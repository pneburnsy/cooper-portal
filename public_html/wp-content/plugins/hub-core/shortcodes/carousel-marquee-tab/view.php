<?php

extract( $atts );

// Enqueue Conditional Script
$this->scripts();

$classes = array( 
	'carousel-container',
	'lqd-marquee-carousel',
	$fadesides,
	$shadow,
	$el_class, 
	$this->get_randomveroffset(),
	$this->get_id() 
);

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">

	<div class="carousel-items row" <?php $this->get_options() ?>>
	<?php
		$this->get_content();
	?>
	</div>

</div>