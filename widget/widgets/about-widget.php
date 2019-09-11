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


			$store_description 		  = !empty( $instance['store_description'] ) ? $instance['store_description'] : '';
            $store_address 		  = !empty( $instance['store_address'] ) ? $instance['store_address'] : '';
            $store_phone   		  = !empty( $instance['store_phone'] ) ? $instance['store_phone'] : '';
            $store_email   		  = !empty( $instance['store_email'] ) ? $instance['store_email'] : '';
            $store_opening_time   = !empty( $instance['store_opening_time'] ) ? $instance['store_opening_time'] : '';

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
		                    <p><span><i class='bx bx-store-alt'></i></span> <?php echo esc_html( $store_address ); ?></p>
		                </li>
						<?php 

						}

		            	 if( !empty($store_phone)) {
		            	?>
		                <li class="phone">
		                    <p><span><i class='bx bx-headphone'></i></span> <?php echo esc_html( $store_phone ); ?></p>
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
		                <li><a href="#" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
		                <li><a href="#" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
		                <li><a href="#" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
		                <li><a href="#" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
		                <li><a href="#" target="_blank"><i class="fa fa-vk" aria-hidden="true"></i></a></li>
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

            return $instance;
        } 

	}
}