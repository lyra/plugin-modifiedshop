<?php
/**
 * PayZen V2-Payment Module version 1.1.0 for xtc_modified 1.x-2.x. Support contact : support@payzen.eu.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * @category  payment
 * @package   payzen
 * @author    Lyra Network (http://www.lyra-network.com/)
 * @copyright 2014-2016 Lyra Network and contributors
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html  GNU General Public License (GPL v2)
 */

include_once (DIR_FS_CATALOG.DIR_ADMIN.'includes/functions/payzen_output.php');
defined('TABLE_PAYZEN_ORDERS_PAYMENT') or define('TABLE_PAYZEN_ORDERS_PAYMENT', 'payzen_orders_payment');

class payzen {
	var $code, $title, $description, $enabled;
	var $order_status;

	function __construct() {
		global $order;

		// initialize code
		$this->code = 'payzen';

		// initialize title
		$this->title = '';

		if (defined('_VALID_XTC')) {
			$image = xtc_image(DIR_WS_ICONS . 'payzen.png', 'PayZen', '', '30', 'style="vertical-align: middle;"');
			$this->title .= $image . ' ';
		}
		$this->title .= MODULE_PAYMENT_PAYZEN_TEXT_TITLE;

		// initialize description
		$this->description = '';
		$this->description .= '<b>' . MODULE_PAYMENT_PAYZEN_MODULE_INFORMATION . '</b>';
		$this->description .= '<br/><br/>';

		$this->description .= MODULE_PAYMENT_PAYZEN_TEXT_DESCRIPTION . '<br/></br>';
		$this->description .= '<p>' . MODULE_PAYMENT_PAYZEN_DEVELOPED_BY . '<a href="http://www.lyra-network.com/" target="_blank">Lyra network</a></p>';
		$this->description .= '<p>' . MODULE_PAYMENT_PAYZEN_CONTACT_EMAIL . '<a href="mailto:support@payzen.eu">support@payzen.eu</a></p>';
		$this->description .= '<p>' . MODULE_PAYMENT_PAYZEN_CONTRIB_VERSION . '1.1.0</p>';
		$this->description .= '<p>' . MODULE_PAYMENT_PAYZEN_GATEWAY_VERSION . 'V2</p>';
		$this->description .= '<p>' . MODULE_PAYMENT_PAYZEN_IPN_URL . HTTP_SERVER . DIR_WS_CATALOG . 'callback/payzen/process.php</p>';

		// initialize enabled
		$this->enabled = (MODULE_PAYMENT_PAYZEN_STATUS == 'True');

		$this->sort_order = MODULE_PAYMENT_PAYZEN_SORT_ORDER;
		$this->form_action_url = MODULE_PAYMENT_PAYZEN_PLATFORM_URL;

		if ((int)MODULE_PAYMENT_PAYZEN_ORDER_STATUS > 0) {
			$this->order_status = MODULE_PAYMENT_PAYZEN_ORDER_STATUS;
		}

		// if there is an order to process, check module availability
		if (is_object($order)) {
			$this->update_status();
		}
	}
	function update_status() {
		global $order;

		require_once DIR_FS_CATALOG . 'includes/external/payzen/api.php';

		if (!$this->enabled) {
			return;
		}

		if (( int) MODULE_PAYMENT_PAYZEN_ZONE > 0) {
			$check_flag = false;
			$check_query = xtc_db_query("SELECT zone_id FROM " . TABLE_ZONES_TO_GEO_ZONES . " WHERE geo_zone_id = '" .
					MODULE_PAYMENT_PAYZEN_ZONE . "' AND zone_country_id = '" . $order->billing['country']['id'] . "' ORDER BY zone_id");

			while($check = xtc_db_fetch_array($check_query)) {
				if ($check['zone_id'] < 1) {
					$check_flag = true;
					break;
				} elseif ($check['zone_id'] == $order->billing['zone_id']) {
					$check_flag = true;
					break;
				}
			}

			if (!$check_flag) {
				$this->enabled = false;
				return;
			}
		}

		// check amount restrictions
		if ((MODULE_PAYMENT_PAYZEN_AMOUNT_MIN != '' && $order->info['total'] < MODULE_PAYMENT_PAYZEN_AMOUNT_MIN) ||
			(MODULE_PAYMENT_PAYZEN_AMOUNT_MAX != '' && $order->info['total'] > MODULE_PAYMENT_PAYZEN_AMOUNT_MAX)) {
			$this->enabled = false;
			return;
		}

		// check currency
		$default_currency = (defined('USE_DEFAULT_LANGUAGE_CURRENCY') && USE_DEFAULT_LANGUAGE_CURRENCY == 'true') ? LANGUAGE_CURRENCY : DEFAULT_CURRENCY;
		if (!PayzenApi::findCurrencyByAlphaCode($order->info['currency']) && !PayzenApi::findCurrencyByAlphaCode($default_currency)) {
			// currency is not supported, module is not available
			$this->enabled = false;
		}
	}
	function javascript_validation() {
		return false;
	}
	function selection() {
		$image = xtc_image (DIR_WS_ICONS . 'payzen.png', 'PayZen', '', '', 'style="vertical-align: middle;"');

		return array(
				'id' => $this->code,
				'module' => $this->title,
				'description' => $image . ' ' . MODULE_PAYMENT_PAYZEN_TEXT_DESCRIPTION
		);
	}
	function pre_confirmation_check() {
		return false;
	}
	function confirmation() {
		return false;
	}
	function process_button() {
		global $order, $xtPrice;

		require_once DIR_FS_CATALOG . 'includes/external/payzen/request.php';
		$request = new PayzenRequest(get_supported_charset());

		// admin configuration parameters
		$configParams = array(
				'site_id',
				'key_test',
				'key_prod',
				'ctx_mode',
				'available_languages',
				'capture_delay',
				'validation_mode',
				'payment_cards',
				'redirect_enabled',
				'redirect_success_timeout',
				'redirect_success_message',
				'redirect_error_timeout',
				'redirect_error_message',
				'return_mode'
		);

		foreach($configParams as $name) {
			$request->set($name, constant('MODULE_PAYMENT_PAYZEN_' . strtoupper($name)));
		}

		// get the current site language
		$language = PayzenApi::isSupportedLanguage($_SESSION['language_code']) ? strtolower($_SESSION['language_code']) : MODULE_PAYMENT_PAYZEN_LANGAGE;

		// get the currency to use
		$currency_value = $order->info['currency_value'];
		$payzen_currency = PayzenApi::findCurrencyByAlphaCode($order->info['currency']);
		if (!$payzen_currency) {
			// currency is not supported, use the default shop currency
			$default_currency = (defined('USE_DEFAULT_LANGUAGE_CURRENCY') && USE_DEFAULT_LANGUAGE_CURRENCY == 'true') ? LANGUAGE_CURRENCY : DEFAULT_CURRENCY;

			$payzen_currency = PayzenApi::findCurrencyByAlphaCode($default_currency);
			$currency_value = 1;
		}

		// calculate amount ...
		$total = round($order->info['total'] * $currency_value, $xtPrice->get_decimal_places($payzen_currency->getAlpha3()));

		// get contrib version and cms used version
		defined('_VALID_XTC') or define('_VALID_XTC', true);
		require_once DIR_FS_CATALOG . (defined('DIR_ADMIN') ? DIR_ADMIN : 'admin/') . 'includes/version.php';

		$contrib = 'xtc_modified1.x-2.x_1.1.0' . '/' . PROJECT_MAJOR_VERSION . '.' . PROJECT_MINOR_VERSION;

		// activate 3ds ?
		$threeds_mpi = null;
		if (MODULE_PAYMENT_PAYZEN_3DS_MIN_AMOUNT != '' && $order->info['total'] < MODULE_PAYMENT_PAYZEN_3DS_MIN_AMOUNT) {
			$threeds_mpi = '2';
		}

		// to get customer title labels
		//require_once (DIR_FS_INC . 'get_customers_gender.inc.php');

		// fill PayZen payment request object
		$data = array(
				// order info
				'amount' => $payzen_currency->convertAmountToInteger($total),
				'order_id' => $this->guess_order_id(),
				'contrib' => $contrib,
				'order_info' => 'session_name=' . xtc_session_name() . '&session_id=' . xtc_session_id(),

				// misc data
				'currency' => $payzen_currency->getNum(),
				'language' => $language,
				'threeds_mpi' => $threedsMpi,
				'url_return' => xtc_href_link('checkout_process_payzen.php', '', 'SSL', true),

				// customer info
				'cust_id' => $_SESSION['customer_id'],
				'cust_email' => $order->customer['email_address'],
				'cust_phone' => $order->customer['telephone'],

				'cust_title' => $order->billing['gender'] == 'm' ? MALE : FEMALE,
				'cust_first_name' => $order->billing['firstname'],
				'cust_last_name' => $order->billing['lastname'],
				'cust_address' => $order->billing['street_address'] . ' ' . $order->billing['suburb'],
				'cust_city' => $order->billing['city'],
				'cust_state' => $order->billing['state'],
				'cust_zip' => $order->billing['postcode'],
				'cust_country' => $order->billing['country']['iso_code_2']
		);

		// delivery data
		if ($order->delivery != false) {
			$data['ship_to_first_name'] = $order->delivery['firstname'];
			$data['ship_to_last_name'] = $order->delivery['lastname'];
			$data['ship_to_street'] = $order->delivery['street_address'];
			$data['ship_to_street2'] = $order->delivery['suburb'];
			$data['ship_to_city'] = $order->delivery['city'];
			$data['ship_to_state'] = $order->delivery['state'];

			$countryCode = $order->delivery['country']['iso_code_2'];
			if ($countryCode == 'FX') { // FX not recognized as a country code by PayPal
				$countryCode = 'FR';
			}
			$data['ship_to_country'] = $countryCode;

			// $data['ship_to_country'] = $order->delivery['country']['iso_code_2'];
			$data['ship_to_zip'] = $order->delivery['postcode'];
		}

		$request->setFromArray($data);
		return $request->getRequestHtmlFields();
	}

	function before_process() {
		global $order, $payzen_response;

		require_once DIR_FS_CATALOG . 'includes/external/payzen/response.php';

		$payzen_response = new PayzenResponse(
				$_REQUEST,
				MODULE_PAYMENT_PAYZEN_CTX_MODE,
				MODULE_PAYMENT_PAYZEN_KEY_TEST,
				MODULE_PAYMENT_PAYZEN_KEY_PROD
		);

		$from_server = $payzen_response->get('hash') != null;

		// check authenticity
		if (!$payzen_response->isAuthentified()) {
			if ($from_server) {
				die($payzen_response->getOutputForPlatform('auth_fail'));
			} else {
				$_SESSION['payzen_error'] = MODULE_PAYMENT_PAYZEN_TECHNICAL_ERROR;
				xtc_redirect(xtc_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_error=' . $this->code, 'SSL', true));
			}
		}

		// act according to case
		if ($payzen_response->isAcceptedPayment()) {
			$query = xtc_db_query("SELECT orders_id FROM " . TABLE_PAYZEN_ORDERS_PAYMENT .
								  " WHERE trans_uuid = '" . $payzen_response->get('trans_uuid') . "'");
			$result = xtc_db_fetch_array($query);

			if (!$this->is_processed_payment($payzen_response->get('trans_uuid'))) { // order not processed yet
				$sql_data_array = array(
						'trans_id' => $payzen_response->get('trans_id'),
						'trans_uuid' => $payzen_response->get('trans_uuid'),
						'trans_status' => $payzen_response->get('trans_status'),
						'result' => serialize($payzen_response->getAllResults()),
						'card_number' => $payzen_response->get('card_number'),
						'card_brand' => $payzen_response->get('card_brand'),
						'card_expiration' => str_pad($payzen_response->get('expiry_month'), 2, '0', STR_PAD_LEFT) . '/' . $payzen_response->get('expiry_year')
				);

				// insert payment information to payzen_orders_payment table
				xtc_db_perform(TABLE_PAYZEN_ORDERS_PAYMENT, $sql_data_array);

				// update the order_staus
				if($this->order_status) {
					$order->info['order_status'] = $this->order_status;
				}

				// update order payment data for xtc modified 1.x versions
				$order->info['cc_type'] = $payzen_response->get('card_brand');
				$order->info['cc_number'] = $payzen_response->get('card_number');
				$order->info['cc_expires'] = $payzen_response->get('expiry_year'); // only 4 positions available for this field

				if (!$from_server && (MODULE_PAYMENT_PAYZEN_CTX_MODE == 'TEST')) {
					// abnormal case : payment confirmed by client return, IPN URL not worked: show warning in test mode
					$_SESSION['payzen_warn'] = true;
				}

				// let checkout_process.php finish the job
				return false;
			} else {
				// successful payment confirmation
				if ($from_server) {
					die($payzen_response->getOutputForPlatform('payment_ok_already_done'));
				} else {
					return false;
				}
			}
		} else {
			// payment failed or cancelled
			if ($from_server) {
				die($payzen_response->getOutputForPlatform('payment_ko'));
			} else {
				$error = '';
				$error .= MODULE_PAYMENT_PAYZEN_PAYMENT_ERROR;
				$error .= ' ' . $payzen_response->getMessage();
				$_SESSION['payzen_error'] = $error;

				xtc_redirect(xtc_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_error=' . $this->code, 'SSL'));
			}
		}
	}

	function after_process() {
		global $insert_id, $payzen_response;

		// update order_id in payzen_orders_payment table
		xtc_db_query("UPDATE " . TABLE_PAYZEN_ORDERS_PAYMENT . " SET orders_id = " . $insert_id .
					 " WHERE trans_uuid='" . $payzen_response->get('trans_uuid') . "'");

		$from_server = $payzen_response->get('hash') != null;
		if ($from_server) {
			$_SESSION['payzen_ipn'] = true;
			echo($payzen_response->getOutputForPlatform('payment_ok'));
		}

		return false;
	}

	function success() {
		$messages = array();

		if (isset($_SESSION['payzen_info'])) {
			array_push($messages, array(
					'title' => MODULE_PAYMENT_PAYZEN_INFORMATION_TITLE,
					'class' => $this->code,
					'fields' => array(
							array(
									'field' => MODULE_PAYMENT_PAYZEN_GOING_INTO_PROD_INFO .
											   '<a href="https://secure.payzen.eu/html/faq/prod" target="_blank">https://secure.payzen.eu/html/faq/prod</a><br /><br />'
							)
					)
			));

			unset($_SESSION['payzen_info']);
		}

		if (isset($_SESSION['payzen_warn'])) {
			array_push($messages, array(
					'title' => MODULE_PAYMENT_PAYZEN_WARNING_TITLE,
					'class' => $this->code,
					'fields' => array(
							array('field' => MODULE_PAYMENT_PAYZEN_CHECK_URL_WARN),
							array('field' =>  MODULE_PAYMENT_PAYZEN_CHECK_URL_WARN_DETAIL)
					)
			));

			unset($_SESSION['payzen_warn']);
		}

		return (empty($messages) ? false : $messages);
	}

	function get_error() {
		$error = false;
		if (isset($_SESSION['payzen_error'])) {
			$error = array(
					'error' => $_SESSION['payzen_error']
			);
			unset($_SESSION['payzen_error']);
		}

		return $error;
	}

	function check() {
		if (!isset($this->_check)) {
			$check_query = xtc_db_query("SELECT configuration_value FROM " . TABLE_CONFIGURATION .
					" WHERE configuration_key = 'MODULE_PAYMENT_PAYZEN_STATUS'");
			$this->_check = xtc_db_num_rows($check_query);
		}

		return $this->_check;
	}

	function _install_query($key, $value, $sort_order, $set_function = null, $use_function = null) {
		$prefix = 'MODULE_PAYMENT_PAYZEN_';

		$sql_data = array(
				'configuration_key' => $prefix . $key,
				'configuration_value' => $value,
				'configuration_group_id' => '6',
				'sort_order' => $sort_order,
				'date_added' => 'now()'
		);

		if ($set_function) {
			$sql_data['set_function'] = $set_function;
		}
		if ($use_function) {
			$sql_data['use_function'] = $use_function;
		}

		xtc_db_perform(TABLE_CONFIGURATION, $sql_data);
	}

	function install() {
		// create payzen_orders_payment table
		xtc_db_query("CREATE TABLE IF NOT EXISTS " . TABLE_PAYZEN_ORDERS_PAYMENT . " (
							payment_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
							orders_id  INT(11) NOT NULL DEFAULT 0,
							trans_id VARCHAR(6),
							trans_uuid VARCHAR(32),
							trans_status VARCHAR(100) ,
							result TEXT ,
							card_number VARCHAR(36),
							card_brand VARCHAR(127),
							card_expiration VARCHAR(7),
							KEY idx_orders_id (orders_id)
					) ENGINE = MYISAM");

		// xtc specific parameters
		$this->_install_query('ALLOWED', '', 0);
		$this->_install_query('STATUS', 'True', 1, 'xtc_cfg_select_option(array(\'True\', \'False\'),', 'payzen_get_text_title');
		$this->_install_query('SORT_ORDER', '0', 2);
		$this->_install_query('ZONE', '0', 3, 'xtc_cfg_pull_down_zone_classes(', 'xtc_get_zone_class_title');

		// gateway access parameters
		$this->_install_query('SITE_ID', '12345678', 10);
		$this->_install_query('KEY_TEST', '1111111111111111', 11);
		$this->_install_query('KEY_PROD', '2222222222222222', 12);
		$this->_install_query('CTX_MODE', 'TEST', 13, 'xtc_cfg_select_option(array(\'TEST\', \'PRODUCTION\'),');
		$this->_install_query('PLATFORM_URL', 'https://secure.payzen.eu/vads-payment/', 14);

		$this->_install_query('LANGUAGE', 'fr', 21, 'payzen_cfg_pull_down_langs(', 'payzen_get_lang_title');
		$this->_install_query('AVAILABLE_LANGUAGES', '', 22, 'payzen_cfg_pull_down_multi_langs(', 'payzen_get_multi_lang_title');
		$this->_install_query('CAPTURE_DELAY', '', 23);
		$this->_install_query('VALIDATION_MODE', '', 24, 'payzen_cfg_pull_down_validation_modes(', 'payzen_get_validation_mode_title');
		$this->_install_query('PAYMENT_CARDS', '', 25, 'payzen_cfg_pull_down_cards(', 'payzen_get_card_title');
		$this->_install_query('3DS_MIN_AMOUNT', '', 26);

		// amount restriction
		$this->_install_query('AMOUNT_MIN', '', 30);
		$this->_install_query('AMOUNT_MAX', '', 31);

		// gateway return parameters
		$this->_install_query('REDIRECT_ENABLED', 'False', 40, 'xtc_cfg_select_option(array(\'True\', \'False\'),');
		$this->_install_query('REDIRECT_SUCCESS_TIMEOUT', '5', 41);
		$this->_install_query('REDIRECT_SUCCESS_MESSAGE', htmlentities('Redirection vers la boutique dans quelques instants...', ENT_QUOTES, 'UTF-8'), 42);
		$this->_install_query('REDIRECT_ERROR_TIMEOUT', '5', 43);
		$this->_install_query('REDIRECT_ERROR_MESSAGE', htmlentities('Redirection vers la boutique dans quelques instants...', ENT_QUOTES, 'UTF-8'), 44);
		$this->_install_query('RETURN_MODE', 'GET', 45, "xtc_cfg_select_option(array(\'GET\', \'POST\'), ");
		$this->_install_query('ORDER_STATUS', '1', 48, 'xtc_cfg_pull_down_order_statuses(', 'xtc_get_order_status_name');
	}

	function remove() {
		$config_params = $this->keys();

		// parameters not shown in admin configuration
		$config_params[] = 'MODULE_PAYMENT_PAYZEN_ALLOWED';

		foreach($config_params as $param) {
			xtc_db_query("DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = '" . $param . "'");
		}
	}

	function keys() {
		return array(
				'MODULE_PAYMENT_PAYZEN_STATUS',
				'MODULE_PAYMENT_PAYZEN_SORT_ORDER',
				'MODULE_PAYMENT_PAYZEN_ZONE',

				'MODULE_PAYMENT_PAYZEN_SITE_ID',
				'MODULE_PAYMENT_PAYZEN_KEY_TEST',
				'MODULE_PAYMENT_PAYZEN_KEY_PROD',
				'MODULE_PAYMENT_PAYZEN_CTX_MODE',
				'MODULE_PAYMENT_PAYZEN_PLATFORM_URL',

				'MODULE_PAYMENT_PAYZEN_LANGUAGE',
				'MODULE_PAYMENT_PAYZEN_AVAILABLE_LANGUAGES',
				'MODULE_PAYMENT_PAYZEN_CAPTURE_DELAY',
				'MODULE_PAYMENT_PAYZEN_VALIDATION_MODE',
				'MODULE_PAYMENT_PAYZEN_PAYMENT_CARDS',
				'MODULE_PAYMENT_PAYZEN_3DS_MIN_AMOUNT',

				'MODULE_PAYMENT_PAYZEN_AMOUNT_MIN',
				'MODULE_PAYMENT_PAYZEN_AMOUNT_MAX',

				'MODULE_PAYMENT_PAYZEN_REDIRECT_ENABLED',
				'MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_TIMEOUT',
				'MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_MESSAGE',
				'MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_TIMEOUT',
				'MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_MESSAGE',
				'MODULE_PAYMENT_PAYZEN_RETURN_MODE',
				'MODULE_PAYMENT_PAYZEN_ORDER_STATUS'
		);
	}

	function guess_order_id() {
		$query = xtc_db_query("SELECT MAX(orders_id) AS orders_id FROM " . TABLE_ORDERS);

		if (!xtc_db_num_rows($query)) {
			return 1;
		} else {
			$result = xtc_db_fetch_array($query);
			return $result['orders_id'] + 1;
		}
	}

	function admin_order($oID, $lang) {
		require_once DIR_FS_CATALOG . 'includes/external/payzen/response.php';

		$oID = (int) $oID;
		if (!is_int($oID))
			return false;

		$query = xtc_db_query("SELECT * FROM ".TABLE_PAYZEN_ORDERS_PAYMENT." WHERE orders_id = '" . $oID . "'");
		$data = xtc_db_fetch_array($query);

		// result description is stored as serialized array
		$allResults = unserialize($data['result']);
		$keys = ['result', 'auth_result', 'warranty_result'];

		$texts = [];
		foreach ($keys as $key) {
			$text = PayzenResponse::translate($allResults[$key], $key, $lang);
			if(!$text) {
				continue;
			}

			$text = htmlentities($text, ENT_QUOTES, 'UTF-8');
			$text = PayzenResponse::appendResultCode($text, $allResults[$key]);
			if ($key === 'result' && $allResults[$key] == '30') {
				$extraResult = $allResults['extra_result'];
				$text .= ' ' . PayzenResponse::appendResultCode(PayzenResponse::$FORM_ERRORS[$extraResult], $extraResult);
			}

			$texts[] = $text;
		}

		$html = '
				<tr>
					<td class="main" colspan="2">' . implode('<br />', $texts) . '</td>
				</tr>
				<tr>
					<td class="main"><span style="font-weight: bold">'. MODULE_PAYMENT_PAYZEN_PAYMENT_MEAN .':</span></td>
					<td class="main">' . $data['card_brand'] . '</td>
				</tr>
				<tr>
					<td class="main"><span style="font-weight: bold">' . MODULE_PAYMENT_PAYZEN_TRANSACTION_ID .':</span></td>
					<td class="main">' . $data['trans_id'] . '</td>
				</tr>
				<tr>
					<td class="main"><span style="font-weight: bold">' . MODULE_PAYMENT_PAYZEN_CARD_NUMBER .':</span></td>
					<td class="main">' . $data['card_number'] . '</td>
				</tr>
				<tr>
					<td class="main"><span style="font-weight: bold">' . MODULE_PAYMENT_PAYZEN_EXPIRATION_DATE .':</span></td>
					<td class="main">' . $data['card_expiration'] . '</td>
				</tr>';

		echo $html;
	}

	function is_processed_payment ($trans_uuid){
		$query = xtc_db_query("SELECT orders_id FROM " . TABLE_PAYZEN_ORDERS_PAYMENT . " WHERE trans_uuid = '". $trans_uuid. "'");
		$result = xtc_db_fetch_array($query);

		return  (is_array($result) && $result['orders_id'] > 0);
	}
}
