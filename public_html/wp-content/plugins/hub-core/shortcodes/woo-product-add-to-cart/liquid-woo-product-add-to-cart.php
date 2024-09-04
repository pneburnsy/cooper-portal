<?php
/**
* Shortcode Woo Product Add to cart
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Woo_Product_Add_To_Cart extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug = 'ld_woo_product_add_to_cart';
		$this->title = esc_html__( 'Product Add to Cart', 'landinghub-core' );
		$this->icon = 'icon-wpb-woocommerce';
		$this->description = esc_html__( 'Display Woo product add to cart', 'landinghub-core' );
		// $this->category    = esc_html__( 'Product Layout', 'landinghub-core' );
		$this->show_settings_on_create = false;
		
		
		parent::__construct();
	}

	public function get_params() {}
	
	
	
}
new LD_Woo_Product_Add_To_Cart;