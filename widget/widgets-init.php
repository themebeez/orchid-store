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

	$footer_widget_areas = orchid_store_get_option( 'footer_widgets_area_columns' );

	if( !empty( $footer_widget_areas ) ) {

		for( $i = 1; $i <= $footer_widget_areas; $i++ ) {

			$sidebar_id = 'footer-'.$i;

			register_sidebar( array(
				/* translators: %s: number of footer widget area. */
				'name'          => sprintf( esc_html__( 'Footer %s', 'orchid-store' ), $i ),
				'id'            => $sidebar_id,
				'description'   => esc_html__( 'Add widgets here.', 'orchid-store' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="widget-title"><h3>',
				'after_title'   => '</h3></div>',
			) );
		}
	}

	register_sidebar( array(
		'name'          => esc_html__( 'Woocommerce Sidebar', 'orchid-store' ),
		'id'            => 'woocommerce-sidebar',
		'description'   => esc_html__( 'Add woocommerce widgets here.', 'orchid-store' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><h3>',
		'after_title'   => '</h3></div>',
	) );

	register_widget( 'Orchid_Store_Banner_Widget' );	

	register_widget( 'Orchid_Store_Post_Widget' );

	register_widget( 'Orchid_Store_Advertisement_Widget' );

	register_widget( 'Orchid_Store_Services_Widget' );

	register_widget( 'Orchid_Store_About_Widget' );


	if( class_exists( 'WooCommerce' ) ) {

		register_widget( 'Orchid_Store_Featured_Product_Categories_Widget' );

		register_widget( 'Orchid_Store_Products_Filter_Widget' );

		register_widget( 'Orchid_Store_Products_Widget' );
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


/**
 * Widget to display about store information
 */
require get_template_directory() . '/widget/widgets/about-widget.php';


if( class_exists( 'WooCommerce' ) ) {

	/**
	 * Widget to display featured product categories.
	 */
	require get_template_directory() . '/widget/widgets/featured-product-categories.php';

	/**
	 * Widget to display products and filter products according to product category.
	 */
	require get_template_directory() . '/widget/widgets/products-filter.php';

	/**
	 * Widget to display products.
	 */
	require get_template_directory() . '/widget/widgets/products-widget.php';
}