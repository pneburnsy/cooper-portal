<?php
/**
* Shortcode Liquid Carousel
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Bananas_Banner extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug         = 'ld_bananas_banner';
		$this->title        = esc_html__( 'Banner Bananas', 'landinghub-core' );
		$this->icon         = 'la la-arrows';
		$this->show_settings_on_create        = true;
		$this->description  = esc_html__( 'Create a 3D banner with effect.', 'landinghub-core' );

		parent::__construct();
	}

	public function get_params() {
		
		$this->params = array(
			
			array(
				'type'       => 'liquid_attach_image',
				'param_name' => 'image',
				'heading'    => esc_html__( 'Image', 'landinghub-core' ),
				'descripton' => esc_html__( 'Add an image from gallery or upload new', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'heading',
				'heading'     => esc_html__( 'Heading', 'landinghub-core' ),
				'description' => esc_html__( 'Add heading', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-8'
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_heading',
				'heading'     => esc_html__( 'Custom font?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use custom font for heading', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3'
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'heading2',
				'heading'     => esc_html__( 'Heading 2', 'landinghub-core' ),
				'description' => esc_html__( 'Add heading', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-8',
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_heading2',
				'heading'     => esc_html__( 'Custom font?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use custom font for heading', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3'
			),
			
			//Typo Options
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_heading_typo',
				'heading'    => esc_html__( 'Heading Typography', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_heading',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'fs',
				'heading'     => esc_html__( 'Font Size', 'landinghub-core' ),
				'description' => esc_html__( 'Example: 20px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3 vc_column-with-padding',
				'dependency' => array(
					'element' => 'use_custom_fonts_heading',
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
					'element' => 'use_custom_fonts_heading',
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
					'element' => 'use_custom_fonts_heading',
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
					'element' => 'use_custom_fonts_heading',
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
					'element' => 'use_custom_fonts_heading',
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
					'element' => 'use_custom_fonts_heading',
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
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the heading', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_heading',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			
			//Typo 2 Options
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_heading_typo2',
				'heading'    => esc_html__( 'Heading 2 Typography', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_heading2',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'fs2',
				'heading'     => esc_html__( 'Font Size', 'landinghub-core' ),
				'description' => esc_html__( 'Example: 20px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3 vc_column-with-padding',
				'dependency' => array(
					'element' => 'use_custom_fonts_heading2',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'lh2',
				'heading'     => esc_html__( 'Line-Height', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_heading2',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'fw2',
				'heading'     => esc_html__( 'Font Weight', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_heading2',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'ls2',
				'heading'     => esc_html__( 'Letter Spacing', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_heading2',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'transform2',
				'heading'    => esc_html__( 'Transformation', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Default', 'landinghub-core' )    => '',
					esc_html__( 'Uppercase', 'landinghub-core' )  => 'uppercase',
					esc_html__( 'Lowercase', 'landinghub-core' )  => 'lowercase',
					esc_html__( 'Capitalize', 'landinghub-core' ) => 'capitalize',
				),
				'dependency' => array(
					'element' => 'use_custom_fonts_heading2',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			/*
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use for Title theme default font family?', 'landinghub-core' ),
				'param_name'  => 'use_theme_fonts2',
				'value'       => array(
					esc_html__( 'Yes', 'landinghub-core' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'landinghub-core' ),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_heading2',
					'value'   => 'true',
				),
				'std'         => 'yes',
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'menu_font2',
				'value'      => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
				'settings'   => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'landinghub-core' ),
						'font_style_description'  => esc_html__( 'Select font styling.', 'landinghub-core' ),
					),
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
				'dependency' => array(
					'element'            => 'use_theme_fonts2',
					'value_not_equal_to' => 'yes',
				),
			),
			*/
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'color2',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the heading', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_heading2',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			

		);
		

		
		$this->add_extras();
	
	}

	protected function get_image() {

		// check
		if( empty( $this->atts['image'] ) ) {
			return;
		}
		
		$img_src = $html = '';
		if( preg_match( '/^\d+$/', $this->atts['image'] ) ){
			$src = liquid_get_image_src( $this->atts['image'] );
			$img_src = $src[0];
			$html = wp_get_attachment_image( $this->atts['image'], 'full', false, array( 'data-rjs' => $img_src ) );
		} else {
			$img_src  = $this->atts['image'];
			$html = '<img src="' . esc_url( $img_src ) . '" alt="" />';
		}

		$image = sprintf( '<figure>%s</figure>', $html );
		
		echo $image;

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
		
		$menu_font_inline_style = $menu_font_inline_style2 =  '';
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
		
		$elements[ liquid_implode( '%1$s .lqd-bnr-bnns-h' ) ] = array( $menu_font_inline_style );
		$elements[ liquid_implode( '%1$s .lqd-bnr-bnns-h' ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ liquid_implode( '%1$s .lqd-bnr-bnns-h' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ liquid_implode( '%1$s .lqd-bnr-bnns-h' ) ]['font-weight'] = !empty( $fw ) ? $fw : '';
		$elements[ liquid_implode( '%1$s .lqd-bnr-bnns-h' ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';
		if( !empty( $color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-bnr-bnns-h' ) ]['color'] = $color;
		}
		/*
		if( 'yes' !== $use_theme_fonts2 ) {

			// Build the data array
			$menu_font_data2 = $this->get_fonts_data( $menu_font2 );

			// Build the inline style
			$menu_font_inline_style2 = $this->google_fonts_style( $menu_font_data2 );

			// Enqueue the right font
			$this->enqueue_google_fonts( $menu_font_data2 );

		}
		*/
		
		$elements[ liquid_implode( '%1$s .lqd-bnr-bnns-h-inner' ) ] = array( $menu_font_inline_style2 );
		$elements[ liquid_implode( '%1$s .lqd-bnr-bnns-h-inner' ) ]['font-size'] = !empty( $fs2 ) ? $fs2 : '';
		$elements[ liquid_implode( '%1$s .lqd-bnr-bnns-h-inner' ) ]['line-height'] = !empty( $lh2 ) ? $lh2 : '';
		$elements[ liquid_implode( '%1$s .lqd-bnr-bnns-h-inner' ) ]['font-weight'] = !empty( $fw2 ) ? $fw2 : '';
		$elements[ liquid_implode( '%1$s .lqd-bnr-bnns-h-inner' ) ]['letter-spacing'] = !empty( $ls2 ) ? $ls2 : '';

		if( !empty( $color2 ) ) {
			$elements[ liquid_implode( '%1$s .lqd-bnr-bnns-h-inner' ) ]['color'] = $color2;
		}
		

		$this->dynamic_css_parser( $id, $elements );
	}

}
new LD_Bananas_Banner;