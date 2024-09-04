<?php
/**
* Shortcode Social Icons
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Social_Icons extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_social_icons';
		$this->title       = esc_html__( 'Social Icons', 'landinghub-core' );
		$this->description = esc_html__( 'Social Icons', 'landinghub-core' );
		$this->icon        = 'la la-facebook';
		$this->styles      = array( 'vc_font_awesome_5' );
		$this->show_settings_on_create = true;

		parent::__construct();
	}

	public function get_params() {

		$url = liquid_addons()->plugin_uri() . '/assets/img/sc-preview/social-icons/';

		$this->params = array(

			array(
				'type'       => 'select_preview',
				'param_name' => 'style',
				'heading'    => esc_html__( 'Style', 'landinghub-core' ),
				'value'      => array(

					array(
						'value' => '',
						'label' => esc_html__( 'Default', 'landinghub-core' ),
						'image' => $url . 'default.svg'
					),

					array(
						'label' => esc_html__( 'Brand Colors', 'landinghub-core' ),
						'value' => 'branded-text',
						'image' => $url . 'brand-color.svg'
					),

					array(
						'label' => esc_html__( 'Brand Fills', 'landinghub-core' ),
						'value' => 'branded',
						'image' => $url . 'brand-fill.svg'
					),
				),
				'save_always' => true,
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'size',
				'heading'    => esc_html__( 'Size', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Small ( 30px )', 'landinghub-core' )  => 'social-icon-sm',
					esc_html__( 'Medium ( 48px )', 'landinghub-core' ) => 'social-icon-md',
					esc_html__( 'Large ( 55px )', 'landinghub-core' )  => 'social-icon-lg'
				),
				'edit_field_class' => 'vc_col-md-4'
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'shape',
				'heading'    => esc_html__( 'Shape', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'None', 'landinghub-core' )       => '',
					esc_html__( 'Square', 'landinghub-core' )     => 'square',
					esc_html__( 'Round', 'landinghub-core' )      => 'round',
					esc_html__( 'Circle', 'landinghub-core' )     => 'circle',
				),
				'edit_field_class' => 'vc_col-md-4'
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'border',
				'heading'    => esc_html__( 'Border Size', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'None', 'landinghub-core' ) => 'social-icon-border-none',
					esc_html__( '1px', 'landinghub-core' )  => 'social-icon-border-1',
					esc_html__( '2px', 'landinghub-core' )  => 'social-icon-border-2',
					esc_html__( '3px', 'landinghub-core' )  => 'social-icon-border-3'
				),
				'dependency'  => array(
					'element' => 'style',
					'value_not_equal_to' => array( 'branded', 'branded-text' ),
				),
				'edit_field_class' => 'vc_col-md-4'
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'orientation',
				'heading'    => esc_html__( 'Direction', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Horizontal', 'landinghub-core' ) => '',
					esc_html__( 'Vertical', 'landinghub-core' )   => 'social-icon-vertical'
				),
				'edit_field_class' => 'vc_col-md-4'
			),

			array(
				'type'       => 'param_group',
				'param_name' => 'identities',
				'heading'    => esc_html__( 'Identities', 'landinghub-core' ),
				'params'     => array(

					array(
						'id' => 'network',
						'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
					),

					array(
						'type'        => 'textfield',
						'param_name'  => 'url',
						'heading'     => esc_html__( 'URL (Link)', 'landinghub-core' ),
						'description' => esc_html__(  'Add social link', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					)
				)
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'font_size',
				'heading'     => esc_html__( 'Size', 'landinghub-core' ),
				'description' => esc_html__( 'Add size in pixels e.g 15px', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'custom_size',
				'heading'     => esc_html__( 'Custom Shape Size', 'landinghub-core' ),
				'description' => esc_html__( 'Add size in pixels e.g 15px', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'shape',
					'value'   => array( 'square', 'round', 'circle' )
				),
			),

			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'primary_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Primary Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'hover_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Hover Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'bg_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Background Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'shape',
					'value' => array( 'square', 'round', 'circle' )
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'hbg_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Hover Background Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'shape',
					'value'   => array( 'square', 'round', 'circle' )
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'       => 'liquid_colorpicker',
				'param_name' => 'border_color',
				'only_solid'  => true,
				'heading'    => esc_html__( 'Border Color', 'landinghub-core' ),
				'group'      => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'shape',
					'value' => array( 'square', 'round', 'circle' )
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'       => 'liquid_colorpicker',
				'param_name' => 'hborder_color',
				'only_solid'  => true,
				'heading'    => esc_html__( 'Hover Border Color', 'landinghub-core' ),
				'group'      => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'shape',
					'value' => array( 'square', 'round', 'circle' )
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

		);

		$this->add_extras();
	}

	protected function get_shape() {
		
		$shape = $this->atts['shape'];
		$classnames = [];

		if ( $shape !== '' ) {
			array_push($classnames, 'social-icon-shaped');
		}

		if ( $shape === 'round' ) {
			array_push($classnames, 'social-icon-round');
		} else if ( $shape === 'circle' ) {
			array_push($classnames, 'social-icon-circle');
		}

		return implode(' ', $classnames);
	}

	public function generate_css() {

		extract( $this->atts );

		$elements = array();

		$id = '.' . $this->get_id();
		$out = '';

		$elements['%1$s'] = array (
			'font-size' => $font_size
		);
		$elements['%1$s a'] = array (
			'width' => $custom_size . ' !important',
			'height' => $custom_size . ' !important'
		);

		$elements['%1$s li a']['color'] = isset( $primary_color ) ? $primary_color.'!important' : '';
		$elements['%1$s li a']['border-color'] = isset( $border_color ) ? $border_color.'!important' : '';
		$elements['%1$s li a:hover']['border-color'] = isset( $hborder_color ) ? $hborder_color.'!important' : '';
		$elements['%1$s li a:hover']['color'] = isset( $hover_color ) ? $hover_color.'!important' : '';
		$elements['%1$s li a']['background-color'] = isset( $bg_color ) ? $bg_color.'!important' : '';
		$elements['%1$s li a:hover']['background-color'] = isset( $hbg_color ) ? $hbg_color.'!important' : '';

		$this->dynamic_css_parser( $id, $elements );
	}
}
new LD_Social_Icons;