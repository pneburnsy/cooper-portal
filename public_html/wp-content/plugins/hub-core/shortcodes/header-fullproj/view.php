<?php

extract( $atts );

$identities = vc_param_group_parse_atts( $identities );

if( empty( $identities ) )
	return;

// Enqueue Conditional Script
$this->scripts();

// classes
$module_classes = array(
	'header-module',
	'module-lqd-fullproj-scrn',
	'no-rotate',
	$el_class,
	$this->get_id(),
);
$fullproj_classes = array( 
	'lqd-fullproj-scrn', 
	'pos-rel', 
	'overflow-hidden', 
	'pos-fix', 
	'pos-tl collapse',
	$this->get_id()
);
$trigger_wrap_classes = array( 
	'lqd-fullproj-trigger'
);
$trigger_classes = array( 
	'nav-trigger',
	'collapsed',
	$trigger_style,
	$trigger_fill, 
	$trigger_shape,
	$trigger_txt_position,
);


// Enqueue Conditional Script
$this->generate_css();

$i = 0;

?>
<div class="<?php echo ld_helper()->sanitize_html_classes( $module_classes ) ?>">

	<div class="<?php echo ld_helper()->sanitize_html_classes( $trigger_wrap_classes ) ?>">
		<button
		class="<?php echo ld_helper()->sanitize_html_classes( $trigger_classes ) ?>"
		role="button"
		type="button"
		data-ld-toggle="true"
		data-toggle="collapse"
		data-toggle-options='{ "changeClassnames": {"html": "overflow-hidden"}, "cloneTriggerInTarget": true }'
		data-target="<?php echo '#' . $this->get_id(); ?>"
		aria-expanded="false"
		aria-controls="<?php echo $this->get_id() ?>">
			<span class="bars">
				<span class="bars-inner">
					<span class="bar"></span>
					<span class="bar"></span>
					<span class="bar"></span>
					<i class="loading-spinner"></i>
				</span>
			</span>
			<?php if( !empty( $label ) ) { ?>
			<span class="txt"><?php esc_html_e( $label ); ?></span>
			<?php } ?>
		</button>
	</div><!-- /.lqd-fullproj-trigger -->

	<div id="<?php echo $this->get_id(); ?>" class="<?php echo ld_helper()->sanitize_html_classes( $fullproj_classes ); ?>" data-lqd-fullproj="true" aria-expanded="false" id="<?php echo $this->get_id(); ?>"  data-move-element='{"target": "body", "type": "appendTo"}'>
		
		<span class="lqd-fullproj-loader d-inline-flex pos-abs z-index-3">
			<span class="d-inline-flex circle"></span>
		</span>

		<div class="lqd-fullproj-scrn-inner p-3 p-sm-5 p-md-9">
		
			<div class="lqd-fullproj-menu h1 my-0">
				<ul class="reset-ul d-flex flex-wrap align-items-center" data-active-onhover="true" data-active-onhover-options='{ "triggerHandlers": ["mouseenter"] }'>
					
					<?php foreach ( $identities as $item ) { 
						$i++;
						
						$href_atts = '';
						if( 'image' !== $item['media_type'] ) {
							$href_atts = ' data-video-trigger="true"';
						}
					?>

					<li class="d-inline-flex align-items-center justify-content-between <?php if( $i == 1 ) { echo 'lqd-is-active'; }?>">
						<a class="lqd-fullproj-link <?php if( $i == 1 ) { echo 'active'; } ?>" href="<?php echo $url = ( !empty( $item['url'] ) ? esc_url( $item['url'] ) : '#' ) ?>" <?php echo $href_atts; ?>>
						
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
</div><!-- /.header-module -->