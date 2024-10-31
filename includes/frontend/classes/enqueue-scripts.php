<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class MXMLS_Enqueue_Scripts_Frontend
{

	/*
	* MXMLS_Enqueue_Scripts_Frontend
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
		add_action( 'wp_enqueue_scripts', [ 'MXMLS_Enqueue_Scripts_Frontend', 'mxmls_enqueue' ] );

	}

		public static function mxmls_enqueue()
		{

			// wp_enqueue_style( 'mxmls_font_awesome', MXMLS_PLUGIN_URL . 'assets/font-awesome-4.6.3/css/font-awesome.min.css' );
			
			wp_enqueue_style( 'mxmls_style', MXMLS_PLUGIN_URL . 'includes/frontend/assets/css/style.css', [], MXMLS_PLUGIN_VERSION, 'all' );

			// add vue.js DEV
			// wp_enqueue_script( 'mx_vue_js', MXMLS_PLUGIN_URL . 'assets/add/vue/vue-dev.js', [], MXMLS_PLUGIN_VERSION, true );

				// add vue.js PROD
				wp_enqueue_script( 'mx_vue_js', MXMLS_PLUGIN_URL . 'assets/add/vue/vue-prod.js', [], MXMLS_PLUGIN_VERSION, true );
			
			wp_enqueue_script( 'mxmls_script', MXMLS_PLUGIN_URL . 'includes/frontend/assets/js/script.js', [ 'jquery', 'mx_vue_js' ], MXMLS_PLUGIN_VERSION, true );

			wp_localize_script( 'mxmls_script', 'mxmls_local_obj', [

				'ajaxurl' 	=> admin_url( 'admin-ajax.php' ),
				'nonce' 	=> wp_create_nonce( 'mxmls_nonce_request_front' )

			] );
		
		}

}