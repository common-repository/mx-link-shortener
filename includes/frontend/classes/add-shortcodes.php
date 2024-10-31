<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class MXMLS_Add_Shortcodes
{

	public static function register_shortode()
	{

		add_shortcode( 'mx_link_shortener', ['MXMLS_Add_Shortcodes', 'mx_link_shortener_func'] );

		add_shortcode( 'mx_link_shortener_land', ['MXMLS_Add_Shortcodes', 'mx_link_shortener_land_func'] );

	}

		public static function mx_link_shortener_func()
		{

			ob_start(); ?>

			<div class="mx_link_shortener_wrapper">

				<?php if( ! get_option( 'mx_link_shortener_land' ) || get_option( 'mx_link_shortener_land' ) == '' ) : ?>

					<h2>You must set up the redirect page!</h2>
					<a href="<?php echo esc_url( admin_url() ); ?>admin.php?page=mx-link-shortener">Set up now.</a>

				<?php elseif( ! get_option( 'mx_link_shortener_site_name' ) || get_option( 'mx_link_shortener_site_name' ) == '' ) : ?>

					<h2>You must set up the site name!</h2>
					<a href="<?php echo esc_url( admin_url() ); ?>admin.php?page=mx-link-shortener">Set up now.</a>

				<?php elseif( ! get_option( 'mx_link_shortener_site_email' ) || get_option( 'mx_link_shortener_site_email' ) == '' ) : ?>

					<h2>You must set up the email address from where users will be getting emails!</h2>
					<a href="<?php echo esc_url( admin_url() ); ?>admin.php?page=mx-link-shortener">Set up now.</a>

				<?php else : ?>

					<div id="mxLinkShortener">
						
						<mx_link_shortener_form></mx_link_shortener_form>

					</div>

				<?php endif; ?>

			</div>

			<?php return ob_get_clean();

		}

		public static function mx_link_shortener_land_func()
		{

			ob_start();

			if( isset( $_GET['l'] ) ) {

				global $wpdb;

				$table = $wpdb->prefix . MXMLS_TABLE_SLUG;

				$url_hash = sanitize_text_field( $_GET['l'] );

				$result = $wpdb->get_row( 

					$wpdb->prepare(

						"SELECT id, long_link FROM $table WHERE short_link_hash=%s",
						$url_hash

					)					

				);

				if( $result !== NULL ) { ?>					

					<script>

						window.mx_long_link = '<?php echo esc_url( $result->long_link ); ?>';
						window.mx_url_hash = '<?php echo esc_html( $url_hash ); ?>';

					</script>

					<?php echo esc_url( $result->long_link );?>

					<div id="mxLinkShortenerUpdate">
						<mx_link_shortener_notification
							:error="error"
						></mx_link_shortener_notification>
					</div>

				<?php } else {

					echo 'This link isn\'t correct';

				}

			} else {

				echo 'incorrect';

			}

			return ob_get_clean();

		}

}