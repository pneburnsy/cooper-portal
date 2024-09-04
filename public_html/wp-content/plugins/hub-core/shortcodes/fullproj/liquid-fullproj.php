<?php
/**
* Shortcode Header Full Projection
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Fullproj extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_fullproj';
		$this->title       = esc_html__( 'Fullscreen Projects', 'landinghub-core' );
		$this->description = esc_html__( 'Show fullscreen images with text and links for custom projects.', 'landinghub-core' );
		$this->icon        = 'la la-star';
		$this->scripts      = array( 'threejs' );
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
							esc_html__( 'Image', 'landinghub-core' )         => 'image',
							esc_html__( 'Video (Local)', 'landinghub-core' ) => 'local_video',
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
						'type'             => 'liquid_attach_image',
						'param_name'       => 'image',
						'heading'          => esc_html__( 'Image', 'landinghub-core' ),
						'descripton'       => esc_html__( 'Add image from gallery or upload new', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
						'dependency'    => array(
							'element'   => 'media_type',
							'value' => array( 'image' )
						),
						
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'text',
						'heading'     => esc_html__( 'Title', 'landinghub-core' ),
						'description' => esc_html__(  'Add title', 'landinghub-core' ),
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'subtitle',
						'heading'     => esc_html__( 'Subtitle', 'landinghub-core' )	,
						'description' => esc_html__( 'Add subtitle', 'landinghub-core' ),
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
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_title',
				'heading'     => esc_html__( 'Custom font?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use custom font for item labels', 'landinghub-core' ),
			),
			//Typo Title Options
			array(
				'type'        => 'responsive_textfield',
				'param_name'  => 'fs',
				'heading'     => esc_html__( 'Font Size', 'landinghub-core' ),
				'description' => esc_html__( 'Example: 20px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Title Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'responsive_textfield',
				'param_name'  => 'lh',
				'heading'     => esc_html__( 'Line-Height', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Title Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'responsive_textfield',
				'param_name'  => 'fw',
				'heading'     => esc_html__( 'Font Weight', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Title Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'responsive_textfield',
				'param_name'  => 'ls',
				'heading'     => esc_html__( 'Letter Spacing', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Title Typo', 'landinghub-core' ),
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
				'type'        => 'textfield',
				'param_name'  => 'height',
				'heading'     => esc_html__( 'Height', 'landinghub-core' ),
				'description' => esc_html__( 'Add height with px, for ex. 45px', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'inactive_items_opacity',
				'heading'     => esc_html__( 'Inactive Items Opacity', 'landinghub-core' ),
				'description' => esc_html__( 'Set an opacity for inactive items from 0 to 1.', 'landinghub-core' ),
			),
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

	public function generate_css() {

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
		$elements[ liquid_implode( '%1$s .lqd-fullproj-menu' ) ] = array( $text_font_inline_style );

		if( !empty( $fs ) ) {
			if ( strpos( $fs, 'text_' ) !== false ) {
				$responsive_fs = Liquid_Responsive_Texfield_Param::generate_css( 'font-size', $fs, $this->get_id() . ' .lqd-fullproj-menu' );
				$elements['media']['responsive-fs'] = $responsive_fs;
			}
			else {
				$elements[ liquid_implode( '%1$s .lqd-fullproj-menu' ) ]['font-size'] = $fs;
			}
		}
		if( !empty( $lh ) ) {		
			if ( strpos( $lh, 'text_' ) !== false ) {
				$responsive_lh = Liquid_Responsive_Texfield_Param::generate_css( 'line-height', $lh, $this->get_id() . ' .lqd-fullproj-menu' );
				$elements['media']['responsive-lh'] = $responsive_lh;
			}
			else {
				$elements[ liquid_implode( '%1$s .lqd-fullproj-menu'  ) ]['line-height'] = $lh;
			}	
		}
		if( !empty( $fw ) ) {
			if ( strpos( $fw, 'text_' ) !== false ) {
				$responsive_fw = Liquid_Responsive_Texfield_Param::generate_css( 'font-weight', $fw, $this->get_id() . ' .lqd-fullproj-menu' );
				$elements['media']['responsive-fw'] = $responsive_fw;
			}
			else {
				$elements[ liquid_implode( '%1$s .lqd-fullproj-menu'  ) ]['font-weight'] = $fw;
			}
		}
		if( !empty( $ls ) ) {		
			if ( strpos( $ls, 'text_' ) !== false ) {
				$responsive_ls = Liquid_Responsive_Texfield_Param::generate_css( 'letter-spacing', $ls, $this->get_id() . ' .lqd-fullproj-menu' );
				$elements['media']['responsive-ls'] = $responsive_ls;
			}
			else {
				$elements[ liquid_implode( '%1$s .lqd-fullproj-menu'  ) ]['letter-spacing'] = $ls;
			}
		}
		$elements[ liquid_implode( '%1$s .lqd-fullproj-menu' ) ]['text-transform'] = !empty( $transform ) ? $transform : '';

		
		if( !empty( $color ) && isset( $color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-fullproj-menu a' ) ]['color'] = $color;
		}
		if( !empty( $hover_color ) && isset( $hover_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-fullproj-menu li.lqd-is-active a' ) ]['color'] = $hover_color;
		}
		if( !empty( $height ) ) {
			$elements[ liquid_implode( '%1$s' ) ]['height'] = $height;
		}
		if( !empty( $inactive_items_opacity ) ) {
			$elements[ liquid_implode( '%1$s .lqd-fullproj-menu:hover .lqd-fullproj-title' ) ]['opacity'] = $inactive_items_opacity;
		}

		$this->dynamic_css_parser( $id, $elements );

	}
}
new LD_Fullproj;