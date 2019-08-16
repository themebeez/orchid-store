<?php
/**
 * Product Categories and Slider Widget Class
 *
 * @package Orchid_Store
 */

if( ! class_exists( 'Orchid_Store_Banner_Widget' ) ) {

    class Orchid_Store_Banner_Widget extends WP_Widget {
     
        function __construct() { 

            parent::__construct(
                'orchid-store-product-categories-slider-widget',
                esc_html__( 'OS: Banner', 'orchid-store' ),
                array(
                    'classname'     => 'general-banner banner-style-1 section-spacing',
                    'description'   => esc_html__( 'Displays product categories and slider', 'orchid-store' ), 
                )
            );     
        }
     
        public function widget( $args, $instance ) {

            $title          = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
            $slider_pages   = $instance['slider_pages'];
            $button_titles  = $instance['button_titles'];
            $button_links   = $instance['button_links'];
            $show_contents  = $instance['show_contents'];
            $banner_image_1 = $instance['banner_img_1'];
            $banner_image_2 = $instance['banner_img_2'];
            ?>
            <section class="general-banner banner-style-1 section-spacing">
                <div class="section-inner">
                    <div class="__os-container__">
                        <div class="os-row">
                            <?php
                            if( !empty( $slider_pages ) ) {
                                ?>
                                <div class="os-col slider-col left-col">
                                    <div class="owl-carousel owl-carousel-1">
                                        <?php
                                        foreach( $slider_pages as $slider_index => $slider_page ) {

                                            $slider_item = new WP_Query( array(
                                                'post_type'     => 'page',
                                                'pagename'      => $slider_page,
                                            ) ); 

                                            if( $slider_item->have_posts() ) {

                                                while( $slider_item->have_posts() ) {

                                                    $slider_item->the_post();
                                                    ?>
                                                    <div class="item">
                                                        <figure class="thumb" <?php if( has_post_thumbnail() ) { ?> style="background-image:url( <?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ); ?> );" <?php } ?>>
                                                            <?php
                                                            if( $show_contents == true ) {
                                                                ?>
                                                                <div class="item-entry">
                                                                    <div class="content-holder">
                                                                        <div class="entry-contents">
                                                                            <div class="title">
                                                                                <h2><?php the_title(); ?></h2>
                                                                            </div>
                                                                            <div class="excerpt">
                                                                                <?php the_content(); ?>
                                                                            </div><!-- .excerpt -->
                                                                            <?php
                                                                            if( !empty( $button_titles[$slider_index] ) && !empty( $button_links[$slider_index] ) ) {
                                                                                ?>
                                                                                <div class="permalink">
                                                                                    <a class="button-general" href="<?php echo esc_url( $button_links[$slider_index] ); ?>"><?php echo esc_html( $button_titles[$slider_index] ); ?></a>
                                                                                </div><!-- .permalink -->
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </div><!-- .entry-contents -->
                                                                    </div><!-- .content-holder -->
                                                                </div><!-- .item-entry -->
                                                                <?php
                                                            }
                                                            ?>
                                                        </figure><!-- .thumb -->
                                                    </div>
                                                    <?php
                                                }
                                                wp_reset_postdata();
                                            }
                                        }
                                        ?>
                                    </div><!-- .owl-carousel -->
                                </div><!-- .os-col -->
                                <?php
                            }

                            if( !empty( $banner_img_1 ) || !empty( $banner_img_2 ) ) {
                                ?>
                                <div class="os-col right-col">
                                    <?php
                                    if( !empty( $banner_img_1 ) ) {
                                        ?>
                                        <div class="banner-image-wrapper banner-image-one-wrapper">
                                            <img src="<?php echo esc_url( $banner_img_1 ); ?>">
                                        </div>
                                        <?php
                                    }

                                    if( !empty( $banner_img_2 ) ) {
                                        ?>
                                        <div class="banner-image-wrapper banner-image-two-wrapper">
                                            <img src="<?php echo esc_url( $banner_img_2 ); ?>">
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div><!-- .os-col -->
                                <?php
                            }
                            ?>
                        </div><!-- .os-row -->
                    </div><!-- .__os-container__ -->
                </div><!-- .section-inner -->
            </section><!-- .general-banner -->
            <?php     
        }
     
        public function form( $instance ) {

            $defaults = array(
                'title'			=> '',
                'slider_pages'	=> array(),
                'button_titles'	=> array(),
                'button_links'	=> array(),
                'show_contents'	=> true,
                'banner_img_1' => '',
                'banner_img_2' => '',
            );

            $instance = wp_parse_args( (array) $instance, $defaults );
            $banner_img_1 = $instance['banner_img_1'];
            $banner_img_2 = $instance['banner_img_2'];
    		?>
    		<p>
                <label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>">
                    <strong><?php esc_html_e( 'Title', 'orchid-store' ); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />   
            </p>

            <p>
                <span class="sldr-elmnt-title"><strong><?php esc_html_e( 'Slider Elements', 'orchid-store' ); ?></strong></span>
                <span class="sldr-elmnt-desc"><?php esc_html_e( 'Below are the list of pages. Check on a page to set is as slider item and set button title and button link.', 'orchid-store' ) ?></span>

                <span class="widget_multicheck">
                <?php

                $page_choices = orchid_store_all_pages();

                if( !empty( $page_choices ) ) {

                    $total_pages_count = 0;

                	if( !empty( $instance['slider_pages'] ) ) {

                        $total_pages_count = count( $instance['slider_pages'] );
                    }

                    $loop_count = 0;

                    foreach( $page_choices as $page_key => $page_value ) {

                    	$btn_wrapper_class = 'sldr-elmnt-btn-wrapper';

                    	if( !empty( $instance['slider_pages'] ) ) {
 
	                    	if( in_array( $page_key, $instance['slider_pages'] ) ) {
	                    		$btn_wrapper_class .= ' sldr-elmnt-btn-wrapper-show';
	                    	} else {
	                    		$btn_wrapper_class .= ' sldr-elmnt-btn-wrapper-hide';
	                    	}
	                    } else {
	                    	$btn_wrapper_class .= ' sldr-elmnt-btn-wrapper-hide';
	                    }
	                    ?>
	                    <span class="sldr-elmnt-cntnr">
                            <input class="sldr-elmnt-page" id="<?php echo esc_attr( $this->get_field_id( 'slider_pages' ) . $page_key ); ?>" name="<?php echo esc_attr( $this->get_field_name('slider_pages') ); ?>[]" type="checkbox" value="<?php echo esc_attr( $page_key ); ?>" <?php if( !empty( $instance['slider_pages'] ) ) { if( in_array( $page_key, $instance['slider_pages'] ) ) { ?>checked<?php } } ?>>
	                    	<label for="<?php echo esc_attr( $this->get_field_id( 'slider_pages' ) . $page_key ); ?>">	                    		
	                    		<strong><?php echo esc_html( $page_value ); ?></strong>
	                    	</label>
                            
                            <?php
                            if( in_array( $page_key, $instance['slider_pages'] ) ) {
                                ?>
                                <span class="<?php echo esc_attr( $btn_wrapper_class ); ?>">			                    
                                    <span class="sldr-elmnt-btn-title">
                                        <label for="<?php echo esc_attr( $this->get_field_id( 'button_titles' ) . $page_key ); ?>"><strong><?php esc_html_e( 'Button Title' ); ?></strong></label>
                                        <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_titles' ) . $page_key ); ?>" name="<?php echo esc_attr( $this->get_field_name('button_titles') ); ?>[]" value="<?php if( !empty( $instance['button_titles']) ) { echo esc_attr( $instance['button_titles'][$loop_count] ); } ?>">
                                    </span><!-- .sldr-elmnt-btn-title -->

                                    <span class="sldr-elmnt-btn-link">
                                        <label for="<?php echo esc_attr( $this->get_field_id( 'button_links' ) . $page_key ); ?>"><strong><?php esc_html_e( 'Button Link' ); ?></strong></label>
                                        <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_links' ) . $page_key ); ?>" name="<?php echo esc_attr( $this->get_field_name('button_links') ); ?>[]" value="<?php if( !empty( $instance['button_links'] ) ) { echo esc_attr( $instance['button_links'][$loop_count] ); } ?>">
                                    </span><!-- .sldr-elmnt-btn-link -->

			                    </span><!-- sldr-elmnt-btn-wrapper -->  
                                <?php
                            } else {
                                ?>
                                <span class="<?php echo esc_attr( $btn_wrapper_class ); ?> os-temp-sldr-fields">  
                                    <?php // Hidden fields to store original name attribute values of button title and link. ?>
                                    <input type="hidden" class="original-button-title-name" value="<?php echo esc_attr( $this->get_field_name('button_titles') ); ?>[]">
                                    <input type="hidden" class="original-button-link-name" value="<?php echo esc_attr( $this->get_field_name('button_links') ); ?>[]">
                                    
                                    <span class="sldr-elmnt-btn-title">
                                        <label for="<?php echo esc_attr( $this->get_field_id( 'button_titles' ) . $page_key ); ?>"><strong><?php esc_html_e( 'Button Title' ); ?></strong></label>
                                        <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_titles' ) . $page_key ); ?>" name="temp_button_titles" value="">
                                    </span><!-- .sldr-elmnt-btn-title -->

                                    <span class="sldr-elmnt-btn-link">
                                        <label for="<?php echo esc_attr( $this->get_field_id( 'button_links' ) . $page_key ); ?>"><strong><?php esc_html_e( 'Button Link' ); ?></strong></label>
                                        <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_links' ) . $page_key ); ?>" name="temp_button_links" value="">
                                    </span><!-- .sldr-elmnt-btn-link -->
                                </span><!-- sldr-elmnt-btn-wrapper -->  
                                <?php
                            }
                            ?>                          
		                </span><!-- .sldr-elmnt-cntnr -->
		                <?php
                        if( !empty( $instance['slider_pages'] ) ) {

                            if( in_array( $page_key, $instance['slider_pages'] ) ) {

                                $loop_count++;
                            }
                        }
	                }                    
                } else {
                    ?>
                    <input id="<?php echo esc_attr( $this->get_field_id( 'slider_pages' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name('slider_pages') ); ?>[]" type="hidden" value="" checked>
                    <input id="<?php echo esc_attr( $this->get_field_id( 'button_titles' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name('button_titles') ); ?>[]" type="hidden" value="">
                    <input id="<?php echo esc_attr( $this->get_field_id( 'button_links' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name('button_links') ); ?>[]" type="hidden" value="">
                    <small><?php echo esc_html__( 'No pages to select.', 'orchid-store' ); ?></small>
                    <?php
                }
                ?>
                </span>
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('show_contents') ); ?>">
                	<input id="<?php echo esc_attr( $this->get_field_id('show_contents') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_contents') ); ?>" type="checkbox" value="<?php echo esc_attr( $instance['show_contents'] ); ?>" <?php if( $instance['show_contents'] == true ) { ?>checked<?php } ?> />  
                    <strong><?php esc_html_e( 'Show Slider Contents', 'orchid-store' ); ?></strong>
                </label>                 
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('banner_img_1')); ?>">
                    <strong><?php esc_html_e('Banner Image One', 'orchid-store'); ?></strong>
                </label>

                <span class="os-image-uploader-container">

                    <?php
                    $upload_btn_class = 'button os-upload-btn';
                    $remove_btn_class = 'button os-remove-btn';

                    if( empty( $banner_img_1 ) ) {

                        $remove_btn_class .= ' os-btn-hide';
                        $upload_btn_class .= ' os-btn-show';
                    } else {

                        $remove_btn_class .= ' os-btn-show';
                        $upload_btn_class .= ' os-btn-hide';
                    }
                    ?>
                    
                    <span class="os-upload-image-holder" style="background-image: url( <?php echo esc_url( $banner_img_1 ); ?> );"></span>
                    <input type="hidden" class="widefat os-upload-image-url-holder" name="<?php echo esc_attr($this->get_field_name('banner_img_1')); ?>" id="<?php echo esc_attr($this->get_field_id('banner_img_1')); ?>" value="<?php echo esc_url( $banner_img_1 ); ?>">
                    <button class="<?php echo esc_attr( $upload_btn_class ); ?>" id="os-upload-btn"><?php esc_html_e( 'Upload', 'orchid-store' ); ?></button>
                    <button class="<?php echo esc_attr( $remove_btn_class ); ?>" id="os-remove-btn"><?php esc_html_e( 'Remove', 'orchid-store' ); ?></button>
                </span>
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('banner_img_2')); ?>">
                    <strong><?php esc_html_e('Banner Image Two', 'orchid-store'); ?></strong>
                </label>

                <span class="os-image-uploader-container">

                    <?php
                    $upload_btn_class = 'button os-upload-btn';
                    $remove_btn_class = 'button os-remove-btn';

                    if( empty( $banner_img_2 ) ) {

                        $remove_btn_class .= ' os-btn-hide';
                        $upload_btn_class .= ' os-btn-show';
                    } else {

                        $remove_btn_class .= ' os-btn-show';
                        $upload_btn_class .= ' os-btn-hide';
                    }
                    ?>
                    
                    <span class="os-upload-image-holder" style="background-image: url( <?php echo esc_url( $banner_img_2 ); ?> );"></span>
                    <input type="hidden" class="widefat os-upload-image-url-holder" name="<?php echo esc_attr($this->get_field_name('banner_img_2')); ?>" id="<?php echo esc_attr($this->get_field_id('banner_img_2')); ?>" value="<?php echo esc_url( $banner_img_2 ); ?>">
                    <button class="<?php echo esc_attr( $upload_btn_class ); ?>" id="os-upload-btn"><?php esc_html_e( 'Upload', 'orchid-store' ); ?></button>
                    <button class="<?php echo esc_attr( $remove_btn_class ); ?>" id="os-remove-btn"><?php esc_html_e( 'Remove', 'orchid-store' ); ?></button>
                </span>
            </p>
    		<?php
        }
     
        public function update( $new_instance, $old_instance ) {
     
            $instance = $old_instance;

            $instance['title']  		= sanitize_text_field( $new_instance['title'] );

            $instance['slider_pages'] 	= array_map( 'sanitize_text_field', $new_instance['slider_pages'] );

            $instance['button_titles'] 	= array_map( 'sanitize_text_field', $new_instance['button_titles'] );

            $instance['button_links'] 	= array_map( 'esc_url_raw', $new_instance['button_links'] );

            $instance['show_contents'] 	= wp_validate_boolean( $new_instance['show_contents'] );

            $instance['banner_img_1']   = esc_url_raw( $new_instance['banner_img_1'] );

            $instance['banner_img_2']   = esc_url_raw( $new_instance['banner_img_2'] );

            return $instance;
        } 
    }
}