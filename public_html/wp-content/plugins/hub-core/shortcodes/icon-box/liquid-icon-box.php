<?php
/**
* Shortcode Icon box
*/

if( !defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Icon_Box extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_icon_box';
		$this->title       = esc_html__( 'Icon Box', 'landinghub-core' );
		$this->description = esc_html__( 'Create an icon box.', 'landinghub-core' );
		$this->icon        = 'la la-flash';
		$this->styles       = array( 'vc_font_awesome_5' );
		$this->scripts      = array( 'jquery-vivus' );
		$this->show_settings_on_create = true;
		
		add_filter( 'https_ssl_verify', '__return_false' );

		parent::__construct();
	}
	
	public function get_params() {

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
				'value' => 'yes',
			)
		);
		
		$params = array(
			
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_separator',
				'heading'    => esc_html__( 'Heading', 'landinghub-core' ),
				'group' => esc_html__( 'Content', 'landinghub-core' ),
			),
			array(
				'id' => 'title',
				'group' => esc_html__( 'Content', 'landinghub-core' ),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'tag',
				'heading'     => esc_html__( 'Element tag', 'landinghub-core' ),
				'description' => esc_html__( 'Select element tag.', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'h1', 'landinghub-core' )  => 'h1',
					esc_html__( 'h2', 'landinghub-core' )  => 'h2',
					esc_html__( 'h3', 'landinghub-core' )  => 'h3',
					esc_html__( 'h4', 'landinghub-core' )  => 'h4',
					esc_html__( 'h5', 'landinghub-core' )  => 'h5',
					esc_html__( 'h6', 'landinghub-core' )  => 'h6',
					esc_html__( 'p', 'landinghub-core' )   => 'p',
					esc_html__( 'div', 'landinghub-core' ) => 'div',
				),
				'std' => 'h3',
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Content', 'landinghub-core' ),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_inheritance',
				'heading'     => esc_html__( 'Inherit font styles?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to enable font style inheritance', 'landinghub-core' ),
				'group' => esc_html__( 'Content', 'landinghub-core' ),
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
				),
				'group' => esc_html__( 'Content', 'landinghub-core' ),
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'title_mb',
				'heading'     => esc_html__( 'Heading Bottom Space', 'landinghub-core' ),
				'description' => esc_html__( 'Add space to the title', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 100,
				'step'        => 1,
				'group' => esc_html__( 'Content', 'landinghub-core' ),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'heading_size',
				'heading'    => esc_html__( 'Title Size', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Default', 'landinghub-core' )     => '',
					esc_html__( 'Extra Small (18px)', 'landinghub-core' ) => 'xs',
					esc_html__( 'Small (20px)', 'landinghub-core' )       => 'sm',
					esc_html__( 'Medium (24px)', 'landinghub-core' )      => 'md',
					esc_html__( 'Large (28px)', 'landinghub-core' )       => 'lg',
					esc_html__( 'Custom', 'landinghub-core' )             => 'custom',
				),
				'group' => esc_html__( 'Content', 'landinghub-core' ),
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'custom_heading_size',
				'heading'    => esc_html__( 'Custom title size', 'landinghub-core' ),
				'description' => esc_html__( 'Add custom title size with px. for ex. 35px' ),
				'dependency' => array(
					'element' => 'heading_size',
					'value'   => 'custom'	
				),
				'group'            => esc_html__( 'Content', 'landinghub-core' ),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'heading_weight',
				'heading'    => esc_html__( 'Title Weight', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Default', 'landinghub-core' )   => '',
					esc_html__( 'Light', 'landinghub-core' )     => 'font-weight-light',
					esc_html__( 'Normal', 'landinghub-core' )    => 'font-weight-normal',
					esc_html__( 'Medium', 'landinghub-core' ) => 'font-weight-medium',
					esc_html__( 'Semi Bold', 'landinghub-core' ) => 'font-weight-semibold',
					esc_html__( 'Bold', 'landinghub-core' )      => 'font-weight-bold',
				),
				'group' => esc_html__( 'Content', 'landinghub-core' ),
			),
			array(
				'type'       => 'liquid_button_set',
				'param_name' => 'heading_underline',
				'heading'    => esc_html__( 'Title Underlined', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'No', 'landinghub-core' )   => 'no',
					esc_html__( 'Yes', 'landinghub-core' )   => 'yes',
				),
				'std' => 'no',
				'group' => esc_html__( 'Content', 'landinghub-core' ),
			),
			array(
				'type'       => 'liquid_button_set',
				'param_name' => 'heading_icon_onhover',
				'heading'    => esc_html__( 'Title Icon On Hover', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'No', 'landinghub-core' )   => 'no',
					esc_html__( 'Yes', 'landinghub-core' )   => 'yes',
				),
				'std' => 'no',
				'group' => esc_html__( 'Content', 'landinghub-core' ),
			),
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_separator',
				'heading'    => esc_html__( 'Contents', 'landinghub-core' ),
				'group' => esc_html__( 'Content', 'landinghub-core' ),
			),
			array(
				'type'       => 'textarea_html',
				'param_name' => 'content',
				'heading'    => esc_html__( 'Content', 'landinghub-core' ),
				'holder'     => 'div',
				'group' => esc_html__( 'Content', 'landinghub-core' )
			),
			array(
				'id' => 'link',
				'group' => esc_html__( 'Content', 'landinghub-core' ),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'get_bubble_classname',
				'heading'     => esc_html__( 'Show content in bubble box', 'landinghub-core' ),
				'group' => esc_html__( 'Content', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Yes', 'landinghub-core' ) => 'iconbox-bubble'
				),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'get_content_hover_classname',
				'heading'     => esc_html__( 'Show content on hover', 'landinghub-core' ),
				'group' => esc_html__( 'Content', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Yes', 'landinghub-core' ) => 'iconbox-contents-show-onhover'
				),
				'dependency'       => array(
					'element' => 'get_bubble_classname',
					'value'   => 'iconbox-bubble',
				),
			),
			array(
				'type'       => 'checkbox',
				'param_name' => 'toggleable',
				'heading'    => esc_html__( 'Toggle Icon And Button On Hover', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Yes', 'landinghub-core' ) => 'yes'
				),
				'group' => esc_html__( 'Content', 'landinghub-core' ),
				'dependency'       => array(
					'element' => 'get_bubble_classname',
					'is_empty'   => true,
				),
			),
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_separator_label',
				'heading'    => esc_html__( 'Label', 'landinghub-core' ),
				'group' => esc_html__( 'Content', 'landinghub-core' ),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'show_label',
				'heading'     => esc_html__( 'Add Label to iconbox', 'landinghub-core' ),
				'group' => esc_html__( 'Content', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Yes', 'landinghub-core' ) => 'yes'
				),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'label',
				'heading'     => esc_html__( 'Label', 'landinghub-core' ),
				'description' => esc_html__( 'Add label text', 'landinghub-core' ),
				'dependency'       => array(
					'element' => 'show_label',
					'value'   => 'yes',
				),
				'group' => esc_html__( 'Content', 'landinghub-core' ),
			),
			array(
				'type'       => 'liquid_button_set',
				'param_name' => 'label_position',
				'heading'    => esc_html__( 'Label Position', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Floating', 'landinghub-core' )   => 'floating',
					esc_html__( 'In Content', 'landinghub-core' ) => 'in_content',
				),
				'dependency'       => array(
					'element' => 'show_label',
					'value'   => 'yes',
				),
				'std' => 'floating',
				'group' => esc_html__( 'Content', 'landinghub-core' ),
			),
			
		);
		
		$icon = liquid_get_icon_params( false, null, 'all', array( 'align', 'color', 'hcolor', 'size' ), 'i_' );
		
		$svg_params = array(

			array(
				'type'       => 'dropdown',
				'param_name' => 'hover_animation',
				'heading'    => esc_html__( 'Re-Play Animation', 'landinghub-core' ),
				'description' => esc_html__( 'Play animations again once hovering the iconbox. ', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'No', 'landinghub-core' )  => '',
					esc_html__( 'Yes', 'landinghub-core' ) => 'yes'
				),
				'dependency' => array(
					'element' => 'i_type',
					'value'   => 'animated',
				),
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'animation_delay',
				'heading'    => esc_html__( 'Animation Delay', 'landinghub-core' ),
				'description' => esc_html__( 'Add starting animation delay in milliseconds.', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'i_type',
					'value'   => 'animated',
				),
			),

		);
		
		$styling_params = array(

			array(
				'type'       => 'subheading',
				'param_name' => 'sh_separator',
				'heading'    => esc_html__( 'Icon Properties', 'landinghub-core' )
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'icon_size',
				'heading'     => esc_html__( 'Icon size', 'landinghub-core' ),
				'description' => esc_html__( 'Add font icon size with px, for ex. 24px', 'landinghub-core' ),
				'dependency'       => array(
					'element' => 'i_type',
					'value'   => array( 'fontawesome', 'linea' ),
				),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'custom_size',
				'heading'     => esc_html__( 'Custom Icon size', 'landinghub-core' ),
				'description' => esc_html__( 'Add icon custom size with px, for ex. 45px', 'landinghub-core' ),
				'dependency'       => array(
					'element' => 'i_type',
					'value'   => array( 'animated', 'image' ),
				),
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'icon_mb',
				'heading'     => esc_html__( 'Icon Spacing', 'landinghub-core' ),
				'description' => esc_html__( 'Add space to the icon', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 100,
				'step'        => 1,
			),
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_separator',
				'heading'    => esc_html__( 'Shape Properties', 'landinghub-core' )
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'i_shape',
				'heading'    => 'Shape',
				'value'      => array(
					esc_html__( 'None', 'landinghub-core' ) => '',
					esc_html__( 'Square', 'landinghub-core' )  => 'square',
					esc_html__( 'Circle', 'landinghub-core' )  => 'circle',
					esc_html__( 'Lozenge', 'landinghub-core' ) => 'lozenge',
					esc_Html__( 'Custom', 'landinghub-core' )  => 'custombg',
				),
			),
			array(
				'type'        => 'liquid_attach_image',
				'param_name'  => 'i_shape_custom_bg',
				'heading'     => esc_html__( 'Custom Shape', 'landinghub-core' ),
				'dependency'    => array(
					'element' => 'i_shape',
					'value'   => 'custombg',
				),
			),
			
			//Custom size
			array(
				'type'        => 'textfield',
				'param_name'  => 'custom_i_top_offset',
				'heading'     => esc_html__( 'Top Offset', 'landinghub-core' ),
				'description' => esc_html__( 'Add top offset with px, for ex. 45px', 'landinghub-core' ),
				'dependency'       => array(
					'element' => 'i_shape',
					'value'   => array( 'custombg' ),
				),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'custom_i_left_offset',
				'heading'     => esc_html__( 'Left Offset', 'landinghub-core' ),
				'description' => esc_html__( 'Add left offset with px, for ex. 45px', 'landinghub-core' ),
				'dependency'       => array(
					'element' => 'i_shape',
					'value'   => array( 'custombg' ),
				),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'custom_i_width',
				'heading'     => esc_html__( 'Width', 'landinghub-core' ),
				'description' => esc_html__( 'Add width with px, for ex. 45px', 'landinghub-core' ),
				'dependency'       => array(
					'element' => 'i_shape',
					'value'   => array( 'custombg' ),
				),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'custom_i_height',
				'heading'     => esc_html__( 'Height', 'landinghub-core' ),
				'description' => esc_html__( 'Add height with px, for ex. 45px', 'landinghub-core' ),
				'dependency'       => array(
					'element' => 'i_shape',
					'value'   => array( 'custombg' ),
				),
			),
			
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'i_shape_border_radius',
				'heading'     => esc_html__( 'Border Radius', 'landinghub-core' ),
				'description' => esc_html__( 'Add border radiuse to square shape', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 50,
				'step'        => 1,
				'dependency'       => array(
					'element' => 'i_shape',
					'value'   => array( 'square' ),
				),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'i_size',
				'heading'    => esc_html__( 'Pre-Defined Shape Sizes', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Default', 'landinghub-core' )     => '',
					esc_html__( 'Extra Small (45px)', 'landinghub-core' ) => 'xs',
					esc_html__( 'Small (60px)', 'landinghub-core' )       => 'sm',
					esc_html__( 'Medium (90px)', 'landinghub-core' )      => 'md',
					esc_html__( 'Large (100px)', 'landinghub-core' )       => 'lg',
					esc_html__( 'Extra Large (125px)', 'landinghub-core' ) => 'xl',
				),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'custom_i_size',
				'heading'     => esc_html__( 'Custom Shape Size', 'landinghub-core' ),
				'description' => esc_html__( 'Add shape custom size with px, for ex. 45px', 'landinghub-core' ),
				'dependency'       => array(
					'element' => 'i_shape',
					'value'   => array( 'square', 'circle' ),
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Border Width', 'landinghub-core' ),
				'param_name' => 'i_border',
				'value'      => array(
					esc_html__( 'None', 'landinghub-core' ) => '',
					esc_html__( '1', 'landinghub-core' )    => 1,
					esc_html__( '2', 'landinghub-core' )    => 2,
					esc_html__( '3', 'landinghub-core' )    => 3,
				),
				'dependency'       => array(
					'element' => 'i_shape',
					'value'   => array( 'square', 'circle', 'lozenge' )
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Position', 'landinghub-core' ),
				'param_name' => 'position',
				'value'      => array(
					esc_html__( 'Default', 'landinghub-core' )        => '',
					esc_html__( 'Heading Inline', 'landinghub-core' ) => 'iconbox-inline',
					esc_html__( 'Content Inline', 'landinghub-core' ) => 'iconbox-side'
				),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Align Icon To Middle', 'landinghub-core' ),
				'param_name' => 'items_alignment',
				'value'      => array(
					esc_html__( 'Yes', 'landinghub-core' ) => 'align-items-center',
				),
				'dependency' => array(
					'element' => 'position',
					'value'   => array( 'iconbox-inline', 'iconbox-side' ),
				),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Icons Linked', 'landinghub-core' ),
				'description' => esc_html__( 'Add line between icons. ( works with icon shape "Circle" only', 'landinghub-core' ),
				'param_name' => 'i_linked',
				'value'      => array(
					esc_html__( 'Yes', 'landinghub-core' )  => 'iconbox-icon-linked',
				),
				'dependency'       => array(
					'element' => 'position',
					'value'   => array( 'iconbox-side' )
				),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Ripple effect', 'landinghub-core' ),
				'param_name' => 'i_ripple_effect',
				'value'      => array(
					esc_html__( 'Yes', 'landinghub-core' ) => 'yes',
				),
				'dependency'       => array(
					'element' => 'i_shape',
					'value'   => array( 'square', 'circle', 'lozenge' )
				),
			),
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_separator',
				'heading'    => esc_html__( 'Show/Hide Button', 'landinghub-core' )
			),
			array(
				'type'       => 'checkbox',
				'param_name' => 'show_button',
				'heading'    => esc_html__( 'Show Button', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Yes', 'landinghub-core' ) => 'yes'
				)
			),


		);
		
		//Design Options
		$design_params = array(
			array(
				'type'       => 'css_editor',
				'param_name' => 'css',
				'heading'    => esc_html__( 'CSS box', 'landinghub-core' ),
			),
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_separator',
				'heading'    => esc_html__( 'Content Alignment', 'landinghub-core' ),
				'group' => esc_html__( 'Content', 'landinghub-core' ),
			),
			array(
				'type'       => 'liquid_button_set',
				'param_name' => 'alignment',
				'heading'    => esc_html__( 'Alignment', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Default', 'landinghub-core' ) => 'text-align-default',
					esc_html__( 'Left', 'landinghub-core' )    => 'text-left',
					esc_html__( 'Right', 'landinghub-core' )   => 'text-right'
				),
				'group' => esc_html__( 'Content', 'landinghub-core' ),
				'std' => 'text-align-default',
			),
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_label',
				'heading'    => esc_html__( 'Icon Colors', 'landinghub-core' ),
			),
			array(
				'type'             => 'liquid_colorpicker',
				'only_solid'       => true,
				'param_name'       => 'i_color',
				'heading'          => esc_html__( 'Icon Color', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'i_type',
					'value_not_equal_to'   => 'image',
				),
			),
			array(
				'type'             => 'liquid_colorpicker',
				'param_name'       => 'i_color2',
				'only_solid'       => true,
				'heading'          => esc_html__( 'Icon Color 2', 'landinghub-core' ),
				'description'      => esc_html__( 'Use second color option to create gradients', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'i_type',
					'value_not_equal_to'   => 'image',
				),
			),
			array(
				'type'             => 'liquid_colorpicker',
				'param_name'       => 'h_i_color',
				'only_solid'       => true,
				'heading'          => esc_html__( 'Hover Icon Color', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'i_type',
					'value_not_equal_to'   => 'image',
				),
			),
			array(
				'type'             => 'liquid_colorpicker',
				'param_name'       => 'h_i_color2',
				'only_solid'       => true,				
				'heading'          => esc_html__( 'Hover Icon Color 2', 'landinghub-core' ),
				'description'      => esc_html__( 'Use second color option to create gradients', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'i_type',
					'value_not_equal_to'   => 'image',
				),
			),
			array(
				'type'             => 'liquid_colorpicker',
				'param_name'       => 'svg_stroke_color',
				'only_solid'       => true,				
				'heading'          => esc_html__( 'SVG Stroke Color', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'i_type',
					'value'   => 'image',
				),
			),
			array(
				'type'             => 'liquid_colorpicker',
				'param_name'       => 'svg_fill_color',
				'only_solid'       => true,				
				'heading'          => esc_html__( 'SVG Fill Color', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'i_type',
					'value'   => 'image',
				),
			),
			array(
				'type'             => 'liquid_colorpicker',
				'param_name'       => 'h_svg_stroke_color',
				'only_solid'       => true,				
				'heading'          => esc_html__( 'SVG Hover Stroke Color', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'i_type',
					'value'   => 'image',
				),
			),
			array(
				'type'             => 'liquid_colorpicker',
				'param_name'       => 'h_svg_fill_color',
				'only_solid'       => true,				
				'heading'          => esc_html__( 'SVG Hover Fill Color', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'i_type',
					'value'   => 'image',
				),
			),
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_label',
				'heading'    => esc_html__( 'Heading Colors', 'landinghub-core' ),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'heading_gradient',
				'heading'     => esc_html__( 'Enable Heading Gradient?', 'landinghub-core' ),
				'description' => esc_html__( 'Enable gradient color to the heading', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Yes', 'landinghub-core' ) => 'iconbox-heading-gradient'
				)
			),
			array(
				'type'             => 'liquid_colorpicker',
				'param_name'       => 'h_color',
				'only_solid'       => true,
				'heading'          => esc_html__( 'Heading Color', 'landinghub-core' ),
			),
			array(
				'type'             => 'liquid_colorpicker',
				'param_name'       => 'h_color2',
				'only_solid'       => true,
				'heading'          => esc_html__( 'Heading Color 2', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a second color to make heading gradient', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'heading_gradient',
					'value'   => 'iconbox-heading-gradient',
				),
			),
			array(
				'type'             => 'liquid_colorpicker',
				'param_name'       => 'h_hcolor',
				'only_solid'       => true,
				'heading'          => esc_html__( 'Hover Heading Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick heading color for hover state', 'landinghub-core' ),
			),
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_label',
				'heading'    => esc_html__( 'Icon Shape Colors', 'landinghub-core' ),
				'dependency'       => array(
					'element' => 'i_shape',
					'value'   => array( 'square', 'circle', 'lozenge' )
				),
			),
			array(
				'type'             => 'liquid_colorpicker',
				'param_name'       => 'shape_color',
				'heading'          => esc_html__( 'Shape Fill Color', 'landinghub-core' ),
				'dependency'       => array(
					'element' => 'i_shape',
					'value'   => array( 'square', 'circle', 'lozenge' )
				),
			),
			array(
				'type'             => 'liquid_colorpicker',
				'param_name'       => 'shape_hcolor',
				'heading'          => esc_html__( 'Hover Shape Fill Color', 'landinghub-core' ),
				'dependency'       => array(
					'element' => 'i_shape',
					'value'   => array( 'square', 'circle', 'lozenge' )
				),
			),
			array(
				'type'             => 'liquid_colorpicker',
				'only_solid'       => true,
				'param_name'       => 'border_shape_color',
				'heading'          => esc_html__( 'Shape Border Color', 'landinghub-core' ),
				'dependency'       => array(
					'element' => 'i_border',
					'value'   => array( '1', '2', '3' )
				),
			),
			array(
				'type'             => 'liquid_colorpicker',
				'only_solid'       => true,
				'param_name'       => 'border_shape_hcolor',
				'heading'          => esc_html__( 'Hover Shape Border Color', 'landinghub-core' ),
				'dependency'       => array(
					'element' => 'i_border',
					'value'   => array( '1', '2', '3' )
				),
			),
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_label',
				'heading'    => esc_html__( 'Iconbox Filling Colors', 'landinghub-core' ),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'fill',
				'heading'     => esc_html__( 'Enable Fill?', 'landinghub-core' ),
				'description' => esc_html__( 'Enable to add background color to the icon box', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Yes', 'landinghub-core' ) => 'yes'
				),
				'dependency'       => array(
					'element' => 'get_bubble_classname',
					'is_empty'   => true,
				),
			),
			array(
				'type'          => 'liquid_colorpicker',
				'param_name'    => 'fill_color',
				'heading'       => esc_html__( 'Fill Color', 'one-color' ),
				'dependency'    => array(
					'element'   => 'fill',
					'not_empty' => true,
				),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'border_radius',
				'heading'    => esc_html__( 'Border Radius', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Default', 'landinghub-core' )    => '',
					esc_html__( 'Semi Round', 'landinghub-core' ) => 'iconbox-semiround',
					esc_html__( 'Round', 'landinghub-core' )      => 'iconbox-round',
				),
				'dependency'    => array(
					'element'   => 'fill',
					'not_empty' => true,
				),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'hover_fill',
				'heading'     => esc_html__( 'Enable Hover Fill?', 'landinghub-core' ),
				'description' => esc_html__( 'Enable to add background color to the hover state of the icon box', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Yes', 'landinghub-core' ) => 'yes'
				),
				'dependency'       => array(
					'element' => 'get_bubble_classname',
					'is_empty'   => true,
				),
			),
			array(
				'type'        => 'liquid_attach_image',
				'param_name'  => 'hover_bg_image',
				'heading'     => esc_html__( 'Hover Background Image', 'landinghub-core' ),
				'dependency'    => array(
					'element'   => 'hover_fill',
					'not_empty' => true,
				),
			),
			array(
				'type'          => 'liquid_colorpicker',
				'param_name'    => 'hover_fill_color',
				'heading'       => esc_html__( 'Hover Fill Color', 'one-color' ),
				'dependency'    => array(
					'element'   => 'hover_fill',
					'not_empty' => true,
				),
			),
			array(
				'type'          => 'liquid_colorpicker',
				'only_solid'    => true,
				'param_name'    => 'hover_text_color',
				'heading'       => esc_html__( 'Hover Text Color', 'one-color' ),
				'dependency'    => array(
					'element'   => 'hover_fill',
					'not_empty' => true,
				),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'scale_bg',
				'heading'     => esc_html__( 'Enable Scale bg?', 'landinghub-core' ),
				'description' => esc_html__( 'Enable scale background on hover state of the icon box', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Yes', 'landinghub-core' ) => 'iconbox-scale-bg'
				),
				'dependency'    => array(
					'element'   => 'hover_fill',
					'not_empty' => true,
				),
			),
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_label',
				'heading'    => esc_html__( 'Shadows', 'landinghub-core' ),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'shadow',
				'heading'    => esc_html__( 'Pre-Made Shadows', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'None', 'landinghub-core' )              => '',
					esc_html__( 'Box Shadow', 'landinghub-core' )        => 'iconbox-shadow',
					esc_html__( 'Hover Box Shadow', 'landinghub-core' )  => 'iconbox-shadow-hover',
					esc_html__( 'Icon Shadow', 'landinghub-core' )       => 'iconbox-icon-shadow',
					esc_html__( 'Hover Icon Shadow', 'landinghub-core' ) => 'iconbox-icon-hover-shadow',
				),
			),
			//Icon Box Shadow Options
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Icon Custom Shadow', 'landinghub-core' ),
				'param_name'  => 'enable_shape_shadowbox',
				'description' => esc_html__( 'If checked, the box-shadow options will be visible', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'dependency'    => array(
					'element' => 'i_shape',
					'value'   => array( 'square', 'circle' ),
				),
			),
			array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Icon Shape Shadow Box Options', 'landinghub-core' ),
				'param_name' => 'shape_box_shadow',
				'dependency' => array(
					'element' => 'enable_shape_shadowbox',
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
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'x_offset',
						'heading'     => esc_html__( 'Position X', 'landinghub-core' ),
						'description' => esc_html__(  'Set position X in px', 'landinghub-core' ),
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'y_offset',
						'heading'     => esc_html__( 'Position Y', 'landinghub-core' ),
						'description' => esc_html__(  'Set position Y in px', 'landinghub-core' ),
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'blur_radius',
						'heading'     => esc_html__( 'Blur Radius', 'landinghub-core' ),
						'description' => esc_html__(  'Add blur radius in px', 'landinghub-core' ),
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'spread_radius',
						'heading'     => esc_html__( 'Spread Radius', 'landinghub-core' ),
						'description' => esc_html__(  'Add spread radius in px', 'landinghub-core' ),
					),
					array(
						'type'        => 'colorpicker',
						'param_name'  => 'shadow_color',
						'heading'     => esc_html__( 'Color', 'landinghub-core' ),
						'description' => esc_html__(  'Pick a color for shadow', 'landinghub-core' ),
					),

				)
			),
			
		);
		foreach( $design_params as &$param ) {
			$param['group'] = esc_html__( 'Design Options', 'landinghub-core' );
		}

		$this->params = array_merge( $icon, $svg_params, $params, $styling_params, $design_params, $button );

		$this->add_extras();
	
	}
	
	protected function get_shape() {
		
		$shape = $this->atts['i_shape'];
		if( empty( $shape ) ) {
			return;
		}

		return 'iconbox-' . $shape;

	}
	
	protected function get_svg_attributes() {
		
		$attributes = $svg = array();
		$color  = $color2 = $hcolor = $hcolor2 = '';
		
		$icon = liquid_get_icon( $this->atts );
		
		if( isset( $icon['type'] ) && 'image' === $icon['type'] ) {
			return;
		}

		if( isset( $icon['src'] ) ) {
			$filetype = wp_check_filetype( $icon['src'] );
			$svg['file'] = $icon['src'];
			$attributes['data-animated-svg'] = true;	
		}

		$attributes['data-animate-icon'] = true;	
		if ( !empty( $this->atts['animation_delay'] ) ) {
			$svg['delay'] = $this->atts['animation_delay'];
		}
		if( 'yes' === $this->atts['hover_animation'] ) {
			$svg['resetOnHover'] = true;
		}

		if( !empty( $this->atts['i_color'] ) ) {
			$color = $this->atts['i_color'];	
		}
		if( !empty( $this->atts['i_color2'] ) && !empty( $this->atts['i_color'] ) ) {
			$color2 = ':' . $this->atts['i_color2'];
		}
		if( !empty( $this->atts['i_color2'] ) || !empty( $this->atts['i_color'] ) ) {
			$svg['color'] = $color . $color2;	
		}

		if( !empty( $this->atts['h_i_color'] ) ) {
			$hcolor = $this->atts['h_i_color'];
		}
		if ( !empty( $this->atts['h_i_color2'] ) && !empty( $this->atts['h_i_color'] ) ) {
			 $hcolor2 = ':' . $this->atts['h_i_color2'];
		}
		if ( !empty( $this->atts['h_i_color2'] ) || !empty( $this->atts['h_i_color'] ) ) {
			$svg['hoverColor'] = $hcolor . $hcolor2;
		}

		if ( !empty( $svg ) ) {
			$attributes['data-plugin-options'] = wp_json_encode( $svg );
		}
		
		
		return $attributes;
		
	}
	
	protected function get_border_opts() {
		
		$border = $this->atts['i_border'];
		if( empty( $border ) ) {
			return;
		}

		return 'data-shape-border="' . $border . '"';		
	}
	
	protected function get_fill() {
		
		$enable = $this->atts['fill'];
		if( empty( $enable ) ) {
			return;
		}
		
		return 'iconbox-filled';
	}
	
	protected function get_ripple_classnames() {

		$enable = $this->atts['i_ripple_effect'];
		if( empty( $enable ) ) {
			return;
		}		

		return 'iconbox-icon-ripple';	
	}
	
	protected function get_hover_fill() {
		
		$enable = $this->atts['hover_fill'];
		if( empty( $enable ) ) {
			return;
		}

		return 'iconbox-filled iconbox-filled-hover';
		
	}
	
	protected function get_custom_bg_shape() {
		
		$out = '';
		
		$shape = $this->atts['i_shape'];
		$bg_id = $this->atts['i_shape_custom_bg'];
		if( 'custombg' !== $shape || empty( $bg_id ) ) {
			return'';
		}		
		
		$src = wp_get_attachment_url( $bg_id );
		$filetype = wp_check_filetype( $src );
		
		if( 'svg' === $filetype['ext'] ) {
			
			$request  = wp_remote_get( $src );
			$response = wp_remote_retrieve_body( $request );
			$svg_icon = $response;

			$out = $svg_icon;
			
		} 
		else {
			$out = sprintf( '<img src="%s" />', esc_url( $src ) );
		}

		echo '<span class="icon-custom-bg">';
		echo $out;
		echo '</span>';
	}
	
	protected function get_size() {

		$size = $this->atts['i_size'];
		if( empty( $size ) ) {
			return;
		}

		return 'iconbox-' . $size;

	}
	
	protected function get_the_icon() {

		$attributes = array(
			'class' => 'iconbox-icon-container'
		);
		
		echo  '<div class="iconbox-icon-wrap">';
		printf('<span%s>', ld_helper()->html_attributes( $attributes ) );

		if( !empty( $this->atts['shape_hcolor'] ) ) {
			echo '<span class="iconbox-icon-hover-bg"></span>';
		}
		
		$this->get_custom_bg_shape();
		$icon = liquid_get_icon( $this->atts );
		
		if( ! empty( $icon['type'] ) ) {			
			if( 'image' === $icon['type'] || 'animated' === $icon['type'] ) {
				$filetype = wp_check_filetype( $icon['src'] );
				if( 'svg' === $filetype['ext'] ) {
					$request  = wp_remote_get( $icon['src'] );
					$response = wp_remote_retrieve_body( $request );
					$svg_icon = $response;
					if( 'animated' !== $icon['type'] ) {
						echo $svg_icon;	
					}
				} 
				else {
					printf( '<img src="%s" class="liquid-image-icon" />', esc_url( $icon['src'] ) );
				}
			}
			else {
				printf( '<i class="%s"></i>', $icon['icon'] );
			}
		}

		echo '</span>';
		echo  '</div>';
	}
	
	
	protected function get_animated_icon_classname() {

		$icon = liquid_get_icon( $this->atts );
		$classname = '';
		
		if( ! empty( $icon['type'] ) ) {			
			if( 'animated' === $icon['type'] ) {
				$classnames = 'lqd-animated-icon';
			}
		}

		return $classname;

	}

	protected function get_title() {

		// check
		if( empty( $this->atts['title'] ) ) {
			return;
		}

		$title  = wp_kses_post( do_shortcode( $this->atts['title'] ) );
		$weight = $this->atts['heading_weight'];
		$underlined = $this->atts['heading_underline'];
		$classnames = 'lqd-iconbox-title ';
		$tag = $this->atts['tag'];

		if( $this->atts['use_inheritance'] ){
			$classnames .= $this->atts['tag_to_inherite'];
		}

		if ( ! empty ( $weight ) ) {
			$classnames	.= $weight;
		}
		if ( 'yes' === $underlined ) {
			$classnames	= $classnames . " text-underline";
		}

		$class = 'class="' . $classnames . '"';

		printf( '<%1$s %2$s>%3$s</%1$s>', $tag, $class, $title );
	}
	
	protected function get_label() {

		// check
		if( empty( $this->atts['label'] ) ) {
			return;
		}		
		
		$label = $this->atts['label'];
		
		printf( '<span class="iconbox-label">%s</span>', $this->atts['label'] );
	}
	
	protected function get_toggleable() {

		$toggleable = $this->atts['toggleable'];
		if( 'yes' !== $toggleable ) {
			return;
		}

		return "iconbox-contents-show-onhover";

	}
	
	protected function get_toggleable_opts() {

		$toggleable = $this->atts['toggleable'];
		$tag = $this->atts['tag'];
		if( 'yes' !== $toggleable ) {
			return;
		}

		return 'data-slideelement-onhover="true" data-slideelement-options=\'{ "visibleElement": ".iconbox-icon-wrap, p, ' . $tag . '", "hiddenElement": ".btn", "alignMid": true }\'';

	}
	
	protected function get_heading_size() {

		$size = $this->atts['heading_size'];
		if( empty( $size ) || 'custom' === $size ) {
			return;
		}

		return "iconbox-heading-$size";

	}
	
	protected function get_heading_icon_onhover_classnames() {

		if( 'no' === $this->atts['heading_icon_onhover'] ) {
			return;
		}		

		return 'iconbox-heading-arrow-onhover';
	}
	
	protected function get_content() {

		// check
		if( empty( $this->atts['content'] ) ) {
			return;
		}

		echo wp_kses_post( ld_helper()->do_the_content( $this->atts['content'] ) );
	}
	
	protected function before_icon_box_content() {

		// check
		if( empty( $this->atts['content'] ) ) {
			return;
		}

		return '<div class="contents">';
	}

	protected function after_icon_box_content() {

		// check
		if( empty( $this->atts['content'] ) ) {
			return;
		}

		return '</div>';

	}
	
	protected function get_overlay_link() {
		
		$link = liquid_get_link_attributes( $this->atts['link'], false );
		
		if( empty( $link['href']) ) {
			return;
		}
		$link['class'] = 'liquid-overlay-link z-index-2';
		if( !empty($this->atts['localscroll_link']) ) {
			$link['data-localscroll'] = 'true';	
		}

		echo '<a'. ld_helper()->html_attributes( $link ) .'></a>';
		
	}
	
	protected function get_button() {

		if ( empty( $this->atts['show_button'] ) ) {
			return;
		}

		$data = vc_map_integrate_parse_atts( $this->slug, 'ld_button', $this->atts, 'ib_' );
		if ( $data ) {

			$btn = visual_composer()->getShortCode( 'ld_button' )->shortcodeClass();

			if ( is_object( $btn ) ) {
				echo $btn->render( array_filter( $data ) );
			}
		}
	}

	/**
	 * [generate_css description]
	 * @method generate_css
	 */
	protected function generate_css() {

		extract( $this->atts );

		$bg = $elements = array();
		$id = '.' . $this->get_id();
		
		//Icon color
		if( ! empty( $i_color ) && isset( $i_color ) ) {
			$elements[ liquid_implode( '%1$s .iconbox-icon-container' ) ]['color'] = $i_color;
		}
		if( !empty( $h_i_color ) ) {
			$elements[liquid_implode( '%1$s:hover .iconbox-icon-container' )]['color'] = $h_i_color;
		}
		if ( !empty( $i_color2 ) ) {
			$elements[liquid_implode( '%1$s .iconbox-icon-container i' )] = array(
				'background'              => 'linear-gradient(to bottom right, ' . $i_color . ' 20%, ' . $i_color2 . ' 80%)',
				'background-clip'         => 'text !important',
				'-webkit-background-clip' => 'text !important',
				'text-fill-color'         => 'transparent !important',
				'-webkit-text-fill-color' => 'transparent !important',
				'line-height' => '1.15em !important'
			);
			if( !empty( $h_i_color ) ) {

				$h_i_color2 = ! empty( $h_i_color2 ) ? $h_i_color2 : $h_i_color;
				$elements[liquid_implode( '%1$s:hover .iconbox-icon-container i' )] = array(
					'background'              => 'linear-gradient(to bottom right, ' . $h_i_color . ' 20%, ' . $h_i_color2 . ' 80%)',
					'background-clip'         => 'text !important',
					'-webkit-background-clip' => 'text !important',
					'text-fill-color'         => 'transparent !important',
					'-webkit-text-fill-color' => 'transparent !important',
					'line-height' => '1.15em !important'
				);
			}
		}
		if( ! empty( $icon_size ) ) {
			$elements[ liquid_implode( '%1$s .iconbox-icon-container' ) ]['font-size'] = $icon_size;
		}
		if( !empty( $icon_mb ) && '0' !== $icon_mb ) {
			if( 'iconbox-inline' === $position ) {
				if( 'text-right' === $alignment ) {
					$elements[ liquid_implode( '%1$s .iconbox-icon-container' ) ]['margin-inline-start'] = $icon_mb . 'px !important';	
				}
				else {
					$elements[ liquid_implode( '%1$s .iconbox-icon-container' ) ]['margin-inline-end'] = $icon_mb . 'px !important';
				}
			}
			if ( 'iconbox-side' === $position ) {
				if( 'text-right' === $alignment ) {
					$elements[ liquid_implode( '%1$s .iconbox-icon-wrap' ) ]['margin-inline-start'] = $icon_mb . 'px !important';	
				}
				else {
					$elements[ liquid_implode( '%1$s .iconbox-icon-wrap' ) ]['margin-inline-end'] = $icon_mb . 'px !important';
				}
			}
			else if ( 'iconbox-inline' !== $position && 'iconbox-side' !== $position ) {
				$elements[ liquid_implode( '%1$s .iconbox-icon-container' ) ]['margin-bottom'] = $icon_mb . 'px !important';
			}
			if( 'iconbox-inline' === $position || 'iconbox-side' === $position ) {
				$elements[ liquid_implode( '%1$s .iconbox-icon-container, %1$s .iconbox-icon-wrap' ) ]['margin-bottom'] = '0';	
			}
		}
		if( ! empty( $custom_i_size ) ) {
			$elements[ liquid_implode( '%1$s .iconbox-icon-container' ) ]['width'] = $custom_i_size . ' !important';
			$elements[ liquid_implode( '%1$s .iconbox-icon-container' ) ]['height'] = $custom_i_size . ' !important';
		}
		
		if( !empty( $shape_color ) && isset( $shape_color ) ) {
			$elements[ liquid_implode( '%1$s .iconbox-icon-container' ) ]['background'] = $shape_color;
			$elements[ liquid_implode( '%1$s .iconbox-icon-container:before' ) ]['border-color'] = $shape_color;
		}
		if( !empty( $shape_hcolor ) && isset( $shape_hcolor ) ) {
			$elements[ liquid_implode( '%1$s .iconbox-icon-container .iconbox-icon-hover-bg' ) ]['background'] = $shape_hcolor;
			$elements[ liquid_implode( '%1$s:hover .iconbox-icon-container:before' ) ]['border-color'] = $shape_hcolor;
		}
		if( !empty( $svg_stroke_color ) && isset( $svg_stroke_color ) ) {
			$elements[ liquid_implode( '%1$s .iconbox-icon-container > svg path:not([stroke=none])' ) ]['stroke'] = $svg_stroke_color;
			$elements[ liquid_implode( '%1$s .iconbox-icon-container > svg rect:not([stroke=none])' ) ]['stroke'] = $svg_stroke_color;
			$elements[ liquid_implode( '%1$s .iconbox-icon-container > svg ellipse:not([stroke=none])' ) ]['stroke'] = $svg_stroke_color;
			$elements[ liquid_implode( '%1$s .iconbox-icon-container > svg circle:not([stroke=none])' ) ]['stroke'] = $svg_stroke_color;
			$elements[ liquid_implode( '%1$s .iconbox-icon-container > svg polygon:not([stroke=none])' ) ]['stroke'] = $svg_stroke_color;
			$elements[ liquid_implode( '%1$s .iconbox-icon-container > svg polyline:not([stroke=none])' ) ]['stroke'] = $svg_stroke_color;
		}
		if( !empty( $svg_fill_color ) && isset( $svg_fill_color ) ) {
			$elements[ liquid_implode( '%1$s .iconbox-icon-container > svg path:not([fill=none])' ) ]['fill'] = $svg_fill_color;
			$elements[ liquid_implode( '%1$s .iconbox-icon-container > svg rect:not([fill=none])' ) ]['fill'] = $svg_fill_color;
			$elements[ liquid_implode( '%1$s .iconbox-icon-container > svg ellipse:not([fill=none])' ) ]['fill'] = $svg_fill_color;
			$elements[ liquid_implode( '%1$s .iconbox-icon-container > svg circle:not([fill=none])' ) ]['fill'] = $svg_fill_color;
			$elements[ liquid_implode( '%1$s .iconbox-icon-container > svg polygon:not([fill=none])' ) ]['fill'] = $svg_fill_color;
			$elements[ liquid_implode( '%1$s .iconbox-icon-container > svg polyline:not([fill=none])' ) ]['fill'] = $svg_fill_color;
		}
		if( !empty( $h_svg_stroke_color ) && isset( $h_svg_stroke_color ) ) {
			$elements[ liquid_implode( '%1$s:hover .iconbox-icon-container > svg path:not([stroke=none])' ) ]['stroke'] = $h_svg_stroke_color;
			$elements[ liquid_implode( '%1$s:hover .iconbox-icon-container > svg rect:not([stroke=none])' ) ]['stroke'] = $h_svg_stroke_color;
			$elements[ liquid_implode( '%1$s:hover .iconbox-icon-container > svg ellipse:not([stroke=none])' ) ]['stroke'] = $h_svg_stroke_color;
			$elements[ liquid_implode( '%1$s:hover .iconbox-icon-container > svg circle:not([stroke=none])' ) ]['stroke'] = $h_svg_stroke_color;
			$elements[ liquid_implode( '%1$s:hover .iconbox-icon-container > svg polygon:not([stroke=none])' ) ]['stroke'] = $h_svg_stroke_color;
			$elements[ liquid_implode( '%1$s:hover .iconbox-icon-container > svg polyline:not([stroke=none])' ) ]['stroke'] = $h_svg_stroke_color;
		}
		if( !empty( $h_svg_fill_color ) && isset( $h_svg_fill_color ) ) {
			$elements[ liquid_implode( '%1$s:hover .iconbox-icon-container > svg path:not([fill=none])' ) ]['fill'] = $h_svg_fill_color;
			$elements[ liquid_implode( '%1$s:hover .iconbox-icon-container > svg rect:not([fill=none])' ) ]['fill'] = $h_svg_fill_color;
			$elements[ liquid_implode( '%1$s:hover .iconbox-icon-container > svg ellipse:not([fill=none])' ) ]['fill'] = $h_svg_fill_color;
			$elements[ liquid_implode( '%1$s:hover .iconbox-icon-container > svg circle:not([fill=none])' ) ]['fill'] = $h_svg_fill_color;
			$elements[ liquid_implode( '%1$s:hover .iconbox-icon-container > svg polygon:not([fill=none])' ) ]['fill'] = $h_svg_fill_color;
			$elements[ liquid_implode( '%1$s:hover .iconbox-icon-container > svg polyline:not([fill=none])' ) ]['fill'] = $h_svg_fill_color;
		}
		
		//Heading color
		if( !empty( $h_color ) && isset( $h_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-iconbox-title' ) ]['color'] = $h_color;
		}
		if( isset( $title_mb ) && '0' !== $title_mb ) {
			$elements[ liquid_implode( '%1$s .lqd-iconbox-title' ) ]['margin-bottom'] = $title_mb . 'px';
		}
		if( !empty( $custom_heading_size ) ) {
			$elements[ liquid_implode( '%1$s .lqd-iconbox-title' ) ]['font-size'] = $custom_heading_size;
		}
		
		if( !empty( $h_color ) && !empty( $h_color2 ) ) {
			$elements[ liquid_implode( '%1$s-heading-gradient .lqd-iconbox-title' ) ]['background'] = 'linear-gradient(to right, ' . $h_color . ' 0%, ' . $h_color2 . ' 100%)';
		}
		if( !empty( $h_hcolor ) && 'iconbox-heading-gradient' === $heading_gradient ) {
			$elements[ liquid_implode( '%1$s-heading-gradient:hover .lqd-iconbox-title' ) ]['background'] = $h_hcolor;
		}
		elseif( !empty( $h_hcolor ) ) {
			$elements[ liquid_implode( '%1$s:hover .lqd-iconbox-title' ) ]['color'] = $h_hcolor;
		}
		
		//Background colors
		if( !empty( $fill_color ) && isset( $fill_color ) ) {
			$elements[ liquid_implode( '%1$s' ) ]['background'] = $fill_color;
		}
		if( !empty( $hover_fill_color ) && isset( $hover_fill_color ) ) {
			$elements[ liquid_implode( '%1$s:before' ) ]['background'] = $hover_fill_color;
		}
		if( !empty( $hover_bg_image ) ) {
			if( preg_match( '/^\d+$/', $hover_bg_image ) ){
				$src = liquid_get_image_src( $hover_bg_image );
				$elements[ liquid_implode( '%1$s:before' ) ]['background-image'] = 'url(' . esc_url( $src[0] ) . ')';
			} else {
				$src = $hover_bg_image;
				$elements[ liquid_implode( '%1$s:before' ) ]['background-image'] = 'url(' . esc_url( $src ) . ')';
			}
		}

		if( !empty( $custom_i_top_offset ) ) {
			$elements[ liquid_implode( '%1$s .iconbox-icon-container .icon-custom-bg > *' ) ]['margin-top'] = $custom_i_top_offset;
		}
		if( !empty( $custom_i_left_offset ) ) {
			$elements[ liquid_implode( '%1$s .iconbox-icon-container .icon-custom-bg > *' ) ]['margin-inline-start'] = $custom_i_left_offset;
		}
		if( !empty( $custom_i_width ) ) {
			$elements[ liquid_implode( '%1$s .iconbox-icon-container .icon-custom-bg > *' ) ]['width'] = $custom_i_width;
		}
		if( !empty( $custom_i_height ) ) {
			$elements[ liquid_implode( '%1$s .iconbox-icon-container .icon-custom-bg > *' ) ]['height'] = $custom_i_height;
		}
		

		if( !empty( $hover_text_color ) ) {
			$elements[ liquid_implode( '%1$s:hover, %1$s:hover p' ) ]['color'] = $hover_text_color;
		}
		if( !empty( $border_shape_color ) ) {
			$elements[ liquid_implode( '%1$s .iconbox-icon-container' ) ]['border-color'] = $border_shape_color;
		}
		if( !empty( $border_shape_hcolor ) ) {
			$elements[ liquid_implode( '%1$s:hover .iconbox-icon-container' ) ]['border-color'] = $border_shape_hcolor;
		}
		if( '0' !== $i_shape_border_radius ) {
			$elements[ liquid_implode( '%1$s .iconbox-icon-container' ) ]['border-radius'] = $i_shape_border_radius . 'px';
		}
		
		if( !empty( $custom_size ) ) {
			$elements[ liquid_implode( '%1$s .iconbox-icon-container img,%1$s .iconbox-icon-container > svg' ) ]['width'] = $custom_size . ' !important';
		}
		
		$shape_box_shadow = vc_param_group_parse_atts( $shape_box_shadow );
		
		//Shadow box for button
		if( ! empty( $shape_box_shadow ) ) {
			$shape_box_shadow_css = $this->get_shadow_css( $shape_box_shadow );
			$elements[liquid_implode( '%1$s .iconbox-icon-container' )]['box-shadow'] = $shape_box_shadow_css;
		}

		$this->dynamic_css_parser( $id, $elements );
	}

}
new LD_Icon_Box;