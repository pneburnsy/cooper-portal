<?php
/**
* Shortcode Header Full Projection
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Header_Fullproj extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_header_fullproj';
		$this->title       = esc_html__( 'Header Fullscreen Project', 'landinghub-core' );
		$this->description = esc_html__( 'Show fullscreen images with text and links for custom projects.', 'landinghub-core' );
		$this->icon        = 'la la-star';
		$this->category    = esc_html__( 'Header Modules', 'landinghub-core' );
		$this->scripts      = array( 'threejs' );
		$this->show_settings_on_create = true;

		parent::__construct();
	}

	public function get_params() {
		

		$this->params = array(

			array(
				'type'        => 'textfield',
				'param_name'  => 'label',
				'value'				=> 'All Projects',
				'heading'     => esc_html__( 'Text', 'landinghub-core' ),
				'description' => esc_html__(  'Add text', 'landinghub-core' ),
			),

			array(
				'type'        => 'liquid_button_set',
				'param_name'  => 'trigger_txt_position',
				'heading'     => esc_html__( 'Trigger Text Position' ),
				'description' => esc_html__( 'Select a the trigger text position', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Left', 'landinghub-core' ) => 'txt-left',
					esc_html__( 'Right', 'landinghub-core' ) => 'txt-right',
				),
				'dependency'  => array(
					'element' => 'label',
					'not_empty' => true,
				),
				'std' => 'txt-right',
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type' => 'dropdown',
				'param_name' => 'trigger_style',
				'heading' => esc_html__( 'Trigger style', 'landinghub-core' ),
				'description' => esc_html__( 'Select trigger style for side drawer', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Style 1', 'landinghub-core' ) => 'style-1',
					esc_html__( 'Style 2', 'landinghub-core' ) => 'style-2',
					esc_html__( 'Style 3', 'landinghub-core' ) => 'style-3',
					esc_html__( 'Style 4', 'landinghub-core' ) => 'style-4',
				),
				'std' => 'style-3',
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'trigger_fill',
				'heading' => esc_html__( 'Trigger fill', 'landinghub-core' ),
				'description' => esc_html__( 'Select trigger fill for side drawer', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'None', 'landinghub-core' ) => 'fill-none',
					esc_html__( 'Solid', 'landinghub-core' ) => 'solid',
					esc_html__( 'Bordered', 'landinghub-core' ) => 'bordered',
				),
				'std' => 'bordered',
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'trigger_shape',
				'heading' => esc_html__( 'Trigger Shape', 'landinghub-core' ),
				'description' => esc_html__( 'Select trigger shape for side drawer', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'None', 'landinghub-core' )   => '',
					esc_html__( 'Round', 'landinghub-core' )  => 'round',
					esc_html__( 'Circle', 'landinghub-core' ) => 'circle',
				),
				'dependency'  => array(
					'element' => 'trigger_fill',
					'value_not_equal_to'   => 'fill-none',
				),
				'std' => 'circle',
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'inactive_items_opacity',
				'heading'     => esc_html__( 'Inactive Items Opacity', 'landinghub-core' ),
				'description' => esc_html__( 'Set an opacity for inactive items from 0 to 1.', 'landinghub-core' ),
			),

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
						'description' => esc_html__(  'Add text', 'landinghub-core' ),
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
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'color',
				'only_solid' => true,
				'heading'     => esc_html__( 'Link Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'hover_color',
				'only_solid' => true,
				'heading'     => esc_html__( 'Link Hover Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'trigger_color',
				'only_solid' => true,
				'heading'     => esc_html__( 'Trigger Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'trigger_color_hover',
				'heading'     => esc_html__( 'Trigger Hover Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the trigger when it\'s hovered.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'trigger_color_active',
				'heading'     => esc_html__( 'Trigger Active Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the trigger when it\'s active.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),

			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'trigger_text_color',
				'heading'     => esc_html__( 'Trigger Text Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the trigger text.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'group' => esc_html__( 'Design Options' ),
				'dependency'  => array(
					'element' => 'label',
					'not_empty' => true,
				),
			),

			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'shape_color',
				'heading'     => esc_html__( 'Shape Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the trigger shape.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'shape_hover_color',
				'heading'     => esc_html__( 'Shape Hover Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the hover state of trigger shape.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'shape_active_color',
				'heading'     => esc_html__( 'Shape Avtive Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the active state of trigger shape.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
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
		$elements[ liquid_implode( '%1$s .lqd-fullproj-menu' ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ liquid_implode( '%1$s .lqd-fullproj-menu' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ liquid_implode( '%1$s .lqd-fullproj-menu' ) ]['font-weight'] = !empty( $fw ) ? $fw . ' !important' : '';
		$elements[ liquid_implode( '%1$s .lqd-fullproj-menu' ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';
		$elements[ liquid_implode( '%1$s .lqd-fullproj-menu' ) ]['text-transform'] = !empty( $transform ) ? $transform : '';
		
		if( !empty( $color ) && isset( $color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-fullproj-menu a' ) ]['color'] = $color;
		}
		if( !empty( $hover_color ) && isset( $hover_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-fullproj-menu li.lqd-is-active a' ) ]['color'] = $hover_color;
		}
		
		if( ! empty($trigger_color) ) {
			
			if ( 'style-1' === $trigger_style ) {
				$elements[ liquid_implode( '%1$s .nav-trigger .bar' ) ]['background'] = $trigger_color;
			} else if ( 'style-2' === $trigger_style ) {
				$elements[ liquid_implode( '%1$s .nav-trigger .bar:first-child:before, %1$s .nav-trigger .bar:nth-child(2):before' ) ]['background'] = $trigger_color;
			} else {
				$elements[ liquid_implode( '%1$s .nav-trigger .bar' ) ]['background'] = $trigger_color;
				$elements[ liquid_implode( '%1$s .nav-trigger .bar' ) ]['color'] = $trigger_color;
			}

		}

		if( ! empty($trigger_color_hover) ) {

			if ( 'style-1' === $trigger_style ) {
				$elements[ liquid_implode( '%1$s .nav-trigger:hover .bar' ) ]['background'] = $trigger_color_hover;
			} else if ( 'style-2' === $trigger_style ) {
				$elements[ liquid_implode( '%1$s .nav-trigger:hover .bar:first-child:before, %1$s .nav-trigger:hover .bar:nth-child(2):before' ) ]['background'] = $trigger_color_hover;
			} else {
				$elements[ liquid_implode( '%1$s .nav-trigger:hover .bar' ) ]['background'] = $trigger_color_hover . ' !important';
				$elements[ liquid_implode( '%1$s .nav-trigger:hover .bar' ) ]['color'] = $trigger_color_hover . ' !important';
			}

		}

		if( ! empty($trigger_color_active) ) {

			if ( 'style-1' === $trigger_style ) {
				$elements[ liquid_implode( '%1$s .nav-trigger.is-active .bar' ) ]['background'] = $trigger_color_active;
			} else if ( 'style-2' === $trigger_style ) {
				$elements[ liquid_implode( '%1$s .nav-trigger.is-active .bar:before, %1$s .nav-trigger.is-active .bar:after' ) ]['background'] = $trigger_color_active;
			} else {
				$elements[ liquid_implode( '%1$s .nav-trigger.is-active .bar' ) ]['background'] = $trigger_color_active . ' !important';
				$elements[ liquid_implode( '%1$s .nav-trigger.is-active .bar' ) ]['color'] = $trigger_color_active . ' !important';
			}

		}

		if( ! empty($trigger_text_color) ) {
			$elements[ liquid_implode( '%1$s .nav-trigger' ) ]['color'] = $trigger_text_color;
		}
		
		if( !empty( $shape_color ) ) {
			if( 'solid' == $trigger_fill ) {
				$elements[ liquid_implode( '%1$s .nav-trigger.solid .bars:before' ) ]['background-color'] = $shape_color;
			}
			elseif( 'bordered' == $trigger_fill ) {
				$elements[ liquid_implode( '%1$s .nav-trigger.bordered .bars' ) ]['border-color'] = $shape_color;				
			}
		}
		if( !empty( $shape_hover_color ) ) {
			if( 'solid' == $trigger_fill ) {
				$elements[ liquid_implode( '%1$s .nav-trigger.solid:hover .bars:before' ) ]['background-color'] = $shape_hover_color;
			}
			elseif( 'bordered' == $trigger_fill ) {
				$elements[ liquid_implode( '%1$s .nav-trigger.bordered:hover .bars' ) ]['border-color'] = $shape_hover_color;				
			}
		}
		if( !empty( $shape_active_color ) ) {
			if( 'solid' == $trigger_fill ) {
				$elements[ liquid_implode( '%1$s .nav-trigger.solid.is-active .bars:before' ) ]['background-color'] = $shape_active_color;
			}
			elseif( 'bordered' == $trigger_fill ) {
				$elements[ liquid_implode( '%1$s .nav-trigger.bordered.is-active .bars' ) ]['border-color'] = $shape_active_color;				
			}
		}

		if( !empty( $inactive_items_opacity ) ) {
			$elements[ liquid_implode( '%1$s .lqd-fullproj-menu:hover .lqd-fullproj-title' ) ]['opacity'] = $inactive_items_opacity;
		}

		$this->dynamic_css_parser( $id, $elements );

	}
}
new LD_Header_Fullproj;