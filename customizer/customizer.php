<?php
/**
 * Orchid_Store Theme Customizer
 *
 * @package Orchid_Store
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function orchid_store_customize_register( $wp_customize ) {
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';


	/**
	 * Load custom customizer control for radio image control
	 */
	require get_template_directory() . '/customizer/controls/class-customizer-radio-image-control.php';

	/**
	 * Load custom customizer control for select control
	 */
	require get_template_directory() . '/customizer/controls/class-customizer-select-control.php';

	/**
	 * Load custom customizer control for toggle control
	 */
	require get_template_directory() . '/customizer/controls/class-customizer-toggle-control.php';

	/**
	 * Load custom customizer control for slider control
	 */
	require get_template_directory() . '/customizer/controls/class-customizer-sortable-repeater-control.php';

	/**
	 * Load customizer functions for sanitization of input values of contol fields
	 */
	require get_template_directory() . '/customizer/functions/sanitize-callback.php';

	/**
	 * Load customizer functions for intializing panel, section, and control fields
	 */
	require get_template_directory() . '/customizer/functions/reuseable-callback.php';		

	/**
	 * Load customizer functions for loading control field's choices, declaration of panel, section 
	 * and control fields
	 */
	require get_template_directory() . '/customizer/functions/customizer-fields.php';

	/**
	 * Load customizer functions for intializing theme upsell
	 */
	require get_template_directory() . '/customizer/controls/class-customizer-pro-upsell.php';

	$wp_customize->register_section_type( 'Orchid_Store_Pro_Upsell' );

	$wp_customize->add_section(
		new Orchid_Store_Pro_Upsell( $wp_customize, 'orchid_store_pro_upsell', array(
			'title'       	=> esc_html__( 'Orchid Store Pro', 'orchid-store' ),
			'button_text' 	=> esc_html__( 'Go Pro',        'orchid-store' ),
			'button_url'  	=> 'https://themebeez.com/themes/orchid-store-pro/?ref=upsell-btn',
			'priority'		=> 0,
		) )
	);

	if ( isset( $wp_customize->selective_refresh ) ) {
		
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'orchid_store_customize_partial_blogname',
		) );
		
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'orchid_store_customize_partial_blogdescription',
		) );
	}

	$wp_customize->get_control( 'header_textcolor' )->label = esc_html__( 'Site Title Color', 'orchid-store' );
	$wp_customize->get_control( 'header_textcolor' )->section = 'title_tagline';
	$wp_customize->get_control( 'background_color' )->section = 'background_image';
	$wp_customize->get_section( 'background_image' )->title = esc_html__( 'Background', 'orchid-store' );

	$wp_customize->get_control( 'custom_logo' )->section = 'orchid_store_section_site_logo';
	$wp_customize->get_control( 'custom_logo' )->priority = 5;
	$wp_customize->get_control( 'blogname' )->section = 'orchid_store_section_site_logo';
	$wp_customize->get_control( 'blogdescription' )->section = 'orchid_store_section_site_logo';
	$wp_customize->get_control( 'header_textcolor' )->section = 'orchid_store_section_site_logo';
	$wp_customize->get_control( 'display_header_text' )->section = 'orchid_store_section_site_logo';
	$wp_customize->get_control( 'site_icon' )->section = 'orchid_store_section_site_logo';
	$wp_customize->get_control( 'header_image' )->section = 'orchid_store_section_page_header';
	$wp_customize->get_control( 'header_image' )->description = esc_html__( 'Header is used as background image for breadcrumb', 'orchid-store' );
	$wp_customize->get_control( 'header_image' )->priority = 20;
	$wp_customize->get_control( 'header_image' )->active_callback = 'orchid_store_is_page_header_enabled';
	$wp_customize->get_section( 'static_front_page' )->priority = 1;
}
add_action( 'customize_register', 'orchid_store_customize_register' );

/**
 * Load active callback functions.
 */
require get_template_directory() . '/customizer/functions/active-callback.php';

/**
 * Load function to load customizer field's default values.
 */
require get_template_directory() . '/customizer/functions/customizer-defaults.php';

/**
 * Load function to load dynamic style.
 */
require get_template_directory() . '/customizer/functions/dynamic-style.php';


/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function orchid_store_customize_partial_blogname() {

	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function orchid_store_customize_partial_blogdescription() {

	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function orchid_store_customize_preview_js() {

	wp_enqueue_script( 'orchid-store-customizer', get_template_directory_uri() . '/customizer/assets/js/customizer.js', array( 'customize-preview' ), ORCHID_STORE_VERSION, true );
}
add_action( 'customize_preview_init', 'orchid_store_customize_preview_js' );



/**
 * Enqueue Customizer Scripts and Styles
 */
function orchid_store_enqueues() {

	wp_enqueue_style( 'orchid-store-customizer-style', get_template_directory_uri() . '/customizer/assets/css/customizer-style.css' );

	wp_register_script( 'orchid-store-customizer-script', get_template_directory_uri() . '/customizer/assets/js/customizer-script.js', array( 'jquery' ), ORCHID_STORE_VERSION, true );

	$headers = array(
		'logo_setup' => esc_html__( 'Logo Setup', 'orchid-store' ),
		'favicon' => esc_html__( 'Favicon', 'orchid-store' ),
		'home_content' => esc_html__( 'Homepage Content', 'orchid-store' ),
		'post_meta' => esc_html__( 'Post Metas', 'orchid-store' ),
		'sidebar' => esc_html__( 'Sidebar Position', 'orchid-store' ),
		'breadcrumb_background' => esc_html__( 'Background', 'orchid-store' ),
		'body_background' => esc_html__( 'Body Background', 'orchid-store' ),
	);

	wp_localize_script( 'orchid-store-customizer-script', 'fieldHeaders', $headers );
	 
	wp_enqueue_script( 'orchid-store-customizer-script' );
}
add_action( 'customize_controls_enqueue_scripts', 'orchid_store_enqueues' );