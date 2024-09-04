<?php

extract( $atts );

// Enqueue Conditional Script
$this->scripts();

$classes = array( 
	'lqd-bnr-3d-depth',	
	$this->get_target_classname(),
	$el_class, 
	$this->get_id() 
);

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>" <?php $this->get_target_opts(); ?>>
	<div
	class="bg-cover"
	data-lqd-fake3d="true"
	<?php $this->get_opts(); ?>>
	</div>
</div><!-- /.lqd-bnr-3d-depth -->