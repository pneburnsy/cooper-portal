<?php
/**
* Shortcode Tab
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Tabs extends LD_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug          = 'ld_tabs';
		$this->title         = esc_html__( 'Tabs', 'landinghub-core' );
		$this->description   = esc_html__( 'Tabbed content.', 'landinghub-core' );
		$this->icon          = 'la la-table';
		$this->is_container  = true;
		$this->js_view       = 'VcBackendTtaTabsView';
		$this->as_parent     = array( 'only' => 'ld_tab_section' );
		$this->styles        = array( 'liquid-sc-tabs' );
		$this->show_settings_on_create = true;

		$this->custom_markup = '<div class="vc_tta-container" data-vc-action="collapse">
			<div class="vc_general vc_tta vc_tta-tabs vc_tta-color-backend-tabs-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-spacing-1 vc_tta-tabs-position-top vc_tta-controls-align-left">
				<div class="vc_tta-tabs-container">'
				. '<ul class="vc_tta-tabs-list">'
					. '<li class="vc_tta-tab" data-vc-tab data-vc-target-model-id="{{ model_id }}" data-element_type="ld_tab_section"><a href="javascript:;" data-vc-tabs data-vc-container=".vc_tta" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-target-model-id="{{ model_id }}"><span class="vc_tta-title-text">{{ section_title }}</span></a></li>'
				. '</ul>
				</div>
				<div class="vc_tta-panels vc_clearfix {{container-class}}">
					{{ content }}
				</div>
			</div>
		</div>';

		$this->default_content = '
			[ld_tab_section title="' . sprintf( '%s %d', 'Tab', 1 ) . '"][/ld_tab_section]
			[ld_tab_section title="' . sprintf( '%s %d', 'Tab', 2 ) . '"][/ld_tab_section]';

		$this->admin_enqueue_js = array( vc_asset_url( 'lib/vc_tabs/vc-tabs.min.js' ) );

		if ( vc_is_inline() ) {
			add_action( 'wp_footer', [ $this, 'add_templates' ] );
		}

		parent::__construct();
	}

	public function add_templates() {

		echo $this->get_templates_for_content_wrap();
		echo $this->get_templates_for_nav();

	}

	public function get_content_by_style( string $style = 'style01') {

		$html = '';

		switch ($style) {
			case 'style01': {
				$html .= '<div class="lqd-tabs-content mt-5 mt-sm-0 mb-sm-5">';
				break;
			}
			case 'style02':
			case 'style03':
			case 'style04': {
				$html .= '<div class="lqd-tabs-content mb-5">';
				break;
			}
			case 'style05':
			case 'style06': {
				$html .= '<div class="lqd-tabs-content pl-sm-5 pt-5 pt-sm-0">';
				break;
			}
			case 'style08': {
				$html .= '<div class="lqd-tabs-content pl-md-6">';
				break;
			}
			default: {
				$html .= '<div class="lqd-tabs-content">';
				break;
			}
		}

		$html .= '</div>';

		return $html;

	}

	public function get_templates_for_content_wrap() {

		$styles = [
			'style01',
			'style02',
			'style03',
			'style04',
			'style05',
			'style06',
			'style07',
			'style08',
			'style09',
			'style09b',
			'style09c',
			'style10',
			'style11',
			'style12',
			'style13',
			'style14',
		];

		foreach ( $styles as $key => $style ) {
			$styles[$key] = '<script type="text/html" data-lqd-tab-content-style="' . $style . '">' . $this->get_content_by_style($style) .'</script>';
		}

		return implode('', $styles);

	}

	public function get_templates_for_nav() {

		$styles = [
			'style01',
			'style02',
			'style03',
			'style04',
			'style05',
			'style06',
			'style07',
			'style08',
			'style09',
			'style09b',
			'style09c',
			'style10',
			'style11',
			'style12',
			'style13',
			'style14',
		];

		foreach ( $styles as $key => $style ) {
			$styles[$key] = '<script type="text/html" data-lqd-tab-nav-style="' . $style . '">' . $this->get_nav_by_style($style) . '</script>';
		}

		return implode('', $styles);

	}

	public function get_nav_by_style( string $style = 'style01' ) {

		$classes = [];

		//classes
		switch ($style) {
			case 'style01': {
				$classes[] = 'mb-5 mb-sm-0';
				break;
			}
			case 'style02': {
				$classes[] = 'pb-5';
				break;
			}
			case 'style03':
			case 'style04': {
				$classes[] = 'text-center';
				break;
			}
			case 'style06':
			case 'style09b':
			case 'style10':
			case 'style11':
			case 'style12':{
				$classes[] = 'font-weight-medium';
				break;
			}
			case 'style07': {
				$classes[] = 'font-weight-semibold';
				break;
			}
		}

		$classes = $classes ? ' class="' . implode(' ', $classes) . '"' : '';

		//html
		$html = '';
		switch ($style) {
			case 'style01': {
				$html .= '
<li role="presentation" data-controls="<%=aria_controls%>" data-controls-section="<%=section_id%>" ' . $classes . '>
	<a href="<%=href%>" aria-expanded="false" aria-controls="<%=aria_controls%>" role="tab" data-toggle="tab">
		<span class="iconbox iconbox-circle iconbox-side align-items-center">
			<% if ( icon_class !== "" ) { %>
			<span class="iconbox-icon-wrap">
				<span class="iconbox-icon-container">
					<i class="<%=icon_class%>"></i>
				</span>
			</span>
			<% } %>
			<span class="contents d-flex flex-column">
				<span class="iconbox-title h3 mt-0 mb-3"><%=title%></span>
			<% if (description) { %> <span class="iconbox-desc"><%=description%></span> <% } %>
			</span>
		</span>
	</a>
</li>';
				break;
			}
			case 'style02': {
				$html .= '
<li role="presentation" data-controls="<%=aria_controls%>" data-controls-section="<%=section_id%>" ' . $classes . '>
	<a href="<%=href%>" aria-expanded="false" aria-controls="<%=aria_controls%>" role="tab" data-toggle="tab">
		<span class="iconbox iconbox-square iconbox-side align-items-center">
			<% if ( icon_class !== "" ) { %>
			<span class="iconbox-icon-wrap">
				<span class="iconbox-icon-container">
					<i class="<%=icon_class%>"></i>
				</span>
			</span>
			<% } %>
			<span class="contents d-flex flex-column pr-md-4">
				<span class="iconbox-title h3 mt-0 mb-2"><%=title%></span>
				<% if (description) { %> <span class="iconbox-desc"><%=description%></span> <% } %>
			</span>
		</span>
		<span class="lqd-tabs-nav-progress">
			<span class="lqd-tabs-nav-progress-inner"></span>
		</span>
	</a>
</li>';
				break;
			}
			case 'style03':
			case 'style04': {
				$html .= '
<li role="presentation" data-controls="<%=aria_controls%>" data-controls-section="<%=section_id%>" ' . $classes . '>
	<a href="<%=href%>" aria-controls="<%=aria_controls%>" role="tab" data-toggle="tab">
		<span class="iconbox">
			<% if ( icon_class !== "" ) { %>
			<span class="iconbox-icon-wrap">
				<span class="iconbox-icon-container">
					<i class="<%=icon_class%>"></i>
				</span>
			</span>
			<% } %>
			<span class="contents d-flex flex-column">
				<span class="iconbox-title h3 my-0"><%=title%></span>
			</span>
		</span>
		<span class="lqd-tabs-nav-progress">
			<span class="lqd-tabs-nav-progress-inner"></span>
		</span>
	</a>
</li>';
				break;
			}
			case 'style05': {
				$html .= '
<li role="presentation" data-controls="<%=aria_controls%>" data-controls-section="<%=section_id%>">
	<a href="<%=href%>" aria-controls="<%=aria_controls%>" role="tab" data-toggle="tab" class="p-5 border-radius-7">
		<span class="iconbox iconbox-side mb-0">
			<% if ( icon_class !== "" ) { %>
			<span class="iconbox-icon-wrap">
				<span class="iconbox-icon-container">
					<i class="<%=icon_class%>"></i>
				</span>
			</span>
			<% } %>
			<span class="contents d-flex flex-column">
				<span class="iconbox-title h3 mt-0 mb-3"><%=title%></span>
				<% if (description) { %> <span class="iconbox-desc"><%=description%></span> <% } %>
			</span>
		</span>
	</a>
</li>';
				break;
			}
			case 'style06': {
				$html .= '
<li role="presentation" data-controls="<%=aria_controls%>" data-controls-section="<%=section_id%>" ' . $classes . '>
	<a href="<%=href%>" aria-controls="<%=aria_controls%>" role="tab" data-toggle="tab" class="py-3 round">
		<% if ( icon_class !== "" ) { %>
		<span class="lqd-tabs-nav-icon">
			<i class="<%=icon_class%>"></i>
		</span>
		<% } %>
		<span class="lqd-tabs-nav-txt"><%=title%></span>
	</a>
</li>';
				break;
			}
			case 'style07': {
				$html .= '
<li role="presentation" data-controls="<%=aria_controls%>" data-controls-section="<%=section_id%>" ' . $classes . '>
	<a href="<%=href%>" aria-controls="<%=aria_controls%>" role="tab" data-toggle="tab" class="py-3 px-6 circle">
		<% if ( icon_class !== "" ) { %>
		<span class="lqd-tabs-nav-icon">
			<i class="<%=icon_class%>"></i>
		</span>
		<% } %>
		<span class="lqd-tabs-nav-txt"><%=title%></span>
	</a>
</li>';
				break;
			}
			case 'style08': {
				$html .= '
<li role="presentation" data-controls="<%=aria_controls%>" data-controls-section="<%=section_id%>">
	<a href="<%=href%>" aria-controls="<%=aria_controls%>" role="tab" data-toggle="tab" class="d-flex flex-wrap align-items-center py-1 mb-2">
		<span class="lqd-tabs-nav-txt"><%=title%></span>
	</a>
</li>';
				break;
			}
			case 'style09':
			case 'style09b':
			case 'style09c': {
				$html .= '
<li role="presentation" data-controls="<%=aria_controls%>" data-controls-section="<%=section_id%>">
	<a href="<%=href%>" aria-controls="<%=aria_controls%>" role="tab" data-toggle="tab" class="d-flex justify-content-center">
		<span class="lqd-tabs-nav-txt"><%=title%></span>
	</a>
</li>';
				break;
			}
			case 'style10':
			case 'style11':
			case 'style12': {
				$html .= '
<li role="presentation" data-controls="<%=aria_controls%>" data-controls-section="<%=section_id%>" ' . $classes . '>
	<a href="<%=href%>" aria-controls="<%=aria_controls%>" role="tab" data-toggle="tab" class="d-flex align-items-center">
		<span class="lqd-tabs-nav-txt"><%=title%></span>
	</a>
</li>';
				break;
			}
			case 'style13': {
				$html .= '
<li role="presentation" data-controls="<%=aria_controls%>" data-controls-section="<%=section_id%>" ' . $classes . '>
	<a href="<%=href%>" aria-controls="<%=aria_controls%>" role="tab" data-toggle="tab" class="d-flex flex-wrap align-items-center mb-3">
		<span class="lqd-tabs-nav-txt"><%=title%></span>
		<% if (description) { %> <span class="lqd-tabs-nav-ext"><%=description%></span> <% } %>
	</a>
</li>';
				break;
			}
			case 'style14': {
				$html .= '
<li role="presentation" data-controls="<%=aria_controls%>" data-controls-section="<%=section_id%>" ' . $classes . '>
	<a href="<%=href%>" aria-controls="<%=aria_controls%>" role="tab" data-toggle="tab" class="d-inline-flex align-items-center">
		<span class="lqd-tabs-nav-txt" data-txt="<%=title%>"><span><%=title%><span></span>
	</a>
	<% if (description) { %> <span class="lqd-tabs-nav-ext"><%=description%></span> <% } %>
</li>';
				break;
			}

		}

		return $html;
		
	}

	/**
	 * Get params
	 * @return array
	 */
	public function get_params() {

		$url = liquid_addons()->plugin_uri() . '/assets/img/sc-preview/tabs/';
		
		$button = vc_map_integrate_shortcode( 'ld_button', 'ib_', esc_html__( 'Button', 'landinghub-core' ),
			array(
				'exclude' => array(
					'el_id',
					'el_class',
					'sh_shadowbox',
					'enable_row_shadowbox',
					'button_box_shadow',
					'hover_button_box_shadow'
				),
			),
			array(
				'element' => 'show_button',
				'value'   => 'yes',
			)
		);

		$params = array(

			array(
				'type'        => 'select_preview',
				'param_name'  => 'style',
				'heading'     => esc_html__( 'Style', 'landinghub-core' ),
				'value'       => array(
					array(
						'value' => 'style01',
						'label' => esc_html__( 'Style 1', 'landinghub-core' ),
						'image' => $url . 'style01.jpg'
					),
					array(
						'label' => esc_html__( 'Style 2', 'landinghub-core' ),
						'value' => 'style02',
						'image' => $url . 'style02.jpg'
					),
					array(
						'label' => esc_html__( 'Style 3', 'landinghub-core' ),
						'value' => 'style03',
						'image' => $url . 'style03.jpg'
					),
					array(
						'label' => esc_html__( 'Style 4', 'landinghub-core' ),
						'value' => 'style04',
						'image' => $url . 'style04.jpg'
					),
					array(
						'label' => esc_html__( 'Style 5', 'landinghub-core' ),
						'value' => 'style05',
						'image' => $url . 'style05.jpg'
					),
					array(
						'label' => esc_html__( 'Style 6', 'landinghub-core' ),
						'value' => 'style06',
						'image' => $url . 'style06.jpg'
					),
					array(
						'label' => esc_html__( 'Style 7', 'landinghub-core' ),
						'value' => 'style07',
						'image' => $url . 'style07.jpg'
					),
					array(
						'label' => esc_html__( 'Style 8', 'landinghub-core' ),
						'value' => 'style08',
						'image' => $url . 'style08.jpg'
					),
					array(
						'label' => esc_html__( 'Style 9 A', 'landinghub-core' ),
						'value' => 'style09',
						'image' => $url . 'style09a.jpg'
					),
					array(
						'label' => esc_html__( 'Style 9 B', 'landinghub-core' ),
						'value' => 'style09b',
						'image' => $url . 'style09b.jpg'
					),
					array(
						'label' => esc_html__( 'Style 9 C', 'landinghub-core' ),
						'value' => 'style09c',
						'image' => $url . 'style09c.jpg'
					),
					array(
						'label' => esc_html__( 'Style 10', 'landinghub-core' ),
						'value' => 'style10',
						'image' => $url . 'style10.jpg'
					),
					array(
						'label' => esc_html__( 'Style 11', 'landinghub-core' ),
						'value' => 'style11',
						'image' => $url . 'style11.jpg'
					),
					array(
						'label' => esc_html__( 'Style 12', 'landinghub-core' ),
						'value' => 'style12',
						'image' => $url . 'style12.jpg'
					),
					array(
						'label' => esc_html__( 'Style 13', 'landinghub-core' ),
						'value' => 'style13',
						'image' => $url . 'style13.jpg'
					),
					array(
						'label' => esc_html__( 'Style 14', 'landinghub-core' ),
						'value' => 'style14',
						'image' => $url . 'style14.jpg'
					),
				),
				'save_always' => true,

			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'nav_alignment',
				'heading'    => esc_html__( 'Nav Alignment', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Default', 'landinghub-core' ) => 'justify-content-md-between',
					esc_html__( 'Start', 'landinghub-core' )   => 'justify-content-md-start',
					esc_html__( 'Center', 'landinghub-core' )  => 'justify-content-md-center',
					esc_html__( 'End', 'landinghub-core' )     => 'justify-content-md-end',
				),
				'std' => 'justify-content-md-between',
				'dependency'  => array(
					'element' => 'style',
					'value'  => array( 'style03', 'style09c', 'style11', 'style12' ),
				),
			),
			array(
				'type'       => 'checkbox',
				'param_name' => 'nav_expand',
				'heading'    => esc_html__( 'Expand Nav Items', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Yes', 'landinghub-core' ) => 'yes'
				),
				'std' => 'yes',
				'dependency'  => array(
					'element' => 'style',
					'value'  => array( 'style09', 'style09b' ),
				),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'nav_alignment_style9',
				'heading'    => esc_html__( 'Nav Alignment', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Start', 'landinghub-core' )   => 'justify-content-md-start',
					esc_html__( 'Center', 'landinghub-core' )  => 'justify-content-md-center',
					esc_html__( 'End', 'landinghub-core' )     => 'justify-content-md-end',
				),
				'std' => 'justify-content-md-center',
				'dependency'  => array(
					'element' => 'nav_expand',
					'is_empty'  => true,
				),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'reverse_direction',
				'heading'     => esc_html__( 'Reverse Direction', 'landinghub-core' ),
				'description' => esc_html__( 'Swap the position of nav and content.', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'style',
					'value'  => array( 'style01', 'style02', 'style05', 'style06', 'style08', 'style09', 'style09b', 'style09c', 'style11', 'style12', 'style13' ),
				),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_nav',
				'heading'     => esc_html__( 'Custom font?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use custom font for navigation', 'landinghub-core' ),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'tab_trigger',
				'heading'    => esc_html__( 'Trigger', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Click', 'landinghub-core' ) => 'click',
					esc_html__( 'Hover', 'landinghub-core' ) => 'hover'
				),
				'dependency'  => array(
					'element' => 'style',
					'value_not_equal_to'  => array( 'style14' ),
				),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'enable_deeplinks',
				'heading'     => esc_html__( 'Enable Deeplinks?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to enable deeplinks for navigation', 'landinghub-core' ),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'enable_sticky_nav',
				'heading'     => esc_html__( 'Enable Sticky Nav?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to enable sticky navigation. Useful when you have a long content.', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Yes', 'landinghub-core' ) => 'lqd-css-sticky'
				),
				'dependency'  => array(
					'element' => 'style',
					'value'  => array( 'style06', 'style08' ),
				),
			),
			array(
				'id'          => 'title',
				'dependency'  => array(
					'element' => 'style',
					'value'  => array( 'style06' ),
				),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'show_button',
				'heading'    => esc_html__( 'Show Button', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'No', 'landinghub-core' )  => '',
					esc_html__( 'Yes', 'landinghub-core' ) => 'yes'
				),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 'style05', 'style06', 'style08', 'style11', 'style12', 'style13' ),
				),
			),
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_separator',
				'heading'    => esc_html__( 'Normal State Colors', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'nav_bg_color',
				'heading'     => esc_html__( 'Nav Background Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a background color for tabs navigation.', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 'style09c' ),
				),
				'edit_field_class' => 'vc_column-with-padding vc_col-sm-4',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'primary_color',
				'heading'     => esc_html__( 'Primary Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a primary color for tabs', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to'   => array( 'style08', 'style13' ),
				),
				'edit_field_class' => 'vc_column-with-padding vc_col-sm-4',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'secondary_color',
				'heading'     => esc_html__( 'Secondary Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a primary color for tabs. This will create a gradient', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 'style14' ),
				),
				'edit_field_class' => 'vc_column-with-padding vc_col-sm-4',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'border_color',
				'heading'     => esc_html__( 'Border Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a border color for tabs', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 'style03', 'style09', 'style09b' ),
				),
				'edit_field_class' => 'vc_column-with-padding vc_col-sm-4',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'text_color',
				'heading'     => esc_html__( 'Text Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a text color for tabs', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_column-with-padding vc_col-sm-4',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'title_color',
				'heading'     => esc_html__( 'Title Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a title color for tabs', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 'style01', 'style02', 'style05' ),
				),
				'edit_field_class' => 'vc_column-with-padding vc_col-sm-4',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'icon_bg',
				'heading'     => esc_html__( 'Icon Background', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a background for icon shape', 'landinghub-core' ),
				'edit_field_class' => 'vc_column-with-padding vc_col-sm-4',
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 'style01', 'style02' ),
				),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'icon_color',
				'heading'     => esc_html__( 'Icon Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the icon', 'landinghub-core' ),
				'edit_field_class' => 'vc_column-with-padding vc_col-sm-4',
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 'style01', 'style02', 'style03', 'style04', 'style05', 'style06', 'style07' ),
				),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
			),
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_separator',
				'heading'    => esc_html__( 'Active State Colors', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'primary_hcolor',
				'heading'     => esc_html__( 'Primary Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a primary color for tabs', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_column-with-padding vc_col-sm-4',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'secondary_hcolor',
				'heading'     => esc_html__( 'Secondary Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a primary color for tabs. This will create a gradient', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 'style14' ),
				),
				'edit_field_class' => 'vc_column-with-padding vc_col-sm-4',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'border_hcolor',
				'heading'     => esc_html__( 'Border Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a border color for tabs', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 'style09', 'style09b' ),
				),
				'edit_field_class' => 'vc_column-with-padding vc_col-sm-4',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'text_hcolor',
				'heading'     => esc_html__( 'Text Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a text color for tabs', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to'   => array( 'style14' ),
				),
				'edit_field_class' => 'vc_column-with-padding vc_col-sm-4',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'title_hcolor',
				'heading'     => esc_html__( 'Title Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a title color for tabs', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 'style01', 'style02', 'style05' ),
				),
				'edit_field_class' => 'vc_column-with-padding vc_col-sm-4',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'icon_hbg',
				'heading'     => esc_html__( 'Icon Background', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a background for icon shape', 'landinghub-core' ),
				'edit_field_class' => 'vc_column-with-padding vc_col-sm-4',
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 'style01', 'style02' ),
				),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'icon_hcolor',
				'heading'     => esc_html__( 'Icon Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the icon', 'landinghub-core' ),
				'edit_field_class' => 'vc_column-with-padding vc_col-sm-4',
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 'style01', 'style02', 'style03', 'style04', 'style05', 'style06', 'style07' ),
				),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
			),

			//Typo Options
			array(
				'type'        => 'textfield',
				'param_name'  => 'fs',
				'heading'     => esc_html__( 'Font Size', 'landinghub-core' ),
				'description' => esc_html__( 'Example: 20px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3 vc_column-with-padding',
				'dependency' => array(
					'element' => 'use_custom_fonts_nav',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typography', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'lh',
				'heading'     => esc_html__( 'Line-Height', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_nav',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typography', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'fw',
				'heading'     => esc_html__( 'Font Weight', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_nav',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typography', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'ls',
				'heading'     => esc_html__( 'Letter Spacing', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_nav',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typography', 'landinghub-core' ),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'transform',
				'heading'    => esc_html__( 'Transformation', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Default', 'landinghub-core' )    => '',
					esc_html__( 'Uppercase', 'landinghub-core' )  => 'uppercase',
					esc_html__( 'Lowercase', 'landinghub-core' )  => 'lowercase',
					esc_html__( 'Capitalize', 'landinghub-core' ) => 'capitalize',
				),
				'dependency' => array(
					'element' => 'use_custom_fonts_nav',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typography', 'landinghub-core' ),
			),
			/*
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use for counter theme default font family?', 'landinghub-core' ),
				'param_name'  => 'use_theme_fonts',
				'value'       => array(
					esc_html__( 'Yes', 'landinghub-core' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'landinghub-core' ),
				'group' => esc_html__( 'Typography', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_nav',
					'value'   => 'true',
				),
				'std'         => 'yes',
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'nav_font',
				'value'      => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
				'settings'   => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'landinghub-core' ),
						'font_style_description'  => esc_html__( 'Select font styling.', 'landinghub-core' ),
					),
				),
				'group' => esc_html__( 'Typography', 'landinghub-core' ),
				'dependency' => array(
					'element'            => 'use_theme_fonts',
					'value_not_equal_to' => 'yes',
				),
			),			
			*/

		);
		
		$this->params = array_merge( $params, $button );

		$this->add_extras();
	}

	public function before_output( $atts, &$content ) {

		global $liquid_accordion_tabs;

		$liquid_accordion_tabs = array();

		//parse ld_tab_section shortcode
		do_shortcode( $content );

		$atts['items'] = $liquid_accordion_tabs;

		return $atts;
	}
	
	protected function get_button() {

		if ( empty( $this->atts['show_button'] ) ) {
			return;
		}

		$data = vc_map_integrate_parse_atts( $this->slug, 'ld_button', $this->atts, 'ib_' );
		if ( $data ) {

			$btn = visual_composer()->getShortCode( 'ld_button' )->shortcodeClass();

			if ( is_object( $btn ) ) {
				
				echo '<div class="lqd-tabs-nav-btn-wrap">';
				echo $btn->render( array_filter( $data ) );
				echo '</div>';
			}
		}
	}

	protected function get_class( $style ) {

		$hash = array(
			'style01'  => 'lqd-tabs lqd-tabs-style-1 d-flex',
			'style02'  => 'lqd-tabs lqd-tabs-style-2 d-flex',
			'style03'  => 'lqd-tabs lqd-tabs-style-3',
			'style04'  => 'lqd-tabs lqd-tabs-style-4',
			'style05'  => 'lqd-tabs lqd-tabs-style-5 d-flex flex-wrap',
			'style06'  => 'lqd-tabs lqd-tabs-style-6 d-flex flex-wrap',
			'style07'  => 'lqd-tabs lqd-tabs-style-7',
			'style08'  => 'lqd-tabs lqd-tabs-style-8 d-flex flex-wrap',
			'style09'  => 'lqd-tabs lqd-tabs-style-9 d-flex',
			'style09b' => 'lqd-tabs lqd-tabs-style-9 d-flex lqd-tabs-style-9-alt',
			'style09c' => 'lqd-tabs lqd-tabs-style-9 d-flex lqd-tabs-style-9-alt2',
			'style10'  => 'lqd-tabs lqd-tabs-style-10',
			'style11'  => 'lqd-tabs lqd-tabs-style-11 d-flex',
			'style12'  => 'lqd-tabs lqd-tabs-style-12 d-flex',
			'style13'  => 'lqd-tabs lqd-tabs-style-13 d-flex',
			'style14'  => 'lqd-tabs lqd-tabs-style-14 lqd-tabs-has-nav-arrows d-flex',
		);

		return $hash[ $style ];
	}

	protected function get_tabs_opts() {
		
		$opts = array();
		
		if( !empty( $this->atts['enable_deeplinks'] ) ) {
			$opts['deepLink'] = true;
		}
		
		if( !empty( $this->atts['tab_trigger'] ) ) {
			$opts['trigger'] = $this->atts['tab_trigger'];
		}

		if ( 'style14' === $this->atts['style'] ) {
			$opts['translateNav'] = true;
		}

		return 'data-tabs-options=\'' . wp_json_encode( $opts ) . '\'';

	}

	protected function get_reverse_direction() {

		$style = $this->atts['style'];
		$reverse = $this->atts['reverse_direction'];
		$isInRow = 'style05' === $style || 'style06' === $style || 'style08' === $style || 'style13' === $style;
		$isInColumn = 'style01' === $style || 'style02' === $style || 'style09' === $style || 'style09b' === $style || 'style09c' === $style || 'style11' === $style || 'style12' === $style || 'style14' === $style;

		if ( ! $isInRow && ! $isInColumn ) {
			return;
		}

		if ( $isInRow && $reverse ) {
			return 'flex-md-row-reverse';
		} else if ( $isInColumn && $reverse ) {
			return 'flex-column-reverse';
		} else if ( $isInColumn && ! $reverse ) {
			return 'flex-column';
		}
		
	}

	protected function get_nav_expand() {

		$nav_expand = $this->atts['nav_expand'];

		if ( $nav_expand ) {
			return;
		}

		return 'lqd-tabs-nav-items-not-expanded';

	}

	protected function get_nav() {

		$out = $nav_align = ''; $first = true;
		$style = $this->atts['style'] ? $this->atts['style'] : 'style01';
		$nav_align = $this->atts['nav_alignment'];
		$nav_align_style9 = $this->atts['nav_alignment_style9'];
		$sticky = $this->atts['enable_sticky_nav'];
		
		if( 'style03' === $style ) {
			$out .= '<ul class="reset-ul lqd-tabs-nav d-flex align-items-center ' . $nav_align . '" role="tablist">';
		}
		elseif( 'style04' === $style ) {
			$out .= '<ul class="reset-ul lqd-tabs-nav d-flex align-items-center flex-wrap justify-content-between" role="tablist">';
		}
		elseif( 'style05' === $style ) {
			$out .= '<ul class="reset-ul lqd-tabs-nav d-flex flex-column justify-content-center" role="tablist">';
		}
		elseif( 'style06' === $style ) {
			$out .= '<ul class="reset-ul lqd-tabs-nav d-flex flex-column ' . $sticky .'" role="tablist">';
		}
		elseif( 'style07' === $style ) {
			$out .= '<ul class="reset-ul lqd-tabs-nav d-flex align-items-center flex-wrap justify-content-center" role="tablist">';
		}
		elseif( 'style08' === $style ) {
			$out .= '<ul class="reset-ul lqd-tabs-nav d-flex flex-column ' . $sticky .'" role="tablist">';
		}
		elseif( 'style09' === $style || 'style09b' === $style ) {
			$out .= '<ul class="reset-ul lqd-tabs-nav d-flex align-items-center flex-wrap ' . $nav_align_style9 . '" role="tablist">';
		}
		elseif ( 'style09c' === $style ) {
			$out .= '<ul class="reset-ul lqd-tabs-nav d-flex align-items-center flex-wrap ' . $nav_align . '" role="tablist">';
		}
		elseif( 'style10' === $style ) {
			$out .= '<ul class="reset-ul lqd-tabs-nav d-flex flex-wrap justify-content-center align-items-end" role="tablist">';
		}
		elseif( 'style11' === $style ) {
			$out .= '<ul class="reset-ul lqd-tabs-nav d-flex align-items-center flex-wrap ' . $nav_align . '" role="tablist">';
		}
		elseif( 'style12' === $style ) {
			$out .= '<ul class="reset-ul lqd-tabs-nav d-flex align-items-center flex-wrap ' . $nav_align . '" role="tablist">';
		}
		elseif( 'style13' === $style ) {
			$out .= '<ul class="reset-ul lqd-tabs-nav d-flex flex-column" role="tablist">';
		}
		elseif( 'style14' === $style ) {
			$out .= '<ul class="reset-ul lqd-tabs-nav d-flex align-items-center mb-8" role="tablist">';
		}
		else {
			$out .= '<ul class="reset-ul lqd-tabs-nav d-flex align-items-center flex-wrap" role="tablist">';
		}

		if ( $this->atts['items'] ) {
			foreach ( $this->atts[ 'items' ] as $i => $tab ) {

				$classes = array();
				
				$classes[] = $tab['unique_id'];

				if ( $first ) {
					$classes[] = 'active';
				}

				if ( 'style01' === $style ) {
					if ( ! $this->atts[ 'reverse_direction' ] ) {
						$classes[] = 'mt-5 mt-sm-0';
					} else {
						$classes[] = 'mb-5 mb-sm-0';
					}
				} elseif ( 'style02' === $style ) {
					if ( ! $this->atts[ 'reverse_direction' ] ) {
						$classes[] = 'mb-5';
					} else {
						$classes[] = 'mt-5';
					}
				} elseif ( 'style03' === $style || 'style04' === $style ) {
					$classes[] = 'text-center';
				} elseif ( 'style06' === $style || 'style09b' === $style || 'style10' === $style ) {
					$classes[] = 'font-weight-medium';
				} elseif ( 'style07' === $style ) {
					$classes[] = 'font-weight-semibold';
				} elseif ( 'style12' === $style ) {
					$classes[] = 'mb-3';
				}

				$classes = ! empty( $classes ) ? ' class="' . join( ' ', $classes ) . '"' : '';

				// Tab title
				$title = wp_kses_data( do_shortcode( $tab[ 'title' ] ) );

				// Nav
				if ( 'style01' === $style ) {

					$out .= sprintf( '<li data-controls="%1$s" role="presentation"%2$s><a href="#%1$s" aria-expanded="false" aria-controls="%1$s" role="tab" data-toggle="tab">', $this->get_id( $tab ), $classes );

					$out .= '<span class="iconbox iconbox-circle iconbox-side align-items-center">';
					if ( $tab[ 'icon' ][ 'type' ] ) {
						$out .= '<span class="iconbox-icon-wrap">
											<span class="iconbox-icon-container">
												<i class="' . $tab[ 'icon' ][ 'icon' ] . '"></i>
											</span>
										</span>';
					}
					$out .= '<span class="contents d-flex flex-column">
								<span class="iconbox-title h3 mt-0 mb-3">' . $title . '</span>';
					if ( ! empty( $tab[ 'desc' ] ) ) {
						$out .= '<span class="iconbox-desc">' . $tab[ 'desc' ] . '</span>';
					};
					$out .= '</span>
						</span>';
					$out .= '</a></li>';

				} elseif ( 'style02' === $style ) {

					$out .= sprintf( '<li data-controls="%1$s" role="presentation"%2$s><a href="#%1$s" aria-expanded="false" aria-controls="%1$s" role="tab" data-toggle="tab">', $this->get_id( $tab ), $classes );

					$out .= '<span class="iconbox iconbox-square iconbox-side align-items-center">';
					if ( $tab[ 'icon' ][ 'type' ] ) {
						$out .= '<span class="iconbox-icon-wrap">
											<span class="iconbox-icon-container">
												<i class="' . $tab[ 'icon' ][ 'icon' ] . '"></i>
											</span>
										</span>';
					}
					$out .= '<span class="contents d-flex flex-column pr-md-4">
								<span class="iconbox-title h3 mt-0 mb-2">' . $title . '</span>';
					if ( ! empty( $tab[ 'desc' ] ) ) {
						$out .= '<span class="iconbox-desc">' . $tab[ 'desc' ] . '</span>';
					};
					$out .= '</span>
						</span>';
					$out .= '<span class="lqd-tabs-nav-progress">
							<span class="lqd-tabs-nav-progress-inner"></span>
						</span>';
					$out .= '</a></li>';
				} elseif ( 'style03' === $style || 'style04' === $style ) {

					$out .= sprintf( '<li data-controls="%1$s" role="presentation"%2$s><a href="#%1$s" aria-expanded="false" aria-controls="%1$s" role="tab" data-toggle="tab">', $this->get_id( $tab ), $classes );

					$out .= '<span class="iconbox">';
					if ( $tab[ 'icon' ][ 'type' ] ) {
						$out .= '<span class="iconbox-icon-wrap">
											<span class="iconbox-icon-container">
												<i class="' . $tab[ 'icon' ][ 'icon' ] . '"></i>
											</span>
										</span>';
					}
					$out .= '<span class="contents d-flex flex-column">
								<span class="iconbox-title h3 my-0">' . $title . '</span>';
					$out .= '</span>
						</span>';
					$out .= '<span class="lqd-tabs-nav-progress">
							<span class="lqd-tabs-nav-progress-inner"></span>
						</span>';
					$out .= '</a></li>';
				} elseif ( 'style05' === $style ) {

					$out .= sprintf( '<li data-controls="%1$s" role="presentation"%2$s><a class="p-5 border-radius-7" href="#%1$s" aria-expanded="false" aria-controls="%1$s" role="tab" data-toggle="tab">', $this->get_id( $tab ), $classes );

					$out .= '<span class="iconbox iconbox-side mb-0">';
					if ( $tab[ 'icon' ][ 'type' ] ) {
						$out .= '<span class="iconbox-icon-wrap">
											<span class="iconbox-icon-container">
												<i class="' . $tab[ 'icon' ][ 'icon' ] . '"></i>
											</span>
										</span>';
					}
					$out .= '<span class="contents d-flex flex-column">
								<span class="iconbox-title h3 mt-0 mb-3">' . $title . '</span>';
					if ( ! empty( $tab[ 'desc' ] ) ) {
						$out .= '<span class="iconbox-desc">' . $tab[ 'desc' ] . '</span>';
					};
					$out .= '</span>
						</span>';

					$out .= '</a></li>';
				} elseif ( 'style06' === $style ) {
					$out .= sprintf( '<li data-controls="%1$s" role="presentation"%2$s><a class="py-3 round" href="#%1$s" aria-expanded="false" aria-controls="%1$s" role="tab" data-toggle="tab">', $this->get_id( $tab ), $classes );
					if ( $tab[ 'icon' ][ 'type' ] ) {
						$out .= '<span class="lqd-tabs-nav-icon">
								<i class="' . $tab[ 'icon' ][ 'icon' ] . '"></i>
							</span>';
					}
					$out .= '<span class="lqd-tabs-nav-txt">' . $title . '</span>';
					$out .= '</a></li>';
				} elseif ( 'style07' === $style ) {
					$out .= sprintf( '<li data-controls="%1$s" role="presentation"%2$s><a class="py-3 px-6 circle" href="#%1$s" aria-expanded="false" aria-controls="%1$s" role="tab" data-toggle="tab">', $this->get_id( $tab ), $classes );
					if ( $tab[ 'icon' ][ 'type' ] ) {
						$out .= '<span class="lqd-tabs-nav-icon">
								<i class="' . $tab[ 'icon' ][ 'icon' ] . '"></i>
							</span>';
					}
					$out .= '<span class="lqd-tabs-nav-txt">' . $title . '</span>';
					$out .= '</a></li>';
				} elseif ( 'style08' === $style ) {
					$out .= sprintf( '<li data-controls="%1$s" role="presentation"%2$s><a class="d-flex align-items-center py-1 mb-2" href="#%1$s" aria-expanded="false" aria-controls="%1$s" role="tab" data-toggle="tab">', $this->get_id( $tab ), $classes );
					$out .= '<span class="lqd-tabs-nav-txt">' . $title . '</span>';
					$out .= '</a></li>';
				} elseif ( 'style10' === $style ) {
					$out .= sprintf( '<li data-controls="%1$s" role="presentation"%2$s><a class="d-flex align-items-center" href="#%1$s" aria-expanded="false" aria-controls="%1$s" role="tab" data-toggle="tab">', $this->get_id( $tab ), $classes );
					$out .= '<span class="lqd-tabs-nav-txt">' . $title . '</span>';
					$out .= '</a></li>';
				} elseif ( 'style12' === $style ) {
					$out .= sprintf( '<li data-controls="%1$s" role="presentation"%2$s><a class="d-flex align-items-center" href="#%1$s" aria-expanded="false" aria-controls="%1$s" role="tab" data-toggle="tab">', $this->get_id( $tab ), $classes );
					$out .= '<span class="lqd-tabs-nav-txt">' . $title . '</span>';
					$out .= '</a></li>';
				} elseif ( 'style13' === $style ) {
					$out .= sprintf( '<li data-controls="%1$s" role="presentation"%2$s><a class="d-flex flex-wrap align-items-center mb-3" href="#%1$s" aria-expanded="false" aria-controls="%1$s" role="tab" data-toggle="tab">', $this->get_id( $tab ), $classes );
					$out .= '<span class="lqd-tabs-nav-txt">' . $title . '</span>';
					if ( ! empty( $tab[ 'desc' ] ) ) {
						$out .= '<span class="lqd-tabs-nav-ext">' . $tab[ 'desc' ] . '</span>';
					};
					$out .= '</a></li>';
				} elseif ( 'style14' === $style ) {
					$out .= sprintf( '<li data-controls="%1$s" role="presentation"%2$s><a class="d-inline-flex align-items-center circle" href="#%1$s" aria-expanded="false" aria-controls="%1$s" role="tab" data-toggle="tab">', $this->get_id( $tab ), $classes );
					$out .= '<span class="lqd-tabs-nav-txt" data-txt="' . $title . '"><span>' . $title . '<span></span>';
					$out .= '</a>';
					if ( ! empty( $tab[ 'desc' ] ) ) {
						$out .= '<span class="lqd-tabs-nav-ext">' . $tab[ 'desc' ] . '</span>';
					};
					$out .= '</li>';
				} else {
					$out .= sprintf( '<li data-controls="%1$s" role="presentation"%2$s><a href="#%1$s" aria-expanded="false" aria-controls="%1$s" role="tab" data-toggle="tab">', $this->get_id( $tab ), $classes );
					$out .= '<span class="lqd-tabs-nav-txt">' . $title . '</span>';
					$out .= '</a></li>';
				}

				$first = false;

			}
		}

		$out .= '</ul>';

		echo $out;
	}

	protected function get_content() {

		$out = ''; $first = true;
		$style = $this->atts['style'];
		
		if( 'style01' === $style ) {
			if ( ! $this->atts['reverse_direction'] ) {
				$out .= '<div class="lqd-tabs-content mb-5 mb-sm-0 mt-sm-5">';
			} else {
				$out .= '<div class="lqd-tabs-content mt-5 mt-sm-0 mb-sm-5">';
			}
		}
		elseif( 
			'style02' === $style && $this->atts['reverse_direction']
		) {
			$out .= '<div class="lqd-tabs-content">';
		}
		elseif( 
			'style02' === $style || 
			'style03' === $style || 
			'style04' === $style 
		) {
			$out .= '<div class="lqd-tabs-content mb-5">';
		}
		elseif( 
			'style05' === $style || 
			'style06' === $style 
		) {
			if ( $this->atts['reverse_direction'] ) {
				$out .= '<div class="lqd-tabs-content pr-sm-5 pt-5 pt-sm-0">';
			} else {
				$out .= '<div class="lqd-tabs-content pl-sm-5 pt-5 pt-sm-0">';
			}
		}
		elseif( 
			'style08' === $style || 'style13' === $style
		) {
			if ( $this->atts['reverse_direction'] ) {
				$out .= '<div class="lqd-tabs-content pr-md-6">';
			} else {
				$out .= '<div class="lqd-tabs-content pl-md-6">';
			}
		}		
		else {
			$out .= '<div class="lqd-tabs-content">';
		}

		if ( $this->atts['items'] ) {
			foreach ( $this->atts[ 'items' ] as $tab ) {
				if ( vc_is_inline() && vc_frontend_editor()->post_shortcodes ) {
					$out .= $tab[ 'content' ];
				} else {
					$out .= sprintf( '<div id="%1$s" role="tabpanel" class="lqd-tabs-pane fade%3$s">%2$s</div>', $this->get_id( $tab ), $tab[ 'content' ], ( $first ? ' active in' : '' ) );
					$first = false;
				}
			}
		} else {
			$out .= vc_container_anchor();
		}

		if ( 'style14' === $style ) {
			$out .= '<div class="lqd-tabs-nav-arrows">
				<button class="lqd-tabs-nav-arrow lqd-tabs-nav-prev d-inline-flex align-items-center justify-content-center circle pos-abs">
					<i class="lqd-icn-ess icon-md-arrow-back"></i>
				</button>
				<button class="lqd-tabs-nav-arrow lqd-tabs-nav-next d-inline-flex align-items-center justify-content-center circle pos-abs">
					<i class="lqd-icn-ess icon-md-arrow-forward"></i>
				</button>
			</div>';
		}

		$out .= '</div>';

		echo $out;
	}

	protected function get_nav_wrap_classnames() {

		$classname_arr = array('lqd-tabs-nav-wrap');
		$style = $this->atts['style'] ? $this->atts['style'] : 'style01';
		
		if ( !empty( $this->atts['show_button'] ) ) {
			$classname_arr[] = 'lqd-tabs-nav-has-btn';
		}

		switch ($style) {

			case 'style03':
			case 'style04':
			case 'style11':
				$classname_arr[] = 'mb-5';
				break;

			case 'style07':
			case 'style09':
			case 'style09b':
			case 'style10':
				$classname_arr[] = 'mb-6';
				break;

			case 'style09c':
				$classname_arr[] = 'mb-7';
				break;
			
			case 'style12':
				$classname_arr[] = 'mb-6';
				break;

		}

		if ( $this->atts['reverse_direction'] ) {

			if (
				$style === 'style07'
				|| $style === 'style09'
				|| $style === 'style09b'
				|| $style === 'style09c'
				|| $style === 'style11'
			) {
				array_pop($classname_arr);
			}

			switch ($style) {
	
				case 'style07':
				case 'style09':
				case 'style09b':
				case 'style12':
					$classname_arr[] = 'mt-6';
					break;
	
				case 'style09c':
					$classname_arr[] = 'mt-7';
					break;
	
				case 'style11':
					$classname_arr[] = 'mt-5';
					break;
	
			}

		}

		return $classname_arr;

	}
	
	protected function inline_css() {
		
		echo '<style>';		
			foreach ( $this->atts['items'] as $tab ) {

				if( !empty( $tab['primary_color'] ) ) {
					echo '.lqd-tabs .lqd-tabs-nav > .' . $tab['unique_id'] . ' > a .lqd-tabs-nav-txt {'; 
					echo 'background:' . $tab['primary_color'] .';';
					echo '}';
				}
				if( !empty( $tab['primary_color'] ) && !empty( $tab['secondary_color'] ) ) {
					echo '.lqd-tabs .lqd-tabs-nav > .' . $tab['unique_id'] . ' > a .lqd-tabs-nav-txt {'; 
					echo 'background:linear-gradient(to right,' . $tab['primary_color'] . ', ' . $tab['secondary_color'] . ')';
					echo '}';
				}
				if( !empty( $tab['primary_hcolor'] ) ) {
					echo '.lqd-tabs .lqd-tabs-nav > .' . $tab['unique_id'] . ' > a .lqd-tabs-nav-txt:before {'; 
					echo 'background:' . $tab['primary_hcolor'] .';';
					echo '}';
				}
				if( !empty( $tab['primary_hcolor'] ) && !empty( $tab['secondary_hcolor'] ) ) {
					echo '.lqd-tabs .lqd-tabs-nav > .' . $tab['unique_id'] . ' > a .lqd-tabs-nav-txt:before {'; 
					echo 'background:linear-gradient(to right,' . $tab['primary_hcolor'] . ', ' . $tab['secondary_hcolor'] . ')';
					echo '}';
				}
				
			}
		echo '</style>';

	}

	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' .$this->get_id();
		
		
		$nav_font_inline_style = '';
		/*
		if( 'yes' !== $use_theme_fonts ) {

			// Build the data array
			$nav_font_data = $this->get_fonts_data( $nav_font );

			// Build the inline style
			$nav_font_inline_style = $this->google_fonts_style( $nav_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $nav_font_data );

		}
		*/

		if ( 'style13' !== $style ) {
			$elements[ liquid_implode( '%1$s .lqd-tabs-nav > li > a, %1$s .lqd-tabs-nav .h3' ) ] = array( $nav_font_inline_style );
			$elements[ liquid_implode( '%1$s .lqd-tabs-nav > li > a, %1$s .lqd-tabs-nav .h3' ) ]['font-size'] = !empty( $fs ) ? $fs : '';
			$elements[ liquid_implode( '%1$s .lqd-tabs-nav > li > a, %1$s .lqd-tabs-nav .h3' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
			$elements[ liquid_implode( '%1$s .lqd-tabs-nav > li > a, %1$s .lqd-tabs-nav .h3' ) ]['font-weight'] = !empty( $fw ) ? $fw : '';
			$elements[ liquid_implode( '%1$s .lqd-tabs-nav > li > a, %1$s .lqd-tabs-nav .h3' ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';
			$elements[ liquid_implode( '%1$s .lqd-tabs-nav > li > a, %1$s .lqd-tabs-nav .h3' ) ]['text-transform'] = !empty( $transform ) ? $transform : '';
		} else {
			$elements[ liquid_implode( '%1$s .lqd-tabs-nav > li > a .lqd-tabs-nav-txt' ) ] = array( $nav_font_inline_style );
			$elements[ liquid_implode( '%1$s .lqd-tabs-nav > li > a .lqd-tabs-nav-txt' ) ]['font-size'] = !empty( $fs ) ? $fs : '';
			$elements[ liquid_implode( '%1$s .lqd-tabs-nav > li > a .lqd-tabs-nav-txt' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
			$elements[ liquid_implode( '%1$s .lqd-tabs-nav > li > a .lqd-tabs-nav-txt' ) ]['font-weight'] = !empty( $fw ) ? $fw : '';
			$elements[ liquid_implode( '%1$s .lqd-tabs-nav > li > a .lqd-tabs-nav-txt' ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';
			$elements[ liquid_implode( '%1$s .lqd-tabs-nav > li > a .lqd-tabs-nav-txt' ) ]['text-transform'] = !empty( $transform ) ? $transform : '';
		}
		

		if ( !empty( $primary_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-tabs-nav li a .h3' ) ]['color'] = 'inherit';
		}
		if ( !empty( $primary_hcolor ) ) {	
			$elements[ liquid_implode( '%1$s .lqd-tabs-nav li.active a .h3' ) ]['color'] = 'inherit';
		}

		if ( !empty( $text_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-tabs-nav a' ) ]['color'] = $text_color;			
		}
		if ( !empty( $text_hcolor ) ) {
			$elements[ liquid_implode( '%1$s .lqd-tabs-nav li.active a' ) ]['color'] = $text_hcolor;
		}

		if ( !empty( $icon_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-tabs-nav .iconbox-icon-container' ) ]['color'] = $icon_color;			
		}
		if ( !empty( $icon_hcolor ) ) {
			$elements[ liquid_implode( '%1$s .lqd-tabs-nav li.active .iconbox-icon-container' ) ]['color'] = $icon_hcolor;
		}

		if ( ! empty( $nav_bg_color ) ) {

			if ( 'style09c' === $style ) {
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav li' ) ]['background'] = $nav_bg_color;
			}

		}

		if ( 'style01' === $style || 'style02' === $style ) {
			if ( !empty( $icon_bg ) ) {
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav .iconbox-icon-container' ) ]['background'] = $icon_bg;
			}
			if ( !empty( $icon_hbg ) ) {
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav .active .iconbox-icon-container' ) ]['background'] = $icon_hbg;
			}
		}
		if ( 'style01' === $style || 'style02' === $style || 'style05' === $style ) {

			if ( !empty( $title_color ) ) {
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav .h3' ) ]['color'] = $title_color;
			}
			if ( !empty( $title_hcolor ) ) {
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav li.active .h3' ) ]['color'] = $title_hcolor;
			}

		}
		
		if ( 'style03' === $style && empty( $icon_color ) && !empty( $primary_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-tabs-nav .iconbox-icon-container' ) ]['color'] = $primary_color;
		}
		if ( 'style03' === $style && empty( $icon_hcolor ) && !empty( $primary_hcolor ) ) {
			$elements[ liquid_implode( '%1$s .lqd-tabs-nav .iconbox-icon-container' ) ]['color'] = $primary_hcolor;
		}

		if ( 'style01' === $style ) {
			if ( !empty( $primary_color ) ) {
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav li:before' ) ]['background'] = $primary_color;
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav li:after' ) ]['border-bottom-color'] = $primary_color;
			}
			if ( !empty( $primary_hcolor ) ) {	
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav li.active:before' ) ]['background'] = $primary_hcolor;
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav li.active:after' ) ]['border-bottom-color'] = $primary_hcolor;
			}
		}

		if ( 'style02' === $style ) {
			if ( !empty( $primary_color ) ) {
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav .lqd-tabs-nav-progress' ) ]['background'] = $primary_color;
			}
			if ( !empty( $primary_hcolor ) ) {	
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav .lqd-tabs-nav-progress-inner' ) ]['background'] = $primary_hcolor;
			}
		}

		if ( 'style03' === $style ) {
			if ( !empty( $border_color ) ) {
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav' ) ]['border-color'] = $border_color;
			}
			if ( !empty( $primary_color ) ) {
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav' ) ]['border-color'] = $primary_color;
			}
			if ( !empty( $primary_hcolor ) ) {	
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav li:after' ) ]['background'] = $primary_hcolor;
			}
		}

		if ( 'style04' === $style ) {
			if ( !empty( $primary_color ) ) {
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav:before' ) ]['background'] = $primary_color;
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav .h3:after' ) ]['background'] = $primary_color;
			}
			if ( !empty( $primary_hcolor ) ) {	
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav li.active .iconbox-icon-container' ) ]['color'] = $primary_hcolor;
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav li.active .h3:after' ) ]['background'] = $primary_hcolor;
			}
		}

		if ( 'style05' === $style ) {
			if ( !empty( $primary_color ) ) {
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav a:before' ) ]['background'] = $primary_color;
			}
			if ( !empty( $primary_hcolor ) ) {	
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav a:after' ) ]['background'] = $primary_hcolor;
			}
		}

		if ( 'style06' === $style ) {
			if ( !empty( $primary_color ) ) {
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav a .lqd-tabs-nav-icon' ) ]['background'] = $primary_color;
			}
			if ( !empty( $primary_hcolor ) ) {	
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav li.active a .lqd-tabs-nav-icon' ) ]['background'] = $primary_hcolor;
			}
			if ( !empty( $icon_color ) ) {
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav a .lqd-tabs-nav-icon' ) ]['color'] = $icon_color;
			}
			if ( !empty( $icon_hcolor ) ) {	
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav li.active a .lqd-tabs-nav-icon' ) ]['color'] = $icon_hcolor;
			}
		}

		if ( 'style07' === $style ) {
			if ( !empty( $primary_color ) ) {
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav a' ) ]['background'] = $primary_color;
			}
			if ( !empty( $primary_hcolor ) ) {	
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav li.active a' ) ]['background'] = $primary_hcolor;
			}
			if ( !empty( $icon_color ) ) {
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav a, %1$s .lqd-tabs-nav a .lqd-tabs-nav-icon' ) ]['color'] = $icon_color;
			}
			if ( !empty( $icon_hcolor ) ) {	
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav li.active a .lqd-tabs-nav-icon' ) ]['color'] = $icon_hcolor;
			}
		}

		if ( 'style08' === $style ) {
			if ( !empty( $primary_hcolor ) ) {
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav a:before' ) ]['background'] = $primary_hcolor;
			}
		}

		if ( 'style09' === $style ) {
			if ( !empty( $primary_color ) ) {
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav a' ) ]['background'] = $primary_color;
			}
			if ( !empty( $primary_hcolor ) ) {
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav li.active a' ) ]['background'] = $primary_hcolor;
			}
			if ( !empty( $border_color ) ) {
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav a' ) ]['border-color'] = $border_color;
			}
			if ( !empty( $border_hcolor ) ) {
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav li.active a' ) ]['border-color'] = $border_hcolor;
			}
		}

		if ( 'style09b' === $style ) {
			if ( !empty( $primary_color ) ) {
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav a:before' ) ]['background'] = $primary_color;
			}
			if ( !empty( $primary_hcolor ) ) {
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav li.active a' ) ]['background'] = $primary_hcolor;
			}
		}

		if ( 'style09c' === $style ) {
			if ( !empty( $primary_color ) ) {
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav a' ) ]['background'] = $primary_color;
			}
			if ( !empty( $primary_hcolor ) ) {
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav li.active a' ) ]['background'] = $primary_hcolor;
			}
		}

		if ( 'style10' === $style ) {
			if ( !empty( $primary_color ) ) {
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav a:after' ) ]['background'] = $primary_color;
			}
			if ( !empty( $primary_hcolor ) ) {
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav a:before' ) ]['background'] = $primary_hcolor;
			}
		}

		if ( 'style13' === $style ) {
			if ( !empty( $primary_hcolor ) ) {
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav li.active a' ) ]['background'] = $primary_hcolor;
			}
		}
		
		if ( 'style14' === $style ) {
			
			if ( !empty($text_color) ) {
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav li' ) ]['color'] = $text_color;
			}
			
			if ( !empty($primary_color) ) {
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav > li > a .lqd-tabs-nav-txt span' ) ]['background'] = $primary_color;
			}
			if ( !empty($primary_color) && !empty($secondary_color) ) {
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav > li > a .lqd-tabs-nav-txt span' ) ]['background'] = 'linear-gradient(to right, ' . $primary_color . ', ' . $secondary_color . ')';
			}
			
			if ( !empty($primary_hcolor) ) {
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav > li > a .lqd-tabs-nav-txt:before' ) ]['background'] = $primary_hcolor;
			}
			if ( !empty($primary_hcolor) && !empty($secondary_hcolor) ) {
				$elements[ liquid_implode( '%1$s .lqd-tabs-nav > li > a .lqd-tabs-nav-txt:before' ) ]['background'] = 'linear-gradient(to right, ' . $primary_hcolor . ', ' . $secondary_hcolor . ')';
			}

		}

		$this->dynamic_css_parser( $id, $elements );

	}
}
new LD_Tabs;

// Accordion Tab
include_once 'liquid-tab-section.php';