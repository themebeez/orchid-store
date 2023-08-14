<?php
/**
 * Collection of functions that returns array of different elements. 
 */

if( ! function_exists( 'orchid_store_all_post_categories' ) ) {
	/**
	 * Get post categories.
	 *
	 * @since 1.0.0
	 *
	 * @param null.
	 * @return array.
	 */
	function orchid_store_all_post_categories() {

		$post_terms = get_terms( array( 'taxonomy' => 'category' ) );

		$post_categories = array();

		if( ! empty( $post_terms ) ) {

			$value_as = orchid_store_get_option( 'value_as' );

			if ( $value_as == 'slug' ) {

				foreach( $post_terms as $post_term ) {

					$post_categories[$post_term->slug] = $post_term->name;
				}
			} else {
				foreach( $post_terms as $post_term ) {

					$post_categories[$post_term->term_id] = $post_term->name;
				}
			}
		}

		return $post_categories;
	}
}


if( ! function_exists( 'orchid_store_all_pages' ) ) {
	/**
	 * Get pages.
	 *
	 * @since 1.0.0
	 *
	 * @param null.
	 * @return array.
	 */
	function orchid_store_all_pages() {

		$pages  =  get_pages();

		$page_list = array();

		if( !empty( $pages ) ) {

			$value_as = orchid_store_get_option( 'value_as' );

			if ( $value_as == 'slug' ) {

				foreach( $pages as $page ) {

					$page_list[ $page->post_name ] = $page->post_title;
				}
			} else {
				foreach( $pages as $page ) {

					$page_list[ $page->ID ] = $page->post_title;
				}
			}
		}

		return $page_list;
	}
}

if( ! function_exists( 'orchid_store_all_product_categories' ) ) {
	/**
	 * Get pages.
	 *
	 * @since 1.0.0
	 *
	 * @param null.
	 * @return array.
	 */
	function orchid_store_all_product_categories() {

		if( ! class_exists( 'WooCommerce' ) ) {

			return;
		}

		$product_terms = get_terms( 'product_cat', array(
			'number'     => '',
			'orderby'    => 'name',
			'order'      => 'ASC',
			'hide_empty' => true
		) );

		return $product_terms;
	}
}


if( ! function_exists( 'orchid_store_all_sidebar_positions' ) ) {
	/**
	 * Get sidebar positions.
	 *
	 * @since 1.0.0
	 *
	 * @param null.
	 * @return array.
	 */
	function orchid_store_all_sidebar_positions() {

		return array(
			'left' => get_template_directory_uri() . '/customizer/assets/images/sidebar_left.png',
			'right' => get_template_directory_uri() . '/customizer/assets/images/sidebar_right.png',
			'none' => get_template_directory_uri() . '/customizer/assets/images/sidebar_none.png',
		);
	}
}


if ( ! function_exists( 'orchid_store_add_to_cart_button_positions' ) ) {
	/**
	 * Add to cart button positions.
	 *
	 * @since 1.5.0
	 *
	 * @return array.
	 */
	function orchid_store_add_to_cart_button_positions() {

		return array(
			'default'    => get_template_directory_uri() . '/customizer/assets/images/add_to_cart_default.png',
			'over_image' => get_template_directory_uri() . '/customizer/assets/images/add_to_cart_over_thumbnail.png',
			'none'       => get_template_directory_uri() . '/customizer/assets/images/add_to_cart_none.png',
		);
	}
}


if ( ! function_exists( 'orchid_store_checkout_page_layouts' ) ) {
	/**
	 * Checkout page layouts.
	 *
	 * @since 1.5.0
	 *
	 * @return array.
	 */
	function orchid_store_checkout_page_layouts() {

		return array(
			'layout_1' => get_template_directory_uri() . '/customizer/assets/images/checkout_layout_1.png',
			'layout_2' => get_template_directory_uri() . '/customizer/assets/images/checkout_layout_2.png',
		);
	}
}


if ( ! function_exists( 'orchid_store_cart_page_layouts' ) ) {
	/**
	 * Cart page layouts.
	 *
	 * @since 1.5.0
	 *
	 * @return array.
	 */
	function orchid_store_cart_page_layouts() {

		return array(
			'layout_1' => get_template_directory_uri() . '/customizer/assets/images/cart_layout_1.png',
			'layout_2' => get_template_directory_uri() . '/customizer/assets/images/cart_layout_2.png',
		);
	}
}
