<?php

extract( $atts );

$identities = vc_param_group_parse_atts( $identities );

if( empty( $identities ) )
	return;

// Enqueue Conditional Script
$this->scripts();

$classes = array( 
	'lqd-dist-gal',	
	$el_class, 
	$hover_style,
	$this->get_id() 
);

$this->generate_css();

$distGalId = $this->get_id();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>" data-lqd-dist-gal="true">

	<div class="lqd-dist-gal-inner">

		<div class="lqd-dist-gal-distort">

			<div class="lqd-dist-gal-images">
				
				<?php $this->get_galleries(); ?>
	
			</div><!-- /.lqd-dist-gal-images -->

		</div>

		<nav class="lqd-dist-gal-menu">
			<?php 
				
				foreach ( $identities as $item ) { 
				$url = !empty( $item['url'] ) ? esc_url( $item['url'] ) : '#';
				
			?>
			<h2 class="m-0">
				<a href="<?php echo $url; ?>" class="lqd-dist-gal-menu-item">
					<?php if ( $hover_style === 'lqd-dist-gal-hover-outline' ): ?>
						<span class="overlay-text pos-abs pos-tl pos-br ws-nowrap">
							<?php echo esc_html( $item['text'] );?>
							<?php if ( ! empty($item['subtext']) ) : ?>
								<small><?php echo esc_html( $item['subtext'] ); ?></small>
							<?php endif; ?>
						</span>
					<?php endif ?>
					<span class="primary-text">
						<?php echo esc_html( $item['text'] );?>
						<?php if ( ! empty($item['subtext']) ) : ?>
							<small><?php echo esc_html( $item['subtext'] ); ?></small>
						<?php endif; ?>
					</span>
				</a>
			</h2>
			<?php } ?>
		</nav>

	</div><!-- /.content -->

</div><!-- /.lqd-dist-gal -->