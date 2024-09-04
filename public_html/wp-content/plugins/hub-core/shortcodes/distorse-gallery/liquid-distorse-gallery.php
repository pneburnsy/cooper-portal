<?php
/**
* Shortcode Liquid Carousel
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Distorse_Gallery extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug         = 'ld_distorse_gallery';
		$this->title        = esc_html__( 'Distorse Gallery', 'landinghub-core' );
		$this->icon            = 'la la-image';
		$this->description  = esc_html__( 'Create an distorse gallery.', 'landinghub-core' );
		$this->show_settings_on_create = true;

		parent::__construct();
	}

	public function get_params() {
		
		$this->params = array(


			array(
				'type'       => 'param_group',
				'param_name' => 'identities',
				'heading'    => esc_html__( 'Identities', 'landinghub-core' ),
				'params'     => array(
					array(
						'type'        => 'attach_images',
						'param_name'  => 'images',
						'heading'     => esc_html__( 'Gallery Images', 'landinghub-core' ),
						'description' => esc_html__( 'Add images to show in the gallery carousel', 'landinghub-core' )
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'text',
						'heading'     => esc_html__( 'Text', 'landinghub-core' ),
						'description' => esc_html__(  'Add text', 'landinghub-core' ),
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'subtext',
						'heading'     => esc_html__( 'Sub Text', 'landinghub-core' ),
						'description' => esc_html__(  'Add Sub text', 'landinghub-core' ),
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'url',
						'heading'     => esc_html__( 'URL (Link)', 'landinghub-core' ),
						'description' => esc_html__(  'Add link', 'landinghub-core' ),
					)
				)
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'hover_style',
				'heading'     => esc_html__( 'Hover Style', 'landinghub-core' ),
				'description' => esc_html__( 'Select hover style.', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Outlined', 'landinghub-core' ) => 'lqd-dist-gal-hover-outline',
					esc_html__( 'Filled', 'landinghub-core' )    => 'lqd-dist-gal-hover-fill',
				),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'blend_mode',
				'heading'    => esc_html__( 'Blend Mode', 'landinghub-core' ),
				'description' => esc_html__( 'Select blend mode for the hover state of the link', 'landinghub-core' ),
				'value'      => array(
					'normal',
					'multiply',
					'screen',
					'overlay',
					'darken',
					'lighten',
					'color-dodge',
					'color-burn',
					'hard-light',
					'soft-light',
					'difference',
					'exclusion',
					'hue',
					'saturation',
					'color',
					'luminosity'
				),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_title',
				'heading'     => esc_html__( 'Custom font?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use custom font for item labels', 'landinghub-core' ),
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
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'color',
				'heading'     => esc_html__( 'Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'hover_color',
				'heading'     => esc_html__( 'Hover Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sub_color',
				'heading'     => esc_html__( 'Sub Text Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sub_hover_color',
				'heading'     => esc_html__( 'Sub Text Hover Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),

		);

		$this->add_extras();
	}
	
	protected function get_galleries() {
		
		$identities = vc_param_group_parse_atts( $this->atts['identities'] );
		
		foreach ( $identities as $key => $item ) { 

			$images = explode( ',', $item['images'] );
			$lighbox_id = uniqid('lqd-dist-gal-');
			
			if( '1' == count( $images )  ) {
				echo '<div class="lqd-dist-gal-img">';
					foreach( $images as $image ) {
						$img_url = wp_get_attachment_image_url( $image, array( '800', '978' ), false);
						echo '<a href="' . $img_url . '" class="fresco" data-fresco-group="' . esc_attr($lighbox_id) . '">
										<img width="450" height="550" src="' . $img_url . '"/>
									</a>';
					}
				echo '</div>';
			}
			else {
				echo '<div class="lqd-dist-gal-img" data-lqd-img-trail="true" data-img-trl-options=\'{ "respectDirection": true, "keepLastItemVisible": true, "threshold": 90, "trigger": "#'. $this->get_id() .' .lqd-dist-gal-menu h2:nth-child(' . ( $key + 1 ) . ') a"
}\'>';
				echo '<div class="lqd-img-trail-array">';

					foreach( $images as $image ) {
						$img_url = wp_get_attachment_image_url( $image, array( '800', '978' ), false);
						echo '<a href="' . $img_url . '" class="fresco" data-fresco-group="' . esc_attr($lighbox_id) . '">
										<img class="lqd-img-trail-img" width="450" height="550" src="' . $img_url . '"/>
									</a>';
					}

				echo '</div><!--/lqd-img-trail-array-->';
				echo '</div>';
				
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
		$elements[ liquid_implode( '%1$s .lqd-dist-gal-menu' ) ] = array( $text_font_inline_style );
		$elements[ liquid_implode( '%1$s .lqd-dist-gal-menu' ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ liquid_implode( '%1$s .lqd-dist-gal-menu' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ liquid_implode( '%1$s .lqd-dist-gal-menu' ) ]['font-weight'] = !empty( $fw ) ? $fw . ' !important' : '';
		$elements[ liquid_implode( '%1$s .lqd-dist-gal-menu' ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';
		
		if( !empty( $color ) && isset( $color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-dist-gal-menu' ) ]['--lqd-dist-gal-menu-color'] = $color;
		}
		if( !empty( $hover_color ) && isset( $hover_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-dist-gal-menu' ) ]['--lqd-dist-gal-menu-color-hover'] = $hover_color;
		}
		if( !empty( $sub_color ) && isset( $sub_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-dist-gal-menu a small' ) ]['color'] = $sub_color;
		}
		if( !empty( $sub_hover_color ) && isset( $sub_hover_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-dist-gal-menu a:hover small' ) ]['color'] = $sub_hover_color;
		}
		if( !empty( $blend_mode ) && isset( $blend_mode ) ) {
			$elements[ liquid_implode( '%1$s .lqd-dist-gal-menu a' ) ]['transition'] = 'none';
			$elements[ liquid_implode( '%1$s .lqd-dist-gal-menu a:hover' ) ]['mix-blend-mode'] = $blend_mode;
		}

		$this->dynamic_css_parser( $id, $elements );
	}

}
new LD_Distorse_Gallery;