<?php
/*
 * Page 404
*/

$this->sections[] = array (
	'title'  => esc_html__( 'Search Page', 'hub' ),
	'icon'   => 'el el-search',
	'fields' => array(

		array(
			'id'       => 'search-header-template',
			'type'     => 'select',
			'title'    => esc_html__( 'Search Page Header', 'hub' ),
			'subtitle' => esc_html__( 'Choose a header for search result pages.', 'hub'),
			'data'     => 'post',
			'args'     => array( 
				'post_type'      => 'liquid-header', 
				'posts_per_page' => -1 
			)
		),
		array(
			'id'       => 'search-title-bar-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Search Page Title', 'hub' ),
			'subtitle' => esc_html__( 'Switch on to display the titlebar for the search result pages.', 'hub' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'hub' ),
				'off'  => esc_html__( 'Off', 'hub' )
			),
			'default'  => 'on'
		),
		array(
			'id'       => 'search-title-bar-subheading',
			'type'	   => 'text',
			'title'    => esc_html__( 'Search Page Subtitle', 'hub' ),
			'subtitle' => esc_html__( 'Define a default subtitle for the search result pages.', 'hub' )
		),
		array(
			'id'      => 'search-blog-style',
			'type'    => 'select',
			'title'   => esc_html__( 'Style', 'hub' ),
			'options' => array(
				'style01' => esc_html__( 'Style 1', 'hub' ),
				'style02' => esc_html__( 'Style 2', 'hub' ),
				'style02-alt' => esc_html__( 'Style 2 Alt', 'hub' ),
				'style03' => esc_html__( 'Style 3', 'hub' ),
				'style04' => esc_html__( 'Style 4', 'hub' ),
				'style05' => esc_html__( 'Style 5', 'hub' ),
				'style06' => esc_html__( 'Style 6', 'hub' ),
				'style07' => esc_html__( 'Style 7', 'hub' ),
				'style08' => esc_html__( 'Style 8', 'hub' ),
				'style09' => esc_html__( 'Style 9', 'hub' ),
				'style10' => esc_html__( 'Style 10', 'hub' ),
				'style11' => esc_html__( 'Style 11', 'hub' ),
				'style12' => esc_html__( 'Style 12', 'hub' ),
				'style13' => esc_html__( 'Style 13', 'hub' ),
				'style14' => esc_html__( 'Style 14', 'hub' ),
				'style15' => esc_html__( 'Style 15', 'hub' ),
				'style16' => esc_html__( 'Style 16', 'hub' ),
				'style17' => esc_html__( 'Style 17', 'hub' ),
				'style18' => esc_html__( 'Style 18', 'hub' ),
				'style19' => esc_html__( 'Style 19', 'hub' ),
				'style20' => esc_html__( 'Style 20', 'hub' ),
				'style21' => esc_html__( 'Style 21', 'hub' ),
				'style22' => esc_html__( 'Style 22', 'hub' ),
				'style22-alt' => esc_html__( 'Style 22 Alt', 'hub' ),
				'style23' => esc_html__( 'Style 23', 'hub' ),
			),
			'subtitle' => esc_html__( 'Select content type for your grid.', 'hub' ),
			'default'  => 'style22'
		),
		array(
			'id'      => 'blog-search-columns',
			'type'    => 'select',
			'title'   => esc_html__( 'Columns', 'hub' ),
			'options' => array(
				'1'       => esc_html__( '1 Column', 'hub' ),
				'2'       => esc_html__( '2 Columns', 'hub' ),
				'3'       => esc_html__( '3 Columns', 'hub' ),
				'4'       => esc_html__( '4 Columns', 'hub' ),
			),
			'subtitle' => esc_html__( 'How many columns to show for your blog category page.', 'hub' ),
			'default'  => '1'
		),
		array(
			'id'    => 'search-blog-show-meta',
			'type'  => 'select',
			'title' => esc_html__( 'Meta', 'hub' ),
			'options' => array(
				'yes' => esc_html__( 'Yes', 'hub' ),
				'no' => esc_html__( 'No', 'hub' ),
			),
			'subtitle' => esc_html__( 'Manage the meta for posts', 'hub' ),
			'default'  => 'yes'
		),
		array(
			'id'    => 'search-blog-meta-type',
			'type'  => 'select',
			'title' => esc_html__( 'Meta Type', 'hub' ),
			'options' => array(
				'tags' => esc_html__( 'Tags', 'hub' ),
				'cats' => esc_html__( 'Categories', 'hub' ),
			),
			'subtitle' => esc_html__( 'Manage the meta type for posts', 'hub' ),
			'default'  => 'tags',
			'required' => array(
				'search-blog-show-meta',
				'equals',
				'yes'
			)
		),
		array(
			'id'    => 'search-blog-one-category',
			'type'	=> 'button_set',
			'title' => esc_html__( 'Single Category', 'hub' ),
			'options' => array(
				'yes' => esc_html__( 'Yes', 'hub' ),
				'no' => esc_html__( 'No', 'hub' ),
			),
			'default'  => 'yes',
			'required' => array(
				'search-blog-meta-type',
				'equals',
				'cats'
			)	
		),
		array(
			'id'       => 'search-blog-excerpt-length',
			'type'     => 'text',
			'title'    => esc_html__( 'Default Blog Excerpt Length', 'hub' ),
			'validate' => 'numeric',
			'default'  => '20',
		),
		
	)
);
