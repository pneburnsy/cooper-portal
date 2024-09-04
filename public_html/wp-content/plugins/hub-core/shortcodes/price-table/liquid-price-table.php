<?php
/**
* Shortcode Liquid Pricing Table
*/

if( ! defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Price_Table extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_price_table';
		$this->title       = esc_html__( 'Price Table', 'landinghub-core' );
		$this->description = esc_html__( 'Create pricing table.', 'landinghub-core' );
		$this->icon        = 'la la-usd';
		$this->show_settings_on_create = true;

		parent::__construct();
	}
	
	public function get_params() {

		$url = liquid_addons()->plugin_uri() . '/assets/img/sc-preview/pricing-table/';

		$icon = liquid_get_icon_params( false, '', 'all', array( 'align', 'size' ), 'i_', array(
			'element' => 'style',
			'value' => array( 's8' )
		) );

		$content = array_merge(
		array(
			array(
				'type'        => 'select_preview',
				'param_name'  => 'template',
				'heading'     => esc_html__( 'Style', 'landinghub-core' ),
				'admin_label' => true,
				'value'       => array(
					array(
						'value' => 'style01',
						'label' => esc_html__( 'Style 1', 'landinghub-core' ),
						'image' => $url . 'style01.jpg'
					),
					array(
						'label' => esc_html__( 'Style 2', 'landinghub-core' ),
						'value' => 'style02',
						'image' => $url . 'style02.jpg'
					),
					array(
						'label' => esc_html__( 'Style 3', 'landinghub-core' ),
						'value' => 'style03',
						'image' => $url . 'style03.jpg'
					),
					array(
						'label' => esc_html__( 'Style 3B', 'landinghub-core' ),
						'value' => 'style03b',
						'image' => $url . 'style03b.jpg'
					),
					array(
						'label' => esc_html__( 'Style 4', 'landinghub-core' ),
						'value' => 'style04',
						'image' => $url . 'style04.jpg'
					),
					array(
						'label' => esc_html__( 'Style 5', 'landinghub-core' ),
						'value' => 'style05',
						'image' => $url . 'style05.jpg'
					),
					array(
						'label' => esc_html__( 'Style 6', 'landinghub-core' ),
						'value' => 'style06',
						'image' => $url . 'style06.jpg'
					),
					array(
						'label' => esc_html__( 'Style 7', 'landinghub-core' ),
						'value' => 'style07',
						'image' => $url . 'style07.jpg'
					),
					array(
						'label' => esc_html__( 'Style 8', 'landinghub-core' ),
						'value' => 'style08',
						'image' => $url . 'style08.jpg'
					),
					array(
						'label' => esc_html__( 'Style 9', 'landinghub-core' ),
						'value' => 'style09',
						'image' => $url . 'style09.jpg'
					),
					array(
						'label' => esc_html__( 'Style 10', 'landinghub-core' ),
						'value' => 'style10',
						'image' => $url . 'style10.jpg'
					),
					array(
						'label' => esc_html__( 'Style 11', 'landinghub-core' ),
						'value' => 'style11',
						'image' => $url . 'style11.jpg'
					),
				),
				'save_always' => true,
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'title',
				'heading'     => esc_html__( 'Title', 'landinghub-core' ),
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-8'
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_title',
				'heading'     => esc_html__( 'Custom font?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use custom font for title', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'subtitle',
				'heading'    => esc_html__( 'Subtitle', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'template',
					'value' => array( 'style11' ),
				),
			),
			array(
				'type'        => 'textarea',
				'param_name'  => 'description',
				'heading'     => esc_html__( 'Description', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'template',
					'value'   => array( 'style03', 'style03b', 'style04', 'style07', 'style09', 'style11' ),
				),
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'price',
				'heading'    => esc_html__( 'Price', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'template',
					'value_not_equal_to' => array( 'style01' ),
				),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'featured',
				'heading'     => esc_html__( 'Featured?', 'landinghub-core' ),
				'description' => esc_html__( 'Enable to make this price table featured', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'dependency' => array(
					'element' => 'template',
					'value'   => array( 'style02', 'style03', 'style03b', 'style04', 'style05', 'style06', 'style08', 'style10', 'style11' ),
				),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'featured_tag',
				'heading'     => esc_html__( 'Show featured tag?', 'landinghub-core' ),
				'description' => esc_html__( 'Enable to featured tag with label', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'dependency' => array(
					'element' => 'template',
					'value'   => array( 'style03', 'style03b', 'style10', 'style11' ),
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type' => 'textfield',	
				'param_name' => 'featured_label',
				'heading' => esc_html__( 'Featured Label', 'landinghub-core' ),
				'description' => esc_html__( 'Add featured label under the featured icon', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'featured_tag',
					'value'   => 'yes',
				),
				'edit_field_class' => 'vc_col-sm-6'
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
				'param_name' => 'text_font',
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


		),

		//$icon,

		array(

			array(
				'type'        => 'textarea_html',
				'param_name'  => 'content',
				'heading'     => esc_html__( 'Features', 'landinghub-core' ),
				'description' => esc_html__( 'Input values here. Divide values by pressing Enter. Example: <strong>10GB</strong> Disk Space,<strong>100GB</strong> Monthly Bandwidth;', 'landinghub-core'),
				'value'       => '<ul><li>Free One Year Domain</li><li>10+ Pages Design</li><li>Full Organized Layered</li><li>Unlimited Revision</li><li>50% Discount Off</li><li>Free Logo Design</li><li>Free Stationary Design</li></ul>',
			),
			array(
				'type'        => 'textarea',
				'param_name'  => 'footer_text',
				'heading'     => esc_html__( 'Footer Text', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'template',
					'value'   => array( 'style04', 'style09' ),
				),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'show_button',
				'heading'    => esc_html__( 'Show Button', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'No', 'landinghub-core' )  => '',
					esc_html__( 'Yes', 'landinghub-core' ) => 'yes',
				)
			)

		) );

		$button = vc_map_integrate_shortcode( 'ld_button', 'pt_', esc_html__( 'Button', 'landinghub-core' ),
			array(
				'exclude' => array(
					'el_id',
					'el_class'
				)
			),
			array(
				'element' => 'show_button',
				'value' => 'yes',
			)
		);

		$design = array(
			array(
				'type'		 => 'liquid_colorpicker',
				'param_name' => 'accent_color',
				'heading'    => esc_html__( 'Accent Color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),
			array(
				'type'		 => 'liquid_colorpicker',
				'param_name' => 'bg_color',
				'heading'    => esc_html__( 'Background Color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),
			array(
				'type'		 => 'liquid_colorpicker',
				'param_name' => 'border_color',
				'heading'    => esc_html__( 'Border Color', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'template',
					'value'   => array( 'style02', 'style03b', 'style04', 'style05', 'style07', 'style09', 'style10', 'style11' ),
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),
			array(
				'type'		 => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'h_color',
				'heading'    => esc_html__( 'Heading Color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'dependency'  => array(
					'element' => 'template',
					'value_not_equal_to'   => array( 'style06' ),
				),
			),
			array(
				'type'		 => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'desc_color',
				'heading'    => esc_html__( 'Description Color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'dependency'  => array(
					'element' => 'template',
					'value'   => array( 'style03', 'style03b', 'style07', 'style11' ),
				),
			),
			array(
				'type'		 => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'price_color',
				'heading'    => esc_html__( 'Price Color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				// 'dependency'  => array(
				// 	'element' => 'featured',
				// 	'value'   => 'yes',
				// ),
			),
			array(
				'type'		 => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'featured_txt_color',
				'heading'    => esc_html__( 'Text Color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'dependency'  => array(
					'element' => 'featured',
					'value'   => 'yes',
				),
			),
			array(
				'type'		 => 'liquid_colorpicker',
				'only_gradient' => true,
				'param_name' => 'h_gradient_color',
				'heading'    => esc_html__( 'Heading Gradient Color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'dependency'  => array(
					'element' => 'template',
					'value'   => array( 'style06' ),
				),
			),
			
		);
		foreach( $design as &$param ) {
			$param['group'] = esc_html__( 'Design Options', 'landinghub-core' );
		}

		$this->params = array_merge( $content, $design, $button );

		$this->add_extras();
	}
	
	protected function get_title( $classes = '' ) {

		// check
		if( empty( $this->atts['title'] ) ) {
			return '';
		}
		
		if( !empty( $classes ) ) {
			$class = 'class="lqd-pt-title ' . $classes . '"';
		}
		else {
			$class = 'class="lqd-pt-title"';
		}

		$title = wp_kses_post( $this->atts['title'] );
		
		// Default
		$title = sprintf( '<h4 %s> %s</h4>', $class, $title );

		echo $title;

	}
	
	protected function get_description() {

		if( !$this->atts['description'] ) {
			return;
		}

		$style = $this->atts['template'];
		
		if( 'style03' === $style ) {
			echo '<p class="lqd-pt-description-lg mb-0">' . wp_kses_post( $this->atts['description'] ) . '</p>';			
		} 
		elseif( 'style03b' === $style ) {
			echo '<p class="lqd-pt-description-md mb-0">' . wp_kses_post( $this->atts['description'] ) . '</p>';	
		}
		elseif( 'style04' === $style ) {
			echo '<p class="lqd-pt-description text-uppercase ltr-sp-1 mb-1">' . wp_kses_post( $this->atts['description'] ) . '</p>';	
		}
		elseif( 'style11' === $style ) {
			echo '<p class="lqd-pt-description mb-1">' . wp_kses_post( $this->atts['description'] ) . '</p>';	
		}
		else {
			echo '<p class="lqd-pt-description mb-0">' . wp_kses_post( $this->atts['description'] ) . '</p>';
		}
		
		
	}
	
	protected function get_featured() {

		if( !$this->atts['featured'] ) {
			return;
		}
		if( 'style02' === $this->atts['template'] ) {
			return 'lqd-pt-featured overflow-hidden';
		}
		else {
			return 'lqd-pt-featured';
		}

		
	}
	
	protected function get_featured_tag() {
		
		if( !$this->atts['featured_tag'] ) {
			return;
		}
		$featured_label = '';
		if( !empty( $this->atts['featured_label'] ) ) {
			$featured_label = $this->atts['featured_label'];
		}
		
		if( 'style03b' === $this->atts['template'] ) {
			printf( '<span class="lqd-pt-label font-weight-bold circle">%s</span>', $featured_label );
		}
		elseif( 'style10' === $this->atts['template'] ) {
			printf( '<span class="lqd-pt-label text-uppercase ltr-sp-085 font-weight-semibold round">%s</span>', $featured_label );
		}
		elseif( 'style11' === $this->atts['template'] ) {
			printf( '<span class="lqd-pt-label text-uppercase ltr-sp-1 font-weight-semibold">%s</span>', $featured_label );
		}
		else {
			printf( '<span class="lqd-pt-label text-uppercase ltr-sp-1 font-weight-semibold round">%s</span>', $featured_label );
		}
		
		
	}

	protected function get_price() {

		// check
		if( empty( $this->atts['price'] ) ) {
			return '';
		}

		$out = '';

		$price = wp_kses_post( do_shortcode( $this->atts['price'] ) );
		
		if( 'style02' ===  $this->atts['template'] ) {
			$out .= sprintf( '<span class="lqd-pt-price font-weight-medium text-primary mt-0 mb-4">%s</span>', $price );
		}
		elseif( 'style03' ===  $this->atts['template'] ) {
			$out .= sprintf( '<span class="lqd-pt-price font-weight-semibold mt-5 mb-3">%s</span>', $price );
		}
		elseif( 'style03b' ===  $this->atts['template'] ) {
			$out .= sprintf( '<span class="lqd-pt-price font-weight-semibold mt-3 mb-2">%s</span>', $price );
		}
		elseif( 'style04' ===  $this->atts['template'] ) {
			$out .= sprintf( '<span class="lqd-pt-price text-primary mb-1">%s</span>', $price );
		}
		elseif( 'style06' ===  $this->atts['template'] ) {
			$out .= sprintf( '<span class="lqd-pt-price font-weight-medium text-primary">%s</span>', $price );
		}
		elseif( 'style07' === $this->atts['template'] ) {
			$out .= sprintf( '<span class="lqd-pt-price my-5">%s</span>', $price );
		}
		elseif( 'style08' === $this->atts['template'] ) {
			$out .= sprintf( '<span class="lqd-pt-price font-weight-bold mb-3">%s</span>', $price );
		}
		elseif( 'style09' === $this->atts['template'] ) {
			$out .= sprintf( '<span class="lqd-pt-price font-weight-semibold mb-2">%s</span>', $price );
		}
		elseif( 'style10' === $this->atts['template'] ) {
			$out .= sprintf( '<span class="lqd-pt-price font-weight-medium">%s</span>', $price );
		}
		elseif( 'style11' === $this->atts['template'] ) {
			$out .= sprintf( '<span class="lqd-pt-price text-primary mb-4">%s</span>', $price );
		}
		else {
			$out .= sprintf( '<span class="lqd-pt-price text-primary">%s</span>', $price );	
		}

		echo $out;
	}
	
	protected function get_features() {

		// check
		if( empty( $this->atts['content'] ) ) {
			return '';
		}

		$content = ld_helper()->do_the_content( $this->atts['content'] );

		echo wp_kses_post( $content );
	}

	protected function get_footer_text() {
		
		// check
		if( empty( $this->atts['footer_text'] ) ) {
			return '';
		}

		$content = ld_helper()->do_the_content( $this->atts['footer_text'] );

		echo '<div class="lqd-pt-footer-extra mt-2">' . wp_kses_post( $content ) . '</div>';
		
	}

	protected function get_button() {

		if ( empty( $this->atts['show_button'] ) ) {
			return;
		}

		$data = vc_map_integrate_parse_atts( $this->slug, 'ld_button', $this->atts, 'pt_' );

		if ( $data ) {
			$btn = visual_composer()->getShortCode( 'ld_button' )->shortcodeClass();
			if ( is_object( $btn ) ) {
				echo $btn->render( array_filter( $data ) );
			}
		}
	}

	protected function get_class( $style ) {

		$hash = array(
			'style01'  => 'lqd-pt-style-1 lqd-pt-title-27 pos-rel round overflow-hidden',
			'style02'  => 'lqd-pt-style-2 lqd-pt-title-16 lqd-pt-price-34 pos-rel round',
			'style03'  => 'lqd-pt-style-3 lqd-pt-title-18 lqd-pt-price-50 pos-rel',
			'style03b' => 'lqd-pt lqd-pt-style-3 lqd-pt-style-3b lqd-pt-title-18 lqd-pt-price-50 pos-rel',
			'style04'  => 'lqd-pt-style-4 lqd-pt-title-18 lqd-pt-price-60 pos-rel overflow-hidden text-center',
			'style05'  => 'lqd-pt-style-5 lqd-pt-title-13 lqd-pt-price-55 pos-rel round text-center',
			'style06'  => 'lqd-pt-style-6 lqd-pt-title-11 lqd-pt-price-50 lqd-pt-body-15 pos-rel border-radius-12',
			'style07'  => 'lqd-pt-style-7 lqd-pt-title-27 lqd-pt-price-52 lqd-pt-body-16 pos-rel round',
			'style08'  => 'lqd-pt-style-8 lqd-pt-title-16 lqd-pt-price-48 pos-rel round',
			'style09'  => 'lqd-pt-style-9 lqd-pt-title-16 lqd-pt-price-48 lqd-pt-body-16 pos-rel border-radius-8',
			'style10'  => 'lqd-pt-style-10 lqd-pt-title-18 lqd-pt-price-50 lqd-pt-body-16 pos-rel border-radius-5',
			'style11'  => 'lqd-pt-style-11 lqd-pt-title-28 lqd-pt-price-60 pos-rel overflow-hidden text-center',

		);

		return $hash[ $style ];
	}

	protected function generate_css() {
		
		$settings = get_option( 'wpb_js_google_fonts_subsets' );
		if ( is_array( $settings ) && ! empty( $settings ) ) {
			$subsets = '&subset=' . implode( ',', $settings );
		} else {
			$subsets = '';
		}

		// check
		$elements = array();
		extract( $this->atts );
		$id = '.' . $this->get_id();
		
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
		$elements[ liquid_implode( '%1$s .lqd-pt-title' ) ] = array( $text_font_inline_style );
		$elements[ liquid_implode( '%1$s .lqd-pt-title' ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ liquid_implode( '%1$s .lqd-pt-title' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ liquid_implode( '%1$s .lqd-pt-title' ) ]['font-weight'] = !empty( $fw ) ? $fw . ' !important' : '';
		$elements[ liquid_implode( '%1$s .lqd-pt-title' ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';

		if ( ! empty( $accent_color ) && isset( $accent_color ) ) {

			if ( 'style01' === $template ) {
				$elements[ liquid_implode( '%1$s .lqd-pt-head' ) ]['background'] = $accent_color;
			}
			if ( 'style02' === $template ) {
				$elements[ liquid_implode( '%1$s:not(.lqd-pt-featured) .lqd-pt-price' ) ]['color'] = $accent_color;
			}
			if ( 'style03' === $template ) {
				$elements[ liquid_implode( '%1$s:not(.lqd-pt-featured) li i' ) ]['color'] = $accent_color;
			}
			if ( 'style03b' === $template ) {
				$elements[ liquid_implode( '%1$s .lqd-pt-label' ) ]['background-color'] = $accent_color;
			}
			if ( 'style04' === $template ) {
				$elements[ liquid_implode( '%1$s:not(.lqd-pt-featured) .lqd-pt-price' ) ]['color'] = $accent_color;
			}
			if ( 'style05' === $template ) {
				$elements[ liquid_implode( '%1$s:not(.lqd-pt-featured) .lqd-pt-price' ) ]['color'] = $accent_color;
			}
			if ( 'style07' === $template ) {
				$elements[ liquid_implode( '%1$s:not(.lqd-pt-featured) .lqd-pt-price' ) ]['color'] = $accent_color;
			}
			if ( 'style08' === $template ) {
				$elements[ liquid_implode( '%1$s:not(.lqd-pt-featured) .lqd-pt-price' ) ]['color'] = $accent_color;
			}
			if ( 'style09' === $template ) {
				$elements[ liquid_implode( '%1$s .lqd-pt-price' ) ]['color'] = $accent_color;
			}
			if ( 'style10' === $template ) {
				$elements[ liquid_implode( '%1$s:not(.lqd-pt-featured) .lqd-pt-price' ) ]['color'] = $accent_color;
			}
			if ( 'style11' === $template ) {
				$elements[ liquid_implode( '%1$s:not(.lqd-pt-featured) .lqd-pt-price' ) ]['color'] = $accent_color;
			}
			
			$elements[ liquid_implode( '%1$s.lqd-pt-featured .lqd-pt-bg' ) ]['background'] = $accent_color;

		}

		if ( ! empty( $bg_color ) && isset( $bg_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-pt-bg' ) ]['background'] = $bg_color . ' !important';
		}

		if ( ! empty( $border_color ) && isset( $border_color ) ) {
			$elements[ liquid_implode( '%1$s, %1$s .lqd-pt-body, %1$s .lqd-pt-foot, %1$s .lqd-pt-head p, %1$s figure' ) ]['border-color'] = $border_color . ' !important';
		}

		if ( ! empty( $desc_color ) && isset( $desc_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-pt-description, %1$s .lqd-pt-description-lg, %1$s .lqd-pt-description-md' ) ]['color'] = $desc_color;
		}

		if ( ! empty( $h_gradient_color ) && isset( $h_gradient_color ) ) {

			if ( 'style06' === $template ) {
				$elements[ liquid_implode( '%1$s:not(.lqd-pt-featured) .lqd-pt-price' ) ]['background'] = $h_gradient_color;
			}

		}
		
		if( ! empty( $h_color ) && isset( $h_color ) ) { 

			if ( 'style09' === $template || 'style11' === $template ) {
				$elements[ liquid_implode( '%1$s .lqd-pt-label' ) ]['background'] = $h_color;
			}

			$elements[ liquid_implode( '%1$s .lqd-pt-title' ) ]['color'] = $h_color;

		}
		
		if( ! empty( $price_color ) && isset( $price_color ) ) { 

			$elements[ liquid_implode( '%1$s .lqd-pt-price' ) ]['color'] = $price_color;

		}
		
		if( ! empty( $featured_txt_color ) && isset( $featured_txt_color ) ) { 
			$elements[ liquid_implode( '%1$s' ) ]['color'] = $featured_txt_color;
		}

		$this->dynamic_css_parser( $id, $elements );
	}
}
new LD_Price_Table;