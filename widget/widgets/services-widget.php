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

            $services_titles    = isset( $instance['services_titles'] ) ? $instance['services_titles'] : array();
            $services_descs     = isset( $instance['services_descs'] ) ? $instance['services_descs'] : array();
            $services_imgs      = isset( $instance['services_imgs'] ) ? $instance['services_imgs'] : array();

            if( !empty( $services_titles ) && !empty( $services_descs ) && !empty( $services_imgs ) ) {
                ?>
                <section class="general-cta cta-style-1 section-spacing">
                    <div class="section-inner">
                        <div class="__os-container__">
                            <div class="cta-entry">
                                <div class="os-row">
                                    <?php
                                    for( $i = 0; $i < 3; $i++ ) {
                                        ?>
                                        <div class="os-col">
                                            <div class="box">
                                                <div class="left-col">
                                                    <?php
                                                    if( !empty( $services_imgs[$i] ) ) {
                                                        ?>
                                                        <img src="<?php echo esc_url( $services_imgs[$i] ); ?>" alt="">
                                                        <?php
                                                    }
                                                    ?>
                                                </div><!-- .left-col -->
                                                <div class="right-col">
                                                    <?php
                                                    if( !empty( $services_titles[$i] ) ) {
                                                        ?>
                                                        <div class="title">
                                                            <h3><?php echo esc_html( $services_titles[$i] ); ?></h3>
                                                        </div><!-- .title -->
                                                        <?php
                                                    }

                                                    if( !empty( $services_descs[$i] ) ) {
                                                        ?>
                                                        <div class="excerpt">
                                                            <p><?php echo esc_html( $services_descs[$i] ); ?></p>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div><!-- .right-col -->
                                            </div><!-- .box -->
                                        </div><!-- .col -->
                                        <?php
                                    }
                                    ?>
                                </div><!-- .row -->
                            </div><!-- .cta-entry -->
                        </div><!-- .__os-container__ -->
                    </div><!-- .section-inner -->
                </section><!-- .section -->
                <?php
            }
        }
     
        public function form( $instance ) {
            $defaults = array(
                'title'             => '',

            );

            $instance = wp_parse_args( (array) $instance, $defaults );

            $services_titles    = !empty( $instance['services_titles'] ) ? $instance['services_titles'] : array();
            $services_descs     = !empty( $instance['services_descs'] ) ? $instance['services_descs'] : array();
            $services_imgs      = !empty( $instance['services_imgs'] ) ? $instance['services_imgs'] : array();
            ?> 

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>">
                    <strong><?php esc_html_e('Title', 'orchid-store'); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />   
            </p>

            <?php
            for( $i = 0; $i < 3; $i++ ) {
                ?>
                <p>
                    <span class="os-fields-wrapper">
                        <span class="os-fields-wrapper-title">
                            <strong>
                                <?php 
                                /* translators: %s : number of service */
                                printf( esc_html__( 'Service %s', 'orchid-store' ), $i + 1 ); 
                                ?>
                            </strong>
                            <span class="os-collapse-icon"><span class="dashicons dashicons-arrow-down"></span></span>
                        </span>
                        <span class="os-fields">
                            <label for="<?php echo esc_attr( $this->get_field_id('services_titles') . $i ); ?>">
                                <strong><?php esc_html_e('Title', 'orchid-store'); ?></strong>
                            </label>
                            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('services_titles') . $i ); ?>" name="<?php echo esc_attr( $this->get_field_name('services_titles') ); ?>[]" type="text" value="<?php if( !empty( $services_titles[$i] ) ) { echo esc_attr( $services_titles[$i] ); } ?>" /> 

                            <label for="<?php echo esc_attr( $this->get_field_id('services_descs') . $i ); ?>">
                                <strong><?php esc_html_e('Description', 'orchid-store'); ?></strong>
                            </label>
                            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('services_descs') . $i ); ?>" name="<?php echo esc_attr( $this->get_field_name('services_descs') ); ?>[]" type="text" value="<?php if( !empty( $services_descs[$i] ) ) { echo esc_attr( $services_descs[$i] ); } ?>" /> 

                            <label for="<?php echo esc_attr($this->get_field_id('services_imgs') . $i ); ?>">
                                <strong><?php esc_html_e('Icon Image', 'orchid-store'); ?></strong>
                            </label>
                            <span class="os-image-notice"><?php esc_html_e( 'Upload image having 1x1 aspect ratio.', 'orchid-store' ); ?></span>

                            <span class="os-image-uploader-container">
                                <?php
                                $upload_btn_class = 'button os-upload-btn';
                                $remove_btn_class = 'button os-remove-btn';

                                if( empty( $services_imgs[$i] ) ) {

                                    $remove_btn_class .= ' os-btn-hide';
                                    $upload_btn_class .= ' os-btn-show';
                                } else {

                                    $remove_btn_class .= ' os-btn-show';
                                    $upload_btn_class .= ' os-btn-hide';
                                }
                                ?>                                
                                <span class="os-upload-image-holder" style="background-image: url( <?php if( !empty( $services_imgs[$i] ) ) { echo esc_url( $services_imgs[$i] ); } ?> );"></span>
                                <input type="hidden" class="widefat os-upload-image-url-holder" name="<?php echo esc_attr($this->get_field_name('services_imgs') ); ?>[]" id="<?php echo esc_attr($this->get_field_id('services_imgs') . $i ); ?>" value="<?php if( !empty( $services_imgs[$i] ) ) { echo esc_attr( $services_imgs[$i] ); } ?>">
                                <button class="<?php echo esc_attr( $upload_btn_class ); ?>" id="os-upload-btn"><?php esc_html_e( 'Upload', 'orchid-store' ); ?></button>
                                <button class="<?php echo esc_attr( $remove_btn_class ); ?>" id="os-remove-btn"><?php esc_html_e( 'Remove', 'orchid-store' ); ?></button>
                            </span>  
                        </span>
                    </span>
                </p>
                <?php
            }
            ?>
            <?php
        }
     
        public function update( $new_instance, $old_instance ) {
     
            $instance = $old_instance;

            $instance['title']              = sanitize_text_field( $new_instance['title'] );

            $instance['services_titles']    = isset( $new_instance['services_titles'] ) ? array_map( 'sanitize_text_field', $new_instance['services_titles'] ) : array();

            $instance['services_descs']     = isset( $new_instance['services_descs'] ) ? array_map( 'sanitize_text_field', $new_instance['services_descs'] ) : array();

            $instance['services_imgs']      = isset( $new_instance['services_imgs'] ) ? array_map( 'esc_url_raw', $new_instance['services_imgs'] ) : array();

            return $instance;
        } 
    }
endif;