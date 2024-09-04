<?php

$classes = array( 
	'ld-carousel-laptop', 
	'ld-carousel-laptop-style-1',
	$this->get_id() 
);

// Enqueue Conditional Script
$this->scripts();

$attachments  = $this->get_attachments();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">

	<div class="ld-carousel-laptop-inner">

		<div class="mockup-container">
			<div class="mockup-inner">
				<figure>
					<img src="<?php echo get_template_directory_uri() ?>/assets/img/mockups/laptop/mockup-1.png" alt="Laptop">
				</figure>
			</div><!-- /.mockup-inner -->
		</div><!-- /.mockup-container -->

		<div class="mockup-content-container">
			<div class="mockup-content-inner">

				<div class="carousel-container carousel-nav-floated carousel-nav-middle carousel-nav-sm carousel-dots-mobile-inside">

					<div class="carousel-items row" data-lqd-flickity='{ "prevNextButtons": true, "navArrow": 6 }'>
						
						<?php foreach ( $attachments as $attachment ) { ?>
							<div class="carousel-item col-xs-12">
								<figure class="bg-cover bg-center" data-responsive-bg="true">
									<?php echo wp_get_attachment_image( $attachment->ID, 'full', false ); ?>
								</figure>
							</div><!-- /.carousel-item -->
						<?php } ?>
				
					</div><!-- /.carousel-items row -->
				
				</div><!-- /.carousel-container -->					

			</div><!-- /.mockup-content-inner -->
		</div><!-- /.mockup-content-container -->
		
	</div><!-- /.ld-carousel-laptop-inner -->


</div><!-- /.ld-carousel-laptop ld-carousel-laptop-style-1 -->