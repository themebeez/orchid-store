<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Orchid_Store
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="<?php orchid_store_content_entry_class(); ?>">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'orchid-store' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .editor-entry -->
	<?php
	/**
    * Hook - orchid_store_post_tags.
    *
    * @hooked orchid_store_post_tags_action - 10
    */
    do_action( 'orchid_store_post_tags' );

    if ( get_edit_post_link() ) :
	    edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'orchid-store' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	endif;
	?>
</article><!-- #post-<?php the_ID(); ?> -->