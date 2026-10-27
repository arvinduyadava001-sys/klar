<form role="search" method="get" class="sc-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" name="s" placeholder="<?php echo esc_attr_x( 'Search products, articles&hellip;', 'placeholder', 'skincare-clean' ); ?>" value="<?php echo get_search_query(); ?>">
	<button type="submit"><?php esc_html_e( 'Search', 'skincare-clean' ); ?></button>
</form>
