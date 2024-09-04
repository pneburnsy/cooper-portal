<?php
/**
* Shortcode Liquid Carousel
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Carousel extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug         = 'ld_carousel';
		$this->title        = esc_html__( 'Carousel', 'landinghub-core' );
		$this->icon         = 'la la-arrows';
		$this->scripts      = array( 'flickity', 'flickity-fade' );
		$this->show_settings_on_create        = true;
		$this->description  = esc_html__( 'Create a carousel.', 'landinghub-core' );
		$this->is_container = true;

		parent::__construct();
	}

	public function get_params() {
		
		$options = array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Active Slide', 'landinghub-core' ),
				'description' => esc_html__( 'Select a custom initial active slide.', 'landinghub-core' ),
				'param_name'  => 'initialindex',
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Cell Align', 'landinghub-core' ),
				'description' => esc_html__( 'Cells alignment.', 'landinghub-core' ),
				'param_name'  => 'cellalign',
				'value'       => array(
					esc_Html__( 'Left', 'landinghub-core' )   => 'left',
					esc_html__( 'Center', 'landinghub-core' ) => 'center',
					esc_html__( 'Right', 'landinghub-core' )  => 'right',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Navigation Arrows', 'landinghub-core' ),
				'description' => esc_html__( 'Enable/Disable navigation arrows..', 'landinghub-core' ),
				'param_name'  => 'prevnextbuttons',
				'value'       => array(
					esc_html__( 'Disable', 'landinghub-core' )  => 'no',
					esc_html__( 'Enable', 'landinghub-core' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Pagination Dots', 'landinghub-core' ),
				'description' => esc_html__( 'Enable/Disable pagination dots.', 'landinghub-core' ),
				'param_name'  => 'pagenationdots',
				'value'       => array(
					esc_html__( 'Disable', 'landinghub-core' )  => 'no',
					esc_html__( 'Enable', 'landinghub-core' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Stretch Carousel', 'landinghub-core' ),
				'description' => esc_html__( 'Stretch the carousel to the right side of the viewport.', 'landinghub-core' ),
				'param_name'  => 'fullwidthside',
				'value'       => array(
					esc_html__( 'Disable', 'landinghub-core' )  => '',
					esc_html__( 'Enable', 'landinghub-core' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Fade Sides Carousel', 'landinghub-core' ),
				'description' => esc_html__( 'Fade the carousel right and left sides of the viewport.', 'landinghub-core' ),
				'param_name'  => 'fadesides',
				'value'       => array(
					esc_html__( 'Disable', 'landinghub-core' )  => '',
					esc_html__( 'Enable', 'landinghub-core' ) => 'lqd-fade-sides'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Group Cells', 'landinghub-core' ),
				'description' => esc_html__( 'Enable this option if you want the navigation being mapped to grouped cells, not individual cells.', 'landinghub-core' ),
				'param_name'  => 'groupcells',
				'value'       => array(
					esc_html__( 'Enable', 'landinghub-core' ) => 'yes',
					esc_html__( 'Disable', 'landinghub-core' )  => 'no'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Carousel Loop', 'landinghub-core' ),
				'description' => esc_html__( 'Loop for infinite scrolling.', 'landinghub-core' ),
				'param_name'  => 'wraparound',
				'value'       => array(
					esc_html__( 'Disable', 'landinghub-core' )  => '',
					esc_html__( 'Enable', 'landinghub-core' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Adaptive Height', 'landinghub-core' ),
				'description' => esc_html__( 'Height of the carousel will change based on active slide.', 'landinghub-core' ),
				'param_name'  => 'adaptiveheight',
				'value'       => array(
					esc_html__( 'Disable', 'landinghub-core' )  => '',
					esc_html__( 'Enable', 'landinghub-core' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Equal Height Cells', 'landinghub-core' ),
				'description' => esc_html__( 'Height of all carousel cells will be the same.', 'landinghub-core' ),
				'param_name'  => 'equalheightcells',
				'value'       => array(
					esc_html__( 'Disable', 'landinghub-core' )  => '',
					esc_html__( 'Enable', 'landinghub-core' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Fade Effect', 'landinghub-core' ),
				'param_name'  => 'fadeeffect',
				'value'       => array(
					esc_html__( 'Disable', 'landinghub-core' )  => '',
					esc_html__( 'Enable', 'landinghub-core' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Draggable', 'landinghub-core' ),
				'description' => esc_html__( 'Enable/Disable draggableity of the carousel. This option does not work in frontend editor.', 'landinghub-core' ),
				'param_name'  => 'draggable',
				'value'       => array(
					esc_html__( 'Enable', 'landinghub-core' ) => '',
					esc_html__( 'Disable', 'landinghub-core' )  => 'no'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Custom Cursor On Hover', 'landinghub-core' ),
				'description' => esc_html__( 'Enable/Disable custom cursor on hover. Only working when custom cursor is enabled from theme options', 'landinghub-core' ),
				'param_name'  => 'custom_cursor',
				'value'       => array(
					esc_html__( 'Enable', 'landinghub-core' ) => '',
					esc_html__( 'Disable', 'landinghub-core' )  => 'disable-cc'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Free Scroll', 'landinghub-core' ),
				'description' => esc_html__( 'Enables carousel to be freely scrolled without aligning cells to an end position.', 'landinghub-core' ),
				'param_name'  => 'freescroll',
				'value'       => array(
					esc_html__( 'Disable', 'landinghub-core' )  => '',
					esc_html__( 'Enable', 'landinghub-core' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Autoplay', 'landinghub-core' ),
				'description' => esc_html__( 'Enable/Disable carousel autoplay.', 'landinghub-core' ),
				'param_name'  => 'autoplay',
				'value'       => array(
					esc_html__( 'Dsiable', 'landinghub-core' )  => '',
					esc_html__( 'Enable', 'landinghub-core' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Autoplay Delay', 'landinghub-core' ),
				'description' => esc_html__( 'Autolay delay in milliseconds.', 'landinghub-core' ),
				'param_name'  => 'autoplaytime',
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'autoplay',
					'value'   => array( 'yes' )
				)
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Pause AutoPlay On Hover', 'landinghub-core' ),
				'description' => esc_html__( 'Pause the autoplay each time user hovers over the carousel.', 'landinghub-core' ),
				'param_name'  => 'pauseautoplayonhover',
				'value'       => array(
					esc_html__( 'Disable', 'landinghub-core' )  => 'no',
					esc_html__( 'Enable', 'landinghub-core' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'autoplay',
					'value'   => array( 'yes' )
				)
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Random Vertical Position', 'landinghub-core' ),
				'description' => esc_html__( 'Randomly position carousel cells.', 'landinghub-core' ),
				'param_name'  => 'randomveroffset',
				'value'       => array(
					esc_html__( 'Disable', 'landinghub-core' )  => '',
					esc_html__( 'Enable', 'landinghub-core' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'textarea',
				'heading'     => esc_html__( 'Controlling Carousels', 'landinghub-core' ),
				'description' => esc_html__( 'Add IDs or classnames of the other carousels on this page for ex. #carousel-1, carousel-2 or .carousel-1, .carousel-2 (Note: divide by comma)', 'landinghub-core' ),
				'param_name'  => 'controllingcarousels',
				'edit_field_class' => 'vc_col-sm-6'
			),

		);
		foreach( $options as &$param ) {
			$param['group'] = esc_html__( 'Carousel Options', 'landinghub-core' );
		}
		
		$nav = array(
			array(
				'type'        => 'subheading',
				'heading'     => esc_html__( 'Navigation', 'landinghub-core' ),
				'param_name'  => 'sh_nav',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'prevnextbuttons',
					'value'   => 'yes'
				),
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'navarrow',
				'heading' => esc_html__( 'Style', 'landinghub-core' ),
				'description' => esc_html__( 'Select a navigation arrow style', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'None', 'landinghub-core' )    => '',
					esc_html__( 'Default', 'landinghub-core' ) => '1',
					esc_html__( 'Style 2', 'landinghub-core' ) => '2',
					esc_html__( 'Style 3', 'landinghub-core' ) => '3',
					esc_html__( 'Style 4', 'landinghub-core' ) => '4',
					esc_html__( 'Style 5', 'landinghub-core' ) => '5',
					esc_html__( 'Style 6', 'landinghub-core' ) => '6',
					esc_html__( 'Custom', 'landinghub-core' )  => 'custom'
				),
				'dependency'  => array(
					'element' => 'prevnextbuttons',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Append Navigation Arrows To', 'landinghub-core' ),
				'description' => esc_html__( 'Append the navigation to other elements in the page.', 'landinghub-core' ),
				'param_name'  => 'navappend',
				'value'       => array(
					esc_html__( 'Carousel itself', 'landinghub-core' )  => 'self',
					esc_html__( 'Parent Row', 'landinghub-core' ) => 'parent_row',
					esc_html__( 'Other Elements', 'landinghub-core' ) => 'custom_id',
				),
				'dependency'  => array(
					'element' => 'prevnextbuttons',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
			),
			array(
				'type' => 'textfield',
				'param_name' => 'navappend_id',
				'heading' => esc_html__( 'ID to Append navigation arrows', 'landinghub-core' ),
				'description' => esc_html__( 'Input the id of element to append the navigaion, for ex. #heading-id', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'navappend',
					'value'   => 'custom_id'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
			),
			array(
				'type' => 'textarea_safe',
				'param_name' => 'prev',
				'heading' => esc_html__( 'Previous Button', 'landinghub-core' ),
				'description' => esc_html__( 'Add here markup for previous button for ex <i class=\"fa fa-angle-left\"></i>', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'navarrow',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
			),
			array(
				'type' => 'textarea_safe',
				'param_name' => 'next',
				'heading' => esc_html__( 'Next Button', 'landinghub-core' ),
				'description' => esc_html__( 'Add here markup for next button for ex <i class=\"fa fa-angle-right\"></i>', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'navarrow',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
			),
			
			
			array(
				'type'        => 'dropdown',
				'param_name'  => 'navsize',
				'heading'     => esc_html__( 'Navigation Arrow Size', 'landinghub-core' ),
				'description' => esc_html__( 'Select navigation size.', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Default', 'landinghub-core' )     => 'carousel-nav-md',
					esc_html__( 'Small', 'landinghub-core' )       => 'carousel-nav-sm',
					esc_html__( 'Large', 'landinghub-core' )       => 'carousel-nav-lg',
					esc_html__( 'Extra Large', 'landinghub-core' ) => 'carousel-nav-xl',
				),
				'dependency'  => array(
					'element' => 'prevnextbuttons',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'navfill',
				'heading'     => esc_html__( 'Fill Color', 'landinghub-core' ),
				'description' => esc_html__( 'Select navigation fill color.', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'None', 'landinghub-core' )  => '',
					esc_html__( 'Bordered', 'landinghub-core' ) => 'carousel-nav-bordered',
					esc_html__( 'Solid', 'landinghub-core' )    => 'carousel-nav-solid',
				),
				'dependency'  => array(
					'element' => 'prevnextbuttons',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'navshape',
				'heading'     => esc_html__( 'Shape Style', 'landinghub-core' ),
				'description' => esc_html__( 'Select navigation shape style.', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'None', 'landinghub-core' )      => '',
					esc_html__( 'Rectangle', 'landinghub-core' ) => 'carousel-nav-rectangle',
					esc_html__( 'Square', 'landinghub-core' )    => 'carousel-nav-square',
					esc_html__( 'Circle', 'landinghub-core' )    => 'carousel-nav-circle',
				),
				'dependency'  => array(
					'element' => 'prevnextbuttons',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'navshadow',
				'heading'     => esc_html__( 'Shadow Styles', 'landinghub-core' ),
				'description' => esc_html__( 'Select shadow style of carousel cells.', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'None', 'landinghub-core' )            => '',
					esc_html__( 'Shadow', 'landinghub-core' )          => 'carousel-nav-shadowed',
					esc_html__( 'Shadow on hover', 'landinghub-core' ) => 'carousel-nav-shadowed-onhover',
				),
				'dependency'  => array(
					'element' => 'prevnextbuttons',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'navhalign',
				'heading' => esc_html__( 'Navigation Arrows Alignment', 'landinghub-core' ),
				'description' => esc_html__( 'Select alignment for the navigation/', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Left', 'landinghub-core' ) => 'carousel-nav-left',
					esc_html__( 'Center', 'landinghub-core' ) => 'carousel-nav-center',
					esc_html__( 'Right', 'landinghub-core' ) => 'carousel-nav-right',
				),
				'dependency'  => array(
					'element' => 'prevnextbuttons',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'navfloated',
				'heading' => esc_html__( 'Floated Navigation Arrows', 'landinghub-core' ),
				'description' => esc_html__( 'Select navigation arrows to be floted on top of carousel cells or not.', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Disable', 'landinghub-core' ) => '',
					esc_html__( 'Enable', 'landinghub-core' ) => 'carousel-nav-floated',
				),
				'dependency'  => array(
					'element' => 'prevnextbuttons',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'navvalign',
				'heading'     => esc_html__( 'Navigation Arrows Vertical Position', 'landinghub-core' ),
				'description' => esc_html__( 'Select vertical position for the navigation.', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Default', 'landinghub-core' )    => '',
					esc_html__( 'Top', 'landinghub-core' )    => 'carousel-nav-top',
					esc_html__( 'Middle', 'landinghub-core' ) => 'carousel-nav-middle',
					esc_html__( 'Bottom', 'landinghub-core' ) => 'carousel-nav-bottom',
				),
				'dependency'  => array(
					'element' => 'navfloated',
					'value'   => 'carousel-nav-floated'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'navdirection',
				'heading'     => esc_html__( 'Navigation Arrows Direction', 'landinghub-core' ),
				'description' => esc_html__( 'Select direction for the navigation.', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Default', 'landinghub-core' )    => '',
					esc_html__( 'Vertical', 'landinghub-core' ) => 'carousel-nav-vertical',
				),
				'dependency'  => array(
					'element' => 'prevnextbuttons',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'navslidernumberstoarrows',
				'heading'     => esc_html__( 'Numbers to Arrows', 'landinghub-core' ),
				'description' => esc_html__( 'Add numbers to slider arrows?', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'No', 'landinghub-core' )  => 'no',
					esc_html__( 'Yes', 'landinghub-core' ) => 'yes',
				),
				'dependency'  => array(
					'element' => 'prevnextbuttons',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'navline',
				'heading'     => esc_html__( 'Arrows Separator', 'landinghub-core' ),
				'description' => esc_html__( 'Enable/Disable the separator between previous and next navigation arrows.', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Disable', 'landinghub-core' )    => 'no',
					esc_html__( 'Enable', 'landinghub-core' ) => 'carousel-nav-dot-between',
				),
				'dependency'  => array(
					'element' => 'navslidernumberstoarrows',
					'value'   => 'no'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
			),
			array(
				'type'        => 'textarea',
				'param_name'  => 'navoffset',
				'heading'     => esc_html__( 'Navigation Arrows Offset', 'landinghub-core' ),
				'description' => esc_html__( 'Add here nav offset values, separated by comma, for ex. right:22%', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'prevnextbuttons',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'prevoffset',
				'heading'     => esc_html__( 'Previous Button Offset', 'landinghub-core' ),
				'description' => esc_html__( 'Add here previous button offset values for ex. 10px', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'prevnextbuttons',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'nextoffset',
				'heading'     => esc_html__( 'Next Button Offset', 'landinghub-core' ),
				'description' => esc_html__( 'Add here next button offset values, for ex. 22px', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'prevnextbuttons',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
			),
			
			array(
				'type'        => 'textfield',
				'param_name'  => 'shapesize',
				'heading'     => esc_html__( 'Navigation Arrow Shape Size', 'landinghub-core' ),
				'description' => esc_html__( 'Custom Shape Size, for ex. 22px', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'navshape',
					'value'   => array( 'carousel-nav-square', 'carousel-nav-circle' ),
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'shapeheight',
				'heading'     => esc_html__( 'Navigation Arrow Shape Height', 'landinghub-core' ),
				'description' => esc_html__( 'Custom shape height, for ex. 22px', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'navshape',
					'value'   => array( 'carousel-nav-rectangle' ),
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'shapewidth',
				'heading'     => esc_html__( 'Navigation Arrow Shape Width', 'landinghub-core' ),
				'description' => esc_html__( 'Custom shape width, for ex. 22px', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'navshape',
					'value'   => array( 'carousel-nav-rectangle' ),
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
			),
			
			array(
				'type'        => 'subheading',
				'heading'     => esc_html__( 'Styling', 'landinghub-core' ),
				'param_name'  => 'sh_styling_nav',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'prevnextbuttons',
					'value'   => 'yes'
				),
			),
			array(
				'type' => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'nav_arrow_color',
				'heading' => esc_html__( 'Arrow Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the nav arrows', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'prevnextbuttons',
					'value' => 'yes',	
				),
			),
			array(
				'type' => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'nav_arrow_color_hover',
				'heading' => esc_html__( 'Arrow Hover Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the nav arrows on hover', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'prevnextbuttons',
					'value' => 'yes',	
				),
			),
			array(
				'type' => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'nav_arrow_numbers',
				'heading' => esc_html__( 'Arrow Numbers Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the nav arrows nambers', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'navslidernumberstoarrows',
					'value'   => 'yes'
				),
			),
			array(
				'type' => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'nav_border_color',
				'heading' => esc_html__( 'Border Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the nav button borders', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'prevnextbuttons',
					'value' => 'yes',	
				),
			),
			array(
				'type' => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'nav_border_hcolor',
				'heading' => esc_html__( 'Border Hover Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a hover color for the nav button borders', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'prevnextbuttons',
					'value' => 'yes',	
				),
			),
			array(
				'type' => 'liquid_colorpicker',
				'param_name' => 'nav_bg_color',
				'heading' => esc_html__( 'Background', 'landinghub-core' ),
				'description' => esc_html__( 'Pick background for the nav buttons', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'prevnextbuttons',
					'value' => 'yes',	
				),
			),
			array(
				'type' => 'liquid_colorpicker',
				'param_name' => 'nav_bg_hcolor',
				'heading' => esc_html__( 'Background Hover', 'landinghub-core' ),
				'description' => esc_html__( 'Pick hover background for the nav buttons', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'prevnextbuttons',
					'value' => 'yes',	
				),
			),
			array(
				'type'        => 'subheading',
				'heading'     => esc_html__( 'Pagination Dots', 'landinghub-core' ),
				'param_name'  => 'sh_pagination_nav',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'pagenationdots',
					'value'   => 'yes'
				),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Pagination Type', 'landinghub-core' ),
				'description' => esc_html__( 'Select type for pagination dots', 'landinghub-core' ),
				'param_name'  => 'dots_type',
				'value'       => array(
					esc_html__( 'Dots', 'landinghub-core' )    => 'dots',
					esc_html__( 'Numbers', 'landinghub-core' ) => 'numbers',
				),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'pagenationdots',
					'value'   => 'yes'
				),
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Number Style', 'landinghub-core' ),
				'description' => esc_html__( 'Select style for pagination numbers', 'landinghub-core' ),
				'param_name'  => 'number_style',
				'value'       => array(
					esc_html__( 'Circle', 'landinghub-core' ) => 'circle',
					esc_html__( 'Line', 'landinghub-core' )   => 'line',
				),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'dots_type',
					'value'   => 'numbers'
				),
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Append Dots To', 'landinghub-core' ),
				'description' => esc_html__( 'Append the dots to other elements in the page.', 'landinghub-core' ),
				'param_name'  => 'dotsappend',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Carousel itself', 'landinghub-core' )  => 'self',
					esc_html__( 'Parent Row', 'landinghub-core' ) => 'parent_row',
					esc_html__( 'Other Elements', 'landinghub-core' ) => 'custom_id',
				),
				'dependency'  => array(
					'element' => 'pagenationdots',
					'value'   => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type' => 'textfield',
				'param_name' => 'dotsappend_id',
				'heading' => esc_html__( 'Element ID to Append dots', 'landinghub-core' ),
				'description' => esc_html__( 'Input the id of element to append pagination dots, for ex. #heading-id', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'dotsappend',
					'value'   => 'custom_id'
				),
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Pagination Dots Alignment', 'landinghub-core' ),
				'description' => esc_html__( 'Select alignment for pagination dots', 'landinghub-core' ),
				'param_name'  => 'align_dots',
				'value'       => array(
					esc_html__( 'Default', 'landinghub-core' ) => '',
					esc_html__( 'Left', 'landinghub-core' )    => 'carousel-dots-left',
					esc_html__( 'Right', 'landinghub-core' )   => 'carousel-dots-right'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'dots_type',
					'value'   => 'dots'
				)
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Pagination Dots Position', 'landinghub-core' ),
				'description' => esc_html__( 'Select position for page dots', 'landinghub-core' ),
				'param_name'  => 'dots_position',
				'value'       => array(
					esc_html__( 'Default', 'landinghub-core' ) => '',
					esc_html__( 'Inside', 'landinghub-core' )  => 'carousel-dots-inside',
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'dots_type',
					'value'   => 'dots'
				)
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Pagination Dots Orientation', 'landinghub-core' ),
				'description' => esc_html__( 'Select orientation for page dots', 'landinghub-core' ),
				'param_name'  => 'dots_orientation',
				'value'       => array(
					esc_html__( 'Default', 'landinghub-core' )  => '',
					esc_html__( 'Vertical', 'landinghub-core' ) => 'carousel-dots-vertical',
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'dots_type',
					'value'   => 'dots'
				)
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'dots_vertical_align',
				'heading'     => esc_html__( 'Dots Vertical Alignment', 'landinghub-core' ),
				'description' => esc_html__( 'Select vertical alignment for dots.', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Bottom', 'landinghub-core' )    => '',
					esc_html__( 'Middle', 'landinghub-core' ) => 'carousel-dots-middle',
					esc_html__( 'Top', 'landinghub-core' ) => 'carousel-dots-top',
				),
				'dependency'  => array(
					'element' => 'dots_orientation',
					'value'   => 'carousel-dots-vertical'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'dots_top_offset',
				'std'         => 'auto',
				'heading'     => esc_html__( 'Dots Top Offset', 'landinghub-core' ),
				'description' => esc_html__( 'Dots offset from top edge', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'dots_type',
					'value'   => 'dots'
				)
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'dots_right_offset',
				'std'         => 'auto',
				'heading'     => esc_html__( 'Dots Right Offset', 'landinghub-core' ),
				'description' => esc_html__( 'Dots offset from right edge', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'dots_type',
					'value'   => 'dots'
				)
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'dots_bottom_offset',
				'std'         => '-25px',
				'heading'     => esc_html__( 'Dots Bottom Offset', 'landinghub-core' ),
				'description' => esc_html__( 'Dots offset from bottom edge', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'dots_type',
					'value'   => 'dots'
				)
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'dots_left_offset',
				'std'         => 'auto',
				'heading'     => esc_html__( 'Dots Left Offset', 'landinghub-core' ),
				'description' => esc_html__( 'Dots offset from left edge', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'dots_type',
					'value'   => 'dots'
				)
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'dots_style',
				'heading'     => esc_html__( 'Pagination Dots Style', 'landinghub-core' ),
				'description' => esc_html__( 'Select pagination dots style', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Style 1', 'landinghub-core' ) => 'carousel-dots-style1',
					esc_html__( 'Style 2', 'landinghub-core' ) => 'carousel-dots-style2',
					esc_html__( 'Style 3', 'landinghub-core' ) => 'carousel-dots-style3',
				),
				'dependency'  => array(
					'element' => 'dots_type',
					'value'   => 'dots'
				),
				'edit_field_class' => 'vc_col-sm-12',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
			),

			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Pagination Dots Size', 'landinghub-core' ),
				'description' => esc_html__( 'Select size for page dots', 'landinghub-core' ),
				'param_name'  => 'size_dots',
				'value'       => array(
					esc_html__( 'Default', 'landinghub-core' )  => '',
					esc_html__( 'Small' )  => 'carousel-dots-sm',
					esc_html__( 'Medium' ) => 'carousel-dots-md',
					esc_html__( 'Large' )  => 'carousel-dots-lg',
					esc_html__( 'Custom' ) => 'carousel-dots-custom',
				),
				'edit_field_class' => 'vc_col-sm-12',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'dots_type',
					'value'   => 'dots'
				)
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'dotscustomsize',
				'heading'     => esc_html__( 'Dots Width', 'landinghub-core' ),
				'description' => esc_html__( 'Set width for dots px, ex. 25px', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'size_dots',
					'value'   => 'carousel-dots-custom'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'dotscustomsize_height',
				'heading'     => esc_html__( 'Dots Height', 'landinghub-core' ),
				'description' => esc_html__( 'Set height for dots px, ex. 25px', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'size_dots',
					'value'   => 'carousel-dots-custom'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'dots_bg_color',
				'heading'     => esc_html__( 'Dots Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick color for the page dots', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group'       => esc_html__( 'Nav', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'pagenationdots',
					'value'   => 'yes',	
				),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'dots_bg_hcolor',
				'heading'     => esc_html__( 'Dots Hover Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick hover color for the page dots', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group'       => esc_html__( 'Nav', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'pagenationdots',
					'value'   => 'yes',	
				),
			),

			// Mobile dots
			array(
				'type'        => 'subheading',
				'heading'     => esc_html__( 'Mobile Pagination Dots', 'landinghub-core' ),
				'param_name'  => 'mobile_sh_pagination_dots',
				'group' => esc_html__( 'Nav', 'landinghub-core' )
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Mobile Pagination Dots Position', 'landinghub-core' ),
				'description' => esc_html__( 'Select position for page dots on mobile', 'landinghub-core' ),
				'param_name'  => 'mobile_dots_position',
				'value'       => array(
					esc_html__( 'Outside', 'landinghub-core' ) => 'carousel-dots-mobile-outside',
					esc_html__( 'Inside', 'landinghub-core' )  => 'carousel-dots-mobile-inside',
				),
				'group' => esc_html__( 'Nav', 'landinghub-core' ),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Mobile Pagination Dots Alignment', 'landinghub-core' ),
				'description' => esc_html__( 'Select alignment for pagination dots on mobile.', 'landinghub-core' ),
				'param_name'  => 'mobile_align_dots',
				'value'       => array(
					esc_html__( 'Center', 'landinghub-core' ) => 'carousel-dots-mobile-center',
					esc_html__( 'Left', 'landinghub-core' )    => 'carousel-dots-mobile-left',
					esc_html__( 'Right', 'landinghub-core' )   => 'carousel-dots-mobile-right'
				),
				'group' => esc_html__( 'Nav', 'landinghub-core' )
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'mobile_dots_bg_color',
				'heading'     => esc_html__( 'Mobile Dots Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick color for the page dots on mobile', 'landinghub-core' ),
				'group'       => esc_html__( 'Nav', 'landinghub-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'mobile_dots_bg_hcolor',
				'heading'     => esc_html__( 'Mobile Dots Hover Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick hover color for the page dots on mobile', 'landinghub-core' ),
				'group'       => esc_html__( 'Nav', 'landinghub-core' ),
			),
		);
		
		$animation = array(
			
			//Custom Animation Options
			array(
				'type'        => 'textfield',
				'param_name'  => 'pf_duration',
				'heading'     => esc_html__( 'Duration', 'landinghub-core' ),
				'description' => esc_html__( 'Add duration of the animation in milliseconds', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'group' => esc_html__( 'Item Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type' => 'textfield',
				'param_name' => 'pf_delay',
				'heading' => esc_html__( 'Delay (Stagger)', 'landinghub-core' ),
				'description' => esc_html__( 'Add delay of the animation between of the animated elements in milliseconds', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Item Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type' => 'textfield',
				'param_name' => 'pf_start_delay',
				'heading' => esc_html__( 'Start Delay', 'landinghub-core' ),
				'description' => esc_html__( 'Add start delay of the animation in milliseconds', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Item Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'pf_easing',
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
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( 'Item Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'subheading',
				'param_name'  => 'pf_init_values',
				'heading'     => esc_html__( 'Animate From', 'landinghub-core' ),
				'group' => esc_html__( 'Item Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_init_translate_x',
				'heading'     => esc_html__( 'Translate X', 'landinghub-core' ),
				'description' => esc_html__( 'Select translate on X axe', 'landinghub-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group' => esc_html__( 'Item Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_init_translate_y',
				'heading'     => esc_html__( 'Translate Y', 'landinghub-core' ),
				'description' => esc_html__( 'Select translate on Y axe', 'landinghub-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group' => esc_html__( 'Item Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)		
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_init_translate_z',
				'heading'     => esc_html__( 'Translate Z', 'landinghub-core' ),
				'description' => esc_html__( 'Select translate on Z axe', 'landinghub-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group' => esc_html__( 'Item Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_init_scale_x',
				'heading'     => esc_html__( 'Scale X', 'landinghub-core' ),
				'description' => esc_html__( 'Select Scale X', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 10,
				'step'        => 0.05,
				'std'         => 1,
				'edit_field_class' => 'vc_col-sm-4',
				'group' => esc_html__( 'Item Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_init_scale_y',
				'heading'     => esc_html__( 'Scale Y', 'landinghub-core' ),
				'description' => esc_html__( 'Select Scale Y', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 10,
				'step'        => 0.05,
				'std'         => 1,
				'edit_field_class' => 'vc_col-sm-4',
				'group' => esc_html__( 'Item Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_init_rotate_x',
				'heading'     => esc_html__( 'Rotate X', 'landinghub-core' ),
				'description' => esc_html__( 'Select rotate degree on X axe', 'landinghub-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,	
				'group' => esc_html__( 'Item Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_init_rotate_y',
				'heading'     => esc_html__( 'Rotate Y', 'landinghub-core' ),
				'description' => esc_html__( 'Select rotate degree on Y axe', 'landinghub-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group' => esc_html__( 'Item Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_init_rotate_z',
				'heading'     => esc_html__( 'Rotate Z', 'landinghub-core' ),
				'description' => esc_html__( 'Select rotate degree on Z axe', 'landinghub-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group' => esc_html__( 'Item Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_init_opacity',
				'heading'     => esc_html__( 'Opacity', 'landinghub-core' ),
				'description' => esc_html__( 'Set opacity', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 1,
				'step'        => 0.1,
				'std'         => 1,
				'group' => esc_html__( 'Item Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			//Animation Values
			array(
				'type'        => 'subheading',
				'param_name'  => 'pf_animations_values',
				'heading'     => esc_html__( 'Animate To', 'landinghub-core' ),
				'group' => esc_html__( 'Item Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),			
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_an_translate_x',
				'heading'     => esc_html__( 'Translate X', 'landinghub-core' ),
				'description' => esc_html__( 'Select translate on X axe', 'landinghub-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group' => esc_html__( 'Item Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_an_translate_y',
				'heading'     => esc_html__( 'Translate Y', 'landinghub-core' ),
				'description' => esc_html__( 'Select translate on Y axe', 'landinghub-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group' => esc_html__( 'Item Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_an_translate_z',
				'heading'     => esc_html__( 'Translate Z', 'landinghub-core' ),
				'description' => esc_html__( 'Select translate on Z axe', 'landinghub-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
				'group' => esc_html__( 'Item Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_an_scale_x',
				'heading'     => esc_html__( 'Scale X', 'landinghub-core' ),
				'description' => esc_html__( 'Select Scale X', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 10,
				'step'        => 0.05,
				'std'         => 1,
				'edit_field_class' => 'vc_col-sm-4',
				'group' => esc_html__( 'Item Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_an_scale_y',
				'heading'     => esc_html__( 'Scale Y', 'landinghub-core' ),
				'description' => esc_html__( 'Select Scale Y', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 10,
				'step'        => 0.05,
				'std'         => 1,
				'edit_field_class' => 'vc_col-sm-4',
				'group' => esc_html__( 'Item Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_an_rotate_x',
				'heading'     => esc_html__( 'Rotate X', 'landinghub-core' ),
				'description' => esc_html__( 'Select rotate degree on X axe', 'landinghub-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group' => esc_html__( 'Item Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_an_rotate_y',
				'heading'     => esc_html__( 'Rotate Y', 'landinghub-core' ),
				'description' => esc_html__( 'Select rotate degree on Y axe', 'landinghub-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group' => esc_html__( 'Item Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_an_rotate_z',
				'heading'     => esc_html__( 'Rotate Z', 'landinghub-core' ),
				'description' => esc_html__( 'Select rotate degree on Z axe', 'landinghub-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
				'group' => esc_html__( 'Item Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_an_opacity',
				'heading'     => esc_html__( 'Opacity', 'landinghub-core' ),
				'description' => esc_html__( 'Set opacity', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 1,
				'step'        => 0.1,
				'std'         => 1,
				'group' => esc_html__( 'Item Animation', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'enable_item_animation',
					'value'   => 'yes',
				)
			),
				
		);
		
		$this->params = array_merge( array(
			// Params goes here
			array(
				'type'        => 'responsive_columns',
				'param_name'  => 'columns',
				'heading'     => esc_html__( 'Number of Columns', 'landinghub-core' ),
				'std'         => 'md:3|sm:2|xs:1|spacing_xs:15px',
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'inactiv_opacity',
				'heading'     => esc_html__( 'Inactive slides opacity', 'landinghub-core' ),
				'description' => esc_html__( 'Set opacity for inactive slides', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 1,
				'step'        => 0.1,
				'std'         => 1,
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'shadow',
				'heading'     => esc_html__( 'Shadow', 'landinghub-core' ),
				'description' => esc_html__( 'Set shadow to items', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'None', 'landinghub-core' ) => '',
					esc_html__( 'Active Item', 'landinghub-core' ) => 'carousel-shadow-active',
					esc_html__( 'All Items', 'landinghub-core' ) => 'carousel-shadow-all',
				),
			),
			array(
				'type'             => 'checkbox',
				'param_name'       => 'enable_parallax',
				'value'            => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'heading'          => esc_html__( 'Enable Parallax?', 'landinghub-core' ),
				'description'      => esc_html__( 'Will enable parallax for images in slider.', 'landinghub-core' ),
			),
			array(
				'type'             => 'checkbox',
				'param_name'       => 'enable_item_animation',
				'value'            => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'heading'          => esc_html__( 'Animate Carousel Items?', 'landinghub-core' ),
				'description'      => esc_html__( 'Will enable animation for items, it will be animated when it "enters" the browsers viewport (Note: works only in modern browsers).', 'landinghub-core' ),
			),
			
			), $options, $nav, $animation ); 

		$this->add_extras();
	}

	protected function columnize_content( &$content ) {

		global $shortcode_tags;

		// Find all registered tag names in $content.
		preg_match_all( '@\[([^<>&/\[\]\x00-\x20=]++)@', $content, $matches );
		$tagnames = array_intersect( array_keys( $shortcode_tags ), $matches[1] );
		$pattern = get_shortcode_regex();
		
		$item_classname = 'carousel-item';

		foreach( $tagnames as $tag ) {
			$start = "[$tag";
			$end = "[/$tag]";

			if( ld_helper()->str_contains( $end, $content ) ) {
				$content = str_replace( $start, '<div class="' . $item_classname . '">' . $start, $content );
				$content = str_replace( $end, $end . '</div>', $content );
			}
			else {
				preg_match_all( '/' . $pattern . '/s', $content, $matches );

				foreach( array_unique( $matches[0] ) as $replace ) {
					$content = str_replace( $replace, '<div class="' . $item_classname . '">' . $replace . '</div>', $content );
				}
			}

		}
	}

	protected function get_ca_options() {

		extract( $this->atts );
		
		if( !$enable_item_animation ) {
			return;
		}
		
		$animation_opts = $this->get_animation_opts();

		$opts = $split_opts = array();
		$opts[] = 'data-custom-animations="true"';
		$opts[] = 'data-ca-options=\'' . stripslashes( wp_json_encode( $animation_opts ) ) . '\'';
	
		return join( ' ', $opts );

	}

	protected function get_animation_opts() {

		extract( $this->atts );
		
		$opts = $init_values = $animations_values = $arr = array();
		$opts['triggerHandler'] = 'inview';
		$opts['animationTarget'] = '.flickity-slider > .carousel-item';
		$opts['duration'] = !empty( $pf_duration ) ? $pf_duration : 700;
		if( !empty( $pf_start_delay ) ) {
			$opts['startDelay'] = $pf_start_delay;
		}
		$opts['delay'] = !empty( $pf_delay ) ? $pf_delay : 100;
		$opts['ease'] = $pf_easing;
		
		//Init values
		if ( !empty( $pf_init_translate_x ) ) { $init_values['x'] = ( int ) $pf_init_translate_x; }
		if ( !empty( $pf_init_translate_y ) ) { $init_values['y'] = ( int ) $pf_init_translate_y; }
		if ( !empty( $pf_init_translate_z ) ) { $init_values['z'] = ( int ) $pf_init_translate_z; }
	
		if ( '1' !== $pf_init_scale_x ) { $init_values['scaleX'] = ( float ) $pf_init_scale_x; }
		if ( '1' !== $pf_init_scale_y ) { $init_values['scaleY'] = ( float ) $pf_init_scale_y; }
	
		if ( !empty( $pf_init_rotate_x ) ) { $init_values['rotationX'] = ( int ) $pf_init_rotate_x; }
		if ( !empty( $pf_init_rotate_y ) ) { $init_values['rotationY'] = ( int ) $pf_init_rotate_y; }
		if ( !empty( $pf_init_rotate_z ) ) { $init_values['rotationZ'] = ( int ) $pf_init_rotate_z; }
		
		if ( isset( $pf_init_opacity ) && '1' !== $pf_init_opacity ) { $init_values['opacity'] = ( float ) $pf_init_opacity; }
	
		//Animation values
		if ( !empty( $pf_init_translate_x ) ) { $animations_values['x'] = ( int ) $pf_an_translate_x; }
		if ( !empty( $pf_init_translate_y ) ) { $animations_values['y'] = ( int ) $pf_an_translate_y; }
		if ( !empty( $pf_init_translate_z ) ) { $animations_values['z'] = ( int ) $pf_an_translate_z; }
	
		if ( isset( $pf_an_scale_x ) && '1' !== $pf_init_scale_x ) { $animations_values['scaleX'] = ( float ) $pf_an_scale_x; }
		if ( isset( $pf_an_scale_y ) && '1' !== $pf_init_scale_y ) { $animations_values['scaleY'] = ( float ) $pf_an_scale_y; }
	
		if ( !empty( $pf_init_rotate_x ) ) { $animations_values['rotationX'] = ( int ) $pf_an_rotate_x; }
		if ( !empty( $pf_init_rotate_y ) ) { $animations_values['rotationY'] = ( int ) $pf_an_rotate_y; }
		if ( !empty( $pf_init_rotate_z ) ) { $animations_values['rotationZ'] = ( int ) $pf_an_rotate_z; }
	
		if ( isset( $pf_an_opacity ) && '1' !== $pf_init_opacity ) { $animations_values['opacity'] = ( float ) $pf_an_opacity; }	

		$opts['initValues'] = !empty( $init_values ) ? $init_values : array( 'scale' => 1 );
		$opts['animations'] = !empty( $animations_values ) ? $animations_values : array( 'scale' => 1 );
		
		return $opts;
		
	}

	protected function get_options() {

		$opts = array();
		$raw = $this->atts;
		$ids = array(
			'initialindex'         => 'initialIndex',
			'cellalign'            => 'cellAlign',
			'groupcells'           => 'groupCells',
			'pagenationdots'       => 'pageDots',
			'number_style'         => 'numbersStyle',
			'autoplay'             => 'autoPlay',
			'autoplaytime'         => 'autoPlay',
			'pauseautoplayonhover' => 'pauseAutoPlayOnHover',
			'draggable'            => 'draggable',
			'freescroll'           => 'freeScroll',
			'fadeeffect'           => 'fade',
			'wraparound'           => 'wrapAround',
			'adaptiveheight'       => 'adaptiveHeight',
			'equalheightcells'      => 'equalHeightCells',
			'navappend'            => 'buttonsAppendTo',
			'navappend_id'         => 'buttonsAppendTo',

			'dots_type' => 'dotsIndicator',
			
			'dotsappend'            => 'dotsAppendTo',
			'dotsappend_id'         => 'dotsAppendTo',
			
			'prevnextbuttons'      => 'prevNextButtons',
			'navarrow'             => 'navArrow',
			'navslidernumberstoarrows' => 'addSlideNumbersToArrows',
			'fullwidthside'        => 'fullwidthSide',
			'navoffset'            => 'navOffsets',
			'randomveroffset'      => 'randomVerOffset',
			'controllingcarousels' => 'controllingCarousels',
			'enable_parallax'      => 'parallax'
			
		);

		unset(
			$raw['style'],
			$raw['columns'],
			$raw['paddings'],
			$raw['title'],
			$raw['content'],
			$raw['inactiv_opacity'],
			$raw['shadow'],
			$raw['fadesides'],
			$raw['custom_cursor'],

			$raw['navfloated'],
			$raw['navhalign'],
			$raw['navvalign'],
			$raw['navdirection'],
			$raw['dots_vertical_align'],
			$raw['navline'],
			$raw['navsize'],
			$raw['navfill'],
			$raw['navshape'],
			$raw['navshadow'],

			$raw['nav_arrow_color'],
			$raw['nav_arrow_color_hover'],
			$raw['nav_arrow_numbers'],
			$raw['nav_border_color'],
			$raw['nav_border_hcolor'],
			$raw['nav_bg_color'],
			$raw['nav_bg_hcolor'],
			
			$raw['shapesize'],
			$raw['shapeheight'],
			$raw['shapewidth'],			

			$raw['size_dots'],
			$raw['dotscustomsize'],
			$raw['align_dots'],
			$raw['dots_style'],

			$raw['dots_bg_color'],
			$raw['dots_bg_hcolor'],
			
			$raw['mobile_dots_position'],
			$raw['mobile_align_dots'],
			$raw['mobile_dots_bg_color'],
			$raw['mobile_dots_bg_hcolor'],
			$raw['dots_top_offset'],
			$raw['dots_right_offset'],
			$raw['dots_bottom_offset'],
			$raw['dots_left_offset'],
			$raw['_id'],
			$raw['el_id'],
			$raw['el_class'],
			
			$raw['enable_item_animation'],
			$raw['pf_duration'],
			$raw['pf_start_delay'],
			$raw['pf_delay'],
			$raw['pf_easing'],
			$raw['pf_init_values'],
			$raw['pf_init_translate_x'],
			$raw['pf_init_translate_y'],
			$raw['pf_init_translate_z'],
			$raw['pf_init_scale_x'],
			$raw['pf_init_scale_y'],
			$raw['pf_init_rotate_x'],
			$raw['pf_init_rotate_y'],
			$raw['pf_init_rotate_z'],
			$raw['pf_init_opacity'],
			$raw['pf_animations_values'],
			$raw['pf_an_translate_x'],
			$raw['pf_an_translate_y'],
			$raw['pf_an_translate_z'],
			$raw['pf_an_scale_x'],
			$raw['pf_an_scale_y'],
			$raw['pf_an_rotate_x'],
			$raw['pf_an_rotate_y'],
			$raw['pf_an_rotate_z'],
			$raw['pf_an_opacity']
			
		);

		$raw = array_filter( $raw );
		$custom_opts = $arr = $offset_value = array();

		foreach( $raw as $id => $val ) {

			// Casting
			if( 'yes' === $val ) {
				$val = true;
			}
			if( 'no' === $val || '' === $val ) {
				$val = false;
			}
			if( in_array( $id, array( 'initialindex', 'autoplaytime' ) ) ) {
				$val = intval( $val );
			}

			if( in_array( $id, array( 'prev', 'next', 'navarrow' ) ) ) {
				
				if( 'navarrow' === $id && 'custom' !== $val ){
					$opts[ $ids[ 'navarrow' ] ] = $val;
				}
				else {

					if( 'next' === $id ) {
						$val = !empty( $val ) ? vc_value_from_safe( $val, true ) : '<i class=\"fa fas fa-angle-left\"></i>';
						$custom_opts['next'] = $val;
					}
					if( 'prev' === $id ) {
						$val = !empty( $val ) ? vc_value_from_safe( $val, true ) : '<i class=\"fa fas fa-angle-right\"></i>';
						$custom_opts['prev'] = $val;
					}
					$opts[ $ids[ 'navarrow' ] ] = $custom_opts;
				}
			}
			elseif( 'controllingcarousels' === $id ) {
				
				$cc_values = explode( ',', $val );

				foreach( $cc_values as $value ) {
					$cc_value[] = $value ;
				}

				$opts[ $ids[ 'controllingcarousels' ] ] = $cc_value;
								
			}
			elseif( 'navoffset' === $id ) {

				$offset_values = explode( ',', $val );

				foreach( $offset_values as $value ) {

					$arr = explode( ':', $value );
					$offset_value[ $arr[0] ] = $arr[1] ;

				}

				$opts[ $ids[ 'navoffset' ] ] = array( 'nav' => $offset_value);

			} 
			elseif( 'prevoffset' === $id )	 {
				if( !empty( $val ) ) {
					$opts[ $ids[ 'navoffset' ] ]['prev'] = $val;	
				}
			}
			elseif( 'nextoffset' === $id )	 {
				if( !empty( $val ) ) {
					$opts[ $ids[ 'navoffset' ] ]['next'] = $val;
				}
			}
			elseif ( 'navappend' === $id ) {

				if ( 'custom_id' === $val && !empty( $opts[ $ids[ 'navappend_id' ] ] ) ) {

					$opts[ $ids[ 'navappend' ] ] = $opts[ $ids[ 'navappend_id' ] ];

				} else {

					$opts[ $ids[ $id ] ] = $val;
					
				}

			}
			else{
				$opts[ $ids[ $id ] ] = $val;
			}

		}

		if( !empty( $opts ) ) {
			echo " data-lqd-flickity='" . stripslashes( wp_json_encode( $opts ) ) ."'";
		}
		else {
			echo " data-lqd-flickity=true";
		}
	}

	protected function get_custom_cursor() {

		$classname = '';

		if ( 'disable-cc' === $this->atts['custom_cursor'] ) {
			$classname = 'disable-cc';
		}

		return $classname;

	}

	protected function get_fade_effect() {

		$classname = '';

		if ( 'yes' === $this->atts['fadeeffect'] ) {
			$classname = 'lqd-carousel-fade';
		}

		return $classname;

	}

	protected function generate_css() {

		extract( $this->atts );
		$elements = array();
		$queries_css = '';

		$id = '.' . $this->get_id();
		
		if( !empty( $columns ) ) {
			
			$columns = vc_parse_multi_attribute( $columns );

			if( isset( $columns['xs'] ) ) {
				$width = 100/$columns['xs'];	
				$elements[liquid_implode( '%1$s .carousel-item' )]['width'] = $width . '%';
			}
			if( !empty( $columns['spacing_xs'] ) ) {
				$elements[liquid_implode( '%1$s .carousel-item' )]['padding-inline-start']      = $columns['spacing_xs'];
				$elements[liquid_implode( '%1$s .carousel-item' )]['padding-inline-end']     = $columns['spacing_xs'];
				$elements[liquid_implode( '%1$s .carousel-items.row' )]['margin-inline-start']  = '-' . $columns['spacing_xs'];
				$elements[liquid_implode( '%1$s .carousel-items.row' )]['margin-inline-end'] = '-' . $columns['spacing_xs'];
			}
			
			if( isset( $columns['sm'] ) || !empty( $columns['spacing_sm'] ) ) {
				
				$queries_css .= '@media (min-width: 768px) {';
					if( isset( $columns['sm'] ) ) {
						$width = 100/$columns['sm'];
						$queries_css .= $id . ' .carousel-item { width:' . $width . '% }';
					}
					if( !empty( $columns['spacing_sm'] ) ) {
						$queries_css .= $id . ' .carousel-item { padding-inline-start:' . $columns['spacing_sm'] . ';padding-inline-end:' . $columns['spacing_sm'] . ';}';
						$queries_css .= $id . ' .carousel-items.row { margin-inline-start:-' . $columns['spacing_sm'] . ';margin-inline-end:-' . $columns['spacing_sm'] . ';}';
					}
					
				$queries_css .= '}';
			}
			if( isset( $columns['md'] ) || !empty( $columns['spacing_md'] ) ) {
				
				$queries_css .= '@media (min-width: 992px) {';
					if( isset( $columns['md'] ) ) {
						$width = 100/$columns['md'];
						$queries_css .= $id . ' .carousel-item { width:' . $width . '% }';
					}
					if( !empty( $columns['spacing_md'] ) ) {
						$queries_css .= $id . ' .carousel-item { padding-inline-start:' . $columns['spacing_md'] . ';padding-inline-end:' . $columns['spacing_md'] . ';}';
						$queries_css .= $id . ' .carousel-items.row { margin-inline-start:-' . $columns['spacing_md'] . ';margin-inline-end:-' . $columns['spacing_md'] . ';}';
					}
				$queries_css .= '}';
			}
			if( isset( $columns['lg'] ) || !empty( $columns['spacing_lg'] ) ) {
				
				$queries_css .= '@media (min-width: 1200px) {';
					if( isset( $columns['lg'] ) ) {
						$width = 100/$columns['lg'];
						$queries_css .= $id . ' .carousel-item { width:' . $width . '% }';
					}
					if( !empty( $columns['spacing_lg'] ) ) {
						$queries_css .= $id . ' .carousel-item { padding-inline-start:' . $columns['spacing_lg'] . ';padding-inline-end:' . $columns['spacing_lg'] . ';}';
						$queries_css .= $id . ' .carousel-items.row { margin-inline-start:-' . $columns['spacing_lg'] . ';margin-inline-end:-' . $columns['spacing_lg'] . ';}';
					}
				$queries_css .= '}';
			}
		}

		if( '1' !== $inactiv_opacity ) {
			$elements[liquid_implode( '%1$s .flickity-slider > .carousel-item:not(.is-selected)' )]['opacity'] = $inactiv_opacity;
		}
		
		if( !empty( $nav_arrow_color ) ) {
			$elements[liquid_implode( '%1$s.carousel-nav .flickity-button svg' )]['stroke'] = $nav_arrow_color;
			$elements[liquid_implode( '%1$s.carousel-nav .flickity-button' )]['color'] = $nav_arrow_color;
			$elements[liquid_implode( '%1$s.carousel-nav .flickity-button.previous:after' )]['background'] = $nav_arrow_color;
		}
		if( !empty( $nav_arrow_color_hover ) ) {
			$elements[liquid_implode( '%1$s.carousel-nav .flickity-button:hover svg' )]['stroke'] = $nav_arrow_color_hover;
			$elements[liquid_implode( '%1$s.carousel-nav .flickity-button:hover' )]['color'] = $nav_arrow_color_hover;
		}
		if( !empty( $nav_arrow_numbers ) ) {
			$elements[liquid_implode( '%1$s .carousel-nav .lqd-carousel-slides' )]['color'] = $nav_arrow_numbers;
		}
		if( !empty( $nav_border_color ) ) {
			$elements[liquid_implode( '%1$s.carousel-nav .flickity-button' )]['border-color'] = $nav_border_color;
			$elements[liquid_implode( '%1$s.carousel-nav .flickity-button.previous:after' )]['background-color'] = $nav_border_color;
		}
		if( !empty( $nav_border_hcolor ) ) {
			$elements[liquid_implode( '%1$s.carousel-nav .flickity-button:hover' )]['border-color'] = $nav_border_hcolor;
		}
		if( !empty( $nav_bg_color ) ) {
			$elements[liquid_implode( '%1$s.carousel-nav .flickity-button' )]['background'] = $nav_bg_color;
		}
		if( !empty( $nav_bg_hcolor ) ) {
			$elements[liquid_implode( '%1$s.carousel-nav .flickity-button:before' )]['background'] = $nav_bg_hcolor;
		}
		if( !empty( $shapesize ) ) {
			$elements[liquid_implode( '%1$s.carousel-nav .flickity-button' ) ]['width'] = $shapesize .' !important';
			$elements[liquid_implode( '%1$s.carousel-nav .flickity-button' ) ]['height'] = $shapesize .' !important';
		}
		if( !empty( $shapeheight ) ) {
			$elements[liquid_implode( '%1$s.carousel-nav .flickity-button' ) ]['height'] = $shapeheight .' !important';
		}
		if( !empty( $shapewidth ) ) {
			$elements[liquid_implode( '%1$s.carousel-nav .flickity-button' ) ]['width'] = $shapewidth .' !important';
		}
		
		
		if( 'carousel-dots-style3' ===  $dots_style ) {
			if( !empty( $dots_bg_color ) ) {
				$elements[liquid_implode( '%1$s .flickity-page-dots .dot' )]['color'] = $dots_bg_color;
				$elements[liquid_implode( '%1$s .flickity-page-dots .dot' )]['background-color'] = $dots_bg_color;
			}
			if( !empty( $dots_bg_hcolor ) ) {
				$elements[liquid_implode( '%1$s .flickity-page-dots .dot.is-selected:before' )]['color'] = $dots_bg_hcolor;
			}
		}
		else if ( 'numbers' !== $dots_type ) {
			if( !empty( $dots_bg_color ) ) {
				$elements[liquid_implode( '%1$s .flickity-page-dots .dot' )]['background'] = $dots_bg_color;
				$elements[liquid_implode( '%1$s .flickity-page-dots .dot' )]['border-color'] = $dots_bg_color;
				$elements[liquid_implode( '%1$s .flickity-page-dots .dot' )]['color'] = $dots_bg_color;
			}
			if( !empty( $dots_bg_hcolor ) ) {
				$elements[liquid_implode( '%1$s .flickity-page-dots .dot.is-selected, %1$s .flickity-page-dots .dot:hover' )]['background'] = $dots_bg_hcolor;
				$elements[liquid_implode( '%1$s .flickity-page-dots .dot.is-selected, %1$s .flickity-page-dots .dot:hover' )]['border-color'] = $dots_bg_hcolor;
				$elements[liquid_implode( '%1$s .flickity-page-dots .dot.is-selected, %1$s .flickity-page-dots .dot:hover' )]['color'] = $dots_bg_hcolor;
			}
		}
		else {
			if( !empty( $dots_bg_color ) ) {
				$elements[liquid_implode( '%1$s .lqd-carousel-slides-numbers' )]['color'] = $dots_bg_color;
				$elements[liquid_implode( '%1$s .lqd-carousel-slides-numbers svg' )]['stroke'] = $dots_bg_color;
				$elements[liquid_implode( '%1$s .lqd-carousel-numbers-line path' )]['opacity'] = '1';
			}
			if( !empty( $dots_bg_hcolor ) ) {
				$elements[liquid_implode( '%1$s .lqd-carousel-slides-numbers:hover' )]['color'] = $dots_bg_hcolor;
				$elements[liquid_implode( '%1$s .lqd-carousel-slides-numbers:hover svg' )]['stroke'] = $dots_bg_hcolor;
				$elements[liquid_implode( '%1$s .lqd-carousel-numbers-line path:last-of-type' )]['stroke'] = $dots_bg_hcolor;
				$elements[liquid_implode( '%1$s .lqd-carousel-slides-current' )]['color'] = $dots_bg_hcolor;
			}
		}

		if( !empty( $mobile_dots_bg_color ) ) {
			$elements[liquid_implode( '%1$s .carousel-dots-mobile .flickity-page-dots .dot' )]['background-color'] = $mobile_dots_bg_color;
		}
		if( !empty( $mobile_dots_bg_hcolor ) ) {
			$elements[liquid_implode( '%1$s .carousel-dots-mobile .flickity-page-dots .dot.is-selected' )]['background-color'] = $mobile_dots_bg_hcolor;
		}
		
		if ( !empty($dots_top_offset) ) {
			$elements[liquid_implode( '%1$s .flickity-page-dots' )]['top'] = $dots_top_offset;
		}
		if ( !empty($dots_right_offset) ) {
			$elements[liquid_implode( '%1$s .flickity-page-dots' )]['right'] = $dots_right_offset;
		}
		if ( !empty($dots_bottom_offset) ) {
			$elements[liquid_implode( '%1$s .flickity-page-dots' )]['bottom'] = $dots_bottom_offset;
		}
		if ( !empty($dots_left_offset) ) {
			$elements[liquid_implode( '%1$s .flickity-page-dots' )]['left'] = $dots_left_offset;
		}
		
		if( !empty( $dotscustomsize ) ) {
			$elements[liquid_implode( '%1$s .flickity-page-dots .dot' )]['width'] = $dotscustomsize;
			$elements[liquid_implode( '%1$s .flickity-page-dots .dot' )]['height'] = $dotscustomsize;
		}
		if ( !empty( $dotscustomsize_height ) ) {
			$elements[liquid_implode( '%1$s .flickity-page-dots .dot' )]['height'] = $dotscustomsize_height;
		}

		$elements['media']['responsive'] = $queries_css;

		$this->dynamic_css_parser( $id, $elements );
	}

}
new LD_Carousel;
class WPBakeryShortCode_LD_Carousel extends WPBakeryShortCodesContainer {}