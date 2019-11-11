<?php

if( ! function_exists( 'orchid_store_dynamic_style' ) ) {

	function orchid_store_dynamic_style() {

		$primary_color = orchid_store_get_option( 'primary_color' );

		$secondary_color = orchid_store_get_option( 'secondary_color' );
		?>
		<style>
			<?php 
			if( $primary_color ) {
				?>
				.editor-entry a,
				.entry-404 h1 span,
				.banner-style-1 .caption span,
				.product-widget-style-2 .tab-nav ul li a.active,
				.site-navigation ul .mega-menu-sub-menu .mega-sub-menu-group > a {

					color: <?php echo esc_attr( $primary_color ); ?>;
				}

				button,
				input[type="button"],
				input[type="reset"],
				input[type="submit"],
				.entry-tags a,
				.entry-cats ul li a,
				.button-general,
				a.button-general,
				#yith-quick-view-close,
				.woocommerce .add_to_cart_button,
				.woocommerce #respond input#submit, 
				.woocommerce input#submit, 
				.woocommerce a.button, 
				.woocommerce button.button, 
				.woocommerce input.button, 
				.woocommerce .cart .button, 
				.woocommerce .cart input.button, 
				.woocommerce button.button.alt, 
				.woocommerce a.button.alt, 
				.woocommerce input.button.alt,
				.orchid-backtotop,
				.category-nav li a:hover,
				.cta-style-1,
				.main-navigation,
				.header-style-1 .top-header,
				#yith-wcwl-popup-message,
				.header-style-1 .custom-search-entry button,
				.header-style-1 .custom-search-entry button:hover,
				.masterheader .mini-cart button,
				.owl-carousel button.owl-dot.active,
				.woocommerce .added_to_cart.wc-forward,
				.woocommerce div.product .entry-summary .yith-wcwl-add-to-wishlist a,
				.default-post-wrap .page-head .entry-cats ul li a:hover,
				.woocommerce nav.woocommerce-pagination ul li a:hover,
				.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
				.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
				.woocommerce-page #add_payment_method #payment div.payment_box, 
				.woocommerce-cart #payment div.payment_box, 
				.woocommerce-checkout #payment div.payment_box,
				.header-style-1 .wishlist-icon-container a,
				.wc-block-grid .wp-block-button__link,
				.os-about-widget .social-icons ul li a,
				.patigation .page-numbers,
				.woocommerce .woocommerce-pagination .page-numbers li span, 
				.woocommerce .woocommerce-pagination .page-numbers li a,
				.woocommerce ul.products li .product-hover-items ul li a {

					background-color: <?php echo esc_attr( $primary_color ); ?>;
				}

				section .section-title h2:after, 
				section .section-title h3:after {

					content:'';
					background-color: <?php echo esc_attr( $primary_color ); ?>;
				}

				.widget .widget-title h3:after {

					content:'';
					border-top-color:<?php echo esc_attr( $primary_color ); ?>;
				}

				.woocommerce-page .woocommerce-MyAccount-content p a {

					border-bottom-color:<?php echo esc_attr( $primary_color ); ?>;
				}

				#add_payment_method #payment div.payment_box::before, 
				.woocommerce-cart #payment div.payment_box::before, 
				.woocommerce-checkout #payment div.payment_box::before {

					content:'';
					border-bottom-color:<?php echo esc_attr( $primary_color ); ?>;
				}
				
				.category-nav ul,
				.masterheader .mini-cart,
				.header-style-1 .custom-search-entry,
				.header-style-1 .custom-search-entry .select-custom {

					border-color:<?php echo esc_attr( $primary_color ); ?>;
				}
				<?php
			}

			if( $secondary_color ) {
				?>				
				a:hover,
				.entry-metas ul li a:hover,
				.footer a:hover,
				.editor-entry a:hover,
				.widget_archive a:hover,
				.widget_categories a:hover,
				.widget_recent_entries a:hover,
				.widget_meta a:hover,
				.widget_product_categories a:hover,
				.widget_rss li a:hover,
				.widget_pages li a:hover,
				.widget_nav_menu li a:hover,
				.woocommerce-widget-layered-nav ul li a:hover,
				.widget_rss .widget-title h3 a:hover,
				.widget_rss ul li a:hover,
				.masterheader .social-icons ul li a:hover,
				.comments-area .comment-body .reply a:hover,
				.comments-area .comment-body .reply a:focus,
				.comments-area .comment-body .fn a:hover,
				.comments-area .comment-body .fn a:focus,
				.footer .widget_rss ul li a:hover,
				.comments-area .comment-body .fn:hover,
				.comments-area .comment-body .fn a:hover,
				.comments-area .comment-body .reply a:hover, 
				.comments-area .comment-body .comment-metadata a:hover,
				.comments-area .comment-body .comment-metadata .edit-link:hover,
				.masterheader .topbar-items a:hover,
				.default-page-wrap .page-head .entry-metas ul li a:hover,
				.default-post-wrap .page-head .entry-metas ul li a:hover,
				.mini-cart-open .woocommerce.widget_shopping_cart .cart_list li a:hover,
				.woocommerce .woocommerce-breadcrumb a:hover,
				.os-breadcrumb-wrap ul li a:hover,
				.woocommerce-page a.edit:hover,
				.footer .footer-bottom p a:hover,
				.footer .copyrights a:hover, 
				.footer .widget_nav_menu ul li a:hover, 
				.footer .widget_rss .widget_title h3 a:hover, 
				.footer .widget_tag_cloud .tagcloud a:hover,
				.wc-block-grid .wc-block-grid__product-title:hover,
				.site-navigation ul li .sub-menu.mega-menu-sub-menu li a:hover,
				.site-navigation ul .mega-menu-sub-menu .mega-sub-menu-group > a:hover {

					color: <?php echo esc_attr( $secondary_color ); ?>;
				}

				button:hover,
				input[type="button"]:hover,
				input[type="reset"]:hover,
				input[type="submit"]:hover,
				.orchid-backtotop:hover,
				.entry-tags a:hover,
				.entry-cats ul li a:hover,
				.button-general:hover,
				a.button-general:hover,
				#yith-quick-view-close:hover,
				.woocommerce .add_to_cart_button:hover,
				.woocommerce #respond input#submit:hover, 
				.woocommerce input#submit:hover, 
				.woocommerce a.button:hover, 
				.woocommerce button.button:hover, 
				.woocommerce input.button:hover, 
				.woocommerce .cart .button:hover, 
				.woocommerce .cart input.button:hover, 
				.woocommerce button.button.alt:hover, 
				.woocommerce a.button.alt:hover, 
				.woocommerce input.button.alt:hover,
				.masterheader .mini-cart button:hover,
				.woocommerce .product-hover-items ul li a:hover,
				.owl-carousel .owl-nav button.owl-next:hover,
				.owl-carousel .owl-nav button.owl-prev:hover,
				.woocommerce .added_to_cart.wc-forward:hover,
				.category-navigation .cat-nav-trigger,
				.wc-block-grid .wp-block-button__link:hover,
				.header-style-1 .wishlist-icon-container a:hover,
				.os-about-widget .social-icons ul li a:hover,
				.woocommerce ul.products li .product-hover-items ul li a:hover,
				.woocommerce div.product .entry-summary .yith-wcwl-add-to-wishlist a:hover,
				.patigation .page-numbers.current,
				.patigation .page-numbers:hover,
				.woocommerce .woocommerce-pagination .page-numbers li a:hover, 
				.woocommerce .woocommerce-pagination .page-numbers li .current {

					background-color: <?php echo esc_attr( $secondary_color ); ?>;
				}

				@media ( min-width: 992px ) {

					.site-navigation ul li .sub-menu li a:hover, 
					.site-navigation ul li .children li a:hover {

						background-color: <?php echo esc_attr( $secondary_color ); ?>;
					}
				}

				.widget_tag_cloud .tagcloud a:hover,
				.widget_product_tag_cloud .tagcloud a:hover {

					border-color: <?php echo esc_attr( $secondary_color ); ?>;
				}
				<?php
			}

			if( orchid_store_get_option( 'enable_parallax_page_header_background' ) == true ) {
				?>
				.os-breadcrumb-wrap {

					background-attachment: fixed;
				}
				<?php
			}
			?>
		</style>
		<?php
	}
}
add_action( 'wp_head', 'orchid_store_dynamic_style', 10 );