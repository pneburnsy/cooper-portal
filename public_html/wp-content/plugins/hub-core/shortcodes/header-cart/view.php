<?php
	
	extract( $atts );

	$this->generate_css();

	$classes = array(
		'header-module',
		$atts['show_on_mobile'],
		$atts['offcanvas_placement'],
		$atts['enable_offcanvas'] === 'yes' ? 'pos-stc' : ''
	);
	
?>
<div class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>">
<?php

if( $enable_offcanvas ) {
	$located = locate_template( 'templates/header/header-cart-offcanvas.php' );
}
else {
	$located = locate_template( 'templates/header/header-cart.php' );
}
include $located;

?>
</div>