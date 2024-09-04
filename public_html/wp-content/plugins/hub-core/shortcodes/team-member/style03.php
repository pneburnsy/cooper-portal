<?php

extract( $atts );

// classes
$classes = array(
	'lqd-tm',
	'lqd-tm-style-3',
	'pos-rel',
	'text-center',
	'round',
	'overflow-hidden',
	$el_class, 
	$this->get_id()
);

$this->generate_css();
$gradient_id = uniqid( 'gradient-' )

?>

<div class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">

	<div class="lqd-tm-img pos-rel">

		<?php $this->get_image( true ); ?>

		<div class="lqd-tm-socials lqd-overlay d-flex align-items-center justify-content-center">
			<?php $this->get_social(); ?>
		</div>

	</div>

	<div
		class="lqd-tm-details p-4 pos-rel"
		data-custom-animations="true"
		data-ca-options='{ "triggerHandler": "inview", "animationTarget": "h3,h6", "duration": 1200, "delay": 120,  "startDelay": 500, "direction": "backward", "initValues": { "y": -30, "opacity": 0 }, "animations": { "y": 0, "opacity": 1 } }'
	>

		<div class="lqd-tm-bg lqd-overlay" data-reveal="true" data-reveal-options='{ "direction": "tb", "bgcolor": "rgba(0,0,0,0.1)", "duration": 400 }'></div>

		<?php $this->get_name( 'mt-0 mb-2 pos-rel' ); ?>
		<?php $this->get_position( 'my-0 pos-rel' ); ?>

	</div>

	<?php $this->get_overlay_link(); ?>

</div>