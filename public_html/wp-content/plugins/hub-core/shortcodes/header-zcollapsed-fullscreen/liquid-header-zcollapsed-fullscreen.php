<?php
/**
* Shortcode Collapsed Container
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly
	
/**
* LD_Shortcode
*/
class LD_Header_Collapsed_Fullscreen extends LD_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug            = 'ld_header_collapsed_fullscreen';
		$this->title           = esc_html__( 'Navigation Container Fullscreen', 'landinghub-core' );
		$this->icon            = 'la la-file-image-o';
		$this->content_element = true;
		$this->is_container    = true;
		$this->category    = esc_html__( 'Header Modules', 'landinghub-core' );

		parent::__construct();
	}

	public function get_params() {
		
		//$menu = vc_map_integrate_shortcode( 'ld_header_menu', 'hm_', '' );

		$design = array(
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'bg_color',
				'heading'     => esc_html__( 'Navigation Background Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a background color for the navigation container', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'line_color',
				'heading'     => esc_html__( 'Vertical Lines Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the lines', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options' ),
			),
		);
		
		
		$this->params = array_merge( $menu, $design );
		$this->params = $design;

		$this->add_extras();	

	}

	protected function get_menu() {

/*
		$data = vc_map_integrate_parse_atts( $this->slug, 'ld_header_menu', $this->atts, 'hm_' );
		$data['el_class'] = ' ' . $this->get_id();
		$data['template'] = 'fullscreen';
		
		if ( $data ) {

			$nav = visual_composer()->getShortCode( 'ld_header_menu' )->shortcodeClass();

			if ( is_object( $nav ) ) {
				echo $nav->render( array_filter( $data ) );
			}
		}
*/
	}
	
	protected function generate_css() {
		
		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();

		if( !empty( $bg_color ) ) {
			$elements[ liquid_implode( '.header-fullscreen-style-1 .lqd-fsh-bg-side-container span, .header-fullscreen-style-1 .lqd-fsh-bg-col span' ) ]['background'] = esc_attr( $bg_color );
		}
		if( !empty( $line_color ) ) {
			$elements[ liquid_implode( '.header-fullscreen-style-1 .lqd-fsh-bg-side-container:before, .header-fullscreen-style-1 .lqd-fsh-bg-col:before' ) ]['background-color'] = esc_attr( $line_color );
		}

		$this->dynamic_css_parser( $id, $elements );
	}


}
new LD_Header_Collapsed_Fullscreen;
class WPBakeryShortCode_LD_Header_Collapsed_Fullscreen extends WPBakeryShortCodesContainer {}