jQuery( document ).ready( function( $ ) {

	$( '#mxmls_form_update' ).on( 'submit', function( e ){

		e.preventDefault();

		var nonce = $( this ).find( '#mxmls_wpnonce' ).val();

		var someString = $( '#mxmls_some_string' ).val();

		var data = {

			'action': 'mxmls_update',
			'nonce': nonce,
			'mxmls_some_string': someString

		};

		jQuery.post( mxmls_admin_localize.ajaxurl, data, function( response ){

			// console.log( response );
			alert( 'Value updated.' );

		} );

	} );

} );