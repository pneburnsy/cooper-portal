<?php
/**
* Shortcode Liquid Overlay Text
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Image_Overlay_Text extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug         = 'ld_imgage_overlay_text';
		$this->title        = esc_html__( 'Image + Overlay Text', 'landinghub-core' );
		$this->icon            = 'la la-image';
		$this->description  = esc_html__( 'Add an image with overlay text', 'landinghub-core' );
		$this->scripts      = array( 'threejs', 'jquery-fresco', 'lity', 'splittext' );
		$this->styles       = array( 'fresco' );
		$this->show_settings_on_create = true;

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
				'type'       => 'liquid_attach_image',
				'param_name' => 'image',
				'heading'    => esc_html__( 'Image', 'landinghub-core' ),
				'descripton' => esc_html__( 'Add image from gallery or upload new', 'landinghub-core' ),
			),
			array(
				'type'        => 'vc_link',
				'param_name'  => 'img_link',
				'heading'     => esc_html__( 'Link', 'landinghub-core' ),
			),
			array(
				'id' => 'title',
				'edit_field_class' => 'vc_col-sm-8 vc_column-with-padding',
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_title',
				'heading'     => esc_html__( 'Custom font?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use custom font for title', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'subtitle',
				'heading'     => esc_html__( 'Subtitle', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-8 vc_column-with-padding',
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_subtitle',
				'heading'     => esc_html__( 'Custom font?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use custom font for subtitle', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'info',
				'heading'     => esc_html__( 'Info', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-8 vc_column-with-padding',
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_info',
				'heading'     => esc_html__( 'Custom font?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use custom font for info', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type'       => 'textarea_html',
				'param_name' => 'content',
				'heading'    => esc_html__( 'Text', 'landinghub-core' ),
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
				'heading'     => esc_html__( 'Use for Subtitle theme default font family?', 'landinghub-core' ),
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
			//Typo Info Options
			array(
				'type'        => 'textfield',
				'param_name'  => 'fs_info',
				'heading'     => esc_html__( 'Font Size', 'landinghub-core' ),
				'description' => esc_html__( 'Example: 20px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3 vc_column-with-padding',
				'dependency' => array(
					'element' => 'use_custom_fonts_info',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Info Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'lh_info',
				'heading'     => esc_html__( 'Line-Height', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_info',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Info Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'fw_info',
				'heading'     => esc_html__( 'Font Weight', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_info',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Info Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'ls_info',
				'heading'     => esc_html__( 'Letter Spacing', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_info',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Info Typo', 'landinghub-core' ),
			),
			/*
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use for Info theme default font family?', 'landinghub-core' ),
				'param_name'  => 'use_theme_fonts_info',
				'value'       => array(
					esc_html__( 'Yes', 'landinghub-core' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'landinghub-core' ),
				'group' => esc_html__( 'Info Typo', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_info',
					'value'   => 'true',
				),
				'std'         => 'yes',
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'info_font',
				'value'      => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
				'settings'   => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'landinghub-core' ),
						'font_style_description'  => esc_html__( 'Select font styling.', 'landinghub-core' ),
					),
				),
				'group'      => esc_html__( 'Info Typo', 'landinghub-core' ),
				'dependency' => array(
					'element'            => 'use_theme_fonts_info',
					'value_not_equal_to' => 'yes',
				),
			),
			*/
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'color',
				'heading'     => esc_html__( 'Title Fill Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'stroke_color',
				'heading'     => esc_html__( 'Title Stroke Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'subtitle_color',
				'heading'     => esc_html__( 'Subtitle Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'info_color',
				'heading'     => esc_html__( 'Info Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			

		);
		
		$this->params = array_merge( $params, $button );
		$this->add_extras();
	}
	

	protected function get_image() {

		// check
		if( empty( $this->atts['image'] ) ) {
			return;
		}
		
		$alt = get_post_meta( $this->atts['image'], '_wp_attachment_image_alt', true );
		$image_opts = array();
		
		if( preg_match( '/^\d+$/', $this->atts['image'] ) ){
			$image  = '<figure class="invisible">' . wp_get_attachment_image( $this->atts['image'], 'full', false, $image_opts ) . '</figure>';
		} else {
			$image = '<figure class="invisible"><img src="' . esc_url( $this->atts['image'] ) . '" alt="' . esc_attr( $alt ) . '" /></figure>';
		}

		echo $image;

	}
	
	protected function get_content() {

		// check
		if( empty( $this->atts['content'] ) ) {
			return '';
		}

		$content = ld_helper()->do_the_content( $this->atts['content'] );

		echo $content;
	}
	
	protected function get_button() {

		if ( empty( $this->atts['show_button'] ) ) {
			return;
		}

		$data = vc_map_integrate_parse_atts( $this->slug, 'ld_button', $this->atts, 'ib_' );
		if ( $data ) {

			$btn = visual_composer()->getShortCode( 'ld_button' )->shortcodeClass();

			if ( is_object( $btn ) ) {
				echo $btn->render( array_filter( $data ) );
			}
		}
	}
	
	protected function get_overlay_link() {

		$link = liquid_get_link_attributes( $this->atts['img_link'], false );
		
		if ( !empty( $link['href'] ) ) {
			printf( '<a%s class="lqd-overlay lqd-iot-link lqd-cc-label-trigger z-index-2"></a>', ld_helper()->html_attributes( $link ));
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
		
		$title_font_inline_style = $subtitle_font_inline_style = $info_font_inline_style = '';
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

		$elements[ liquid_implode( '%1$s .lqd-iot-overlay-txt h2' ) ] = array( $title_font_inline_style );
		$elements[ liquid_implode( '%1$s .lqd-iot-overlay-txt h2' ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ liquid_implode( '%1$s .lqd-iot-overlay-txt h2' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ liquid_implode( '%1$s .lqd-iot-overlay-txt h2' ) ]['font-weight'] = !empty( $fw ) ? $fw . ' !important' : '';
		$elements[ liquid_implode( '%1$s .lqd-iot-overlay-txt h2' ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';
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
		$elements[ liquid_implode( '%1$s .lqd-iot-content-left h3' ) ] = array( $subtitle_font_inline_style );
		$elements[ liquid_implode( '%1$s .lqd-iot-content-left h3' ) ]['font-size'] = !empty( $fs_subtitle ) ? $fs_subtitle : '';
		$elements[ liquid_implode( '%1$s .lqd-iot-content-left h3' ) ]['line-height'] = !empty( $lh_subtitle ) ? $lh_subtitle : '';
		$elements[ liquid_implode( '%1$s .lqd-iot-content-left h3' ) ]['font-weight'] = !empty( $fw_subtitle ) ? $fw_subtitle . ' !important' : '';
		$elements[ liquid_implode( '%1$s .lqd-iot-content-left h3' ) ]['letter-spacing'] = !empty( $ls_subtitle ) ? $ls_subtitle : '';
		/*
		if( 'yes' !== $use_theme_fonts_info ) {

			// Build the data array
			$info_font_data = $this->get_fonts_data( $info_font );

			// Build the inline style
			$info_font_inline_style = $this->google_fonts_style( $info_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $info_font_data );

		}
		*/
		$elements[ liquid_implode( '%1$s .lqd-iot-cat' ) ] = array( $info_font_inline_style );
		$elements[ liquid_implode( '%1$s .lqd-iot-cat' ) ]['font-size'] = !empty( $fs_info ) ? $fs_info : '';
		$elements[ liquid_implode( '%1$s .lqd-iot-cat' ) ]['line-height'] = !empty( $lh_info ) ? $lh_info : '';
		$elements[ liquid_implode( '%1$s .lqd-iot-cat' ) ]['font-weight'] = !empty( $fw_info ) ? $fw_info . ' !important' : '';
		$elements[ liquid_implode( '%1$s .lqd-iot-cat' ) ]['letter-spacing'] = !empty( $ls_info ) ? $ls_info : '';
		
		if( !empty( $color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-iot-overlay-txt h2' ) ]['color'] = $color;
		}
		if( !empty( $stroke_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-iot-overlay-txt h2' ) ]['-webkit-text-stroke-color'] = $stroke_color;
			$elements[ liquid_implode( '%1$s .lqd-iot-overlay-txt h2' ) ]['text-stroke-color'] = $stroke_color;
		}
		if( !empty( $subtitle_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-iot-content-left h3' ) ]['color'] = $subtitle_color;
		}
		if( !empty( $info_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-iot-cat' ) ]['color'] = $info_color;
		}



		$this->dynamic_css_parser( $id, $elements );
	}

}
new LD_Image_Overlay_Text;