<?php

$defaults = orchid_store_get_default_theme_options();

if( ! function_exists( 'orchid_store_panel_declaration' ) ) {

	function orchid_store_panel_declaration() {

		$panels = array(
			array(
				'id' => 'site_header',
				'title' => esc_html__( 'Site Header', 'orchid-store' ),
				'description' => '',
				'priority' => 2,
			),
			array(
				'id' => 'site_pages',
				'title' => esc_html__( 'Site Pages', 'orchid-store' ),
				'description' => '',
				'priority' => 2,
			),
		);

		if( !empty( $panels ) ) {

			foreach( $panels as $panel ) {

				orchid_store_add_panel( $panel['id'], $panel['title'], $panel['description'], $panel['priority'] );
			}
		}
	}
}
orchid_store_panel_declaration();


if( ! function_exists( 'orchid_store_section_declaration' ) ) {

	function orchid_store_section_declaration() {

		$sections = array(
			array(
				'id' => 'site_logo',
				'title' => esc_html__( 'Site Logo', 'orchid-store' ),
				'description' => '',
				'panel' => 'site_header',
				'priority' => '',
			),
			array(
				'id' => 'site_favicon',
				'title' => esc_html__( 'Site Favicon', 'orchid-store' ),
				'description' => '',
				'panel' => 'site_header',
				'priority' => '',
			),
			array(
				'id' => 'header_image',
				'title' => esc_html__( 'Header Image', 'orchid-store' ),
				'description' => '',
				'panel' => 'site_header',
				'priority' => '',
			),
			array(
				'id' => 'top_header',
				'title' => esc_html__( 'Top Header', 'orchid-store' ),
				'description' => '',
				'panel' => 'site_header',
				'priority' => '',
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
				'title' => esc_html__( 'Site Sidebar', 'orchid-store' ),
				'description' => '',
				'panel' => '',
				'priority' => 3,
			),
			array(
				'id' => 'site_footer',
				'title' => esc_html__( 'Site Footer', 'orchid-store' ),
				'description' => '',
				'panel' => '',
				'priority' => 3,
			),
			array(
				'id' => 'post_excerpt',
				'title' => esc_html__( 'Post Excerpt', 'orchid-store' ),
				'description' => '',
				'panel' => '',
				'priority' => 3,
			),
			array(
				'id' => 'theme_color',
				'title' => esc_html__( 'Theme Color', 'orchid-store' ),
				'description' => '',
				'panel' => '',
				'priority' => 3,
			),
		);

		if( !empty( $sections ) ) {

			foreach( $sections as $section ) {

				orchid_store_add_section( $section['id'], $section['title'], $section['description'], $section['panel'], $section['priority'] );
			}
		}
	}
}
orchid_store_section_declaration();


/*******************************************************************************************************
********************************** Home Page Control Fields Declaration *********************************
*******************************************************************************************************/
$wp_customize->add_setting( 
	'orchid_store_field_enable_home_content', 
	array(
		'sanitize_callback' => 'wp_validate_boolean',
		'default' => $defaults['orchid_store_field_enable_home_content' ],
	) 
);

$wp_customize->add_control( 
	new Orchid_Store_Customizer_Toggle_Control( $wp_customize,
		'orchid_store_field_enable_home_content', 
		array(
			'label' => esc_html__( 'Enable Home Content', 'masonry-blog' ),
			'section' => 'static_front_page',
			'type' => 'ios',
			'active_callback' => 'orchid_store_is_static_home_page_set',
		) 
	) 
);


/*******************************************************************************************************
********************************** Header Control Fields Declaration *********************************
*******************************************************************************************************/
orchid_store_add_toggle_field( 'display_top_header', esc_html__( 'Display Top Header', 'orchid-store' ), '', '', 'top_header' );

orchid_store_add_sortable_repeater_field( 'top_header_social_links', esc_html__( 'Social Links', 'orchid-store' ), '', 'orchid_store_active_top_header', 'top_header' );



/*******************************************************************************************************
************************************* Blog Page Control Fields Declaration *****************************
*******************************************************************************************************/
orchid_store_add_toggle_field( 'blog_display_cats', esc_html__( 'Display Post Categories', 'orchid-store' ), '', '', 'blog_page' );
orchid_store_add_toggle_field( 'blog_display_date', esc_html__( 'Display Post Date', 'orchid-store' ), '', '', 'blog_page' );
orchid_store_add_toggle_field( 'blog_display_author', esc_html__( 'Display Post Author', 'orchid-store' ), '', '', 'blog_page' );
orchid_store_add_radio_image_field( 'blog_sidebar_position', esc_html__( 'Select Sidebar Position', 'orchid-store' ), '', orchid_store_all_sidebar_positions(), '', 'blog_page' );




/*******************************************************************************************************
********************************** Archive Page Control Fields Declaration *****************************
*******************************************************************************************************/
orchid_store_add_toggle_field( 'archive_display_cats', esc_html__( 'Display Post Categories', 'orchid-store' ), '', '', 'archive_page' );
orchid_store_add_toggle_field( 'archive_display_date', esc_html__( 'Display Post Date', 'orchid-store' ), '', '', 'archive_page' );
orchid_store_add_toggle_field( 'archive_display_author', esc_html__( 'Display Post Author', 'orchid-store' ), '', '', 'archive_page' );
orchid_store_add_radio_image_field( 'archive_sidebar_position', esc_html__( 'Select Sidebar Position', 'orchid-store' ), '', orchid_store_all_sidebar_positions(), '', 'archive_page' );



/*******************************************************************************************************
*********************************** Search Page Control Fields Declaration *****************************
*******************************************************************************************************/
orchid_store_add_toggle_field( 'search_display_cats', esc_html__( 'Display Post Categories', 'orchid-store' ), '', '', 'search_page' );
orchid_store_add_toggle_field( 'search_display_date', esc_html__( 'Display Post Date', 'orchid-store' ), '', '', 'search_page' );
orchid_store_add_toggle_field( 'search_display_author', esc_html__( 'Display Post Author', 'orchid-store' ), '', '', 'search_page' );
orchid_store_add_radio_image_field( 'search_sidebar_position', esc_html__( 'Select Sidebar Position', 'orchid-store' ), '', orchid_store_all_sidebar_positions(), '', 'search_page' );



/*******************************************************************************************************
*********************************** Blog Single Control Fields Declaration *****************************
*******************************************************************************************************/
orchid_store_add_toggle_field( 'display_post_featured_image', esc_html__( 'Display Featured Image', 'orchid-store' ), '', '', 'post_single' );
orchid_store_add_toggle_field( 'display_post_cats', esc_html__( 'Display Categories', 'orchid-store' ), '', '', 'post_single' );
orchid_store_add_toggle_field( 'display_post_date', esc_html__( 'Display Posted Date', 'orchid-store' ), '', '', 'post_single' );
orchid_store_add_toggle_field( 'display_post_author', esc_html__( 'Display Author Name', 'orchid-store' ), '', '', 'post_single' );
orchid_store_add_toggle_field( 'display_post_tags', esc_html__( 'Display Tags', 'orchid-store' ), '', '', 'post_single' );
orchid_store_add_radio_image_field( 'post_sidebar_position', esc_html__( 'Select Sidebar Position', 'orchid-store' ), '', orchid_store_all_sidebar_positions(), '', 'post_single' );



/*******************************************************************************************************
*********************************** Page Single Control Fields Declaration *****************************
*******************************************************************************************************/
orchid_store_add_toggle_field( 'display_page_featured_image', esc_html__( 'Display Featured Image', 'orchid-store' ), '', '', 'page_single' );
orchid_store_add_radio_image_field( 'page_sidebar_position', esc_html__( 'Select Sidebar Position', 'orchid-store' ), '', orchid_store_all_sidebar_positions(), '', 'page_single' );




/*******************************************************************************************************
************************************ Sidebar Control Fields Declaration *********************************
*******************************************************************************************************/
orchid_store_add_toggle_field( 'enable_sticky_sidebar', esc_html__( 'Enable Sticky Sidebar', 'orchid-store' ), '', '', 'site_sidebar' );
orchid_store_add_toggle_field( 'enable_sidebar_small_devices', esc_html__( 'Enable Sidebar For Small Devices', 'orchid-store' ), esc_html__( 'This option lets you to display or do not display sidebar for devices with width smaller than 768px.', 'orchid-store' ), '', 'site_sidebar' );
orchid_store_add_toggle_field( 'enable_global_sidebar_position', esc_html__( 'Enable Global Sidebar Position', 'orchid-store' ), esc_html__( 'On checking this option, all the page templates of your website will have same sidebar position.', 'orchid-store' ), '', 'site_sidebar' );
orchid_store_add_radio_image_field( 'global_sidebar_position', esc_html__( 'Select Sidebar Position', 'orchid-store' ), '', orchid_store_all_sidebar_positions(), '', 'site_sidebar' );



/*******************************************************************************************************
************************************ Footer Control Fields Declaration *********************************
*******************************************************************************************************/
orchid_store_add_select_field( 'footer_widgets_area_columns', esc_html__( 'Select Number of Widget Area Columns', 'orchid-store' ), '', array( '1' => esc_html__( '1', 'orchid-store' ), '2' => esc_html__( '2', 'orchid-store' ), '3' => esc_html__( '3', 'orchid-store' ), '4' => esc_html__( '4', 'orchid-store' ) ), '', 'site_footer', false );
orchid_store_add_text_field( 'copyright_text', esc_html__( 'Copyright Text', 'orchid-store' ), '', '', 'site_footer' );
orchid_store_add_image_field( 'payments_image', esc_html__( 'Image of Payment Processors', 'orchid-store' ), '', '', 'site_footer' );


/*******************************************************************************************************
***************************************** Excerpt Fields Declaration ***********************************
*******************************************************************************************************/
orchid_store_add_number_field( 'excerpt_length', esc_html__( 'Excerpt Length', 'orchid-store' ), esc_html__( 'Excerpt is the short content of post or page.', 'orchid-store' ), '', 'post_excerpt', '', '', '' );



/*******************************************************************************************************
***************************************** Theme Color Declaration ***********************************
*******************************************************************************************************/
orchid_store_add_color_field( 'primary_color', esc_html__( 'Primary Color', 'orchid-store' ), '', '', 'theme_color' );
orchid_store_add_color_field( 'secondary_color', esc_html__( 'Secondary Color', 'orchid-store' ), '', '', 'theme_color' );



/*******************************************************************************************************
***************************************** Woocommerce Option Declaration *******************************
*******************************************************************************************************/
if( class_exists( 'Woocommerce' ) ) {

	$wp_customize->add_section( 
		'orchid_store_section_woocommerce_sidebar', 
		array(
			'title'			=> esc_html__( 'Woocommerce Sidebar', 'orchid-store' ),
			'panel'			=> 'woocommerce',
		) 
	);

	// Woocommerce Pages Sidebar Postion
	$wp_customize->add_setting( 'orchid_store_field_woocommerce_sidebar_position', 
		array(
			'sanitize_callback'		=> 'orchid_store_sanitize_select',
			'default'				=> $defaults['orchid_store_field_woocommerce_sidebar_position'],
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control( 
		new Orchid_Store_Radio_Image_Control( $wp_customize, 'orchid_store_field_woocommerce_sidebar_position', 
			array(
				'label' => esc_html__( 'Sidebar Position', 'orchid-store' ),
				'description' => '',
				'type'	=> 'select',
				'choices' => orchid_store_all_sidebar_positions(),
				'section' => 'orchid_store_section_woocommerce_sidebar',
			)
		) 
	);

	// No of Product Columns in Shop Page
	$wp_customize->add_setting( 'orchid_store_field_shop_product_col_no', 
		array(
		'default' => $defaults['orchid_store_field_shop_product_col_no'],
		'sanitize_callback' => 'orchid_store_sanitize_range',
		'capability'        => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control( 'orchid_store_field_shop_product_col_no', 
		array(
			'label' => esc_html__( 'Shop - Product Columns', 'orchid-store' ),
			'description' => esc_html__( 'Set number of columns to be displayed in shop page for displaying products. Maximum number of colums is 6 while minimum number of columns is 2.', 'orchid-store' ),
			'type' => 'number',
			'section' => 'woocommerce_product_catalog',
			'input_attrs' => array(
				'min' => 2,
				'max' => 6,
				'step' => 1
			),
		)
	);


	// No of Related Product Columns in Product Page
	$wp_customize->add_setting( 'orchid_store_field_related_product_col_no', 
		array(
		'default' => $defaults['orchid_store_field_related_product_col_no'],
		'sanitize_callback' => 'orchid_store_sanitize_range',
		'capability'        => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control( 'orchid_store_field_related_product_col_no', 
		array(
			'label' => esc_html__( 'Related Product Columns', 'orchid-store' ),
			'description' => esc_html__( 'Set number of columns to be displayed in related product section of product page. Maximum number of colums is 6 while minimum number of columns is 2.', 'orchid-store' ),
			'type' => 'number',
			'section' => 'woocommerce_product_catalog',
			'input_attrs' => array(
				'min' => 2,
				'max' => 6,
				'step' => 1
			),
		)
	);


	// No of Related Products in Product Page
	$wp_customize->add_setting( 'orchid_store_field_related_product_no', 
		array(
		'default' => $defaults['orchid_store_field_related_product_no'],
		'sanitize_callback' => 'orchid_store_sanitize_number',
		'capability'        => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control( 'orchid_store_field_related_product_no', 
		array(
			'label' => esc_html__( 'No of Related Product', 'orchid-store' ),
			'description' => esc_html__( 'Set number of products to be displayed in related product section of product page.', 'orchid-store' ),
			'type' => 'number',
			'section' => 'woocommerce_product_catalog',
		)
	);


	// Upsell Product Columns in Product Page
	$wp_customize->add_setting( 'orchid_store_field_upsell_product_col_no', 
		array(
		'default' => $defaults['orchid_store_field_upsell_product_col_no'],
		'sanitize_callback' => 'orchid_store_sanitize_range',
		'capability'        => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control( 'orchid_store_field_upsell_product_col_no', 
		array(
			'label' => esc_html__( 'Upsell Product Columns', 'orchid-store' ),
			'description' => esc_html__( 'Set number of columns to be displayed in upsell product section of product page. Maximum number of colums is 6 while minimum number of columns is 2.', 'orchid-store' ),
			'type' => 'number',
			'section' => 'woocommerce_product_catalog',
			'input_attrs' => array(
				'min' => 2,
				'max' => 6,
				'step' => 1
			),
		)
	);

	// Cross Sell Product Columns in Product Page
	$wp_customize->add_setting( 'orchid_store_field_cross_sell_product_col_no', 
		array(
		'default' => $defaults['orchid_store_field_cross_sell_product_col_no'],
		'sanitize_callback' => 'orchid_store_sanitize_range',
		'capability'        => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control( 'orchid_store_field_cross_sell_product_col_no', 
		array(
			'label' => esc_html__( 'Cross Sell Product Columns', 'orchid-store' ),
			'description' => esc_html__( 'Set number of columns to be displayed in cross sell product section of product page. Maximum number of colums is 6 while minimum number of columns is 2.', 'orchid-store' ),
			'type' => 'number',
			'section' => 'woocommerce_product_catalog',
			'input_attrs' => array(
				'min' => 2,
				'max' => 6,
				'step' => 1
			),
		)
	);
}