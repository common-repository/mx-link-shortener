<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class MXMLS_Ajax
{

	public static $iterations = 5;

	public static function register_ajax()
	{

		// create
		add_action( 'wp_ajax_mx_create_short_link', ['MXMLS_Ajax', 'mx_create_short_link_func'] );
		add_action( 'wp_ajax_nopriv_mx_create_short_link', ['MXMLS_Ajax', 'mx_create_short_link_func'] );

		// update
		add_action( 'wp_ajax_mx_update_short_link', ['MXMLS_Ajax', 'mx_update_short_link_func'] );
		add_action( 'wp_ajax_nopriv_mx_update_short_link', ['MXMLS_Ajax', 'mx_update_short_link_func'] );


	}

	public static function mx_update_short_link_func()
	{

		if( empty( $_POST['nonce'] ) ) wp_die();

		if( wp_verify_nonce( $_POST['nonce'], 'mxmls_nonce_request_front' ) ) {

			$hash = sanitize_text_field( $_POST['short_link_hash'] );

			global $wpdb;

			$table = $wpdb->prefix . MXMLS_TABLE_SLUG;

			// get tow
			$row = $wpdb->get_row( 

				$wpdb->prepare(

					"SELECT count_redirects FROM $table WHERE short_link_hash=%s",
					$hash

				)

			);

			if( $row == NULL ) {

				echo 'error';

			} else {

				$count = intval( $row->count_redirects );

				$count++;

				// update count
				$update = $wpdb->update(
					$table,
					[ 'count_redirects' => $count ],
					[ 'short_link_hash' => $hash ],
					[ '%d' ]
				);

				echo esc_html( $update );

			}

		}

		wp_die();

	}

	public static function mx_create_short_link_func()
	{

		if( empty( $_POST['nonce'] ) ) wp_die();

		if( wp_verify_nonce( $_POST['nonce'], 'mxmls_nonce_request_front' ) ) {

			// url
			$lonk_link = esc_url_raw( $_POST['long_link'] );

			// short_link
			$short_link = self::generate_short_link();

			if( $short_link == 'toomanyeterations' ) {

				echo 'error';
				wp_die();

			}
	
			// email
			$email = sanitize_email( $_POST['email'] );

			// save to DB
			global $wpdb;

			$table = $wpdb->prefix . MXMLS_TABLE_SLUG;

			$insert = $wpdb->insert( $table, [
				'long_link' 		=> $lonk_link,
				'short_link_hash' 	=> $short_link,
				'email' 			=> $email
			], [
				'%s',
				'%s',
				'%s'
			] );			

			if( $insert == 1) {

				self::send_email( $email, $short_link );

			}

			echo esc_html( $insert );

		} 

		wp_die();

	}

	public static function generate_short_link()
	{

		if( self::$iterations == 0 )
			return 'toomanyeterations';

		self::$iterations--;

		global $wpdb;

		$table = $wpdb->prefix . MXMLS_TABLE_SLUG;

		$short_link = wp_generate_password( 12, false );

		$result = $wpdb->get_row( 

			$wpdb->prepare(

				"SELECT * FROM $table WHERE short_link_hash=%s",
				$short_link

			)			

		);

		if( $result !== NULL ) {

			return self::generate_short_link();

		} 

		return $short_link;

	}

	public static function send_email( $email, $short_link )
	{

		$to 		= $email;

		$subject 	= 'The short link generated!';

		$land_url = get_option( 'mx_link_shortener_land' );

		$short_link = $land_url . '?l=' . $short_link;

		$body 		= '<p>Dear client, we\'ve created a shor link for you.</p>';
		$body 		.= '<p>Short Link: <b><a href="' . esc_url( $short_link ) . '">' . esc_url( $short_link ) . '</a></b></p>';

		$site_name 	= get_option( 'mx_link_shortener_site_name' );
		$site_email = get_option( 'mx_link_shortener_site_email' );
		$headers 	= 'From: ' . esc_html( $site_name ) . '<' . esc_html( $site_email ) . '>' . "\n";
		$headers 	.= "Content-Type: text/html\n";

		return wp_mail( $to, $subject, $body, $headers );

	}

}