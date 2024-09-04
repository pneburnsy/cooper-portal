<?php
/**
* Shortcode Header Container
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly
	
/**
* LD_Shortcode
*/
class LD_Header_Mainbar extends LD_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug            = 'ld_header_mainbar';
		$this->title           = esc_html__( 'Header Mainbar', 'landinghub-core' );
		$this->description     = esc_html__( 'Header Mainbar container', 'landinghub-core' );
		$this->icon            = 'la la-file-image-o';
		$this->category        = esc_html__( 'Header Containers', 'landinghub-core' );
		$this->default_content = '[vc_row el_id="MainBar"][vc_column width="1/3"][/vc_column][vc_column width="1/3"][/vc_column][vc_column width="1/3"][/vc_column][/vc_row]';

		parent::__construct();
	}

	public function get_params() {

		$this->add_extras();
	}


}
new LD_Header_Mainbar;