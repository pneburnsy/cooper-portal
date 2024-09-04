<?php

extract( $atts );

$classes = array( 
	'lqd-fb',
	$this->get_class( $template ), 
	$content_alignment,
	$el_class, 
	$this->get_id() 
);

// Enqueue Conditional Script
$this->scripts();
$this->generate_css();
$link = liquid_get_link_attributes( $this->atts['img_link'], false );

?>

<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>">
	<div class="lqd-fb-inner">

		<div
		class="lqd-fb-img round"
		data-custom-animations="true"
		data-ca-options='{ "triggerHandler": "inview", "animationTarget": "figure", "duration": 1200, "initValues": { "scale": 1.075, "opacity": 0 }, "animations": { "scale": 1, "opacity": 1 } }'>
			<figure data-responsive-bg="true">
				<?php $this->get_image( false, true ); ?>
				<?php $this->get_overlay_link() ?>
			</figure>
		</div>

		<div class="lqd-fb-content z-index-2 round <?php echo $ct_width; ?>">
			<div class="lqd-fb-content-inner d-flex flex-wrap align-items-center pos-rel round px-5 py-4">
				<div class="lqd-overlay" data-reveal="true" data-reveal-options='{ "direction": "bt", "delay": 150, "duration": 500, "coverArea": 100 }'>
					<div class="lqd-fb-bg lqd-overlay"></div>
				</div>
				<?php if( !empty( $title ) ) { ?>
				<div
				class="w-80 pr-md-2 pos-rel"
				data-custom-animations="true"
				data-ca-options='{ "triggerHandler": "inview", "animationTarget": "all-childs", "duration": 1200, "delay": 120,  "startDelay": 800, "initValues": { "y": 30, "opacity": 0 }, "animations": { "y": 0, "opacity": 1 } }'>
					<<?php echo $tag; ?> class="lqd-fb-content-title my-0" data-split-text="true" data-split-options='{ "type": "lines" }'><?php $this->get_title(); ?></<?php echo $tag; ?>>
				</div>
				<?php } ?>
				<div
				class="w-20 pos-rel"
				data-custom-animations="true"
				data-ca-options='{ "triggerHandler": "inview", "animationTarget": "all-childs", "duration": 1100, "delay": 120,  "startDelay": 950, "initValues": { "y": 30, "opacity": 0 }, "animations": { "y": 0, "opacity": 1 } }'>
					<a class="lh-1 d-flex align-items-center justify-content-end lqd-fb-icon"<?php echo ld_helper()->html_attributes( $link ) ?>>
						<?php $this->get_icon();?>
					</a>
				</div>
			</div>
			<a <?php echo ld_helper()->html_attributes( $link ) ?> class="liquid-overlay-link"></a>
		</div>

	</div>
</div>