<div class="mx-main-page-text-wrap">
	
	<a href="<?php echo esc_url( admin_url() ); ?>admin.php?page=mx-link-shortener">Settings</a>

	<h1>List of links</h1>

	<?php 

		$table = new MXMLSShorenerLinksTable();

		$table->prepare_items();

		$table->display_table();

	 ?>

</div>