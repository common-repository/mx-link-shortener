<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// create table class
require_once MXMLS_PLUGIN_ABS_PATH . 'includes/core/create-table.php';

class MXMLS_Basis_Plugin_Class
{

	private static $table_slug = MXMLS_TABLE_SLUG;

	public static function activate()
	{

		// set option for rewrite rules CPT
		self::create_option_for_activation();

		// Create table
		global $wpdb;

		// Table name
		$table_name = $wpdb->prefix . self::$table_slug;

		$product_table = new MXMLSCreateTable( $table_name );

		// add some column

			// Lonk link
			$product_table->longtext( 'long_link' );

			// short link
			$product_table->varchar( 'short_link_hash', 200, true );

			// email
			$product_table->varchar( 'email', 200, true );

			// number of redirects
			$product_table->int( 'count_redirects' );

			// created
			$product_table->datetime( 'created_at' );

		// create columns
		$product_table->create_columns();

		// create table
		$table_created = $product_table->create_table();		

	}

	public static function deactivate()
	{

		// Rewrite rules
		flush_rewrite_rules();

	}

	/*
	* This function sets the option in the table for CPT rewrite rules
	*/
	public static function create_option_for_activation()
	{

		// add_option( 'mxmls_flush_rewrite_rules', 'go_flush_rewrite_rules' );

	}

}