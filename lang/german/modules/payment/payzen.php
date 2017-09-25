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

## CATALOG MESSAGES ##
define('MODULE_PAYMENT_PAYZEN_TECHNICAL_ERROR', 'Ein Fehler ist bei dem Zahlungsvorgang unterlaufen.');
define('MODULE_PAYMENT_PAYZEN_PAYMENT_ERROR', 'Ihre Bestellung konnte nicht best&auml;tigt werden.  Die Zahlung wurde nicht angenommen.');
define('MODULE_PAYMENT_PAYZEN_CHECK_URL_WARN', 'Die automatische Best&auml;tigung hat nicht funktioniert. Haben Sie die Benachrichtigung-URL im Backoffice PayZen richtig eingestellt?');
define('MODULE_PAYMENT_PAYZEN_CHECK_URL_WARN_DETAIL', 'Um die Problematif zu verstehen, benutzen Sie bitte die Benutzerhilfe des Moduls:<br />&nbsp;&nbsp;&nbsp;- Kapitel &laquo; Aufmerksam lesen &raquo;<br />&nbsp;&nbsp;&nbsp;- Kapitel &laquo; Einstellung der Benachrichtigung-URL &raquo;.');
define('MODULE_PAYMENT_PAYZEN_GOING_INTO_PROD_INFO', '<b>UMSTELLUNG AUF PRODUKTIONSUMFELD:</b> Sie m&ouml;chten wissen, wie Sie auf Produktionsumfeld umstellen k&ouml;nnen, bitte lesen Sie folgende URL ');
define('MODULE_PAYMENT_PAYZEN_TEXT_TITLE', 'PayZen');
define('MODULE_PAYMENT_PAYZEN_TEXT_DESCRIPTION', 'Sichere Zahlung per EC/-Kreditkarte');
define('MODULE_PAYMENT_PAYZEN_INFORMATION_TITLE', 'Informationen');
define('MODULE_PAYMENT_PAYZEN_WARNING_TITLE', 'Warnung');

## ADMINISTRATION INTERFACE - INFORMATIONS ##
define('MODULE_PAYMENT_PAYZEN_MODULE_INFORMATION', 'Modulinformationen');
define('MODULE_PAYMENT_PAYZEN_DEVELOPED_BY', 'Entwickelt von : ');
define('MODULE_PAYMENT_PAYZEN_CONTACT_EMAIL', 'Kontakt: ');
define('MODULE_PAYMENT_PAYZEN_CONTRIB_VERSION', 'Modulversion: ');
define('MODULE_PAYMENT_PAYZEN_GATEWAY_VERSION', 'Plattformversion: ');
define('MODULE_PAYMENT_PAYZEN_CMS_VERSION', 'Getestet mit: ');
define('MODULE_PAYMENT_PAYZEN_IPN_URL', 'Benachrichtigung-URL zur Eintragung in Ihr Shopsystem: <br />');

## ADMINISTRATION INTERFACE - MODULE SETTINGS ##
define('MODULE_PAYMENT_PAYZEN_STATUS_TITLE', 'PayZen-Modul aktivieren');
define('MODULE_PAYMENT_PAYZEN_STATUS_DESC', 'M&ouml;chten Sie die PayZen-Zahlungsart akzeptieren?');
define('MODULE_PAYMENT_PAYZEN_SORT_ORDER_TITLE', 'Anzeigereihenfolge');
define('MODULE_PAYMENT_PAYZEN_SORT_ORDER_DESC', 'Anzeigereihenfolge: Von klein nach gross.');
define('MODULE_PAYMENT_PAYZEN_ZONE_TITLE', 'Zahlungsraum');
define('MODULE_PAYMENT_PAYZEN_ZONE_DESC', 'Ist ein Zahlungsraum ausgew&auml;hlt, so wird diese Zahlungsart nur f&uuml;r diesen verf&uuml;gbar sein.');

## ADMINISTRATION INTERFACE - PLATFORM SETTINGS ##
define('MODULE_PAYMENT_PAYZEN_SITE_ID_TITLE', 'Shop ID');
define('MODULE_PAYMENT_PAYZEN_SITE_ID_DESC', 'Kennung, die von Ihrer Bank bereitgestellt wird.');
define('MODULE_PAYMENT_PAYZEN_KEY_TEST_TITLE', 'Zertifikat im Testbetrieb');
define('MODULE_PAYMENT_PAYZEN_KEY_TEST_DESC', 'Zertifikat, das von Ihrer Bank zu Testzwecken bereitgestellt wird (im PayZen-System verf&uuml;gbar).');
define('MODULE_PAYMENT_PAYZEN_KEY_PROD_TITLE', 'Zertifikat im Produktivbetrieb');
define('MODULE_PAYMENT_PAYZEN_KEY_PROD_DESC', 'Von Ihrer Bank bereitgestelltes Zertifikat (im PayZen-System verf&uuml;gbar).');
define('MODULE_PAYMENT_PAYZEN_CTX_MODE_TITLE', 'Modus');
define('MODULE_PAYMENT_PAYZEN_CTX_MODE_DESC', 'Kontextmodus dieses Moduls.');
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
define('MODULE_PAYMENT_PAYZEN_VALIDATION_MODE_DESC', 'Bei manueller Eingabe m&uuml;ssen Sie Zahlungen manuell in Ihrem Banksystem best&auml;tigen.');
define('MODULE_PAYMENT_PAYZEN_PAYMENT_CARDS_TITLE', 'Kartentypen');
define('MODULE_PAYMENT_PAYZEN_PAYMENT_CARDS_DESC', 'Liste der/die f&uuml;r die Zahlung verf&uuml;gbare(n) Kartentyp(en), durch Semikolon getrennt.');
define('MODULE_PAYMENT_PAYZEN_3DS_MIN_AMOUNT_TITLE', 'Mindestbetrag zur Aktivierung von 3DS');
define('MODULE_PAYMENT_PAYZEN_3DS_MIN_AMOUNT_DESC', 'Muss f&uuml;r die Option Selektives 3-D Secure freigeschaltet sein.');

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
define('MODULE_PAYMENT_PAYZEN_ORDER_STATUS_DESC', 'Definiert den Status von Bestellungen, die &uuml;ber die PayZen-Zahlungsart bezahlt wurden.');

## ADMINISTRATION INTERFACE - MISC CONSTANTS ##
define('MODULE_PAYMENT_PAYZEN_VALUE_FALSE', 'Nein');
define('MODULE_PAYMENT_PAYZEN_VALUE_TRUE', 'Ja');

define('MODULE_PAYMENT_PAYZEN_VALIDATION_DEFAULT', 'Einstellung &uuml;ber das PayZen-System');
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
define('MODULE_PAYMENT_PAYZEN_TRANSACTION_ID', 'Transaktionsnummer');
define('MODULE_PAYMENT_PAYZEN_CARD_NUMBER', 'Kartennummer');
define('MODULE_PAYMENT_PAYZEN_EXPIRATION_DATE', 'Verfallsdatum');