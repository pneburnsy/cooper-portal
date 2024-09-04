<?php
/**
* Shortcode Woo Product Price
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Woo_Product_Price extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug = 'ld_woo_product_price';
		$this->title = esc_html__( 'Product Price', 'landinghub-core' );
		$this->icon = 'icon-wpb-woocommerce';
		$this->description = esc_html__( 'Display Woo product price', 'landinghub-core' );
		// $this->category    = esc_html__( 'Product Layout', 'landinghub-core' );
		$this->show_settings_on_create = false;
		
		
		parent::__construct();
	}

	public function get_params() {}
	
	
	
}
new LD_Woo_Product_Price;