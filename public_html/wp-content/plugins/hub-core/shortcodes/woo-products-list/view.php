<?php
	
// check
if( !liquid_helper()->is_woocommerce_active() ) {
	return;
}

// Enqueue Conditional Script
$this->scripts();

extract( $atts );

$this->generate_css();

global $wpdb, $product;


add_filter( 'liquid_product_lists_classnames', array( $this, 'add_ul_classname' ) );
add_filter( 'post_class', array( $this, 'add_product_classname' ) );
add_filter( 'post_class', array( $this, 'get_grid_class' ) );
$this->enable_gallery();

$style = liquid_helper()->get_option( 'wc-archive-product-style' );

//query args
$args = array(
	'posts_per_page' => intval( $limit ) ? intval( $limit ) : 12,
	'post_type'      => 'product',
	'post_status'    => 'publish',
);

if ( $taxonomies ) {

	$cats_tax = explode( ',', $taxonomies );
	if ( is_array( $cats_tax ) && count( $cats_tax ) == 1 ) {
		$cats_tax = array_shift( $cats_tax );
	}
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'product_cat',
			'field'    => 'slug',
			'terms'    => $cats_tax
		)
	);
}

$args['meta_query']   = array();
$args['meta_query'][] = WC()->query->stock_status_meta_query();
$args['meta_query']   = array_filter( $args['meta_query'] );

// default - menu_order
$args['orderby'] = 'menu_order title';
$args['order'] = $order == 'DESC' ? 'DESC' : 'ASC';
$args['meta_key'] = '';

switch ( $orderby ) {
	case 'rand' :
		$args['orderby'] = 'rand';
	break;
	case 'date' :
		$args['orderby'] = 'date';
		$args['order'] = $order == 'ASC' ? 'ASC' : 'DESC';
	break;
	case 'price' :
		$args['orderby'] = "meta_value_num {$wpdb->posts}.ID";
		$args['order'] = $order == 'DESC' ? 'DESC' : 'ASC';
		$args['meta_key'] = '_price';
	break;
	case 'popularity' :
		$args['meta_key'] = 'total_sales';
		// Sorting handled later though a hook
		add_filter('posts_clauses', 'liquid_woocommerce_order_by_popularity_post_clauses');
	break;
	case 'rating' :
		// Sorting handled later though a hook
		add_filter('posts_clauses', 'liquid_woocommerce_order_by_rating_post_clauses');
	break;
	case 'title' :
		$args['orderby'] = 'title';
		$args['order'] = $order == 'DESC' ? 'DESC' : 'ASC';
	break;
}

switch ( $show ) {
	case 'featured' :
		$args['meta_query'][] = array(
			'key'   => '_featured',
			'value' => 'yes'
		);
	break;
	case 'onsale' :
		$product_ids_on_sale   = wc_get_product_ids_on_sale();
		$product_ids_on_sale[] = 0;
		$args['post__in']      = $product_ids_on_sale;
	break;
}

$prods_classnames = array( 
	'lqd-prods',
	$el_class, 
	$this->get_id() 
);

$columns  = '3';
$classes  = '';
$products = $this->get_query_results();

ob_start();

if ( $products && $products->ids ) {
	// Prime caches to reduce future queries.
	if ( is_callable( '_prime_post_caches' ) ) {
		_prime_post_caches( $products->ids );
	}

	// Setup the loop.
	wc_setup_loop(
		array(
			'columns'      => $columns,
			'name'         => $this->type,
			'is_shortcode' => true,
			'is_search'    => false,
			'is_paginated' => true,
			'total'        => $products->total,
			'total_pages'  => $products->total_pages,
			'per_page'     => $products->per_page,
			'current_page' => $products->current_page,
		)
	);

	$original_post = $GLOBALS['post'];

	do_action( "woocommerce_shortcode_before_{$this->type}_loop", $this->attributes );

	// Fire standard shop loop hooks when paginating results so we can show result counts and so on.
/*
	if ( wc_string_to_bool( $this->attributes['paginate'] ) ) {
		do_action( 'woocommerce_before_shop_loop' );
	}
*/

	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		foreach ( $products->ids as $product_id ) {
			$GLOBALS['post'] = get_post( $product_id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			setup_postdata( $GLOBALS['post'] );

			// Set custom product visibility when quering hidden products.
			add_action( 'woocommerce_product_is_visible', array( $this, 'set_product_as_visible' ) );

			// Render product template.
			if( function_exists( 'wc_get_template' ) ) { 
		
				if( 'minimal' === $style || 'minimal-2' === $style ) {
					wc_get_template_part( 'content', 'product-minimal' );
				}
				elseif( 'minimal-hover-shadow' === $style ) {
					wc_get_template_part( 'content', 'product-minimal-hover-shadow' );
				}
				elseif( 'minimal-hover-shadow-2' === $style ) {
					wc_get_template_part( 'content', 'product-minimal-hover-shadow-2' );				
				}
				elseif( 'classic' === $style || 'classic-alt' === $style ) {
					wc_get_template_part( 'content', 'product-classic' );
				}
				else {
					wc_get_template_part( 'content', 'product' );
				}
			}

			// Restore product visibility.
			remove_action( 'woocommerce_product_is_visible', array( $this, 'set_product_as_visible' ) );
		}
	}

	$GLOBALS['post'] = $original_post; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
	woocommerce_product_loop_end();

	// Fire standard shop loop hooks when paginating results so we can show result counts and so on.
	if( 'pagination' === $atts['pagination'] ) {
		do_action( 'woocommerce_after_shop_loop' );
	}
	if( in_array( $atts['pagination'], array( 'ajax' ) ) ) {
		
		global $wp;
		$current_url = home_url( add_query_arg( array(), $wp->request ) );
		
		if( ( $products->current_page + 1 ) <= $products->total_pages ) {
			$next_page_url = $products->current_page + 1;
		}
		else {
			$next_page_url = $products->current_page;
		}
		$url = $current_url . '/?product-page=' . $next_page_url . '';
		
		$hash = array(
			'ajax' => 'btn btn-md ajax-load-more',
		);

		$attributes = array(
			'href' => add_query_arg( 'ajaxify', '1', $url ),
			'rel' => 'nofollow',
			'data-ajaxify' => true,
			'data-ajaxify-options' => json_encode( array(
				'wrapper' => '.woocommerce .lqd-prods-row',
				'items'   => '> .lqd-prod-item',
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

	do_action( "woocommerce_shortcode_after_{$this->type}_loop", $this->attributes );

	wp_reset_postdata();
	wc_reset_loop();
} else {
	do_action( "woocommerce_shortcode_{$this->type}_loop_no_results", $this->attributes );
}

echo '<div class="woocommerce">' . ob_get_clean() . '</div>';
