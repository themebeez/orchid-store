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
    <div class="inner-entry">
        <div class="__os-container__">
            <div class="row">
                <div class="<?php orchid_store_content_container_class(); ?>">
                    <div id="primary" class="content-area">
                        <div id="main" class="site-main">
                        	<?php
                        	if( have_posts() ) :
                        		?>
	                            <div class="search-entry">
	                                <div class="title">
	                                	<h1 class="entry-title">
		                                	<?php
											/* translators: %s: search query. */
											printf( esc_html__( 'Search Results for: %s', 'orchid-store' ), '<span>' . get_search_query() . '</span>' );
											?>
										</h1><!-- .entry-title -->
	                                </div><!-- .title -->
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