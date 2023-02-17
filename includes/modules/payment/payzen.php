<?php
/**
 * Copyright © Lyra Network.
 * This file is part of PayZen plugin for modified eCommerce Shopsoftware. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL v2)
 */

// Include autoloaders.
require_once(DIR_FS_EXTERNAL . 'payzen/sdk-autoload.php');
require_once(DIR_FS_EXTERNAL . 'payzen/payzen_logger.php');

use Lyranetwork\Payzen\Sdk\Form\Api as PayzenApi;
use Lyranetwork\Payzen\Sdk\Form\Request as PayzenRequest;
use Lyranetwork\Payzen\Sdk\Form\Response as PayzenResponse;

global $payzen_plugin_features;

$payzen_plugin_features = array(
    'qualif' => false,
    'prodfaq' => true,
    'shatwo' => true,
);

include_once(DIR_FS_CATALOG . 'admin/includes/functions/payzen_output.php');
require_once(DIR_FS_INC . 'xtc_get_shop_conf.inc.php');

// Load module language file.
require_once(DIR_FS_CATALOG . 'lang/' . $_SESSION['language'] . '/modules/payment/payzen.php');

defined('TABLE_PAYZEN_ORDERS_PAYMENT') or define('TABLE_PAYZEN_ORDERS_PAYMENT', 'payzen_orders_payment');

class payzen
{
    private static $GATEWAY_NAME = 'PayZen';
    private static $GATEWAY_URL = 'https://secure.payzen.eu/vads-payment/';
    private static $SITE_ID = '12345678';
    private static $KEY_TEST = '1111111111111111';
    private static $KEY_PROD = '2222222222222222';
    private static $CTX_MODE = 'TEST';
    private static $SIGN_ALGO = 'SHA-256';
    private static $LANGUAGE = 'fr';

    private static $CMS_IDENTIFIER = 'modified_eCommerce_Shopsoftware_1.x-2.x';
    private static $SUPPORT_EMAIL = 'support@payzen.eu';
    private static $PLUGIN_VERSION = '1.2.1';
    private static $GATEWAY_VERSION = 'V2';

    var $code, $title, $description, $enabled;
    var $order_status;
    var $logger;

    function __construct()
    {
        global $order;

        // Initialize code.
        $this->code = 'payzen';

        // Initialize title.
        $this->title = '';

        if (defined('_VALID_XTC')) {
            $image = xtc_image(DIR_WS_ICONS . 'payzen.png', static::$GATEWAY_NAME, '', '30', 'style="vertical-align: middle;"');
            $this->title .= $image . ' ';
        }

        $this->title .= MODULE_PAYMENT_PAYZEN_TEXT_TITLE;

        // Initialize description.
        $this->description = '';
        $this->description .= '<b>' . MODULE_PAYMENT_PAYZEN_MODULE_INFORMATION . '</b>';
        $this->description .= '<br/><br/>';

        $this->description .= MODULE_PAYMENT_PAYZEN_TEXT_DESCRIPTION . '<br/></br>';
        $this->description .= '<p>' . MODULE_PAYMENT_PAYZEN_DEVELOPED_BY . '<a href="http://www.lyra-network.com/" target="_blank">Lyra network</a></p>';
        $this->description .= '<p>' . MODULE_PAYMENT_PAYZEN_CONTACT_EMAIL . PayzenApi::formatSupportEmails(self::$SUPPORT_EMAIL) . '</p>';
        $this->description .= '<p>' . MODULE_PAYMENT_PAYZEN_CONTRIB_VERSION . self::$PLUGIN_VERSION . '</p>';
        $this->description .= '<p>' . MODULE_PAYMENT_PAYZEN_GATEWAY_VERSION . self::$GATEWAY_VERSION . '</p>';
        $this->description .= '<p>' . MODULE_PAYMENT_PAYZEN_DOC . self::getOnlineDocUri() . '</p>';
        $this->description .= '<p>' . MODULE_PAYMENT_PAYZEN_IPN_URL . HTTP_SERVER . DIR_WS_CATALOG . 'callback/payzen/process.php</p>';

        // Initialize enabled.
        $this->enabled = defined('MODULE_PAYMENT_PAYZEN_STATUS') && (MODULE_PAYMENT_PAYZEN_STATUS == 'True');

        $this->sort_order = defined('0MODULE_PAYMENT_PAYZEN_SORT_ORDER') ? MODULE_PAYMENT_PAYZEN_SORT_ORDER : 0;
        $this->form_action_url = defined('MODULE_PAYMENT_PAYZEN_PLATFORM_URL') ? MODULE_PAYMENT_PAYZEN_PLATFORM_URL : '';

        if (defined('MODULE_PAYMENT_PAYZEN_ORDER_STATUS') && ((int)MODULE_PAYMENT_PAYZEN_ORDER_STATUS > 0)) {
            $this->order_status = MODULE_PAYMENT_PAYZEN_ORDER_STATUS;
        }

        // If there is an order to process, check module availability.
        if (is_object($order)) {
            $this->update_status();
        }

        // Init class logger.
        $this->logger = new PayzenLogger(date('Y_m') . '_payzen.log');
    }

    function getOnlineDocUri()
    {
        // Get documentation links.
        $languages = array(
            'fr' => 'Français',
            'en' => 'English',
            'es' => 'Español',
            'pt' => 'Português'
            // Complete when other languages are managed.
        );

        $docsUri = "";
        foreach (PayzenApi::getOnlineDocUri() as $lang => $docUri) {
            $docsUri .= '<a style="margin-left: 10px; text-decoration: none; text-transform: uppercase; color: red;" href="' . $docUri . 'modified/sitemap.html" target="_blank">' . $languages[$lang] . '</a>';
        }

        return $docsUri;
    }

    function update_status()
    {
        global $order;

        if (! $this->enabled) {
            return;
        }

        if ((int) MODULE_PAYMENT_PAYZEN_ZONE > 0) {
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

            if (! $check_flag) {
                $this->enabled = false;
                return;
            }
        }

        // Check amount restrictions.
        if ((MODULE_PAYMENT_PAYZEN_AMOUNT_MIN != '' && $order->info['total'] < MODULE_PAYMENT_PAYZEN_AMOUNT_MIN) ||
            (MODULE_PAYMENT_PAYZEN_AMOUNT_MAX != '' && $order->info['total'] > MODULE_PAYMENT_PAYZEN_AMOUNT_MAX)) {
            $this->enabled = false;
            return;
        }

        // Check currency.
        $default_currency = (defined('USE_DEFAULT_LANGUAGE_CURRENCY') && USE_DEFAULT_LANGUAGE_CURRENCY == 'true') ? LANGUAGE_CURRENCY : DEFAULT_CURRENCY;
        if (! PayzenApi::findCurrencyByAlphaCode($order->info['currency']) && ! PayzenApi::findCurrencyByAlphaCode($default_currency)) {
            // Currency is not supported, module is not available.
            $this->enabled = false;
        }
    }

    function javascript_validation()
    {
        return false;
    }

    function selection()
    {
        $image = xtc_image (DIR_WS_ICONS . 'payzen.png', self::$GATEWAY_NAME, '', '', 'style="vertical-align: middle;"');

        return array(
            'id' => $this->code,
            'module' => $this->title,
            'description' => $image . ' ' . MODULE_PAYMENT_PAYZEN_TEXT_DESCRIPTION
        );
    }

    function pre_confirmation_check()
    {
        return false;
    }

    function confirmation()
    {
        return false;
    }

    function process_button()
    {
        global $order, $xtPrice;

        $request = new PayzenRequest(get_supported_charset());

        // Admin configuration parameters.
        $configParams = array(
            'site_id',
            'key_test',
            'key_prod',
            'ctx_mode',
            'sign_algo',
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

        foreach ($configParams as $name) {
            $request->set($name, constant('MODULE_PAYMENT_PAYZEN_' . strtoupper($name)));
        }

        // Get the current site language.
        $language = PayzenApi::isSupportedLanguage($_SESSION['language_code']) ? strtolower($_SESSION['language_code']) : MODULE_PAYMENT_PAYZEN_LANGAGE;

        // Get the currency to use.
        $currency_value = $order->info['currency_value'];
        $payzen_currency = PayzenApi::findCurrencyByAlphaCode($order->info['currency']);
        if (! $payzen_currency) {
            // Currency is not supported, use the default shop currency.
            $default_currency = (defined('USE_DEFAULT_LANGUAGE_CURRENCY') && USE_DEFAULT_LANGUAGE_CURRENCY == 'true') ? LANGUAGE_CURRENCY : DEFAULT_CURRENCY;

            $payzen_currency = PayzenApi::findCurrencyByAlphaCode($default_currency);
            $currency_value = 1;
        }

        // Calculate amount.
        $total = round($order->info['total'] * $currency_value, $xtPrice->get_decimal_places($payzen_currency->getAlpha3()));

        // Get contrib version and cms used version.
        defined('_VALID_XTC') or define('_VALID_XTC', true);
        require_once DIR_FS_CATALOG . (defined('DIR_ADMIN') ? DIR_ADMIN : 'admin/') . 'includes/version.php';

        $contrib = self::$CMS_IDENTIFIER . '_' . self::$PLUGIN_VERSION . '/' . PROJECT_MAJOR_VERSION . '.' . PROJECT_MINOR_VERSION . '/' . PayzenApi::shortPhpVersion();

        // Activate 3ds?
        $threeds_mpi = null;
        if (MODULE_PAYMENT_PAYZEN_3DS_MIN_AMOUNT != '' && $order->info['total'] < MODULE_PAYMENT_PAYZEN_3DS_MIN_AMOUNT) {
            $threeds_mpi = '2';
        }

        // Fill gateway payment request object.
        $data = array(
            // Order info.
            'amount' => $payzen_currency->convertAmountToInteger($total),
            'order_id' => $this->guess_order_id(),
            'contrib' => $contrib,

            // Misc data.
            'currency' => $payzen_currency->getNum(),
            'language' => $language,
            'threeds_mpi' => $threeds_mpi,
            'url_return' => xtc_href_link('checkout_process_payzen.php', '', 'SSL', true),

            // Customer info.
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

        // Delivery data.
        if ($order->delivery != false) {
            $data['ship_to_first_name'] = $order->delivery['firstname'];
            $data['ship_to_last_name'] = $order->delivery['lastname'];
            $data['ship_to_street'] = $order->delivery['street_address'];
            $data['ship_to_street2'] = $order->delivery['suburb'];
            $data['ship_to_city'] = $order->delivery['city'];
            $data['ship_to_state'] = $order->delivery['state'];

            $countryCode = $order->delivery['country']['iso_code_2'];
            if ($countryCode == 'FX') { // FX not recognized as a country code by PayPal.
                $countryCode = 'FR';
            }

            $data['ship_to_country'] = $countryCode;
            $data['ship_to_zip'] = $order->delivery['postcode'];
        }

        // Set session_name and session_id as ext_info.
        $request->addExtInfo('session_name', xtc_session_name());
        $request->addExtInfo('session_id', xtc_session_id());

        $dataToLog = $request->getRequestFieldsArray(true, false);
        $this->log('Data to be sent to payment gateway: ' . json_encode($dataToLog));

        $request->setFromArray(array_map('stripslashes', $data));
        return $request->getRequestHtmlFields();
    }

    function before_process()
    {
        global $order, $payzen_response;

        $payzen_response = new PayzenResponse(
            array_map('stripslashes', $_REQUEST),
            MODULE_PAYMENT_PAYZEN_CTX_MODE,
            MODULE_PAYMENT_PAYZEN_KEY_TEST,
            MODULE_PAYMENT_PAYZEN_KEY_PROD,
            MODULE_PAYMENT_PAYZEN_SIGN_ALGO
        );

        $from_server = $payzen_response->get('hash') != null;
        if ($from_server) {
            $this->log('IPN URL PROCESS START');
        }

        // Check authenticity.
        if (! $payzen_response->isAuthentified()) {
            $ip = $_SERVER['REMOTE_ADDR'];
            $this->log("{$ip} tries to access modules/payment/payzen file without valid signature with parameters: " . json_encode($_REQUEST));
            $this->log('Signature algorithm selected in module settings must be the same as one selected in gateway Back Office.');

            if ($from_server) {
                $this->log('IPN URL PROCESS END');
                die($payzen_response->getOutputForPlatform('auth_fail'));
            } else {
                $_SESSION['payzen_error'] = MODULE_PAYMENT_PAYZEN_TECHNICAL_ERROR;
                xtc_redirect(xtc_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_error=' . $this->code, 'SSL', true));
            }
        }

        // Act according to case.
        if ($payzen_response->isAcceptedPayment()) {
            if (! $this->is_processed_payment($payzen_response->get('trans_uuid'))) { // Order not processed yet.
                $this->log("Payment accepted for order ID #{$payzen_response->get('order_id')}.");

                // Save  card brand user choice.
                $card_brand_choice = '';
                if ($payzen_response->get('brand_management')) {
                    $brand_info = json_decode($payzen_response->get('brand_management'));
                    if (isset($brand_info->userChoice) && $brand_info->userChoice) {
                        $card_brand_choice = 'MODULE_PAYMENT_PAYZEN_PAYMENT_CARD_BRAND_BUYER_CHOICE';
                    } else {
                        $card_brand_choice = 'MODULE_PAYMENT_PAYZEN_PAYMENT_CARD_BRAND_DEFAULT_CHOICE';
                    }
                }

                $sql_data_array = array(
                    'trans_id' => $payzen_response->get('trans_id'),
                    'trans_uuid' => $payzen_response->get('trans_uuid'),
                    'trans_status' => $payzen_response->get('trans_status'),
                    'result' => serialize($payzen_response->getAllResults()),
                    'card_number' => $payzen_response->get('card_number'),
                    'card_brand' => $payzen_response->get('card_brand'),
                    'card_brand_choice' => $card_brand_choice,
                    'card_expiration' => str_pad($payzen_response->get('expiry_month'), 2, '0', STR_PAD_LEFT) . '/' . $payzen_response->get('expiry_year')
                );

                // Insert payment information to payzen_orders_payment table.
                xtc_db_perform(TABLE_PAYZEN_ORDERS_PAYMENT, $sql_data_array);

                // Update the order_staus.
                if ($this->order_status) {
                    $order->info['order_status'] = $this->order_status;
                }

                // Update order payment data for xtc modified 1.x versions.
                $order->info['cc_type'] = $payzen_response->get('card_brand');
                $order->info['cc_number'] = $payzen_response->get('card_number');
                $order->info['cc_expires'] = $payzen_response->get('expiry_year'); // Only 4 positions available for this field.

                if (! $from_server && (MODULE_PAYMENT_PAYZEN_CTX_MODE == 'TEST')) {
                    // Abnormal case : payment confirmed by client return, IPN URL not worked: show warning in test mode.
                    $this->log("Payment has been processed by client return! This means the IPN URL did not work.");
                    $_SESSION['payzen_warn'] = true;
                }

                // Let checkout_process.php finish the job.
                return false;
            } else {
                $this->logger->logInfo("Payment success confirmed for order ID #{$payzen_response->get('order_id')}.");

                // Successful payment confirmation.
                if ($from_server) {
                    $this->log('IPN URL PROCESS END');
                    die($payzen_response->getOutputForPlatform('payment_ok_already_done'));
                }

                return false;
            }
        } else {
            $this->log("Payment failed for order ID #{$payzen_response->get('order_id')}.");

            // Payment failed or cancelled.
            if ($from_server) {
                $this->log('IPN URL PROCESS END');
                die($payzen_response->getOutputForPlatform('payment_ko'));
            } else {
                $error = '';
                if (! $payzen_response->isCancelledPayment()) {
                    $error .= MODULE_PAYMENT_PAYZEN_PAYMENT_ERROR;
                    $_SESSION['payzen_error'] = $error;
                }

                $this->log("Redirect to checkout page.");
                xtc_redirect(xtc_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_error=' . $this->code, 'SSL'));
            }
        }
    }

    function after_process()
    {
        global $insert_id, $payzen_response;

        // Update order_id in payzen_orders_payment table.
        xtc_db_query("UPDATE " . TABLE_PAYZEN_ORDERS_PAYMENT . " SET orders_id = " . $insert_id .
            " WHERE trans_uuid='" . $payzen_response->get('trans_uuid') . "'");

        $this->log("Order #{$insert_id} created for gateway order ID #{$payzen_response->get('order_id')}.");

        $from_server = $payzen_response->get('hash') != null;
        if ($from_server) {
            $this->log('IPN URL PROCESS END');
            $_SESSION['payzen_ipn'] = true;

            echo($payzen_response->getOutputForPlatform('payment_ok'));
        }

        return false;
    }

    function success()
    {
        global $payzen_plugin_features;
        $messages = array();

        if (isset($_SESSION['payzen_info']) && $payzen_plugin_features['prodfaq']) {
            array_push($messages, array(
                'title' => MODULE_PAYMENT_PAYZEN_INFORMATION_TITLE,
                'class' => $this->code,
                'fields' => array(
                    array(
                        'field' => MODULE_PAYMENT_PAYZEN_GOING_INTO_PROD_INFO
                    )
                )
            ));

            unset($_SESSION['payzen_info']);
        }

        if (isset($_SESSION['payzen_warn'])) {
            $fields = array();

            if (xtc_get_shop_conf('SHOP_OFFLINE') == 'checked') {
                $fields[] = array('field' => MODULE_PAYMENT_PAYZEN_MAINTENANCE_MODE_WARN);
            } else {
                $fields[] = array('field' => MODULE_PAYMENT_PAYZEN_CHECK_URL_WARN);
                $fields[] = array('field' =>  MODULE_PAYMENT_PAYZEN_CHECK_URL_WARN_DETAIL);
            }

            array_push($messages, array(
                'title' => MODULE_PAYMENT_PAYZEN_WARNING_TITLE,
                'class' => $this->code,
                'fields' => $fields
            ));

            unset($_SESSION['payzen_warn']);
        }

        return (empty($messages) ? false : $messages);
    }

    function get_error()
    {
        $error = false;
        if (isset($_SESSION['payzen_error'])) {
            $error = array(
                'error' => $_SESSION['payzen_error']
            );

            unset($_SESSION['payzen_error']);
        }

        return $error;
    }

    function check()
    {
        if (! isset($this->_check)) {
            $check_query = xtc_db_query("SELECT configuration_value FROM " . TABLE_CONFIGURATION .
                " WHERE configuration_key = 'MODULE_PAYMENT_PAYZEN_STATUS'");
            $this->_check = xtc_db_num_rows($check_query);
        }

        return $this->_check;
    }

    function _install_query($key, $value, $sort_order, $set_function = null, $use_function = null)
    {
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

    function install()
    {
        global $payzen_plugin_features;

        // Create payzen_orders_payment table.
        xtc_db_query("CREATE TABLE IF NOT EXISTS " . TABLE_PAYZEN_ORDERS_PAYMENT . " (
                            payment_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            orders_id  INT(11) NOT NULL DEFAULT 0,
                            trans_id VARCHAR(6),
                            trans_uuid VARCHAR(32),
                            trans_status VARCHAR(100) ,
                            result TEXT ,
                            card_number VARCHAR(36),
                            card_brand VARCHAR(127),
                            card_brand_choice VARCHAR(255) ,
                            card_expiration VARCHAR(7),
                            KEY idx_orders_id (orders_id)
                      ) ENGINE = MYISAM");

        // Xtc specific parameters.
        $this->_install_query('ALLOWED', '', 0);
        $this->_install_query('STATUS', 'True', 1, 'xtc_cfg_select_option(array(\'True\', \'False\'),', 'payzen_get_text_title');
        $this->_install_query('SORT_ORDER', '0', 2);
        $this->_install_query('ZONE', '0', 3, 'xtc_cfg_pull_down_zone_classes(', 'xtc_get_zone_class_title');

        // Gateway access parameters.
        $this->_install_query('SITE_ID', self::$SITE_ID, 10);

        $params = 'array(\'PRODUCTION\')';
        if (! $payzen_plugin_features['qualif']) {
            $params = 'array(\'TEST\', \'PRODUCTION\')';
            $this->_install_query('KEY_TEST', self::$KEY_TEST, 11);
        }

        $this->_install_query('KEY_PROD', self::$KEY_PROD, 12);
        $this->_install_query('CTX_MODE', self::$CTX_MODE, 13, "xtc_cfg_select_option($params,");
        $this->_install_query('SIGN_ALGO', self::$SIGN_ALGO, 14, 'payzen_cfg_draw_pull_down_sign_algos(', 'payzen_get_sign_algo_title');
        $this->_install_query('PLATFORM_URL', self::$GATEWAY_URL, 15);

        $this->_install_query('LANGUAGE', self::$LANGUAGE, 21, 'payzen_cfg_pull_down_langs(', 'payzen_get_lang_title');
        $this->_install_query('AVAILABLE_LANGUAGES', '', 22, 'payzen_cfg_pull_down_multi_langs(', 'payzen_get_multi_lang_title');
        $this->_install_query('CAPTURE_DELAY', '', 23);
        $this->_install_query('VALIDATION_MODE', '', 24, 'payzen_cfg_pull_down_validation_modes(', 'payzen_get_validation_mode_title');
        $this->_install_query('PAYMENT_CARDS', '', 25, 'payzen_cfg_pull_down_cards(', 'payzen_get_card_title');
        $this->_install_query('3DS_MIN_AMOUNT', '', 26);

        // Amount restriction.
        $this->_install_query('AMOUNT_MIN', '', 30);
        $this->_install_query('AMOUNT_MAX', '', 31);

        // Gateway return parameters.
        $this->_install_query('REDIRECT_ENABLED', 'False', 40, 'xtc_cfg_select_option(array(\'True\', \'False\'),');
        $this->_install_query('REDIRECT_SUCCESS_TIMEOUT', '5', 41);
        $this->_install_query('REDIRECT_SUCCESS_MESSAGE', html_entity_decode(MODULE_PAYMENT_PAYZEN_REDIRECT_MESSAGE, ENT_QUOTES, 'UTF-8'), 42);
        $this->_install_query('REDIRECT_ERROR_TIMEOUT', '5', 43);
        $this->_install_query('REDIRECT_ERROR_MESSAGE', html_entity_decode(MODULE_PAYMENT_PAYZEN_REDIRECT_MESSAGE, ENT_QUOTES, 'UTF-8'), 44);
        $this->_install_query('RETURN_MODE', 'GET', 45, "xtc_cfg_select_option(array(\'GET\', \'POST\'), ");
        $this->_install_query('ORDER_STATUS', '1', 48, 'xtc_cfg_pull_down_order_statuses(', 'xtc_get_order_status_name');
    }

    function remove()
    {
        $config_params = $this->keys();

        // Parameters not shown in admin configuration.
        $config_params[] = 'MODULE_PAYMENT_PAYZEN_ALLOWED';

        foreach ($config_params as $param) {
            xtc_db_query("DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = '" . $param . "'");
        }
    }

    function keys()
    {
        global $payzen_plugin_features;

        $keys = array();
        $keys[] = 'MODULE_PAYMENT_PAYZEN_STATUS';
        $keys[] = 'MODULE_PAYMENT_PAYZEN_SORT_ORDER';
        $keys[] = 'MODULE_PAYMENT_PAYZEN_ZONE';

        $keys[] = 'MODULE_PAYMENT_PAYZEN_SITE_ID';

        if (! $payzen_plugin_features['qualif']) {
            $keys[] = 'MODULE_PAYMENT_PAYZEN_KEY_TEST';
        }

        $keys[] = 'MODULE_PAYMENT_PAYZEN_KEY_PROD';
        $keys[] = 'MODULE_PAYMENT_PAYZEN_CTX_MODE';
        $keys[] = 'MODULE_PAYMENT_PAYZEN_SIGN_ALGO';
        $keys[] = 'MODULE_PAYMENT_PAYZEN_PLATFORM_URL';

        $keys[] = 'MODULE_PAYMENT_PAYZEN_LANGUAGE';
        $keys[] = 'MODULE_PAYMENT_PAYZEN_AVAILABLE_LANGUAGES';
        $keys[] = 'MODULE_PAYMENT_PAYZEN_CAPTURE_DELAY';
        $keys[] = 'MODULE_PAYMENT_PAYZEN_VALIDATION_MODE';
        $keys[] = 'MODULE_PAYMENT_PAYZEN_PAYMENT_CARDS';
        $keys[] = 'MODULE_PAYMENT_PAYZEN_3DS_MIN_AMOUNT';

        $keys[] = 'MODULE_PAYMENT_PAYZEN_AMOUNT_MIN';
        $keys[] = 'MODULE_PAYMENT_PAYZEN_AMOUNT_MAX';

        $keys[] = 'MODULE_PAYMENT_PAYZEN_REDIRECT_ENABLED';
        $keys[] = 'MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_TIMEOUT';
        $keys[] = 'MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_MESSAGE';
        $keys[] = 'MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_TIMEOUT';
        $keys[] = 'MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_MESSAGE';
        $keys[] = 'MODULE_PAYMENT_PAYZEN_RETURN_MODE';
        $keys[] = 'MODULE_PAYMENT_PAYZEN_ORDER_STATUS';

        return $keys;
    }

    function guess_order_id()
    {
        $query = xtc_db_query("SELECT MAX(orders_id) AS orders_id FROM " . TABLE_ORDERS);

        if (! xtc_db_num_rows($query)) {
            return 1;
        } else {
            $result = xtc_db_fetch_array($query);
            return $result['orders_id'] + 1;
        }
    }

    function admin_order($oID, $lang)
    {
        $oID = (int) $oID;
        if (! is_int($oID)) {
            return false;
        }

        $query = xtc_db_query("SELECT * FROM " . TABLE_PAYZEN_ORDERS_PAYMENT . " WHERE orders_id = '" . $oID . "'");
        $data = xtc_db_fetch_array($query);

        // Result description is stored as serialized array.
        $allResults = unserialize($data['result']);
        $keys = array('result', 'auth_result', 'warranty_result');

        $texts = array();
        foreach ($keys as $key) {
            $text = PayzenResponse::translate($allResults[$key], $key, $lang);
            if (! $text) {
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

        $card_brand_choice = $data['card_brand_choice']? '<b> (' . constant($data['card_brand_choice']) . ')<b>' : '';
        $html = '
                <tr>
                    <td class="main" colspan="2">' . implode('<br />', $texts) . '</td>
                </tr>
                <tr>
                    <td class="main"><span style="font-weight: bold">' . MODULE_PAYMENT_PAYZEN_PAYMENT_MEAN . ':</span></td>
                    <td class="main">' . $data['card_brand']  . $card_brand_choice . '</td>
                </tr>
                <tr>
                    <td class="main"><span style="font-weight: bold">' . MODULE_PAYMENT_PAYZEN_TRANSACTION_ID . ':</span></td>
                    <td class="main">' . $data['trans_id'] . '</td>
                </tr>
                <tr>
                    <td class="main"><span style="font-weight: bold">' . MODULE_PAYMENT_PAYZEN_CARD_NUMBER . ':</span></td>
                    <td class="main">' . $data['card_number'] . '</td>
                </tr>
                <tr>
                    <td class="main"><span style="font-weight: bold">' . MODULE_PAYMENT_PAYZEN_EXPIRATION_DATE .':</span></td>
                    <td class="main">' . $data['card_expiration'] . '</td>
                </tr>';

        echo $html;
    }

    function is_processed_payment ($trans_uuid)
    {
        $query = xtc_db_query("SELECT orders_id FROM " . TABLE_PAYZEN_ORDERS_PAYMENT . " WHERE trans_uuid = '" . $trans_uuid . "'");
        $result = xtc_db_fetch_array($query);

        return (is_array($result) && $result['orders_id'] > 0);
    }

    public function log($message)
    {
        $this->logger->log($message);
    }
}
