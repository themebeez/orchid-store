<?php
/**
 * Necessary functions for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Orchid_Store
 */


/**
 * Funtion To Get Google Fonts
 */
if ( !function_exists( 'orchid_store_lite_fonts_url' ) ) {
    /**
     * Return Font's URL.
     *
     * @since 1.0.0
     * @return string Fonts URL.
     */
    function orchid_store_lite_fonts_url() {

        $fonts_url = '';
        $fonts = array();
        $subsets = 'latin,latin-ext';

        /* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== _x('on', 'Lato font: on or off', 'orchid-store')) {
            $fonts[] = 'Lato:400,700,900';
        }

        /* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== _x('on', 'Poppins font: on or off', 'orchid-store')) {
            $fonts[] = 'Poppins:400,400i,500,700,800,900';
        }

        if ($fonts) {
            $fonts_url = add_query_arg(array(
                'family' => urldecode(implode('|', $fonts)),
                'subset' => urldecode($subsets),
            ), 'https://fonts.googleapis.com/css');
        }
        return $fonts_url;
    }
}


/**
 * Fallback For Main Menu
 */
if ( !function_exists( 'orchid_store_navigation_fallback' ) ) {

    function orchid_store_navigation_fallback() {
        ?>
        <ul class="primary-menu">
            <?php 
            wp_list_pages( array( 
                'title_li' => '', 
                'depth' => 4,
            ) ); 
            ?>
        </ul><!-- .primary-menu -->
        <?php    
    }
}


/**
 * Function to get post thumbnail alt text value.
 */
if( !function_exists( 'orchid_store_thumbnail_alt_text' ) ) {

    function orchid_store_thumbnail_alt_text( $post_id ) {

        $post_thumbnail_id = get_post_thumbnail_id( $post_id );

        $alt_text = '';

        if( !empty( $post_thumbnail_id ) ) {

            $alt_text = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true );
        }

        if( !empty( $alt_text ) ) {

            echo esc_attr( $alt_text );
        } else {

            the_title_attribute();
        }
    }
}

if( !function_exists( 'orchid_store_sidebar_position' ) ) {

    function orchid_store_sidebar_position() {

        $sidebar_position = '';

        $is_global_sidebar = orchid_store_get_option( 'enable_global_sidebar_position' );

        if( !is_active_sidebar( 'sidebar-1' ) ) {

            $sidebar_position = 'none';

            return $sidebar_position;
        }  

        if( class_exists( 'Woocommerce' ) || is_defined( 'YITH_WCWL' ) ) {

            if( is_cart() || is_checkout() || is_account_page() || is_page( 'wishlist' ) ) {

                $sidebar_position = 'none';

                return $sidebar_position;
            }
        }

        if( $is_global_sidebar == true ) {

            $sidebar_position = orchid_store_get_option( 'global_sidebar_position' );

            return $sidebar_position;
        }

        if( is_home() && !is_front_page() ) {

            $sidebar_position = orchid_store_get_option( 'blog_sidebar_position' );
        }

        if( is_archive() ) {

            $sidebar_position = orchid_store_get_option( 'archive_sidebar_position' );
        }

        if( is_search() ) {

            $sidebar_position = orchid_store_get_option( 'search_sidebar_position' );
        }

        if( is_single() ) {

            $sidebar_position = orchid_store_get_option( 'post_sidebar_position' );
        }

        if( is_page() ) {

            $sidebar_position = orchid_store_get_option( 'page_sidebar_position' );
        }

        if( class_exists( 'Woocommerce' ) ) {

            if( is_product() || is_woocommerce() || is_shop() ) {

                $sidebar_position = orchid_store_get_option( 'woocommerce_sidebar_position' );
            }
        }

        return $sidebar_position;
    }
} 

/**
 * Filters For Excerpt Length
 */
if( !function_exists( 'orchid_store_excerpt_length' ) ) :
    /*
     * Excerpt More
     */
    function orchid_store_excerpt_length( $length ) {

        if( is_admin() ) {

            return $length;
        }

        $excerpt_length = orchid_store_get_option( 'excerpt_length' );

        if ( absint( $excerpt_length ) > 0 ) {
            
            $excerpt_length = absint( $excerpt_length );
        }

        return $excerpt_length;
    }
endif;
add_filter( 'excerpt_length', 'orchid_store_excerpt_length' );


/**
 * Filter For Excerpt More
 */
if( !function_exists( 'orchid_store_excerpt_more' ) ) :

    function orchid_store_excerpt_more( $more ) {

        if ( is_admin() ) {

            return $more;
        }

        return '';
    }
endif;
add_filter( 'excerpt_more', 'orchid_store_excerpt_more' );