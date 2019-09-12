<?php
/**
 * Display Featured Product Categories Widget Class
 *
 * @package Orchid_Store
 */

if( ! class_exists( 'Orchid_Store_Featured_Product_Categories_Widget' ) ) {

    class Orchid_Store_Featured_Product_Categories_Widget extends WP_Widget {
     
        function __construct() { 

            parent::__construct(
                'orchid-store-featured-product-categories-widget',
                esc_html__( 'OS: Featured Product Categories', 'orchid-store' ),
                array(
                    'classname'     => '',
                    'description'   => esc_html__( 'Displays featured product categories.', 'orchid-store' ), 
                )
            );     
        }
     
        public function widget( $args, $instance ) {

            $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

            $product_categories = $instance['product_categories'];

            $button_title = $instance['button_title'];

            if( !empty( $product_categories ) ) {
                ?>
                <section class="cats-widget-styles cats-widget-style-1 section-spacing">
                    <div class="section-inner">
                        <div class="__os-container__">
                            <div class="cats-widget-entry">
                                <div class="row">
                                    <?php
                                    foreach( $product_categories as $product_category ) {

                                        $category_term = get_term_by( 'slug', $product_category, 'product_cat' );

                                        $term_img = '';

                                        if( !empty( $category_term ) ) {

                                            $thumbnail_id   = get_term_meta( $category_term->term_id, 'thumbnail_id', true );
                                
                                            $image_url      = wp_get_attachment_image_src( $thumbnail_id, 'shop_catalog' );

                                            if( !empty( $image_url ) ){

                                                $term_img = $image_url[0];

                                            } else {

                                                $term_img = wc_placeholder_img_src();
                                                
                                            } 
                                        }
                                        ?>
                                        <div class="col col-lg-4 col-md-2 col-sm-2 col-12">
                                            <div class="card thumb wow osfadeInUp" style="background-image: url(<?php echo esc_url( $term_img ); ?>);" data-wow-duration="1.5s" data-wow-delay="0.2s">
                                                <div class="shadow">
                                                    <div class="card-content">
                                                        <div class="title">
                                                            <h3><?php echo esc_html( $category_term->name ); ?></h3>
                                                        </div><!-- .title -->
                                                        <?php
                                                        if( !empty( $button_title ) ) {
                                                            ?>
                                                            <div class="permalink">
                                                                <a class="button-general" href="<?php echo esc_url( get_term_link( $category_term->term_id, 'product_cat' ) ); ?>"><?php echo esc_html( $button_title ); ?></a>
                                                            </div><!-- .permalink -->
                                                            <?php
                                                        }
                                                        ?>
                                                    </div><!-- .card-content -->
                                                </div><!-- shadow -->
                                            </div><!-- // card -->
                                        </div><!-- .col -->
                                        <?php
                                    }
                                    ?>
                                </div><!-- .row -->
                            </div><!-- .cats-widget-entry -->
                        </div><!-- .__os-container__ -->
                    </div><!-- .section-inner -->
                </section><!-- .cats-widget-styles.cats-widget-style-1.section-spacing -->
                <?php
            }     
        }
     
        public function form( $instance ) {

            $defaults = array(
                'title'                 => '',
                'product_categories'    => '',
                'button_title'          => '',
            );

            $instance = wp_parse_args( (array) $instance, $defaults );
    		?>
    		<p>
                <label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>">
                    <strong><?php esc_html_e( 'Title', 'orchid-store' ); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />   
            </p>

            <p>
                <span class="sldr-elmnt-title"><strong><?php esc_html_e( 'Product Categories', 'orchid-store' ); ?></strong></span>
                <span class="sldr-elmnt-desc"><?php esc_html_e( 'Below are the list of product categories. Check on a category to set is as a filter item.', 'orchid-store' ) ?></span>

                <span class="widget_multicheck">
                <?php

                $product_categories = orchid_store_all_product_categories();

                if( !empty( $product_categories ) ) {

                    foreach( $product_categories as $product_category ) {
                        ?>
                        <span class="sldr-elmnt-cntnr">

                            <label for="<?php echo esc_attr( $this->get_field_id( 'product_categories' ) . $product_category->term_id ); ?>">
                                <input id="<?php echo esc_attr( $this->get_field_id( 'product_categories' ) . $product_category->term_id ); ?>" name="<?php echo esc_attr( $this->get_field_name('product_categories') ); ?>[]" type="checkbox" value="<?php echo esc_attr( $product_category->slug ); ?>" <?php if( !empty( $instance['product_categories'] ) ) { checked( in_array( $product_category->slug, $instance['product_categories'] ), true ); } ?>>
                                <strong><?php echo esc_html( $product_category->name ); ?></strong>
                            </label>

                        </span><!-- .sldr-elmnt-cntnr -->
                        <?php
                    }
                } else {
                    ?>
                    <input id="<?php echo esc_attr( $this->get_field_id( 'product_categories' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name('product_categories') ); ?>" type="hidden" value="" checked>
                    <small><?php echo esc_html__( 'There are no product categories to select.', 'orchid-store' ); ?></small>
                    <?php
                }
                ?>
                </span>
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('button_title') ); ?>">
                    <strong><?php esc_html_e( 'Button Title', 'orchid-store' ); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('button_title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('button_title') ); ?>" type="text" value="<?php echo esc_attr( $instance['button_title'] ); ?>" />   
                <small><?php echo esc_html__( 'To hide the button, do not set this field.', 'orchid-store' ); ?></small>
            </p>
    		<?php
        }
     
        public function update( $new_instance, $old_instance ) {
     
            $instance = $old_instance;

            $instance['title']                  = sanitize_text_field( $new_instance['title'] );

            $instance['product_categories'] 	= array_map( 'sanitize_key', $new_instance['product_categories'] );

            $instance['button_title']           = sanitize_text_field( $new_instance['button_title'] );

            return $instance;
        } 
    }
}