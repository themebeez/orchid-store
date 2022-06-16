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
                'name'     => 'Themebeez Toolkit',
                'slug'     => 'themebeez-toolkit',
                'required' => false,
            ),
            array(
                'name'     => 'WooCommerce',
                'slug'     => 'woocommerce',
                'required' => false,
            ),
            array(
                'name'     => 'YITH WooCommerce Wishlist',
                'slug'     => 'yith-woocommerce-wishlist',
                'required' => false,
            ),
            array(
                'name'     => 'Elementor Page Builder',
                'slug'     => 'elementor',
                'required' => false,
            ),
        );

        if ( ! class_exists( 'YITH_WCQV' ) ) {

            $plugins[] = array(
                'name'     => 'Addonify Quick View',
                'slug'     => 'addonify-quick-view',
                'required' => false,
            );
        }

        tgmpa( $plugins );
    }

endif;
add_action( 'tgmpa_register', 'orchid_store_recommended_plugins' );