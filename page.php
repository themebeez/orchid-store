<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Orchid_Store
 */

get_header();

if( get_theme_mod( 'orchid_store_field_enable_home_content', true ) == true && is_front_page() && ! is_home() ) {

    if( is_active_sidebar( 'sidebar-2' ) ) {
    
        dynamic_sidebar( 'sidebar-2' );
    }
} else {
    ?>
    <div class="inner-page-wrap default-page-wrap default-page-s1">
        <?php
        /**
    	* Hook - orchid_store_title_breadcrumb.
    	*
    	* @hooked orchid_store_title_breadcrumb_action - 10
    	*/
    	do_action( 'orchid_store_title_breadcrumb' );
    	?>
        <div class="__os-container__">
            <div class="os-row">
                <div class="<?php orchid_store_content_container_class(); ?>">
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">
                        	<?php
                        	while( have_posts() ) :

                        		the_post();

                        		get_template_part( 'template-parts/content', 'page' );

                        		// If comments are open or we have at least one comment, load up the comment template.
    							if ( comments_open() || get_comments_number() ) :
    								comments_template();
    							endif;

                        	endwhile;
                        	?>
                        </main><!-- #main.site-main -->
                    </div><!-- #primary.content-area -->
                </div><!-- .col -->
                <?php get_sidebar(); ?>
            </div><!-- .row -->
        </div><!-- .os-container -->
    </div><!-- .inner-page-wrap.default-page-wrap.default-page-s1 -->
    <?php
}
get_footer();
