<?php

/**
* Shortcode Promo
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Typewriter extends LD_Shortcode { 

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_typewriter';
		$this->title       = esc_html__( 'Typewriter', 'landinghub-core' );
		$this->description = esc_html__( 'Add a typewriter text', 'landinghub-core' );
		$this->icon        = 'la la-text-height';
		$this->scripts      = array( 'typewriter' );
		$this->show_settings_on_create = true;

		parent::__construct();
	}
	
	public function get_params() {
		
		$params = array(

			array(
				'type'       => 'textarea',
				'param_name' => 'content',
				'heading'    => esc_html__( 'Text', 'landinghub-core' ),
				'description' => wp_kses_post( __( 'Check <a href="https://mntn-dev.github.io/t.js/" target="_blank">here</a> for examples of the usage', 'landinghub-core' ) ),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'tag',
				'heading'     => esc_html__( 'Element tag', 'landinghub-core' ),
				'description' => esc_html__( 'Select element tag.', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'p', 'landinghub-core' )   => 'p',
					esc_html__( 'h1', 'landinghub-core' )  => 'h1',
					esc_html__( 'h2', 'landinghub-core' )  => 'h2',
					esc_html__( 'h3', 'landinghub-core' )  => 'h3',
					esc_html__( 'h4', 'landinghub-core' )  => 'h4',
					esc_html__( 'h5', 'landinghub-core' )  => 'h5',
					esc_html__( 'h6', 'landinghub-core' )  => 'h6',
					esc_html__( 'div', 'landinghub-core' ) => 'div',
				),
				'std' => 'p',
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_title',
				'heading'     => esc_html__( 'Custom font?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use custom font for title', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

		);
		
		$typo = array(
			//Typo Options
			array(
				'type'        => 'responsive_textfield',
				'param_name'  => 'fs',
				'heading'     => esc_html__( 'Font Size', 'landinghub-core' ),
				'description' => esc_html__( 'Example: 20px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3 vc_column-with-padding',
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'responsive_textfield',
				'param_name'  => 'lh',
				'heading'     => esc_html__( 'Line-Height', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'responsive_textfield',
				'param_name'  => 'fw',
				'heading'     => esc_html__( 'Font Weight', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'responsive_textfield',
				'param_name'  => 'ls',
				'heading'     => esc_html__( 'Letter Spacing', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
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
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
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
				'group'      => esc_html__( 'Typo', 'landinghub-core' ),
				'dependency' => array(
					'element'            => 'use_theme_fonts',
					'value_not_equal_to' => 'yes',
				),
			),
			*/
		);
		
		$design = array(

			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'color',
				'heading'     => esc_html__( 'Primary Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color as primary', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
			),

		);
	
		$this->params = array_merge( $params, $typo, $design );
		$this->add_extras();

	}
	
	
	protected function generate_css() {

		extract( $this->atts );

		$elements = array();

		if( !empty( $el_id ) ) {
			$id = '#' . $el_id;	
		}
		else {
			$id = '.' . $this->get_id();
		}
		
		$text_font_inline_style = '';
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
		$elements[ liquid_implode( '%1$s ' . $tag ) ] = array( $text_font_inline_style );

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

		$elements[ liquid_implode( '%1$s ' . $tag ) ]['color'] = !empty( $color ) ? $color : '';


		$this->dynamic_css_parser( $id, $elements );

	}
	
}

new LD_Typewriter;