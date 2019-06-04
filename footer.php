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

	<footer class="footer secondary-widget-area">
        <div class="footer-inner">
            <div class="__os-container__">
                <div class="footer-entry">
                	<?php
                	if( is_active_sidebar( 'sidebar-3' ) || is_active_sidebar( 'sidebar-4' ) || is_active_sidebar( 'sidebar-5' ) || is_active_sidebar( 'sidebar-6' ) ) {
                		?>
	                    <div class="footer-top columns-4">
	                        <div class="row">
	                            <div class="os-col column">
	                                <?php 
	                                if( is_active_sidebar( 'sidebar-3' ) ) {
	                                	dynamic_sidebar( 'sidebar-3' );
	                                }
	                                ?>
	                            </div><!-- .col -->
	                            <div class="os-col column">
	                                <?php 
	                                if( is_active_sidebar( 'sidebar-4' ) ) {
	                                	dynamic_sidebar( 'sidebar-4' );
	                                }
	                                ?>
	                            </div><!-- // col -->
	                            <div class="os-col column">
	                                <?php 
	                                if( is_active_sidebar( 'sidebar-5' ) ) {
	                                	dynamic_sidebar( 'sidebar-5' );
	                                }
	                                ?>
	                            </div><!-- // os-col -->
	                            <div class="os-col column">
	                                <?php 
	                                if( is_active_sidebar( 'sidebar-6' ) ) {
	                                	dynamic_sidebar( 'sidebar-6' );
	                                }
	                                ?>
	                            </div><!-- // os-col -->
	                        </div><!-- // row -->
	                    </div><!-- // footer-top -->
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
        </div><!-- .footer-inner -->
    </footer><!-- .footer -->
</div><!-- .__os-page-wrap__ -->

<?php wp_footer(); ?>

</body>
</html>
