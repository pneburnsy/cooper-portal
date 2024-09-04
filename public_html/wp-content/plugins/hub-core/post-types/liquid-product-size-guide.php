<?php

/**
 * Post Type: Size Guide
 * Register Custom Post Type
 */

$labels = array(
	'name'                => esc_html__( 'Size Guide', 'landinghub-core' ),
	'singular_name'       => esc_html__( 'Size Guide', 'landinghub-core' ),
	'all_items'           => esc_html__( 'Product Size Guide', 'landinghub-core' ),
	'name_admin_bar'      => esc_html__( 'Product Size Guide', 'landinghub-core' ),
	'add_new_item'        => esc_html__( 'Add New Product Size Guide', 'landinghub-core' ),
	'new_item'            => esc_html__( 'New Product Size Guide', 'landinghub-core' ),
	'edit_item'           => esc_html__( 'Edit Product Size Guide', 'landinghub-core' ),
	'update_item'         => esc_html__( 'Update Product Size Guide', 'landinghub-core' ),
	'view_item'           => esc_html__( 'View Product Size Guide', 'landinghub-core' ),
	'search_items'        => esc_html__( 'Search Product Size Guide', 'landinghub-core' ),
);
$args = array(
	'label'               => esc_html__( 'Size Guide', 'landinghub-core' ),
	'labels'              => $labels,
	'supports'            => array( 'title', 'editor', 'revisions', ),
	'public'              => true,
	'has_archive'         => false,
	'hierarchical'        => true,
	'exclude_from_search' => true,
	'capability_type'     => 'page',
	'show_in_menu'        => 'liquid-templates-library',
);
register_post_type( 'ld-product-sizeguide', $args );
