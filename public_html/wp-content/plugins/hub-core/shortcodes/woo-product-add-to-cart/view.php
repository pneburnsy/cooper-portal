<?php
	
// check
if( !liquid_helper()->is_woocommerce_active() ) {
	return;
}
global $product;
$product = wc_get_product();
if ( empty( $product ) ) { return; }
?>
<div class="lqd-woo-single-layout-2">
	<div class="product product-layout-component lqd-product-add-to-cart">
		<?php 
			woocommerce_template_single_add_to_cart(); 
		?>
	</div>
</div>