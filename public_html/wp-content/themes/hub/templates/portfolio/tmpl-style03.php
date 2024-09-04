<div class="carousel-item col-lg-<?php $this->get_column_class() ?> col-md-6 col-xs-12 <?php $this->entry_term_classes() ?>">

	<div class="carousel-item-inner">
		<div class="carousel-item-content">
			
			<article<?php echo liquid_helper()->html_attributes( $attributes ) ?>>
				<div class="lqd-pf-item-inner">
		
					<div class="lqd-pf-img overflow-hidden border-radius-6 pos-rel mb-5">
						<figure>
							<?php $this->entry_thumbnail( 'liquid-style3-pf' ); ?>
						</figure>
		
						<span class="lqd-pf-overlay-bg lqd-overlay d-flex align-items-center justify-content-center">
							<i class="lqd-icn-ess icon-md-arrow-forward"></i>
						</span>
		
					</div>
		
					<div class="lqd-pf-details">
						<?php 
							$title_tag = isset( $title_tag ) ? $title_tag : 'h2'; 
							$tag_to_inherite = isset( $tag_to_inherite ) ? $tag_to_inherite : 'h5';
						?>
						<?php the_title( sprintf( '<%1$s class="lqd-pf-title mt-0 mb-1 %2$s">', $title_tag, $tag_to_inherite ), sprintf( '</%s>', $title_tag ) );?>
						<?php $this->entry_cats() ?>
					</div>
		
					<?php $this->get_overlay_button(); ?>
		
				</div>
			</article>

		</div>
	</div>
	
</div>