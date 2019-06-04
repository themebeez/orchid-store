<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Orchid_Store
 */

get_header();
?>
<div class="inner-page-wrap default-post-wrap page-full-bg-thumbnail">
    <div class="inner-entry">
    	<?php
    	while( have_posts() ) :

    		the_post();

    		$show_categories    = orchid_store_get_option( 'display_post_cats' );
    		$show_author        = orchid_store_get_option( 'display_post_author' );
			$show_date          = orchid_store_get_option( 'display_post_date' );
    		?>
	        <div class="thumb featured-thumb" <?php if( has_post_thumbnail() ) { ?>style="background-image: url(<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ); ?>);"<?php } ?>>
	            <section class="page-head">
	                <div class="head-entry">
	                    <div class="holder">
	                        <?php
	                        if( $show_categories == true ) {
				                /**
				                * Hook - orchid_store_post_categories.
				                *
				                * @hooked orchid_store_post_categories_action - 10
				                */
				                do_action( 'orchid_store_post_categories' );
				            }
			                ?>
	                        <div class="title">
	                            <h1 class="entry-title"><?php the_title(); ?></h1>
	                        </div><!-- .title -->
	                        <?php
	                        if( $show_date == true || $show_author == true ) {
	                        	?>
		                        <div class="entry-metas">
		                            <ul>
		                                <?php
		                                if( $show_author == true ) {
					                        /**
					                        * Hook - orchid_store_post_author.
					                        *
					                        * @hooked orchid_store_post_author_action - 10
					                        */
					                        do_action( 'orchid_store_post_author' );
					                    }

					                    if( $show_date == true ) {
					                        /**
					                        * Hook - orchid_store_post_date.
					                        *
					                        * @hooked orchid_store_post_date_action - 10
					                        */
					                        do_action( 'orchid_store_post_date' );
					                    }
				                        ?>
		                            </ul>
		                        </div><!-- .entry-metas -->
		                        <?php
		                    }
		                    ?>
	                    </div><!-- .holder -->
	                </div><!-- .head-entry -->
	            </section><!-- .page-head -->
	        </div><!-- .thumb.featured-thumb -->
	        <?php
	    endwhile;
	    ?>
        <div class="__os-container__">
            <div class="row">
                <div class="<?php orchid_store_content_container_class(); ?>">
                    <div id="primary" class="content-area">
                        <div id="main" class="site-main">                            
                        	<?php
                        	while( have_posts() ) :

                        		the_post();

                        		get_template_part( 'template-parts/content', 'single' );

                        		/**
		                        * Hook - orchid_store_post_navigation.
		                        *
		                        * @hooked orchid_store_post_navigation_action - 10
		                        */
		                        do_action( 'orchid_store_post_navigation' );

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_commorchid_store_post_navigationents_number() ) :
									comments_template();
								endif;

                        	endwhile;
                        	?>
                        </div><!-- #main.site-main -->
                    </div><!-- #primary.content-area -->
                </div><!-- .col -->
                <?php get_sidebar(); ?>
            </div><!-- .row -->
        </div><!-- .__os-container__ -->
    </div><!-- .inner-entry -->
</div><!-- .inner-page-wrap.default-post-wrap.page-full-bg-thumbnail -->
<?php
get_footer();
