<?php
/**
 * Add to wishlist button template - Added to list
 *
 * @author  themebeez
 * @package Orchid_Store
 */

/**
 * Template variables:
 *
 * @var $wishlist_url string Url to wishlist page
 * @var $exists bool Whether current product is already in wishlist
 * @var $show_exists bool Whether to show already in wishlist link on multi wishlist
 * @var $product_id int Current product id
 * @var $product_type string Current product type
 * @var $label string Button label
 * @var $browse_wishlist_text string Browse wishlist text
 * @var $already_in_wishslist_text string Already in wishlist text
 * @var $product_added_text string Product added text
 * @var $icon string Icon for Add to Wishlist button
 * @var $link_classes string Classed for Add to Wishlist button
 * @var $available_multi_wishlist bool Whether add to wishlist is available or not
 * @var $disable_wishlist bool Whether wishlist is disabled or not
 * @var $template_part string Template part
 * @var $loop_position string Loop position
 */

if ( ! defined( 'YITH_WCWL' ) ) {
	exit;
} // Exit if accessed directly

global $product;
?>

<!-- ADDED TO WISHLIST MESSAGE -->
<div class="yith-wcwl-wishlistaddedbrowse">
	<a class="button-general wish-list-button os-tooltip" href="<?php echo esc_url( $wishlist_url ); ?>" rel="nofollow" data-tippy-content="<?php echo esc_attr( $product_added_text ); ?>">
		<span class="icon">
			<svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="currentColor"><path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z"/></svg>
		</span>
		<span class="text"><?php echo esc_html( apply_filters( 'yith-wcwl-browse-wishlist-label', $browse_wishlist_text, $product_id, $icon ) ); // phpcs:ignore ?></span>
	</a>
</div>
