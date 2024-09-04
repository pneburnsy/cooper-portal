<?php
/**
* Shortcode Counter
*/

if ( ! defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Counter extends LD_Shortcode { 

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_counter';
		$this->title       = esc_html__( 'Counter', 'landinghub-core' );
		$this->icon        = 'la la-list-ol';
		$this->description = esc_html__( 'Create counter.', 'landinghub-core' );
		$this->show_settings_on_create = true;

		parent::__construct();
	}
	
	public function get_params() {
		
		$url = liquid_addons()->plugin_uri() . '/assets/img/sc-preview/counter/';
		
		$icon_params = liquid_get_icon_params( false, '', array( 'fontawesome', 'linea' ), array( 'align', 'size' ), 'i_', array( 'element' => 'add_icon', 'value' => 'yes' ) );

		 $general = array(
			
			array(
				'type'        => 'select_preview',
				'param_name'  => 'template',
				'heading'     => esc_html__( 'Style', 'landinghub-core' ),
				'admin_label' => true,
				'value'       => array(

					array(
						'label' => esc_html__( 'default', 'landinghub-core' ),
						'value' => 'default',
						'image' => $url . 'default.jpg'
					),
					array(
						'value' => 'solid',
						'label' => esc_html__( 'Solid', 'landinghub-core' ),
						'image' => $url . 'solid.jpg'
					),
					array(
						'value' => 'bordered',
						'label' => esc_html__( 'Bordered', 'landinghub-core' ),
						'image' => $url . 'bordered.jpg'
					),
				)
			),
			
			array(
				'type'        => 'textfield',
				'param_name'  => 'count',
				'heading'     => esc_html__( 'Counter', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-8'
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_title',
				'heading'     => esc_html__( 'Custom font?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use custom font for counter', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4'
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_inheritance',
				'heading'     => esc_html__( 'Inherit font styles?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to enable font style inheritance', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'tag_to_inherite',
				'heading'     => esc_html__( 'Tag', 'landinghub-core' ),
				'description' => esc_html__( 'Select tag you want to inherite style defined in theme options', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'h1', 'landinghub-core' ) => 'h1',
					esc_html__( 'h2', 'landinghub-core' ) => 'h2',
					esc_html__( 'h3', 'landinghub-core' ) => 'h3',
					esc_html__( 'h4', 'landinghub-core' ) => 'h4',
					esc_html__( 'h5', 'landinghub-core' ) => 'h5',
					esc_html__( 'h6', 'landinghub-core' ) => 'h6',
				),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'use_inheritance',
					'value'   => 'true',
				)
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'label',
				'heading'    => esc_html__( 'Label', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-8'
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_inheritance_label',
				'heading'     => esc_html__( 'Inherit font styles?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to enable font style inheritance', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'tag_to_inherite_label',
				'heading'     => esc_html__( 'Tag', 'landinghub-core' ),
				'description' => esc_html__( 'Select tag you want to inherite style defined in theme options', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'h1', 'landinghub-core' ) => 'h1',
					esc_html__( 'h2', 'landinghub-core' ) => 'h2',
					esc_html__( 'h3', 'landinghub-core' ) => 'h3',
					esc_html__( 'h4', 'landinghub-core' ) => 'h4',
					esc_html__( 'h5', 'landinghub-core' ) => 'h5',
					esc_html__( 'h6', 'landinghub-core' ) => 'h6',
				),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'use_inheritance_label',
					'value'   => 'true',
				)
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_text',
				'heading'     => esc_html__( 'Custom font?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use custom font for label', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4'
			),
		);		
			
		$general2 = array(	

			array(
				'type'        => 'textfield',
				'param_name'  => 'start_delay',
				'heading'     => esc_html__( 'Start Delay', 'landinghub-core' ),
				'description' => esc_html__( 'Delay before counting starts in milliseconds', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'liquid_button_set',
				'param_name'  => 'content_align',
				'heading'     => esc_html__( 'Alignment', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Left', 'landinghub-core' )  => '',
					esc_html__( 'Center ' )           => 'text-center',
					esc_html__( 'Right', 'landinghub-core' ) => 'text-right',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'counter_mb_checkbox',
				'heading'     => esc_html__( 'Custom Counter Bottom Margin', 'landinghub-core' ),
				'description' => esc_html__( 'Enable custom margin bottom on counter element.', 'landinghub-core' ),
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'counter_mb',
				'heading'     => esc_html__( 'Counter Bottom Space', 'landinghub-core' ),
				'description' => esc_html__( 'Add space to the counter', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 100,
				'step'        => 1,
				'dependency'       => array(
					'element' => 'counter_mb_checkbox',
					'not_empty'=> true,
				),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'add_icon',
				'heading'     => esc_html__( 'Add icon?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to add icon', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'dependency'  => array(
					'element' => 'template',
					'value'   => 'solid',
				),
			),
			
			//Counter Typo Options
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
				'group' => esc_html__( 'Counter Typography', 'landinghub-core' ),
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
				'group' => esc_html__( 'Counter Typography', 'landinghub-core' ),
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
				'group' => esc_html__( 'Counter Typography', 'landinghub-core' ),
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
				'group' => esc_html__( 'Counter Typography', 'landinghub-core' ),
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
				'group' => esc_html__( 'Counter Typography', 'landinghub-core' ),
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
				'group' => esc_html__( 'Counter Typography', 'landinghub-core' ),
				'dependency' => array(
					'element'            => 'use_theme_fonts',
					'value_not_equal_to' => 'yes',
				),
			),
			*/
			//Text Typo Options
			array(
				'type'        => 'textfield',
				'param_name'  => 'text_fs',
				'heading'     => esc_html__( 'Font Size', 'landinghub-core' ),
				'description' => esc_html__( 'Example: 20px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3 vc_column-with-padding',
				'dependency' => array(
					'element' => 'use_custom_fonts_text',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Label Typography', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'text_lh',
				'heading'     => esc_html__( 'Line-Height', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_text',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Label Typography', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'text_fw',
				'heading'     => esc_html__( 'Font Weight', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_text',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Label Typography', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'text_ls',
				'heading'     => esc_html__( 'Letter Spacing', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_text',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Label Typography', 'landinghub-core' ),
			),
			/*
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Use for counter theme default font family?', 'landinghub-core' ),
				'param_name'  => 'text_use_theme_fonts',
				'value'       => array(
					esc_html__( 'Yes', 'landinghub-core' ) => 'yes'
				),
				'description' => esc_html__( 'Use font family from the theme.', 'landinghub-core' ),
				'group' => esc_html__( 'Label Typography', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'use_custom_fonts_text',
					'value'   => 'true',
				),
				'std'         => 'yes',
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'text_text_font',
				'value'      => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
				'settings'   => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'landinghub-core' ),
						'font_style_description'  => esc_html__( 'Select font styling.', 'landinghub-core' ),
					),
				),
				'group' => esc_html__( 'Label Typography', 'landinghub-core' ),
				'dependency' => array(
					'element'            => 'text_use_theme_fonts',
					'value_not_equal_to' => 'yes',
				),
			),
			*/

			// Colors
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => 'true',
				'param_name'  => 'color',
				'heading'     => esc_html__( 'Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => 'true',
				'param_name'  => 'label_color',
				'heading'     => esc_html__( 'Label Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => 'true',
				'param_name'  => 'color_h',
				'heading'     => esc_html__( 'Hover Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'bg_color',
				'heading'     => esc_html__( 'Background Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'dependency' => array(
					'element' => 'template',
					'value'   => 'solid'
				),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'bg_color_h',
				'heading'     => esc_html__( 'Hover Background Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'dependency' => array(
					'element' => 'template',
					'value'   => 'solid'
				),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => 'true',
				'param_name'  => 'border_color',
				'heading'     => esc_html__( 'Border Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'dependency' => array(
					'element' => 'template',
					'value'   => 'bordered'
				),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => 'true',
				'param_name'  => 'border_color_h',
				'heading'     => esc_html__( 'Hover Border Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'dependency' => array(
					'element' => 'template',
					'value'   => 'bordered'
				),
			),


		);
		
		$this->params = array_merge( $general, $general2, $icon_params );

		$this->add_extras();
	}

	protected function get_class( $style ) {

		$hash = array(
			'default'    => 'lqd-counter-default',
			'solid'    => 'lqd-counter-solid p-4 px-sm-5 text-left',
			'bordered' => 'lqd-counter-bordered lqd-counter-bold',
		);

		return isset( $hash[ $style ] ) ? $hash[ $style ] : $hash['default'];
	}
	
	protected function get_data_options() {
		
		$opts = array();
		$counter = $this->atts['count'];
		$start_delay = $this->atts['start_delay'];
		
		if( ! empty( $counter ) ) {
			$opts['targetNumber'] = esc_html( $counter );	
		}
		if( ! empty( $start_delay ) ) {
			$opts['startDelay'] = esc_html( $start_delay );	
		}
		
		return 'data-counter-options=\'' . wp_json_encode( $opts ) . '\'';
		
	}
	
	protected function get_label() {
		
		$label = $this->atts['label'];
		$classname = '';
		
		if( $this->atts['use_inheritance_label'] ) {
			$classname = $this->atts['tag_to_inherite_label']; 
		}

		if ( empty( $label ) ) {
			return;
		}
		
		printf( '<span class="lqd-counter-text lqd-text-bottom %s">%s</span>', $classname, esc_html( $label ) );
	}	
	
	protected function get_count() {
		
		$counter = $this->atts['count'];

		if ( empty( $counter ) ) {
			return;
		}
		
		printf( '<span>%s</span>', esc_html( $counter ) );
	}
	
	protected function get_icon() {

		$icon = liquid_get_icon( $this->atts );
		$icon_html = '';

		if( $icon['type'] ) {
			$icon_html = '<span class="lqd-counter-icon"><i class="' . $icon['icon'] . '"></i></span>';
		}

		echo $icon_html;

	}

	protected function generate_css() {
		
		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();
		
		$text_font_inline_style = '';
		$text_text_font_inline_style = '';
		/*
		if( 'yes' !== $use_theme_fonts ) {

			// Build the data array
			$text_font_data = $this->get_fonts_data( $text_font );

			// Build the inline style
			$text_font_inline_style = $this->google_fonts_style( $text_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $text_font_data );

		}
		if( 'yes' !== $text_use_theme_fonts ) {

			// Build the data array
			$text_text_font_data = $this->get_fonts_data( $text_text_font );

			// Build the inline style
			$text_text_font_inline_style = $this->google_fonts_style( $text_text_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $text_text_font_data );

		}
		*/
		
		$elements[ liquid_implode( '%1$s .lqd-counter-element' ) ] = array( $text_font_inline_style );
		$elements[ liquid_implode( '%1$s .lqd-counter-element' ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ liquid_implode( '%1$s .lqd-counter-element' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ liquid_implode( '%1$s .lqd-counter-element' ) ]['font-weight'] = !empty( $fw ) ? $fw : '';
		$elements[ liquid_implode( '%1$s .lqd-counter-element' ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';
		
		$elements[ liquid_implode( '%1$s .lqd-text-bottom' ) ] = array( $text_text_font_inline_style );
		$elements[ liquid_implode( '%1$s .lqd-text-bottom' ) ]['font-size'] = !empty( $text_fs ) ? $text_fs : '';
		$elements[ liquid_implode( '%1$s .lqd-text-bottom' ) ]['line-height'] = !empty( $text_lh ) ? $text_lh : '';
		$elements[ liquid_implode( '%1$s .lqd-text-bottom' ) ]['font-weight'] = !empty( $text_fw ) ? $text_fw : '';
		$elements[ liquid_implode( '%1$s .lqd-text-bottom' ) ]['letter-spacing'] = !empty( $text_ls ) ? $text_ls : '';
		
		if( ! empty( $color ) && isset( $color ) ) {
			$elements[ liquid_implode( '%1$s' ) ]['color'] = $color;
		}
		if( ! empty( $label_color ) && isset( $label_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-counter-text' ) ]['color'] = $label_color;
		}
		if( ! empty( $color_h ) && isset( $color_h ) ) {
			$elements[ liquid_implode( '%1$s:hover' ) ]['color'] = $color_h;
		}
		if( ! empty( $bg_color ) && isset( $bg_color ) ) {
			$elements[ liquid_implode( '%1$s' ) ]['background'] = $bg_color;
		}
		if( ! empty( $bg_color_h ) && isset( $bg_color_h ) ) {
			$elements[ liquid_implode( '%1$s .lqd-counter-overlay-bg' ) ]['background'] = $bg_color_h;
		}
		if( ! empty( $border_color ) && isset( $border_color ) ) {
			$elements[ liquid_implode( '%1$s' ) ]['border-color'] = $border_color;
		}
		if( ! empty( $border_color_h ) && isset( $border_color_h ) ) {
			$elements[ liquid_implode( '%1$s:hover' ) ]['border-color'] = $border_color_h;
		}

		if ( ! empty($counter_mb_checkbox) && isset($counter_mb_checkbox) ) {
			$elements[ liquid_implode( '%1$s .lqd-counter-element' ) ]['margin-bottom'] = $counter_mb . 'px';
		}

		$this->dynamic_css_parser( $id, $elements );

	}
	
}

new LD_Counter;