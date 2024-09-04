<?php
/**
 * Post Type: Footer
 * Register Custom Post Type
 */
$labels = array(
	'name'                => esc_html_x( 'Footers', 'Post Type General Name', 'landinghub-core' ),
	'singular_name'       => esc_html_x( 'Footer', 'Post Type Singular Name', 'landinghub-core' ),
	'all_items'           => esc_html__( 'Footers', 'landinghub-core' ),
	'name_admin_bar'      => esc_html__( 'Footers', 'landinghub-core' ),
	'add_new_item'        => esc_html__( 'Add New Footer', 'landinghub-core' ),
	'new_item'            => esc_html__( 'New Footer', 'landinghub-core' ),
	'edit_item'           => esc_html__( 'Edit Footer', 'landinghub-core' ),
	'update_item'         => esc_html__( 'Update Footer', 'landinghub-core' ),
	'view_item'           => esc_html__( 'View Footer', 'landinghub-core' ),
	'search_items'        => esc_html__( 'Search Footer', 'landinghub-core' ),
);
$args = array(
	'label'               => esc_html__( 'Footer', 'landinghub-core' ),
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
register_post_type( 'liquid-footer', $args );
