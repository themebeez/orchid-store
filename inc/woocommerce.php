<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Orchid_Store
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function orchid_store_woocommerce_setup() {

	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'orchid_store_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function orchid_store_woocommerce_scripts() {

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'orchid-store-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'orchid_store_woocommerce_scripts' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function orchid_store_woocommerce_active_body_class( $classes ) {

	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'orchid_store_woocommerce_active_body_class' );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function orchid_store_woocommerce_products_per_page() {

	$no_of_rows = intval( get_theme_mod( 'orchid_store_field_row_per_page', 4 ) );

	$no_of_cols = intval( get_theme_mod( 'orchid_store_field_shop_product_col_no', 3 ) );

	$items = intval( $no_of_cols * $no_of_rows );

	return $items;
}
add_filter( 'loop_shop_per_page', 'orchid_store_woocommerce_products_per_page', 20 );

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function orchid_store_woocommerce_thumbnail_columns() {

	return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'orchid_store_woocommerce_thumbnail_columns' );

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function orchid_store_woocommerce_loop_columns() {

	$no_of_cols = intval( get_theme_mod( 'orchid_store_field_shop_product_col_no', 3 ) );

	return $no_of_cols;
}
add_filter( 'loop_shop_columns', 'orchid_store_woocommerce_loop_columns' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function orchid_store_woocommerce_related_products_args( $args ) {

	$defaults = array();
		
	$defaults['columns'] = intval( get_theme_mod( 'orchid_store_field_related_product_col_no', 3 ) );
	$defaults['posts_per_page'] = intval( get_theme_mod( 'orchid_store_field_related_product_no', 3 ) );

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'orchid_store_woocommerce_related_products_args' );

if ( ! function_exists( 'orchid_store_woocommerce_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper.
	 *
	 * @return  void
	 */
	function orchid_store_woocommerce_product_columns_wrapper() {

		$columns = orchid_store_woocommerce_loop_columns();

		echo '<div class="columns-' . absint( $columns ) . '">';
	}
}
add_action( 'woocommerce_before_shop_loop', 'orchid_store_woocommerce_product_columns_wrapper', 40 );

if ( ! function_exists( 'orchid_store_woocommerce_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close.
	 *
	 * @return  void
	 */
	function orchid_store_woocommerce_product_columns_wrapper_close() {

		echo '</div>';
	}
}
add_action( 'woocommerce_after_shop_loop', 'orchid_store_woocommerce_product_columns_wrapper_close', 40 );


/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'orchid_store_woocommerce_header_cart' ) ) {
			orchid_store_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'orchid_store_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function orchid_store_woocommerce_cart_link_fragment( $fragments ) {

		ob_start();
		orchid_store_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'orchid_store_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'orchid_store_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function orchid_store_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'orchid-store' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'orchid-store' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}


/**
 * Change number of upsells output
 */
function orchid_store_upsell_products_args( $args ) {

	$args['columns'] = intval( get_theme_mod( 'orchid_store_field_upsell_product_col_no', 4 ) ); 	

 	return $args;
}
add_filter( 'woocommerce_upsell_display_args', 'orchid_store_upsell_products_args', 20 );


/**
 * Change number of cross sells column
 */
function orchid_store_cross_sells_columns( $columns ) {

	$columns = intval( get_theme_mod( 'orchid_store_field_cross_sell_product_col_no', 4 ) );
 	
 	return $columns;
}
add_filter( 'woocommerce_cross_sells_columns', 'orchid_store_cross_sells_columns' );


if( ! function_exists( 'orchid_store_add_to_cart_fragments' ) ) {

	function orchid_store_add_to_cart_fragments( $fragments ) {

		ob_start();
	    ?>
	    <span class="woocommerce-Price-amount amount os-minicart-amount"><?php echo wp_kses_post( WC()->cart->get_cart_subtotal() ); ?></span>
	    <?php
	    $fragments['.os-minicart-amount'] = ob_get_clean();

	    return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'orchid_store_add_to_cart_fragments' );

/**
 * Defining custom hooks from woocommerce functions
 */
add_action( 'orchid_store_loop_product_link_open', 'woocommerce_template_loop_product_link_open', 10 );
add_action( 'orchid_store_loop_product_link_close', 'woocommerce_template_loop_product_link_close', 10 );
add_action( 'orchid_store_loop_product_thumbnail', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'orchid_store_loop_add_to_cart', 'woocommerce_template_loop_add_to_cart', 10 );
add_action( 'orchid_store_loop_sale_flash', 'woocommerce_show_product_loop_sale_flash', 10 );
add_action( 'orchid_store_shop_loop_item_title', 'orchid_store_template_loop_product_title' );
add_action( 'orchid_store_product_thumbnail', 'orchid_store_template_loop_product_thumbnail' );
add_action( 'orchid_store_loop_product_quick_link', 'orchid_store_template_loop_product_quick_link' );

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
add_action( 'orchid_store_woocommerce_breadcrumb', 'woocommerce_breadcrumb', 20, 0 );

if ( get_theme_mod( 'orchid_store_field_display_plus_minus_btns', true ) ) {
	add_action( 'woocommerce_before_add_to_cart_quantity', 'orchid_store_quantity_minus' );
	add_action( 'woocommerce_after_add_to_cart_quantity', 'orchid_store_quantity_plus' );
}

remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );