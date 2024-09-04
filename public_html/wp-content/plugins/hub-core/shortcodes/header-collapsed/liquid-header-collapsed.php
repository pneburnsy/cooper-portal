<?php
/**
* Shortcode Collapsed Container
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly
	
/**
* LD_Shortcode
*/
class LD_Header_Collapsed extends LD_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug            = 'ld_header_collapsed';
		$this->title           = esc_html__( 'Navigation Container', 'landinghub-core' );
		$this->description     = esc_html__( 'Use this container before to add navigation menu', 'landinghub-core' );
		$this->icon            = 'la la-file-image-o';
		$this->content_element = true;
		$this->is_container    = true;
		$this->category    = esc_html__( 'Header Modules', 'landinghub-core' );
		$this->show_settings_on_create = true;

		parent::__construct();
	}

	public function get_params() {

		$this->params = array();
		$this->add_extras();	
	}

}
new LD_Header_Collapsed;
class WPBakeryShortCode_LD_Header_Collapsed extends WPBakeryShortCodesContainer {}