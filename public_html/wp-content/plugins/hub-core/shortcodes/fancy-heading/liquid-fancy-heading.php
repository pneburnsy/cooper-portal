<?php

/**
* Shortcode Fancy Heading
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Fancy_Heading extends LD_Shortcode { 

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_fancy_heading';
		$this->title       = esc_html__( 'Liquid Text', 'landinghub-core' );
		$this->description = esc_html__( 'Add a fancy custom text', 'landinghub-core' );
		$this->icon        = 'la la-text-height';
		$this->scripts      = array( 'splittext' );
		$this->show_settings_on_create = true;

		parent::__construct();
	}

	public function get_params() {

		$this->params = array(
			array(
				'type'        => 'textarea_html',
				'heading'     => esc_html__( 'Title', 'landinghub-core' ),
				'param_name'  => 'content',
				'holder' => 'div',
				'value'       => esc_html__( 'This is Liquid Fancy heading element', 'landinghub-core' ),
				'description' => esc_html__( 'Note: If you are using non-latin characters be sure to activate them under Settings/WPBakery Page Builder/General Settings.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-12',
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'tag',
				'heading'     => esc_html__( 'Element tag', 'landinghub-core' ),
				'description' => esc_html__( 'Select element tag.', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'h1', 'landinghub-core' )  => 'h1',
					esc_html__( 'h2', 'landinghub-core' )  => 'h2',
					esc_html__( 'h3', 'landinghub-core' )  => 'h3',
					esc_html__( 'h4', 'landinghub-core' )  => 'h4',
					esc_html__( 'h5', 'landinghub-core' )  => 'h5',
					esc_html__( 'h6', 'landinghub-core' )  => 'h6',
					esc_html__( 'p', 'landinghub-core' )   => 'p',
					esc_html__( 'div', 'landinghub-core' ) => 'div',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'alignment',
				'heading'     => esc_html__( 'Alignment', 'landinghub-core' ),
				'description' => esc_html__( 'Select title alignment', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Inherit', 'landinghub-core' )   => '',
					esc_html__( 'Left', 'landinghub-core' )      => 'text-left',
					esc_html__( 'Center', 'landinghub-core' )    => 'text-center',
					esc_html__( 'Right', 'landinghub-core' )     => 'text-right',
					esc_html__( 'Justified', 'landinghub-core' ) => 'text-justified',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'transform',
				'heading'    => esc_html__( 'Transformation', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Default', 'landinghub-core' )    => '',
					esc_html__( 'Uppercase', 'landinghub-core' )  => 'text-uppercase',
					esc_html__( 'Lowercase', 'landinghub-core' )  => 'text-lowercase',
					esc_html__( 'Capitalize', 'landinghub-core' ) => 'text-capitalize',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'text_decoration',
				'heading'    => esc_html__( 'Text Decoration', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'None', 'landinghub-core' )  => 'text-decoration-default',
					esc_html__( 'Underline', 'landinghub-core' ) => 'text-underline',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'color',
				'heading'     => esc_html__( 'Color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'liquid_colorpicker',
				'only_gradient' => true,
				'param_name'  => 'gradient',
				'heading'     => esc_html__( 'Gradient', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_title',
				'heading'     => esc_html__( 'Custom Typography?', 'landinghub-core' ),
				'description' => esc_html__( 'Font, Size, Weight and Spacing', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_inheritance',
				'heading'     => esc_html__( 'Inherit font styles?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to enable font style inheritance', 'landinghub-core' ),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'tag_to_inherite',
				'heading'     => esc_html__( 'Tag', 'landinghub-core' ),
				'description' => esc_html__( 'Select tag you want to inherite style defined in theme options', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'h1', 'landinghub-core' ) => 'h1',
					esc_html__( 'h2', 'landinghub-core' ) => 'h2',
					esc_html__( 'h3', 'landinghub-core' ) => 'h3',
					esc_html__( 'h4', 'landinghub-core' ) => 'h4',
					esc_html__( 'h5', 'landinghub-core' ) => 'h5',
					esc_html__( 'h6', 'landinghub-core' ) => 'h6',
				),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'use_inheritance',
					'value'   => 'true',
				)
			),
			array(
				'type'        => 'vc_link',
				'heading'     => esc_html__( 'URL (Link)', 'landinghub-core' ),
				'param_name'  => 'link',
				'description' => esc_html__( 'Add link to custom heading.', 'landinghub-core' ),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_bg_mask',
				'heading'     => esc_html__( 'Enable Background mask?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to enable background mask on title', 'landinghub-core' ),
			),
			array(
				'type'             => 'liquid_attach_image',
				'param_name'       => 'mask_image',
				'heading'          => esc_html__( 'Mask Image', 'landinghub-core' ),
				'descripton'       => esc_html__( 'Add image from gallery or upload new', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'use_bg_mask',
					'value'   => 'true',
				),
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'mask_bg_size',
				'heading' => esc_html__( 'Background Size', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Default', 'landinghub-core' ) => '',
					esc_html__( 'Cover', 'landinghub-core' )   => 'cover',
					esc_html__( 'Contain', 'landinghub-core' ) => 'contain',
				),
				'dependency'  => array(
					'element' => 'use_bg_mask',
					'value'   => 'true',
				),
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'mask_bg_repeat',
				'heading' => esc_html__( 'Background Repeat', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Default', 'landinghub-core' )   => '',
					esc_html__( 'No repeat', 'landinghub-core' ) => 'no-repeat',
					esc_html__( 'Repeat', 'landinghub-core' )    => 'repeat',
					esc_html__( 'Repeat X', 'landinghub-core' )    => 'repeat-x',
					esc_html__( 'Repeat Y', 'landinghub-core' )    => 'repeat-y',
				),
				'dependency'  => array(
					'element' => 'use_bg_mask',
					'value'   => 'true',
				),
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'mask_bg_position',
				'heading' => esc_html__( 'Background Position', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Default', 'landinghub-core' )         => '',
					esc_html__( 'Center Bottom', 'landinghub-core' )   => 'center bottom',
					esc_html__( 'Center Center', 'landinghub-core' )   => 'center center',
					esc_html__( 'Center Top', 'landinghub-core' )      => 'center top',
					esc_html__( 'Left Bottom', 'landinghub-core' )     => 'left bottom',
					esc_html__( 'Left Center', 'landinghub-core' )     => 'left center',
					esc_html__( 'Left Top', 'landinghub-core' )        => 'left top',
					esc_html__( 'Right Bottom', 'landinghub-core' )    => 'right bottom',
					esc_html__( 'Right Center', 'landinghub-core' )    => 'right center',
					esc_html__( 'Right Top', 'landinghub-core' )       => 'right top',
					esc_html__( 'Custom Position', 'landinghub-core' ) => 'custom',
				),
				'dependency'  => array(
					'element' => 'use_bg_mask',
					'value'   => 'true',
				),
			),
			array(
				'type'             => 'textfield',
				'param_name'       => 'mask_bg_pos_h',
				'heading'          => esc_html__( 'Horizontal Position', 'landinghub-core' ),
				'description'      => esc_html__( 'Enter custom horizontal position in px or %', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'mask_bg_position',
					'value'   => 'custom',
				),
			),
			array(
				'type'             => 'textfield',
				'param_name'       => 'mask_bg_pos_v',
				'heading'          => esc_html__( 'Vertical Position', 'landinghub-core' ),
				'description'      => esc_html__( 'Enter custom vertical position in px or %', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'mask_bg_position',
					'value'   => 'custom',
				),
			),
			array(
				'type' => 'subheading',
				'param_name' => 'sb_heading',
				'heading' => esc_html__( 'Animation', 'landinghub-core' ),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'parallax',
				'heading'     => esc_html__( 'Parallax', 'landinghub-core' ),
				'description' => esc_html__( 'Add parallax effect to the element', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' )  => 'yes' ),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'enable_split',
				'heading'     => esc_html__( 'Enable Split Animation?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to enable split effect', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'use_bg_mask',
					'is_empty'   => true,
				)
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'split_type',
				'heading'     => esc_html__( 'Split Animation Type', 'landinghub-core' ),
				'description' => esc_html__( 'Select split animation type', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Lines', 'landinghub-core' ) => 'lines',
					esc_html__( 'Words', 'landinghub-core' ) => 'words',
					esc_html__( 'Characters', 'landinghub-core' ) => 'chars, words',
				),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				)
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'enable_txt_rotator',
				'heading'     => esc_html__( 'Enable Text Rotator?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to enable text rotator', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes'  ),
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'rotator_type',
				'heading'     => esc_html__( 'Rotator Type', 'landinghub-core' ),
				'description' => esc_html__( 'Select rotator type', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Default', 'landinghub-core' )    => '',
					esc_html__( 'Basic', 'landinghub-core' ) => 'basic',
				),
				'dependency' => array(
					'element' => 'enable_txt_rotator',
					'value'   => 'yes',
				),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'text_rotator_delay',
				'heading'     => esc_html__( 'Stay time', 'landinghub-core' ),
				'description' => esc_html__( 'Staying time for each word in seconds. default is 2 seconds.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'enable_txt_rotator',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'word_colors',
				'heading'     => esc_html__( 'Title rotator words color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a different color for the title rotator words', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'enable_txt_rotator',
					'value'   => 'yes',
				),
			),
			array(
				'type'       => 'param_group',
				'param_name' => 'items',
				'heading'    => esc_html__( 'Separated words for text rotator', 'landinghub-core' ),
				'value'      => '',
				'params'     => array(
					array(
						'type'        => 'textfield',
						'param_name'  => 'word',
						'heading'     => esc_html__( 'Title word', 'landinghub-core' ),
						'description' => esc_html__( 'Add word for title rotator', 'landinghub-core' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_column-with-padding  vc_col-sm-6',
					),
					array(
						'type'        => 'liquid_colorpicker',
						'only_solid'  => true,
						'param_name'  => 'word_color',
						'heading'     => esc_html__( 'Title word color', 'landinghub-core' ),
						'description' => esc_html__( 'Pick a different color for the title word', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6',
					),
				),
				'dependency' => array(
					'element' => 'enable_txt_rotator',
					'value'   => 'yes',
				),
			),
			//Underline
			array(
				'type'        => 'subheading',
				'param_name'  => 'sb_underline',
				'heading'     => esc_html__( 'Line Options', 'landinghub-core' ),
			),
			array(
				'type'       => 'checkbox',
				'param_name' => 'enable_underline',
				'heading'    => esc_html__( 'Underline', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Yes', 'landinghub-core' ) => 'yes',
				),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'line_height',
				'heading'     => esc_html__( 'Height', 'landinghub-core' ),
				'description' => esc_html__( 'Add line height in px, for ex 2px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'enable_underline',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'line_width',
				'heading'     => esc_html__( 'Width', 'landinghub-core' ),
				'description' => esc_html__( 'Add line width in px, for ex 60px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'enable_underline',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'line_offset',
				'heading'     => esc_html__( 'Bottom Offset', 'landinghub-core' ),
				'description' => esc_html__( 'Add line bottom offset, for ex -10px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'enable_underline',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'line_roudness',
				'heading'     => esc_html__( 'Roudness', 'landinghub-core' ),
				'description' => esc_html__( 'Add line roudness in px, for ex 5px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'enable_underline',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'line_color',
				'heading'     => esc_html__( 'Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a background color for line', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'enable_underline',
					'value'   => array( 'yes', 'custom_underline' ),
				)
			),
			array(
				'type' => 'subheading',
				'param_name' => 'whitespace_subheading',
				'heading' => esc_html__( 'White Space', 'landinghub-core' ),
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'whitespace',
				'heading' => esc_html__( 'Whitespace', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Normal', 'landinghub-core' ) => '',
					esc_html__( 'Nowrap', 'landinghub-core' ) => 'ws-nowrap'
				)
			),
			array(
				'type' => 'subheading',
				'param_name' => 'sb_highlight',
				'heading' => esc_html__( 'Highlight', 'landinghub-core' ),
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'highlight_type',
				'heading' => esc_html__( 'Type', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Underline', 'landinghub-core' ) => 'lqd-highlight-underline',
					esc_html__( 'Brush', 'landinghub-core' )     => 'lqd-highlight-custom-underline'

				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'highlight_animation',
				'heading' => esc_html__( 'Animation', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Grow From Left', 'landinghub-core' )   => 'lqd-highlight-grow-left',
					esc_html__( 'Grow From Bottom', 'landinghub-core' ) => 'lqd-highlight-grow-bottom',
					esc_html__( 'Fade In', 'landinghub-core' )          => 'lqd-highlight-fadein',
				),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'highlight_type',
					'value'   => 'lqd-highlight-underline',
				)
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'highlight_reset_onhover',
				'heading'     => esc_html__( 'Fill Text On Hover?', 'landinghub-core' ),
				'description' => esc_html__( 'Check if you want to fill the text background with highlight when it is hovered over.', 'landinghub-core' ),
				'value' => array( esc_html__( 'Yes', 'landinghub-core'  ) => 'lqd-highlight-reset-onhover' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'highlight_color',
				'heading'     => esc_html__( 'Backround Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a background color for highlight', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'highlight_type',
					'value'   => 'lqd-highlight-underline',
				)
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'highlight_color_brush',
				'only_solid' => true,
				'heading'     => esc_html__( 'Backround Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a background color for highlight', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'highlight_type',
					'value'   => 'lqd-highlight-custom-underline',
				)
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'highlight_height',
				'heading'     => esc_html__( 'Height', 'landinghub-core' ),
				'description' => esc_html__( 'Add line height in px, for ex 2px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'std' => '0.275em'
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'highlight_offset',
				'heading'     => esc_html__( 'Bottom Offset', 'landinghub-core' ),
				'description' => esc_html__( 'Add line bottom offset, for ex -10px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'std' => '0px'
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'highlight_roudness',
				'heading'     => esc_html__( 'Roudness', 'landinghub-core' ),
				'description' => esc_html__( 'Add line roudness in px, for ex 5px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'highlight_type',
					'value'   => 'lqd-highlight-underline',
				)
			),
			array(
				'type' => 'subheading',
				'param_name' => 'sb_highlight',
				'heading' => esc_html__( 'Outline', 'landinghub-core' ),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'hover_text_outline',
				'heading'     => esc_html__( 'Outline Text', 'landinghub-core' ),
				'description' => '',
				'value' => array( esc_html__( 'Yes', 'landinghub-core' ) => 'ld-fh-outline' ),
				'dependency'  => array(
					'element' => 'enable_split',
					'is_empty' => true,
				)
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'outline_appearance',
				'heading'     => esc_html__( 'Appearance', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'None', 'landinghub-core' )     => '',
					esc_html__( 'Default', 'landinghub-core' )  => 'ld-fh-outline-static',
					esc_html__( 'On Hover', 'landinghub-core' ) => 'ld-fh-outline',
				),
				'dependency' => array(
					'element' => 'hover_text_outline',
					'value'   => 'ld-fh-outline',
				),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'hover_text_outline_color',
				'heading'     => esc_html__( 'Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a different color for the hover state of the outline text', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'hover_text_outline',
					'value'   => 'ld-fh-outline',
				),
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'hover_text_outline_width',
				'heading' => esc_html__( 'Width' ),
				'description' => esc_html__( 'Set hover text outline width in px. for ex. 5px', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'hover_text_outline',
					'value'   => 'ld-fh-outline',
				),
			),

			// Vertical Text
			array(
				'type' => 'subheading',
				'param_name' => 'vh_heading',
				'heading' => esc_html__( 'Vertical Text', 'landinghub-core' ),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'vertical_txt',
				'heading'     => esc_html__( 'Vertical Text?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to enable vertical text', 'landinghub-core' ),
				'value' => array( esc_html__( 'Yes', 'landinghub-core'  ) => 'text-sm-vertical' ),
			),

			//Typo Options
			array(
				'type'        => 'responsive_textfield',
				'param_name'  => 'fs',
				'heading'     => esc_html__( 'Font Size', 'landinghub-core' ),
				'description' => esc_html__( 'Example: 20px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Text', 'landinghub-core' ),
			),
			array(
				'type'        => 'responsive_textfield',
				'param_name'  => 'lh',
				'heading'     => esc_html__( 'Line-Height', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Text', 'landinghub-core' ),
			),
			array(
				'type'        => 'responsive_textfield',
				'param_name'  => 'fw',
				'heading'     => esc_html__( 'Font Weight', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Text', 'landinghub-core' ),
			),
			array(
				'type'        => 'responsive_textfield',
				'param_name'  => 'ls',
				'heading'     => esc_html__( 'Letter Spacing', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Text', 'landinghub-core' ),
			),
			//Animation Options
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_mask',
				'heading'     => esc_html__( 'Enabled mask?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to enable mask on title to use it in animation', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Animation', 'landinghub-core' ),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'enable_randomize',
				'heading'     => esc_html__( 'Enable Random Values?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to enable random values to the animation', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Animation', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'duration',
				'heading'     => esc_html__( 'Duration', 'landinghub-core' ),
				'description' => esc_html__( 'Add duration of the animation in milliseconds', 'landinghub-core' ),
				'std' => '1800',
				'dependency'  => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group'            => esc_html__( 'Animation', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'delay',
				'heading'     => esc_html__( 'Delay (Stagger)', 'landinghub-core' ),
				'description' => esc_html__( 'Add delay of the animation between of the animated elements in milliseconds', 'landinghub-core' ),
				'std' => '180',
				'dependency'  => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group'            => esc_html__( 'Animation', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'start_delay',
				'heading'     => esc_html__( 'Start Delay', 'landinghub-core' ),
				'description' => esc_html__( 'Add start delay of the animation in milliseconds', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group'            => esc_html__( 'Animation', 'landinghub-core' ),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'easing',
				'heading'     => esc_html__( 'Easing', 'landinghub-core' ),
				'description' => esc_html__( 'Select an easing type', 'landinghub-core' ),
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
				'std'         => 'power4.out',
				'dependency'  => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group'            => esc_html__( 'Animation', 'landinghub-core' ),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'direction',
				'heading'     => esc_html__( 'Direction', 'landinghub-core' ),
				'description' => esc_html__( 'Select animations direction', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Forward', 'landinghub-core' )  => 'forward',
					esc_html__( 'Backward', 'landinghub-core' ) => 'backward',
					esc_html__( 'Random', 'landinghub-core' ) => 'random',
				),
				'dependency'  => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Animation', 'landinghub-core' ),
			),
			array(
				'type'        => 'subheading',
				'param_name'  => 'ca_init_values',
				'heading'     => esc_html__( 'Animate From', 'landinghub-core' ),
				'group'       => esc_html__( 'Animation', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_init_translate_x',
				'heading'     => esc_html__( 'Translate X', 'landinghub-core' ),
				'description' => esc_html__( 'Select translate on X axe', 'landinghub-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group' => esc_html__( 'Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_init_translate_y',
				'heading'     => esc_html__( 'Translate Y', 'landinghub-core' ),
				'description' => esc_html__( 'Select translate on Y axe', 'landinghub-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group' => esc_html__( 'Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_init_translate_z',
				'heading'     => esc_html__( 'Translate Z', 'landinghub-core' ),
				'description' => esc_html__( 'Select translate on Z axe', 'landinghub-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group' => esc_html__( 'Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_init_scale_x',
				'heading'     => esc_html__( 'Scale X', 'landinghub-core' ),
				'description' => esc_html__( 'Select Scale X', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 10,
				'step'        => 0.05,
				'std'         => 1,
				'group' => esc_html__( 'Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
				'edit_field_class' => 'vc_col-sm-4',
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_init_scale_y',
				'heading'     => esc_html__( 'Scale Y', 'landinghub-core' ),
				'description' => esc_html__( 'Select Scale Y', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 10,
				'step'        => 0.05,
				'std'         => 1,
				'group' => esc_html__( 'Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_init_rotate_x',
				'heading'     => esc_html__( 'Rotate X', 'landinghub-core' ),
				'description' => esc_html__( 'Select rotate degree on X axe', 'landinghub-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group' => esc_html__( 'Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_init_rotate_y',
				'heading'     => esc_html__( 'Rotate Y', 'landinghub-core' ),
				'description' => esc_html__( 'Select rotate degree on Y axe', 'landinghub-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group' => esc_html__( 'Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_init_rotate_z',
				'heading'     => esc_html__( 'Rotate Z', 'landinghub-core' ),
				'description' => esc_html__( 'Select rotate degree on Z axe', 'landinghub-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group' => esc_html__( 'Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
	
			),
			
			array(
				'type'        => 'textfield',
				'param_name'  => 'ca_init_origin_x',
				'heading'     => esc_html__( 'TransformOrigin X', 'landinghub-core' ),
				'description' => esc_html__( 'Add value for transform-origin X axe in %', 'landinghub-core' ),
				'group' => esc_html__( 'Animation', 'landinghub-core' ),
				'std' => '50%',
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'ca_init_origin_y',
				'heading'     => esc_html__( 'TransformOrigin Y', 'landinghub-core' ),
				'description' => esc_html__( 'Add value for transform-origin Y axe in %', 'landinghub-core' ),
				'group' => esc_html__( 'Animation', 'landinghub-core' ),
				'std' => '50%',
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'ca_init_origin_z',
				'heading'     => esc_html__( 'TransformOrigin Z', 'landinghub-core' ),
				'description' => esc_html__( 'Add value for transform-origin Z axe in px', 'landinghub-core' ),
				'group' => esc_html__( 'Animation', 'landinghub-core' ),
				'std' => '0px',
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_init_opacity',
				'heading'     => esc_html__( 'Opacity', 'landinghub-core' ),
				'description' => esc_html__( 'Set opacity', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 1,
				'step'        => 0.1,
				'std'         => 1,
				'group' => esc_html__( 'Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
	
			),
			
			//Animation Values
			array(
				'type'        => 'subheading',
				'param_name'  => 'ca_animations_values',
				'heading'     => esc_html__( 'Animate To', 'landinghub-core' ),
				'group' => esc_html__( 'Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
			),			
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_an_translate_x',
				'heading'     => esc_html__( 'Translate X', 'landinghub-core' ),
				'description' => esc_html__( 'Select translate on X axe', 'landinghub-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group' => esc_html__( 'Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_an_translate_y',
				'heading'     => esc_html__( 'Translate Y', 'landinghub-core' ),
				'description' => esc_html__( 'Select translate on Y axe', 'landinghub-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group' => esc_html__( 'Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_an_translate_z',
				'heading'     => esc_html__( 'Translate Z', 'landinghub-core' ),
				'description' => esc_html__( 'Select translate on Z axe', 'landinghub-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group' => esc_html__( 'Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_an_scale_x',
				'heading'     => esc_html__( 'Scale X', 'landinghub-core' ),
				'description' => esc_html__( 'Select Scale X', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 10,
				'step'        => 0.05,
				'std'         => 1,
				'group' => esc_html__( 'Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
				'edit_field_class' => 'vc_col-sm-4',
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_an_scale_y',
				'heading'     => esc_html__( 'Scale Y', 'landinghub-core' ),
				'description' => esc_html__( 'Select Scale Y', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 10,
				'step'        => 0.05,
				'std'         => 1,
				'group' => esc_html__( 'Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_an_rotate_x',
				'heading'     => esc_html__( 'Rotate X', 'landinghub-core' ),
				'description' => esc_html__( 'Select rotate degree on X axe', 'landinghub-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group' => esc_html__( 'Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_an_rotate_y',
				'heading'     => esc_html__( 'Rotate Y', 'landinghub-core' ),
				'description' => esc_html__( 'Select rotate degree on Y axe', 'landinghub-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group' => esc_html__( 'Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_an_rotate_z',
				'heading'     => esc_html__( 'Rotate Z', 'landinghub-core' ),
				'description' => esc_html__( 'Select rotate degree on Z axe', 'landinghub-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group' => esc_html__( 'Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
	
			),
			
			array(
				'type'        => 'textfield',
				'param_name'  => 'ca_an_origin_x',
				'heading'     => esc_html__( 'TransformOrigin X', 'landinghub-core' ),
				'description' => esc_html__( 'Add value for transform-origin X axe in %', 'landinghub-core' ),
				'group' => esc_html__( 'Animation', 'landinghub-core' ),
				'std' => '50%',
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'ca_an_origin_y',
				'heading'     => esc_html__( 'TransformOrigin Y', 'landinghub-core' ),
				'description' => esc_html__( 'Add value for transform-origin Y axe in %', 'landinghub-core' ),
				'group' => esc_html__( 'Animation', 'landinghub-core' ),
				'std' => '50%',
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'ca_an_origin_z',
				'heading'     => esc_html__( 'TransformOrigin Z', 'landinghub-core' ),
				'description' => esc_html__( 'Add value for transform-origin Z axe in px', 'landinghub-core' ),
				'group' => esc_html__( 'Animation', 'landinghub-core' ),
				'std' => '0px',
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_an_opacity',
				'heading'     => esc_html__( 'Opacity', 'landinghub-core' ),
				'description' => esc_html__( 'Set opacity', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 1,
				'step'        => 0.1,
				'std'         => 1,
				'group' => esc_html__( 'Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_split',
					'value'   => 'true',
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
				'heading'     => esc_html__( 'Parallax Trigger Number', 'landinghub-core' ),
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
				'edit_field_class' => 'vc_col-md-6',
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
				'type'       => 'liquid_responsive',
				'heading'    => esc_html__( 'Padding', 'landinghub-core' ),
				'description' => esc_html__( 'Add paddings for the element, use px or %', 'landinghub-core' ),
				'css'        => 'padding',
				'param_name' => 'padding',
				'group'      => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-md-6',
			),
			
			array(
				'type'        => 'checkbox',
				'param_name'  => 'enable_bg',
				'heading'     => esc_html__( 'Enable Background?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to enable background', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			),
			array(
				'type'       => 'liquid_colorpicker',
				'param_name' => 'fh_bg',
				'heading'    => esc_html__( 'Fancy Heading Background', 'landinghub-core' ),
				'description' => esc_html__( 'Add fancy heading background', 'landinghub-core' ),
				'group'      => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_bg',
					'value'   => 'yes',
				),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'fh_border_radius',
				'heading'     => esc_html__( 'Fancy Heading Border Radius', 'landinghub-core' ),
				'description' => esc_html__( 'Select border radius for fancy heading', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'None', 'landinghub-core' )       => '',
					esc_html__( 'Semi Round', 'landinghub-core' ) => 'semi-round',
					esc_html__( 'Round', 'landinghub-core' )      => 'round',
					esc_html__( 'Circle', 'landinghub-core' )     => 'circle',
				),
				'dependency'  => array(
					'element' => 'enable_bg',
					'value'   => 'yes',
				),
			),
			//Box Shadow Options
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Enable box-shadow?', 'landinghub-core' ),
				'param_name'  => 'enable_fh_shadowbox',
				'description' => esc_html__( 'If checked, the box-shadow options will be visible', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'dependency'  => array(
					'element' => 'enable_bg',
					'value'   => 'yes',
				),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
			),
			array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Shadow Box Options', 'landinghub-core' ),
				'param_name' => 'fh_box_shadow',
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_fh_shadowbox',
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
						'edit_field_class' => 'vc_col-sm-6'
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

		$this->add_extras();

	}

	protected function get_title() {
		
		$tag = $this->atts['tag'];
		
		$classnames = $outline_title = '';
		$classnames_arr = array('ld-fh-element');
		
		$link = liquid_get_link_attributes( $this->atts['link'], false );
		
		if( !empty( $this->atts['gradient'] ) ) {
			$classnames_arr[] = 'ld-gradient-heading';
		}
		if( !empty( $this->atts['fh_border_radius'] ) ) {
			$classnames_arr[] = $this->atts['fh_border_radius'];
		}
		if( 'custom_underline' === $this->atts['enable_underline'] ) {
			$classnames_arr[] = 'lqd-highlight-custom-underline';
		}

		if( !empty( $this->atts['whitespace'] ) ) {
			$classnames_arr[] = $this->atts['whitespace'];
		}

		if( !empty( $this->atts['highlight_type'] ) ) {
			$classnames_arr[] = $this->atts['highlight_type'];
		}
		if( !empty( $this->atts['highlight_animation'] ) ) {
			$classnames_arr[] = $this->atts['highlight_animation'];
		}
		if( !empty( $this->atts['highlight_reset_onhover'] ) ) {
			$classnames_arr[] = 'lqd-highlight-reset-onhover';
		}

		if( !empty( $this->atts['vertical_txt'] ) ) {
			$classnames_arr[] = $this->atts['vertical_txt'];
		}

		if( !empty( $this->atts['text_decoration'] ) ) {
			$classnames_arr[] = $this->atts['text_decoration'];
		}

		if ( $this->atts['enable_split'] ) {
			$classnames_arr[] = $this->get_split_classname();
		}
		
		$title = do_shortcode( wp_kses_post( $this->atts['content'] ) ) . $this->get_title_words();
		$tag_inherit = '';
		if( $this->atts['use_inheritance'] ){
			$classnames_arr[] = $this->atts['tag_to_inherite'];
		}
		
		if( !empty( $classnames_arr ) ) {
			$classnames = 'class="' . join( ' ', $classnames_arr ) . '"';
		}
		
		if( 'ld-fh-outline' === $this->atts['hover_text_outline'] ) {
			$outline_title = '<span class="ld-fh-txt-outline">' .  ld_helper()->do_the_content( $title, false ) . '</span>';
		}
		
		// Title
		if( $title ) {
			if ( !empty ( $link['href'] ) ) {
				printf( '<%1$s %3$s %4$s %8$s><a%5$s '. $this->get_split_options() .'>%7$s %6$s %2$s</a></%1$s>', !empty( $tag ) ? $tag : 'h2', ld_helper()->do_the_content( $title, false ), $classnames, $this->get_data_opts(), ld_helper()->html_attributes( $link ), $this->get_underline(), $outline_title, $this->get_parallax_options() );
			}
			else {
				printf( '<%1$s %3$s %4$s %7$s '. $this->get_split_options() .'>%6$s %5$s %2$s</%1$s>', !empty( $tag ) ? $tag : 'h2', ld_helper()->do_the_content( $title, false ), $classnames, $this->get_data_opts(), $this->get_underline(), $outline_title, $this->get_parallax_options() );
			}
			
		}
		
	}
	
	protected function get_title_words() {
		
		if( !$this->atts['enable_txt_rotator'] ) {
			return;
		}

		if( empty( $this->atts['items'] ) ) {
			return;
		}

		$words = vc_param_group_parse_atts( $this->atts['items'] );
		$words = array_filter( $words );

		if( empty( $words ) ) {
			return;
		}
		
		$out = $style_word = '';
		
		$out .= ' <span class="txt-rotate-keywords">';
		$i = 1;
		foreach ( $words as $word ) {
			$active = ( $i == 1 ) ? ' active' : '';
			$style_word = !empty( $word['word_color'] ) ? 'style="color:' . esc_attr( $word['word_color'] ) . '"' : '';
			
			$out .= '<span class="txt-rotate-keyword' . $active . '" ' . $style_word . '><span>' . esc_html( $word['word'] ) . '</span></span>';
			$i++;
		}
		$out .= '</span><!-- /.txt-rotate-keywords -->';

		return $out;
		
	}
	
	protected function get_text_rotator_options() {
		
		if( !$this->atts['enable_txt_rotator'] ) {
			return;
		}

		$attrs = array(
			'data-text-rotator' => true,
		);
		$options = array();

		if( 'basic' === $this->atts['rotator_type'] ) {
			$options['animationType'] = 'basic';
		}

		if ( ! empty( $this->atts['text_rotator_delay'] ) ) {
			$options['delay'] = (float) $this->atts['text_rotator_delay'];
		}

		if ( ! empty( $options ) ) {
			$attrs['data-text-rotator-options'] = wp_json_encode( $options );
		}
		
		return $attrs;
		
	}
	
	protected function get_bg_classname() {

		if( empty( $this->atts['fh_bg'] ) ) {
			return;
		}

		return 'ld-fh-has-fill';
		
	}
	
	protected function get_pos_abs() {

		if( empty( $this->atts['absolute_pos'] ) ) {
			return;
		}

		return 'ld-fh-pos-abs lqd-exclude-parent-ca';
		
	}
	
	protected function get_underline() {
		
		if( empty( $this->atts['enable_underline'] ) || 'custom_underline' === $this->atts['enable_underline'] ) {
			return;
		}
		
		return '<span class="ld-fh-underline"></span>';
		
	}
	
	protected function get_highlight_opts() {

		
		if( !has_shortcode( $this->atts['content'], 'ld_highlight' )  ) {
			return;
		}
		
		$opts = array(
			'data-inview' => true,
			'data-transition-delay' => true,
			'data-delay-options' => wp_json_encode(
				array(
					'elements' => '.lqd-highlight-inner',
					'delayType' => 'transition'
				)
			)
		);
		
		return $opts;
	
	}
	
	protected function get_parallax_options() {
		
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
	
	protected function get_data_opts() {
		
		$opts = array();
		$rotator_opts = $this->get_text_rotator_options();
		$highlight_opts = $this->get_highlight_opts();
		
		if( is_array( $rotator_opts ) && ! empty( $rotator_opts ) ) {
			$opts = array_merge( $opts, $rotator_opts );
		}
		if( is_array( $highlight_opts ) && ! empty( $highlight_opts ) ) {
			$opts = array_merge( $opts, $highlight_opts );
		}
		
		return ld_helper()->html_attributes( $opts );
		
	}
	
	protected function get_split_options() {

		extract( $this->atts );

		if( !$enable_split ) {
			return;
		}
		
		$opts = $split_opts = array();
		$split_opts['type'] = $split_type;
		$animation_opts = $this->get_animation_opts();
		$opts[] = 'data-split-text="true"';
		$opts[] = 'data-split-options=\'' . wp_json_encode( $split_opts ) . '\'';
		
		if ( ! empty($animation_opts) ) {
			$opts[] = 'data-custom-animations="true"';
			$opts[] = 'data-ca-options=\'' . stripslashes( wp_json_encode( $animation_opts ) ) . '\'';
		}

		return join( ' ', $opts );

	}

	protected function get_split_classname() {

		$classname = '';
		$prefix = 'lqd-split-';
		$split_type = $this->atts['split_type'];

		if ( ! $this->atts['enable_split'] ) {
			return $classname;
		};

		if ( $split_type === 'chars, words' ) {
			$classname = $prefix . 'chars';
		} else {
			$classname = $prefix . $split_type;
		}

		return $classname;

	}
	
	protected function get_animation_opts() {

		extract( $this->atts );

		$animation_target = '.lqd-lines > .split-inner';
		
		if ( 'chars, words' === $split_type ) {
			$animation_target = '.lqd-chars > .split-inner';
		} else if ( 'words' === $split_type ) {
			$animation_target = '.lqd-words > .split-inner';
		}
		
		$has_animation = false;
		$opts = $init_values = $animations_values = $arr = array();
		$opts['triggerHandler'] = 'inview';
		$opts['animationTarget'] = $animation_target;
		$opts['duration'] = !empty( $duration ) ? $duration : 1800;
		if( !empty( $start_delay ) ) {
			$opts['startDelay'] = $start_delay;
		}
		if( !empty( $enable_randomize ) ) {
			$opts['randomizeInitValues'] = true;
		}
		$opts['delay'] = !empty( $delay ) ? $delay : 100;
		$opts['ease'] = $easing;
		$opts['direction'] = $direction;
		
		//Init values
		if ( !empty( $ca_init_translate_x ) ) { $init_values['x'] = ( int ) $ca_init_translate_x; }
		if ( !empty( $ca_init_translate_y ) ) { $init_values['y'] = ( int ) $ca_init_translate_y; }
		if ( !empty( $ca_init_translate_z ) ) { $init_values['z'] = ( int ) $ca_init_translate_z; }
	
		if ( '1' !== $ca_init_scale_x ) { $init_values['scaleX'] = ( float ) $ca_init_scale_x; }
		if ( '1' !== $ca_init_scale_y ) { $init_values['scaleY'] = ( float ) $ca_init_scale_y; }
	
		if ( !empty( $ca_init_rotate_x ) ) { $init_values['rotationX'] = ( int ) $ca_init_rotate_x; }
		if ( !empty( $ca_init_rotate_y ) ) { $init_values['rotationY'] = ( int ) $ca_init_rotate_y; }
		if ( !empty( $ca_init_rotate_z ) ) { $init_values['rotationZ'] = ( int ) $ca_init_rotate_z; }
		
		if ( !empty( $ca_init_origin_x ) && '50%' !== $ca_init_origin_x ) {
			$init_values['transformOriginX'] = ( int ) $ca_init_origin_x;
		}
		if ( !empty( $ca_init_origin_y && '50%' !== $ca_init_origin_y ) ) {
			$init_values['transformOriginY'] = ( int ) $ca_init_origin_y;
		}
		if ( !empty( $ca_init_origin_z && '0px' !== $ca_init_origin_z ) ) {
			$init_values['transformOriginZ'] = $ca_init_origin_z;
		}

		if ( isset( $ca_init_opacity ) && '1' !== $ca_init_opacity ) { $init_values['opacity'] = ( float ) $ca_init_opacity; }
	
		//Animation values
		if ( !empty( $ca_init_translate_x ) ) { $animations_values['x'] = ( int ) $ca_an_translate_x; }
		if ( !empty( $ca_init_translate_y ) ) { $animations_values['y'] = ( int ) $ca_an_translate_y; }
		if ( !empty( $ca_init_translate_z ) ) { $animations_values['z'] = ( int ) $ca_an_translate_z; }
	
		if ( isset( $ca_an_scale_x ) && '1' !== $ca_init_scale_x ) { $animations_values['scaleX'] = ( float ) $ca_an_scale_x; }
		if ( isset( $ca_an_scale_y ) && '1' !== $ca_init_scale_y ) { $animations_values['scaleY'] = ( float ) $ca_an_scale_y; }
	
		if ( !empty( $ca_init_rotate_x ) ) { $animations_values['rotationX'] = ( int ) $ca_an_rotate_x; }
		if ( !empty( $ca_init_rotate_y ) ) { $animations_values['rotationY'] = ( int ) $ca_an_rotate_y; }
		if ( !empty( $ca_init_rotate_z ) ) { $animations_values['rotationZ'] = ( int ) $ca_an_rotate_z; }
		
		if ( !empty( $ca_an_origin_x ) && '50%' !== $ca_an_origin_x ) {
			$animations_values['transformOriginX'] = ( int ) $ca_an_origin_x;
		}
		if ( !empty( $ca_an_origin_y && '50%' !== $ca_an_origin_y ) ) {
			$animations_values['transformOriginY'] = ( int ) $ca_an_origin_y;
		}
		if ( !empty( $ca_an_origin_z && '0px' !== $ca_an_origin_z ) ) {
			$animations_values['transformOriginZ'] = $ca_an_origin_z;
		}
	
		if ( isset( $ca_an_opacity ) && '1' !== $ca_init_opacity ) { $animations_values['opacity'] = ( float ) $ca_an_opacity; }

		if ( ! empty( $init_values) || ! empty( $animations_values ) ) {
			$has_animation = true;
		}

		if ( ! empty( $init_values ) ) {
			$opts['initValues'] = $init_values;
		}
		if ( ! empty( $animations_values ) ) {
			$opts['animations'] = $animations_values;
		}

		return $has_animation ? $opts : '';
		
	}
	
	protected function add_mask() {
		
		if( !$this->atts['use_mask'] ) {
			return;
		}

		return 'mask-text';

	}

	protected function add_bg_mask() {
		
		if( empty( $this->atts['mask_image'] ) ) {
			return;	
		}

		return 'has-mask-image';

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

		if( !empty( $el_id ) ) {
			$id = '#' . $el_id;	
		}
		else {
			$id = '.' . $this->get_id();
		}

		$text_font_inline_style = '';
		
		$fh_box_shadow = vc_param_group_parse_atts( $fh_box_shadow );
		
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

		$elements[ liquid_implode( '%1$s ' . $tag  ) ] = array( $text_font_inline_style );

		if( !empty( $fs ) ) {
			if ( strpos( $fs, 'text_' ) !== false ) {
				$responsive_fs = Liquid_Responsive_Texfield_Param::generate_css( 'font-size', $fs, $_id . ' ' . $tag );
				$elements['media']['responsive-fs'] = $responsive_fs;
			}
			else {
				$elements[ liquid_implode( '%1$s ' . $tag  ) ]['font-size'] = $fs;
			}
		}
		if( !empty( $lh ) ) {		
			if ( strpos( $lh, 'text_' ) !== false ) {
				$responsive_lh = Liquid_Responsive_Texfield_Param::generate_css( 'line-height', $lh, $_id . ' ' . $tag );
				$elements['media']['responsive-lh'] = $responsive_lh;
				$responsive_lh_var = Liquid_Responsive_Texfield_Param::generate_css( '--element-line-height', $lh, $_id . ' ' . $tag );
				$elements['media']['responsive-lh-var'] = $responsive_lh_var;
			}
			else {
				$elements[ liquid_implode( '%1$s ' . $tag  ) ]['line-height'] = $lh;
				$elements[ liquid_implode( '%1$s ' . $tag  ) ]['--element-line-height'] = $lh;
			}	
		}
		if( !empty( $fw ) ) {
			if ( strpos( $fw, 'text_' ) !== false ) {
				$responsive_fw = Liquid_Responsive_Texfield_Param::generate_css( 'font-weight', $fw, $_id . ' ' . $tag );
				$elements['media']['responsive-fw'] = $responsive_fw;
			}
			else {
				$elements[ liquid_implode( '%1$s ' . $tag  ) ]['font-weight'] = $fw;
			}
		}
		if( !empty( $ls ) ) {		
			if ( strpos( $ls, 'text_' ) !== false ) {
				$responsive_ls = Liquid_Responsive_Texfield_Param::generate_css( 'letter-spacing', $ls, $_id . ' ' . $tag );
				$elements['media']['responsive-ls'] = $responsive_ls;
			}
			else {
				$elements[ liquid_implode( '%1$s ' . $tag  ) ]['letter-spacing'] = $ls;
			}
		}

		$elements[ liquid_implode( '%1$s ' . $tag  ) ]['color'] = !empty( $color ) ? $color : '';

		if ( !empty( $gradient ) ) {
			$elements[ liquid_implode( '%1$s .ld-fh-element'  ) ]['background'] = $gradient;
		}
		
		if( !empty( $fh_bg ) ) {
			$elements[ liquid_implode( '%1$s ' . $tag  ) ]['background'] = $fh_bg;
		}
		if( ! empty( $absolute_pos ) ) {
			$elements[ liquid_implode( '%1$s ' . $tag ) ]['position'] = 'absolute';
		}
		
		$responsive_pos = Liquid_Responsive_Param::generate_css( 'position', $position, $_id . ' ' . $tag );
		$elements['media']['position'] = $responsive_pos;
		
		$responsive_pad = Liquid_Responsive_Param::generate_css( 'padding', $padding, $_id . ' ' . $tag );
		$elements['media']['padding'] = $responsive_pad;

		$responsive_margin = Liquid_Responsive_Param::generate_css( 'margin', $margin, $_id . ' ' . $tag );
		$elements['media']['margin'] = $responsive_margin;
		
		if( !empty( $line_height ) ) {
			$elements[ liquid_implode( '%1$s .ld-fh-underline') ]['height'] = $line_height;
		}
		if( !empty( $line_width ) ) {
			$elements[ liquid_implode( '%1$s .ld-fh-underline') ]['width'] = $line_width;
		}
		if( !empty( $line_offset ) ) {
			$elements[ liquid_implode( '%1$s .ld-fh-underline') ]['bottom'] = $line_offset;
		}
		if( !empty( $line_color ) ) {
			$elements[ liquid_implode( '%1$s .ld-fh-underline') ]['background'] = $line_color;
		}
		if( !empty( $line_roudness ) ) {
			$elements[ liquid_implode( '%1$s .ld-fh-underline') ]['border-radius'] = $line_roudness;
		}
		
		
		if( !empty( $highlight_height ) ) {
			if ( 'lqd-highlight-underline' === $highlight_type ) {
				$elements[ liquid_implode( '%1$s .lqd-highlight-inner') ]['height'] = $highlight_height . '!important';
			} else {
				$elements[ liquid_implode( '%1$s .lqd-highlight-inner svg') ]['height'] = $highlight_height . '!important';
			}
		}
		if( !empty( $highlight_offset ) ) {
			$elements[ liquid_implode( '%1$s .lqd-highlight-inner') ]['bottom'] = $highlight_offset . '!important';
		}
		if( !empty( $highlight_color ) && 'lqd-highlight-underline' === $highlight_type ) {
			$elements[ liquid_implode( '%1$s .lqd-highlight-inner') ]['background'] = $highlight_color . '!important';
		}
		if( !empty( $highlight_color_brush ) ) {
			$elements[ liquid_implode( '%1$s .lqd-highlight-inner svg') ]['fill'] = $highlight_color_brush . '!important';
		}

		if( !empty( $highlight_roudness ) ) {
			$elements[ liquid_implode( '%1$s .lqd-highlight-inner') ]['border-radius'] = $highlight_roudness . '!important';
		}
		
		if( !empty( $word_colors ) ) {
			$elements[ liquid_implode( '%1$s .txt-rotate-keywords') ]['color'] = $word_colors;
		}
		
		//Shadow box for fh
		if( ! empty( $fh_box_shadow ) ) {	
			$fh_box_shadow_css = $this->get_shadow_css( $fh_box_shadow );
			$elements[liquid_implode( '%1$s ' . $tag )]['box-shadow'] = $fh_box_shadow_css;

		}
		
		if( !empty( $mask_image ) ) {
			if( preg_match( '/^\d+$/', $mask_image ) ){
				$src = liquid_get_image_src( $mask_image );
				$elements[ liquid_implode( '%1$s ' . $tag ) ]['background-image'] = 'url(' . esc_url( $src[0] ) . ')';
			} else {
				$src = $mask_image;
				$elements[ liquid_implode( '%1$s ' . $tag ) ]['background-image'] = 'url(' . esc_url( $src ) . ')';
			}
			if( !empty( $mask_bg_size ) ) {
				$elements[ liquid_implode( '%1$s ' . $tag ) ]['background-size'] = $mask_bg_size;
			}
			if( !empty( $mask_bg_repeat ) ) {
				$elements[ liquid_implode( '%1$s ' . $tag ) ]['background-repeat'] = $mask_bg_repeat;
			}
			if( !empty( $mask_bg_position ) ) {
				if( 'custom' !== $mask_bg_position ) {
					$elements[ liquid_implode( '%1$s ' . $tag ) ]['background-position'] = $mask_bg_position . ' !important';
				}
				else {
					$elements[ liquid_implode( '%1$s ' . $tag ) ]['background-position'] = $mask_bg_pos_h . ' ' . $mask_bg_pos_v . ' !important';
				}
			}
			$elements[ liquid_implode( ' %1$s ' . $tag ) ] = array(
				'background-clip' => 'text !important',
				'-webkit-background-clip' => 'text !important',
				'color' => 'transparent !important',
			);
		}
		
		if( !empty( $hover_text_outline_color ) ) {
			$elements[ liquid_implode( '%1$s .ld-fh-txt-outline' ) ]['-webkit-text-stroke-color'] = $hover_text_outline_color;			
		}
		if( !empty( $hover_text_outline_width ) ) {
			$elements[ liquid_implode( '%1$s .ld-fh-txt-outline' ) ]['-webkit-text-stroke-width'] = $hover_text_outline_width;			
		}

		$this->dynamic_css_parser( $id, $elements );
		
	}
	
}

new LD_Fancy_Heading;