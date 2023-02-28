<?php
/**
 * TGMPA plugins recommendation.
 *
 * @package Orchid_Store
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
				'name'     => 'Elementor Page Builder',
				'slug'     => 'elementor',
				'required' => false,
			),
		);

		if ( class_exists( 'WooCommerce' ) ) {

			if ( ! class_exists( 'Addonify_Quick_View' ) ) {

				$plugins[] = array(
					'name'     => 'Addonify WooCommerce Quick View',
					'slug'     => 'addonify-quick-view',
					'required' => false,
				);
			}

			if ( ! class_exists( 'Addonify_Wishlist' ) ) {

				$plugins[] = array(
					'name'     => 'Addonify WooCommerce Wishlist',
					'slug'     => 'addonify-wishlist',
					'required' => false,
				);
			}

			$plugins[] = array(
				'name'     => 'Addonify - Compare Products For WooCommerce',
				'slug'     => 'addonify-compare-products',
				'required' => false,
			);
		}

		tgmpa( $plugins );
	}

	add_action( 'tgmpa_register', 'orchid_store_recommended_plugins' );
endif;

