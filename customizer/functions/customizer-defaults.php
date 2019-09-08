<?php

if ( ! function_exists( 'orchid_store_get_option' ) ) {

    /**
     * Get theme option.
     *
     * @since 1.0.0
     *
     * @param string $key Option key.
     * @return mixed Option value.
     */
    function orchid_store_get_option( $key ) {

        if ( empty( $key ) ) {
            return;
        }

        $fullkey = 'orchid_store_field_'. $key;

        $value = '';

        $default = orchid_store_get_default_theme_options();

        $default_value = null;

        if ( is_array( $default ) && isset( $default[ $key ] ) ) {
            $default_value = $default[ $key ];
        }

        if ( null !== $default_value ) {
            $value = get_theme_mod( $fullkey, $default_value );
        }
        else {
            $value = get_theme_mod( $fullkey );
        }

        return $value;
    }
}


if ( ! function_exists( 'orchid_store_get_default_theme_options' ) ) {

    /**
     * Get default theme options.
     *
     * @since 1.0.0
     *
     * @return array Default theme options.
     */
    function orchid_store_get_default_theme_options() {

        $defaults = array(

            'display_top_header' => true,
            'top_header_facebook_link' => '',
            'top_header_twitter_link' => '',
            'top_header_instagram_link' => '',
            'top_header_pinterest_link' => '',
            'top_header_youtube_link' => '',
            'top_header_google_plus_link' => '',
            'top_header_linkedin_link' => '',
            'top_header_vk_link' => '',

            'display_special_menu' => true,
            'special_menu_title' => esc_html__( 'Special Menu', 'orchid-store' ),

            'blog_display_cats' => true,
            'blog_display_excerpt' => true,
            'blog_display_date' => true,
            'blog_display_author' => true,
            'blog_sidebar_position' => 'right',

            'archive_display_cats' => true,
            'archive_display_excerpt' => true,
            'archive_display_date' => true,
            'archive_display_author' => true,
            'archive_sidebar_position' => 'right',

            'search_display_cats' => true,
            'search_display_excerpt' => true,
            'search_display_date' => true,
            'search_display_author' => true,
            'search_sidebar_position' => 'right',

            'enable_sticky_sidebar' => true,
            'enable_sidebar_small_devices' => true,
            'enable_global_sidebar_position' => false,
            'global_sidebar_position' => 'right',

            'display_post_featured_image' => true,
            'display_post_cats' => true,
            'display_post_date' => true,
            'display_post_author' => true,
            'display_post_tags' => true,
            'post_sidebar_position' => 'right',

            'display_page_featured_image' => true,
            'page_sidebar_position' => 'right',

            'copyright_text' => '',
            'payments_image' => '',

            'excerpt_length' => 30,
        );

        if( class_exists( 'Woocommerce' ) ) {
            
            $defaults['orchid_store_field_woocommerce_sidebar_position'] = 'right';
            $defaults['orchid_store_field_shop_product_col_no'] = 3;
            $defaults['orchid_store_field_related_product_col_no'] = 3;
            $defaults['orchid_store_field_related_product_no'] = 3;
            $defaults['orchid_store_field_upsell_product_col_no'] = 3;
            $defaults['orchid_store_field_cross_sell_product_col_no'] = 3;
        }

        $defaults['orchid_store_field_enable_home_content'] = false;

        return $defaults;
    }
}