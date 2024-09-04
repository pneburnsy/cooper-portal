<?php
/**
* Header Trigger Buttons
*/

if( !defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/

class LD_Header_Trigger extends LD_Shortcode {
	
	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_header_trigger';
		$this->title       = esc_html__( 'Trigger Button', 'landinghub-core' );
		$this->icon        = 'la la-bars';
		$this->description = esc_html__( 'Create a custom trigger button.', 'landinghub-core' );
		$this->category    = esc_html__( 'Header Modules', 'landinghub-core' );

		parent::__construct();
	}
	
	public function get_params() {

		$this->params = array(

			array(
				'type' => 'dropdown',
				'param_name' => 'style',
				'heading' => esc_html__( 'Style', 'landinghub-core' ),
				'description' => esc_html__( 'Select a style for trigger', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Style 1', 'landinghub-core' )    => 'style-1',
					esc_html__( 'Style 2', 'landinghub-core' ) => 'style-2',
					esc_html__( 'Style 3', 'landinghub-core' ) => 'style-3',
					esc_html__( 'Style 4', 'landinghub-core' ) => 'style-4',
					esc_html__( 'Style 5', 'landinghub-core' ) => 'style-5',
				),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'text',
				'heading'     => esc_html__( 'Text', 'landinghub-core' ),
				'description' => esc_html__( 'Add text near the trigger', 'landinghub-core' ),
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_menu',
				'heading'     => esc_html__( 'Custom font?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use custom font for the text', 'landinghub-core' ),
			),
			//Typo Options
			array(
				'type'        => 'textfield',
				'param_name'  => 'fs',
				'heading'     => esc_html__( 'Font Size', 'landinghub-core' ),
				'description' => esc_html__( 'Example: 20px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3 vc_column-with-padding',
				'dependency' => array(
					'element' => 'use_custom_fonts_menu',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'lh',
				'heading'     => esc_html__( 'Line-Height', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_menu',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'fw',
				'heading'     => esc_html__( 'Font Weight', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_menu',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'ls',
				'heading'     => esc_html__( 'Letter Spacing', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_menu',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'transform',
				'heading'    => esc_html__( 'Transformation', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Default', 'landinghub-core' )    => '',
					esc_html__( 'Uppercase', 'landinghub-core' )  => 'uppercase',
					esc_html__( 'Lowercase', 'landinghub-core' )  => 'lowercase',
					esc_html__( 'Capitalize', 'landinghub-core' ) => 'capitalize',
				),
				'dependency' => array(
					'element' => 'use_custom_fonts_menu',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			/*
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use for text theme\'s default font family?', 'landinghub-core' ),
				'param_name'  => 'use_theme_fonts',
				'value'       => array(
					esc_html__( 'Yes', 'landinghub-core' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'landinghub-core' ),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_menu',
					'value'   => 'true',
				),
				'std'         => 'yes',
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'menu_font',
				'value'      => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
				'settings'   => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'landinghub-core' ),
						'font_style_description'  => esc_html__( 'Select font styling.', 'landinghub-core' ),
					),
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
				'dependency' => array(
					'element'            => 'use_theme_fonts',
					'value_not_equal_to' => 'yes',
				),
			),
			*/
			array(
				'type'        => 'liquid_button_set',
				'param_name'  => 'position',
				'heading'     => esc_html__( 'Text Position' ),
				'description' => esc_html__( 'Select a the text position', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Left', 'landinghub-core' ) => 'txt-left',
					esc_html__( 'Right', 'landinghub-core' ) => 'txt-right',
				),
				'dependency'  => array(
					'element' => 'text',
					'not_empty' => true,
				),
				'std' => 'txt-right',
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'trigger_fill',
				'heading' => esc_html__( 'Trigger fill', 'landinghub-core' ),
				'description' => esc_html__( 'Select trigger fill for side drawer', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'None', 'landinghub-core' ) => 'fill-none',
					esc_html__( 'Solid', 'landinghub-core' ) => 'solid',
					esc_html__( 'Bordered', 'landinghub-core' ) => 'bordered',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'trigger_shape',
				'heading' => esc_html__( 'Trigger Shape', 'landinghub-core' ),
				'description' => esc_html__( 'Select trigger shape for side drawer', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'None', 'landinghub-core' )   => '',
					esc_html__( 'Round', 'landinghub-core' )  => 'round',
					esc_html__( 'Circle', 'landinghub-core' ) => 'circle',
				),
				'dependency'  => array(
					'element' => 'trigger_fill',
					'value_not_equal_to'   => 'fill-none',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'target_id',
				'heading'     => esc_html__( 'ID of the target', 'landinghub-core' ),
				'description' => esc_html__( 'Add id of the target for trigger button, for ex. target_id', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'orientation',
				'heading'     => esc_html__( 'Orientation', 'landinghub-core' ),
				'description' => esc_html__( 'Select an orientation', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Default', 'landinghub-core' )  => '',
					esc_html__( 'Vertical', 'landinghub-core' ) => 'rotate-90',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'trigger_color',
				'heading'     => esc_html__( 'Trigger Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the trigger.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'trigger_color_hover',
				'heading'     => esc_html__( 'Trigger Hover Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the trigger when it\'s hovered.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'trigger_color_active',
				'heading'     => esc_html__( 'Trigger Active Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the trigger when it\'s active.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),

			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'trigger_text_color',
				'heading'     => esc_html__( 'Trigger Text Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the trigger text.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'group' => esc_html__( 'Design Options' ),
				'dependency'  => array(
					'element' => 'text',
					'not_empty' => true,
				),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'trigger_text_color_hover',
				'heading'     => esc_html__( 'Trigger Hover Text Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the trigger text when it\'s hovered.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
				'dependency'  => array(
					'element' => 'text',
					'not_empty' => true,
				),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'trigger_text_color_active',
				'heading'     => esc_html__( 'Trigger Active Text Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the trigger text when it\'s active.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
				'dependency'  => array(
					'element' => 'text',
					'not_empty' => true,
				),
			),

			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'shape_color',
				'heading'     => esc_html__( 'Shape Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the trigger shape.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'shape_hover_color',
				'heading'     => esc_html__( 'Shape Hover Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the hover state of trigger shape.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'shape_active_color',
				'heading'     => esc_html__( 'Shape Avtive Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the active state of trigger shape.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'sticky_separator',
				'heading'    => esc_html__( 'Sticky Colors', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_trigger_color',
				'heading'     => esc_html__( 'Trigger Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the trigger.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'group' => esc_html__( 'Design Options' )
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_trigger_color_hover',
				'heading'     => esc_html__( 'Trigger Hover Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the trigger when it\'s hovered.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_trigger_color_active',
				'heading'     => esc_html__( 'Trigger Active Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the trigger when it\'s active.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_trigger_text_color',
				'heading'     => esc_html__( 'Trigger Text Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the trigger text.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
				'dependency'  => array(
					'element' => 'text',
					'not_empty' => true,
				),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_trigger_text_color_hover',
				'heading'     => esc_html__( 'Trigger Hover Text Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the trigger text when it\'s hovered.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
				'dependency'  => array(
					'element' => 'text',
					'not_empty' => true,
				),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_trigger_text_color_active',
				'heading'     => esc_html__( 'Trigger Active Text Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the trigger text when it\'s active.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
				'dependency'  => array(
					'element' => 'text',
					'not_empty' => true,
				),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_shape_color',
				'heading'     => esc_html__( 'Shape Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the trigger shape.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_shape_hover_color',
				'heading'     => esc_html__( 'Shape Hover Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the hover state of trigger shape.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_shape_active_color',
				'heading'     => esc_html__( 'Shape Avtive Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the active state of trigger shape.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'sticky_light_separator',
				'heading'    => esc_html__( 'Colors Over Light Rows', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_light_trigger_color',
				'heading'     => esc_html__( 'Trigger Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the trigger.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'group' => esc_html__( 'Design Options' )
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_light_trigger_color_hover',
				'heading'     => esc_html__( 'Trigger Hover Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the trigger when it\'s hovered.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_light_trigger_color_active',
				'heading'     => esc_html__( 'Trigger Active Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the trigger when it\'s active.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_light_trigger_text_color',
				'heading'     => esc_html__( 'Trigger Text Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the trigger text.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
				'dependency'  => array(
					'element' => 'text',
					'not_empty' => true,
				),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_light_trigger_text_color_hover',
				'heading'     => esc_html__( 'Trigger Hover Text Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the trigger text when it\'s hovered.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
				'dependency'  => array(
					'element' => 'text',
					'not_empty' => true,
				),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_light_trigger_text_color_active',
				'heading'     => esc_html__( 'Trigger Active Text Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the trigger text when it\'s active.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
				'dependency'  => array(
					'element' => 'text',
					'not_empty' => true,
				),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_light_shape_color',
				'heading'     => esc_html__( 'Shape Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the trigger shape.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_light_shape_hover_color',
				'heading'     => esc_html__( 'Shape Hover Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the hover state of trigger shape.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_light_shape_active_color',
				'heading'     => esc_html__( 'Shape Avtive Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the active state of trigger shape.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'sticky_dark_separator',
				'heading'    => esc_html__( 'Colors Over Dark Rows', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_dark_trigger_color',
				'heading'     => esc_html__( 'Trigger Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the trigger.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'group' => esc_html__( 'Design Options' )
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_dark_trigger_color_hover',
				'heading'     => esc_html__( 'Trigger Hover Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the trigger when it\'s hovered.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_dark_trigger_color_active',
				'heading'     => esc_html__( 'Trigger Active Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the trigger when it\'s active.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_dark_trigger_text_color',
				'heading'     => esc_html__( 'Trigger Text Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the trigger text.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
				'dependency'  => array(
					'element' => 'text',
					'not_empty' => true,
				),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_dark_trigger_text_color_hover',
				'heading'     => esc_html__( 'Trigger Hover Text Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the trigger text when it\'s hovered.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
				'dependency'  => array(
					'element' => 'text',
					'not_empty' => true,
				),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_dark_trigger_text_color_active',
				'heading'     => esc_html__( 'Trigger Active Text Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the trigger text when it\'s active.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
				'dependency'  => array(
					'element' => 'text',
					'not_empty' => true,
				),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_dark_shape_color',
				'heading'     => esc_html__( 'Shape Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the trigger shape.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_dark_shape_hover_color',
				'heading'     => esc_html__( 'Shape Hover Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the hover state of trigger shape.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_dark_shape_active_color',
				'heading'     => esc_html__( 'Shape Avtive Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the active state of trigger shape.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),

		);

		$this->add_extras();
	}
	
	protected function get_text() {
		
		$text = $this->atts['text'];
		
		if( empty( $text ) ) {
			return;
		}

		printf( '<span class="txt">%s</span>', esc_html( $text ) );

	}
	
	protected function get_position() {
		
		$position = $this->atts['position'];
		$text     = $this->atts['text'];
		
		if( empty( $text ) || empty( $position ) ) {
			return;
		}

		return $position;

	}

	protected function generate_css() {
		
		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();
		
		$menu_font_inline_style = '';
		/*
		if( 'yes' !== $use_theme_fonts ) {

			// Build the data array
			$menu_font_data = $this->get_fonts_data( $menu_font );

			// Build the inline style
			$menu_font_inline_style = $this->google_fonts_style( $menu_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $menu_font_data );

		}
		*/
		$elements[ liquid_implode( '%1$s' ) ] = array( $menu_font_inline_style );
		$elements[ liquid_implode( '%1$s' ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ liquid_implode( '%1$s' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ liquid_implode( '%1$s' ) ]['font-weight'] = !empty( $fw ) ? $fw : '';
		$elements[ liquid_implode( '%1$s' ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';
		$elements[ liquid_implode( '%1$s' ) ]['text-transform'] = !empty( $transform ) ? $transform : '';

		if( ! empty($trigger_color) ) {
			
			if ( 'style-1' === $style ) {
				$elements[ liquid_implode( '%1$s .bar' ) ]['background'] = $trigger_color;
			} else if ( 'style-2' === $style ) {
				$elements[ liquid_implode( '%1$s.style-2 .bar:before, %1$s.style-2 .bar:after' ) ]['background'] = $trigger_color;
			} else {
				$elements[ liquid_implode( '%1$s .bar' ) ]['background'] = $trigger_color;
			}
			$elements[ liquid_implode( '%1$s' ) ]['color'] = $trigger_color;
			
		}
		
		if( ! empty($trigger_color_hover) ) {

			if ( 'style-1' === $style ) {
				$elements[ liquid_implode( '%1$s:hover .bar' ) ]['background'] = $trigger_color_hover;
			} else if ( 'style-2' === $style ) {
				$elements[ liquid_implode( '%1$s.style-2:hover .bar:before, %1$s.style-2:hover .bar:after' ) ]['background'] = $trigger_color_hover;
			} else {
				$elements[ liquid_implode( '%1$s:hover .bar' ) ]['background'] = $trigger_color_hover;
			}
			$elements[ liquid_implode( '%1$s:hover' ) ]['color'] = $trigger_color_hover;

		}

		if( ! empty($trigger_color_active) ) {

			if ( 'style-1' === $style ) {
				$elements[ liquid_implode( '%1$s.is-active .bar' ) ]['background'] = $trigger_color_active;
			} else if ( 'style-2' === $style ) {
				$elements[ liquid_implode( '%1$s.is-active .bar:before, %1$s.is-active .bar:after' ) ]['background'] = $trigger_color_active;
			} else {
				$elements[ liquid_implode( '%1$s.is-active .bar' ) ]['background'] = $trigger_color_active;
			}
			$elements[ liquid_implode( '%1$s.is-active' ) ]['color'] = $trigger_color_active;

		}

		if( ! empty($trigger_text_color) ) {
			$elements[ liquid_implode( '%1$s .txt' ) ]['color'] = $trigger_text_color;
		}
		if( ! empty($trigger_text_color_hover) ) {
			$elements[ liquid_implode( '%1$s:hover .txt' ) ]['color'] = $trigger_text_color_hover;
		}
		if( ! empty($trigger_text_color_active) ) {
			$elements[ liquid_implode( '%1$s.is-active .txt' ) ]['color'] = $trigger_text_color_active;
		}
		
		if( !empty( $shape_color ) ) {
			if( 'solid' === $trigger_fill ) {
				$elements[ liquid_implode( '%1$s.solid .bars:before' ) ]['background-color'] = $shape_color;
			} else if ( 'bordered' === $trigger_fill ) {
				$elements[ liquid_implode( '%1$s.bordered .bars' ) ]['border-color'] = $shape_color;				
			}
		}
		if( !empty( $shape_hover_color ) ) {
			if( 'solid' === $trigger_fill ) {
				$elements[ liquid_implode( '%1$s.solid:hover .bars:before' ) ]['background-color'] = $shape_hover_color;
			} else if ( 'bordered' === $trigger_fill ) {
				$elements[ liquid_implode( '%1$s.bordered:hover .bars' ) ]['border-color'] = $shape_hover_color;				
			}
		}
		if( !empty( $shape_active_color ) ) {
			if( 'solid' === $trigger_fill ) {
				$elements[ liquid_implode( '%1$s.solid.is-active .bars:before' ) ]['background-color'] = $shape_active_color;
			} else if ( 'bordered' === $trigger_fill ) {
				$elements[ liquid_implode( '%1$s.bordered.is-active .bars' ) ]['border-color'] = $shape_active_color;				
			}
		}

		// Sticky Colors
		if( ! empty($sticky_trigger_color) ) {
			
			if ( 'style-1' === $style ) {
				$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s .bar' ) ]['background'] = $sticky_trigger_color;
			} else if ( 'style-2' === $style ) {
				$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s.style-2 .bar:before, .is-stuck .lqd-head-col > .header-module > %1$s.style-2 .bar:after' ) ]['background'] = $sticky_trigger_color;
			} else {
				$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s .bar' ) ]['background'] = $sticky_trigger_color;
			}
			$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s' ) ]['color'] = $sticky_trigger_color;

		}
		if( ! empty($sticky_trigger_color_hover) ) {

			if ( 'style-1' === $style ) {
				$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s:hover .bar' ) ]['background'] = $sticky_trigger_color_hover;
			} else if ( 'style-2' === $style ) {
				$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s.style-2:hover .bar:before, .is-stuck .lqd-head-col > .header-module > %1$s.style-2:hover .bar:after' ) ]['background'] = $sticky_trigger_color_hover;
			} else {
				$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s:hover .bar' ) ]['background'] = $sticky_trigger_color_hover;
			}
			$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s:hover' ) ]['color'] = $sticky_trigger_color_hover;

		}
		if( ! empty($sticky_trigger_color_active) ) {

			if ( 'style-1' === $style ) {
				$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s.is-active .bar' ) ]['background'] = $sticky_trigger_color_active;
			} else if ( 'style-2' === $style ) {
				$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s.is-active .bar:before, .is-stuck .lqd-head-col > .header-module > %1$s.is-active .bar:after' ) ]['background'] = $sticky_trigger_color_active;
			} else {
				$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s.is-active .bar' ) ]['background'] = $sticky_trigger_color_active;
			}
			$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s.is-active' ) ]['color'] = $sticky_trigger_color_active;

		}
		if( ! empty($sticky_trigger_text_color) ) {
			$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s .txt' ) ]['color'] = $sticky_trigger_text_color;
		}
		if( ! empty($sticky_trigger_text_color_hover) ) {
			$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s:hover .txt' ) ]['color'] = $sticky_trigger_text_color_hover;
		}
		if( ! empty($sticky_trigger_text_color_active) ) {
			$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s.is-active .txt' ) ]['color'] = $sticky_trigger_text_color_active;
		}
		if( !empty( $sticky_shape_color ) ) {
			if( 'solid' === $trigger_fill ) {
				$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s.solid .bars:before' ) ]['background-color'] = $sticky_shape_color;
			} else if ( 'bordered' === $trigger_fill ) {
				$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s.bordered .bars' ) ]['border-color'] = $sticky_shape_color;				
			}
		}
		if( !empty( $sticky_shape_hover_color ) ) {
			if( 'solid' === $trigger_fill ) {
				$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s.solid:hover .bars:before' ) ]['background-color'] = $sticky_shape_hover_color;
			} else if ( 'bordered' === $trigger_fill ) {
				$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s.bordered:hover .bars' ) ]['border-color'] = $sticky_shape_hover_color;				
			}
		}
		if( !empty( $sticky_shape_active_color ) ) {
			if( 'solid' === $trigger_fill ) {
				$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s.solid.is-active .bars:before' ) ]['background-color'] = $sticky_shape_active_color;
			} else if ( 'bordered' === $trigger_fill ) {
				$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s.bordered.is-active .bars' ) ]['border-color'] = $sticky_shape_active_color;				
			}
		}

		// Sticky Over Light Rows
		if( ! empty($sticky_light_trigger_color) ) {
			
			if ( 'style-1' === $style ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s .bar' ) ]['background'] = $sticky_light_trigger_color;
			} else if ( 'style-2' === $style ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s.style-2 .bar:before, .lqd-head-col > .lqd-active-row-light.header-module > %1$s.style-2 .bar:after' ) ]['background'] = $sticky_light_trigger_color;
			} else {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s .bar' ) ]['background'] = $sticky_light_trigger_color;
			}
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s' ) ]['color'] = $sticky_light_trigger_color;

		}
		if( ! empty($sticky_light_trigger_color_hover) ) {

			if ( 'style-1' === $style ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s:hover .bar' ) ]['background'] = $sticky_light_trigger_color_hover;
			} else if ( 'style-2' === $style ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s.style-2:hover .bar:before, .lqd-head-col > .lqd-active-row-light.header-module > %1$s.style-2:hover .bar:after' ) ]['background'] = $sticky_light_trigger_color_hover;
			} else {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s:hover .bar' ) ]['background'] = $sticky_light_trigger_color_hover;
			}
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s:hover' ) ]['color'] = $sticky_light_trigger_color_hover;

		}
		if( ! empty($sticky_light_trigger_color_active) ) {

			if ( 'style-1' === $style ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s.is-active .bar' ) ]['background'] = $sticky_light_trigger_color_active;
			} else if ( 'style-2' === $style ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s.is-active .bar:before, .lqd-head-col > .lqd-active-row-light.header-module > %1$s.is-active .bar:after' ) ]['background'] = $sticky_light_trigger_color_active;
			} else {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s.is-active .bar' ) ]['background'] = $sticky_light_trigger_color_active;
			}
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s.is-active' ) ]['color'] = $sticky_light_trigger_color_active;

		}
		if( ! empty($sticky_light_trigger_text_color) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s .txt' ) ]['color'] = $sticky_light_trigger_text_color;
		}
		if( ! empty($sticky_light_trigger_text_color_hover) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s:hover .txt' ) ]['color'] = $sticky_light_trigger_text_color_hover;
		}
		if( ! empty($sticky_light_trigger_text_color_active) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s.is-active .txt' ) ]['color'] = $sticky_light_trigger_text_color_active;
		}
		if( !empty( $sticky_light_shape_color ) ) {
			if( 'solid' === $trigger_fill ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s.solid .bars:before' ) ]['background-color'] = $sticky_light_shape_color;
			} else if ( 'bordered' === $trigger_fill ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s.bordered .bars' ) ]['border-color'] = $sticky_light_shape_color;				
			}
		}
		if( !empty( $sticky_light_shape_hover_color ) ) {
			if( 'solid' === $trigger_fill ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s.solid:hover .bars:before' ) ]['background-color'] = $sticky_light_shape_hover_color;
			} else if ( 'bordered' === $trigger_fill ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s.bordered:hover .bars' ) ]['border-color'] = $sticky_light_shape_hover_color;				
			}
		}
		if( !empty( $sticky_light_shape_active_color ) ) {
			if( 'solid' === $trigger_fill ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s.solid.is-active .bars:before' ) ]['background-color'] = $sticky_light_shape_active_color;
			} else if ( 'bordered' === $trigger_fill ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s.bordered.is-active .bars' ) ]['border-color'] = $sticky_light_shape_active_color;				
			}
		}

		// Sticky Over Dark Rows
		if( ! empty($sticky_dark_trigger_color) ) {
			
			if ( 'style-1' === $style ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s .bar' ) ]['background'] = $sticky_dark_trigger_color;
			} else if ( 'style-2' === $style ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s.style-2 .bar:before, .lqd-head-col > .lqd-active-row-dark.header-module > %1$s.style-2 .bar:after' ) ]['background'] = $sticky_dark_trigger_color;
			} else {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s .bar' ) ]['background'] = $sticky_dark_trigger_color;
			}
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s' ) ]['color'] = $sticky_dark_trigger_color;

		}
		if( ! empty($sticky_dark_trigger_color_hover) ) {

			if ( 'style-1' === $style ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s:hover .bar' ) ]['background'] = $sticky_dark_trigger_color_hover;
			} else if ( 'style-2' === $style ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s.style-2:hover .bar:before, .lqd-head-col > .lqd-active-row-dark.header-module > %1$s.style-2:hover .bar:after' ) ]['background'] = $sticky_dark_trigger_color_hover;
			} else {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s:hover .bar' ) ]['background'] = $sticky_dark_trigger_color_hover;
			}
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s:hover' ) ]['color'] = $sticky_dark_trigger_color_hover;

		}
		if( ! empty($sticky_dark_trigger_color_active) ) {

			if ( 'style-1' === $style ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s.is-active .bar' ) ]['background'] = $sticky_dark_trigger_color_active;
			} else if ( 'style-2' === $style ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s.is-active .bar:before, .lqd-head-col > .lqd-active-row-dark.header-module > %1$s.is-active .bar:after' ) ]['background'] = $sticky_dark_trigger_color_active;
			} else {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s.is-active .bar' ) ]['background'] = $sticky_dark_trigger_color_active;
			}
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s.is-active' ) ]['color'] = $sticky_dark_trigger_color_active;

		}
		if( ! empty($sticky_dark_trigger_text_color) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s .txt' ) ]['color'] = $sticky_dark_trigger_text_color;
		}
		if( ! empty($sticky_dark_trigger_text_color_hover) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s:hover .txt' ) ]['color'] = $sticky_dark_trigger_text_color_hover;
		}
		if( ! empty($sticky_dark_trigger_text_color_active) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s.is-active .txt' ) ]['color'] = $sticky_dark_trigger_text_color_active;
		}
		if( !empty( $sticky_dark_shape_color ) ) {
			if( 'solid' === $trigger_fill ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s.solid .bars:before' ) ]['background-color'] = $sticky_dark_shape_color;
			} else if ( 'bordered' === $trigger_fill ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s.bordered .bars' ) ]['border-color'] = $sticky_dark_shape_color;				
			}
		}
		if( !empty( $sticky_dark_shape_hover_color ) ) {
			if( 'solid' === $trigger_fill ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s.solid:hover .bars:before' ) ]['background-color'] = $sticky_dark_shape_hover_color;
			} else if ( 'bordered' === $trigger_fill ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s.bordered:hover .bars' ) ]['border-color'] = $sticky_dark_shape_hover_color;				
			}
		}
		if( !empty( $sticky_dark_shape_active_color ) ) {
			if( 'solid' === $trigger_fill ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s.solid.is-active .bars:before' ) ]['background-color'] = $sticky_dark_shape_active_color;
			} else if ( 'bordered' === $trigger_fill ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s.bordered.is-active .bars' ) ]['border-color'] = $sticky_dark_shape_active_color;				
			}
		}

		$this->dynamic_css_parser( $id, $elements );

	}

}
new LD_Header_Trigger;