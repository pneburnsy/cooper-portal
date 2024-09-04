
<?php

extract( $atts );

$classes = array( 
	'lqd-typewriter',
	$el_class, 
	$_id,
);

// Enqueue Conditional Script
$this->scripts();

$this->generate_css();

?>

<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">
	<<?php echo $tag ?> data-typewriter="true">
		<?php echo ld_helper()->do_the_content( $this->atts['content'], false ); ?>
	</<?php echo $tag ?>>
</div>