<?php
	
// check
if( !liquid_helper()->is_woocommerce_active() ) {
	return;
}
global $product;
$product = wc_get_product();
if ( empty( $product ) ) { return; }
?>
<div class="product product-layout-component lqd-product-related">
<?php
	woocommerce_output_related_products(); 
?>
</div>