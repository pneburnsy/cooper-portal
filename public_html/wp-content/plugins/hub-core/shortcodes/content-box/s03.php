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
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>">
	<div class="lqd-fb-inner" data-reveal="true" data-reveal-options='{ "direction": "bt", "bgcolor": "#000", "duration": 500 }'>

		<div class="lqd-fb-img overflow-hidden">
			<?php $this->get_image( true, true ); ?>
			<?php $this->get_overlay_link() ?>
		</div>

		<div class="lqd-fb-content pos-rel">
			<div class="lqd-fb-bg lqd-overlay"></div>
			<div class="lqd-fb-hover-overlay lqd-overlay"></div>
			<div
			class="lqd-fb-content-inner d-flex flex-column pos-rel px-6 py-4"
			data-custom-animations="true"
			data-ca-options='{ "triggerHandler": "inview", "animationTarget": "all-childs", "duration": 1200, "delay": 120,  "startDelay": 500, "initValues": { "y": 30, "opacity": 0 }, "animations": { "y": 0, "opacity": 1 } }'>
				<?php if( !empty( $title ) ) { ?>
				<<?php echo $tag; ?>
				class="lqd-fb-content-title my-0 mb-2"
				data-split-text="true" data-split-options='{ "type": "lines" }'><?php $this->get_title(); ?>
				</<?php echo $tag; ?>>
				<?php } ?>
				
				<?php if( !empty( $label ) ) { ?>
				<h6
				class="my-0"
				data-split-text="true" data-split-options='{ "type": "lines" }'><?php $this->get_label(); ?></h6>
				<?php } ?>
			</div>
		</div>

	</div>
</div>
