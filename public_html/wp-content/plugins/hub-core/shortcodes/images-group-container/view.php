<?php

extract( $atts );

$classes = array(
	'lqd-imggrp-container',
	$el_class, 
	$hide_el,
	$this->get_id() 
);

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>" <?php echo $this->get_animations() ?> <?php echo $this->get_move_element() ?> <?php echo $this->get_parallax_options() ?>>
	<div class="lqd-imggrp-inner">
		<?php echo ld_helper()->do_the_content( $content ); ?>	
	</div><!-- /.lqd-imggrp-inner -->
</div><!-- /.lqd-imggrp-container -->