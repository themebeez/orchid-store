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