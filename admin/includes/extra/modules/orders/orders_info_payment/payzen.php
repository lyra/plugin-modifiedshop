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
defined ('_VALID_XTC') or die ('Direct Access to this location is not allowed.');

if ($order->info['payment_method'] == 'payzen') {
	if (file_exists(DIR_FS_CATALOG . DIR_WS_MODULES . 'payment/' . $order->info['payment_method'] . '.php')) {
		include (DIR_FS_CATALOG . DIR_WS_MODULES . 'payment/' . $order->info['payment_method'] . '.php');
		include (DIR_FS_CATALOG . 'lang/' . $order->info['language'] . '/modules/payment/' . $order->info['payment_method'] . '.php');
		$payment = new payzen();
		$payment->admin_order($oID, $_SESSION['language_code']);
	}
}