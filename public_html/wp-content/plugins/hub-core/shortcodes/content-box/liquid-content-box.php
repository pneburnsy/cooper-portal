<?php
/**
* Shortcode Content Box
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Content_Box extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_content_box';
		$this->title       = esc_html__( 'Fancy Box', 'landinghub-core' );
		$this->icon        = 'la la-th-large';
		$this->description = esc_html__( 'Create a fancy box', 'landinghub-core' );
		$this->show_settings_on_create = true;

		parent::__construct();
	}

	public function get_params() {

		$url = liquid_addons()->plugin_uri() . '/assets/img/sc-preview/fancy-box/';
		
		$icon_params = liquid_get_icon_params( false, '', array( 'fontawesome', 'linea' ), array( 'align', 'size' ), 'i_', array( 'element' => 'template', 'value' => array( 's08', 's06' ) ) );
		
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
				'type'       => 'select_preview',
				'param_name' => 'template',
				'heading'    => esc_html__( 'Style', 'landinghub-core' ),
				'value'      => array(

					array(
						'value' => 's01',
						'label' => esc_html__( 'Style 1', 'landinghub-core' ),
						'image' => $url . 'style01.jpg'
					),
					array(
						'value' => 's01a',
						'label' => esc_html__( 'Style 1 A', 'landinghub-core' ),
						'image' => $url . 'style01a.jpg'
					),
					array(
						'value' => 's01b',
						'label' => esc_html__( 'Style 1 B', 'landinghub-core' ),
						'image' => $url . 'style01b.jpg'
					),
					array(
						'value' => 's02',
						'label' => esc_html__( 'Style 2', 'landinghub-core' ),
						'image' => $url . 'style02.jpg'
					),
					array(
						'value' => 's03',
						'label' => esc_html__( 'Style 3', 'landinghub-core' ),
						'image' => $url . 'style03.jpg'
					),
					array(
						'value' => 's04',
						'label' => esc_html__( 'Style 4', 'landinghub-core' ),
						'image' => $url . 'style04.jpg'
					),
					array(
						'value' => 's05',
						'label' => esc_html__( 'Style 5', 'landinghub-core' ),
						'image' => $url . 'style05.jpg'
					),
					array(
						'value' => 's06',
						'label' => esc_html__( 'Style 6', 'landinghub-core' ),
						'image' => $url . 'style06.jpg'
					),
					array(
						'value' => 's07',
						'label' => esc_html__( 'Style 7', 'landinghub-core' ),
						'image' => $url . 'style07.jpg'
					),
					array(
						'value' => 's08',
						'label' => esc_html__( 'Style 8', 'landinghub-core' ),
						'image' => $url . 'style08.jpg'
					),
					array(
						'value' => 's09',
						'label' => esc_html__( 'Style 9', 'landinghub-core' ),
						'image' => $url . 'style09.jpg'
					),
					array(
						'value' => 's10',
						'label' => esc_html__( 'Style 10', 'landinghub-core' ),
						'image' => $url . 'style10.jpg'
					),
					array(
						'value' => 's11',
						'label' => esc_html__( 'Style 11', 'landinghub-core' ),
						'image' => $url . 'style11.jpg'
					),
				),
				'save_always' => true,
			),
			array(
				'id'          => 'title',
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'tag',
				'heading'     => esc_html__( 'Element tag', 'landinghub-core' ),
				'description' => esc_html__( 'Select element tag.', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'h1', 'landinghub-core' )  => 'h1',
					esc_html__( 'h2', 'landinghub-core' )  => 'h2',
					esc_html__( 'h3', 'landinghub-core' )  => 'h3',
					esc_html__( 'h4', 'landinghub-core' )  => 'h4',
					esc_html__( 'h5', 'landinghub-core' )  => 'h5',
					esc_html__( 'h6', 'landinghub-core' )  => 'h6',
					esc_html__( 'p', 'landinghub-core' )   => 'p',
					esc_html__( 'div', 'landinghub-core' ) => 'div',
				),
				'std' => 'h2'
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_title',
				'heading'     => esc_html__( 'Custom font?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use custom font for title', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'subtitle',
				'heading'     => esc_html__( 'Subtitle', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'template',
					'value'   => array( 's06' ),				
				),
				
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_subtitle',
				'heading'     => esc_html__( 'Custom font?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use custom font for subtitle', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'template',
					'value'   => array( 's06' ),				
				),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'content_alignment',
				'heading'    => esc_html__( 'Content Alignment', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Default', 'landinghub-core' )  => '',
					esc_html__( 'Bottom Right', 'landinghub-core' ) => 'lqd-fb-content-br',
					esc_html__( 'Bottom Center', 'landinghub-core' ) => 'lqd-fb-content-bc',
					esc_html__( 'Middle', 'landinghub-core' ) => 'lqd-fb-content-mid',
				),
				'dependency'  => array(
					'element' => 'template',
					'value'   => array( 's08' ),
				),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'ct_width',
				'heading'    => esc_html__( 'Content Width', 'landinghub-core' ),
				'value'      => array(
					esc_html__( '50%', 'landinghub-core' )  => 'w-50',
					esc_html__( '60%', 'landinghub-core' )  => 'w-60',
					esc_html__( '70%', 'landinghub-core' )  => 'w-70',
					esc_html__( '80%', 'landinghub-core' )  => 'w-80',
					esc_html__( '90%', 'landinghub-core' )  => 'w-90',
					esc_html__( '100%', 'landinghub-core' )  => 'w-100',
				),
				'dependency'  => array(
					'element' => 'template',
					'value'   => array( 's08' ),
				),
				'std' => 'w-60',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'ct_alignment',
				'heading'    => esc_html__( 'Content Alignment', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Default', 'landinghub-core' )  => 'text-center',
					esc_html__( 'Left', 'landinghub-core' )  => 'text-left',
					esc_html__( 'Right', 'landinghub-core' )  => 'text-right',
				),
				'dependency'  => array(
					'element' => 'template',
					'value'   => array( 's09' ),
				),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'box_height',
				'heading'    => esc_html__( 'Box Height', 'landinghub-core' ),
				'value'      => array(
					esc_html__( '50%', 'landinghub-core' )  => 'h-pt-50',
					esc_html__( '60%', 'landinghub-core' )  => 'h-pt-60',
					esc_html__( '70%', 'landinghub-core' )  => 'h-pt-70',
					esc_html__( '80%', 'landinghub-core' )  => 'h-pt-80',
					esc_html__( '90%', 'landinghub-core' )  => 'h-pt-90',
					esc_html__( '100%', 'landinghub-core' ) => 'h-pt-100',
				),
				'std' => 'h-pt-100',
				'dependency'  => array(
					'element' => 'template',
					'value'   => array( 's01' ),
				),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'box_height_a',
				'heading'    => esc_html__( 'Box Height', 'landinghub-core' ),
				'value'      => array(
					esc_html__( '50%', 'landinghub-core' )  => 'h-pt-50',
					esc_html__( '60%', 'landinghub-core' )  => 'h-pt-60',
					esc_html__( '70%', 'landinghub-core' )  => 'h-pt-70',
					esc_html__( '80%', 'landinghub-core' )  => 'h-pt-80',
					esc_html__( '100%', 'landinghub-core' ) => 'h-pt-100',
				),
				'std' => 'h-pt-50',
				'dependency'  => array(
					'element' => 'template',
					'value'   => array( 's01a' ),
				),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'box_height_b',
				'heading'    => esc_html__( 'Box Height', 'landinghub-core' ),
				'value'      => array(
					esc_html__( '50%', 'landinghub-core' )  => 'h-pt-50',
					esc_html__( '60%', 'landinghub-core' )  => 'h-pt-60',
					esc_html__( '70%', 'landinghub-core' )  => 'h-pt-70',
					esc_html__( '80%', 'landinghub-core' )  => 'h-pt-80',
					esc_html__( '100%', 'landinghub-core' ) => 'h-pt-100',
				),
				'std' => 'h-pt-80',
				'dependency'  => array(
					'element' => 'template',
					'value'   => array( 's01b' ),
				),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'box_height_6',
				'heading'    => esc_html__( 'Box Height', 'landinghub-core' ),
				'value'      => array(
					esc_html__( '50%', 'landinghub-core' )  => 'h-pt-50',
					esc_html__( '60%', 'landinghub-core' )  => 'h-pt-60',
					esc_html__( '70%', 'landinghub-core' )  => 'h-pt-70',
					esc_html__( '80%', 'landinghub-core' )  => 'h-pt-80',
					esc_html__( '90%', 'landinghub-core' )  => 'h-pt-90',
					esc_html__( '100%', 'landinghub-core' ) => 'h-pt-100',
					esc_html__( '125%', 'landinghub-core' ) => 'h-pt-125',
				),
				'std' => 'h-pt-125',
				'dependency'  => array(
					'element' => 'template',
					'value'   => array( 's06' ),
				),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'label',
				'heading'     => esc_html__( 'Label', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'template',
					'value'   => array( 's01', 's01b', 's03' ),
				),
			),
			array(
				'type'        => 'liquid_attach_image',
				'param_name'  => 'image',
				'heading'     => esc_html__( 'Image', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'template',
					'value_not_equal_to'   => array( 's10' ),
				),
			),
			array(
				'type'        => 'vc_link',
				'param_name'  => 'img_link',
				'heading'     => esc_html__( 'Link', 'landinghub-core' ),
			),

			array(
				'type'       => 'textarea_html',
				'param_name' => 'content',
				'heading'    => esc_html__( 'Text', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'template',
					'value'   => array( 's01', 's01b', 's04', 's05', 's07', 's09', 's10' ),
				),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'show_button',
				'heading'    => esc_html__( 'Show Button', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'No', 'landinghub-core' )  => '',
					esc_html__( 'Yes', 'landinghub-core' ) => 'yes'
				),
				'dependency'  => array(
					'element' => 'template',
					'value'   => array( 's01a', 's01b', 's02', 's04', 's05', 's06', 's10' ),
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
				'dependency' => array(
					'element' => 'use_custom_fonts_subtitle',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Subtitle Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'subtitle_lh',
				'heading'     => esc_html__( 'Line-Height', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_subtitle',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Subtitle Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'subtitle_fw',
				'heading'     => esc_html__( 'Font Weight', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_subtitle',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Subtitle Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'subtitle_ls',
				'heading'     => esc_html__( 'Letter Spacing', 'landinghub-core' ),
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
			array(
				'type'       => 'liquid_responsive',
				'heading'    => esc_html__( 'Margin', 'landinghub-core' ),
				'description' => esc_html__( 'Add margins for the element, use px or %', 'landinghub-core' ),
				'css'        => 'margin',
				'param_name' => 'margin',
				'group'      => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-md-6',
			),
			// Colors
			array( 
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'overlay_color',
				'heading'     => esc_html__( 'Image Overlay Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency' => array(
					'element'            => 'template',
					'value_not_equal_to' => array('s04', 's05', 's07', 's08', 's10')
				)
			),
			array( 
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'overlay_hcolor',
				'heading'     => esc_html__( 'Hover Image Overlay Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency' => array(
					'element'            => 'template',
					'value_not_equal_to' => array('s08', 's10')
				)
			),
			array( 
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'content_bg',
				'heading'     => esc_html__( 'Content Background', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency' => array(
					'element'            => 'template',
					'value_not_equal_to' => array('s10')
				)
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'revealer_color',
				'heading'     => esc_html__( 'Revealer Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'template',
					'value'   => array('s02', 's03', 's08' )
				),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'hover_revealer_color',
				'heading'     => esc_html__( 'Hover Revealer Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'template',
					'value'   => array( 's08' )
				),
			),
			array( 
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'heading_color',
				'heading'     => esc_html__( 'Heading Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
			),
			array( 
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'heading_hcolor',
				'heading'     => esc_html__( 'Heading Hover Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
			),
			array( 
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'subtitle_color',
				'heading'     => esc_html__( 'Subtitle Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'template',
					'value'   => array( 's06' )
				),
			),
			array( 
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'hover_text_color',
				'heading'     => esc_html__( 'Hover Text Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'template',
					'value'   => array( 's08' )
				),
			),
			array( 
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'label_color',
				'heading'     => esc_html__( 'Label Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'template',
					'value'   => array('s01', 's01b', 's03')
				),
			),

		);
	
		$this->params = array_merge( $params, $icon_params, $button );
		$this->add_extras();

	}
	
	protected function get_title() {

		// check
		if( empty( $this->atts['title'] ) ) {
			return '';
		}
		
		$link = liquid_get_link_attributes( $this->atts['img_link'], false );
		if ( !empty( $link['href'] ) ) {
			$title = sprintf( '<a%s>%s</a>', ld_helper()->html_attributes( $link ), $this->atts['title'] );
		}
		else {
			$title = $this->atts['title'];	
		}

		echo $title;
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
	
	protected function get_image( $wrapper = true, $invisible = true ) {

		// check value
		if( empty( $this->atts['image'] ) ) {
			return;
		}

		$img_src = $image = '';
		$alt = get_post_meta( $this->atts['image'], '_wp_attachment_image_alt', true );
		$link = liquid_get_link_attributes( $this->atts['img_link'], false );

		if( preg_match( '/^\d+$/', $this->atts['image'] ) ) {
			if( $invisible ) {
				if( 's07' === $this->atts['template'] ) {
					$html = wp_get_attachment_image( $this->atts['image'], 'full', false, array( 'alt' => esc_html( $alt ), 'class' => 'w-100 invisible pos-abs' ) );	
				}
				else {
					$html = wp_get_attachment_image( $this->atts['image'], 'full', false, array( 'alt' => esc_html( $alt ), 'class' => 'w-100 invisible' ) );	
				}
				
			}
			else {
				$html = wp_get_attachment_image( $this->atts['image'], 'full', false, array( 'alt' => esc_html( $alt ) , 'class' => 'w-100') );
			}
		} 
		else {
			$img_src  = $this->atts['image'];
			if( $invisible ) {
				if( 's07' === $this->atts['template'] ) {
					$html = '<img class="w-100 invisible pos-abs" src="' . esc_url( $img_src ) . '" alt="' . esc_html( $alt ) . '" />'; 
				}
				else {
					$html = '<img class="w-100 invisible" src="' . esc_url( $img_src ) . '" alt="' . esc_html( $alt ) . '" />'; 
				}
			}
			else {
				$html = '<img class="w-100" src="' . esc_url( $img_src ) . '" alt="' . esc_html( $alt ) . '" />';
			}
		}

		if( $wrapper ) {
			$image = sprintf( '<figure data-responsive-bg="true">%s</figure>', $html );	
		}
		else {
			$image = $html;
		}
		
		echo $image;

	}
	
	protected function get_overlay_link() {
		
		$link = liquid_get_link_attributes( $this->atts['img_link'], false );
		if ( !empty( $link['href'] ) ) {
			printf( '<a%s class="liquid-overlay-link"></a>', ld_helper()->html_attributes( $link )  );
		}
		
	}
	
	protected function get_icon() {

		$icon = liquid_get_icon( $this->atts );
		$icon_html = '';

		if( $icon['type'] ) {
			$icon_html = '<i class="' . $icon['icon'] . '"></i>';
		}

		echo $icon_html;

	}

	protected function get_subtitle() {

		// check
		if( empty( $this->atts['subtitle'] ) ) {
			return '';
		}

		$subtitle = $this->atts['subtitle'];

		echo $subtitle;
	}
	
	protected function get_content() {

		// check
		if( empty( $this->atts['content'] ) ) {
			return '';
		}

		$content = ld_helper()->do_the_content( $this->atts['content'], false );

		echo $content;
	}
	
	protected function get_label() {
		
		// check
		if( empty( $this->atts['label'] ) ) {
			return '';
		}

		echo ld_helper()->do_the_content( $this->atts['label'], false ); 
		
	}
	
	protected function get_class( $style ) {
		
		$hash = array(
			's01'  => 'lqd-fb-style-1 round pos-rel overflow-hidden lqd-fb-zoom-img-onhover',
			's01a' => 'lqd-fb-style-1 lqd-fb-style-1-2 round pos-rel overflow-hidden lqd-fb-zoom-img-onhover',
			's01b' => 'lqd-fb-style-1 lqd-fb-style-1-3 round pos-rel overflow-hidden lqd-fb-zoom-img-onhover',
			's02'  => 'lqd-fb-style-2 round pos-rel overflow-hidden h-pt-80 lqd-fb-zoom-img-onhover',
			's03'  => 'lqd-fb-style-3 round pos-rel lqd-fb-zoom-img-onhover',
			's04'  => 'lqd-fb-style-4 lqd-fb-zoom-img-onhover pos-rel',
			's05'  => 'lqd-fb-style-5 overflow-hidden pos-rel',
			's06'  => 'lqd-fb-style-6 pos-rel',
			's07'  => 'lqd-fb-style-7 overflow-hidden round pos-rel',
			's08'  => 'lqd-fb-style-8 pos-rel',
			's09'  => 'lqd-fb-style-9 border-radius-10 overflow-hidden pos-rel',
			's10'  => 'lqd-fb-style-10 pos-rel',
			's11'  => 'lqd-fb-style-11 text-center',
		);

		return isset( $hash[ $style ] ) ? $hash[ $style ] : '';
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
		$elements[ liquid_implode( '%1$s .lqd-fb-content-title' ) ] = array( $text_font_inline_style );
		$elements[ liquid_implode( '%1$s .lqd-fb-content-title' ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ liquid_implode( '%1$s .lqd-fb-content-title' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ liquid_implode( '%1$s .lqd-fb-content-title' ) ]['font-weight'] = !empty( $fw ) ? $fw . ' !important' : '';
		$elements[ liquid_implode( '%1$s .lqd-fb-content-title' ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';
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
		$elements[ liquid_implode( '%1$s.lqd-fb-style-6 h6' ) ] = array( $subtitle_font_inline_style );
		$elements[ liquid_implode( '%1$s.lqd-fb-style-6 h6' ) ]['font-size'] = !empty( $subtitle_fs ) ? $subtitle_fs : '';
		$elements[ liquid_implode( '%1$s.lqd-fb-style-6 h6' ) ]['line-height'] = !empty( $subtitle_lh ) ? $subtitle_lh : '';
		$elements[ liquid_implode( '%1$s.lqd-fb-style-6 h6' ) ]['font-weight'] = !empty( $subtitle_fw ) ? $subtitle_fw . ' !important' : '';
		$elements[ liquid_implode( '%1$s.lqd-fb-style-6 h6' ) ]['letter-spacing'] = !empty( $subtitle_ls ) ? $subtitle_ls : '';
		
		if( ! empty( $overlay_color ) && isset( $overlay_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-fb-bg' ) ]['background'] = $overlay_color;
		}
		if( ! empty( $overlay_hcolor ) && isset( $overlay_hcolor ) ) {
			$elements[ liquid_implode( '%1$s .lqd-fb-hover-overlay' ) ]['background'] = $overlay_hcolor;
		}
		if( ! empty( $content_bg ) && isset( $content_bg ) ) {
			$elements[ liquid_implode( '%1$s .lqd-fb-content' ) ]['background'] = $content_bg;
		}
		
		if( ! empty( $revealer_color ) && isset( $revealer_color ) ) {
			$elements[ liquid_implode( '%1$s .block-revealer__element' ) ]['background'] = $revealer_color . ' !important';
		}
		if( ! empty( $hover_revealer_color ) && isset( $hover_revealer_color ) ) {
			$elements[ liquid_implode( '%1$s .block-revealer__element:before' ) ]['background'] = $hover_revealer_color . '';
		}

		if( ! empty( $border_color ) && isset( $border_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-fb-img:after' ) ]['background'] = $border_color . ' !important';
		}
		if( ! empty( $heading_color ) && isset( $heading_color ) ) {
			$elements[ liquid_implode( '%1$s h2' ) ]['color'] = $heading_color;
			$elements[ liquid_implode( '%1$s .lqd-fb-title i' ) ]['color'] = $heading_color;
		}
		if( ! empty( $heading_hcolor ) && isset( $heading_hcolor ) ) {
			$elements[ liquid_implode( '%1$s:hover h2' ) ]['color'] = $heading_hcolor;
		}
		if( ! empty( $hover_text_color ) && isset( $hover_text_color ) ) {
			$elements[ liquid_implode( '%1$s:hover .lqd-fb-content' ) ]['color'] = $hover_text_color;
		}
		if( ! empty( $label_color ) && isset( $label_color ) ) {
			$elements[ liquid_implode( '%1$s h6' ) ]['color'] = $label_color;
		}
		if( ! empty( $subtitle_color ) && isset( $subtitle_color ) ) {
			$elements[ liquid_implode( '%1$s.lqd-fb-style-6 h6' ) ]['color'] = $subtitle_color;
		}
		
		if( ! empty( $i_color ) && isset( $i_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-fb-icon' ) ]['color'] = $i_color;
		}
		if( ! empty( $i_hcolor ) && isset( $i_hcolor ) ) {
			$elements[ liquid_implode( '%1$s:hover .lqd-fb-icon' ) ]['color'] = $i_hcolor;
		}

		$responsive_margin = Liquid_Responsive_Param::generate_css( 'margin', $margin, $_id );
		$elements['media']['margin'] = $responsive_margin;

		$this->dynamic_css_parser( $id, $elements );

	}

}
new LD_Content_Box;
