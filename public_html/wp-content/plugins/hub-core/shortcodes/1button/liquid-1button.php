<?php
/**
* Custom Button Shortcode
*/

if( !defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/

class LD_Button extends LD_Shortcode {
	
	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_button';
		$this->title       = esc_html__( 'Button', 'landinghub-core' );
		$this->icon        = 'la la-play-circle';
		$this->show_settings_on_create        = true;
		$this->scripts      = array( 'jquery-fresco', 'lity', 'splittext' );
		$this->styles       = array( 'vc_font_awesome_5' ,'fresco' );
		$this->description = esc_html__( 'Create a custom button.', 'landinghub-core' );

		parent::__construct();
	}
	
	public function get_params() {
		
		
		$url = liquid_addons()->plugin_uri() . '/assets/img/sc-preview/button/';
		
		$icon_params = liquid_get_icon_params( true, '', 'all', array( 'align', 'color', 'hcolor' ), 'i_' );
		
		$icon_button_params = array(
			array(
				'type' => 'dropdown',
				'param_name' => 'i_position',
				'heading' => esc_html__( 'Icon Position', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Right', 'landinghub-core' )  => 'right',
					esc_html__( 'Left', 'landinghub-core' )   => 'left',
					esc_html__( 'Bottom', 'landinghub-core' ) => 'bottom',
					esc_html__( 'Top', 'landinghub-core' )    => 'top',
				),
				'dependency' => array(
					'element' => 'i_add_icon',
					'not_empty' => true
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'i_shape',
				'heading'    => esc_html__( 'Icon shape', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'None', 'landinghub-core' )       => '',
					esc_html__( 'Square', 'landinghub-core' )     => 'btn-icon-square',
					esc_html__( 'Semi Round', 'landinghub-core' ) => 'btn-icon-semi-round',
					esc_html__( 'Round', 'landinghub-core' )      => 'btn-icon-round',
					esc_html__( 'Circle', 'landinghub-core' )     => 'btn-icon-circle',
				),
				'dependency' => array(
					'element' => 'i_add_icon',
					'not_empty' => true
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'i_shape_style',
				'heading' => esc_html__( 'Icon shape style', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Default', 'landinghub-core' ) => '',
					esc_html__( 'Solid', 'landinghub-core' )    => 'btn-icon-solid',
					esc_html__( 'Bordered', 'landinghub-core' ) => 'btn-icon-bordered',
				),
				'dependency' => array(
					'element' => 'i_shape',
					'not_empty' => true
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'i_shape_bw',
				'heading' => esc_html__( 'Icon shape border width', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Default - 1px', 'landinghub-core' ) => '',
					esc_html__( '2px', 'landinghub-core' )    => 'btn-icon-border-thick',
					esc_html__( '3px', 'landinghub-core' ) => 'btn-icon-border-thicker',
					esc_html__( '4px', 'landinghub-core' ) => 'btn-icon-border-thickest',
				),
				'dependency' => array(
					'element' => 'i_shape_style',
					'value' => 'btn-icon-bordered'
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'i_shape_size',
				'heading'    => esc_html__( 'Icon Shape size', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Default', 'landinghub-core' )     => '',
					esc_html__( 'Extra Small', 'landinghub-core' ) => 'btn-icon-xsm',
					esc_html__( 'Small', 'landinghub-core' )       => 'btn-icon-sm',
					esc_html__( 'Medium', 'landinghub-core' )      => 'btn-icon-md',
					esc_html__( 'Large', 'landinghub-core' )       => 'btn-icon-lg',
					esc_html__( 'Extra Large', 'landinghub-core' ) => 'btn-icon-xlg',
					esc_html__( 'Custom Size', 'landinghub-core' ) => 'btn-icon-custom-size',
				),
				'dependency' => array(
					'element' => 'i_shape',
					'value' => array( 'btn-icon-square', 'btn-icon-semi-round', 'btn-icon-round', 'btn-icon-circle' ),
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'i_shape_custom_size',
				'heading'     => esc_html__( 'Icon shape custom size', 'landinghub-core' ),
				'description' => esc_html__( 'Add custom shape size with px. for ex. 30px', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'i_shape_size',
					'value'   => array( 'btn-icon-custom-size' ),
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'i_hover_reveal',
				'heading'    => esc_html__( 'Hover Effect', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Default', 'landinghub-core' )  => '',
					esc_html__( 'Reveal', 'landinghub-core' ) => 'btn-hover-reveal',
					esc_html__( 'Switch Position', 'landinghub-core' ) => 'btn-hover-swp',
				),
				'dependency' => array(
					'element' => 'i_add_icon',
					'not_empty' => true
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'i_ripple',
				'heading'    => esc_html__( 'Icon Ripple Effect', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'No', 'landinghub-core' )  => '',
					esc_html__( 'Yes', 'landinghub-core' ) => 'btn-icon-ripple',
				),
				'dependency' => array(
					'element' => 'i_shape',
					'value' => array( 'btn-icon-circle' ),
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			//Icon Box Shadow Options
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Enable icon box-shadow?', 'landinghub-core' ),
				'param_name'  => 'enable_icon_shadowbox',
				'description' => esc_html__( 'If checked, the icon box-shadow options will be visible', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'i_shape',
					'not_empty'   => true,
				),
			),
			array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Icon Shadow Box Options', 'landinghub-core' ),
				'param_name' => 'icon_box_shadow',
				'dependency' => array(
					'element' => 'enable_icon_shadowbox',
					'not_empty' => true,
				),
				'params' => array(
					array(
						'type'        => 'dropdown',
						'param_name'  => 'inset',
						'heading'     => esc_html__( 'Inset', 'landinghub-core' ),
						'description' => esc_html__(  'Select if it is inset', 'landinghub-core' ),
						'value'      => array(
							esc_html__( 'No', 'landinghub-core' )  => '',
							esc_html__( 'Yes', 'landinghub-core' ) => 'inset',
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'x_offset',
						'heading'     => esc_html__( 'Position X', 'landinghub-core' ),
						'description' => esc_html__(  'Set position X in px', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'y_offset',
						'heading'     => esc_html__( 'Position Y', 'landinghub-core' ),
						'description' => esc_html__(  'Set position Y in px', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'blur_radius',
						'heading'     => esc_html__( 'Blur Radius', 'landinghub-core' ),
						'description' => esc_html__(  'Add blur radius in px', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'spread_radius',
						'heading'     => esc_html__( 'Spread Radius', 'landinghub-core' ),
						'description' => esc_html__(  'Add spread radius in px', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'colorpicker',
						'param_name'  => 'shadow_color',
						'heading'     => esc_html__( 'Color', 'landinghub-core' ),
						'description' => esc_html__(  'Pick a color for shadow', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),

				)
			),
			array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Icon Shadow Box Options', 'landinghub-core' ),
				'param_name' => 'h_icon_box_shadow',
				'dependency' => array(
					'element' => 'enable_icon_shadowbox',
					'not_empty' => true,
				),
				'params' => array(
					array(
						'type'        => 'dropdown',
						'param_name'  => 'inset',
						'heading'     => esc_html__( 'Inset', 'landinghub-core' ),
						'description' => esc_html__(  'Select if it is inset', 'landinghub-core' ),
						'value'      => array(
							esc_html__( 'No', 'landinghub-core' )  => '',
							esc_html__( 'Yes', 'landinghub-core' ) => 'inset',
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'x_offset',
						'heading'     => esc_html__( 'Position X', 'landinghub-core' ),
						'description' => esc_html__(  'Set position X in px', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'y_offset',
						'heading'     => esc_html__( 'Position Y', 'landinghub-core' ),
						'description' => esc_html__(  'Set position Y in px', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'blur_radius',
						'heading'     => esc_html__( 'Blur Radius', 'landinghub-core' ),
						'description' => esc_html__(  'Add blur radius in px', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'spread_radius',
						'heading'     => esc_html__( 'Spread Radius', 'landinghub-core' ),
						'description' => esc_html__(  'Add spread radius in px', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'colorpicker',
						'param_name'  => 'shadow_color',
						'heading'     => esc_html__( 'Color', 'landinghub-core' ),
						'description' => esc_html__(  'Pick a color for shadow', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),

				)
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'i_separator',
				'heading'    => esc_html__( 'Add Separator', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'No', 'landinghub-core' )  => '',
					esc_html__( 'Yes', 'landinghub-core' ) => 'btn-icon-sep',
				),
				'dependency' => array(
					'element' => 'i_position',
					'value' => array( 'right', 'left' ),
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'       => 'subheading',
				'param_name' => 'margin_label',
				'heading'    => esc_html__( 'Icon Spacing', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'i_add_icon',
					'not_empty' => true
				),
			),
			array(
				'type' => 'textfield',
				'param_name' => 'i_margin_left',
				'heading' => esc_html__( 'Left Margin', 'landinghub-core' ),
				'description' => esc_html__( 'Left margin for icon. for ex. 30px', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'i_add_icon',
					'not_empty' => true
				),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'textfield',
				'param_name' => 'i_margin_right',
				'heading' => esc_html__( 'Right Margin', 'landinghub-core' ),
				'description' => esc_html__( 'Right margin for icon. for ex. 30px', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'i_add_icon',
					'not_empty' => true
				),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'textfield',
				'param_name' => 'i_margin_top',
				'heading' => esc_html__( 'Top Margin', 'landinghub-core' ),
				'description' => esc_html__( 'Top margin for icon. for ex. 30px', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'i_add_icon',
					'not_empty' => true
				),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'textfield',
				'param_name' => 'i_margin_bottom',
				'heading' => esc_html__( 'Bottom Margin', 'landinghub-core' ),
				'description' => esc_html__( 'Bottom margin for icon. for ex. 30px', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'i_add_icon',
					'not_empty' => true
				),
				'edit_field_class' => 'vc_col-sm-3',
			),

		);	

		$general_params = array(
			
		array(
				'type'       => 'select_preview',
				'param_name' => 'style',
				'heading'    => esc_html__( 'Style', 'landinghub-core' ),
				'value'      => array(

					array(
						'value' => 'btn-default',
						'label' => esc_html__( 'Bordered', 'landinghub-core' ),
						'image' => $url . 'bordered.svg'
					),
					array(
						'label' => esc_html__( 'Solid', 'landinghub-core' ),
						'value' => 'btn-solid',
						'image' => $url . 'solid.svg'
					),
					array(
						'label' => esc_html__( 'Text only', 'landinghub-core' ),
						'value' => 'btn-naked',
						'image' => $url . 'text-only.svg'
					),
					array(
						'label' => esc_html__( 'Underlined', 'landinghub-core' ),
						'value' => 'btn-underlined',
						'image' => $url . 'underlined.svg'
					),

				),
				'save_always' => true,
			),
		
			// Params goes here
			array(
				'type'        => 'textfield',
				'param_name'  => 'title',
				'heading'     => esc_html__( 'Text', 'landinghub-core' ),
				'value'       => esc_html__( '', 'landinghub-core' ),
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'transformation',
				'heading'    => esc_html__( 'Text transformation', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Default', 'landinghub-core' ) => '',
					esc_html__( 'Uppercase', 'landinghub-core' ) => 'text-uppercase',
					esc_html__( 'Capitalize', 'landinghub-core' ) => 'text-capitalize',
					esc_html__( 'Lowercase', 'landinghub-core' ) => 'text-lowercase',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'link_type', 
				'heading'     => esc_html__( 'Link Type', 'landinghub-core' ),
				'description' => esc_html__( 'Select a type of the link' ),
				'value' => array(
					esc_html__( 'Simple Click', 'one' )      => '',
					esc_html__( 'Lightbox', 'landinghub-core' )     => 'lightbox',
					esc_html__( 'Modal Window', 'landinghub-core' ) => 'modal_window',
					esc_html__( 'Local Scroll', 'landinghub-core' ) => 'local_scroll',
					esc_html__( 'Scroll to Section Bellow', 'landinghub-core' ) => 'scroll_to_section',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'image_caption',
				'heading'     => esc_html__( 'Image Caption', 'landinghub-core' ),
				'dependency'       => array(
					'element' => 'link_type',
					'value' => array( 'lightbox' ),
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'textfield',
				'param_name'       => 'scroll_speed',
				'heading'          => esc_html__( 'Scroll Speed', 'landinghub-core' ),
				'description'      => esc_html__( 'Add scroll speed in milliseconds', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'       => array(
					'element' => 'link_type',
					'value' => array( 'local_scroll', 'scroll_to_section' ),
				),
			),
			array(
				'type'             => 'textfield',
				'param_name'       => 'anchor_id',
				'heading'          => esc_html__( 'Element ID', 'landinghub-core' ),
				'description'      => esc_html__( 'Input the ID of the element to scroll, for ex. #Element_ID', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'       => array(
					'element' => 'link_type',
					'value' => array( 'local_scroll', 'modal_window' ),
				),
			),
			array(
				'id'               => 'link',
				'description'      => esc_html__( 'Add the link', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'       => array(
					'element' => 'link_type',
					'value_not_equal_to' => array( 'modal_window', 'local_scroll', 'scroll_to_section' ),
				),
			),
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_styling',
				'heading'    => esc_html__( 'Styling', 'landinghub-core' )
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'shape',
				'heading'    => esc_html__( 'Shape', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'None', 'landinghub-core' )    => '',
					esc_html__( 'Semi Round', 'landinghub-core' ) => 'semi-round',
					esc_html__( 'Round', 'landinghub-core' )      => 'round',
					esc_html__( 'Circle', 'landinghub-core' )     => 'circle'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to' => array( 'btn-naked', 'btn-underlined' ),
				),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'size',
				'heading'    => esc_html__( 'Size', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Default', 'landinghub-core' )     => '',
					esc_html__( 'Extra Small', 'landinghub-core' ) => 'btn-xsm',
					esc_html__( 'Small', 'landinghub-core' )       => 'btn-sm',
					esc_html__( 'Medium', 'landinghub-core' )      => 'btn-md',
					esc_html__( 'Large', 'landinghub-core' )       => 'btn-lg',
					esc_html__( 'Extra Large', 'landinghub-core' ) => 'btn-xlg',
					esc_html__( 'Custom', 'landinghub-core' )      => 'btn-custom',

				),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to' => array( 'btn-naked', 'btn-underlined' ),
				),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'custom_size',
				'heading'     => esc_html__( 'Custom Width', 'landinghub-core' ),
				'description' => esc_html__( 'Add custom width for button, in px.', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'size',
					'value'   => 'btn-custom'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'custom_height',
				'heading'     => esc_html__( 'Custom Height', 'landinghub-core' ),
				'description' => esc_html__( 'Add custom height for button, in px.', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'size',
					'value'   => 'btn-custom'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'border',
				'heading'    => esc_html__( 'Border Thickness', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Default - 1px', 'landinghub-core' ) => 'border-thin',
					esc_html__( '2px', 'landinghub-core' )   => 'border-thick',
					esc_html__( '3px', 'landinghub-core' ) => 'border-thicker',
					esc_html__( 'None - 0px', 'landinghub-core' ) => 'border-none',
				),
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to' => 'btn-naked',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'border_width',
				'heading'    => esc_html__( 'Border Width', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Default - 100%', 'landinghub-core' ) => '',
					esc_html__( '75%', 'landinghub-core' )   => 'btn-bw-75',
					esc_html__( '50%', 'landinghub-core' )   => 'btn-bw-50',
					esc_html__( '30%', 'landinghub-core' )   => 'btn-bw-30',
				),
				'dependency' => array(
					'element' => 'style',
					'value' => 'btn-underlined',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'liquid_button_set',
				'param_name' => 'width',
				'heading'    => esc_html__( 'Button Width', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Normal', 'landinghub-core' ) => '',
					esc_html__( 'Fullwidth', 'landinghub-core' )   => 'btn-block',
				),
				'dependency' => array(
					'element' => 'style',
					'value' => array( 'btn-solid', 'btn-default' ),
				),
				'std' => '',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'hover_txt_effect',
				'heading'    => esc_html__( 'Hover Text Effect', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'None', 'landinghub-core' )  => '',
					esc_html__( 'Hover Liquid X', 'landinghub-core' )     => 'btn-hover-txt-liquid-x',
					esc_html__( 'Hover Liquid X Alt', 'landinghub-core' ) => 'btn-hover-txt-liquid-x-alt',
					esc_html__( 'Hover Liquid Y', 'landinghub-core' )     => 'btn-hover-txt-liquid-y',
					esc_html__( 'Hover Liquid Y Alt', 'landinghub-core' ) => 'btn-hover-txt-liquid-y-alt',
					
					esc_html__( 'Hover Switch X', 'landinghub-core' ) => 'btn-hover-txt-switch btn-hover-txt-switch-x',
					esc_html__( 'Hover Switch Y ', 'landinghub-core' ) => 'btn-hover-txt-switch btn-hover-txt-switch-y',
					
					esc_html__( 'Hover Marquee X', 'landinghub-core' ) => 'btn-hover-txt-marquee btn-hover-txt-marquee-x',
					esc_html__( 'Hover Marquee Y', 'landinghub-core' ) => 'btn-hover-txt-marquee btn-hover-txt-marquee-y',

					esc_html__( 'Hover Change Text ', 'landinghub-core' ) => 'btn-hover-txt-switch-change btn-hover-txt-switch btn-hover-txt-switch-y',
					
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'title_secondary',
				'heading'     => esc_html__( 'Text', 'landinghub-core' ),
				'value'       => esc_html__( '', 'landinghub-core' ),
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'hover_txt_effect',
					'value' => 'btn-hover-txt-switch-change btn-hover-txt-switch btn-hover-txt-switch-y'
				),
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'icon_options',
				'heading'    => esc_html__( 'Icon', 'landinghub-core' ),
			),

		);
			
		$styling_params = array (
			
			//Group Design Options
			array(
				'type'        => 'css_editor',
				'param_name'  => 'css',
				'description' => '',
				'heading'     => esc_html__( 'CSS Box', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
			),
			array(
				'type'             => 'liquid_colorpicker',
				'param_name'       => 'color',
				'only_solid'       => true,
				'heading'          => esc_html__( 'Primary Color', 'landinghub-core' ),
				'description'      => esc_html__( 'Background color', 'landinghub-core' ),
				'group'            => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_column-with-padding  vc_col-sm-6',
			),
			array(
				'type'             => 'liquid_colorpicker',
				'param_name'       => 'color2',
				'only_solid'       => true,
				'heading'          => esc_html__( 'Secondary Color', 'landinghub-core' ),
				'description'      => esc_html__( 'Background secondary color, will create gradient effect', 'landinghub-core' ),
				'group'            => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'hover_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Primary Hover Color', 'landinghub-core' ),
				'description' => esc_html__( 'Hover state background color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'hover_color2',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Secondary Hover Color', 'landinghub-core' ),
				'description' => esc_html__( 'Hover state background secondary color, will create gradient effect', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'i_color',
				'heading'     => esc_html__( 'Icon color', 'landinghub-core' ),
				'description' => esc_html__( 'Select icon color.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'i_add_icon',
					'not_empty' => true
				),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'i_hcolor',
				'heading'     => esc_html__( 'Icon hover color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick icon hover color.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'i_add_icon',
					'not_empty' => true
				),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'i_fill_color',
				'heading'     => esc_html__( 'Icon Fill color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick icon fill color.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'i_shape_style',
					'value'   => array( 'btn-icon-solid' ),
				),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'i_fill_hcolor',
				'heading'     => esc_html__( 'Icon Hover Fill color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick icon hover fill color.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'i_shape_style',
					'value'   => array( 'btn-icon-solid' ),
				),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
			),
			
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'i_fill_color2',
				'heading'     => esc_html__( 'Icon Fill color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick icon fill color.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'i_shape_style',
					'value'   => array( 'btn-icon-bordered' ),
				),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'i_fill_hcolor2',
				'heading'     => esc_html__( 'Icon Hover Fill color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick icon hover fill color.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'i_shape_style',
					'value'   => array( 'btn-icon-bordered' ),
				),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
			),
			
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'i_separator_color',
				'heading'     => esc_html__( 'Icon Separator color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'i_separator',
					'value'   => array( 'btn-icon-sep' ),
				),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'i_separator_hcolor',
				'heading'     => esc_html__( 'Icon Hover Separator color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'i_separator',
					'value'   => array( 'btn-icon-sep' ),
				),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
			),
			
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_label',
				'heading'    => esc_html__( 'Label', 'landinghub-core' ),
				'group'      => esc_html__( 'Design Options', 'landinghub-core' ),
			),
			array(
				'type'       => 'liquid_colorpicker',
				'param_name' => 'text_color',
				'only_solid'  => true,
				'heading'    => esc_html__( 'Label Color', 'landinghub-core' ),
				'group'      => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to' => 'btn-underlined',
				),
			),
			array(
				'type'       => 'liquid_colorpicker',
				'param_name' => 'htext_color',
				'only_solid'  => true,
				'heading'    => esc_html__( 'Label Hover Color', 'landinghub-core' ),
				'group'      => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to' => 'btn-underlined',
				),
			),
			array(
				'type'        => 'responsive_textfield',
				'param_name'  => 'fs',
				'heading'     => esc_html__( 'Font Size', 'landinghub-core' ),
				'description' => esc_html__( 'Example: 20px', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type'        => 'responsive_textfield',
				'param_name'  => 'lh',
				'heading'     => esc_html__( 'Line-Height', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type'        => 'responsive_textfield',
				'param_name'  => 'fw',
				'heading'     => esc_html__( 'Font Weight', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type'        => 'responsive_textfield',
				'param_name'  => 'ls',
				'heading'     => esc_html__( 'Letter Spacing', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_border',
				'heading'    => esc_html__( 'Border', 'landinghub-core' ),
				'group'      => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to' => 'btn-naked',
				),
			),
			array(
				'type'       => 'liquid_colorpicker',
				'param_name' => 'b_color',
				'only_solid'  => true,
				'heading'    => 'Border Color',
				'group'      => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to' => array( 'btn-naked', 'btn-default' ),
				),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'b_color2',
				'heading'     => 'Border Color 2',
				'only_solid'  => true,
				'description' => esc_html__( 'Border color 2, will create gradient effect', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to' => array( 'btn-naked', 'btn-default' ),
				),
			),
			array(
				'type'       => 'liquid_colorpicker',
				'param_name' => 'h_b_color',
				'only_solid'  => true,
				'heading'    => 'Hover Border Color',
				'group'      => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to' => 'btn-naked',
				),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'h_b_color2',
				'only_solid'  => true,
				'heading'     => 'Hover Border Color 2',
				'description' => esc_html__( 'Hover Border color 2, will create gradient effect', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to' => 'btn-naked',
				),
			),
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_shadowbox',
				'heading'    => esc_html__( 'Box-shadow', 'landinghub-core' ),
				'group'      => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to' => array( 'btn-naked', 'btn-underlined' ),
				),
			),

			//Box Shadow Options
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Enable box-shadow?', 'landinghub-core' ),
				'param_name'  => 'enable_row_shadowbox',
				'description' => esc_html__( 'If checked, the box-shadow options will be visible', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to' => array( 'btn-naked', 'btn-underlined' ),
				),
			),
			array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Shadow Box Options', 'landinghub-core' ),
				'param_name' => 'button_box_shadow',
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_row_shadowbox',
					'not_empty' => true,
				),
				'params' => array(
					array(
						'type'        => 'dropdown',
						'param_name'  => 'inset',
						'heading'     => esc_html__( 'Inset', 'landinghub-core' ),
						'description' => esc_html__(  'Select if it is inset', 'landinghub-core' ),
						'value'      => array(
							esc_html__( 'No', 'landinghub-core' )  => '',
							esc_html__( 'Yes', 'landinghub-core' ) => 'inset',
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'x_offset',
						'heading'     => esc_html__( 'Position X', 'landinghub-core' ),
						'description' => esc_html__(  'Set position X in px', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'y_offset',
						'heading'     => esc_html__( 'Position Y', 'landinghub-core' ),
						'description' => esc_html__(  'Set position Y in px', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'blur_radius',
						'heading'     => esc_html__( 'Blur Radius', 'landinghub-core' ),
						'description' => esc_html__(  'Add blur radius in px', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'spread_radius',
						'heading'     => esc_html__( 'Spread Radius', 'landinghub-core' ),
						'description' => esc_html__(  'Add spread radius in px', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'colorpicker',
						'param_name'  => 'shadow_color',
						'heading'     => esc_html__( 'Color', 'landinghub-core' ),
						'description' => esc_html__(  'Pick a color for shadow', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
				)
			),

			//Hover state box-shadow
			array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Hover Shadow Box Options', 'landinghub-core' ),
				'param_name' => 'hover_button_box_shadow',
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_row_shadowbox',
					'not_empty' => true,
				),
				'params' => array(
					array(
						'type'        => 'dropdown',
						'param_name'  => 'inset',
						'heading'     => esc_html__( 'Inset', 'landinghub-core' ),
						'description' => esc_html__(  'Select if it is inset', 'landinghub-core' ),
						'value'      => array(
							esc_html__( 'No', 'landinghub-core' )  => '',
							esc_html__( 'Yes', 'landinghub-core' ) => 'inset',
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'x_offset',
						'heading'     => esc_html__( 'Position X', 'landinghub-core' ),
						'description' => esc_html__(  'Set position X in px', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'y_offset',
						'heading'     => esc_html__( 'Position Y', 'landinghub-core' ),
						'description' => esc_html__(  'Set position Y in px', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'blur_radius',
						'heading'     => esc_html__( 'Blur Radius', 'landinghub-core' ),
						'description' => esc_html__(  'Add blur radius in px', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'spread_radius',
						'heading'     => esc_html__( 'Spread Radius', 'landinghub-core' ),
						'description' => esc_html__(  'Add spread radius in px', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'colorpicker',
						'param_name'  => 'shadow_color',
						'heading'     => esc_html__( 'Color', 'landinghub-core' ),
						'description' => esc_html__(  'Pick a color for shadow', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
				)
			),
		);
		
		$this->params = array_merge( $general_params,  $icon_params, $icon_button_params, $styling_params  );

		$this->add_extras();
		
	}

	protected function get_size() {
		
		$size = $this->atts['size'];
		
		if( empty( $size ) ) {
			return '';
		}
		
		return $size;
	}

	protected function get_shape() {
		
		$shape = $this->atts['shape'];
		
		if( empty( $shape ) ) {
			return '';
		}
		
		return $shape;
	}	
	
	protected function get_border() {
		
		if( 'btn-naked' == $this->atts['style'] ) {
			return;
		}

		$border = $this->atts['border'];

		if ( 'btn-solid' == $this->atts['style'] || 'btn-underlined' == $this->atts['style'] ) {
			return $border;	
		}
		
		return "btn-bordered $border";	
	}
	
	protected function get_width() {
		
		
		if( 'btn-naked' === $this->atts['style'] || 'btn-underlined' === $this->atts['style'] ) {
			return;
		}

		$width = $this->atts['width'];
		
		return "$width";	
	}
	
	protected function get_hover_text_opts() {
		
		$effect = $this->atts['hover_txt_effect'];
		if( empty( $effect ) ) {
			return;
		}

		$out = '';
		
		switch( $effect ) {
			
			case 'btn-hover-txt-liquid-x':
			default:
				
				$out = 'data-split-text="true"
					    data-split-options=\'{"type": "chars, words"}\'';
			break;
			
			case 'btn-hover-txt-liquid-x-alt':
				
				$out = 'data-split-text="true"
					    data-split-options=\'{"type": "chars, words"}\'';

			break;
			
			case 'btn-hover-txt-liquid-y':
				
				$out = 'data-split-text="true"
					    data-split-options=\'{"type": "chars, words"}\'';
			break;

			case 'btn-hover-txt-liquid-y-alt':
				
				$out = 'data-split-text="true"
				        data-split-options=\'{"type": "chars, words"}\'';
			break;

		}

		echo $out;

	}	
	
	protected function get_gradient() {
		
		$color  = $this->atts['color2'];
		$color2 = $this->atts['hover_color2'];

		// if( empty( $color ) || empty( $color2 ) ) {
		if( empty( $color ) ) {
			return;
		}
		
		return 'btn-gradient';
		
	}
	
	protected function get_gradient_bg() {
		
		extract( $this->atts );
		
		if( empty( $color ) || empty( $color2 ) || 'btn-default' === $style || 'btn-naked' === $style || 'btn-underlined' === $style ) {
			return;
		}
		
		echo '<span class="btn-gradient-bg"></span>';
		
	}

	protected function get_gradient_hover_bg() {

		extract( $this->atts );
		
		if( ( empty( $hover_color2 ) && empty( $color2 ) ) || 'btn-naked' === $style || 'btn-underlined' === $style ) {
			return;
		}
		
		echo '<span class="btn-gradient-bg btn-gradient-bg-hover"></span>';
		
	}
	
	protected function get_gradient_hover_icon_bg() {

		extract( $this->atts );
		
		if( 'btn-icon-solid' === $i_shape_style && !empty( $hover_color2 ) && 'btn-naked' === $style || 
			'btn-icon-solid' === $i_shape_style && !empty( $hover_color2 ) && 'btn-underlined' === $style ) 
		{
			return '<span class="btn-gradient-bg btn-gradient-bg-hover"></span>';	
		}

	}
	
	protected function get_gradient_border() {

		$color  = $this->atts['b_color2'];
		$color2 = $this->atts['h_b_color2'];
		
		if( empty( $color ) && empty( $color2 ) ) {
			return;
		}
		
		return 'btn-bordered-gradient';

	}
	
	protected function get_custom_size_classname() {
		
		if( !empty( $this->atts['custom_size'] ) || !empty( $this->atts['custom_height'] ) ) {
			
			return 'btn-custom-sized';
		}

	}
	
	protected function get_border_svg() {
		
		extract( $this->atts );

		$border_color  = $b_color2;
		$border_color2 = $h_b_color2;
		
		$rx = $ry = 0;
		
		if( 'semi-round' === $shape ) {
			$rx = $ry = '2px';
		}
		elseif( 'round' === $shape ) {
			$rx = $ry = '4px';
		}
		elseif( 'circle' === $shape ) {
			$rx = '17%';
			$ry = '50%';
		}
		if( !empty( $custom_height ) ) {
			$rx = (int)$custom_height / 2 . 'px';
			$ry = (int)$custom_height / 2 . 'px';
		}
		
		if( ( empty( $color2 ) && empty( $hover_color2 ) ) || 'btn-naked' === $style || 'btn-underlined' === $style || 'border-none' === $border ) {
			return;
		}

		$out = '';
		$svg_id = uniqid('svg-border-');
		$out .= '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" class="btn-gradient-border" width="100%" height="100%">
			      <defs>
			        <linearGradient id="' . $svg_id . '" x1="0%" y1="0%" x2="100%" y2="0%">
			          <stop offset="0%" />
			          <stop offset="100%" />
			        </linearGradient>
			      </defs>
			      <rect x="0.5" y="0.5" rx="' . esc_attr( $rx ) . '" ry="' . esc_attr( $ry ) . '" width="100%" height="100%" stroke="url(#' . $svg_id . ')"/>
			    </svg>';

		echo $out;

	}

	protected function get_icon_pos() {
		
		$pos = $this->atts['i_position'];
			
		if( empty( $pos ) ) {
			return;
		}
				
		$hash = array(
			'right'  => '',
			'left'   => 'btn-icon-left',
			'bottom' => 'btn-icon-block',
			'top'    => 'btn-icon-block btn-icon-top',	
		);

		return $hash[ $pos ];

	}

	protected function if_lightbox() {

		if( 'lightbox' !== $this->atts['link_type'] ) {
			return '';
		}

		return 'fresco';

	}

	public function generate_css() {
		
		extract( $this->atts );
		
		$elements     = array();
		$parent       = isset( $this->parent_selector ) ? $this->parent_selector . ' ' : '';
		if( !empty( $el_id ) ) {
			$id = '#' . $el_id;	
		}
		else {
			$id = '.' . $this->get_id();
		}
		$parent_hover = isset( $this->parent_selector ) ? $this->parent_selector . ':hover ' . $id : '';
		
		$gradient_border_start = '#svg-' . $this->get_id() . ' .btn-gradient-border defs stop:first-child';
		$gradient_border_stop  = '#svg-' . $this->get_id() . ' .btn-gradient-border defs stop:last-child';

		$button_box_shadow = vc_param_group_parse_atts( $button_box_shadow );
		$hover_button_box_shadow = vc_param_group_parse_atts( $hover_button_box_shadow );
		$icon_box_shadow = vc_param_group_parse_atts( $icon_box_shadow );
		$h_icon_box_shadow = vc_param_group_parse_atts( $h_icon_box_shadow );
		
		if( !empty( $color ) && isset( $color ) ) {
			$elements[liquid_implode( '%1$s.btn-icon-solid .btn-icon' )]['background'] = $color;
			$elements[liquid_implode( '%1$s.btn-icon-circle.btn-icon-ripple .btn-icon:before' )]['border-color'] = $color;
		}
		if( !empty( $hover_color ) && isset( $hover_color ) && empty( $hover_color2 ) ) {
			$elements[liquid_implode( '%1$s.btn-icon-solid:hover .btn-icon' )]['background'] = $hover_color;
		}
		
		//Icon styling 
		if( !empty( $i_color ) ) {
			$elements[liquid_implode( '%1$s .btn-icon' )]['color'] = $i_color;
		}
		if( !empty( $i_size ) ) {
			$elements[liquid_implode( '%1$s .btn-icon' )]['font-size'] = $i_size;
		}
		if( !empty( $i_hcolor ) ) {
			$elements[liquid_implode( '%1$s:hover .btn-icon' )]['color'] = $i_hcolor;
		}
		if( !empty( $i_fill_color ) ) {
			$elements[liquid_implode( '%1$s.btn-icon-solid .btn-icon' )]['background'] = $i_fill_color;
		}
		if( !empty( $i_fill_hcolor ) ) {
			$elements[liquid_implode( '%1$s.btn-icon-solid:hover .btn-icon' )]['background'] = $i_fill_hcolor;
		}
		if( !empty( $i_fill_color2 ) ) {
			$elements[liquid_implode( '%1$s.btn-icon-bordered .btn-icon' )]['border-color'] = $i_fill_color2;
		}
		if( !empty( $i_fill_hcolor2 ) ) {
			$elements[liquid_implode( '%1$s.btn-icon-bordered:hover .btn-icon' )]['border-color'] = $i_fill_hcolor2;
			$elements[liquid_implode( '%1$s.btn-icon-bordered:hover .btn-icon' )]['background-color'] = $i_fill_hcolor2;
		}
		if( !empty( $i_margin_left ) ) {
			$elements[liquid_implode( '%1$s .btn-icon' )]['margin-inline-start'] = $i_margin_left . ' !important';
		}
		if( !empty( $i_margin_right ) ) {
			$elements[liquid_implode( '%1$s .btn-icon' )]['margin-inline-end'] = $i_margin_right . ' !important';
		}
		if( !empty( $i_margin_top ) ) {
			$elements[liquid_implode( '%1$s .btn-icon' )]['margin-top'] = $i_margin_top . ' !important';
		}
		if( !empty( $i_margin_bottom ) ) {
			$elements[liquid_implode( '%1$s .btn-icon' )]['margin-bottom'] = $i_margin_bottom . ' !important';
		}
		if( !empty( $i_shape_custom_size ) ) {
			$elements[liquid_implode( '%1$s .btn-icon' )]['width'] = $i_shape_custom_size . ' !important';
			$elements[liquid_implode( '%1$s .btn-icon' )]['height'] = $i_shape_custom_size . ' !important';
		}
		
		//Button Custom Size
		if( !empty( $custom_size ) ) {
			$elements[liquid_implode( '%1$s' )]['width'] = $custom_size;
		}
		if( !empty( $custom_height ) ) {
			$elements[liquid_implode( '%1$s' )]['height'] = $custom_height;
		}
		
		
		if( 'btn-default' === $style ) {
			
			if( ! empty( $color ) && isset( $color ) ) {
				$elements[liquid_implode( '%1$s' )]['color'] = $color;
				$elements[liquid_implode( '%1$s' )]['border-color'] = $color;
				$elements[liquid_implode( '%1$s:hover' )]['background-color'] = $color;
			}
			if( ! empty( $hover_color ) && isset( $hover_color ) ) {
				$elements[liquid_implode( array( $parent_hover, '%1$s:hover' ) )]['background-color'] = $hover_color;
				$elements[liquid_implode( array( $parent_hover, '%1$s:hover' ) )]['border-color'] = $hover_color;
			}
			if( ! empty( $hover_color ) && ! empty( $hover_color2 ) ) {
				$elements[liquid_implode( array( '%1$s .btn-gradient-bg-hover' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $hover_color ) . ' 0%, ' . esc_attr( $hover_color2 ) . ' 100%)';
			} elseif ( empty( $hover_color2 ) && ! empty( $hover_color ) ) {
				$elements[liquid_implode( array( '%1$s .btn-gradient-bg-hover' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $hover_color ) . ' 0%, ' . esc_attr( $hover_color ) . ' 100%)';
			} elseif ( ! empty( $color ) && ! empty( $color2 ) && empty( $hover_color ) && empty( $hover_color_2 ) ) {
				$elements[liquid_implode( array( '%1$s .btn-gradient-bg-hover' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $color ) . ' 0%, ' . esc_attr( $color2 ) . ' 100%)';
			}
			//Button gradient border colors
			if( ! empty( $color ) && ! empty( $color2 ) ) {
				$elements[ liquid_implode( array( '%1$s .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $color;
				$elements[ liquid_implode( array( '%1$s .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $color2;
			}
			if( ! empty( $h_b_color ) && ! empty( $h_b_color2 ) ) { 
				$elements[ liquid_implode( array( '%1$s:hover .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $h_b_color;
				$elements[ liquid_implode( array( '%1$s:hover .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $h_b_color2;
			} elseif( ! empty( $hover_color ) && ! empty( $hover_color2 ) ) { 
				$elements[ liquid_implode( array( '%1$s:hover .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $hover_color;
				$elements[ liquid_implode( array( '%1$s:hover .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $hover_color2;
			}elseif ( ! empty($hover_color) && empty($hover_color2) ) {
				$elements[ liquid_implode( array( '%1$s:hover .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $hover_color;
				$elements[ liquid_implode( array( '%1$s:hover .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $hover_color;
			}
			
		}
		elseif( 'btn-solid' === $style ) {
			if( ! empty( $color ) && isset( $color ) ) {
				$elements[liquid_implode( '%1$s' )]['background-color'] = $color;
				$elements[liquid_implode( '%1$s' )]['border-color'] = $color;
			}
			if( ! empty( $hover_color ) && isset( $hover_color ) ) {
				$elements[liquid_implode( array( $parent_hover, '%1$s:hover' ) )]['background-color'] = $hover_color;
				$elements[liquid_implode( array( $parent_hover, '%1$s:hover' ) )]['border-color'] = $hover_color;
			}			
			if( ! empty( $color ) && ! empty( $color2 ) ) {
				$elements[liquid_implode( array( '%1$s .btn-gradient-bg' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $color ) . ' 0%, ' . esc_attr( $color2 ) . ' 100%)';
			}
			if( ! empty( $hover_color ) && ! empty( $hover_color2 ) ) {
				$elements[liquid_implode( array( '%1$s .btn-gradient-bg-hover' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $hover_color ) . ' 0%, ' . esc_attr( $hover_color2 ) . ' 100%)';
			} elseif ( empty( $hover_color2 ) && ! empty( $hover_color ) ) {
				$elements[liquid_implode( array( '%1$s .btn-gradient-bg-hover' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $hover_color ) . ' 0%, ' . esc_attr( $hover_color ) . ' 100%)';
			}
			//Button gradient border colors
			if( ! empty( $color ) && ! empty( $color2 ) ) {
				$elements[ liquid_implode( array( '%1$s .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $color;
				$elements[ liquid_implode( array( '%1$s .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $color2;
			} elseif ( ! empty( $color ) && empty( $color2 ) ) {
				$elements[ liquid_implode( array( '%1$s .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $color;
				$elements[ liquid_implode( array( '%1$s .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $color;
			}

			if( ! empty( $b_color ) && ! empty( $b_color2 ) ) {
				$elements[ liquid_implode( array( '%1$s .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $b_color;
				$elements[ liquid_implode( array( '%1$s .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $b_color2;
			} elseif( ! empty( $b_color ) && empty( $b_color2 ) ) {
				$elements[ liquid_implode( array( '%1$s .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $b_color;
				$elements[ liquid_implode( array( '%1$s .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $b_color;
			} 

			if( ! empty( $h_b_color ) && ! empty( $h_b_color2 ) ) { 
				$elements[ liquid_implode( array( '%1$s:hover .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $h_b_color;
				$elements[ liquid_implode( array( '%1$s:hover .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $h_b_color2;
			} elseif( ! empty( $hover_color ) && ! empty( $hover_color2 ) ) { 
				$elements[ liquid_implode( array( '%1$s:hover .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $hover_color;
				$elements[ liquid_implode( array( '%1$s:hover .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $hover_color2;
			} elseif ( ! empty($hover_color) && empty($hover_color2) ) {
				$elements[ liquid_implode( array( '%1$s:hover .btn-gradient-border defs stop:first-child' ) )]['stop-color'] = $hover_color;
				$elements[ liquid_implode( array( '%1$s:hover .btn-gradient-border defs stop:last-child' ) )]['stop-color'] = $hover_color;
			}
		} elseif ( 'btn-naked' === $style || 'btn-underlined' === $style ) {

			if( ! empty( $color ) && isset( $color ) ) {
				$elements[liquid_implode( '%1$s' )]['color'] = $color;
			}

			if( ! empty( $hover_color ) && isset( $hover_color ) ) {
				$elements[liquid_implode( array( $parent_hover, '%1$s:hover' ) )]['color'] = $hover_color;
			}

			if ( ! empty( $color ) && ! empty( $color2 ) ) {
				$elements[liquid_implode( array( '%1$s .btn-txt' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $color ) . ' 0%, ' . esc_attr( $color2 ) . ' 100%)';
				$elements[liquid_implode( array( '%1$s.btn-icon-solid .btn-icon' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $color ) . ' 0%, ' . esc_attr( $color2 ) . ' 100%)';
				$elements[liquid_implode( array( '%1$s:not(.btn-icon-solid) .btn-icon i' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $color ) . ' 0%, ' . esc_attr( $color2 ) . ' 100%)';
			}
			
			if ( !empty( $hover_color ) && !empty( $hover_color2 ) ) {
				$elements[liquid_implode( array( '%1$s:hover .btn-txt' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $hover_color ) . ' 0%, ' . esc_attr( $hover_color2 ) . ' 100%)';
				$elements[liquid_implode( array( '%1$s:hover:not(.btn-icon-solid) .btn-icon i' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $hover_color ) . ' 0%, ' . esc_attr( $hover_color2 ) . ' 100%)';
				$elements[liquid_implode( array( '%1$s.btn-icon-solid .btn-icon .btn-gradient-bg-hover' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $hover_color ) . ' 0%, ' . esc_attr( $hover_color2 ) . ' 100%)';
			} 
			elseif ( !empty( $color2 ) && !empty( $hover_color ) && empty( $hover_color2 ) ) {
				$elements[liquid_implode( array( '%1$s:hover .btn-txt' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $hover_color ) . ' 0%, ' . esc_attr( $hover_color ) . ' 100%)';
				$elements[liquid_implode( array( '%1$s:hover:not(.btn-icon-solid) .btn-icon i' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $hover_color ) . ' 0%, ' . esc_attr( $hover_color ) . ' 100%)';
				$elements[liquid_implode( array( '%1$s.btn-icon-solid:hover .btn-icon' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $hover_color ) . ' 0%, ' . esc_attr( $hover_color ) . ' 100%)';
			}

			if ( !empty($text_color) && isset($text_color) ) {
				$elements[liquid_implode( '%1$s' )]['color'] = $text_color;
			}

			if ( !empty($htext_color) && isset($htext_color) ) {
				$elements[liquid_implode( '%1$s:hover' )]['color'] = $htext_color;
			}

		}

		if ( 'btn-underlined' === $style ) {

			if ( ! empty( $color ) && isset( $color ) ) {
				$elements[liquid_implode( array( '%1$s:before' ) )]['background'] = $color;
			}

			if ( ! empty( $hover_color ) && isset( $hover_color ) ) {
				$elements[liquid_implode( array( '%1$s:after' ) )]['background'] = $hover_color;
			}

			if ( ! empty( $color ) && ! empty( $color2 ) ) {
				$elements[liquid_implode( array( '%1$s:before' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $color ) . ' 0%, ' . esc_attr( $color2 ) . ' 100%)';
			}

			if ( ! empty( $hover_color ) && ! empty( $hover_color2 ) ) {
				$elements[liquid_implode( array( '%1$s:after' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $hover_color ) . ' 0%, ' . esc_attr( $hover_color2 ) . ' 100%)';
			}

			if ( ! empty( $b_color ) ) {
				$elements[liquid_implode( array( '%1$s:before' ) )]['background'] = $b_color;
			}

			if ( ! empty( $b_color ) && ! empty( $b_color2 ) ) {
				$elements[liquid_implode( array( '%1$s:before' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $b_color ) . ' 0%, ' . esc_attr( $b_color2 ) . ' 100%)';
			}

			if ( ! empty( $h_b_color ) ) {
				$elements[liquid_implode( array( '%1$s:after' ) )]['background'] = $h_b_color;
			}

			if ( ! empty( $h_b_color ) && ! empty( $h_b_color2 ) ) {
				$elements[liquid_implode( array( '%1$s:after' ) )]['background'] = 'linear-gradient(to right, ' . esc_attr( $h_b_color ) . ' 0%, ' . esc_attr( $h_b_color2 ) . ' 100%)';
			}

			if ( !empty($text_color) && isset($text_color) ) {
				$elements[liquid_implode( '%1$s' )]['color'] = $text_color;
			}

			if ( !empty($htext_color) && isset($htext_color) ) {
				$elements[liquid_implode( '%1$s:hover' )]['color'] = $htext_color;
			}

		}
		
		//text colors for button label
		if ( 'btn-naked' !== $style ) {

			if( ! empty( $text_color ) && isset( $text_color ) ) {
				$elements[liquid_implode( '%1$s' )]['color'] = $text_color;
			}	
			if( ! empty( $htext_color ) && isset( $htext_color ) ) {
				$elements[liquid_implode( '%1$s:hover' )]['color'] = $htext_color;
			}
			
		} else {
			
			if( !empty( $text_color ) && isset( $text_color ) && !empty( $color2 ) ) {
				$elements[liquid_implode( '%1$s.btn .btn-txt' )]['color'] = $text_color;
				$elements[liquid_implode( '%1$s.btn .btn-txt' )]['background'] = 'none';
				$elements[liquid_implode( '%1$s.btn .btn-txt' )]['text-fill-color'] = 'currentcolor !important';
				$elements[liquid_implode( '%1$s.btn .btn-txt' )]['-webkit-text-fill-color'] = 'currentcolor !important';
				$elements[liquid_implode( '%1$s.btn .btn-txt' )]['background-clip'] = 'border-box !important';
				$elements[liquid_implode( '%1$s.btn .btn-txt' )]['-webkit-background-clip'] = 'border-box !important';
			}	
			if( !empty( $htext_color ) && isset( $htext_color ) && !empty( $hover_color2 ) ) {
				$elements[liquid_implode( '%1$s.btn:hover .btn-txt' )]['color'] = $htext_color;
				$elements[liquid_implode( '%1$s.btn:hover .btn-txt' )]['text-fill-color'] = 'currentcolor !important';
				$elements[liquid_implode( '%1$s.btn:hover .btn-txt' )]['-webkit-text-fill-color'] = 'currentcolor !important';
				$elements[liquid_implode( '%1$s.btn:hover .btn-txt' )]['background-clip'] = 'border-box !important';
				$elements[liquid_implode( '%1$s.btn:hover .btn-txt' )]['-webkit-background-clip'] = 'border-box !important';
			}
		}

		//Font options fot the label		
		if( !empty( $fs ) ) {
			if ( strpos( $fs, 'text_' ) !== false ) {
				$responsive_fs = Liquid_Responsive_Texfield_Param::generate_css( 'font-size', $fs, $_id );
				$elements['media']['responsive-fs'] = $responsive_fs;
			}
			else {
				$elements[ liquid_implode( '%1$s' ) ]['font-size'] = $fs;
			}
		}
		if( !empty( $lh ) ) {		
			if ( strpos( $lh, 'text_' ) !== false ) {
				$responsive_lh = Liquid_Responsive_Texfield_Param::generate_css( 'line-height', $lh, $_id);
				$elements['media']['responsive-lh'] = $responsive_lh;
				$responsive_lh_var = Liquid_Responsive_Texfield_Param::generate_css( '--element-line-height', $lh, $_id );
				$elements['media']['responsive-lh-var'] = $responsive_lh_var;
			}
			else {
				$elements[ liquid_implode( '%1$s' ) ]['line-height'] = $lh;
				$elements[ liquid_implode( '%1$s' ) ]['--element-line-height'] = $lh;
			}	
		}
		if( !empty( $fw ) ) {
			if ( strpos( $fw, 'text_' ) !== false ) {
				$responsive_fw = Liquid_Responsive_Texfield_Param::generate_css( 'font-weight', $fw, $_id );
				$elements['media']['responsive-fw'] = $responsive_fw;
			}
			else {
				$elements[ liquid_implode( '%1$s' ) ]['font-weight'] = $fw;
			}
		}
		if( !empty( $ls ) ) {		
			if ( strpos( $ls, 'text_' ) !== false ) {
				$responsive_ls = Liquid_Responsive_Texfield_Param::generate_css( 'letter-spacing', $ls, $_id );
				$elements['media']['responsive-ls'] = $responsive_ls;
			}
			else {
				$elements[ liquid_implode( '%1$s' ) ]['letter-spacing'] = $ls;
			}
		}

		//Button border colors
		if( ! empty( $b_color ) && isset( $b_color ) ) {
			$elements[liquid_implode( array( '%1$s.btn-bordered' ) )]['border-color'] = $b_color;
		}
		if( ! empty( $h_b_color ) && isset( $h_b_color ) ) {
			$elements[liquid_implode( array( '%1$s.btn-bordered:hover' ) )]['border-color'] = $h_b_color;
		}
		
		if( !empty( $icon_box_shadow ) ) {
			$icon_box_shadow_css = $this->get_shadow_css( $icon_box_shadow );
			$elements[liquid_implode( '%1$s .btn-icon' )]['box-shadow'] = $icon_box_shadow_css;
		}
		if( !empty( $h_icon_box_shadow ) ) {
			$h_icon_box_shadow_css = $this->get_shadow_css( $h_icon_box_shadow );
			$elements[liquid_implode( '%1$s:hover .btn-icon' )]['box-shadow'] = $h_icon_box_shadow_css;
		}
		
		//Shadow box for button
		if( ! empty( $button_box_shadow ) ) {
			
			$button_box_shadow_css = $this->get_shadow_css( $button_box_shadow );
			$elements[liquid_implode( '%1$s' )]['box-shadow'] = $button_box_shadow_css;

		}
		if( ! empty( $hover_button_box_shadow ) ) {

			$hover_button_box_shadow_css = $this->get_shadow_css( $hover_button_box_shadow );
			$elements[liquid_implode( array( '%1$s:hover' ) )]['box-shadow'] = $hover_button_box_shadow_css;

		}
		
		if( !empty( $i_separator_color ) ) {
			$elements[liquid_implode( array( '%1$s .btn-icon:before' ) )]['background'] = $i_separator_color;
		} 
		if( !empty( $i_separator_hcolor ) ) {
			$elements[liquid_implode( array( '%1$s:hover .btn-icon:before' ) )]['background'] = $i_separator_hcolor;
		} 
		if( !empty( $hover_bg_color ) ) {
			$elements[liquid_implode( array( '%1$s .lqd-btn-liquid-bg' ) )]['fill'] = $hover_bg_color;
		} 
		
		

		$this->dynamic_css_parser( $parent . $id, $elements );

	}
}
new LD_Button;