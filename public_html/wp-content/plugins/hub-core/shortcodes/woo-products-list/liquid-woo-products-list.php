<?php
/**
* Shortcode Woo Products
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Woo_Products_List extends LD_Shortcode {

	/**
	 * Shortcode type.
	 *
	 * @since 3.2.0
	 * @var   string
	 */
	protected $type = 'liquid_products';

	/**
	 * [$post_type description]
	 * @var string
	 */
	private $post_type = 'product';

	/**
	 * Attributes.
	 *
	 * @since 3.2.0
	 * @var   array
	 */
	protected $attributes = array();


	/**
	 * Query args.
	 *
	 * @since 3.2.0
	 * @var   array
	 */
	protected $query_args = array();

	/**
	* [$taxonomies description]
	* @var array
	*/
	private $taxonomies = array( 'product_cat' );

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug = 'ld_woo_products_list';
		$this->title = esc_html__( 'Woo Products', 'landinghub-core' );
		$this->icon = 'la la-shopping-bag';
		$this->scripts      = array( 'flickity' );
		$this->description = esc_html__( 'Display woo products', 'landinghub-core' );
		
		require_once vc_path_dir( 'CONFIG_DIR', 'grids/vc-grids-functions.php' );
		if ( 'vc_get_autocomplete_suggestion' === vc_request_param( 'action' ) || 'vc_edit_form' === vc_post_param( 'action' ) ) {

			// Narrow data taxonomies
			add_filter( 'vc_autocomplete_'. $this->slug . '_taxonomies_callback', array( $this,'autocomplete_taxonomies_field_search' ) );
			add_filter( 'vc_autocomplete_'. $this->slug . '_taxonomies_render', array($this, 'render_autocomplete_field') );
			
			// Filter Cats
			add_filter( 'vc_autocomplete_'. $this->slug . '_filter_cats_callback', array( $this,'autocomplete_taxonomies_field_search' ) );
			add_filter( 'vc_autocomplete_'. $this->slug . '_filter_cats_render', array( $this, 'render_autocomplete_field' ) );

		}
		
		add_filter( 'woocommerce_product_loop_start', array( $this, 'woocommerce_product_loop_start' ) );
		
		parent::__construct();
	}

	public function get_params() {

		$url = liquid_addons()->plugin_uri() . 'assets/img/sc-preview/products-list/';

		$general = array(
			array(
				'type'       => 'select_preview',
				'heading'    => esc_html__( 'Layout Style', 'landinghub-core' ),
				'param_name' => 'template',
				'value'      => array(
					array(
						'value' => 'grid',
						'label' => esc_html__( 'Grid', 'landinghub-core' ),
						'image' => $url . 'grid.svg'
					),
					array(
						'label' => esc_html__( 'Masonry', 'landinghub-core' ),
						'value' => 'masonry',
						'image' => $url . 'masonry.svg'
					),
					array(
						'label' => esc_html__( 'Carousel', 'landinghub-core' ),
						'value' => 'carousel',
						'image' => $url . 'carousel.svg'
					),
				),
				'description' => esc_html__( 'Select the desired product list layout', 'landinghub-core' ),
				'admin_label' => true,
				'save_always' => true,
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'enable_gallery',
				'heading'     => esc_html__( 'Show Gallery?', 'landinghub-core' ),
				'description' => esc_html__( 'Enable to show images from the gallery', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			),

/*
			array(
				'type'       => 'dropdown',
				'param_name' => 'style',
				'heading'    => esc_html__( 'Product Styles', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Default', 'landinghub-core' )                => 'default',
					esc_html__( 'Classic', 'landinghub-core' )                => 'classic',
					esc_html__( 'Minimal', 'landinghub-core' )                => 'minimal',
					esc_html__( 'Minimal 2', 'landinghub-core' )              => 'minimal-2',
					esc_html__( 'Minimal Hover Shadow', 'landinghub-core' )   => 'minimal-hover-shadow',
					esc_html__( 'Minimal Hover Shadow 2', 'landinghub-core' ) => 'minimal-hover-shadow-2',

				),
				'admin_label' => true,
				'save_always' => true,
			),
*/
			array(
				'type'       => 'dropdown',
				'param_name' => 'grid_columns',
				'heading'    => esc_html__( 'Columns', 'landinghub-core' ),
				'value'      => array(
					'1 Column' => '1',
					'2 Columns' => '2',
					'3 Columns' => '3',
					'4 Columns' => '4',
					'5 Columns' => '5',
					'6 Columns' => '6',
				),
				'std' => '3',
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'columns_gap',
				'heading'     => esc_html__( 'Columns gap', 'landinghub-core' ),
				'description' => esc_html__( 'Select gap between columns in row.', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 35,
				'step'        => 1,
				'std'         => 15,
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
				'dependency' => array(
					'element' => 'template',
					'value'   => array( 'carousel' ),
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
				'std'					=> 'yes',
				'dependency' => array(
					'element' => 'template',
					'value'   => array( 'carousel' ),
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Draggable', 'landinghub-core' ),
				'description' => esc_html__( 'Enable/Disable draggableity of the carousel.', 'landinghub-core' ),
				'param_name'  => 'draggable',
				'value'       => array(
					esc_html__( 'Enable', 'landinghub-core' ) => '',
					esc_html__( 'Disable', 'landinghub-core' )  => 'no'
				),
				'dependency' => array(
					'element' => 'template',
					'value'   => array( 'carousel' ),
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
				'dependency' => array(
					'element' => 'template',
					'value'   => array( 'carousel' ),
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
				'dependency' => array(
					'element' => 'template',
					'value'   => array( 'carousel' ),
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
				'heading'     => esc_html__( 'Navigation Arrows', 'landinghub-core' ),
				'description' => esc_html__( 'Enable/Disable navigation arrows..', 'landinghub-core' ),
				'param_name'  => 'prevnextbuttons',
				'value'       => array(
					esc_html__( 'Disable', 'landinghub-core' )  => 'no',
					esc_html__( 'Enable', 'landinghub-core' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'template',
					'value'   => array( 'carousel' ),
				),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'show_filter',
				'heading'     => esc_html__( 'Enable filter?', 'landinghub-core' ),
				'description' => esc_html__( 'Will enable products categories filter', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'No', 'landinghub-core' )  => '',
					esc_html__( 'Yes', 'landinghub-core' ) => 'yes'
				),
				'dependency' => array(
					'element' => 'template',
					'value_not_equal_to'   => array( 'grid' ),
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'pagination',
				'heading' => esc_html__( 'Pagination', 'landinghub-core' ),
				'description' => esc_html__( 'Select yes to show pagination.', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'None', 'landinghub-core' )        => 'none',
					esc_html__( 'Ajax', 'landinghub-core' )        => 'ajax',
					esc_html__( 'Pagination', 'landinghub-core' )  => 'pagination',
				),
				'dependency' => array(
					'element' => 'template',
					'value_not_equal_to'   => array( 'carousel' ),
				),
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'ajax_trigger',
				'heading' => esc_html__( 'Ajax Trigger', 'landinghub-core' ),
				'description' => esc_html__( 'Select a trigger for ajax load', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Click', 'landinghub-core' )   => 'click',
					esc_html__( 'Inview', 'landinghub-core' )  => 'inview',
				),
				'dependency' => array(
					'element' => 'pagination',
					'value'   => 'ajax',	
				),
			),
			array(
				'id' => 'limit'
			),
			// ID
			array(
				'type'        => 'textfield',
				'param_name'  => 'el_id',
				'heading'     => esc_html__( 'Element ID', 'landinghub-core' ),
				'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add unique id and then refer to it in your css file.', 'landinghub-core' ),
			),
			// CSS
			array(
				'type'        => 'textfield',
				'param_name'  => 'el_class',
				'heading'     => esc_html__( 'Extra class name', 'landinghub-core' ),
				'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'landinghub-core' ),
			)
			
		);


		$data_params = array(	
			
			array(
				'type'        => 'autocomplete',
				'param_name'  => 'taxonomies',
				'heading'     => esc_html__( 'Categories', 'landinghub-core' ),
				'description' => esc_html__( 'Show products only from these categories', 'landinghub-core' ),
				'settings'    => array(
					'multiple'       => true,
					'min_length'     => 1,
					'groups'         => true,
					'no_hide'        => true, // In UI after select doesn't hide an select list
					'unique_values'  => true,
					'display_inline' => true,
					'delay'          => 500,
					'auto_focus'     => true,
				),
				'param_holder_class' => 'vc_not-for-custom',
				'group'              => esc_html__( 'Data', 'landinghub-core' ),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'orderby',
				'heading'     => esc_html__( 'Order by', 'landinghub-core' ),
				'admin_label' => true,
				'value'       => array(
					esc_html__( 'Rand', 'landinghub-core' )       => 'rand',
					esc_html__( 'Date', 'landinghub-core' )       => 'date',
					esc_html__( 'Price', 'landinghub-core' )      => 'price',
					esc_html__( 'Popularity', 'landinghub-core' ) => 'popularity',
					esc_html__( 'Rating', 'landinghub-core' )     => 'rating',
					esc_html__( 'Title', 'landinghub-core' )      => 'title',
				),
				'std'         => 'date',
				'group' => esc_html__( 'Data', 'landinghub-core' ),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'order',
				'heading'     => esc_html__( 'Order', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Ascending', 'landinghub-core' )  => 'asc',
					esc_html__( 'Descending', 'landinghub-core' ) => 'desc'
				),
				'dependency'  => array( 'element' => 'orderby', 'value' => array( 'date', 'price', 'title' ) ),
				'admin_label' => true,
				'group'       => esc_html__( 'Data', 'landinghub-core' ),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'show',
				'heading'    => esc_html__( 'Show', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'All Products', 'landinghub-core' ) 	    => '',
					esc_html__( 'Featured Products', 'landinghub-core' ) => 'featured',
					esc_html__( 'On-sale Products', 'landinghub-core' )  => 'onsale',
				),
				'group' => esc_html__( 'Data', 'landinghub-core' ),
				'admin_label' => true
			),
		);
		
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
		);
		
		$filter = array(
			
			array(
				'type'        => 'autocomplete',
				'param_name'  => 'filter_cats',
				'heading'     => esc_html__( 'Categories', 'landinghub-core' ),
				'description' => esc_html__( 'Enter categories to display in filter bar.', 'landinghub-core' ),
				'settings'    => array(
					'multiple'      => true,
					'min_length'    => 1,
					'groups'        => true,
					'sortable'      => true,
					'no_hide'       => true, // In UI after select doesn't hide an select list
					'unique_values' => true,
					'delay'         => 500,
					'auto_focus'    => true,
				),
				'param_holder_class' => 'vc_not-for-custom',

			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'filter_enable_counter',
				'heading'     => esc_html__( 'Show Counter?', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'filter_normal_color',
				'heading'     => esc_html__( 'Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the filter items', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4'				
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'filter_hover_color',
				'heading'     => esc_html__( 'Hover/Active color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the filter hover/active item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4'				
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'filter_dec_color',
				'heading'     => esc_html__( 'Decoration color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the filter decoration/lines/borders item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4'				
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'filter_lbl_all',
				'heading'     => esc_html__( 'Label "All"', 'landinghub-core' ),
				'value'       => esc_html__( 'All', 'landinghub-core' ),
				'save_always' => true,
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'filter_color',
				'heading'     => esc_html__( 'Color Scheme', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Default', 'landinghub-core' )  => '',
					esc_html__( 'Light', 'landinghub-core' )    => 'filter-list-scheme-light'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'filter_size',
				'heading'     => esc_html__( 'Font size', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Default', 'landinghub-core' ) => '',
					esc_html__( 'Small', 'landinghub-core' )   => 'size-sm',
					esc_html__( 'Medium', 'landinghub-core' )  => 'size-md',
					esc_html__( 'Large', 'landinghub-core' )   => 'size-lg',
					esc_html__( 'Custom', 'landinghub-core' ) => 'size-custom',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'custom_filter_size',
				'heading'     => esc_html__( 'Custom Font size', 'landinghub-core' ),
				'description' => esc_html__( 'Add custom font size with px. ex 24px', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'filter_size',
					'value'   => 'size-custom',	
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'filter_decoration',
				'heading'     => esc_html__( 'Font Decoration', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Default', 'landinghub-core' )     => '',
					esc_html__( 'Underline', 'landinghub-core' )   => 'filters-underline',
					esc_html__( 'Linethrough', 'landinghub-core' ) => 'filters-line-through',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'filter_underline_height',
				'heading'     => esc_html__( 'Height for underline element', 'landinghub-core' ),
				'description' => esc_html__( 'Add height with px. ex 24px', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'filter_decoration',
					'value'   => 'filters-underline',	
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'filter_transformation',
				'heading'     => esc_html__( 'Font Transformation', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Default', 'landinghub-core' )    => '',
					esc_html__( 'Uppercase', 'landinghub-core' )  => 'text-uppercase ltr-sp-1',
					esc_html__( 'Capitalize', 'landinghub-core' ) => 'text-capitalize',
					esc_html__( 'Lowercase', 'landinghub-core' )  => 'text-lowercase',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'filter_align',
				'heading'     => esc_html__( 'Filter Alignment', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Center', 'landinghub-core' ) => 'justify-content-center',
					esc_html__( 'Left', 'landinghub-core' )  => 'justify-content-start',
					esc_html__( 'Right', 'landinghub-core' )  => 'justify-content-end',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'filter_mb',
				'heading'     => esc_html__( 'Filter Margin Bottom', 'landinghub-core' ),
				'description' => esc_html__( 'Add bottom margin to the filter', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 100,
				'step'        => 1,
				'std'         => 50
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'filter_weight',
				'heading'     => esc_html__( 'Font Weight', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Default', 'landinghub-core' )   => '',
					esc_html__( 'Light', 'landinghub-core' )     => 'font-weight-light',
					esc_html__( 'Normal', 'landinghub-core' )    => 'font-weight-normal',
					esc_html__( 'Medium', 'landinghub-core' )    => 'font-weight-medium',
					esc_html__( 'Semi Bold', 'landinghub-core' ) => 'font-weight-semibold',
					esc_html__( 'Bold', 'landinghub-core' )      => 'font-weight-bold',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			//Filter Title options
			array(
				'type'       => 'subheading',
				'param_name' => 'ft_options',
				'heading'    => esc_html__( 'Filter Title', 'landinghub-core' ),
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'filter_title',
				'heading'    => esc_html__( 'Filter title', 'landinghub-core' ),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'tag_to_inherite',
				'heading'     => esc_html__( 'Style to inherite', 'landinghub-core' ),
				'description' => esc_html__( 'Select tag you want to inherite style defined in theme options', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'None', 'landinghub-core' ) => '',
					esc_html__( 'h1', 'landinghub-core' )   => 'h1 mt-0',
					esc_html__( 'h2', 'landinghub-core' )   => 'h2 mt-0',
					esc_html__( 'h3', 'landinghub-core' )   => 'h3 mt-0',
					esc_html__( 'h4', 'landinghub-core' )   => 'h4 mt-0',
					esc_html__( 'h5', 'landinghub-core' )   => 'h5 mt-0',
					esc_html__( 'h6', 'landinghub-core' )   => 'h6 mt-0',
				),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'filter_title_size',
				'heading'     => esc_html__( 'Font size', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Default', 'landinghub-core' )                  => '',
					esc_html__( 'Medium - 18px', 'landinghub-core' )            => 'size-md',
					esc_html__( 'Large - 24px', 'landinghub-core' )             => 'size-lg',
					esc_html__( 'Extra Large - 55px', 'landinghub-core' )       => 'size-xl',
					esc_html__( 'Extra Extra Large - 72px', 'landinghub-core' ) => 'size-xxl',
				),
				'edit_field_class' => 'vc_col-sm-4'
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'filter_title_weight',
				'heading'     => esc_html__( 'Font Weight', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Default', 'landinghub-core' )   => '',
					esc_html__( 'Light', 'landinghub-core' )     => 'font-weight-light',
					esc_html__( 'Normal', 'landinghub-core' )    => 'font-weight-normal',
					esc_html__( 'Medium', 'landinghub-core' )    => 'font-weight-medium',
					esc_html__( 'Semi Bold', 'landinghub-core' ) => 'font-weight-semibold',
					esc_html__( 'Bold', 'landinghub-core' )      => 'font-weight-bold',
				),
				'edit_field_class' => 'vc_col-sm-4'
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'filter_title_transformation',
				'heading'     => esc_html__( 'Font Transformation', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Default', 'landinghub-core' )    => '',
					esc_html__( 'Uppercase', 'landinghub-core' )  => 'text-uppercase',
					esc_html__( 'Capitalize', 'landinghub-core' ) => 'text-capitalize',
					esc_html__( 'Lowercase', 'landinghub-core' )  => 'text-lowercase',
				),
				'edit_field_class' => 'vc_col-sm-4'
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'filter_title_color',
				'heading'     => esc_html__( 'Title Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the filter title', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4'				
			),
			//Filter SubtitleTitle options
			array(
				'type'       => 'subheading',
				'param_name' => 'fst_options',
				'heading'    => esc_html__( 'Filter Subtitle', 'landinghub-core' ),
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'filter_subtitle',
				'heading'    => esc_html__( 'Filter Subtitle', 'landinghub-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'filter_subtitle_color',
				'heading'     => esc_html__( 'Subtitle Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the filter subtitle', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4'
			),
			array(
				'type' => 'el_id',
				'param_name' => 'filter_id',
				'settings' => array(
					'auto_generate' => true,
				),
				'save_always' => true,
				'heading'     => esc_html__( 'Filter ID', 'landinghub-core' ),
				'description' =>  wp_kses_post( __( 'Enter Filter ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'landinghub-core' ) ),
			),

		);

		foreach( $filter as &$param ) {
			$param['group'] = esc_html__( 'Filter', 'landinghub-core' );
			if( !isset( $param['dependency'] ) ) {
				$param['dependency'] = array(
					'element' => 'show_filter',
					'value' => array( 'yes' )
				);
			}
		}


		$this->params = array_merge( $general, $nav, $filter, $data_params );
		$this->add_extras();
	}

	public function add_ul_classname( $class = array() ) {
		
		$class[] = 'reset-ul';
		$class[] = 'lqd-prods-row';
		
		return $class;
	}
	
	public function add_product_classname( $class = array() ) {

		$class[] = 'lqd-prod-item';
		$class[] = $this->entry_term_classes();

		return $class;
	}


	public function get_grid_class( $class = array() ) {

		$columns = $this->atts['grid_columns'];
		$width = get_post_meta( get_the_ID(), 'product-item-width', true );

		if ( !empty( $width ) ) {
			$class[] = sprintf( 'col-md-%s col-sm-6 col-xs-12', $width );
			return $class;
		}
		else {

			$hash = array(
				'1' => '12',
				'2' => '6',
				'3' => '4',
				'4' => '3',
				'5' => '5',
				'6' => '2'
			);
			
			if( '5' == $hash[ $columns ] )  {
				$class[] = 'vc_col-md-1/5 col-sm-6 col-xs-12';
			} else {
				$class[] = sprintf( 'col-md-%s col-sm-6 col-xs-12', isset( $hash[ $columns ] ) ? $hash[ $columns ] : '12' );
			}
			
			return $class;
			
		}

	}
	
	public function woocommerce_product_loop_start( $ob_get_clean ) {

		ob_start();
		
		include vc_shortcodes_theme_templates_dir( 'woo-products-list/loop/loop-start.php' );
		
		return ob_get_clean();
		
	}

	/**
	 * [entry_term_classes description]
	 * @method entry_term_classes
	 * @return [type]             [description]
	 */
	protected function entry_term_classes() {

		$terms = get_the_terms( get_the_ID(), $this->taxonomies[0] );
		if( !$terms ) {
			return;
		}
		$terms = wp_list_pluck( $terms, 'slug' );
		return join( ' ', $terms );

	}
	

	protected function get_options() {

		$default_args = array(
			'carouselEl'       => 'ul.products',
			'filters'          => $this->atts['filter_id'],
			'equalHeightCells' => true,
			'prevNextButtons'  => true,
			'navArrow'         => $this->atts['navarrow'],
			'wrapAround'       => true,
			
		);
		
		if( empty( $this->atts['navarrow'] ) ) {
			unset( $default_args['navArrow'] );
		}
		$opts = $offset_values = array();
		
		if( 'no' === $this->atts['prevnextbuttons'] ) {
			$opts['prevNextButtons'] = false;
		}
		if( !empty( $this->atts['autoplay'] ) ) {
			$opts['autoPlay'] = true;
		}
		if( !empty( $this->atts['autoplaytime'] ) ) {
			$opts['autoPlay'] = $this->atts['autoplaytime'];
		}
		if( 'yes' === $this->atts['pauseautoplayonhover'] ) {
			$opts['pauseAutoPlayOnHover'] = true;
		}
		if( 'no' === $this->atts['draggable'] ) {
			$opts['draggable'] = false;
		}
		if( !empty( $this->atts['freescroll'] ) ) {
			$opts['freeScrol'] = true;	
		}
		
		if( 'custom_id' === $this->atts['navappend'] && !empty( $this->atts['navappend_id'] ) ) {
			$opts['buttonsAppendTo'] = $this->atts['navappend_id'];
		}
		else {
			$opts['buttonsAppendTo'] = $this->atts['navappend'];
		}
		if( 'custom' === $this->atts['navarrow'] ) {
			
			$nav_next = !empty( $this->atts['next'] ) ? vc_value_from_safe( $this->atts['next'], true ) : '<i class=\"fa fas fa-angle-left\"></i>';
			$nav_prev = !empty( $this->atts['prev'] ) ? vc_value_from_safe( $this->atts['prev'], true ) : '<i class=\"fa fas fa-angle-right\"></i>';
			
			$next = '<i class=\"fa fas fa-angle-left\"></i>';

			$opts['navArrow'] = array(
				'next' => $nav_next,
				'prev' => $nav_prev
			);
		}
		if( 'yes' !== $this->atts['wraparound'] ) {
			$opts['wrapAround'] = false;
		}
		
		if( !empty( $this->atts['navoffset'] ) ) {
			
			$offset_values = explode( ',', $this->atts['navoffset'] );
			foreach( $offset_values as $value ) {
				$arr = explode( ':', $value );
				$offset_value[ $arr[0] ] = $arr[1] ;
			}
			
			$opts['navOffsets'] = array( 'nav' => $offset_value );
		}
		if( !empty( $this->atts['prevoffset'] ) ) {
			$opts['navOffsets']['prev'] = $this->atts['prevoffset'];
		}
		if( !empty( $this->atts['nextoffset'] ) ) {
			$opts['navOffsets']['next'] = $this->atts['nextoffset'];
		}

		$opts = wp_parse_args( $opts, $default_args );
		
		
		
		echo " data-lqd-flickity='" . stripslashes( wp_json_encode( $opts ) ) ."'";
		
	}
	
	public function enable_gallery() {
		
		if( empty( $this->atts['enable_gallery'] ) ) {
			remove_action( 'woocommerce_before_shop_loop_item_title', 'liquid_woocommerce_template_loop_product_gallery', 12 );
		}
		
	}
	
	protected function generate_css() {

		extract( $this->atts );
		$elements = array();
		$queries_css = '';

		$id = '.' . $this->get_id();
		
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
		
		$gap = (int)$columns_gap . 'px';

		$elements[ liquid_implode( '%1$s ul.products' ) ] = array(
			'margin-inline-start' => '-' . $gap,
			'margin-inline-end' => '-' . $gap
		);

		$elements[ liquid_implode( '%1$s ul.products li.product, %1$s ul.products .carousel-item' ) ] = array(
			'padding-inline-start' => $gap,
			'padding-inline-end' => $gap
		);
		
		$this->dynamic_css_parser( $id, $elements );
	}
	

	/**
	 * @since 4.5.2
	 *
	 * @param $search_string
	 *
	 * @return array|bool
	 */
	function autocomplete_taxonomies_field_search( $search_string ) {
		$data = array();
		$vc_taxonomies = get_terms( $this->taxonomies, array(
			'hide_empty' => false,
			'search'     => $search_string,
		) );
		if ( is_array( $vc_taxonomies ) && ! empty( $vc_taxonomies ) ) {
			foreach ( $vc_taxonomies as $t ) {
				if ( is_object( $t ) ) {
					$data[] = ld_helper()->get_term_object( $t );
				}
			}
		}

		return $data;
	}

	function render_autocomplete_field( $term ) {
		return ld_helper()->vc_autocomplete_taxonomies_field_render($term, 'product_cat');
	}
	
	
		/**
	 * Parse query args.
	 *
	 * @since  3.2.0
	 * @return array
	 */
	protected function parse_query_args() {
		$query_args = array(
			'post_type'           => 'product',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'no_found_rows'       => false,
			'orderby'             => empty( $_GET['orderby'] ) ? $this->atts['orderby'] : wc_clean( wp_unslash( $_GET['orderby'] ) ), // phpcs:ignore WordPress.Security.NonceVerification.Recommended

		);

		$orderby_value         = explode( '-', $query_args['orderby'] );
		$orderby               = esc_attr( $orderby_value[0] );
		$order                 = ! empty( $orderby_value[1] ) ? $orderby_value[1] : strtoupper( $this->atts['order'] );
		$query_args['orderby'] = $orderby;
		$query_args['order']   = $order;

// 		if ( wc_string_to_bool( $this->attributes['paginate'] ) ) {
			$this->atts['page'] = absint( empty( $_GET['product-page'] ) ? 1 : $_GET['product-page'] ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
// 		}

/*
		if ( ! empty( $this->attributes['rows'] ) ) {
			$this->attributes['limit'] = $this->attributes['columns'] * $this->attributes['rows'];
		}
*/

		$ordering_args         = WC()->query->get_catalog_ordering_args( $query_args['orderby'], $query_args['order'] );
		$query_args['orderby'] = $ordering_args['orderby'];
		$query_args['order']   = $ordering_args['order'];
		if ( $ordering_args['meta_key'] ) {
			$query_args['meta_key'] = $ordering_args['meta_key']; // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
		}
		$query_args['posts_per_page'] = intval( $this->atts['limit'] );
		if ( 1 < $this->atts['page'] ) {
			$query_args['paged'] = absint( $this->atts['page'] );
		}
		//$query_args['meta_query'] = WC()->query->get_meta_query(); // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
		switch ( $this->atts['show'] ) {
			case 'featured' :
/*
				$query_args['meta_query'][] = array(
					'key'   => '_featured',
					'value' => 'yes'
				);
*/
				//$query_args['visibility'] = 'featured';
				
			break;
			case 'onsale' :
				$query_args['post__in'] = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
			break;
		}
		$query_args['tax_query']  = array(); // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query

		// Visibility.
		$this->set_visibility_query_args( $query_args );

		// SKUs.
		//$this->set_skus_query_args( $query_args );

		// IDs.
		//$this->set_ids_query_args( $query_args );

		// Set specific types query args.
		if ( method_exists( $this, "set_{$this->type}_query_args" ) ) {
			$this->{"set_{$this->type}_query_args"}( $query_args );
		}

		// Attributes.
		//$this->set_attributes_query_args( $query_args );

		// Categories.
		$this->set_categories_query_args( $query_args );

		// Tags.
		//$this->set_tags_query_args( $query_args );

		$query_args = apply_filters( 'woocommerce_shortcode_products_query', $query_args, $this->attributes, $this->type );

		// Always query only IDs.
		$query_args['fields'] = 'ids';

		return $query_args;
	}
	
	
	/**
	 * Set visibility as featured.
	 *
	 * @since 3.2.0
	 * @param array $query_args Query args.
	 */
	protected function set_visibility_featured_query_args( &$query_args ) {
		$query_args['tax_query'] = array_merge( $query_args['tax_query'], WC()->query->get_tax_query() ); // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query

		$query_args['tax_query'][] = array(
			'taxonomy'         => 'product_visibility',
			'terms'            => 'featured',
			'field'            => 'name',
			'operator'         => 'IN',
			'include_children' => false,
		);
	}
	
	/**
	 * Set categories query args.
	 *
	 * @since 3.2.0
	 * @param array $query_args Query args.
	 */
	protected function set_categories_query_args( &$query_args ) {
		if ( ! empty( $this->atts['taxonomies'] ) ) {
			$categories = array_map( 'sanitize_title', explode( ',', $this->atts['taxonomies'] ) );
			$field      = 'slug';

			if ( is_numeric( $categories[0] ) ) {
				$field      = 'term_id';
				$categories = array_map( 'absint', $categories );
				// Check numeric slugs.
				foreach ( $categories as $cat ) {
					$the_cat = get_term_by( 'slug', $cat, 'product_cat' );
					if ( false !== $the_cat ) {
						$categories[] = $the_cat->term_id;
					}
				}
			}

			$query_args['tax_query'][] = array(
				'taxonomy'         => 'product_cat',
				'terms'            => $categories,
				'field'            => 'slug'
			);
		}
	}
	
	
	/**
	 * Set visibility query args.
	 *
	 * @since 3.2.0
	 * @param array $query_args Query args.
	 */
	protected function set_visibility_query_args( &$query_args ) {

		if ( 'featured' === $this->atts['show'] ) {
			$this->{'set_visibility_featured_query_args'}( $query_args );
		} else {
			$query_args['tax_query'] = array_merge( $query_args['tax_query'], WC()->query->get_tax_query() ); // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
		}
	}
	
	/**
	 * Set product as visible when querying for hidden products.
	 *
	 * @since  3.2.0
	 * @param  bool $visibility Product visibility.
	 * @return bool
	 */
	public function set_product_as_visible( $visibility ) {
		return true;
	}

/**
	 * Run the query and return an array of data, including queried ids and pagination information.
	 *
	 * @since  3.3.0
	 * @return object Object with the following props; ids, per_page, found_posts, max_num_pages, current_page
	 */
	protected function get_query_results() {
		$this->query_args = $this->parse_query_args();
		$transient_name    = $this->get_transient_name();
		$transient_version = WC_Cache_Helper::get_transient_version( 'product_query' );
		$cache             = true;
		$transient_value   = $cache ? get_transient( $transient_name ) : false;

		if ( isset( $transient_value['value'], $transient_value['version'] ) && $transient_value['version'] === $transient_version ) {
			$results = $transient_value['value'];
		} else {
			$query = new WP_Query( $this->query_args );

			$paginated = ! $query->get( 'no_found_rows' );

			$results = (object) array(
				'ids'          => wp_parse_id_list( $query->posts ),
				'total'        => $paginated ? (int) $query->found_posts : count( $query->posts ),
				'total_pages'  => $paginated ? (int) $query->max_num_pages : 1,
				'per_page'     => (int) $query->get( 'posts_per_page' ),
				'current_page' => $paginated ? (int) max( 1, $query->get( 'paged', 1 ) ) : 1,
			);

/*
			if ( $cache ) {
				$transient_value = array(
					'version' => $transient_version,
					'value'   => $results,
				);
				set_transient( $transient_name, $transient_value, DAY_IN_SECONDS * 30 );
			}
*/
		}

		// Remove ordering query arguments which may have been added by get_catalog_ordering_args.
		WC()->query->remove_ordering_args();

		/**
		 * Filter shortcode products query results.
		 *
		 * @since 4.0.0
		 * @param stdClass $results Query results.
		 * @param WC_Shortcode_Products $this WC_Shortcode_Products instance.
		 */
		return apply_filters( 'woocommerce_shortcode_products_query_results', $results, $this );
	}

	/**
	 * Loop over found products.
	 *
	 * @since  3.2.0
	 * @return string
	 */
	protected function product_loop() {
		$columns  = '3';
		$classes  = '';
		$products = $this->get_query_results();

		ob_start();

		if ( $products && $products->ids ) {
			// Prime caches to reduce future queries.
			if ( is_callable( '_prime_post_caches' ) ) {
				_prime_post_caches( $products->ids );
			}

			// Setup the loop.
			wc_setup_loop(
				array(
					'columns'      => $columns,
					'name'         => $this->type,
					'is_shortcode' => true,
					'is_search'    => false,
					'is_paginated' => true,
					'total'        => $products->total,
					'total_pages'  => $products->total_pages,
					'per_page'     => $products->per_page,
					'current_page' => $products->current_page,
				)
			);

			$original_post = $GLOBALS['post'];

			do_action( "woocommerce_shortcode_before_{$this->type}_loop", $this->attributes );

			// Fire standard shop loop hooks when paginating results so we can show result counts and so on.
/*
			if ( wc_string_to_bool( $this->attributes['paginate'] ) ) {
				do_action( 'woocommerce_before_shop_loop' );
			}
*/

			woocommerce_product_loop_start();

			if ( wc_get_loop_prop( 'total' ) ) {
				foreach ( $products->ids as $product_id ) {
					$GLOBALS['post'] = get_post( $product_id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
					setup_postdata( $GLOBALS['post'] );

					// Set custom product visibility when quering hidden products.
					//add_action( 'woocommerce_product_is_visible', array( $this, 'set_product_as_visible' ) );

					// Render product template.
					wc_get_template_part( 'content', 'product' );

					// Restore product visibility.
					//remove_action( 'woocommerce_product_is_visible', array( $this, 'set_product_as_visible' ) );
				}
			}

			$GLOBALS['post'] = $original_post; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			woocommerce_product_loop_end();

			// Fire standard shop loop hooks when paginating results so we can show result counts and so on.
			//if ( wc_string_to_bool( $this->atts['paginate'] ) ) {
				do_action( 'woocommerce_after_shop_loop' );
			//}

			do_action( "woocommerce_shortcode_after_{$this->type}_loop", $this->attributes );

			wp_reset_postdata();
			wc_reset_loop();
		} else {
			do_action( "woocommerce_shortcode_{$this->type}_loop_no_results", $this->attributes );
		}

		return '<div class="woocommerce">' . ob_get_clean() . '</div>';
	}

	/**
	 * Order by rating.
	 *
	 * @since  3.2.0
	 * @param  array $args Query args.
	 * @return array
	 */
	public static function order_by_rating_post_clauses( $args ) {
		global $wpdb;

		$args['where']  .= " AND $wpdb->commentmeta.meta_key = 'rating' ";
		$args['join']   .= "LEFT JOIN $wpdb->comments ON($wpdb->posts.ID = $wpdb->comments.comment_post_ID) LEFT JOIN $wpdb->commentmeta ON($wpdb->comments.comment_ID = $wpdb->commentmeta.comment_id)";
		$args['orderby'] = "$wpdb->commentmeta.meta_value DESC";
		$args['groupby'] = "$wpdb->posts.ID";

		return $args;
	}
	
	/**
	 * Generate and return the transient name for this shortcode based on the query args.
	 *
	 * @since 3.3.0
	 * @return string
	 */
	protected function get_transient_name() {
		$transient_name = 'wc_product_loop_' . md5( wp_json_encode( $this->query_args ) . $this->type );

		if ( 'rand' === $this->atts['orderby'] ) {
			// When using rand, we'll cache a number of random queries and pull those to avoid querying rand on each page load.
			$rand_index      = wp_rand( 0, max( 1, absint( apply_filters( 'woocommerce_product_query_max_rand_cache_count', 5 ) ) ) );
			$transient_name .= $rand_index;
		}

		return $transient_name;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
new LD_Woo_Products_List;