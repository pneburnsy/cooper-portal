<?php
/**
* Shortcode Asymmetric Slider
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly
	
/**
* LD_Shortcode
*/
class LD_Asymmetric_Slider extends LD_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug     = 'ld_asymmetric_slider';
		$this->title    = esc_html__( 'Asymmetric Slider', 'landinghub-core' );
		$this->show_settings_on_create        = true;
		$this->icon     = 'la la-file-image-o';

		parent::__construct();
	}

	public function get_params() {
		
		$button = vc_map_integrate_shortcode( 'ld_button', 'ib_', esc_html__( 'Button', 'landinghub-core' ),
			array(
				'exclude' => array(
					'el_id',
					'el_class',
					'sh_shadowbox',
					'enable_row_shadowbox',
					'button_box_shadow',
					'hover_button_box_shadow'
				),
			),
			array(
				'element' => 'show_button',
				'value'   => 'yes',
			)
		);

		
		$params = array(
			
			array(
				'type'       => 'param_group',
				'param_name' => 'identities',
				'heading'    => esc_html__( 'Items', 'landinghub-core' ),
				'params'     => array(
					array(
						'type'        => 'textfield',
						'param_name'  => 'title',
						'heading'     => esc_html__( 'Title', 'landinghub-core' ),
						'description' => esc_html__(  'Add title', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'subtitle',
						'heading'     => esc_html__( 'Subtitle', 'landinghub-core' ),
						'description' => esc_html__(  'Add subtitle', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6',
					),
					array(
						'type'        => 'textarea',
						'param_name'  => 'description',
						'heading'     => esc_html__( 'Text', 'landinghub-core' ),
						'description' => esc_html__(  'Add text', 'landinghub-core' ),
					),
					array(
						'type'        => 'attach_image',
						'param_name'  => 'image',
						'heading'     => esc_html__( 'Image', 'landinghub-core' ),
						'description' => esc_html__( 'Add image to show in the slider item', 'landinghub-core' )
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'btn_label',
						'heading'     => esc_html__( 'Button Label', 'landinghub-core' ),
						'description' => esc_html__(  'Add button laber', 'landinghub-core' ),
						'std' => esc_html__( 'See latest projects', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6',
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'url',
						'heading'     => esc_html__( 'URL (Link)', 'landinghub-core' ),
						'description' => esc_html__(  'Add button link', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6',
					)
				)
			),
			
			array( 
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_title',
				'heading'     => esc_html__( 'Custom font (Title)?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use custom font for title', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array( 
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_subtitle',
				'heading'     => esc_html__( 'Custom font (Subtitle) ?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use custom font for subtitle', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array( 
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_text',
				'heading'     => esc_html__( 'Custom font (Text)?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use custom font for text', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4',				
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'show_button',
				'heading'    => esc_html__( 'Show Button', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'No', 'landinghub-core' )  => '',
					esc_html__( 'Yes', 'landinghub-core' ) => 'yes'
				),
			),
			//Typo Title Options
			array(
				'type'        => 'textfield',
				'param_name'  => 'fs',
				'heading'     => esc_html__( 'Font Size', 'landinghub-core' ),
				'description' => esc_html__( 'Example: 20px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3 vc_column-with-padding',
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Title Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'lh',
				'heading'     => esc_html__( 'Line-Height', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Title Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'fw',
				'heading'     => esc_html__( 'Font Weight', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Title Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'ls',
				'heading'     => esc_html__( 'Letter Spacing', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Title Typo', 'landinghub-core' ),
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
				'group' => esc_html__( 'Title Typo', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
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
				'group'      => esc_html__( 'Title Typo', 'landinghub-core' ),
				'dependency' => array(
					'element'            => 'use_theme_fonts',
					'value_not_equal_to' => 'yes',
				),
			),
			*/
			
			//Typo Subtitle Options
			array(
				'type'        => 'textfield',
				'param_name'  => 'fs_subtitle',
				'heading'     => esc_html__( 'Font Size', 'landinghub-core' ),
				'description' => esc_html__( 'Example: 20px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3 vc_column-with-padding',
				'dependency' => array(
					'element' => 'use_custom_fonts_subtitle',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Subtitle Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'lh_subtitle',
				'heading'     => esc_html__( 'Line-Height', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_subtitle',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Subtitle Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'fw_subtitle',
				'heading'     => esc_html__( 'Font Weight', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_subtitle',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Subtitle Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'ls_subtitle',
				'heading'     => esc_html__( 'Letter Spacing', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_subtitle',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Subtitle Typo', 'landinghub-core' ),
			),
			/*
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use for Title theme default font family?', 'landinghub-core' ),
				'param_name'  => 'use_theme_fonts_subtitle',
				'value'       => array(
					esc_html__( 'Yes', 'landinghub-core' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'landinghub-core' ),
				'group' => esc_html__( 'Subtitle Typo', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_subtitle',
					'value'   => 'true',
				),
				'std'         => 'yes',
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'subtitle_font',
				'value'      => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
				'settings'   => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'landinghub-core' ),
						'font_style_description'  => esc_html__( 'Select font styling.', 'landinghub-core' ),
					),
				),
				'group'      => esc_html__( 'Subtitle Typo', 'landinghub-core' ),
				'dependency' => array(
					'element'            => 'use_theme_fonts_subtitle',
					'value_not_equal_to' => 'yes',
				),
			),
			*/
			
			//Typo Text Options
			array(
				'type'        => 'textfield',
				'param_name'  => 'fs_text',
				'heading'     => esc_html__( 'Font Size', 'landinghub-core' ),
				'description' => esc_html__( 'Example: 20px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3 vc_column-with-padding',
				'dependency' => array(
					'element' => 'use_custom_fonts_text',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Text Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'lh_text',
				'heading'     => esc_html__( 'Line-Height', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_text',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Text Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'fw_text',
				'heading'     => esc_html__( 'Font Weight', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_text',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Text Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'ls_text',
				'heading'     => esc_html__( 'Letter Spacing', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_text',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Text Typo', 'landinghub-core' ),
			),
			/*
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use for Title theme default font family?', 'landinghub-core' ),
				'param_name'  => 'use_theme_fonts_text',
				'value'       => array(
					esc_html__( 'Yes', 'landinghub-core' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'landinghub-core' ),
				'group' => esc_html__( 'Text Typo', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_text',
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
				'group'      => esc_html__( 'Text Typo', 'landinghub-core' ),
				'dependency' => array(
					'element'            => 'use_theme_fonts_text',
					'value_not_equal_to' => 'yes',
				),
			),
			*/
			
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'color',
				'heading'     => esc_html__( 'Title Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4 vc_column-with-padding',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'subtitle_color',
				'heading'     => esc_html__( 'Subtitle Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'text_color',
				'heading'     => esc_html__( 'Text Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'stroke_color',
				'heading'     => esc_html__( 'Stroke Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
			),
			
			array(
				'type'       => 'subheading',
				'param_name' => 'nav_colors_separator',
				'heading'    => esc_html__( 'Navigation Colors', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'nav_bg_color',
				'heading'     => esc_html__( 'Background Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'nav_arrow_color',
				'heading'     => esc_html__( 'Arrow Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'nav_bg_hcolor',
				'heading'     => esc_html__( 'Hover Background Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'nav_arrow_hcolor',
				'heading'     => esc_html__( 'Hover Arrow Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
			),
			
		);
		$this->params = array_merge( $params, $button );
		$this->add_extras();

	}


	protected function get_button( $label = '', $url = '' ) {

		if ( empty( $this->atts['show_button'] ) ) {
			return;
		}
			
		$data = vc_map_integrate_parse_atts( $this->slug, 'ld_button', $this->atts, 'ib_' );
		if ( $data ) {
			
			if( !empty( $label ) ) {
				$data['title'] = $label;
			}
			if( !empty( $url ) ) {
				$data['link'] = 'url:' . $url;
			}
			
			$btn = visual_composer()->getShortCode( 'ld_button' )->shortcodeClass();

			if ( is_object( $btn ) ) {
				echo $btn->render( array_filter( $data ) );
			}
		}
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

		$title_font_inline_style = $subtitle_font_inline_style = $text_font_inline_style = '';
		
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

		$elements[ liquid_implode( '%1$s .lqd-asym-slider-content h2' ) ] = array( $title_font_inline_style );
		$elements[ liquid_implode( '%1$s .lqd-asym-slider-content h2' ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ liquid_implode( '%1$s .lqd-asym-slider-content h2' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ liquid_implode( '%1$s .lqd-asym-slider-content h2' ) ]['font-weight'] = !empty( $fw ) ? $fw . ' !important' : '';
		$elements[ liquid_implode( '%1$s .lqd-asym-slider-content h2' ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';
		
		/*
		if( 'yes' !== $use_theme_fonts_subtitle ) {

			// Build the data array
			$subtitle_font_data = $this->get_fonts_data( $subtitle_font );

			// Build the inline style
			$subtitle_font_inline_style = $this->google_fonts_style( $subtitle_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $subtitle_font_data );

		}
		*/

		$elements[ liquid_implode( '%1$s .lqd-asym-slider-content h4' ) ] = array( $subtitle_font_inline_style );
		$elements[ liquid_implode( '%1$s .lqd-asym-slider-content h4' ) ]['font-size'] = !empty( $fs_subtitle ) ? $fs_subtitle : '';
		$elements[ liquid_implode( '%1$s .lqd-asym-slider-content h4' ) ]['line-height'] = !empty( $lh_subtitle ) ? $lh_subtitle : '';
		$elements[ liquid_implode( '%1$s .lqd-asym-slider-content h4' ) ]['font-weight'] = !empty( $fw_subtitle ) ? $fw_subtitle . ' !important' : '';
		$elements[ liquid_implode( '%1$s .lqd-asym-slider-content h4' ) ]['letter-spacing'] = !empty( $ls_subtitle ) ? $ls_subtitle : '';
		
		/*
		if( 'yes' !== $use_theme_fonts_text ) {

			// Build the data array
			$text_font_data = $this->get_fonts_data( $text_font );

			// Build the inline style
			$text_font_inline_style = $this->google_fonts_style( $text_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $text_font_data );

		}
		*/

		$elements[ liquid_implode( '%1$s .lqd-asym-slider-content p' ) ] = array( $text_font_inline_style );
		$elements[ liquid_implode( '%1$s .lqd-asym-slider-content p' ) ]['font-size'] = !empty( $fs_text ) ? $fs_text : '';
		$elements[ liquid_implode( '%1$s .lqd-asym-slider-content p' ) ]['line-height'] = !empty( $lh_text ) ? $lh_text : '';
		$elements[ liquid_implode( '%1$s .lqd-asym-slider-content p' ) ]['font-weight'] = !empty( $fw_text ) ? $fw_text . ' !important' : '';
		$elements[ liquid_implode( '%1$s .lqd-asym-slider-content p' ) ]['letter-spacing'] = !empty( $ls_text ) ? $ls_text : '';
		
		if( !empty( $color ) && isset( $color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-asym-slider-content h2' ) ]['color'] = $color;
		}
		if( !empty( $subtitle_color ) && isset( $subtitle_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-asym-slider-content h4' ) ]['color'] = $subtitle_color;
		}
		if( !empty( $text_color ) && isset( $text_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-asym-slider-content p' ) ]['color'] = $text_color;
		}
		if( !empty( $title_color ) && isset( $title_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-asym-slider-content h2' ) ]['color'] = $title_color;
		}	
		if( !empty( $stroke_color ) && isset( $stroke_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-asym-slider-content hr' ) ]['border-color'] = $stroke_color;
		}	
		
		if( !empty( $nav_bg_color ) && isset( $nav_bg_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-asym-slider-arrow' ) ]['background'] = $nav_bg_color;
		}	
		if( !empty( $nav_arrow_color ) && isset( $nav_arrow_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-asym-slider-arrow' ) ]['color'] = $nav_arrow_color;
		}
		if( !empty( $nav_bg_hcolor ) && isset( $nav_bg_hcolor ) ) {
			$elements[ liquid_implode( '%1$s .lqd-asym-slider-arrow:before' ) ]['background'] = $nav_bg_hcolor;
		}	
		if( !empty( $nav_arrow_hcolor ) && isset( $nav_arrow_hcolor ) ) {
			$elements[ liquid_implode( '%1$s .lqd-asym-slider-arrow:hover' ) ]['color'] = $nav_arrow_hcolor;
		}
		
		$this->dynamic_css_parser( $id, $elements );
	}


}
new LD_Asymmetric_Slider;