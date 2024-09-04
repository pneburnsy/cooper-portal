<?php
/**
* Shortcode Images Group Element
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly
	
/**
* LD_Shortcode
*/
class LD_Images_Group_Element extends LD_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug            = 'ld_images_group_element';
		$this->title           = esc_html__( 'Liquid Fancy Image', 'landinghub-core' );
		$this->description     = esc_html__( 'Liquid Fancy Image with effects', 'landinghub-core' );
		$this->icon            = 'la la-file-image-o';
		$this->is_container    = true;
		$this->scripts      = array( 'jquery-fresco' );
		$this->styles       = array( 'fresco' );
		$this->as_parent       = array( 'only' => 'ld_button' );
		$this->show_settings_on_create = true;

		parent::__construct();
	}

	public function get_params() {
		
		$this->params = array(

			array(
				'type'             => 'liquid_attach_image',
				'param_name'       => 'image',
				'heading'          => esc_html__( 'Image', 'landinghub-core' ),
				'descripton'       => esc_html__( 'Add image from gallery or upload new', 'landinghub-core' )
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Image size', 'landinghub-core' ),
				'param_name'       => 'img_size',
				'value'            => '',
				'description'      => esc_html__( 'Enter image sizes or percents from original size. Example: 200x100 (Width x Height) or 50%.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'vc_link',
				'param_name'  => 'img_link',
				'heading'     => esc_html__( 'Link', 'landinghub-core' ),
				'description'     => esc_html__( 'Set a link. For lightbox only image, youtube and vimeo videos are accepted. ', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'checkbox',
				'param_name' => 'enable_lightbox',
				'heading'    => esc_html__( 'Enable Lightbox.', 'landinghub-core' ),
				'description'    => esc_html__( 'By default, lightbox will open the image, unless a different image or video url is set in Link option.', 'landinghub-core' ),
				'value'      => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Lightbox Groupd ID.', 'landinghub-core' ),
				'param_name'       => 'lightbox_group_id',
				'value'            => '',
				'description'      => esc_html__( 'Enter a lightbox group id. You can go back and forth between images/videos with the same ID when the lightbox is opened.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'enable_lightbox',
					'not_empty' => true,
				),
			),

			array(
				'type'        => 'liquid_button_set',
				'param_name'  => 'content_align',
				'heading'     => esc_html__( 'Content Alignment', 'landinghub-core' ),
				'description' => esc_html__( 'Content alignment. It\'ll apply if there\'s a button added inside.', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Left', 'landinghub-core' )  => 'lqd-imggrp-content-mid-left',
					esc_html__( 'Center ' ) => 'lqd-imggrp-content-mid',
					esc_html__( 'Right', 'landinghub-core' ) => 'lqd-imggrp-content-mid-right',
				),
				'std' => 'lqd-imggrp-content-mid'
			),
			
			array(
				'type'       => 'checkbox',
				'param_name' => 'enable_side_label',
				'heading'    => esc_html__( 'Add Side Label', 'landinghub-core' ),
				'value'      => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'textarea',
				'param_name'  => 'label',
				'heading'     => esc_html__( 'Side label', 'landinghub-core' )	,
				'description' => esc_html__( 'Add side label', 'landinghub-core' ),
				'group'       => esc_html__( 'Side Label', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_side_label',
					'not_empty' => true,
				),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'label_side',
				'heading'     => esc_html__( 'Label side', 'landinghub-core' ),
				'description' => esc_html__( 'Select label side', 'landinghub-core' ),
				'group'       => esc_html__( 'Side Label', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Left', 'landinghub-core' )  => 'lqd-imggrp-content-fixed-left',
					esc_html__( 'Right', 'landinghub-core' ) => 'lqd-imggrp-content-fixed-right',
				),
				'dependency' => array(
					'element' => 'enable_side_label',
					'not_empty' => true,
				),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_title',
				'heading'     => esc_html__( 'Custom font?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use custom font for side label', 'landinghub-core' ),
				'group'       => esc_html__( 'Side Label', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_side_label',
					'not_empty' => true,
				),
			),
			array(
				'type'       => 'checkbox',
				'param_name' => 'enable_side_label_overlay',
				'heading'    => esc_html__( 'Side Label Overlay', 'landinghub-core' ),
				'value'      => array( esc_html__( 'Yes', 'landinghub-core' ) => 'lqd-imggrp-content-fixed-in' ),
				'group'       => esc_html__( 'Side Label', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_side_label',
					'not_empty' => true,
				),
			),
			array(
				'type' => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'label_color',
				'heading' => esc_html__( 'Label color', 'landinghub-core' ),
				'group'       => esc_html__( 'Side Label', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_side_label',
					'not_empty' => true,
				),
			),
			array(
				'type' => 'liquid_colorpicker',
				'param_name' => 'label_overlay_bgcolor',
				'heading' => esc_html__( 'Overlay background color', 'landinghub-core' ),
				'group'       => esc_html__( 'Side Label', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_side_label_overlay',
					'not_empty' => true,
				),
			),

			array(
				'type'       => 'checkbox',
				'param_name' => 'enable_lines',
				'heading'    => esc_html__( 'Add Lines', 'landinghub-core' ),
				'value'      => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Lines Count', 'landinghub-core' ),
				'param_name'       => 'lines_count',
				'value'            => '3',
				'description'      => esc_html__( 'Enter number of the overlay lines', 'landinghub-core' ),
				'group'       => esc_html__( 'Overlay Lines', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_lines',
					'not_empty' => true,
				),
			),
			array(
				'type' => 'liquid_colorpicker',
				'param_name' => 'lines_color',
				'heading' => esc_html__( 'Lines color', 'landinghub-core' ),
				'group'       => esc_html__( 'Overlay Lines', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_lines',
					'not_empty' => true,
				),
			),
			
			array(
				'type'       => 'checkbox',
				'param_name' => 'enable_effects',
				'heading'    => esc_html__( 'Add Effects', 'landinghub-core' ),
				'value'      => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'parallax',
				'heading'     => esc_html__( 'Parallax', 'landinghub-core' ),
				'description' => esc_html__( 'Add parallax effect to the element', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' )  => 'yes' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'checkbox',
				'param_name' => 'enable_image_shadow',
				'heading'    => esc_html__( 'Add Shadow?', 'landinghub-core' ),
				'value'      => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'shadow_style',
				'heading'    => esc_html__( 'Shadow Style', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Style 1', 'landinghub-core' ) => 1,
					esc_html__( 'Style 2', 'landinghub-core' ) => 2,
					esc_html__( 'Style 3', 'landinghub-core' ) => 3,
					esc_html__( 'Style 4', 'landinghub-core' ) => 4,
					esc_html__( 'Custom', 'landinghub-core' ) => 'custom',
				),		
				'dependency' => array(
					'element' => 'enable_image_shadow',
					'not_empty' => true
				),
			),
			array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Custom Shadow Options', 'landinghub-core' ),
				'param_name' => 'shape_box_shadow',
				'dependency' => array(
					'element' => 'shadow_style',
					'value' => 'custom',
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
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'x_offset',
						'heading'     => esc_html__( 'Position X', 'landinghub-core' ),
						'description' => esc_html__(  'Set position X in px', 'landinghub-core' ),
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'y_offset',
						'heading'     => esc_html__( 'Position Y', 'landinghub-core' ),
						'description' => esc_html__(  'Set position Y in px', 'landinghub-core' ),
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'blur_radius',
						'heading'     => esc_html__( 'Blur Radius', 'landinghub-core' ),
						'description' => esc_html__(  'Add blur radius in px', 'landinghub-core' ),
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'spread_radius',
						'heading'     => esc_html__( 'Spread Radius', 'landinghub-core' ),
						'description' => esc_html__(  'Add spread radius in px', 'landinghub-core' ),
					),
					array(
						'type'        => 'colorpicker',
						'param_name'  => 'shadow_color',
						'heading'     => esc_html__( 'Color', 'landinghub-core' ),
						'description' => esc_html__(  'Pick a color for shadow', 'landinghub-core' ),
					),

				)
			),
			array(
				'type'       => 'checkbox',
				'param_name' => 'enable_hover3d',
				'heading'    => esc_html__( 'Enable Hover 3D?', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'value'      => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			),
			array(
				'type' => 'textfield',
				'param_name' => 'hover3d_stacking_factor',
				'heading' => esc_html__( 'Stacking Factor, use integer number', 'landinghub-core' ),
				'std' => '1',
				'dependency' => array(
					'element' => 'enable_hover3d',
					'not_empty' => true
				),
			),
			array(
				'type'       => 'checkbox',
				'param_name' => 'enable_border',
				'heading'    => esc_html__( 'Add border?', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'value'      => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'border_width',
				'heading'    => esc_html__( 'Border Size', 'landinghub-core' ),
				'value' => array(
					esc_html__( '2px', 'landinghub-core' ) => '2px',
					esc_html__( '4px', 'landinghub-core' ) => '4px',
					esc_html__( '6px', 'landinghub-core' ) => '6px',
					esc_html__( 'Custom', 'landinghub-core' ) => 'custom',
				),
				'dependency' => array(
					'element' => 'enable_border',
					'not_empty' => true
				),
			),
			array(
				'type' => 'textfield',
				'param_name' => 'custom_border_width',
				'heading' => esc_html__( 'Border width', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'border_width',
					'value' => 'custom'
				),
			),
			array(
				'type' => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'border_color',
				'heading' => esc_html__( 'Border color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4',
				'dependency' => array(
					'element' => 'enable_border',
					'not_empty' => true
				),
			),
			array(
				'type'       => 'checkbox',
				'param_name' => 'enable_roudness',
				'heading'    => esc_html__( 'Add roundness?', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'value'      => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'image_roudness',
				'heading'    => esc_html__( 'Border Radius', 'landinghub-core' ),
				'value' => array(
					esc_html__( '2px', 'landinghub-core' ) => 2,
					esc_html__( '4px', 'landinghub-core' ) => 4,
					esc_html__( '6px', 'landinghub-core' ) => 6,
					esc_html__( '8px', 'landinghub-core' ) => 8,
					esc_html__( '50em (Circle)', 'landinghub-core' ) => '50em',
					esc_html__( 'Custom', 'landinghub-core' ) => 'custom',
				),
				'dependency' => array(
					'element' => 'enable_roudness',
					'not_empty' => true
				),
			),
			array(
				'type' => 'textfield',
				'param_name' => 'custom_roundness',
				'heading' => esc_html__( 'Custom roundness', 'landinghub-core' ),
				'description' => esc_html__( 'Please, add roundness with px/em units. ex. 5px', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'image_roudness',
					'value' => 'custom'
				),
			),
			array(
				'type'       => 'checkbox',
				'param_name' => 'enable_float_effect',
				'heading'    => esc_html__( 'Floating Effect?', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'value'      => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'float_easing',
				'heading'    => esc_html__( 'Float Effect Easing', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Ease', 'landinghub-core' ) => 'ease',
					esc_html__( 'Ease In', 'landinghub-core' ) => 'ease-in',
					esc_html__( 'Ease Out', 'landinghub-core' ) => 'ease-out',
					esc_html__( 'Ease In Out', 'landinghub-core' ) => 'ease-in-out',
					esc_html__( 'Custom Ease', 'landinghub-core' ) => 'custom_ease',
				),
				'dependency' => array(
					'element' => 'enable_float_effect',
					'not_empty' => true
				),
			),
			array(
				'type' => 'textfield',
				'param_name' => 'float_custom_ease',
				'heading' => esc_html__( 'Custom Float Easing', 'landinghub-core' ),
				'description' => wp_kses_post( 'Define custom easing for the float effect. You can also use <a href="https://cubic-bezier.com/" target="_blank">Cubic-Bezier</a>', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'float_easing',
					'value' => 'custom_ease'
				),
			),
			
			//Side Label Typo Options
			array(
				'type'        => 'textfield',
				'param_name'  => 'fs',
				'heading'     => esc_html__( 'Font Size', 'landinghub-core' ),
				'description' => esc_html__( 'Example: 20px', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Label Typography', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'lh',
				'heading'     => esc_html__( 'Line-Height', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Label Typography', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'fw',
				'heading'     => esc_html__( 'Font Weight', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Label Typography', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'ls',
				'heading'     => esc_html__( 'Letter Spacing', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Label Typography', 'landinghub-core' ),
			),
			/*
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use for side label theme\'s default font family?', 'landinghub-core' ),
				'param_name'  => 'use_theme_fonts',
				'value'       => array(
					esc_html__( 'Yes', 'landinghub-core' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'landinghub-core' ),
				'group' => esc_html__( 'Label Typography', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'std'         => 'yes',
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'text_font',
				'value'      => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
				'settings'   => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'landinghub-core' ),
						'font_style_description'  => esc_html__( 'Select font styling.', 'landinghub-core' ),
					),
				),
				'group' => esc_html__( 'Label Typography', 'landinghub-core' ),
				'dependency' => array(
					'element'            => 'use_theme_fonts',
					'value_not_equal_to' => 'yes',
				),
			),
			*/
			//Effects
			array(
				'type' => 'subheading',
				'param_name' => 'sb_shadow',
				'heading' => esc_html__( 'Animated Shadow', 'landinghub-core' ),
				'group' => esc_html__( 'Effects', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_image_shadow',
					'not_empty' => true
				),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'enable_shadow',
				'heading'     => esc_html__( 'Animated Shadow', 'landinghub-core' ),
				'description' => esc_html__( 'Enable Animated Shadow', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'group' => esc_html__( 'Effects', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_image_shadow',
					'not_empty' => true
				),
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'shadow_delay',
				'heading'    => esc_html__( 'Delay in milliseconds', 'landinghub-core' ),
				'description' => esc_html__( 'Delay before animation starts', 'landinghub-core' ),
				'group' => esc_html__( 'Effects', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_image_shadow',
					'not_empty' => true
				),
			),
			// Reveal
			array(
				'type' => 'subheading',
				'param_name' => 'sb_reveal',
				'heading' => esc_html__( 'Reveal effect', 'landinghub-core' ),
				'group' => esc_html__( 'Effects', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_effects',
					'not_empty' => true
				),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'enable_reveal',
				'heading'     => esc_html__( 'Reveal Effect', 'landinghub-core' ),
				'description' => esc_html__( 'Enable Reveal Effect', 'landinghub-core' ),
				'value'      => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'edit_field_class' => 'vc_col-sm-12',
				'group' => esc_html__( 'Effects', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_effects',
					'not_empty' => true
				),
			),
			array(
				'type' => 'liquid_colorpicker',
				'param_name' => 'reveal_color',
				'heading' => esc_html__( 'Background color', 'landinghub-core' ),
				'description' => esc_html__( 'Background color of the reveal effect', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4',
				'group' => esc_html__( 'Effects', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_reveal',
					'not_empty' => true
				),
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'reveal_direction',
				'heading' => esc_html__( 'Direction', 'landinghub-core' ),
				'description' => esc_html__( 'Direction of the reveal effect', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Left - Right', 'landinghub-core' ) => 'lr',
					esc_html__( 'Top - Bottom', 'landinghub-core' ) => 'tb',
					esc_html__( 'Right - Left', 'landinghub-core' ) => 'rl',
					esc_html__( 'Bottom - Top', 'landinghub-core' ) => 'bt'
				),
				'edit_field_class' => 'vc_col-sm-4',
				'group' => esc_html__( 'Effects', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_reveal',
					'not_empty' => true
				),
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'reveal_delay',
				'heading'    => esc_html__( 'Delay in milliseconds', 'landinghub-core' ),
				'description' => esc_html__( 'Delay before revealing starts', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4',
				'group' => esc_html__( 'Effects', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_reveal',
					'not_empty' => true
				),
			),
			// Color adjust
			array(
				'type' => 'subheading',
				'param_name' => 'sb_color_adjust',
				'heading' => esc_html__( 'Color Adjust', 'landinghub-core' ),
				'group' => esc_html__( 'Effects', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_effects',
					'not_empty' => true
				),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'enable_color_adjust',
				'heading'     => esc_html__( 'Color Adjust', 'landinghub-core' ),
				'description' => esc_html__( 'Enable color adjust', 'landinghub-core' ),
				'value'      => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'group' => esc_html__( 'Effects', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_effects',
					'not_empty' => true
					)
				),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'enable_color_adjust_reset',
				'heading'     => esc_html__( 'Enable Reset Color Adjust', 'landinghub-core' ),
				'description' => esc_html__( 'Reset color addjusts on hover or when it\'s in active carousel item', 'landinghub-core' ),
				'value'      => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'group' => esc_html__( 'Effects', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_color_adjust',
					'not_empty' => true
					)
				),
				array(
					'type'        => 'liquid_slider',
					'param_name'  => 'ca_saturation',
					'heading'     => esc_html__( 'Saturation', 'landinghub-core' ),
					'description' => esc_html__( 'Default: 1', 'landinghub-core' ),
					'min'         => 0,
					'max'         => 100,
					'std'         => 1,
					'step'        => 1,
					'edit_field_class' => 'vc_col-sm-6',
					'group' => esc_html__( 'Effects', 'landinghub-core' ),
					'dependency' => array(
						'element' => 'enable_color_adjust',
						'not_empty' => true
					),
				),
				array(
					'type'        => 'liquid_slider',
					'param_name'  => 'ca_brightness',
					'heading'     => esc_html__( 'Brightness', 'landinghub-core' ),
					'description' => esc_html__( 'Default: 1', 'landinghub-core' ),
					'min'         => 0,
					'max'         => 10,
					'std'         => 1,
					'step'        => 1,
					'edit_field_class' => 'vc_col-sm-6',
					'group' => esc_html__( 'Effects', 'landinghub-core' ),
					'dependency' => array(
						'element' => 'enable_color_adjust',
						'not_empty' => true
					),
				),
				array(
					'type'        => 'liquid_slider',
					'param_name'  => 'ca_contrast',
					'heading'     => esc_html__( 'Contrast', 'landinghub-core' ),
					'description' => esc_html__( 'Default: 100', 'landinghub-core' ),
					'min'         => 0,
					'max'         => 500,
					'std'         => 100,
					'step'        => 1,
					'edit_field_class' => 'vc_col-sm-6',
					'group' => esc_html__( 'Effects', 'landinghub-core' ),
					'dependency' => array(
						'element' => 'enable_color_adjust',
						'not_empty' => true
					),
				),
				array(
					'type'        => 'liquid_slider',
					'param_name'  => 'ca_grayscale',
					'heading'     => esc_html__( 'Grayscale', 'landinghub-core' ),
					'description' => esc_html__( 'Default: 0', 'landinghub-core' ),
					'min'         => 0,
					'max'         => 100,
					'std'         => 0,
					'step'        => 1,
					'edit_field_class' => 'vc_col-sm-6',
					'group' => esc_html__( 'Effects', 'landinghub-core' ),
					'dependency' => array(
						'element' => 'enable_color_adjust',
						'not_empty' => true
					),
				),
				array(
					'type'        => 'liquid_slider',
					'param_name'  => 'ca_hue',
					'heading'     => esc_html__( 'Hue', 'landinghub-core' ),
					'description' => esc_html__( 'Default: 0', 'landinghub-core' ),
					'min'         => -180,
					'max'         => 180,
					'std'         => 0,
					'step'        => 1,
					'edit_field_class' => 'vc_col-sm-6',
					'group' => esc_html__( 'Effects', 'landinghub-core' ),
					'dependency' => array(
						'element' => 'enable_color_adjust',
						'not_empty' => true
					),
				),
				array(
					'type'        => 'liquid_slider',
					'param_name'  => 'ca_opacity',
					'heading'     => esc_html__( 'Opacity', 'landinghub-core' ),
					'description' => esc_html__( 'Default: 100', 'landinghub-core' ),
					'min'         => 0,
					'max'         => 100,
					'std'         => 100,
					'step'        => 1,
					'edit_field_class' => 'vc_col-sm-6',
					'group' => esc_html__( 'Effects', 'landinghub-core' ),
					'dependency' => array(
						'element' => 'enable_color_adjust',
						'not_empty' => true
					),
				),
			
			//Parallax
			array(
				'type'        => 'subheading',
				'param_name'  => 'prlx_from',
				'heading'     => esc_html__( 'Parallax "From" Options', 'landinghub-core' ),
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'translate_from_x',
				'heading'     => esc_html__( 'Translate X', 'landinghub-core' ),
				'description' => esc_html__( 'Select translate on X axe', 'landinghub-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'translate_from_y',
				'heading'     => esc_html__( 'Translate Y', 'landinghub-core' ),
				'description' => esc_html__( 'Select translate on Y axe', 'landinghub-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'translate_from_z',
				'heading'     => esc_html__( 'Translate Z', 'landinghub-core' ),
				'description' => esc_html__( 'Select translate on Z axe', 'landinghub-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'scale_from_x',
				'heading'     => esc_html__( 'Scale X', 'landinghub-core' ),
				'description' => esc_html__( 'Select Scale X', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 5,
				'step'        => 0.1,
				'std'         => 1,
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-4',
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'scale_from_y',
				'heading'     => esc_html__( 'Scale Y', 'landinghub-core' ),
				'description' => esc_html__( 'Select Scale Y', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 5,
				'step'        => 0.1,
				'std'         => 1,
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'rotate_from_x',
				'heading'     => esc_html__( 'Rotate X', 'landinghub-core' ),
				'description' => esc_html__( 'Select rotate degree on X axe', 'landinghub-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'rotate_from_y',
				'heading'     => esc_html__( 'Rotate Y', 'landinghub-core' ),
				'description' => esc_html__( 'Select rotate degree on Y axe', 'landinghub-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'rotate_from_z',
				'heading'     => esc_html__( 'Rotate Z', 'landinghub-core' ),
				'description' => esc_html__( 'Select rotate degree on Z axe', 'landinghub-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
	
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'from_torigin_x',
				'heading'     => esc_html__( 'Transform Origin X', 'landinghub-core' ),
				'description' => esc_html__( 'Select or add transform origin X axe', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'None', 'landinghub-core' )   => '',
					esc_html__( 'Left', 'landinghub-core' )   => 'left',
					esc_html__( 'Center', 'landinghub-core' ) => 'center',
					esc_html__( 'Right', 'landinghub-core' )  => 'right',
					esc_html__( 'Custom', 'landinghub-core' ) => 'custom',
				),
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'from_torigin_x_custom',
				'heading'     => esc_html__( 'Custom value for X-asex', 'landinghub-core' ),
				'description' => esc_html__( 'Add custom value for transform-origin X axe in px or %', 'landinghub-core' ),
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'from_torigin_x',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'from_torigin_y',
				'heading'     => esc_html__( 'Transform Origin Y', 'landinghub-core' ),
				'description' => esc_html__( 'Select or add transform origin Y axe', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'None', 'landinghub-core' )   => '',
					esc_html__( 'Top', 'landinghub-core' )    => 'top',
					esc_html__( 'Center', 'landinghub-core' ) => 'center',
					esc_html__( 'Bottom', 'landinghub-core' ) => 'bottom',
					esc_html__( 'Custom', 'landinghub-core' ) => 'custom',
				),
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'from_torigin_y_custom',
				'heading'     => esc_html__( 'Custom value for Y-asex', 'landinghub-core' ),
				'description' => esc_html__( 'Add custom value for transform-origin Y axe in px or %', 'landinghub-core' ),
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'from_torigin_y',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'from_opacity',
				'heading'     => esc_html__( 'Opacity', 'landinghub-core' ),
				'description' => esc_html__( 'Set opacity', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 1,
				'step'        => 0.1,
				'std'         => 1,
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
	
			),
	
			//parallax custom code textarea
			array(
				'type'        => 'textarea',
				'param_name'  => 'parallax_from',
				'heading'     => esc_html__( 'Parallax "From" Custom Options', 'landinghub-core' ),
				'description' => esc_html__( 'Parallax custom options to add to data-paralax-from attribute, will override all options above', 'landinghub-core' ),
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
			),
			array(
				'type'        => 'subheading',
				'param_name'  => 'prlx_to',
				'heading'     => esc_html__( 'Parallax "To" Options', 'landinghub-core' ),
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'translate_to_x',
				'heading'     => esc_html__( 'Translate X', 'landinghub-core' ),
				'description' => esc_html__( 'Select translate on X axe', 'landinghub-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'translate_to_y',
				'heading'     => esc_html__( 'Translate Y', 'landinghub-core' ),
				'description' => esc_html__( 'Select translate on Y axe', 'landinghub-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'translate_to_z',
				'heading'     => esc_html__( 'Translate Z', 'landinghub-core' ),
				'description' => esc_html__( 'Select translate on Z axe', 'landinghub-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'scale_to_x',
				'heading'     => esc_html__( 'Scale X', 'landinghub-core' ),
				'description' => esc_html__( 'Select Scale X', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 10,
				'step'        => 0.1,
				'std'         => 1,
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-4',
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'scale_to_y',
				'heading'     => esc_html__( 'Scale Y', 'landinghub-core' ),
				'description' => esc_html__( 'Select Scale Y', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 10,
				'step'        => 0.1,
				'std'         => 1,
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'rotate_to_x',
				'heading'     => esc_html__( 'Rotate X', 'landinghub-core' ),
				'description' => esc_html__( 'Select rotate degree on X axe', 'landinghub-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
	
			),
	
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'rotate_to_y',
				'heading'     => esc_html__( 'Rotate Y', 'landinghub-core' ),
				'description' => esc_html__( 'Select rotate degree on Y axe', 'landinghub-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
	
			),
	
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'rotate_to_z',
				'heading'     => esc_html__( 'Rotate Z', 'landinghub-core' ),
				'description' => esc_html__( 'Select rotate degree on Z axe', 'landinghub-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
	
			),
	
			array(
				'type'        => 'dropdown',
				'param_name'  => 'to_torigin_x',
				'heading'     => esc_html__( 'Transform Origin X', 'landinghub-core' ),
				'description' => esc_html__( 'Select or add transform origin X axe', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'None', 'landinghub-core' )   => '',
					esc_html__( 'Left', 'landinghub-core' )   => '0%',
					esc_html__( 'Center', 'landinghub-core' ) => '50%',
					esc_html__( 'Right', 'landinghub-core' )  => '100%',
					esc_html__( 'Custom', 'landinghub-core' ) => 'custom',
				),
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
	
			array(
				'type'        => 'textfield',
				'param_name'  => 'to_torigin_x_custom',
				'heading'     => esc_html__( 'Custom value for X-asex', 'landinghub-core' ),
				'description' => esc_html__( 'Add custom value for transform-origin X axe in px or %', 'landinghub-core' ),
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'to_torigin_x',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
	
			array(
				'type'        => 'dropdown',
				'param_name'  => 'to_torigin_y',
				'heading'     => esc_html__( 'Transform Origin Y', 'landinghub-core' ),
				'description' => esc_html__( 'Select or add transform origin Y axe', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'None', 'landinghub-core' )   => '',
					esc_html__( 'Top', 'landinghub-core' )    => '0%',
					esc_html__( 'Center', 'landinghub-core' ) => '50%',
					esc_html__( 'Bottom', 'landinghub-core' ) => '100%',
					esc_html__( 'Custom', 'landinghub-core' ) => 'custom',
				),
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
	
			array(
				'type'        => 'textfield',
				'param_name'  => 'to_torigin_y_custom',
				'heading'     => esc_html__( 'Custom value for Y-asex', 'landinghub-core' ),
				'description' => esc_html__( 'Add custom value for transform-origin Y axe in px or %', 'landinghub-core' ),
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'to_torigin_y',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
	
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'to_opacity',
				'heading'     => esc_html__( 'Opacity', 'landinghub-core' ),
				'description' => esc_html__( 'Set opacity', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 1,
				'step'        => 0.1,
				'std'         => 1,
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
	
			),
	
			array(
				'type'        => 'textarea',
				'param_name'  => 'parallax_to',
				'heading'     => esc_html__( 'Parallax To', 'landinghub-core' ),
				'description' => esc_html__( 'Parallax custom options to add to data-paralax-from attribute', 'landinghub-core' ),
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
			),
	
			array(
				'type'        => 'subheading',
				'param_name'  => 'prlx_common',
				'heading'     => esc_html__( 'Parallax Settings', 'landinghub-core' ),
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
			),
	
			array(
				'type'        => 'textfield',
				'param_name'  => 'to_delay',
				'heading'     => esc_html__( 'Delay', 'landinghub-core' ),
				'description' => esc_html__( 'Add delay time in seconds', 'landinghub-core' ),
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
			),
	
			array(
				'type'        => 'dropdown',
				'param_name'  => 'to_easy',
				'heading'     => esc_html__( 'Easing', 'landinghub-core' ),
				'value'       => array(
					'linear',
					'power1.in',
					'power2.in',
					'power3.in',
					'power4.in',
					'sine.in',
					'expo.in',
					'circ.in',
					'back.in',
					'bounce.in',
					'elastic.in(1,0.2)',
					'power1.out',
					'power2.out',
					'power3.out',
					'power4.out',
					'sine.out',
					'expo.out',
					'circ.out',
					'back.out',
					'bounce.out',
					'elastic.out(1,0.2)',
					'power1.inOut',
					'power2.inOut',
					'power3.inOut',
					'power4.inOut',
					'sine.inOut',
					'expo.inOut',
					'circ.inOut',
					'back.inOut',
					'bounce.inOut',
					'elastic.inOut(1,0.2)',
				),
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'parallax_offset',
				'heading'     => esc_html__( 'Parallax Offset', 'landinghub-core' ),
				'description' => esc_html__( 'Offset number', 'landinghub-core' ),
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'parallax_trigger',
				'heading'    => esc_html__( 'Parallax Trigger', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'On Enter', 'landinghub-core' )  => 'top bottom',
					esc_html__( 'On Leave', 'landinghub-core' ) => 'top top',
					esc_html__( 'On Center', 'landinghub-core' ) => 'center center',
					esc_html__( 'Custom', 'landinghub-core' ) => 'number',
				),
				'std'        => 'top bottom',
				'group'      => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
	
			array(
				'type'        => 'textfield',
				'param_name'  => 'parallax_trigger_number',
				'heading'     => esc_html__( 'Parallax Custom Trigger', 'landinghub-core' ),
				// 'description' => esc_html__( 'Input trigger number value from 0 to 1', 'landinghub-core' ),
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax_trigger',
					'value'   => 'number'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),			
			array(
				'type'        => 'textfield',
				'param_name'  => 'parallax_duration',
				'heading'     => esc_html__( 'Increase/Decrease Duration', 'landinghub-core' ),
				'description' => esc_html__( 'You can modify the duration. Add +=NUMBER to increase or -=NUMBER to decrease the duration. You can also add % after the number for responsive valuse.', 'landinghub-core' ),
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'parallax_overflow',
				'heading'     => esc_html__( 'Parallax overflow hidden', 'landinghub-core' ),
				'description' => esc_html__( 'Make overflow hidden or visible', 'landinghub-core' ),
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax',
					'value'   => 'yes'
				),
				'value' => array(
					esc_html__( 'Yes', 'landinghub-core' )  => 'yes',
					esc_html__( 'No', 'landinghub-core' )  => 'no',
				),
				'std'        => 'no',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'overflow_height',
				'heading'     => esc_html__( 'Height', 'landinghub-core' ),
				'description' => esc_html__( 'add height for parallax element with px, for ex 150px', 'landinghub-core' ),
				'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'parallax_overflow',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			
			//Design Options
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Absolute Position?', 'landinghub-core' ),
				'param_name'  => 'absolute_pos',
				'description' => esc_html__( 'If checked the position will be set absolute', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_col-md-offset-6',
			),
			array(
				'type'       => 'liquid_responsive',
				'heading'    => esc_html__( 'Margin', 'landinghub-core' ),
				'description' => esc_html__( 'Add margins for the element, use px or %', 'landinghub-core' ),
				'css'        => 'margin',
				'param_name' => 'margin',
				'group'      => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			//Position
			array(
				'type'       => 'liquid_responsive',
				'heading'    => esc_html__( 'Position', 'landinghub-core' ),
				'description' => esc_html__( 'Add positions for the element, use px or %', 'landinghub-core' ),
				'css'        => 'position',
				'param_name' => 'position',
				'group'      => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'responsive_hide',
				'heading'    => esc_html__( 'Hide Image?', 'landinghub-core' ),
				'param_name' => 'hide_el',
				'group'      => esc_html__( 'Design Options', 'landinghub-core' ),			
			),
		);

		$this->add_extras();
	}
	
	protected function get_image() {

		// check
		if( empty( $this->atts['image'] ) ) {
			return;
		}
		
		$dimensions = $loaded = '';
		
		$image_opts = $attr = $sizes = array();
		$size = 'full';
		$alt = get_post_meta( $this->atts['image'], '_wp_attachment_image_alt', true );
		$attachment = get_post( $this->atts['image'] );
		
		if( preg_match( '/^\d+$/', $this->atts['image'] ) ){
			if( !empty( $this->atts['img_size'] ) ) {

				$dimensions  = vc_extract_dimensions( $this->atts['img_size'] );
				if( empty( $dimensions ) ) {
					$image_src = wp_get_attachment_image_src( $this->atts['image'], 'full', false );
					list( $src, $width, $height ) = $image_src;
					$dimensions = array( $width * ( (int)$this->atts['img_size'] / 100 ), $height * ( (int)$this->atts['img_size'] / 100 ) );
				}
				if ( preg_match_all( '/(\d+)x(\d+)/', $this->atts['img_size'], $sizes ) ) {
					$exact_size = array(
						'width' => isset( $sizes[1][0] ) ? $sizes[1][0] : '0',
						'height' => isset( $sizes[2][0] ) ? $sizes[2][0] : '0',
					);
					$src = wpb_resize( $this->atts['image'], null, $exact_size['width'], $exact_size['height'], true );
					$src = $src['url'];
					$srcset = '';
					
				} else {
					$src = wp_get_attachment_image_url( $this->atts['image'], 'full', false );
					$srcset = wp_get_attachment_image_srcset( $this->atts['image'] );
				}	
				
				$hwstring    = image_hwstring( $dimensions[0], $dimensions[1] );
				$default_attr = array(
		            'src'    => $src,
		            'srcset' => $srcset,
		            'class'  => '',
		            'alt'    => $alt,
		        );
 
				$attr = wp_parse_args( $attr, $default_attr );				
				$attr = apply_filters( 'wp_get_attachment_image_attributes', $attr, $attachment  );
				$attr = array_map( 'esc_attr', $attr );
				
				$image = rtrim("<img $hwstring");
		        foreach ( $attr as $name => $value ) {
		            $image .= " $name=" . '"' . $value . '"';
		        }
		        $image .= ' />';	

			}
			else {				
				$image  = wp_get_attachment_image( $this->atts['image'], $size, false, $image_opts );	
			}
			
			$src = wp_get_attachment_image_url( $this->atts['image'], 'full', false );
			$filetype = wp_check_filetype( $src );
			if( 'svg' === $filetype['ext'] ) {
				$loaded = 'class="loaded"';
			} 
			
		} else {
			if( 'on' === liquid_helper()->get_option( 'enable-lazy-load' ) && !is_admin() ) {
				$image = '<img class="ld-lazyload loaded" data-src="' . esc_url( $this->atts['image'] ) . '" src="' . esc_url( $this->atts['image'] ) . '" alt="' . esc_attr( $alt ) . '" />';
			}
			else {
				$image = '<img class="loaded" data-src="' . esc_url( $this->atts['image'] ) . '" src="' . esc_url( $this->atts['image'] ) . '" alt="' . esc_attr( $alt ) . '" />';
			}
			$loaded = 'class="loaded"';
		}
		
		$image = sprintf( '<figure %s>%s</figure>', $loaded, $image );
		
		echo $image;

	}
	
	protected function get_label() {
		
		$label = $this->atts['label'];
		$side  = $this->atts['label_side'];
		$side_overlay = $this->atts['enable_side_label_overlay'];
		if( empty( $label ) ) {
			return;
		}
		
		printf( '<div class="lqd-imggrp-content %s %s"><p>%s</p></div>', esc_attr( $side ), $side_overlay, wp_kses_post( $label ) );		

	}
	
	protected function get_lines() {
		
		if( !$this->atts['enable_lines'] ) {
			return '';
		}
		
		$out = '';
		
		$lines = $this->atts['lines_count'];
		
		$out = '<div class="lqd-v-lines lqd-overlay justify-content-center">';
		$out .= '<span class="lqd-v-line d-flex justify-content-start invisible"><span class="h-100"></span></span>';
		for( $i = 1; $i <= $lines; $i++ ) {
			$out .= '<span class="lqd-v-line d-flex justify-content-start"><span class="h-100"></span></span>';
		}
		$out .= '</div>';

		echo $out;
		
	}
	
	protected function get_overlay_link() {
		
		$link = liquid_get_link_attributes( $this->atts['img_link'], false );
		if ( !empty( $link['href'] ) && empty($this->atts['enable_lightbox']) ) {
			printf( '<a%s class="lqd-overlay lqd-fi-overlay-link lqd-cc-label-trigger"></a>', ld_helper()->html_attributes( $link ));
		}
		
	}
	
	protected function get_lightbox_link() {
		
		$link = liquid_get_link_attributes( $this->atts['img_link'], false );

		if ( ! empty($this->atts['enable_lightbox']) && empty( $link['href'] ) ) {
			printf( '<a href="%s" class="lqd-overlay lqd-fi-overlay-link lqd-cc-label-trigger fresco" data-fresco-group="%s"></a>', wp_get_attachment_image_url( $this->atts['image'], 'full', false ), $this->atts['lightbox_group_id'] );
		} else if ( ! empty($this->atts['enable_lightbox']) && ! empty( $link['href'] ) ) {
			printf( '<a%s class="lqd-overlay lqd-fi-overlay-link lqd-cc-label-trigger fresco" data-fresco-group="%s"></a>', ld_helper()->html_attributes( $link ), $this->atts['lightbox_group_id'] );
		}
		
		
	}

	protected function get_data_stacking_factor() {
		
		$hover3d = $this->atts['enable_hover3d'];
		$hover3d_stacking_factor = $this->atts['hover3d_stacking_factor'];
		
		if( $hover3d ) {
			return 'data-stacking-factor="' . $hover3d_stacking_factor . '"';
		}
		
	}

	protected function get_data_float_effect() {
		
		$enable_float_effect = $this->atts['enable_float_effect'];
		$float_easing = $this->atts['float_easing'];
		$float_custom_ease = $this->atts['float_custom_ease'];
		
		$easing = $float_easing;
		
		if( $float_easing === 'custom_ease' && ! empty($float_custom_ease) ) {
			$easing = $float_custom_ease;
		}

		if ( $enable_float_effect ) {
			return 'data-float="' . $easing . '"';
		}
		
	}
	
	protected function get_data_options() {
		
		$opts = array();
		
		$shadow = $this->atts['enable_shadow'];
		$shadow_style = $this->atts['shadow_style'];
		$shadow_delay = $this->atts['shadow_delay'];
		$hover3d      = $this->atts['enable_hover3d'];

		if( $this->atts['enable_image_shadow'] ) {
			$opts[] = 'data-shadow-style="' . $shadow_style . '"';
		}
		if( $this->atts['enable_roudness'] ) {
			$opts[] = 'data-roundness="'. $this->atts['image_roudness'] . '"';
		}

		if( $shadow ) {
			$opts[] = 'data-inview="true"';
			if( ! empty( $shadow_delay ) && isset( $shadow_delay ) ) {
				$opts[] = 'data-inview-options=\'' . wp_json_encode( array( 'delayTime' => (int)$shadow_delay ) ) . '\'';
			}
			$opts[] = 'data-animate-shadow="true"';	
		}
		
		if( $hover3d ) {
			$opts[] = 'data-hover3d="true"';
		}
		
		if( empty( $opts ) ) {
			return;
		}
		
		return implode( ' ', $opts );	
	}

	protected function get_reveal_data() {

		$data = array();

		$reveal = $this->atts['enable_reveal'];
		$reveal_color =	isset( $this->atts['reveal_color'] ) ? $this->atts['reveal_color'] : '#f0f3f6';
		$reveal_direction = $this->atts['reveal_direction'];
		$reveal_delay = isset( $this->atts['reveal_delay'] ) ? $this->atts['reveal_delay'] : 0;

		if( $reveal ) {
			$data[] = 'data-reveal="true"';
			$data[] = 'data-reveal-options=\'' . wp_json_encode( array( 'direction' => $reveal_direction, 'bgcolor' => $reveal_color, 'delay' => $reveal_delay ) ) . '\'';
		}

		if( empty( $data ) ) {
			return;
		}

		return implode( ' ', $data );	

	}
	
	protected function get_parallax_options() {
		
		$text_font_inline_style = '';		
		
		extract( $this->atts );
		
		if( 'yes' !== $parallax ) {
			return;
		}

		$wrapper_attributes = $parallax_data = $parallax_data_from = $parallax_data_to = $parallax_opts = array();

		$wrapper_attributes[] = 'data-parallax="true"';
	
		//Data-options-from
		if ( !empty( $translate_from_x ) ) { $parallax_data_from['x']      = ( int ) $translate_from_x; }
		if ( !empty( $translate_from_y ) ) { $parallax_data_from['y']      = ( int ) $translate_from_y; }
		if ( !empty( $translate_from_z ) ) { $parallax_data_from['z']      = ( int ) $translate_from_z; }
	
		if ( '1' !== $scale_from_x ) { $parallax_data_from['scaleX']     = ( float ) $scale_from_x; }
		if ( '1' !== $scale_from_y ) { $parallax_data_from['scaleY']     = ( float ) $scale_from_y; }
	
		if ( !empty( $rotate_from_x ) ) { $parallax_data_from['rotationX'] = ( int ) $rotate_from_x; }
		if ( !empty( $rotate_from_y ) ) { $parallax_data_from['rotationY'] = ( int ) $rotate_from_y; }
		if ( !empty( $rotate_from_z ) ) { $parallax_data_from['rotationZ'] = ( int ) $rotate_from_z; }
	
		if ( isset( $from_opacity ) && '1' !== $from_opacity ) { $parallax_data_from['opacity']    = ( float ) $from_opacity; }
	
		if ( ! empty(
			$from_torigin_x_custom ) ) { $_x_custom = $from_torigin_x_custom;
		} else {
			$_x_custom = ! empty( $from_torigin_x ) ? $from_torigin_x : '';
		}
		if ( ! empty( $from_torigin_y_custom ) ) {
			$_y_custom = $from_torigin_y_custom;
		} else {
			$_y_custom = ! empty( $from_torigin_y ) ? $from_torigin_y : '';
		}
		if ( ! empty( $_x_custom ) && ! empty( $_y_custom ) ) {
			$parallax_data_from['transformOrigin'] = $_x_custom . '&nbsp;' . $_y_custom;
		}
	
		//Data-options-to
		if ( !empty( $translate_from_x ) ) { $parallax_data_to['x'] = ( int ) $translate_to_x; }
		if ( !empty( $translate_from_y ) ) { $parallax_data_to['y'] = ( int ) $translate_to_y; }
		if ( !empty( $translate_from_z ) ) { $parallax_data_to['z'] = ( int ) $translate_to_z; }
	
		if ( isset( $scale_to_x ) && '1' !== $scale_from_x ) { $parallax_data_to['scaleX'] = ( float ) $scale_to_x; }
		if ( isset( $scale_to_y ) && '1' !== $scale_from_y ) { $parallax_data_to['scaleY'] = ( float ) $scale_to_y; }
	
		if ( !empty( $rotate_from_x ) ) { $parallax_data_to['rotationX'] = ( int ) $rotate_to_x; }
		if ( !empty( $rotate_from_y ) ) { $parallax_data_to['rotationY'] = ( int ) $rotate_to_y; }
		if ( !empty( $rotate_from_z ) ) { $parallax_data_to['rotationZ'] = ( int ) $rotate_to_z; }
	
		if ( isset( $to_opacity ) && '1' !== $from_opacity ) { $parallax_data_to['opacity'] = ( float ) $to_opacity; }
	
		if( ! empty(
			$to_torigin_x_custom ) ) { $to_x_custom = $to_torigin_x_custom;
		} else {
			$to_x_custom = ! empty( $to_torigin_x ) ? $to_torigin_x : '';
		}
		if( ! empty( $to_torigin_y_custom ) ) {
			$to_y_custom = $to_torigin_y_custom;
		} else {
			$to_y_custom = ! empty( $to_torigin_y ) ? $to_torigin_y : '';
		}
		if( ! empty( $to_x_custom ) && ! empty( $to_y_custom ) ) {
			$parallax_data_to['transformOrigin'] = $to_x_custom . '&nbsp;' . $to_y_custom;
		}
	
		//Parallax general options
		if ( ! empty( $parallax_from ) ) {
			$parallax_data['from'] = $parallax_from;
		} else {
			$parallax_data['from'] = $parallax_data_from;
		}
		if( ! empty( $parallax_to ) ) {
			$parallax_data['to'] = $parallax_to;
		} else {
			$parallax_data['to'] = $parallax_data_to;
		}

	
		if( is_array( $parallax_data['from'] ) && ! empty( $parallax_data['from'] ) ) {
			$wrapper_attributes[] = 'data-parallax-from=\'' . wp_json_encode( $parallax_data['from'] ) . '\'';
		}
		elseif( ! empty( $parallax_from ) ) {
			$wrapper_attributes[] = 'data-parallax-from=\'{' . $parallax_from . '}\'';
		}
	
		if( is_array( $parallax_data['to'] ) && ! empty( $parallax_data['to'] ) ) {
	
			$wrapper_attributes[] = 'data-parallax-to=\'' . wp_json_encode( $parallax_data['to'] ) . '\'';
		}
		elseif( ! empty( $parallax_to ) ) {
			$wrapper_attributes[] = 'data-parallax-to=\'{' . $parallax_to . '}\'';
		}

		$parallax_opts['overflowHidden'] = ( 'no' === $parallax_overflow ) ? false : true;
		if ( isset( $to_easy ) ) { $parallax_opts['ease'] = $to_easy; }
		if ( ! empty( $to_delay ) ) { $parallax_opts['delay'] = ( float ) $to_delay; }
		if( ! empty( $parallax_offset ) ) { $parallax_opts['offset'] = esc_attr( $parallax_offset ); }
		if( 'number' !== $parallax_trigger ){
			$parallax_opts['start'] = esc_attr( $parallax_trigger );
		}
		elseif ( ! empty( $parallax_trigger_number ) ) {
			$parallax_opts['start'] = esc_attr( $parallax_trigger_number );
		}
		if ( ! empty($parallax_duration) ) {
			$parallax_opts['end'] = esc_attr( 'bottom'  . $parallax_duration . ' top' );
		}
		if( ! empty( $parallax_opts ) ) {
			$wrapper_attributes[] = 'data-parallax-options=\'' . wp_json_encode( $parallax_opts ) .'\'';
		}

		return implode( ' ', $wrapper_attributes );

	}
	
	protected function get_overflow_height() {
		
		if( empty( $this->atts['overflow_height'] ) ) {
			return '';
		}

		return 'custom-height-applied';
		
	}	

	protected function get_color_adjust_reset() {
		
		if( !$this->atts['enable_color_adjust_reset'] ) {
			return '';
		}

		return 'reset-color-adjust-enabled';
		
	}
	
	protected function generate_css() {
		
		$settings = get_option( 'wpb_js_google_fonts_subsets' );
		if ( is_array( $settings ) && ! empty( $settings ) ) {
			$subsets = '&subset=' . implode( ',', $settings );
		} else {
			$subsets = '';
		}

		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();
		
		$text_font_inline_style  = '';
		/*
		if( 'yes' !== $use_theme_fonts ) {

			// Build the data array
			$text_font_data = $this->get_fonts_data( $text_font );

			// Build the inline style
			$text_font_inline_style = $this->google_fonts_style( $text_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $text_font_data );

		}
		*/
		$elements[ liquid_implode( '%1$s .lqd-imggrp-content-fixed-left, %1$s .lqd-imggrp-content-fixed-right' ) ] = array( $text_font_inline_style );
		$elements[ liquid_implode( '%1$s .lqd-imggrp-content-fixed-left, %1$s .lqd-imggrp-content-fixed-right' ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ liquid_implode( '%1$s .lqd-imggrp-content-fixed-left, %1$s .lqd-imggrp-content-fixed-right' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ liquid_implode( '%1$s .lqd-imggrp-content-fixed-left, %1$s .lqd-imggrp-content-fixed-right' ) ]['font-weight'] = !empty( $fw ) ? $fw . ' !important' : '';
		$elements[ liquid_implode( '%1$s .lqd-imggrp-content-fixed-left, %1$s .lqd-imggrp-content-fixed-right' ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';

		if ( ! empty($enable_color_adjust) ) {
			$elements[ liquid_implode( '%1$s .liquid-img-container-inner figure' ) ]['filter'] = 'saturate(' . $ca_saturation . ')' . ' brightness(' . $ca_brightness . ')' . ' contrast(' . $ca_contrast . '%)' . ' grayscale(' . $ca_grayscale . '%)' . ' hue-rotate(' . $ca_hue . 'deg)' . ' opacity(' . $ca_opacity . '%)';
		}
		
		if( ! empty( $absolute_pos ) ) {
			$elements[ liquid_implode( '%1$s' ) ]['position'] = 'absolute';
		}
		if( !empty( $overflow_height ) ) {
			$elements[ liquid_implode( '%1$s' ) ]['height'] = $overflow_height;
		}
		if( !empty( $custom_roundness ) ) {
			$elements[ liquid_implode( '%1$s' ) ]['border-radius'] = $custom_roundness;
		}

		if( !empty( $enable_border ) ) {

			$bw = '0px';
			$bc = 'currentColor';

			if ( !empty( $border_width ) && 'custom' !== $border_width ) {
				$bw  = $border_width;
			}
			if ( !empty( $custom_border_width ) ) {
				$bw  = $custom_border_width;
			}
			if ( !empty( $border_color ) ) {
				$bc = $border_color;
			}

			$elements[ liquid_implode( '%1$s .lqd-imggrp-img-container > figure' ) ]['border'] = $bw . ' solid ' . $bc;

		}

		if( !empty( $label_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-imggrp-content-fixed-left, %1$s .lqd-imggrp-content-fixed-right' ) ]['color'] = $label_color;
		}
		if( !empty( $label_overlay_bgcolor ) ) {
			$elements[ liquid_implode( '%1$s .lqd-imggrp-content-fixed-in' ) ]['background'] = $label_overlay_bgcolor;
		}
		if( !empty( $lines_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-v-lines span span' ) ]['background'] = $lines_color;
		}

		if( !empty( $float_custom_ease ) ) {
			$elements[ liquid_implode( '%1$s[data-float]' ) ]['--float-animation-ease'] = $float_custom_ease;
		}
		
		$responsive_pos = Liquid_Responsive_Param::generate_css( 'position', $position, $this->get_id() );
		$elements['media']['position'] = $responsive_pos;

		$responsive_margin = Liquid_Responsive_Param::generate_css( 'margin', $margin, $this->get_id() );
		$elements['media']['margin'] = $responsive_margin;
		
		$shape_box_shadow = vc_param_group_parse_atts( $shape_box_shadow );
		
		//Shadow box for button
		if( ! empty( $shape_box_shadow ) ) {
			$shape_box_shadow_css = $this->get_shadow_css( $shape_box_shadow );
			$elements[liquid_implode( '%1$s .lqd-imggrp-img-container' )]['box-shadow'] = $shape_box_shadow_css;
		}
		
		$this->dynamic_css_parser( $id, $elements );
	}


}
new LD_Images_Group_Element;
class WPBakeryShortCode_LD_Images_Group_Element extends WPBakeryShortCodesContainer {}