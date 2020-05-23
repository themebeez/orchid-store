<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Orchid_Store
 */

get_header();
?>
<div class="inner-page-wrap search-page-wrap">
	<?php
    /**
	* Hook - orchid_store_title_breadcrumb.
	*
	* @hooked orchid_store_title_breadcrumb_action - 10
	*/
	do_action( 'orchid_store_title_breadcrumb' );
	?>
    <div class="inner-entry">
        <div class="__os-container__">
            <div class="os-row">
                <div class="<?php orchid_store_content_container_class(); ?>">
                    <div id="primary" class="content-area">
                        <div id="main" class="site-main">
                        	<?php
                        	if( have_posts() ) :
                        		
							    if( orchid_store_get_option( 'display_page_header' ) == false ) {
							        ?>
							        <h1 class="entry-title page-title">
							            <?php
							            /* translators: %s: search query. */
							            printf( esc_html__( 'Search Results for: %s', 'orchid-store' ), '<span>' . get_search_query() . '</span>' );
							            ?>
							        </h1><!-- .entry-title -->
							        <?php
							    } 
                        		?>
	                            <div class="search-entry">
	                                <?php
	                                /* Start the Loop */
									while ( have_posts() ) :

										the_post();

										/*
										 * Include the Post-Type-specific template for the content.
										 * If you want to override this in a child theme, then include a file
										 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
										 */
										get_template_part( 'template-parts/content', 'search' );

									endwhile;

									/**
			                        * Hook - orchid_store_pagination.
			                        *
			                        * @hooked orchid_store_pagination_action - 10
			                        */
			                        do_action( 'orchid_store_pagination' );
			                        ?>
	                            </div><!-- .search-entry -->
	                            <?php
	                        else :

	                        	get_template_part( 'template-parts/content', 'none' );

	                        endif;
	                        ?>
                        </div><!-- #main.site-main -->
                    </div><!-- #primary.content-area -->
                </div><!-- .col -->
                <?php get_sidebar(); ?>
            </div><!-- .row -->
        </div><!-- .__os-container__ -->
    </div><!-- .inner-entry -->
</div><!-- .inner-page-wrap.search-page-wrap -->
<?php
get_footer();