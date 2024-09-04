<?php
/**
* Shortcode Accordion
*/

if( ! defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly
	
/**
* LD_Shortcode
*/
class LD_Accordion extends LD_Shortcode {
	
	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug          = 'vc_accordion';
		$this->title         = esc_html__( 'Accordion', 'landinghub-core' );
		$this->icon          = 'la la-navicon';
		$this->description   = esc_html__( 'Create an accordion.', 'landinghub-core' );
		$this->is_container  = true;
		$this->show_settings_on_create = true;
		$this->js_view       = 'VcAccordionView';
		$this->custom_markup = '<div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">%content%</div><div class="tab_controls"><a class="add_tab" title="Add section"><span class="vc_icon"></span> <span class="tab-label">Add section</span></a></div>';
		$this->default_content = '
			[vc_accordion_tab title="' . sprintf( '%s %d', 'Section', 1 ) . '"][/vc_accordion_tab]
			[vc_accordion_tab title="' . sprintf( '%s %d', 'Section', 2 ) . '"][/vc_accordion_tab]';

		parent::__construct();

	}
	
	/**
	 * Get params
	 * @return array
	 */
	public function get_params() {

		$this->params = array_merge(

			array(

				array(
					'type'        => 'textfield',
					'param_name'  => 'active_tab',
					'heading'     => esc_html__( 'Active tab', 'landinghub-core' ),
					'description' => esc_html__( 'Enter active tab. Set this to -1 if you want all the tabs closed.', 'landinghub-core' ),
				),
				
				array(
					'type'       => 'dropdown',
					'param_name' => 'size',
					'heading'    => esc_html__( 'Title Height', 'landinghub-core' ),
					'value'      => array(
						esc_html__( 'Shortest', 'landinghub-core' ) => 'xs',
						esc_html__( 'Short', 'landinghub-core' )    => 'sm',
						esc_html__( 'Medium', 'landinghub-core' )   => 'md',
						esc_html__( 'Tall', 'landinghub-core' )     => 'lg',
					),
					'std' => 'sm',
					'edit_field_class' => 'vc_col-sm-6'
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'borders',
					'heading'    => esc_html__( 'Border style', 'landinghub-core' ),
					'value'      => array(
						esc_html__( 'None', 'landinghub-core' )  => '',
						esc_html__( 'Title Bordered', 'landinghub-core' )     => 'accordion-title-bordered',
						esc_html__( 'Title Underlined', 'landinghub-core' )   => 'accordion-title-underlined',
						esc_html__( 'Content Underlined', 'landinghub-core' ) => 'accordion-body-underlined',
						esc_html__( 'Content Bordered', 'landinghub-core' )   => 'accordion-body-bordered',
					),
					'edit_field_class' => 'vc_col-sm-6'
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'border_round',
					'heading'    => esc_html__( 'Border Round', 'landinghub-core' ),
					'value'      => array(
						esc_html__( 'None', 'landinghub-core' )  => '',
						esc_html__( 'Round', 'landinghub-core' )  => 'accordion-title-round',
						esc_html__( 'Circle', 'landinghub-core' ) => 'accordion-title-circle',
					),
					'dependency' => array(
						'element' => 'borders',
						'value'   => 'accordion-title-bordered'
					),
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'body_border_round',
					'heading'    => esc_html__( 'Border Round', 'landinghub-core' ),
					'value'      => array(
						esc_html__( 'None', 'landinghub-core' )  => '',
						esc_html__( 'Round', 'landinghub-core' )  => 'accordion-body-round',
					),
					'dependency' => array(
						'element' => 'borders',
						'value'   => 'accordion-body-bordered'
					),
				),
				array(
					'type'             => 'checkbox',
					'param_name'       => 'items_shadow',
					'value'            => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
					'heading'          => esc_html__( 'Accordion Item Shadow', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6'
				),
				array(
					'type'             => 'checkbox',
					'param_name'       => 'heading_shadow',
					'value'            => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
					'heading'          => esc_html__( 'Heading Shaodw', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'             => 'checkbox',
					'param_name'       => 'active_style',
					'value'            => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
					'heading'          => esc_html__( 'Active Heading Shaodw', 'landinghub-core' ),
					'dependency' => array(
						'element' => 'items_shadow',
						'value_not_equal_to'   => 'yes',
					),
					'edit_field_class' => 'vc_col-sm-6'
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'bottom_margin',
					'heading'     => esc_html__( 'Bottom Margin', 'landinghub-core' ),
					'description' => esc_html__( 'Example: 20px', 'landinghub-core' ),
				),
				array(
					'type'        => 'checkbox',
					'param_name'  => 'use_custom_fonts_title',
					'heading'     => esc_html__( 'Custom font?', 'landinghub-core' ),
					'description' => esc_html__( 'Check to use custom font for title', 'landinghub-core' ),
				),
				//Typo Options
			array(
				'type'        => 'textfield',
				'param_name'  => 'fs',
				'heading'     => esc_html__( 'Font Size', 'landinghub-core' ),
				'description' => esc_html__( 'Example: 20px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3 vc_column-with-padding',
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'lh',
				'heading'     => esc_html__( 'Line-Height', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'fw',
				'heading'     => esc_html__( 'Font Weight', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'ls',
				'heading'     => esc_html__( 'Letter Spacing', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
			),
			/*
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use for Title theme default font family?', 'landinghub-core' ),
				'param_name'  => 'use_theme_fonts',
				'value'       => array(
					esc_html__( 'Yes', 'landinghub-core' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'landinghub-core' ),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_title',
					'value'   => 'true',
				),
				'std'         => 'yes',
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'text_font',
				'value'      => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
				'settings'   => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'landinghub-core' ),
						'font_style_description'  => esc_html__( 'Select font styling.', 'landinghub-core' ),
					),
				),
				'group' => esc_html__( 'Typo', 'landinghub-core' ),
				'dependency' => array(
					'element'            => 'use_theme_fonts',
					'value_not_equal_to' => 'yes',
				),
			),
			*/
				array(
					'type'       => 'subheading',
					'param_name' => 'sh_separator',
					'heading'    => esc_html__( 'Expander', 'landinghub-core' ),
				),
				array(
					'type'        => 'checkbox',
					'param_name'  => 'show_icon',
					'heading'     => esc_html__( 'Enable Expander', 'landinghub-core' ),
					'description' => esc_html__( 'If enabled will show icons in expander', 'landinghub-core' ),
					'value'       => array( esc_html__( ' Yes', 'landinghub-core' ) => 'yes' ),
				),

				array(
					'type'       => 'checkbox',
					'param_name' => 'i_add_icon',
					'heading'    => esc_html__( 'Normal State Icon', 'landinghub-core' ),
					'description' => esc_html__( 'Normal state of the panel', 'landinghub-core' ),
					'group'      => esc_html__( 'Icon', 'landinghub-core' ),
					'value'      => '',
					'dependency' => array(
						'element' => 'show_icon',
						'value'   => 'yes'
					),
				),

				array(
					'type'       => 'dropdown',
					'param_name' => 'expander_position',
					'heading'    => esc_html__( 'Expander position', 'landinghub-core' ),
					'value'      => array(
						esc_html__( 'Default', 'landinghub-core' ) => '',
						esc_html__( 'Left', 'landinghub-core' )    => 'accordion-expander-left',
					),
					'edit_field_class' => 'vc_col-sm-6',
					'dependency' => array(
						'element' => 'show_icon',
						'value'   => 'yes'
					),
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'expander_size',
					'heading'    => esc_html__( 'Expander Size', 'landinghub-core' ),
					'value'      => array(
						esc_html__( 'Normal', 'landinghub-core' ) => '',
						esc_html__( 'Large ( 22px )', 'landinghub-core' )    => 'accordion-expander-lg',
						esc_html__( 'xLarge ( 26px )', 'landinghub-core' )    => 'accordion-expander-xl',
					),
					'edit_field_class' => 'vc_col-sm-6',
					'dependency' => array(
						'element' => 'show_icon',
						'value'   => 'yes'
					),
				),
			),

			liquid_get_icon_params( 'manual', esc_html__( 'Icon', 'landinghub-core' ), 'all', array( 'align', 'color', 'size', 'hcolor' ) ),

			array(

				array(
					'type'       => 'checkbox',
					'param_name' => 'active_add_icon',
					'heading'    => esc_html__( 'Active State Icon', 'landinghub-core' ),
					'description' => esc_html__( 'Active state of the panel', 'landinghub-core' ),
					'group'      => esc_html__( 'Icon', 'landinghub-core' ),
					'value'      => '',
					'dependency' => array(
						'element' => 'show_icon',
						'value'   => 'yes'
					),
				),

			),

			liquid_get_icon_params( 'manual', esc_html__( 'Icon', 'landinghub-core' ), 'all', array( 'align', 'color', 'size', 'hcolor' ), 'active_' ),

			array(

				//BG colors
				array(
					'type'       => 'subheading',
					'param_name' => 'sh_separator',
					'heading'    => esc_html__( 'Background Colors', 'landinghub-core' ),
					'group' => esc_html__( 'Design', 'landinghub-core' ),
				),
				array( 
					'type'        => 'liquid_colorpicker',
					'param_name'  => 'content_bg',
					'heading'     => esc_html__( 'Content Background', 'landinghub-core' ),
					'group'       => esc_html__( 'Design', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
				),
				array( 
					'type'        => 'liquid_colorpicker',
					'param_name'  => 'bg_color',
					'heading'     => esc_html__( 'Heading Background', 'landinghub-core' ),
					'description' => esc_html__( 'Background color for heading', 'landinghub-core' ),
					'group'       => esc_html__( 'Design', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array( 
					'type'        => 'liquid_colorpicker',
					'param_name'  => 'active_bg_color',
					'heading'     => esc_html__( 'Active Heading Background', 'landinghub-core' ),
					'description' => esc_html__( 'Background color for active heading', 'landinghub-core' ),
					'group'       => esc_html__( 'Design', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6',
				),

				//Headings colors
				array(
					'type'       => 'subheading',
					'param_name' => 'sh_separator',
					'heading'    => esc_html__( 'Text Colors', 'landinghub-core' ),
					'group' => esc_html__( 'Design', 'landinghub-core' ),
				),
				array( 
					'type'        => 'liquid_colorpicker',
					'only_solid'  => true,
					'param_name'  => 'heading_color',
					'heading'     => esc_html__( 'Text Solid Color', 'landinghub-core' ),
					'description' => esc_html__( 'Heading normal state', 'landinghub-core' ),
					'group'       => esc_html__( 'Design', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
				),
				array( 
					'type'        => 'liquid_colorpicker',
					'only_gradient'  => true,
					'param_name'  => 'heading_g_color',
					'heading'     => esc_html__( 'Text Gradient Color', 'landinghub-core' ),
					'description' => esc_html__( 'Heading normal state', 'landinghub-core' ),
					'group'       => esc_html__( 'Design', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
				),
				array( 
					'type'        => 'liquid_colorpicker',
					'only_solid'  => true,
					'param_name'  => 'active_heading_color',
					'heading'     => esc_html__( 'Active Text Solid Color', 'landinghub-core' ),
					'description' => esc_html__( 'Heading active state', 'landinghub-core' ),
					'group'       => esc_html__( 'Design', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6'
				),
				array( 
					'type'        => 'liquid_colorpicker',
					'only_gradient'  => true,
					'param_name'  => 'active_heading_g_color',
					'heading'     => esc_html__( 'Active Text Gradient Color', 'landinghub-core' ),
					'description' => esc_html__( 'Heading active state', 'landinghub-core' ),
					'group'       => esc_html__( 'Design', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6'
				),
				
				//Border color
				array(
					'type'       => 'subheading',
					'param_name' => 'sh_separator',
					'heading'    => esc_html__( 'Border Colors', 'landinghub-core' ),
					'group' => esc_html__( 'Design', 'landinghub-core' ),
				),
				array( 
					'type'        => 'liquid_colorpicker',
					'only_solid'  => true,
					'param_name'  => 'border_color',
					'heading'     => esc_html__( 'Border Color', 'landinghub-core' ),
					'group'       => esc_html__( 'Design', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6'
				),
				array( 
					'type'        => 'liquid_colorpicker',
					'only_solid'  => true,
					'param_name'  => 'active_border_color',
					'heading'     => esc_html__( 'Active Border Color', 'landinghub-core' ),
					'group'       => esc_html__( 'Design', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6'
				),
				
				//Expander color
				array(
					'type'       => 'subheading',
					'param_name' => 'sh_separator',
					'heading'    => esc_html__( 'Expander Colors', 'landinghub-core' ),
					'group' => esc_html__( 'Design', 'landinghub-core' ),
				),
				array( 
					'type'        => 'liquid_colorpicker',
					'only_solid'  => true,
					'param_name'  => 'exp_color',
					'heading'     => esc_html__( 'Expander Color', 'landinghub-core' ),
					'group'       => esc_html__( 'Design', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6',
					'dependency' => array(
						'element' => 'show_icon',
						'value'   => 'yes'
					),
				),
				array( 
					'type'        => 'liquid_colorpicker',
					'only_solid'  => true,
					'param_name'  => 'active_exp_color',
					'heading'     => esc_html__( 'Active Expander Color', 'landinghub-core' ),
					'group'       => esc_html__( 'Design', 'landinghub-core' ),
					'edit_field_class' => 'vc_col-sm-6',
					'dependency' => array(
						'element' => 'show_icon',
						'value'   => 'yes'
					),
				),

				
			)
		);

		$this->add_extras();
	}
	
	public function before_output( $atts, &$content ) {

		global $liquid_accordion_tabs;

		$liquid_accordion_tabs = array();

		//parse vc_accordion_tab shortcode
		do_shortcode( $content );

		$atts['items'] = $liquid_accordion_tabs;

		return $atts;
	}
	
	//Method to get size classname of the accordion	
	protected function get_size() {
		
		$size = $this->atts['size'];
		
		if( empty( $size ) ) {
			return;
		}
		
		return 'accordion-' . $size;
	}

	protected function get_active_style() {
		
		$active_style = $this->atts['active_style'];
		$active_style_arr = array(
			'no'   => '',
			'yes' => 'accordion-active-has-shadow',
		);

		if( empty( $active_style ) ) {
			return;
		}

		return $active_style_arr[ $active_style ];		
	}

	protected function get_heading_shadow() {
		
		$heading_shadow = $this->atts['heading_shadow'];
		$heading_shadow_arr = array(
			'no'   => '',
			'yes' => 'accordion-heading-has-shadow',
		);

		if( empty( $heading_shadow ) ) {
			return;
		}

		return $heading_shadow_arr[ $heading_shadow ];		
	}

	protected function get_items_shadow() {
		
		$items_shadow = $this->atts['items_shadow'];
		$items_shadow_arr = array(
			'no'   => '',
			'yes' => 'accordion-body-shadow'
		);

		if( empty( $items_shadow ) ) {
			return;
		}

		return $items_shadow_arr[ $items_shadow ];		
	}

	protected function get_items_fill() {
		
		if( ! empty( $this->atts['bg_color'] ) || ! empty( $this->atts['active_bg_color'] ) ) {
			return 'accordion-active-has-fill';
		} else {
			return;
		}
		
	}

	protected function get_color_classname() {
		
		if( empty( $this->atts['content_bg'] ) ) {
			return;
		}
		
		return 'accordion-content-has-fill';
	}

	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();
		
		$text_font_inline_style = '';
		/*
		if( 'yes' !== $use_theme_fonts ) {

			// Build the data array
			$text_font_data = $this->get_fonts_data( $text_font );

			// Build the inline style
			$text_font_inline_style = $this->google_fonts_style( $text_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $text_font_data );

		}
		*/

		$elements[ liquid_implode( '%1$s .accordion-title'  ) ] = array( $text_font_inline_style );
		$elements[ liquid_implode( '%1$s .accordion-title'  ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ liquid_implode( '%1$s .accordion-title' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ liquid_implode( '%1$s .accordion-title'  ) ]['font-weight'] = !empty( $fw ) ? $fw : '';
		$elements[ liquid_implode( '%1$s .accordion-title'  ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';
		
		//Content background
		if( ! empty( $content_bg ) && isset( $content_bg ) ) {
			$elements[ liquid_implode( '%1$s .accordion-content' ) ]['background'] = $content_bg;
		}
		
		//Heading Solid color
		if( ! empty( $heading_color ) && isset( $heading_color ) ) {
			$elements[ liquid_implode( '%1$s .accordion-title a' ) ]['color'] = $heading_color;
		}
		if( ! empty( $active_heading_color ) && isset( $active_heading_color ) ) {
			$elements[ liquid_implode( '%1$s .accordion-item.active .accordion-title a' ) ]['color'] = $active_heading_color;
		}

		// Heading gradient color
		if( ! empty( $heading_g_color ) && isset( $heading_g_color ) ) {
			$elements[ liquid_implode( '%1$s .accordion-title a' ) ]['background'] = $heading_g_color . ';-webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; text-fill-color: transparent;';
			$elements[ liquid_implode( '%1$s .accordion-expander' ) ]['background'] = 'inherit';
		}
		if( ! empty( $active_heading_g_color ) && isset( $active_heading_g_color ) ) {
			$elements[ liquid_implode( '%1$s .accordion-item.active .accordion-title a' ) ]['background'] = $active_heading_g_color . ';-webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; text-fill-color: transparent;';
			$elements[ liquid_implode( '%1$s .accordion-item.active .accordion-expander' ) ]['background'] = 'inherit';
		}

		//BG Color
		if( ! empty( $bg_color ) && isset( $bg_color ) ) {
			$elements[ liquid_implode( '%1$s .accordion-title a' ) ]['background'] = $bg_color;
		}
		if( ! empty( $active_bg_color ) && isset( $active_bg_color ) ) {
			$elements[ liquid_implode( '%1$s .accordion-item.active .accordion-title a' ) ]['background'] = $active_bg_color;
		}
		
		//Border color		
		if( ! empty( $border_color ) && isset( $border_color ) ) {
			$elements[ liquid_implode( '%1$s .accordion-title a, %1$s .accordion-item' ) ]['border-color'] = $border_color;
		}
		if( ! empty( $active_border_color ) && isset( $active_border_color ) ) {
			$elements[ liquid_implode( '%1$s .accordion-item.active .accordion-title a, %1$s .accordion-item.active' ) ]['border-color'] = $active_border_color;
		}
		if( !empty( $bottom_margin ) ) {
			$elements[ liquid_implode( '%1$s .accordion-item:not(:last-child)' ) ]['margin-bottom'] = $bottom_margin;
		}
		
		//Expander color		
		if( ! empty( $exp_color ) && isset( $exp_color ) ) {
			$elements[ liquid_implode( '%1$s .accordion-expander' ) ]['color'] = $exp_color;
		}
		if( ! empty( $active_exp_color ) && isset( $active_exp_color ) ) {
			$elements[ liquid_implode( '%1$s .accordion-item.active .accordion-expander' ) ]['color'] = $active_exp_color;
		}

		$this->dynamic_css_parser( $id, $elements );
	}


	
}
new LD_Accordion;

//Accordion Tab
include_once 'liquid-accordion-tab.php';