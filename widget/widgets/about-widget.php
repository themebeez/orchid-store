<?php
/**
 * About widget
 *
 * @package Orchid_Store
 */

if( ! class_exists( 'Orchid_Store_About_Widget' ) ) {

	class Orchid_Store_About_Widget extends WP_Widget {

		function __construct() { 

            parent::__construct(

                'orchid-store-about-widget',
                esc_html__( 'OS: About Widget', 'orchid-store' ),
                array(
                    'classname'     => 'os-about-widget',
                    'description'   => esc_html__( 'Displays Store About Information', 'orchid-store' ), 
                )
            );     
        }

        public function widget( $args, $instance ) {

            $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );


			$store_description 	  = !empty( $instance['store_description'] ) ? $instance['store_description'] : '';
            $store_address 		  = !empty( $instance['store_address'] ) ? $instance['store_address'] : '';
            $store_phone   		  = !empty( $instance['store_phone'] ) ? $instance['store_phone'] : '';
            $store_email   		  = !empty( $instance['store_email'] ) ? $instance['store_email'] : '';
            $store_opening_time   = !empty( $instance['store_opening_time'] ) ? $instance['store_opening_time'] : '';
            $facebook_url         = !empty( $instance['facebook_url'] ) ? $instance['facebook_url'] : '';
            $twitter_url          = !empty( $instance['twitter_url'] ) ? $instance['twitter_url'] : '';
            $instagram_url        = !empty( $instance['instagram_url'] ) ? $instance['instagram_url'] : '';
            $youtube_url          = !empty( $instance['youtube_url'] ) ? $instance['youtube_url'] : '';
            $pinterest_url        = !empty( $instance['pinterest_url'] ) ? $instance['pinterest_url'] : '';
            $vimeo_url            = !empty( $instance['vimeo_url'] ) ? $instance['vimeo_url'] : '';
            $vk_url               = !empty( $instance['vk_url'] ) ? $instance['vk_url'] : '';

            echo $args['before_widget'];

            echo $args['before_title'];

            echo esc_html( $title );

            echo $args['after_title'];
            ?>

		       <div class="widget-entry">
		        <div class="info">
		            <div class="site-branding">
		                <div class="logo">
		                    <a href="#"><img src="https://demo.themebeez.com/demos-2/orchid-store/wp-content/uploads/sites/9/2019/09/orchid-store-free-version-logo-1.png" alt="logo"></a>
		                </div><!-- // logo -->

		                <?php 

		                if( !empty( $store_description ) ) {
		                	?>
			                <div class="intro">
			                    <p><?php echo esc_html( $store_description ); ?></p>
			                </div><!-- // intro -->
		            	<?php 
			        	}
			        	?>
		            </div><!-- // site-branding -->
		            <ul class="contact-info">
		            	<?php 
		            	 if( !empty($store_address)) {
		            	?>
		                <li class="location">
		                    <p><span><i class='bx bx-map-pin'></i></span> <?php echo esc_html( $store_address ); ?></p>
		                </li>
						<?php 

						}

		            	 if( !empty($store_phone)) {
		            	?>
		                <li class="phone">
		                    <p><span><i class='bx bx-phone'></i></span> <?php echo esc_html( $store_phone ); ?></p>
		                </li>
		                <?php 
		                }
		                

		                if( !empty($store_email)) {
		            	?>
		                <li class="email">
		                    <p><span><i class='bx bx-paper-plane'></i></span> <?php echo esc_html( $store_email ); ?></p>
		                </li>
						<?php 
		                }

		                if( !empty($store_opening_time)) {
		            	?>
		                <li class="opening-time">
		                    <p><span><i class='bx bx-time'></i></span> <?php echo esc_html( $store_opening_time ); ?></p>
		                </li>

		                <?php 

		            	}

		            	?>
		            </ul>
		        </div><!-- // info -->
		        <div class="social-icons">
		            <ul class="social-icons-list">
                        
                        <?php 

                        if( !empty($facebook_url)) {

                        ?>
		                <li><a href="<?php echo esc_url( $facebook_url ); ?>" target="_blank"><i class='bx bxl-facebook'></i></a></li>

                        <?php 

                        }

                        if( !empty($twitter_url)) {

                        ?>

		                <li><a href="<?php echo esc_url( $twitter_url ); ?>" target="_blank"><i class='bx bxl-twitter'></i></a></li>

                        <?php 

                        }

                        if( !empty($instagram_url)) {

                        ?>

		                <li><a href="<?php echo esc_url( $instagram_url ); ?>" target="_blank"><i class='bx bxl-instagram'></i></a></li>
                        
                        <?php 

                        }

                        if( !empty($youtube_url)) {

                        ?>

		                <li><a href="<?php echo esc_url( $youtube_url ); ?>" target="_blank"><i class='bx bxl-youtube'></i></a></li>

                        <?php 

                        }

                        if( !empty($pinterest_url)) {

                        ?>

		                <li><a href="<?php echo esc_url( $pinterest_url ); ?>" target="_blank"><i class='bx bxl-pinterest'></i></a></li>

                        <?php 

                        }

                        if( !empty($vimeo_url)) {

                        ?>

                        <li><a href="<?php echo esc_url( $vimeo_url ); ?>" target="_blank"><i class='bx bxl-vimeo'></i></a></li>

                        <?php 

                        }

                        if( !empty($vk_url)) {

                        ?>

                        <li><a href="<?php echo esc_url( $vk_url ); ?>" target="_blank"><i class='bx bxl-vk'></i></a></li>

                        <?php 

                        }

                        ?>
		            </ul>
		        </div><!-- // social-icons -->
		    </div><!-- // widget-entry -->
        <?php 
        	echo $args['after_widget'];
    	}

    	public function form( $instance ) {
            $defaults = array(

                'title'       => '',
                'store_description' => '',
                'store_address'	=> '',
                'store_phone'  => '',
                'store_email'  => '',
                'store_opening_time'  => '',
                'facebook_url'  => '',
                'twitter_url'  => '',
                'instagram_url'  => '',
                'youtube_url'  => '',
                'pinterest_url'  => '',
                'vimeo_url'  => '',
                'vk_url'  => '',
            );

            $instance = wp_parse_args( (array) $instance, $defaults );
    		?>

    		<p>
                <label for="<?php echo esc_attr( $this->get_field_name('title') ); ?>">
                    <strong><?php esc_html_e( 'Title', 'orchid-store' ); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />   
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_name('store_description') ); ?>">
                    <strong><?php esc_html_e( 'Store description', 'orchid-store' ); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('store_description') ); ?>" name="<?php echo esc_attr( $this->get_field_name('store_description') ); ?>" type="text" value="<?php echo esc_attr( $instance['store_description'] ); ?>" />   
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_name('store_address') ); ?>">
                    <strong><?php esc_html_e( 'Store address', 'orchid-store' ); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('store_address') ); ?>" name="<?php echo esc_attr( $this->get_field_name('store_address') ); ?>" type="text" value="<?php echo esc_attr( $instance['store_address'] ); ?>" />   
            </p>

             <p>
                <label for="<?php echo esc_attr( $this->get_field_name('store_phone') ); ?>">
                    <strong><?php esc_html_e( 'Store phone', 'orchid-store' ); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('store_phone') ); ?>" name="<?php echo esc_attr( $this->get_field_name('store_phone') ); ?>" type="text" value="<?php echo esc_attr( $instance['store_phone'] ); ?>" />   
            </p>

			<p>
                <label for="<?php echo esc_attr( $this->get_field_name('store_email') ); ?>">
                    <strong><?php esc_html_e( 'Store email', 'orchid-store' ); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('store_email') ); ?>" name="<?php echo esc_attr( $this->get_field_name('store_email') ); ?>" type="text" value="<?php echo esc_attr( $instance['store_email'] ); ?>" />   
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_name('store_opening_time') ); ?>">
                    <strong><?php esc_html_e( 'Store opening time', 'orchid-store' ); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('store_opening_time') ); ?>" name="<?php echo esc_attr( $this->get_field_name('store_opening_time') ); ?>" type="text" value="<?php echo esc_attr( $instance['store_opening_time'] ); ?>" />   
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_name('facebook_url') ); ?>">
                    <strong><?php esc_html_e( 'Social: Facebook Link', 'orchid-store' ); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('facebook_url') ); ?>" name="<?php echo esc_attr( $this->get_field_name('facebook_url') ); ?>" type="text" value="<?php echo esc_attr( $instance['facebook_url'] ); ?>" />   
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_name('twitter_url') ); ?>">
                    <strong><?php esc_html_e( 'Social: Twitter Link', 'orchid-store' ); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('twitter_url') ); ?>" name="<?php echo esc_attr( $this->get_field_name('twitter_url') ); ?>" type="text" value="<?php echo esc_attr( $instance['twitter_url'] ); ?>" />   
            </p>  

            <p>
                <label for="<?php echo esc_attr( $this->get_field_name('instagram_url') ); ?>">
                    <strong><?php esc_html_e( 'Social: Instagram Link', 'orchid-store' ); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('instagram_url') ); ?>" name="<?php echo esc_attr( $this->get_field_name('instagram_url') ); ?>" type="text" value="<?php echo esc_attr( $instance['instagram_url'] ); ?>" />   
            </p> 

            <p>
                <label for="<?php echo esc_attr( $this->get_field_name('pinterest_url') ); ?>">
                    <strong><?php esc_html_e( 'Social: Pinterest Link', 'orchid-store' ); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('pinterest_url') ); ?>" name="<?php echo esc_attr( $this->get_field_name('pinterest_url') ); ?>" type="text" value="<?php echo esc_attr( $instance['pinterest_url'] ); ?>" />   
            </p>   

            <p>
                <label for="<?php echo esc_attr( $this->get_field_name('youtube_url') ); ?>">
                    <strong><?php esc_html_e( 'Social: YouTube Link', 'orchid-store' ); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('youtube_url') ); ?>" name="<?php echo esc_attr( $this->get_field_name('youtube_url') ); ?>" type="text" value="<?php echo esc_attr( $instance['youtube_url'] ); ?>" />   
            </p>  

            <p>
                <label for="<?php echo esc_attr( $this->get_field_name('vimeo_url') ); ?>">
                    <strong><?php esc_html_e( 'Social: Vimeo Link', 'orchid-store' ); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('vimeo_url') ); ?>" name="<?php echo esc_attr( $this->get_field_name('vimeo_url') ); ?>" type="text" value="<?php echo esc_attr( $instance['vimeo_url'] ); ?>" />   
            </p>  

            <p>
                <label for="<?php echo esc_attr( $this->get_field_name('vk_url') ); ?>">
                    <strong><?php esc_html_e( 'Social: VK Link', 'orchid-store' ); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('vk_url') ); ?>" name="<?php echo esc_attr( $this->get_field_name('vk_url') ); ?>" type="text" value="<?php echo esc_attr( $instance['vk_url'] ); ?>" />   
            </p>                   
      
    		<?php
        }
     
        public function update( $new_instance, $old_instance ) {
     
            $instance = $old_instance;

            $instance['title'] 					= sanitize_text_field( $new_instance['title'] );

            $instance['store_description'] 		= sanitize_text_field( $new_instance['store_description'] );

            $instance['store_address'] 			= sanitize_text_field( $new_instance['store_address'] );

            $instance['store_phone'] 			= sanitize_text_field( $new_instance['store_phone'] );

            $instance['store_email'] 			= sanitize_text_field( $new_instance['store_email'] );

            $instance['store_opening_time'] 	= sanitize_text_field( $new_instance['store_opening_time'] );

            $instance['facebook_url']           = sanitize_text_field( $new_instance['facebook_url'] );

            $instance['twitter_url']            = sanitize_text_field( $new_instance['twitter_url'] );

            $instance['instagram_url']          = sanitize_text_field( $new_instance['instagram_url'] );

            $instance['youtube_url']            = sanitize_text_field( $new_instance['youtube_url'] );

            $instance['pinterest_url']          = sanitize_text_field( $new_instance['pinterest_url'] );

            $instance['vimeo_url']              = sanitize_text_field( $new_instance['vimeo_url'] );

            $instance['vk_url']                 = sanitize_text_field( $new_instance['vk_url'] );

            return $instance;
        } 

	}
}