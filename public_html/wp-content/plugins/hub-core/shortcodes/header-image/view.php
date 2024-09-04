<?php

extract( $atts );

$this->generate_css();

$classes = array(
	'header-module', 
	'module-logo',
	'no-rotate',
	$alignment,
	$visiblemobile,
	$sticky_show_onsticky,
	$this->get_shape(),
	$shape_logo_style,
	$el_class,
	$this->get_id()

);

?>

<div id="<?php echo $this->get_id(); ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>">

	<?php $this->get_logo(); ?>
	<?php $this->get_mobile_trigger(); ?>
	
</div><!-- /.navbar-header -->