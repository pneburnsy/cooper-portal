<?php

extract( $atts );

// Enqueue Conditional Script
$this->scripts();

$classes = array( 
	'carousel-container',
	$shadow,
	$fadesides,
	$navfloated,
	$navhalign,
	$mobile_navhalign,
	$navvalign,
	$navdirection,
	$dots_vertical_align,
	$navline,
	$navsize,
	$navfill,
	$navshape,
	$navshadow,
	
	$align_dots,
	$mobile_align_dots,
	$size_dots,
	$dots_style,
	$dots_orientation,
	$dots_position,
	$mobile_dots_position,
	
	$custom_cursor,

	$this->get_randomveroffset(),

	$this->get_fade_effect(),

	$el_class, 
	$this->get_id() 
);

$itemsClasses = array(
	'carousel-items',
	$this->get_custom_cursor()
);

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">

	<div class="<?php echo ld_helper()->sanitize_html_classes( $itemsClasses ); ?>" <?php $this->get_options() ?> <?php echo $this->get_ca_options(); ?>>
	<?php
		$this->get_content();
	?>
	</div>

</div>