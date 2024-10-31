<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*
* Error Handle calss
*/
class MXMLS_Display_Error
{

	/**
	* Error notice
	*/
	public $mxmls_error_notice = '';

	public function __construct( $mxmls_error_notice )
	{

		$this->mxmls_error_notice = $mxmls_error_notice;

	}

	public function mxmls_show_error()
	{
		
		add_action( 'admin_notices', function() { ?>

			<div class="notice notice-error is-dismissible">

			    <p><?php echo esc_attr( $this->mxmls_error_notice ); ?></p>
			    
			</div>
		    
		<?php } );

	}

}