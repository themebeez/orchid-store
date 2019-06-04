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
 * Sanitization function for multiple select.
 */
if( !function_exists( 'orchid_store_sanitize_multiple_select' ) ) {

    function orchid_store_sanitize_multiple_select( $input, $setting ) {

        $choices = $setting->manager->get_control( $setting->id )->choices;

        if( !empty( $input ) ) {

            foreach( $input as $key ) {

                if( !array_key_exists( $key, $choices ) ) {

                    return $setting->default;
                }
            }
        }

        return $input;
    } 
}