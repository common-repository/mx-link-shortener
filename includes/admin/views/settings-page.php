<?php 

	if( isset( $_POST['mx_link_shortener_settings_land_url'] ) ) {

		// land url
		if( $_POST['mx_link_shortener_settings_land_url'] !== NULL AND $_POST['mx_link_shortener_settings_land_url'] !== '' ) {

			// save option
			$option = esc_url_raw( $_POST['mx_link_shortener_settings_land_url'] );

			$option = rtrim( $option, '/' );

			update_option( 'mx_link_shortener_land', $option );

		}

		// site name
		if( $_POST['mx_link_shortener_settings_site_name'] !== NULL AND $_POST['mx_link_shortener_settings_site_name'] !== '' ) {

			// save option
			$site_name = sanitize_text_field( $_POST['mx_link_shortener_settings_site_name'] );

			update_option( 'mx_link_shortener_site_name', $site_name );

		}

		// site email
		if( $_POST['mx_link_shortener_settings_site_email'] !== NULL AND $_POST['mx_link_shortener_settings_site_email'] !== '' ) {

			// save option
			$site_email = sanitize_email( $_POST['mx_link_shortener_settings_site_email'] );

			update_option( 'mx_link_shortener_site_email', $site_email );

		}

	}		

?>

<div class="mx-main-page-text-wrap">

	<a href="<?php echo esc_url( admin_url() ); ?>admin.php?page=mx-shortened-links">List of links</a>
	
	<h2>Link shortener settings</h2>

	<form method="post">
		
		<div>
			<label for="mx-link-shortener-settings-land-url">Enter the URL of the page to which the user will be redirected</label><br>

			<?php 

				$land_url 	= get_option( 'mx_link_shortener_land' );				

			?>

			<input type="text" id="mx-link-shortener-settings-land-url" name="mx_link_shortener_settings_land_url" value="<?php echo $land_url ? esc_url( $land_url ) : ''; ?>" />

		</div>

		<div>
			<label for="mx-link-shortener-settings-site-name">Enter the name of the site (this value will be used when sending emails)</label><br>

			<?php 

				$site_name 	= get_option( 'mx_link_shortener_site_name' );

			?>

			<input type="text" id="mx-link-shortener-settings-site-name" name="mx_link_shortener_settings_site_name" value="<?php echo $site_name ? esc_html( $site_name ) : ''; ?>" />

		</div>

		<div>
			<label for="mx-link-shortener-settings-site-email">Enter the email from where users will receive emails</label><br>

			<?php 

				$site_email 	= get_option( 'mx_link_shortener_site_email' );

			?>

			<input type="text" id="mx-link-shortener-settings-site-email" name="mx_link_shortener_settings_site_email" value="<?php echo $site_email ? esc_html( $site_email ) : ''; ?>" />

		</div>

		<button class="mx-link-shortener-settings-submit">Save</button>

	</form>

</div>

<div>
	<h3>Shortcodes</h3>
	<p>
		<b>[mx_link_shortener]</b> - You should place this shortcode on the page where your users will shorten their long links.
	</p>
	<p>
		<b>[mx_link_shortener_land]</b> - You should place this shortcode on the page where the shortlinks will go.
	</p>
</div>