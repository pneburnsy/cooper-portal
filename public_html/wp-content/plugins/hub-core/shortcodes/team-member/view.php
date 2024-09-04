<?php

extract( $atts );

// classes
$classes = array(
	'lqd-tm',
	'lqd-tm-style-1',
	'pos-rel',
	$el_class, 
	$this->get_id()
);

$this->generate_css();

?>
<div class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>" data-inview="true">

	<?php $this->get_image(); ?>
	<div
		class="lqd-tm-details px-7 py-4"
		data-custom-animations="true"
		data-ca-options='{ "triggerHandler": "inview", "animationTarget": "h3,h6,.social-icon", "duration": 1200, "delay": 120,  "startDelay": 350, "direction": "backward", "initValues": { "y": -30, "opacity": 0 }, "animations": { "y": 0, "opacity": 1 } }'
	>
		<div class="lqd-tm-bg lqd-overlay" data-reveal="true" data-reveal-options='{ "direction": "tb", "bgcolor": "#fff", "duration": 700, "coverArea": 100 }'></div>
		<?php $this->get_name( 'mt-0 mb-2 pos-rel' ); ?>
		<?php $this->get_position( 'my-0 font-weight-normal pos-rel' ); ?>
		<?php $this->get_social(); ?>
	</div>

	<?php $this->get_overlay_link(); ?>

</div>