<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Orchid_Store
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function orchid_store_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'orchid_store_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function orchid_store_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'orchid_store_pingback_header' );


if( ! function_exists( 'orchid_store_sidebar_class' ) ) {

	function orchid_store_sidebar_class() {

		$sidebar_class = 'col-lg-4 col-md-12 col-sm-12 col-12';

		$sidebar_position = orchid_store_sidebar_position();

		$is_sticky = orchid_store_get_option( 'enable_sticky_sidebar' );

		$enable_on_small_devices = orchid_store_get_option( 'enable_sidebar_small_devices' );

		if( $is_sticky == true && $sidebar_position != 'none' ) {
			$sidebar_class .= ' sticky-portion';
		}

		if( $enable_on_small_devices == false && $sidebar_position != 'none' ) {
			$sidebar_class .= ' hide-in-small';
		}

		if( $sidebar_position == 'left' ) {
			$sidebar_class .= ' order-first';
		}

		echo esc_attr( $sidebar_class );
	}
}


if( ! function_exists( 'orchid_store_content_container_class' ) ) {

	function orchid_store_content_container_class() {

		$container_class = '';

		$sidebar_position = orchid_store_sidebar_position();

		if( $sidebar_position == 'none' ) {

			$container_class = 'col-lg-12';

		} else {

			$container_class = 'col-lg-8 col-md-12 col-sm-12 col-12';

			$is_sticky = orchid_store_get_option( 'enable_sticky_sidebar' );

			if( $is_sticky == true && $sidebar_position != 'none' ) {

				$container_class .= ' sticky-portion';
			}

			if( $sidebar_position == 'left' ) {

				$container_class .= ' order-last';
			}
		}

		echo esc_attr( $container_class );
	}
}


if( ! function_exists( 'orchid_store_content_entry_class' ) ) {

	function orchid_store_content_entry_class() {

		$content_entry_class = '';

		if( class_exists( 'Woocommerce' ) || is_defined( 'YITH_WCWL' ) ) {

            if( is_cart() || is_checkout() || is_account_page() || is_page( 'wishlist' ) || is_woocommerce() || is_shop() || is_product() ) {

                $content_entry_class = '__os-woo-entry__';

                echo esc_attr( $content_entry_class );

                return;
            }
        }

        if( is_single() || is_page() ) {

        	$content_entry_class = 'editor-entry';

        	echo esc_attr( $content_entry_class );

        	return;
        }
	}
}
