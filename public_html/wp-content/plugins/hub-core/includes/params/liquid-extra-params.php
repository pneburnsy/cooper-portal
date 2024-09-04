<?php
function liquid_section_parameters() {

	vc_remove_param( 'vc_section', 'css' );
	vc_remove_param( 'vc_section', 'full_width' );

	vc_remove_param( 'vc_section', 'parallax' );	
	vc_remove_param( 'vc_section', 'parallax_image' );
	vc_remove_param( 'vc_section', 'video_bg_parallax' );
	vc_remove_param( 'vc_section', 'parallax_speed_bg' );
	vc_remove_param( 'vc_section', 'parallax_speed_video' );
	//vc_remove_param( 'vc_section', 'video_bg' );
	//vc_remove_param( 'vc_section', 'video_bg_url' );



	vc_add_param( 'vc_section', array(
			'type'       => 'responsive_css_editor',
			'heading'    => esc_html__( 'Responsive CSS Box', 'landinghub-core' ),
			'param_name' => 'responsive_css',
			'group'      => esc_html__( 'Design Options', 'landinghub-core' ),
		)
	);

	vc_add_param( 'vc_section', array(
			'type'        => 'css_editor',
			'heading'     => esc_html__( 'CSS box', 'landinghub-core' ),
			'param_name'  => 'css',
			'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
		)
	);
	
	vc_add_params( 'vc_section', array(
			array(
				'type' => 'dropdown',
				'param_name' => 'bg_position',
				'heading' => esc_html__( 'Background Position', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Default', 'landinghub-core' )         => '',
					esc_html__( 'Center Bottom', 'landinghub-core' )   => 'center bottom',
					esc_html__( 'Center Center', 'landinghub-core' )   => 'center center',
					esc_html__( 'Center Top', 'landinghub-core' )      => 'center top',
					esc_html__( 'Left Bottom', 'landinghub-core' )     => 'left bottom',
					esc_html__( 'Left Center', 'landinghub-core' )     => 'left center',
					esc_html__( 'Left Top', 'landinghub-core' )        => 'left top',
					esc_html__( 'Right Bottom', 'landinghub-core' )    => 'right bottom',
					esc_html__( 'Right Center', 'landinghub-core' )    => 'right center',
					esc_html__( 'Right Top', 'landinghub-core' )       => 'right top',
					esc_html__( 'Custom Position', 'landinghub-core' ) => 'custom',
				),
				// 'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
			),
			array(
				'type'             => 'textfield',
				'param_name'       => 'bg_pos_h',
				'heading'          => esc_html__( 'Horizontal Position', 'landinghub-core' ),
				'description'      => esc_html__( 'Enter custom horizontal position in px or %', 'landinghub-core' ),
				'group'            => esc_html__( 'Design Options', 'landinghub-core' ),
				// 'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'bg_position',
					'value'   => 'custom'
				)
			),
			array(
				'type'             => 'textfield',
				'param_name'       => 'bg_pos_v',
				'heading'          => esc_html__( 'Vertical Position', 'landinghub-core' ),
				'description'      => esc_html__( 'Enter custom vertical position in px or %', 'landinghub-core' ),
				'group'            => esc_html__( 'Design Options', 'landinghub-core' ),
				// 'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'bg_position',
					'value'   => 'custom'
				)
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'bg_attachment',
				'heading'    => esc_html__( 'Background Attachment', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Default', 'landinghub-core' ) => 'scroll',
					esc_html__( 'Fixed', 'landinghub-core' )   => 'fixed',
					esc_html__( 'Inherit', 'landinghub-core' ) => 'inherit',
				),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
				// 'edit_field_class' => 'vc_col-sm-6',
			),
		) 
	);
	
	vc_update_shortcode_param( 'vc_section',  array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Full height section?', 'js_composer' ),
			'param_name' => 'full_height',
			'description' => esc_html__( 'If checked section will be set to full height.', 'js_composer' ),
			'value' => array( esc_html__( 'Yes', 'js_composer' ) => 'yes' ),
			'weight'      => 1,
		)
	);
	vc_update_shortcode_param( 'vc_section', array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Content position', 'js_composer' ),
			'param_name' => 'content_placement',
			'value' => array(
				esc_html__( 'Default', 'js_composer' ) => '',
				esc_html__( 'Top', 'js_composer' ) => 'top',
				esc_html__( 'Middle', 'js_composer' ) => 'middle',
				esc_html__( 'Bottom', 'js_composer' ) => 'bottom',
			),
			'description' => esc_html__( 'Select content position within section.', 'js_composer' ),
			'weight'      => 1,
		)
	);
	vc_update_shortcode_param( 'vc_section', array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Use video background?', 'landinghub-core' ),
			'param_name'  => 'video_bg',
			'description' => esc_html__( 'If checked, video will be used as row background.', 'landinghub-core' ),
			'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			'weight'      => 1,
		)
	);

	vc_add_params( 'vc_section', array(
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Disable Video Background for Mobile ', 'landinghub-core' ),
				'param_name'  => 'mobile_video_bg',
				'description' => esc_html__( 'If checked, video will be disabled for mobile devices', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'dependency'  => array(
					'element'   => 'video_bg',
					'not_empty' => true,
				),
				'weight'      => 1,
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Video Background Source', 'landinghub-core' ),
				'param_name' => 'video_bg_source',
				'value'      => array(
					esc_html__( 'Local', 'landinghub-core' )   => 'local',
					esc_html__( 'Youtube', 'landinghub-core' ) => 'youtube',
				),
				'dependency'  => array(
					'element'   => 'video_bg',
					'not_empty' => true,
				),
				'weight'        => 1,
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'MP4 Video Path', 'landinghub-core' ),
				'param_name'  => 'video_local_mp4_url',
				'value'       => '',
				// default video url
				'description' => esc_html__( 'Add local video path in mp4 format', 'landinghub-core' ),
				'dependency'  => array(
					'element'   => 'video_bg_source',
					'value' => 'local',
				),
				'weight'        => 1,
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'WEBM Video Path', 'landinghub-core' ),
				'param_name'  => 'video_local_webm_url',
				'value'       => '',
				// default video url
				'description' => esc_html__( 'Add local video path in WEBM format', 'landinghub-core' ),
				'dependency'  => array(
					'element'   => 'video_bg_source',
					'value' => 'local',
				),
				'weight'        => 1,
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Loop?', 'landinghub-core' ),
				'param_name'  => 'video_loop',
				'description' => esc_html__( 'Loop video', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'weight'      => 1,
				'std'         => 'yes',
				'dependency'  => array(
					'element'   => 'video_bg',
					'not_empty' => true,
				),
			),

		) 
	);
	
	vc_update_shortcode_param( 'vc_section', array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'YouTube link', 'landinghub-core' ),
			'param_name'  => 'video_bg_url',
			'value'       => 'https://www.youtube.com/watch?v=lMJXxhRFO1k',
			// default video url
			'description' => esc_html__( 'Add YouTube link.', 'landinghub-core' ),
			'dependency'  => array(
				'element'   => 'video_bg_source',
				'value' => 'youtube',
			),
			'weight'        => 1,
		)
	);
	
	vc_add_params( 'vc_section', array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Start time', 'landinghub-core' ),
				'param_name'  => 'y_start_time',
				'value'       => '',
				// default video url
				'description' => esc_html__( 'Youtube video start time, for ex 0 ( in seconds )', 'landinghub-core' ),
				'dependency'  => array(
					'element'   => 'video_bg_source',
					'value' => 'youtube',
				),
				// 'edit_field_class' => 'vc_col-sm-6',
				'weight'        => 1,
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'End time', 'landinghub-core' ),
				'param_name'  => 'y_end_time',
				'value'       => '',
				// default video url
				'description' => esc_html__( 'Youtube video end time, for ex 120 ( in seconds )', 'landinghub-core' ),
				'dependency'  => array(
					'element'   => 'video_bg_source',
					'value' => 'youtube',
				),
				// 'edit_field_class' => 'vc_col-sm-6',
				'weight'        => 1,
			),

		) 
	);
	vc_update_shortcode_param( 'vc_section', array(
			'type'         => 'checkbox',
			'param_name'   => 'parallax',
			'heading'      => esc_html__( 'Parallax Background', 'landinghub-core' ),
			'description'  => esc_html__( 'Add parallax background image in "Design Options" or the video background', 'landinghub-core' ),
			'value'        => array( esc_html__( 'Yes', 'landinghub-core' ) => 'enable_parallax' ),
			'weight'       => 1,
		)
	);

	
}

add_action( 'vc_after_init', 'liquid_section_parameters' );

function liquid_row_extras() {
	
	vc_add_param( 'vc_section', array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Enable section scroll?', 'landinghub-core' ),
			'param_name'  => 'section_scroll',
			'description' => esc_html__( 'If checked, section scroll will be enabled.', 'landinghub-core' ),
			'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
		)
	);

	vc_remove_param( 'vc_row', 'css' );

	vc_remove_param( 'vc_row', 'parallax_image' );
	vc_remove_param( 'vc_row', 'parallax_speed_bg' );
	vc_remove_param( 'vc_row', 'video_bg_parallax' );
	vc_remove_param( 'vc_row', 'parallax_speed_video' );

	vc_remove_param( 'vc_row_inner', 'parallax_image' );
	vc_remove_param( 'vc_row_inner', 'parallax_speed_bg' );
	vc_remove_param( 'vc_row_inner', 'video_bg_parallax' );
	vc_remove_param( 'vc_row', 'parallax_speed_video' );

	vc_update_shortcode_param( 'vc_row', array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Row stretch', 'landinghub-core' ),
			'param_name' => 'full_width',
			'value'      => array(
				esc_html__( 'Default', 'landinghub-core' ) => '',
				esc_html__( 'Stretch row and content', 'landinghub-core' ) => 'stretch_row'
			),
			'description' => esc_html__( 'Select stretching options for row and content (Note: stretched may not work properly if parent container has "overflow: hidden" CSS property).', 'landinghub-core' ),
			'weight'      => 1,
		)
	);
	vc_update_shortcode_param( 'vc_row', array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Columns gap', 'landinghub-core' ),
			'param_name' => 'gap',
			'value' => array(
				'0px' => '0',
				'1px' => '1',
				'2px' => '2',
				'3px' => '3',
				'4px' => '4',
				'5px' => '5',
				'10px' => '10',
				'15px' => '15',
				'20px' => '20',
				'25px' => '25',
				'30px' => '30',
				'35px' => '35',
			),
			'std'         => '15',
			'description' => esc_html__( 'Select gap between columns in row.', 'landinghub-core' ),
			'weight'      => 1,
		)
	);
	vc_update_shortcode_param( 'vc_row_inner', array(
		'type'       => 'dropdown',
		'heading'    => esc_html__( 'Row stretch', 'landinghub-core' ),
		'param_name' => 'full_width',
		'value'      => array(
			esc_html__( 'Default', 'landinghub-core' ) => '',
			esc_html__( 'Stretch row and content', 'landinghub-core' ) => 'stretch_row'
		),
		'std' => 'stretch_row',
		'description' => esc_html__( 'Select stretching options for row and content (Note: stretched may not work properly if parent container has "overflow: hidden" CSS property).', 'landinghub-core' ),
		'weight'      => 1,
	)
);
	vc_update_shortcode_param( 'vc_row_inner', array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Columns gap', 'landinghub-core' ),
			'param_name' => 'gap',
			'value' => array(
				'0px' => '0',
				'1px' => '1',
				'2px' => '2',
				'3px' => '3',
				'4px' => '4',
				'5px' => '5',
				'10px' => '10',
				'15px' => '15',
				'20px' => '20',
				'25px' => '25',
				'30px' => '30',
				'35px' => '35',
			),
			'std'         => '15',
			'description' => esc_html__( 'Select gap between columns in row.', 'landinghub-core' ),
		)
	);
	vc_update_shortcode_param( 'vc_row', array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Full height row?', 'landinghub-core' ),
			'param_name'  => 'full_height',
			'description' => esc_html__( 'If checked row will be set to full height.', 'landinghub-core' ),
			'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			'weight'      => 1,
		)
	);
	vc_update_shortcode_param( 'vc_row', array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Columns position', 'landinghub-core' ),
			'param_name' => 'columns_placement',
			'value'      => array(
				esc_html__( 'Default', 'landinghub-core' )  => '',
				esc_html__( 'Middle', 'landinghub-core' )  => 'middle',
				esc_html__( 'Top', 'landinghub-core' )     => 'top',
				esc_html__( 'Bottom', 'landinghub-core' )  => 'bottom',
				esc_html__( 'Stretch', 'landinghub-core' ) => 'stretch',
			),
			'description' => esc_html__( 'Select columns position within row.', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'full_height',
				'not_empty' => true,
			),
			'weight' => 1,
		)
	);
	vc_update_shortcode_param( 'vc_row', array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Columns position', 'landinghub-core' ),
			'param_name' => 'stack_columns_placement',
			'value'      => array(
				esc_html__( 'Default', 'landinghub-core' )  => '',
				esc_html__( 'Middle', 'landinghub-core' )  => 'middle',
				esc_html__( 'Top', 'landinghub-core' )     => 'top',
				esc_html__( 'Bottom', 'landinghub-core' )  => 'bottom',
				esc_html__( 'Stretch', 'landinghub-core' ) => 'stretch',
			),
			'description' => esc_html__( 'Select columns position within row.', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'full_height',
				'is_empty' => true,
			),
			'weight' => 1,
		)
	);
	vc_update_shortcode_param( 'vc_row', array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Equal height', 'landinghub-core' ),
			'param_name'  => 'equal_height',
			'description' => esc_html__( 'If checked columns will be set to equal height.', 'landinghub-core' ),
			'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			'weight'      => 1,
		)
	);	
	vc_update_shortcode_param( 'vc_row', array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Content position', 'landinghub-core' ),
			'param_name' => 'content_placement',
			'value'      => array(
				esc_html__( 'Default', 'landinghub-core' ) => '',
				esc_html__( 'Top', 'landinghub-core' ) => 'top',
				esc_html__( 'Middle', 'landinghub-core' ) => 'middle',
				esc_html__( 'Bottom', 'landinghub-core' ) => 'bottom',
			),
			'description' => esc_html__( 'Select content position within columns.', 'landinghub-core' ),
			'weight'      => 1,
		)
	);
	vc_add_params( 'vc_row', array(
			array(
				'type'         => 'checkbox',
				'param_name'   => 'row_sticky_row',
				'heading'      => esc_html__( 'Sticky Row', 'landinghub-core' ),
				'description'  => esc_html__( 'Enable to make this row sticky', 'landinghub-core' ),
				'value'        => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'weight'       => 1,
			)		
		) 
	);
	vc_add_params( 'vc_row', array(
			array(
				'type'         => 'checkbox',
				'param_name'   => 'fade_scroll',
				'heading'      => esc_html__( 'Fade on scroll', 'landinghub-core' ),
				'description'  => esc_html__( 'Enable to make this row to fade on scroll', 'landinghub-core' ),
				'value'        => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'weight'       => 1,
			)		
		) 
	);
	vc_add_params( 'vc_row', array(
			array(
				'type'         => 'liquid_button_set',
				'param_name'   => 'luminosity',
				'heading'      => esc_html__( 'Luminosity', 'landinghub-core' ),
				'description'  => esc_html__( 'if it is set to automatic, row luminosity will be defined based on section background color.', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Automatic', 'landinghub-core' ) => 'default-auto',
					esc_html__( 'Dark', 'landinghub-core' )      => 'dark',
					esc_html__( 'Light', 'landinghub-core' )     => 'light',
				),
				'std' => 'default-auto',
				'weight'       => 1,
			)		
		) 
	);
	vc_update_shortcode_param( 'vc_row', array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Use video background?', 'landinghub-core' ),
			'param_name'  => 'video_bg',
			'description' => esc_html__( 'If checked, video will be used as row background.', 'landinghub-core' ),
			'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			'weight'      => 1,
		)
	);

	vc_add_params( 'vc_row', array(
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Disable Video Background for Mobile ', 'landinghub-core' ),
				'param_name'  => 'mobile_video_bg',
				'description' => esc_html__( 'If checked, video will be disabled for mobile devices', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'dependency'  => array(
					'element'   => 'video_bg',
					'not_empty' => true,
				),
				'weight'      => 1,
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Video Background Source', 'landinghub-core' ),
				'param_name' => 'video_bg_source',
				'value'      => array(
					esc_html__( 'Local', 'landinghub-core' )   => 'local',
					esc_html__( 'Youtube', 'landinghub-core' ) => 'youtube',
				),
				'dependency'  => array(
					'element'   => 'video_bg',
					'not_empty' => true,
				),
				'weight'        => 1,
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'MP4 Video Path', 'landinghub-core' ),
				'param_name'  => 'video_local_mp4_url',
				'value'       => '',
				// default video url
				'description' => esc_html__( 'Add local video path in mp4 format', 'landinghub-core' ),
				'dependency'  => array(
					'element'   => 'video_bg_source',
					'value' => 'local',
				),
				'weight'        => 1,
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'WEBM Video Path', 'landinghub-core' ),
				'param_name'  => 'video_local_webm_url',
				'value'       => '',
				// default video url
				'description' => esc_html__( 'Add local video path in WEBM format', 'landinghub-core' ),
				'dependency'  => array(
					'element'   => 'video_bg_source',
					'value' => 'local',
				),
				'weight'        => 1,
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Loop?', 'landinghub-core' ),
				'param_name'  => 'video_loop',
				'description' => esc_html__( 'Loop video.', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'weight'      => 1,
				'std'         => 'yes',
				'dependency'  => array(
					'element'   => 'video_bg',
					'not_empty' => true,
				),
			),

		) 
	);
	
	vc_update_shortcode_param( 'vc_row', array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'YouTube link', 'landinghub-core' ),
			'param_name'  => 'video_bg_url',
			'value'       => 'https://www.youtube.com/watch?v=lMJXxhRFO1k',
			// default video url
			'description' => esc_html__( 'Add YouTube link.', 'landinghub-core' ),
			'dependency'  => array(
				'element'   => 'video_bg_source',
				'value' => 'youtube',
			),
			'weight'        => 1,
		)
	);
	
	vc_add_params( 'vc_row', array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Start time', 'landinghub-core' ),
				'param_name'  => 'y_start_time',
				'value'       => '',
				// default video url
				'description' => esc_html__( 'Youtube video start time, for ex 0 ( in seconds )', 'landinghub-core' ),
				'dependency'  => array(
					'element'   => 'video_bg_source',
					'value' => 'youtube',
				),
				// 'edit_field_class' => 'vc_col-sm-6',
				'weight'        => 1,
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'End time', 'landinghub-core' ),
				'param_name'  => 'y_end_time',
				'value'       => '',
				// default video url
				'description' => esc_html__( 'Youtube video end time, for ex 120 ( in seconds )', 'landinghub-core' ),
				'dependency'  => array(
					'element'   => 'video_bg_source',
					'value' => 'youtube',
				),
				// 'edit_field_class' => 'vc_col-sm-6',
				'weight'        => 1,
			),

		) 
	);
	
	vc_add_params( 'vc_row', array(
			array(
				'type'         => 'checkbox',
				'param_name'   => 'row_sticky_bg',
				'heading'      => esc_html__( 'Sticky Background', 'landinghub-core' ),
				'description'  => esc_html__( 'Add background image in Design Options', 'landinghub-core' ),
				'value'        => array( esc_html__( 'Yes', 'landinghub-core' ) => 'enable_row_sticky_bg' ),
				'weight'       => 1,
			)		
		) 
	);
	vc_update_shortcode_param( 'vc_row', array(
			'type'         => 'checkbox',
			'param_name'   => 'parallax',
			'heading'      => esc_html__( 'Parallax Background', 'landinghub-core' ),
			'description'  => esc_html__( 'Add parallax background image in "Design Options" or the video background', 'landinghub-core' ),
			'value'        => array( esc_html__( 'Yes', 'landinghub-core' ) => 'enable_parallax' ),
			'weight'       => 1,
			'dependency'  => array(
				'element' => 'row_sticky_bg',
				'value_not_equal_to'   => 'enable_row_sticky_bg',
			),
		)
	);
	vc_add_params( 'vc_row', array(
			array(
				'type'         => 'checkbox',
				'param_name'   => 'shrink_borders',
				'heading'      => esc_html__( 'Borders Effect', 'landinghub-core' ),
				'description'  => esc_html__( 'Add border growing effects', 'landinghub-core' ),
				'value'        => array( esc_html__( 'Yes', 'landinghub-core' ) => 'enable_shrink_borders' ),
				'weight'       => 1,
				'dependency'  => array(
					'element' => 'row_sticky_bg',
					'value'   => 'enable_row_sticky_bg',
				),
			)		
		) 
	);

	$scale_bg_param = array (
		array(
			'type'         => 'checkbox',
			'param_name'   => 'row_scale_bg_onhover',
			'heading'      => esc_html__( 'Scale BG Image On Hover', 'landinghub-core' ),
			'description'  => esc_html__( 'Enables the scale effect for background image.', 'landinghub-core' ),
			'value'        => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			'weight'       => 1,
			'dependency'  => array(
				'element' => 'row_sticky_bg',
				'value_not_equal_to'   => 'enable_row_sticky_bg',
			),
		)		
	);
	
	$slideshow_bg_params = array(

		array(
			'type'        => 'checkbox',
			'param_name'  => 'enable_slideshow_bg',
			'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			'heading'     => esc_html__( 'Slideshow Background?', 'landinghub-core' ),
			'description' => esc_html__( 'Will enable slideshow background', 'landinghub-core' ),
			'weight'      => 1,
		),
		array(
			'type'        => 'textfield',
			'param_name'  => 'slideshow_delay',
			'heading'     => esc_html__( 'Slideshow Delay', 'landinghub-core' ),
			'description' => esc_html__( 'Add slideshow delay in milliseconds for ex. 200', 'landinghub-core' ),
			// 'edit_field_class' => 'vc_col-sm-6',
			'dependency'  => array(
				'element' => 'enable_slideshow_bg',
				'value'   => 'yes',
			),
			'weight'      => 1,	
		),
		array(
			'type'        => 'dropdown',
			'param_name'  => 'slideshow_effect',
			'heading'     => esc_html__( 'Slideshow Effect', 'landinghub-core' ),
			'description' => esc_html__( 'Select a slideshow effect', 'landinghub-core' ),
			'value'       => array(
				esc_html__( 'Fade (default)', 'landinghub-core' ) => '',
				esc_html__( 'Slide', 'landinghub-core' )   => 'slide',
				esc_html__( 'Scale', 'landinghub-core' )   => 'scale',
			),
			// 'edit_field_class' => 'vc_col-sm-6',
			'dependency'  => array(
				'element' => 'enable_slideshow_bg',
				'value'   => 'yes',
			),
			'weight'      => 1,	
		),
		array(
			'type'        => 'attach_images',
			'heading'     => esc_html__( 'Images', 'landinghub-core' ),
			'param_name'  => 'slideshow_images',
			'value'       => '',
			'description' => esc_html__( 'Select images from media library.', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'enable_slideshow_bg',
				'value'   => 'yes',
			),
			'weight'      => 1,
		),
		
	);
	
	$custom_animation_params = array(
		array(
			'type'             => 'checkbox',
			'param_name'       => 'enable_content_animation',
			'value'            => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			'heading'          => esc_html__( 'Animate Columns?', 'landinghub-core' ),
			'description'      => esc_html__( 'Will enable animation for columns, it will be animated when it "enters" the browsers viewport.', 'landinghub-core' ),
			'weight' => 1,
		),

		//Custom Animation Options
		array(
			'type'        => 'dropdown',
			'param_name'  => 'animation_preset',
			'heading'     => esc_html__( 'Animation Presets', 'landinghub-core' ),
			'description' => esc_html__( 'Select a animation preset', 'landinghub-core' ),
			'value'       => array(
				'Fade In',
				'Fade In Down',
				'Fade In Up',
				'Fade In Left',
				'Fade In Right',
				'Flip In Y',
				'Flip In X',
				'Scale Up',
				'Scale Down',
				'custom',
			),
			'std' => 'custom',
			'group' => esc_html__( 'Animation', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'enable_content_animation',
				'value'   => 'yes',
			),
		),
		array(
			'type'        => 'textfield',
			'param_name'  => 'ca_duration',
			'heading'     => esc_html__( 'Duration', 'landinghub-core' ),
			'description' => esc_html__( 'Add duration of the animation in milliseconds', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'enable_content_animation',
				'value'   => 'yes',
			),
			// 'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			'group' => esc_html__( 'Animation', 'landinghub-core' ),
		),
		array(
			'type' => 'textfield',
			'param_name' => 'ca_delay',
			'heading' => esc_html__( 'Delay (Stagger)', 'landinghub-core' ),
			'description' => esc_html__( 'Add delay of the animation between of the animated elements in milliseconds', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'enable_content_animation',
				'value'   => 'yes',
			),
			// 'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Animation', 'landinghub-core' ),
		),
		array(
			'type' => 'textfield',
			'param_name' => 'ca_start_delay',
			'heading' => esc_html__( 'Start Delay', 'landinghub-core' ),
			'description' => esc_html__( 'Add start delay of the animation in milliseconds', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'enable_content_animation',
				'value'   => 'yes',
			),
			// 'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Animation', 'landinghub-core' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'ca_easing',
			'heading' => esc_html__( 'Easing', 'landinghub-core' ),
			'description' => esc_html__( 'Select an easing type', 'landinghub-core' ),
			'value' => array(
				'linear',
				'power1.in',
				'power2.in',
				'power3.in',
				'power4.in',
				'sine.in',
				'expo.in',
				'circ.in',
				'back.in',
				'bounce.in',
				'elastic.in(1,0.2)',
				'power1.out',
				'power2.out',
				'power3.out',
				'power4.out',
				'sine.out',
				'expo.out',
				'circ.out',
				'back.out',
				'bounce.out',
				'elastic.out(1,0.2)',
				'power1.inOut',
				'power2.inOut',
				'power3.inOut',
				'power4.inOut',
				'sine.inOut',
				'expo.inOut',
				'circ.inOut',
				'back.inOut',
				'bounce.inOut',
				'elastic.inOut(1,0.2)',
			),
			'std' => 'power4.out',
			'dependency' => array(
				'element' => 'enable_content_animation',
				'value'   => 'yes',
			),
			// 'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Animation', 'landinghub-core' ),
		),
		array(
			'type'        => 'dropdown',
			'param_name'  => 'ca_direction',
			'heading'     => esc_html__( 'Direction', 'landinghub-core' ),
			'description' => esc_html__( 'Select animations direction', 'landinghub-core' ),
			'value' => array(
				esc_html__( 'Forward', 'landinghub-core' )  => 'forward',
				esc_html__( 'Backward', 'landinghub-core' )  => 'backward',
			),
			'dependency' => array(
				'element' => 'enable_content_animation',
				'value'   => 'yes',
			),
			// 'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Animation', 'landinghub-core' ),
		),
		array(
			'type'        => 'subheading',
			'param_name'  => 'ca_init_values',
			'heading'     => esc_html__( 'Animate From', 'landinghub-core' ),
			'group' => esc_html__( 'Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_init_translate_x',
			'heading'     => esc_html__( 'Translate X', 'landinghub-core' ),
			'description' => esc_html__( 'Select translate on X axe', 'landinghub-core' ),
			'min'         => -500,
			'max'         => 500,
			'step'        => 1,
			'group' => esc_html__( 'Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_init_translate_y',
			'heading'     => esc_html__( 'Translate Y', 'landinghub-core' ),
			'description' => esc_html__( 'Select translate on Y axe', 'landinghub-core' ),
			'min'         => -500,
			'max'         => 500,
			'step'        => 1,
			'group' => esc_html__( 'Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_init_translate_z',
			'heading'     => esc_html__( 'Translate Z', 'landinghub-core' ),
			'description' => esc_html__( 'Select translate on Z axe', 'landinghub-core' ),
			'min'         => -500,
			'max'         => 500,
			'step'        => 1,
			'group' => esc_html__( 'Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_init_scale_x',
			'heading'     => esc_html__( 'Scale X', 'landinghub-core' ),
			'description' => esc_html__( 'Select Scale X', 'landinghub-core' ),
			'min'         => 0,
			'max'         => 10,
			'step'        => 0.05,
			'std'         => 1,
			'group' => esc_html__( 'Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
			// 'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_init_scale_y',
			'heading'     => esc_html__( 'Scale Y', 'landinghub-core' ),
			'description' => esc_html__( 'Select Scale Y', 'landinghub-core' ),
			'min'         => 0,
			'max'         => 10,
			'step'        => 0.05,
			'std'         => 1,
			'group' => esc_html__( 'Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
			// 'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_init_rotate_x',
			'heading'     => esc_html__( 'Rotate X', 'landinghub-core' ),
			'description' => esc_html__( 'Select rotate degree on X axe', 'landinghub-core' ),
			'min'         => -360,
			'max'         => 360,
			'step'        => 1,
			'group' => esc_html__( 'Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_init_rotate_y',
			'heading'     => esc_html__( 'Rotate Y', 'landinghub-core' ),
			'description' => esc_html__( 'Select rotate degree on Y axe', 'landinghub-core' ),
			'min'         => -360,
			'max'         => 360,
			'step'        => 1,
			'group' => esc_html__( 'Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_init_rotate_z',
			'heading'     => esc_html__( 'Rotate Z', 'landinghub-core' ),
			'description' => esc_html__( 'Select rotate degree on Z axe', 'landinghub-core' ),
			'min'         => -360,
			'max'         => 360,
			'step'        => 1,
			'group' => esc_html__( 'Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
		),
		
		array(
			'type'        => 'textfield',
			'param_name'  => 'ca_init_origin_x',
			'heading'     => esc_html__( 'TransformOrigin X', 'landinghub-core' ),
			'description' => esc_html__( 'Add value for transform-origin X axe in %', 'landinghub-core' ),
			'group' => esc_html__( 'Animation', 'landinghub-core' ),
			'std' => '50%',
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
			// 'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type'        => 'textfield',
			'param_name'  => 'ca_init_origin_y',
			'heading'     => esc_html__( 'TransformOrigin Y', 'landinghub-core' ),
			'description' => esc_html__( 'Add value for transform-origin Y axe in %', 'landinghub-core' ),
			'group' => esc_html__( 'Animation', 'landinghub-core' ),
			'std' => '50%',
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
			// 'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type'        => 'textfield',
			'param_name'  => 'ca_init_origin_z',
			'heading'     => esc_html__( 'TransformOrigin Z', 'landinghub-core' ),
			'description' => esc_html__( 'Add value for transform-origin Z axe in px or em units', 'landinghub-core' ),
			'group' => esc_html__( 'Animation', 'landinghub-core' ),
			'std' => '0px',
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
			// 'edit_field_class' => 'vc_col-sm-4',
		),
		
		
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_init_opacity',
			'heading'     => esc_html__( 'Opacity', 'landinghub-core' ),
			'description' => esc_html__( 'Set opacity', 'landinghub-core' ),
			'min'         => 0,
			'max'         => 1,
			'step'        => 0.1,
			'std'         => 1,
			'group' => esc_html__( 'Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
		),
		//Animation Values
		array(
			'type'        => 'subheading',
			'param_name'  => 'ca_animations_values',
			'heading'     => esc_html__( 'Animate To', 'landinghub-core' ),
			'group' => esc_html__( 'Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
		),			
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_an_translate_x',
			'heading'     => esc_html__( 'Translate X', 'landinghub-core' ),
			'description' => esc_html__( 'Select translate on X axe', 'landinghub-core' ),
			'min'         => -500,
			'max'         => 500,
			'step'        => 1,
			'group' => esc_html__( 'Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_an_translate_y',
			'heading'     => esc_html__( 'Translate Y', 'landinghub-core' ),
			'description' => esc_html__( 'Select translate on Y axe', 'landinghub-core' ),
			'min'         => -500,
			'max'         => 500,
			'step'        => 1,
			'group' => esc_html__( 'Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_an_translate_z',
			'heading'     => esc_html__( 'Translate Z', 'landinghub-core' ),
			'description' => esc_html__( 'Select translate on Z axe', 'landinghub-core' ),
			'min'         => -500,
			'max'         => 500,
			'step'        => 1,
			'group' => esc_html__( 'Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_an_scale_x',
			'heading'     => esc_html__( 'Scale X', 'landinghub-core' ),
			'description' => esc_html__( 'Select Scale X', 'landinghub-core' ),
			'min'         => 0,
			'max'         => 10,
			'step'        => 0.05,
			'std'         => 1,
			'group' => esc_html__( 'Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
			// 'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_an_scale_y',
			'heading'     => esc_html__( 'Scale Y', 'landinghub-core' ),
			'description' => esc_html__( 'Select Scale Y', 'landinghub-core' ),
			'min'         => 0,
			'max'         => 10,
			'step'        => 0.05,
			'std'         => 1,
			'group' => esc_html__( 'Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
			// 'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_an_rotate_x',
			'heading'     => esc_html__( 'Rotate X', 'landinghub-core' ),
			'description' => esc_html__( 'Select rotate degree on X axe', 'landinghub-core' ),
			'min'         => -360,
			'max'         => 360,
			'step'        => 1,
			'group' => esc_html__( 'Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_an_rotate_y',
			'heading'     => esc_html__( 'Rotate Y', 'landinghub-core' ),
			'description' => esc_html__( 'Select rotate degree on Y axe', 'landinghub-core' ),
			'min'         => -360,
			'max'         => 360,
			'step'        => 1,
			'group' => esc_html__( 'Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_an_rotate_z',
			'heading'     => esc_html__( 'Rotate Z', 'landinghub-core' ),
			'description' => esc_html__( 'Select rotate degree on Z axe', 'landinghub-core' ),
			'min'         => -360,
			'max'         => 360,
			'step'        => 1,
			'group' => esc_html__( 'Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
		),
		
		array(
			'type'        => 'textfield',
			'param_name'  => 'ca_an_origin_x',
			'heading'     => esc_html__( 'TransformOrigin X', 'landinghub-core' ),
			'description' => esc_html__( 'Add value for transform-origin X axe with %', 'landinghub-core' ),
			'group' => esc_html__( 'Animation', 'landinghub-core' ),
			'std' => '50%',
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
			// 'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type'        => 'textfield',
			'param_name'  => 'ca_an_origin_y',
			'heading'     => esc_html__( 'TransformOrigin Y', 'landinghub-core' ),
			'description' => esc_html__( 'Add value for transform-origin Y axe with %', 'landinghub-core' ),
			'group' => esc_html__( 'Animation', 'landinghub-core' ),
			'std' => '50%',
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
			// 'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type'        => 'textfield',
			'param_name'  => 'ca_an_origin_z',
			'heading'     => esc_html__( 'TransformOrigin Z', 'landinghub-core' ),
			'description' => esc_html__( 'Add value for transform-origin Z axe in px or em', 'landinghub-core' ),
			'group' => esc_html__( 'Animation', 'landinghub-core' ),
			'std' => '0px',
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
			// 'edit_field_class' => 'vc_col-sm-4',
		),
		
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_an_opacity',
			'heading'     => esc_html__( 'Opacity', 'landinghub-core' ),
			'description' => esc_html__( 'Set opacity', 'landinghub-core' ),
			'min'         => 0,
			'max'         => 1,
			'step'        => 0.1,
			'std'         => 1,
			'group' => esc_html__( 'Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
		),
		
	);

	$enable_cc_circle_params = array (
		array(
			'type'         => 'checkbox',
			'param_name'   => 'enable_cc_circle',
			'heading'      => esc_html__( 'Enable Custom Cursor Overlay?', 'landinghub-core' ),
			'description'  => esc_html__( 'Enable to show an overlay circle when hovering over the row. This option only works when custom cursor is enabled from Theme Options.', 'landinghub-core' ),
			'value'        => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			'weight' => 1
		),
		array(
			'type'       => 'liquid_colorpicker',
			'param_name' => 'cc_circle_color',
			'heading'    => esc_html__( 'Circle Color', 'landinghub-core' ),
			'description'  => esc_html__( 'Custom cursor circle color.', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'enable_cc_circle',
				'not_empty' => true,
			),
			'weight' => 1
		),
	);

	$params = array(
		
		
		array(
			'type'       => 'responsive_css_editor',
			'heading'    => esc_html__( 'Responsive CSS Box', 'landinghub-core' ),
			'param_name' => 'responsive_css',
			'group'      => esc_html__( 'Design Options', 'landinghub-core' ),
		),
		array(
			'type'        => 'css_editor',
			'heading'     => esc_html__( 'CSS box', 'landinghub-core' ),
			'param_name'  => 'css',
			'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
		),
		array(
			'type'       => 'responsive_hide',
			'heading'    => esc_html__( 'Hide Row?', 'landinghub-core' ),
			'param_name' => 'row_hide',
			'group'      => esc_html__( 'Design Options', 'landinghub-core' ),			
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'bg_position',
			'heading' => esc_html__( 'Background Position', 'landinghub-core' ),
			'value' => array(
				esc_html__( 'Default', 'landinghub-core' )         => '',
				esc_html__( 'Center Bottom', 'landinghub-core' )   => 'center bottom',
				esc_html__( 'Center Center', 'landinghub-core' )   => 'center center',
				esc_html__( 'Center Top', 'landinghub-core' )      => 'center top',
				esc_html__( 'Left Bottom', 'landinghub-core' )     => 'left bottom',
				esc_html__( 'Left Center', 'landinghub-core' )     => 'left center',
				esc_html__( 'Left Top', 'landinghub-core' )        => 'left top',
				esc_html__( 'Right Bottom', 'landinghub-core' )    => 'right bottom',
				esc_html__( 'Right Center', 'landinghub-core' )    => 'right center',
				esc_html__( 'Right Top', 'landinghub-core' )       => 'right top',
				esc_html__( 'Custom Position', 'landinghub-core' ) => 'custom',
			),
			// 'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Design Options', 'landinghub-core' ),
		),
		array(
			'type'             => 'textfield',
			'param_name'       => 'bg_pos_h',
			'heading'          => esc_html__( 'Horizontal Position', 'landinghub-core' ),
			'description'      => esc_html__( 'Enter custom horizontal position in px or %', 'landinghub-core' ),
			'group'            => esc_html__( 'Design Options', 'landinghub-core' ),
			// 'edit_field_class' => 'vc_col-sm-6',
			'dependency'  => array(
				'element' => 'bg_position',
				'value'   => 'custom'
			)
		),
		array(
			'type'             => 'textfield',
			'param_name'       => 'bg_pos_v',
			'heading'          => esc_html__( 'Vertical Position', 'landinghub-core' ),
			'description'      => esc_html__( 'Enter custom vertical position in px or %', 'landinghub-core' ),
			'group'            => esc_html__( 'Design Options', 'landinghub-core' ),
			// 'edit_field_class' => 'vc_col-sm-6',
			'dependency'  => array(
				'element' => 'bg_position',
				'value'   => 'custom'
			)
		),
		array(
			'type'       => 'dropdown',
			'param_name' => 'bg_attachment',
			'heading'    => esc_html__( 'Background Attachment', 'landinghub-core' ),
			'value'      => array(
				esc_html__( 'Default', 'landinghub-core' ) => 'scroll',
				esc_html__( 'Fixed', 'landinghub-core' )   => 'fixed',
				esc_html__( 'Inherit', 'landinghub-core' ) => 'inherit',
			),
			'group' => esc_html__( 'Design Options', 'landinghub-core' ),
			// 'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type'             => 'textfield',
			'param_name'       => 'custom_border_radius',
			'heading'          => esc_html__( 'Custom Border Radius', 'landinghub-core' ),
			'description'      => esc_html__( 'Enter custom border radius in px or %', 'landinghub-core' ),
			'group'            => esc_html__( 'Design Options', 'landinghub-core' ),
			// 'edit_field_class' => 'vc_col-sm-6',
		),
		//Gradient Background
		array(
			'type'        => 'checkbox',
			'param_name'  => 'enable_gradient',
			'heading'     => esc_html__( 'Enable Gradient', 'landinghub-core' ),
			'description' => esc_html__( 'If checked, gradient background will be enabled', 'landinghub-core' ),
			'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
			// 'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type'        => 'checkbox',
			'param_name'  => 'mobile_bg_gradient',
			'heading'     => esc_html__( 'Disable on Mobile?', 'landinghub-core' ),
			'description' => esc_html__( 'If checked, will disable gradient background on mobile devices', 'landinghub-core' ),
			'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			'dependency'  => array(
				'element' => 'enable_gradient',
				'not_empty' => true,
			),
			'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
			// 'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type'       => 'liquid_colorpicker',
			'param_name' => 'gradient_bg',
			'heading'    => esc_html__( 'Gradient Background', 'landinghub-core' ),
			'description'  => esc_html__( 'Add gradient background', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'enable_gradient',
				'not_empty' => true,
			),
			// 'edit_field_class' => 'vc_col-sm-4',
			'group' => esc_html__( 'Design Options', 'landinghub-core' ),	
		),
		//Overlay
		array(
			'type'        => 'checkbox',
			'param_name'  => 'enable_overlay',
			'heading'     => esc_html__( 'Enable Overlay', 'landinghub-core' ),
			'description' => esc_html__( 'If checked, overlay will be enabled', 'landinghub-core' ),
			'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
		),		
		array(
			'type'       => 'liquid_colorpicker',
			'param_name' => 'overlay_bg',
			'heading'    => esc_html__( 'Overlay Background', 'landinghub-core' ),
			'description'  => esc_html__( 'Set overlay background', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'enable_overlay',
				'not_empty' => true,
			),
			// 'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Design Options', 'landinghub-core' ),	
		),
		array(
			'type'       => 'liquid_colorpicker',
			'param_name' => 'hover_overlay_bg',
			'heading'    => esc_html__( 'Hover Overlay Background', 'landinghub-core' ),
			'description'  => esc_html__( 'Set hover overlay background', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'enable_overlay',
				'not_empty' => true,
			),
			// 'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Design Options', 'landinghub-core' ),	
		),
		//Box Shadow Options
		array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Enable box-shadow?', 'landinghub-core' ),
			'param_name'  => 'enable_row_shadowbox',
			'description' => esc_html__( 'If checked, the box-shadow options will be visible', 'landinghub-core' ),
			'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			// 'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Design Options', 'landinghub-core' ),
		),
		array(
			'type' => 'param_group',
			'heading' => esc_html__( 'Shadow Box Options', 'landinghub-core' ),
			'param_name' => 'row_box_shadow',
			'group' => esc_html__( 'Design Options', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'enable_row_shadowbox',
				'not_empty' => true,
			),
			'params' => array(				
				array(
					'type'        => 'dropdown',
					'param_name'  => 'inset',
					'heading'     => esc_html__( 'Inset', 'landinghub-core' ),
					'description' => esc_html__(  'Select if it is inset', 'landinghub-core' ),
					'value'      => array(
						esc_html__( 'No', 'landinghub-core' )  => '',
						esc_html__( 'Yes', 'landinghub-core' ) => 'inset',
					),
					// 'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'x_offset',
					'heading'     => esc_html__( 'Position X', 'landinghub-core' ),
					'description' => esc_html__(  'Set position X in px', 'landinghub-core' ),
					// 'edit_field_class' => 'vc_col-sm-6'
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'y_offset',
					'heading'     => esc_html__( 'Position Y', 'landinghub-core' ),
					'description' => esc_html__(  'Set position Y in px', 'landinghub-core' ),
					// 'edit_field_class' => 'vc_col-sm-6'
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'blur_radius',
					'heading'     => esc_html__( 'Blur Radius', 'landinghub-core' ),
					'description' => esc_html__(  'Add blur radius in px', 'landinghub-core' ),
					// 'edit_field_class' => 'vc_col-sm-6'
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'spread_radius',
					'heading'     => esc_html__( 'Spread Radius', 'landinghub-core' ),
					'description' => esc_html__(  'Add spread radius in px', 'landinghub-core' ),
					// 'edit_field_class' => 'vc_col-sm-6'
				),
				array(
					'type'        => 'colorpicker',
					'param_name'  => 'shadow_color',
					'heading'     => esc_html__( 'Color', 'landinghub-core' ),
					'description' => esc_html__(  'Pick a color for shadow', 'landinghub-core' ),
					// 'edit_field_class' => 'vc_col-sm-6'
				),
				
			)
		),
		array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Enable svg dividers?', 'landinghub-core' ),
			'param_name'  => 'enable_row_dividers',
			'description' => esc_html__( 'If checked, the svg dividers will be visible', 'landinghub-core' ),
			'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			// 'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Design Options', 'landinghub-core' ),
		),
		array(
			'type'       => 'liquid_shape_divider',
			'heading'    => esc_html__( 'Shape Divider Options', 'landinghub-core' ),
			'param_name' => 'row_svg_divider',
			'group'      => esc_html__( 'Shape Divider', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'enable_row_dividers',
				'not_empty' => true,
			),
		),
	);
	
	$parallax_inner_row_param = array(
		array(
			'type'         => 'checkbox',
			'param_name'   => 'parallax',
			'heading'      => esc_html__( 'Parallax Background', 'landinghub-core' ),
			'description'  => esc_html__( 'Add parallax background image in Design Options', 'landinghub-core' ),
			'value'        => array( esc_html__( 'Yes', 'landinghub-core' ) => 'enable_parallax' ),
			'weight'       => 1,
		)
	);

	vc_add_params( 'vc_row', $scale_bg_param );
	vc_add_params( 'vc_row_inner', $scale_bg_param );

	vc_add_params( 'vc_row', $slideshow_bg_params );
	vc_add_params( 'vc_row_inner', $slideshow_bg_params );

	vc_add_params( 'vc_row', $custom_animation_params );
	vc_add_params( 'vc_row', $enable_cc_circle_params );

	vc_add_params( 'vc_row_inner', $parallax_inner_row_param );
	vc_add_params( 'vc_row_inner', $custom_animation_params );	
	vc_add_params( 'vc_row', $params );
	vc_add_params( 'vc_row_inner', $params );

	vc_add_param( 'vc_row', array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Section tooltip', 'landinghub-core' ),
			'param_name'  => 'data_tooltip',
			'description' => esc_html__( 'Add title as tooltip on stack page', 'landinghub-core' ),
			'weight'      => 1,
		)
	);

}
add_action( 'vc_after_init', 'liquid_row_extras' );

function liquid_columns_extras() {
	
	vc_remove_param( 'vc_column', 'css_animation' );
	vc_remove_param( 'vc_column_inner', 'css_animation' );
	
	vc_remove_param( 'vc_column', 'parallax_image' );
	vc_remove_param( 'vc_column_inner', 'parallax_image' );
	
	vc_remove_param( 'vc_column', 'el_id' );
	vc_remove_param( 'vc_column_inner', 'el_id' );
	
	vc_remove_param( 'vc_column', 'el_class' );
	vc_remove_param( 'vc_column_inner', 'el_class' );
	
	vc_remove_param( 'vc_column', 'parallax_speed_bg' );
	vc_remove_param( 'vc_column_inner', 'parallax_speed_bg' );

	vc_remove_param( 'vc_column', 'video_bg_parallax' );
	vc_remove_param( 'vc_column_inner', 'video_bg_parallax' );
	
	vc_remove_param( 'vc_column', 'parallax_speed_video' );
	vc_remove_param( 'vc_column_inner', 'parallax_speed_video' );
	
	vc_update_shortcode_param( 'vc_column', array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Content position?', 'landinghub-core' ),
			'param_name'  => 'column_content_align',
			'description' => esc_html__( 'Select vertical alignment of the content inside column. This option works only when parent row "Equal height" option is enabled and override "Content position" of parent row for this column.', 'landinghub-core' ),
			'value'      => array(
				esc_html__( 'Default', 'landinghub-core' )   => '',
				esc_html__( 'Start', 'landinghub-core' ) => 'justify-content-start',
				esc_html__( 'Center', 'landinghub-core' ) => 'justify-content-center',
				esc_html__( 'End', 'landinghub-core' ) => 'justify-content-end',
			),
			'weight'      => 1,
		)
	);
	
	vc_update_shortcode_param( 'vc_column', array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Use video background?', 'landinghub-core' ),
			'param_name'  => 'video_bg',
			'description' => esc_html__( 'If checked, video will be used as row background.', 'landinghub-core' ),
			'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			'weight'      => 1,
		)
	);
	vc_update_shortcode_param( 'vc_column_inner', array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Use video background?', 'landinghub-core' ),
			'param_name'  => 'video_bg',
			'description' => esc_html__( 'If checked, video will be used as row background.', 'landinghub-core' ),
			'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			'weight'      => 1,
		)
	);

	vc_add_params( 'vc_column', array(
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Disable Video Background for Mobile ', 'landinghub-core' ),
				'param_name'  => 'mobile_video_bg',
				'description' => esc_html__( 'If checked, video will be disabled for mobile devices', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'dependency'  => array(
					'element'   => 'video_bg',
					'not_empty' => true,
				),
				'weight'      => 1,
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Video Background Source', 'landinghub-core' ),
				'param_name' => 'video_bg_source',
				'value'      => array(
					esc_html__( 'Local', 'landinghub-core' )   => 'local',
					esc_html__( 'Youtube', 'landinghub-core' ) => 'youtube',
				),
				'dependency'  => array(
					'element'   => 'video_bg',
					'not_empty' => true,
				),
				'weight'        => 1,
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'MP4 Video Path', 'landinghub-core' ),
				'param_name'  => 'video_local_mp4_url',
				'value'       => '',
				// default video url
				'description' => esc_html__( 'Add local video path in mp4 format', 'landinghub-core' ),
				'dependency'  => array(
					'element'   => 'video_bg_source',
					'value' => 'local',
				),
				'weight'        => 1,
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'WEBM Video Path', 'landinghub-core' ),
				'param_name'  => 'video_local_webm_url',
				'value'       => '',
				// default video url
				'description' => esc_html__( 'Add local video path in WEBM format', 'landinghub-core' ),
				'dependency'  => array(
					'element'   => 'video_bg_source',
					'value' => 'local',
				),
				'weight'        => 1,
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Loop?', 'landinghub-core' ),
				'param_name'  => 'video_loop',
				'description' => esc_html__( 'Loop video.', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'weight'      => 1,
				'std'         => 'yes',
				'dependency'  => array(
					'element'   => 'video_bg',
					'not_empty' => true,
				),
			),

		) 
	);
	vc_add_params( 'vc_column_inner', array(
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Disable Video Background for Mobile ', 'landinghub-core' ),
				'param_name'  => 'mobile_video_bg',
				'description' => esc_html__( 'If checked, video will be disabled for mobile devices', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'dependency'  => array(
					'element'   => 'video_bg',
					'not_empty' => true,
				),
				'weight'      => 1,
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Video Background Source', 'landinghub-core' ),
				'param_name' => 'video_bg_source',
				'value'      => array(
					esc_html__( 'Local', 'landinghub-core' )   => 'local',
					esc_html__( 'Youtube', 'landinghub-core' ) => 'youtube',
				),
				'dependency'  => array(
					'element'   => 'video_bg',
					'not_empty' => true,
				),
				'weight'        => 1,
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'MP4 Video Path', 'landinghub-core' ),
				'param_name'  => 'video_local_mp4_url',
				'value'       => '',
				// default video url
				'description' => esc_html__( 'Add local video path in mp4 format', 'landinghub-core' ),
				'dependency'  => array(
					'element'   => 'video_bg_source',
					'value' => 'local',
				),
				'weight'        => 1,
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'WEBM Video Path', 'landinghub-core' ),
				'param_name'  => 'video_local_webm_url',
				'value'       => '',
				// default video url
				'description' => esc_html__( 'Add local video path in WEBM format', 'landinghub-core' ),
				'dependency'  => array(
					'element'   => 'video_bg_source',
					'value' => 'local',
				),
				'weight'        => 1,
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Loop?', 'landinghub-core' ),
				'param_name'  => 'video_loop',
				'description' => esc_html__( 'Loop video.', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'weight'      => 1,
				'std'         => 'yes',
				'dependency'  => array(
					'element'   => 'video_bg',
					'not_empty' => true,
				),
			),

		) 
	);	
	
	vc_update_shortcode_param( 'vc_column', array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'YouTube link', 'landinghub-core' ),
			'param_name'  => 'video_bg_url',
			'value'       => 'https://www.youtube.com/watch?v=lMJXxhRFO1k',
			// default video url
			'description' => esc_html__( 'Add YouTube link.', 'landinghub-core' ),
			'dependency'  => array(
				'element'   => 'video_bg_source',
				'value' => 'youtube',
			),
			'weight'        => 1,
		)
	);
	vc_update_shortcode_param( 'vc_column_inner', array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'YouTube link', 'landinghub-core' ),
			'param_name'  => 'video_bg_url',
			'value'       => 'https://www.youtube.com/watch?v=lMJXxhRFO1k',
			// default video url
			'description' => esc_html__( 'Add YouTube link.', 'landinghub-core' ),
			'dependency'  => array(
				'element'   => 'video_bg_source',
				'value' => 'youtube',
			),
			'weight'        => 1,
		)
	);
	
	vc_add_params( 'vc_column', array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Start time', 'landinghub-core' ),
				'param_name'  => 'y_start_time',
				'value'       => '',
				// default video url
				'description' => esc_html__( 'Youtube video start time, for ex 0 ( in seconds )', 'landinghub-core' ),
				'dependency'  => array(
					'element'   => 'video_bg_source',
					'value' => 'youtube',
				),
				// 'edit_field_class' => 'vc_col-sm-6',
				'weight'        => 1,
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'End time', 'landinghub-core' ),
				'param_name'  => 'y_end_time',
				'value'       => '',
				// default video url
				'description' => esc_html__( 'Youtube video end time, for ex 120 ( in seconds )', 'landinghub-core' ),
				'dependency'  => array(
					'element'   => 'video_bg_source',
					'value' => 'youtube',
				),
				// 'edit_field_class' => 'vc_col-sm-6',
				'weight'        => 1,
			),

		) 
	);
	vc_add_params( 'vc_column_inner', array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Start time', 'landinghub-core' ),
				'param_name'  => 'y_start_time',
				'value'       => '',
				// default video url
				'description' => esc_html__( 'Youtube video start time, for ex 0 ( in seconds )', 'landinghub-core' ),
				'dependency'  => array(
					'element'   => 'video_bg_source',
					'value' => 'youtube',
				),
				// 'edit_field_class' => 'vc_col-sm-6',
				'weight'        => 1,
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'End time', 'landinghub-core' ),
				'param_name'  => 'y_end_time',
				'value'       => '',
				// default video url
				'description' => esc_html__( 'Youtube video end time, for ex 120 ( in seconds )', 'landinghub-core' ),
				'dependency'  => array(
					'element'   => 'video_bg_source',
					'value' => 'youtube',
				),
				// 'edit_field_class' => 'vc_col-sm-6',
				'weight'        => 1,
			),

		) 
	);
	vc_update_shortcode_param( 'vc_column',
		array(
			'type'         => 'checkbox',
			'param_name'   => 'row_scale_bg_onhover',
			'heading'      => esc_html__( 'Scale BG Image On Hover', 'landinghub-core' ),
			'description'  => esc_html__( 'Enables the scale effect for background image.', 'landinghub-core' ),
			'value'        => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			'weight'       => 1,
		)		
	);
	vc_update_shortcode_param( 'vc_column_inner', 
		array(
			'type'         => 'checkbox',
			'param_name'   => 'row_scale_bg_onhover',
			'heading'      => esc_html__( 'Scale BG Image On Hover', 'landinghub-core' ),
			'description'  => esc_html__( 'Enables the scale effect for background image.', 'landinghub-core' ),
			'value'        => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			'weight'       => 1,
		)		
	);
	vc_update_shortcode_param( 'vc_column',
		array(
			'type'        => 'checkbox',
			'param_name'  => 'parallax',
			'heading'     => esc_html__( 'Parallax', 'landinghub-core' ),
			'description' => esc_html__( 'Add parallax for column.', 'landinghub-core' ),
			'value'       => array( esc_html__( 'Yes', 'landinghub-core' )  => 'yes' ),
			'weight' => 1
		)
	);
	vc_update_shortcode_param( 'vc_column_inner', 
		array(
			'type'        => 'checkbox',
			'param_name'  => 'parallax',
			'heading'     => esc_html__( 'Parallax', 'landinghub-core' ),
			'description' => esc_html__( 'Add parallax for column.', 'landinghub-core' ),
			'value'       => array( esc_html__( 'Yes', 'landinghub-core' )  => 'yes' ),
			'weight' => 1
		)
	);
	vc_add_params( 'vc_column', array(
			array(
				'type'         => 'checkbox',
				'param_name'   => 'enable_pin',
				'heading'      => esc_html__( 'Enable Pin', 'landinghub-core' ),
				'value'        => array( esc_html__( 'Yes', 'landinghub-core' ) => 'enable_pin' ),
				'weight'       => 1,
			)		
		) 
	);
	vc_update_shortcode_param( 'vc_column',
		array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Use CSS Pin?', 'landinghub-core' ),
			'param_name'  => 'css_pin',
			'value'       => array( esc_html__( 'Yes', 'landinghub-core' )  => 'lqd-column-css-pin' ),
			'description' => esc_html__( 'It is more performant, but less flexible. And works only when the column is next to another column.', 'landinghub-core' ),
			'dependency'  => array(
				'element'   => 'enable_pin',
				'not_empty' => true,
			),
			'std' => 'lqd-column-css-pin',
			'weight' => 1
		)
	);
	vc_update_shortcode_param( 'vc_column',
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Pin Offset', 'landinghub-core' ),
			'param_name'  => 'pin_offset',
			'value'       => '30px',
			'description' => esc_html__( 'Enter pinning offset.', 'landinghub-core' ),
			'dependency'  => array(
				'element'   => 'enable_pin',
				'not_empty' => true,
			),
			'weight' => 1
		)
	);
	vc_update_shortcode_param( 'vc_column',
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Custom Pin Duration', 'landinghub-core' ),
			'param_name'  => 'pin_duration',
			'value'       => '100%',
			'description' => esc_html__( 'Enter a custom pinning duration. If a value is set, the content below this column will be pushed down, so the column can pin. You can use \'%\' if you want value relative to viewport height or use \'px\' for absolute pin duration.', 'landinghub-core' ),
			'dependency'  => array(
				'element'   => 'css_pin',
				'value_not_equal_to' => 'lqd-column-css-pin',
			),
			'weight' => 1
		)
	);
	vc_add_params( 'vc_column', array(
			array(
				'type'         => 'checkbox',
				'param_name'   => 'enable_link',
				'heading'      => esc_html__( 'Enable Link', 'landinghub-core' ),
				'value'        => array( esc_html__( 'Yes', 'landinghub-core' ) => 'enable_column_link' ),
				'weight'       => 1,
			)		
		) 
	);
	vc_add_params( 'vc_column', array(
			array(
				'type'        => 'vc_link',
				'param_name'  => 'link',
				'heading'     => esc_html__( 'URL (Link)', 'landinghub-core' ),
				'description' => esc_html__( 'Add link to column.', 'landinghub-core' ),
				'weight'      => 1,
				'dependency'  => array(
					'element'   => 'enable_link',
					'not_empty' => true,
				),
			)
		) 
	);
	
	vc_add_params( 'vc_column_inner', array(
			array(
				'type'         => 'checkbox',
				'param_name'   => 'enable_link',
				'heading'      => esc_html__( 'Enable Link', 'landinghub-core' ),
				'value'        => array( esc_html__( 'Yes', 'landinghub-core' ) => 'enable_column_link' ),
				'weight'       => 1,
			)		
		) 
	);
	vc_add_params( 'vc_column_inner', array(
			array(
				'type'        => 'vc_link',
				'param_name'  => 'link',
				'heading'     => esc_html__( 'URL (Link)', 'landinghub-core' ),
				'description' => esc_html__( 'Add link to column.', 'landinghub-core' ),
				'weight'      => 1,
				'dependency'  => array(
					'element'   => 'enable_link',
					'not_empty' => true,
				),
			)
		) 
	);
	
	$custom_animation_params = array(
		array(
			'type'             => 'checkbox',
			'param_name'       => 'enable_content_animation',
			'value'            => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			'heading'          => esc_html__( 'Content animation', 'landinghub-core' ),
			'description'      => esc_html__( 'Will enable animation for content of columns, it will be animated when it "enters" the browsers viewport.', 'landinghub-core' ),
		),

		//Custom Animation Options
		array(
			'type'        => 'dropdown',
			'param_name'  => 'animation_preset',
			'heading'     => esc_html__( 'Animation Presets', 'landinghub-core' ),
			'description' => esc_html__( 'Select a animation preset', 'landinghub-core' ),
			'value'       => array(
				'Fade In',
				'Fade In Down',
				'Fade In Up',
				'Fade In Left',
				'Fade In Right',
				'Flip In Y',
				'Flip In X',
				'Scale Up',
				'Scale Down',
				'custom',
			),
			'std' => 'custom',
			'group' => esc_html__( 'Content Animation', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'enable_content_animation',
				'value'   => 'yes',
			),
		),
		array(
			'type'        => 'textfield',
			'param_name'  => 'ca_duration',
			'heading'     => esc_html__( 'Duration', 'landinghub-core' ),
			'description' => esc_html__( 'Add duration of the animation in milliseconds', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'enable_content_animation',
				'value'   => 'yes',
			),
			// 'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			'group' => esc_html__( 'Content Animation', 'landinghub-core' ),
		),
		array(
			'type' => 'textfield',
			'param_name' => 'ca_delay',
			'heading' => esc_html__( 'Delay (Stagger)', 'landinghub-core' ),
			'description' => esc_html__( 'Add delay of the animation between of the animated elements in milliseconds', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'enable_content_animation',
				'value'   => 'yes',
			),
			// 'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Content Animation', 'landinghub-core' ),
		),
		array(
			'type' => 'textfield',
			'param_name' => 'ca_start_delay',
			'heading' => esc_html__( 'Start Delay', 'landinghub-core' ),
			'description' => esc_html__( 'Add start delay of the animation in milliseconds', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'enable_content_animation',
				'value'   => 'yes',
			),
			// 'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Content Animation', 'landinghub-core' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'ca_easing',
			'heading' => esc_html__( 'Easing', 'landinghub-core' ),
			'description' => esc_html__( 'Select an easing type', 'landinghub-core' ),
			'value' => array(
				'linear',
				'power1.in',
				'power2.in',
				'power3.in',
				'power4.in',
				'sine.in',
				'expo.in',
				'circ.in',
				'back.in',
				'bounce.in',
				'elastic.in(1,0.2)',
				'power1.out',
				'power2.out',
				'power3.out',
				'power4.out',
				'sine.out',
				'expo.out',
				'circ.out',
				'back.out',
				'bounce.out',
				'elastic.out(1,0.2)',
				'power1.inOut',
				'power2.inOut',
				'power3.inOut',
				'power4.inOut',
				'sine.inOut',
				'expo.inOut',
				'circ.inOut',
				'back.inOut',
				'bounce.inOut',
				'elastic.inOut(1,0.2)',
			),
			'std' => 'power4.out',
			'dependency' => array(
				'element' => 'enable_content_animation',
				'value'   => 'yes',
			),
			// 'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Content Animation', 'landinghub-core' ),
		),
		array(
			'type'        => 'dropdown',
			'param_name'  => 'ca_direction',
			'heading'     => esc_html__( 'Direction', 'landinghub-core' ),
			'description' => esc_html__( 'Select animations direction', 'landinghub-core' ),
			'value' => array(
				esc_html__( 'Forward', 'landinghub-core' )  => 'forward',
				esc_html__( 'Backward', 'landinghub-core' )  => 'backward',
			),
			'dependency' => array(
				'element' => 'enable_content_animation',
				'value'   => 'yes',
			),
			// 'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Content Animation', 'landinghub-core' ),
		),
		array(
			'type'        => 'subheading',
			'param_name'  => 'ca_init_values',
			'heading'     => esc_html__( 'Animate From', 'landinghub-core' ),
			'group' => esc_html__( 'Content Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_init_translate_x',
			'heading'     => esc_html__( 'Translate X', 'landinghub-core' ),
			'description' => esc_html__( 'Select translate on X axe', 'landinghub-core' ),
			'min'         => -500,
			'max'         => 500,
			'step'        => 1,
			'group' => esc_html__( 'Content Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_init_translate_y',
			'heading'     => esc_html__( 'Translate Y', 'landinghub-core' ),
			'description' => esc_html__( 'Select translate on Y axe', 'landinghub-core' ),
			'min'         => -500,
			'max'         => 500,
			'step'        => 1,
			'group' => esc_html__( 'Content Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_init_translate_z',
			'heading'     => esc_html__( 'Translate Z', 'landinghub-core' ),
			'description' => esc_html__( 'Select translate on Z axe', 'landinghub-core' ),
			'min'         => -500,
			'max'         => 500,
			'step'        => 1,
			'group' => esc_html__( 'Content Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_init_scale_x',
			'heading'     => esc_html__( 'Scale X', 'landinghub-core' ),
			'description' => esc_html__( 'Select Scale X', 'landinghub-core' ),
			'min'         => 0,
			'max'         => 10,
			'step'        => 0.05,
			'std'         => 1,
			'group' => esc_html__( 'Content Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
			// 'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_init_scale_y',
			'heading'     => esc_html__( 'Scale Y', 'landinghub-core' ),
			'description' => esc_html__( 'Select Scale Y', 'landinghub-core' ),
			'min'         => 0,
			'max'         => 10,
			'step'        => 0.05,
			'std'         => 1,
			'group' => esc_html__( 'Content Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
			// 'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_init_rotate_x',
			'heading'     => esc_html__( 'Rotate X', 'landinghub-core' ),
			'description' => esc_html__( 'Select rotate degree on X axe', 'landinghub-core' ),
			'min'         => -360,
			'max'         => 360,
			'step'        => 1,
			'group' => esc_html__( 'Content Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_init_rotate_y',
			'heading'     => esc_html__( 'Rotate Y', 'landinghub-core' ),
			'description' => esc_html__( 'Select rotate degree on Y axe', 'landinghub-core' ),
			'min'         => -360,
			'max'         => 360,
			'step'        => 1,
			'group' => esc_html__( 'Content Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_init_rotate_z',
			'heading'     => esc_html__( 'Rotate Z', 'landinghub-core' ),
			'description' => esc_html__( 'Select rotate degree on Z axe', 'landinghub-core' ),
			'min'         => -360,
			'max'         => 360,
			'step'        => 1,
			'group'       => esc_html__( 'Content Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
		),
		
		array(
			'type'        => 'textfield',
			'param_name'  => 'ca_init_origin_x',
			'heading'     => esc_html__( 'TransformOrigin X', 'landinghub-core' ),
			'description' => esc_html__( 'Add value for transform-origin X axe with %', 'landinghub-core' ),
			'group'       => esc_html__( 'Content Animation', 'landinghub-core' ),
			'std' => '50%',
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
			// 'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type'        => 'textfield',
			'param_name'  => 'ca_init_origin_y',
			'heading'     => esc_html__( 'TransformOrigin Y', 'landinghub-core' ),
			'description' => esc_html__( 'Add value for transform-origin Y axe with %', 'landinghub-core' ),
			'group'       => esc_html__( 'Content Animation', 'landinghub-core' ),
			'std' => '50%',
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
			// 'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type'        => 'textfield',
			'param_name'  => 'ca_init_origin_z',
			'heading'     => esc_html__( 'TransformOrigin Z', 'landinghub-core' ),
			'description' => esc_html__( 'Add value for transform-origin Z axe in px or em units', 'landinghub-core' ),
			'group'       => esc_html__( 'Content Animation', 'landinghub-core' ),
			'std' => '0px',
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
			// 'edit_field_class' => 'vc_col-sm-4',
		),
		
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_init_opacity',
			'heading'     => esc_html__( 'Opacity', 'landinghub-core' ),
			'description' => esc_html__( 'Set opacity', 'landinghub-core' ),
			'min'         => 0,
			'max'         => 1,
			'step'        => 0.1,
			'std'         => 1,
			'group'       => esc_html__( 'Content Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
		),
		//Animation Values
		array(
			'type'        => 'subheading',
			'param_name'  => 'ca_animations_values',
			'heading'     => esc_html__( 'Animate To', 'landinghub-core' ),
			'group' => esc_html__( 'Content Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
		),			
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_an_translate_x',
			'heading'     => esc_html__( 'Translate X', 'landinghub-core' ),
			'description' => esc_html__( 'Select translate on X axe', 'landinghub-core' ),
			'min'         => -500,
			'max'         => 500,
			'step'        => 1,
			'group' => esc_html__( 'Content Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_an_translate_y',
			'heading'     => esc_html__( 'Translate Y', 'landinghub-core' ),
			'description' => esc_html__( 'Select translate on Y axe', 'landinghub-core' ),
			'min'         => -500,
			'max'         => 500,
			'step'        => 1,
			'group' => esc_html__( 'Content Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_an_translate_z',
			'heading'     => esc_html__( 'Translate Z', 'landinghub-core' ),
			'description' => esc_html__( 'Select translate on Z axe', 'landinghub-core' ),
			'min'         => -500,
			'max'         => 500,
			'step'        => 1,
			'group' => esc_html__( 'Content Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_an_scale_x',
			'heading'     => esc_html__( 'Scale X', 'landinghub-core' ),
			'description' => esc_html__( 'Select Scale X', 'landinghub-core' ),
			'min'         => 0,
			'max'         => 10,
			'step'        => 0.05,
			'std'         => 1,
			'group' => esc_html__( 'Content Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
			// 'edit_field_class' => 'vc_col-sm-4',

		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_an_scale_y',
			'heading'     => esc_html__( 'Scale Y', 'landinghub-core' ),
			'description' => esc_html__( 'Select Scale Y', 'landinghub-core' ),
			'min'         => 0,
			'max'         => 10,
			'step'        => 0.05,
			'std'         => 1,
			'group' => esc_html__( 'Content Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
			// 'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_an_rotate_x',
			'heading'     => esc_html__( 'Rotate X', 'landinghub-core' ),
			'description' => esc_html__( 'Select rotate degree on X axe', 'landinghub-core' ),
			'min'         => -360,
			'max'         => 360,
			'step'        => 1,
			'group' => esc_html__( 'Content Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_an_rotate_y',
			'heading'     => esc_html__( 'Rotate Y', 'landinghub-core' ),
			'description' => esc_html__( 'Select rotate degree on Y axe', 'landinghub-core' ),
			'min'         => -360,
			'max'         => 360,
			'step'        => 1,
			'group' => esc_html__( 'Content Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_an_rotate_z',
			'heading'     => esc_html__( 'Rotate Z', 'landinghub-core' ),
			'description' => esc_html__( 'Select rotate degree on Z axe', 'landinghub-core' ),
			'min'         => -360,
			'max'         => 360,
			'step'        => 1,
			'group' => esc_html__( 'Content Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
		),
		array(
			'type'        => 'textfield',
			'param_name'  => 'ca_an_origin_x',
			'heading'     => esc_html__( 'TransformOrigin X', 'landinghub-core' ),
			'description' => esc_html__( 'Add value for transform-origin X axe with %', 'landinghub-core' ),
			'group' => esc_html__( 'Content Animation', 'landinghub-core' ),
			'std' => '50%',
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
			// 'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type'        => 'textfield',
			'param_name'  => 'ca_an_origin_y',
			'heading'     => esc_html__( 'TransformOrigin Y', 'landinghub-core' ),
			'description' => esc_html__( 'Add value for transform-origin Y axe with %', 'landinghub-core' ),
			'group' => esc_html__( 'Content Animation', 'landinghub-core' ),
			'std' => '50%',
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
			// 'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type'        => 'textfield',
			'param_name'  => 'ca_an_origin_z',
			'heading'     => esc_html__( 'TransformOrigin Z', 'landinghub-core' ),
			'description' => esc_html__( 'Add value for transform-origin Z axe in px or em', 'landinghub-core' ),
			'group' => esc_html__( 'Content Animation', 'landinghub-core' ),
			'std' => '0px',
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
			// 'edit_field_class' => 'vc_col-sm-4',
		),
		
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'ca_an_opacity',
			'heading'     => esc_html__( 'Opacity', 'landinghub-core' ),
			'description' => esc_html__( 'Set opacity', 'landinghub-core' ),
			'min'         => 0,
			'max'         => 1,
			'step'        => 0.1,
			'std'         => 1,
			'group'       => esc_html__( 'Content Animation', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'animation_preset',
				'value'   => 'custom',
			),
		),
	);

	$backdrop_filter = array(
		array(
			'type'        => 'checkbox',
			'param_name'  => 'enable_backdrop_filter',
			'heading'     => esc_html__( 'Enable Backdrop Filter', 'landinghub-core' ),
			'description' => esc_html__( 'Add backdrop filter to the column. You need a transparent bakcground color to see the effect. Please be careful with this effect. It can affect on performance some time.', 'landinghub-core' ),
			'value'      => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			'weight'       => 1,
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'backfilter_blur',
			'heading'     => esc_html__( 'Blur', 'landinghub-core' ),
			'description' => esc_html__( 'Default: 0', 'landinghub-core' ),
			'min'         => 0,
			'max'         => 50,
			'std'         => 0,
			'step'        => 1,
			'group' => esc_html__( 'Backdrop Filter', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'enable_backdrop_filter',
				'not_empty' => true
			),
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'backfilter_saturation',
			'heading'     => esc_html__( 'Saturation', 'landinghub-core' ),
			'description' => esc_html__( 'Default: 1', 'landinghub-core' ),
			'min'         => 0,
			'max'         => 50,
			'std'         => 1,
			'step'        => 0.25,
			'group' => esc_html__( 'Backdrop Filter', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'enable_backdrop_filter',
				'not_empty' => true
			),
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'backfilter_brightness',
			'heading'     => esc_html__( 'Brightness', 'landinghub-core' ),
			'description' => esc_html__( 'Default: 1', 'landinghub-core' ),
			'min'         => 0,
			'max'         => 10,
			'std'         => 1,
			'step'        => 0.25,
			'group' => esc_html__( 'Backdrop Filter', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'enable_backdrop_filter',
				'not_empty' => true
			),
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'backfilter_contrast',
			'heading'     => esc_html__( 'Contrast', 'landinghub-core' ),
			'description' => esc_html__( 'Default: 1', 'landinghub-core' ),
			'min'         => 0,
			'max'         => 10,
			'std'         => 1,
			'step'        => 0.25,
			'group' => esc_html__( 'Backdrop Filter', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'enable_backdrop_filter',
				'not_empty' => true
			),
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'backfilter_grayscale',
			'heading'     => esc_html__( 'Grayscale', 'landinghub-core' ),
			'description' => esc_html__( 'Default: 0', 'landinghub-core' ),
			'min'         => 0,
			'max'         => 1,
			'std'         => 0,
			'step'        => 0.1,
			'group' => esc_html__( 'Backdrop Filter', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'enable_backdrop_filter',
				'not_empty' => true
			),
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'backfilter_hue',
			'heading'     => esc_html__( 'Hue Rotate', 'landinghub-core' ),
			'description' => esc_html__( 'Default: 0', 'landinghub-core' ),
			'min'         => -180,
			'max'         => 180,
			'std'         => 0,
			'step'        => 1,
			'group' => esc_html__( 'Backdrop Filter', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'enable_backdrop_filter',
				'not_empty' => true
			),
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'backfilter_sepia',
			'heading'     => esc_html__( 'Sepia', 'landinghub-core' ),
			'description' => esc_html__( 'Default: 0', 'landinghub-core' ),
			'min'         => 0,
			'max'         => 5,
			'std'         => 1,
			'step'        => 0.1,
			'group' => esc_html__( 'Backdrop Filter', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'enable_backdrop_filter',
				'not_empty' => true
			),
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'backfilter_opacity',
			'heading'     => esc_html__( 'Backdrop Opacity', 'landinghub-core' ),
			'description' => esc_html__( 'Default: 1', 'landinghub-core' ),
			'min'         => 0,
			'max'         => 1,
			'std'         => 1,
			'step'        => 0.1,
			'group' => esc_html__( 'Backdrop Filter', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'enable_backdrop_filter',
				'not_empty' => true
			),
		),
	);

	$hover_move_effect = array(

		array(
			'type'         => 'checkbox',
			'param_name'   => 'enable_hover_move',
			'heading'      => esc_html__( 'Enable Hover Move?', 'landinghub-core' ),
			'description'  => esc_html__( 'Enable to add a moving effect when hoverin over the column.', 'landinghub-core' ),
			'value'        => array( esc_html__( 'Yes', 'landinghub-core' ) => 'lqd-column-move-onhover' ),
			'weight' => 1
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Moving Value', 'landinghub-core' ),
			'param_name'  => 'hover_move_value',
			'value'       => '-3px',
			'description' => esc_html__( 'How much you want the column to move when hevered. Value can be negative or positive.', 'landinghub-core' ),
			'dependency'  => array(
				'element'   => 'enable_hover_move',
				'not_empty' => true,
			),
			'weight'        => 1,
		),

	);

	$enable_cc_circle_params = array (
		array(
			'type'         => 'checkbox',
			'param_name'   => 'enable_cc_circle',
			'heading'      => esc_html__( 'Enable Custom Cursor Overlay?', 'landinghub-core' ),
			'description'  => esc_html__( 'Enable to show an overlay circle when hovering over the row. This option only works when custom cursor is enabled from Theme Options.', 'landinghub-core' ),
			'value'        => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			'weight' => 1
		),
		array(
			'type'       => 'liquid_colorpicker',
			'param_name' => 'cc_circle_color',
			'heading'    => esc_html__( 'Circle Color', 'landinghub-core' ),
			'description'  => esc_html__( 'Custom cursor circle color.', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'enable_cc_circle',
				'not_empty' => true,
			),
			'weight' => 1
		),
	);
	
	$extra_params = array(
		array(
			'type'        => 'el_id',
			'heading'     => esc_html__( 'Element ID', 'landinghub-core' ),
			'param_name'  => 'el_id',
			'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'landinghub-core' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'landinghub-core' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'landinghub-core' ),
		),
	);
	
	$paralax_params = array(
		//Paralax settings for vc_column and vc_column_inner
		array(
			'type'        => 'subheading',
			'param_name'  => 'prlx_from',
			'heading'     => esc_html__( 'Parallax "From" Options', 'landinghub-core' ),
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'translate_from_x',
			'heading'     => esc_html__( 'Translate X', 'landinghub-core' ),
			'description' => esc_html__( 'Select translate on X axe', 'landinghub-core' ),
			'min'         => -500,
			'max'         => 500,
			'step'        => 1,
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),

		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'translate_from_y',
			'heading'     => esc_html__( 'Translate Y', 'landinghub-core' ),
			'description' => esc_html__( 'Select translate on Y axe', 'landinghub-core' ),
			'min'         => -500,
			'max'         => 500,
			'step'        => 1,
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),

		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'translate_from_z',
			'heading'     => esc_html__( 'Translate Z', 'landinghub-core' ),
			'description' => esc_html__( 'Select translate on Z axe', 'landinghub-core' ),
			'min'         => -500,
			'max'         => 500,
			'step'        => 1,
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),

		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'scale_from_x',
			'heading'     => esc_html__( 'Scale X', 'landinghub-core' ),
			'description' => esc_html__( 'Select Scale X', 'landinghub-core' ),
			'min'         => 0,
			'max'         => 10,
			'step'        => 0.05,
			'std'         => 1,
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),
			// 'edit_field_class' => 'vc_col-sm-4',

		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'scale_from_y',
			'heading'     => esc_html__( 'Scale Y', 'landinghub-core' ),
			'description' => esc_html__( 'Select Scale Y', 'landinghub-core' ),
			'min'         => 0,
			'max'         => 10,
			'step'        => 0.05,
			'std'         => 1,
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),
			// 'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'rotate_from_x',
			'heading'     => esc_html__( 'Rotate X', 'landinghub-core' ),
			'description' => esc_html__( 'Select rotate degree on X axe', 'landinghub-core' ),
			'min'         => -360,
			'max'         => 360,
			'step'        => 1,
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),

		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'rotate_from_y',
			'heading'     => esc_html__( 'Rotate Y', 'landinghub-core' ),
			'description' => esc_html__( 'Select rotate degree on Y axe', 'landinghub-core' ),
			'min'         => -360,
			'max'         => 360,
			'step'        => 1,
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),

		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'rotate_from_z',
			'heading'     => esc_html__( 'Rotate Z', 'landinghub-core' ),
			'description' => esc_html__( 'Select rotate degree on Z axe', 'landinghub-core' ),
			'min'         => -360,
			'max'         => 360,
			'step'        => 1,
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),

		),
		array(
			'type'        => 'dropdown',
			'param_name'  => 'from_torigin_x',
			'heading'     => esc_html__( 'Transform Origin X', 'landinghub-core' ),
			'description' => esc_html__( 'Select or add transform origin X axe', 'landinghub-core' ),
			'value'       => array(
				esc_html__( 'None', 'landinghub-core' )   => '',
				esc_html__( 'Left', 'landinghub-core' )   => 'left',
				esc_html__( 'Center', 'landinghub-core' ) => 'center',
				esc_html__( 'Right', 'landinghub-core' )  => 'right',
				esc_html__( 'Custom', 'landinghub-core' ) => 'custom',
			),
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),
			// 'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type'        => 'textfield',
			'param_name'  => 'from_torigin_x_custom',
			'heading'     => esc_html__( 'Custom value for X-asex', 'landinghub-core' ),
			'description' => esc_html__( 'Add custom value for transform-origin X axe in px or %', 'landinghub-core' ),
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'from_torigin_x',
				'value'   => 'custom',
			),
			// 'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type'        => 'dropdown',
			'param_name'  => 'from_torigin_y',
			'heading'     => esc_html__( 'Transform Origin Y', 'landinghub-core' ),
			'description' => esc_html__( 'Select or add transform origin Y axe', 'landinghub-core' ),
			'value'       => array(
				esc_html__( 'None', 'landinghub-core' )   => '',
				esc_html__( 'Top', 'landinghub-core' )    => 'top',
				esc_html__( 'Center', 'landinghub-core' ) => 'center',
				esc_html__( 'Bottom', 'landinghub-core' ) => 'bottom',
				esc_html__( 'Custom', 'landinghub-core' ) => 'custom',
			),
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),
			// 'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type'        => 'textfield',
			'param_name'  => 'from_torigin_y_custom',
			'heading'     => esc_html__( 'Custom value for Y-asex', 'landinghub-core' ),
			'description' => esc_html__( 'Add custom value for transform-origin Y axe in px or %', 'landinghub-core' ),
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'from_torigin_y',
				'value'   => 'custom',
			),
			// 'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'from_opacity',
			'heading'     => esc_html__( 'Opacity', 'landinghub-core' ),
			'description' => esc_html__( 'Set opacity', 'landinghub-core' ),
			'min'         => 0,
			'max'         => 1,
			'step'        => 0.1,
			'std'         => 1,
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),

		),
		//parallax custom code textarea
		array(
			'type'        => 'textarea',
			'param_name'  => 'parallax_from',
			'heading'     => esc_html__( 'Parallax "From" Custom Options', 'landinghub-core' ),
			'description' => esc_html__( 'Parallax custom options to add to data-paralax-from attribute, will override all options above', 'landinghub-core' ),
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),
		),
		array(
			'type'        => 'subheading',
			'param_name'  => 'prlx_to',
			'heading'     => esc_html__( 'Parallax "To" Options', 'landinghub-core' ),
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'translate_to_x',
			'heading'     => esc_html__( 'Translate X', 'landinghub-core' ),
			'description' => esc_html__( 'Select translate on X axe', 'landinghub-core' ),
			'min'         => -500,
			'max'         => 500,
			'step'        => 1,
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),

		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'translate_to_y',
			'heading'     => esc_html__( 'Translate Y', 'landinghub-core' ),
			'description' => esc_html__( 'Select translate on Y axe', 'landinghub-core' ),
			'min'         => -500,
			'max'         => 500,
			'step'        => 1,
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),

		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'translate_to_z',
			'heading'     => esc_html__( 'Translate Z', 'landinghub-core' ),
			'description' => esc_html__( 'Select translate on Z axe', 'landinghub-core' ),
			'min'         => -500,
			'max'         => 500,
			'step'        => 1,
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),

		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'scale_to_x',
			'heading'     => esc_html__( 'Scale X', 'landinghub-core' ),
			'description' => esc_html__( 'Select Scale X', 'landinghub-core' ),
			'min'         => 0,
			'max'         => 10,
			'step'        => 0.05,
			'std'         => 1,
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),
			// 'edit_field_class' => 'vc_col-sm-4',

		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'scale_to_y',
			'heading'     => esc_html__( 'Scale Y', 'landinghub-core' ),
			'description' => esc_html__( 'Select Scale Y', 'landinghub-core' ),
			'min'         => 0,
			'max'         => 10,
			'step'        => 0.05,
			'std'         => 1,
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),
			// 'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'rotate_to_x',
			'heading'     => esc_html__( 'Rotate X', 'landinghub-core' ),
			'description' => esc_html__( 'Select rotate degree on X axe', 'landinghub-core' ),
			'min'         => -360,
			'max'         => 360,
			'step'        => 1,
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),

		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'rotate_to_y',
			'heading'     => esc_html__( 'Rotate Y', 'landinghub-core' ),
			'description' => esc_html__( 'Select rotate degree on Y axe', 'landinghub-core' ),
			'min'         => -360,
			'max'         => 360,
			'step'        => 1,
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),

		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'rotate_to_z',
			'heading'     => esc_html__( 'Rotate Z', 'landinghub-core' ),
			'description' => esc_html__( 'Select rotate degree on Z axe', 'landinghub-core' ),
			'min'         => -360,
			'max'         => 360,
			'step'        => 1,
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),

		),
		array(
			'type'        => 'dropdown',
			'param_name'  => 'to_torigin_x',
			'heading'     => esc_html__( 'Transform Origin X', 'landinghub-core' ),
			'description' => esc_html__( 'Select or add transform origin X axe', 'landinghub-core' ),
			'value'       => array(
				esc_html__( 'None', 'landinghub-core' )   => '',
				esc_html__( 'Left', 'landinghub-core' )   => '0%',
				esc_html__( 'Center', 'landinghub-core' ) => '50%',
				esc_html__( 'Right', 'landinghub-core' )  => '100%',
				esc_html__( 'Custom', 'landinghub-core' ) => 'custom',
			),
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),
			// 'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type'        => 'textfield',
			'param_name'  => 'to_torigin_x_custom',
			'heading'     => esc_html__( 'Custom value for X-asex', 'landinghub-core' ),
			'description' => esc_html__( 'Add custom value for transform-origin X axe in px or %', 'landinghub-core' ),
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'to_torigin_x',
				'value'   => 'custom',
			),
			// 'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type'        => 'dropdown',
			'param_name'  => 'to_torigin_y',
			'heading'     => esc_html__( 'Transform Origin Y', 'landinghub-core' ),
			'description' => esc_html__( 'Select or add transform origin Y axe', 'landinghub-core' ),
			'value'       => array(
				esc_html__( 'None', 'landinghub-core' )   => '',
				esc_html__( 'Top', 'landinghub-core' )    => '0%',
				esc_html__( 'Center', 'landinghub-core' ) => '50%',
				esc_html__( 'Bottom', 'landinghub-core' ) => '100%',
				esc_html__( 'Custom', 'landinghub-core' ) => 'custom',
			),
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),
			// 'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type'        => 'textfield',
			'param_name'  => 'to_torigin_y_custom',
			'heading'     => esc_html__( 'Custom value for Y-asex', 'landinghub-core' ),
			'description' => esc_html__( 'Add custom value for transform-origin Y axe in px or %', 'landinghub-core' ),
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'to_torigin_y',
				'value'   => 'custom',
			),
			// 'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type'        => 'liquid_slider',
			'param_name'  => 'to_opacity',
			'heading'     => esc_html__( 'Opacity', 'landinghub-core' ),
			'description' => esc_html__( 'Set opacity', 'landinghub-core' ),
			'min'         => 0,
			'max'         => 1,
			'step'        => 0.1,
			'std'         => 1,
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),

		),
		array(
			'type'        => 'textarea',
			'param_name'  => 'parallax_to',
			'heading'     => esc_html__( 'Parallax To', 'landinghub-core' ),
			'description' => esc_html__( 'Parallax custom options to add to data-paralax-from attribute', 'landinghub-core' ),
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),
		),
		array(
			'type'        => 'subheading',
			'param_name'  => 'prlx_common',
			'heading'     => esc_html__( 'Parallax Settings', 'landinghub-core' ),
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),
		),
		array(
			'type'        => 'textfield',
			'param_name'  => 'to_delay',
			'heading'     => esc_html__( 'Delay', 'landinghub-core' ),
			'description' => esc_html__( 'Add delay time in seconds', 'landinghub-core' ),
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),
		),
		array(
			'type'        => 'dropdown',
			'param_name'  => 'to_easy',
			'heading'     => esc_html__( 'Easing', 'landinghub-core' ),
			'value'       => array(
				'linear',
				'power1.in',
				'power2.in',
				'power3.in',
				'power4.in',
				'sine.in',
				'expo.in',
				'circ.in',
				'back.in',
				'bounce.in',
				'elastic.in(1,0.2)',
				'power1.out',
				'power2.out',
				'power3.out',
				'power4.out',
				'sine.out',
				'expo.out',
				'circ.out',
				'back.out',
				'bounce.out',
				'elastic.out(1,0.2)',
				'power1.inOut',
				'power2.inOut',
				'power3.inOut',
				'power4.inOut',
				'sine.inOut',
				'expo.inOut',
				'circ.inOut',
				'back.inOut',
				'bounce.inOut',
				'elastic.inOut(1,0.2)',
			),
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),
		),
		array(
			'type'        => 'textfield',
			'param_name'  => 'parallax_offset',
			'heading'     => esc_html__( 'Parallax Offset', 'landinghub-core' ),
			'description' => esc_html__( 'Offset number', 'landinghub-core' ),
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),
			// 'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type'       => 'dropdown',
			'param_name' => 'parallax_trigger',
			'heading'    => esc_html__( 'Parallax Trigger', 'landinghub-core' ),
			'value' => array(
				esc_html__( 'On Enter', 'landinghub-core' )  => 'top bottom',
				esc_html__( 'On Leave', 'landinghub-core' ) => 'top top',
				esc_html__( 'On Center', 'landinghub-core' ) => 'center center',
				esc_html__( 'Custom', 'landinghub-core' ) => 'number',
			),
			'std'        => 'top bottom',
			'group'      => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency' => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),
			// 'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type'        => 'textfield',
			'param_name'  => 'parallax_trigger_number',
			'heading'     => esc_html__( 'Parallax Trigger Number', 'landinghub-core' ),
			// 'description' => esc_html__( 'Input trigger number value from 0 to 1', 'landinghub-core' ),
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'parallax_trigger',
				'value'   => 'number'
			),
			// 'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type'        => 'textfield',
			'param_name'  => 'parallax_duration',
			'heading'     => esc_html__( 'Increase/Decrease Duration', 'landinghub-core' ),
			'description' => esc_html__( 'You can modify the duration. Add +=NUMBER to increase or -=NUMBER to decrease the duration. You can also add % after the number for responsive valuse.', 'landinghub-core' ),
			'group'       => esc_html__( 'Parallax Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'parallax',
				'value'   => 'yes'
			),
			// 'edit_field_class' => 'vc_col-sm-6',
		),
	);	
	
	$shadow_box_params = array(
		//Overlay
		array(
			'type'             => 'textfield',
			'param_name'       => 'custom_border_radius',
			'heading'          => esc_html__( 'Custom Border Radius', 'landinghub-core' ),
			'description'      => esc_html__( 'Enter custom border radius in px or %', 'landinghub-core' ),
			'group'            => esc_html__( 'Design Options', 'landinghub-core' ),
			// 'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type'        => 'checkbox',
			'param_name'  => 'enable_overlay',
			'heading'     => esc_html__( 'Enable Overlay', 'landinghub-core' ),
			'description' => esc_html__( 'If checked, overlay will be enabled', 'landinghub-core' ),
			'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
		),
		array(
			'type'        => 'checkbox',
			'param_name'  => 'overlay_bring_front',
			'heading'     => esc_html__( 'Bring Overlay To Front', 'landinghub-core' ),
			'description' => esc_html__( 'Enable this option if you want the overlay to overlap the content.', 'landinghub-core' ),
			'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'enable_overlay',
				'not_empty' => true,
			),
		),
		array(
			'type'       => 'liquid_colorpicker',
			'param_name' => 'overlay_bg',
			'heading'    => esc_html__( 'Overlay Background', 'landinghub-core' ),
			'description'  => esc_html__( 'Set overlay background', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'enable_overlay',
				'not_empty' => true,
			),
			// 'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Design Options', 'landinghub-core' ),	
		),
		array(
			'type'       => 'liquid_colorpicker',
			'param_name' => 'hover_overlay_bg',
			'heading'    => esc_html__( 'Hover Overlay Background', 'landinghub-core' ),
			'description'  => esc_html__( 'Set hover overlay background', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'enable_overlay',
				'not_empty' => true,
			),
			// 'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Design Options', 'landinghub-core' ),	
		),
		array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Enable column box-shadow?', 'landinghub-core' ),
			'param_name'  => 'enable_column_shadowbox',
			'description' => esc_html__( 'If checked, the column box-shadow options will be visible', 'landinghub-core' ),
			'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
			// 'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Enable column hover box-shadow?', 'landinghub-core' ),
			'param_name'  => 'enable_column_hover_shadowbox',
			'description' => esc_html__( 'If checked, the column hover box-shadow options will be visible', 'landinghub-core' ),
			'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
			// 'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type'        => 'liquid_colorpicker',
			'param_name'  => 'gradient_bg_color',
			'only_gradient' => true,
			'heading'     => esc_html__( 'Gradient Background Color', 'landinghub-core' ),
			'description' => esc_html__( 'Pick gradient backround color for the column', 'landinghub-core' ),
			'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
			// 'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type' => 'param_group',
			'heading' => esc_html__( 'Column Shadow Box Options', 'landinghub-core' ),
			'param_name' => 'column_box_shadow',
			'dependency' => array(
				'element' => 'enable_column_shadowbox',
				'not_empty' => true,
			),
			'group'  => esc_html__( 'Design Options', 'landinghub-core' ),
			'params' => array(
				array(
					'type'        => 'dropdown',
					'param_name'  => 'inset',
					'heading'     => esc_html__( 'Inset', 'landinghub-core' ),
					'description' => esc_html__(  'Select if it is inset', 'landinghub-core' ),
					'value'      => array(
						esc_html__( 'No', 'landinghub-core' )  => '',
						esc_html__( 'Yes', 'landinghub-core' ) => 'inset',
					),
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'x_offset',
					'heading'     => esc_html__( 'Position X', 'landinghub-core' ),
					'description' => esc_html__(  'Set position X in px', 'landinghub-core' ),
					// 'edit_field_class' => 'vc_col-sm-6'
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'y_offset',
					'heading'     => esc_html__( 'Position Y', 'landinghub-core' ),
					'description' => esc_html__(  'Set position Y in px', 'landinghub-core' ),
					// 'edit_field_class' => 'vc_col-sm-6'
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'blur_radius',
					'heading'     => esc_html__( 'Blur Radius', 'landinghub-core' ),
					'description' => esc_html__(  'Add blur radius in px', 'landinghub-core' ),
					// 'edit_field_class' => 'vc_col-sm-6'
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'spread_radius',
					'heading'     => esc_html__( 'Spread Radius', 'landinghub-core' ),
					'description' => esc_html__(  'Add spread radius in px', 'landinghub-core' ),
					// 'edit_field_class' => 'vc_col-sm-6'
				),
				array(
					'type'        => 'liquid_colorpicker',
					'only_solid'  => true,
					'param_name'  => 'shadow_color',
					'heading'     => esc_html__( 'Color', 'landinghub-core' ),
					'description' => esc_html__(  'Pick a color for shadow', 'landinghub-core' ),
					// 'edit_field_class' => 'vc_col-sm-6'
				),

			),	
		
		),
		
		array(
			'type' => 'param_group',
			'heading' => esc_html__( 'Column Hover Shadow Box Options', 'landinghub-core' ),
			'param_name' => 'column_hover_box_shadow',
			'dependency' => array(
				'element' => 'enable_column_hover_shadowbox',
				'not_empty' => true,
			),
			'group'  => esc_html__( 'Design Options', 'landinghub-core' ),
			'params' => array(
				array(
					'type'        => 'dropdown',
					'param_name'  => 'inset',
					'heading'     => esc_html__( 'Inset', 'landinghub-core' ),
					'description' => esc_html__(  'Select if it is inset', 'landinghub-core' ),
					'value'      => array(
						esc_html__( 'No', 'landinghub-core' )  => '',
						esc_html__( 'Yes', 'landinghub-core' ) => 'inset',
					),
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'x_offset',
					'heading'     => esc_html__( 'Position X', 'landinghub-core' ),
					'description' => esc_html__(  'Set position X in px', 'landinghub-core' ),
					// 'edit_field_class' => 'vc_col-sm-6'
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'y_offset',
					'heading'     => esc_html__( 'Position Y', 'landinghub-core' ),
					'description' => esc_html__(  'Set position Y in px', 'landinghub-core' ),
					// 'edit_field_class' => 'vc_col-sm-6'
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'blur_radius',
					'heading'     => esc_html__( 'Blur Radius', 'landinghub-core' ),
					'description' => esc_html__(  'Add blur radius in px', 'landinghub-core' ),
					// 'edit_field_class' => 'vc_col-sm-6'
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'spread_radius',
					'heading'     => esc_html__( 'Spread Radius', 'landinghub-core' ),
					'description' => esc_html__(  'Add spread radius in px', 'landinghub-core' ),
					// 'edit_field_class' => 'vc_col-sm-6'
				),
				array(
					'type'        => 'liquid_colorpicker',
					'only_solid'  => true,
					'param_name'  => 'shadow_color',
					'heading'     => esc_html__( 'Color', 'landinghub-core' ),
					'description' => esc_html__(  'Pick a color for shadow', 'landinghub-core' ),
					// 'edit_field_class' => 'vc_col-sm-6'
				)

			),
		),	
	);

	$column_mobile_move_to_top = array(
		array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Move Column To Top On Tablet?', 'landinghub-core' ),
			'param_name'  => 'column_top_ontablet',
			'description' => esc_html__( 'Enable this option if you want to move the column to top of the row on tablet. If you have this option enabled on columns before this column, this one will place after those.', 'landinghub-core' ),
			'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			'group' => esc_html__( 'Width-Alignment', 'landinghub-core' ),
		),
		array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Move Column To Top On Mobile?', 'landinghub-core' ),
			'param_name'  => 'column_top_onmobile',
			'description' => esc_html__( 'Enable this option if you want to move the column to top of the row on mobile. If you have this option enabled on columns before this column, this one will place after those.', 'landinghub-core' ),
			'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			'group' => esc_html__( 'Width-Alignment', 'landinghub-core' ),
		)
	);
	
	$responsive_alignment_params = array(
		array(
			'type'        => 'responsive_alignment',
			'param_name'  => 'responsive_align',
			'heading'     => esc_html__( 'Responsive text alignment', 'landinghub-core' ),
			'description' => esc_html__( 'Text alignment inside the column with responsiveness', 'landinghub-core' ),
			'group' => esc_html__( 'Width-Alignment', 'landinghub-core' ),
		),
	);
	
	vc_add_params( 'vc_column', $enable_cc_circle_params );

	vc_add_params( 'vc_column', $paralax_params );
	vc_add_params( 'vc_column_inner', $paralax_params );
	
	vc_add_params( 'vc_column', $shadow_box_params );
	vc_add_params( 'vc_column_inner', $shadow_box_params );

	vc_add_params( 'vc_column', $custom_animation_params );
	vc_add_params( 'vc_column_inner', $custom_animation_params );
	
	vc_add_params( 'vc_column', $column_mobile_move_to_top );
	vc_add_params( 'vc_column_inner', $column_mobile_move_to_top );
	
	vc_add_params( 'vc_column', $responsive_alignment_params );
	vc_add_params( 'vc_column_inner', $responsive_alignment_params );
	
	vc_add_params( 'vc_column', $backdrop_filter );
	vc_add_params( 'vc_column_inner', $backdrop_filter );

	vc_add_params( 'vc_column', $hover_move_effect );
	vc_add_params( 'vc_column_inner', $hover_move_effect );
	
	vc_add_params( 'vc_column', $extra_params );
	vc_add_params( 'vc_column_inner', $extra_params );
	
	
	
}
//liquid_columns_extras();
add_action( 'vc_after_init', 'liquid_columns_extras' );

function liquid_background_position_params() {
	
	vc_remove_param( 'vc_column', 'css' );

	$params = array(

		array(
			'type'       => 'responsive_css_editor',
			'heading'    => esc_html__( 'Responsive CSS Box', 'landinghub-core' ),
			'param_name' => 'responsive_css',
			'group'      => esc_html__( 'Design Options', 'landinghub-core' ),
			'weight'     => 1
		),
		array(
			'type'        => 'css_editor',
			'heading'     => esc_html__( 'CSS box', 'landinghub-core' ),
			'param_name'  => 'css',
			'weight'      => 1,
			'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'bg_position',
			'heading' => esc_html__( 'Background Position', 'landinghub-core' ),
			'value' => array(
				esc_html__( 'Default', 'landinghub-core' )         => '',
				esc_html__( 'Center Bottom', 'landinghub-core' )   => 'center bottom',
				esc_html__( 'Center Center', 'landinghub-core' )   => 'center center',
				esc_html__( 'Center Top', 'landinghub-core' )      => 'center top',
				esc_html__( 'Left Bottom', 'landinghub-core' )     => 'left bottom',
				esc_html__( 'Left Center', 'landinghub-core' )     => 'left center',
				esc_html__( 'Left Top', 'landinghub-core' )        => 'left top',
				esc_html__( 'Right Bottom', 'landinghub-core' )    => 'right bottom',
				esc_html__( 'Right Center', 'landinghub-core' )    => 'right center',
				esc_html__( 'Right Top', 'landinghub-core' )       => 'right top',
				esc_html__( 'Custom Position', 'landinghub-core' ) => 'custom',
			),
			'group' => esc_html__( 'Design Options', 'landinghub-core' ),
		),

		array(
			'type'             => 'textfield',
			'param_name'       => 'bg_pos_h',
			'heading'          => esc_html__( 'Horizontal Position', 'landinghub-core' ),
			'description'      => esc_html__( 'Enter custom horizontal position in px or %', 'landinghub-core' ),
			'group'            => esc_html__( 'Design Options', 'landinghub-core' ),
			// 'edit_field_class' => 'vc_col-sm-6',
			'dependency'  => array(
				'element' => 'bg_position',
				'value'   => 'custom'
			)
		),

		array(
			'type'             => 'textfield',
			'param_name'       => 'bg_pos_v',
			'heading'          => esc_html__( 'Vertical Position', 'landinghub-core' ),
			'description'      => esc_html__( 'Enter custom vertical position in px or %', 'landinghub-core' ),
			'group'            => esc_html__( 'Design Options', 'landinghub-core' ),
			// 'edit_field_class' => 'vc_col-sm-6',
			'dependency'  => array(
				'element' => 'bg_position',
				'value'   => 'custom'
			)
		),

	);

	vc_add_params( 'vc_row_inner', $params );
	vc_add_params( 'vc_column', $params );
	vc_add_params( 'vc_column_inner', $params );

}
add_action( 'vc_after_init', 'liquid_background_position_params' );

//Add vc_custom_heading extra options
function liquid_extends_vc_custom_heading() {
	
		vc_update_shortcode_param( 'vc_custom_heading', array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Text source', 'landinghub-core' ),
				'param_name' => 'source',
				'value'      => array(
					esc_html__( 'Custom text', 'landinghub-core' ) => '',
					esc_html__( 'Post or Page Title', 'landinghub-core' ) => 'post_title',
				),
				'std'         => '',
				'description' => esc_html__( 'Select text source.', 'landinghub-core' ),
				'weight'      => 1
			)
		);
		vc_update_shortcode_param( 'vc_custom_heading', array(
				'type'        => 'textarea',
				'heading'     => esc_html__( 'Text', 'landinghub-core' ),
				'param_name'  => 'text',
				'admin_label' => true,
				'value'       => esc_html__( 'This is custom heading element', 'landinghub-core' ),
				'description' => esc_html__( 'Note: If you are using non-latin characters be sure to activate them under Settings/WPBakery Page Builder/General Settings.', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'source',
					'is_empty' => true,
				),
				'weight' => 1
			)
		);
		vc_update_shortcode_param( 'vc_custom_heading', array(
				'type'        => 'vc_link',
				'heading'     => esc_html__( 'URL (Link)', 'landinghub-core' ),
				'param_name'  => 'link',
				'description' => esc_html__( 'Add link to custom heading.', 'landinghub-core' ),
				'weight'      => 1
			)
		);
		vc_update_shortcode_param( 'vc_custom_heading', array(
				'type'        => 'font_container',
				'param_name'  => 'font_container',
				'value'       => 'tag:h2|text_align:left',
				'settings'    => array(
					'fields'  => array(
						'tag' => 'h2',
						// default value h2
						'text_align',
						'font_size',
						'line_height',
						'color',
						'tag_description'         => esc_html__( 'Select element tag.', 'landinghub-core' ),
						'text_align_description'  => esc_html__( 'Select text alignment.', 'landinghub-core' ),
						'font_size_description'   => esc_html__( 'Enter font size.', 'landinghub-core' ),
						'line_height_description' => esc_html__( 'Enter line height.', 'landinghub-core' ),
						'color_description'       => esc_html__( 'Select heading color.', 'landinghub-core' ),
					),
				),
				'weight' => 1
			)
		);

	$params = array(

		array(
			'type'        => 'textfield',
			'param_name'  => 'letter_spacing',
			'heading'     => esc_html__( 'Letter Spacing', 'landinghub-core' ),
			'description' => esc_html__( 'Add letter spacing', 'landinghub-core' ),
			'weight'      => 1
		),
		array(
			'type'       => 'checkbox',
			'param_name' => 'enable_gradient',
			'heading'    => esc_html__( 'Enable Gradient color', 'landinghub-core' ),
			'value'      => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			'weight'     => 1
		),
		array(
			'type'          => 'liquid_colorpicker',
			'only_gradient' => true,
			'param_name'    => 'gradient_color',
			'heading'       => esc_html__( 'Gradient Color', 'landinghub-core' ),
			'description'   => esc_html__( 'Add gradient color to text' ),
			'dependency'    => array(
				'element'   => 'enable_gradient',
				'not_empty' => true
			),
			'weight'        => 1
		),
		array(
			'type'       => 'checkbox',
			'param_name' => 'enable_fittext',
			'heading'    => esc_html__( 'Enable fitText', 'landinghub-core' ),
			'value'      => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			'weight' => 1
		),
		array(
			'type'        => 'textfield',
			'param_name'  => 'fittex_size',
			'heading'     => esc_html__( 'fitText Max size', 'landinghub-core' ),
			'description' => esc_html__( 'Add Max text size in px ex. 75px', 'landinghub-core' ),
			'dependency'  => array(
				'element'   => 'enable_fittext',
				'not_empty' => true
			),
			'weight' => 1
		),

	);

	vc_add_params( 'vc_custom_heading', $params );
	
	vc_update_shortcode_param( 'vc_custom_heading', array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'Use theme default font family?', 'landinghub-core' ),
			'param_name' => 'use_theme_fonts',
			'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			'description' => esc_html__( 'Use font family from the theme.', 'landinghub-core' ),
			'weight' => 1,
			'std' => 'yes',
		)
	);
	
}
add_action( 'vc_after_init', 'liquid_extends_vc_custom_heading' );