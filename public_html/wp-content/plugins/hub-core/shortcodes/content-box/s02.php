<?php

extract( $atts );

$classes = array( 
	'lqd-fb',
	$this->get_class( $template ), 

	$el_class, 
	$this->get_id() 
);

// Enqueue Conditional Script
$this->scripts();

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>" data-inview="true">
	<div class="lqd-fb-inner lqd-overlay">

		<div class="lqd-fb-img lqd-overlay overflow-hidden">
		<?php $this->get_image( true, true ); ?>
		<?php $this->get_overlay_link() ?>
		</div>

		<div class="lqd-fb-content lqd-overlay align-items-end">
			<div class="lqd-fb-content-inner d-flex flex-wrap align-items-center pos-rel px-3 px-md-7 py-4 py-md-6 w-100">
				<div class="lqd-overlay" data-reveal="true" data-reveal-options='{ "direction": "bt", "bgcolor": "#000", "delay": 150, "duration": 500 }'>
					<div class="lqd-fb-bg lqd-overlay"></div>
					<div class="lqd-fb-hover-overlay lqd-overlay"></div>
				</div>

				<?php if( !empty( $title ) ) { ?>
				<div
				class="w-65 pos-rel"
				data-custom-animations="true"
				data-ca-options='{ "triggerHandler": "inview", "animationTarget": "all-childs", "duration": 1200, "delay": 120,  "startDelay": 800, "initValues": { "y": 30, "opacity": 0 }, "animations": { "y": 0, "opacity": 1 } }'>
					<<?php echo $tag; ?>
					class="lqd-fb-content-title my-0"
					data-split-text="true" data-split-options='{ "type": "lines" }'><?php $this->get_title(); ?>
					</<?php echo $tag; ?>>
				</div>
				<?php } ?>
				
				<div
				class="w-35 pos-rel text-md-right"
				data-custom-animations="true"
				data-ca-options='{ "triggerHandler": "inview", "animationTarget": "all-childs", "duration": 1200, "delay": 120,  "startDelay": 950, "initValues": { "y": 30, "opacity": 0 }, "animations": { "y": 0, "opacity": 1 } }'>
				<?php $this->get_button() ?>
				</div>
			</div>
		</div>

	</div>
</div>
