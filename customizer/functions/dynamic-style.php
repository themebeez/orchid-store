<?php

if( ! function_exists( 'orchid_store_dynamic_style' ) ) {

	function orchid_store_dynamic_style() {

		$primary_color = orchid_store_get_option( 'primary_color' );

		$secondary_color = orchid_store_get_option( 'secondary_color' );

		$disable_outline_focus = orchid_store_get_option( 'disable_ouline_on_focus' );		

		$custom_style = '';

		if( orchid_store_get_option( 'disable_ouline_on_focus' ) == true ) {

			$custom_style .= "
			a:focus,
			button:focus,
			.btn-general:focus, 
			.button:focus,
			a.button:focus,
			select:focus,
			input[type='button']:focus,
			input[type='reset']:focus,
			input[type='submit']:focus, 
			.mobile-menu-toggle-btn:focus,
			.category-navigation .cat-nav-trigger:focus,
			.masterheader .mini-cart .trigger-mini-cart:focus,
			.header-style-1 .wishlist-icon-container a:focus,
			.masterheader .mini-cart .trigger-mini-cart:focus,
			.header-style-1 .custom-search-entry button:focus  {
				
				outline:none;
			}
			
			.site-navigation ul li a:hover,
			.category-navigation ul li a:hover {

				text-decoration:none;
			}";
		}


		if( $primary_color ) {
			
			$custom_style .= "
			.editor-entry a,
			.quantity-button,
			.entry-404 h1 span,
			.banner-style-1 .caption span,
			.product-widget-style-2 .tab-nav ul li a.active {

				color: {$primary_color};
			}

			button,
			.mobile-navigation,
			input[type='button'],
			input[type='reset'],
			input[type='submit'],
			.wp-block-search .wp-block-search__button,
			.wp-block-search.wp-block-search__text-button .wp-block-search__button,
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
			.header-style-1 .custom-search .search-form button,
			.header-style-1  .wishlist-icon-container a > .item-count,
			.header-style-1  .mini-cart .trigger-mini-cart > .item-count,
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
			.woocommerce ul.products li .product-hover-items ul li a,
			.woocommerce #respond input#submit.alt.disabled,
			.woocommerce #respond input#submit.alt:disabled,
			.woocommerce #respond input#submit.alt:disabled[disabled],
			.woocommerce a.button.alt.disabled,
			.woocommerce a.button.alt:disabled,
			.woocommerce a.button.alt:disabled[disabled],
			.woocommerce button.button.alt.disabled,
			.woocommerce button.button.alt:disabled,
			.woocommerce button.button.alt:disabled[disabled],
			.woocommerce input.button.alt.disabled,
			.woocommerce input.button.alt:disabled,
			.woocommerce input.button.alt:disabled:hover,
			.woocommerce input.button.alt:disabled[disabled],
			.product-widget-style-3 .owl-carousel .owl-nav button.owl-next, 
			.product-widget-style-3 .owl-carousel .owl-nav button.owl-prev,
			.mobile-header-style-1 .bottom-block,
			.woocommerce-store-notice.demo_store {

				background-color: {$primary_color};
			}

			section .section-title h2:after, 
			section .section-title h3:after {

				content:'';
				background-color: {$primary_color};
			}

			.widget .widget-title h3:after {

				content:'';
				border-top-color:{$primary_color};
			}

			.woocommerce-page .woocommerce-MyAccount-content p a {

				border-bottom-color:{$primary_color};
			}

			#add_payment_method #payment div.payment_box::before, 
			.woocommerce-cart #payment div.payment_box::before, 
			.woocommerce-checkout #payment div.payment_box::before {

				content:'';
				border-bottom-color: {$primary_color};
			}
			
			.category-nav ul,
			.masterheader .mini-cart,
			.header-style-1 .custom-search-entry,
			.header-style-1 .custom-search-entry .select-custom {

				border-color: {$primary_color};
			}";			
		}

		if( $secondary_color ) {
			
			$custom_style .= "
			a:hover,
			.quantity-button:hover,
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
			.breadcrumb-trail ul li a:hover,
			.os-page-breadcrumb-wrap .breadcrumb-trail ul li a:hover,
			.woocommerce .os-page-breadcrumb-wrap .woocommerce-breadcrumb a:hover,
			.os-breadcrumb-wrap ul li a:hover,
			.woocommerce-page a.edit:hover,
			.footer .footer-bottom p a:hover,
			.footer .copyrights a:hover, 
			.footer .widget_nav_menu ul li a:hover, 
			.footer .widget_rss .widget_title h3 a:hover, 
			.footer .widget_tag_cloud .tagcloud a:hover,
			.wc-block-grid .wc-block-grid__product-title:hover,
			.site-navigation ul li .sub-menu.mega-menu-sub-menu li a:hover {

				color: {$secondary_color};
			}

			button:hover,
			input[type='button']:hover,
			input[type='reset']:hover,
			input[type='submit']:hover,
			.wp-block-search .wp-block-search__button:hover,
			.wp-block-search.wp-block-search__text-button .wp-block-search__button:hover,
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
			.header-style-1 .custom-search .search-form button:hover,
			.os-about-widget .social-icons ul li a:hover,
			.woocommerce ul.products li .product-hover-items ul li a:hover,
			.woocommerce div.product .entry-summary .yith-wcwl-add-to-wishlist a:hover,
			.patigation .page-numbers.current,
			.patigation .page-numbers:hover,
			.woocommerce .woocommerce-pagination .page-numbers li a:hover, 
			.woocommerce .woocommerce-pagination .page-numbers li .current,
			.woocommerce a.button.alt:disabled:hover,
			.woocommerce a.button.alt.disabled:hover,
			.woocommerce button.button.alt:disabled:hover,
			.woocommerce button.button.alt.disabled:hover,
			.woocommerce input.button.alt.disabled:hover,
			.woocommerce a.button.alt:disabled[disabled]:hover,
			.woocommerce #respond input#submit.alt:disabled:hover,
			.woocommerce #respond input#submit.alt.disabled:hover,
			.woocommerce button.button.alt:disabled[disabled]:hover,
			.woocommerce input.button.alt:disabled[disabled]:hover,
			.woocommerce #respond input#submit.alt:disabled[disabled]:hover,
			.product-widget-style-3 .owl-carousel .owl-nav button.owl-next:hover, 
			.product-widget-style-3 .owl-carousel .owl-nav button.owl-prev:hover {

				background-color: {$secondary_color};
			}

			@media ( min-width: 992px ) {

				.site-navigation ul li .sub-menu li a:hover, 
				.site-navigation ul li .children li a:hover {

					background-color: {$secondary_color};
				}
			}

			.widget_tag_cloud .tagcloud a:hover,
			.widget_product_tag_cloud .tagcloud a:hover {

				border-color: {$secondary_color};
			}";
		}

		if( orchid_store_get_option( 'enable_parallax_page_header_background' ) == true ) {

			$custom_style .= "
			.os-breadcrumb-wrap {

				background-attachment: fixed;
			}";
		}

		if( orchid_store_get_option( 'blog_archive_search_col_align' ) == 'content_feat_img' ) {

			$custom_style .= "
			.search-entry article .thumb-col, 
			.archive-entry .thumb-col {
				
				order: 2;
			}

			.search-entry article .content-col, 
			.archive-entry article .content-col {

				order: 1;
			}";
		}

		$custom_style .= "
		.excerpt a,
		.editor-entry a {
			text-decoration: underline;
		}";

		return $custom_style;
	}
}