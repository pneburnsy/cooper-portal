<?php

extract( $atts );

$this->scripts();

$classes = array(
	'lqd-imggrp-single',
	$this->get_color_adjust_reset(),
	$this->get_overflow_height(),
	$hide_el,
	$el_class, 
	$this->get_id() 
);

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>" <?php echo $this->get_data_options(); ?> <?php echo $this->get_data_float_effect() ?> >
	
	<div class="lqd-imggrp-img-container" <?php echo $this->get_data_stacking_factor() ?> <?php echo $this->get_reveal_data(); ?>  <?php echo $this->get_parallax_options() ?>>
		
		<?php if( !empty( $content) ) { ?>
			<div class="lqd-imggrp-content <?php echo $content_align;  ?>">
				<div class="lqd-imggrp-content-inner">
					<?php echo ld_helper()->do_the_content( $content, false ); ?>
				</div><!-- /.lqd-imggrp-content-inner -->
			</div><!-- /.lqd-imggrp-content -->
		<?php } ?>		
		<?php $this->get_label() ?>
		<?php $this->get_image(); ?>
		<?php $this->get_lines(); ?>
		<?php $this->get_overlay_link(); ?>
		<?php $this->get_lightbox_link(); ?>
		
	</div><!-- /.lqd-imggrp-content -->
</div><!-- /.lqd-imggrp-single -->