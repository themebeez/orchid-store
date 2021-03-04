<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Orchid_Store
 */

$sidebar_position = orchid_store_sidebar_position();



if ( ! is_active_sidebar( 'sidebar-1' ) || $sidebar_position == 'none' ) {
	return;
}
?>
<div class="<?php orchid_store_sidebar_class(); ?>">
	<aside id="secondary" class="secondary-widget-area">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside><!-- #secondary -->
</div><!-- .col -->
