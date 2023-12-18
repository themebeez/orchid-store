<?php
/**
 * Toggle Custom Control.
 *
 * @package orchid_store
 */

if ( ! class_exists( 'Orchid_Store_Customize_Toggle_Control' ) ) {
	/**
	 * Class Orchid_Store_Customize_Toggle_Control
	 *
	 * @package    Orchid_Store
	 * @subpackage Orchid_Store/customizer/controls
	 * @author     Themebeez <themebeez@gmail.com>
	 */
	class Orchid_Store_Customize_Toggle_Control extends WP_Customize_Control {
		/**
		 * Control's Type.
		 *
		 * @since 1.0.0
		 * @var string
		 */
		public $type = 'flat'; // light, iso, flat.

		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {

			wp_enqueue_script(
				'orchid-store-toggle',
				get_template_directory_uri() . '/customizer/assets/js/toggle.js',
				array( 'jquery' ),
				ORCHID_STORE_VERSION,
				true
			);

			wp_enqueue_style(
				'orchid-store-toggle',
				get_template_directory_uri() . '/customizer/assets/css/toggle.css',
				array(),
				ORCHID_STORE_VERSION,
				'all'
			);
		}

		/**
		 * Render the control's content.
		 *
		 * @author soderlind
		 * @version 1.0.0
		 */
		public function render_content() {
			?>
			<label>
				<div style="display:flex;flex-direction: row;justify-content: space-between;">
					<span class="customize-control-title" style="flex: 2 0 0; vertical-align: middle;">
						<?php echo esc_html( $this->label ); ?>
					</span>
					<input
						id="cb<?php echo esc_attr( $this->instance_number ); ?>"
						type="checkbox"
						class="tgl tgl-<?php echo esc_attr( $this->type ); ?>"
						value="<?php echo esc_attr( $this->value() ); ?>" 
						<?php $this->link(); ?>
						<?php checked( $this->value() ); ?>
					/>
					<label for="cb<?php echo esc_attr( $this->instance_number ); ?>" class="tgl-btn"></label>
				</div>
				<?php
				if ( $this->description ) {
					?>
					<div class="customize-control-description-wrapper">
						<span class="description customize-control-description">
							<?php echo esc_html( $this->description ); ?>
						</span>
					</div>
					<?php
				}
				?>
			</label>
			<?php
		}
	}
}
