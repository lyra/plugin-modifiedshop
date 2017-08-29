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
define('MODULE_PAYMENT_VADS_TEXT_TITLE','PayZen - Kartenzahlung');
define('MODULE_PAYMENT_VADS_TEXT_DESCRIPTION', "Kreditkartenzahlung: PayZen");

## ADMINISTRATION INTERFACE - INFORMATIONS ##
define('MODULE_PAYMENT_VADS_MODULE_INFORMATION', "Modulinformationen");
define('MODULE_PAYMENT_VADS_DEVELOPED_BY', "Entwickelt von: ");
define('MODULE_PAYMENT_VADS_CONTACT_EMAIL', "Kontaktemail: ");
define('MODULE_PAYMENT_VADS_CONTRIB_VERSION', "Modulversion: ");
define('MODULE_PAYMENT_VADS_GATEWAY_VERSION', "Version der Zahlungsplattform ");
define('MODULE_PAYMENT_VADS_CMS_VERSION', "Getestet mit: ");
define('MODULE_PAYMENT_VADS_SILENT_URL', "Server URL, im Backoffice angeben: ");


define('MODULE_PAYMENT_VADS_CONTRIB_TITLE',"Modulversion");

define('MODULE_PAYMENT_VADS_TEXT_ERROR_MESSAGE', "Ihre Zahlung kann nicht bestätigt werden.");

define('MODULE_PAYMENT_VADS_CHECK_URL_NOT_CALLED_ERROR_MESSAGE', "Warnung Testmodus: Die Bestellung wurde registriert, aber die automatische Bestätigung hat nicht funkioniert. Haben Sie die Server URL im Backoffice richtig angegeben?
 PayZen");

## ADMINISTRATION PARAMETERS ##
define('MODULE_PAYMENT_VADS_GATEWAY_TITLE', "Zahlungsplattform");
define('MODULE_PAYMENT_VADS_GATEWAY_DESC', "Name der Zahlungsplattform");

define('MODULE_PAYMENT_VADS_URL_GATEWAY_TITLE', "URL der Zahlungsplattform");
define('MODULE_PAYMENT_VADS_URL_GATEWAY_DESC', "Zahlungs-URL zur Weiterleitung des Kunden
");

define('MODULE_PAYMENT_VADS_COMPANY_TITLE', "Firmenname");
define('MODULE_PAYMENT_VADS_COMPANY_DEFAULT', "Firma");
define('MODULE_PAYMENT_VADS_COMPANY_DESC', "Geben Sie Ihren Firmennammen an.");

define('MODULE_PAYMENT_VADS_STATUS_TITLE', "Zahlungsmodul VADS aktivieren");
define('MODULE_PAYMENT_VADS_STATUS_DESC', "Bestätigen Sie diese Zahlungsmöglichkeit?
");

define('MODULE_PAYMENT_VADS_SITE_ID_TITLE', "Website Kennung");
define('MODULE_PAYMENT_VADS_SITE_ID_DESC', "Kennung Ihrer Bank");

define('MODULE_PAYMENT_VADS_MODE_TITLE', "Modus");
define('MODULE_PAYMENT_VADS_MODE_DESC', "Funktionsweise des Moduls");

define('MODULE_PAYMENT_VADS_DELAY_TITLE', "Zeitspanne vor Kassenschluss");
define('MODULE_PAYMENT_VADS_DELAY_DESC', "Anzahl der Tage vor Kassenabschluss (im Backoffice einstellbar) PayZen)");

define('MODULE_PAYMENT_VADS_LANGAGE_TITLE', "Sprache - Ausgangsparameter");
define('MODULE_PAYMENT_VADS_LANGAGE_DESC', "Sprachen : DE (Deutsch), ZN (Chinesisch), EN (Englisch), ES (Spanisch), JA (Japanisch)");

define('MODULE_PAYMENT_VADS_CARTE_TITLE', "Kartentyp");
define('MODULE_PAYMENT_VADS_CARTE_DESC', " Kartentyp, der für die Zahlung benutzt werden kann, durch Semikolon getrennt");

define('MODULE_PAYMENT_VADS_TYPE_PAIEMENT_TITLE', "Zahlungsart");
define('MODULE_PAYMENT_VADS_TYPE_PAIEMENT_DESC', "Dieses Modul verwaltet nur einmalige Zahlungen");

define('MODULE_PAYMENT_VADS_MODE_VALIDATION_TITLE', "Bestätigungsart");
define('MODULE_PAYMENT_VADS_MODE_VALIDATION_DESC', "2 Möglichkeiten: automatisch (0), manuell (1), dies kann im Backoffice eingestellt werden PayZen)");

define('MODULE_PAYMENT_VADS_URL_UNAUTHORIZED_TITLE', "URL im Falle einer Verweigerung der Zahlungserlaubnis");
define('MODULE_PAYMENT_VADS_URL_UNAUTHORIZED_DESC', "URL zur Weiterleitung des Kunden im Falle einer Zahlungsverweigerung");

define('MODULE_PAYMENT_VADS_REDIRECT_ENABLED_TITLE', "Automatische Weiterleitung");
define('MODULE_PAYMENT_VADS_REDIRECT_ENABLED_DESC', "Falls aktiviert wird der Kunde am Ende des Zahlungsprozesses direkt auf Ihre Website weitergeleitet");

define('MODULE_PAYMENT_VADS_REDIRECT_SUCCESS_TIMEOUT_TITLE', "Zeitspanne vor Weiterleitung (Erfolg)");
define('MODULE_PAYMENT_VADS_REDIRECT_SUCCESS_TIMEOUT_DESC', "Zeit in Sekunden (0-300) bevor der Kunde automatisch zu Ihrer Website weitergeleitet wird");
define('MODULE_PAYMENT_VADS_REDIRECT_SUCCESS_MESSAGE_TITLE', "Nachricht vor Weiterleitung (Erfolg)");
define('MODULE_PAYMENT_VADS_REDIRECT_SUCCESS_MESSAGE_DESC', "Angezeigte Nachricht der Zahlungsplattform vor Weiterleitung nach Erfolg der Zahlung");
define('MODULE_PAYMENT_VADS_REDIRECTION_SUCCESS_MESSAGE_DEFAULT', "Ihre Zahlung wurde registriert, Sie werden gleich weitergeleitet");

define('MODULE_PAYMENT_VADS_REDIRECT_ERROR_TIMEOUT_TITLE', "Zeitspanne vor Weiterleitung (Scheitern)");
define('MODULE_PAYMENT_VADS_REDIRECT_ERROR_TIMEOUT_DESC', "Zeit in Sekunden (0-300) bevor der Kunde automatisch zu Ihrer Website weitergeleitet wird im Falle einer gescheiterten Zahlung");
define('MODULE_PAYMENT_VADS_REDIRECT_ERROR_MESSAGE_TITLE', "Nachricht vor Weiterleitung (Scheitern)");
define('MODULE_PAYMENT_VADS_REDIRECT_ERROR_MESSAGE_DESC', "Angezeigte Nachricht der Zahlungsplattform vor Weiterleitung nach Scheiterung der Zahlung");
define('MODULE_PAYMENT_VADS_REDIRECTION_ERROR_MESSAGE_DEFAULT', "Fehler, sie werden gleich weitergeleitet");
/*
define('MODULE_PAYMENT_VADS_URL_REFUSED_TITLE', "URL en cas d\'autre refus");
define('MODULE_PAYMENT_VADS_URL_REFUSED_DESC', "URL sur lequel le client sera redirigé en cas d\'autre refus");

define('MODULE_PAYMENT_VADS_URL_CANCEL_TITLE', "URL en cas d\'annulation");
define('MODULE_PAYMENT_VADS_URL_CANCEL_DESC', "URL sur lequel le client sera redirigé en cas d\'annulation");

define('MODULE_PAYMENT_VADS_URL_ERROR_TITLE', "URL en cas d\'erreur");
define('MODULE_PAYMENT_VADS_URL_ERROR_DESC', "URL sur lequel le client sera redirigé en cas d\'erreur");
*/
define('MODULE_PAYMENT_VADS_REDIRECTION_OSC_ERROR_MESSAGE',"Der Zahlungsvorgang ist gescheitert, Ihre Bestellung wurde nicht registriert");

define('MODULE_PAYMENT_VADS_RETURN_MODE_TITLE', 'Art der Rückleitung');
define('MODULE_PAYMENT_VADS_RETURN_MODE_DESC', 'Art der Rückleitung des Zahlungsergebnisses');

define('MODULE_PAYMENT_VADS_URL_DEFAUT_TITLE', "URL Rückleitung zur Website");
define('MODULE_PAYMENT_VADS_URL_DEFAUT_DESC', "URL zur Rückleitung nachdem der Kunde auf Rückleitung zur Website geklickt hat");

define('MODULE_PAYMENT_VADS_URL_SUCCES_TITLE', "URL zur Rückleitung im Falle einer akzeptierten Zahlung");
define('MODULE_PAYMENT_VADS_URL_SUCCES_DESC', "URL zur Rückleitung des Kunden nach einer akzeptierten Zahlung");

define('MODULE_PAYMENT_VADS_KEY_TEST_TITLE', "Testzertifikat");
define('MODULE_PAYMENT_VADS_KEY_TEST_DESC', "Von PayZen erstelltes Zertifikat (im Backoffice erhältlich)");
define('MODULE_PAYMENT_VADS_KEY_PROD_TITLE', "Produktionszertifikat");
define('MODULE_PAYMENT_VADS_KEY_PROD_DESC', "Von PayZen erstelltes Zertifikat (im Backoffice erhältlich)");

define('MODULE_PAYMENT_VADS_SORT_ORDER_TITLE', "Anzeigenreihenfolge");
define('MODULE_PAYMENT_VADS_SORT_ORDER_DESC', "Die kleinste Zahl wird zuerst angezeigt");

define('MODULE_PAYMENT_VADS_ZONE_TITLE', "Zahlungsbereich");
define('MODULE_PAYMENT_VADS_ZONE_DESC', "Wenn ein Bereich ausgewählt wird, wird diese Zahlungsart nur für diesen gültig sein.");

define('MODULE_PAYMENT_VADS_ORDER_STATUS_ID_TITLE', "Bestellungsstatus");
define('MODULE_PAYMENT_VADS_ORDER_STATUS_ID_DESC', "Definieren des Bestellungsstatus (Bestellungen, die anhand dieser Zahlungsart bezahlt wurden)");

?>