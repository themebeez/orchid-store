<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Orchid_Store
 */

?>
    </div><!-- #content.site-title -->

	<footer class="footer secondary-widget-area">
        <div class="footer-inner">
            <div class="footer-mask">
                <div class="__os-container__">
                    <div class="footer-entry">
                    	<?php 
                        if( orchid_store_get_option( 'display_footer_widget_area' ) == true ) {

                            $orchid_store_footer_widget_area_no = orchid_store_get_option( 'footer_widgets_area_columns' ); 
                            ?>
                            <div class="footer-top columns-<?php echo esc_attr( $orchid_store_footer_widget_area_no ); ?>">
                                <div class="row">
                                	<?php
                                	if( !empty( $orchid_store_footer_widget_area_no ) ) {

                                		for( $orchid_store_count = 1; $orchid_store_count <= $orchid_store_footer_widget_area_no; $orchid_store_count++ ) {
                                			$orchid_store_sidebar_id = 'footer-'.$orchid_store_count;
                                			?>
                                			<div class="os-col column">
        		                                <?php 
        		                                if( is_active_sidebar( $orchid_store_sidebar_id ) ) {
        		                                	dynamic_sidebar( $orchid_store_sidebar_id );
        		                                }
        		                                ?>
        		                            </div><!-- .col -->
                                			<?php
                                		}
                                	}
                                	?>
                                </div><!-- .row -->
                            </div><!-- .footer-top -->
                            <?php
                        }
                        ?>
                        <div class="footer-bottom">
                            <div class="os-row">
                                <div class="os-col copyrights-col">
                                    <?php
                                    /**
    		                        * Hook - orchid_store_footer_left.
    		                        *
    		                        * @hooked orchid_store_footer_left_action - 10
    		                        */
    		                        do_action( 'orchid_store_footer_left' );
                                    ?>
                                </div><!-- .os-col -->
                                <div class="os-col">
                                    <?php
                                    /**
    		                        * Hook - orchid_store_footer_right.
    		                        *
    		                        * @hooked orchid_store_footer_right_action - 10
    		                        */
    		                        do_action( 'orchid_store_footer_right' );
                                    ?>
                                </div><!-- .os-col -->
                            </div><!-- .os-row -->
                        </div><!-- .footer-bottom -->
                    </div><!-- .footer-entry -->
                </div><!-- .__os-container__ -->
            </div><!-- .footer-mask -->
        </div><!-- .footer-inner -->
    </footer><!-- .footer -->
    
    <?php  
    if( orchid_store_get_option( 'display_scroll_top_button' ) == true ) {
        ?>
        <div class="orchid-backtotop"><span><i class="bx bx-chevron-up"></i></span></div>
        <?php
    }
    ?>

</div><!-- .__os-page-wrap__ -->

<?php wp_footer(); ?>

</body>
</html>
