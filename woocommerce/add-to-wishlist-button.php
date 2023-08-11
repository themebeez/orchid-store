<?php
/**
 * Add to wishlist button template
 *
 * @author  Your Inspiration Themes
 * @package Orchid_Store
 */

if ( ! defined( 'YITH_WCWL' ) ) {
	exit; // Exit if accessed directly.
}

global $product;
?>
<div class="yith-wcwl-add-button">
	<a
		href="<?php echo esc_url( add_query_arg( 'add_to_wishlist', $product_id, $base_url ) ); ?>"
		rel="nofollow"
		data-product-id="<?php echo esc_attr( $product_id ); ?>"
		data-product-type="<?php echo esc_attr( $product_type ); ?>"
		data-original-product-id="<?php echo esc_attr( $parent_product_id ); ?>"
		class="button-general wish-list-button os-tooltip <?php echo esc_attr( $link_classes ); ?>"
		data-title="<?php echo esc_attr( apply_filters( 'yith_wcwl_add_to_wishlist_title', $label ) ); ?>"
		data-tippy-content="<?php echo esc_attr( $label ); ?>">
		<span class="icon">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z"/></svg>
		</span>
		<span class="text"><?php echo esc_html( $label ); ?></span>
	</a>
</div>
