<?php
/**
* Shortcode Porftfolio Single Title
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Pf_Single_Related extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug = 'ld_single_portfolio_related';
		$this->title = esc_html__( 'Portfolio Single Related', 'landinghub-core' );
		$this->icon = 'la la-folder';
		$this->description = esc_html__( 'Display Portfolio Single Post Related', 'landinghub-core' );
		// $this->category    = esc_html__( 'Portfolio Components', 'landinghub-core' );
		
		parent::__construct();
	}

	public function get_params() {
		$this->params = array(
			array(
				'type'        => 'descriptions',
				'param_name'  => 'desc',
				'heading'     => esc_html__( 'Portfolio single related element settings are controlled via Theme Options > Portfolio > Portfolio Single globally, or via portfolio single meta options individually', 'landinghub-core' ),
			),
		);	
	}
	
	
	
}
new LD_Pf_Single_Related;