=== Easy Digital Downloads ===
Author URI: http://pippinsplugins.com
Plugin URI: http://easydigitaldownloads.com/extension/product-import-csv
Contributors: mordauk, Daniel Espinoza
Donate link: http://pippinsplugins.com/support-the-site
Tags: easy digital downloads, edd, download, downloads, e-store, eshop, digital downloads, e-downloads, ecommerce, e commerce, e-commerce, selling, wp-ecommerce, wp ecommerce, mordauk, pippinsplugins, CSV Import, Prodct Import, Download Import
Requires at least: 3.3
Tested up to: 3.5

Stable Tag: 1.0.0
License: GNU Version 2 or Any Later Version

Import products into Easy Digital Downloads via CSV

== Description ==

This is an extension for [Easy Digital Downloads](http://wordpress.org/extend/plugins/easy-digital-downloads/) that allows you to bulk import your products from a CSV file. The import can handle complete product creation, including descriptions, prices, categories, download files, and all other aspects of the download product configuration.

== Installation ==

1. Activate the plugin
2. Go to Downloads > Settings > Misc and configure the CSV Import Mapping
3. Format your CSV according to the mapping in 1
4. Go to Downloads > CSV Import and upload your import file
5. Check the "Validate File Only" if you want to check if your file is valid without importing

== Frequently Asked Questions ==

= How Do I Import Files with My Downloads? =

In order to import downloadable files with your Download products, you need to first upload all of the files you want imported to wp-content/uploads.

Once all of the files are uploaded, you will enter the file names in the CSV with each filename separated by a | (pipe). Like this:

my_zip_file.zip|image2.png

During the import, the files will be moved into the secure wp-content/uploads/edd/{year}/{month}/ folder.

== Screenshots ==

1. Import screen
2. CSV Import Mapping

== Changelog ==

= 1.0.0 =

* Initial release