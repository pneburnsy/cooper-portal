<?php
/**
* Shortcode Animated Frame Element
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly
	
/**
* LD_Shortcode
*/
class LD_Animated_Frame extends LD_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug     = 'ld_animated_frame';
		$this->title    = esc_html__( 'Animated Frame', 'landinghub-core' );
		$this->icon     = 'la la-file-image-o';
		$this->show_settings_on_create        = true;
		$this->as_child = array( 'only' => 'ld_animated_frames_container' );
		$this->styles   = array( 'fresco', 'jquery-ytplayer' );
		$this->scripts  = array( 'wp-mediaelement', 'jquery-ytplayer' );

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
				'id'          => 'title',
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_title',
				'heading'     => esc_html__( 'Custom font?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use custom font for title', 'landinghub-core' ),
			),
			array(
				'type'       => 'textarea',
				'param_name' => 'content',
				'heading'    => esc_html__( 'Text', 'landinghub-core' ),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_txt',
				'heading'     => esc_html__( 'Custom font?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use custom font for text', 'landinghub-core' ),
			),
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
				'type'             => 'liquid_attach_image',
				'param_name'       => 'image',
				'heading'          => esc_html__( 'Image', 'landinghub-core' ),
				'descripton'       => esc_html__( 'Add image from gallery or upload new', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'dependency'    => array(
					'element'   => 'media_type',
					'value' => array( 'image', 'depth_image' )
				),
				
			),
			array(
				'type'             => 'liquid_attach_image',
				'param_name'       => 'second_image',
				'heading'          => esc_html__( 'Depth Image', 'landinghub-core' ),
				'descripton'       => esc_html__( 'Add image from gallery or upload new', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'    => array(
					'element'   => 'media_type',
					'value' => array( 'depth_image' )
				),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'vth',
				'heading'     => esc_html__( 'Vertical Threshold', 'landinghub-core' ),
				'description' => esc_html__( 'Add vertical threshold for ex. 15', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'    => array(
					'element'   => 'media_type',
					'value' => array( 'depth_image' )
				),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'hth',
				'heading'     => esc_html__( 'Horizontal Threshold', 'landinghub-core' ),
				'description' => esc_html__( 'Add horizontal threshold for ex. 35', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'    => array(
					'element'   => 'media_type',
					'value' => array( 'depth_image' )
				),
			),
			array(
				'type'        => 'vc_link',
				'param_name'  => 'overlay_link',
				'heading'     => esc_html__( 'Overlay URL (Link)', 'landinghub-core' ),
				'description' => esc_html__( 'Add link to slide.', 'landinghub-core' )
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
			
			//Typo Options
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
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
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
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
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
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
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
			
			
			//Txt Typo Options
			array(
				'type'        => 'textfield',
				'param_name'  => 'fs_txt',
				'heading'     => esc_html__( 'Font Size', 'landinghub-core' ),
				'description' => esc_html__( 'Example: 20px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3 vc_column-with-padding',
				'dependency' => array(
					'element' => 'use_custom_fonts_txt',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Text Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'lh_txt',
				'heading'     => esc_html__( 'Line-Height', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_txt',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Text Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'fw_txt',
				'heading'     => esc_html__( 'Font Weight', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_txt',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Text Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'ls_txt',
				'heading'     => esc_html__( 'Letter Spacing', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_txt',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Text Typo', 'landinghub-core' ),
			),
			/*
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use for Title theme default font family?', 'landinghub-core' ),
				'param_name'  => 'use_theme_fonts_txt',
				'value'       => array(
					esc_html__( 'Yes', 'landinghub-core' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'landinghub-core' ),
				'group' => esc_html__( 'Text Typo', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_txt',
					'value'   => 'true',
				),
				'std'         => 'yes',
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'text_font_txt',
				'value'      => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
				'settings'   => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'landinghub-core' ),
						'font_style_description'  => esc_html__( 'Select font styling.', 'landinghub-core' ),
					),
				),
				'group'      => esc_html__( 'Text Typo', 'landinghub-core' ),
				'dependency' => array(
					'element'            => 'use_theme_fonts_txt',
					'value_not_equal_to' => 'yes',
				),
			),
			*/
			
		);
		
		$design = array(

			array(
				'type' => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'color',
				'heading'     => esc_html__( 'Title Color', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'txt_color',
				'heading'     => esc_html__( 'Text Color', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'liquid_colorpicker',
				'param_name' => 'overlay_bg',
				'heading'     => esc_html__( 'Overlay Background', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
		);
		
		$this->params = array_merge( $params, $button, $design );

		$this->add_extras();
	}
	
	protected function load_js_sc() {
		
		$args = array( 'no_js' );

		if( 'local_video' === $this->atts['media_type'] ) {
			array_push( $args,
				'wp-mediaelement'
			);
		}
		elseif( 'yt_video' === $this->atts['media_type'] ) {
			array_push( $args,
				'jquery-ytplayer'
			);
		}

		return $args;

	}

	protected function get_title() {

		// check
		if( empty( $this->atts['title'] ) ) {
			return '';
		}

		$title = sprintf( '<h2 class="lqd-af-slide__title" data-split-text="true" data-split-options=\'{ "type": "lines" }\'>%s</h3>', $this->atts['title'] );

		echo $title;
	}

	protected function get_content() {

		// check
		if( empty( $this->atts['content'] ) ) {
			return '';
		}

		$content = sprintf( '<p class="lqd-af-slide__desc" data-split-text="true" data-split-options=\'{ "type": "lines" }\'>%s</p>', $this->atts['content'] );

		echo $content;
	}

	protected function get_image() {
		

		$img_src = $image = '';
		$alt  = $this->atts['title'];
		
		
		if( 'image' == $this->atts['media_type'] ) {
		
			if( preg_match( '/^\d+$/', $this->atts['image'] ) ) {
				$html = wp_get_attachment_image( $this->atts['image'], 'full', false, array( 'class' => 'invisible', 'alt' => esc_html( $alt ) ) );
			} 
			else {
				$img_src  = $this->atts['image'];
				$html = '<img class="invisible" src="' . esc_url( $img_src ) . '" alt="' . esc_html( $alt ) . '" />';
			}
	
			$image = sprintf( '<figure data-responsive-bg="true">%s<span class="liquid-overlay-link"></span></figure>', $html );
			
		}
		elseif( 'local_video' == $this->atts['media_type'] ) {
			
			$image = '<figure>
						<div class="lqd-vbg-wrap">
							<div class="lqd-vbg-inner">
								<span class="lqd-vbg-loader"></span>
								<video class="lqd-vbg-video" data-video-bg="true" autoplay loop muted playsinline>';
			if( !empty( $this->atts['mp4_local_video'] ) ) {
				$image .= '<source src="' . esc_url( $this->atts['mp4_local_video'] ) . '" type="video/mp4">';
			}
			if( !empty( $this->atts['webm_local_video'] ) ) {
				$image .= '<source src="' . esc_url( $this->atts['webm_local_video'] ) . '" type="video/webm">';
			}

			$image .=          '</video>
							</div>
						</div>
					</figure>';
		
		}
		elseif( 'yt_video' == $this->atts['media_type'] ) {
			
			$image = '<figure>
						<div class="lqd-vbg-wrap">
							<div class="lqd-vbg-inner">
								<span class="lqd-vbg-loader"></span>
								<div
									class="lqd-vbg-video"
									data-video-bg="true"
									data-youtube-options=\'{
										"videoURL": "' . $this->atts['yt_video_url'] . '",
										"startAt": 8,
										"stopAt": 17
									}\'
								></div>
							</div>
						</div>
					</figure>';
		}
		
		echo $image;
		
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
		$title_font_inline_style = $text_font_inline_style = '';
		
		/*
		if( 'yes' !== $use_theme_fonts ) {

			// Build the data array
			$title_font_data = $this->get_fonts_data( $text_font );

			// Build the inline style
			$title_font_inline_style = $this->google_fonts_style( $title_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $title_font_data );

		}
		*/

		$elements[ liquid_implode( '%1$s h2' ) ] = array( $title_font_inline_style );
		$elements[ liquid_implode( '%1$s h2' ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ liquid_implode( '%1$s h2' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ liquid_implode( '%1$s h2' ) ]['font-weight'] = !empty( $fw ) ? $fw : '';
		$elements[ liquid_implode( '%1$s h2' ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';
		$elements[ liquid_implode( '%1$s h2' ) ]['color'] = !empty( $color ) ? $color : '';
		
		/*
		if( 'yes' !== $use_theme_fonts_txt ) {

			// Build the data array
			$text_font_data_txt = $this->get_fonts_data( $text_font_txt );

			// Build the inline style
			$text_font_inline_style = $this->google_fonts_style( $text_font_data_txt );

			// Enqueue the right font
			$this->enqueue_google_fonts( $text_font_data_txt );

		}
		*/

		$elements[ liquid_implode( '%1$s p' ) ] = array( $text_font_inline_style );
		$elements[ liquid_implode( '%1$s p' ) ]['font-size'] = !empty( $fs_txt ) ? $fs_txt : '';
		$elements[ liquid_implode( '%1$s p' ) ]['line-height'] = !empty( $lh_txt ) ? $lh_txt : '';
		$elements[ liquid_implode( '%1$s p' ) ]['font-weight'] = !empty( $fw_txt ) ? $fw_txt : '';
		$elements[ liquid_implode( '%1$s p' ) ]['letter-spacing'] = !empty( $ls_txt ) ? $ls_txt : '';
		$elements[ liquid_implode( '%1$s p' ) ]['color'] = !empty( $txt_color ) ? $txt_color : '';
		
		if( !empty( $overlay_bg ) ) {
			$elements[ liquid_implode( '%1$s .lqd-af-slide__img .liquid-overlay-link' ) ]['background'] = $overlay_bg;
		}
		
		$this->dynamic_css_parser( $id, $elements );
	}


}
new LD_Animated_Frame;