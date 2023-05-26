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
				<a href="<?php echo esc_url( $wishlist_page_url ); ?>"><i class='bx bx-heart'></i> 
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
						<li><a href="<?php echo esc_url( $wishlist_page_url ); ?>"><i class='bx bx-heart'></i> <?php esc_html_e( 'My Wishlist', 'orchid-store' ); ?></a></li>
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
			<ul>
				<?php
				if (
					class_exists( 'YITH_WCQV' ) ||
					class_exists( 'Addonify_Quick_View' )
				) {
					if (
						class_exists( 'Addonify_Quick_View' ) &&
						(int) get_option( 'addonify_qv_enable_quick_view', false ) === 1
					) {
						?>
						<li>
							<a 
								class="os-tooltip view-product addonify-qvm-button" 
								data-tippy-content="<?php echo get_option( 'addonify_qv_quick_view_btn_label' ) ? esc_attr( get_option( 'addonify_qv_quick_view_btn_label' ) ) : esc_attr__( 'Quick View', 'orchid-store' ); ?>" 
								data-product_id="<?php echo esc_attr( $product->get_id() ); ?>"
								href="#"
							>
								<i class="bx bx-search"></i>
							</a>
						</li>
						<?php
					}

					if ( class_exists( 'YITH_WCQV' ) ) {
						?>
						<li>
							<a 
								class="os-tooltip view-product yith-wcqv-button" 
								data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" 
								data-tippy-content="<?php echo esc_attr( get_option( 'yith-wcqv-button-label' ) ); ?>" href="#">
									<i class="bx bx-search"></i>
							</a>
						</li>
						<?php
					}
				}
				if (
					class_exists( 'YITH_WCWL' ) ||
					class_exists( 'Addonify_Wishlist' )
				) {
					if (
						class_exists( 'Addonify_Wishlist' ) &&
						(int) get_option( 'addonify_wishlist_enable_wishlist', true ) === 1
					) {
						$addonify_wishlist_button_classes = array( 'os-tooltip', 'adfy-wishlist-btn', 'addonify-add-to-wishlist-btn', 'addonify-custom-wishlist-btn' );

						if ( addonify_wishlist_is_product_in_wishlist( $product->get_id() ) ) {
							$addonify_wishlist_button_classes[] = 'added-to-wishlist';
						}

						$tooltip_text = ( addonify_wishlist_is_product_in_wishlist( $product->get_id() ) ) ? get_option( 'btn_label_if_added_to_wishlist', __( 'Already in wishlist', 'orchid-store' ) ) : get_option( 'addonify_wishlist_btn_label', __( 'Add to wishlist', 'orchid-store' ) );

						$icon = ( addonify_wishlist_is_product_in_wishlist( $product->get_id() ) ) ? 'bx bxs-heart' : 'bx bx-heart';
						?>
						<li>
							<?php
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
											<span class="icon"><i class="<?php echo esc_attr( $icon ); ?>"></i></span>
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
											<span class="icon"><i class="<?php echo esc_attr( $icon ); ?>"></i></span>
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
										<span class="icon"><i class="<?php echo esc_attr( $icon ); ?>"></i></span>
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
									<span class="icon"><i class="<?php echo esc_attr( $icon ); ?>"></i></span>
								</a>
								<?php
							}
							?>
						</li>
						<?php
					}

					if ( class_exists( 'YITH_WCWL' ) ) {
						?>
						<li><?php echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); ?></li>
						<?php
					}
				}

				if ( class_exists( 'Addonify_Compare_Products' ) ) {

					$addonify_compare_products_button_classes = array( 'os-tooltip', 'addonify-cp-button' );

					$icon = 'bx bx-layer';

					if (
						function_exists( 'addonify_compare_products_is_product_in_compare_cookie' ) &&
						addonify_compare_products_is_product_in_compare_cookie( $product->get_id() )
					) {
						$addonify_compare_products_button_classes[] = 'selected';
						$icon                                       = 'bxs bxs-layer';
					}

					if (
						function_exists( 'addonify_compare_products_get_compare_products_list' ) &&
						in_array( $product->get_id(), addonify_compare_products_get_compare_products_list() ) // phpcs:ignore
					) {
						$addonify_compare_products_button_classes[] = 'selected';
						$icon                                       = 'bxs bxs-layer';
					}

					$tooltip_text = get_option( 'compare_products_btn_label', __( 'Compare', 'orchid-store' ) );
					?>
					<li>
						<a
							href="#" 
							class="<?php echo esc_attr( implode( ' ', $addonify_compare_products_button_classes ) ); ?> os-addtocompare-btn" 
							data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" 
							data-product_name="<?php echo esc_attr( $product->get_name() ); ?>"
							data-tippy-content="<?php echo esc_attr( $tooltip_text ); ?>"
						>
							<span class="icon"><i class="<?php echo esc_attr( $icon ); ?>"></i></span>
						</a>
					</li>
					<?php
				}
				?>
			</ul>
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
							<div class="title">
								<h1 class="entry-title page-title"><?php woocommerce_page_title(); ?></h1>
							</div><!-- .title -->
							<?php
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
