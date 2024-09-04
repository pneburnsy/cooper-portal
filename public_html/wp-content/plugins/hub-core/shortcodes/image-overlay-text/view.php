<?php

extract( $atts );


// Enqueue Conditional Script
$this->scripts();

$classes = array( 
	'lqd-iot', 
	'pos-rel',
	$el_class, 
	$this->get_id() 
);

$this->generate_css();

$maxFont = !empty( $fs ) ? intval( $fs )  : '350';

?>
<div 
	id="<?php echo $this->get_id() ?>" 
	class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>" 
	data-inview="true" 
	data-hover3d="true" 
	data-inview-options='{ "onImagesLoaded": true }'
	>
	<div class="lqd-iot-inner pos-rel">
		
		<div class="lqd-iot-img-wrap pos-rel mb-3 mb-md-0 w-md-95 mx-auto px-md-2" data-stacking-factor="0.5">

			<div class="lqd-iot-img pos-rel overflow-hidden z-index-2" data-webglhover="true">
				<div class="lqd-iot-img-inner" data-hoverme>
					<?php $this->get_image(); ?>
					<?php $this->get_overlay_link(); ?>
				</div>
			</div>
			
			<?php if( !empty( $title ) ) { ?>
			<div class="lqd-iot-overlay-txt lqd-overlay d-flex align-items-center justify-content-center overflow-hidden">
				<div class="lqd-overlay lqd-iot-overlay-txt-inner text-center align-items-center justify-content-center">
					<h2 class="my-0"><?php esc_html_e( $title ); ?></h2>
				</div>
			</div>
			<?php } ?>

			<div class="lqd-iot-overlay-btn pos-abs justify-content-end z-index-2">
				<?php $this->get_button() ?>
			</div>

		</div>
		
		<div class="lqd-iot-content lqd-iot-content-left d-flex align-items-end pos-md-abs pos-bl mb-3 mb-md-0">
			<div class="lqd-iot-content-inner d-flex align-items-center">
				<?php if( !empty( $subtitle ) ) { ?>
				<div class="lqd-iot-subtitle">
					<h3 class="h6"><?php esc_html_e( $subtitle ); ?></h3>
				</div>
				<?php } ?>
				
				<?php if( !empty( $info ) ) { ?>
				<div class="lqd-iot-cat">
					<ul class="reset-ul inline-nav">
						<li><?php esc_html_e( $info ); ?></li>
					</ul>
				</div>
				<?php } ?>
			</div>
		</div>

		<?php if( !empty( $content ) ) { ?>
		<div class="lqd-iot-content lqd-iot-content-right d-flex align-items-end pos-md-abs pos-br">
			<div class="lqd-iot-content-inner d-flex align-items-center">
				<?php $this->get_content(); ?>
			</div>
		</div>
		<?php } ?>

	</div>
</div>