<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', esc_html__( 'You must be logged in to checkout.', 'orchid-store' ) ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<?php
	if ( get_theme_mod( 'orchid_store_field_checkout_layout', 'layout_1' ) === 'layout_1' ) {

		if ( $checkout->get_checkout_fields() ) {

			do_action( 'woocommerce_checkout_before_customer_details' );
			?>

			<div class="col2-set" id="customer_details">
				<div class="col-1">
					<?php do_action( 'woocommerce_checkout_billing' ); ?>
				</div>
				<div class="col-2">
					<?php do_action( 'woocommerce_checkout_shipping' ); ?>
				</div>
			</div>

			<?php
			do_action( 'woocommerce_checkout_after_customer_details' );
		}

		do_action( 'woocommerce_checkout_before_order_review_heading' );
		?>

		<h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'orchid-store' ); ?></h3>

		<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

		<div id="order_review" class="woocommerce-checkout-review-order">
			<?php do_action( 'woocommerce_checkout_order_review' ); ?>
		</div>

		<?php
		do_action( 'woocommerce_checkout_after_order_review' );
	} else {
		?>
		<div class="col2-set">
			<div class="col-1">
				<div id="customer_details">
					<?php
					if ( $checkout->get_checkout_fields() ) {
						do_action( 'woocommerce_checkout_before_customer_details' );
						do_action( 'woocommerce_checkout_billing' );
						do_action( 'woocommerce_checkout_shipping' );
						do_action( 'woocommerce_checkout_after_customer_details' );
					}
					?>
				</div>
			</div>
			<div class="col-2">
				<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
				<h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'orchid-store' ); ?></h3>
				<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
				<div id="order_review" class="woocommerce-checkout-review-order">
					<?php do_action( 'woocommerce_checkout_order_review' ); ?>
				</div>
				<?php
				do_action( 'woocommerce_checkout_after_order_review' );
				?>
			</div>
		</div>
		<?php
	}
	?>
</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
