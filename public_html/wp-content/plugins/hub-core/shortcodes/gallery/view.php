<?php

// Enqueue Conditional Script
$this->scripts();

$attachments  = $this->get_attachments();

$el_id = uniqid( 'lqd-image-gallery-' );

?>
<div class="lqd-img-gal">

	<div class="lqd-img-gal-imgs">

		<div class="carousel-container carousel-nav-floated carousel-nav-center carousel-nav-middle carousel-nav-lg carousel-nav-solid carousel-nav-circle carousel-nav-appear-onhover carousel-dots-mobile-inside">
			<div class="carousel-items" data-lqd-flickity='{ "prevNextButtons": true, "navArrow": "6", "parallax": true, "adaptiveHeight": true }' id="<?php echo $el_id ?>main-carousel">

				<?php foreach ( $attachments as $attachment ) { ?>
				<div class="carousel-item col-xs-12 px-0">
					<div class="carousel-item-inner">
						<figure>
							<?php echo wp_get_attachment_image( $attachment->ID, 'full', false ); ?>
						</figure>
					</div>
				</div>
				<?php }; ?>

			</div><!-- /.carousel-items -->
		</div><!-- /.carousel-container -->

	</div><!-- /.lqd-img-gal-imgs -->

	<div class="lqd-img-gal-thumbs">

		<div class="carousel-container">
			<div class="carousel-items" data-lqd-flickity='{ "contain": false, "pageDots": false, "asNavFor": "#<?php echo $el_id ?>main-carousel" }'>

				<?php foreach ( $attachments as $attachment ) { ?>
				<div class="carousel-item col-xs-4 col-sm-3 col-md-2">
					<div class="carousel-item-inner">
						<figure>
							<?php echo wp_get_attachment_image( $attachment->ID, array( 160, 70 ), false ); ?>
						</figure>
					</div>
				</div>
				<?php }; ?>

			</div><!-- /.carousel-items -->
		</div><!-- /.carousel-container -->

	</div><!-- /.lqd-img-gal-thumbs -->

</div><!-- /.lqd-img-gal -->