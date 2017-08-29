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

## DIVERS ##
define('MODULE_PAYMENT_VADS_TEXT_TITLE','PayZen - Secured bank card payment');
define('MODULE_PAYMENT_VADS_TEXT_DESCRIPTION', "PAYMENT BY CB VIA PayZen");
define('MODULE_PAYMENT_VADS_TEXT_ERROR_MESSAGE', "Your order has not been confirmed. An error has occured in the payment process.");
define('MODULE_PAYMENT_VADS_CHECK_URL_NOT_CALLED_ERROR_MESSAGE', "Warning in TEST mode : this order has been saved, but the automatic validation has not worked. Please check that you correctly set the server URL in your back office PayZen.");

## ADMINISTRATION INTERFACE - INFORMATIONS ##
define('MODULE_PAYMENT_VADS_DEVELOPED_BY', "Developped by : ");
define('MODULE_PAYMENT_VADS_CONTACT_EMAIL', "Contact us : ");
define('MODULE_PAYMENT_VADS_CONTRIB_VERSION', "Module version : ");
define('MODULE_PAYMENT_VADS_GATEWAY_VERSION', "Platform version : ");
define('MODULE_PAYMENT_VADS_CMS_VERSION', "Tested with : ");
define('MODULE_PAYMENT_VADS_SILENT_URL', "Server URL to copy in your store back office : ");

## ADMINISTRATION PARAMETERS ##
define('MODULE_PAYMENT_VADS_GATEWAY_TITLE', "Payment platform");
define('MODULE_PAYMENT_VADS_GATEWAY_DESC', "Name of the payment platform on which you have subscribed");

define('MODULE_PAYMENT_VADS_URL_GATEWAY_TITLE', "Platform URL");
define('MODULE_PAYMENT_VADS_URL_GATEWAY_DESC', "Link to the payment platform.");

define('MODULE_PAYMENT_VADS_COMPANY_TITLE', "Company name");
define('MODULE_PAYMENT_VADS_COMPANY_DEFAULT', "Company");
define('MODULE_PAYMENT_VADS_COMPANY_DESC', "Entrer the name of your company");

define('MODULE_PAYMENT_VADS_STATUS_TITLE', "Enable the PayZen module");
define('MODULE_PAYMENT_VADS_STATUS_DESC', "Would you like to accept the PayZen payment mode ?");

define('MODULE_PAYMENT_VADS_SITE_ID_TITLE', "Site ID");
define('MODULE_PAYMENT_VADS_SITE_ID_DESC', "The identifier provided by your bank.");

define('MODULE_PAYMENT_VADS_MODE_TITLE', "Mode");
define('MODULE_PAYMENT_VADS_MODE_DESC', "The context mode of this module.");

define('MODULE_PAYMENT_VADS_DELAY_TITLE', "Capture delay");
define('MODULE_PAYMENT_VADS_DELAY_DESC', "The number of days before the restoration bank (adjustable in your back office PayZen).");

define('MODULE_PAYMENT_VADS_LANGAGE_TITLE', "Default language");
define('MODULE_PAYMENT_VADS_LANGAGE_DESC', "Available Languages: DE (German), ZH (Chinese), EN (English), ES (Spanish), FR (French), IT (Italian), JA (Japanese).");

define('MODULE_PAYMENT_VADS_CARTE_TITLE', "Card Types");
define('MODULE_PAYMENT_VADS_CARTE_DESC', "The card type(s) that can be used for the payment separated by semicolons.");

define('MODULE_PAYMENT_VADS_TYPE_PAIEMENT_TITLE', "Payment type");
define('MODULE_PAYMENT_VADS_TYPE_PAIEMENT_DESC', "This module manages the payment on single mode");

define('MODULE_PAYMENT_VADS_MODE_VALIDATION_TITLE', "Validation mode");
define('MODULE_PAYMENT_VADS_MODE_VALIDATION_DESC', "2 types are available: Auto (0) or manual (1) (it can be set in the back office PayZen).");

define('MODULE_PAYMENT_VADS_URL_UNAUTHORIZED_TITLE', "URL for refusing permission");
define('MODULE_PAYMENT_VADS_URL_UNAUTHORIZED_DESC', "URL which the client is forwaded for refusing permission");

define('MODULE_PAYMENT_VADS_REDIRECT_ENABLED_TITLE', "Automatic forward");
define('MODULE_PAYMENT_VADS_REDIRECT_ENABLED_DESC', "If enabled, the client is automaticly forwarded to your site at the end of the payment process.");

define('MODULE_PAYMENT_VADS_REDIRECT_SUCCESS_TIMEOUT_TITLE', "Success forward timeout");
define('MODULE_PAYMENT_VADS_REDIRECT_SUCCESS_TIMEOUT_DESC', "Time in seconds (0-300) before the client is automatically forwarded to your site when the payment was successful.");
define('MODULE_PAYMENT_VADS_REDIRECT_SUCCESS_MESSAGE_TITLE', "Success forward message");
define('MODULE_PAYMENT_VADS_REDIRECT_SUCCESS_MESSAGE_DESC', "Message posted on the payment platform before forwarding when the payment was successful.");
define('MODULE_PAYMENT_VADS_REDIRECTION_SUCCESS_MESSAGE_DEFAULT', "Your payment has been correctly done, you will be forwarded shortly.");

define('MODULE_PAYMENT_VADS_REDIRECT_ERROR_TIMEOUT_TITLE', "Failure forward timeout");
define('MODULE_PAYMENT_VADS_REDIRECT_ERROR_TIMEOUT_DESC', "Time in seconds (0-300) before the client is automatically forwarded to your site when the payment failed.");
define('MODULE_PAYMENT_VADS_REDIRECT_ERROR_MESSAGE_TITLE', "Failure forward message");
define('MODULE_PAYMENT_VADS_REDIRECT_ERROR_MESSAGE_DESC', "Message posted on the payment platform before forwarding when the payment failed.");
define('MODULE_PAYMENT_VADS_REDIRECTION_ERROR_MESSAGE_DEFAULT', "An error has occured, you will be forwarded shortly.");
/*
define('MODULE_PAYMENT_VADS_URL_REFUSED_TITLE', "URL in case of another refusal");
define('MODULE_PAYMENT_VADS_URL_REFUSED_DESC', "URL which the client is redirected if another refusal");

define('MODULE_PAYMENT_VADS_URL_CANCEL_TITLE', "URL for cancel");
define('MODULE_PAYMENT_VADS_URL_CANCEL_DESC', "URL which the client is redirected in case of cancellation");

define('MODULE_PAYMENT_VADS_URL_ERROR_TITLE', "URL for errors");
define('MODULE_PAYMENT_VADS_URL_ERROR_DESC', "URL which the client is redirected on failure");
*/
define('MODULE_PAYMENT_VADS_REDIRECTION_OSC_ERROR_MESSAGE',"The payment process has failed, your order has not been registered");

define('MODULE_PAYMENT_VADS_RETURN_MODE_TITLE', 'Return mode');
define('MODULE_PAYMENT_VADS_RETURN_MODE_DESC', 'Method that will be used for transmitting the payment result from the payment gateway to your store.');

define('MODULE_PAYMENT_VADS_URL_DEFAUT_TITLE', "Default URL");
define('MODULE_PAYMENT_VADS_URL_DEFAUT_DESC', "URL on which the client is redirected by default.");

define('MODULE_PAYMENT_VADS_URL_SUCCES_TITLE', "Success URL");
define('MODULE_PAYMENT_VADS_URL_SUCCES_DESC', "URL on which the client is redirected on payment success.");

define('MODULE_PAYMENT_VADS_KEY_TEST_TITLE', "Certificate in test mode");
define('MODULE_PAYMENT_VADS_KEY_TEST_DESC', "Certificate provided by your bank for test (Available on the back office PayZen).");
define('MODULE_PAYMENT_VADS_KEY_PROD_TITLE', "Certificate in production mode");
define('MODULE_PAYMENT_VADS_KEY_PROD_DESC', "Certificate provided by your bank (Available on the back office PayZen).");

define('MODULE_PAYMENT_VADS_SORT_ORDER_TITLE', "Display order");
define('MODULE_PAYMENT_VADS_SORT_ORDER_DESC', "Display order. The smaller appears first.");

define('MODULE_PAYMENT_VADS_ZONE_TITLE', "Payment area");
define('MODULE_PAYMENT_VADS_ZONE_DESC', "If an area is selected, this mode of payment will only be available for it.");

define('MODULE_PAYMENT_VADS_ORDER_STATUS_ID_TITLE', "Order Status");
define('MODULE_PAYMENT_VADS_ORDER_STATUS_ID_DESC', "Defining the status of orders paid by the PayZen payment method.");

?>