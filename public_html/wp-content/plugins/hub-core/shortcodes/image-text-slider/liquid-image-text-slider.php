<?php
/**
* Shortcode Liquid Carousel
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Image_Text_Slider extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug         = 'ld_imgtxt_slider';
		$this->title        = esc_html__( 'Image + Text Slider', 'landinghub-core' );
		$this->icon            = 'la la-image';
		$this->description  = esc_html__( 'Create a distorsed image gallery.', 'landinghub-core' );
		$this->styles  = array( 'fresco', 'jquery-ytplayer' );
		$this->scripts = array( 'jquery-ytplayer', 'wp-mediaelement' );
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
						'type'       => 'dropdown',
						'param_name' => 'media_type',
						'heading'    => esc_html__( 'Media type', 'landinghub-core' ),
						'value'      => array(
							esc_html__( 'Image', 'landinghub-core' )             => 'image',
							esc_html__( 'Video (Local)', 'landinghub-core' )   => 'local_video',
							esc_html__( 'Video (Youtube)', 'landinghub-core' ) => 'yt_video',
						),
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Local Video (mp4)', 'landinghub-core' ),
						'param_name'  => 'mp4_local_video',
						// default video url
						'description' => esc_html__( '', 'landinghub-core' ),
						'dependency'    => array(
							'element'   => 'media_type',
							'value' => array( 'local_video' )
						),
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Local Video (webm)', 'landinghub-core' ),
						'param_name'  => 'webm_local_video',
						// default video url
						'description' => esc_html__( '', 'landinghub-core' ),
						'dependency'    => array(
							'element'   => 'media_type',
							'value' => array( 'local_video' )
						),
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'YouTube link', 'landinghub-core' ),
						'param_name'  => 'yt_video_url',
						'value'       => 'https://www.youtube.com/watch?v=cVEemOmHw9Y',
						// default video url
						'description' => esc_html__( 'Add YouTube link.', 'landinghub-core' ),
						'dependency'    => array(
							'element'   => 'media_type',
							'value' => array( 'yt_video' )
						),
					),
					array(
						'type'        => 'attach_image',
						'param_name'  => 'image',
						'heading'     => esc_html__( 'Image', 'landinghub-core' ),
						'description' => esc_html__( 'Add image to show in the slider', 'landinghub-core' ),
						'dependency'    => array(
							'element'   => 'media_type',
							'value' => array( 'image' )
						),
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'text',
						'heading'     => esc_html__( 'Text', 'landinghub-core' ),
						'description' => esc_html__(  'Add text', 'landinghub-core' ),
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
					esc_html__( 'Default', 'landinghub-core' ) => '',
					esc_html__( 'Fade', 'landinghub-core' )    => 'lqd-imgtxt-slider-fade',
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
			

		);

		$this->add_extras();
	}
	
	protected function get_galleries() {
		
		$identities = vc_param_group_parse_atts( $this->atts['identities'] );
		
		foreach ( $identities as $key => $item ) {

			$images = explode( ',', $item['images'] );	
			
			if( '1' == count( $images )  ) {
				echo '<g class="lqd-dist-gal-img">';
					foreach( $images as $image ) {
						echo '<image class="lqd-img-trail-img" width="350" height="450" x="50" y="50" xlink:href="' . wp_get_attachment_image_url( $image, array( '350', '450' ), false) . '"/>';
					}
				echo '</g>';
			}
			else {
				echo '<g class="lqd-dist-gal-img" data-lqd-img-trail="true" data-img-trl-options=\'{ "respectDirection": true, "keepLastItemVisible": true, "threshold": 35, "trigger": "#'. $this->get_id() .' .lqd-dist-gal-menu a:nth-child(' . ( $key + 1 ) . ')"
}\'>';
				echo '<g class="lqd-img-trail-array">';

					foreach( $images as $image ) {
						echo '<image class="lqd-img-trail-img" width="350" height="450" x="50" y="50" xlink:href="' . wp_get_attachment_image_url( $image, array( '350', '450' ), false) . '"/>';
					}

				echo '</g><!--/lqd-img-trail-array-->';
				echo '</g>';
				
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
		$elements[ liquid_implode( '%1$s .lqd-imgtxt-slider-nav' ) ] = array( $text_font_inline_style );
		$elements[ liquid_implode( '%1$s .lqd-imgtxt-slider-nav' ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ liquid_implode( '%1$s .lqd-imgtxt-slider-nav' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ liquid_implode( '%1$s .lqd-imgtxt-slider-nav' ) ]['font-weight'] = !empty( $fw ) ? $fw . ' !important' : '';
		$elements[ liquid_implode( '%1$s .lqd-imgtxt-slider-nav' ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';
		
		if( !empty( $color ) && isset( $color ) ) {
			if ( 'lqd-imgtxt-slider-fade' === $hover_style ) {
				$elements[ liquid_implode( '%1$s .lqd-imgtxt-slider-link' ) ]['color'] = $color;
			} else {
				$elements[ liquid_implode( '%1$s .lqd-imgtxt-slider-link:before' ) ]['-webkit-text-stroke-color'] = $color;
			}
		}
		if( !empty( $hover_color ) && isset( $hover_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-imgtxt-slider-link:hover' ) ]['color'] = $hover_color;
		}
		if( !empty( $blend_mode ) && isset( $blend_mode ) ) {
			$elements[ liquid_implode( '%1$s .lqd-imgtxt-slider-nav a:hover' ) ]['mix-blend-mode'] = $blend_mode;
		}

		$this->dynamic_css_parser( $id, $elements );
	}

}
new LD_Image_Text_Slider;