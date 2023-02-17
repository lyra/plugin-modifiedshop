<?php
/**
 * Copyright © Lyra Network.
 * This file is part of PayZen plugin for modified eCommerce Shopsoftware. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL v2)
 */

require_once DIR_FS_CATALOG . 'includes/modules/payment/payzen.php';
global $payzen_plugin_features;

## CATALOG MESSAGES ##
define('MODULE_PAYMENT_PAYZEN_TECHNICAL_ERROR', 'An error has occurred during the payment process.');
define('MODULE_PAYMENT_PAYZEN_PAYMENT_ERROR', 'Your payment was not accepted. Please, try to re-order.');
define('MODULE_PAYMENT_PAYZEN_CHECK_URL_WARN', 'The automatic validation has not worked. Have you correctly set up the notification URL in your PayZen Back Office?');
define('MODULE_PAYMENT_PAYZEN_CHECK_URL_WARN_DETAIL', 'For understanding the problem, please read the documentation of the module:<br />&nbsp;&nbsp;&nbsp;- Chapter &laquo; To read carefully before going further &raquo;<br />&nbsp;&nbsp;&nbsp;- Chapter &laquo; Notification URL settings &raquo;');
define('MODULE_PAYMENT_PAYZEN_GOING_INTO_PROD_INFO', '<b>GOING INTO PRODUCTION:</b> You want to know how to put your shop into production mode, please read chapters « Proceeding to test phase » and « Shifting the shop to production mode » in the documentation of the module.');
define('MODULE_PAYMENT_PAYZEN_MAINTENANCE_MODE_WARN','The shop is in maintenance mode.The automatic notification cannot work.');
define('MODULE_PAYMENT_PAYZEN_TEXT_TITLE', 'PayZen');
define('MODULE_PAYMENT_PAYZEN_TEXT_DESCRIPTION', 'Payment by credit card');
define('MODULE_PAYMENT_PAYZEN_INFORMATION_TITLE', 'Information');
define('MODULE_PAYMENT_PAYZEN_WARNING_TITLE', 'Warning');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_MESSAGE', 'Redirection to shop in a few seconds...');

## ADMINISTRATION INTERFACE - INFORMATIONS ##
define('MODULE_PAYMENT_PAYZEN_MODULE_INFORMATION', 'MODULE INFORMATION');
define('MODULE_PAYMENT_PAYZEN_DEVELOPED_BY', 'Developed by: ');
define('MODULE_PAYMENT_PAYZEN_CONTACT_EMAIL', 'Contact us: ');
define('MODULE_PAYMENT_PAYZEN_CONTRIB_VERSION', 'Module version: ');
define('MODULE_PAYMENT_PAYZEN_GATEWAY_VERSION', 'Gateway version: ');
define('MODULE_PAYMENT_PAYZEN_CMS_VERSION', 'Tested with: ');
define('MODULE_PAYMENT_PAYZEN_DOC', 'Click to view the module configuration documentation: ');
define('MODULE_PAYMENT_PAYZEN_IPN_URL', 'IPN URL to copy into your PayZen Back Office > Settings > Notification rules:<br />');

## ADMINISTRATION INTERFACE - MODULE SETTINGS ##
define('MODULE_PAYMENT_PAYZEN_STATUS_TITLE', 'Activation');
define('MODULE_PAYMENT_PAYZEN_STATUS_DESC', 'Enables / disables this payment method.');
define('MODULE_PAYMENT_PAYZEN_SORT_ORDER_TITLE', 'Sort order');
define('MODULE_PAYMENT_PAYZEN_SORT_ORDER_DESC', 'In the payment methods list.');
define('MODULE_PAYMENT_PAYZEN_ZONE_TITLE', 'Payment area');
define('MODULE_PAYMENT_PAYZEN_ZONE_DESC', 'If an area is selected, this payment mode will only be available for it.');

## ADMINISTRATION INTERFACE - PLATFORM SETTINGS ##
define('MODULE_PAYMENT_PAYZEN_SITE_ID_TITLE', 'Shop ID');
define('MODULE_PAYMENT_PAYZEN_SITE_ID_DESC', 'The identifier provided by PayZen.');
define('MODULE_PAYMENT_PAYZEN_KEY_TEST_TITLE', 'Key in test mode');
define('MODULE_PAYMENT_PAYZEN_KEY_TEST_DESC', 'Key provided by PayZen for test mode (available in PayZen Back Office).');
define('MODULE_PAYMENT_PAYZEN_KEY_PROD_TITLE', 'Key in production mode');
define('MODULE_PAYMENT_PAYZEN_KEY_PROD_DESC', 'Key provided by PayZen (available in PayZen Back Office after enabling production mode).');
define('MODULE_PAYMENT_PAYZEN_CTX_MODE_TITLE', 'Mode');
define('MODULE_PAYMENT_PAYZEN_CTX_MODE_DESC', 'The context mode of this module.');
define('MODULE_PAYMENT_PAYZEN_SIGN_ALGO_TITLE', 'Signature algorithm');
define('MODULE_PAYMENT_PAYZEN_SIGN_ALGO_DESC', 'Algorithm used to compute the payment form signature. Selected algorithm must be the same as one configured in the PayZen Back Office.' . (! $payzen_plugin_features['shatwo'] ? '<br /><b>The HMAC-SHA-256 algorithm should not be activated if it is not yet available in the PayZen Back Office, the feature will be available soon.</b>' : ''));
define('MODULE_PAYMENT_PAYZEN_PLATFORM_URL_TITLE', 'Payment page URL');
define('MODULE_PAYMENT_PAYZEN_PLATFORM_URL_DESC', 'Link to the payment page.');

## ADMINISTRATION INTERFACE - PAYMENT SETTINGS ##
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_TITLE', 'Default language');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_DESC', 'Default language on the payment page.');
define('MODULE_PAYMENT_PAYZEN_AVAILABLE_LANGUAGES_TITLE', 'Available languages');
define('MODULE_PAYMENT_PAYZEN_AVAILABLE_LANGUAGES_DESC', 'Languages available on the payment page. If you do not select any, all the supported languages will be available.');
define('MODULE_PAYMENT_PAYZEN_CAPTURE_DELAY_TITLE', 'Capture delay');
define('MODULE_PAYMENT_PAYZEN_CAPTURE_DELAY_DESC', 'The number of days before the bank capture (adjustable in your PayZen Back Office).');
define('MODULE_PAYMENT_PAYZEN_VALIDATION_MODE_TITLE', 'Validation mode');
define('MODULE_PAYMENT_PAYZEN_VALIDATION_MODE_DESC', 'If manual is selected, you will have to confirm payments manually in your PayZen Back Office.');
define('MODULE_PAYMENT_PAYZEN_PAYMENT_CARDS_TITLE', 'Card Types');
define('MODULE_PAYMENT_PAYZEN_PAYMENT_CARDS_DESC', 'The card type(s) that can be used for the payment. Select none to use gateway configuration.');
define('MODULE_PAYMENT_PAYZEN_3DS_MIN_AMOUNT_TITLE', 'Manage 3DS');
define('MODULE_PAYMENT_PAYZEN_3DS_MIN_AMOUNT_DESC', 'Amount below which customer could be exempt from strong authentication. Needs subscription to «Selective 3DS1» or «Frictionless 3DS2» options. For more information, refer to the module documentation.');

## ADMINISTRATION INTERFACE - AMOUNT RESTRICTIONS SETTINGS ##
define('MODULE_PAYMENT_PAYZEN_AMOUNT_MIN_TITLE', 'Minimum amount');
define('MODULE_PAYMENT_PAYZEN_AMOUNT_MIN_DESC', 'Minimum amount to activate this payment method.');
define('MODULE_PAYMENT_PAYZEN_AMOUNT_MAX_TITLE', 'Maximum amount');
define('MODULE_PAYMENT_PAYZEN_AMOUNT_MAX_DESC', 'Maximum amount to activate this payment method.');

## ADMINISTRATION INTERFACE - BACK TO STORE SETTINGS ##
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ENABLED_TITLE', 'Automatic redirection');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ENABLED_DESC', 'If enabled, the buyer is automatically redirected to your site at the end of the payment.');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_TIMEOUT_TITLE', 'Redirection timeout on success');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_TIMEOUT_DESC', 'Time in seconds (0-300) before the buyer is automatically redirected to your website after a successful payment.');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_MESSAGE_TITLE', 'Redirection message on success');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_MESSAGE_DESC', 'Message displayed on the payment page prior to redirection after a successful payment.');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_TIMEOUT_TITLE', 'Redirection timeout on failure');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_TIMEOUT_DESC', 'Time in seconds (0-300) before the buyer is automatically redirected to your website after a declined payment.');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_MESSAGE_TITLE', 'Redirection message on failure');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_MESSAGE_DESC', 'Message displayed on the payment page prior to redirection after a declined payment.');
define('MODULE_PAYMENT_PAYZEN_RETURN_MODE_TITLE', 'Return mode');
define('MODULE_PAYMENT_PAYZEN_RETURN_MODE_DESC', 'Method that will be used for transmitting the payment result from the payment page to your shop.');
define('MODULE_PAYMENT_PAYZEN_ORDER_STATUS_TITLE', 'Order Status');
define('MODULE_PAYMENT_PAYZEN_ORDER_STATUS_DESC', 'Status of orders when payment is successfull.');

## ADMINISTRATION INTERFACE - MISC CONSTANTS ##
define('MODULE_PAYMENT_PAYZEN_VALUE_FALSE', 'No');
define('MODULE_PAYMENT_PAYZEN_VALUE_TRUE', 'Yes');

define('MODULE_PAYMENT_PAYZEN_VALIDATION_', 'PayZen Back Office configuration');
define('MODULE_PAYMENT_PAYZEN_VALIDATION_0', 'Automatic');
define('MODULE_PAYMENT_PAYZEN_VALIDATION_1', 'Manual');

define('MODULE_PAYMENT_PAYZEN_LANGUAGE_FRENCH', 'French');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_GERMAN', 'German');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_ENGLISH', 'English');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_SPANISH', 'Spanish');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_CHINESE', 'Chinese');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_ITALIAN', 'Italian');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_JAPANESE', 'Japanese');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_PORTUGUESE', 'Portuguese');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_DUTCH', 'Dutch');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_SWEDISH', 'Swedish');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_RUSSIAN', 'Russian');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_TURKISH', 'Turkish');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_POLISH', 'Polish');

#ADMINISTRATION INTERFACE EXTRA ORDER INFORMATIONS
define('MODULE_PAYMENT_PAYZEN_PAYMENT_MEAN', 'Means of payment');
define('MODULE_PAYMENT_PAYZEN_PAYMENT_CARD_BRAND_BUYER_CHOICE', 'Card brand chosen by buyer');
define('MODULE_PAYMENT_PAYZEN_PAYMENT_CARD_BRAND_DEFAULT_CHOICE','Default card brand used');
define('MODULE_PAYMENT_PAYZEN_TRANSACTION_ID', 'Transaction ID');
define('MODULE_PAYMENT_PAYZEN_CARD_NUMBER', 'Card number');
define('MODULE_PAYMENT_PAYZEN_EXPIRATION_DATE', 'Expiration date');
