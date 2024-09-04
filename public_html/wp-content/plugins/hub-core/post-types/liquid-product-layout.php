<?php

/**
 * Post Type: Product Layout
 * Register Custom Post Type
 */

$labels = array(
	'name'                => esc_html__( 'Product Layout', 'landinghub-core' ),
	'singular_name'       => esc_html__( 'Product Layout', 'landinghub-core' ),
	'name_admin_bar'      => esc_html__( 'Product Layout', 'landinghub-core' ),
	'add_new_item'        => esc_html__( 'Add New Product Layout', 'landinghub-core' ),
	'new_item'            => esc_html__( 'New Product Layout', 'landinghub-core' ),
	'edit_item'           => esc_html__( 'Edit Product Layout', 'landinghub-core' ),
	'update_item'         => esc_html__( 'Update Product Layout', 'landinghub-core' ),
	'view_item'           => esc_html__( 'View Product Layout', 'landinghub-core' ),
	'search_items'        => esc_html__( 'Search Product Layout', 'landinghub-core' ),
);
$args = array(
	'label'               => esc_html__( 'Product Layout', 'landinghub-core' ),
	'labels'              => $labels,
	'supports'            => array( 'title', 'editor', 'revisions', ),
	'hierarchical'        => false,
	'public'              => true,
	'show_ui'             => true,
	'show_in_menu'        => 'liquid-templates-library',
	'menu_position'       => 25,
	'menu_icon'           => 'dashicons-align-center',
	'show_in_admin_bar'   => true,
	'show_in_nav_menus'   => false,
	'can_export'          => true,
	'has_archive'         => false,
	'exclude_from_search' => true,
	'publicly_queryable'  => true,
	'rewrite'             => false,
	'capability_type'     => 'page',
);
register_post_type( 'ld-product-layout', $args );
