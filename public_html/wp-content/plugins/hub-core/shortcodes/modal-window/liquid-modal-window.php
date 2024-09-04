<?php
/**
* Modal Window Button
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Modal_Window extends LD_Shortcode {
	
	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_modal_window';
		$this->title       = esc_html__( 'Modal Box', 'landinghub-core' );
		$this->icon        = 'la la-window-maximize';
		$this->scripts      = array( 'lity' );
		$this->description = esc_html__( 'Create a modal Box', 'landinghub-core' );
		$this->is_container = true;

		parent::__construct();
	}
	
	public function get_params() {

		$this->params = array(
			array(
				'type'        => 'dropdown',
				'param_name'  => 'modal_type',
				'heading'     => esc_html__( 'Modal Type', 'landinghub-core' ),
				'description' => esc_html__( 'Select a type for the modal.', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Default', 'landinghub-core' ) => 'default',
					esc_html__( 'Fullscreen', 'landinghub-core' )   => 'fullscreen',
					esc_html__( 'Box', 'landinghub-core' ) => 'box',
				),
			),
			array( 
				'id' => 'title',
			),
		);
		$this->add_extras();
	}

	protected function get_title() {
		
		if( empty( $this->atts['title'] ) ) {
			return;
		}
		echo esc_html( $this->atts['title'] );		
	}

	protected function get_modal_type() {
		
		if( empty( $this->atts['modal_type'] ) ) {
			return;
		}
		echo esc_html( $this->atts['modal_type'] );		
	}

}
new LD_Modal_Window;
class WPBakeryShortCode_LD_Modal_Window extends WPBakeryShortCodesContainer {}