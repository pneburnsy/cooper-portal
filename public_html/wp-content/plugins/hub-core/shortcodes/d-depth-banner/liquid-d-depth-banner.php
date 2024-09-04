<?php
/**
* Shortcode Liquid Carousel
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_D_Depth_Banner extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug         = 'ld_d_depth_banner';
		$this->title        = esc_html__( '3D Banner Depth', 'landinghub-core' );
		$this->icon         = 'la la-arrows';
		$this->scripts      = array( 'fake3d' );
		$this->description  = esc_html__( 'Create a 3D banner with depth effect.', 'landinghub-core' );
		$this->show_settings_on_create = true;

		parent::__construct();
	}

	public function get_params() {
		
		$this->params = array(
			
			array(
				'type'       => 'liquid_attach_image',
				'param_name' => 'image',
				'heading'    => esc_html__( 'Original Image', 'landinghub-core' ),
				'descripton' => esc_html__( 'Add image from gallery or upload new', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),
			array(
				'type'       => 'liquid_attach_image',
				'param_name' => 'second_image',
				'heading'    => esc_html__( 'Depth Image', 'landinghub-core' ),
				'descripton' => esc_html__( 'Add image from gallery or upload new', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'vth',
				'heading'     => esc_html__( 'Vertical Threshold', 'landinghub-core' ),
				'description' => esc_html__( 'Add vertical threshold for ex. 15', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'hth',
				'heading'     => esc_html__( 'Horizontal Threshold', 'landinghub-core' ),
				'description' => esc_html__( 'Add horizontal threshold for ex. 35', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'height',
				'heading'     => esc_html__( 'Height', 'landinghub-core' ),
				'description' => esc_html__( 'Add height in px. for ex. 650px', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'target',
				'heading'     => esc_html__( 'Target Selector', 'landinghub-core' ),
				'description' => esc_html__( 'Add target selector classname or ID, for ex. .ld-container', 'landinghub-core' ),
			),

		);
		
		$this->add_extras();
	
	}
	
	protected function get_opts() {
		
		$opts = array();
		
		$imageOriginal = $imageDepth = '';
		if( preg_match( '/^\d+$/', $this->atts['image'] ) ){
			$imageOriginal  = wp_get_attachment_image_url( $this->atts['image'], 'full', false );
		} else {
			$imageOriginal = esc_url( $this->atts['image'] );
		}

		if( preg_match( '/^\d+$/', $this->atts['second_image'] ) ){
			$imageDepth  = wp_get_attachment_image_url( $this->atts['second_image'], 'full', false );
		} else {
			$imageDepth = esc_url( $this->atts['second_image'] );
		}
		
		if( !empty( $imageOriginal ) ) {
			$opts['imageOriginal'] = $imageOriginal;
		}
		if( !empty( $imageDepth ) ) {
			$opts['imageDepth'] = $imageDepth;
		}
		if( !empty( $this->atts['hth'] ) ) {
			$opts['hth'] = (int) $this->atts['hth'];
		}
		if( !empty( $this->atts['vth'] ) ) {
			$opts['vth'] = (int) $this->atts['vth'];
		}		

		echo 'data-fake3d-options=\'' . wp_json_encode( $opts ) . '\'';

	}
	
	protected function get_target_opts() {
		
		if( empty( $this->atts['target'] ) ) {
			return;
		}
		
		echo 'data-move-element=\'{ "target": "' . $this->atts['target'] . '", "type": "insertBefore" }\'';
		
	}
	
	protected function get_target_classname() {
		
		if( empty( $this->atts['target'] ) ) {
			return;
		}
		
		return 'as-bg';
		
	}

	protected function generate_css() {

		extract( $this->atts );
		$elements = array();
		$bg_img = '';

		$id = '.' . $this->get_id();
		
		if( !empty( $height ) && isset( $height ) ) {
			$elements[ liquid_implode( '%1$s > div' ) ]['height'] = $height . ' !important';
		}

		if( preg_match( '/^\d+$/', $this->atts['image'] ) ){
			$bg_img  = wp_get_attachment_image_url( $this->atts['image'], 'full', false );
		} else {
			$bg_img = esc_url( $this->atts['image'] );
		}

		if ( !empty( $bg_img ) ) {
			$elements[ liquid_implode( '.vc_mobile %1$s > div' ) ]['background-image'] = 'url(' . esc_url($bg_img) . ')';
		}

		$this->dynamic_css_parser( $id, $elements );
	}

}
new LD_D_Depth_Banner;