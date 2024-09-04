<?php
/**
* Shortcode Timeline
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly
	
/**
* LD_Shortcode
*/
class LD_Timeline extends LD_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug            = 'ld_timeline';
		$this->title           = esc_html__( 'Timeline', 'landinghub-core' );
		$this->description     = esc_html__( 'Add timeline container', 'landinghub-core' );
		$this->icon            = 'la la-clock-o';
		$this->content_element = true;
		$this->is_container    = true;
		$this->as_parent       = array( 'only' => 'ld_timeline_item' );

		parent::__construct();
	}

	public function get_params() {
		
		$this->params = array(
			
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'primary_color',
				'heading'     => esc_html__( 'Primary Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color as primary', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
			),

		);

		$this->add_extras();
	}

	protected function generate_css() {

		$elements = array();
		extract( $this->atts );
		$id = '.' .$this->get_id();
		
		if( !empty( $primary_color ) && isset( $primary_color ) )  {
			$elements[liquid_implode( '%1$s .ld-timeline-bar' )]['background'] = $primary_color;
		}

		$this->dynamic_css_parser( $id, $elements );
	}


}
new LD_Timeline;
class WPBakeryShortCode_LD_Timeline extends WPBakeryShortCodesContainer {}