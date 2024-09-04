<div class="lqd-pf-column <?php $this->get_grid_class() ?> col-sm-6 col-xs-12 masonry-item <?php $this->entry_term_classes() ?>">

	<article<?php echo liquid_helper()->html_attributes( $attributes ) ?>>
		<div class="lqd-pf-item-inner">

			<div class="lqd-pf-img mb-3 pos-rel border-radius-10 overflow-hidden">
				<figure>
					<?php $this->entry_thumbnail( 'liquid-style6-pf' ); ?>
				</figure>
				<span class="lqd-pf-overlay-bg lqd-overlay d-flex align-items-center justify-content-center">
				</span>
			</div>

			<div class="lqd-pf-details">
				<div class="d-flex justify-content-between">
					<?php 
						$title_tag = isset( $title_tag ) ? $title_tag : 'h2'; 
						$tag_to_inherite = isset( $tag_to_inherite ) ? $tag_to_inherite : 'h5';
					?>
					<?php the_title( sprintf( '<%1$s class="lqd-pf-title mt-0 align-items-center %2$s">', $title_tag, $tag_to_inherite ), sprintf( '</%s>', $title_tag ) );?>
					<?php $this->get_badge(); ?>
				</div>
				<?php $this->entry_cats() ?>
			</div>

			<?php $this->get_overlay_button(); ?>

		</div>
	</article>

</div>