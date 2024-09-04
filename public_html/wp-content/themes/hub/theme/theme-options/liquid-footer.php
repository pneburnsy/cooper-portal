<?php
/*
 * Footer Section
*/

$this->sections[] = array(
	'title'  => esc_html__( 'Footer', 'hub' ),
	'icon'   => 'el-icon-photo',
	'fields' => array(
		array(
			'id'       => 'footer-enable-switch',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Enable footer', 'hub' ),
			'subtitle' => esc_html__( 'If on, this layout part will be displayed.', 'hub' ),
			'options'  => array(
				'on'  => esc_html__( 'On', 'hub' ),
				'off' => esc_html__( 'Off', 'hub' ),
			)
		),
		array(
 			'id'=>'footer-template',
 			'type' => 'select',
 			'title' => esc_html__('Footer template', 'hub'),
 			'subtitle'=> esc_html__('Select a footer template for your website.', 'hub'),
 			'data' => 'post',
			'args' => array( 'post_type' => 'liquid-footer', 'posts_per_page' => -1 )
 		),
		array(
			'id'      => 'footer-force',
			'type'	  => 'button_set',
			'title'   => esc_html__( 'Force footer template site-wide?', 'hub' ),
			'subtitle'   => esc_html__( 'Override single post/page footer settings to show the same footer template site-wide', 'hub' ),
			'options' => array(
				'off'    => esc_html__( 'No', 'hub' ),
				'on' => esc_html__( 'Yes', 'hub' ),
			),
			'default' => 'off',
			'required' => array(
                'footer-template',
                '!=',
                ''
            ),
		),
	)
);
