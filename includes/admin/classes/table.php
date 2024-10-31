<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class MXMLSShorenerLinksTable
{

	public $items = [];

	public $rows = 0;

	public $current_page = 1;

	public $offset = 0;

	public $per_page = 40;

	public $pages = 1;

	public function prepare_items()
	{

		global $wpdb;

		$table = $wpdb->prefix . MXMLS_TABLE_SLUG;

		// set pagination
		$this->set_pagination();

		// get items
		$this->items = $wpdb->get_results( 

			$wpdb->prepare(

				"SELECT id, long_link, short_link_hash, email, count_redirects, created_at FROM $table ORDER BY id DESC LIMIT %d, %d",
				$this->offset,
				$this->per_page

			)
		);

	}

	public function display_row( $item )
	{

		$land_url = get_option( 'mx_link_shortener_land' );

		foreach ( $item as $key => $col ) {
			
			echo '<td>';

				if( $key == 'id' ) {

					echo esc_html( $col );

					continue;

				}

				if( $key == 'long_link' ) {

					echo esc_url( $col );

					continue;

				}

				if( $key == 'short_link_hash' ) {

					echo esc_url( $land_url ) . '?l=' . esc_html( $col );

					continue;

				}

				echo esc_html( $col );

			echo '</td>';

		}

	}

	public function display_rows()
	{

		foreach ( $this->items as $key => $value ) {

			echo '<tr>';
			
				$this->display_row( $value );

			echo '</tr>';

		}

	}

	public function set_pagination()
	{

		global $wpdb;

		$table = $wpdb->prefix . MXMLS_TABLE_SLUG;

		$this->rows = $wpdb->get_var( "SELECT COUNT(id) FROM $table" );

		if( $this->rows == '0' ) return;

		$this->pages = ceil( intval($this->rows)/$this->per_page );

		if( ! isset( $_GET['link_page'] ) ) {

			$this->current_page = 1;

		} else {

			if( $_GET['link_page'] == '0' || $_GET['link_page'] == '1' ) {

				$this->current_page = 1;

			} else {

				$current_page = intval( $_GET['link_page'] );				

				$this->offset = ( $current_page * $this->per_page ) - $this->per_page;				

				if( $current_page > $this->pages ) {

					$this->current_page = $this->pages;

				} else {

					$this->current_page = $current_page;

				}

			}

		}

	}

	public function pagination()
	{ ?>

		<?php if( $this->rows > 0 ) : ?>

			<div class="mx-link-shortener-pagination">
				<ul>

					<?php for( $i = 1; $i<=$this->pages; $i++ ) : ?>

						<li>
							<a href="<?php echo esc_url( admin_url() ); ?>admin.php?page=mx-shortened-links&link_page=<?php echo esc_html( $i ); ?>"><?php echo esc_html( $i ); ?></a>
						</li>

					<?php endfor; ?>
					
				</ul>
			</div>

		<?php endif; ?>	

	<?php }

	public function display_table()
	{ ?>

		<table class="mx-link-shortener-table">
			<thead>
				<tr>
					<th>ID</th>
					<th style="max-width:200px">Long Link</th>
					<th>Short Link</th>
					<th>Email</th>
					<th>Count</th>
					<th>Created</th>
				</tr>
			</thead>
			<tbody>
				
				<?php $this->display_rows() ?>

			</tbody>
		</table>

		<?php

		$this->pagination();

	}

}