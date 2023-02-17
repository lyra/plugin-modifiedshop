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
define('MODULE_PAYMENT_PAYZEN_TECHNICAL_ERROR', 'Une erreur est survenue durant le processus de paiement.');
define('MODULE_PAYMENT_PAYZEN_PAYMENT_ERROR', 'Votre paiement n&#039;a pas &eacute;t&eacute; accept&eacute;. Veuillez repasser votre commande.');
define('MODULE_PAYMENT_PAYZEN_CHECK_URL_WARN', 'La commande a &eacute;t&eacute; valid&eacute;e mais la confirmation automatique n&#039;a pas fonctionn&eacute;. Avez-vous correctement configur&eacute; l&#039;URL de notification dans le Back Office PayZen?');
define('MODULE_PAYMENT_PAYZEN_CHECK_URL_WARN_DETAIL', 'Afin de comprendre la probl&eacute;matique, reportez vous à la documentation du module :<br />&nbsp;&nbsp;&nbsp;- Chapitre &laquo; A lire attentivement avant d&#039;aller loin &raquo;<br />&nbsp;&nbsp;&nbsp;- Chapitre &laquo; Param&eacute;trage de l&#039;URL de notification &raquo;');
define('MODULE_PAYMENT_PAYZEN_GOING_INTO_PROD_INFO', '<b>PASSAGE EN PRODUCTION :</b> Vous souhaitez savoir comment passer votre boutique en production, merci de consulter les chapitres « Proc&eacute;der &agrave; la phase des tests » et « Passage d&#039;une boutique en mode production » de la documentation du module.');
define('MODULE_PAYMENT_PAYZEN_MAINTENANCE_MODE_WARN','La boutique est en mode maintenance. La validation automatique ne peut fonctionner.');
define('MODULE_PAYMENT_PAYZEN_TEXT_TITLE', 'PayZen');
define('MODULE_PAYMENT_PAYZEN_TEXT_DESCRIPTION', 'Paiement par carte bancaire');
define('MODULE_PAYMENT_PAYZEN_INFORMATION_TITLE', 'Information');
define('MODULE_PAYMENT_PAYZEN_WARNING_TITLE', 'Avertissement');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_MESSAGE', 'Redirection vers la boutique dans quelques instants...');

## ADMINISTRATION INTERFACE - INFORMATIONS ##
define('MODULE_PAYMENT_PAYZEN_MODULE_INFORMATION', 'INFORMATIONS SUR LE MODULE');
define('MODULE_PAYMENT_PAYZEN_DEVELOPED_BY', 'D&eacute;velopp&eacute; par: ');
define('MODULE_PAYMENT_PAYZEN_CONTACT_EMAIL', 'Courriel de contact: ');
define('MODULE_PAYMENT_PAYZEN_CONTRIB_VERSION', 'Version du module: ');
define('MODULE_PAYMENT_PAYZEN_GATEWAY_VERSION', 'Version de la plateforme: ');
define('MODULE_PAYMENT_PAYZEN_DOC', 'Cliquer pour accéder à la documentation de configuration du module: ');
define('MODULE_PAYMENT_PAYZEN_IPN_URL', 'URL de notification &agrave; copier dans le Back Office PayZen > Param&eacute;trage > R&egrave;gles de notifications: <br />');

## ADMINISTRATION INTERFACE - MODULE SETTINGS ##
define('MODULE_PAYMENT_PAYZEN_STATUS_TITLE', 'Activation');
define('MODULE_PAYMENT_PAYZEN_STATUS_DESC', 'Active / d&eacute;sactive cette m&eacute;thode de paiement.');
define('MODULE_PAYMENT_PAYZEN_SORT_ORDER_TITLE', 'Ordre d&#039;affichage');
define('MODULE_PAYMENT_PAYZEN_SORT_ORDER_DESC', 'Dans la liste des moyens de paiement.');
define('MODULE_PAYMENT_PAYZEN_ZONE_TITLE', 'Zone de paiement');
define('MODULE_PAYMENT_PAYZEN_ZONE_DESC', 'Si une zone est choisie, ce mode de paiement ne sera effectif que pour celle-ci.');

## ADMINISTRATION INTERFACE - PLATFORM SETTINGS ##
define('MODULE_PAYMENT_PAYZEN_SITE_ID_TITLE', 'Identifiant boutique');
define('MODULE_PAYMENT_PAYZEN_SITE_ID_DESC', 'Identifiant fourni par PayZen.');
define('MODULE_PAYMENT_PAYZEN_KEY_TEST_TITLE', 'Cl&eacute; en mode test');
define('MODULE_PAYMENT_PAYZEN_KEY_TEST_DESC', 'Cl&eacute; fournie par PayZen pour le mode test (disponible sur le Back Office PayZen).');
define('MODULE_PAYMENT_PAYZEN_KEY_PROD_TITLE', 'Cl&eacute; en mode production');
define('MODULE_PAYMENT_PAYZEN_KEY_PROD_DESC', 'Cl&eacute; fournie par PayZen (disponible sur le Back Office PayZen apr&egrave;s passage en production).');
define('MODULE_PAYMENT_PAYZEN_CTX_MODE_TITLE', 'Mode');
define('MODULE_PAYMENT_PAYZEN_CTX_MODE_DESC', 'Mode de fonctionnement du module.');
define('MODULE_PAYMENT_PAYZEN_SIGN_ALGO_TITLE', 'Algorithme de signature');
define('MODULE_PAYMENT_PAYZEN_SIGN_ALGO_DESC', 'Algorithme utilis&eacute; pour calculer la signature du formulaire de paiement. L&#039;algorithme s&eacute;lectionn&eacute; doit être le même que celui configur&eacute; sur le Back Office PayZen.' . (! $payzen_plugin_features['shatwo'] ? '<br /><b>Le HMAC-SHA-256 ne doit pas être activ&eacute; si celui-ci n&#039;est pas encore disponible depuis le Back Office PayZen, la fonctionnalit&eacute; sera disponible prochainement.</b>' : ''));
define('MODULE_PAYMENT_PAYZEN_PLATFORM_URL_TITLE', 'URL de la page de paiement');
define('MODULE_PAYMENT_PAYZEN_PLATFORM_URL_DESC', 'URL vers laquelle l&#039;acheteur sera redirig&eacute; pour le paiement.');

## ADMINISTRATION INTERFACE - PAYMENT SETTINGS ##
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_TITLE', 'Langue par d&eacute;faut');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_DESC', 'S&eacute;lectionner la langue par d&eacute;faut &agrave; utiliser sur la page de paiement.');
define('MODULE_PAYMENT_PAYZEN_AVAILABLE_LANGUAGES_TITLE', 'Langues disponibles');
define('MODULE_PAYMENT_PAYZEN_AVAILABLE_LANGUAGES_DESC', 'S&eacute;lectionner les langues &agrave; proposer sur la page de paiement.');
define('MODULE_PAYMENT_PAYZEN_CAPTURE_DELAY_TITLE', 'D&eacute;lai avant remise en banque');
define('MODULE_PAYMENT_PAYZEN_CAPTURE_DELAY_DESC', 'Le nombre de jours avant la remise en banque (param&eacute;trable sur votre Back Office PayZen).');
define('MODULE_PAYMENT_PAYZEN_VALIDATION_MODE_TITLE', 'Mode de validation');
define('MODULE_PAYMENT_PAYZEN_VALIDATION_MODE_DESC', 'En mode manuel, vous devrez confirmer les paiements dans le Back Office PayZen.');
define('MODULE_PAYMENT_PAYZEN_PAYMENT_CARDS_TITLE', 'Types de carte');
define('MODULE_PAYMENT_PAYZEN_PAYMENT_CARDS_DESC', 'Le(s) type(s) de carte pouvant être utilis&eacute;(s) pour le paiement. Ne rien s&eacute;lectionner pour utiliser la configuration de la plateforme.');
define('MODULE_PAYMENT_PAYZEN_3DS_MIN_AMOUNT_TITLE', 'G&eacute;rer le 3DS');
define('MODULE_PAYMENT_PAYZEN_3DS_MIN_AMOUNT_DESC', 'Montant en dessous duquel l&#039;acheteur pourrait être exempt&eacute; de l&#039;authentification forte. N&eacute;cessite la souscription &agrave; l&#039;option «Selective 3DS1» ou l&#039;option  «Frictionless 3DS2». Pour plus d&#039;informations, reportez-vous &agrave; la documentation du module.');

## ADMINISTRATION INTERFACE - AMOUNT RESTRICTIONS SETTINGS ##
define('MODULE_PAYMENT_PAYZEN_AMOUNT_MIN_TITLE', 'Montant minimum');
define('MODULE_PAYMENT_PAYZEN_AMOUNT_MIN_DESC', 'Montant minimum pour lequel cette m&eacute;thode de paiement est disponible.');
define('MODULE_PAYMENT_PAYZEN_AMOUNT_MAX_TITLE', 'Montant maximum');
define('MODULE_PAYMENT_PAYZEN_AMOUNT_MAX_DESC', 'Montant maximum pour lequel cette m&eacute;thode de paiement est disponible.');

## ADMINISTRATION INTERFACE - BACK TO STORE SETTINGS ##
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ENABLED_TITLE', 'Redirection automatique');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ENABLED_DESC', 'Si activ&eacute;e, l&#039;acheteur sera redirig&eacute; automatiquement vers votre site &agrave; la fin du paiement.');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_TIMEOUT_TITLE', 'Temps avant redirection (succ&egrave;s)');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_TIMEOUT_DESC', 'Temps en secondes (0-300) avant que l&#039;acheteur ne soit redirig&eacute; automatiquement vers votre site lorsque le paiement a r&eacute;ussi.');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_MESSAGE_TITLE', 'Message avant redirection (succ&egrave;s)');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_SUCCESS_MESSAGE_DESC', 'Message affich&eacute; sur la page de paiement avant redirection lorsque le paiement a r&eacute;ussi.');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_TIMEOUT_TITLE', 'Temps avant redirection (&eacute;chec)');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_TIMEOUT_DESC', 'Temps en secondes (0-300) avant que l&#039;acheteur ne soit redirig&eacute; automatiquement vers votre site lorsque le paiement a &eacute;chou&eacute;.');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_MESSAGE_TITLE', 'Message avant redirection (&eacute;chec)');
define('MODULE_PAYMENT_PAYZEN_REDIRECT_ERROR_MESSAGE_DESC', 'Message affich&eacute; sur la page de paiement avant redirection, lorsque le paiement a &eacute;chou&eacute;.');
define('MODULE_PAYMENT_PAYZEN_RETURN_MODE_TITLE', 'Mode de retour');
define('MODULE_PAYMENT_PAYZEN_RETURN_MODE_DESC', 'Fa&ccedil;on dont l&#039;acheteur transmettra le r&eacute;sultat du paiement lors de son retour &agrave; la boutique.');
define('MODULE_PAYMENT_PAYZEN_ORDER_STATUS_TITLE', 'Statut des commandes');
define('MODULE_PAYMENT_PAYZEN_ORDER_STATUS_DESC', 'Statut des commandes dont le paiement a r&eacute;ussi.');

## ADMINISTRATION INTERFACE - MISC CONSTANTS ##
define('MODULE_PAYMENT_PAYZEN_VALUE_FALSE', 'Non');
define('MODULE_PAYMENT_PAYZEN_VALUE_TRUE', 'Oui');

define('MODULE_PAYMENT_PAYZEN_VALIDATION_', 'Configuration Back Office PayZen');
define('MODULE_PAYMENT_PAYZEN_VALIDATION_0', 'Automatique');
define('MODULE_PAYMENT_PAYZEN_VALIDATION_1', 'Manuel');

define('MODULE_PAYMENT_PAYZEN_LANGUAGE_FRENCH', 'Fran&ccedil;ais');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_GERMAN', 'Allemand');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_ENGLISH', 'Anglais');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_SPANISH', 'Espagnol');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_CHINESE', 'Chinois');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_ITALIAN', 'Italien');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_JAPANESE', 'Japonais');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_PORTUGUESE', 'Portugais');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_DUTCH', 'N&eacute;erlandais');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_SWEDISH', 'Su&eacute;dois');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_RUSSIAN', 'Russe');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_TURKISH', 'Turc');
define('MODULE_PAYMENT_PAYZEN_LANGUAGE_POLISH', 'Polonais');

#ADMINISTRATION INTERFACE EXTRA ORDER INFORMATIONS
define('MODULE_PAYMENT_PAYZEN_PAYMENT_MEAN', 'Moyen de paiement');
define('MODULE_PAYMENT_PAYZEN_PAYMENT_CARD_BRAND_BUYER_CHOICE', 'Marque de carte choisie par l&#039;acheteur');
define('MODULE_PAYMENT_PAYZEN_PAYMENT_CARD_BRAND_DEFAULT_CHOICE','Marque de carte par d&eacute;faut utilis&eacute;e');
define('MODULE_PAYMENT_PAYZEN_TRANSACTION_ID', 'Num&eacute;ro de transaction');
define('MODULE_PAYMENT_PAYZEN_CARD_NUMBER', 'Num&eacute;ro de carte');
define('MODULE_PAYMENT_PAYZEN_EXPIRATION_DATE', 'Date d&#039;expiration');
