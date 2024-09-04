<?php
	
// check
if( !liquid_helper()->is_woocommerce_active() ) {
	return;
}

global $product;
$product = wc_get_product();
if ( empty( $product ) ) { return; }

extract( $atts );

do_action( $woo_action );