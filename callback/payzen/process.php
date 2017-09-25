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

/**
 * This file is an access point to standard checkout_process.php.
 */

// restore session if this is a server call.
if(key_exists('vads_hash', $_POST) && isset($_POST['vads_hash']) && key_exists('vads_order_info', $_POST) && isset($_POST['vads_order_info'])) {
	$parts = explode('&', $_POST['vads_order_info']);
	$sname = substr($parts[0], strlen('session_name='));
	$sid = substr($parts[1], strlen('session_id='));

	$_POST[$sname] = $sid;

	// for cookie based sessions ...
	$_COOKIE[$sname] = $sname;
	$_COOKIE['cookie_test'] = 'please_accept_for_session';

	// then we launch the standard checkout_process
	chdir('../../');
	require_once 'checkout_process.php';
}