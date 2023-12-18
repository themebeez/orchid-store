<?php
/**
 * Collection of active callback functions for customizer fields.
 *
 * @since 1.0.0
 * @package Orchid_Store
 */

if ( ! function_exists( 'orchid_store_active_top_header' ) ) {
	/**
	 * Active callback function for when top header is active.
	 *
	 * @since 1.0.0
	 * @param object $control WP Customize Control.
	 * @return boolean.
	 */
	function orchid_store_active_top_header( $control ) {

		return $control->manager->get_setting( 'orchid_store_field_display_top_header' )->value();
	}
}


if ( ! function_exists( 'orchid_store_active_special_menu' ) ) {
	/**
	 * Active callback function for when special menu is active.
	 *
	 * @since 1.0.0
	 * @param object $control WP Customize Control.
	 */
	function orchid_store_active_special_menu( $control ) {

		return $control->manager->get_setting( 'orchid_store_field_display_special_menu' )->value();
	}
}


if ( ! function_exists( 'orchid_store_is_static_home_page_set' ) ) {
	/**
	 * Active callback function for when static home page is set.
	 *
	 * @since 1.0.0
	 * @param object $control WP Customize Control.
	 * @return boolean
	 */
	function orchid_store_is_static_home_page_set( $control ) {

		return ( $control->manager->get_setting( 'show_on_front' )->value() === 'page' );
	}
}


if ( ! function_exists( 'orchid_store_is_not_global_sidebar_position_active' ) ) {
	/**
	 * Active callback function for when global sidebar position is not active.
	 *
	 * @since 1.0.0
	 * @param object $control WP Customize Control.
	 * @return boolean.
	 */
	function orchid_store_is_not_global_sidebar_position_active( $control ) {

		return $control->manager->get_setting( 'orchid_store_field_enable_global_sidebar_position' )->value();
	}
}


if ( ! function_exists( 'orchid_store_is_global_sidebar_position_active' ) ) {
	/**
	 * Active callback function for when global sidebar position is active.
	 *
	 * @since 1.0.0
	 * @param object $control WP Customize Control.
	 * @return boolean
	 */
	function orchid_store_is_global_sidebar_position_active( $control ) {

		return $control->manager->get_setting( 'orchid_store_field_enable_global_sidebar_position' )->value();
	}
}


if ( ! function_exists( 'orchid_store_is_post_common_sidebar_position_active' ) ) {
	/**
	 * Active callback function for when common sidebar position for posts is active.
	 *
	 * @sonce 1.0.0
	 * @param object $control WP Customize Control.
	 * @return boolean.
	 */
	function orchid_store_is_post_common_sidebar_position_active( $control ) {

		return (
			! $control->manager->get_setting( 'orchid_store_field_enable_global_sidebar_position' )->value() &&
			$control->manager->get_setting( 'orchid_store_field_enable_post_common_sidebar_position' )->value()
		);
	}
}


if ( ! function_exists( 'orchid_store_is_page_common_sidebar_position_active' ) ) {
	/**
	 * Active callback function for when common sidebar position for pages is active.
	 *
	 * @since 1.0.0
	 * @param object $control WP Customize Control.
	 * @return boolean.
	 */
	function orchid_store_is_page_common_sidebar_position_active( $control ) {

		return (
			! $control->manager->get_setting( 'orchid_store_field_enable_global_sidebar_position' )->value() &&
			$control->manager->get_setting( 'orchid_store_field_enable_page_common_sidebar_position' )->value()
		);
	}
}


if ( ! function_exists( 'orchid_store_is_footer_widget_area_enabled' ) ) {
	/**
	 * Active callback function for when footer widget area is displayed.
	 *
	 * @since 1.0.0
	 * @param object $control WP Customize Control.
	 * @return boolean
	 */
	function orchid_store_is_footer_widget_area_enabled( $control ) {

		return $control->manager->get_setting( 'orchid_store_field_display_footer_widget_area' )->value();
	}
}


if ( ! function_exists( 'orchid_store_is_product_search_form_enabled' ) ) {
	/**
	 * Active callback function for when product search form is enabled.
	 *
	 * @since 1.0.0
	 * @param object $control WP Customize Control.
	 * @return boolean.
	 */
	function orchid_store_is_product_search_form_enabled( $control ) {

		return $control->manager->get_setting( 'orchid_store_field_display_product_search_form' )->value();
	}
}


if ( ! function_exists( 'orchid_store_is_page_header_enabled' ) ) {
	/**
	 * Active callback function for when page header is enabled.
	 *
	 * @since 1.0.0
	 * @param object $control WP Customize Control.
	 * @return boolean.
	 */
	function orchid_store_is_page_header_enabled( $control ) {

		return $control->manager->get_setting( 'orchid_store_field_display_page_header' )->value();
	}
}


if ( ! function_exists( 'orchid_store_is_cart_mini_cart' ) ) {
	/**
	 * Active callback function to check if mini-cart is selected as cart.
	 *
	 * @since 1.0.0
	 * @param object $control WP Customize Control.
	 * @return boolean.
	 */
	function orchid_store_is_cart_mini_cart( $control ) {

		$cart_display = $control->manager->get_setting( 'orchid_store_field_cart_display' )->value();

		return ( 'default' === $cart_display );
	}
}


if ( ! function_exists( 'orchid_store_is_cart_floating_cart' ) ) {
	/**
	 * Active callback function to check if floating-cart is selected as cart.
	 *
	 * @since 1.0.0
	 * @param object $control WP Customize Control.
	 * @return boolean.
	 */
	function orchid_store_is_cart_floating_cart( $control ) {

		$is_mini_cart_enabled = $control->manager->get_setting( 'orchid_store_field_display_mini_cart' )->value();

		$cart_display = $control->manager->get_setting( 'orchid_store_field_cart_display' )->value();

		return ( $is_mini_cart_enabled && 'floating_cart' === $cart_display );
	}
}


if ( ! function_exists( 'orchid_store_is_mini_cart_enabled' ) ) {
	/**
	 * Active callback function to check if mini-cart is enabled.
	 *
	 * @since 1.0.0
	 * @param object $control WP Customize Control.
	 * @return boolean.
	 */
	function orchid_store_is_mini_cart_enabled( $control ) {

		return $control->manager->get_setting( 'orchid_store_field_display_mini_cart' )->value();
	}
}


if ( ! function_exists( 'orchid_store_is_wishlist_enabled' ) ) {
	/**
	 * Active callback function to check if wishlist is enabled.
	 *
	 * @since 1.0.0
	 * @param object $control WP Customize Control.
	 * @return boolean.
	 */
	function orchid_store_is_wishlist_enabled( $control ) {

		return $control->manager->get_setting( 'orchid_store_field_display_wishlist' )->value();
	}
}


/**
 * Active callback function that checks whether boxed site layout is enabled.
 *
 * @since 1.0.0
 *
 * @param object $control WP Customize Control.
 * @return boolean
 */
function orchid_store_is_boxed_site_layout_enabled( $control ) {

	$site_layout = $control->manager->get_setting( 'orchid_store_field_site_layout' )->value();

	return ( 'boxed' === $site_layout );
}


/**
 * Active callback function that checks whether fullwidth site layout is enabled.
 *
 * @since 1.0.0
 *
 * @param object $control WP Customize Control.
 * @return boolean
 */
function orchid_store_is_fullwidth_site_layout_enabled( $control ) {

	$site_layout = $control->manager->get_setting( 'orchid_store_field_site_layout' )->value();

	return ( 'fullwidth' === $site_layout );
}


/**
 * Active callback function that checks whether third-party search form is enabled.
 *
 * @since 1.0.0
 *
 * @param object $control WP Customize Control.
 * @return boolean
 */
function orchid_store_is_third_party_search_form_enabled( $control ) {

	$site_layout = $control->manager->get_setting( 'orchid_store_field_select_search_form' )->value();

	return ( 'third_party_search' === $site_layout );
}


/**
 * Active callback function that checks whether add to cart button is enabled in product archive.
 *
 * @since 1.0.0
 *
 * @param object $control WP Customize Control.
 * @return boolean
 */
function orchid_store_is_add_to_cart_button_enabled_in_product_archive( $control ) {

	$add_to_cart_layout = $control->manager->get_setting( 'orchid_store_field_add_to_cart_button_placement' )->value();

	return ( 'none' !== $add_to_cart_layout );
}


/**
 * Active callback function that checks whether percentage discount tag is disabled.
 *
 * @since 1.0.0
 *
 * @param object $control WP Customize Control.
 * @return boolean
 */
function orchid_store_is_percentage_discount_tag_disabled( $control ) {

	return $control->manager->get_setting( 'orchid_store_field_enable_percentage_sale_tag' )->value();
}
