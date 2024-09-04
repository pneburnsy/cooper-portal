<?php

extract( $atts );

$el_classes = array( 
	$this->get_class( $style ), 
	$el_class, 
	$this->get_nav_expand(),
	$this->get_reverse_direction(),
	$this->get_id() 
);
$this->inline_css();
$this->generate_css();

?>
<div class="<?php echo ld_helper()->sanitize_html_classes( $el_classes ); ?>" <?php echo $this->get_tabs_opts(); ?>>

	<nav class="<?php echo ld_helper()->sanitize_html_classes( $this->get_nav_wrap_classnames() ); ?>">
		<?php $this->get_nav(); ?>
		<?php $this->get_button(); ?> 
	</nav>

	<?php $this->get_content() ?>

</div>
