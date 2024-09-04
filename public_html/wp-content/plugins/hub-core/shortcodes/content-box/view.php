<?php

extract( $atts );

$classes = array( 
	'lqd-fb',
	$this->get_class( $template ), 
	$box_height,
	$el_class, 
	$this->get_id() 
);

// Enqueue Conditional Script
$this->scripts();

$this->generate_css();

?>
<div
id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>"
data-inview="true"
data-slideelement-onhover="true"
data-slideelement-options='{ "visibleElement": "h6, h2", "hiddenElement": ".lqd-fb-txt" }'>

	<div class="lqd-fb-inner lqd-overlay">

		<div class="lqd-fb-img lqd-overlay overflow-hidden">

		<?php $this->get_image( true, true ); ?>
		<?php $this->get_overlay_link() ?>

		</div><!-- /.lqd-fb-img -->

		<div class="lqd-fb-content lqd-overlay align-items-end">
			<div class="lqd-fb-bg lqd-overlay"></div><!-- /.lqd-fb-bg lqd-overlay -->
			<div
			class="lqd-fb-content-inner pos-rel p-4 p-md-7 w-100"
			data-custom-animations="true"
			data-ca-options='{ "triggerHandler": "inview", "animationTarget": "all-childs", "duration": 1200, "delay": 120,  "startDelay": 250, "initValues": { "y": 30, "opacity": 0 }, "animations": { "y": 0, "opacity": 1 } }'>
				
				<?php if( !empty( $label ) ) { ?>
				<h6 class="my-0 mb-3 text-uppercase font-weight-medium ltr-sp-2">
					<?php $this->get_label(); ?>
				</h6>
				<?php } ?>
				
				<?php if( !empty( $title ) ) { ?>
				<<?php echo $tag; ?> class="my-0">
					<?php $this->get_title(); ?>
				</<?php echo $tag; ?>>
				<?php } ?>

				<?php if( !empty( $content ) ) { ?>
					<div class="lqd-fb-txt">
						<p class="my-0 mb-5"><?php $this->get_content(); ?></p>
					</div>
				<?php } ?>
				
			</div><!-- /.lqd-fb-content-inner -->
		</div><!-- /.lqd-fb-content -->

	</div><!-- /.lqd-fb-inner -->
</div><!-- /.lqd-fb pos-rel -->
