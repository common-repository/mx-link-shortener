<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class MXMLS_Main_Page_Controller extends MXMLS_Controller
{

	public function hidemenu()
	{

		return new MXMLS_View( 'hidemenu-page' );

	}

	public function settings_menu_item_action()
	{

		return new MXMLS_View( 'settings-page' );

	}

}