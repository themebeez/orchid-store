<?php
/**
 * Collection of functions to sanitize customizer field values.
 *
 * @package Orchid_Store
 */

if ( ! function_exists( 'orchid_store_sanitize_range' ) ) {
	/**
	 * Sanitization callback function for number field with value in range.
	 */
	function orchid_store_sanitize_range( $input, $setting ) {

		if ( $input <= $setting->manager->get_control( $setting->id )->input_attrs['max'] ) {

			if ( $input >= $setting->manager->get_control( $setting->id )->input_attrs['min'] ) {

				return absint( $input );
			}
		}
	}
}



if ( ! function_exists( 'orchid_store_sanitize_number' ) ) {
	/**
	 * Sanitization callback function for number field.
	 */
	function orchid_store_sanitize_number( $input, $setting ) {

		return absint( $input );
	}
}


if ( ! function_exists( 'orchid_store_sanitize_select' ) ) {
	/**
	 * Sanitization callback function for select field.
	 */
	function orchid_store_sanitize_select( $input, $setting ) {

		$input = sanitize_key( $input );

		$choices = $setting->manager->get_control( $setting->id )->choices;

		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}
}



if ( ! function_exists( 'orchid_store_sanitize_urls' ) ) {
	/**
	 * Sanitization callback function for sanitizing urls.
	 */
	function orchid_store_sanitize_urls( $input ) {

		if ( strpos( $input, ',' ) !== false ) {

			$input = explode( ',', $input );
		}

		if ( is_array( $input ) ) {

			foreach ( $input as $key => $value ) {

				$input[ $key ] = esc_url_raw( $value );
			}

			$input = implode( ',', $input );
		} else {

			$input = esc_url_raw( $input );
		}

		return $input;
	}
}

if ( ! function_exists( 'orchid_store_no_sanitize' ) ) {
	/**
	 * Sanitization callback function when there is no need for sanitization.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_no_sanitize( $input ) {

		return $input;
	}
}
