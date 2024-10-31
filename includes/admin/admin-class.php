<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class MXMLS_Admin_Main
{

	// list of model names used in the plugin
	public $models_collection = [
		'MXMLS_Main_Page_Model'
	];

	/*
	* MXMLS_Admin_Main constructor
	*/
	public function __construct()
	{

	}

	/*
	* Additional classes
	*/
	public function mxmls_additional_classes()
	{

		// enqueue_scripts class
		mxmls_require_class_file_admin( 'enqueue-scripts.php' );

		MXMLS_Enqueue_Scripts::mxmls_register();

		// table
		mxmls_require_class_file_admin( 'table.php' );

	}

	/*
	* Models Connection
	*/
	public function mxmls_models_collection()
	{

		// require model file
		foreach ( $this->models_collection as $model ) {
			
			mxmls_use_model( $model );

		}		

	}

	/**
	* registration ajax actions
	*/
	public function mxmls_registration_ajax_actions()
	{

		// ajax requests to main page
		// MXMLS_Main_Page_Model::mxmls_wp_ajax();

	}

	/*
	* Routes collection
	*/
	public function mxmls_routes_collection()
	{		

		// hide menu item
		MXMLS_Route::mxmls_get( 'MXMLS_Main_Page_Controller', 'hidemenu', 'NULL', [
			'page_title' => 'List of shortened links',
		], 'mx-shortened-links' );

		// sub settings menu item
		MXMLS_Route::mxmls_get( 'MXMLS_Main_Page_Controller', 'settings_menu_item_action', 'NULL', [
			'menu_title' => 'Link Shortener',
			'page_title' => 'Link Shortener'
		], 'mx-link-shortener', true );

	}

}

// Initialize
$initialize_admin_class = new MXMLS_Admin_Main();

// include classes
$initialize_admin_class->mxmls_additional_classes();

// include models
$initialize_admin_class->mxmls_models_collection();

// ajax requests
$initialize_admin_class->mxmls_registration_ajax_actions();

// include controllers
$initialize_admin_class->mxmls_routes_collection();