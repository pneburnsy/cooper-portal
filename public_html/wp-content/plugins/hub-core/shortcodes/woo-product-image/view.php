<?php
	
// check
if( !liquid_helper()->is_woocommerce_active() ) {
	return;
}
global $product;
$product = wc_get_product();
if ( empty( $product ) ) { return; }
?>
<div class="product product-layout-component lqd-product-image">
<?php
	woocommerce_show_product_images(); 
?>
</div>