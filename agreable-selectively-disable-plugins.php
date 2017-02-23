<?php

/**
 * @wordpress-plugin
 * Plugin Name:       Agreable Selectively Disable Plugins
 * Description:       Disables plugins for API requests in order to speed up the API response times.
 * Version:           1.0.0
 * Author:            Shortlist Media
 * Author URI:        http://shortlistmedia.co.uk/
 * License:           MIT
 */

// Set a $_SERVER key to watch out for
$server_key = 'is-automated-testing';

// listener for the thin load
// If automated testing, set some metadata
if (isset($_SERVER[$server_key])) {
  add_filter( 'option_active_plugins', 'api_request_disable_plugin' );
}
function api_request_disable_plugin( $plugins ) {

  // die(var_dump($plugins));

  // If key is present then skip loading the following plugins
  $plugins_not_needed = array(
    "agreable-advert-plugin/plugin.php",
    // "agreable-catfish-importer-plugin/plugin.php",
    "agreable-instant-articles-plugin/plugin.php",
    "agreable-longform-plugin/plugin.php",
    "agreable-partnership-plugin/plugin.php",
    "agreable-promo-plugin/plugin.php",
    "bulk-delete/bulk-delete.php",
    "croissant-admin-theme/croissant-admin-theme.php",
    "custom-post-type-permalinks/custom-post-type-permalinks.php",
    "google-sitemap-generator/sitemap.php",
    "iframely/iframely.php",
    "nginx-helper/nginx-helper.php",
    "stealth-login-page/plugin.php",
    "wordpress-importer/wordpress-importer.php",
    "wp-migrate-db-pro-cli/wp-migrate-db-pro-cli.php",
    "wp-migrate-db-pro-media-files/wp-migrate-db-pro-media-files.php",
    "wp-migrate-db-pro/wp-migrate-db-pro.php",
    "wp-offload-s3-enable-media-replace/amazon-s3-and-cloudfront-enable-media-replace.php",
    "wp-offload-s3-pro/amazon-s3-and-cloudfront-pro.php",
    // "wp-selectively-disable-plugins/wp-selectively-disable-plugins.php",
    "yoimages/yoimages.php"
  );

	foreach ( $plugins_not_needed as $plugin ) {
		$key = array_search( $plugin, $plugins );
		if ( false !== $key ) {
			unset( $plugins[ $key ] );
		}
	}

	return $plugins;
}
