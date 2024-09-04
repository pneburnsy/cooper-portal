<?php 
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Hub
 * @since 1.0
 */

get_header();

	if ( have_posts() ) {
		get_template_part( 'templates/search', 'layout' );
	} else {
		get_template_part( 'templates/content/error' );
	}

get_footer();