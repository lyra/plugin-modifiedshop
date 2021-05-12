<?php
/**
 * Copyright © Lyra Network.
 * This file is part of PayZen plugin for modified eCommerce Shopsoftware. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL v2)
 */

defined ('_VALID_XTC') or die ('Direct Access to this location is not allowed.');

if ($order->info['payment_method'] == 'payzen') {
    if (file_exists(DIR_FS_CATALOG . DIR_WS_MODULES . 'payment/' . $order->info['payment_method'] . '.php')) {
        include (DIR_FS_CATALOG . DIR_WS_MODULES . 'payment/' . $order->info['payment_method'] . '.php');
        include (DIR_FS_CATALOG . 'lang/' . $order->info['language'] . '/modules/payment/' . $order->info['payment_method'] . '.php');
        $payment = new payzen();
        $payment->admin_order($oID, $_SESSION['language_code']);
    }
}
