<?php
/**
* Header Button Shortcode
*/

if( !defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/

class LD_Header_Button extends LD_Shortcode {
	
	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_header_button';
		$this->title       = esc_html__( 'Button', 'landinghub-core' );
		$this->icon        = 'la la-square';
		$this->description = esc_html__( 'Create a custom button.', 'landinghub-core' );
		$this->category    = esc_html__( 'Header Modules', 'landinghub-core' );
		$this->show_settings_on_create = true;

		parent::__construct();
	}
	
	public function get_params() {
		
		$this->params = array_merge( 

			vc_map_integrate_shortcode( 'ld_button', 'ib_', '' ), 
			array(
				array(
					'type'       => 'subheading',
					'param_name' => 'sticky_colors',
					'heading'    => esc_html__( 'Sticky Colors', 'landinghub-core' ),
					'group'      => esc_html__( 'Sticky Design Options', 'landinghub-core' ),
				),
				array(
					'type'             => 'liquid_colorpicker',
					'param_name'       => 'sticky_color',
					'only_solid'       => true,
					'heading'          => esc_html__( 'Primary Color', 'landinghub-core' ),
					'description'      => esc_html__( 'Background color', 'landinghub-core' ),
					'group'            => esc_html__( 'Sticky Design Options', 'landinghub-core' ),
					'edit_field_class' => 'vc_column-with-padding  vc_col-sm-6',
				),
				array(
					'type'        => 'liquid_colorpicker',
					'param_name'  => 'sticky_hover_color',
					'only_solid'  => true,
					'heading'     => esc_html__( 'Primary Hover Color', 'landinghub-core' ),
					'description' => esc_html__( 'Hover state background color', 'landinghub-core' ),
					'group'       => esc_html__( 'Sticky Design Options', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'       => 'liquid_colorpicker',
					'param_name' => 'sticky_text_color',
					'only_solid' => true,
					'heading'    => esc_html__( 'Label Color', 'landinghub-core' ),
					'group'      => esc_html__( 'Sticky Design Options', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'       => 'liquid_colorpicker',
					'param_name' => 'sticky_htext_color',
					'only_solid' => true,
					'heading'    => esc_html__( 'Label Hover Color', 'landinghub-core' ),
					'group'      => esc_html__( 'Sticky Design Options', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'       => 'liquid_colorpicker',
					'param_name' => 'sticky_border_color',
					'only_solid' => true,
					'heading'    => esc_html__( 'Border Color', 'landinghub-core' ),
					'group'      => esc_html__( 'Sticky Design Options', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'       => 'liquid_colorpicker',
					'param_name' => 'sticky_hborder_color',
					'only_solid' => true,
					'heading'    => esc_html__( 'Border Hover Color', 'landinghub-core' ),
					'group'      => esc_html__( 'Sticky Design Options', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'        => 'liquid_colorpicker',
					'only_solid'  => true,
					'param_name'  => 'sticky_i_color',
					'heading'     => esc_html__( 'Icon color', 'landinghub-core' ),
					'description' => esc_html__( 'Select icon color.', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6',
					'group' => esc_html__( 'Sticky Design Options', 'landinghub-core' ),
				),
				array(
					'type'        => 'liquid_colorpicker',
					'only_solid'  => true,
					'param_name'  => 'sticky_i_hcolor',
					'heading'     => esc_html__( 'Icon hover color', 'landinghub-core' ),
					'description' => esc_html__( 'Pick icon hover color.', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6',
					'group' => esc_html__( 'Sticky Design Options', 'landinghub-core' ),
				),
				array(
					'type'        => 'liquid_colorpicker',
					'param_name'  => 'sticky_i_fill_color',
					'heading'     => esc_html__( 'Icon Fill color', 'landinghub-core' ),
					'description' => esc_html__( 'Pick icon fill color.', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6',
					'group' => esc_html__( 'Sticky Design Options', 'landinghub-core' ),
				),
				array(
					'type'        => 'liquid_colorpicker',
					'param_name'  => 'sticky_i_fill_hcolor',
					'heading'     => esc_html__( 'Icon Hover Fill color', 'landinghub-core' ),
					'description' => esc_html__( 'Pick icon hover fill color.', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6',
					'group' => esc_html__( 'Sticky Design Options', 'landinghub-core' ),
				),

				array(
					'type'       => 'subheading',
					'param_name' => 'sticky_light_separator',
					'heading'    => esc_html__( 'Colors Over Light Rows', 'landinghub-core' ),
					'group' => esc_html__( 'Sticky Design Options' ),
				),
				array(
					'type'             => 'liquid_colorpicker',
					'param_name'       => 'sticky_light_color',
					'only_solid'       => true,
					'heading'          => esc_html__( 'Primary Color', 'landinghub-core' ),
					'description'      => esc_html__( 'Background color', 'landinghub-core' ),
					'group'            => esc_html__( 'Sticky Design Options', 'landinghub-core' ),
					'edit_field_class' => 'vc_column-with-padding  vc_col-sm-6',
				),
				array(
					'type'        => 'liquid_colorpicker',
					'param_name'  => 'sticky_light_hover_color',
					'only_solid'  => true,
					'heading'     => esc_html__( 'Primary Hover Color', 'landinghub-core' ),
					'description' => esc_html__( 'Hover state background color', 'landinghub-core' ),
					'group'       => esc_html__( 'Sticky Design Options', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'       => 'liquid_colorpicker',
					'param_name' => 'sticky_light_text_color',
					'only_solid' => true,
					'heading'    => esc_html__( 'Label Color', 'landinghub-core' ),
					'group'      => esc_html__( 'Sticky Design Options', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'       => 'liquid_colorpicker',
					'param_name' => 'sticky_light_htext_color',
					'only_solid' => true,
					'heading'    => esc_html__( 'Label Hover Color', 'landinghub-core' ),
					'group'      => esc_html__( 'Sticky Design Options', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'       => 'liquid_colorpicker',
					'param_name' => 'sticky_light_border_color',
					'only_solid' => true,
					'heading'    => esc_html__( 'Border Color', 'landinghub-core' ),
					'group'      => esc_html__( 'Sticky Design Options', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'       => 'liquid_colorpicker',
					'param_name' => 'sticky_light_hborder_color',
					'only_solid' => true,
					'heading'    => esc_html__( 'Border Hover Color', 'landinghub-core' ),
					'group'      => esc_html__( 'Sticky Design Options', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'        => 'liquid_colorpicker',
					'only_solid'  => true,
					'param_name'  => 'sticky_light_i_color',
					'heading'     => esc_html__( 'Icon color', 'landinghub-core' ),
					'description' => esc_html__( 'Select icon color.', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6',
					'group' => esc_html__( 'Sticky Design Options', 'landinghub-core' ),
				),
				array(
					'type'        => 'liquid_colorpicker',
					'only_solid'  => true,
					'param_name'  => 'sticky_light_i_hcolor',
					'heading'     => esc_html__( 'Icon hover color', 'landinghub-core' ),
					'description' => esc_html__( 'Pick icon hover color.', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6',
					'group' => esc_html__( 'Sticky Design Options', 'landinghub-core' ),
				),
				array(
					'type'        => 'liquid_colorpicker',
					'param_name'  => 'sticky_light_i_fill_color',
					'heading'     => esc_html__( 'Icon Fill color', 'landinghub-core' ),
					'description' => esc_html__( 'Pick icon fill color.', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6',
					'group' => esc_html__( 'Sticky Design Options', 'landinghub-core' ),
				),
				array(
					'type'        => 'liquid_colorpicker',
					'param_name'  => 'sticky_light_i_fill_hcolor',
					'heading'     => esc_html__( 'Icon Hover Fill color', 'landinghub-core' ),
					'description' => esc_html__( 'Pick icon hover fill color.', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6',
					'group' => esc_html__( 'Sticky Design Options', 'landinghub-core' ),
				),
	
				array(
					'type'       => 'subheading',
					'param_name' => 'sticky_dark_separator',
					'heading'    => esc_html__( 'Colors Over Dark Rows', 'landinghub-core' ),
					'group' => esc_html__( 'Sticky Design Options' ),
				),
				array(
					'type'             => 'liquid_colorpicker',
					'param_name'       => 'sticky_dark_color',
					'only_solid'       => true,
					'heading'          => esc_html__( 'Primary Color', 'landinghub-core' ),
					'description'      => esc_html__( 'Background color', 'landinghub-core' ),
					'group'            => esc_html__( 'Sticky Design Options', 'landinghub-core' ),
					'edit_field_class' => 'vc_column-with-padding  vc_col-sm-6',
				),
				array(
					'type'        => 'liquid_colorpicker',
					'param_name'  => 'sticky_dark_hover_color',
					'only_solid'  => true,
					'heading'     => esc_html__( 'Primary Hover Color', 'landinghub-core' ),
					'description' => esc_html__( 'Hover state background color', 'landinghub-core' ),
					'group'       => esc_html__( 'Sticky Design Options', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'       => 'liquid_colorpicker',
					'param_name' => 'sticky_dark_text_color',
					'only_solid' => true,
					'heading'    => esc_html__( 'Label Color', 'landinghub-core' ),
					'group'      => esc_html__( 'Sticky Design Options', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'       => 'liquid_colorpicker',
					'param_name' => 'sticky_dark_htext_color',
					'only_solid' => true,
					'heading'    => esc_html__( 'Label Hover Color', 'landinghub-core' ),
					'group'      => esc_html__( 'Sticky Design Options', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'       => 'liquid_colorpicker',
					'param_name' => 'sticky_dark_border_color',
					'only_solid' => true,
					'heading'    => esc_html__( 'Border Color', 'landinghub-core' ),
					'group'      => esc_html__( 'Sticky Design Options', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'       => 'liquid_colorpicker',
					'param_name' => 'sticky_dark_hborder_color',
					'only_solid' => true,
					'heading'    => esc_html__( 'Border Hover Color', 'landinghub-core' ),
					'group'      => esc_html__( 'Sticky Design Options', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'        => 'liquid_colorpicker',
					'only_solid'  => true,
					'param_name'  => 'sticky_dark_i_color',
					'heading'     => esc_html__( 'Icon color', 'landinghub-core' ),
					'description' => esc_html__( 'Select icon color.', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6',
					'group' => esc_html__( 'Sticky Design Options', 'landinghub-core' ),
				),
				array(
					'type'        => 'liquid_colorpicker',
					'only_solid'  => true,
					'param_name'  => 'sticky_dark_i_hcolor',
					'heading'     => esc_html__( 'Icon hover color', 'landinghub-core' ),
					'description' => esc_html__( 'Pick icon hover color.', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6',
					'group' => esc_html__( 'Sticky Design Options', 'landinghub-core' ),
				),
				array(
					'type'        => 'liquid_colorpicker',
					'param_name'  => 'sticky_dark_i_fill_color',
					'heading'     => esc_html__( 'Icon Fill color', 'landinghub-core' ),
					'description' => esc_html__( 'Pick icon fill color.', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6',
					'group' => esc_html__( 'Sticky Design Options', 'landinghub-core' ),
				),
				array(
					'type'        => 'liquid_colorpicker',
					'param_name'  => 'sticky_dark_i_fill_hcolor',
					'heading'     => esc_html__( 'Icon Hover Fill color', 'landinghub-core' ),
					'description' => esc_html__( 'Pick icon hover fill color.', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6',
					'group' => esc_html__( 'Sticky Design Options', 'landinghub-core' ),
				),
					
			) 
		);

	}

	protected function get_button() {

		$data = vc_map_integrate_parse_atts( $this->slug, 'ld_button', $this->atts, 'ib_' );
		$data['el_class'] .= ' ' . $this->get_id();
		
		if ( $data ) {

			$btn = visual_composer()->getShortCode( 'ld_button' )->shortcodeClass();

			if ( is_object( $btn ) ) {
				echo $btn->render( array_filter( $data ) );
			}
		}
	}
	
	public function generate_css() {
		
		extract( $this->atts );
		
		$elements     = array();
		$id           = '.' .$this->get_id();
		
		// Sticky Colors
		if( ! empty( $sticky_color ) && isset( $sticky_color ) ) {
			$elements[liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s' )]['color'] = $sticky_color;
			$elements[liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s' )]['border-color'] = $sticky_color;
			$elements[liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s.btn-solid' )]['background-color'] = $sticky_color;
		}
		if( ! empty( $sticky_hover_color ) && isset( $sticky_hover_color ) ) {
			$elements[liquid_implode( array( '.is-stuck .lqd-head-col > .header-module > %1$s:hover' ) )]['border-color'] = $sticky_hover_color;
			$elements[liquid_implode( array( '.is-stuck .lqd-head-col > .header-module > %1$s:hover, .is-stuck .lqd-head-col > .header-module > %1$s.btn-solid:hover' ) )]['background-color'] = $sticky_hover_color;
		}

		if ( !empty( $sticky_text_color ) && isset( $sticky_text_color ) ) {
			$elements[liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s' )]['color'] = $sticky_text_color;
		}
		if ( !empty( $sticky_htext_color ) && isset( $sticky_htext_color ) ) {
			$elements[liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s:hover' )]['color'] = $sticky_htext_color;
		}

		if ( !empty( $sticky_border_color ) && isset( $sticky_border_color ) ) {
			$elements[liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s' )]['border-color'] = $sticky_border_color;
		}
		if ( !empty( $sticky_hborder_color ) && isset( $sticky_hborder_color ) ) {
			$elements[liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s:hover' )]['border-color'] = $sticky_hborder_color;
		}
		if( !empty( $sticky_i_color ) ) {
			$elements[liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s .btn-icon' )]['color'] = $sticky_i_color;
		}
		if( !empty( $sticky_i_hcolor ) ) {
			$elements[liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s:hover .btn-icon' )]['color'] = $sticky_i_hcolor;
		}
		if( !empty( $sticky_i_fill_color ) ) {
			$elements[liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s .btn-icon' )]['background'] = $sticky_i_fill_color;
		}
		if( !empty( $sticky_i_fill_hcolor ) ) {
			$elements[liquid_implode( '.is-stuck .lqd-head-col > .header-module > %1$s:hover .btn-icon' )]['background'] = $sticky_i_fill_hcolor;
		}

		// Over Light Colors
		if( ! empty( $sticky_light_color ) && isset( $sticky_light_color ) ) {
			$elements[liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s' )]['color'] = $sticky_light_color;
			$elements[liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s' )]['border-color'] = $sticky_light_color;
			$elements[liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s.btn-solid' )]['background-color'] = $sticky_light_color;
		}
		if( ! empty( $sticky_light_hover_color ) && isset( $sticky_light_hover_color ) ) {
			$elements[liquid_implode( array( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s:hover' ) )]['border-color'] = $sticky_light_hover_color;
			$elements[liquid_implode( array( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s:hover, .lqd-head-col > .lqd-active-row-light.header-module > %1$s.btn-solid:hover' ) )]['background-color'] = $sticky_light_hover_color;
		}

		if ( !empty( $sticky_light_text_color ) && isset( $sticky_light_text_color ) ) {
			$elements[liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s' )]['color'] = $sticky_light_text_color;
		}
		if ( !empty( $sticky_light_htext_color ) && isset( $sticky_light_htext_color ) ) {
			$elements[liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s:hover' )]['color'] = $sticky_light_htext_color;
		}

		if ( !empty( $sticky_light_border_color ) && isset( $sticky_light_border_color ) ) {
			$elements[liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s' )]['border-color'] = $sticky_light_border_color;
		}
		if ( !empty( $sticky_light_hborder_color ) && isset( $sticky_light_hborder_color ) ) {
			$elements[liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s:hover' )]['border-color'] = $sticky_light_hborder_color;
		}
		if( !empty( $sticky_light_i_color ) ) {
			$elements[liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s .btn-icon' )]['color'] = $sticky_light_i_color;
		}
		if( !empty( $sticky_light_i_hcolor ) ) {
			$elements[liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s:hover .btn-icon' )]['color'] = $sticky_light_i_hcolor;
		}
		if( !empty( $sticky_light_i_fill_color ) ) {
			$elements[liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s .btn-icon' )]['background'] = $sticky_light_i_fill_color;
		}
		if( !empty( $sticky_light_i_fill_hcolor ) ) {
			$elements[liquid_implode( '.lqd-head-col > .lqd-active-row-light.header-module > %1$s:hover .btn-icon' )]['background'] = $sticky_light_i_fill_hcolor;
		}

		// Over Ddark Colors
		if( ! empty( $sticky_dark_color ) && isset( $sticky_dark_color ) ) {
			$elements[liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s' )]['color'] = $sticky_dark_color;
			$elements[liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s' )]['border-color'] = $sticky_dark_color;
			$elements[liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s.btn-solid' )]['background-color'] = $sticky_dark_color;
		}
		if( ! empty( $sticky_dark_hover_color ) && isset( $sticky_dark_hover_color ) ) {
			$elements[liquid_implode( array( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s:hover' ) )]['border-color'] = $sticky_dark_hover_color;
			$elements[liquid_implode( array( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s:hover, .lqd-head-col > .lqd-active-row-dark.header-module > %1$s.btn-solid:hover' ) )]['background-color'] = $sticky_dark_hover_color;
		}

		if ( !empty( $sticky_dark_text_color ) && isset( $sticky_dark_text_color ) ) {
			$elements[liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s' )]['color'] = $sticky_dark_text_color;
		}
		if ( !empty( $sticky_dark_htext_color ) && isset( $sticky_dark_htext_color ) ) {
			$elements[liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s:hover' )]['color'] = $sticky_dark_htext_color;
		}

		if ( !empty( $sticky_dark_border_color ) && isset( $sticky_dark_border_color ) ) {
			$elements[liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s' )]['border-color'] = $sticky_dark_border_color;
		}
		if ( !empty( $sticky_dark_hborder_color ) && isset( $sticky_dark_hborder_color ) ) {
			$elements[liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s:hover' )]['border-color'] = $sticky_dark_hborder_color;
		}
		if( !empty( $sticky_dark_i_color ) ) {
			$elements[liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s .btn-icon' )]['color'] = $sticky_dark_i_color;
		}
		if( !empty( $sticky_dark_i_hcolor ) ) {
			$elements[liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s:hover .btn-icon' )]['color'] = $sticky_dark_i_hcolor;
		}
		if( !empty( $sticky_dark_i_fill_color ) ) {
			$elements[liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s .btn-icon' )]['background'] = $sticky_dark_i_fill_color;
		}
		if( !empty( $sticky_dark_i_fill_hcolor ) ) {
			$elements[liquid_implode( '.lqd-head-col > .lqd-active-row-dark.header-module > %1$s:hover .btn-icon' )]['background'] = $sticky_dark_i_fill_hcolor;
		}
	
		$this->dynamic_css_parser( $id, $elements );	
		
	}

	
}
new LD_Header_Button;