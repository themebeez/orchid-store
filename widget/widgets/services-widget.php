<?php
/**
 * Services Widget Class
 *
 * @package Orchid_Store
 */

if( ! class_exists( 'Orchid_Store_Services_Widget' ) ) :

    class Orchid_Store_Services_Widget extends WP_Widget {
 
        function __construct() { 

            parent::__construct(
                'orchid-store-services-widget',
                esc_html__( 'OS: Services', 'orchid-store' ),
                array(
                    'description' => esc_html__( 'Displays services.', 'orchid-store' ), 
                )
            );
     
        }
     
        public function widget( $args, $instance ) {

            $title              = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
            $service_1_title    = !empty( $instance['service_1_title'] ) ? $instance['service_1_title'] : '';
            $service_1_desc     = !empty( $instance['service_1_desc'] ) ? $instance['service_1_desc'] : '';
            $service_1_img      = !empty( $instance['service_1_img'] ) ? $instance['service_1_img'] : '';
            $service_2_title    = !empty( $instance['service_2_title'] ) ? $instance['service_2_title'] : '';
            $service_2_desc     = !empty( $instance['service_2_desc'] ) ? $instance['service_2_desc'] : '';
            $service_2_img      = !empty( $instance['service_2_img'] ) ? $instance['service_2_img'] : '';
            $service_3_title    = !empty( $instance['service_3_title'] ) ? $instance['service_3_title'] : '';
            $service_3_desc     = !empty( $instance['service_3_desc'] ) ? $instance['service_3_desc'] : '';
            $service_3_img      = !empty( $instance['service_3_img'] ) ? $instance['service_3_img'] : '';
            ?>
            <section class="general-cta cta-style-1 section-spacing">
                <div class="section-inner">
                    <div class="__os-container__">
                        <div class="cta-entry">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                    <div class="box">
                                        <div class="left-col">
                                            <?php
                                            if( !empty( $service_1_img ) ) {
                                                ?>
                                                <img src="<?php echo esc_url( $service_1_img ); ?>" alt="">
                                                <?php
                                            }
                                            ?>
                                        </div><!-- .left-col -->
                                        <div class="right-col">
                                            <?php
                                            if( !empty( $service_1_title ) ) {
                                                ?>
                                                <div class="title">
                                                    <h3><?php echo esc_html( $service_1_title ); ?></h3>
                                                </div><!-- .title -->
                                                <?php
                                            }

                                            if( !empty( $service_1_desc ) ) {
                                                ?>
                                                <div class="excerpt">
                                                    <p><?php echo esc_html( $service_1_desc ); ?></p>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div><!-- .right-col -->
                                    </div><!-- .box -->
                                </div><!-- .col -->
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                    <div class="box">
                                        <div class="left-col">
                                            <?php
                                            if( !empty( $service_2_img ) ) {
                                                ?>
                                                <img src="<?php echo esc_url( $service_2_img ); ?>" alt="">
                                                <?php
                                            }
                                            ?>
                                        </div><!-- .left-col -->
                                        <div class="right-col">
                                            <?php
                                            if( !empty( $service_2_title ) ) {
                                                ?>
                                                <div class="title">
                                                    <h3><?php echo esc_html( $service_2_title ); ?></h3>
                                                </div><!-- .title -->
                                                <?php
                                            }

                                            if( !empty( $service_2_desc ) ) {
                                                ?>
                                                <div class="excerpt">
                                                    <p><?php echo esc_html( $service_2_desc ); ?></p>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div><!-- .right-col -->
                                    </div><!-- .box -->
                                </div><!-- .col -->
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                    <div class="box">
                                        <div class="left-col">
                                            <?php
                                            if( !empty( $service_3_img ) ) {
                                                ?>
                                                <img src="<?php echo esc_url( $service_3_img ); ?>" alt="">
                                                <?php
                                            }
                                            ?>
                                        </div><!-- .left-col -->
                                        <div class="right-col">
                                            <?php
                                            if( !empty( $service_3_title ) ) {
                                                ?>
                                                <div class="title">
                                                    <h3><?php echo esc_html( $service_3_title ); ?></h3>
                                                </div><!-- .title -->
                                                <?php
                                            }

                                            if( !empty( $service_3_desc ) ) {
                                                ?>
                                                <div class="excerpt">
                                                    <p><?php echo esc_html( $service_3_desc ); ?></p>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div><!-- .right-col -->
                                    </div><!-- .box -->
                                </div><!-- .col -->
                            </div><!-- .row -->
                        </div><!-- .cta-entry -->
                    </div><!-- .__os-container__ -->
                </div><!-- .section-inner -->
            </section><!-- .section -->
            <?php
        }
     
        public function form( $instance ) {
            $defaults = array(
                'title'             => '',
                'service_1_title'   => '',
                'service_1_desc'    => '',
                'service_1_img'     => '',
                'service_2_title'   => '',
                'service_2_desc'    => '',
                'service_2_img'     => '',
                'service_3_title'   => '',
                'service_3_desc'    => '',
                'service_3_img'     => '',

            );

            $instance = wp_parse_args( (array) $instance, $defaults );

            $service_1_img = $instance['service_1_img'];
            $service_2_img = $instance['service_2_img'];
            $service_3_img = $instance['service_3_img'];
            ?> 

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>">
                    <strong><?php esc_html_e('Title', 'orchid-store'); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />   
            </p>

            <p>
                <span class="os-fields-wrapper">
                    <span class="os-fields-wrapper-title"><strong><?php esc_html_e( 'Service 1', 'orchid-store' ); ?></strong></span>
                    <span class="os-fields">
                        <label for="<?php echo esc_attr( $this->get_field_id('service_1_title') ); ?>">
                            <strong><?php esc_html_e('Service Title', 'orchid-store'); ?></strong>
                        </label>
                        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('service_1_title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('service_1_title') ); ?>" type="text" value="<?php echo esc_attr( $instance['service_1_title'] ); ?>" /> 

                        <label for="<?php echo esc_attr( $this->get_field_id('service_1_desc') ); ?>">
                            <strong><?php esc_html_e('Service Description', 'orchid-store'); ?></strong>
                        </label>
                        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('service_1_desc') ); ?>" name="<?php echo esc_attr( $this->get_field_name('service_1_desc') ); ?>" type="text" value="<?php echo esc_attr( $instance['service_1_desc'] ); ?>" /> 

                        <label for="<?php echo esc_attr($this->get_field_id('service_1_img')); ?>">
                            <strong><?php esc_html_e('Service Image', 'orchid-store'); ?></strong>
                        </label>
                        <span class="os-image-notice"><?php esc_html_e( 'Upload image having 1x1 aspect ratio.', 'orchid-store' ); ?></span>

                        <span class="os-image-uploader-container">

                            <?php
                            $upload_btn_class = 'button os-upload-btn';
                            $remove_btn_class = 'button os-remove-btn';

                            if( empty( $service_1_img ) ) {

                                $remove_btn_class .= ' os-btn-hide';
                                $upload_btn_class .= ' os-btn-show';
                            } else {

                                $remove_btn_class .= ' os-btn-show';
                                $upload_btn_class .= ' os-btn-hide';
                            }
                            ?>
                            
                            <span class="os-upload-image-holder" style="background-image: url( <?php echo esc_url( $service_1_img ); ?> );"></span>
                            <input type="hidden" class="widefat os-upload-image-url-holder" name="<?php echo esc_attr($this->get_field_name('service_1_img')); ?>" id="<?php echo esc_attr($this->get_field_id('service_1_img')); ?>" value="<?php echo esc_url( $service_1_img ); ?>">
                            <button class="<?php echo esc_attr( $upload_btn_class ); ?>" id="os-upload-btn"><?php esc_html_e( 'Upload', 'orchid-store' ); ?></button>
                            <button class="<?php echo esc_attr( $remove_btn_class ); ?>" id="os-remove-btn"><?php esc_html_e( 'Remove', 'orchid-store' ); ?></button>
                        </span>  
                    </span>
                </span>
            </p>

            <p>
                <span class="os-fields-wrapper">
                    <span class="os-fields-wrapper-title"><strong><?php esc_html_e( 'Service 2', 'orchid-store' ); ?></strong></span>
                    <span class="os-fields">
                        <label for="<?php echo esc_attr( $this->get_field_id('service_2_title') ); ?>">
                            <strong><?php esc_html_e('Service Title', 'orchid-store'); ?></strong>
                        </label>
                        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('service_2_title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('service_2_title') ); ?>" type="text" value="<?php echo esc_attr( $instance['service_2_title'] ); ?>" /> 

                        <label for="<?php echo esc_attr( $this->get_field_id('service_2_desc') ); ?>">
                            <strong><?php esc_html_e('Service Description', 'orchid-store'); ?></strong>
                        </label>
                        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('service_2_desc') ); ?>" name="<?php echo esc_attr( $this->get_field_name('service_2_desc') ); ?>" type="text" value="<?php echo esc_attr( $instance['service_2_desc'] ); ?>" /> 

                        <label for="<?php echo esc_attr($this->get_field_id('service_2_img')); ?>">
                            <strong><?php esc_html_e('Service Image', 'orchid-store'); ?></strong>
                        </label>
                        <span class="os-image-notice"><?php esc_html_e( 'Upload image having 1x1 aspect ratio.', 'orchid-store' ); ?></span>
                        <span class="os-image-uploader-container">

                            <?php
                            $upload_btn_class = 'button os-upload-btn';
                            $remove_btn_class = 'button os-remove-btn';

                            if( empty( $service_2_img ) ) {

                                $remove_btn_class .= ' os-btn-hide';
                                $upload_btn_class .= ' os-btn-show';
                            } else {

                                $remove_btn_class .= ' os-btn-show';
                                $upload_btn_class .= ' os-btn-hide';
                            }
                            ?>
                            
                            <span class="os-upload-image-holder" style="background-image: url( <?php echo esc_url( $service_2_img ); ?> );"></span>
                            <input type="hidden" class="widefat os-upload-image-url-holder" name="<?php echo esc_attr($this->get_field_name('service_2_img')); ?>" id="<?php echo esc_attr($this->get_field_id('service_2_img')); ?>" value="<?php echo esc_url( $service_2_img ); ?>">
                            <button class="<?php echo esc_attr( $upload_btn_class ); ?>" id="os-upload-btn"><?php esc_html_e( 'Upload', 'orchid-store' ); ?></button>
                            <button class="<?php echo esc_attr( $remove_btn_class ); ?>" id="os-remove-btn"><?php esc_html_e( 'Remove', 'orchid-store' ); ?></button>
                        </span>  
                    </span>
                </span>
            </p>

            <p>
                <span class="os-fields-wrapper">
                    <span class="os-fields-wrapper-title"><strong><?php esc_html_e( 'Service 3', 'orchid-store' ); ?></strong></span>
                    <span class="os-fields">
                        <label for="<?php echo esc_attr( $this->get_field_id('service_3_title') ); ?>">
                            <strong><?php esc_html_e('Service Title', 'orchid-store'); ?></strong>
                        </label>
                        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('service_3_title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('service_3_title') ); ?>" type="text" value="<?php echo esc_attr( $instance['service_3_title'] ); ?>" /> 

                        <label for="<?php echo esc_attr( $this->get_field_id('service_3_desc') ); ?>">
                            <strong><?php esc_html_e('Service Description', 'orchid-store'); ?></strong>
                        </label>
                        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('service_3_desc') ); ?>" name="<?php echo esc_attr( $this->get_field_name('service_3_desc') ); ?>" type="text" value="<?php echo esc_attr( $instance['service_3_desc'] ); ?>" /> 

                        <label for="<?php echo esc_attr($this->get_field_id('service_3_img')); ?>">
                            <strong><?php esc_html_e('Service Image', 'orchid-store'); ?></strong>
                        </label>
                        <span class="os-image-notice"><?php esc_html_e( 'Upload image having 1x1 aspect ratio.', 'orchid-store' ); ?></span>
                        <span class="os-image-uploader-container">

                            <?php
                            $upload_btn_class = 'button os-upload-btn';
                            $remove_btn_class = 'button os-remove-btn';

                            if( empty( $service_3_img ) ) {

                                $remove_btn_class .= ' os-btn-hide';
                                $upload_btn_class .= ' os-btn-show';
                            } else {

                                $remove_btn_class .= ' os-btn-show';
                                $upload_btn_class .= ' os-btn-hide';
                            }
                            ?>
                            
                            <span class="os-upload-image-holder" style="background-image: url( <?php echo esc_url( $service_3_img ); ?> );"></span>
                            <input type="hidden" class="widefat os-upload-image-url-holder" name="<?php echo esc_attr($this->get_field_name('service_3_img')); ?>" id="<?php echo esc_attr($this->get_field_id('service_3_img')); ?>" value="<?php echo esc_url( $service_3_img ); ?>">
                            <button class="<?php echo esc_attr( $upload_btn_class ); ?>" id="os-upload-btn"><?php esc_html_e( 'Upload', 'orchid-store' ); ?></button>
                            <button class="<?php echo esc_attr( $remove_btn_class ); ?>" id="os-remove-btn"><?php esc_html_e( 'Remove', 'orchid-store' ); ?></button>
                        </span>  
                    </span>
                </span>
            </p>    
            <?php
        }
     
        public function update( $new_instance, $old_instance ) {
     
            $instance = $old_instance;

            $instance['title']              = sanitize_text_field( $new_instance['title'] );

            $instance['service_1_title']    = sanitize_text_field( $new_instance['service_1_title'] );

            $instance['service_1_desc']     = sanitize_text_field( $new_instance['service_1_desc'] );

            $instance['service_1_img']      = esc_url_raw( $new_instance['service_1_img'] );

            $instance['service_2_title']    = sanitize_text_field( $new_instance['service_2_title'] );

            $instance['service_2_desc']     = sanitize_text_field( $new_instance['service_2_desc'] );

            $instance['service_2_img']      = esc_url_raw( $new_instance['service_2_img'] );

            $instance['service_3_title']    = sanitize_text_field( $new_instance['service_3_title'] );

            $instance['service_3_desc']     = sanitize_text_field( $new_instance['service_3_desc'] );

            $instance['service_3_img']      = esc_url_raw( $new_instance['service_3_img'] );

            return $instance;
        } 
    }
endif;