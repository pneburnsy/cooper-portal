<?php

extract( $atts );

$identities = vc_param_group_parse_atts( $identities );

if( empty( $identities ) )
	return;

// Enqueue Conditional Script
$this->scripts();

$classes = array( 
	'lqd-slsh',	
	$el_class, 
	$this->get_id() 
);

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>"  data-active-onhover="true" data-active-onhover-options='{ "triggers": ".carousel-container .carousel-item", "targets": ".lqd-slsh-img-container .lqd-slsh-img-full" }'>

	<div class="carousel-container carousel-nav-floated carousel-nav-top carousel-nav-lg carousel-nav-square carousel-nav-solid">

		<div class="carousel-items row pos-rel z-index-2 mx-0" data-lqd-flickity='{ "prevNextButtons": true, "wrapAround": true, "equalHeightCells": true, "groupCells": false, "navArrow": 6 }'>

			<?php 
				
				$i = 1; 
				foreach ( $identities as $slide ) { 
				
			?>
			
			<div class="carousel-item col-md-3 col-xs-6 px-0">

				<div
				class="lqd-slsh-item pos-rel h-pt-150"
				data-slideelement-onhover="true"
				data-slideelement-options='{ "visibleElement": "h2 .lqd-lines", "hiddenElement": "p .lqd-lines, .lqd-slsh-btn" }'>
					
					<?php if( !empty( $slide['url'] ) ) { ?>
						<a target="<?php echo esc_attr( isset($slide['target']) && $slide['target'] ? '_blank' : '_self') ?>" href="<?php echo esc_url( $slide['url'] ); ?>" class="liquid-overlay-link z-index-3"></a>
					<?php } ?>
					
					<?php if( !empty( $slide['image'] ) ) { ?>
					<div class="lqd-slsh-img lqd-overlay">
						<figure class="w-100">
							<?php
								
								$alt    = get_post_meta( $slide['image'], '_wp_attachment_image_alt', true );
								$image  = wp_get_attachment_image( $slide['image'], 'full', false, array( 'class' => 'lqd-overlay objfit-cover objpos-center', 'alt' => esc_attr( $alt ) ) );
								
								echo $image;

							?>
						</figure>
						<div class="lqd-slsh-overlay-bg lqd-overlay"></div><!-- /.lqd-slsh-overlay-bg lqd-overlay -->
					</div><!-- /.lqd-slsh-img -->
					<?php } ?>
					<div class="lqd-slsh-content lqd-overlay flex-column justify-content-end px-3 py-4 px-md-6 py-md-5">
						<div class="lqd-slsh-content-inner pos-rel">
							<h2
							class="lqd-slsh-h-org my-0"
							data-split-text="true"
							data-split-options='{ "type": "lines" }'
							data-fittext="true"
							data-fittext-options='{ "maxFontSize": "currentFontSize" }'><?php echo esc_html( $slide['title'] ); ?></h2>
							
							<?php if( !empty( $slide['description'] ) ) { ?>
							<p
							class="mt-3"
							data-split-text="true"
							data-split-options='{ "type": "lines" }'><?php echo $slide['description'] ?></p><?php } ?>
							
							<?php if( !empty( $slide['url'] ) ) { ?>
							<div class="lqd-slsh-btn mt-4">
								<a href="<?php echo esc_url( $slide['url'] ) ?>" class="btn btn-sm btn-naked btn-hover-swp">
									<span>
										<span class="btn-txt"><?php echo $slide['btn_label'] ?></span>
										<span class="btn-icon">
											<i class="lqd-icn-ess icon-md-arrow-round-forward"></i>
										</span>
										<span class="btn-icon">
											<i class="lqd-icn-ess icon-md-arrow-round-forward"></i>
										</span>
									</span>
								</a>
							</div><!-- /.lqd-slsh-btn -->
							<?php } ?>

							
						</div><!-- /.lqd-slsh-content-inner -->
					</div><!-- /.lqd-slsh-content -->

				</div><!-- /.lqd-slsh-item -->

			</div><!-- /.carousel-item -->

			<?php $i++; } ?>
			
			
		</div><!-- /.carousel-items row -->

		<div class="lqd-slsh-img-container lqd-overlay">
		
		<?php foreach ( $identities as $slide ) { ?>
	
			<figure class="lqd-slsh-img-full lqd-overlay">
			<?php
				
				$alt    = get_post_meta( $slide['image'], '_wp_attachment_image_alt', true );
				$image  = wp_get_attachment_image( $slide['image'], 'full', false, array( 'class' => 'objfit-cover objpos-center lqd-overlay', 'alt' => esc_attr( $alt ) ) );
				
				echo $image;

			?>
			</figure>
			
		<?php } ?>
	

		</div><!-- /.lqd-slsh-img-container -->

	</div><!-- /.carousel-container -->

</div><!-- /.lqd-slsh -->