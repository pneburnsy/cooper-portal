<?php

extract( $atts );

$identities = vc_param_group_parse_atts( $identities );

if( empty( $identities ) )
	return;

// Enqueue Conditional Script
$this->scripts();

$classes = array( 
	'lqd-asym-slider',	
	$el_class, 
	$this->get_id() 
);

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>" data-asym-slider="true">
	<div class="lqd-asym-slider-inner">

		<div class="lqd-asym-slider-t pos-rel z-index-3">
			<div class="lqd-asym-slider-content d-flex flex-column flex-md-row align-items-center">
				<div class="lqd-asym-slider-title-wrap d-flex w-100 w-md-50 pos-rel">

					<?php $i = 0; foreach ( $identities as $item ) {   
						if( !empty( $item['title'] ) ) { 
					?>
						<div class="lqd-asym-slider-title w-100 <?php echo $i; echo $i === 0 ? ' active' : ''; ?>">
							<h2 class="lqd-asym-slider-title-element my-0 h1" data-fittext="true" data-fittext-options='{"compressor": 0.4, "maxFontSize": "currentFontSize"}'>
								<span class="d-block" data-split-text="true" data-split-options='{ "type": "chars, words" }'><?php echo $item['title'] ?></span>
							</h2>
						</div><!-- /.lqd-asym-slider-title -->
					<?php } $i++; } ?>

				</div><!-- /.lqd-asym-slider-title-wrap -->
				<div class="lqd-asym-slider-info-wrap d-flex w-100 w-md-25 pl-md-3 pos-rel">

					<?php $i = 0; foreach ( $identities as $item ) { ?>
						<div class="lqd-asym-slider-info w-100 <?php echo $i === 0 ? 'active' : ''; ?>">
							<?php if( isset( $item['subtitle'] ) ) { ?>
							<h4 class="lqd-asym-slider-subtitle-element my-0"><?php echo $item['subtitle'] ?></h4>
							<hr class="my-3">
							<?php } ?>
							<?php if( isset( $item['description'] ) ) { ?>
							<p class="lqd-asym-slider-description-element h4 my-0"><?php echo $item['description'] ?></p>
							<?php } ?>
						</div><!-- /.lqd-asym-slider-info -->
					<?php $i++; 
						} ?>

				</div><!-- /.lqd-asym-slider-info-wrap -->
			</div><!-- /.lqd-asym-slider-content -->
		</div><!-- /.lqd-asym-slider-t -->

		<div class="lqd-asym-slider-b pos-rel">
			<div class="lqd-asym-slider-img-wrap d-flex pos-rel overflow-hidden">

				<?php $i = 0; foreach ( $identities as $item ) { ?>
					<div class="lqd-asym-slider-img d-flex w-100 h-100 pos-rel overflow-hidden <?php echo $i === 0 ? 'active' : ''; ?>">
						<div class="lqd-asym-slider-img-inner w-100 overflow-hidden">
							<?php if( !empty( $item['image'] ) ) { ?>
							<figure class="my-0 w-100 h-100 bg-cover bg-center" data-responsive-bg="true">
								<?php echo wp_get_attachment_image( $item['image'], 'full', false, array( 'class' => 'invisible w-100', 'alt' => esc_attr( $alt = !empty( $item['title'] ) ? $item['title'] : '' ) ) ); ?>
							</figure>
							<?php } ?>
						</div><!-- /.lqd-asym-slider-img-inner -->
						<div class="lqd-asym-slider-btn-wrap d-inline-flex pos-abs pos-bl z-index-2 overflow-hidden">
							<div class="lqd-asym-slider-btn">
								<?php $this->get_button( $item['btn_label'], $item['url'] ); ?>
							</div><!-- /.lqd-asym-slider-btn -->
						</div><!-- /.lqd-asym-slider-btn-wrap -->
					</div><!-- /.lqd-asym-slider-img -->
				<?php $i++; } ?>

			</div><!-- /.lqd-asym-slider-img-wrap -->

			<div class="lqd-asym-slider-arrows d-flex pos-abs pos-tr z-index-3">
				<button class="lqd-asym-slider-arrow lqd-asym-slider-prev">
					<i class="lqd-icn-ess icon-md-arrow-back"></i>
				</button>
				<button class="lqd-asym-slider-arrow lqd-asym-slider-next">
					<i class="lqd-icn-ess icon-md-arrow-forward"></i>
				</button>
			</div><!-- /.lqd-asym-slider-arrows -->

		</div><!-- /.lqd-asym-slider-b -->

	</div><!-- /.lqd-asym-slider-inner -->
</div><!-- /.lqd-asym-slider -->