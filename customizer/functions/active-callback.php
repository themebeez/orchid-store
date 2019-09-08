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