<?php
/**
 * The customize control to add plugin installation and activation of AFC plugin.
 *
 * @link       https://themebeez.com/
 * @since      1.0.0
 *
 * @package    Orchid_Store
 * @subpackage Orchid_Store/customizer/controls
 */


if ( ! class_exists( 'Orchid_Store_AFC_Recommendation_Control' ) ) {

	/**
	 * The customize control to add plugin installation and activation of AFC plugin.
	 *
	 * @package    Orchid_Store
 	 * @subpackage Orchid_Store/customizer/controls
	 * @author     Themebeez <themebeez@gmail.com>
	 */
	class Orchid_Store_AFC_Recommendation_Control extends WP_Customize_Control {

		/**
		 * Type of customize control.
		 * 
		 * @since 1.4.2
		 * @access public
		 * @var string $type Type of customize control.
		 */
		public $type = 'afc-recommendation';

		/**
         * Enqueue our scripts and styles.
		 * 
		 * @since 1.4.2
         */
        public function enqueue() {

            wp_enqueue_style( 'orchid-store-afc-recommendation', get_template_directory_uri() . '/customizer/assets/css/afc-recommendation.css' );
        }

		/**
         * Render control.
		 * 
		 * @since 1.4.2
         */
        public function render_content() {

			$installed_plugins = get_plugins();
			?>
			<div class="os-afc-recommendation">
				<div id="os-afc-install" class="os-afc-stat <?php echo ( ! isset( $installed_plugins['addonify-floating-cart/addonify-floating-cart.php'] ) ) ? 'afc-display' : 'afc-hide'; ?>">
					<p>
						<?php
						printf(
							/* translators: 1: plugin name. */
							esc_html__( 'Please install the %1$s plugin to enable the floating cart.', 'orchid-store' ),
							'<b><i>Addonify Floating Cart for WooCommerce</i></b>'
						);
						?>
					</p>
					<button id="os-install-afc" class="widefat button button-primary">
						<?php echo esc_html__( 'Install Now', 'orchid-store' ); ?>
					</button>
				</div>

				<div id="os-afc-activate" class="os-afc-stat <?php echo ( isset( $installed_plugins['addonify-floating-cart/addonify-floating-cart.php'] ) && ! is_plugin_active( 'addonify-floating-cart/addonify-floating-cart.php' ) ) ? 'afc-display' : 'afc-hide'; ?>">
					<p>
						<?php
						printf(
							/* translators: 1: plugin name. */
							esc_html__( 'Please activate the %1$s plugin to enable the floating cart.', 'orchid-store' ),
							'<b><i>Addonify Floating Cart for WooCommerce</i></b>'
						);
						?>
					</p>
					<button id="os-activate-afc" class="widefat button button-primary"><?php echo esc_html__( 'Activate Now', 'orchid-store' ); ?></button>
				</div>

				<div id="os-afc-activated" class="os-afc-stat <?php echo ( isset( $installed_plugins['addonify-floating-cart/addonify-floating-cart.php'] ) && is_plugin_active( 'addonify-floating-cart/addonify-floating-cart.php' ) ) ? 'afc-display' : 'afc-hide'; ?>">
					<p>
						<?php
						printf(
							/* translators: 1: plugin name */
							esc_html__( 'Floating cart&rsquo;s features can be configured from the %1$s plugin&rsquo;s setting page.', 'orchid-store' ),
							'<b><i>Addonify Floating Cart for WooCommerce</i></b>'
						);
						?>
					</p>
					<a href="<?php echo esc_url( admin_url( 'admin.php?page=addonify_floating_cart' ) ); ?>" class="button button-primary os-afc-settings-link"><?php echo esc_html__( 'Configure Now', 'orchid-store' ); ?></a>
				</div>

				<div id="os-afc-error" class="afc-hide">
					<p></p>
				</div>
            </div>
            <?php
        }
	}
}
