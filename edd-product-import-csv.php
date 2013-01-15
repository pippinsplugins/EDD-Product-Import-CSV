<?php
/*
Plugin Name: Easy Digital Downloads - CSV Import
Plugin URI: http://easydigitaldownloads.com
Description: Adds the ability to import downloads via a CSV file.
Author: Daniel Espinoza
Author URI: http://www.growdevelopment.com
Version: 1.0.0

Easy Digital Downloads is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Easy Digital Downloads is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Easy Digital Downloads. If not, see <http://www.gnu.org/licenses/>.
*/

/*
|--------------------------------------------------------------------------
| CONSTANTS
|--------------------------------------------------------------------------
*/

// plugin folder url
if(!defined('EDD_CSVIMPORT_URL')) {
	define('EDD_CSVIMPORT_URL', plugin_dir_url( __FILE__ ));
}
// plugin folder path
if(!defined('EDD_CSVIMPORT_DIR')) {
	define('EDD_CSVIMPORT_DIR', plugin_dir_path( __FILE__ ));
}
// plugin root file
if(!defined('EDD_CSVIMPORT_FILE')) {
	define('EDD_CSVIMPORT_FILE', __FILE__);
}

/*
|--------------------------------------------------------------------------
| GLOBALS
|--------------------------------------------------------------------------
*/
// if this is the WordPress dashboard then setup these variables.
if ( is_admin() ) {

	global $edd_import_file_columns;
	$edd_import_file_columns = array(
		"0" => "A",
		"1" => "B",
		"2" => "C",
		"3" => "D",
		"4" => "E",
		"5" => "F",
		"6" => "G",
		"7" => "H",
		"8" => "I",
		"9" => "J",
		"10" => "K",
		"11" => "L",
		"12" => "M",
		"13" => "N",
		"14" => "O",
		"15" => "P",
		"16" => "Q",
		"17" => "R",
		"18" => "S",
		"19" => "T",
		"20" => "U",
		"21" => "V",
		"22" => "W",
		"23" => "X",
		"24" => "Y",
		"25" => "Z",
		"26" => "AA",
		"27" => "BB",
		"28" => "CC",
		"29" => "DD",
		"30" => "EE",
		"31" => "FF",
		"32" => "GG",
		"33" => "HH",
		"34" => "II",
		"35" => "JJ",
		"36" => "KK",
		"37" => "LL",
		"38" => "MM",
		"39" => "NN",
		"40" => "OO",
		"41" => "PP",
		"42" => "QQ",
		"43" => "RR",
		"44" => "SS",
		"45" => "TT",
		"46" => "UU",
		"47" => "VV",
		"48" => "WW",
		"49" => "XX",
		"50" => "YY",
		"51" => "ZZ"
	);
}

/*
|--------------------------------------------------------------------------
| INCLUDES
|--------------------------------------------------------------------------
*/

include_once( EDD_CSVIMPORT_DIR . 'includes/register-settings.php' );
include_once( EDD_CSVIMPORT_DIR . 'includes/admin-actions.php' );
include_once( EDD_CSVIMPORT_DIR . 'includes/admin-page.php' );
include_once( EDD_CSVIMPORT_DIR . 'includes/import-functions.php' );
include_once( EDD_CSVIMPORT_DIR . 'includes/install.php' );
