<?php
#####################################################################################################
#
#					Module pour la plateforme de paiement PayZen
#						Version : 1.0 (révision 29030)
#									########################
#					Développé pour xtc_modified
#						Version : 1.05
#						Compatibilité plateforme : V1
#									########################
#					Développé par Lyra Network
#						http://www.lyra-network.com/
#						14/09/2011
#						Contact : support@payzen.eu
#
#####################################################################################################

/*
 * This file is an access point for the payment gateway to validate an order.
 */
 
$certificat_test = '';
$certificat_prod = '';
$mode = '';

// Verify the payment gateway identity
$valid_signature = false;
$signature = $_POST['version']."+".$_POST['site_id']."+".$_POST['ctx_mode']."+".$_POST['trans_id']."+".$_POST['trans_date']."+"
.$_POST['validation_mode']."+".$_POST['capture_delay']."+".$_POST['payment_config']."+".$_POST['card_brand'] ."+".$_POST['card_number']."+"
.$_POST['amount']."+".$_POST['currency'] ."+".$_POST['auth_mode'] ."+".$_POST['auth_result'] ."+".$_POST['auth_number'] ."+"
.$_POST['warranty_result'] ."+".$_POST['payment_certificate'] ."+".$_POST['result'] ."+".$_POST['hash']."+";

if( ($mode == 'TEST' && $certificat_test != '')) {
	$signature .= $certificat_test;
}

if($mode == 'PRODUCTION' && $certificat_prod != '') {
	$signature .= $certificat_prod;
}

$signature = sha1($signature);
$valid_signature = ($signature == $_POST['signature']);

// If payment gateway has been authentified, let it borrow the customer's session to confirm the order
if($mode=='' || $valid_signature){	//TODO : ? terme, garder le test sur $mode ??
	session_id($_POST['cust_id']);
}

// Then we launch the standard checkout_process
include 'checkout_process.php';
?>