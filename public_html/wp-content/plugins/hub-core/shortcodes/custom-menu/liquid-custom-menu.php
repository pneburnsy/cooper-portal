<?php
/**
* Shortcode Custom Menu
*/

if ( ! defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Custom_Menu extends LD_Shortcode { 
	
	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_custom_menu';
		$this->title       = esc_html__( 'Liquid Custom Menu', 'landinghub-core' );
		$this->icon        = 'la la-list';
		$this->description = esc_html__( 'Create custom menu.', 'landinghub-core' );
		$this->show_settings_on_create = true;

		parent::__construct();
	}
	
	public function get_params() {
		
		$icon = liquid_get_icon_params( false, 'Toggle Button', 'all', array( 'align', 'color', 'hcolor', 'size' ), 'i_', array( 'element' => 'add_toggle', 'value' => 'yes' ) );

		$general = array(
			array(
				'type' => 'dropdown',
				'param_name' => 'source',
				'heading' => esc_html__( 'Data Source', 'landinghub-core' ),
				'description' => esc_html__( 'Select Data source of the custom menu, it can be an existent wp menu or custom menu items added here the Items option.', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'WP Menus', 'landinghub-core' ) => 'wp_menus',
					esc_html__( 'Custom', 'landinghub-core' ) => 'custom',
				),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'menu_slug',
				'heading'     => esc_html__( 'Menu', 'landinghub-core' ),
				'description' => esc_html__( 'Select the menu you want to use.', 'landinghub-core' ),
				'admin_label' => true,
				'value' => ld_helper()->get_terms_data_for_vc('nav_menu'),
				'dependency' => array(
					'element' => 'source',
					'value' => 'wp_menus'
				)
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'localscroll',
				'heading'     => esc_html__( 'Local Scroll?', 'landinghub-core' ),
				'description' => esc_html__( 'Enable to use localscroll feature for the menu items on the page', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' )
			),
			array(
				'type'       => 'param_group',
				'param_name' => 'items',
				'heading'    => esc_html__( 'Items', 'landinghub-core' ),
				'params'     => array(
					array(
						'type'        => 'textfield',
						'param_name'  => 'label',
						'heading'     => esc_html__( 'Label', 'landinghub-core' ),
						'description' => esc_html__(  'Add label item', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
						'admin_label' => true,
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'url',
						'heading'     => esc_html__( 'URL (Link)', 'landinghub-core' ),
						'description' => esc_html__(  'Add link', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'badge',
						'heading'     => esc_html__( 'Badge', 'landinghub-core' ),
						'description' => esc_html__(  'Add badge to item', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
						'admin_label' => true,
					),
					array(
						'type'        => 'liquid_colorpicker',
						'param_name'  => 'badge_color',
						'only_solid'  => true,
						'heading'     => esc_html__( 'Badge Color', 'landinghub-core' ),
						'description' => esc_html__(  'Add badge color to item', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'icon_classname',
						'heading'     => esc_html__( 'Icon', 'landinghub-core' ),
						'description' => esc_html__(  'Add classname for the icon', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6',
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'icon_alignment',
						'heading'     => esc_html__( 'Icon Alignment', 'landinghub-core' ),
						'description' => esc_html__( 'Select alignement for the icon', 'landinghub-core' ),
						'value'       => array(
							esc_html__( 'Left', 'landinghub-core' )   => 'left-icon',
							esc_html__( 'Right', 'landinghub-core' )  => 'right-icon',
						),
						'edit_field_class' => 'vc_col-sm-6',
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'target',
						'heading'     => esc_html__( 'Link Target', 'landinghub-core' ),
						'value'       => array(
							esc_html__( 'Open in a new tab', 'landinghub-core' )   => '_blank',
							esc_html__( 'Open in self tab', 'landinghub-core' )  => '_self',
						),
						'edit_field_class' => 'vc_col-sm-6',
					),
				),
				'dependency' => array(
					'element' => 'source',
					'value' => 'custom'
				)
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'menu_alignment',
				'heading'     => esc_html__( 'Menu Alignment', 'landinghub-core' ),
				'description' => esc_html__( 'Select alignement for the menu', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Inherit', 'landinghub-core' ) => '',
					esc_html__( 'Left', 'landinghub-core' ) => 'text-left',
					esc_html__( 'Center', 'landinghub-core' )  => 'text-center',
					esc_html__( 'Right', 'landinghub-core' )   => 'text-right',
				),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'icon_pos',
				'heading'     => esc_html__( 'Icon Position', 'landinghub-core' ),
				'description' => esc_html__( 'Select the position for icon.', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Next to menu label', 'landinghub-core' )  => 'icon-next-to-label',
					esc_html__( 'Push to the edge', 'landinghub-core' )   => 'icon-push-to-edge',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'checkbox',
				'param_name'  => 'sticky',
				'heading'     => esc_html__( 'Sticky?', 'landinghub-core' ),
				'description' => esc_html__( 'Enable to make menu sticky', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'cm_sticky_type',
				'heading'    => esc_html__( 'Sticky Type', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Default', 'landinghub-core' )  => 'lqd-sticky-menu-default',
					esc_html__( 'Floating', 'landinghub-core' ) => 'lqd-sticky-menu-floating',
				),
				'std' => 'lqd-sticky-menu-default',
				'dependency' => array(
					'element' => 'sticky',
					'value' => 'yes'
				),
			),
			array(
				'type'       => 'checkbox',
				'param_name'  => 'inline',
				'heading'     => esc_html__( 'Inline?', 'landinghub-core' ),
				'description' => esc_html__( 'Enable to make menu inline', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'inline-nav' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'sticky',
					'value_not_equal_to' => 'yes'
				)
			),
			array(
				'type'       => 'checkbox',
				'param_name'  => 'auto_expand_items',
				'heading'     => esc_html__( 'Auto Expand Items?', 'landinghub-core' ),
				'description' => esc_html__( 'Expand items to fill the container.', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'inline-nav' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'sticky',
					'value' => 'yes'
				)
			),
			array(
				'type'       => 'checkbox',
				'param_name'  => 'add_separator',
				'heading'     => esc_html__( 'Add Separator?', 'landinghub-core' ),
				'description' => esc_html__( 'Enable to add separator', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'inline',
					'value' => 'inline-nav'
				)
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'separator',
				'heading'     => esc_html__( 'Separator', 'landinghub-core' ),
				'description' => esc_html__( 'Add separator', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'add_separator',
					'value' => 'yes'
				)
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'spacing',
				'heading'     => esc_html__( 'Space', 'landinghub-core' ),
				'description' => esc_html__( 'Space between items. Does not work if "Auto Expand Items?" is enabled.', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 50,
				'step'        => 1,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'checkbox',
				'param_name'  => 'add_toggle',
				'heading'     => esc_html__( 'Add Toggle Button?', 'landinghub-core' ),
				'description' => esc_html__( 'Enable to add toggle button', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'sticky',
					'is_empty' => true
				)
			),
			array(
				'type'       => 'checkbox',
				'param_name'  => 'mobile_add_toggle',
				'heading'     => esc_html__( 'Collapsible on Mobile?', 'landinghub-core' ),
				'description' => esc_html__( 'Enable this option if you want to make the menu collapsible on mobile', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'toggle_button_text',
				'heading'     => esc_html__( 'Toggle Text', 'landinghub-core' ),
				'description' => esc_html__( 'Add text for toggle button', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4 vc_column-with-padding',
				'dependency' => array(
					'element' => 'add_toggle',
					'value' => 'yes'
				),
				'group' => esc_html__( 'Toggle Button', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'mobile_toggle_button_text',
				'heading'     => esc_html__( 'Mobile Toggle Text', 'landinghub-core' ),
				'description' => esc_html__( 'Add text for mobile toggle button', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4 vc_column-with-padding',
				'dependency' => array(
					'element' => 'mobile_add_toggle',
					'value' => 'yes'
				),
				'group' => esc_html__( 'Toggle Button', 'landinghub-core' ),
			),
			array(
				'type'       => 'checkbox',
				'param_name'  => 'dropdown_collapsed',
				'heading'     => esc_html__( 'Collapsed?', 'landinghub-core' ),
				'description' => esc_html__( 'Enable if you want the dropdown collapsed by default.', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'std'					=> 'yes',
				'dependency' => array(
					'element' => 'add_toggle',
					'value' => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-4',
				'group' => esc_html__( 'Toggle Button', 'landinghub-core' ),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'toggle_shape',
				'heading'     => esc_html__( 'Toggle Shaoe', 'landinghub-core' ),
				'description' => esc_html__( 'Select a shape for the toggle button.', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Sharp', 'landinghub-core' ) => '',
					esc_html__( 'Round', 'landinghub-core' ) => 'round',
					esc_html__( 'Circle', 'landinghub-core' )  => 'circle',
				),
				'dependency' => array(
					'element' => 'add_toggle',
					'value' => 'yes'
				),
				'group' => esc_html__( 'Toggle Button', 'landinghub-core' ),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'add_scroll_indicator',
				'heading'     => esc_html__( 'Scroll Indicator?', 'landinghub-core' ),
				'description' => esc_html__( 'Add scroll indicator to each menu item.', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'sticky',
					'value' => 'yes'
				),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'magnetic_items',
				'heading'     => esc_html__( 'Magnetic Items?', 'landinghub-core' ),
				'description' => esc_html__( 'Enables magnetic menu items, If custom cursor is enabled from Theme Options.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'items_decoration',
				'heading'     => esc_html__( 'Menu Items Decoration', 'landinghub-core' ),
				'description' => esc_html__( 'Select text decoration for menu items.', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'None', 'landinghub-core' ) => 'lqd-menu-td-none',
					esc_html__( 'Underline', 'landinghub-core' ) => 'lqd-menu-td-underline',
				),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_list',
				'heading'     => esc_html__( 'Custom font?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use custom font for lists items', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4',
				'dependency' => array(
					'element' => 'add_toggle',
					'value' => 'yes'
				),
				'group' => esc_html__( 'Toggle Button', 'landinghub-core' ),
			),
			//Typo Options
			array(
				'type'        => 'textfield',
				'param_name'  => 'fs_button',
				'heading'     => esc_html__( 'Font Size', 'landinghub-core' ),
				'description' => esc_html__( 'Example: 20px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3 vc_column-with-padding',
				'dependency' => array(
					'element' => 'use_custom_fonts_list',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Toggle Button', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'lh_button',
				'heading'     => esc_html__( 'Line-Height', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_list',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Toggle Button', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'fw_button',
				'heading'     => esc_html__( 'Font Weight', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_list',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Toggle Button', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'ls_button',
				'heading'     => esc_html__( 'Letter Spacing', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_list',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Toggle Button', 'landinghub-core' ),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'transform_button',
				'heading'    => esc_html__( 'Transformation', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Default', 'landinghub-core' )    => '',
					esc_html__( 'Uppercase', 'landinghub-core' )  => 'uppercase',
					esc_html__( 'Lowercase', 'landinghub-core' )  => 'lowercase',
					esc_html__( 'Capitalize', 'landinghub-core' ) => 'capitalize',
				),
				'dependency' => array(
					'element' => 'use_custom_fonts_list',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Toggle Button', 'landinghub-core' ),
			),
			/*
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use for lists items theme default font family?', 'landinghub-core' ),
				'param_name'  => 'use_theme_fonts_button',
				'value'       => array(
					esc_html__( 'Yes', 'landinghub-core' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'landinghub-core' ),
				'group' => esc_html__( 'Toggle Button', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_list',
					'value'   => 'true',
				),
				'std'         => 'yes',
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'list_font_button',
				'value'      => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
				'settings'   => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'landinghub-core' ),
						'font_style_description'  => esc_html__( 'Select font styling.', 'landinghub-core' ),
					),
				),
				'group' => esc_html__( 'Toggle Button', 'landinghub-core' ),
				'dependency' => array(
					'element'            => 'use_theme_fonts_button',
					'value_not_equal_to' => 'yes',
				),
			),
			*/
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_menu',
				'heading'     => esc_html__( 'Custom font?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use custom font for menu', 'landinghub-core' ),
			),
			//Typo Options
			array(
				'type'        => 'textfield',
				'param_name'  => 'fs',
				'heading'     => esc_html__( 'Font Size', 'landinghub-core' ),
				'description' => esc_html__( 'Example: 20px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3 vc_column-with-padding',
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
				'edit_field_class' => 'vc_col-sm-3',
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
				'edit_field_class' => 'vc_col-sm-3',
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
				'edit_field_class' => 'vc_col-sm-3',
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
				'heading'     => esc_html__( 'Use for menu items theme default font family?', 'landinghub-core' ),
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
			array(
				'type'       => 'subheading',
				'param_name' => 'container_separator',
				'heading'    => esc_html__( 'Navigation Container Styling', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'bgcolor',
				'heading'     => esc_html__( 'Navigation Background Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a background color for the container', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'container_border_color',
				'heading'     => esc_html__( 'Navigation Border Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a border color for the container', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'       => 'subheading',
				'param_name' => 'links_separator',
				'heading'    => esc_html__( 'Menu Items Styling', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Links Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'hcolor',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Links Hover/Active Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the item hover and active state.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'bg_color',
				'heading'     => esc_html__( 'Link Background Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a background color for the item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'bg_hcolor',
				'heading'     => esc_html__( 'Hover Link Background Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick background color for the item hover and active state.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),

			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'border_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Links Border Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a border color for the item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'border_hcolor',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Links Hover Border Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick border hover color for the item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'icon_color',
				'heading'     => esc_html__( 'Icon Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick an icon color for the item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'icon_hcolor',
				'heading'     => esc_html__( 'Hover Icon Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick icon hover color for the item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'toggle_color',
				'heading'     => esc_html__( 'Toggle Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the toggle button.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
				'dependency' => array(
					'element' => 'add_toggle',
					'value' => 'yes'
				),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'toggle_active_color',
				'heading'     => esc_html__( 'Toggle Active Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the toggle button when it is active.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
				'dependency' => array(
					'element' => 'add_toggle',
					'value' => 'yes'
				),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'toggle_bg_color',
				'heading'     => esc_html__( 'Toggle Bg Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a background color for the toggle button.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
				'dependency' => array(
					'element' => 'add_toggle',
					'value' => 'yes'
				),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'toggle_active_bg_color',
				'heading'     => esc_html__( 'Toggle Active Bg Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a background color for the toggle button when it is active.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
				'dependency' => array(
					'element' => 'add_toggle',
					'value' => 'yes'
				),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'scroll_indicator_bg',
				'heading'     => esc_html__( 'Scroll Indicator Bg', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the backgound of scroll indicators.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'scroll_indicator_progress',
				'heading'     => esc_html__( 'Scroll Indicator Progress', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the backgound of scroll indicators progress bar.', 'landinghub-core' ),
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
				'param_name'  => 'sticky_bgcolor',
				'heading'     => esc_html__( 'Background Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a background color for the container', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_hcolor',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Hover Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick hover color for the item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_bg_color',
				'heading'     => esc_html__( 'Background Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a background color for the item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_bg_hcolor',
				'heading'     => esc_html__( 'Hover Background Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick background hover color for the item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),

			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_border_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Links Border Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a border color for the item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_border_hcolor',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Links Hover Border Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick border hover color for the item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_icon_color',
				'heading'     => esc_html__( 'Icon Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick an icon color for the item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_icon_hcolor',
				'heading'     => esc_html__( 'Hover Icon Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick icon hover color for the item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			
			array(
				'type'       => 'subheading',
				'param_name' => 'sticky_light_separator',
				'heading'    => esc_html__( 'Colors Over Light Rows', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_light_bgcolor',
				'heading'     => esc_html__( 'Background Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a background color for the container', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_light_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_light_hcolor',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Hover Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick hover color for the item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_light_bg_color',
				'heading'     => esc_html__( 'Background Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a background color for the item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_light_bg_hcolor',
				'heading'     => esc_html__( 'Hover Background Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick background hover color for the item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_light_border_color',
				'heading'     => esc_html__( 'Border Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a border color for the item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_light_border_hcolor',
				'heading'     => esc_html__( 'Hover Border Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick border hover color for the item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_light_icon_color',
				'heading'     => esc_html__( 'Icon Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick an icon color for the item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_light_icon_hcolor',
				'heading'     => esc_html__( 'Hover Icon Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick icon hover color for the item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'sticky_dark_separator',
				'heading'    => esc_html__( 'Colors Over Dark Rows', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_dark_bgcolor',
				'heading'     => esc_html__( 'Background Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a background color for the container', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_dark_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_dark_hcolor',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Hover Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick hover color for the item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_dark_bg_color',
				'heading'     => esc_html__( 'Background Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a background color for the item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_dark_bg_hcolor',
				'heading'     => esc_html__( 'Hover Background Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick background hover color for the item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),

			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_dark_border_color',
				'heading'     => esc_html__( 'Border Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a border color for the item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_dark_border_hcolor',
				'heading'     => esc_html__( 'Hover Border Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick border hover color for the item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_dark_icon_color',
				'heading'     => esc_html__( 'Icon Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick an icon color for the item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'sticky_dark_icon_hcolor',
				'heading'     => esc_html__( 'Hover Icon Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick icon hover color for the item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),

		);
		
		$this->params = array_merge( $general, $icon );

		$this->add_extras();
	}
	
	protected function get_the_icon() {

		$icon = liquid_get_icon( $this->atts );
		
		if( ! empty( $icon['type'] ) ) {			
			if( 'image' === $icon['type'] || 'animated' === $icon['type'] ) {
				$filetype = wp_check_filetype( $icon['src'] );
				if( 'svg' === $filetype['ext'] ) {
					$request  = wp_remote_get( $icon['src'] );
					$response = wp_remote_retrieve_body( $request );
					$svg_icon = $response;

					echo $svg_icon;
				} 
				else {
					printf( '<img src="%s" class="liquid-image-icon" />', esc_url( $icon['src'] ) );
				}
			}
			else {
				printf( '<i class="%s"></i>', $icon['icon'] );
			}
		}
		else {
			echo '<i class="fa fa-bars"></i>';
		}

	}

	protected function add_magnetic_items() {
		
		if( !$this->atts['magnetic_items'] ) {
			return;
		}
		
		return 'lqd-magnetic-items';

	}

	protected function add_auto_expand_items() {
		
		if( !$this->atts['auto_expand_items'] ) {
			return;
		}
		
		return 'lqd-custom-menu-expand-items';

	}

	protected function get_inline_nav() {
		
		if( !$this->atts['inline'] && !$this->atts['sticky'] ) {
			return;
		}
		
		return 'inline-nav';

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
		$menu_font_inline_style = $button_font_inline_style = '';
		
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
		
		$elements[ liquid_implode( '%1$s > ul > li > a' ) ] = array( $menu_font_inline_style );
		$elements[ liquid_implode( '%1$s > ul > li > a' ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ liquid_implode( '%1$s > ul > li > a' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ liquid_implode( '%1$s > ul > li > a' ) ]['font-weight'] = !empty( $fw ) ? $fw : '';
		$elements[ liquid_implode( '%1$s > ul > li > a' ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';
		$elements[ liquid_implode( '%1$s > ul > li > a' ) ]['text-transform'] = !empty( $transform ) ? $transform : '';
		
		/*
		if( 'yes' !== $use_theme_fonts_button ) {

			// Build the data array
			$button_font_data = $this->get_fonts_data( $list_font_button );

			// Build the inline style
			$button_font_inline_style = $this->google_fonts_style( $button_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $button_font_data );

		}
		*/
		$elements[ liquid_implode( '%1$s .toggle-label' ) ] = array( $button_font_inline_style );
		$elements[ liquid_implode( '%1$s .toggle-label' ) ]['font-size'] = !empty( $fs_button ) ? $fs_button : '';
		$elements[ liquid_implode( '%1$s .toggle-label' ) ]['line-height'] = !empty( $lh_button ) ? $lh_button : '';
		$elements[ liquid_implode( '%1$s .toggle-label' ) ]['font-weight'] = !empty( $fw_button ) ? $fw_button : '';
		$elements[ liquid_implode( '%1$s .toggle-label' ) ]['letter-spacing'] = !empty( $ls_button ) ? $ls_button : '';
		$elements[ liquid_implode( '%1$s .toggle-label' ) ]['text-transform'] = !empty( $transform_button ) ? $transform_button : '';
		
		

		if( !empty( $separator ) && 'inline-nav' === $inline ) {
			$elements[ liquid_implode( '%1$s li:not(:last-child):after' ) ]['content'] = '\'' . $separator . '\'';
		}
		
		if( !empty( $spacing ) && empty($auto_expand_items) ) {
			if( 'inline-nav' === $inline || ! empty($sticky) ) {
				
				$elements[ liquid_implode( '%1$s' ) ]['margin-inline-start'] = '-' . $spacing . 'px';
				$elements[ liquid_implode( '%1$s' ) ]['margin-inline-end'] = '-' . $spacing . 'px';

				if ( !empty( $separator ) ) {
					$elements[ liquid_implode( '%1$s li:after' ) ]['margin-inline-start'] = $spacing . 'px';
					$elements[ liquid_implode( '%1$s li:after' ) ]['margin-inline-end'] = $spacing . 'px';
					$elements[ liquid_implode( '.lqd-stickybar > .lqd-head-col > .header-module > %1$s li:after' ) ]['margin-top'] = $spacing . 'px';
					$elements[ liquid_implode( '.lqd-stickybar > .lqd-head-col > .header-module > %1$s li:after' ) ]['margin-bottom'] = $spacing . 'px';
				} else {
					$elements[ liquid_implode( '%1$s li' ) ]['margin-inline-start'] = $spacing . 'px';
					$elements[ liquid_implode( '%1$s li' ) ]['margin-inline-end'] = $spacing . 'px';
					$elements[ liquid_implode( '.lqd-stickybar > .lqd-head-col > .header-module > %1$s li' ) ]['margin-top'] = $spacing . 'px';
					$elements[ liquid_implode( '.lqd-stickybar > .lqd-head-col > .header-module > %1$s li' ) ]['margin-bottom'] = $spacing . 'px';
				}

			} else {
				$elements[ liquid_implode( '%1$s > ul > li:not(:last-child)' ) ]['margin-bottom'] = $spacing . 'px';
				$elements[ liquid_implode( '.lqd-stickybar > .lqd-head-col > .header-module > %1$s li' ) ]['margin-inline-start'] = $spacing . 'px';
			}	
		}

		// Colors
		if( !empty( $bgcolor ) ) {
			$elements[ liquid_implode( '%1$s' ) ]['background'] = $bgcolor;
		}
		if( !empty( $container_border_color ) ) {
			$elements[ liquid_implode( '%1$s' ) ]['border-bottom'] = '1px solid ' . $container_border_color;
		}
		if( !empty( $color ) ) {
			$elements[ liquid_implode( '%1$s > ul > li > a' ) ]['color'] = $color;
		}
		if( !empty( $hcolor ) ) {
			$elements[ liquid_implode( '%1$s > ul > li > a:hover, %1$s li.is-active > a' ) ]['color'] = $hcolor;
		}

		if( !empty( $bg_color ) ) {
			$elements[ liquid_implode( '%1$s > ul > li > a' ) ]['background'] = $bg_color;
		}
		if( !empty( $bg_hcolor ) ) {
			$elements[ liquid_implode( '%1$s > ul > li > a:hover, %1$s li.is-active > a' ) ]['background'] = $bg_hcolor;
		}

		if( !empty( $border_color ) ) {
			$elements[ liquid_implode( '%1$s.menu-items-has-border > ul > li > a' ) ]['border-color'] = $border_color . ' !important';
		}
		if( !empty( $border_hcolor ) ) {
			$elements[ liquid_implode( '%1$s.menu-items-has-border > ul > li > a:hover, %1$s.menu-items-has-border > ul > li.is-active > a' ) ]['border-color'] = $border_hcolor . ' !important';
		}

		if( !empty( $icon_color ) ) {
			$elements[ liquid_implode( '%1$s > ul > li .link-icon' ) ]['color'] = $icon_color;
		}
		if( !empty( $icon_hcolor ) ) {
			$elements[ liquid_implode( '%1$s > ul > li > a:hover .link-icon .link-icon, %1$s li.is-active .link-icon' ) ]['color'] = $icon_hcolor;
		}

		if( !empty( $toggle_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-custom-menu-dropdown-btn' ) ]['color'] = $toggle_color;
		}
		if( !empty( $toggle_active_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-custom-menu-dropdown-btn.is-active' ) ]['color'] = $toggle_active_color;
		}
		if( !empty( $toggle_bg_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-custom-menu-dropdown-btn' ) ]['background'] = $toggle_bg_color;
		}
		if( !empty( $toggle_active_bg_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-custom-menu-dropdown-btn.is-active' ) ]['background'] = $toggle_active_bg_color;
		}

		// Sticky Colors
		if( !empty( $sticky_bgcolor ) ) {
			$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s' ) ]['background'] = $sticky_bgcolor;
		}
		if( !empty( $sticky_color ) ) {
			$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s > ul > li > a' ) ]['color'] = $sticky_color;
		}
		if( !empty( $sticky_hcolor ) ) {
			$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s > ul > li > a:hover, .is-stuck .lqd-head-col > .header-module %1$s li.is-active > a' ) ]['color'] = $sticky_hcolor;
		}

		if( !empty( $sticky_bg_color ) ) {
			$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s > ul > li > a' ) ]['background'] = $sticky_bg_color;
		}
		if( !empty( $sticky_bg_hcolor ) ) {
			$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s > ul > li > a:hover, .is-stuck .lqd-head-col > .header-module %1$s li.is-active > a' ) ]['background'] = $sticky_bg_hcolor;
		}

		if( !empty( $sticky_border_color ) ) {
			$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s.menu-items-has-border > ul > li > a' ) ]['border-color'] = $sticky_border_color . ' !important';
		}
		if( !empty( $sticky_border_hcolor ) ) {
			$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module >  %1$s.menu-items-has-border > ul > li > a:hover, .is-stuck .lqd-head-col > .header-module >  %1$s.menu-items-has-border > ul > li.is-active > a' ) ]['border-color'] = $sticky_border_hcolor . ' !important';
		}

		if( !empty( $sticky_icon_color ) ) {
			$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s > ul > li .link-icon' ) ]['color'] = $sticky_icon_color;
		}
		if( !empty( $sticky_icon_hcolor ) ) {
			$elements[ liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s > ul > li > a:hover .link-icon, .is-stuck .lqd-head-col > .header-module %1$s li.is-active .link-icon' ) ]['color'] = $sticky_icon_hcolor;
		}

		// Light Colors
		if( !empty( $sticky_light_bgcolor ) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s' ) ]['background'] = $sticky_light_bgcolor;
		}
		if( !empty( $sticky_light_color ) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s > ul > li > a' ) ]['color'] = $sticky_light_color;
		}
		if( !empty( $sticky_light_hcolor ) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s > ul > li > a:hover, .lqd-head-col > .lqd-active-row-light.header-module > %1$s li.is-active > a' ) ]['color'] = $sticky_light_hcolor;
		}

		if( !empty( $sticky_light_bg_color ) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s > ul > li > a' ) ]['background'] = $sticky_light_bg_color;
		}
		if( !empty( $sticky_light_bg_hcolor ) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s > ul > li > a:hover, .lqd-head-col > .lqd-active-row-light.header-module > %1$s li.is-active > a' ) ]['background'] = $sticky_light_bg_hcolor;
		}

		if( !empty( $sticky_light_border_color ) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s.menu-items-has-border > ul > li > a' ) ]['border-color'] = $sticky_light_border_color . ' !important';
		}
		if( !empty( $sticky_light_border_hcolor ) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module >  %1$s.menu-items-has-border > ul > li > a:hover, .lqd-head-col > .lqd-active-row-light.header-module >  %1$s.menu-items-has-border > ul > li.is-active > a' ) ]['border-color'] = $sticky_light_border_hcolor . ' !important';
		}

		if( !empty( $sticky_light_icon_color ) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s > ul > li .link-icon' ) ]['color'] = $sticky_light_icon_color;
		}
		if( !empty( $sticky_light_icon_hcolor ) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s > ul > li > a:hover .link-icon, .lqd-head-col > .lqd-active-row-light.header-module > %1$s li.is-active .link-icon' ) ]['color'] = $sticky_light_icon_hcolor;
		}

		// Dark Colors
		if( !empty( $sticky_dark_bgcolor ) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s' ) ]['background'] = $sticky_dark_bgcolor;
		}
		if( !empty( $sticky_dark_color ) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s > ul > li > a' ) ]['color'] = $sticky_dark_color;
		}
		if( !empty( $sticky_dark_hcolor ) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s > ul > li > a:hover, .lqd-head-col > .lqd-active-row-dark.header-module > %1$s li.is-active > a' ) ]['color'] = $sticky_dark_hcolor;
		}

		if( !empty( $sticky_dark_bg_color ) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s > ul > li > a' ) ]['background'] = $sticky_dark_bg_color;
		}
		if( !empty( $sticky_dark_bg_hcolor ) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s > ul > li > a:hover, .lqd-head-col > .lqd-active-row-dark.header-module > %1$s li.is-active > a' ) ]['background'] = $sticky_dark_bg_hcolor;
		}
		
		if( !empty( $sticky_dark_border_color ) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s.menu-items-has-border > ul > li > a' ) ]['border-color'] = $sticky_dark_border_color . ' !important';
		}
		if( !empty( $sticky_dark_border_hcolor ) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module >  %1$s.menu-items-has-border > ul > li > a:hover, .lqd-head-col > .lqd-active-row-light.header-module >  %1$s.menu-items-has-border > ul > li.is-active > a' ) ]['border-color'] = $sticky_dark_border_hcolor . ' !important';
		}

		if( !empty( $sticky_dark_icon_color ) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s > ul > li .link-icon' ) ]['color'] = $sticky_dark_icon_color;
		}
		if( !empty( $sticky_dark_icon_hcolor ) ) {
			$elements[ liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s > ul > li > a:hover .link-icon, .lqd-head-col > .lqd-active-row-dark.header-module > %1$s li.is-active .link-icon' ) ]['color'] = $sticky_dark_icon_hcolor;
		}

		if( !empty( $scroll_indicator_bg ) ) {
			$elements[ liquid_implode( '%1$s .lqd-scrl-indc .lqd-scrl-indc-line' ) ]['background'] = $scroll_indicator_bg;
		}
		if( !empty( $scroll_indicator_progress ) ) {
			$elements[ liquid_implode( '%1$s .lqd-scrl-indc .lqd-scrl-indc-el' ) ]['background'] = $scroll_indicator_progress;
		}

		$this->dynamic_css_parser( $id, $elements );

	}

}
new LD_Custom_Menu;