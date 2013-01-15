<?php
/**
 * Import Functions
 *
 * @package     Easy Digital Downloads - CSV Import
 * @subpackage  Import Functions
 * @copyright   Copyright (c) 2012, Daniel Espinzoa
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
*/


/**
 * Show File Upload
 *
 * @access      public
 * @since       1.0
 * @return      void
*/

function edd_show_file_upload_form() {
	global $edd_import_field_mapping, $edd_import_file_columns, $edd_message;

	if ( $edd_message != '') { ?>
	<div id="" class="updated settings-error">
		<p><strong><?php echo $edd_message ?></strong></p>
	</div>
	<?php } ?>
	<h3><?php  _e('Import Downloads From A CSV File', 'edd') ?></h3>
	<p>
		<?php _e('To import downloads select a valid CSV file and press Import File.  Results  of the import will be displayed in the log area below.', 'edd') ?>
	</p>
	<p>
		<?php
		$link = '<a href="' . get_admin_url() . 'edit.php?post_type=download&page=edd-settings&tab=misc" >' . __('CSV Import Mapping', 'edd') . '</a>';
		echo sprintf( __('The mapping of download fields to CSV columns can be adjusted in the %s section.','edd'), $link );
		?>
	</p>
	<form method="post" enctype="multipart/form-data">
		<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><?php _e('Import File','edd') ?></th>
				<td><input type="file" id="import_file" name="import_file" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e('Validate File Only','edd') ?></th>
				<td><input type="checkbox" id="check_file" name="check_file" /> <?php _e('Check file, but do not save downloads to the database.','edd') ?></td>
			</tr>
		</tbody>
		</table>
		<?php
			$edd_generate_mapping_nonce = wp_create_nonce('edd_generate_mapping');
		?>
		<input type="hidden" name="_wpnonce" value="<?php echo $edd_generate_mapping_nonce  ?>" />
		<input type="hidden" name="edd-action" value="import_csv" />
		<p>
			<input type="submit" name="" id="" class="button-secondary action" value="<?php _e('Import File','edd'); ?>" />
		</p>
	</form>

	<?php
}


/**
 * Show Import Log
 *
 * @access      public
 * @param 		edd_log_file - The log file to display
 * @since       1.0
 * @return      void
*/

function edd_show_import_log() {
	global $edd_log_file;
	?>
	<strong>Output Log</strong><br/>
	<textarea style="width: 650px; height: 150px" ><?php echo $edd_log_file ?></textarea>
	<?php
}



/**
 * Setup Upload Directories
 *
 * Patterned after edd_change_downloads_upload_dir() located in includes/upload-functions.php
 * @access      public
 * @since       1.0
 * @return      void
*/
function edd_setup_upload_dirs() {

    $wp_upload_dir = wp_upload_dir();
    $upload_path = $wp_upload_dir['basedir'] . '/edd' . $wp_upload_dir['subdir'];

    // We don't want users snooping in the EDD root, so let's add htacess there, first
    // Creating the directory if it doesn't already exist.
    $rules = 'Options -Indexes';
    if( ! @file_get_contents( $wp_upload_dir['basedir'] . '/edd/.htaccess' ) ) {
    	wp_mkdir_p( $wp_upload_dir['basedir'] . '/edd' );
    } // end if
    @file_put_contents( $wp_upload_dir['basedir'] . '/edd/.htaccess', $rules );

    // now add blank index.php files to the {year}/{month} directory
    if ( wp_mkdir_p( $upload_path ) ) {

        $folder = '.';
        if( !file_exists( $folder . 'index.php' ) ) {
            @file_put_contents( $folder . 'index.php', '<?php' . PHP_EOL . '// silence is golden' );
        }

    }

}

/**
 * Import CSV File
 *
 * @access      public
 * @since       1.0
 * @return      void
*/
function edd_import_csv_file() {
	global $edd_options, $edd_log_file;

	$file_name = $_FILES['import_file']['name'];
	$edd_log_file = sprintf( __('Starting import of file: %s' , 'edd'), $file_name ) . "\n";

	if ( is_file($_FILES['import_file']['tmp_name'])) {
		if ( ($handle = fopen( $_FILES['import_file']['tmp_name'], "r")) !== FALSE ) {

			$row_ctr=0;
			while (($line = fgetcsv($handle, 1000,",")) !== FALSE ) {

				$row_ctr++;

				// skip header row
				if ( $row_ctr > 1 ) {

					// get the current post's data from the mapped column
					$edd_author_id 		= isset( $edd_options['edd_import_post_author'] ) 		 ? $line[ $edd_options['edd_import_post_author'] ]        : $line[0];
					$edd_date_created 	= isset( $edd_options['edd_import_post_date'] ) 		 ? $line[ $edd_options['edd_import_post_date'] ]          : $line[1];
					$edd_description 	= isset( $edd_options['edd_import_post_content'] ) 		 ? $line[ $edd_options['edd_import_post_content'] ]       : $line[2];
					$edd_download_name	= isset( $edd_options['edd_import_post_title'] ) 		 ? $line[ $edd_options['edd_import_post_title'] ]         : $line[3];
					$edd_excerpt		= isset( $edd_options['edd_import_post_excerpt'] ) 		 ? $line[ $edd_options['edd_import_post_excerpt'] ]       : $line[4];
					$edd_status			= isset( $edd_options['edd_import_post_status'] ) 		 ? $line[ $edd_options['edd_import_post_status'] ]        : $line[5];
					$edd_post_name		= isset( $edd_options['edd_import_post_name'] ) 		 ? $line[ $edd_options['edd_import_post_name'] ]          : $line[6];
					$edd_price			= isset( $edd_options['edd_import_edd_price'] ) 		 ? $line[ $edd_options['edd_import_edd_price'] ]          : $line[7];
					$edd_files			= isset( $edd_options['edd_import_download_files'] ) 	 ? $line[ $edd_options['edd_import_download_files'] ]     : $line[8];
					$edd_limit			= isset( $edd_options['edd_import_download_limit'] ) 	 ? $line[ $edd_options['edd_import_download_limit'] ]     : $line[9];
					$edd_hide_link		= isset( $edd_options['edd_import_hide_purchase_link'] ) ? $line[ $edd_options['edd_import_hide_purchase_link'] ] : $line[10];
					$edd_images			= isset( $edd_options['edd_import_images']) 			 ? $line[ $edd_options['edd_import_images'] ]             : $line[11];
					$edd_categories		= isset( $edd_options['edd_import_categories'] ) 		 ? $line[ $edd_options['edd_import_categories'] ]         : $line[12];
					$edd_tags			= isset( $edd_options['edd_import_tags'] ) 				 ? $line[ $edd_options['edd_import_tags'] ]               : $line[13];

					// check for valid data
					$validation_error = false;
					$validation_msg  = '';
					// author exists
					if ( ! get_user_by( 'id', $edd_author_id ) ) {
						$validation_error = true;
						$validation_msg  .= sprintf(__('Author does not exist with ID: %d', 'edd'), $edd_author_id) . "; ";
					}
					// date valid format
					if ( ! strtotime( $edd_date_created ) ) {
						$validation_error = true;
						$validation_msg  .= sprintf(__('Date validation failed for string: %s', 'edd'), $edd_date_created) . "; ";
					}
					// download name  blank
					if ( 0 == strlen( $edd_download_name ) ) {
						$validation_error = true;
						$validation_msg  .= __('Download Name is blank.', 'edd') . "; ";
					}

					// status one of 'publish','draft','pending'
					$_status = array('publish','draft','pending');
					if ( ! in_array( $edd_status, $_status ) ) {
						$validation_error = true;
						$validation_msg  .= __('Status needs to be one publish, draft or pending', 'edd') . "; ";
					}


					if ( $validation_error ) {
						// report error and loop
						$edd_log_file .= sprintf( __('Error importing row %d: ', 'edd'), $row_ctr)  . $validation_msg . "\n" ;
					} else {

						if ( isset($_POST['check_file'] ) && ( $_POST['check_file'] == 'on' ) ) {

							$edd_log_file .= sprintf(__('Successfully validated row: %d', 'edd'), $row_ctr ) . "\n";

						} else {

							// add post
							// setup post args
							$new_download_args = array(
								'post_type' 	 => 'download',
								'comment_status' => 'closed',
								'ping_status' 	 => 'closed',
								'post_author' 	 => $edd_author_id,
								'post_name' 	 => $edd_post_name,
								'post_title' 	 => $edd_download_name,
								'post_status' 	 => $edd_status,
								'post_excerpt' 	 => $edd_excerpt,
								'post_date' 	 => $edd_date_created,
								'post_content' 	 => $edd_description,
								'post_parent' 	 => 0,
							);
							$new_download_id = wp_insert_post( $new_download_args , true );

							if ( is_wp_error( $new_download_id ) ) {

								$edd_log_file .= sprintf( __('Error importing row %d: ', 'edd'), $row_ctr) . $new_download_id->get_error_message() ;

							} else {

								// Setup categories
								$_edd_categories = explode( "|", $edd_categories );
								edd_check_taxonomy( $_edd_categories, 'download_category' );
								$category_add_action = wp_set_object_terms( $new_download_id, $_edd_categories, 'download_category' );

								if ( is_wp_error( $category_add_action ) ) {
									$edd_log_file .= sprintf(__('Error adding categories to post (%s)', 'edd'), $new_download_id ) . $category_add_action->get_error_message() . "\n";
								}

								// Setup tags
								$_edd_tags = explode( "|", $edd_tags );
								edd_check_taxonomy( $_edd_tags, 'download_tag' );
								$tag_add_action = wp_set_object_terms( $new_download_id, $_edd_tags, 'download_tag' );
								if ( is_wp_error( $tag_add_action ) ) {
									$edd_log_file .= sprintf(__('Error adding tags to post (%s)', 'edd'), $new_download_id ) . $tag_add_action->get_error_message();
								}


								// Add post meta
								add_post_meta( $new_download_id, 'edd_price', $edd_price );
								add_post_meta( $new_download_id, 'edd_product_notes', '' );
								add_post_meta( $new_download_id, '_edd_download_limit', $edd_limit );
								add_post_meta( $new_download_id, '_edd_hide_purchase_link', $edd_hide_link );

								// variable prices not supported at the moment
								add_post_meta( $new_download_id, 'edd_variable_prices', '' );

								// setup custom edd file upload destination
								edd_setup_upload_dirs();

					            $wp_upload_dir = wp_upload_dir();
					            $edd_upload_path = $wp_upload_dir['basedir'] . '/edd' . $wp_upload_dir['subdir'];
								// Add images. Will look for images in the /wp-content/uploads directory
								$_edd_images = explode( "|", $edd_images );
								$image_ctr = 0;

								foreach ( $_edd_images as $key => $filename ) {
									$image_ctr++;
									$filename = trim( $filename );
									$image_file = trailingslashit( $wp_upload_dir['basedir'] ) . $filename ;

									if ( file_exists( $image_file ) ) {

										$image_url 	= str_replace( trailingslashit( ABSPATH ), trailingslashit( site_url() ), $image_file );
										$wp_filetype = wp_check_filetype( $image_file, null );

										$attachment = array(
											'guid' => $image_url,
											'post_mime_type' => $wp_filetype['type'],
											'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
											'post_content' => '',
											'post_status' => 'inherit',
											'post_parent' => $new_download_id
										);

										$attach_id = wp_insert_attachment( $attachment, $filename, $new_download_id );

										if ( ! is_wp_error( $attach_id ) && $attach_id ) {
											if ( 1 == $image_ctr )
												update_post_meta( $new_download_id, '_thumbnail_id', $attach_id );

											require_once(ABSPATH . 'wp-admin/includes/image.php');
											$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
											wp_update_attachment_metadata( $attach_id, $attach_data );
										} else {
											$edd_log_file .= sprintf(__('Error adding image attachment: %s', 'edd'), $attachment_id->get_error_message() ) . "\n";
										}


										$edd_log_file .= sprintf(__('Added image: %s', 'edd'), $filename ) . "\n";

									} else {
										$edd_log_file .= sprintf(__('Error: Image file not found in uploads directory (%s)', 'edd'), $filename ) . "\n";
									}

								}

								// setup downloads
								$_edd_files    = explode( "|", $edd_files );
					            $new_files     = array();

								if ( count( $_edd_files ) > 0 ) {

									// for each file get name and move to path
									foreach ( $_edd_files as $edd_file_name ) {

										$_source_location = trailingslashit( $wp_upload_dir['basedir'] ) . $edd_file_name;
										if ( file_exists( $_source_location ) ) {

											$_dest_location = trailingslashit( $edd_upload_path ) . $edd_file_name;
											if ( copy ( $_source_location, $_dest_location ) ) {

												$new_files[] = array( 'name'      => $edd_file_name,
																      'file'      => $_dest_location,
																      'condition' => 'all' );

												$edd_log_file .= sprintf(__('Added download: %s', 'edd'), $edd_file_name ) . "\n";
											} else {
												// copy file error
												$edd_log_file .= sprintf(__('Error moving download file to edd location: %s', 'edd'), $edd_file_name ) . "\n";
											}
										} else {
											// file doesn't exist
											$edd_log_file .= sprintf(__('Error adding download, File not found in /wp-content/uploads: %s', 'edd'), $edd_file_name ) . "\n";
										}
									}
									add_post_meta( $new_download_id, 'edd_download_files', $new_files );


								} else {
									$edd_log_file .= __('No downloads added for this row', 'edd') . "\n";
								}

								$edd_log_file .= sprintf(__('Successfully added download: %s', 'edd'), $edd_download_name ) . "\n";

							} // if ( $wp_error )

						} // if ( just validating )

					} // if ( $validation_error )

				} // if ( $row_ctr )

			} // while()

		} else {

			$edd_log_file .= __('Error opening file uploaded.','edd');
		}

	} else {

		$edd_log_file .= __('Error opening file uploaded.', 'edd');
	}


}

/**
 * Check Taxonomy
 *
 * Check supplied taxonomy for the terms.  If term don't exist, then add it.
 *
 * @access      public
 * @param 		$_edd_terms - array of catgories
 * @param 		$_edd_taxonomy - taxonomy to check against
 * @since       1.0
 * @return      void
*/
function edd_check_taxonomy( $_edd_terms, $_edd_taxonomy ) {

	foreach ( $_edd_terms as $_the_term ){
		if ( $term = term_exists( $_the_term, $_edd_taxonomy) ) {
			// term already exists
		} else {
			wp_insert_term( $_the_term, $_edd_taxonomy );
		}
	}
}

