<?php

extract( $atts );

$classes = array(
	'collapse', 
	'navbar-collapse',
	$el_class,
	$this->get_id()
);

$classes = apply_filters( 'liquid_header_collapsed_classes', $classes );
	
?>
<?php echo ld_helper()->do_the_content( $content ); ?>	
