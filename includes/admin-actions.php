<?php
/**
 * Admin Actions
 *
 * @package     Easy Digital Downloads - CSV Import
 * @subpackage  Admin Actions
 * @copyright   Copyright (c) 2012, Daniel Espinoza
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
*/


/**
 * Import CSV File
 *
 * @access      public
 * @since       1.0
 * @return      void
*/
function edd_import_process_file() {
	global $edd_message;
	$edd_message = '';

	if ( isset( $_POST['edd-action'] ) && ( $_POST['edd-action'] == 'import_csv' ) ) {

		// check for file

		if ( empty( $_FILES ) || $_FILES['import_file']['size'] == 0 ){
			$edd_message = 'Please choose a file to import.';
			return;
		}

		edd_import_csv_file();

		$edd_message = "Import completed.  Results in Output Log below.";
	}

}
add_action( 'init', 'edd_import_process_file', 10 );

