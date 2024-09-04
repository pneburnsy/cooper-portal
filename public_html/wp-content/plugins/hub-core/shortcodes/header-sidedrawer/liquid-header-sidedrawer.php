<?php
/**
* Shortcode Header Sidedrawer
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Header_Sidedrawer extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_header_sidedrawer';
		$this->title       = esc_html__( 'Side Drawer', 'landinghub-core' );
		$this->description = esc_html__( 'Add side drawer', 'landinghub-core' );
		$this->icon        = 'la la-star';
		$this->category    = esc_html__( 'Header Modules', 'landinghub-core' );
		$this->content_element = true;
		$this->is_container    = true;
		$this->show_settings_on_create = true;

		parent::__construct();

	}
	
	public function get_params() {

		$this->params = array(
			array(
				'type'        => 'textfield',
				'param_name'  => 'label',
				'heading'     => esc_html__( 'Text', 'landinghub-core' ),
				'description' => esc_html__(  'Add text', 'landinghub-core' ),
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'trigger_type',
				'heading' => esc_html__( 'Trigger type', 'landinghub-core' ),
				'description' => esc_html__( 'Select trigger type for side drawer', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Hover', 'landinghub-core' ) => 'hover',
					esc_html__( 'Click', 'landinghub-core' ) => 'click',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'liquid_button_set',
				'param_name'  => 'trigger_txt_position',
				'heading'     => esc_html__( 'Trigger Text Position' ),
				'description' => esc_html__( 'Select a the trigger text position', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Left', 'landinghub-core' ) => 'txt-left',
					esc_html__( 'Right', 'landinghub-core' ) => 'txt-right',
				),
				'dependency'  => array(
					'element' => 'label',
					'not_empty' => true,
				),
				'std' => 'txt-right',
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'drawer_pos',
				'heading' => esc_html__( 'Drawer Position', 'landinghub-core' ),
				'description' => esc_html__( 'Select drawer position.', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Right', 'landinghub-core' ) => 'ld-module-sd-right',
					esc_html__( 'Left', 'landinghub-core' ) => 'ld-module-sd-left',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'trigger_style',
				'heading' => esc_html__( 'Trigger style', 'landinghub-core' ),
				'description' => esc_html__( 'Select trigger style for side drawer', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Style 1', 'landinghub-core' ) => 'style-1',
					esc_html__( 'Style 2', 'landinghub-core' ) => 'style-2',
					esc_html__( 'Style 3', 'landinghub-core' ) => 'style-3',
					esc_html__( 'Style 4', 'landinghub-core' ) => 'style-4',
				),
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
				'type' => 'dropdown',
				'param_name' => 'justify_content',
				'heading' => esc_html__( 'Content Alignment', 'landinghub-core' ),
				'description' => esc_html__( 'Select the alignment for the contents inside the sidedrawer.', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Top', 'landinghub-core' )   => 'justify-content-start',
					esc_html__( 'Center', 'landinghub-core' )   => 'justify-content-center',
					esc_html__( 'Bottom', 'landinghub-core' )   => 'justify-content-end',
					esc_html__( 'Space Between', 'landinghub-core' )   => 'justify-content-between',
					esc_html__( 'Space Around', 'landinghub-core' )   => 'justify-content-around',
				),
				'std' => 'justify-content-center',
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'drawer_width',
				'heading'     => esc_html__( 'Drawer Width', 'landinghub-core' ),
				'description' => esc_html__(  'Add drawer width.', 'landinghub-core' ),
				'value'				=> '350px',
				'edit_field_class' => 'vc_col-sm-6',
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
					'element' => 'label',
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
					'element' => 'label',
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
					'element' => 'label',
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
					'element' => 'label',
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
					'element' => 'label',
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
					'element' => 'label',
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
					'element' => 'label',
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
					'element' => 'label',
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
					'element' => 'label',
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
					'element' => 'label',
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
					'element' => 'label',
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
					'element' => 'label',
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
	}
	
	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();

		if( ! empty($trigger_color) ) {
			
			if ( 'style-1' === $trigger_style ) {
				$elements[ liquid_implode( '%1$s .bar' ) ]['background'] = $trigger_color;
			} else if ( 'style-2' === $trigger_style ) {
				$elements[ liquid_implode( '%1$s.style-2 .bar:before, %1$s.style-2 .bar:after' ) ]['background'] = $trigger_color;
			} else {
				$elements[ liquid_implode( '%1$s .bar' ) ]['background'] = $trigger_color;
			}
			$elements[ liquid_implode( '%1$s' ) ]['color'] = $trigger_color;
			
		}
		
		if( ! empty($trigger_color_hover) ) {

			if ( 'style-1' === $trigger_style ) {
				$elements[ liquid_implode( '%1$s:hover .bar' ) ]['background'] = $trigger_color_hover;
			} else if ( 'style-2' === $trigger_style ) {
				$elements[ liquid_implode( '%1$s.style-2:hover .bar:before, %1$s.style-2:hover .bar:after' ) ]['background'] = $trigger_color_hover;
			} else {
				$elements[ liquid_implode( '%1$s:hover .bar' ) ]['background'] = $trigger_color_hover;
			}
			$elements[ liquid_implode( '%1$s:hover' ) ]['color'] = $trigger_color_hover;

		}

		if( ! empty($trigger_color_active) ) {

			if ( 'style-1' === $trigger_style ) {
				$elements[ liquid_implode( '%1$s.is-active .bar' ) ]['background'] = $trigger_color_active;
			} else if ( 'style-2' === $trigger_style ) {
				$elements[ liquid_implode( '%1$s.is-active .bar:before, %1$s.is-active .bar:after' ) ]['background'] = $trigger_color_active;
			} else {
				$elements[ liquid_implode( '%1$s.is-active .bar' ) ]['background'] = $trigger_color_active;
			}
			$elements[ liquid_implode( '%1$s.is-active' ) ]['color'] = $trigger_color_active;

		}

		if( ! empty($trigger_text_color) ) {
			$elements[ liquid_implode( '%1$s > .txt' ) ]['color'] = $trigger_text_color;
		}
		if( ! empty($trigger_text_color_hover) ) {
			$elements[ liquid_implode( '%1$s:hover > .txt' ) ]['color'] = $trigger_text_color_hover;
		}
		if( ! empty($trigger_text_color_active) ) {
			$elements[ liquid_implode( '%1$s.is-active > .txt' ) ]['color'] = $trigger_text_color_active;
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
			
			if ( 'style-1' === $trigger_style ) {
				$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s .bar' ) ]['background'] = $sticky_trigger_color;
			} else if ( 'style-2' === $trigger_style ) {
				$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s.style-2 .bar:before, .is-stuck .lqd-head-col > .header-module > %1$s.style-2 .bar:after' ) ]['background'] = $sticky_trigger_color;
			} else {
				$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s .bar' ) ]['background'] = $sticky_trigger_color;
			}
			$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s' ) ]['color'] = $sticky_trigger_color;

		}
		if( ! empty($sticky_trigger_color_hover) ) {

			if ( 'style-1' === $trigger_style ) {
				$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s:hover .bar' ) ]['background'] = $sticky_trigger_color_hover;
			} else if ( 'style-2' === $trigger_style ) {
				$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s.style-2:hover .bar:before, .is-stuck .lqd-head-col > .header-module > %1$s.style-2:hover .bar:after' ) ]['background'] = $sticky_trigger_color_hover;
			} else {
				$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s:hover .bar' ) ]['background'] = $sticky_trigger_color_hover;
			}
			$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s:hover' ) ]['color'] = $sticky_trigger_color_hover;

		}
		if( ! empty($sticky_trigger_color_active) ) {

			if ( 'style-1' === $trigger_style ) {
				$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s.is-active .bar' ) ]['background'] = $sticky_trigger_color_active;
			} else if ( 'style-2' === $trigger_style ) {
				$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s.is-active .bar:before, .is-stuck .lqd-head-col > .header-module > %1$s.is-active .bar:after' ) ]['background'] = $sticky_trigger_color_active;
			} else {
				$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s.is-active .bar' ) ]['background'] = $sticky_trigger_color_active;
			}
			$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s.is-active' ) ]['color'] = $sticky_trigger_color_active;

		}
		if( ! empty($sticky_trigger_text_color) ) {
			$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s > .txt' ) ]['color'] = $sticky_trigger_text_color;
		}
		if( ! empty($sticky_trigger_text_color_hover) ) {
			$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s:hover > .txt' ) ]['color'] = $sticky_trigger_text_color_hover;
		}
		if( ! empty($sticky_trigger_text_color_active) ) {
			$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s.is-active > .txt' ) ]['color'] = $sticky_trigger_text_color_active;
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
			
			if ( 'style-1' === $trigger_style ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s .bar' ) ]['background'] = $sticky_light_trigger_color;
			} else if ( 'style-2' === $trigger_style ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s.style-2 .bar:before, .lqd-head-col > .lqd-active-row-light.header-module > %1$s.style-2 .bar:after' ) ]['background'] = $sticky_light_trigger_color;
			} else {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s .bar' ) ]['background'] = $sticky_light_trigger_color;
			}
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s' ) ]['color'] = $sticky_light_trigger_color;

		}
		if( ! empty($sticky_light_trigger_color_hover) ) {

			if ( 'style-1' === $trigger_style ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s:hover .bar' ) ]['background'] = $sticky_light_trigger_color_hover;
			} else if ( 'style-2' === $trigger_style ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s.style-2:hover .bar:before, .lqd-head-col > .lqd-active-row-light.header-module > %1$s.style-2:hover .bar:after' ) ]['background'] = $sticky_light_trigger_color_hover;
			} else {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s:hover .bar' ) ]['background'] = $sticky_light_trigger_color_hover;
			}
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s:hover' ) ]['color'] = $sticky_light_trigger_color_hover;

		}
		if( ! empty($sticky_light_trigger_color_active) ) {

			if ( 'style-1' === $trigger_style ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s.is-active .bar' ) ]['background'] = $sticky_light_trigger_color_active;
			} else if ( 'style-2' === $trigger_style ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s.is-active .bar:before, .lqd-head-col > .lqd-active-row-light.header-module > %1$s.is-active .bar:after' ) ]['background'] = $sticky_light_trigger_color_active;
			} else {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s.is-active .bar' ) ]['background'] = $sticky_light_trigger_color_active;
			}
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s.is-active' ) ]['color'] = $sticky_light_trigger_color_active;

		}
		if( ! empty($sticky_light_trigger_text_color) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s > .txt' ) ]['color'] = $sticky_light_trigger_text_color;
		}
		if( ! empty($sticky_light_trigger_text_color_hover) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s:hover > .txt' ) ]['color'] = $sticky_light_trigger_text_color_hover;
		}
		if( ! empty($sticky_light_trigger_text_color_active) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s.is-active > .txt' ) ]['color'] = $sticky_light_trigger_text_color_active;
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
			
			if ( 'style-1' === $trigger_style ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s .bar' ) ]['background'] = $sticky_dark_trigger_color;
			} else if ( 'style-2' === $trigger_style ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s.style-2 .bar:before, .lqd-head-col > .lqd-active-row-dark.header-module > %1$s.style-2 .bar:after' ) ]['background'] = $sticky_dark_trigger_color;
			} else {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s .bar' ) ]['background'] = $sticky_dark_trigger_color;
			}
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s' ) ]['color'] = $sticky_dark_trigger_color;

		}
		if( ! empty($sticky_dark_trigger_color_hover) ) {

			if ( 'style-1' === $trigger_style ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s:hover .bar' ) ]['background'] = $sticky_dark_trigger_color_hover;
			} else if ( 'style-2' === $trigger_style ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s.style-2:hover .bar:before, .lqd-head-col > .lqd-active-row-dark.header-module > %1$s.style-2:hover .bar:after' ) ]['background'] = $sticky_dark_trigger_color_hover;
			} else {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s:hover .bar' ) ]['background'] = $sticky_dark_trigger_color_hover;
			}
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s:hover' ) ]['color'] = $sticky_dark_trigger_color_hover;

		}
		if( ! empty($sticky_dark_trigger_color_active) ) {

			if ( 'style-1' === $trigger_style ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s.is-active .bar' ) ]['background'] = $sticky_dark_trigger_color_active;
			} else if ( 'style-2' === $trigger_style ) {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s.is-active .bar:before, .lqd-head-col > .lqd-active-row-dark.header-module > %1$s.is-active .bar:after' ) ]['background'] = $sticky_dark_trigger_color_active;
			} else {
				$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s.is-active .bar' ) ]['background'] = $sticky_dark_trigger_color_active;
			}
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s.is-active' ) ]['color'] = $sticky_dark_trigger_color_active;

		}
		if( ! empty($sticky_dark_trigger_text_color) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s > .txt' ) ]['color'] = $sticky_dark_trigger_text_color;
		}
		if( ! empty($sticky_dark_trigger_text_color_hover) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s:hover > .txt' ) ]['color'] = $sticky_dark_trigger_text_color_hover;
		}
		if( ! empty($sticky_dark_trigger_text_color_active) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s.is-active > .txt' ) ]['color'] = $sticky_dark_trigger_text_color_active;
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

		if ( !empty( $drawer_width ) ) {
			$elements[ liquid_implode( '%1$s.ld-module-dropdown' ) ]['width'] = $drawer_width;				
		}

		$this->dynamic_css_parser( $id, $elements );

	}

}
new LD_Header_Sidedrawer;
class WPBakeryShortCode_LD_Header_Sidedrawer extends WPBakeryShortCodesContainer {}