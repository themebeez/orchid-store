<?php
/**
 * Display Products In Grid Widget Class
 *
 * @package Orchid_Store
 */

if( ! class_exists( 'Orchid_Store_Products_Grid_Widget' ) ) {

    class Orchid_Store_Products_Grid_Widget extends WP_Widget {
     
        function __construct() { 

            parent::__construct(
                'orchid-store-products-grid-widget',
                esc_html__( 'OS: Product Grid', 'orchid-store' ),
                array(
                    'classname'     => '',
                    'description'   => esc_html__( 'Displays products in grid.', 'orchid-store' ), 
                )
            );     
        }
     
        public function widget( $args, $instance ) {

            $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
            $product_category = $instance['product_category'];
            $no_of_products = $instance['no_of_products'];

            $product_query_args = array(
                'post_type' => 'product',
            );

            if( $no_of_products > 0 ) {
                $product_query_args['posts_per_page'] = $no_of_products;
            } else {
                $product_query_args['posts_per_page'] = 4;
            }

            if( $product_category != '0' ) {
                $product_query_args['tax_query'] = array(
                    array(
                        'taxonomy'  => 'product_cat',
                        'field'     => 'slug',
                        'terms'     => $product_category,
                    )
                );
            }

            $product_query = new WP_Query( $product_query_args );

            if( $product_query->have_posts() ) {
                ?>
                <section class="product-widget product-widget-style-1 section-spacing">
                    <div class="section-inner">
                        <div class="__os-container__">
                            <div class="widget-entry">
                                <?php
                                if( !empty( $title ) ) {
                                    ?>
                                    <div class="section-title">
                                        <h2><?php echo esc_html( $title ); ?></h2>
                                    </div><!-- .section-title -->
                                    <?php
                                }
                                ?>
                                <div class="product-entry">
                                    <div class="woocommerce columns-4">
                                        <ul class="products">
                                            <?php
                                            while( $product_query->have_posts() ) {

                                                $product_query->the_post();
                                                
                                                wc_get_template_part( 'content', 'product' );
                                            }

                                            woocommerce_reset_loop();

                                            wp_reset_postdata();
                                            ?>
                                        </ul>
                                    </div><!-- .woocommerce.columns-4 -->
                                </div><!-- .product-entry -->
                            </div><!-- .widget-entry -->
                        </div><!-- .__os-container__ -->
                    </div><!-- .section-inner -->
                </section><!-- .product-widget.product-widget-style-1.section-spacing -->
                <?php    
            } 
        }
     
        public function form( $instance ) {

            $defaults = array(
                'title'                 => '',
                'product_category'      => '',
                'no_of_products'        => 4,
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
                <label for="<?php echo esc_attr( $this->get_field_id('product_category') ); ?>">
                    <strong><?php esc_html_e( 'Product Category', 'orchid-store' ); ?></strong>
                </label>
                <?php 
                wp_dropdown_categories( array(
                    'taxonomy'          => 'product_cat',
                    'show_option_all'   => esc_html__('Select Category','orchid-store'),
                    'name'              => $this->get_field_name('product_category'),
                    'id'                => $this->get_field_id('product_category'),
                    'class'             => 'widefat',
                    'value_field'       => 'slug',
                    'hide_empty'        => 1,
                    'selected'          => isset( $instance['product_category'] ) ? $instance['product_category'] : '',
                ) );
                ?>
                <span class="sldr-elmnt-desc"><?php esc_html_e( 'If no category is selected, then latest products are displayed.', 'orchid-store' ); ?></span>
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('no_of_products') ); ?>">
                    <strong><?php esc_html_e('No of Products', 'orchid-store'); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('no_of_products') ); ?>" name="<?php echo esc_attr( $this->get_field_name('no_of_products') ); ?>" type="number" value="<?php echo esc_attr( absint( $instance['no_of_products'] ) ); ?>" />   
            </p>
    		<?php
        }
     
        public function update( $new_instance, $old_instance ) {
     
            $instance = $old_instance;

            $instance['title']                  = sanitize_text_field( $new_instance['title'] );

            $instance['product_category']       = sanitize_text_field( $new_instance['product_category'] );

            $instance['no_of_products']         = absint( $new_instance['no_of_products'] );

            return $instance;
        } 
    }
}