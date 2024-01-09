<?php
/**
 * Collection of reuseable customizer functions.
 *
 * @package Orchid_Store
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'orchid_store_add_panel' ) ) {
	/**
	 *  Function to register new customizer panel
	 *
	 * @since 1.0.0
	 *
	 * @param string $id panel id.
	 * @param string $title panel title.
	 * @param string $desc panel description.
	 * @param int    $priority priority.
	 */
	function orchid_store_add_panel( $id, $title, $desc, $priority ) {

		global $wp_customize;

		$panel_id = 'orchid_store_panel_' . $id;

		if ( '' === $priority ) {

			$priority = 10;
		}

		$wp_customize->add_panel(
			$panel_id,
			array(
				'title'       => $title,
				'description' => $desc,
				'priority'    => $priority,
			)
		);
	}
}



if ( ! function_exists( 'orchid_store_add_section' ) ) {
	/**
	 *  Function to register new customizer section
	 *
	 * @since 1.0.0
	 *
	 * @param string $id section id.
	 * @param string $title section title.
	 * @param string $desc section description.
	 * @param string $panel section id.
	 * @param int    $priority priority.
	 */
	function orchid_store_add_section( $id, $title, $desc, $panel, $priority ) {

		global $wp_customize;

		$section_id = 'orchid_store_section_' . $id;

		$panel_id = 'orchid_store_panel_' . $panel;

		$section_args = array(
			'title'      => $title,
			'desciption' => $desc,
		);

		if ( ! empty( $panel ) ) {
			$section_args['panel'] = $panel_id;
		}

		if ( ! empty( $priority ) ) {
			$section_args['priority'] = $priority;
		}

		$wp_customize->add_section( $section_id, $section_args );
	}
}


if ( ! function_exists( 'orchid_store_add_textarea_field' ) ) {
	/**
	 * Function to register customize textarea control.
	 *
	 * @since 1.5.3
	 *
	 * @param array $customize_args     Control arguments.
	 */
	function orchid_store_add_textarea_field( $customize_args ) {

		global $wp_customize;

		$customize_defaults = orchid_store_get_default_theme_options();

		$wp_customize->add_setting(
			'orchid_store_field_' . $customize_args['id'],
			array(
				'sanitize_callback' => 'sanitize_textarea_field',
				'default'           => $customize_defaults[ $customize_args['id'] ],
			)
		);

		$wp_customize->add_control(
			'orchid_store_field_' . $customize_args['id'],
			array(
				'label'           => isset( $customize_args['label'] ) ? $customize_args['label'] : '',
				'description'     => isset( $customize_args['description'] ) ? $customize_args['description'] : '',
				'type'            => 'textarea',
				'section'         => 'orchid_store_section_' . $customize_args['section'],
				'active_callback' => isset( $customize_args['active_callback'] ) ? $customize_args['active_callback'] : '',
			)
		);
	}
}


if ( ! function_exists( 'orchid_store_add_text_field' ) ) {
	/**
	 *  Function to register new customizer text field.
	 *
	 * @since 1.0.0
	 *
	 * @param string $id Setting id.
	 * @param string $label Control label.
	 * @param string $desc Control description.
	 * @param string $active_callback Active callback.
	 * @param string $section Control section id.
	 */
	function orchid_store_add_text_field( $id, $label, $desc, $active_callback, $section ) {

		global $wp_customize;

		$defaults = orchid_store_get_default_theme_options();

		$field_id = 'orchid_store_field_' . $id;

		$section_id = 'orchid_store_section_' . $section;

		$control_args = array(
			'label'       => $label,
			'description' => $desc,
			'type'        => 'text',
			'section'     => $section_id,
		);

		if ( ! empty( $active_callback ) ) {

			$control_args['active_callback'] = $active_callback;
		}

		$wp_customize->add_setting(
			$field_id,
			array(
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => $defaults[ $id ],
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control( $field_id, $control_args );
	}
}



if ( ! function_exists( 'orchid_store_add_number_field' ) ) {
	/**
	 *  Function to register new customizer number field.
	 *
	 * @since 1.0.0
	 *
	 * @param string $id Setting id.
	 * @param string $label Control label.
	 * @param string $desc Control description.
	 * @param string $active_callback Active callback.
	 * @param string $section Control section id.
	 * @param int    $max Max attribute value.
	 * @param int    $min Min attribute value.
	 * @param int    $step Step attribute value.
	 */
	function orchid_store_add_number_field( $id, $label, $desc, $active_callback, $section, $max, $min, $step ) {

		global $wp_customize;

		$defaults = orchid_store_get_default_theme_options();
		$field_id = 'orchid_store_field_' . $id;

		$section_id = 'orchid_store_section_' . $section;

		$control_args = array(
			'label'       => $label,
			'description' => $desc,
			'type'        => 'number',
			'section'     => $section_id,
		);

		if ( ! empty( $active_callback ) ) {

			$control_args['active_callback'] = $active_callback;
		}

		if ( ! empty( $max ) && ! empty( $min ) && ! empty( $step ) ) {

			$control_args['input_attrs'] = array(
				'min'  => $min,
				'max'  => $max,
				'step' => $step,
			);

			$wp_customize->add_setting(
				$field_id,
				array(
					'default'           => $defaults[ $id ],
					'sanitize_callback' => 'orchid_store_sanitize_range',
					'capability'        => 'edit_theme_options',
				)
			);

		} else {

			$wp_customize->add_setting(
				$field_id,
				array(
					'default'           => $defaults[ $id ],
					'sanitize_callback' => 'orchid_store_sanitize_number',
					'capability'        => 'edit_theme_options',
				)
			);
		}

		$wp_customize->add_control( $field_id, $control_args );
	}
}


if ( ! function_exists( 'orchid_store_add_radio_image_field' ) ) {
	/**
	 *  Function to register new customizer image field
	 *
	 * @since 1.0.0
	 *
	 * @param string $id Setting id.
	 * @param string $label Control label.
	 * @param string $desc Control description.
	 * @param array  $choices image choices.
	 * @param string $active_callback Active callback.
	 * @param string $section Control section id.
	 */
	function orchid_store_add_radio_image_field( $id, $label, $desc, $choices, $active_callback, $section ) {

		global $wp_customize;

		$defaults = orchid_store_get_default_theme_options();

		$field_id = 'orchid_store_field_' . $id;

		$section_id = 'orchid_store_section_' . $section;

		$control_args = array(
			'label'       => $label,
			'description' => $desc,
			'type'        => 'select',
			'choices'     => $choices,
			'section'     => $section_id,
		);

		if ( ! empty( $active_callback ) ) {

			$control_args['active_callback'] = $active_callback;
		}

		$wp_customize->add_setting(
			$field_id,
			array(
				'sanitize_callback' => 'orchid_store_sanitize_select',
				'default'           => $defaults[ $id ],
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new Orchid_Store_Customize_Radio_Image_Control( $wp_customize, $field_id, $control_args )
		);
	}
}



if ( ! function_exists( 'orchid_store_add_toggle_field' ) ) {
	/**
	 *  Function to register new customizer toggle field
	 *
	 * @since 1.0.0
	 *
	 * @param string $id Setting id.
	 * @param string $label Control label.
	 * @param string $description Control description.
	 * @param string $active_callback Active callback.
	 * @param string $section Control section id.
	 */
	function orchid_store_add_toggle_field( $id, $label, $description, $active_callback, $section ) {

		global $wp_customize;

		$defaults = orchid_store_get_default_theme_options();

		$field_id = 'orchid_store_field_' . $id;

		$section_id = 'orchid_store_section_' . $section;

		$control_args = array(
			'label'       => $label,
			'description' => $description,
			'type'        => 'flat', // ios, light, flat.
			'section'     => $section_id,
		);

		if ( ! empty( $active_callback ) ) {

			$control_args['active_callback'] = $active_callback;
		}

		$wp_customize->add_setting(
			$field_id,
			array(
				'sanitize_callback' => 'wp_validate_boolean',
				'default'           => $defaults[ $id ],
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new Orchid_Store_Customize_Toggle_Control( $wp_customize, $field_id, $control_args )
		);
	}
}



if ( ! function_exists( 'orchid_store_add_select_field' ) ) {
	/**
	 *  Function to register new customizer select field
	 *
	 * @since 1.0.0
	 *
	 * @param string $id Setting id.
	 * @param string $label Control label.
	 * @param string $desc Control description.
	 * @param array  $choices select choices.
	 * @param string $active_callback Active callback.
	 * @param string $section Control section id.
	 */
	function orchid_store_add_select_field( $id, $label, $desc, $choices, $active_callback, $section ) {

		global $wp_customize;

		$defaults = orchid_store_get_default_theme_options();

		$field_id = 'orchid_store_field_' . $id;

		$section_id = 'orchid_store_section_' . $section;

		$control_args = array(
			'label'       => $label,
			'description' => $desc,
			'type'        => 'select',
			'choices'     => $choices,
			'section'     => $section_id,
		);

		if ( ! empty( $active_callback ) ) {

			$control_args['active_callback'] = $active_callback;
		}

		$wp_customize->add_setting(
			$field_id,
			array(
				'sanitize_callback' => 'orchid_store_sanitize_select',
				'default'           => $defaults[ $id ],
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control( $field_id, $control_args );
	}
}



if ( ! function_exists( 'orchid_store_add_image_field' ) ) {
	/**
	 *  Function to register new customizer image field
	 *
	 * @since 1.0.0
	 *
	 * @param string $id Setting id.
	 * @param string $label Control label.
	 * @param string $desc Control description.
	 * @param string $active_callback Active callback.
	 * @param string $section Control section id.
	 */
	function orchid_store_add_image_field( $id, $label, $desc, $active_callback, $section ) {

		global $wp_customize;

		$defaults = orchid_store_get_default_theme_options();

		$field_id = 'orchid_store_field_' . $id;

		$section_id = 'orchid_store_section_' . $section;

		$control_args = array(
			'label'      => $label,
			'desciption' => $desc,
			'section'    => $section_id,
		);

		if ( ! empty( $active_callback ) ) {

			$control_args['active_callback'] = $active_callback;
		}

		$wp_customize->add_setting(
			$field_id,
			array(
				'sanitize_callback' => 'esc_url_raw',
				'default'           => $defaults[ $id ],
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control( $wp_customize, $field_id, $control_args )
		);
	}
}


if ( ! function_exists( 'orchid_store_add_sortable_repeater_field' ) ) {
	/**
	 *  Function to register new customizer sortable repeater field
	 *
	 * @since 1.0.0
	 *
	 * @param string $id Setting id.
	 * @param string $label Control label.
	 * @param string $desc Control description.
	 * @param string $active_callback Active callback.
	 * @param string $section Control section id.
	 */
	function orchid_store_add_sortable_repeater_field( $id, $label, $desc, $active_callback, $section ) {

		global $wp_customize;

		$defaults = orchid_store_get_default_theme_options();

		$field_id = 'orchid_store_field_' . $id;

		$section_id = 'orchid_store_section_' . $section;

		$control_args = array(
			'label'         => $label,
			'desciption'    => $desc,
			'section'       => $section_id,
			'button_labels' => array(
				'add' => esc_html__( 'Add Item', 'orchid-store' ), // Optional. Button label for Add button. Default: Add.
			),
		);

		if ( ! empty( $active_callback ) ) {

			$control_args['active_callback'] = $active_callback;
		}

		$wp_customize->add_setting(
			$field_id,
			array(
				'sanitize_callback' => 'orchid_store_sanitize_urls',
				'default'           => $defaults[ $id ],
			)
		);

		$wp_customize->add_control(
			new Orchid_Store_Customize_Sortable_Repeater_Control( $wp_customize, $field_id, $control_args )
		);
	}
}


if ( ! function_exists( 'orchid_store_add_color_field' ) ) {
	/**
	 *  Function to register new customizer color field
	 *
	 * @since 1.0.0
	 *
	 * @param string $id Setting id.
	 * @param string $label Control label.
	 * @param string $desc Control description.
	 * @param string $active_callback Active callback.
	 * @param string $section Control section id.
	 */
	function orchid_store_add_color_field( $id, $label, $desc, $active_callback, $section ) {

		global $wp_customize;

		$defaults = orchid_store_get_default_theme_options();

		$field_id = 'orchid_store_field_' . $id;

		$section_id = 'orchid_store_section_' . $section;

		$control_args = array(
			'label'       => $label,
			'description' => $desc,
			'section'     => $section_id,
		);

		if ( ! empty( $active_callback ) ) {

			$control_args['active_callback'] = $active_callback;
		}

		$wp_customize->add_setting(
			$field_id,
			array(
				'sanitize_callback' => 'sanitize_hex_color',
				'default'           => $defaults[ $id ],
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control( $wp_customize, $field_id, $control_args )
		);
	}
}
