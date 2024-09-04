<?php
/**
* Shortcode Woo Product Hooks
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Woo_Product_Hooks extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug = 'ld_woo_product_hooks';
		$this->title = esc_html__( 'Product Hooks', 'landinghub-core' );
		$this->icon = 'icon-wpb-woocommerce';
		$this->description = esc_html__( 'add woo product hooks', 'landinghub-core' );
		// $this->category    = esc_html__( 'Product Layout', 'landinghub-core' );
		
		
		parent::__construct();
	}

	public function get_params() {
		
		$this->params = array( 
			array(
				'type'       => 'dropdown',
				'param_name' => 'woo_action',
				'heading'    => esc_html__( 'Actions', 'landinghub-core' ),
				'value'       => array(
					'woocommerce_before_single_product_summary'       => 'woocommerce_before_single_product_summary',
					'woocommerce_single_product_summary'              => 'woocommerce_single_product_summary',
					'woocommerce_after_single_product_summary'        => 'woocommerce_after_single_product_summary',
				),
				'admin_label' => true,
			)
		);
		
	}
	
	
	
}
new LD_Woo_Product_Hooks;