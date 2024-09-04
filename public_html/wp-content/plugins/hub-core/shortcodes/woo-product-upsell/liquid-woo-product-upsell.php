<?php
/**
* Shortcode Woo Product Upsell
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Woo_Product_Upsell extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug = 'ld_woo_product_upsell';
		$this->title = esc_html__( 'Product Upsell', 'landinghub-core' );
		$this->icon = 'icon-wpb-woocommerce';
		$this->description = esc_html__( 'Display Woo product upsell', 'landinghub-core' );
		// $this->category    = esc_html__( 'Product Layout', 'landinghub-core' );
		$this->show_settings_on_create = false;
		
		
		parent::__construct();
	}

	public function get_params() {}
	
	
	
}
new LD_Woo_Product_Upsell;