<?php

extract( $atts );

// Enqueue Conditional Script
$this->scripts();

$classes = array( 
	'lqd-bnr-bnns',
	'text-center',
	$el_class, 
	$this->get_id() 
);

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">
	<div class="lqd-bnr-bnns-inner lqd-overlay">

		<?php if( !empty( $heading ) ) { ?>
		<div
		class="lqd-bnr-bnns-h-wrap lqd-bnr-bnns-h-wrap-first"
		data-parallax="true"
		data-parallax-from='{"opacity": 0, "y": 100}'
		data-parallax-to='{"opacity": 1, "y": 0}'
		data-parallax-options='{"addWillChange": true, "start": "top top", "end": "+=60%"}'>
			<h2 class="lqd-bnr-bnns-h">
				<?php echo $heading; ?>
			</h2>

		</div>
		<?php } ?>

		<div class="fullwidth pos-abs h-100">
			<div class="lqd-bnr-bnns-media fullwidth h-vh-100 lqd-css-sticky pos-l pos-r">
				<div
				class="lqd-bnr-media-inner"
				data-parallax="true"
				data-parallax-from='{"scale": 1, "y": 0}'
				data-parallax-to='{"scale": 0.75, "y": 100}'
				data-parallax-options='{"addWillChange": true, "start": "top top", "end": "+=50%"}'>
					<?php $this->get_image(); ?>
				</div>

			</div>
		</div>

		<?php if( !empty( $heading2 ) ) { ?>
		<div class="lqd-bnr-bnns-h-wrap lqd-bnr-bnns-h-wrap-last d-flex align-items-center justify-content-center h-vh-100 lqd-css-sticky text-center w-100"
		data-parallax="true"
		data-parallax-from='{"opacity": 1, "y": 0}'
		data-parallax-to='{"opacity": 0, "y": 150}'
		data-parallax-options='{"addWillChange": true, "start": "top top", "end": "+=50%"}'>

			<h2 class="lqd-bnr-bnns-h-inner"><?php echo $heading2; ?></h2>

		</div>
		<?php } ?>

	</div>
	
</div>


