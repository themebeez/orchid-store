<?php
/**
 * Collection of active callback functions for customizer fields.
 *
 * @package Orchid_Store
 */

/**
 * Active callback function for when top header is active.
 */
if( ! function_exists( 'orchid_store_active_top_header' ) ) {

	function orchid_store_active_top_header( $control ) {

		if ( $control->manager->get_setting( 'orchid_store_field_display_top_header' )->value() == true ) {

			return true;
		} else {
			
			return false;
		}		
	}
}


/**
 * Active callback function for when special menu is active.
 */
if( ! function_exists( 'orchid_store_active_special_menu' ) ) {

	function orchid_store_active_special_menu( $control ) {

		if ( $control->manager->get_setting( 'orchid_store_field_display_special_menu' )->value() == true ) {

			return true;
		} else {
			
			return false;
		}		
	}
}



/**
 * Active callback function for when static home page is set.
 */
if( ! function_exists( 'orchid_store_is_static_home_page_set' ) ) {

	function orchid_store_is_static_home_page_set( $control ) {

		if ( $control->manager->get_setting( 'show_on_front' )->value() == 'page' ) {

			return true;
		} else {
			
			return false;
		}		
	}
}


/**
 * Active callback function for when global sidebar position is not active.
 */
if( ! function_exists( 'orchid_store_is_not_global_sidebar_position_active' ) ) {

	function orchid_store_is_not_global_sidebar_position_active( $control ) {

		if ( $control->manager->get_setting( 'orchid_store_field_enable_global_sidebar_position' )->value() == true ) {

			return false;
		} else {
			
			return true;
		}		
	}
}

/**
 * Active callback function for when global sidebar position is active.
 */
if( ! function_exists( 'orchid_store_is_global_sidebar_position_active' ) ) {

	function orchid_store_is_global_sidebar_position_active( $control ) {

		if ( $control->manager->get_setting( 'orchid_store_field_enable_global_sidebar_position' )->value() == true ) {

			return true;
		} else {
			
			return false;
		}		
	}
}


/**
 * Active callback function for when common sidebar position for posts is active.
 */
if( ! function_exists( 'orchid_store_is_post_common_sidebar_position_active' ) ) {

	function orchid_store_is_post_common_sidebar_position_active( $control ) {

		if ( $control->manager->get_setting( 'orchid_store_field_enable_global_sidebar_position' )->value() == false && $control->manager->get_setting( 'orchid_store_field_enable_post_common_sidebar_position' )->value() == true ) {

			return true;
		} else {
			
			return false;
		}		
	}
}


/**
 * Active callback function for when common sidebar position for pages is active.
 */
if( ! function_exists( 'orchid_store_is_page_common_sidebar_position_active' ) ) {

	function orchid_store_is_page_common_sidebar_position_active( $control ) {

		if ( $control->manager->get_setting( 'orchid_store_field_enable_global_sidebar_position' )->value() == false && $control->manager->get_setting( 'orchid_store_field_enable_page_common_sidebar_position' )->value() == true ) {

			return true;
		} else {
			
			return false;
		}		
	}
}


/**
 * Active callback function for when footer widget area is displayed.
 */
if( ! function_exists( 'orchid_store_is_footer_widget_area_enabled' ) ) {

	function orchid_store_is_footer_widget_area_enabled( $control ) {

		if ( $control->manager->get_setting( 'orchid_store_field_display_footer_widget_area' )->value() == true ) {

			return true;
		} else {
			
			return false;
		}		
	}
}


/**
 * Active callback function for when product search form is enabled.
 */
if( ! function_exists( 'orchid_store_is_product_search_form_enabled' ) ) {

	function orchid_store_is_product_search_form_enabled( $control ) {

		if ( $control->manager->get_setting( 'orchid_store_field_display_product_search_form' )->value() == true ) {

			return true;
		} else {
			
			return false;
		}	
	}
}


/**
 * Active callback function for when page header is enabled.
 */
if( ! function_exists( 'orchid_store_is_page_header_enabled' ) ) {

	function orchid_store_is_page_header_enabled( $control ) {

		if ( $control->manager->get_setting( 'orchid_store_field_display_page_header' )->value() == true ) {

			return true;
		} else {
			
			return false;
		}	
	}
}

/**
 * Active callback function to check if mini-cart is selected as cart.
 */
if ( ! function_exists( 'orchid_store_is_cart_mini_cart' ) ) {

	function orchid_store_is_cart_mini_cart( $control ) {
		

		$cart_display = $control->manager->get_setting( 'orchid_store_field_cart_display' )->value();

		return ( 'default' == $cart_display ) ? true : false;
	}
}

/**
 * Active callback function to check if floating-cart is selected as cart.
 */
if ( ! function_exists( 'orchid_store_is_cart_floating_cart' ) ) {

	function orchid_store_is_cart_floating_cart( $control ) {

		$is_mini_cart_enabled = $control->manager->get_setting( 'orchid_store_field_display_mini_cart' )->value();

		$cart_display = $control->manager->get_setting( 'orchid_store_field_cart_display' )->value();

		return ( true == $is_mini_cart_enabled && 'floating_cart' == $cart_display ) ? true : false;
	}
}


/**
 * Active callback function to check if mini-cart is enabled.
 */
if ( ! function_exists( 'orchid_store_is_mini_cart_enabled' ) ) {

	function orchid_store_is_mini_cart_enabled( $control ) {

		$is_mini_cart_enabled = $control->manager->get_setting( 'orchid_store_field_display_mini_cart' )->value();

		return ( true == $is_mini_cart_enabled ) ? true : false;
	}
} 



/**
 * Active callback function to check if wishlist is enabled.
 */
if ( ! function_exists( 'orchid_store_is_wishlist_enabled' ) ) {

	function orchid_store_is_wishlist_enabled( $control ) {

		$is_wishlist_enabled = $control->manager->get_setting( 'orchid_store_field_display_wishlist' )->value();

		return ( $is_wishlist_enabled == true ) ? true : false;
	}
}


/**
 * Active callback function that checks whether boxed site layout is enabled.
 *
 * @since 1.5.0
 *
 * @param object $control WP Customize Control.
 * @return boolean
 */
function orchid_store_is_boxed_site_layout_enabled( $control ) {

	$site_layout = $control->manager->get_setting( 'orchid_store_field_site_layout' )->value();

	return ( 'boxed' === $site_layout ) ? true : false;
}


/**
 * Active callback function that checks whether fullwidth site layout is enabled.
 *
 * @since 1.5.0
 *
 * @param object $control WP Customize Control.
 * @return boolean
 */
function orchid_store_is_fullwidth_site_layout_enabled( $control ) {

	$site_layout = $control->manager->get_setting( 'orchid_store_field_site_layout' )->value();

	return ( 'fullwidth' === $site_layout ) ? true : false;
}


/**
 * Active callback function that checks whether third-party search form is enabled.
 *
 * @since 1.5.0
 *
 * @param object $control WP Customize Control.
 * @return boolean
 */
function orchid_store_is_third_party_search_form_enabled( $control ) {

	$site_layout = $control->manager->get_setting( 'orchid_store_field_select_search_form' )->value();

	return ( 'third_party_search' === $site_layout ) ? true : false;
}


/**
 * Active callback function that checks whether add to cart button is enabled in product archive.
 *
 * @since 1.5.0
 *
 * @param object $control WP Customize Control.
 * @return boolean
 */
function orchid_store_is_add_to_cart_button_enabled_in_product_archive( $control ) {

	$add_to_cart_layout = $control->manager->get_setting( 'orchid_store_field_add_to_cart_button_placement' )->value();

	return ( 'none' !== $add_to_cart_layout ) ? true : false;
}


/**
 * Active callback function that checks whether percentage discount tag is disabled.
 *
 * @since 1.5.0
 *
 * @param object $control WP Customize Control.
 * @return boolean
 */
function orchid_store_is_percentage_discount_tag_disabled( $control ) {

	return $control->manager->get_setting( 'orchid_store_field_enable_percentage_sale_tag' )->value();
}
