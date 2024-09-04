<?php
/**
* Shortcode Simple Menu
*/

if ( ! defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Simple_Menu extends LD_Shortcode { 
	
	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_simple_menu';
		$this->title       = esc_html__( 'Liquid Simple Menu', 'landinghub-core' );
		$this->icon        = 'la la-list';
		$this->description = esc_html__( 'Create simple custom menu.', 'landinghub-core' );
		$this->show_settings_on_create = true;

		parent::__construct();
	}
	
	public function get_params() {

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
				),
				'dependency' => array(
					'element' => 'source',
					'value' => 'custom'
				)
			),
			//Typo Options
			array(
				'type'        => 'responsive_textfield',
				'param_name'  => 'fs',
				'heading'     => esc_html__( 'Font Size', 'landinghub-core' ),
				'description' => esc_html__( 'Example: 20px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3 vc_column-with-padding',
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'responsive_textfield',
				'param_name'  => 'lh',
				'heading'     => esc_html__( 'Line-Height', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'responsive_textfield',
				'param_name'  => 'fw',
				'heading'     => esc_html__( 'Font Weight', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'responsive_textfield',
				'param_name'  => 'ls',
				'heading'     => esc_html__( 'Letter Spacing', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
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
				'type'       => 'liquid_responsive',
				'heading'    => esc_html__( 'Margin', 'landinghub-core' ),
				'description' => esc_html__( 'Add margins for the element, use px or %', 'landinghub-core' ),
				'css'        => 'margin',
				'param_name' => 'margin',
				'group'      => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-md-6',
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

		);
		
		$this->params = array_merge( $general );

		$this->add_extras();
	}

	protected function get_inline_nav() {
		
		if( !$this->atts['inline'] ) {
			return;
		}
		
		return 'inline-nav';

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
	
	protected function generate_css() {
		
		$settings = get_option( 'wpb_js_google_fonts_subsets' );
		if ( is_array( $settings ) && ! empty( $settings ) ) {
			$subsets = '&subset=' . implode( ',', $settings );
		} else {
			$subsets = '';
		}

		extract( $this->atts );

		$elements = array();
		if( !empty( $el_id ) ) {
			$id = '#' . $el_id;	
		}
		else {
			$id = '.' . $this->get_id();
		}
	
		$menu_font_inline_style = '';
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
		if( !empty( $fs ) ) {
			if ( strpos( $fs, 'text_' ) !== false ) {
				$responsive_fs = Liquid_Responsive_Texfield_Param::generate_css( 'font-size', $fs, $_id . ' > ul > li > a' );
				$elements['media']['responsive-fs'] = $responsive_fs;
			}
			else {
				$elements[ liquid_implode( '%1$s > ul > li > a' ) ]['font-size'] = $fs;
			}
		}
		if( !empty( $lh ) ) {		
			if ( strpos( $lh, 'text_' ) !== false ) {
				$responsive_lh = Liquid_Responsive_Texfield_Param::generate_css( 'line-height', $lh, $_id . ' > ul > li > a' );
				$elements['media']['responsive-lh'] = $responsive_lh;
				$responsive_lh_var = Liquid_Responsive_Texfield_Param::generate_css( '--element-line-height', $lh, $_id . ' > ul > li > a' );
				$elements['media']['responsive-lh-var'] = $responsive_lh_var;
			}
			else {
				$elements[ liquid_implode( '%1$s > ul > li > a' ) ]['line-height'] = $lh;
			}	
		}
		if( !empty( $fw ) ) {
			if ( strpos( $fw, 'text_' ) !== false ) {
				$responsive_fw = Liquid_Responsive_Texfield_Param::generate_css( 'font-weight', $fw, $_id . ' > ul > li > a' );
				$elements['media']['responsive-fw'] = $responsive_fw;
			}
			else {
				$elements[ liquid_implode( '%1$s > ul > li > a' ) ]['font-weight'] = $fw;
			}
		}
		if( !empty( $ls ) ) {		
			if ( strpos( $ls, 'text_' ) !== false ) {
				$responsive_ls = Liquid_Responsive_Texfield_Param::generate_css( 'letter-spacing', $ls, $_id . ' > ul > li > a' );
				$elements['media']['responsive-ls'] = $responsive_ls;
			}
			else {
				$elements[ liquid_implode( '%1$s > ul > li > a' ) ]['letter-spacing'] = $ls;
			}
		}
		$elements[ liquid_implode( '%1$s > ul > li > a' ) ]['text-transform'] = !empty( $transform ) ? $transform : '';

		if( !empty( $spacing ) ) {
			if( 'inline-nav' === $inline || ! empty($sticky) ) {
				
				$elements[ liquid_implode( '%1$s' ) ]['margin-inline-start'] = '-' . $spacing . 'px';
				$elements[ liquid_implode( '%1$s' ) ]['margin-inline-end'] = '-' . $spacing . 'px';

				
				$elements[ liquid_implode( '%1$s li' ) ]['margin-inline-start'] = $spacing . 'px';
				$elements[ liquid_implode( '%1$s li' ) ]['margin-inline-end'] = $spacing . 'px';
				$elements[ liquid_implode( '.lqd-stickybar > .lqd-head-col > .header-module > %1$s li' ) ]['margin-top'] = $spacing . 'px';
				$elements[ liquid_implode( '.lqd-stickybar > .lqd-head-col > .header-module > %1$s li' ) ]['margin-bottom'] = $spacing . 'px';

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
		
		$responsive_margin = Liquid_Responsive_Param::generate_css( 'margin', $margin, $_id );
		$elements['media']['margin'] = $responsive_margin;

		$this->dynamic_css_parser( $id, $elements );

	}

}
new LD_Simple_Menu;