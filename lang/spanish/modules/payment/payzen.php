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
define('MODULE_PAYMENT_PAYZEN_TECHNICAL_ERROR', 'Ocurri&oacute; un error durante el proceso de pago.');
define('MODULE_PAYMENT_PAYZEN_PAYMENT_ERROR', 'Su pago no fue aceptado. Intente realizar de nuevo el pedido.');
define('MODULE_PAYMENT_PAYZEN_CHECK_URL_WARN', 'La validación automática no ha funcionado. ¿Configuró correctamente la URL de notificación en su Back Office PayZen?');
define('MODULE_PAYMENT_PAYZEN_CHECK_URL_WARN_DETAIL', 'Para entender el problema, lea la documentación del módulo:<br />&nbsp;&nbsp;&nbsp;- Capítulo &laquo; Leer detenidamente antes de continuar &raquo;<br />&nbsp;&nbsp;&nbsp;- Capítulo &laquo; Configuración de la URL de notificación &raquo;');
define('MODULE_PAYMENT_PAYZEN_GOING_INTO_PROD_INFO', '<b>IR A PRODUCTION:</b> Si desea saber c&oacute;mo poner su tienda en modo production, lea los cap&iacute;tulos « Proceder a la fase de prueba » y « Paso de una tienda al modo producci&oacute;n » en la documentaci&oacute;n del m&oacute;dulo.');
define('MODULE_PAYMENT_PAYZEN_MAINTENANCE_MODE_WARN','La tienda est&aacute; en modo de mantenimiento. La notificaci&oacute;n autom&aacute;tica no puede funcionar.');
define('MODULE_PAYMENT_PAYZEN_TEXT_TITLE', 'PayZen');
define('MODULE_PAYMENT_PAYZEN_TEXT_DESCRIPTION', 'Pago con tarjeta de cr&eacute;dito');
define('MODULE_PAYMENT_PAYZEN_INFORMATION_TITLE', 'Informaci&oacute;n');
define('MODULE_PAYMENT_PAYZEN_WARNING_TITLE', 'Advertencia');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_MESSAGE', 'Redirecci&oacute;n a la tienda en unos momentos...');

## ADMINISTRATION INTERFACE - INFORMATIONS ##
define('MODULE_PAYMENT_PAYZEN_MODULE_INFORMATION', 'INFORMACI&Oacute;N DEL M&Oacute;DULO');
define('MODULE_PAYMENT_PAYZEN_DEVELOPED_BY', 'Desarrollado por: ');
define('MODULE_PAYMENT_PAYZEN_CONTACT_EMAIL', 'Cont&aacute;ctenos: ');
define('MODULE_PAYMENT_PAYZEN_CONTRIB_VERSION', 'Versi&oacute;n del m&oacute;dulo: ');
define('MODULE_PAYMENT_PAYZEN_GATEWAY_VERSION', 'Versi&oacute;n del portal: ');
define('MODULE_PAYMENT_PAYZEN_CMS_VERSION', 'Probado con: ');
define('MODULE_PAYMENT_PAYZEN_IPN_URL', 'URL de notificaci&oacute;n a copiar en el Back Office PayZen > Configuraci&oacute;n > Reglas de notificaci&oacute;n: <br />');

## ADMINISTRATION INTERFACE - MODULE SETTINGS ##
define('MODULE_PAYMENT_PAYZEN_STATUS_TITLE', 'Activación');
define('MODULE_PAYMENT_PAYZEN_STATUS_DESC', 'Habilita / deshabilita este m&eacute;todo de pago.');
define('MODULE_PAYMENT_PAYZEN_SORT_ORDER_TITLE', 'Orden de clasificación');
define('MODULE_PAYMENT_PAYZEN_SORT_ORDER_DESC', 'En la lista de métodos de pago.');
define('MODULE_PAYMENT_PAYZEN_ZONE_TITLE', 'Payment area');
define('MODULE_PAYMENT_PAYZEN_ZONE_DESC', 'If an area is selected, this payment mode will only be available for it.');

## ADMINISTRATION INTERFACE - PLATFORM SETTINGS ##
define('MODULE_PAYMENT_PAYZEN_SITE_ID_TITLE', 'ID de tienda');
define('MODULE_PAYMENT_PAYZEN_SITE_ID_DESC', 'El identificador proporcionado por PayZen.');
define('MODULE_PAYMENT_PAYZEN_KEY_TEST_TITLE', 'Clave en modo test');
define('MODULE_PAYMENT_PAYZEN_KEY_TEST_DESC', 'Clave proporcionada por PayZen para modo test (disponible en el Back Office PayZen).');
define('MODULE_PAYMENT_PAYZEN_KEY_PROD_TITLE', 'Clave en modo production');
define('MODULE_PAYMENT_PAYZEN_KEY_PROD_DESC', 'Clave proporcionada por PayZen (disponible en el Back Office PayZen despu&eacute;s de habilitar el modo production).');
define('MODULE_PAYMENT_PAYZEN_CTX_MODE_TITLE', 'Modo');
define('MODULE_PAYMENT_PAYZEN_CTX_MODE_DESC', 'El modo de contexto de este m&oacute;dulo.');
define('MODULE_PAYMENT_PAYZEN_SIGN_ALGO_TITLE', 'Algoritmo de firma');
define('MODULE_PAYMENT_PAYZEN_SIGN_ALGO_DESC', 'Algoritmo usado para calcular la firma del formulario de pago. El algoritmo seleccionado debe ser el mismo que el configurado en el Back Office PayZen.' . (! $payzen_plugin_features['shatwo'] ? '<br /><b>El algoritmo HMAC-SHA-256 no se debe activar si a&uacute;n no est&aacute; disponible el Back Office PayZen, la funci&oacute;n estar&aacute; disponible pronto.</b>' : ''));
define('MODULE_PAYMENT_PAYZEN_PLATFORM_URL_TITLE', 'URL de p&aacute;gina de pago');
define('MODULE_PAYMENT_PAYZEN_PLATFORM_URL_DESC', 'Enlace a la p&aacute;gina de pago.');

## ADMINISTRATION INTERFACE - PAYMENT SETTINGS ##
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_TITLE', 'Idioma predeterminado');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_DESC', 'Idioma predeterminado en la p&aacute;gina de pago.');
define('MODULE_PAYMENT_PAYZEN_AVAILABLE_LANGUAGES_TITLE', 'Idiomas disponibles');
define('MODULE_PAYMENT_PAYZEN_AVAILABLE_LANGUAGES_DESC', 'Idiomas disponibles en la p&aacute;gina de pago. Si no selecciona ninguno, todos los idiomas compatibles estar&aacute;n disponibles.');
define('MODULE_PAYMENT_PAYZEN_CAPTURE_DELAY_TITLE', 'Plazo de captura');
define('MODULE_PAYMENT_PAYZEN_CAPTURE_DELAY_DESC', 'El n&uacute;mero de d&iacute;as antes de la captura del pago (ajustable en su Back Office PayZen).');
define('MODULE_PAYMENT_PAYZEN_VALIDATION_MODE_TITLE', 'Modo de validaci&oacute;n');
define('MODULE_PAYMENT_PAYZEN_VALIDATION_MODE_DESC', 'Si se selecciona manual, deberá confirmar los pagos manualmente en su Back Office PayZen.');
define('MODULE_PAYMENT_PAYZEN_PAYMENT_CARDS_TITLE', 'Tipos de tarjeta');
define('MODULE_PAYMENT_PAYZEN_PAYMENT_CARDS_DESC', 'El tipo(s) de tarjeta que se puede usar para el pago. No haga ninguna selección para usar la configuración del portal.');
define('MODULE_PAYMENT_PAYZEN_3DS_MIN_AMOUNT_TITLE', 'Gestionar el 3DS');
define('MODULE_PAYMENT_PAYZEN_3DS_MIN_AMOUNT_DESC', 'Monto por debajo del cual el comprador podr&iacute;a estar exento de de la autenticaci&oacute;n fuerte. Requiere suscripci&oacute;n a la opci&oacute;n «Selective 3DS1» o a la opci&oacute;n «Frictionless 3DS2». Para m&aacute;s informaci&oacute;n, consulte la documentaci&oacute;n del m&oacute;dulo.');
## ADMINISTRATION INTERFACE - AMOUNT RESTRICTIONS SETTINGS ##
define('MODULE_PAYMENT_PAYZEN_AMOUNT_MIN_TITLE', 'Monto m&iacute;nimo');
define('MODULE_PAYMENT_PAYZEN_AMOUNT_MIN_DESC', 'Monto m&iacute;nimo para activar este m&eacute;todo de pago.');
define('MODULE_PAYMENT_PAYZEN_AMOUNT_MAX_TITLE', 'Monto m&aacute;ximo');
define('MODULE_PAYMENT_PAYZEN_AMOUNT_MAX_DESC', 'Monto m&aacute;ximo para activar este m&eacute;todo de pago.');

## ADMINISTRATION INTERFACE - BACK TO STORE SETTINGS ##
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ENABLED_TITLE', 'Redirecci&oacute;n autom&aacute;tica');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ENABLED_DESC', 'Si est&aacute; habilitada, el comprador es redirigido autom&aacute;ticamente a su sitio al final del pago.');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_TIMEOUT_TITLE', 'Tiempo de espera de la redirecci&oacute;n en pago exitoso');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_TIMEOUT_DESC', 'Tiempo en segundos (0-300) antes de que el comprador sea redirigido autom&aacute;ticamente a su sitio web despu&eacute;s de un pago exitoso.');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_MESSAGE_TITLE', 'Mensaje de redirecci&oacute;n en pago exitoso');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_MESSAGE_DESC', 'Mensaje mostrado en la p&aacute;gina de pago antes de la redirecci&oacute;n despu&eacute;s de un pago exitoso.');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_TIMEOUT_TITLE', 'Tiempo de espera de la redirecci&oacute;n en pago rechazado');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_TIMEOUT_DESC', 'Tiempo en segundos (0-300) antes de que el comprador sea redirigido autom&aacute;ticamente a su sitio web despu&eacute;s de un pago rechazado.');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_MESSAGE_TITLE', 'Mensaje de redirecci&oacute;n en pago rechazado');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_MESSAGE_DESC', 'Mensaje mostrado en la p&aacute;gina de pago antes de la redirecci&oacute;n despu&eacute;s de un pago rechazado.');
define('MODULE_PAYMENT_PAYZEN_RETURN_MODE_TITLE', 'Modo de retorno');
define('MODULE_PAYMENT_PAYZEN_RETURN_MODE_DESC', 'M&eacute;todo que se usar&aacute; para transmitir el resultado del pago de la p&aacute;gina de pago a su tienda.');
define('MODULE_PAYMENT_PAYZEN_ORDER_STATUS_TITLE', 'Estado de pedidos');
define('MODULE_PAYMENT_PAYZEN_ORDER_STATUS_DESC', 'Estado de los pedidos cuando el pago es exitoso.');

## ADMINISTRATION INTERFACE - MISC CONSTANTS ##
define('MODULE_PAYMENT_PAYZEN_VALUE_FALSE', 'No');
define('MODULE_PAYMENT_PAYZEN_VALUE_TRUE', 'S&iacute;');

define('MODULE_PAYMENT_PAYZEN_VALIDATION_', 'Configuraci&oacute;n de Back Office PayZen');
define('MODULE_PAYMENT_PAYZEN_VALIDATION_0', 'Autom&aacute;tico');
define('MODULE_PAYMENT_PAYZEN_VALIDATION_1', 'Manual');

define('MODULE_PAYMENT_PAYZEN_LANGUAGE_FRENCH', 'Franc&eacute;s');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_GERMAN', 'Alem&aacute;n');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_ENGLISH', 'Ingl&eacute;s');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_SPANISH', 'Espa&ntilde;ol');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_CHINESE', 'Chino');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_ITALIAN', 'Italiano');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_JAPANESE', 'Japon&eacute;s');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_PORTUGUESE', 'Portugu&eacute;s');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_DUTCH', 'Holand&eacute;s');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_SWEDISH', 'Sueco');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_RUSSIAN', 'Ruso');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_TURKISH', 'Turco');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_POLISH', 'Polaco');

#ADMINISTRATION INTERFACE EXTRA ORDER INFORMATIONS
define('MODULE_PAYMENT_PAYZEN_PAYMENT_MEAN', 'Medio de pago');
define('MODULE_PAYMENT_PAYZEN_PAYMENT_CARD_BRAND_BUYER_CHOICE', 'Marca de tarjeta elegida por el comprador.');
define('MODULE_PAYMENT_PAYZEN_PAYMENT_CARD_BRAND_DEFAULT_CHOICE','Marca de tarjeta por defecto en uso.');
define('MODULE_PAYMENT_PAYZEN_TRANSACTION_ID', 'ID de transacci&oacute;n');
define('MODULE_PAYMENT_PAYZEN_CARD_NUMBER', 'N&uacute;mero de la tarjeta');
define('MODULE_PAYMENT_PAYZEN_EXPIRATION_DATE', 'Fecha de expiraci&oacute;n');
