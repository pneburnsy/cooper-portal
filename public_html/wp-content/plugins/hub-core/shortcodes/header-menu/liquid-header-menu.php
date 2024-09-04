<?php
/**
* Shortcode Header Menu
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Header_Menu extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_header_menu';
		$this->title       = esc_html__( 'Primary Menu', 'landinghub-core' );
		$this->description = esc_html__( 'Add Navigation Menu', 'landinghub-core' );
		$this->icon        = 'la la-star';
		$this->category    = esc_html__( 'Header Modules', 'landinghub-core' );

		parent::__construct();

	}
	
	public function get_params() {

		$this->params = array(

			array(
				'type'        => 'dropdown',
				'param_name'  => 'menu_slug',
				'heading'     => esc_html__( 'Menu', 'landinghub-core' ),
				'description' => esc_html__( 'Select the menu you want to use.', 'landinghub-core' ),
				'admin_label' => true,
				'value' => ld_helper()->get_terms_data_for_vc('nav_menu'),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'hover_style',
				'heading' => esc_html__( 'Hover style', 'landinghub-core' ),
				'description' => esc_html__( 'Select a hover style for menu', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Default', 'landinghub-core' )             => 'default',
					esc_html__( 'Fade Inactive', 'landinghub-core' )       => 'fade-inactive',	
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'visible',
				'heading'     => esc_html__( 'Hide?', 'landinghub-core' ),
				'description' => esc_html__( 'Hide menu and display it only if pressed on trigger button', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'navbar-visible-ontoggle' ),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_menu',
				'heading'     => esc_html__( 'Custom font?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use custom font for menu', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'local_scroll',
				'heading'     => esc_html__( 'Enable Local scroll?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use local scroll, to create one page navigation', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'magnetic_items',
				'heading'     => esc_html__( 'Magnetic Items?', 'landinghub-core' ),
				'description' => esc_html__( 'Enables magnetic menu items, If custom cursor is enabled from Theme Options.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'alignment_subheading',
				'heading'    => esc_html__( 'Alignments', 'landinghub-core' ),
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'align_items',
				'heading' => esc_html__( 'Menu Alignment', 'landinghub-core' ),
				'description' => esc_html__( 'Select alignment for menu items', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Inherit', 'landinghub-core' ) => 'default-align',
					esc_html__( 'Left', 'landinghub-core' )    => 'start',
					esc_html__( 'Center', 'landinghub-core' )  => 'center',
					esc_html__( 'Right', 'landinghub-core' )   => 'end',
				),
				'std' => 'default-align',
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'align_counter',
				'heading' => esc_html__( 'Counter/Badge Alignment', 'landinghub-core' ),
				'description' => esc_html__( 'Select alignment for menu items', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Right', 'landinghub-core' ) => 'lqd-menu-counter-right',
					esc_html__( 'Left', 'landinghub-core' )   => 'lqd-menu-counter-left',
				),
				'std' => 'lqd-menu-counter-right',
				'edit_field_class' => 'vc_col-sm-6'
			),
			
			array(
				'type'       => 'subheading',
				'param_name' => 'spacing_subheading',
				'heading'    => esc_html__( 'Menu Items Spacing', 'landinghub-core' ),
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'padding_top',
				'heading'     => esc_html__( 'Top space', 'landinghub-core' ),
				'description' => esc_html__( 'Add top padding for menu', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 100,
				'step'        => 1,
				'std'         => 10,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'padding_right',
				'heading'     => esc_html__( 'Right space', 'landinghub-core' ),
				'description' => esc_html__( 'Add right padding for menu', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 100,
				'step'        => 1,
				'std'         => 15,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'padding_bottom',
				'heading'     => esc_html__( 'Bottom space', 'landinghub-core' ),
				'description' => esc_html__( 'Add bottom padding for menu', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 100,
				'step'        => 1,
				'std'         => 10,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'padding_left',
				'heading'     => esc_html__( 'Left space', 'landinghub-core' ),
				'description' => esc_html__( 'Add left padding for menu', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 100,
				'step'        => 1,
				'std'         => 15,
				'edit_field_class' => 'vc_col-sm-6',
			),
			
			array(
				'type'       => 'subheading',
				'param_name' => 'dropdown_options_subheading',
				'heading'    => esc_html__( 'Dropdown Options', 'landinghub-core' ),
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'ddmenu_hover_style',
				'heading' => esc_html__( 'Submenu Style', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Default', 'landinghub-core' ) => 'lqd-submenu-default-style',
					esc_html__( 'Cover', 'landinghub-core' )   => 'lqd-submenu-cover',
				),
				'std' => 'none',
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_ddmenu',
				'heading'     => esc_html__( 'Custom font?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use custom font for dropdown menu', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6'
			),
			
			//Typo Options
			array(
				'type'       => 'subheading',
				'param_name' => 'typo_options_subheading',
				'heading'    => esc_html__( 'Menu Typography', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_menu',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'fs',
				'heading'     => esc_html__( 'Font Size', 'landinghub-core' ),
				'description' => esc_html__( 'Example: 20px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'dependency' => array(
					'element' => 'use_custom_fonts_menu',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'lh',
				'heading'     => esc_html__( 'Line-Height', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'use_custom_fonts_menu',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'fw',
				'heading'     => esc_html__( 'Font Weight', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'use_custom_fonts_menu',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'ls',
				'heading'     => esc_html__( 'Letter Spacing', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'use_custom_fonts_menu',
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
					'element' => 'use_custom_fonts_menu',
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
					'element' => 'use_custom_fonts_menu',
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
			//Dropdown Typo Options
			array(
				'type'       => 'subheading',
				'param_name' => 'dropdown_typo_options_subheading',
				'heading'    => esc_html__( 'Dropdown Menu Typography', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_ddmenu',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'dd_fs',
				'heading'     => esc_html__( 'Font Size', 'landinghub-core' ),
				'description' => esc_html__( 'Example: 20px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'dependency' => array(
					'element' => 'use_custom_fonts_ddmenu',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'dd_lh',
				'heading'     => esc_html__( 'Line-Height', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'use_custom_fonts_ddmenu',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'dd_fw',
				'heading'     => esc_html__( 'Font Weight', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'use_custom_fonts_ddmenu',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'dd_ls',
				'heading'     => esc_html__( 'Letter Spacing', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'use_custom_fonts_ddmenu',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'dd_transform',
				'heading'    => esc_html__( 'Transformation', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Default', 'landinghub-core' )    => '',
					esc_html__( 'Uppercase', 'landinghub-core' )  => 'uppercase',
					esc_html__( 'Lowercase', 'landinghub-core' )  => 'lowercase',
					esc_html__( 'Capitalize', 'landinghub-core' ) => 'capitalize',
				),
				'dependency' => array(
					'element' => 'use_custom_fonts_ddmenu',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			/*
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use for Title theme default font family?', 'landinghub-core' ),
				'param_name'  => 'use_theme_ddfonts',
				'value'       => array(
					esc_html__( 'Yes', 'landinghub-core' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'landinghub-core' ),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_ddmenu',
					'value'   => 'true',
				),
				'std'         => 'yes',
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'ddmenu_font',
				'value'      => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
				'settings'   => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'landinghub-core' ),
						'font_style_description'  => esc_html__( 'Select font styling.', 'landinghub-core' ),
					),
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
				'dependency' => array(
					'element'            => 'use_theme_ddfonts',
					'value_not_equal_to' => 'yes',
				),
			),
			*/
			array(
				'type'       => 'subheading',
				'param_name' => 'color_design_options_subheading',
				'heading'    => esc_html__( 'Menu Color Options', 'landinghub-core' ),
				'group'      => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'link_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Menu Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the menu item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'link_hcolor',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Menu Hover Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick hover color for the menu item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'link_active_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Menu Active Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick actiev color for the menu item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Decoration Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the decoration line', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
				'dependency' => array(
					'element' => 'hover_style',
					'value' => array( 'underline-1' ),
				),
			),
			
			array(
				'type'       => 'subheading',
				'param_name' => 'dropdown_design_options_subheading',
				'heading'    => esc_html__( 'Dropdown Color Options', 'landinghub-core' ),
				'group'      => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'ddlink_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Dropdown Menu Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the dropdown menu item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'ddlink_hcolor',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Dropdown Menu Hover Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick hover color for the  dropdown menu item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'dd_bg',
				'heading'     => esc_html__( 'Dropdown Menu Background', 'landinghub-core' ),
				'description' => esc_html__( 'Pick background color for the  dropdown menu', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'sticky_separator',
				'heading'    => esc_html__( 'Sticky Colors', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_link_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Menu Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the menu item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_link_hcolor',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Menu Hover Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick hover color for the menu item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_link_active_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Menu Active Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick active color for the menu item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Decoration Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the decoration line', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
				'dependency' => array(
					'element' => 'hover_style',
					'value' => array( 'underline-1' ),
				),
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'sticky_light_separator',
				'heading'    => esc_html__( 'Colors Over Light Rows', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_light_link_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Menu Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the menu item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_light_link_hcolor',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Menu Hover Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick hover color for the menu item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_light_link_active_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Menu Active Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick active color for the menu item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_light_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Decoration Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the decoration line', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
				'dependency' => array(
					'element' => 'hover_style',
					'value' => array( 'underline-1' ),
				),
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'sticky_dark_separator',
				'heading'    => esc_html__( 'Colors Over Dark Rows', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_dark_link_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Menu Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the menu item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_dark_link_hcolor',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Menu Hover Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick hover color for the menu item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_dark_link_active_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Menu Active Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick active color for the menu item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_dark_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Decoration Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the decoration line', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
				'dependency' => array(
					'element' => 'hover_style',
					'value' => array( 'underline-1' ),
				),
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'sticky_dropdown_design_options_subheading',
				'heading'    => esc_html__( 'Sticky Dropdown Color Options', 'landinghub-core' ),
				'group'      => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_ddlink_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Dropdown Menu Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the dropdown menu item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_ddlink_hcolor',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Dropdown Menu Hover Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick hover color for the  dropdown menu item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_dd_bg',
				'heading'     => esc_html__( 'Dropdown Menu Background', 'landinghub-core' ),
				'description' => esc_html__( 'Pick background color for the  dropdown menu', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'sticky_light_dropdown_design_options_subheading',
				'heading'    => esc_html__( 'Dropdown Colors Over Light Rows', 'landinghub-core' ),
				'group'      => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_light_ddlink_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Dropdown Menu Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the dropdown menu item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_light_ddlink_hcolor',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Dropdown Menu Hover Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick hover color for the  dropdown menu item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_light_dd_bg',
				'heading'     => esc_html__( 'Dropdown Menu Background', 'landinghub-core' ),
				'description' => esc_html__( 'Pick background color for the  dropdown menu', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'sticky_dark_dropdown_design_options_subheading',
				'heading'    => esc_html__( 'Dropdown Colors Over Dark Rows', 'landinghub-core' ),
				'group'      => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_dark_ddlink_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Dropdown Menu Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the dropdown menu item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_dark_ddlink_hcolor',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Dropdown Menu Hover Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick hover color for the  dropdown menu item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_dark_dd_bg',
				'heading'     => esc_html__( 'Dropdown Menu Background', 'landinghub-core' ),
				'description' => esc_html__( 'Pick background color for the  dropdown menu', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),

		);

		$this->add_extras();
	}
	
	protected function add_local_scroll() {
		
		if( !$this->atts['local_scroll'] ) {
			return;
		}
		
		return 'data-localscroll="true" data-localscroll-options=\'{"itemsSelector": "> li > a", "trackWindowScroll": true}\'';

	}

	protected function add_magnetic_items() {
		
		if( !$this->atts['magnetic_items'] ) {
			return;
		}
		
		return 'lqd-magnetic-items';

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
		$menu_font_inline_style = $ddmenu_font_inline_style = '';
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
		$elements[ liquid_implode( '%1$s > li > a' ) ] = array( $menu_font_inline_style );
		$elements[ liquid_implode( '%1$s > li > a' ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ liquid_implode( '%1$s > li > a' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ liquid_implode( '%1$s > li > a' ) ]['font-weight'] = !empty( $fw ) ? $fw : '';
		$elements[ liquid_implode( '%1$s > li > a' ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';
		/*
		if( 'yes' !== $use_theme_ddfonts ) {

			// Build the data array
			$ddmenu_font_data = $this->get_fonts_data( $ddmenu_font );

			// Build the inline style
			$ddmenu_font_inline_style = $this->google_fonts_style( $ddmenu_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $ddmenu_font_data );

		}
		*/
		$elements[ liquid_implode( '%1$s .nav-item-children > li > a' ) ] = array( $ddmenu_font_inline_style );
		$elements[ liquid_implode( '%1$s .nav-item-children > li > a' ) ]['font-size'] = !empty( $dd_fs ) ? $dd_fs : '';
		$elements[ liquid_implode( '%1$s .nav-item-children > li > a' ) ]['line-height'] = !empty( $dd_lh ) ? $dd_lh : '';
		$elements[ liquid_implode( '%1$s .nav-item-children > li > a' ) ]['font-weight'] = !empty( $dd_fw ) ? $dd_fw : '';
		$elements[ liquid_implode( '%1$s .nav-item-children > li > a' ) ]['letter-spacing'] = !empty( $dd_ls ) ? $dd_ls : '';
		

		if( !empty( $color ) )  {
			$elements[liquid_implode( '%1$s > li > a:after' )]['background'] = $color;
		}
		if( !empty( $link_color ) ) {
			$elements[ liquid_implode( '%1$s > li > a, .navbar-fullscreen %1$s > li > a' ) ]['color'] = $link_color;
		}
		if( !empty( $link_hcolor ) ) {
			$elements[ liquid_implode( '%1$s > li:hover > a, .navbar-fullscreen %1$s > li > a:hover' ) ]['color'] = $link_hcolor;
		}
		if ( !empty( $link_hcolor ) && empty( $link_active_color ) ) {
			$elements[ liquid_implode( '%1$s > li.is-active > a, %1$s > li.current_page_item > a, %1$s > li.current-menu-item > a, %1$s > li.current-menu-ancestor > a, .navbar-fullscreen %1$s > li.is-active > a, .navbar-fullscreen %1$s > li.current_page_item > a, .navbar-fullscreen %1$s > li.current-menu-item > a, .navbar-fullscreen %1$s > li.current-menu-ancestor > a' ) ]['color'] = $link_hcolor;
		}
		if( !empty( $link_active_color ) ) {
			$elements[ liquid_implode( '%1$s > li.is-active > a, %1$s > li.current_page_item > a, %1$s > li.current-menu-item > a, %1$s > li.current-menu-ancestor > a, .navbar-fullscreen %1$s > li.is-active > a, .navbar-fullscreen %1$s > li.current_page_item > a, .navbar-fullscreen %1$s > li.current-menu-item > a, .navbar-fullscreen %1$s > li.current-menu-ancestor > a' ) ]['color'] = $link_active_color;
		}
		
		if( !empty( $ddlink_color ) ) {
			$elements[ liquid_implode( '%1$s .nav-item-children > li > a' ) ]['color'] = $ddlink_color;
		}
		if( !empty( $ddlink_hcolor ) ) {
			$elements[ liquid_implode( '%1$s .nav-item-children > li > a:hover' ) ]['color'] = $ddlink_hcolor;
		}
		if( !empty( $dd_bg ) ) {
			$elements[ liquid_implode( '%1$s .nav-item-children:before' ) ]['background'] = $dd_bg;
		}
		
		
		if( !empty( $sticky_color ) )  {
			$elements[liquid_implode( '.is-stuck .lqd-head-col > .header-module > .navbar-collapse %1$s > li > a:after' )]['background'] = $sticky_color;
		}
		if( !empty( $sticky_link_color ) ) {
			$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > .navbar-collapse %1$s > li > a' ) ]['color'] = $sticky_link_color;
		}
		if( !empty( $sticky_link_hcolor ) ) {
			$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > .navbar-collapse %1$s > li:hover > a' ) ]['color'] = $sticky_link_hcolor;
		}
		if ( !empty( $sticky_link_hcolor ) && empty( $sticky_link_active_color ) ) {
			$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > .navbar-collapse %1$s > li.is-active > a, .is-stuck .lqd-head-col > .header-module > .navbar-collapse %1$s > li.current_page_item > a, .is-stuck .lqd-head-col > .header-module > .navbar-collapse %1$s > li.current-menu-item > a, .is-stuck .lqd-head-col > .header-module > .navbar-collapse %1$s > li.current-menu-ancestor > a' ) ]['color'] = $sticky_link_hcolor;
		}
		if( !empty( $sticky_link_active_color ) ) {
			$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > .navbar-collapse %1$s > li.is-active > a, .is-stuck .lqd-head-col > .header-module > .navbar-collapse %1$s > li.current_page_item > a, .is-stuck .lqd-head-col > .header-module > .navbar-collapse %1$s > li.current-menu-item > a, .is-stuck .lqd-head-col > .header-module > .navbar-collapse %1$s > li.current-menu-ancestor > a' ) ]['color'] = $sticky_link_active_color;
		}
		
		if( !empty( $sticky_light_color ) )  {
			$elements[liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > .navbar-collapse %1$s > li > a:after' )]['background'] = $sticky_light_color;
		}
		if( !empty( $sticky_light_link_color ) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > .navbar-collapse %1$s > li > a' ) ]['color'] = $sticky_light_link_color;
		}
		if( !empty( $sticky_light_link_hcolor ) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > .navbar-collapse %1$s > li:hover > a' ) ]['color'] = $sticky_light_link_hcolor;
		}
		if ( !empty( $sticky_light_link_hcolor ) && empty( $sticky_light_link_active_color ) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > .navbar-collapse %1$s > li.is-active > a, .lqd-head-col > .lqd-active-row-light.header-module > .navbar-collapse %1$s > li.current_page_item > a, .lqd-head-col > .lqd-active-row-light.header-module > .navbar-collapse %1$s > li.current-menu-item > a, .lqd-head-col > .lqd-active-row-light.header-module > .navbar-collapse %1$s > li.current-menu-ancestor > a' ) ]['color'] = $sticky_light_link_hcolor;
		}
		if( !empty( $sticky_light_link_active_color ) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > .navbar-collapse %1$s > li.is-active > a, .lqd-head-col > .lqd-active-row-light.header-module > .navbar-collapse %1$s > li.current_page_item > a, .lqd-head-col > .lqd-active-row-light.header-module > .navbar-collapse %1$s > li.current-menu-item > a, .lqd-head-col > .lqd-active-row-light.header-module > .navbar-collapse %1$s > li.current-menu-ancestor > a' ) ]['color'] = $sticky_light_link_active_color;
		}
		
		if( !empty( $sticky_dark_color ) )  {
			$elements[liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > .navbar-collapse %1$s > li > a:after' )]['background'] = $sticky_dark_color;
		}
		if( !empty( $sticky_dark_link_color ) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > .navbar-collapse %1$s > li > a' ) ]['color'] = $sticky_dark_link_color;
		}
		if( !empty( $sticky_dark_link_hcolor ) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > .navbar-collapse %1$s > li:hover > a' ) ]['color'] = $sticky_dark_link_hcolor;
		}
		if ( !empty( $sticky_dark_link_hcolor ) && empty( $sticky_dark_link_active_color ) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > .navbar-collapse %1$s > li.is-active > a, .lqd-head-col > .lqd-active-row-dark.header-module > .navbar-collapse %1$s > li.current_page_item > a, .lqd-head-col > .lqd-active-row-dark.header-module > .navbar-collapse %1$s > li.current-menu-item > a, .lqd-head-col > .lqd-active-row-dark.header-module > .navbar-collapse %1$s > li.current-menu-ancestor > a' ) ]['color'] = $sticky_dark_link_hcolor;
		}
		if( !empty( $sticky_dark_link_active_color ) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > .navbar-collapse %1$s > li.is-active > a, .lqd-head-col > .lqd-active-row-dark.header-module > .navbar-collapse %1$s > li.current_page_item > a, .lqd-head-col > .lqd-active-row-dark.header-module > .navbar-collapse %1$s > li.current-menu-item > a, .lqd-head-col > .lqd-active-row-dark.header-module > .navbar-collapse %1$s > li.current-menu-ancestor > a' ) ]['color'] = $sticky_dark_link_active_color;
		}

		if( !empty( $sticky_ddlink_color ) ) {
			$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > .navbar-collapse %1$s .nav-item-children > li > a' ) ]['color'] = $sticky_ddlink_color;
		}
		if( !empty( $sticky_ddlink_hcolor ) ) {
			$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > .navbar-collapse %1$s .nav-item-children > li > a:hover' ) ]['color'] = $sticky_ddlink_hcolor;
		}
		if( !empty( $sticky_dd_bg ) ) {
			$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > .navbar-collapse %1$s .nav-item-children:before' ) ]['background'] = $sticky_dd_bg;
		}

		if( !empty( $sticky_light_ddlink_color ) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > .navbar-collapse %1$s .nav-item-children > li > a' ) ]['color'] = $sticky_light_ddlink_color;
		}
		if( !empty( $sticky_light_ddlink_hcolor ) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > .navbar-collapse %1$s .nav-item-children > li > a:hover' ) ]['color'] = $sticky_light_ddlink_hcolor;
		}
		if( !empty( $sticky_light_dd_bg ) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > .navbar-collapse %1$s .nav-item-children:before' ) ]['background'] = $sticky_light_dd_bg;
		}

		if( !empty( $sticky_dark_ddlink_color ) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > .navbar-collapse %1$s .nav-item-children > li > a' ) ]['color'] = $sticky_dark_ddlink_color;
		}
		if( !empty( $sticky_dark_ddlink_hcolor ) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > .navbar-collapse %1$s .nav-item-children > li > a:hover' ) ]['color'] = $sticky_dark_ddlink_hcolor;
		}
		if( !empty( $sticky_dark_dd_bg ) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > .navbar-collapse %1$s .nav-item-children:before' ) ]['background'] = $sticky_dark_dd_bg;
		}
		
		if( !empty( $transform ) ) {
			$elements[ liquid_implode( '%1$s > li > a' ) ]['text-transform'] = $transform;
		}

		if( '10' !== $padding_top ) {
			$elements[ liquid_implode( '%1$s' ) ]['--lqd-menu-items-top-padding'] = $padding_top . 'px';
		}
		if( '15' !== $padding_right ) {
			$elements[ liquid_implode( '%1$s' ) ]['--lqd-menu-items-right-padding'] = $padding_right . 'px';
		}
		if( '10' !== $padding_bottom ) {
			$elements[ liquid_implode( '%1$s' ) ]['--lqd-menu-items-bottom-padding'] = $padding_bottom . 'px';
		}
		if( '15' !== $padding_left ) {
			$elements[ liquid_implode( '%1$s' ) ]['--lqd-menu-items-left-padding'] = $padding_left . 'px';
		}

		$this->dynamic_css_parser( $id, $elements );

	}

}
new LD_Header_Menu;