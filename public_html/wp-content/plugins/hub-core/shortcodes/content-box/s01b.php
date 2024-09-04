<?php

extract( $atts );

$classes = array( 
	'lqd-fb',
	$this->get_class( $template ), 
	$box_height_b,
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
			<div class="lqd-fb-content-inner d-flex flex-column justify-content-end pos-rel h-100 w-100 w-md-75 p-4 p-md-8">
				
				<?php if( !empty( $label ) ) { ?>
				<div
				class="lqd-fb-content-top"
				data-custom-animations="true"
				data-ca-options='{ "triggerHandler": "inview", "animationTarget": "all-childs", "duration": 1200, "delay": 120,  "startDelay": 250, "initValues": { "y": 30, "opacity": 0 }, "animations": { "y": 0, "opacity": 1 } }'>
					<h6 class="my-0 text-uppercase ltr-sp-25"><?php $this->get_label(); ?></h6>
				</div>
				<?php } ?>
				
				<div
				class="lqd-fb-content-bottom mt-auto"
				data-custom-animations="true"
				data-ca-options='{ "triggerHandler": "inview", "animationTarget": "all-childs", "duration": 1200, "delay": 120,  "startDelay": 300, "initValues": { "y": 30, "opacity": 0 }, "animations": { "y": 0, "opacity": 1 } }'>
					
					<?php if( !empty( $title ) ) { ?>
					<<?php echo $tag; ?>
					class="lqd-fb-content-title my-0 mb-3"
					data-split-text="true" data-split-options='{ "type": "lines" }'><?php $this->get_title(); ?>
					</<?php echo $tag; ?>>
					<?php } ?>
					
					
					<?php if( !empty( $content ) ) { ?>
					<p
					class="my-0 mb-5"
					data-split-text="true" data-split-options='{ "type": "lines" }'><?php $this->get_content(); ?></p>
					<?php } ?>

					<?php $this->get_button() ?>

				</div>
				
			</div>
		</div>

	</div>
</div>
