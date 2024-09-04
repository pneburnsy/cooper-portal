<?php
/*
 * GDPR
*/

if ( !class_exists ( 'Liquid_Gdpr' ) ){
	$gdpr_desc = sprintf(
		wp_kses_post( '<div class="notice-red"> To use this feature, you need to install and activate the <strong>Liquid GDPR</strong> plugin. <a href="%1$s" target="_blank"> Install Plugin</a></div>', 'hub' ),
		admin_url( 'admin.php?page=liquid-setup&step=plugins' )
	);
	$gdpr_fields = array();

} else {
	$gdpr_desc = '';
	$gdpr_fields = array(
		array(
			'id' => 'enable-gdpr',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Enable GDPR', 'hub' ),
			'subtitle' => esc_html__( 'Switch off to disable the GDPR Box', 'hub' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'hub' ),
				'off'  => esc_html__( 'Off', 'hub' ),
			),
			'default' => 'on'
		),
		array(
			'id'       => 'gdpr-button',
			'type'     => 'text',
			'title'    => esc_html__( 'Accept Button Text', 'hub' ),
			'subtitle' => '',
			'default'  => esc_html__( 'Accept', 'hub' ),
			'placeholder' => esc_html__( 'Accept', 'hub' ),
			'required' => array(
				'enable-gdpr',
				'=',
				'on'
			),
		),
		array(
			'id'       => 'gdpr-content',
			'type'     => 'textarea',
			'title'    => esc_html__( 'Content', 'hub' ),
			'subtitle' => '',
			'default'  => esc_html__( 'This website uses cookies to improve your web experience.', 'hub' ),
			'placeholder' => esc_html__( 'This website uses cookies to improve your web experience.', 'hub' ),
			'required' => array(
				'enable-gdpr',
				'=',
				'on'
			),
		),
		array(
			'id'       => 'gdpr-typography-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Custom Typography', 'hub' ),
			'options'  => array(
				'on'  => esc_html__( 'On', 'hub' ),
				'off' => esc_html__( 'Off', 'hub' )
			),
			'default'  => 'off',

		),
		'gdpr-typography' => array(
			'id'             => 'gdpr-typography',
			'title'          => esc_html__( 'Typography', 'hub' ),
			'subtitle'       => esc_html__( 'Manages the typography for the page title', 'hub' ),
			'type'           => 'typography',
			'text-transform' => true,
			'letter-spacing' => true,
			'text-align'     => false,
			'compiler'       => true,
			'color'          => false,
			'units'          => '%',
			'required' => array(
				'gdpr-typography-enable',
				'equals',
				'on'
			),
		),
		array(
			'id'            => 'gdpr-bg-color',
			'type'          => 'liquid_colorpicker',
			'title'    => esc_html__( 'Background', 'hub' ),
			'subtitle' => esc_html__( 'Set GDPR Box Background', 'hub' ),
			'required' => array(
				'enable-gdpr',
				'=',
				'on'
			),
		),
		array(
			'id'            => 'gdpr-color',
			'type'          => 'liquid_colorpicker',
			'only_solid'    => true,
			'title'    => esc_html__( 'Content Color', 'hub' ),
			'required' => array(
				'enable-gdpr',
				'=',
				'on'
			),
		),
		array(
			'id'            => 'gdpr-btn-color',
			'type'          => 'liquid_colorpicker',
			'only_solid'    => true,
			'title'    => esc_html__( 'Button Color', 'hub' ),
			'required' => array(
				'enable-gdpr',
				'=',
				'on'
			),
		),
		array(
			'id'            => 'gdpr-btn-color-hover',
			'type'          => 'liquid_colorpicker',
			'only_solid'    => true,
			'title'    => esc_html__( 'Button Hover Color', 'hub' ),
			'required' => array(
				'enable-gdpr',
				'=',
				'on'
			),
		),
		array(
			'id'            => 'gdpr-btn-bg-color',
			'type'          => 'liquid_colorpicker',
			'title'    => esc_html__( 'Button Background Color', 'hub' ),
			'required' => array(
				'enable-gdpr',
				'=',
				'on'
			),
		),
		array(
			'id'            => 'gdpr-btn-bg-color-hover',
			'type'          => 'liquid_colorpicker',
			'title'    => esc_html__( 'Button Background Hover Color', 'hub' ),
			'required' => array(
				'enable-gdpr',
				'=',
				'on'
			),
		),
		array(
			'id'             => 'gdpr-box-paddings',
			'type'           => 'spacing',
			'mode'           => 'padding',
			'units_extended' => 'false',
			'title'          => __('GDPR Box Padding', 'hub'),
			'subtitle'       => __('Set GDPR Box Padding. Add value with the unit type (px, em, etc.). Example: 1.5em', 'hub'),
			'required' => array(
				'enable-gdpr',
				'=',
				'on'
			),
		),
		array(
			'id'             => 'gdpr-box-radius',
			'type'           => 'spacing',
			'mode'           => 'padding',
			'units_extended' => 'false',
			'title'          => __('GDPR Box Border Radius', 'hub'),
			'subtitle'       => __('Set GDPR Box Border Radius. Add value with the unit type (px, em, etc.). Example: 1.5em', 'hub'),
			'required' => array(
				'enable-gdpr',
				'=',
				'on'
			),
		),
		array(
			'id'             => 'gdpr-btn-paddings',
			'type'           => 'spacing',
			'mode'           => 'padding',
			'units_extended' => true,
			'title'          => __('GDPR Button Padding', 'archub'),
			'subtitle'       => __('Set GDPR Button Padding. Add value with the unit type (px, em, etc.). Example: 1.5em', 'hub'),
			'required' => array(
				'enable-gdpr',
				'=',
				'on'
			),
		),
		array(
			'id'             => 'gdpr-btn-radius',
			'type'           => 'spacing',
			'mode'           => 'padding',
			'units_extended' => 'false',
			'title'          => __('Button Border Radius', 'hub'),
			'subtitle'       => __('Set Button Border Radius. Add value with the unit type (px, em, etc.). Example: 1.5em', 'hub'),
			'required' => array(
				'enable-gdpr',
				'=',
				'on'
			),
		),
	);
}

$this->sections[] = array(
	'title' => esc_html__( 'GDPR Alert', 'hub' ),
	'icon' => 'el-icon-lock',
	'desc' => $gdpr_desc,
	'fields' => $gdpr_fields
);
