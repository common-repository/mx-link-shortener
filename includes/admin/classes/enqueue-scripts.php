<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class MXMLS_Enqueue_Scripts
{

	/*
	* MXMLS_Enqueue_Scripts
	*/
	public function __construct()
	{

	}

	/*
	* Registration of styles and scripts
	*/
	public static function mxmls_register()
	{

		// register scripts and styles
		add_action( 'admin_enqueue_scripts', [ 'MXMLS_Enqueue_Scripts', 'mxmls_enqueue' ] );

	}

		public static function mxmls_enqueue()
		{

			// wp_enqueue_style( 'mxmls_font_awesome', MXMLS_PLUGIN_URL . 'assets/font-awesome-4.6.3/css/font-awesome.min.css' );

			wp_enqueue_style( 'mxmls_admin_style', MXMLS_PLUGIN_URL . 'includes/admin/assets/css/style.css', [], MXMLS_PLUGIN_VERSION, 'all' );

			// wp_enqueue_script( 'mxmls_admin_script', MXMLS_PLUGIN_URL . 'includes/admin/assets/js/script.js', [ 'jquery' ], MXMLS_PLUGIN_VERSION, false );

			// wp_localize_script( 'mxmls_admin_script', 'mxmls_admin_localize', [

			// 	'ajaxurl' 			=> admin_url( 'admin-ajax.php' )

			// ] );

		}

}