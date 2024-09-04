<?php

$style = $atts['style'];
$items_height = $atts['items_height'];
//$filter_id = $atts['filter_id'];
$section_id = uniqid( 'heading-id' );
$ajax_trigger = $atts['ajax_trigger'];

$carousel_heading = $unique_id = '';
if( !empty( $atts['carousel_heading'] ) ) {
	$carousel_heading = '<header class="fancy-title" id="' . $section_id . '"><h2 class="font-weight-bold">'. esc_html( $atts['carousel_heading'] ) . '</h2></header>';
}

$ajax_wrapper = '';

if( !empty( $atts['unique_id'] ) ) {
	$unique_id = $atts['unique_id'];
	$ajax_wrapper = '.' . $unique_id;
}

// check
$located = locate_template( "templates/blog/tmpl-$style.php" );
if ( ! file_exists( $located ) ) {
	return;
}

$i = 0;

// Enqueue Conditional Script
$this->scripts();

// The CSS
$this->generate_css();

echo '<div class="lqd-lp-grid ' . $this->get_id() . ' ' . $unique_id . ' ">';

// Include filter
if( 'yes' === $atts['enable_filter'] ) {
	$filter_located = locate_template( 'templates/blog/partial-filters.php' );
	include $filter_located;
}

// Build Query
$GLOBALS['wp_query'] = new WP_Query( $this->build_query() );
$before = $after = '';
	
	if( 'style05' === $style || 'style07' === $style ) {
		echo '<div class="lqd-lp-row row d-flex flex-wrap" data-liquid-masonry="true" data-masonry-options=\'{ "filtersID": "#' . $atts['filter_id'] . '","itemSelector": ".lqd-lp-column" }\'>';
		$after  = '</div>';
	}
	elseif( 'style14' === $style ) {
		echo '<div class="lqd-lp-row row d-flex flex-wrap" data-liquid-masonry="true" data-masonry-options=\'{ "filtersID": "#' . $atts['filter_id'] . '","itemSelector": ".lqd-lp-column" }\'>';
		$after  = '</div>';
	}
	else {
		if( 'yes' === $atts['enable_filter'] ) {
			if( 'style16' === $style ){
				echo '<div class="lqd-lp-row row d-flex flex-wrap" data-liquid-masonry="true" data-masonry-options=\'{ "filtersID": "#' . $atts['filter_id'] . '","itemSelector": ".lqd-lp-column", "layoutMode": "fitRows" }\'>';
			} else {
				echo '<div class="lqd-lp-row row d-flex flex-wrap" data-liquid-masonry="true" data-masonry-options=\'{ "filtersID": "#' . $atts['filter_id'] . '","itemSelector": ".lqd-lp-column" }\'>';
			}
		} else {
			echo '<div class="lqd-lp-row row d-flex flex-wrap">';
		}
		$after  = '</div>';
	}

	while( have_posts() ): the_post();

		$before = '<div class="lqd-lp-column ' . $this->get_grid_class() . ' ' . $this->entry_term_classes() . '">';
	
		$post_classes = array( 'lqd-lp' );
		if( 'style01' === $style ) {
			$post_classes[] = 'lqd-lp-style-1 pos-rel';
		}
		elseif( 'style02' === $style ) {
			$post_classes[] = 'lqd-lp-style-2 lqd-lp-animate-onhover d-flex flex-column justify-content-between pos-rel round overflow-hidden p-5';
		}
		elseif( 'style02-alt' === $style ) {
			$post_classes[] = 'lqd-lp-style-2 lqd-lp-style-2-alt lqd-lp-animate-onhover d-flex flex-column justify-content-between pos-rel round overflow-hidden p-5';
		}
		elseif( 'style03' === $style ) {
			$post_classes[] = 'lqd-lp-style-3 pos-rel';
		}
		elseif( 'style04' === $style ) {
			$post_classes[] = 'lqd-lp-style-4 lqd-lp-title-15 pos-rel d-flex flex-wrap align-items-center';
		}
		elseif( 'style05' === $style ) {
			$post_classes[] = 'lqd-lp-style-5 lqd-lp-title-34 pos-rel d-flex flex-wrap align-items-center';
			$before = '<div class="lqd-lp-column col-md-12 ' . $this->entry_term_classes() . '">';
		}
		elseif( 'style06' === $style ) {
			$post_classes[] = 'lqd-lp-style-6 lqd-lp-hover-img-zoom pos-rel round overflow-hidden';
		}
		elseif( 'style06-alt' === $style ) {
			$post_classes[] = 'lqd-lp lqd-lp-style-6 lqd-lp-style-6-alt lqd-lp-title-20 lqd-lp-hover-img-zoom lqd-lp-hover-img-zoom-out pos-rel round overflow-hidden';
		}
		elseif( 'style07' === $style ) {
			$post_classes[] = 'lqd-lp-style-7 lqd-lp-title-34 pos-rel lqd-lp-hover-img-zoom';
			$before = '<div class="lqd-lp-column col-md-12 ' . $this->entry_term_classes() . '">';
		}
		elseif( 'style08' === $style ) {
			$post_classes[] = 'lqd-lp-style-8 p-5 pos-rel round overflow-hidden';
		}
		elseif( 'style09' === $style ) {
			$post_classes[] = 'lqd-lp-style-9 pos-rel d-flex flex-wrap';
		}
		elseif( 'style10' === $style  ) {
			$post_classes[] = 'lqd-lp-style-10 lqd-lp-content-overlay lqd-lp-img-cover pos-rel d-flex flex-wrap round overflow-hidden h-pt-80 lqd-lp-hover-img-zoom';
		}
		elseif( 'style11' === $style  ) {
			$post_classes[] = 'lqd-lp-style-11 lqd-lp-content-overlay lqd-lp-img-cover lqd-lp-title-27 pos-rel d-flex flex-wrap round overflow-hidden h-pt-95';
		}
		elseif( 'style12' === $style  ) {
			$post_classes[] = 'lqd-lp-style-12 pos-rel overflow-hidden border-radius-7 p-4 px-md-5';
		}
		elseif( 'style13' === $style  ) {
			$post_classes[] = 'lqd-lp lqd-lp-style-13 lqd-lp-title-highlight pos-rel';
		}
		elseif( 'style14' === $style  ) {
			$i++;
			if( 1 === $i ) {
				$post_classes[] = 'lqd-lp lqd-lp-style-14 lqd-lp-img-cover lqd-lp-hover-img-zoom lqd-lp-title-36 pos-rel d-flex flex-wrap round overflow-hidden h-pt-60';
				$before = '<div class="lqd-lp-column col-xs-12 col-md-8 ' . $this->entry_term_classes() . '">';
			}
			else {
				$post_classes[] = 'lqd-lp lqd-lp-style-14 lqd-lp-img-cover lqd-lp-hover-img-zoom lqd-lp-title-20 pos-rel d-flex flex-wrap round overflow-hidden h-pt-60';
				$before = '<div class="lqd-lp-column col-xs-12 col-md-4 ' . $this->entry_term_classes() . '">';
			}
		}
		elseif( 'style16' === $style  ) {
			$post_classes[] = 'lqd-lp lqd-lp-style-16 pos-rel';
		}
		elseif( 'style17' === $style  ) {
			$post_classes[] = 'lqd-lp lqd-lp-style-17 lqd-lp-img-cover lqd-lp-title-40 pos-rel d-flex flex-wrap round overflow-hidden ' . $items_height . '';
		}
		elseif( 'style18' === $style  ) {
			$post_classes[] = 'lqd-lp lqd-lp-style-18 lqd-lp-title-highlight d-md-block';
		}
		elseif( 'style19' === $style  ) {
			$post_classes[] = 'lqd-lp lqd-lp-style-19 lqd-lp-title-highlight pos-rel';
		}
		elseif( 'style20' === $style  ) {
			$post_classes[] = 'lqd-lp lqd-lp-style-20 lqd-lp-hover-img-zoom pos-rel';
		}
		elseif( 'style21' === $style  ) {
			$post_classes[] = 'lqd-lp lqd-lp-style-21 pos-rel d-flex flex-wrap';
		}
		elseif( 'style22' === $style || 'style22-alt' === $style  ) {
			$post_classes[] = 'lqd-lp lqd-lp-style-22 lqd-lp-title-34 pos-rel lqd-lp-hover-img-zoom';
		}
		elseif( 'style23' === $style  ) {
			$post_classes[] = 'lqd-lp lqd-lp-style-23 lqd-lp-title-22 lqd-lp-hover-img-zoom lqd-lp-hover-img-zoom-out pos-rel';
		}

		$post_classes = join( ' ', get_post_class( $post_classes, get_the_ID() ) );

		$attributes = array(
			'id'    => 'post-' . get_the_ID(),
			'class' => $post_classes
		);
		
		echo $before;
		
		printf( '<article%s>', ld_helper()->html_attributes( $attributes ) );

			if( 'quote' === get_post_format() ) {
				$quote_located = locate_template( 'templates/blog/format-quote.php' );
				include $quote_located;
			}
			else {
				include $located;
			}

		echo '</article>';

		echo $after;
		
	endwhile;
	
	if( 'carousel' == $style ) {
		echo '</div></div>';
	}
	echo '</div><!--/ .row -->';
	
	// Pagination
	if( 'pagination' === $atts['pagination'] ) {
		
		$max = $GLOBALS['wp_query']->max_num_pages;

		// Set up paginated links.
        $links = paginate_links( array(
			'type' => 'array',
			'prev_next' => true,
			'prev_text' => '<span aria-hidden="true">' . wp_kses_post( __( '<i class="fa fa-angle-left"></i>', 'landinghub-core' ) ) . '</span>',
			'next_text' => '<span aria-hidden="true">' . wp_kses_post( __( '<i class="fa fa-angle-right"></i>', 'landinghub-core' ) ) . '</span>',
		) );

		if( !empty( $links ) ) {
			printf( '<div class="page-nav"><nav aria-label="Page navigation"><ul class="pagination"><li>%s</li></ul></nav></div>', join( "</li>\n\t<li>", $links ) );
		}
	}
	
	if( in_array( $atts['pagination'], array( 'ajax' ) ) && $url = get_next_posts_page_link( $GLOBALS['wp_query']->max_num_pages ) ) {
		$hash = array(
			'ajax' => 'btn btn-md ajax-load-more',
		);

		$attributes = array(
			'href' => add_query_arg( 'ajaxify', '1', $url ),
			'rel' => 'nofollow',
			'data-ajaxify' => true,
			'data-ajaxify-options' => json_encode( array(
				'wrapper' => '.lqd-lp-grid' . $ajax_wrapper . ' > .lqd-lp-row',
				'items'   => '> .lqd-lp-column',
				'trigger' => $ajax_trigger,
			) )
		);

		echo '<div class="liquid-pf-nav ld-pf-nav-ajax"><div class="page-nav text-center"><nav aria-label="' . esc_attr__( 'Page navigation', 'landinghub-core' ) . '">';
		switch( $atts['pagination'] ) {

			case 'ajax':
				$ajax_text = ! empty( $atts['ajax_text'] ) ? esc_html( $atts['ajax_text'] ) : esc_html__( 'Load more', 'landinghub-core' );
				$attributes['class'] = 'ld-ajax-loadmore';
				printf( '<a%2$s><span><span class="static">%1$s</span><span class="loading"><span class="dots"><span></span><span></span><span></span></span><span class="text-uppercase lts-sp-1">' . esc_html__( 'Loading', 'landinghub-core' ) . '</span></span><span class="all-loaded">' . esc_html__( 'All items loaded', 'landinghub-core' ) . ' <i class="lqd-icn-ess icon-ion-ios-checkmark"></i></span></span></a>', $ajax_text, ld_helper()->html_attributes( $attributes ), $url );
				break;
		}

		echo '</nav></div></div>';
	}

	wp_reset_query();

echo '</div><!--/ .lqd-lp-grid -->';