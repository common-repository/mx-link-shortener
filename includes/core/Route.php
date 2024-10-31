<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// require Route-Registrar.php
require_once MXMLS_PLUGIN_ABS_PATH . 'includes/core/Route-Registrar.php';

/*
* Routes class
*/
class MXMLS_Route
{

	public function __construct()
	{
		// ...
	}
	
	public static function mxmls_get( ...$args )
	{

		return new MXMLS_Route_Registrar( ...$args );

	}
	
}