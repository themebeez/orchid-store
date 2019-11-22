<?php
/**
 * Radio Image Custom Control
 */

if( ! class_exists( 'Orchid_Store_Select_Control' ) ) {

	class Orchid_Store_Select_Control extends WP_Customize_Control {
		
		public $type = 'dropdown_select2';
		
		private $multiselect = false;
		
		private $placeholder = '';
		
		public function __construct( $manager, $id, $args = array(), $options = array() ) {

			parent::__construct( $manager, $id, $args );

			// Check if this is a multi-select field
			if ( isset( $this->input_attrs['multiselect'] ) && $this->input_attrs['multiselect'] ) {
				$this->multiselect = true;
			}

			// Check if a placeholder string has been specified
			if ( isset( $this->input_attrs['placeholder'] ) && $this->input_attrs['placeholder'] ) {
				$this->placeholder = $this->input_attrs['placeholder'];
			}
		}

		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {

			wp_enqueue_script( 'select2', get_template_directory_uri() . '/customizer/assets/js/select2.js', array( 'jquery' ), ORCHID_STORE_VERSION, true );

			wp_enqueue_script( 'orchid-store-select', get_template_directory_uri() . '/customizer/assets/js/select.js', array( 'jquery' ), ORCHID_STORE_VERSION, true );

			wp_enqueue_style( 'select2', get_template_directory_uri() . '/customizer/assets/css/select2.css' );

			wp_enqueue_style( 'orchid-store-select', get_template_directory_uri() . '/customizer/assets/css/select.css' );
		}

		/**
		 * Render the control in the customizer
		 */
		public function render_content() {

			$defaultValue = $this->value();

			if ( $this->multiselect ) {

				if( !empty( $this->value() ) ) {
					$defaultValue = explode( ',', $this->value() );
				}
			}
			?>
			<div class="dropdown_select2_control">
				<?php 
				if( !empty( $this->label ) ) { 
					?>
					<label for="<?php echo esc_attr( $this->id ); ?>" class="customize-control-title">
						<?php echo esc_html( $this->label ); ?>
					</label>
					<?php 
				} 

				if( !empty( $this->description ) ) { 
					?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
					<?php 
				} 
				?>
				<input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" class="customize-control-dropdown-select2" value="<?php echo esc_attr( $this->value() ); ?>" name="<?php echo esc_attr( $this->id ); ?>" <?php $this->link(); ?> />

				<select name="select2-list-<?php echo ( $this->multiselect ? 'multi[]' : 'single' ); ?>" class="customize-control-select2" data-placeholder="<?php echo esc_attr( $this->placeholder ); ?>" <?php echo ( $this->multiselect ? 'multiple="multiple" ' : '' ); ?>>
					<?php
						if ( !$this->multiselect ) {
							// When using Select2 for single selection, the Placeholder needs an empty <option> at the top of the list for it to work (multi-selects dont need this)
							echo '<option></option>';
						}
						foreach ( $this->choices as $key => $value ) {
							if ( is_array( $value ) ) {
								echo '<optgroup label="' . esc_attr( $key ) . '">';
								foreach ( $value as $optgroupkey => $optgroupvalue ) {
									echo '<option value="' . esc_attr( $optgroupkey ) . '" ' . ( in_array( esc_attr( $optgroupkey ), $defaultValue ) ? 'selected="selected"' : '' ) . '>' . esc_attr( $optgroupvalue ) . '</option>';
								}
								echo '</optgroup>';
							}
							else {
								echo '<option value="' . esc_attr( $key ) . '" ' . selected( esc_attr( $key ), $defaultValue, false )  . '>' . esc_attr( $value ) . '</option>';
							}
	 					}
	 				?>
				</select>
			</div>
			<?php
		}
	}
}