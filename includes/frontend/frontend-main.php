<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class MXMLS_FrontEnd_Main
{

	/*
	* MXMLS_FrontEnd_Main constructor
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
		mxmls_require_class_file_frontend( 'enqueue-scripts.php' );

		MXMLS_Enqueue_Scripts_Frontend::mxmls_register();

		// add shortcodes
		mxmls_require_class_file_frontend( 'add-shortcodes.php' );
		
		MXMLS_Add_Shortcodes::register_shortode();

		// ajax
		mxmls_require_class_file_frontend( 'ajax.php' );

		MXMLS_Ajax::register_ajax();

	}

}

// Initialize
$initialize_admin_class = new MXMLS_FrontEnd_Main();

// include classes
$initialize_admin_class->mxmls_additional_classes();