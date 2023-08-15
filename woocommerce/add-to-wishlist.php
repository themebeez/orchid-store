<?php
/**
 * Add to wishlist template
 *
 * @author  themebeez
 * @package Orchid_Store
 */

if ( ! defined( 'YITH_WCWL' ) ) {
	exit;
} // Exit if accessed directly

global $product;
?>

<div
	class="yith-wcwl-add-to-wishlist add-to-wishlist-<?php echo esc_attr( $product_id ); ?> <?php echo esc_attr( $container_classes ); ?> wishlist-fragment on-first-load"
	data-fragment-ref="<?php echo esc_attr( $product_id ); ?>"
	data-fragment-options="<?php echo esc_attr( wp_json_encode( $fragment_options ) ); ?>"
>
	<?php if ( ! $ajax_loading ) : ?>
		<?php if ( ! ( $disable_wishlist && ! is_user_logged_in() ) ) : ?>
			<!-- ADD TO WISHLIST -->
			<?php yith_wcwl_get_template( 'add-to-wishlist-' . $template_part . '.php', $var ); ?>

			<!-- COUNT TEXT -->
			<?php
			if ( $show_count ) :
				echo yith_wcwl_get_count_text( $product_id ); // phpcs:ignore
			endif;
			?>
		<?php else : ?>
			<a
				href="<?php echo esc_url( add_query_arg( array( 'wishlist_notice' => 'true', 'add_to_wishlist' => $product_id ), get_permalink( wc_get_page_id( 'myaccount' ) ) ) ); // phpcs:ignore ?>"
				rel="nofollow"
				class="disabled_item <?php echo esc_attr( str_replace( array( 'add_to_wishlist', 'single_add_to_wishlist' ), '', $link_classes ) ); ?> button-general wish-list-button os-tooltip"
				data-tippy-content="<?php echo esc_attr( $already_in_wishlist_text ); ?>"
			>
				<span class="icon">
					<svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="currentColor"><path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z"/></svg>
				</span>
				<span class="text"><?php echo esc_html( $label ); ?></span>
			</a>
		<?php endif; ?>
	<?php endif; ?>
</div>
