<?php
/**
 * Collection of functions to sanitize customizer field values.
 *
 * @package Orchid_Store
 */

if ( ! function_exists( 'orchid_store_sanitize_range' ) ) {
	/**
	 * Sanitization callback function for number field with value in range.
	 *
	 * @param string $input Setting value.
	 * @param object $setting setting object.
	 * @return int.
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
	 * Sanitization callback for number field
	 *
	 * @param string $input Setting value.
	 * @return int
	 */
	function orchid_store_sanitize_number( $input ) {

		return absint( $input );
	}
}


if ( ! function_exists( 'orchid_store_sanitize_select' ) ) {
	/**
	 * Sanitization callback function for select field.
	 *
	 * @param string $input setting value.
	 * @param object $setting setting object.
	 * @return string.
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
	 *
	 * @param string $input setting value.
	 * @return string sanitized url.
	 */
	function orchid_store_sanitize_urls( $input ) {

		if ( strpos( $input, ',' ) ) {

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
	 * @param string $input setting value.
	 * @since 1.0.0
	 */
	function orchid_store_no_sanitize( $input ) {

		return $input;
	}
}
