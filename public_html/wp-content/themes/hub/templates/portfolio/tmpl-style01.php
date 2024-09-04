<div class="lqd-pf-column col-md-<?php $this->get_column_class() ?> col-sm-6 col-xs-12 masonry-item <?php $this->entry_term_classes() ?>">

	<article<?php echo liquid_helper()->html_attributes( $attributes ) ?>>
		<div class="lqd-pf-item-inner">

			<div class="lqd-pf-img">
				<figure>
					<?php $this->entry_thumbnail(); ?>
				</figure>
			</div>

			<div class="lqd-pf-details d-flex flex-wrap pos-rel border-radius-4">
				<span class="lqd-pf-overlay-bg lqd-overlay"></span>
				<div class="lqd-pf-info d-flex flex-wrap align-items-center justify-content-between w-100 p-4">
					<?php 
						$title_tag = isset( $title_tag ) ? $title_tag : 'h2'; 
						$tag_to_inherite = isset( $tag_to_inherite ) ? $tag_to_inherite : 'h5';
					?>
					<?php the_title( sprintf( '<%1$s class="lqd-pf-title mt-0 mb-0 %2$s">', $title_tag, $tag_to_inherite ), sprintf( '</%s>', $title_tag ) );?>
					<?php $this->entry_cats() ?>
				</div>
			</div>

			<?php $this->get_overlay_button(); ?>

		</div>
	</article>

</div>