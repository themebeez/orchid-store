<?php
/**
 * Advertisement Widget Class
 *
 * @package Orchid_Store
 */

if( ! class_exists( 'Orchid_Store_Advertisement_Widget' ) ) :

    class Orchid_Store_Advertisement_Widget extends WP_Widget {
 
        function __construct() { 

            parent::__construct(
                'orchid-store-advertisement-widget',
                esc_html__( 'OS: Offer Advertisement', 'orchid-store' ),
                array(
                    'classname' => '',
                    'description' => esc_html__( 'Displays offer advertisement.', 'orchid-store' ), 
                )
            );
     
        }
     
        public function widget( $args, $instance ) {

            $title              = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
            $offer_title        = isset( $instance['offer_title'] ) ? $instance['offer_title'] : '';
            $offer_text         = isset( $instance['offer_text'] ) ? $instance['offer_text'] : '';
            $button_title       = isset( $instance['button_title'] ) ? $instance['button_title'] : '';
            $button_link        = isset( $instance['button_link'] ) ? $instance['button_link'] : '';
            $content_alignment  = isset( $instance['content_alignment'] ) ? $instance['content_alignment'] : '';
            $offer_image        = isset( $instance['offer_image'] ) ? $instance['offer_image'] : '';
            $img_as_bg          = isset( $instance['set_image_in_background'] ) ? $instance['set_image_in_background'] : true;
            $show_contents      = isset( $instance['show_offer_contents'] ) ? $instance['show_offer_contents'] : true;

            $box_holder_class = 'box-holder';

            switch ( $content_alignment ) {

                case 'left':

                    $box_holder_class .= ' box-holder-left-align';
                    break;

                case 'right' :

                    $box_holder_class .= ' box-holder-right-align';
                    break;

                default:
                    
                    $box_holder_class .= ' box-holder-center-align';
                    break;
            }

            if( !empty( $offer_image ) && $img_as_bg == true ) {
                ?>
                <section class="general-cta cta-style-2 section-spacing" style="background-image: url( <?php echo esc_url( $offer_image ); ?> );">
                <?php
            } else {
                ?>
                <section class="general-cta cta-style-2 section-spacing">
                <?php
            }
            ?>
                <div class="section-inner">
                    <?php
                    if( !empty( $offer_image ) && $img_as_bg != true ) {
                        ?>
                        <img src="<?php echo esc_url( $offer_image ); ?>">
                        <?php
                    }
                    ?>
                    <div class="__os-container__">
                        <div class="cta-entry">
                            <div class="<?php echo esc_attr( $box_holder_class ); ?>">
                                <?php
                                if( $show_contents == true ) {
                                    ?>
                                    <div class="promo-box">
                                        <?php
                                        if( !empty( $offer_title ) ) {
                                            ?>
                                            <div class="title">
                                                <h3><?php echo esc_html( $offer_title ); ?></h3>
                                            </div><!-- .title -->
                                            <?php
                                        }

                                        if( !empty( $offer_text ) ) {
                                            ?>
                                            <div class="sub-title">
                                                <h4><?php echo esc_html( $offer_text ); ?></h4>
                                            </div><!-- .sub-title -->
                                            <?php
                                        }

                                        if( !empty( $button_title ) && !empty( $button_link ) ) {
                                            ?>
                                            <div class="permalink">
                                                <a class="button-general" href="<?php echo esc_url( $button_link ); ?>"><?php echo esc_html( $button_title ); ?></a>
                                            </div><!-- .permalink -->
                                            <?php
                                        }
                                        ?>
                                    </div><!-- .promo-box -->
                                    <?php
                                }
                                ?>
                            </div><!-- .box-holder -->
                        </div><!-- .cta-entry -->
                    </div><!-- .__os-container__ -->
                </div><!-- .section-inner -->
            </section><!-- .section -->
            <?php
        }
     
        public function form( $instance ) {

            $defaults = array(
                'title'                     => '',
                'show_offer_contents'       => true,
                'offer_title'               => '',
                'offer_text'                => '',
                'button_title'              => '',
                'button_link'               => '',
                'content_alignment'         => 'left',
                'offer_image'               => '',
                'set_image_in_background'   => true,

            );

            $instance = wp_parse_args( (array) $instance, $defaults );

            $offer_image = $instance['offer_image'];
            ?> 

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>">
                    <strong><?php esc_html_e('Title', 'orchid-store'); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />   
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('show_offer_contents') ); ?>">
                    <input class="show-offer-contents" type="checkbox" id="<?php echo esc_attr( $this->get_field_id('show_offer_contents') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_offer_contents') ); ?>" <?php checked( absint( $instance['show_offer_contents'] ), 1 ); ?> >                
                    <strong><?php esc_html_e('Display Offer Contents', 'orchid-store'); ?></strong>
                </label>

                <?php
                $wrapper_class = 'os-elements-container-wrapper';
                if( $instance['show_offer_contents'] == true ) {
                    $wrapper_class .= ' show-wrapper';
                } else {
                    $wrapper_class .= ' hide-wrapper';
                }
                ?>
                <span class="<?php echo esc_attr( $wrapper_class ); ?>">
                    <label for="<?php echo esc_attr( $this->get_field_id('offer_title') ); ?>">
                        <strong><?php esc_html_e('Offer Title', 'orchid-store'); ?></strong>
                    </label>
                    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('offer_title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('offer_title') ); ?>" type="text" value="<?php echo esc_attr( $instance['offer_title'] ); ?>" /> 

                    <label for="<?php echo esc_attr( $this->get_field_id('offer_text') ); ?>">
                        <strong><?php esc_html_e('Offer Text', 'orchid-store'); ?></strong>
                    </label>
                    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('offer_text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('offer_text') ); ?>" type="text" value="<?php echo esc_attr( $instance['offer_text'] ); ?>" /> 

                    <label for="<?php echo esc_attr( $this->get_field_id('button_title') ); ?>">
                        <strong><?php esc_html_e('Button Title', 'orchid-store'); ?></strong>
                    </label>
                    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('button_title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('button_title') ); ?>" type="text" value="<?php echo esc_attr( $instance['button_title'] ); ?>" />  

                    <label for="<?php echo esc_attr( $this->get_field_id('button_link') ); ?>">
                        <strong><?php esc_html_e('Button Link', 'orchid-store'); ?></strong>
                    </label>
                    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('button_link') ); ?>" name="<?php echo esc_attr( $this->get_field_name('button_link') ); ?>" type="url" value="<?php echo esc_attr( $instance['button_link'] ); ?>" />   

                    <label for="<?php echo esc_attr( $this->get_field_id('content_alignment') ); ?>">
                        <strong><?php esc_html_e('Content Alignment', 'orchid-store'); ?></strong>
                    </label>  
                    <?php
                    $alignments = array(
                        'left' => esc_html__( 'Left', 'orchid-store' ),
                        'center' => esc_html__( 'Center', 'orchid-store' ),
                        'right' => esc_html__( 'Right', 'orchid-store' ),
                    );
                    ?>
                    <select class="widefat" name="<?php echo esc_attr( $this->get_field_name('content_alignment') ); ?>" id="<?php echo esc_attr( $this->get_field_id('content_alignment') ); ?>">
                        <?php
                        foreach( $alignments as $key_value => $alignment ) {
                            ?>
                            <option value="<?php echo esc_attr( $key_value ); ?>" <?php selected( $key_value, $instance['content_alignment'] ); ?>><?php echo esc_html( $alignment ); ?></option>
                            <?php
                        }
                        ?>
                    </select> 
                </span>
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('offer_image')); ?>">
                    <strong><?php esc_html_e('Offer Image', 'orchid-store'); ?></strong>
                </label>

                <span class="os-image-uploader-container">

                    <?php
                    $upload_btn_class = 'button os-upload-btn';
                    $remove_btn_class = 'button os-remove-btn';

                    if( empty( $offer_image ) ) {

                        $remove_btn_class .= ' os-btn-hide';
                        $upload_btn_class .= ' os-btn-show';
                    } else {

                        $remove_btn_class .= ' os-btn-show';
                        $upload_btn_class .= ' os-btn-hide';
                    }
                    ?>
                    
                    <span class="os-upload-image-holder" style="background-image: url( <?php echo esc_url( $offer_image ); ?> );"></span>
                    <input type="hidden" class="widefat os-upload-image-url-holder" name="<?php echo esc_attr($this->get_field_name('offer_image')); ?>" id="<?php echo esc_attr($this->get_field_id('offer_image')); ?>" value="<?php echo esc_url( $offer_image ); ?>">
                    <button class="<?php echo esc_attr( $upload_btn_class ); ?>" id="os-upload-btn"><?php esc_html_e( 'Upload', 'orchid-store' ); ?></button>
                    <button class="<?php echo esc_attr( $remove_btn_class ); ?>" id="os-remove-btn"><?php esc_html_e( 'Remove', 'orchid-store' ); ?></button>
                </span>
            </p>     

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('set_image_in_background') ); ?>">
                    <input type="checkbox" id="<?php echo esc_attr( $this->get_field_id('set_image_in_background') ); ?>" name="<?php echo esc_attr( $this->get_field_name('set_image_in_background') ); ?>" <?php checked( absint( $instance['set_image_in_background'] ), 1 ); ?> >                
                    <strong><?php esc_html_e('Set Image In Background', 'orchid-store'); ?></strong>
                </label>
            </p> 
            <?php
        }
     
        public function update( $new_instance, $old_instance ) {
     
            $instance = $old_instance;

            $instance['title']                      = sanitize_text_field( $new_instance['title'] );

            $instance['show_offer_contents']        = isset( $new_instance['show_offer_contents'] ) ? wp_validate_boolean( $new_instance['show_offer_contents'] ) : false;

            $instance['offer_title']                = sanitize_text_field( $new_instance['offer_title'] );

            $instance['offer_text']                 = sanitize_text_field( $new_instance['offer_text'] );

            $instance['button_title']               = sanitize_text_field( $new_instance['button_title'] );

            $instance['button_link']                = esc_url_raw( $new_instance['button_link'] );

            $instance['content_alignment']          = sanitize_text_field( $new_instance['content_alignment'] );

            $instance['offer_image']                = esc_url_raw( $new_instance['offer_image'] );

            $instance['set_image_in_background']    = isset( $new_instance['set_image_in_background'] ) ? wp_validate_boolean( $new_instance['set_image_in_background'] ) : false;

            return $instance;
        } 
    }
endif;