<?php

extract( $atts );

$id = ( $el_id ) ? ' id="' . esc_attr( $el_id ) . '"' : '';

$wrapper_classes = array( 
	'lqd-simple-heading-wrap',
	$el_class, 
	$_id,
);

$heading_classes = array(
	'lqd-simple-heading',
);

if( !empty( $fh_border_radius ) ) {
	$heading_classes[] = $fh_border_radius;
}
if( !empty( $gradient ) ) {
	$heading_classes[] = 'ld-gradient-heading';
}

$this->generate_css();

?>
<div <?php echo $id; ?> class="<?php echo ld_helper()->sanitize_html_classes( $wrapper_classes ); ?>">
<<?php echo $tag ?> class="<?php echo ld_helper()->sanitize_html_classes( $heading_classes ); ?>">
	<?php $this->get_heading(); ?>
</<?php echo $tag ?>>
</div>