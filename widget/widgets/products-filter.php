<?php
/**
 * Display Products With Filter Widget Class
 *
 * @package Orchid_Store
 */

if( ! class_exists( 'Orchid_Store_Products_Filter_Widget' ) ) {

    class Orchid_Store_Products_Filter_Widget extends WP_Widget {
            
        public $value_as;

        function __construct() { 

            parent::__construct(
                'orchid-store-products-filter-widget',
                esc_html__( 'OS: Products By Category Filter', 'orchid-store' ),
                array(
                    'classname'     => '',
                    'description'   => esc_html__( 'Displays products by category filter.', 'orchid-store' ), 
                )
            );  

            $this->value_as = orchid_store_get_option( 'value_as' );   
        }
     
        public function widget( $args, $instance ) {

            $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
            $product_categories = isset( $instance['product_categories'] ) ? $instance['product_categories'] : array();
            $no_of_products = isset( $instance['no_of_products'] ) ? $instance['no_of_products'] : 4;

            $hide_out_of_stock_products = isset( $instance['hide_out_of_stock_products'] ) ? $instance['hide_out_of_stock_products'] : false;

            if( empty( $product_categories ) ) {
                $all_product_caregories = orchid_store_all_product_categories();

                if( !empty(  $all_product_caregories) ) {

                    $count = 1;

                    foreach( $all_product_caregories as $product_category ) {                        

                        if( $count <= 5 ) {

                            $product_categories[] = $product_category->slug;
                        } else {

                            break;
                        }

                        $count++;
                    }
                }
            }


            if( !empty( $product_categories ) ) {
                ?>
                <section class="product-widget product-widget-style-2 section-spacing">
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
                                    <div class="tab-wrapper">
                                        <div class="tab-nav">
                                            <ul>
                                                <?php
                                                foreach( $product_categories as $index => $product_category ) {

                                                    $index++;

                                                    $product_category_term = '';

                                                    if ( $this->value_as == 'slug' ) {

                                                        $product_category_term = get_term_by( 'slug', $product_category, 'product_cat' );
                                                    } else {
                                                        $product_category_term = get_term_by( 'id', absint( $product_category ), 'product_cat' );
                                                    }

                                                    if( !empty( $product_category_term ) ) {
                                                        ?>
                                                        <li><a href="#tab<?php echo esc_attr( $index ); ?>" rel="tab<?php echo esc_attr( $index ); ?>" <?php if( $index == 1 ) { ?>class="active"<?php } ?>><?php echo esc_html( $product_category_term->name ); ?></a></li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div><!-- .tab-nav -->
                                        <div class="tabs-entry">
                                            <?php
                                            foreach( $product_categories as $index => $product_category ) {

                                                $index++;

                                                $product_query_args = array(
                                                    'post_type' => 'product',
                                                );

                                                if( $no_of_products > 0 ) {
                                                    $product_query_args['posts_per_page'] = $no_of_products;
                                                } else {
                                                    $product_query_args['posts_per_page'] = 4;
                                                }

                                                if( $product_category != '0' ) {

                                                    if ( $this->value_as == 'slug'  ) {
                                                        $product_query_args['tax_query'] = array(
                                                            array(
                                                                'taxonomy'  => 'product_cat',
                                                                'field'     => 'slug',
                                                                'terms'     => $product_category,
                                                            )
                                                        );
                                                    } else {
                                                        $product_query_args['tax_query'] = array(
                                                            array(
                                                                'taxonomy'  => 'product_cat',
                                                                'field'     => 'term_id',
                                                                'terms'     => $product_category,
                                                            )
                                                        );
                                                    }
                                                }

                                                if ( $hide_out_of_stock_products == true ) {

                                                    $product_query_args['meta_query'][] = array(
                                                        'key'       => '_stock_status',
                                                        'value'     => 'outofstock',
                                                        'compare'   => '!=',
                                                    );
                                                }

                                                $product_query = new WP_Query( $product_query_args );

                                                if( $product_query->have_posts() ) {

                                                    $mobile_cols_no = get_theme_mod( 'orchid_store_field_product_cols_in_mobile', 1 );

                                                    $mobile_col_class = 'os-mobile-col-' . $mobile_cols_no;
                                                    ?>
                                                    <div id="tab<?php echo esc_attr( $index ); ?>" class="tab-content">
                                                        <div class="woocommerce columns-4 <?php echo esc_attr( $mobile_col_class ); ?>">
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
                                                        </div><!-- .woocommerce columns-4 -->
                                                    </div><!-- #tab -->
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div><!-- .tabs-entry -->
                                    </div><!-- .tab-wrapper -->
                                </div><!-- .product-entry -->
                            </div><!-- .widget-entry -->
                        </div><!-- .__os-container__ -->
                    </div><!-- .section-inner -->
                </section><!-- .product-widget.product-widget-style-2.section-spacing -->
                <?php
            }  

     
        }
     
        public function form( $instance ) {

            $defaults = array(
                'title'                 => '',
                'product_categories'    => '',
                'no_of_products'        => 4,
                'hide_out_of_stock_products' => false,
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

                    if ( $this->value_as == 'slug' ) {

                        foreach( $product_categories as $product_category ) {
                            ?>
                            <span class="sldr-elmnt-cntnr">
                                <label for="<?php echo esc_attr( $this->get_field_id( 'product_categories' ) . $product_category->term_id ); ?>">
                                    <input id="<?php echo esc_attr( $this->get_field_id( 'product_categories' ) . $product_category->term_id ); ?>" name="<?php echo esc_attr( $this->get_field_name('product_categories') ); ?>[]" type="checkbox" value="<?php echo esc_attr( $product_category->slug ); ?>" <?php if( !empty( $instance['product_categories'] ) ) { if( in_array( $product_category->slug, $instance['product_categories'] ) ) { ?>checked<?php } } ?>>
                                    <strong><?php echo esc_html( $product_category->name ); ?></strong>
                                </label>

                            </span><!-- .sldr-elmnt-cntnr -->
                            <?php
                        }
                    } else {
                        foreach( $product_categories as $product_category ) {
                            ?>
                            <span class="sldr-elmnt-cntnr">
                                <label for="<?php echo esc_attr( $this->get_field_id( 'product_categories' ) . $product_category->term_id ); ?>">
                                    <input id="<?php echo esc_attr( $this->get_field_id( 'product_categories' ) . $product_category->term_id ); ?>" name="<?php echo esc_attr( $this->get_field_name('product_categories') ); ?>[]" type="checkbox" value="<?php echo esc_attr( $product_category->term_id ); ?>" <?php if( !empty( $instance['product_categories'] ) ) { if( in_array( $product_category->term_id, $instance['product_categories'] ) ) { ?>checked<?php } } ?>>
                                    <strong><?php echo esc_html( $product_category->name ); ?></strong>
                                </label>

                            </span><!-- .sldr-elmnt-cntnr -->
                            <?php
                        }
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
                <label for="<?php echo esc_attr( $this->get_field_name('no_of_products') ); ?>">
                    <strong><?php esc_html_e('Number of Products For Each Category', 'orchid-store'); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('no_of_products') ); ?>" name="<?php echo esc_attr( $this->get_field_name('no_of_products') ); ?>" type="number" value="<?php echo esc_attr( absint( $instance['no_of_products'] ) ); ?>" />   
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('hide_out_of_stock_products') ); ?>">
                    <input id="<?php echo esc_attr( $this->get_field_id('hide_out_of_stock_products') ); ?>" name="<?php echo esc_attr( $this->get_field_name('hide_out_of_stock_products') ); ?>" type="checkbox" <?php checked( true, $instance['hide_out_of_stock_products'] ); ?> />  
                    <strong><?php esc_html_e( 'Hide Products Out of Stock', 'orchid-store' ); ?></strong>
                </label>                 
            </p>
    		<?php
        }
     
        public function update( $new_instance, $old_instance ) {
     
            $instance = $old_instance;

            $instance['title']                  = sanitize_text_field( $new_instance['title'] );

            if ( $this->value_as == 'slug' ) {
                $instance['product_categories'] 	= isset( $new_instance['product_categories'] ) ? array_map( 'sanitize_text_field', $new_instance['product_categories'] ) : array();
            } else {
                $instance['product_categories']     = isset( $new_instance['product_categories'] ) ? array_map( 'absint', $new_instance['product_categories'] ) : array();
            }

            $instance['no_of_products']         = absint( $new_instance['no_of_products'] );

            $instance['hide_out_of_stock_products']  = isset( $new_instance['hide_out_of_stock_products'] ) ? wp_validate_boolean( $new_instance['hide_out_of_stock_products'] ) : false;

            return $instance;
        } 
    }
}