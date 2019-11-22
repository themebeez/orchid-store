<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Orchid_Store
 */

if ( ! function_exists( 'orchid_store_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function orchid_store_posted_on() {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'; // phpcs:ignore.
	}
endif;

if ( ! function_exists( 'orchid_store_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function orchid_store_posted_by() {

		echo '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'; // phpcs:ignore.
	}
endif;


if( ! function_exists( 'orchid_store_post_categories_list' ) ) {

	function orchid_store_post_categories_list() {

		$categories_list = get_the_category_list();

		if ( $categories_list ) {

			echo wp_kses_post( $categories_list ); // phpcs:ignore.
		}
	}
}


if( ! function_exists( 'orchid_store_post_tags_list' ) ) {

	function orchid_store_post_tags_list() {

		if( 'post' != get_post_type() ) {

			return;
		}

		$tags_list = get_the_tag_list();

		if ( $tags_list ) {
			?>
			<div class="entry-tags">
				<div class="post-tags">
					<?php echo wp_kses_post( $tags_list ); // phpcs:ignore. ?>
				</div>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'orchid_store_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function orchid_store_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;
