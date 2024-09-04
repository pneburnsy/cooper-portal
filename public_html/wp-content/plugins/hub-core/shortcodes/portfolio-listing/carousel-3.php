<?php	

$style = $atts['style'];
$filter_id = $atts['filter_id'];

// Locate the template and check if exists.
$located = locate_template( array(
	"templates/portfolio/tmpl-style05.php"
) );
if ( ! $located ) {
	return;
}

// Build Query and check for posts
$the_query = new WP_Query( $this->build_query() );
if( !$the_query->have_posts() ) {
	return;
}

$this->grid_id = $grid_id = uniqid( 'grid-');

// Enqueue Conditional Script
$this->scripts();

// The CSS
$this->generate_css();

//Container 

	echo '<div class="lqd-pf-carousel carousel-container carousel-nav-floated carousel-nav-center carousel-nav-middle carousel-nav-circle carousel-nav-solid carousel-nav-lg carousel-nav-shadowed carousel-dots-mobile-inside ' . $this->get_id() . '" ' . $this->get_options() . '>';
	echo '<div class="row">';
	
		// Include filter
	if( 'yes' === $atts['show_filter'] ) {
		$filter_located = locate_template( 'templates/portfolio/partial-filters.php' );
		include $filter_located;
	}

	echo '<div class="col-xs-12">';
	echo '<div class="carousel-items row mx-0" data-lqd-flickity=\'{ "filters": "#' . $filter_id . '", "filtersCounter": true, "wrapAround": true, "groupCells": false, "prevNextButtons": true, "navOffsets": { "prev": 15, "next": 15 }, "prevNextButtonsOnlyOnMobile": true }\'>';
	
	// Build Query
	$GLOBALS['wp_query'] = $the_query;
	$before = $after = '';
	

	$this->add_excerpt_hooks();

	while( have_posts() ): the_post();

		$post_classes = array( 'lqd-pf-item', $this->get_item_classes() );		
		$post_classes = join( ' ', get_post_class( $post_classes, get_the_ID() ) );

		$attributes = array(
			'id' => 'post-' . get_the_ID(),
			'class' => $post_classes
		);

		echo $before;

			include $located;

		echo $after;

	endwhile;

	$this->remove_excerpt_hooks();

	wp_reset_query();

	echo '</div></div>';
	echo '</div><!-- /.carousel-items -->';
echo '</div><!-- /.carousel-container -->';