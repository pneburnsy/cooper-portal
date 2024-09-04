<?php

extract( $atts );

$identities = vc_param_group_parse_atts( $identities );

if( empty( $identities ) )
	return;

$classes = array( 
	'lqd-hotspot', 
	'pos-rel',
	$this->get_custom_height_class(),
	$el_class, 
	$this->get_id(), 

);

$this->generate_css();

$style = '';

?>
<div class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>" id=<?php echo $this->get_id() ?>>
	<div class="lqd-hotspot-inner">

		<div class="lqd-hotspot-img">
			<?php $this->get_image(); ?>
		</div><!-- /.lqd-hotspot-img -->
		<div class="lqd-hotspot-items lqd-overlay">

			<?php foreach ( $identities as $spot ) {  
				
				if( !empty( $spot['top'] ) || !empty( $spot['bottom'] ) || !empty( $spot['left'] ) || !empty( $spot['right'] ) )  {
					
					$style = 'style="';   

					if( !empty( $spot['top'] ) ) {
						$style .= 'top:' . $spot['top'] . ';';	
					}
					if( !empty( $spot['bottom'] ) ) {
						$style .= 'bottom:' . $spot['bottom'] . ';';
					}
					if( !empty( $spot['left'] ) ) {
						$style .= 'left:' . $spot['left'] . ';';
					}
					if( !empty( $spot['right'] ) ) {
						$style .= 'right:' . $spot['right'] . ';';
					}
					$style .= '"';		
	
				}

			?>
			<div class="lqd-hotspot-item <?php echo $spot['position'] ?> pos-abs" <?php echo $style; ?>>
				<span class="lqd-hotspot-mark d-inline-flex align-items-center justify-content-center circle">
					<i class="lqd-icn-ess icon-ion-ios-add"></i>
				</span>
				<div class="lqd-hotspot-content p-4 round pos-abs z-index-5 text-center">
					<h2 class="h5 mt-0"><?php esc_html_e( $spot['title'] ) ?></h2>
					<p class="mb-0"><?php echo wp_kses_post( $spot['description'] ); ?></p>
				</div><!-- /.lqd-hotspot-content -->
			</div><!-- /.lqd-hotspot-item -->
			<?php } ?>
			
		</div><!-- /.lqd-hotspot-items -->

	</div><!-- /.lqd-hotspot-inner -->
</div><!-- /.lqd-hotspot -->