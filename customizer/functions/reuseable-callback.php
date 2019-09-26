<?php
/**
 * Collection of reuseable customizer functions.
 *
 * @package Orchid_Store
 */


/**
 *	Function to register new customizer panel
 */
if( ! function_exists( 'orchid_store_add_panel' ) ) {
	
	function orchid_store_add_panel( $id, $title, $desc, $priority ) {

		global $wp_customize;

		$panel_id = 'orchid_store_panel_' . $id;

		if( $priority == ''  ) {

			$priority = 10;
		}

		$wp_customize->add_panel( $panel_id,
			array(
				'title' => $title,
				'description' => $desc,
				'priority' => $priority,
			)
		);
	}	
}


/**
 *	Function to register new customizer section
 */
if( ! function_exists( 'orchid_store_add_section' ) ) {

	function orchid_store_add_section( $id, $title, $desc, $panel, $priority ) {

		global $wp_customize;

		$section_id = 'orchid_store_section_' . $id;

		$panel_id = 'orchid_store_panel_' . $panel;

		$section_args = array(
			'title'	=> $title,
			'desciption' => $desc,
		);

		if( !empty( $panel ) ) {
			$section_args['panel'] = $panel_id;
		}

		if( !empty( $priority ) ) {
			$section_args['priority'] = $priority;
		}

		$wp_customize->add_section( $section_id, $section_args );
	}
}


/**
 *	Function to register new customizer text field
 */
if( ! function_exists( 'orchid_store_add_text_field' ) ) {

	function orchid_store_add_text_field( $id, $label, $desc, $active_callback, $section ) {

		global $wp_customize;

		$defaults = orchid_store_get_default_theme_options();

		$field_id = 'orchid_store_field_'. $id;

		$section_id = 'orchid_store_section_'. $section;

		$control_args = array(
			'label' => $label,
			'description' => $desc,
			'type' => 'text',
			'section' => $section_id,
		);

		if( !empty( $active_callback ) ) {

			$control_args['active_callback'] = $active_callback;
		}

		$wp_customize->add_setting( $field_id, 
			array(
				'sanitize_callback'		=> 'sanitize_text_field',
				'default'				=> $defaults[$id],
				'capability'        => 'edit_theme_options',
			) 
		);	

		$wp_customize->add_control( $field_id, $control_args );
	}
}


/**
 *	Function to register new customizer number field
 */
if( ! function_exists( 'orchid_store_add_number_field' ) ) {

	function orchid_store_add_number_field( $id, $label, $desc, $active_callback, $section, $max, $min, $step ) {

		global $wp_customize;

		$defaults = orchid_store_get_default_theme_options();

		$field_id = 'orchid_store_field_'. $id;

		$section_id = 'orchid_store_section_'. $section;

		$control_args = array(
			'label' => $label,
			'description' => $desc,
			'type' => 'number',
			'section' => $section_id,
		);

		if( !empty( $active_callback ) ) {

			$control_args['active_callback'] = $active_callback;
		}

		if( !empty( $max ) && !empty( $min ) && !empty( $step ) ) {

			$control_args['input_attrs'] = array(
				'min' => $min,
				'max' => $max,
				'step' => $step
			);

			$wp_customize->add_setting( $field_id, 
				array(
				'default' => $defaults[$id],
				'sanitize_callback' => 'orchid_store_sanitize_range',
				'capability'        => 'edit_theme_options',
				)
			);	

		} else {

			$wp_customize->add_setting( $field_id, 
				array(
					'default' => $defaults[$id],
					'sanitize_callback' => 'orchid_store_sanitize_number',
					'capability'        => 'edit_theme_options',
				) 
			);	
		}		

		$wp_customize->add_control( $field_id, $control_args );
	}	
}


/**
 *	Function to register new customizer image field
 */
if( ! function_exists( 'orchid_store_add_radio_image_field' ) ) {

	function orchid_store_add_radio_image_field( $id, $label, $desc, $choices, $active_callback, $section ) {

		global $wp_customize;

		$defaults = orchid_store_get_default_theme_options();

		$field_id = 'orchid_store_field_'. $id;

		$section_id = 'orchid_store_section_'. $section;

		$control_args = array(
			'label' => $label,
			'description' => $desc,
			'type'	=> 'select',
			'choices' => $choices,
			'section' => $section_id,
		);

		if( !empty( $active_callback ) ) {

			$control_args['active_callback'] = $active_callback;
		}

		$wp_customize->add_setting( $field_id, 
			array(
				'sanitize_callback'		=> 'orchid_store_sanitize_select',
				'default'				=> $defaults[$id],
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control( new Orchid_Store_Radio_Image_Control( $wp_customize, $field_id, $control_args ) );
	}
}


/**
 *	Function to register new customizer toggle field
 */
if( ! function_exists( 'orchid_store_add_toggle_field' ) ) {

	function orchid_store_add_toggle_field( $id, $label, $description, $active_callback, $section ) {

		global $wp_customize;

		$defaults = orchid_store_get_default_theme_options();

		$field_id = 'orchid_store_field_'. $id;

		$section_id = 'orchid_store_section_'. $section;

		$control_args = array(
			'label'				=> $label,
			'description'		=> $description,
			'type'				=> 'flat', // ios, light, flat
			'section' => $section_id,
		);

		if( !empty( $active_callback ) ) {

			$control_args['active_callback'] = $active_callback;
		}

		$wp_customize->add_setting( $field_id, 
			array(
				'sanitize_callback'		=> 'wp_validate_boolean',
				'default'				=> $defaults[$id],
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control( new Orchid_Store_Customizer_Toggle_Control( $wp_customize, $field_id, $control_args ) );
	}
}


/**
 *	Function to register new customizer select field
 */
if( ! function_exists( 'orchid_store_add_select_field' ) ) {

	function orchid_store_add_select_field( $id, $label, $desc, $choices, $active_callback, $section ) {

		global $wp_customize;

		$defaults = orchid_store_get_default_theme_options();

		$field_id = 'orchid_store_field_'. $id;

		$section_id = 'orchid_store_section_'. $section;

		$control_args = array(
			'label' => $label,
			'description' => $desc,
			'type' => 'select',
			'choices' => $choices,
			'section' => $section_id,
		);

		if( !empty( $active_callback ) ) {

			$control_args['active_callback'] = $active_callback;
		}

		$wp_customize->add_setting( $field_id,
			array(
				'sanitize_callback'		=> 'orchid_store_sanitize_select',
				'default'				=> $defaults[$id],
				'capability'        	=> 'edit_theme_options',
			)
		);

		$wp_customize->add_control( $field_id, $control_args );
	}
}


/**
 *	Function to register new customizer image field
 */
if( ! function_exists( 'orchid_store_add_image_field' ) ) {

	function orchid_store_add_image_field( $id, $label, $desc, $active_callback, $section ) {

		global $wp_customize;

		$defaults = orchid_store_get_default_theme_options();

		$field_id = 'orchid_store_field_'. $id;

		$section_id = 'orchid_store_section_'. $section;

		$control_args = array(
			'label' => $label,
			'desciption' => $desc,
			'section' => $section_id,
		);

		if( !empty( $active_callback ) ) {

			$control_args['active_callback'] = $active_callback;
		}

		$wp_customize->add_setting( $field_id, 
			array(
				'sanitize_callback'		=> 'esc_url_raw',
				'default'				=> $defaults[$id],
			)
		);

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $field_id, $control_args ) );
	}
}

/**
 *	Function to register new customizer sortable repeater field
 */
if( ! function_exists( 'orchid_store_add_sortable_repeater_field' ) ) {

	function orchid_store_add_sortable_repeater_field( $id, $label, $desc, $active_callback, $section ) {

		global $wp_customize;

		$defaults = orchid_store_get_default_theme_options();

		$field_id = 'orchid_store_field_'. $id;

		$section_id = 'orchid_store_section_'. $section;

		$control_args = array(
			'label' => $label,
			'desciption' => $desc,
			'section' => $section_id,
			'button_labels' => array(
				'add' => esc_html__( 'Add Item', 'orchid-store' ), // Optional. Button label for Add button. Default: Add
			)
		);

		if( !empty( $active_callback ) ) {

			$control_args['active_callback'] = $active_callback;
		}

		$wp_customize->add_setting( $field_id, 
			array(
				'sanitize_callback'		=> 'orchid_store_sanitize_urls',
				'default'				=> $defaults[$id],
			)
		);

		$wp_customize->add_control( new Orchid_Store_Sortable_Repeater_Control( $wp_customize, $field_id, $control_args ) ); 
	}
}

/**
 *	Function to register new customizer color field
 */
if( ! function_exists( 'orchid_store_add_color_field' ) ) {

	function orchid_store_add_color_field( $id, $label, $desc, $active_callback, $section ) {

		global $wp_customize;

		$defaults = orchid_store_get_default_theme_options();

		$field_id = 'orchid_store_field_'. $id;

		$section_id = 'orchid_store_section_'. $section;

		$control_args = array(
			'label' => $label,
			'description' => $desc,
			'section' => $section_id,
		);

		if( !empty( $active_callback ) ) {

			$control_args['active_callback'] = $active_callback;
		}

		$wp_customize->add_setting( $field_id, 
			array(
				'sanitize_callback'		=> 'sanitize_hex_color',
				'default'				=> $defaults[$id],
				'capability'        => 'edit_theme_options',
			) 
		);	

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $field_id, $control_args ) );
	}
}