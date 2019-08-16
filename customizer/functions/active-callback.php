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