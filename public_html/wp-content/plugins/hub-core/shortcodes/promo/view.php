<?php

extract( $atts );

$classes = array( 
	'lqd-promo-wrap',
	$content_alignment,

	$el_class, 
	$this->get_id() 
);

$this->generate_css();

$bg_color = !empty( $overlay_color ) ? $overlay_color : '#FE055E';

?>

<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>">
	<div class="lqd-promo-inner">

		<?php $this->get_dynamic_shape(); ?>			
		<?php $this->get_label(); ?>

		<div class="lqd-promo-img">
			<div class="lqd-promo-img-inner" data-reveal="true" data-reveal-options='{ "direction": "rl", "bgcolor": "<?php echo esc_attr( $overlay_color ); ?>", "revealSettings": { "onCoverAnimations": [ {"scale": 2}, {"scale": 1} ] } }'>
				<?php $this->get_image(); ?>
				<?php $this->get_link() ?>
			</div><!-- /.lqd-promo-img-inner -->
		</div><!-- /.lqd-promo-img -->

		<div class="lqd-promo-content"
			data-custom-animations="true"
			data-ca-options='{ "triggerHandler": "inview", "animationTarget": ".btn", "duration": 800, "startDelay": 1300, "initValues": { "y": 70, "opacity": 0 }, "animations": { "y": 0, "opacity": 1 } }'
		>
			<?php $this->get_title(); ?>
			<?php $this->get_content(); ?>
			<?php $this->get_button() ?>

		</div><!-- /.lqd-promo-content -->

	</div><!-- /.lqd-promo-inner -->
</div><!-- /.lqd-promo-wrap -->