<?php
/**
 * Load custom hooks necessary for theme.
 *
 * @package Orchid_Store
 */

if ( ! function_exists( 'orchid_store_header_action' ) ) {
	/**
	 * Head declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_header_action() {

		/**
		* Hook - orchid_store_desktop_header.
		*
		* @hooked orchid_store_desktop_header_action - 10
		*/
		do_action( 'orchid_store_desktop_header' );

		/**
		* Hook - orchid_store_mobile_header.
		*
		* @hooked orchid_store_mobile_header_action - 10
		*/
		do_action( 'orchid_store_mobile_header' );
	}

	add_action( 'orchid_store_header', 'orchid_store_header_action', 10 );
}



if ( ! function_exists( 'orchid_store_desktop_header_template' ) ) {
	/**
	 * Renders header one layout template for desktop devices.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_desktop_header_template() {

		get_template_part( 'template-parts/header/header', 'one' );
	}

	add_action( 'orchid_store_desktop_header', 'orchid_store_desktop_header_template' );
}


if ( ! function_exists( 'orchid_store_mobile_header_template' ) ) {
	/**
	 * Renders header template for mobile devices.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_mobile_header_template() {

		get_template_part( 'template-parts/header/header', 'mobile' );
	}

	add_action( 'orchid_store_mobile_header', 'orchid_store_mobile_header_template' );
}


if ( ! function_exists( 'orchid_store_top_header_menu_action' ) ) {
	/**
	 * Renders menu in top header section.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_top_header_menu_action() {

		if ( has_nav_menu( 'menu-3' ) ) {
			?>
			<nav id="top-header-menu" class="top-header-menu">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-3',
						'container'      => '',
					)
				);
				?>
			</nav><!-- .site-navigation.site-navigation -->
			<?php
		}
	}

	add_action( 'orchid_store_top_header_menu', 'orchid_store_top_header_menu_action', 10 );
}


if ( ! function_exists( 'orchid_store_secondary_navigation_action' ) ) {
	/**
	 * Renders special menu for displaying product categories.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_secondary_navigation_action() {

		wp_nav_menu(
			array(
				'theme_location' => 'menu-2',
				'container'      => '',
				'menu_class'     => 'category-navigation-list',
				'depth'          => 2,
				'fallback_cb'    => 'orchid_store_special_menu_fallback',
			)
		);
	}

	add_action( 'orchid_store_secondary_navigation', 'orchid_store_secondary_navigation_action', 10 );
}


if ( ! function_exists( 'orchid_store_desktop_site_identity_action' ) ) {
	/**
	 * Renders site logo or site title and tagline in header section on desktop devices.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_desktop_site_identity_action() {
		?>
		<div class="site-branding">
			<?php
			if ( has_custom_logo() ) {

				if ( is_front_page() && ! wp_is_mobile() ) {
					?>
					<h1 class="site-logo">
					<?php
				}

				the_custom_logo();

				if ( is_front_page() && ! wp_is_mobile() ) {
					?>
					</h1>
					<?php
				}
			} else {

				if ( is_front_page() && ! wp_is_mobile() ) {
					?>
					<h1 class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
					</h1><!-- .site-title -->
					<?php
				} else {
					?>
					<span class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
					</span><!-- .site-title -->
					<?php
				}
				$site_description = get_bloginfo( 'description', 'display' );
				if ( $site_description || is_customize_preview() ) {
					?>
					<p class="site-description">
						<?php echo esc_html( $site_description ); ?>
					</p> 
					<?php
				}
			}
			?>
		</div><!-- site-branding -->
		<?php
	}

	add_action( 'orchid_store_desktop_site_identity', 'orchid_store_desktop_site_identity_action', 10 );
}


if ( ! function_exists( 'orchid_store_mobile_site_identity_action' ) ) {
	/**
	 * Renders site logo or site title and tagline in header section on mobile devices.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_mobile_site_identity_action() {
		?>
		<div class="site-branding">
			<?php

			$mobile_logo = orchid_store_get_option( 'logo_mobile' );

			if ( has_custom_logo() || $mobile_logo ) {

				if ( is_front_page() && wp_is_mobile() ) {
					?>
					<h1 class="site-logo">
					<?php
				}

				if ( $mobile_logo ) {
					?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img class="mobile-logo" src="<?php echo esc_url( $mobile_logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
					</a>
					<?php
				} else {
					the_custom_logo();
				}

				if ( is_front_page() && wp_is_mobile() ) {
					?>
					</h1>
					<?php
				}
			} else {

				if ( is_front_page() && wp_is_mobile() ) {
					?>
					<h1 class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
					</h1><!-- .site-title -->
					<?php
				} else {
					?>
					<span class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
					</span><!-- .site-title -->
					<?php
				}
				$site_description = get_bloginfo( 'description', 'display' );
				if ( $site_description || is_customize_preview() ) {
					?>
					<p class="site-description"><?php echo esc_html( $site_description ); // phpcs:ignore. ?></p> 
					<?php
				}
			}
			?>
		</div><!-- site-branding -->
		<?php
	}

	add_action( 'orchid_store_mobile_site_identity', 'orchid_store_mobile_site_identity_action', 10 );
}


if ( ! function_exists( 'orchid_store_primary_navigation_action' ) ) {
	/**
	 * Renders primary navigation on header section.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_primary_navigation_action() {
		?>
		<nav id="site-navigation" class="site-navigation">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'container'      => '',
					'menu_class'     => 'primary-menu',
					'menu_id'        => 'primary-menu',
					'fallback_cb'    => 'orchid_store_navigation_fallback',
				)
			);
			?>
		</nav><!-- .site-navigation.site-navigation -->
		<?php
	}

	add_action( 'orchid_store_primary_navigation', 'orchid_store_primary_navigation_action', 10 );
}


if ( ! function_exists( 'orchid_store_post_author_action' ) ) {
	/**
	 * Renders post's author meta.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_post_author_action() {

		if ( 'post' === get_post_type() ) {
			?>
			<li class="posted-by"><?php orchid_store_posted_by(); ?></li>
			<?php
		}
	}

	add_action( 'orchid_store_post_author', 'orchid_store_post_author_action', 10 );
}


if ( ! function_exists( 'orchid_store_post_date_action' ) ) {
	/**
	 * Renders post's published date meta.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_post_date_action() {

		if ( 'post' === get_post_type() ) {
			?>
			<li class="posted-date">
				<?php orchid_store_posted_on(); ?>
			</li>
			<?php
		}
	}

	add_action( 'orchid_store_post_date', 'orchid_store_post_date_action', 10 );
}


if ( ! function_exists( 'orchid_store_post_categories_action' ) ) {
	/**
	 * Renders post's categories meta.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_post_categories_action() {

		if ( 'post' === get_post_type() ) {
			?>
			<div class="entry-cats">
				<?php orchid_store_post_categories_list(); ?>
			</div><!-- .entry-cats -->
			<?php
		}
	}

	add_action( 'orchid_store_post_categories', 'orchid_store_post_categories_action', 10 );
}


if ( ! function_exists( 'orchid_store_post_tags_action' ) ) {
	/**
	 * Renders post's tags meta.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_post_tags_action() {

		orchid_store_post_tags_list();
	}

	add_action( 'orchid_store_post_tags', 'orchid_store_post_tags_action', 10 );
}


if ( ! function_exists( 'orchid_store_excerpt_action' ) ) {
	/**
	 * Renders post's excerpt.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_excerpt_action() {
		?>
		<div class="excerpt">
			<?php the_excerpt(); ?>
		</div><!-- .excerpt -->
		<?php
	}

	add_action( 'orchid_store_excerpt', 'orchid_store_excerpt_action', 10 );
}


if ( ! function_exists( 'orchid_store_pagination_action' ) ) {
	/**
	 * Renders pagination.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_pagination_action() {

		if ( ! empty( get_the_posts_pagination() ) ) {
			?>
			<div class="os-pagination">
				<div class="pagination-entry">
					<?php
					the_posts_pagination(
						array(
							'mid_size'  => 0,
							'prev_text' => esc_html__( 'Previous', 'orchid-store' ),
							'next_text' => esc_html__( 'Next', 'orchid-store' ),
						)
					);
					?>
				</div><!-- .pagination-entry -->
			</div><!-- .pagination -->
			<?php
		}
	}

	add_action( 'orchid_store_pagination', 'orchid_store_pagination_action' );
}


if ( ! function_exists( 'orchid_store_post_navigation_action' ) ) {
	/**
	 * Renders posts navigation in post single.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_post_navigation_action() {

		$next_post = get_next_post();

		$previous_post = get_previous_post();
		?>
		<div class="post-navigation">
			<div class="nav-links">
				<div class="nav-previous">
					<?php
					if ( ! empty( $previous_post ) ) {
						?>
						<span><?php esc_html_e( 'Prev post', 'orchid-store' ); ?></span>
						<a href="<?php echo esc_url( get_permalink( $previous_post->ID ) ); ?>">
							<?php echo esc_html( $previous_post->post_title ); ?>
						</a>
						<?php
					}
					?>
				</div><!-- .nav-previous -->
				<div class="nav-next">
					<?php
					if ( ! empty( $next_post ) ) {
						?>
						<span><?php esc_html_e( 'Next post', 'orchid-store' ); ?></span>
						<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
							<?php echo esc_html( $next_post->post_title ); ?>
						</a>
						<?php
					}
					?>
				</div><!-- .nav-next -->
			</div><!-- .nav-links -->
		</div><!-- .post-navigation -->
		<?php
	}

	add_action( 'orchid_store_post_navigation', 'orchid_store_post_navigation_action', 10 );
}


if ( ! function_exists( 'orchid_store_large_thumbnail_action' ) ) {
	/**
	 * Renders thumbnail of size `orchid-store-thumbnail-large`.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_large_thumbnail_action() {

		if ( has_post_thumbnail() ) {
			?>
			<a href="<?php the_permalink(); ?>">
				<?php
				the_post_thumbnail(
					'orchid-store-thumbnail-large',
					array(
						'alt' => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					)
				);
				?>
			</a>
			<?php
		}
	}

	add_action( 'orchid_store_large_thumbnail', 'orchid_store_large_thumbnail_action', 10 );
}


if ( ! function_exists( 'orchid_store_extra_large_thumbnail_action' ) ) {
	/**
	 * Renders thumbnail of size `orchid-store-thumbnail-extra-large`.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_extra_large_thumbnail_action() {

		if ( has_post_thumbnail() ) {
			?>
			<a href="<?php the_permalink(); ?>">
				<?php
				the_post_thumbnail(
					'orchid-store-thumbnail-extra-large',
					array(
						'alt' => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					)
				);
				?>
			</a>
			<?php
		}
	}

	add_action( 'orchid_store_extra_large_thumbnail', 'orchid_store_extra_large_thumbnail_action', 10 );
}


if ( ! function_exists( 'orchid_store_footer_left_action' ) ) {
	/**
	 * Renders copyright text in the footer
	 *
	 * @since 1.0.0
	 */
	function orchid_store_footer_left_action() {

		$copyright_text = orchid_store_get_option( 'copyright_text' );
		?>
		<div class="copyrights">
			<p>
				<?php
				if ( $copyright_text ) {

					if ( str_contains( $copyright_text, '{copy}' ) ) {
						$copy_right_symbol = '&copy;';
						$copyright_text    = str_replace( '{copy}', $copy_right_symbol, $copyright_text );
					}

					if ( str_contains( $copyright_text, '{year}' ) ) {
						$year           = gmdate( 'Y' );
						$copyright_text = str_replace( '{year}', $year, $copyright_text );
					}

					if ( str_contains( $copyright_text, '{site_title}' ) ) {
						$title          = get_bloginfo( 'name' );
						$copyright_text = str_replace( '{site_title}', $title, $copyright_text );
					}

					if ( str_contains( $copyright_text, '{theme_author}' ) ) {
						$theme_author   = '<a href="https://themebeez.com" rel="author" target="_blank">Themebeez</a>';
						$copyright_text = str_replace( '{theme_author}', $theme_author, $copyright_text );
					}

					echo wp_kses_post( $copyright_text );
				} else {

					/* translators: 1: theme name, 2: theme author */
					printf( esc_html__( '%1$s Theme by %2$s', 'orchid-store' ), 'Orchid Store', '<a href="https://themebeez.com" rel="author" target="_blank">Themebeez</a>' );
				}
				?>
			</p>
		</div><!-- .copyrights -->
		<?php
	}

	add_action( 'orchid_store_footer_left', 'orchid_store_footer_left_action', 10 );
}


if ( ! function_exists( 'orchid_store_footer_right_action' ) ) {
	/**
	 * Renders payment processors image in the footer.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_footer_right_action() {

		$payments_processors = orchid_store_get_option( 'payments_image' );
		if ( ! empty( $payments_processors ) ) {
			?>
			<div class="payment-options payment-col">
				<img src="<?php echo esc_url( $payments_processors ); ?>">
			</div><!-- .payment-options -->
			<?php
		}
	}

	add_action( 'orchid_store_footer_right', 'orchid_store_footer_right_action', 10 );
}


if ( ! function_exists( 'orchid_store_title_breadcrumb_action' ) ) {
	/**
	 * Renders page title and breadcrumbs in page header section.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_title_breadcrumb_action() {

		if ( is_front_page() ) {
			return;
		}

		if ( orchid_store_get_option( 'display_page_header' ) ) {
			?>
			<div class="os-breadcrumb-wrap" 
			<?php
			if ( has_header_image() ) {
				?>
				style="background-image: url(<?php header_image(); ?>);" <?php } ?>>
				<div class="__os-container__">
					<div class="breadcrumb-inner">
					<?php
					if ( orchid_store_get_option( 'display_page_title' ) ) {
						orchid_store_get_page_title();
					}

					if ( orchid_store_get_option( 'display_breadcrumb' ) ) {
						?>
						<div class="os-breadcrumb">
							<?php
							$breadcrumb_args = array(
								'show_browse' => false,
							);

							orchid_store_breadcrumb_trail( $breadcrumb_args );
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
			if ( orchid_store_get_option( 'display_breadcrumb' ) ) {
				?>
				<div class="os-page-breadcrumb-wrap">
					<div class="__os-container__">
						<div class="os-breadcrumb">
							<?php
							$breadcrumb_args = array(
								'show_browse' => false,
							);

							orchid_store_breadcrumb_trail( $breadcrumb_args );
							?>
						</div><!-- .os-breadcrumb -->
					</div><!-- .__os-container__ -->
				</div><!-- .os-product-single-breadcrumb-wrap -->
				<?php
			}
		}
	}

	add_action( 'orchid_store_title_breadcrumb', 'orchid_store_title_breadcrumb_action', 10 );
}


if ( ! function_exists( 'orchid_store_default_search_action' ) ) {
	/**
	 * Renders WordPress's default search form.
	 *
	 * @since 1.0.0
	 */
	function orchid_store_default_search_action() {

		$mobile_product_search_class = '';

		if ( orchid_store_get_option( 'display_product_search_form_on_mobile' ) ) {

			$mobile_product_search_class = 'os-mobile-show';
		}
		?>
		<div class="custom-search <?php echo esc_attr( $mobile_product_search_class ); ?>">
			<div class="custom-search-entry">
				<?php get_search_form(); ?>
			</div><!-- // custom-search-entry -->
		</div><!-- .custom-search -->
		<?php
	}

	add_action( 'orchid_store_default_search', 'orchid_store_default_search_action', 10 );
}
