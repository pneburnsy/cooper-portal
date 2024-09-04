<?php

extract( $atts );

$classes = array( 
	'lqd-fb',
	$this->get_class( $template ), 
	$box_height_a,
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
			<div class="lqd-fb-bg lqd-overlay"></div>
			<div class="lqd-fb-hover-overlay lqd-overlay"></div>
			<div class="lqd-fb-content-inner d-flex flex-wrap align-items-center pos-rel px-2 py-5 w-100">
				<?php if( 'yes' === $show_button ) { ?>
				<div
				class="w-20 px-2 text-center"
				data-custom-animations="true"
				data-ca-options='{ "triggerHandler": "inview", "animationTarget": "all-childs", "duration": 1000, "delay": 120,  "startDelay": 250, "initValues": { "scale": 1.2, "opacity": 0 }, "animations": { "scale": 1, "opacity": 1 } }'>
				<?php $this->get_button() ?>
				</div>
				<?php } ?>
				
				<?php if( !empty( $title ) ) { ?>
				<div
				class="w-80 px-2"
				data-custom-animations="true"
				data-ca-options='{ "triggerHandler": "inview", "animationTarget": "all-childs", "duration": 1000, "delay": 120,  "startDelay": 250, "initValues": { "y": 20, "opacity": 0 }, "animations": { "y": 0, "opacity": 1 } }'>
					<<?php echo $tag; ?>
					class="lqd-fb-content-title my-0"
					data-split-text="true" data-split-options='{ "type": "lines" }'><?php $this->get_title(); ?>
					</<?php echo $tag; ?>>
				</div>
				<?php } ?>
			</div>
		</div>

	</div>
</div>
