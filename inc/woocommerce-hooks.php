<?php
/**
 * Load custom woocommerce hooks necessary for theme.
 *
 * @package Orchid_Store
 */

if ( ! function_exists( 'orchid_store_product_search_action' ) ) {
	/**
	 * Renders search form in the header.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_product_search_action() {

		$mobile_product_search_class = '';

		if ( orchid_store_get_option( 'display_product_search_form_on_mobile' ) ) {

			$mobile_product_search_class = 'os-mobile-show';
		}
		?>
		<div class="custom-search <?php echo esc_attr( $mobile_product_search_class ); ?>">
			<?php get_product_search_form(); ?>
		</div><!-- .custom-search -->
		<?php
	}

	add_action( 'orchid_store_product_search', 'orchid_store_product_search_action', 10 );
}


if ( ! function_exists( 'orchid_store_third_party_product_search_action' ) ) {
	/**
	 * Renders third-party search form in the header.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_third_party_product_search_action() {

		$search_from_shortcode = orchid_store_get_option( 'search_form_shortcode' );

		if ( empty( $search_from_shortcode ) ) {
			return;
		}

		$mobile_product_search_class = '';

		if ( orchid_store_get_option( 'display_product_search_form_on_mobile' ) ) {

			$mobile_product_search_class = 'os-mobile-show';
		}
		?>
		<div class="custom-search <?php echo esc_attr( $mobile_product_search_class ); ?>">
			<?php echo do_shortcode( $search_from_shortcode ); ?>
		</div><!-- .custom-search -->
		<?php
	}

	add_action( 'orchid_store_third_party_product_search', 'orchid_store_third_party_product_search_action', 10 );
}


if ( ! function_exists( 'orchid_store_wishlist_icon_action' ) ) {
	/**
	 * Renders wishlist icon in the header.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_wishlist_icon_action() {

		if ( ! class_exists( 'YITH_WCWL' ) && ! class_exists( 'Addonify_Wishlist' ) ) {
			return;
		}

		$wishlist_page_url = '';

		$wishlist_count = 0;

		if ( class_exists( 'Addonify_Wishlist' ) ) {

			$wishlist_page_url = get_permalink( (int) get_option( 'addonify_wishlist_wishlist_page' ) );
			$wishlist_count    = addonify_wishlist_get_wishlist_items_count();

		}

		if ( class_exists( 'YITH_WCWL' ) ) {
			$wishlist_page_url = orchid_store_get_yith_wishlist_page_url();
			$wishlist_count    = yith_wcwl_count_all_products();
		}

		if ( $wishlist_page_url ) {
			?>
			<div class="wishlist-icon-container">
				<a href="<?php echo esc_url( $wishlist_page_url ); ?>"><i class='fa fa-heart-o'></i> 
					<?php if ( orchid_store_get_option( 'display_wishlist_items_count' ) ) { ?>
						<span class="item-count wishlist-items-count"><?php echo esc_html( $wishlist_count ); ?></span>
					<?php } ?>
				</a>
			</div><!-- .wishlist-icon-container -->
			<?php
		}
	}

	add_action( 'orchid_store_wishlist_icon', 'orchid_store_wishlist_icon_action', 10 );
}



if ( ! function_exists( 'orchid_store_mini_cart_action' ) ) {
	/**
	 * Renders wishlist icon in the header.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_mini_cart_action() {

		if ( ! class_exists( 'WooCommerce' ) ) {

			return;
		}
		?>
		<div class="mini-cart">
			<button class="trigger-mini-cart">
				<i class='bx bx-cart'></i>
				<?php if ( orchid_store_get_option( 'display_cart_items_count' ) ) { ?>
					<span class="item-count cart-items-count">
						<?php echo WC()->cart->get_cart_contents_count(); // phpcs:ignore ?>
					<span>
				<?php } ?>
			</button><!-- .trigger-mini-cart -->
			<span class="cart-amount"><?php esc_html_e( 'Total:', 'orchid-store' ); ?>
				<span class="price">	                
					<span class="woocommerce-Price-amount amount os-minicart-amount"><?php echo wp_kses_post( WC()->cart->get_cart_subtotal() ); ?></span>
				</span><!-- .price -->
			</span><!-- .cart-amount -->
			<?php
			if ( ! is_cart() && ! is_checkout() ) {
				?>
				<div class="mini-cart-open">
					<div class="mini-cart-items">
						<?php

						$instance = array( 'title' => '' );

						the_widget( 'WC_Widget_Cart', $instance );
						?>
					</div><!-- .mini-cart-tems -->
				</div><!-- .mini-cart-open -->
				<?php
			}
			?>
		</div><!-- .mini-cart -->
		<?php
	}
}
add_action( 'orchid_store_mini_cart', 'orchid_store_mini_cart_action', 10 );


if ( ! function_exists( 'orchid_store_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function orchid_store_woocommerce_header_cart() {

		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php orchid_store_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}

	add_action( 'orchid_store_woocommerce_header_cart', 'orchid_store_woocommerce_template_header_cart', 10 );
}



if ( ! function_exists( 'orchid_store_user_links_action' ) ) {
	/**
	 * Renders account and wishlist page links in the header.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_user_links_action() {

		if (
			! class_exists( 'WooCommerce' ) &&
			(
				! class_exists( 'YITH_WCWL' ) &&
				! class_exists( 'Addonify_Wishlist' )
			)
		) {

			return;
		}
		?>
		<nav class="login_register_link">
			<ul>
				<?php
				if ( class_exists( 'WooCommerce' ) ) {
					?>
					<li>
						<?php
						if ( is_user_logged_in() ) {
							?>
							<a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>"><i class='bx bx-user'></i> <?php esc_html_e( 'My account', 'orchid-store' ); ?></a>
							<?php
						} else {
							?>
							<a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>"><i class='bx bx-user'></i> <?php esc_html_e( 'Login / Register', 'orchid-store' ); ?></a>
							<?php
						}
						?>
					</li>
					<?php
				}

				if (
					class_exists( 'YITH_WCWL' ) ||
					class_exists( 'Addonify_Wishlist' )
				) {

					$wishlist_page_url = '';

					if ( class_exists( 'Addonify_Wishlist' ) ) {
						$wishlist_page_url = get_permalink( (int) get_option( 'addonify_wishlist_wishlist_page' ) );
					}

					if ( class_exists( 'YITH_WCWL' ) ) {
						$wishlist_page_url = orchid_store_get_yith_wishlist_page_url();
					}

					if ( $wishlist_page_url ) {
						?>
						<li><a href="<?php echo esc_url( $wishlist_page_url ); ?>"><i class='fa fa-heart-o'></i> <?php esc_html_e( 'My Wishlist', 'orchid-store' ); ?></a></li>
						<?php
					}
				}
				?>
			</ul>
		</nav>
		<?php
	}

	add_action( 'orchid_store_user_links', 'orchid_store_user_links_action', 10 );
}


if ( ! function_exists( 'orchid_store_product_categories_list_action' ) ) {
	/**
	 * Renders category navigation dropdown in the header.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_product_categories_list_action() {

		if ( ! has_nav_menu( 'menu-3' ) ) {
			return;
		}
		?>
		<div class="category-nav">
			<div class="cat-nav-entry overflow-hidden">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-3',
						'container'      => '',
						'menu_class'     => 'overflow-hidden',
						'menu_id'        => '',
						'depth'          => 1,
					)
				);
				?>
			</div><!-- .cat-nav-entry -->
		</div><!-- .category-nav -->
		<?php
	}

	add_action( 'orchid_store_product_categories_list', 'orchid_store_product_categories_list_action', 10 );
}


if ( ! function_exists( 'orchid_store_template_loop_product_thumbnail' ) ) {
	/**
	 * Get the product thumbnail for the loop.
	 */
	function orchid_store_template_loop_product_thumbnail() {

		global $product;

		if ( get_theme_mod( 'orchid_store_field_display_out_of_stock_notice', false ) === true ) {

			if ( ! $product->is_in_stock() ) {

				echo wp_kses_post( wc_get_stock_html( $product ) );
			}
		}

		/**
		 * Hook: orchid_store_loop_product_link_open.
		 *
		 * @hooked woocommerce_template_loop_product_link_open - 10
		 */
		do_action( 'orchid_store_loop_product_link_open' );

		echo woocommerce_get_product_thumbnail(); // phpcs:ignore.

		$effect_on_image_on_hover = get_theme_mod( 'orchid_store_field_on_hover_image_effect', 'none' );

		if ( 'swap' === $effect_on_image_on_hover ) {

			$gallery_image_ids = $product->get_gallery_image_ids();

			if ( is_array( $gallery_image_ids ) && count( $gallery_image_ids ) > 0 ) {

				$additional_attr = array(
					'alt'   => esc_attr( get_the_title() ),
					'class' => 'secondary-image',
				);

				$secondary_image = wp_get_attachment_image( $gallery_image_ids[0], 'woocommerce_thumbnail', false, $additional_attr );

				echo $secondary_image; // phpcs:ignore
			}
		}

		if ( get_theme_mod( 'orchid_store_field_add_to_cart_button_placement', 'default' ) === 'over_image' ) {
			?>
			<div class="custom-cart-btn">
				<?php
				/**
				 * Hook: orchid_store_loop_add_to_cart.
				 *
				 * @hooked woocommerce_template_loop_add_to_cart - 10
				 */
				do_action( 'orchid_store_loop_add_to_cart' );
				?>
			</div>
			<?php
		}

		/**
		 * Hook: orchid_store_loop_product_link_close.
		 *
		 * @hooked woocommerce_template_loop_product_link_close - 10
		 */
		do_action( 'orchid_store_loop_product_link_close' );
	}
}


if ( ! function_exists( 'orchid_store_template_loop_product_title' ) ) {
	/**
	 * Renders product title.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_template_loop_product_title() {

		/**
		 * Hook: orchid_store_loop_product_link_open.
		 *
		 * @hooked woocommerce_template_loop_product_link_open - 10
		 */
		do_action( 'orchid_store_loop_product_link_open' );

		echo '<h2 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . wp_kses_post( get_the_title() ) . '</h2>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		/**
		 * Hook: orchid_store_loop_product_link_close.
		 *
		 * @hooked woocommerce_template_loop_product_link_close - 10
		 */
		do_action( 'orchid_store_loop_product_link_close' );
	}
}


if ( ! function_exists( 'orchid_store_template_loop_product_quick_link' ) ) {
	/**
	 * Renders wishlist, quick view, and compare buttons.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_template_loop_product_quick_link() {

		if (
			! class_exists( 'YITH_WCWL' ) &&
			! class_exists( 'YITH_WCQV' ) &&
			! class_exists( 'Addonify_Quick_View' ) &&
			! class_exists( 'Addonify_Wishlist' ) &&
			! class_exists( 'Addonify_Compare_Products' )
		) {

			return;
		}

		global $product;
		?>
		<div class="product-hover-items">
			<?php
			if (
				class_exists( 'YITH_WCQV' ) ||
				class_exists( 'Addonify_Quick_View' )
			) {

				$icon = '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M23.707,22.293l-5.969-5.969a10.016,10.016,0,1,0-1.414,1.414l5.969,5.969a1,1,0,0,0,1.414-1.414ZM10,18a8,8,0,1,1,8-8A8.009,8.009,0,0,1,10,18Z"/></svg>';

				if (
					class_exists( 'Addonify_Quick_View' ) &&
					get_option( 'addonify_qv_enable_quick_view', true )
				) {
					?>
					<a 
						class="os-tooltip view-product addonify-qvm-button" 
						data-tippy-content="<?php echo get_option( 'addonify_qv_quick_view_btn_label' ) ? esc_attr( get_option( 'addonify_qv_quick_view_btn_label' ) ) : esc_attr__( 'Quick View', 'orchid-store' ); ?>" 
						data-product_id="<?php echo esc_attr( $product->get_id() ); ?>"
						href="#"
					>
						<span class="icon">
							<?php echo orchid_store_escape_svg( $icon ); // phpcs:ignore ?>
						</span>
					</a>
					<?php
				}

				if ( class_exists( 'YITH_WCQV' ) ) {
					?>
					<a 
						class="os-tooltip view-product yith-wcqv-button" 
						data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" 
						data-tippy-content="<?php echo esc_attr( get_option( 'yith-wcqv-button-label' ) ); ?>" href="#">
						<span class="icon">
							<?php echo orchid_store_escape_svg( $icon ); // phpcs:ignore ?>
						</span>
					</a>
					<?php
				}
			}
			if (
				class_exists( 'YITH_WCWL' ) ||
				class_exists( 'Addonify_Wishlist' )
			) {
				if (
					class_exists( 'Addonify_Wishlist' ) &&
					get_option( 'addonify_wishlist_enable_wishlist', true )
				) {
					$addonify_wishlist_button_classes = array( 'os-tooltip', 'adfy-wishlist-btn', 'addonify-add-to-wishlist-btn', 'addonify-custom-wishlist-btn' );

					if ( addonify_wishlist_is_product_in_wishlist( $product->get_id() ) ) {
						$addonify_wishlist_button_classes[] = 'added-to-wishlist';
					}

					$tooltip_text = ( addonify_wishlist_is_product_in_wishlist( $product->get_id() ) ) ? get_option( 'btn_label_if_added_to_wishlist', __( 'Already in wishlist', 'orchid-store' ) ) : get_option( 'addonify_wishlist_btn_label', __( 'Add to wishlist', 'orchid-store' ) );

					$wishlist_icons = array(
						'initial' => '<svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="currentColor"><path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z"/></svg>',
						'added'   => '<svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="currentColor"><path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z"/></svg>',
					);

					$icon = ( addonify_wishlist_is_product_in_wishlist( $product->get_id() ) ) ? $wishlist_icons['added'] : $wishlist_icons['initial'];

					if ( ! is_user_logged_in() ) {

						if ( 1 === (int) addonify_wishlist_get_option( 'require_login' ) ) {

							if ( 'show_popup' === addonify_wishlist_get_option( 'if_not_login_action' ) ) {

								$addonify_wishlist_button_classes[] = 'os-addtowishlist-btn addonify-wishlist-login-popup-enabled';
								?>
								<a
									href="#"
									class="<?php echo esc_attr( implode( ' ', $addonify_wishlist_button_classes ) ); ?>" 
									data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" 
									data-product_name="<?php echo esc_attr( $product->get_name() ); ?>"
									data-tippy-content="<?php echo esc_attr( $tooltip_text ); ?>"
								>
									<span class="w-icon">
										<?php echo orchid_store_escape_svg( $icon ); ?>
									</span>
								</a>
								<?php
							} else {
								$login_url = ( get_option( 'woocommerce_myaccount_page_id' ) ) ? get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) : wp_login_url();
								?>
								<a 
									href="<?php echo esc_url( $login_url ); ?>" 
									class="<?php echo esc_attr( implode( ' ', $addonify_wishlist_button_classes ) ); ?>"
									data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" 
									data-product_name="<?php echo esc_attr( $product->get_name() ); ?>"
									data-tippy-content="<?php echo esc_attr( $tooltip_text ); ?>"
								>
									<span class="w-icon">
										<?php echo orchid_store_escape_svg( $icon ); ?>
									</span>
								</a>
								<?php
							}
						} else {
							$addonify_wishlist_button_classes[] = 'os-addtowishlist-btn addonify-wishlist-ajax-add-to-wishlist';
							?>
							<a
								href="#"
								class="<?php echo esc_attr( implode( ' ', $addonify_wishlist_button_classes ) ); ?>" 
								data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" 
								data-product_name="<?php echo esc_attr( $product->get_name() ); ?>"
								data-tippy-content="<?php echo esc_attr( $tooltip_text ); ?>"
							>
								<span class="w-icon">
									<?php echo orchid_store_escape_svg( $icon ); ?>
								</span>
							</a>
							<?php
						}
					} else {
						$href = '#';
						if ( addonify_wishlist_get_option( 'after_add_to_wishlist_action' ) === 'redirect_to_wishlist_page' ) {
							$href = '?addonify-add-to-wishlist=' . esc_attr( $product->get_id() );
						} else {
							$addonify_wishlist_button_classes[] = 'os-addtowishlist-btn addonify-wishlist-ajax-add-to-wishlist';
						}
						?>
						<a
							href="<?php echo esc_url( $href ); ?>"
							class="<?php echo esc_attr( implode( ' ', $addonify_wishlist_button_classes ) ); ?>" 
							data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" 
							data-product_name="<?php echo esc_attr( $product->get_name() ); ?>"
							data-tippy-content="<?php echo esc_attr( $tooltip_text ); ?>"
						>
							<span class="w-icon">
								<?php echo orchid_store_escape_svg( $icon ); // phpcs:ignore ?>
							</span>
						</a>
						<?php
					}
				}

				if ( class_exists( 'YITH_WCWL' ) ) {
					?>
					<?php echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); ?>
					<?php
				}
			}

			if (
				class_exists( 'Addonify_Compare_Products' ) &&
				get_option( 'addonify_cp_enable_product_comparison', true )
			) {

				$addonify_compare_products_button_classes = array( 'os-tooltip', 'addonify-cp-button' );

				$compare_icons = array(
					'initial' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M22.485,10.975,12,17.267,1.515,10.975A1,1,0,1,0,.486,12.69l11,6.6a1,1,0,0,0,1.03,0l11-6.6a1,1,0,1,0-1.029-1.715Z"/><path d="M22.485,15.543,12,21.834,1.515,15.543A1,1,0,1,0,.486,17.258l11,6.6a1,1,0,0,0,1.03,0l11-6.6a1,1,0,1,0-1.029-1.715Z"/><path d="M12,14.773a2.976,2.976,0,0,1-1.531-.425L.485,8.357a1,1,0,0,1,0-1.714L10.469.652a2.973,2.973,0,0,1,3.062,0l9.984,5.991a1,1,0,0,1,0,1.714l-9.984,5.991A2.976,2.976,0,0,1,12,14.773ZM2.944,7.5,11.5,12.633a.974.974,0,0,0,1,0L21.056,7.5,12.5,2.367a.974.974,0,0,0-1,0h0Z"/></svg>',
					'added'   => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M22.485,10.975,12,17.267,1.515,10.975A1,1,0,1,0,.486,12.69l11,6.6a1,1,0,0,0,1.03,0l11-6.6a1,1,0,1,0-1.029-1.715Z"/><path d="M22.485,15.543,12,21.834,1.515,15.543A1,1,0,1,0,.486,17.258l11,6.6a1,1,0,0,0,1.03,0l11-6.6a1,1,0,1,0-1.029-1.715Z"/><path d="M.485,8.357l9.984,5.991a2.97,2.97,0,0,0,3.062,0l9.984-5.991a1,1,0,0,0,0-1.714L13.531.652a2.973,2.973,0,0,0-3.062,0L.485,6.643a1,1,0,0,0,0,1.714Z"/></svg>',
				);

				$icon = $compare_icons['initial'];

				if (
					function_exists( 'addonify_compare_products_is_product_in_compare_cookie' ) &&
					addonify_compare_products_is_product_in_compare_cookie( $product->get_id() )
				) {
					$addonify_compare_products_button_classes[] = 'selected';
					$icon                                       = $compare_icons['added'];
				}

				if (
					function_exists( 'addonify_compare_products_get_compare_products_list' ) &&
					in_array( $product->get_id(), addonify_compare_products_get_compare_products_list() ) // phpcs:ignore
				) {
					$addonify_compare_products_button_classes[] = 'selected';
					$icon                                       = $compare_icons['added'];
				}

				$tooltip_text = get_option( 'compare_products_btn_label', __( 'Compare', 'orchid-store' ) );
				?>
					<a
						href="#" 
						class="<?php echo esc_attr( implode( ' ', $addonify_compare_products_button_classes ) ); ?> os-addtocompare-btn" 
						data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" 
						data-product_name="<?php echo esc_attr( $product->get_name() ); ?>"
						data-tippy-content="<?php echo esc_attr( $tooltip_text ); ?>"
					>
						<span class="icon"><?php echo orchid_store_escape_svg( $icon ); // phpcs:ignore ?></span>
					</a>
				<?php
			}
			?>
		</div><!-- .product-hover-items -->
		<?php
	}
}


if ( ! function_exists( 'orchid_store_woocommerce_title_breadcrumb_action' ) ) {
	/**
	 * Renders breadcrumbs in WooCommerce pages.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_woocommerce_title_breadcrumb_action() {

		if ( ! class_exists( 'WooCommerce' ) ) {

			return;
		}

		if ( is_product() ) {

			$display_breadcrumb = orchid_store_get_option( 'display_breadcrumb' );

			if ( $display_breadcrumb ) {
				?>
				<div class="os-page-breadcrumb-wrap">
					<div class="__os-container__">
						<div class="os-breadcrumb">
							<?php
							/**
							 * Hook - orchid_store_woocommerce_breadcrumb.
							 *
							 * @hooked woocommerce_breadcurmb - 20
							 */
							do_action( 'orchid_store_woocommerce_breadcrumb' );
							?>
						</div><!-- .os-breadcrumb -->
					</div><!-- .__os-container__ -->
				</div><!-- .os-product-single-breadcrumb-wrap -->
				<?php
			}
		} else {

			if ( orchid_store_get_option( 'display_page_header' ) ) {
				?>
				<div
					class="os-breadcrumb-wrap"
					<?php
					if ( has_header_image() ) {
						?>
						style="background-image: url(<?php header_image(); ?>);"
						<?php
					}
					?>
				>
					<div class="__os-container__">
						<div class="breadcrumb-inner">
							<?php
							if ( orchid_store_get_option( 'display_page_title' ) ) {
								?>
								<div class="title">
									<h1 class="entry-title page-title"><?php woocommerce_page_title(); ?></h1>
								</div><!-- .title -->
								<?php
							}

							$display_breadcrumb = orchid_store_get_option( 'display_breadcrumb' );

							if ( $display_breadcrumb ) {
								?>
								<div class="os-breadcrumb">
									<?php
									/**
									 * Hook - orchid_store_woocommerce_breadcrumb.
									 *
									 * @hooked woocommerce_breadcurmb - 20
									 */
									do_action( 'orchid_store_woocommerce_breadcrumb' );
									?>
								</div><!-- .os-breadcrumb -->
								<?php
							}
							?>
						</div><!-- .breadcrumb-inner -->
					</div><!-- .os-container -->
					<div class="mask"></div>
				</div><!-- .os-breadcrumb-wrap -->
				<?php
			} else {

				$display_breadcrumb = orchid_store_get_option( 'display_breadcrumb' );

				if ( $display_breadcrumb ) {
					?>
					<div class="os-page-breadcrumb-wrap">
						<div class="__os-container__">
							<div class="os-breadcrumb">
								<?php
								/**
								 * Hook - orchid_store_woocommerce_breadcrumb.
								 *
								 * @hooked woocommerce_breadcurmb - 20
								 */
								do_action( 'orchid_store_woocommerce_breadcrumb' );
								?>
							</div><!-- .os-breadcrumb -->
						</div><!-- .__os-container__ -->
					</div><!-- .os-product-single-breadcrumb-wrap -->
					<?php
				}
			}
		}
	}

	add_action( 'orchid_store_woocommerce_title_breadcrumb', 'orchid_store_woocommerce_title_breadcrumb_action', 10 );
}




if ( ! function_exists( 'orchid_store_quantity_minus' ) ) {
	/**
	 * Renders quantity decrement button.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_quantity_minus() {

		global $product;

		if (
			$product->is_sold_individually() ||
			$product->get_stock_quantity() === 1
		) {

			return;
		}
		?>
		<div class="os-quantity-wrapper">
			<button type="button" class="woo-quantity-btn woo-quantity-minus" ><i class='bx bx-minus' ></i></button>
		<?php
	}
}


if ( ! function_exists( 'orchid_store_quantity_plus' ) ) {
	/**
	 * Renders quantity increment button.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_quantity_plus() {

		global $product;

		if (
			$product->is_sold_individually() ||
			$product->get_stock_quantity() === 1
		) {

			return;
		}
		?>
			<button type="button" class="woo-quantity-btn woo-quantity-plus" ><i class='bx bx-plus'></i></button>
		</div>
		<?php
	}
}


if ( ! function_exists( 'orchid_store_get_woocommerce_sidebar' ) ) {
	/**
	 * Renders WooCommerce sidebar.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_get_woocommerce_sidebar() {

		$sidebar_position = orchid_store_sidebar_position();

		if ( 'none' === $sidebar_position ) {

			return;
		}
		?>
		<div class="<?php orchid_store_sidebar_class(); ?>">
			<aside id="secondary" class="secondary-widget-area os-woocommerce-sidebar">
				<?php dynamic_sidebar( 'woocommerce-sidebar' ); ?>
			</aside><!-- #secondary -->
		</div><!-- .col -->
		<?php
	}
}


if ( ! function_exists( 'orchid_store_get_yith_wishlist_page_url' ) ) {
	/**
	 * Gets the YITH wishlist page link.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_get_yith_wishlist_page_url() {

		if ( ! class_exists( 'YITH_WCWL' ) ) {
			return;
		}

		$wishlist_page_id = get_option( 'yith_wcwl_wishlist_page_id' );

		if ( $wishlist_page_id ) {

			return get_page_link( absint( $wishlist_page_id ) );
		}
	}
}



if ( ! function_exists( 'orchid_store_update_wishlist_count' ) ) {
	/**
	 * Updates wishlist items count.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_update_wishlist_count() {

		if ( class_exists( 'Addonify_Wishlist' ) ) {
			wp_send_json(
				array(
					'count' => addonify_wishlist_get_wishlist_items_count(),
				)
			);
		} elseif ( class_exists( 'YITH_WCWL' ) ) {
			wp_send_json(
				array(
					'count' => yith_wcwl_count_all_products(),
				)
			);
		} else {
			wp_send_json(
				array(
					'count' => 0,
				)
			);
		}
	}

	add_action( 'wp_ajax_orchid_store_update_wishlist_count', 'orchid_store_update_wishlist_count' );
	add_action( 'wp_ajax_nopriv_orchid_store_update_wishlist_count', 'orchid_store_update_wishlist_count' );
}



if ( ! function_exists( 'orchid_store_refresh_cart_count' ) ) {
	/**
	 * Updates cart items count with cart fragments.
	 *
	 * @since 1.0.0
	 *
	 * @param array $fragments Cart fragments.
	 */
	function orchid_store_refresh_cart_count( $fragments ) {
		ob_start();
		?>
		<span class="item-count cart-items-count"><?php echo WC()->cart->get_cart_contents_count(); // phpcs:ignore ?></span>
		<?php
		$fragments['.trigger-mini-cart span.cart-items-count'] = ob_get_clean();
		return $fragments;
	}

	add_filter( 'woocommerce_add_to_cart_fragments', 'orchid_store_refresh_cart_count' );
}


/**
 * Wraps WooCommerce result count and catalog ordering in a div container.
 *
 * @since 1.5.0
 */
function orchid_store_result_count_and_catalog_ordering() {
	?>
	<div class="os-result-count-and-catalog-ordering">
		<?php do_action( 'orchid_store_before_shop_loop' ); ?>
	</div>
	<?php
}


/**
 * Adds class to product container if switching of product thumbnail on product hover is enabled.
 *
 * @since 1.5.0
 *
 * @param array      $classes Array of CSS classes.
 * @param WC_Product $product Product object.
 */
function orchid_store_woocommerce_post_class( $classes, $product ) {

	$effect_on_image_on_hover = get_theme_mod( 'orchid_store_field_on_hover_image_effect', 'none' );

	switch ( $effect_on_image_on_hover ) {
		case 'zoom':
			$classes[] = 'os-product-thumbnail-effect-zoom';
			break;
		case 'swap':
			$gallery_image_ids = $product->get_gallery_image_ids();

			if ( is_array( $gallery_image_ids ) && count( $gallery_image_ids ) > 0 ) {
				$classes[] = 'os-product-thumbnail-effect-swap';
			}
			break;
		default:
	}

	$add_to_cart_button_position = get_theme_mod( 'orchid_store_field_add_to_cart_button_placement', 'default' );

	if ( 'over_image' === $add_to_cart_button_position ) {

		$classes[] = 'os-add-to-cart-button-position-over-thumbnail';
	}

	if (
		get_theme_mod( 'orchid_store_field_display_add_to_cart_button_on_hover', false ) &&
		'none' !== $add_to_cart_button_position
	) {

		$classes[] = 'os-add-to-cart-button-display-on-product-hover';
	}

	return $classes;
}
add_filter( 'woocommerce_post_class', 'orchid_store_woocommerce_post_class', 10, 2 );


/**
 * Modifies add to cart link.
 *
 * @since 1.5.0
 *
 * @param string     $add_to_cart_link HTML of add to cart link.
 * @param WC_Product $product Product object.
 * @param array      $args Link arguments.
 */
function orchid_store_woocommerce_loop_add_to_cart_link( $add_to_cart_link, $product, $args ) {

	$add_to_cart_text = esc_html( $product->add_to_cart_text() );

	if ( get_theme_mod( 'orchid_store_field_display_add_to_cart_button_icon', false ) ) {

		$cart_icon = apply_filters(
			'orchid_store_add_to_cart_link_icon',
			'<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>'
		);

		$icon_position = get_theme_mod( 'orchid_store_field_add_to_cart_button_icon_position', 'right' );

		if ( 'left' === $icon_position ) {
			$args['class']    = $args['class'] . ' os-left-cart-icon';
			$add_to_cart_text = $cart_icon . $add_to_cart_text;
		} else {
			$args['class']    = $args['class'] . ' os-right-cart-icon';
			$add_to_cart_text = $add_to_cart_text . $cart_icon;
		}
	}

	return sprintf(
		'<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
		esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
		isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
		$add_to_cart_text
	);
}
add_filter( 'woocommerce_loop_add_to_cart_link', 'orchid_store_woocommerce_loop_add_to_cart_link', 10, 3 );


/**
 * Modifies sale tag.
 *
 * @since 1.5.0
 *
 * @param string     $sale_tag HTML of sale tag.
 * @param WP_Post    $post Post object.
 * @param WC_Product $product Product object.
 */
function orchid_store_woocommerce_sale_flash( $sale_tag, $post, $product ) {

	$product_type = $product->get_type();

	if ( get_theme_mod( 'orchid_store_field_enable_percentage_sale_tag', false ) === true ) {

		if (
			'simple' === $product_type ||
			'external' === $product_type
		) {
			$regular_price = $product->get_regular_price();
			$sale_price    = $product->get_sale_price();

			$discount_percent = ( ( $regular_price - $sale_price ) / $regular_price ) * 100;

			return '<span class="onsale">' . apply_filters( 'orchid_store_percentage_sale_tag', '-' . esc_html( number_format( $discount_percent, 2, '.', '' ) ) . '%' ) . '</span>'; // phpcs:ignore
		}
	}

	return '<span class="onsale">' . esc_html( get_theme_mod( 'orchid_store_field_sale_tag_text', esc_html__( 'Sale!', 'orchid-store' ) ) ) . '</span>';
}
add_filter( 'woocommerce_sale_flash', 'orchid_store_woocommerce_sale_flash', 10, 3 );
