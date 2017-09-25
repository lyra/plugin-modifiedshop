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

/**
 * This file is an access point to standard checkout_success.php or checkout_process.php.
 */

require_once 'includes/application_top.php';

require_once 'includes/external/payzen/response.php';
require_once  'includes/modules/payment/payzen.php';
$payment = new payzen();
$response = new PayzenResponse(
		$_REQUEST,
		MODULE_PAYMENT_PAYZEN_CTX_MODE,
		MODULE_PAYMENT_PAYZEN_KEY_TEST,
		MODULE_PAYMENT_PAYZEN_KEY_PROD
);

// check authenticity
if(!$response->isAuthentified()) {
	$_SESSION['payzen_error'] = MODULE_PAYMENT_PAYZEN_TECHNICAL_ERROR;
	xtc_redirect(xtc_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_error='.$this->code, 'SSL', true));
}

if (MODULE_PAYMENT_PAYZEN_CTX_MODE == 'TEST') {
	// going into production information
	$_SESSION['payzen_info'] = true;
}

if ($payment->is_processed_payment($response->get('trans_uuid'))) {
	xtc_redirect(xtc_href_link(FILENAME_CHECKOUT_SUCCESS, '', 'SSL', true));
} else {
	$return_mode = '_' . strtoupper(MODULE_PAYMENT_PAYZEN_RETURN_MODE);
	if ($return_mode == '_POST') {
		$action = xtc_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL', true);
		$fields = '';

		foreach ($$return_mode as $key => $value) {
			$fields .= '<input type="hidden" name="' . $key . '" value="' . htmlentities($value, ENT_QUOTES, 'UTF-8') . '" />' . "\n";
		}

		echo <<<EOT
			<html>
				<body>
					<form action="$action" method="POST" name="checkout_process_payzen_form">
						$fields
					</form>

					<script type="text/javascript">
						window.onload = function() {
							document.checkout_process_payzen_form.submit();
						};
					</script>
				</body>
			</html>
EOT;
	} else {
		xtc_redirect(xtc_href_link(FILENAME_CHECKOUT_PROCESS, http_build_query($$return_mode), 'SSL', true));
	}
}