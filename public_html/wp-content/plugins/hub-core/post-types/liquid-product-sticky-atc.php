<?php

/**
 * Post Type: Size Guide
 * Register Custom Post Type
 */

$labels = array(
	'name'                => esc_html__( 'Sticky Add to Cart', 'landinghub-core' ),
	'singular_name'       => esc_html__( 'Sticky Add to Cart', 'landinghub-core' ),
	'all_items'           => esc_html__( 'Product Sticky Add to Cart', 'landinghub-core' ),
	'name_admin_bar'      => esc_html__( 'Product Sticky Add to Cart', 'landinghub-core' ),
	'add_new_item'        => esc_html__( 'Add New Product Sticky Add to Cart', 'landinghub-core' ),
	'new_item'            => esc_html__( 'New Product Sticky Add to Cart', 'landinghub-core' ),
	'edit_item'           => esc_html__( 'Edit Product Sticky Add to Cart', 'landinghub-core' ),
	'update_item'         => esc_html__( 'Update Product Sticky Add to Cart', 'landinghub-core' ),
	'view_item'           => esc_html__( 'View Product Sticky Add to Cart', 'landinghub-core' ),
	'search_items'        => esc_html__( 'Search Product Sticky Add to Cart', 'landinghub-core' ),
);
$args = array(
	'label'               => esc_html__( 'Sticky Add to Cart', 'landinghub-core' ),
	'labels'              => $labels,
	'supports'            => array( 'title', 'editor', 'revisions', ),
	'public'              => true,
	'has_archive'         => false,
	'hierarchical'        => true,
	'exclude_from_search' => true,
	'capability_type'     => 'page',
	'show_in_menu'        => 'liquid-templates-library',
);
register_post_type( 'liquid-sticky-atc', $args );
