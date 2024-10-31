<?php
/*
Plugin Name: Mx Link Shortener
Plugin URI: https://github.com/Maxim-us/wp-plugin-skeleton
Description: This plugin shortens links and allows you to store them on your website.
Author: Maksym Marko
Version: 1.1
Author URI: https://markomaksym.com.ua/
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*
* Unique string - MXMLS
*/

/*
* Define MXMLS_PLUGIN_PATH
*
* E:\OpenServer\domains\my-domain.com\wp-content\plugins\mx-link-shortener\mx-link-shortener.php
*/
if ( ! defined( 'MXMLS_PLUGIN_PATH' ) ) {

	define( 'MXMLS_PLUGIN_PATH', __FILE__ );

}

/*
* Define MXMLS_PLUGIN_URL
*
* Return http://my-domain.com/wp-content/plugins/mx-link-shortener/
*/
if ( ! defined( 'MXMLS_PLUGIN_URL' ) ) {

	define( 'MXMLS_PLUGIN_URL', plugins_url( '/', __FILE__ ) );

}

/*
* Define MXMLS_PLUGN_BASE_NAME
*
* 	Return mx-link-shortener/mx-link-shortener.php
*/
if ( ! defined( 'MXMLS_PLUGN_BASE_NAME' ) ) {

	define( 'MXMLS_PLUGN_BASE_NAME', plugin_basename( __FILE__ ) );

}

/*
* Define MXMLS_TABLE_SLUG
*/
if ( ! defined( 'MXMLS_TABLE_SLUG' ) ) {

	define( 'MXMLS_TABLE_SLUG', 'mxmls_link_shortener' );

}

/*
* Define MXMLS_PLUGIN_ABS_PATH
* 
* E:\OpenServer\domains\my-domain.com\wp-content\plugins\mx-link-shortener/
*/
if ( ! defined( 'MXMLS_PLUGIN_ABS_PATH' ) ) {

	define( 'MXMLS_PLUGIN_ABS_PATH', dirname( MXMLS_PLUGIN_PATH ) . '/' );

}

/*
* Define MXMLS_PLUGIN_VERSION
*/
if ( ! defined( 'MXMLS_PLUGIN_VERSION' ) ) {

	// version
	define( 'MXMLS_PLUGIN_VERSION', '1.1' ); // Must be replaced before production on for example '1.0'

}

/*
* Define MXMLS_MAIN_MENU_SLUG
*/
if ( ! defined( 'MXMLS_MAIN_MENU_SLUG' ) ) {

	// version
	define( 'MXMLS_MAIN_MENU_SLUG', 'mxmls-mx-link-shortener-menu' );

}

/**
 * activation|deactivation
 */
require_once plugin_dir_path( __FILE__ ) . 'install.php';

/*
* Registration hooks
*/
// Activation
register_activation_hook( __FILE__, [ 'MXMLS_Basis_Plugin_Class', 'activate' ] );

// Deactivation
register_deactivation_hook( __FILE__, [ 'MXMLS_Basis_Plugin_Class', 'deactivate' ] );


/*
* Include the main MXMLSMxLinkShortener class
*/
if ( ! class_exists( 'MXMLSMxLinkShortener' ) ) {

	require_once plugin_dir_path( __FILE__ ) . 'includes/final-class.php';

	/*
	* Translate plugin
	*/
	add_action( 'plugins_loaded', 'mxmls_translate' );

	function mxmls_translate()
	{

		load_plugin_textdomain( 'mxmls-domain', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	}

}