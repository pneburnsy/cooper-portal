<?php

extract( $atts );

// classes
$classes = array( 

	'lqd-counter ',
	$this->get_class( $template ),
	$content_align,
	
	$el_class, 
	$this->get_id() 
);

$this->generate_css();

if( !$use_inheritance ) {
	$tag_to_inherite = '';
}

?>
<div id="<?php echo $this->get_id(); ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>">

	<div class="lqd-counter-element <?php echo $tag_to_inherite; ?>" data-enable-counter="true" <?php echo $this->get_data_options(); ?>>
		<?php $this->get_count(); ?>
	</div><!-- /.lqd-counter-element -->
	<?php $this->get_label(); ?>

</div><!-- /.lqd-counter lqd-counter-huge -->