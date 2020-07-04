<?php
/**
 * Add to wishlist button template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.8
 */

if ( ! defined( 'YITH_WCWL' ) ) {
    exit;
} // Exit if accessed directly

global $product;
?>
<div class="yith-wcwl-add-button">
    <a href="<?php echo esc_url( add_query_arg( 'add_to_wishlist', $product_id, $base_url ) )?>" rel="nofollow" data-product-id="<?php echo esc_attr( $product_id ); ?>" data-product-type="<?php echo esc_attr( $product_type ); ?>" data-original-product-id="<?php echo esc_attr( $parent_product_id ); ?>" class="button-general wish-list-button os-tooltip <?php echo esc_attr( $link_classes ); ?>" data-title="<?php echo esc_attr( apply_filters( 'yith_wcwl_add_to_wishlist_title', $label ) ); ?>" data-tippy-content="<?php echo esc_attr( $label ); ?>">
        <span class="icon"><i class='bx bx-heart'></i></span>
        <span class="text"><?php echo esc_html( $label ); ?></span>
    </a>
</div>