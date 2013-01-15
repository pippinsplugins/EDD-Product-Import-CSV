<?php
/**
 * Admin Page
 *
 * @package     Easy Digital Downloads - CSV Import
 * @subpackage  Admin Page
 * @copyright   Copyright (c) 2012, Daniel Espinoza
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
*/


/**
 * Add Options Link
 *
 * Creates the admin submenu page for CSV Import.
 *
 * @access      private
 * @since       1.0
 * @return      void
*/

function edd_csv_import_menu() {
	global $edd_csv_import_page;

	$edd_csv_import_page = add_submenu_page( 'edit.php?post_type=download', __('Easy Digital Download CSV Import', 'edd'), __('CSV Import', 'edd'), 'manage_options', 'edd-csv-import', 'edd_csv_import_page' );

}
add_action( 'admin_menu', 'edd_csv_import_menu', 10 );


/**
 * CSV Import Page
 *
 * Shows the cdv import settings and import button.
 *
 * @access      public
 * @since       1.0
 * @return      void
*/
function edd_csv_import_page() {
	global $edd_options;

	?>
	<div class="wrap">
		<h2><?php _e('CSV Import', 'edd'); ?></h2>
		<?php

			do_action('edd_csv_import_top');

			// The upload form
			edd_show_file_upload_form();

			edd_show_import_log();

			do_action('edd_csv_import_bottom');
		?>
	</div><!--end wrap-->
	<?php
}
