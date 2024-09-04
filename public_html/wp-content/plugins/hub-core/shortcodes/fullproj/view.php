<?php

extract( $atts );

$identities = vc_param_group_parse_atts( $identities );

if( empty( $identities ) )
	return;

// Enqueue Conditional Script
$this->scripts();

// classes
$classes = array( 

	'lqd-fullproj-scrn', 
	'pos-rel',
	'overflow-hidden', 

	$el_class,
	$this->get_id(),

);

// Enqueue Conditional Script
$this->generate_css();

$i = 0;

?>
<div id="<?php echo $this->get_id(); ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>" data-lqd-fullproj="true" aria-expanded="false" id="<?php echo $this->get_id(); ?>">

	<span class="lqd-fullproj-loader d-inline-flex pos-abs z-index-3">
		<span class="d-inline-flex circle"></span>
	</span>

	<div class="lqd-fullproj-scrn-inner">
	
		<div class="lqd-fullproj-menu h1 my-0">
			<ul class="reset-ul d-flex flex-wrap align-items-center" data-active-onhover="true">
				
				<?php foreach ( $identities as $item ) { 
					$i++;
					
					$href_atts = '';
					if( 'image' !== $item['media_type'] ) {
						$href_atts = '  data-video-trigger="true"';
					}
					
				?>
				<li class="d-inline-flex align-items-center justify-content-between">
					
					<a class="lqd-fullproj-link" href="<?php echo $url = ( !empty( $item['url'] ) ? esc_url( $item['url'] ) : '#' ) ?>" <?php echo $href_atts; ?>>
						
						<?php if( !empty( $item['text'] ) ) { ?>
						<span class="lqd-fullproj-title"><?php echo esc_html( $item['text'] )?> <?php if( !empty( $item['subtitle'] ) ) { ?><small><?php echo esc_html( $item['subtitle'] )?></small><?php } ?></span>
						<?php } ?>

						<span class="lqd-fullproj-media lqd-overlay">
						<?php if( 'image' === $item['media_type'] ) { 
							$alt = get_post_meta( $item['image'], '_wp_attachment_image_alt', true );
						?>
							<img src="<?php echo wp_get_attachment_image_url( $item['image'], 'full', false ) ?>" alt="<?php echo esc_attr( $alt ); ?>">
						<?php } else { ?>
							<video>
								<?php if( !empty( $item['mp4_local_video'] ) ) { ?>
									<source src="<?php echo esc_url( $item['mp4_local_video'] ) ?>" type="video/mp4">
								<?php } ?>
								<?php if( !empty( $item['webm_local_video'] ) ) { ?>
									<source src="<?php echo esc_url( $item['webm_local_video'] ) ?>" type="video/webm">
								<?php } ?>
							</video>
						<?php } ?>
						</span>
					</a>

				</li>
				<?php } ?>

			</ul>
		</div><!-- /.lqd-fullproj-menu -->

	</div><!-- /.lqd-fullproj-scrn-inner -->

</div><!-- /.lqd-fullproj-scrn -->