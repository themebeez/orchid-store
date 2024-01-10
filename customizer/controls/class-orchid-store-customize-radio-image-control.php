<?php
/**
 * Radio Image Custom Control
 *
 * @package orchid_store
 */

if ( ! class_exists( 'Orchid_Store_Customize_Radio_Image_Control' ) ) {
	/**
	 * Class Orchid_Store_Customize_Radio_Image_Control
	 *
	 * @package    Orchid_Store
	 * @subpackage Orchid_Store/customizer/controls
	 * @author     Themebeez <themebeez@gmail.com>
	 */
	class Orchid_Store_Customize_Radio_Image_Control extends WP_Customize_Control {

		/**
		 * Control's Type.
		 *
		 * @since 1.0.0
		 * @var string
		 */
		public $type = 'radio-image';

		/**
		 * Enqueue control related scripts/styles.
		 *
		 * @since 1.0.0
		 */
		public function enqueue() {

			wp_enqueue_style(
				'orchid-store-radio-image',
				get_template_directory_uri() . '/customizer/assets/css/radio-image.css',
				array(),
				ORCHID_STORE_VERSION,
				'all'
			);
		}

		/**
		 * Renders the control wrapper and calls $this->render_content() for the internals.
		 *
		 * @since 1.0.0
		 */
		public function render_content() {
			?>
			<span class="customize-control-title">
				<?php echo esc_html( $this->label ); ?>
			</span>
			<?php
			if ( $this->description ) {
				?>
				<div class="customize-control-description-wrapper">
					<span class="customize-control-description">
						<?php echo esc_html( $this->description ); ?>
					</span>
				</div>
				<?php
			}
			?>
			<div id="input_<?php echo esc_attr( $this->id ); ?>" class="image">
				<?php
				foreach ( $this->choices as $value => $label ) {
					?>
					<label
						for="<?php echo esc_attr( $this->id . $value ); ?>"
					>
						<input
							class="image-select"
							type="radio"
							value="<?php echo esc_attr( $value ); ?>"
							name="<?php echo esc_attr( '_customize-radio-' . $this->id ); ?>"
							id="<?php echo esc_attr( $this->id . $value ); ?>" 
							<?php $this->link(); ?>
							<?php checked( $this->value(), $value ); ?>
						>
						<img src="<?php echo esc_url( $label ); ?>"/>
					</label>
					<?php
				}
				?>
			</div>
			<?php
		}
	}
}
