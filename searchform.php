<?php
/**
 * Search form for Orchid Store theme.
 *
 * @since 1.5.3
 *
 * @package Orchid_Store
 */

?>
<form method="get" id="search-form" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="s">
		<span class="screen-reader-text">
			<?php
			echo esc_html__( 'Search for:', 'orchid-store' );
			?>
		</span>
	</label>
	<input
		type="search"
		id="s"
		name="s" 
		placeholder="<?php echo esc_attr__( 'Type here to search', 'orchid-store' ); ?>"
		value="<?php echo esc_attr( get_search_query() ); ?>"
	>
	<button type="submit"><i class="bx bx-search"></i></button>
</form>
