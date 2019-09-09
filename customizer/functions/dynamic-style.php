<?php

if( ! function_exists( 'orchid_store_dynamic_style' ) ) {

	function orchid_store_dynamic_style() {

		$enabled_lazy_loading = orchid_store_get_option( 'enable_lazy_loading' );

		$display_srcoll_top = orchid_store_get_option( 'display_scroll_top_one' );  

		$enable_cursive_site_title = orchid_store_get_option( 'enable_cursive_site_title' );

		$site_identity_section_padding = orchid_store_get_option( 'site_identity_section_padding' );

		$enable_cursive_post_meta = orchid_store_get_option( 'enable_cursive_post_meta' );

		$carousel_height = orchid_store_get_option( 'carousel_height' );

		$primary_color = orchid_store_get_option( 'primary_color' );

		$secondary_color = orchid_store_get_option( 'secondary_color' );

		if( $enabled_lazy_loading == true ) {
			?>
			<noscript>
		        <style>
		        img.lazyload {

		            display: none;
		        }

		        img.image-fallback {

		            display: block;
		        }
		        </style>
		    </noscript>
		    <?php
		}
		?>
		<style>
			<?php
			if( $display_srcoll_top == false ) {
				?>
				#glaze-toTop {
					display: none !important;
				}
				<?php
			}

			if( $enable_cursive_site_title == true ) {
				?>
				.header-style-1 .site-title, 
				.header-style-2 .site-title {
					font-family: "Pacifico", cursive;
				}
				<?php
			}


			if( $site_identity_section_padding ) {
				?>
				@media (min-width: 1024px) {
					.header-style-1 .mid-header {
						padding: <?php echo esc_attr( $site_identity_section_padding ) ?>px 0px;
					}
				}
				<?php
			}

			if( $enable_cursive_post_meta == true ) {
				?>
				.entry-cats ul li a, 
				.entry-metas ul li.posted-by a, 
				.author-box .author-name h3 {
					font-family: "Pacifico", cursive;
				}
				<?php
			}
			?>
			<?php
			if( $carousel_height ) {
				?>
				@media(min-width: 992px) {
					.banner-style-1 .post-thumb {
						height: <?php echo esc_attr( $carousel_height ); ?>px;
					}
				}
				<?php
			}


			if( $primary_color ) {
				?>
				.header-style-1 .top-header,
				.main-navigation {
					background-color: <?php echo esc_attr( $primary_color ); ?>;
				}
				<?php
			}

			if( $secondary_color ) {
				?>
				.category-navigation .cat-nav-trigger {
					background-color: <?php echo esc_attr( $secondary_color ); ?>;
				}
				<?php
			}
			?>
		</style>
		<?php
	}
}
add_action( 'wp_head', 'orchid_store_dynamic_style' );