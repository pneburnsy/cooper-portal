<?php
	
// check
if( !liquid_helper()->is_woocommerce_active() ) {
	return;
}


extract( $atts );

$this->generate_css();

// Enqueue Conditional Script
$this->scripts();

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

$products_query = new WP_Query( $args );

if( !$products_query->have_posts() ) {
	return '';
}

?>
<div class="woocommerce lqd-prods-wrap lqd-prods-masonry" data-gap="<?php echo $columns_gap ?>">
	<div class="lqd-prods">
		<?php
			if( 'yes' === $atts['show_filter'] ) {
				$filter_located = vc_shortcodes_theme_templates_dir( 'woo-products-list/partial-filters.php' );
				include $filter_located;
			}
		?>
		<div
		class="lqd-prods-row row d-flex flex-wrap"
		id="<?php echo $this->get_id() ?>"
		data-liquid-masonry="true"
		data-masonry-options='{ "itemSelector": ".lqd-prod-item", "filtersID": "#<?php echo $filter_id ?>" }'>
			
			<?php
				
				woocommerce_product_loop_start();

				$posts_sz = count( $products_query->posts );
				if( $limit > $posts_sz ) {
					$all = $posts_sz;
				} else {
					$all = $limit;
				}
			?>

			<?php

				while ( $products_query->have_posts() ) :

					$products_query->the_post();
					$product = new WC_Product( get_the_ID() );
			?>		
			<?php

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
					
			?>
			<?php
				endwhile; // end of the loop.
				
				wp_reset_postdata();
				
				woocommerce_product_loop_end();
					
				remove_filter('posts_clauses', 'liquid_woocommerce_order_by_popularity_post_clauses');
				remove_filter('posts_clauses', 'liquid_woocommerce_order_by_rating_post_clauses');
				
				//liquid_woocommerce_product_styles( $style );

			?>
		</div><!-- .lqd-prods-row -->
	</div><!-- /.lqe-prods d-flex -->
</div><!-- /.lqd-prods-wrap -->