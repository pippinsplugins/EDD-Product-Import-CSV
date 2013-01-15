<?php
/**
 * Install Function
 *
 * @package     Easy Digital Downloads - CSV Import
 * @subpackage  Install Function
 * @copyright   Copyright (c) 2012, Daniel Espinoza
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
*/


/**
 * CSV Import Install
 *
 * Runs on plugin install.
 *
 * @access      private
 * @since       1.0
 * @return      void
*/

function edd_csv_import_csv_install() {
	global $wpdb, $edd_options;


}
register_activation_hook( EDD_CSVIMPORT_FILE, 'edd_csv_import_csv_install' );
