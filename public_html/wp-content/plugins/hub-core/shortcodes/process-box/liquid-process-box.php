<?php
/**
* Shortcode Process Box
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Process_Box extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_process_box';
		$this->title       = esc_html__( 'Process Box', 'landinghub-core' );
		$this->icon        = 'la la-table';
		$this->description = esc_html__( 'Create a process box', 'landinghub-core' );
		$this->as_child        = array( 'only' => 'ld_process_box_container' );
		$this->show_settings_on_create = true;

		parent::__construct();
	}

	public function get_params() {
		
		$icons = liquid_get_icon_params( false, '', array( 'fontawesome', 'linea' ), array( 'align', 'size' ), 'i_', array( 'element' => 'add_icon', 'value' => 'yes' ) );
		
		$params = array(

			array(
				'id'               => 'title',
				'edit_field_class' => 'vc_col-sm-8 vc_column-with-padding'
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_title',
				'heading'     => esc_html__( 'Custom font?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use custom font for title', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
			),			
			array(
				'type'       => 'textarea_html',
				'param_name' => 'content',
				'heading'    => esc_html__( 'Text', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-9',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'count',
				'heading'     => esc_html__( 'Count', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'admin_label' => true,
				'dependency' => array(
					'element' => 'add_icon',
					'value_not_equal_to' => 'yes',
				)
			),
			array(
				'type'        => 'liquid_attach_image',
				'param_name'  => 'image',
				'heading'     => esc_html__( 'Image', 'landinghub-core' ),
			),
			array(
				'type'       => 'checkbox',
				'param_name' => 'add_icon',
				'heading'    => esc_html__( 'Add Icon?', 'landinghub-core' ),
				'value'      => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			),
			//Typo Title Options
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
				'group' => esc_html__( 'Title Typo', 'landinghub-core' ),
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
				'group' => esc_html__( 'Title Typo', 'landinghub-core' ),
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
				'group' => esc_html__( 'Title Typo', 'landinghub-core' ),
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
				'group' => esc_html__( 'Title Typo', 'landinghub-core' ),
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
				'group' => esc_html__( 'Title Typo', 'landinghub-core' ),
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
				'group'      => esc_html__( 'Title Typo', 'landinghub-core' ),
				'dependency' => array(
					'element'            => 'use_theme_fonts',
					'value_not_equal_to' => 'yes',
				),
			),
			*/
			//Design Options
			array(
				'type' => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'title_color',
				'heading' => esc_html__( 'Title Color', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'title_hover_color',
				'heading' => esc_html__( 'Title Hover Color', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'liquid_colorpicker',
				'param_name' => 'bg_shape',
				'heading' => esc_html__( 'Shape Background', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),
			array(
				'type' => 'liquid_colorpicker',
				'param_name' => 'hover_bg_shape',
				'heading' => esc_html__( 'Shape Hover Background', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'liquid_colorpicker',
				'param_name' => 'shape_border',
				'only_solid' => true,
				'heading' => esc_html__( 'Shape Border', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),
			array(
				'type' => 'liquid_colorpicker',
				'param_name' => 'hover_shape_border',
				'only_solid' => true,
				'heading' => esc_html__( 'Shape Hover Border', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'number_color',
				'heading' => esc_html__( 'Number Color', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'hover_number_color',
				'heading' => esc_html__( 'Number Hover Color', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'icon_color',
				'heading' => esc_html__( 'Icon Color', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'hover_icon_color',
				'heading' => esc_html__( 'Icon Hover Color', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'secondary_color',
				'heading' => esc_html__( 'Secondary Color', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
				'description' => esc_html__( 'Style 3 and 8 rotating border color.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			
		);
		$this->params = array_merge( $params, $icons );
		$this->add_extras();

	}
	
	public function before_output( $atts, &$content ) {
		
		global $liquid_pb_style;
		
		$atts['template'] = $liquid_pb_style;

		return $atts;
	}
	
	protected function get_image() {

		// check value
		if( 
			empty( $this->atts['image'] ) || 
			'yes' === $this->atts['add_icon'] 
		) {
			return;
		}

		$img_src = $image = '';
		if( preg_match( '/^\d+$/', $this->atts['image'] ) ) {
			$html = wp_get_attachment_image( $this->atts['image'], 'full', false );
		} 
		else {
			$img_src  = $this->atts['image'];
			$html = '<img src="' . esc_url( $img_src ) . '" alt="' . esc_html( $alt ) . '" />';

		}

		$image = sprintf( '<figure>%s</figure>', $html );
		
		echo $image;

	}

	protected function get_title( $classnames = '' ) {

		// check
		if( empty( $this->atts['title'] ) ) {
			return '';
		}
		$class = '';
		if( !empty( $classnames ) ) {
			$class = 'class="' . $classnames . '"';
		}
		
		$title = sprintf( '<h3 %s>%s</h3>', $class, $this->atts['title'] );

		echo $title;
	}
	
	protected function get_content() {

		// check
		if( empty( $this->atts['content'] ) ) {
			return '';
		}

		$content = ld_helper()->do_the_content( $this->atts['content'] );

		echo $content;
	}

	protected function get_count() {
		
		if( 'yes' === $this->atts['add_icon'] ) {
			return;
		}
		
		$counter = $this->atts['count'];

		if ( empty( $counter ) ) {
			return;
		}
		
		printf( '<span class="ld-pb-num">%s</span>', esc_html( $counter ) );
	}
	
	protected function get_icon() {
		
		// check value
		if( 
			!empty( $this->atts['image'] ) || 
			'yes' !== $this->atts['add_icon'] 
		) {
			return;
		}

		$icon = liquid_get_icon( $this->atts );
		$icon_html = '';

		if( $icon['type'] ) {
			$icon_html = '<i class="' . $icon['icon'] . '"></i>';
		}
		else {
			$icon_html = '<i class="lqd-icn-ess icon-et-lightbulb"></i>';
		}

		echo $icon_html;

	}

	protected function generate_css() {

		$settings = get_option( 'wpb_js_google_fonts_subsets' );
		if ( is_array( $settings ) && ! empty( $settings ) ) {
			$subsets = '&subset=' . implode( ',', $settings );
		} else {
			$subsets = '';
		}

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
		$elements[ liquid_implode( '%1$s h3' ) ] = array( $text_font_inline_style );
		$elements[ liquid_implode( '%1$s h3' ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ liquid_implode( '%1$s h3' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ liquid_implode( '%1$s h3' ) ]['font-weight'] = !empty( $fw ) ? $fw . ' !important' : '';
		$elements[ liquid_implode( '%1$s h3' ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';
		
		if( !empty( $title_color ) ) {
			$elements[ liquid_implode( '%1$s h3' ) ]['color'] = $title_color;
		}
		if( !empty( $title_hover_color ) ) {
			$elements[ liquid_implode( '%1$s:hover h3' ) ]['color'] = $title_hover_color;
		}
		
		if( !empty( $bg_shape ) ) {
			$elements[ liquid_implode( '%1$s .lqd-pb-active-shape' ) ]['background'] = $bg_shape;
		}
		if( !empty( $hover_bg_shape ) ) {
			$elements[ liquid_implode( '%1$s:hover .lqd-pb-active-shape' ) ]['background'] = $hover_bg_shape;
		}
		
		if( !empty( $shape_border ) ) {
			$elements[ liquid_implode( '%1$s .lqd-pb-active-shape' ) ]['border-color'] = $shape_border;
		}
		if( !empty( $hover_shape_border ) ) {
			$elements[ liquid_implode( '%1$s:hover .lqd-pb-active-shape' ) ]['border-color'] = $hover_shape_border;
		}
		
		if( !empty( $number_color ) ) {
			if( in_array( $template, array( 'style01', 'style02', 'style03', 'style05', 'style07', 'style09' ) ) ) {
				$elements[ liquid_implode( '%1$s .lqd-pb-active-shape' ) ]['color'] = $number_color;
			}
			elseif( in_array( $template, array( 'style04', 'style07', 'style08' ) ) ) {
				$elements[ liquid_implode( '%1$s .lqd-pb-num-container' ) ]['color'] = $number_color;
			}
		}
		
		if( !empty( $hover_number_color ) ) {
			if( in_array( $template, array( 'style01', 'style02', 'style03', 'style05', 'style07', 'style09' ) ) ) {
				$elements[ liquid_implode( '%1$s:hover .lqd-pb-active-shape' ) ]['color'] = $hover_number_color;
			}
			elseif( in_array( $template, array( 'style04', 'style07', 'style08' ) ) ) {
				$elements[ liquid_implode( '%1$s:hover .lqd-pb-num-container' ) ]['color'] = $hover_number_color;
			}
		}

		if( !empty( $icon_color ) ) {
			if( in_array( $template, array( 'style02', 'style04', 'style06', 'style07', 'style08' ) ) ) {
				$elements[ liquid_implode( '%1$s .lqd-pb-icon-container' ) ]['color'] = $icon_color;
			}
		}
		if( !empty( $hover_icon_color ) ) {
			if( in_array( $template, array( 'style02', 'style04', 'style06', 'style07', 'style08' ) ) ) {
				$elements[ liquid_implode( '%1$s:hover .lqd-pb-icon-container' ) ]['color'] = $hover_icon_color;
				$elements[ liquid_implode( '%1$s:hover .lqd-pb-icon-container .lqd-pb-active-shape' ) ]['color'] = 'inherit';
			}
		}

		if( !empty( $secondary_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-pb-shape-border path' ) ]['stroke'] = $secondary_color;
		}
		

		$this->dynamic_css_parser( $id, $elements );

	}

}
new LD_Process_Box;