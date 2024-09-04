<?php

extract( $atts );

$identities = vc_param_group_parse_atts( $identities );

if( empty( $identities ) )
	return;

// Enqueue Conditional Script
$this->scripts();

$classes = array( 
	'lqd-imgtxt-slider pos-rel text-center',
	$hover_style,
	$el_class, 
	$this->get_id() 
);

$this->generate_css();


?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">
	<div class="lqd-imgtxt-slider-inner" data-active-onhover="true" data-active-onhover-options='{ "triggers": ".lqd-imgtxt-slider-nav a", "targets": ".lqd-imgtxt-slider-images .lqd-imgtxt-slider-img" }'>

		<div class="lqd-imgtxt-slider-images pos-abs pointer-events-none">
			
			<?php foreach ( $identities as $key => $item ) { ?>
			
			<div class="lqd-imgtxt-slider-img">
				<figure>
				<?php if( 'image' == $item['media_type'] ) { ?>
					<?php echo wp_get_attachment_image( $item['image'], 'full', false ); ?>
				<?php } elseif( 'local_video' == $item['media_type'] ) { ?>
					<video data-video-bg="true" autoplay loop playsinline>
						<?php if( !empty( $item['mp4_local_video'] ) ) { ?>
							<source src="<?php echo esc_url( $item['mp4_local_video'] ) ?>" type="video/mp4">
						<?php } ?>
						<?php if( !empty( $item['webm_local_video'] ) ) { ?>
							<source src="<?php echo esc_url( $item['webm_local_video'] ) ?>" type="video/webm">
						<?php } ?>
					</video>
				<?php } elseif( 'yt_video' == $item['media_type'] ) { ?>
					<div
						data-video-bg="true"
						data-youtube-options='{ "videoURL": "<?php echo esc_url( $item['yt_video_url'] ) ?>" }'
					></div>
				<?php } ?>
				</figure>
			</div>
			<?php } ?>
			
		</div>

		<nav class="lqd-imgtxt-slider-nav h4 d-inline-flex">

			<ul class="reset-ul d-inline-flex flex-column align-items-center">
				
				<?php foreach ( $identities as $key => $item ) { ?>
				<li class="d-inline-flex">
					<a
					href="<?php echo $url = ( !empty( $item['url'] ) ? esc_url( $item['url'] ) : '#' ) ?>"
					class="lqd-imgtxt-slider-link pos-rel"
					data-text="<?php echo esc_html( $item['text'] ); ?>">
						<span><?php echo esc_html( $item['text'] ); ?></span>
					</a>
				</li>
				<?php } ?>				

			</ul>
		</nav>
		
	</div>
</div>