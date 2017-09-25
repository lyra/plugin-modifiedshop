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
define('MODULE_PAYMENT_PAYZEN_TECHNICAL_ERROR', 'Une erreur est survenue dans le processus de paiement.');
define('MODULE_PAYMENT_PAYZEN_PAYMENT_ERROR', 'Votre commande n&#039;a pas pu &ecirc;tre confirm&eacute;e. Le paiement n&#039;a pas &eacute;t&eacute; accept&eacute;.');
define('MODULE_PAYMENT_PAYZEN_CHECK_URL_WARN', 'La validation automatique n&#039;a pas fonctionn&eacute;. Avez-vous configur&eacute; correctement l&#039;URL de notification dans le Back Office PayZen ?');
define('MODULE_PAYMENT_PAYZEN_CHECK_URL_WARN_DETAIL', 'Afin de comprendre la probl&eacute;matique, reportez vous &agrave; la documentation du module :<br />&nbsp;&nbsp;&nbsp;- Chapitre &laquo;A lire attentivement avant d&#039;aller loin&raquo;<br />&nbsp;&nbsp;&nbsp;- Chapitre &laquo;Param&eacute;trage de l&#039;URL de notification&raquo;.');
define('MODULE_PAYMENT_PAYZEN_GOING_INTO_PROD_INFO', '<b>PASSAGE EN PRODUCTION :</b> Vous souhaitez savoir comment passer votre boutique en production, merci de consulter cette URL : ');
define('MODULE_PAYMENT_PAYZEN_TEXT_TITLE', 'PayZen');
define('MODULE_PAYMENT_PAYZEN_TEXT_DESCRIPTION', 'Paiement par carte bancaire');
define('MODULE_PAYMENT_PAYZEN_INFORMATION_TITLE', 'Information');
define('MODULE_PAYMENT_PAYZEN_WARNING_TITLE', 'Avertissement');

## ADMINISTRATION INTERFACE - INFORMATIONS ##
define('MODULE_PAYMENT_PAYZEN_MODULE_INFORMATION', 'INFORMATIONS SUR LE MODULE');
define('MODULE_PAYMENT_PAYZEN_DEVELOPED_BY', 'D&eacute;velopp&eacute; par : ');
define('MODULE_PAYMENT_PAYZEN_CONTACT_EMAIL', 'Courriel de contact : ');
define('MODULE_PAYMENT_PAYZEN_CONTRIB_VERSION', 'Version du module : ');
define('MODULE_PAYMENT_PAYZEN_GATEWAY_VERSION', 'Version de la plateforme : ');
define('MODULE_PAYMENT_PAYZEN_IPN_URL', 'URL de notification &agrave; copier dans le Back Office PayZen: <br />');

## ADMINISTRATION INTERFACE - MODULE SETTINGS ##
define('MODULE_PAYMENT_PAYZEN_STATUS_TITLE', 'Activation');
define('MODULE_PAYMENT_PAYZEN_STATUS_DESC', 'Activer / d&eacute;sactiver le module de paiement PayZen.');
define('MODULE_PAYMENT_PAYZEN_SORT_ORDER_TITLE', 'Ordre d&#039;affichage');
define('MODULE_PAYMENT_PAYZEN_SORT_ORDER_DESC', 'Le plus petit indice est affich&eacute; en premier.');
define('MODULE_PAYMENT_PAYZEN_ZONE_TITLE', 'Zone de paiement');
define('MODULE_PAYMENT_PAYZEN_ZONE_DESC', 'Si une zone est choisie, ce mode de paiement ne sera effectif que pour celle-ci.');

## ADMINISTRATION INTERFACE - PLATFORM SETTINGS ##
define('MODULE_PAYMENT_PAYZEN_SITE_ID_TITLE', 'Identifiant boutique');
define('MODULE_PAYMENT_PAYZEN_SITE_ID_DESC', 'Identifiant fourni par PayZen.');
define('MODULE_PAYMENT_PAYZEN_KEY_TEST_TITLE', 'Certificat en mode test');
define('MODULE_PAYMENT_PAYZEN_KEY_TEST_DESC', 'Certificat fourni par PayZen pour le mode test (disponible sur le Back Office de votre boutique).');
define('MODULE_PAYMENT_PAYZEN_KEY_PROD_TITLE', 'Certificat en mode production');
define('MODULE_PAYMENT_PAYZEN_KEY_PROD_DESC', 'Certificat fourni par PayZen (disponible sur le Back Office de votre boutique apr&egrave;s passage en production).');
define('MODULE_PAYMENT_PAYZEN_CTX_MODE_TITLE', 'Mode');
define('MODULE_PAYMENT_PAYZEN_CTX_MODE_DESC', 'Mode de fonctionnement du module.');
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
define('MODULE_PAYMENT_PAYZEN_VALIDATION_MODE_DESC', 'En mode manuel, vous devrez confirmer les paiements dans le Back Office de votre boutique.');
define('MODULE_PAYMENT_PAYZEN_PAYMENT_CARDS_TITLE', 'Types de carte');
define('MODULE_PAYMENT_PAYZEN_PAYMENT_CARDS_DESC', 'Le(s) type(s) de carte pouvant &ecirc;tre utilis&eacute;(s) pour le paiement. Ne rien s&eacute;lectionner pour utiliser la configuration de la plateforme.');
define('MODULE_PAYMENT_PAYZEN_3DS_MIN_AMOUNT_TITLE', 'Montant minimum pour lequel activer 3-DS');
define('MODULE_PAYMENT_PAYZEN_3DS_MIN_AMOUNT_DESC', 'N&eacute;cessite la souscription &agrave; l&#039;option 3-D Secure s&eacute;lectif.');

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
define('MODULE_PAYMENT_PAYZEN_ORDER_STATUS_DESC', 'Definir le statut des commandes pay&eacute;es par ce mode de paiement.');

## ADMINISTRATION INTERFACE - MISC CONSTANTS ##
define('MODULE_PAYMENT_PAYZEN_VALUE_FALSE', 'Non');
define('MODULE_PAYMENT_PAYZEN_VALUE_TRUE', 'Oui');

define('MODULE_PAYMENT_PAYZEN_VALIDATION_DEFAULT', 'Configuration Back Office');
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
define('MODULE_PAYMENT_PAYZEN_TRANSACTION_ID', 'Num&eacute;ro de transaction');
define('MODULE_PAYMENT_PAYZEN_CARD_NUMBER', 'Num&eacute;ro de carte');
define('MODULE_PAYMENT_PAYZEN_EXPIRATION_DATE', 'Date d&#039;expiration');