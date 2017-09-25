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
 * General functions to draw PayZen configuration parameters.
 * */
global $payzen_supported_languages, $payzen_supported_cards;

require_once DIR_FS_CATALOG.'includes/external/payzen/api.php';

$payzen_supported_languages = PayzenApi::getSupportedLanguages();
$payzen_supported_cards = PayzenApi::getSupportedCardTypes();

function payzen_cfg_pull_down_langs($value='', $name) {
	global $payzen_supported_languages;

	$name = 'configuration[' . xtc_output_string($name) . ']';
	if (empty($value) && isset($GLOBALS[$name])) $value = stripslashes($GLOBALS[$name]);

	$field = '<select name="' . $name . '">';
	foreach ($payzen_supported_languages as $key => $label) {
		$field .= '<option value="' . $key . '"';
		if ($value == $key) {
			$field .= ' selected="selected"';
		}

		$field .= '>' . xtc_output_string(payzen_get_lang_title($key)) . '</option>';
	}

	$field .= '</select>';

	return $field;
}

function payzen_cfg_pull_down_multi_langs($value='', $name) {
	global $payzen_supported_languages;

	$fieldName = 'configuration[' . xtc_output_string($name) . ']';
	if (empty($value) && isset($GLOBALS[$fieldName])) $value = stripslashes($GLOBALS[$fieldName]);

	$langs = empty($value) ? array() : explode(';', $value);

	$field = '<select name="' . xtc_output_string($name) . '" multiple="multiple" onChange="JavaScript:payzenProcessLangs()">';
	foreach ($payzen_supported_languages as $key => $label) {
		$field .= '<option value="' . $key . '"';
		if (in_array($key, $langs)) {
			$field .= ' selected="selected"';
		}

		$field .= '>' . xtc_output_string(payzen_get_lang_title($key)) . '</option>';
	}
	$field .= '</select> <br />';

	$field .= <<<JSCODE
	<script type="text/javascript">
		function payzenProcessLangs() {
			var elt = document.forms['modules'].elements['$name'];

			var result = '';
			for (var i=0; i < elt.length; i++) {
				if(elt[i].selected) {
					if(result != '') result += ';';
					result += elt[i].value;
				}
			}

			document.forms['modules'].elements['$fieldName'].value = result;
		}
	</script>
JSCODE;

	$field .= '<input type="hidden" name="' . xtc_output_string($fieldName) . '" value="' . $value . '">';

	return $field;
}

function payzen_cfg_pull_down_validation_modes($value='', $name) {
	$name = 'configuration[' . xtc_output_string($name) . ']';

	if (empty($value) && isset($GLOBALS[$name])) $value = stripslashes($GLOBALS[$name]);
	$modes = array('', '0', '1');

	$field = '<select name="' . $name . '">';
	foreach ($modes as $mode) {
		$field .= '<option value="' . $mode . '"';
		if ($value == $mode) {
			$field .= ' selected="selected"';
		}

		$field .= '>' . xtc_output_string(payzen_get_validation_mode_title($mode)) . '</option>';
	}

	$field .= '</select>';

	return $field;
}

function payzen_cfg_pull_down_cards($value='', $name) {
	global $payzen_supported_cards;

	$fieldName = 'configuration[' . xtc_output_string($name) . ']';
	if (empty($value) && isset($GLOBALS[$fieldName])) $value = stripslashes($GLOBALS[$fieldName]);

	$cards = empty($value) ? array() : explode(';', $value);

	$field = '<select name="' . xtc_output_string($name) . '" multiple="multiple" onChange="JavaScript:payzenProcessCards()">';
	foreach ($payzen_supported_cards as $key => $label) {
		$field .= '<option value="' . $key . '"';
		if (in_array($key, $cards)) {
			$field .= ' selected="selected"';
		}

		$field .= '>' . xtc_output_string($label) . '</option>';
	}
	$field .= '</select> <br />';

	$field .= <<<JSCODE
	<script type="text/javascript">
		function payzenProcessCards() {
			var elt = document.forms['modules'].elements['$name'];

			var result = '';
			for (var i=0; i < elt.length; i++) {
				if(elt[i].selected) {
					if(result != '') result += ';';
					result += elt[i].value;
				}
			}

			document.forms['modules'].elements['$fieldName'].value = result;
		}
	</script>
JSCODE;

	$field .= '<input type="hidden" name="' . xtc_output_string($fieldName) . '" value="' . $value . '">';

	return $field;
}

function payzen_get_title($prefix, $value) {
	$key = 'MODULE_PAYMENT_PAYZEN_' . strtoupper($prefix . '_' . $value);

	return defined($key) ? constant($key) : $value;
}

function payzen_get_text_title($value) {
	return payzen_get_title('value', $value);
}

function payzen_get_lang_title($value) {
	global $payzen_supported_languages;

	return payzen_get_title('language', $payzen_supported_languages[$value]);
}

function payzen_get_multi_lang_title($value) {
	if(!empty($value)) {
		$langs = explode(';', $value);

		$result = array();
		foreach ($langs as $lang) {
			$result[] = payzen_get_lang_title($lang);
		}

		return implode(', ', $result);
	} else {
		return '';
	}
}

function payzen_get_validation_mode_title($value) {
	return payzen_get_title('validation', $value);
}

function payzen_get_card_title($value) {
	global $payzen_supported_cards;

	if(!empty($value)) {
		$cards = explode(';', $value);

		$result = array();
		foreach ($cards as $card) {
			$result[] = $payzen_supported_cards[$card];
		}

		return implode(', ', $result);
	} else {
		return '';
	}
}