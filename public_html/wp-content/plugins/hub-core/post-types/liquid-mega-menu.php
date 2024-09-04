<?php

/**
 * Post Type: Mega Menu
 * Register Custom Post Type
 */

 $labels = array(
	'name'                => esc_html_x( 'Mega Menus', 'Post Type General Name', 'landinghub-core' ),
	'singular_name'       => esc_html_x( 'Mega Menu', 'Post Type Singular Name', 'landinghub-core' ),
	'all_items'           => esc_html__( 'Mega Menus', 'landinghub-core' ),
	'name_admin_bar'      => esc_html__( 'Mega Menus', 'landinghub-core' ),
	'add_new_item'        => esc_html__( 'Add New Mega Menu', 'landinghub-core' ),
	'new_item'            => esc_html__( 'New Mega Menu', 'landinghub-core' ),
	'edit_item'           => esc_html__( 'Edit Mega Menu', 'landinghub-core' ),
	'update_item'         => esc_html__( 'Update Mega Menu', 'landinghub-core' ),
	'view_item'           => esc_html__( 'View Mega Menu', 'landinghub-core' ),
	'search_items'        => esc_html__( 'Search Mega Menu', 'landinghub-core' ),
);
$args = array(
	'label'               => esc_html__( 'Mega Menu', 'landinghub-core' ),
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
register_post_type( 'liquid-mega-menu', $args );
