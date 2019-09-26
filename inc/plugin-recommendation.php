<?php

/*
 * Hook - Plugin Recommendation
 */
if ( ! function_exists( 'orchid_store_recommended_plugins' ) ) :
    /**
     * Recommend plugins.
     *
     * @since 1.0.0
     */
    function orchid_store_recommended_plugins() {

        $plugins = array(
            array(
                'name'     => esc_html__( 'Themebeez Toolkit', 'orchid-store' ),
                'slug'     => 'themebeez-toolkit',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'WooCommerce', 'orchid-store' ),
                'slug'     => 'woocommerce',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'YITH WooCommerce Wishlist', 'orchid-store' ),
                'slug'     => 'yith-woocommerce-wishlist',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'YITH WooCommerce Quick View', 'orchid-store' ),
                'slug'     => 'yith-woocommerce-quick-view',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'Elementor Page Builder', 'orchid-store' ),
                'slug'     => 'elementor',
                'required' => false,
            ),
        );

        tgmpa( $plugins );
    }

endif;
add_action( 'tgmpa_register', 'orchid_store_recommended_plugins' );