<?php
/*
 * Post
*/

// Audio
$sections[] = array(
	'separate_box' => true,
	'box_title'    => esc_html__( 'Audio', 'hub' ),
	'post_types'   => array( 'post', 'liquid-portfolio' ),
	'post_format'  => array( 'audio' ),
	'icon'         => 'el-icon-screen',
	'fields' => array(

		array(
			'id' => 'post-audio',
			'type' => 'text',
			'title' => esc_html__( 'Audio URL', 'hub' ),
			'desc' => esc_html__( 'Audio file URL in format: mp3, ogg, wav.', 'hub' )
		)
	)
);

// Gallery
$sections[] = array(
	'separate_box' => true,
	'box_title'    => esc_html__( 'Gallery', 'hub' ),
	'post_types'   => array( 'post', 'liquid-portfolio' ),
	'post_format'  => array( 'gallery' ),
	'icon'         => 'el-icon-screen',
	'fields' => array(
		array(
			'id'        => 'post-gallery-ids',
			'type'      => 'gallery',
			'title'     => esc_html__( 'Gallery Slider', 'hub' ),
			'subtitle'  => esc_html__( 'Upload images or add from media library.', 'hub' ),
		)
	)
);

// Link
$sections[] = array(
	'separate_box' => true,
	'box_title'    => esc_html__( 'Link', 'hub' ),
	'post_types' => array( 'post' ),
	'post_format' => array( 'link' ),
	'icon' => 'el-icon-screen',
	'fields' => array(

		array(
			'id'        => 'post-link-url',
			'type'      => 'text',
			'title'     => esc_html__( 'URL', 'hub' )
		)
	)
);

// Quote
$sections[] = array(
	'separate_box' => true,
	'box_title'    => esc_html__( 'Quote', 'hub' ),
	'post_types' => array( 'post' ),
	'post_format' => array( 'quote' ),
	'icon' => 'el-icon-screen',
	'fields' => array(
		array(
			'id'        => 'post-quote-url',
			'type'      => 'text',
			'title'     => esc_html__( 'Cite', 'hub' )
		)
	)
);

// Video
$sections[] = array(
	'separate_box' => true,
	'box_title'    => esc_html__( 'Video', 'hub' ),
	'post_types' => array( 'post' ),
	'post_format' => array( 'video' ),
	'icon' => 'el-icon-screen',
	'fields' => array(

		array(
			'id'        => 'post-video-url',
			'type'      => 'text',
			'title'     => esc_html__( 'Video URL', 'hub' ),
			'desc'  => esc_html__( 'YouTube or Vimeo video URL', 'hub' )
		),

		array(
			'id'        => 'post-video-file',
			'type'      => 'editor',
			'title'     => esc_html__( 'Video Upload', 'hub' ),
			'desc'  => esc_html__( 'Upload video file', 'hub' )
		),

		array(
			'id'        => 'post-video-html',
			'type'      => 'textarea',
			'title'     => esc_html__( 'Embadded video', 'hub' ),
			'desc'  => esc_html__( 'Use this option when the video does not come from YouTube or Vimeo', 'hub' )
		)
	)
);
