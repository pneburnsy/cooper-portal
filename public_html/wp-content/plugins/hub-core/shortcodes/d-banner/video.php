<?php

extract( $atts );

// Enqueue Conditional Script
$this->scripts();

$classes = array( 
	'lqd-bnr-3d',	
	$el_class, 
	$this->get_id() 
);

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>" data-inview="true">
	<div class="lqd-bnr-3d-inner-wrap" data-hover3d="true">

		<div class="lqd-bnr-3d-inner" data-stacking-factor="2">

			<div
			class="lqd-bnr-3d-heading-wrap"
			data-custom-animations="true"
			data-ca-options='{ "triggerHandler": "inview", "animationTarget": ".lqd-lines", "duration": 1300, "delay": 180, "startDelay": 400, "initValues": { "z": 150, "opacity": 0 }, "animations": { "z": 0, "opacity": 1 } }'>
				<?php if( !empty( $title ) ) { ?>
				<h2
				class="lqd-bnr-3d-heading"
				data-fittext="true"
				data-fittext-options='{ "compressor": 0.5, "minFontSize": 50, "maxFontSize": "currentFontSize" }'
				data-split-text="true"
				data-split-options='{ "type": "lines" }'>
					<?php echo $title; ?>
				</h2>
				<?php } ?>
			</div><!-- /.lqd-bnr-3d-heading-wrap -->
			<div class="lqd-bnr-3d-media pos-rel h-pt-45">

				<div class="lqd-bnr-3d-media-inner pos-abs">

					<div class="lqd-vbg-wrap">
						<div class="lqd-vbg-inner">
							<span class="lqd-vbg-loader"></span>
							<div
								class="lqd-vbg-video"
								data-video-bg="true"
								data-youtube-options='{
									"videoURL": "<?php echo $video_url; ?>",
									"startAt": 8,
									"stopAt": 17
								}'
							></div>
						</div>
					</div>

				</div><!-- /.lqd-bnr-3d-media-inner -->

				<div class="lqd-bnr-3d-borders pos-abs">
					<span></span>
					<span></span>
				</div><!-- /.lqd-bnr-3d-borders -->
			</div><!-- /.lqd-bnr-3d-media -->
			<?php $this->get_button(); ?>
		</div>

	</div><!-- /.lqd-bnr-3d-inner -->
</div><!-- /.lqd-bnr-3d -->