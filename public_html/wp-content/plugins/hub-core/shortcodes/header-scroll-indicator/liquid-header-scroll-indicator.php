<?php
/**
* Shortcode Scroll Indicator
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Header_Scroll_Indicator extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_header_scroll_indicator';
		$this->title       = esc_html__( 'Scroll Indicator', 'landinghub-core' );
		$this->description = esc_html__( 'Add scroll indicator header module', 'landinghub-core' );
		$this->icon        = 'la la-star';
		$this->category    = esc_html__( 'Header Modules', 'landinghub-core' );

		parent::__construct();
	}

	public function get_params() {

		$this->params = array(

			array(
				'type'       => 'subheading',
				'param_name' => 'sh_separator',
				'heading'    => esc_html__( 'Colors', 'landinghub-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'primary_color',
				'heading'     => esc_html__( 'Primary Color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4 vc_column-with-padding',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'bar_color',
				'heading'     => esc_html__( 'Bar Color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'indicator_color',
				'heading'     => esc_html__( 'Indicator Color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'sh_separator',
				'heading'    => esc_html__( 'Sticky Colors', 'landinghub-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'sticky_primary_color',
				'heading'     => esc_html__( 'Primary Color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4 vc_column-with-padding',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'sticky_bar_color',
				'heading'     => esc_html__( 'Bar Color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'sticky_indicator_color',
				'heading'     => esc_html__( 'Indicator Color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'sticky_light_sh_separator',
				'heading'    => esc_html__( 'Colors Over Light Rows', 'landinghub-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'sticky_light_primary_color',
				'heading'     => esc_html__( 'Primary Color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4 vc_column-with-padding',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'sticky_light_bar_color',
				'heading'     => esc_html__( 'Bar Color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'sticky_light_indicator_color',
				'heading'     => esc_html__( 'Indicator Color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'sticky_dark_sh_separator',
				'heading'    => esc_html__( 'Colors Over Dark Rows', 'landinghub-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'sticky_dark_primary_color',
				'heading'     => esc_html__( 'Primary Color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4 vc_column-with-padding',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'sticky_dark_bar_color',
				'heading'     => esc_html__( 'Bar Color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'sticky_dark_indicator_color',
				'heading'     => esc_html__( 'Indicator Color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4',
			),

		);

		$this->add_extras();
	}

	public function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' .$this->get_id();
		
		if( !empty( $primary_color ) ) {
			$elements['%1$s a']['color'] = $primary_color;
			if ( empty($bar_color) ) {
				$elements['%1$s .lqd-scrl-indc-line']['background-color'] = $primary_color;
			}
		}
		if( !empty( $bar_color ) ) {
			$elements['%1$s .lqd-scrl-indc-line']['background-color'] = $bar_color;
		}
		if( !empty( $indicator_color ) ) {
			$elements['%1$s .lqd-scrl-indc-el']['background-color'] = $indicator_color;
		}
		
		if( !empty( $sticky_primary_color ) ) {
			$elements['.is-stuck .lqd-head-col > .header-module %1$s a']['color'] = $sticky_primary_color;
			if ( empty($sticky_bar_color) ) {
				$elements['.is-stuck .lqd-head-col > .header-module %1$s .lqd-scrl-indc-line']['background-color'] = $sticky_primary_color;
			}
		}
		if( !empty( $sticky_bar_color ) ) {
			$elements['.is-stuck .lqd-head-col > .header-module %1$s .lqd-scrl-indc-line']['background-color'] = $sticky_bar_color;
		}
		if( !empty( $sticky_indicator_color ) ) {
			$elements['.is-stuck .lqd-head-col > .header-module %1$s .lqd-scrl-indc-el']['background-color'] = $sticky_indicator_color;
		}
		
		if( !empty( $sticky_light_primary_color ) ) {
			$elements['.lqd-head-col > .lqd-active-row-light.header-module %1$s a']['color'] = $sticky_light_primary_color;
			if ( empty($sticky_light_bar_color) ) {
				$elements['.lqd-head-col > .lqd-active-row-light.header-module %1$s .lqd-scrl-indc-line']['background-color'] = $sticky_light_primary_color;
			}
		}
		if( !empty( $sticky_light_bar_color ) ) {
			$elements['.lqd-head-col > .lqd-active-row-light.header-module %1$s .lqd-scrl-indc-line']['background-color'] = $sticky_light_bar_color;
		}
		if( !empty( $sticky_light_indicator_color ) ) {
			$elements['.lqd-head-col > .lqd-active-row-light.header-module %1$s .lqd-scrl-indc-el']['background-color'] = $sticky_light_indicator_color;
		}
		
		if( !empty( $sticky_dark_primary_color ) ) {
			$elements['.lqd-head-col > .lqd-active-row-dark.header-module %1$s a']['color'] = $sticky_dark_primary_color;
			if ( empty($sticky_dark_bar_color) ) {
				$elements['.lqd-head-col > .lqd-active-row-dark.header-module %1$s .lqd-scrl-indc-line']['background-color'] = $sticky_dark_primary_color;
			}
		}
		if( !empty( $sticky_dark_bar_color ) ) {
			$elements['.lqd-head-col > .lqd-active-row-dark.header-module %1$s .lqd-scrl-indc-line']['background-color'] = $sticky_dark_bar_color;
		}
		if( !empty( $sticky_dark_indicator_color ) ) {
			$elements['.lqd-head-col > .lqd-active-row-dark.header-module %1$s .lqd-scrl-indc-el']['background-color'] = $sticky_dark_indicator_color;
		}


		$this->dynamic_css_parser( $id, $elements );
	}
}
new LD_Header_Scroll_Indicator;