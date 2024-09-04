<?php
	
// check
if( !liquid_helper()->is_woocommerce_active() ) {
	return;
}
global $product;
$product = wc_get_product();
if ( empty( $product ) ) { return; }
?>
<div class="product product-layout-component lqd-product-upsell">
<?php 
	woocommerce_upsell_display(); 
?>
</div>