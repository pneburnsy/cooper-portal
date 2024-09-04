<?php

extract( $atts );

$classes = array( 
	'lqd-fb',
	'round',
	$box_height_6,
	$this->get_class( $template ), 

	$el_class, 
	$this->get_id() 
);

// Enqueue Conditional Script
$this->scripts();

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>" data-lqd-zindex="true">
	<div class="lqd-fb-inner lqd-overlay">
		
		<div class="lqd-fb-shadow"></div>

		<div class="d-flex flex-wrap align-items-center lqd-overlay" data-hover3d="true">

			<div class="lqd-fb-content-wrap lqd-overlay flex-column align-items-end transform-style-3d backface-hidden will-change-transform" data-stacking-factor="0.5">

				<div class="lqd-fb-img lqd-overlay rount backface-hidden">
					<figure class="w-100" data-responsive-bg="true">
						<?php $this->get_image( false, true ); ?>
					</figure>
					<div class="lqd-fb-bg lqd-overlay"></div>
					<div class="lqd-fb-hover-overlay lqd-overlay"></div>
				</div>

				<div class="lqd-fb-content pos-abs pos-bl w-100 p-4 py-lg-7 px-lg-8 backface-hidden">

					<span class="lqd-fb-icon d-flex mb-5">
						<?php $this->get_icon() ?>
					</span>

					<?php if( !empty( $subtitle ) ) { ?>
					<h6 class="my-0 mb-3 font-weight-bold text-uppercase ltr-sp-2"><?php $this->get_subtitle(); ?></h6>
					<?php } ?>
					
					<?php if( !empty( $title ) ) { ?>
					<<?php echo $tag; ?> class="lqd-fb-content-title my-0 mb-3 font-weight-bold"><?php $this->get_title(); ?></<?php echo $tag; ?>>
					<?php } ?>
					
					<?php $this->get_button() ?>

				</div>

				<?php $this->get_overlay_link() ?>

			</div>

		</div>

	</div>
</div>