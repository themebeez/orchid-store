<?php

$orchid_store_defaults = orchid_store_get_default_theme_options();

if ( ! function_exists( 'orchid_store_panel_declaration' ) ) {

	function orchid_store_panel_declaration() {

		$panels = array(
			array(
				'id' => 'site_header',
				'title' => esc_html__( 'Header', 'orchid-store' ),
				'description' => '',
				'priority' => 2,
			),
			array(
				'id' => 'site_pages',
				'title' => esc_html__( 'Pages', 'orchid-store' ),
				'description' => '',
				'priority' => 2,
			),
			array(
				'id' => 'site_colors',
				'title' => esc_html__( 'Colors', 'orchid-store' ),
				'description' => '',
				'priority' => 2,
			),
		);

		if ( !empty( $panels ) ) {

			foreach( $panels as $panel ) {

				orchid_store_add_panel( $panel['id'], $panel['title'], $panel['description'], $panel['priority'] );
			}
		}
	}
}
orchid_store_panel_declaration();


if ( ! function_exists( 'orchid_store_section_declaration' ) ) {

	function orchid_store_section_declaration() {

		$sections = array(
			array(
				'id' => 'site_general',
				'title' => esc_html__( 'General', 'orchid-store' ),
				'description' => '',
				'panel' => '',
				'priority' => 1,
			),
			array(
				'id' => 'site_layout',
				'title' => esc_html__( 'Site Layout', 'orchid-store' ),
				'description' => '',
				'panel' => '',
				'priority' => 1,
			),
			array(
				'id' => 'site_logo',
				'title' => esc_html__( 'Site Identity', 'orchid-store' ),
				'description' => '',
				'panel' => 'site_header',
				'priority' => 10,
			),
			array(
				'id' => 'top_header',
				'title' => esc_html__( 'Top Header', 'orchid-store' ),
				'description' => '',
				'panel' => 'site_header',
				'priority' => '',
			),
			array(
				'id' => 'middle_header',
				'title' => esc_html__( 'Middle Header', 'orchid-store' ),
				'description' => '',
				'panel' => 'site_header',
				'priority' => '',
			),
			array(
				'id' => 'special_menu',
				'title' => esc_html__( 'Special Menu', 'orchid-store' ),
				'description' => '',
				'panel' => 'site_header',
				'priority' => '',
			),
			array(
				'id' => 'product_search',
				'title' => esc_html__( 'Search Form', 'orchid-store' ),
				'description' => '',
				'panel' => 'site_header',
				'priority' => '',
			),
			array(
				'id' => 'page_header',
				'title' => esc_html__( 'Page Header', 'orchid-store' ),
				'description' => '',
				'panel' => 'site_pages',
				'priority' => 3,
			),
			array(
				'id' => 'blog_page',
				'title' => esc_html__( 'Blog Page', 'orchid-store' ),
				'description' => '',
				'panel' => 'site_pages',
				'priority' => 3,
			),
			array(
				'id' => 'archive_page',
				'title' => esc_html__( 'Archive Page', 'orchid-store' ),
				'description' => '',
				'panel' => 'site_pages',
				'priority' => 3,
			),
			array(
				'id' => 'search_page',
				'title' => esc_html__( 'Search Page', 'orchid-store' ),
				'description' => '',
				'panel' => 'site_pages',
				'priority' => 3,
			),
			array(
				'id' => 'blog_archive_search_page',
				'title' => esc_html__( 'Blog/Archive/Search Common', 'orchid-store' ),
				'description' => '',
				'panel' => 'site_pages',
				'priority' => 3,
			),
			array(
				'id' => 'post_single',
				'title' => esc_html__( 'Post Single', 'orchid-store' ),
				'description' => '',
				'panel' => 'site_pages',
				'priority' => 3,
			),
			array(
				'id' => 'page_single',
				'title' => esc_html__( 'Page Single', 'orchid-store' ),
				'description' => '',
				'panel' => 'site_pages',
				'priority' => 3,
			),
			array(
				'id' => 'site_sidebar',
				'title' => esc_html__( 'Sidebar', 'orchid-store' ),
				'description' => '',
				'panel' => '',
				'priority' => 3,
			),
			array(
				'id' => 'site_footer',
				'title' => esc_html__( 'Footer', 'orchid-store' ),
				'description' => '',
				'panel' => '',
				'priority' => 3,
			),
			array(
				'id' => 'post_excerpt',
				'title' => esc_html__( 'Excerpt', 'orchid-store' ),
				'description' => '',
				'panel' => '',
				'priority' => 3,
			),
			array(
				'id' => 'theme_color',
				'title' => esc_html__( 'Theme Color', 'orchid-store' ),
				'description' => '',
				'panel' => 'site_colors',
				'priority' => 3,
			),
			array(
				'id' => 'theme_accessibility',
				'title' => esc_html__( 'Accessibility', 'orchid-store' ),
				'description' => '',
				'panel' => '',
				'priority' => 3,
			),
		);

		if ( class_exists( 'WooCommerce' ) && ( class_exists( 'YITH_WCWL' ) || class_exists( 'Addonify_Wishlist' ) ) ) {

			$sections[] = array(
				'id' => 'wishlist',
				'title' => esc_html__( 'Wishlist', 'orchid-store' ),
				'description' => '',
				'panel' => 'site_header',
				'priority' => '',
			);
		}

		if ( class_exists( 'WooCommerce' ) ) {

			$sections[] = array(
				'id' => 'mini_cart',
				'title' => esc_html__( 'Mini Cart', 'orchid-store' ),
				'description' => '',
				'panel' => 'site_header',
				'priority' => '',
			);
		}

		if ( !empty( $sections ) ) {

			foreach( $sections as $section ) {

				orchid_store_add_section( $section['id'], $section['title'], $section['description'], $section['panel'], $section['priority'] );
			}
		}
	}
}
orchid_store_section_declaration();


orchid_store_add_image_field( 'logo_mobile', esc_html__( 'Logo - For Mobile', 'orchid-store' ), '', '', 'site_logo' );
$wp_customize->get_control( 'orchid_store_field_logo_mobile' )->priority = 5;


/*******************************************************************************************************
********************************** Home Page Control Fields Declaration *********************************
*******************************************************************************************************/
$wp_customize->add_setting( 
	'orchid_store_field_enable_home_content', 
	array(
		'sanitize_callback' => 'wp_validate_boolean',
		'default' => $orchid_store_defaults['orchid_store_field_enable_home_content' ],
	) 
);

$wp_customize->add_control( 
	new Orchid_Store_Customizer_Toggle_Control( $wp_customize,
		'orchid_store_field_enable_home_content', 
		array(
			'label' => esc_html__( 'Enable Homepage Content', 'orchid-store' ),
			'section' => 'static_front_page',
			'type' => 'flat',
			'active_callback' => 'orchid_store_is_static_home_page_set',
		) 
	) 
);

/*******************************************************************************************************
********************************** General Control Fields Declaration *********************************
*******************************************************************************************************/
orchid_store_add_select_field( 
	'value_as', 
	esc_html__( 'Save Dropdown Value As', 'orchid-store' ), 
	esc_html__( 'This option lets you save value of category dropdown, page dropdown, post dropdown, etc. either as slug or id. Select ID if your site language is other than English.', 'orchid-store' ), 
	array( 
		'slug' => esc_html__( 'Slug', 'orchid-store' ), 
		'id' => esc_html__( 'ID', 'orchid-store' ) 
	), 
	'', 
	'site_general' 
);

/*******************************************************************************************************
********************************** Site Layout Control Fields Declaration *********************************
*******************************************************************************************************/
orchid_store_add_select_field( 'site_layout', esc_html__( 'Select Site Layout', 'orchid-store' ), '', array( 'boxed' => esc_html__( 'Boxed', 'orchid-store' ), 'fullwidth' => esc_html__( 'Full Width', 'orchid-store' ) ), '', 'site_layout' );

orchid_store_add_number_field(
	'fullwidth_container_width',
	esc_html__( 'Container Width', 'orchid-store' ),
	'',
	'orchid_store_is_fullwidth_site_layout_enabled',
	'site_layout',
	'',
	'',
	''
);

orchid_store_add_number_field(
	'boxed_container_width',
	esc_html__( 'Container Width', 'orchid-store' ),
	'',
	'orchid_store_is_boxed_site_layout_enabled',
	'site_layout',
	'',
	'',
	''
);

/*******************************************************************************************************
********************************** Header Control Fields Declaration *********************************
*******************************************************************************************************/
orchid_store_add_toggle_field( 'display_top_header', esc_html__( 'Display Top Header', 'orchid-store' ), '', '', 'top_header' );

orchid_store_add_select_field( 'display_menu_or_login_register_link', esc_html__( 'Select Top Header Left Element', 'orchid-store' ), '', array( 'header_menu' => esc_html__( 'Top Header Menu', 'orchid-store' ), 'login_register' => esc_html__( 'Login/Register Link', 'orchid-store' ) ), 'orchid_store_active_top_header', 'top_header' );

orchid_store_add_sortable_repeater_field( 'top_header_social_links', esc_html__( 'Social Links', 'orchid-store' ), '', 'orchid_store_active_top_header', 'top_header' );


/*******************************************************************************************************
********************************** Special Menu Control Fields Declaration *********************************
*******************************************************************************************************/
orchid_store_add_toggle_field( 'display_special_menu', esc_html__( 'Display Special Menu', 'orchid-store' ), '', '', 'special_menu' );

orchid_store_add_text_field( 'special_menu_title', esc_html__( 'Special Menu Title', 'orchid-store' ), '', 'orchid_store_active_special_menu', 'special_menu' );


/*******************************************************************************************************
********************************** Page Header Control Fields Declaration *********************************
*******************************************************************************************************/
orchid_store_add_toggle_field( 'display_page_header', esc_html__( 'Display Page Header', 'orchid-store' ), '', '', 'page_header' );
orchid_store_add_toggle_field( 'display_breadcrumb', esc_html__( 'Display Breadcrumbs', 'orchid-store' ), '', '', 'page_header' );
orchid_store_add_toggle_field(
	'display_page_title',
	esc_html__( 'Display Page Title', 'orchid-store' ),
	esc_html__( 'When enabled, page title will be displayed inside the page header. Otherwise, page title will be displayed below the page header.', 'orchid-store' ),
	'',
	'page_header'
);
orchid_store_add_toggle_field( 'enable_parallax_page_header_background', esc_html__( 'Enable Parallax Background Image', 'orchid-store' ), '', 'orchid_store_is_page_header_enabled', 'page_header' );


/*******************************************************************************************************
********************************** WooCommerce  Elements Control Fields Declaration *********************************
*******************************************************************************************************/
orchid_store_add_toggle_field( 'display_product_search_form', esc_html__( 'Display Search Form', 'orchid-store' ), '', '', 'product_search' );
if ( class_exists( 'WooCommerce' ) ) {
	orchid_store_add_select_field(
		'select_search_form',
		esc_html__( 'Select Search Form', 'orchid-store' ),
		'',
		array(
			'product_search'     => esc_html__( 'Product Search Form', 'orchid-store' ),
			'default_search'     => esc_html__( 'Default Search Form', 'orchid-store' ),
			'third_party_search' => esc_html__( 'Third Party Search Form', 'orchid-store' ),
		),
		'orchid_store_is_product_search_form_enabled',
		'product_search'
	);

	orchid_store_add_text_field(
		'search_form_shortcode',
		esc_html__( 'Search Form Shortcode', 'orchid-store' ),
		'',
		'orchid_store_is_third_party_search_form_enabled',
		'product_search'
	);
}
orchid_store_add_toggle_field( 'display_product_search_form_on_mobile', esc_html__( 'Display Search Form On Mobile Devices', 'orchid-store' ), '', 'orchid_store_is_product_search_form_enabled', 'product_search' );

if ( class_exists( 'WooCommerce' ) ) {

	orchid_store_add_toggle_field(
		'display_mini_cart',
		esc_html__( 'Display Mini Cart', 'orchid-store' ),
		'',
		'',
		'mini_cart'
	);

	orchid_store_add_toggle_field(
		'display_cart_items_count',
		esc_html__( 'Display Cart Items Count', 'orchid-store' ),
		'',
		'orchid_store_is_mini_cart_enabled',
		'mini_cart'
	);

	orchid_store_add_select_field(
		'cart_display',
		esc_html__( 'Display Cart As', 'orchid-store' ),
		'',
		array(
			'default'       => esc_html__( 'Minicart', 'orchid-store' ),
			'floating_cart' => esc_html__( 'Floating Cart', 'orchid-store' ),
		),
		'orchid_store_is_mini_cart_enabled',
		'mini_cart'
	);

	// AFC recommendation field.
	$wp_customize->add_setting(
		'orchid_store_field_afc_plugin_recommendation',
		array(
			'sanitize_callback' => 'orchid_store_no_sanitize',
			'default'           => '',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new Orchid_Store_AFC_Recommendation_Control(
			$wp_customize,
			'orchid_store_field_afc_plugin_recommendation',
			array(
				'label'           => '',
				'description'     => '',
				'type'            => 'afc-recommendation',
				'section'         => 'orchid_store_section_mini_cart',
				'active_callback' => 'orchid_store_is_cart_floating_cart',
			)
		)
	);
}

if ( class_exists( 'WooCommerce' ) && ( class_exists( 'YITH_WCWL' ) || class_exists( 'Addonify_Wishlist' ) ) ) {

	orchid_store_add_toggle_field( 'display_wishlist', esc_html__( 'Display Wishlist', 'orchid-store' ), '', '', 'wishlist' );
	orchid_store_add_toggle_field( 'display_wishlist_items_count', esc_html__( 'Display Wishlist Items Count', 'orchid-store' ), '', 'orchid_store_is_wishlist_enabled', 'wishlist' );

}


/*******************************************************************************************************
************************************* Blog Page Control Fields Declaration *****************************
*******************************************************************************************************/
orchid_store_add_toggle_field( 'blog_featured_image', esc_html__( 'Display Featured Image', 'orchid-store' ), '', '', 'blog_page' );
orchid_store_add_toggle_field( 'blog_display_cats', esc_html__( 'Display Categories', 'orchid-store' ), '', '', 'blog_page' );
orchid_store_add_toggle_field( 'blog_display_date', esc_html__( 'Display Date', 'orchid-store' ), '', '', 'blog_page' );
orchid_store_add_toggle_field( 'blog_display_author', esc_html__( 'Display Author', 'orchid-store' ), '', '', 'blog_page' );
orchid_store_add_radio_image_field( 'blog_sidebar_position', esc_html__( 'Select Sidebar Position', 'orchid-store' ), '', orchid_store_all_sidebar_positions(), 'orchid_store_is_not_global_sidebar_position_active', 'blog_page' );




/*******************************************************************************************************
********************************** Archive Page Control Fields Declaration *****************************
*******************************************************************************************************/
orchid_store_add_toggle_field( 'archive_featured_image', esc_html__( 'Display Featured Image', 'orchid-store' ), '', '', 'archive_page' );
orchid_store_add_toggle_field( 'archive_display_cats', esc_html__( 'Display Categories', 'orchid-store' ), '', '', 'archive_page' );
orchid_store_add_toggle_field( 'archive_display_date', esc_html__( 'Display Date', 'orchid-store' ), '', '', 'archive_page' );
orchid_store_add_toggle_field( 'archive_display_author', esc_html__( 'Display Author', 'orchid-store' ), '', '', 'archive_page' );
orchid_store_add_radio_image_field( 'archive_sidebar_position', esc_html__( 'Select Sidebar Position', 'orchid-store' ), '', orchid_store_all_sidebar_positions(), 'orchid_store_is_not_global_sidebar_position_active', 'archive_page' );



/*******************************************************************************************************
*********************************** Search Page Control Fields Declaration *****************************
*******************************************************************************************************/
orchid_store_add_toggle_field( 'search_featured_image', esc_html__( 'Display Featured Image', 'orchid-store' ), '', '', 'search_page' );
orchid_store_add_toggle_field( 'search_display_cats', esc_html__( 'Display Categories', 'orchid-store' ), '', '', 'search_page' );
orchid_store_add_toggle_field( 'search_display_date', esc_html__( 'Display Date', 'orchid-store' ), '', '', 'search_page' );
orchid_store_add_toggle_field( 'search_display_author', esc_html__( 'Display Author', 'orchid-store' ), '', '', 'search_page' );
orchid_store_add_radio_image_field( 'search_sidebar_position', esc_html__( 'Select Sidebar Position', 'orchid-store' ), '', orchid_store_all_sidebar_positions(), 'orchid_store_is_not_global_sidebar_position_active', 'search_page' );



/*******************************************************************************************************
***************************** Blog/Archive/Search Page Control Fields Declaration **********************
*******************************************************************************************************/
orchid_store_add_select_field( 'blog_archive_search_col_align', esc_html__( 'Select Post Column Alignment', 'orchid-store' ), '', array( 'feat_img_content' => esc_html__( 'Featured Image/Content', 'orchid-store' ), 'content_feat_img' => esc_html__( 'Content/Featured Image', 'orchid-store' ) ), '', 'blog_archive_search_page' );

/*******************************************************************************************************
*********************************** Blog Single Control Fields Declaration *****************************
*******************************************************************************************************/
orchid_store_add_toggle_field( 'display_post_featured_image', esc_html__( 'Display Featured Image', 'orchid-store' ), '', '', 'post_single' );
orchid_store_add_toggle_field( 'display_post_cats', esc_html__( 'Display Categories', 'orchid-store' ), '', '', 'post_single' );
orchid_store_add_toggle_field( 'display_post_date', esc_html__( 'Display Date', 'orchid-store' ), '', '', 'post_single' );
orchid_store_add_toggle_field( 'display_post_author', esc_html__( 'Display Author', 'orchid-store' ), '', '', 'post_single' );
orchid_store_add_toggle_field( 'display_post_tags', esc_html__( 'Display Tags', 'orchid-store' ), '', '', 'post_single' );

orchid_store_add_toggle_field( 'enable_post_common_sidebar_position', esc_html__( 'Enable Common Sidebar Position', 'orchid-store' ), esc_html__( 'This option enables common sidebar position for all the posts.', 'orchid-store' ), 'orchid_store_is_not_global_sidebar_position_active', 'post_single' );
orchid_store_add_radio_image_field( 'post_sidebar_position', esc_html__( 'Select Common Sidebar Position', 'orchid-store' ), '', orchid_store_all_sidebar_positions(), 'orchid_store_is_post_common_sidebar_position_active', 'post_single' );



/*******************************************************************************************************
*********************************** Page Single Control Fields Declaration *****************************
*******************************************************************************************************/
orchid_store_add_toggle_field( 'display_page_featured_image', esc_html__( 'Display Featured image', 'orchid-store' ), '', '', 'page_single' );
orchid_store_add_toggle_field( 'enable_page_common_sidebar_position', esc_html__( 'Enable Common Sidebar Position', 'orchid-store' ), esc_html__( 'This option enables common sidebar position for all the pages.', 'orchid-store' ), 'orchid_store_is_not_global_sidebar_position_active', 'page_single' );
orchid_store_add_radio_image_field( 'page_sidebar_position', esc_html__( 'Select Common Sidebar Position', 'orchid-store' ), '', orchid_store_all_sidebar_positions(), 'orchid_store_is_page_common_sidebar_position_active', 'page_single' );




/*******************************************************************************************************
************************************ Sidebar Control Fields Declaration *********************************
*******************************************************************************************************/
orchid_store_add_toggle_field( 'enable_sticky_sidebar', esc_html__( 'Enable Sticky Sidebar', 'orchid-store' ), '', '', 'site_sidebar' );
orchid_store_add_toggle_field( 'enable_sidebar_small_devices', esc_html__( 'Enable Sidebar For Small Devices', 'orchid-store' ), esc_html__( 'This option lets you to display or do not display sidebar for devices with width smaller than 768px.', 'orchid-store' ), '', 'site_sidebar' );
orchid_store_add_toggle_field( 'enable_global_sidebar_position', esc_html__( 'Enable Global Sidebar Position', 'orchid-store' ), esc_html__( 'On checking this option, all the page templates of your website will have same sidebar position.', 'orchid-store' ), '', 'site_sidebar' );
orchid_store_add_radio_image_field( 'global_sidebar_position', esc_html__( 'Select Global Sidebar Position', 'orchid-store' ), '', orchid_store_all_sidebar_positions(), 'orchid_store_is_global_sidebar_position_active', 'site_sidebar' );



/*******************************************************************************************************
************************************ Footer Control Fields Declaration *********************************
*******************************************************************************************************/
orchid_store_add_toggle_field( 'display_scroll_top_button', esc_html__( 'Display Scroll Top Button', 'orchid-store' ), '', '', 'site_footer' );
orchid_store_add_toggle_field( 'display_footer_widget_area', esc_html__( 'Display Footer Widgets', 'orchid-store' ), '', '', 'site_footer' );
orchid_store_add_select_field( 'footer_widgets_area_columns', esc_html__( 'Select Footer Widget Area Columns', 'orchid-store' ), '', array( '1' => esc_html__( '1', 'orchid-store' ), '2' => esc_html__( '2', 'orchid-store' ), '3' => esc_html__( '3', 'orchid-store' ), '4' => esc_html__( '4', 'orchid-store' ) ), 'orchid_store_is_footer_widget_area_enabled', 'site_footer' );
orchid_store_add_text_field( 'copyright_text', esc_html__( 'Copyright Text', 'orchid-store' ), '', '', 'site_footer' );
orchid_store_add_image_field( 'payments_image', esc_html__( 'Image of payment processors', 'orchid-store' ), '', '', 'site_footer' );


/*******************************************************************************************************
***************************************** Excerpt Fields Declaration ***********************************
*******************************************************************************************************/
orchid_store_add_number_field( 'excerpt_length', esc_html__( 'Excerpt Length', 'orchid-store' ), esc_html__( 'Excerpt is the short content of post or page.', 'orchid-store' ), '', 'post_excerpt', '', '', '' );

/*******************************************************************************************************
***************************************** Accessibility Fields Declaration ***********************************
*******************************************************************************************************/
orchid_store_add_toggle_field( 'disable_ouline_on_focus', esc_html__( 'Disable Outline On Focus', 'orchid-store' ), '', '', 'theme_accessibility' );


/*******************************************************************************************************
***************************************** Theme Color Declaration ***********************************
*******************************************************************************************************/
orchid_store_add_color_field( 'primary_color', esc_html__( 'Primary Color', 'orchid-store' ), '', '', 'theme_color' );
orchid_store_add_color_field( 'secondary_color', esc_html__( 'Secondary Color', 'orchid-store' ), '', '', 'theme_color' );



/*******************************************************************************************************
***************************************** WooCommerce  Option Declaration *******************************
*******************************************************************************************************/
if ( class_exists( 'WooCommerce' ) ) {

	$wp_customize->add_section(
		'orchid_store_section_woocommerce_single',
		array(
			'title' => esc_html__( 'Product Single', 'orchid-store' ),
			'panel' => 'woocommerce',
		)
	);

	$wp_customize->add_section(
		'orchid_store_section_woocommerce_cart',
		array(
			'title' => esc_html__( 'Cart Page', 'orchid-store' ),
			'panel' => 'woocommerce',
		)
	);

	$wp_customize->add_section(
		'orchid_store_section_woocommerce_sidebar',
		array(
			'title' => esc_html__( 'Sidebar', 'orchid-store' ),
			'panel' => 'woocommerce',
		)
	);

	$wp_customize->add_section(
		'orchid_store_section_woocommerce_miscellaneous',
		array(
			'title' => esc_html__( 'Miscellaneous', 'orchid-store' ),
			'panel' => 'woocommerce',
		)
	);

	// WooCommerce  Pages Sidebar Postion.
	$wp_customize->add_setting(
		'orchid_store_field_woocommerce_sidebar_position',
		array(
			'sanitize_callback' => 'orchid_store_sanitize_select',
			'default'           => $orchid_store_defaults['orchid_store_field_woocommerce_sidebar_position'],
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new Orchid_Store_Radio_Image_Control(
			$wp_customize,
			'orchid_store_field_woocommerce_sidebar_position',
			array(
				'label'       => esc_html__( 'Product Archive - Sidebar Position', 'orchid-store' ),
				'description' => '',
				'type'        => 'select',
				'choices'     => orchid_store_all_sidebar_positions(),
				'section'     => 'orchid_store_section_woocommerce_sidebar',
			)
		)
	);


	// WooCommerce  Pages Sidebar Postion.
	$wp_customize->add_setting(
		'orchid_store_field_woocommerce_product_sidebar_position',
		array(
			'sanitize_callback' => 'orchid_store_sanitize_select',
			'default'           => $orchid_store_defaults['orchid_store_field_woocommerce_product_sidebar_position'],
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new Orchid_Store_Radio_Image_Control(
			$wp_customize,
			'orchid_store_field_woocommerce_product_sidebar_position',
			array(
				'label'       => esc_html__( 'Product Single - Sidebar Position', 'orchid-store' ),
				'description' => '',
				'type'        => 'select',
				'choices'     => orchid_store_all_sidebar_positions(),
				'section'     => 'orchid_store_section_woocommerce_sidebar',
			)
		)
	);

	// No of Product Columns in Shop Page.
	$wp_customize->add_setting(
		'orchid_store_field_shop_product_col_no',
		array(
			'default'           => $orchid_store_defaults['orchid_store_field_shop_product_col_no'],
			'sanitize_callback' => 'orchid_store_sanitize_range',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'orchid_store_field_shop_product_col_no',
		array(
			'label'       => esc_html__( 'Shop - Product Columns', 'orchid-store' ),
			'description' => esc_html__( 'Set number of columns to be displayed in shop page for displaying products. Maximum number of colums is 6 while minimum number of columns is 2.', 'orchid-store' ),
			'type'        => 'number',
			'section'     => 'woocommerce_product_catalog',
			'input_attrs' => array(
				'min'  => 2,
				'max'  => 6,
				'step' => 1,
			),
		)
	);


	// No of Rows per page.
	$wp_customize->add_setting(
		'orchid_store_field_row_per_page',
		array(
			'default'           => $orchid_store_defaults['orchid_store_field_row_per_page'],
			'sanitize_callback' => 'orchid_store_sanitize_number',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'orchid_store_field_row_per_page',
		array(
			'label'       => esc_html__( 'Rows per page', 'orchid-store' ),
			'description' => esc_html__( 'How many rows of products should be shown per page?', 'orchid-store' ),
			'type'        => 'number',
			'section'     => 'woocommerce_product_catalog',
		)
	);


	// No of Related Product Columns in Product Page.
	$wp_customize->add_setting(
		'orchid_store_field_related_product_col_no',
		array(
			'default'           => $orchid_store_defaults['orchid_store_field_related_product_col_no'],
			'sanitize_callback' => 'orchid_store_sanitize_range',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'orchid_store_field_related_product_col_no',
		array(
			'label'       => esc_html__( 'Related Product Columns', 'orchid-store' ),
			'description' => esc_html__( 'Set number of columns to be displayed in related product section of product page. Maximum number of colums is 6 while minimum number of columns is 2.', 'orchid-store' ),
			'type'        => 'number',
			'section'     => 'orchid_store_section_woocommerce_single',
			'input_attrs' => array(
				'min'  => 2,
				'max'  => 6,
				'step' => 1,
			),
		)
	);


	// No of Related Products in Product Page.
	$wp_customize->add_setting(
		'orchid_store_field_related_product_no',
		array(
			'default'           => $orchid_store_defaults['orchid_store_field_related_product_no'],
			'sanitize_callback' => 'orchid_store_sanitize_number',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'orchid_store_field_related_product_no',
		array(
			'label'       => esc_html__( 'No of Related Product', 'orchid-store' ),
			'description' => esc_html__( 'Set number of products to be displayed in related product section of product page.', 'orchid-store' ),
			'type'        => 'number',
			'section'     => 'orchid_store_section_woocommerce_single',
		)
	);


	// Upsell Product Columns in Product Page.
	$wp_customize->add_setting(
		'orchid_store_field_upsell_product_col_no',
		array(
			'default'           => $orchid_store_defaults['orchid_store_field_upsell_product_col_no'],
			'sanitize_callback' => 'orchid_store_sanitize_range',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'orchid_store_field_upsell_product_col_no',
		array(
			'label'       => esc_html__( 'Upsell Product Columns', 'orchid-store' ),
			'description' => esc_html__( 'Set number of columns to be displayed in upsell product section of product page. Maximum number of colums is 6 while minimum number of columns is 2.', 'orchid-store' ),
			'type'        => 'number',
			'section'     => 'orchid_store_section_woocommerce_single',
			'input_attrs' => array(
				'min'  => 2,
				'max'  => 6,
				'step' => 1,
			),
		)
	);

	// Cross Sell Product Columns in Product Page.
	$wp_customize->add_setting(
		'orchid_store_field_cross_sell_product_col_no',
		array(
			'default'           => $orchid_store_defaults['orchid_store_field_cross_sell_product_col_no'],
			'sanitize_callback' => 'orchid_store_sanitize_range',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'orchid_store_field_cross_sell_product_col_no',
		array(
			'label'       => esc_html__( 'Cross Sell Product Columns', 'orchid-store' ),
			'description' => esc_html__( 'Set number of columns to be displayed in cross sell product section of product page. Maximum number of colums is 6 while minimum number of columns is 2.', 'orchid-store' ),
			'type'        => 'number',
			'section'     => 'woocommerce_product_catalog',
			'input_attrs' => array(
				'min'  => 2,
				'max'  => 6,
				'step' => 1,
			),
		)
	);

	// Number of Product Columns in mobile devices.
	$wp_customize->add_setting(
		'orchid_store_field_product_cols_in_mobile',
		array(
			'default'           => $orchid_store_defaults['orchid_store_field_product_cols_in_mobile'],
			'sanitize_callback' => 'orchid_store_sanitize_select',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'orchid_store_field_product_cols_in_mobile',
		array(
			'label'       => esc_html__( 'Mobile - Product Columns', 'orchid-store' ),
			'description' => esc_html__( 'This option sets number of product columns to be displayed mobile devices.', 'orchid-store' ),
			'type'        => 'select',
			'section'     => 'woocommerce_product_catalog',
			'choices'     => array(
				1 => esc_html__( '1', 'orchid-store' ),
				2 => esc_html__( '2', 'orchid-store' ),
			),
		)
	);


	// Display Product Out of Stock Notice.
	$wp_customize->add_setting(
		'orchid_store_field_display_out_of_stock_notice',
		array(
			'sanitize_callback' => 'wp_validate_boolean',
			'default'           => $orchid_store_defaults['orchid_store_field_display_out_of_stock_notice'],
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new Orchid_Store_Customizer_Toggle_Control(
			$wp_customize,
			'orchid_store_field_display_out_of_stock_notice',
			array(
				'label'   => esc_html__( 'Display Product Out of Stock Notice', 'orchid-store' ),
				'section' => 'woocommerce_product_catalog',
				'type'    => 'flat',
			)
		)
	);

	// Add to cart button position.
	// @since 1.5.0.
	$wp_customize->add_setting(
		'orchid_store_field_add_to_cart_button_placement',
		array(
			'sanitize_callback' => 'orchid_store_sanitize_select',
			'default'           => $orchid_store_defaults['orchid_store_field_add_to_cart_button_placement'],
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new Orchid_Store_Radio_Image_Control(
			$wp_customize,
			'orchid_store_field_add_to_cart_button_placement',
			array(
				'label'       => esc_html__( 'Add to Cart Button Position', 'orchid-store' ),
				'description' => '',
				'type'        => 'select',
				'choices'     => orchid_store_add_to_cart_button_positions(),
				'section'     => 'woocommerce_product_catalog',
			)
		)
	);

	// Display add to cart button on hover.
	// @since 1.5.0.
	$wp_customize->add_setting(
		'orchid_store_field_display_add_to_cart_button_on_hover',
		array(
			'sanitize_callback' => 'wp_validate_boolean',
			'default'           => $orchid_store_defaults['orchid_store_field_display_add_to_cart_button_on_hover'],
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new Orchid_Store_Customizer_Toggle_Control(
			$wp_customize,
			'orchid_store_field_display_add_to_cart_button_on_hover',
			array(
				'label'           => esc_html__( 'Display Add to Cart Button on Product Hover', 'orchid-store' ),
				'section'         => 'woocommerce_product_catalog',
				'type'            => 'flat', // ios, light, flat.
				'active_callback' => 'orchid_store_is_add_to_cart_button_enabled_in_product_archive',
			)
		)
	);

	// Enable add to cart button icon.
	// @since 1.5.0.
	$wp_customize->add_setting(
		'orchid_store_field_display_add_to_cart_button_icon',
		array(
			'sanitize_callback' => 'wp_validate_boolean',
			'default'           => $orchid_store_defaults['orchid_store_field_display_add_to_cart_button_icon'],
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new Orchid_Store_Customizer_Toggle_Control(
			$wp_customize,
			'orchid_store_field_display_add_to_cart_button_icon',
			array(
				'label'   => esc_html__( 'Enable Add to Cart Button Icon', 'orchid-store' ),
				'section' => 'orchid_store_section_woocommerce_miscellaneous',
				'type'    => 'flat', // ios, light, flat.
			)
		)
	);

	// Add to cart button icon position.
	// @since 1.5.0.
	$wp_customize->add_setting(
		'orchid_store_field_add_to_cart_button_icon_position',
		array(
			'sanitize_callback' => 'orchid_store_sanitize_select',
			'default'           => $orchid_store_defaults['orchid_store_field_add_to_cart_button_icon_position'],
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'orchid_store_field_add_to_cart_button_icon_position',
		array(
			'label'       => esc_html__( 'Add to Cart Button Icon Position', 'orchid-store' ),
			'description' => '',
			'type'        => 'select',
			'choices'     => array(
				'left'  => esc_html__( 'Left', 'orchid-store' ),
				'right' => esc_html__( 'Right', 'orchid-store' ),
			),
			'section'     => 'orchid_store_section_woocommerce_miscellaneous',
		)
	);

	// Enable percentage sale tag.
	// @since 1.5.0.
	$wp_customize->add_setting(
		'orchid_store_field_enable_percentage_sale_tag',
		array(
			'sanitize_callback' => 'wp_validate_boolean',
			'default'           => $orchid_store_defaults['orchid_store_field_enable_percentage_sale_tag'],
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new Orchid_Store_Customizer_Toggle_Control(
			$wp_customize,
			'orchid_store_field_enable_percentage_sale_tag',
			array(
				'label'   => esc_html__( 'Enable Percentage Sale Tag', 'orchid-store' ),
				'section' => 'orchid_store_section_woocommerce_miscellaneous',
				'type'    => 'flat', // ios, light, flat.
			)
		)
	);

	// Sale tag text.
	// @since 1.5.0.
	$wp_customize->add_setting(
		'orchid_store_field_sale_tag_text',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => $orchid_store_defaults['orchid_store_field_sale_tag_text'],
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'orchid_store_field_sale_tag_text',
		array(
			'label'           => esc_html__( 'Sale Tag Text', 'orchid-store' ),
			'type'            => 'text',
			'section'         => 'orchid_store_section_woocommerce_miscellaneous',
			'active_callback' => 'orchid_store_is_percentage_discount_tag_disabled',
		)
	);


	// Display plus and minus buttons @since 1.2.7.
	$wp_customize->add_setting(
		'orchid_store_field_display_plus_minus_btns',
		array(
			'sanitize_callback' => 'wp_validate_boolean',
			'default'           => $orchid_store_defaults['orchid_store_field_display_plus_minus_btns'],
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new Orchid_Store_Customizer_Toggle_Control(
			$wp_customize,
			'orchid_store_field_display_plus_minus_btns',
			array(
				'label'       => esc_html__( 'Display Plus &amp; Minus Buttons', 'orchid-store' ),
				'description' => esc_html__( 'This option adds plus and minus buttons before and after quantity field respectively.', 'orchid-store' ),
				'section'     => 'orchid_store_section_woocommerce_single',
				'type'        => 'flat',
			)
		)
	);


	$wp_customize->add_section(
		'orchid_store_section_woocommerce_message',
		array(
			'title' => esc_html__( 'Cart Messages', 'orchid-store' ),
			'panel' => 'woocommerce',
		)
	);

	// Enable cart messages.
	// @since 1.5.0.
	$wp_customize->add_setting(
		'orchid_store_field_enable_cart_messages',
		array(
			'sanitize_callback' => 'wp_validate_boolean',
			'default'           => $orchid_store_defaults['orchid_store_field_enable_cart_messages'],
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new Orchid_Store_Customizer_Toggle_Control(
			$wp_customize,
			'orchid_store_field_enable_cart_messages',
			array(
				'label'   => esc_html__( 'Enable Cart Messages', 'orchid-store' ),
				'section' => 'orchid_store_section_woocommerce_message',
				'type'    => 'flat', // ios, light, flat.
			)
		)
	);

	// Message when product is added to cart.
	$wp_customize->add_setting(
		'orchid_store_field_product_added_to_cart_message',
		array(
			'default'           => $orchid_store_defaults['orchid_store_field_product_added_to_cart_message'],
			'sanitize_callback' => 'sanitize_text_field',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'orchid_store_field_product_added_to_cart_message',
		array(
			'label'   => esc_html__( 'Product Added To Cart', 'orchid-store' ),
			'type'    => 'text',
			'section' => 'orchid_store_section_woocommerce_message',
		)
	);


	// Message when product is removed from cart.
	$wp_customize->add_setting(
		'orchid_store_field_product_removed_from_cart_message',
		array(
			'default'           => $orchid_store_defaults['orchid_store_field_product_removed_from_cart_message'],
			'sanitize_callback' => 'sanitize_text_field',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'orchid_store_field_product_removed_from_cart_message',
		array(
			'label'   => esc_html__( 'Product Removed From Cart', 'orchid-store' ),
			'type'    => 'text',
			'section' => 'orchid_store_section_woocommerce_message',
		)
	);


	// Message when cart is updated.
	$wp_customize->add_setting(
		'orchid_store_field_cart_update_message',
		array(
			'default'           => $orchid_store_defaults['orchid_store_field_cart_update_message'],
			'sanitize_callback' => 'sanitize_text_field',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'orchid_store_field_cart_update_message',
		array(
			'label'   => esc_html__( 'Cart Updated', 'orchid-store' ),
			'type'    => 'text',
			'section' => 'orchid_store_section_woocommerce_message',
		)
	);



	// Effect on product image on product hover.
	// @since 1.5.0.
	$wp_customize->add_setting(
		'orchid_store_field_on_hover_image_effect',
		array(
			'sanitize_callback' => 'orchid_store_sanitize_select',
			'default'           => $orchid_store_defaults['orchid_store_field_on_hover_image_effect'],
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'orchid_store_field_on_hover_image_effect',
		array(
			'label'   => esc_html__( 'Effect on Product Image on Hover', 'orchid-store' ),
			'section' => 'woocommerce_product_images',
			'type'    => 'select',
			'choices' => array(
				'none' => esc_html__( 'None', 'orchid-store' ),
				'zoom' => esc_html__( 'Zoom', 'orchid-store' ),
				'swap' => esc_html__( 'Swap', 'orchid-store' ),
			),
		)
	);


	// Checkout page layout.
	// @since 1.5.0.
	$wp_customize->add_setting(
		'orchid_store_field_checkout_layout',
		array(
			'sanitize_callback' => 'orchid_store_sanitize_select',
			'default'           => $orchid_store_defaults['orchid_store_field_checkout_layout'],
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new Orchid_Store_Radio_Image_Control(
			$wp_customize,
			'orchid_store_field_checkout_layout',
			array(
				'label'       => esc_html__( 'Checkout Layout', 'orchid-store' ),
				'description' => '',
				'type'        => 'select',
				'choices'     => orchid_store_checkout_page_layouts(),
				'section'     => 'woocommerce_checkout',
			)
		)
	);

	// Cart page layout.
	// @since 1.5.0.
	$wp_customize->add_setting(
		'orchid_store_field_cart_layout',
		array(
			'sanitize_callback' => 'orchid_store_sanitize_select',
			'default'           => $orchid_store_defaults['orchid_store_field_cart_layout'],
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new Orchid_Store_Radio_Image_Control(
			$wp_customize,
			'orchid_store_field_cart_layout',
			array(
				'label'       => esc_html__( 'Cart Layout', 'orchid-store' ),
				'description' => '',
				'type'        => 'select',
				'choices'     => orchid_store_cart_page_layouts(),
				'section'     => 'orchid_store_section_woocommerce_cart',
			)
		)
	);
}

