<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*
* View class
*/
class MXMLS_View
{

	public function __construct( ...$args )
	{
		
		$this->mxmls_render( ...$args );

	}
	
	// render HTML
	public function mxmls_render( $file, $data = NULL )
	{

		// view content
		if( file_exists( MXMLS_PLUGIN_ABS_PATH . "includes/admin/views/{$file}.php" ) ) {

			// data from model
			$data = $data;

			require_once MXMLS_PLUGIN_ABS_PATH . "includes/admin/views/{$file}.php";

		} else { ?>

			<div class="notice notice-error is-dismissible">

			    <p>The view file "<b>includes/admin/views/<?php echo esc_attr( $file ); ?>.php</b>" doesn't exists.</p>
			    
			</div>
		<?php }


	}
	
}