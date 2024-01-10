<?php
/**
 * Necessary functions for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Orchid_Store
 */

if ( ! function_exists( 'orchid_store_lite_fonts_url' ) ) {
	/**
	 * Return Font's URL.
	 *
	 * @since 1.0.0
	 * @return string Fonts URL.
	 */
	function orchid_store_lite_fonts_url() {

		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Inter font: on or off', 'orchid-store' ) ) {
			$fonts[] = 'Inter:400,500,600,700,800';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg(
				array(
					'family' => urlencode( implode( '|', $fonts ) ), // phpcs:ignore
					'subset' => urlencode( $subsets ), // phpcs:ignore
				),
				'https://fonts.googleapis.com/css'
			);
		}

		return $fonts_url;
	}
}


if ( ! function_exists( 'orchid_store_breadcrumb_trail' ) ) {
	/**
	 * Shows a breadcrumb for all types of pages.  This is a wrapper function for the Breadcrumb_Trail class,
	 * which should be used in theme templates.
	 *
	 * @since  0.1.0
	 * @access public
	 * @param  array $args Arguments to pass to Breadcrumb_Trail.
	 */
	function orchid_store_breadcrumb_trail( $args = array() ) {

		$breadcrumb = apply_filters( 'breadcrumb_trail_object', null, $args );

		if ( ! is_object( $breadcrumb ) ) {
			$breadcrumb = new orchid_store_Breadcrumb_Trail( $args );
		}

		return $breadcrumb->trail();
	}
}


if ( ! function_exists( 'orchid_store_navigation_fallback' ) ) {
	/**
	 * Callback function for primary menu.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_navigation_fallback() {
		?>
		<ul class="primary-menu">
			<?php
			wp_list_pages(
				array(
					'title_li' => '',
					'depth'    => 4,
				)
			);
			?>
		</ul><!-- .primary-menu -->
		<?php
	}
}


if ( ! function_exists( 'orchid_store_special_menu_fallback' ) ) {
	/**
	 * Callback function for special menu.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_special_menu_fallback() {

		if ( ! class_exists( 'WooCommerce' ) ) {
			?>
			<ul class="category-navigation-list">
				<?php
				wp_list_pages(
					array(
						'title_li' => '',
						'depth'    => 2,
					)
				);
				?>
			</ul><!-- .primary-menu -->
			<?php
		} else {

			$product_categories = orchid_store_all_product_categories();

			if ( ! empty( $product_categories ) ) {
				?>
				<ul class="category-navigation-list">
					<?php
					foreach ( $product_categories as $product_category ) {
						?>
						<li>
							<a
								href="<?php echo esc_url( get_term_link( $product_category->term_id, 'product_cat' ) ); ?>"
								title="<?php echo esc_attr( $product_category->name ); ?>"
							>
								<?php echo esc_html( $product_category->name ); ?>
							</a>
						</li>
						<?php
					}
					?>
				</ul><!-- .primary-menu -->
				<?php
			}
		}
	}
}


if ( ! function_exists( 'orchid_store_thumbnail_alt_text' ) ) {
	/**
	 * Function to get post thumbnail alt text value.
	 *
	 * @since 1.0.0
	 *
	 * @param int $post_id Post id.
	 */
	function orchid_store_thumbnail_alt_text( $post_id ) {

		$post_thumbnail_id = get_post_thumbnail_id( $post_id );

		$alt_text = '';

		if ( $post_thumbnail_id ) {
			$alt_text = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true );
		}

		if ( $alt_text ) {
			echo esc_attr( $alt_text );
		} else {
			the_title_attribute();
		}
	}
}


if ( ! function_exists( 'orchid_store_sidebar_position' ) ) {
	/**
	 * Function to position sidebar according to the customization value.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_sidebar_position() {

		$sidebar_position = '';

		$is_global_sidebar = orchid_store_get_option( 'enable_global_sidebar_position' );

		if ( class_exists( 'WooCommerce' ) && is_woocommerce() ) {

			if ( ! is_active_sidebar( 'woocommerce-sidebar' ) ) {
				$sidebar_position = 'none';
			} elseif ( $is_global_sidebar ) {

					$sidebar_position = orchid_store_get_option( 'global_sidebar_position' );
			} else {
				if ( is_shop() || is_product_category() || is_product_tag() ) {
					$sidebar_position = get_theme_mod( 'orchid_store_field_woocommerce_sidebar_position', 'right' );
				}
				if ( is_product() ) {
					$sidebar_position = get_theme_mod( 'orchid_store_field_woocommerce_product_sidebar_position', 'right' );
				}
			}
		} elseif (
			class_exists( 'WooCommerce' ) &&
			(
				is_cart() ||
				is_checkout() ||
				is_account_page() ||
				(
					defined( 'YITH_WCWL' ) &&
					is_page( get_option( 'yith_wcwl_wishlist_page_id' ) )
				)
			)
		) {

				$sidebar_position = 'none';
		} elseif ( ! is_active_sidebar( 'sidebar-1' ) ) {

				$sidebar_position = 'none';
		} elseif ( $is_global_sidebar ) {

				$sidebar_position = orchid_store_get_option( 'global_sidebar_position' );
		} else {

			if ( is_home() ) {
				$sidebar_position = orchid_store_get_option( 'blog_sidebar_position' );
			}

			if ( is_archive() ) {
				$sidebar_position = orchid_store_get_option( 'archive_sidebar_position' );
			}

			if ( is_search() ) {
				$sidebar_position = orchid_store_get_option( 'search_sidebar_position' );
			}

			if ( is_single() ) {

				if ( orchid_store_get_option( 'enable_post_common_sidebar_position' ) ) {

					$sidebar_position = orchid_store_get_option( 'post_sidebar_position' );
				} else {

					$sidebar_position = get_post_meta( get_the_ID(), 'orchid_store_sidebar_position', true );

					if ( ! $sidebar_position ) {
						$sidebar_position = 'right';
					}
				}
			}

			if ( is_page() ) {

				if ( orchid_store_get_option( 'enable_page_common_sidebar_position' ) ) {

					$sidebar_position = orchid_store_get_option( 'page_sidebar_position' );
				} else {

					$sidebar_position = get_post_meta( get_the_ID(), 'orchid_store_sidebar_position', true );

					if ( ! $sidebar_position ) {
						$sidebar_position = 'right';
					}
				}
			}
		}

		return $sidebar_position;
	}
}


if ( ! function_exists( 'orchid_store_excerpt_length' ) ) {
	/**
	 * Modifies the length of post excerpt.
	 *
	 * @param int $length Post excerpt's length.
	 */
	function orchid_store_excerpt_length( $length ) {

		if ( is_admin() ) {

			return $length;
		}

		$excerpt_length = orchid_store_get_option( 'excerpt_length' );

		if ( absint( $excerpt_length ) > 0 ) {
			$length = absint( $excerpt_length );
		}

		return $length;
	}

	add_filter( 'excerpt_length', 'orchid_store_excerpt_length' );
}


if ( ! function_exists( 'orchid_store_excerpt_more' ) ) {
	/**
	 * Modifies the trailing string of post excerpt.
	 *
	 * @param string $more Post excerpt's trailing string.
	 */
	function orchid_store_excerpt_more( $more ) {

		return ( is_admin() ) ? $more : '';
	}

	add_filter( 'excerpt_more', 'orchid_store_excerpt_more' );
}


if ( ! function_exists( 'orchid_store_default_archive_widget' ) ) {
	/**
	 * Modifies the archive HTML link content.
	 *
	 * @param string $link_html The archive HTML link content.
	 */
	function orchid_store_default_archive_widget( $link_html ) {

		$link_html = str_replace( '</a>&nbsp;(', '</a> <span class="count">(', $link_html );
		$link_html = str_replace( ')', ')</span>', $link_html );
		return $link_html;
	}

	add_filter( 'get_archives_link', 'orchid_store_default_archive_widget' );
}


if ( ! function_exists( 'orchid_store_cat_count_span' ) ) {
	/**
	 * Modifies the HTML output of a taxonomy list.
	 *
	 * @since 1.0.0
	 *
	 * @param string $output HTML output.
	 */
	function orchid_store_cat_count_span( $output ) {

		$output = str_replace( '</a> (', '</a><span class="count">(', $output );
		$output = str_replace( ')', ')</span>', $output );
		return $output;
	}

	add_filter( 'wp_list_categories', 'orchid_store_cat_count_span' );
}


if ( ! function_exists( 'orchid_store_get_alt_text_of_image' ) ) {
	/**
	 * Get alt text for the image.
	 *
	 * @param string $image_url Image URL.
	 * @return string $alt The alt text.
	 */
	function orchid_store_get_alt_text_of_image( $image_url ) {

		// Get attachment id of the image.
		$attachment_id = attachment_url_to_postid( $image_url );

		// Get the alt text from the attachment meta.
		$alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );

		// If alt is empty then get the post title of the attachment by attachment id.
		if ( ! $alt ) {

			$attachment_post = get_post( $attachment_id );

			if ( $attachment_post ) {
				$alt = $attachment_post->post_title;
			}
		}

		return ( $alt ) ? $alt : '';
	}
}
