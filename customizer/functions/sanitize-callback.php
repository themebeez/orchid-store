<?php
/**
 * Collection of functions to sanitize customizer field values.
 *
 * @package Orchid_Store
 */


/**
 * Sanitization callback function for number field with value in range.
 */
if ( ! function_exists( 'orchid_store_sanitize_range' ) ) {

    function orchid_store_sanitize_range( $input, $setting ) {

        if(  $input <= $setting->manager->get_control( $setting->id )->input_attrs['max'] ) {

            if( $input >= $setting->manager->get_control( $setting->id )->input_attrs['min'] ) {

                return absint( $input );
            }
        }
    }
}


/**
 * Sanitization callback function for number field.
 */
if ( ! function_exists( 'orchid_store_sanitize_number' ) ) {

    function orchid_store_sanitize_number( $input, $setting ) {

        return absint( $input );
    }
}


/**
 * Sanitization callback function for select field.
 */
if ( !function_exists('orchid_store_sanitize_select') ) {

    function orchid_store_sanitize_select( $input, $setting ) {

        $input = sanitize_key( $input );
        
        $choices = $setting->manager->get_control( $setting->id )->choices;
        
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
    }
}


/**
 * Sanitization callback function for sanitizing urls.
 */
if( ! function_exists( 'orchid_store_sanitize_urls' ) ) {

    function orchid_store_sanitize_urls( $input ) {

        if ( strpos( $input, ',' ) !== false) {

            $input = explode( ',', $input );
        }

        if ( is_array( $input ) ) {

            foreach ($input as $key => $value) {

                $input[$key] = esc_url_raw( $value );
            }

            $input = implode( ',', $input );
        } else {

            $input = esc_url_raw( $input );
        }

        return $input;
    }
}