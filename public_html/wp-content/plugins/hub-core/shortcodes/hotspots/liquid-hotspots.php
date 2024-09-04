<?php
/**
* Shortcode HotSpots
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Hotspots extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_hotspots';
		$this->title       = esc_html__( 'HotSpots', 'landinghub-core' );
		$this->description = esc_html__( 'An image with points on it and description', 'landinghub-core' );
		$this->icon        = 'la la-image';
		$this->show_settings_on_create = true;

		parent::__construct();
	}

	public function get_params() {

		$this->params = array(
			
			array(
				'type'       => 'attach_image',
				'param_name' => 'image',
				'heading'    => esc_html__( 'Image', 'infinite-addons' ),
				'descripton' => esc_html__( 'Add image from gallery or upload new', 'infinite-addons' )
			),
			array(
				'type' => 'textfield',
				'param_name' => 'custom_height',
				'heading' => esc_html__( 'Image Height', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'description' => esc_html__( 'Add media element custom height with px, ex. 300px.', 'landinghub-core' ),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_title',
				'heading'     => esc_html__( 'Custom font?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use custom font for title', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_subtitle',
				'heading'     => esc_html__( 'Custom font?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use custom font for description', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'       => 'param_group',
				'param_name' => 'identities',
				'heading'    => esc_html__( 'Points', 'landinghub-core' ),
				'params'     => array(

					array(
						'id' => 'title',
						'admin_label' => true,
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textarea',
						'param_name'  => 'description',
						'heading' => esc_html__( 'Tooltip Content', 'infinite-addons' ),
						'description' => esc_html__( 'Add tooltip content to display', 'infinite-addons' ),
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'position',
						'heading'     => esc_html__( 'Tooltip Alignment', 'infinite-addons' ),
						'description' => esc_html__( 'Tooltip alignment relative to the image', 'infinite-addons' ),
						'value'       => array(
							esc_html__( 'Top', 'infinite-addons' )   => 'lqd-hotspot-t',
							esc_html__( 'Right', 'infinite-addons' ) => 'lqd-hotspot-r',
							esc_html__( 'Left', 'infinite-addons' )   => 'lqd-hotspot-l',
							esc_html__( 'Bottom', 'infinite-addons' ) => 'lqd-hotspot-b',
						)
					),
					array(
						'type'         => 'textfield',
						'param_name'  => 'top',
						'heading'     => esc_html__( 'Top', 'infinite-addons' ),
						'description' => esc_html__( 'Add top position for pointer, use px or %', 'infinite-addons' ),
						'edit_field_class' => 'vc_col-sm-3'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'bottom',
						'heading'     => esc_html__( 'Bottom', 'infinite-addons' ),
						'description' => esc_html__( 'Add bottom position for pointer, use px or %', 'infinite-addons' ),
						'edit_field_class' => 'vc_col-sm-3'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'left',
						'heading'     => esc_html__( 'Left', 'infinite-addons' ),
						'description' => esc_html__( 'Add left position for pointer, use px or %', 'infinite-addons' ),
						'edit_field_class' => 'vc_col-sm-3'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'right',
						'heading'     => esc_html__( 'Right', 'infinite-addons' ),
						'description' => esc_html__( 'Add right position for pointer, use px or %', 'infinite-addons' ),
						'edit_field_class' => 'vc_col-sm-3'
					),


				)
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
			array(
				'type'        => 'colorpicker',
				'param_name'  => 'title_color',
				'heading'     => esc_html__( 'Color', 'landinghub-core' ),
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
			//SubTypo Title Options
			array(
				'type'        => 'textfield',
				'param_name'  => 'subtitle_fs',
				'heading'     => esc_html__( 'Font Size', 'landinghub-core' ),
				'description' => esc_html__( 'Example: 20px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3 vc_column-with-padding',
				'dependency' => array(
					'element' => 'use_custom_fonts_subtitle',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Description Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'subtitle_lh',
				'heading'     => esc_html__( 'Line-Height', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_subtitle',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Description Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'subtitle_fw',
				'heading'     => esc_html__( 'Font Weight', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_subtitle',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Description Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'subtitle_ls',
				'heading'     => esc_html__( 'Letter Spacing', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_subtitle',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Description Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'colorpicker',
				'param_name'  => 'p_color',
				'heading'     => esc_html__( 'Color', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_subtitle',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Description Typo', 'landinghub-core' ),
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
				'group' => esc_html__( 'Description Typo', 'landinghub-core' ),
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
				'group'      => esc_html__( 'Description Typo', 'landinghub-core' ),
				'dependency' => array(
					'element'            => 'use_theme_fonts_subtitle',
					'value_not_equal_to' => 'yes',
				),
			),
			*/
			array(
				'type'        => 'colorpicker',
				'param_name'  => 'bg_color',
				'heading'     => esc_html__( 'Background Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),

		);

		$this->add_extras();
	}
	
	protected function get_image() {

		// check
		if( empty( $this->atts['image'] ) ) {
			return;
		}

		$image  = wp_get_attachment_image( $this->atts['image'], 'full', false, array( 'class' => 'w-100' ) );
		$image = sprintf( '<figure>%s</figure>', $image );
		
		echo $image;

	}
	
	protected function get_custom_height_class() {
		
		if( empty( $this->atts['custom_height'] ) ) {
			return;
		}
		
		return 'lqd-hotspot-custom-height';
		
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
		$out = '';

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
		$elements[ liquid_implode( '%1$s .lqd-hotspot-content h2' ) ] = array( $text_font_inline_style );
		$elements[ liquid_implode( '%1$s .lqd-hotspot-content h2' ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ liquid_implode( '%1$s .lqd-hotspot-content h2' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ liquid_implode( '%1$s .lqd-hotspot-content h2' ) ]['font-weight'] = !empty( $fw ) ? $fw . ' !important' : '';
		$elements[ liquid_implode( '%1$s .lqd-hotspot-content h2' ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';
		$elements[ liquid_implode( '%1$s .lqd-hotspot-content h2' ) ]['color'] = !empty( $title_color ) ? $title_color : '';
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
		$elements[ liquid_implode( '%1$s .lqd-hotspot-content p' ) ] = array( $subtitle_font_inline_style );
		$elements[ liquid_implode( '%1$s .lqd-hotspot-content p' ) ]['font-size'] = !empty( $subtitle_fs ) ? $subtitle_fs : '';
		$elements[ liquid_implode( '%1$s .lqd-hotspot-content p' ) ]['line-height'] = !empty( $subtitle_lh ) ? $subtitle_lh : '';
		$elements[ liquid_implode( '%1$s .lqd-hotspot-content p' ) ]['font-weight'] = !empty( $subtitle_fw ) ? $subtitle_fw . ' !important' : '';
		$elements[ liquid_implode( '%1$s .lqd-hotspot-content p' ) ]['letter-spacing'] = !empty( $subtitle_ls ) ? $subtitle_ls : '';
		$elements[ liquid_implode( '%1$s .lqd-hotspot-content p' ) ]['color'] = !empty( $p_color ) ? $p_color : '';
		
		if( !empty( $custom_height ) ) {
			$elements[ liquid_implode( '%1$s' ) ]['height']  = $custom_height;
		}

		if( !empty( $bg_color ) ) {
			$elements['%1$s .lqd-hotspot-content']['background-color'] = $bg_color;
		}

		$this->dynamic_css_parser( $id, $elements );
	}
}
new LD_Hotspots;