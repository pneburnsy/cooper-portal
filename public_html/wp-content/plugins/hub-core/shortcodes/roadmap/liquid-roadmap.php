<?php
/**
* Shortcode Roadmap
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly
	
/**
* LD_Shortcode
*/
class LD_Roadmap extends LD_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug            = 'ld_roadmap';
		$this->title           = esc_html__( 'Roadmap', 'landinghub-core' );
		$this->description     = esc_html__( 'Add roadmap container', 'landinghub-core' );
		$this->icon            = 'la la-list-ol';
		$this->content_element = true;
		$this->is_container    = true;
		$this->as_parent       = array( 'only' => 'ld_roadmap_item' );

		$this->default_content = '
		[ld_roadmap_item title="' . sprintf( '%s %d', 'Roadmap Item ', 1 ) . '"][/ld_roadmap_item]
		[ld_roadmap_item title="' . sprintf( '%s %d', 'Roadmap Item ', 2 ) . '"][/ld_roadmap_item]';

		parent::__construct();
	}

	public function get_params() {
		
		$this->params = array(
			
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Enable Animation?', 'landinghub-core' ),
				'param_name'  => 'enable_animation',
				'description' => esc_html__( 'If checked the will enable the animation', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'primary_color',
				'heading'     => esc_html__( 'Primary Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color as primary', 'landinghub-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'color',
				'heading'     => esc_html__( 'Text Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for text', 'landinghub-core' ),
			),

		);

		$this->add_extras();
	}
	
	protected function get_animation() {
		
		if( 'yes' === $this->atts['enable_animation'] ) {
			echo 'data-custom-animations="true" data-ca-options=\'{"triggerHandler": "inview", "animationTarget": ".one-roadmap-item", "duration": 1200, "delay": 150, "ease": "power4.out", "initValues": { "y": 50, "z": -150, "rotationX": -95, "opacity": 0 }, "animations": { "y": 0, "z": 0, "rotationX": 0, "opacity": 1 }}\'';
		}
		
	}

	protected function generate_css() {

		$elements = array();
		extract( $this->atts );
		$id = '.' .$this->get_id();

		if( !empty( $color ) && isset( $color ) )  {
			$elements[liquid_implode( '%1$s .one-roadmap-item' )]['color'] = $color;
		}
		if( !empty( $primary_color ) && isset( $primary_color ) )  {
			$elements[liquid_implode( '%1$s .one-roadmap-bar:before, %1$s .one-roadmap-bar:after' )]['background'] = $primary_color;
		}

		$this->dynamic_css_parser( $id, $elements );
	}


}
new LD_Roadmap;
class WPBakeryShortCode_LD_Roadmap extends WPBakeryShortCodesContainer {}