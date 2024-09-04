<?php

/**
* Shortcode Simple Heading
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Simple_Heading extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_simple_heading';
		$this->title       = esc_html__( 'Simple Heading', 'landinghub-core' );
		$this->icon        = 'la la-text-height';

		parent::__construct();
	}

	public function get_params() {

		$this->params = array(
			
			array(
				'type'        => 'textarea_html',
				'param_name'  => 'content',
				'description' => esc_html__( 'Enter text for heading line.', 'landinghub-core' ),
				'value'       => esc_html__( 'Hey! I am first heading line feel free to change me', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-9',
				'holder'      => 'div',
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
				'std' => 'h2',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'color',
				'heading'    => esc_html__( 'Color', 'landinghub-core' ),
			),
			array(
				'type' => 'liquid_colorpicker',
				'only_gradient' => true,
				'param_name'  => 'gradient',
				'heading'     => esc_html__( 'Gradient', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			//Typo Options
			array(
				'type'        => 'responsive_textfield',
				'param_name'  => 'fs',
				'heading'     => esc_html__( 'Font Size', 'landinghub-core' ),
				'description' => esc_html__( 'Example: 20px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3 vc_column-with-padding',
				'group' => esc_html__( 'Text', 'landinghub-core' ),
			),
			array(
				'type'        => 'responsive_textfield',
				'param_name'  => 'lh',
				'heading'     => esc_html__( 'Line-Height', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'group' => esc_html__( 'Text', 'landinghub-core' ),
			),
			array(
				'type'        => 'responsive_textfield',
				'param_name'  => 'fw',
				'heading'     => esc_html__( 'Font Weight', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'group' => esc_html__( 'Text', 'landinghub-core' ),
			),
			array(
				'type'        => 'responsive_textfield',
				'param_name'  => 'ls',
				'heading'     => esc_html__( 'Letter Spacing', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'group' => esc_html__( 'Text', 'landinghub-core' ),
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
				'group' => esc_html__( 'Text', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			/*
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use for Title theme default font family?', 'landinghub-core' ),
				'param_name'  => 'use_theme_fonts',
				'value'       => array(
					esc_html__( 'Yes', 'landinghub-core' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'landinghub-core' ),
				'group' => esc_html__( 'Text', 'landinghub-core' ),
				'std'         => 'yes',
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'title_font',
				'value'      => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
				'settings'   => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'landinghub-core' ),
						'font_style_description'  => esc_html__( 'Select font styling.', 'landinghub-core' ),
					),
				),
				'group' => esc_html__( 'Text', 'landinghub-core' ),
				'dependency' => array(
					'element'            => 'use_theme_fonts',
					'value_not_equal_to' => 'yes',
				),
			),
			*/
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
	
	protected function get_heading() {
		
		$content = ld_helper()->do_the_content( $this->atts['content'], false );
		echo $content;
		
	}

	protected function generate_css() {

		$settings = get_option( 'wpb_js_google_fonts_subsets' );
		if ( is_array( $settings ) && !empty( $settings ) ) {
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

		$title_font_inline_style = '';
		
		/*
		if( 'yes' !== $use_theme_fonts ) {

			// Build the data array
			$title_font_data = $this->get_fonts_data( $title_font );

			// Build the inline style
			$title_font_inline_style = $this->google_fonts_style( $title_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $title_font_data );

		}
		*/
		$fh_box_shadow = vc_param_group_parse_atts( $fh_box_shadow );
		
		//Shadow box for fh
		if( ! empty( $fh_box_shadow ) ) {	
			$fh_box_shadow_css = $this->get_shadow_css( $fh_box_shadow );
			$elements[liquid_implode( '%1$s ' . $tag )]['box-shadow'] = $fh_box_shadow_css;

		}

		$elements[ liquid_implode( '%1$s ' . $tag ) ] = array( $title_font_inline_style );
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
		$elements[ liquid_implode( '%1$s ' . $tag ) ]['text-transform'] = !empty( $transform ) ? $transform : '';
		$elements[ liquid_implode( '%1$s ' . $tag ) ]['color'] = !empty( $color ) ? $color : '';
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

		if ( !empty( $gradient ) ) {
			$elements[ liquid_implode( '%1$s .lqd-simple-heading'  ) ]['background'] = $gradient;
		}
		
		$this->dynamic_css_parser( $id, $elements );
	}
	
}

new LD_Simple_Heading;