<?php



$related_posts = false;
if( function_exists( 'liquid_get_post_type_related_posts' ) ) {
	$related_posts = liquid_get_post_type_related_posts( get_the_ID(), 6, 'liquid-portfolio', 'liquid-portfolio-category' );	
}

if( !$related_posts ) {
	return;
}

?>
<div class="lqd-pf-grid lqd-pf-related-projects">

	<div class="lqd-pf-row carousel-container carousel-nav-floated carousel-nav-center carousel-nav-middle carousel-nav-square carousel-nav-solid carousel-nav-lg carousel-nav-appear-onhover">

		<div class="carousel-items row" data-lqd-flickity='{ "wrapAround": true, "prevNextButtons": true, "navArrow": 6, "navOffsets": {"nav": { "top": "35%" }, "prev": "15px", "next": "15px" } }'>

			<?php while( $related_posts->have_posts() ): $related_posts->the_post(); ?>
	
			<div class="lqd-pf-column carousel-item col-xs-6 col-sm-4 col-md-3">

				<div class="carousel-item-inner">

					<div class="lqd-pf-item lqd-pf-item-style-2 pos-rel mb-2">
						<div class="lqd-pf-item-inner">
		
							<div class="lqd-pf-img mb-3 pos-rel border-radius-5 overflow-hidden">

								<figure>
									<?php echo liquid_the_post_thumbnail( 'liquid-portfolio-sq', array( 'class' => 'w-100' ), false ); ?>
								</figure>

								<span class="lqd-pf-overlay-bg lqd-overlay align-items-center justify-content-center">
									<i class="lqd-icn-ess icon-md-arrow-forward"></i>
								</span>
							</div><!-- /.lqd-pf-img -->
		
							<div class="lqd-pf-details">
								<?php the_title( sprintf( '<h2 class="mt-0 mb-1 h5"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ) ?>
								<?php
									$terms = get_the_terms( get_the_ID(), 'liquid-portfolio-category' );
									$term = $terms[0];
									if( isset( $term ) ) {
										echo '<ul class="reset-ul inline-nav lqd-pf-cat pos-rel z-index-2"><li><a href="' . get_term_link( $term->slug, 'liquid-portfolio-category' ) . '">' . esc_html( $term->name ) . '</a></li></ul>';
									}
								?>
							</div><!-- /.lqd-pf-details -->
		
							<a href="<?php the_permalink() ?>" class="lqd-pf-overlay-link lqd-overlay z-index-1"></a>
		
						</div><!-- /.lqd-pf-item-inner -->
					</div><!-- /.lqd-pf-item -->

				</div><!-- /.carousel-item-inner -->
				
			</div><!-- /.lqd-pf-column col-md-3 -->
	
			<?php endwhile; ?>


		</div><!-- /.carousel-items -->

	</div><!-- /.lqd-pf-row -->
</div><!-- /.lqd-pf-grid -->
<?php wp_reset_postdata();