<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Orchid_Store
 */

get_header();
?>
<div class="inner-page-wrap archive-page-wrap">
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
							<div class="archive-entry">
								<?php
								if ( have_posts() ) {

									if ( ! orchid_store_get_option( 'display_page_header' ) ) {

										the_archive_title( '<h1 class="entry-title page-title">', '</h1>' );
									}

									$archive_description = get_the_archive_description();
									if ( ! empty( $archive_description ) ) {
										?>
										<div class="category-description">
											<?php the_archive_description(); ?>
										</div><!-- .category-description -->
										<?php
									}

									echo '<div class="os-archive-articles">';

									$display_post_thumbnail  = orchid_store_get_option( 'archive_featured_image' );
									$display_categories_meta = orchid_store_get_option( 'archive_display_cats' );
									$display_post_excerpt    = orchid_store_get_option( 'archive_display_excerpt' );
									$display_author_meta     = orchid_store_get_option( 'archive_display_author' );
									$display_date_meta       = orchid_store_get_option( 'archive_display_date' );

									/* Start the Loop */
									while ( have_posts() ) {

										the_post();

										/*
										 * Include the Post-Type-specific template for the content.
										 * If you want to override this in a child theme, then include a file
										 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
										 */
										get_template_part(
											'template-parts/content',
											get_post_type(),
											array(
												'display_post_thumbnail'  => $display_post_thumbnail,
												'display_categories_meta' => $display_categories_meta,
												'display_excerpt'         => $display_post_excerpt,
												'display_author_meta'     => $display_author_meta,
												'display_date_meta'       => $display_date_meta,
											)
										);
									}

									echo '</div>';

									/**
									* Hook - orchid_store_pagination.
									*
									* @hooked orchid_store_pagination_action - 10
									*/
									do_action( 'orchid_store_pagination' );

								} else {

									get_template_part( 'template-parts/content', 'none' );
								}
								?>
							</div><!-- .archive-entry -->
						</div><!-- .main -->
					</div><!-- .primary -->
				</div><!-- .col -->
				<?php get_sidebar(); ?>
			</div><!-- .row -->
		</div><!-- .__os-container__ -->
	</div><!-- .inner-entry -->
</div><!-- .inner-page-wrap -->
<?php
get_footer();
