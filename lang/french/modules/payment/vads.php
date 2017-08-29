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
define('MODULE_PAYMENT_VADS_TEXT_TITLE','PayZen - paiement par carte bancaire');
define('MODULE_PAYMENT_VADS_TEXT_DESCRIPTION', "PAIMENT PAR CB VIA PayZen");

## ADMINISTRATION INTERFACE - INFORMATIONS ##
define('MODULE_PAYMENT_VADS_MODULE_INFORMATION', "Informations sur le module");
define('MODULE_PAYMENT_VADS_DEVELOPED_BY', "Développé par : ");
define('MODULE_PAYMENT_VADS_CONTACT_EMAIL', "Courriel de contact : ");
define('MODULE_PAYMENT_VADS_CONTRIB_VERSION', "Version du module : ");
define('MODULE_PAYMENT_VADS_GATEWAY_VERSION', "Version de la plateforme : ");
define('MODULE_PAYMENT_VADS_CMS_VERSION', "Testé avec : ");
define('MODULE_PAYMENT_VADS_SILENT_URL', "Url serveur à copier dans l'outil de gestion de caisse : ");


define('MODULE_PAYMENT_VADS_CONTRIB_TITLE',"Version du module");

define('MODULE_PAYMENT_VADS_TEXT_ERROR_MESSAGE', "Votre paiement n'a pas pu être confirmé.");

define('MODULE_PAYMENT_VADS_CHECK_URL_NOT_CALLED_ERROR_MESSAGE', "Avertissement mode TEST : la commande a bien été enregistrée mais la validation automatique n'a pas fonctionné. Avez-vous configuré correctement l'url serveur dans l'outil de gestion de caisse PayZen");

## ADMINISTRATION PARAMETERS ##
define('MODULE_PAYMENT_VADS_GATEWAY_TITLE', "Plateforme de paiement");
define('MODULE_PAYMENT_VADS_GATEWAY_DESC', "Nom de la plateforme de paiement à laquelle vous avez souscrit");

define('MODULE_PAYMENT_VADS_URL_GATEWAY_TITLE', "Url de la plateforme");
define('MODULE_PAYMENT_VADS_URL_GATEWAY_DESC', "Url vers laquelle le client sera redirigé pour le paiement");

define('MODULE_PAYMENT_VADS_COMPANY_TITLE', "Le Nom de votre SOCIETE");
define('MODULE_PAYMENT_VADS_COMPANY_DEFAULT', "Société");
define('MODULE_PAYMENT_VADS_COMPANY_DESC', "Entrer le nom de votre Société");

define('MODULE_PAYMENT_VADS_STATUS_TITLE', "Activer le module de paiement VADS");
define('MODULE_PAYMENT_VADS_STATUS_DESC', "Voulez-vous accepter ce mode de paiement");

define('MODULE_PAYMENT_VADS_SITE_ID_TITLE', "Identifiant Site");
define('MODULE_PAYMENT_VADS_SITE_ID_DESC', "Identifiant fourni par votre banque");

define('MODULE_PAYMENT_VADS_MODE_TITLE', "Mode");
define('MODULE_PAYMENT_VADS_MODE_DESC', "Mode de fonctionnement du module");

define('MODULE_PAYMENT_VADS_DELAY_TITLE', "Délai avant remise en banque");
define('MODULE_PAYMENT_VADS_DELAY_DESC', "Le nombre de jours avant la remise en banque (paramétrable sur votre back office PayZen)");

define('MODULE_PAYMENT_VADS_LANGAGE_TITLE', "Langage par défaut");
define('MODULE_PAYMENT_VADS_LANGAGE_DESC', "Langages disponibles : DE (allemand),ZN (chinois),EN (anglais),ES (espagnol),FR (français),IT (italien),JA (japonais)");

define('MODULE_PAYMENT_VADS_CARTE_TITLE', "Type de carte");
define('MODULE_PAYMENT_VADS_CARTE_DESC', "Le(s) type(s) de carte pouvant être utilisé(s) pour le paiement, séparés par des points-virgules");

define('MODULE_PAYMENT_VADS_TYPE_PAIEMENT_TITLE', "Type de paiement");
define('MODULE_PAYMENT_VADS_TYPE_PAIEMENT_DESC', "Ce module ne gère que le paiement en une seule fois (SINGLE)");

define('MODULE_PAYMENT_VADS_MODE_VALIDATION_TITLE', "Mode de validation");
define('MODULE_PAYMENT_VADS_MODE_VALIDATION_DESC', "2 types sont possibles : automatique(0), ou manuelle(1) (Configurable sur le back office PayZen)");

define('MODULE_PAYMENT_VADS_URL_UNAUTHORIZED_TITLE', "URL en cas de refus d\'autorisation");
define('MODULE_PAYMENT_VADS_URL_UNAUTHORIZED_DESC', "URL sur lequel le client sera redirigé en cas de refus d\'autorisation");

define('MODULE_PAYMENT_VADS_REDIRECT_ENABLED_TITLE', "Redirection automatique");
define('MODULE_PAYMENT_VADS_REDIRECT_ENABLED_DESC', "Si activée, le client sera redirigé automatiquement vers votre site à la fin du processus de paiement");

define('MODULE_PAYMENT_VADS_REDIRECT_SUCCESS_TIMEOUT_TITLE', "Temps avant redirection (succès)");
define('MODULE_PAYMENT_VADS_REDIRECT_SUCCESS_TIMEOUT_DESC', "Temps en secondes (0-300) avant que le client ne soit redirigé automatiquement vers votre site lorsque le paiement a réussi");
define('MODULE_PAYMENT_VADS_REDIRECT_SUCCESS_MESSAGE_TITLE', "Message avant redirection (succès)");
define('MODULE_PAYMENT_VADS_REDIRECT_SUCCESS_MESSAGE_DESC', "Message affiché sur la plateforme de paiement avant redirection lorsque le paiement a réussi");
define('MODULE_PAYMENT_VADS_REDIRECTION_SUCCESS_MESSAGE_DEFAULT', "Votre paiement a bien été pris en compte, vous allez être redirigé dans quelques instants");

define('MODULE_PAYMENT_VADS_REDIRECT_ERROR_TIMEOUT_TITLE', "Temps avant redirection (échec)");
define('MODULE_PAYMENT_VADS_REDIRECT_ERROR_TIMEOUT_DESC', "Temps en secondes (0-300) avant que le client ne soit redirigé automatiquement vers votre site lorsque le paiement a échoué");
define('MODULE_PAYMENT_VADS_REDIRECT_ERROR_MESSAGE_TITLE', "Message avant redirection (échec)");
define('MODULE_PAYMENT_VADS_REDIRECT_ERROR_MESSAGE_DESC', "Message affiché sur la plateforme de paiement avant redirection, lorsque le paiement a échoué");
define('MODULE_PAYMENT_VADS_REDIRECTION_ERROR_MESSAGE_DEFAULT', "Une erreur est survenue, vous allez être redirigé dans quelques instants");
/*
define('MODULE_PAYMENT_VADS_URL_REFUSED_TITLE', "URL en cas d\'autre refus");
define('MODULE_PAYMENT_VADS_URL_REFUSED_DESC', "URL sur lequel le client sera redirigé en cas d\'autre refus");

define('MODULE_PAYMENT_VADS_URL_CANCEL_TITLE', "URL en cas d\'annulation");
define('MODULE_PAYMENT_VADS_URL_CANCEL_DESC', "URL sur lequel le client sera redirigé en cas d\'annulation");

define('MODULE_PAYMENT_VADS_URL_ERROR_TITLE', "URL en cas d\'erreur");
define('MODULE_PAYMENT_VADS_URL_ERROR_DESC', "URL sur lequel le client sera redirigé en cas d\'erreur");
*/
define('MODULE_PAYMENT_VADS_REDIRECTION_OSC_ERROR_MESSAGE',"Le processus de paiement a échoué, votre commande n'a pas été enregistrée");

define('MODULE_PAYMENT_VADS_RETURN_MODE_TITLE', 'Mode de retour');
define('MODULE_PAYMENT_VADS_RETURN_MODE_DESC', 'Façon dont le client transmettra le résultat du paiement lors de son retour sur la boutique');

define('MODULE_PAYMENT_VADS_URL_DEFAUT_TITLE', "URL de retour à la boutique");
define('MODULE_PAYMENT_VADS_URL_DEFAUT_DESC', "URL où sera redirigé le client après avoir cliqué sur \"retour à la boutique\" si le paiement échoue");

define('MODULE_PAYMENT_VADS_URL_SUCCES_TITLE', "URL de retour en cas de succès");
define('MODULE_PAYMENT_VADS_URL_SUCCES_DESC', "URL sur lequel le client sera redirigé après avoir cliqué sur \"retour à la boutique\" si le paiement réussit");

define('MODULE_PAYMENT_VADS_KEY_TEST_TITLE', "Certificat en mode test");
define('MODULE_PAYMENT_VADS_KEY_TEST_DESC', "Certificat fourni par PayZen (Disponible sur l'outil de gestion de caisse)");
define('MODULE_PAYMENT_VADS_KEY_PROD_TITLE', "Certificat en mode production");
define('MODULE_PAYMENT_VADS_KEY_PROD_DESC', "Certificat fourni par PayZen (Disponible sur l'outil de gestion de caisse)");

define('MODULE_PAYMENT_VADS_SORT_ORDER_TITLE', "Ordre d\'affichage");
define('MODULE_PAYMENT_VADS_SORT_ORDER_DESC', "Le chiffre le plus petit apparaitra en premier");

define('MODULE_PAYMENT_VADS_ZONE_TITLE', "Zone de paiement");
define('MODULE_PAYMENT_VADS_ZONE_DESC', "Si une zone est choisie, ce mode de paiement ne sera effectif que pour celle-ci.");

define('MODULE_PAYMENT_VADS_ORDER_STATUS_ID_TITLE', "Statut des commandes");
define('MODULE_PAYMENT_VADS_ORDER_STATUS_ID_DESC', "Definir le statut des commandes payées par ce mode de paiement");

?>