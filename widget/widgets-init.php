<?php
/**
 * 
 */

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function orchid_store_widgets_init() {
	
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'orchid-store' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'orchid-store' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><h3>',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Frontpage Widget Area', 'orchid-store' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'orchid-store' ),
		'before_widget' => '<section id="%1$s" class="section-spacing %2$s"><div class="section-inner"><div class="__os-container__">',
		'after_widget'  => '</div></div></section>',
		'before_title'  => '<div class="section-title"><h2>',
		'after_title'   => '</h2></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'orchid-store' ),
		'id'            => 'sidebar-3',
		'description'   => esc_html__( 'Add widgets here.', 'orchid-store' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><h3>',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'orchid-store' ),
		'id'            => 'sidebar-4',
		'description'   => esc_html__( 'Add widgets here.', 'orchid-store' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><h3>',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'orchid-store' ),
		'id'            => 'sidebar-5',
		'description'   => esc_html__( 'Add widgets here.', 'orchid-store' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><h3>',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 4', 'orchid-store' ),
		'id'            => 'sidebar-6',
		'description'   => esc_html__( 'Add widgets here.', 'orchid-store' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><h3>',
		'after_title'   => '</h3></div>',
	) );

	register_widget( 'Orchid_Store_Banner_Widget' );	

	register_widget( 'Orchid_Store_Post_Widget' );

	register_widget( 'Orchid_Store_Advertisement_Widget' );

	register_widget( 'Orchid_Store_Services_Widget' );


	if( class_exists( 'Woocommerce' ) ) {

		register_widget( 'Orchid_Store_Featured_Product_Categories_Widget' );

		register_widget( 'Orchid_Store_Products_Filter_Widget' );

		register_widget( 'Orchid_Store_Products_Grid_Widget' );

		register_widget( 'Orchid_Store_Products_Carousel_Widget' );
	}
}
add_action( 'widgets_init', 'orchid_store_widgets_init' );


/**
 * Widget to display product categories and page slider.
 */
require get_template_directory() . '/widget/widgets/banner-widget.php';

/**
 * Widget to display recent blog posts.
 */
require get_template_directory() . '/widget/widgets/posts-widget.php';

/**
 * Widget to display offer advertisement.
 */
require get_template_directory() . '/widget/widgets/advertisement-widget.php';

/**
 * Widget to display services offered.
 */
require get_template_directory() . '/widget/widgets/services-widget.php';


if( class_exists( 'Woocommerce' ) ) {

	/**
	 * Widget to display featured product categories.
	 */
	require get_template_directory() . '/widget/widgets/featured-product-categories.php';

	/**
	 * Widget to display products and filter products according to product category.
	 */
	require get_template_directory() . '/widget/widgets/products-filter.php';

	/**
	 * Widget to display products in grid.
	 */
	require get_template_directory() . '/widget/widgets/products-grid.php';

	/**
	 * Widget to display products in carousel.
	 */
	require get_template_directory() . '/widget/widgets/products-slider.php';
}