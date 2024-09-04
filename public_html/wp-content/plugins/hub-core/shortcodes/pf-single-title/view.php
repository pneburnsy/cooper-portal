<?php

extract( $atts );

$classes = array(
	'lqd-pf-single-title',
	'my-0', 
	$this->get_id() 
);

$this->generate_css();

?>
<?php the_title( '<h1 class="' . ld_helper()->sanitize_html_classes( $classes ) . '">', '</h1>' ); ?>