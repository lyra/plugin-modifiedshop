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
define('MODULE_PAYMENT_PAYZEN_TECHNICAL_ERROR', 'Ein Fehler ist w&auml;hrend dem Zahlungsvorgang unterlaufen.');
define('MODULE_PAYMENT_PAYZEN_PAYMENT_ERROR', 'Ihre Zahlung wurde abgelehnt. Bitte f&uuml;hren Sie den Bestellvorgang erneut durch.');
define('MODULE_PAYMENT_PAYZEN_CHECK_URL_WARN', 'Es konnte keine automatische Benachrichtigung erstellt werden. Bitte pr&uuml;fen Sie, ob die Benachrichtigung-URL in Ihr PayZen Back Office korrekt eingerichtet ist.');
define('MODULE_PAYMENT_PAYZEN_CHECK_URL_WARN_DETAIL', 'N&auml;here Informationen zu diesem Problem entnehmen Sie bitte der Moduldokumentation:<br />&nbsp;&nbsp;&nbsp;- Kapitel &laquo; Bitte vor dem Weiterlesen aufmerksam lesen &raquo;<br />&nbsp;&nbsp;&nbsp;- Kapitel &laquo; Benachrichtigung-URL Einstellungen &raquo;');
define('MODULE_PAYMENT_PAYZEN_GOING_INTO_PROD_INFO', '<b>UMSTELLUNG AUF PRODUKTIONSUMFELD:</b> Sie m&ouml;chten wissen, wie Sie auf Produktionsumfeld umstellen k&ouml;nnen, bitte lesen Sie die Kapitel « Weiter zur Testphase » und « Verschieben des Shops in den Produktionsumfeld » in der Dokumentation des Moduls.');
define('MODULE_PAYMENT_PAYZEN_MAINTENANCE_MODE_WARN','Dieser Shop befindet sich im Wartungsmodus. Es kann keine automatische Benachrichtigung erstellt werden.');
define('MODULE_PAYMENT_PAYZEN_TEXT_TITLE', 'PayZen');
define('MODULE_PAYMENT_PAYZEN_TEXT_DESCRIPTION', 'Zahlung mit EC-/Kreditkarte');
define('MODULE_PAYMENT_PAYZEN_INFORMATION_TITLE', 'Informationen');
define('MODULE_PAYMENT_PAYZEN_WARNING_TITLE', 'Warnung');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_MESSAGE', 'Weiterleitung zum Shop in K&uuml;rze...');

## ADMINISTRATION INTERFACE - INFORMATIONS ##
define('MODULE_PAYMENT_PAYZEN_MODULE_INFORMATION', 'MODULINFORMATIONEN');
define('MODULE_PAYMENT_PAYZEN_DEVELOPED_BY', 'Entwickelt von: ');
define('MODULE_PAYMENT_PAYZEN_CONTACT_EMAIL', 'Kontakt: ');
define('MODULE_PAYMENT_PAYZEN_CONTRIB_VERSION', 'Modulversion: ');
define('MODULE_PAYMENT_PAYZEN_GATEWAY_VERSION', 'Plattformversion: ');
define('MODULE_PAYMENT_PAYZEN_CMS_VERSION', 'Getestet mit: ');
define('MODULE_PAYMENT_PAYZEN_IPN_URL', 'Benachrichtigung-URL, die Sie in Ihre PayZen Back Office kopieren sollen > Einstellung > Regeln der Benachrichtigungen: <br />');

## ADMINISTRATION INTERFACE - MODULE SETTINGS ##
define('MODULE_PAYMENT_PAYZEN_STATUS_TITLE', 'Aktiviert');
define('MODULE_PAYMENT_PAYZEN_STATUS_DESC', 'Aktiviert / Deaktiviert dieses Zahlungsmodus.');
define('MODULE_PAYMENT_PAYZEN_SORT_ORDER_TITLE', 'Reihenfolge');
define('MODULE_PAYMENT_PAYZEN_SORT_ORDER_DESC', 'In der Liste der Zahlungsmittel.');
define('MODULE_PAYMENT_PAYZEN_ZONE_TITLE', 'Zahlungsraum');
define('MODULE_PAYMENT_PAYZEN_ZONE_DESC', 'Ist ein Zahlungsraum ausgew&auml;hlt, so wird diese Zahlungsart nur f&uuml;r diesen verf&uuml;gbar sein.');

## ADMINISTRATION INTERFACE - PLATFORM SETTINGS ##
define('MODULE_PAYMENT_PAYZEN_SITE_ID_TITLE', 'Shop ID');
define('MODULE_PAYMENT_PAYZEN_SITE_ID_DESC', 'Kennung, die von Ihrer Bank bereitgestellt wird.');
define('MODULE_PAYMENT_PAYZEN_KEY_TEST_TITLE', 'Schl&uuml;ssel im Testbetrieb');
define('MODULE_PAYMENT_PAYZEN_KEY_TEST_DESC', 'Schl&uuml;ssel, das von PayZen zu Testzwecken bereitgestellt wird (im PayZen Back Office verf&uuml;gbar).');
define('MODULE_PAYMENT_PAYZEN_KEY_PROD_TITLE', 'Schl&uuml;ssel im Produktivbetrieb');
define('MODULE_PAYMENT_PAYZEN_KEY_PROD_DESC', 'Von PayZen bereitgestelltes Schl&uuml;ssel (im PayZen Back Office verf&uuml;gbar, nachdem der Produktionsmodus aktiviert wurde).');
define('MODULE_PAYMENT_PAYZEN_CTX_MODE_TITLE', 'Modus');
define('MODULE_PAYMENT_PAYZEN_CTX_MODE_DESC', 'Kontextmodus dieses Moduls.');
define('MODULE_PAYMENT_PAYZEN_SIGN_ALGO_TITLE', 'Signaturalgorithmus');
define('MODULE_PAYMENT_PAYZEN_SIGN_ALGO_DESC', 'Algorithmus zur Berechnung der Zahlungsformsignatur. Der ausgew&auml;hlte Algorithmus muss derselbe sein, wie er im PayZen Back Office.' . (! $payzen_plugin_features['shatwo'] ? '<br /><b>Der HMAC-SHA-256-Algorithmus sollte nicht aktiviert werden, wenn er noch nicht im PayZen Back Office verf&uuml;gbar ist. Die Funktion wird in K&uuml;rze verf&uuml;gbar sein.</b>' : ''));
define('MODULE_PAYMENT_PAYZEN_PLATFORM_URL_TITLE', 'Plattform-URL');
define('MODULE_PAYMENT_PAYZEN_PLATFORM_URL_DESC', 'Link zur Bezahlungsplattform.');

## ADMINISTRATION INTERFACE - PAYMENT SETTINGS ##
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_TITLE', 'Standardsprache');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_DESC', 'W&auml;hlen Sie bitte die Spracheinstellung der Zahlungsseiten aus.');
define('MODULE_PAYMENT_PAYZEN_AVAILABLE_LANGUAGES_TITLE', 'Verf&uuml;gbare Sprachen');
define('MODULE_PAYMENT_PAYZEN_AVAILABLE_LANGUAGES_DESC', 'Verf&uuml;gbare Sprachen der Zahlungsseite. Nichts ausw&auml;hlen, um die Einstellung der Zahlungsplattform zu benutzen.');
define('MODULE_PAYMENT_PAYZEN_CAPTURE_DELAY_TITLE', 'Einzugsfrist');
define('MODULE_PAYMENT_PAYZEN_CAPTURE_DELAY_DESC', 'Anzahl der Tage bis zum Einzug der Zahlung (Einstellung &uuml;ber Ihr PayZen-System).');
define('MODULE_PAYMENT_PAYZEN_VALIDATION_MODE_TITLE', 'Best&auml;tigungsmodus');
define('MODULE_PAYMENT_PAYZEN_VALIDATION_MODE_DESC', 'Bei manueller Eingabe m&uuml;ssen Sie Zahlungen manuell in Ihr PayZen Back Office best&auml;tigen.');
define('MODULE_PAYMENT_PAYZEN_PAYMENT_CARDS_TITLE', 'Kartentypen');
define('MODULE_PAYMENT_PAYZEN_PAYMENT_CARDS_DESC', 'W&auml;hlen Sie die zur Zahlung verf&uuml;gbaren Kartentypen aus. Nichts ausw&auml;hlen, um die Einstellungen der Plattform zu verwenden.');
define('MODULE_PAYMENT_PAYZEN_3DS_MIN_AMOUNT_TITLE', 'Manage 3DS');
define('MODULE_PAYMENT_PAYZEN_3DS_MIN_AMOUNT_DESC', 'Amount below which customer could be exempt from strong authentication. Needs subscription to «Selective 3DS1» or «Frictionless 3DS2» options. For more information, refer to the module documentation.');

## ADMINISTRATION INTERFACE - AMOUNT RESTRICTIONS SETTINGS ##
define('MODULE_PAYMENT_PAYZEN_AMOUNT_MIN_TITLE', 'Mindestbetrag');
define('MODULE_PAYMENT_PAYZEN_AMOUNT_MIN_DESC', 'Mindestbetrag f&uuml;r die Nutzung dieser Zahlungsweise.');
define('MODULE_PAYMENT_PAYZEN_AMOUNT_MAX_TITLE', 'H&ouml;chstbetrag');
define('MODULE_PAYMENT_PAYZEN_AMOUNT_MAX_DESC', 'H&ouml;chstbetrag f&uuml;r die Nutzung dieser Zahlungsweise.');

## ADMINISTRATION INTERFACE - BACK TO STORE SETTINGS ##
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ENABLED_TITLE', 'Automatische Weiterleitung');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ENABLED_DESC', 'Ist diese Einstellung aktiviert, wird der Kunde am Ende des Bezahlvorgangs automatisch auf Ihre Seite weitergeleitet.');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_TIMEOUT_TITLE', 'Zeitbeschr&auml;nkung Weiterleitung im Erfolgsfall');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_TIMEOUT_DESC', 'Zeitspanne in Sekunden (0-300) bis zur automatischen Weiterleitung des Kunden auf Ihre Seite nach erfolgter Zahlung.');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_MESSAGE_TITLE', 'Weiterleitungs-Nachricht im Erfolgsfall');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_MESSAGE_DESC', 'Nachricht, die nach erfolgter Zahlung und vor der Weiterleitung auf der Plattform angezeigt wird.');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_TIMEOUT_TITLE', 'Zeitbeschr&auml;nkung Weiterleitung nach Ablehnung');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_TIMEOUT_DESC', 'Zeitspanne in Sekunden (0-300) bis zur automatischen Weiterleitung des Kunden auf Ihre Seite nach fehlgeschlagener Zahlung.');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_MESSAGE_TITLE', 'Weiterleitungs-Nachricht nach Ablehnung');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_MESSAGE_DESC', 'Nachricht, die nach fehlgeschlagener Zahlung und vor der Weiterleitung auf der Plattform angezeigt wird.');
define('MODULE_PAYMENT_PAYZEN_RETURN_MODE_TITLE', '&Uuml;bermittlungs-Modus');
define('MODULE_PAYMENT_PAYZEN_RETURN_MODE_DESC', 'Methode, die zur &Uuml;bermittlung des Zahlungsergebnisses von der Zahlungsschnittstelle an Ihren Shop verwendet wird.');
define('MODULE_PAYMENT_PAYZEN_ORDER_STATUS_TITLE', 'Bestellstatus');
define('MODULE_PAYMENT_PAYZEN_ORDER_STATUS_DESC', 'Status der Bestellungen bei erfolgreicher Zahlung');

## ADMINISTRATION INTERFACE - MISC CONSTANTS ##
define('MODULE_PAYMENT_PAYZEN_VALUE_FALSE', 'Nein');
define('MODULE_PAYMENT_PAYZEN_VALUE_TRUE', 'Ja');

define('MODULE_PAYMENT_PAYZEN_VALIDATION_', 'PayZen Back Office Konfiguration');
define('MODULE_PAYMENT_PAYZEN_VALIDATION_0', 'Auto');
define('MODULE_PAYMENT_PAYZEN_VALIDATION_1', 'Manuell');

define('MODULE_PAYMENT_PAYZEN_LANGUAGE_FRENCH', 'Franz&ouml;sisch');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_GERMAN', 'Deutsch');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_ENGLISH', 'Englisch');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_SPANISH', 'Spanisch');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_CHINESE', 'Chinesisch');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_ITALIAN', 'Italienisch');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_JAPANESE', 'Japanisch');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_PORTUGUESE', 'Portugiesisch');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_DUTCH', 'Niederl&auml;ndisch');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_SWEDISH', 'Schwedisch');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_RUSSIAN', 'Russisch');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_TURKISH', 'T&uuml;rkisch');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_POLISH', 'Polnisch');

#ADMINISTRATION INTERFACE EXTRA ORDER INFORMATIONS
define('MODULE_PAYMENT_PAYZEN_PAYMENT_MEAN', 'Zahlungsmittel');
define('MODULE_PAYMENT_PAYZEN_PAYMENT_CARD_BRAND_BUYER_CHOICE', 'Kartenmarke von K&auml;ufer gew&auml;hlt.');
define('MODULE_PAYMENT_PAYZEN_PAYMENT_CARD_BRAND_DEFAULT_CHOICE','Standard-Kartenmarke verwendet.');
define('MODULE_PAYMENT_PAYZEN_TRANSACTION_ID', 'Transaktionsnummer');
define('MODULE_PAYMENT_PAYZEN_CARD_NUMBER', 'Kartennummer');
define('MODULE_PAYMENT_PAYZEN_EXPIRATION_DATE', 'Verfallsdatum');
