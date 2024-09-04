<?php
/**
* Shortcode Header Cart
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Header_Cart extends LD_Shortcode {
	
	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_header_cart';
		$this->title       = esc_html__( 'Header Cart', 'landinghub-core' );
		$this->description = esc_html__( 'Mini cart', 'landinghub-core' );
		$this->icon        = 'la la-star';
		$this->styles       = array( 'vc_font_awesome_5' );
		$this->category    = esc_html__( 'Header Modules', 'landinghub-core' );

		parent::__construct();
	}
	
	public function get_params() {

		$this->params = array_merge(
			array(
				array(
					'type'       => 'subheading',
					'param_name' => 'cart_style',
					'heading'    => esc_html__( 'Cart Style', 'landinghub-core' ),
				),
				array(
					'type' => 'checkbox',
					'param_name' => 'enable_offcanvas',
					'heading'    => esc_html__( 'Offcanvas?', 'landinghub-core' ),
					'description' => esc_html__( 'Enable offcanvas cart. NOTE ( Please re-generate the resposive css from theme options panel )', 'landinghub-core' ),
					'value'      => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
					'std'        => '',
				),
				array(
					'type'       => 'subheading',
					'param_name' => 'show_hide_parts',
					'heading'    => esc_html__( 'Show/Hide Parts', 'landinghub-core' ),
				),
				array(
					'type'        => 'liquid_button_set',
					'param_name'  => 'show_icon',
					'heading'     => esc_html__( 'Show Icon?', 'landinghub-core' ),
					'description' => esc_html__( 'Enable if you want to show the icon.', 'landinghub-core' ),
					'value'       => array(
						esc_html__( 'Yes', 'landinghub-core' ) => 'lqd-module-show-icon',
						esc_html__( 'No', 'landinghub-core' )  => 'lqd-module-hide-icon',
					),
					'std' => 'lqd-module-show-icon',
					'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				),
				array(
					'type'        => 'liquid_button_set',
					'param_name'  => 'show_counter',
					'heading'     => esc_html__( 'Show Counter Badge?', 'landinghub-core' ),
					'description' => esc_html__( 'Enable if you want to show the cart total items counter.', 'landinghub-core' ),
					'value'       => array(
						esc_html__( 'Yes', 'landinghub-core' ) => 'lqd-module-show-badge',
						esc_html__( 'No', 'landinghub-core' )  => 'lqd-module-hide-badge',
					),
					'std' => 'lqd-module-show-badge',
					'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				),
				array(
					'type'        => 'liquid_button_set',
					'param_name'  => 'offcanvas_placement',
					'heading'     => esc_html__( 'Placement', 'landinghub-core' ),
					'value'       => array(
						esc_html__( 'Left', 'landinghub-core' )  => 'ld-module-to-left',
						esc_html__( 'Right', 'landinghub-core' ) => 'ld-module-to-right',
					),
					'std' => '',
					'dependency' => array(
						'element' => 'enable_offcanvas',
						'value' => 'yes',
					),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'        => 'liquid_button_set',
					'param_name'  => 'show_on_mobile',
					'heading'     => esc_html__( 'Show on Mobile', 'landinghub-core' ),
					'description' => esc_html__( 'Enable if you want to display it on mobile devices', 'landinghub-core' ),
					'value'       => array(
						esc_html__( 'Yes', 'landinghub-core' ) => 'lqd-show-on-mobile',
						esc_html__( 'No', 'landinghub-core' )  => '',
					),
					'std' => 'lqd-show-on-mobile',
					'edit_field_class' => 'vc_col-sm-4',
				),
				array(
					'type'       => 'subheading',
					'param_name' => 'parts_styles',
					'heading'    => esc_html__( 'Parts Stlyling', 'landinghub-core' ),
				),
				array(
					'type'        => 'liquid_button_set',
					'param_name'  => 'icon_style',
					'heading'     => esc_html__( 'Icon Style', 'landinghub-core' ),
					'description' => esc_html__( 'Select an style for the cart icon.', 'landinghub-core' ),
					'value'       => array(
						esc_html__( 'Plain', 'landinghub-core' ) => 'lqd-module-icon-plain',
						esc_html__( 'Outlined', 'landinghub-core' )  => 'lqd-module-icon-outline',
					),
					'std' => 'lqd-module-icon-plain',
					'dependency' => array(
						'element' => 'show_icon',
						'value' => 'lqd-module-show-icon'
					),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'        => 'liquid_button_set',
					'param_name'  => 'counter_style',
					'heading'     => esc_html__( 'Counter Style', 'landinghub-core' ),
					'description' => esc_html__( 'Select an style for the counter badge.', 'landinghub-core' ),
					'value'       => array(
						esc_html__( 'Filled', 'landinghub-core' ) => 'lqd-module-badge-fill',
						esc_html__( 'Outline', 'landinghub-core' )  => 'lqd-module-badge-outline',
					),
					'std' => 'lqd-module-badge-fill',
					'dependency' => array(
						'element' => 'show_counter',
						'value' => 'lqd-module-show-badge'
					),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'       => 'subheading',
					'param_name' => 'extra_texts',
					'heading'    => esc_html__( 'Extra Texts', 'landinghub-core' ),
				),
				array(
					'type'       => 'textarea',
					'param_name' => 'icon_text',
					'heading'    => esc_html__( 'Cart Icon Text', 'landinghub-core' ),
					'description' => esc_html__( 'The text will be shown next to the icon. You can use [ld_get_cart_total] to show the total amount', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'        => 'checkbox',
					'param_name'  => 'use_custom_fonts_list',
					'heading'     => esc_html__( 'Custom Font?', 'landinghub-core' ),
					'description' => esc_html__( 'Check to use custom font for lists items', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-3',
					'dependency' => array(
						'element' => 'icon_text',
						'not_empty' => true
					)
				),
				array(
					'type'        => 'liquid_button_set',
					'param_name' => 'icon_text_align',
					'heading'    => esc_html__( 'Icon Text Alignment.', 'landinghub-core' ),
					'value'       => array(
						esc_html__( 'Left', 'landinghub-core' ) => 'lqd-module-trigger-txt-left',
						esc_html__( 'Right', 'landinghub-core' )  => 'lqd-module-trigger-txt-right',
					),
					'std' => 'lqd-module-trigger-txt-left',
					'dependency' => array(
						'element' => 'icon_text',
						'not_empty' => true
					),
					'edit_field_class' => 'vc_col-sm-3',
				),
				array(
					'type'       => 'textarea',
					'param_name' => 'cart_text',
					'heading'    => esc_html__( 'Cart Footer Text', 'landinghub-core' ),
					'description' => esc_html__( 'Content will be place in the footer of the dropdown.', 'landinghub-core' ),
					'dependency' => array(
						'element' => 'enable_offcanvas',
						'is_empty' => true,
					),
				),


				//Typo Options
				array(
					'type'        => 'textfield',
					'param_name'  => 'fs_txt',
					'heading'     => esc_html__( 'Font Size', 'landinghub-core' ),
					'description' => esc_html__( 'Example: 20px', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-3 vc_column-with-padding',
					'dependency' => array(
						'element' => 'use_custom_fonts_list',
						'value'   => 'true',
					),
					'group' => esc_html__( 'Icon Text', 'landinghub-core' ),
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'lh_txt',
					'heading'     => esc_html__( 'Line-Height', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-3',
					'dependency' => array(
						'element' => 'use_custom_fonts_list',
						'value'   => 'true',
					),
					'group' => esc_html__( 'Icon Text', 'landinghub-core' ),
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'fw_txt',
					'heading'     => esc_html__( 'Font Weight', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-3',
					'dependency' => array(
						'element' => 'use_custom_fonts_list',
						'value'   => 'true',
					),
					'group' => esc_html__( 'Icon Text', 'landinghub-core' ),
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'ls_txt',
					'heading'     => esc_html__( 'Letter Spacing', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-3',
					'dependency' => array(
						'element' => 'use_custom_fonts_list',
						'value'   => 'true',
					),
					'group' => esc_html__( 'Icon Text', 'landinghub-core' ),
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'transform_txt',
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
					'group' => esc_html__( 'Icon Text', 'landinghub-core' ),
				),

				array(
					'type'        => 'liquid_colorpicker',
					'only_solid'  => true,
					'param_name'  => 'primary_color',
					'heading'     => esc_html__( 'Primary Color', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-4',
					'group' => esc_html__( 'Design Options' ),
				),
				array(
					'type'        => 'liquid_colorpicker',
					'only_solid'  => true,
					'param_name'  => 'badge_color',
					'heading'     => esc_html__( 'Badge Text Color', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-4',
					'group' => esc_html__( 'Design Options' ),
					'dependency' => array(
						'element' => 'show_counter',
						'value' => 'lqd-module-show-badge'
					)
				),
				array(
					'type'        => 'liquid_colorpicker',
					'param_name'  => 'badge_bgcolor',
					'heading'     => esc_html__( 'Badge Fill/Outline Color', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-4',
					'group' => esc_html__( 'Design Options' ),
					'dependency' => array(
						'element' => 'show_counter',
						'value' => 'lqd-module-show-badge'
					)
				),
	
				array(
					'type'       => 'subheading',
					'param_name' => 'sticky_colors',
					'heading'    => esc_html__( 'Sticky Colors', 'landinghub-core' ),
					'group' => esc_html__( 'Design Options' ),
				),
				array(
					'type'        => 'liquid_colorpicker',
					'only_solid'  => true,
					'param_name'  => 'sticky_primary_color',
					'heading'     => esc_html__( 'Primary Color', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-4',
					'group' => esc_html__( 'Design Options' ),
				),
				array(
					'type'        => 'liquid_colorpicker',
					'only_solid'  => true,
					'param_name'  => 'sticky_badge_color',
					'heading'     => esc_html__( 'Badge Text Color', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-4',
					'group' => esc_html__( 'Design Options' ),
					'dependency' => array(
						'element' => 'show_counter',
						'value' => 'lqd-module-show-badge'
					)
				),
				array(
					'type'        => 'liquid_colorpicker',
					'param_name'  => 'sticky_badge_bgcolor',
					'heading'     => esc_html__( 'Badge Fill/Outline Color', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-4',
					'group' => esc_html__( 'Design Options' ),
					'dependency' => array(
						'element' => 'show_counter',
						'value' => 'lqd-module-show-badge'
					)
				),
				
				array(
					'type'       => 'subheading',
					'param_name' => 'sticky_light_colors',
					'heading'    => esc_html__( 'Colors Over Light Rows', 'landinghub-core' ),
					'group' => esc_html__( 'Design Options' ),
				),
				array(
					'type'        => 'liquid_colorpicker',
					'only_solid'  => true,
					'param_name'  => 'sticky_light_primary_color',
					'heading'     => esc_html__( 'Primary Color', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-4',
					'group' => esc_html__( 'Design Options' ),
				),
				array(
					'type'        => 'liquid_colorpicker',
					'only_solid'  => true,
					'param_name'  => 'sticky_light_badge_color',
					'heading'     => esc_html__( 'Badge Text Color', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-4',
					'group' => esc_html__( 'Design Options' ),
					'dependency' => array(
						'element' => 'show_counter',
						'value' => 'lqd-module-show-badge'
					)
				),
				array(
					'type'        => 'liquid_colorpicker',
					'param_name'  => 'sticky_light_badge_bgcolor',
					'heading'     => esc_html__( 'Badge Fill/Outline Color', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-4',
					'group' => esc_html__( 'Design Options' ),
					'dependency' => array(
						'element' => 'show_counter',
						'value' => 'lqd-module-show-badge'
					)
				),
	
				array(
					'type'       => 'subheading',
					'param_name' => 'sticky_dark_colors',
					'heading'    => esc_html__( 'Colors Over Dark Rows', 'landinghub-core' ),
					'group' => esc_html__( 'Design Options' ),
				),
				array(
					'type'        => 'liquid_colorpicker',
					'only_solid'  => true,
					'param_name'  => 'sticky_dark_primary_color',
					'heading'     => esc_html__( 'Primary Color', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-4',
					'group' => esc_html__( 'Design Options' ),
				),
				array(
					'type'        => 'liquid_colorpicker',
					'only_solid'  => true,
					'param_name'  => 'sticky_dark_badge_color',
					'heading'     => esc_html__( 'Badge Text Color', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-4',
					'group' => esc_html__( 'Design Options' ),
					'dependency' => array(
						'element' => 'show_counter',
						'value' => 'lqd-module-show-badge'
					)
				),
				array(
					'type'        => 'liquid_colorpicker',
					'param_name'  => 'sticky_dark_badge_bgcolor',
					'heading'     => esc_html__( 'Badge Fill/Outline Color', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-4',
					'group' => esc_html__( 'Design Options' ),
					'dependency' => array(
						'element' => 'show_counter',
						'value' => 'lqd-module-show-badge'
					)
				),

			),
			
			liquid_get_icon_params( false, '', array( 'fontawesome', 'linea' ), array( 'align', 'margin-inline-start', 'hcolor', 'margin-inline-end' ), 'i_' )

		);

		$this->add_extras();
	}

	public function generate_css() {

		extract($this->atts);

		$elements = array();
		$id = '.' . $this->get_id();

		if( !empty( $primary_color ) ) {
			$elements['.ld-module-cart .ld-module-trigger-icon, .ld-module-cart .ld-module-trigger']['color'] = $primary_color;	
		}
		if( !empty( $badge_color ) ) {
			$elements['.ld-module-cart .ld-module-trigger .ld-module-trigger-count']['color'] = $badge_color;	
		}
		if( !empty( $badge_bgcolor ) ) {
			if ( 'lqd-module-badge-fill' === $counter_style ) {
				$elements['.ld-module-cart .ld-module-trigger .ld-module-trigger-count']['background'] = $badge_bgcolor;	
			} else {
				$elements['.ld-module-cart .ld-module-trigger .ld-module-trigger-count']['border-color'] = $badge_bgcolor;	
			}
		}

		if( !empty( $sticky_primary_color ) ) {
			$elements['.is-stuck .ld-module-cart .ld-module-trigger-icon']['color'] = $sticky_primary_color;	
		}
		if( !empty( $sticky_badge_color ) ) {
			$elements['.is-stuck .ld-module-cart .ld-module-trigger .ld-module-trigger-count']['color'] = $sticky_badge_color;	
		}
		if( !empty( $sticky_badge_bgcolor ) ) {
			if ( 'lqd-module-badge-fill' === $counter_style ) {
				$elements['.is-stuck .ld-module-cart .ld-module-trigger .ld-module-trigger-count']['background'] = $sticky_badge_bgcolor;	
			} else {
				$elements['.is-stuck .ld-module-cart .ld-module-trigger .ld-module-trigger-count']['border-color'] = $sticky_badge_bgcolor;	
			}
		}

		if( !empty( $sticky_light_primary_color ) ) {
			$elements['.lqd-active-row-light.header-module .ld-module-cart .ld-module-trigger-icon']['color'] = $sticky_light_primary_color;	
		}
		if( !empty( $sticky_light_badge_color ) ) {
			$elements['.lqd-active-row-light.header-module .ld-module-cart .ld-module-trigger .ld-module-trigger-count']['color'] = $sticky_light_badge_color;	
		}
		if( !empty( $sticky_light_badge_bgcolor ) ) {
			if ( 'lqd-module-badge-fill' === $counter_style ) {
				$elements['.lqd-active-row-light.header-module .ld-module-cart .ld-module-trigger .ld-module-trigger-count']['background'] = $sticky_light_badge_bgcolor;	
			} else {
				$elements['.lqd-active-row-light.header-module .ld-module-cart .ld-module-trigger .ld-module-trigger-count']['border-color'] = $sticky_light_badge_bgcolor;	
			}
		}

		if( !empty( $sticky_dark_primary_color ) ) {
			$elements['.lqd-active-row-dark.header-module .ld-module-cart .ld-module-trigger-icon']['color'] = $sticky_dark_primary_color;	
		}
		if( !empty( $sticky_dark_badge_color ) ) {
			$elements['.lqd-active-row-dark.header-module .ld-module-cart .ld-module-trigger .ld-module-trigger-count']['color'] = $sticky_dark_badge_color;	
		}
		if( !empty( $sticky_dark_badge_bgcolor ) ) {
			if ( 'lqd-module-badge-fill' === $counter_style ) {
				$elements['.lqd-active-row-dark.header-module .ld-module-cart .ld-module-trigger .ld-module-trigger-count']['background'] = $sticky_dark_badge_bgcolor;	
			} else {
				$elements['.lqd-active-row-dark.header-module .ld-module-cart .ld-module-trigger .ld-module-trigger-count']['border-color'] = $sticky_dark_badge_bgcolor;	
			}
		}
		
		if( !empty( $i_color ) ) {
			$elements['.ld-module-cart .ld-module-trigger-icon']['color'] = $i_color;
		}
		if( !empty( $i_size ) ) {
			$elements['.ld-module-cart .ld-module-trigger-icon']['font-size'] = $i_size;
		}

		$elements[ liquid_implode( '.ld-module-cart .ld-module-trigger-txt, .ld-module-cart .ld-module-trigger .ld-module-trigger-count' ) ]['font-size'] = !empty( $fs_txt ) ? $fs_txt : '';
		$elements[ liquid_implode( '.ld-module-cart .ld-module-trigger-txt' ) ]['line-height'] = !empty( $lh_txt ) ? $lh_txt : '';
		$elements[ liquid_implode( '.ld-module-cart .ld-module-trigger-txt, .ld-module-cart .ld-module-trigger .ld-module-trigger-count' ) ]['font-weight'] = !empty( $fw_txt ) ? $fw_txt : '';
		$elements[ liquid_implode( '.ld-module-cart .ld-module-trigger-txt' ) ]['letter-spacing'] = !empty( $ls_txt ) ? $ls_txt : '';
		$elements[ liquid_implode( '.ld-module-cart .ld-module-trigger-txt' ) ]['text-transform'] = !empty( $transform_txt ) ? $transform_txt : '';
		
		$this->dynamic_css_parser( $id, $elements );

	}

}
new LD_Header_Cart;