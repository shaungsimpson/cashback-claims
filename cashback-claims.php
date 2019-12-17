<?php
/**
 * Plugin Name: Cashback Claim Plugin
 * Description: A plugin to facilitate cashback claims for a promotional offer. Coded up for a coding challenge from GSquared.
 */
// abort if accessed directly
if( ! defined( 'ABSPATH' ) ) { return; }

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
  require_once( dirname( __FILE__ ) . '/vendor/autoload.php' );
}

// define path and url constants for use in plugin
define( 'PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'PLUGIN', plugin_basename( __FILE__ ) . '/cashback-claims.php' );

/**
 * code run during activation
 */
function activate_cbc_plugin() {
  Inc\Core\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_cbc_plugin' );

/**
 * code run during deactivation
 */
function deactivate_cbc_plugin() {
  Inc\Core\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_cbc_plugin' );

/**
 * Initialize all the core classes of the plugin
 */
if ( class_exists( 'Inc\\Init' ) ) {
  Inc\Init::register_services();
}
