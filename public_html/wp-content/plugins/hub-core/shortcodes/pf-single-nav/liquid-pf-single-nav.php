<?php
/**
* Shortcode Porftfolio Single Title
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Pf_Single_Nav extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug = 'ld_single_portfolio_nav';
		$this->title = esc_html__( 'Portfolio Single Navigation', 'landinghub-core' );
		$this->icon = 'la la-folder';
		$this->description = esc_html__( 'Display Portfolio Single Post Navigation', 'landinghub-core' );
		// $this->category    = esc_html__( 'Portfolio Components', 'landinghub-core' );
		
		parent::__construct();
	}

	public function get_params() {
		
		$this->params = array(
			array(
				'type'       => 'dropdown',
				'param_name' => 'template',
				'heading'    => esc_html__( 'Style', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Classic', 'landinghub-core' )							 => 'classic',
					esc_html__( 'Classic - Minimal', 'landinghub-core' )		 => 'classic-minimal',
					esc_html__( 'Modern', 'landinghub-core' )					 => 'no-classic',
					esc_html__( 'Modern - Outline', 'landinghub-core' ) => 'no-classic-outline',
				),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_title',
				'heading'     => esc_html__( 'Custom font?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use custom font for nav', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'template',
					'value'   => array( 'no-classic', 'no-classic-outline' ),
				),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_inheritance',
				'heading'     => esc_html__( 'Inherit font styles?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to enable font style inheritance', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'template',
					'value'   => array( 'no-classic', 'no-classic-outline' ),
				),
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
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'color',
				'heading'     => esc_html__( 'Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
			),
			array( 
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'hcolor',
				'heading'     => esc_html__( 'Hover Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
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
				'group' => esc_html__( 'Nav Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'lh',
				'heading'     => esc_html__( 'Line-Height', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Nav Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'fw',
				'heading'     => esc_html__( 'Font Weight', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Nav Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'ls',
				'heading'     => esc_html__( 'Letter Spacing', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Nav Typo', 'landinghub-core' ),
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
				'group' => esc_html__( 'Nav Typo', 'landinghub-core' ),
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
				'group'      => esc_html__( 'Nav Typo', 'landinghub-core' ),
				'dependency' => array(
					'element'            => 'use_theme_fonts',
					'value_not_equal_to' => 'yes',
				),
			),
			*/

		);
		
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
		
		$text_font_inline_style = $subtitle_font_inline_style = '';
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
		$elements[ liquid_implode( '%1$s .lqd-pf-nav-link-title' ) ] = array( $text_font_inline_style );
		$elements[ liquid_implode( '%1$s .lqd-pf-nav-link-title' ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ liquid_implode( '%1$s .lqd-pf-nav-link-title' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ liquid_implode( '%1$s .lqd-pf-nav-link-title' ) ]['font-weight'] = !empty( $fw ) ? $fw . ' !important' : '';
		$elements[ liquid_implode( '%1$s .lqd-pf-nav-link-title' ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';		


		if( ! empty( $color ) && isset( $color ) ) {
			$elements[ liquid_implode( '%1$s.lqd-pf-meta-nav' ) ]['color'] = $color;
			if ( 'no-classic-outline' === $template ) {
				$elements[ liquid_implode( '%1$s.lqd-pf-meta-nav .lqd-pf-nav-link-title' ) ]['-webkit-text-stroke-color'] = $color;
			}
			if ( empty($hcolor) && ! isset($hcolor) ) {
				$elements[ liquid_implode( '%1$s.lqd-pf-meta-nav .lqd-pf-nav-link:hover .lqd-pf-nav-link-title' ) ]['-webkit-text-stroke-color'] = 'transparent';
				$elements[ liquid_implode( '%1$s.lqd-pf-meta-nav .lqd-pf-nav-link:hover .lqd-pf-nav-link-title' ) ]['color'] = $color;
			}
		}

		if ( ! empty($hcolor) && isset($hcolor) ) {
			$elements[ liquid_implode( '%1$s .lqd-pf-nav-link:hover' ) ]['color'] = $hcolor;
			$elements[ liquid_implode( '%1$s.lqd-pf-meta-nav .lqd-pf-nav-link:hover .lqd-pf-nav-link-title' ) ]['-webkit-text-stroke-color'] = 'transparent';
			$elements[ liquid_implode( '%1$s.lqd-pf-meta-nav .lqd-pf-nav-link:hover .lqd-pf-nav-link-title' ) ]['color'] = $hcolor;
		}

		$this->dynamic_css_parser( $id, $elements );

	}
	
}
new LD_Pf_Single_Nav;