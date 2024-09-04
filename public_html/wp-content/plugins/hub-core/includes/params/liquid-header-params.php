<?php
// New Params for Row header functionality

function liquid_row_header_params() {
	
	$headers_params = array(
		array(
			'type' => 'checkbox',
			'heading' => __( 'Fullwidth?', 'landinghub-core' ),
			'description' => esc_html__( 'Enable to make header fullwidth', 'landinghub-core' ),
			'param_name' => 'header_full_width',
			'value' => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			'weight' => 1,
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Hide On Sticky Header?', 'landinghub-core' ),
			'description' => esc_html__( 'Enable if you want to hide this section when header is sticky.', 'landinghub-core' ),
			'param_name' => 'hide_on_sticky',
			'value' => array( esc_html__( 'Yes', 'landinghub-core' ) => 'lqd-hide-onstuck' ),
			'weight' => 1,
			'std'    => '',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Show Only On Sticky Header?', 'landinghub-core' ),
			'description' => esc_html__( 'Enable if you want to show this section ONLY when header is sticky.', 'landinghub-core' ),
			'param_name' => 'show_on_sticky',
			'value' => array( esc_html__( 'Yes', 'landinghub-core' ) => 'lqd-show-onstuck' ),
			'weight' => 1,
			'std'    => '',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Vertical Bar?', 'landinghub-core' ),
			'description' => esc_html__( 'Enable to make sticky bar. It will stick to the left or right side of the screen.', 'landinghub-core' ),
			'param_name' => 'sticky_bar',
			'value' => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			'std'    => '',				
			'weight' => 1,
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Vertical Bar position', 'landinghub-core' ),
			'param_name' => 'stickybar_placement',
			'value'      => array(
				esc_html__( 'Left', 'landinghub-core' )  => 'lqd-stickybar-left',
				esc_html__( 'Right', 'landinghub-core' ) => 'lqd-stickybar-right',
			),
			'description' => esc_html__( 'Select vertical bar position within header.', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'sticky_bar',
				'not_empty' => true,
			),
			'edit_field_class' => 'vc_col-sm-6',
			'weight' => 1,
			'save_always' => true,
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Fullscreen Navigation?', 'landinghub-core' ),
			'description' => esc_html__( 'Enable to make fullscreen Navigation', 'landinghub-core' ),
			'param_name' => 'fullscreen_nav',
			'value' => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			'std'    => '',				
			'weight' => 1,
			'dependency'  => array(
				'element' => 'sticky_bar',
				'is_empty' => true,
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type'       => 'liquid_colorpicker',
			'only_solid' => true,
			'param_name' => 'fn_bg',
			'heading'    => esc_html__( 'Fullscreen Navigation Background', 'landinghub-core' ),
			'description'  => esc_html__( 'Add background for fullscreen navigation', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'fullscreen_nav',
				'not_empty' => true,
			),
			'edit_field_class' => 'vc_col-sm-6',
			'weight' => 1,
		),
		array(
			'type'       => 'liquid_colorpicker',
			'only_solid' => true,
			'param_name' => 'fn_border_color',
			'heading'    => esc_html__( 'Fullscreen Navigation Border', 'landinghub-core' ),
			'description'  => esc_html__( 'Color for fullscreen navigation border', 'landinghub-core' ),
			'dependency'  => array(
				'element' => 'fullscreen_nav',
				'not_empty' => true,
			),
			'edit_field_class' => 'vc_col-sm-6',
			'weight' => 1,
		),

	);
	
	vc_add_params( 'vc_row', $headers_params );
	
}
add_action( 'vc_after_init', 'liquid_row_header_params' );

function liquid_column_header_params() {
	
	$headers_params = array(
		array(
			'type'       => 'dropdown',
			'param_name' => 'header_col_width',
			'heading'    => esc_html__( 'Column Width', 'landinghub-core' ),
			'description' => esc_html__( 'Select column width', 'landinghub-core' ),
			'value'       => array(
				esc_html__( 'Expand', 'landinghub-core' ) => 'col',
				__( 'Equal to content\'s widths.', 'landinghub-core' ) => 'col-auto',
			),
			'weight' => 1,
		),
	);	

	vc_add_params( 'vc_column', $headers_params );	
	
}
add_action( 'vc_after_init', 'liquid_column_header_params' );