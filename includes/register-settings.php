<?php
/**
 * Register Settings
 *
 * @package     Easy Digital Downloads - CSV Import
 * @subpackage  Register Settings
 * @copyright   Copyright (c) 2012, Daniel Espinoza (daniel@growdevelopment.com)
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
*/

/**
 * Register Settings
 *
 * Registers the required settings for the plugin and adds them to the 'CSV Import' tab
 *
 * @access      private
 * @since       1.0
 * @return      void
*/

function edd_csv_import_register_settings( $settings ) {
	global $edd_import_file_columns;

	$settings[] = array(
					'id' => 'edd_csv_import',
					'name' => '<strong>' . __('CSV Import Mapping', 'edd') . '</strong>',
					'desc' => __('', 'edd'),
					'type' => 'header',
				);
	$settings[] = array(
					'id' 		=> 'edd_import_post_author',
					'name'		=> __('Author ID','edd'),
					'desc'		=> __('ID of user to associate this download to.', 'edd'),
					'type' 		=> 'select',
					'options'	=> $edd_import_file_columns
				);
	$settings[] = array(
					'id' 		=> 'edd_import_post_date',
					'name'		=> __('Date Created','edd'),
					'desc'		=> __('Format: \'YYYY-MM-DD HH:MM:SS\'', 'edd'),
					'type' 		=> 'select',
					'options'	=> $edd_import_file_columns
				);
	$settings[] = array(
					'id' 		=> 'edd_import_post_content',
					'name'		=> __('Description','edd'),
					'desc'		=> __('The main product description.', 'edd'),
					'type' 		=> 'select',
					'options'	=> $edd_import_file_columns
				);
	$settings[] = array(
					'id' 		=> 'edd_import_post_title',
					'name'		=> __('Download Name','edd'),
					'desc'		=> __('The product title.', 'edd'),
					'type' 		=> 'select',
					'options'	=> $edd_import_file_columns
				);
	$settings[] = array(
					'id' 		=> 'edd_import_post_excerpt',
					'name'		=> __('Excerpt','edd'),
					'desc'		=> __('The product exceprt, if any.', 'edd'),
					'type' 		=> 'select',
					'options'	=> $edd_import_file_columns
				);
	$settings[] = array(
					'id' 		=> 'edd_import_post_status',
					'name'		=> __('Status','edd'),
					'desc'		=> __('Possible values: \'publish\',\'draft\',\'pending\'', 'edd'),
					'type' 		=> 'select',
					'options'	=> $edd_import_file_columns
				);
	$settings[] = array(
					'id' 		=> 'edd_import_post_name',
					'name'		=> __('Post Name','edd'),
					'desc'		=> __('URL slug for the download.', 'edd'),
					'type' 		=> 'select',
					'options'	=> $edd_import_file_columns
				);
	$settings[] = array(
					'id' 		=> 'edd_import_edd_price',
					'name'		=> __('Price','edd'),
					'desc'		=> __('Example: 45.00', 'edd'),
					'type' 		=> 'select',
					'options'	=> $edd_import_file_columns
				);
	$settings[] = array(
					'id' 		=> 'edd_import_download_files',
					'name'		=> __('Download Files','edd'),
					'desc'		=> __('Name of download files.  Pipe (|) separated.', 'edd'),
					'type' 		=> 'select',
					'options'	=> $edd_import_file_columns
				);
	$settings[] = array(
					'id' 		=> 'edd_import_download_limit',
					'name'		=> __('Download Limit','edd'),
					'desc'		=> __('Number of times a download can be downloaded.', 'edd'),
					'type' 		=> 'select',
					'options'	=> $edd_import_file_columns
				);
	$settings[] = array(
					'id' 		=> 'edd_import_hide_purchase_link',
					'name'		=> __('Hide Purchase Link','edd'),
					'desc'		=> __('0 (No) or 1 (Yes)', 'edd'),
					'type' 		=> 'select',
					'options'	=> $edd_import_file_columns
				);
	$settings[] = array(
					'id' 		=> 'edd_import_images',
					'name'		=> __('Image Files','edd'),
					'desc'		=> __('Name of images. Pipe (|) separated.', 'edd'),
					'type' 		=> 'select',
					'options'	=> $edd_import_file_columns
				);
	$settings[] = array(
					'id' 		=> 'edd_import_categories',
					'name'		=> __('Categories','edd'),
					'desc'		=> __('List of categories. Pipe (|) separated.', 'edd'),
					'type' 		=> 'select',
					'options'	=> $edd_import_file_columns
				);
	$settings[] = array(
					'id' 		=> 'edd_import_tags',
					'name'		=> __('Tags','edd'),
					'desc'		=> __('List of tags. Pipe (|) separated.', 'edd'),
					'type' 		=> 'select',
					'options'	=> $edd_import_file_columns
				);

	return $settings;

}

add_filter('edd_settings_misc', 'edd_csv_import_register_settings', 10, 1);
