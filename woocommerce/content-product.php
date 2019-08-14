<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class( '', $product ); ?>>
	
	<div class="bg-white product-main-wrap">
		<div class="product-thumb-wrap imghover">
			<?php
			/**
			 * Hook: orchid_store_product_thumbnail.
			 *
			 * @hooked orchid_store_template_loop_product_thumbnail - 10
			 */
			do_action( 'orchid_store_product_thumbnail' );

			/**
			 * Hook: orchid_store_loop_sale_flash.
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 */
			do_action( 'orchid_store_loop_sale_flash' );

			/**
			 * Hook: orchid_store_loop_product_quick_link.
			 *
			 * @hooked orchid_store_template_loop_product_quick_link - 10
			 */
			do_action( 'orchid_store_loop_product_quick_link' );
			?>
		</div>

		<div class="product-info-wrap">
			<?php
			/**
			 * Hook: orchid_store_shop_loop_item_title.
			 *
			 * @hooked orchid_store_template_loop_product_title - 10
			 */
			do_action( 'orchid_store_shop_loop_item_title' );

			/**
			 * Hook: woocommerce_after_shop_loop_item_title.
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
			?>
			<div class="custom-cart-btn">
				<?php
				/**
				 * Hook: orchid_store_loop_add_to_cart.
				 *
				 * @hooked woocommerce_template_loop_add_to_cart - 10
				 */
				do_action( 'orchid_store_loop_add_to_cart' );
				?>
			</div>
		</div>
	</div><!-- .bg-white product-main-wrap -->
</li>
