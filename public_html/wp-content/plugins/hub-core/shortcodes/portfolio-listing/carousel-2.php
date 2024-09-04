<?php	

$style = $atts['style'];
$filter_id = $atts['filter_id'];

// Locate the template and check if exists.
$located = locate_template( array(
	"templates/portfolio/tmpl-style04.php"
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

	echo '<div class="carousel-container carousel-nav-floated carousel-nav-bottom carousel-nav-left carousel-nav-square carousel-nav-solid carousel-nav-lg carousel-nav-shadowed lqd-pf-filterable-carousel ' . $this->get_id() . '" ' . $this->get_options() . '>';
	echo '<div class="row d-flex flex-wrap align-items-center">';
	
		// Include filter
	if( 'yes' === $atts['show_filter'] ) {
		$filter_located = locate_template( 'templates/portfolio/partial-filters-carousel.php' );
		include $filter_located;
		echo '<div class="col-md-8 col-xs-12">';
	}
	else {
		echo '<div class="col-xs-12">';
	}
	
	echo '<div class="carousel-items row" data-lqd-flickity=\'{ "filters": "#' . $filter_id . '", "filtersCounter": true, "doSomethingCrazyWithFilters": true, "prevNextButtons": true, "navArrow": 6, "fullwidthSide": true, "navOffsets": { "nav": {"bottom": "110px", "left": "65px", "right": "auto"} } }\'>';
	
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