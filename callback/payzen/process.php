<?php
/**
 * Copyright © Lyra Network.
 * This file is part of PayZen plugin for modified eCommerce Shopsoftware. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL v2)
 */

/**
 * This file is an access point to standard checkout_process.php.
 */

// Restore session if this is a server call.
if (isset($_POST['vads_hash']) && $_POST['vads_hash']
    && isset($_POST['vads_ext_info_session_name']) && $_POST['vads_ext_info_session_name']
    && isset($_POST['vads_ext_info_session_id']) && $_POST['vads_ext_info_session_id']) {

    $sname = $_POST['vads_ext_info_session_name'];
    $sid = $_POST['vads_ext_info_session_id'];

    $_POST[$sname] = $sid;

    // For cookie based sessions.
    $_COOKIE[$sname] = $sname;
    $_COOKIE['cookie_test'] = 'please_accept_for_session';

    // Then we launch the standard checkout_process.
    chdir('../../');
    require_once 'checkout_process.php';
}
