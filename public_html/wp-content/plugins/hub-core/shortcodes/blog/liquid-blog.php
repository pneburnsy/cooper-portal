<?php

/**
* Shortcode Blog
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Blog extends LD_Shortcode {

	/**
	 * [$post_type description]
	 * @var string
	 */
	private $post_type = 'post';

	/**
	 * [$taxonomies description]
	 * @var array
	 */
	private $taxonomies = array( 'category', 'post_tag' );

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_blog';
		$this->title       = esc_html__( 'Blog', 'landinghub-core' );
		$this->scripts     = array( 'packery-mode', 'flickity' );
		$this->icon        = 'la la-pencil';
		$this->show_settings_on_create        = true;
		$this->description = esc_html__( 'Latest Posts listing', 'landinghub-core' );

		require_once vc_path_dir( 'CONFIG_DIR', 'grids/vc-grids-functions.php' );
		if ( 'vc_get_autocomplete_suggestion' === vc_request_param( 'action' ) || 'vc_edit_form' === vc_post_param( 'action' ) ) {
			add_filter( 'vc_autocomplete_'. $this->slug . '_include_callback', array( $this, 'include_field_search' ) ); // Get suggestion(find). Must return an array
			add_filter( 'vc_autocomplete_'. $this->slug . '_include_render', 'vc_include_field_render' ); // Render exact product. Must return an array (label,value)

			// Narrow data taxonomies
			add_filter( 'vc_autocomplete_'. $this->slug . '_taxonomies_callback', array( $this,'autocomplete_taxonomies_field_search' ) );
			add_filter( 'vc_autocomplete_'. $this->slug . '_taxonomies_render', 'vc_autocomplete_taxonomies_field_render' );

			// Narrow data taxonomies for exclude_filter
			add_filter( 'vc_autocomplete_'. $this->slug . '_exclude_callback', array( $this, 'exclude_field_search' ) ); // Get suggestion(find). Must return an array
			add_filter( 'vc_autocomplete_'. $this->slug . '_exclude_render', 'vc_exclude_field_render' ); // Render exact product. Must return an array (label,value)
			
			// Filter Cats
			add_filter( 'vc_autocomplete_'. $this->slug . '_filter_cats_callback', array( $this,'autocomplete_taxonomies_field_search' ) );
			add_filter( 'vc_autocomplete_'. $this->slug . '_filter_cats_render', 'vc_autocomplete_taxonomies_field_render' );
		}
		
		add_action( 'pre_get_posts', array( $this, 'query_offset' ), 1 );
		add_filter( 'found_posts', array( $this, 'adjust_offset_pagination' ), 1, 2 );

		parent::__construct();
	}

	protected function get_post_type_list() {

		$postTypesList[] = array(
			$this->post_type,
			esc_html__( 'Posts', 'landinghub-core' ),
		);

		$postTypesList[] = array(
			'custom',
			esc_html__( 'Custom query', 'landinghub-core' ),
		);

		$postTypesList[] = array(
			'ids',
			esc_html__( 'List of IDs', 'landinghub-core' ),
		);

		return $postTypesList;
	}

	public function get_params() {

		$url = liquid_addons()->plugin_uri() . 'assets/img/sc-preview/blog/';
		
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

		$general = array(
			array(
				'type'       => 'select_preview',
				'heading'    => esc_html__( 'Style', 'landinghub-core' ),
				'param_name' => 'style',
				'value'      => array(

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
						'label' => esc_html__( 'Style 2 Alt', 'landinghub-core' ),
						'value' => 'style02-alt',
						'image' => $url . 'style02-alt.jpg'
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
						'label' => esc_html__( 'Style 6 Alt', 'landinghub-core' ),
						'value' => 'style06-alt',
						'image' => $url . 'style06-alt.jpg'
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
						'label' => esc_html__( 'Style 9', 'landinghub-core' ),
						'value' => 'style09',
						'image' => $url . 'style09.jpg'
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
					array(
						'label' => esc_html__( 'Style 15', 'landinghub-core' ),
						'value' => 'style15',
						'image' => $url . 'style15.jpg'
					),
					array(
						'label' => esc_html__( 'Style 16', 'landinghub-core' ),
						'value' => 'style16',
						'image' => $url . 'style16.jpg'
					),
					array(
						'label' => esc_html__( 'Style 17', 'landinghub-core' ),
						'value' => 'style17',
						'image' => $url . 'style17.jpg'
					),
					array(
						'label' => esc_html__( 'Style 18', 'landinghub-core' ),
						'value' => 'style18',
						'image' => $url . 'style18.jpg'
					),
					array(
						'label' => esc_html__( 'Style 19', 'landinghub-core' ),
						'value' => 'style19',
						'image' => $url . 'style19.jpg'
					),
					array(
						'label' => esc_html__( 'Style 20', 'landinghub-core' ),
						'value' => 'style20',
						'image' => $url . 'style20.jpg'
					),
					array(
						'label' => esc_html__( 'Style 21', 'landinghub-core' ),
						'value' => 'style21',
						'image' => $url . 'style21.jpg'
					),
					array(
						'label' => esc_html__( 'Style 22', 'landinghub-core' ),
						'value' => 'style22',
						'image' => $url . 'style22.jpg'
					),
					array(
						'label' => esc_html__( 'Style 22 Alt', 'landinghub-core' ),
						'value' => 'style22-alt',
						'image' => $url . 'style22.jpg'
					),
					array(
						'label' => esc_html__( 'Style 23', 'landinghub-core' ),
						'value' => 'style23',
						'image' => $url . 'style23.jpg'
					),
					
				),
				'description' => esc_html__( 'Select the desired blog layout', 'landinghub-core' ),
				'admin_label' => true,
				'save_always' => true,
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'enable_filter',
				'heading'    => esc_html__( 'Post Filters', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Disable', 'landinghub-core' ) => 'no',
					esc_html__( 'Enable', 'landinghub-core' ) => 'yes',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'grid_columns',
				'heading'    => esc_html__( 'Columns', 'landinghub-core' ),
				'value'      => array(
					'1 Column'  => '1',
					'2 Columns' => '2',
					'3 Columns' => '3',
					'4 Columns' => '4',
				),
				'dependency'  => array(
					'element' => 'style',
					'value_not_equal_to' => array(
						'style05',
						'style07',
						'style14',
						'style15',
						'style18',
						'style22'
					),
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'items_height',
				'heading'    => esc_html__( 'Items Height', 'landinghub-core' ),
				'value'      => array(
					'Full Height'  => 'fullheight',
					'75% of Column Width (Wide)' => 'h-pt-75',
					'100% of Column Width (Square)' => 'h-pt-100',
					'125% of Column Width (Tall)' => 'h-pt-125',
				),
				'dependency'  => array(
					'element' => 'style',
					'value' => array( 'style17' ),
				),
				'std' => 'fullheight',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'show_meta',
				'heading'     => esc_html__( 'Post Meta', 'landinghub-core' ),
				'description' => esc_html__( 'Show/Hide post meta ( tags, categories )', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Show', 'landinghub-core' ) => 'yes',
					esc_html__( 'Hide', 'landinghub-core' ) => 'no'
				),
				'default' => 'yes',
				'dependency'  => array(
					'element' => 'style',
					'value_not_equal_to' => array(
						'style18'
					),
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'meta_type',
				'heading'     => esc_html__( 'Meta Type', 'landinghub-core' ),
				'description' => esc_html__( 'Type Of Post Meta To Show', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Tags', 'landinghub-core' ) => 'tags',
					esc_html__( 'Categories', 'landinghub-core' ) => 'cats'
				),
				'dependency'         => array(
					'element' => 'show_meta',
					'value'   => 'yes'
				),
				'default' => 'tags',
				'edit_field_class' => 'vc_col-sm-6',
			),
			
			array(
				'type'        => 'dropdown',
				'param_name'  => 'one_category',
				'heading'     => esc_html__( 'Show Only One Post Meta', 'landinghub-core' ),
				'description' => esc_html__( 'Enable to show one category/tag', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Enable', 'landinghub-core' ) => 'yes',
					esc_html__( 'Disable', 'landinghub-core' ) => 'no'
				),
				'default'     => 'yes',
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'         => array(
					'element' => 'show_meta',
					'value'   => 'yes'
				),
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'post_excerpt_length',
				'heading'     => esc_html__( 'Excerpt Length', 'landinghub-core' ),
				'description' => esc_html__( 'Set the excerpt length. Leave blank to set default ( 20 words )', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'style',
					'value_not_equal_to' => array(
						'style01',
						'style02',
						'style02-alt',
						'style03',
						'style04',
						'style06',
						'style10',
						'style19',
					),
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'dropdown',
				'heading'    => esc_html__( 'Pagination', 'landinghub-core' ),
				'param_name' => 'pagination',
				'value' => array(
					esc_html__( 'None', 'landinghub-core' ) => 'none',
					esc_html__( 'Ajax', 'landinghub-core' )        => 'ajax',
					esc_html__( 'Classic Pagination', 'landinghub-core' ) => 'pagination',
				),
				'description' => esc_html__( 'Select posts pagination style.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
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
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Data Source', 'landinghub-core' ),
				'param_name'  => 'post_type',
				'value'       => $this->get_post_type_list(),
				'save_always' => true,
				'description' => esc_html__( 'Select content type for your grid.', 'landinghub-core' ),
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Total Items', 'landinghub-core' ),
				'param_name' => 'posts_per_page',
				'value'      => 10,
				// default value
				'param_holder_class' => 'vc_not-for-custom',
				'description'        => esc_html__( 'Set max limit for items in grid or enter -1 to display all (limited to 1000).', 'landinghub-core' ),
				'dependency'         => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					),
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'el_id',
				'param_name' => 'filter_id',
				'settings' => array(
					'auto_generate' => true,
				),
				'heading'     => esc_html__( 'Filter ID', 'landinghub-core' ),
				'description' =>  wp_kses_post( __( 'Enter Filter ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'landinghub-core' ) ),
			),

			// Custom query tab
			array(
				'type'        => 'textarea_safe',
				'heading'     => esc_html__( 'Custom query', 'landinghub-core' ),
				'param_name'  => 'custom_query',
				'description' => __( 'Build custom query according to <a href="http://codex.wordpress.org/Function_Reference/query_posts">WordPress Codex</a>.', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'post_type',
					'value' => array( 'custom' ),
				),
			),
			array(
				'type'       => 'autocomplete',
				'heading'    => esc_html__( 'Narrow data source', 'landinghub-core' ),
				'param_name' => 'taxonomies',
				'settings'   => array(
					'multiple'   => true,
					'min_length' => 3,
					'groups'     => true,
					'no_hide'    => true, // In UI after select doesn't hide an select list
					'unique_values'  => true,
					'display_inline' => true,
					'delay'      => 500,
					'auto_focus' => true,
				),
				'param_holder_class' => 'vc_not-for-custom',
				'description' => esc_html__( 'Enter categories, tags or custom taxonomies.', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					),
				),
			),
			array(
				'type'        => 'autocomplete',
				'heading'     => esc_html__( 'Include only', 'landinghub-core' ),
				'param_name'  => 'include',
				'description' => esc_html__( 'Add posts, pages, etc. by title.', 'landinghub-core' ),
				'settings'    => array(
					'multiple' => true,
					'sortable' => true,
					'groups'   => true,
					'no_hide'  => true, // In UI after select doesn't hide an select list
				),
				'dependency'   => array(
					'element' => 'post_type',
					'value' => array( 'ids' ),
				),
			),

			array(
				'type'        => 'subheading',
				'param_name'  => 'show_title_typo',
				'heading'     => esc_html__( 'Columns Spacing', 'landinghub-core' ),
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'columns_gap',
				'heading'     => esc_html__( 'Side Spacing', 'landinghub-core' ),
				'description' => esc_html__( 'Select gap between columns.', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 50,
				'step'        => 1,
				'std'         => 15,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'bottom_gap',
				'heading'     => esc_html__( 'Bottom Spacing', 'landinghub-core' ),
				'description' => esc_html__( 'Bottom gap between columns', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 100,
				'step'        => 1,
				'std'         => 30,
				'edit_field_class' => 'vc_col-sm-6',
			),

			//Typo options
			array(
				'type'        => 'subheading',
				'param_name'  => 'h_title_typo',
				'heading'     => esc_html__( 'Title Typography', 'landinghub-core' ),
				'group'       => 'Typography'
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'title_size',
				'heading'     => esc_html__( 'Title Size', 'landinghub-core' ),
				'description' => esc_html__( 'Add size in pixels/em e.g 15px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'group'       => 'Typography'
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'title_weight',
				'heading'     => esc_html__( 'Title Weight', 'landinghub-core' ),
				'description' => esc_html__( 'Add title weight', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'group'       => 'Typography'
			),
			array(
				'type'        => 'subheading',
				'param_name'  => 'h_custom_spacing',
				'heading'     => esc_html__( 'Heading Custom Spacing', 'landinghub-core' ),
				'group'       => 'Typography'
			),
			array(
				'type'             => 'checkbox',
				'param_name'       => 'heading_custom_spacing',
				'value'            => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'heading'          => esc_html__( 'Enable Custom Spacing', 'landinghub-core' ),
				'group'       => 'Typography'
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'title_mt',
				'heading'     => esc_html__( 'Title Top Margin', 'landinghub-core' ),
				'description' => esc_html__( 'Add top spacing to the title', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 50,
				'step'        => 1,
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'   => array(
					'element' => 'heading_custom_spacing',
					'value' => array( 'yes' ),
				),
				'group'       => 'Typography'
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'title_mb',
				'heading'     => esc_html__( 'Title Bottom Margin', 'landinghub-core' ),
				'description' => esc_html__( 'Add bottom spacing to the title', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 50,
				'step'        => 1,
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'   => array(
					'element' => 'heading_custom_spacing',
					'value' => array( 'yes' ),
				),
				'group'       => 'Typography'
			),
			array(
				'type'        => 'subheading',
				'param_name'  => 'excerpt_typography',
				'heading'     => esc_html__( 'Excerpt Typography', 'landinghub-core' ),
				'group'       => 'Typography',
				'dependency' => array(
					'element' => 'style',
					'value'   => array(
						'style08',
						'style09',
						'style11',
						'style12',
						'style13',
						'style15',
						'style16',
						'style20',
						'style22',
						'style23',
					),
				),
			),
			//Typo Options
			array(
				'type'        => 'textfield',
				'param_name'  => 'fs',
				'heading'     => esc_html__( 'Font Size', 'landinghub-core' ),
				'description' => esc_html__( 'Example: 20px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3 vc_column-with-padding',
				'dependency' => array(
					'element' => 'style',
					'value'   => array(
						'style08',
						'style09',
						'style11',
						'style12',
						'style13',
						'style15',
						'style16',
						'style20',
						'style22',
						'style23',
					),
				),
				'group' => esc_html__( 'Typography', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'lh',
				'heading'     => esc_html__( 'Line-Height', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'style',
					'value'   => array(
						'style08',
						'style09',
						'style11',
						'style12',
						'style13',
						'style15',
						'style16',
						'style20',
						'style22',
						'style23',
					),
				),
				'group' => esc_html__( 'Typography', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'fw',
				'heading'     => esc_html__( 'Font Weight', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'style',
					'value'   => array(
						'style08',
						'style09',
						'style11',
						'style12',
						'style13',
						'style15',
						'style16',
						'style20',
						'style22',
						'style23',
					),
				),
				'group' => esc_html__( 'Typography', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'ls',
				'heading'     => esc_html__( 'Letter Spacing', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'style',
					'value'   => array(
						'style08',
						'style09',
						'style11',
						'style12',
						'style13',
						'style15',
						'style16',
						'style20',
						'style22',
						'style23',
					),
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
					'element' => 'style',
					'value'   => array(
						'style08',
						'style09',
						'style11',
						'style12',
						'style13',
						'style15',
						'style16',
						'style20',
						'style22',
						'style23',
					),
				),
				'group' => esc_html__( 'Typography', 'landinghub-core' ),
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
				'group' => esc_html__( 'Typography', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'style',
					'value'   => array(
						'style08',
						'style09',
						'style11',
						'style12',
						'style13',
						'style15',
						'style16',
						'style20',
						'style22',
						'style23',
					),
				),
				'std'         => 'yes',
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'excerpt_font',
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
			
			
			// Design Options
			array(
				'type'        => 'subheading',
				'param_name'  => 't_color',
				'heading'     => esc_html__( 'Contents Colors', 'landinghub-core' ),
				'group'       => 'Design Options'
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true, 
				'param_name'  => 'title_color',
				'heading'     => esc_html__( 'Title Color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'group'       => 'Design Options'
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true, 
				'param_name'  => 'hover_title_color',
				'heading'     => esc_html__( 'Hover Title Color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group'       => 'Design Options'
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true, 
				'param_name'  => 'underline_color',
				'heading'     => esc_html__( 'Underline Color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'group'       => 'Design Options',
				'dependency' => array(
					'element' => 'style',
					'value'   => array(
						'style18'
					),
				),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true, 
				'param_name'  => 'hover_underline_color',
				'heading'     => esc_html__( 'Hover Underline Color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'group'       => 'Design Options',
				'dependency' => array(
					'element' => 'style',
					'value'   => array(
						'style13',
						'style18',
						'style19'
					),
				),
			),
			
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true, 
				'param_name'  => 'excerpt_color',
				'heading'     => esc_html__( 'Excerpt Color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'dependency' => array(
					'element' => 'style',
					'value'   => array(
						'style08',
						'style09',
						'style11',
						'style12',
						'style13',
						'style15',
						'style16',
						'style20',
						
					),
				),
				'group'       => 'Design Options'
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true, 
				'param_name'  => 'btn_color',
				'heading'     => esc_html__( 'Button Color', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'style',
					'value'   => array(
						'style16',
						'style17',
						
					),
				),
				'group'       => 'Design Options'
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true, 
				'param_name'  => 'hover_btn_color',
				'heading'     => esc_html__( 'Hover Button Color', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'style',
					'value'   => array(
						'style16',
						'style17',
						
					),
				),
				'group'       => 'Design Options'
			),
			array(
				'type'        => 'subheading',
				'param_name'  => 'bg_color_subh',
				'heading'     => esc_html__( 'Background Colors', 'landinghub-core' ),
				'dependency'   => array(
					'element' => 'style',
					'value' => array( 'style03', 'style09', 'style10', 'style11', 'style21' ),
				),
				'group'       => 'Design Options'
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'bg_color',
				'heading'     => esc_html__( 'Background Color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'dependency'   => array(
					'element' => 'style',
					'value' => array( 'style21' ),
				),
				'group'       => 'Design Options'
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'overlay_color',
				'heading'     => esc_html__( 'Overlay Color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'   => array(
					'element' => 'style',
					'value' => array( 'style02-alt', 'style03', 'style09', 'style10', 'style11', 'style17', 'style21' ),
				),
				'group'       => 'Design Options'
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
				'type'        => 'colorpicker',
				'param_name'  => 'filter_normal_color',
				'heading'     => esc_html__( 'Color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the filter items', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4'				
			),
			array(
				'type'        => 'colorpicker',
				'param_name'  => 'filter_hover_color',
				'heading'     => esc_html__( 'Hover/Active color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the filter hover/active item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4'				
			),
			array(
				'type'        => 'colorpicker',
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
					esc_html__( 'Large', 'landinghub-core' )   => 'size-lg h2',
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
				'type'        => 'liquid_slider',
				'param_name'  => 'filter_mb',
				'heading'     => esc_html__( 'Filter Margin Bottom', 'landinghub-core' ),
				'description' => esc_html__( 'Add bottom margin to the filter', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 100,
				'step'        => 1,
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
				'type'       => 'textfield',
				'param_name' => 'filter_subtitle',
				'heading'    => esc_html__( 'Filter subtitle', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'style',
					'value' => 'carousel-filterable'
				),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'link_label',
				'heading'     => esc_html__( 'Button Label', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'style',
					'value' => 'carousel-filterable'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'id'               => 'link',
				'description'      => esc_html__( 'Please, set the link to show the button', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'style',
					'value' => 'carousel-filterable'
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

		);

		foreach( $filter as &$param ) {
			$param['group'] = esc_html__( 'Filter', 'landinghub-core' );
			$param['dependency'] = array(
				'element' => 'enable_filter',
				'value' => array( 'yes' )
			);
		}

		$data = array(
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Order By', 'landinghub-core' ),
				'param_name' => 'orderby',
				'value' => array(
					esc_html__( 'Date', 'landinghub-core' )                  => 'date',
					esc_html__( 'Order by post ID', 'landinghub-core' )      => 'ID',
					esc_html__( 'Author', 'landinghub-core' )                => 'author',
					esc_html__( 'Title', 'landinghub-core' )                 => 'title',
					esc_html__( 'Last modified date', 'landinghub-core' )    => 'modified',
					esc_html__( 'Post/page parent ID', 'landinghub-core' )   => 'parent',
					esc_html__( 'Number of comments', 'landinghub-core' )    => 'comment_count',
					esc_html__( 'Menu order/Page Order', 'landinghub-core' ) => 'menu_order',
					esc_html__( 'Meta value', 'landinghub-core' )            => 'meta_value',
					esc_html__( 'Meta value number', 'landinghub-core' )     => 'meta_value_num',
					esc_html__( 'Random order', 'landinghub-core' )          => 'rand',
				),

				'description'        => esc_html__( 'Select order type. If "Meta value" or "Meta value Number" is chosen then meta key is required.', 'landinghub-core' ),
				'group'              => esc_html__( 'Data', 'landinghub-core' ),
				'param_holder_class' => 'vc_grid-data-type-not-ids',
				'dependency'         => array(
					'element'            => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom'
					)
				)
			),

			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Sort Order', 'landinghub-core' ),
				'param_name' => 'order',
				'group'      => esc_html__( 'Data', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Descending', 'landinghub-core' ) => 'DESC',
					esc_html__( 'Ascending', 'landinghub-core' ) => 'ASC',
				),
				'param_holder_class' => 'vc_grid-data-type-not-ids',
				'description'        => esc_html__( 'Select sorting order.', 'landinghub-core' ),
				'dependency'         => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					)
				)
			),

			array(
				'type'               => 'textfield',
				'heading'            => esc_html__( 'Meta key', 'landinghub-core' ),
				'param_name'         => 'meta_key',
				'description'        => esc_html__( 'Input meta key for grid ordering.', 'landinghub-core' ),
				'group'              => esc_html__( 'Data', 'landinghub-core' ),
				'param_holder_class' => 'vc_grid-data-type-not-ids',
				'dependency' => array(
					'element' => 'orderby',
					'value'   => array(
						'meta_value',
						'meta_value_num',
					)
				)
			),

			array(
				'type'           => 'textfield',
				'heading'        => esc_html__( 'Offset', 'landinghub-core' ),
				'param_name'     => 'offset',
				'description'    => esc_html__( 'Number of grid elements to displace or pass over.', 'landinghub-core' ),
				'group'          => esc_html__( 'Data', 'landinghub-core' ),
				'param_holder_class' => 'vc_grid-data-type-not-ids',
				'dependency' => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					)
				)
			),

			array(
				'type'        => 'autocomplete',
				'heading'     => esc_html__( 'Exclude', 'landinghub-core' ),
				'param_name'  => 'exclude',
				'description' => esc_html__( 'Exclude posts, pages, etc. by title.', 'landinghub-core' ),
				'group'       => esc_html__( 'Data', 'landinghub-core' ),
				'settings' => array(
					'multiple' => true,
					'no_hide'  => true, // In UI after select doesn't hide an select list
				),
				'param_holder_class' => 'vc_grid-data-type-not-ids',
				'dependency'  => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					),
					'callback' => 'vc_grid_exclude_dependency_callback'
				)
			),
			
			array(
				'type' => 'el_id',
				'settings' => array(
					'auto_generate' => true,
				),
				'heading'     => esc_html__( 'Unique ID', 'landinghub-core' ),
				'param_name'  => 'unique_id',
				'description' => esc_html__( 'Unique ID need for ajax load more posts functionality', 'landinghub-core' ),
				'group'       => esc_html__( 'Extras', 'landinghub-core' ),
			),
			
		);

		$this->params = array_merge( $general, $filter, $data );

		$this->add_extras();
	}
	
	/**
	 * [before_output description]
	 * @method before_output
	 * @param  [type]        $atts    [description]
	 * @param  [type]        $content [description]
	 * @return [type]                 [description]
	 */
	public function before_output( $atts, &$content ) {

		if( 'style15' === $atts['style'] ) {
			$atts['template'] = 'carousel-filterable';
		}

		return $atts;
	}

	// https://codex.wordpress.org/Making_Custom_Queries_using_Offset_and_Pagination
	// check it
	protected function build_query() {

		extract( $this->atts );
		$settings = array();

		if( 'custom' === $post_type && ! empty( $custom_query ) ) {
			$query = html_entity_decode( vc_value_from_safe( $custom_query ), ENT_QUOTES, 'utf-8' );
			$settings = wp_parse_args( $query );
		}
		elseif( 'ids' === $post_type ) {

			if ( empty( $include ) ) {
				$include = - 1;
			}

			$incposts = wp_parse_id_list( $include );
			$settings = array(
				'post__in' => $incposts,
				'posts_per_page' => count( $incposts ),
				'post_type' => 'any',
				'orderby' => 'post__in',
			);
		}
		else {
			$settings = array(
				'posts_per_page' => isset( $posts_per_page ) ? (int) $posts_per_page : 100,
				'offset'         => $offset,
				'orderby' => $orderby,
				'order' => $order,
				'meta_key' => in_array( $orderby, array(
					'meta_value',
					'meta_value_num',
				) ) ? $meta_key : '',
				'post_type' => $post_type,
				'ignore_sticky_posts' => true,
			);

			if( $exclude ) {
				$settings['post__not_in'] = wp_parse_id_list( $exclude );
			}

			/*if( intval( $offset ) ) {
				$settings['no_found_rows'] = intval( $offset );
			}*/

			if( 'none' === $pagination ) {
				$settings['no_found_rows'] = true;
			}
			else {
				$settings['paged'] = ld_helper()->get_paged();
			}

			if ( $settings['posts_per_page'] < 1 ) {
				$settings['posts_per_page'] = 1000;
			}

			if ( ! empty( $taxonomies ) ) {

				$terms = get_terms( $this->taxonomies, array(
					'hide_empty' => false,
					'include' => $taxonomies,
				) );
				$settings['tax_query'] = array();
				$tax_queries = array(); // List of taxnonimes
				foreach ( $terms as $t ) {
					if ( ! isset( $tax_queries[ $t->taxonomy ] ) ) {
						$tax_queries[ $t->taxonomy ] = array(
							'taxonomy' => $t->taxonomy,
							'field' => 'id',
							'terms' => array( $t->term_id ),
							'relation' => 'IN',
						);
					} else {
						$tax_queries[ $t->taxonomy ]['terms'][] = $t->term_id;
					}
				}
				$settings['tax_query'] = array_values( $tax_queries );
				$settings['tax_query']['relation'] = 'OR';
			}
		}

		return $settings;
	}

	// Entry Helper ------------------------------------------------
	
	public function query_offset( &$query ) {
		
		//Before anything else, make sure this is the right query...
		if ( ! $query->is_home() || empty( $this->atts['offset'] ) ) {
		    return;
		}

		$offset = $this->atts['offset'];
		$ppp = isset( $this->atts['posts_per_page'] ) ? (int) $this->atts['posts_per_page'] : 100;

		if ( $query->is_paged ) {
		    $page_offset = $offset + ( ( $query->query_vars['paged'] - 1 ) * $ppp );
			$query->set( 'offset', $page_offset );
		}
		else {		
			$query->set( 'offset', $offset );
		}
	}

	public function adjust_offset_pagination( $found_posts, $query ) {

		if ( empty( $this->atts['offset'] ) ) {
		    return $found_posts;
		}
		
		$offset = $this->atts['offset'];

		if ( $query->is_home() ) {
		    return $found_posts - $offset;
		}

		return $found_posts;
	}

	protected function entry_title( $classes = '' ) {
		
		$style = $this->atts['style'];
		
		$format = get_post_format();
		if ( 'link' !== $format && is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
			return;
		}

		$url = 'link' == $format ? liquid_helper()->get_option( 'post-link-url' ) : get_permalink();
		$target = 'link' == $format ? 'target="_blank"' : '';
		
		the_title( sprintf( '<h2 class="entry-title lqd-lp-title %s"><a ' . $target . ' href="%s" rel="bookmark">', $classes, esc_url( $url ) ), '</a></h2>' );

		
	}
	
	protected function overlay_link() {
		
		$format = get_post_format();
		$url = 'link' == $format ? liquid_helper()->get_option( 'post-link-url' ) : get_permalink();
		$target = 'link' == $format ? 'target="_blank"' : '';
		
		echo '<a ' . $target . ' href="' . esc_url( $url ) . '" class="lqd-lp-overlay-link lqd-overlay z-index-2"></a>';

	}

	public function excerpt_lengh( $length ) {

		if( !isset( $this->atts['post_excerpt_length'] ) ) {
			return '20';
		}
		return $this->atts['post_excerpt_length'];
	}

	public function excerpt_more( $more ) {

		if( !isset( $this->atts['post_excerpt_length'] ) ) {
			return $more;
		}
		return '';

	}
	
	public function clean_excerpt() {
		return false;
	}

	protected function entry_content( $class = '' ) {

		$style = $this->atts['style'];
		
		if( empty( $class ) ) {
			$class = 'lqd-lp-excerpt w-80 mb-3';
		}

		if( !is_single() ) :

	?>
			<div class="<?php echo $class; ?>">
				<?php
					add_filter( 'excerpt_length', array( $this, 'excerpt_lengh' ), 999 );
					add_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );
					add_filter( 'liquid_dinamic_css_output', array( $this, 'clean_excerpt' ) );
					the_excerpt();
					remove_filter( 'liquid_dinamic_css_output', array( $this, 'clean_excerpt' ) ); ?>
			</div><!-- /.latest-post-excerpt -->
		<?php else: ?>
			<div class="entry-content">
			<?php
				/* translators: %s: Name of current post */
				the_content( sprintf(
					__( 'Continue reading %s', 'landinghub-core' ),
					the_title( '<span class="screen-reader-text">', '</span>', false )
				) );

				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'landinghub-core' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'landinghub-core' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				) );
			?>
	    </div>
	<?php endif;

	}

	protected function entry_cats() {

		$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'landinghub-core' ) );

		if ( $categories_list ) {
			printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
				_x( 'Categories', 'Used before category names.', 'landinghub-core' ),
				$categories_list
			);
		}
	}

	protected function entry_tags( $classes = '' ) {
		
		$show_meta = $this->atts['show_meta'];
		if( 'no' === $show_meta ) {
			return;
		}
		
		global $post;
		
		$out = '';
		
		$meta_type    = $this->atts['meta_type'];
		$one_category = $this->atts['one_category'];
		$style = $this->atts['style'];
		
		$tags_list = wp_get_post_tags( $post->ID );
		
		$rel = 'rel="tag"';
		
		if( 'cats' === $meta_type ) {
			$tags_list = get_the_category( $post->ID );	
			$rel = 'rel="category"';
		}		
		
		$before       = '<ul class="lqd-lp-cat ' . esc_attr( $classes ) . '">';
		$after        = '</ul>';
		$before_link  = '<li>';
		$after_link   = '</li>';
		$before_label = '';
		$after_label  = '';
		
		if ( $tags_list ) {			
			$out .= $before;
			if( 'yes' === $one_category ) {
				if( 'style05' == $this->atts['style'] ) {
					$out .= '<li class="border-radius-5"><a class="lh-1" href="' . get_category_link( $tags_list['0']->term_id ) . '" ' . $rel . '>' . $before_label . esc_html( $tags_list['0']->name ) . $after_label . '</a></li>';
				}
				elseif( 'style01' == $this->atts['style'] || 'style02' == $this->atts['style'] || 'style02-alt' == $this->atts['style'] || 'style03' == $this->atts['style'] || 'style06' == $this->atts['style'] || 'style06-alt' == $this->atts['style'] || 'style11' == $this->atts['style'] || 'style15' == $this->atts['style'] || 'style23' == $this->atts['style'] ) {
					$out .= '<li><a class="lh-15 circle" href="' . get_category_link( $tags_list['0']->term_id ) . '" ' . $rel . '>' . $before_label . esc_html( $tags_list['0']->name ) . $after_label . '</a></li>';
				}
				elseif( 'style10' == $this->atts['style'] ) {
					$out .= '<li><a class="lh-15 round" href="' . get_category_link( $tags_list['0']->term_id ) . '" ' . $rel . '>' . $before_label . esc_html( $tags_list['0']->name ) . $after_label . '</a></li>';
				}
				else {
					$out .= '<li><a href="' . get_category_link( $tags_list['0']->term_id ) . '" ' . $rel . '>' . $before_label . esc_html( $tags_list['0']->name ) . $after_label . '</a></li>';
				}
				
			}
			else {
				foreach( $tags_list as $tag ) {
					if( 'style05' == $this->atts['style'] ) {
						$out .= '<li class="border-radius-5"><a href="' . get_category_link( $tag->term_id ) . '" ' . $rel . '>' . $before_label . esc_html( $tag->name ) . $after_label . '</a></li>';
					}
					elseif( 'style01' == $this->atts['style'] || 'style02' == $this->atts['style'] || 'style02-alt' == $this->atts['style'] || 'style03' == $this->atts['style'] || 'style06' == $this->atts['style'] || 'style06-alt' == $this->atts['style'] || 'style11' == $this->atts['style'] || 'style15' == $this->atts['style'] || 'style23' == $this->atts['style'] ) {
						$out .= '<li><a class="lh-15 circle" href="' . get_category_link( $tag->term_id ) . '" ' . $rel . '>' . $before_label . esc_html( $tag->name ) . $after_label . '</a></li>';
					}
					elseif( 'style10' == $this->atts['style'] ) {
						$out .= '<li><a class="round" href="' . get_category_link( $tag->term_id ) . '" ' . $rel . '>' . $before_label . esc_html( $tag->name ) . $after_label . '</a></li>';
					}
					else {
						$out .= '<li><a href="' . get_category_link( $tag->term_id ) . '" ' . $rel . '>' . $before_label . esc_html( $tag->name ) . $after_label . '</a></li>';
					}
				}				
			}
			$out .= $after;
		}
		
		if( $out ) {
			printf( '<div><span class="screen-reader-text">%1$s </span>%2$s</div>',
				_x( 'Tags', 'Used before tag names.', 'landinghub-core' ),
				$out
			);
		}
		
	}
	
	protected function get_grid_class() {

		$column = $this->atts['grid_columns'];
		$hash = array(
			'1' => '12',
			'2' => '6',
			'3' => '4',
			'4' => '3',
			'6' => '2'
		);

		if ( ! empty( $hash[ $column ] ) ) {
			$col = $hash[ $column ];
			if ( $col !== '12' ) {
				$col .= ' col-sm-6';
			}
			return sprintf( 'col-md-%s', $col );
		}

		return 'col-md-12';

	}

	protected function entry_author( $avatar_size = false ) {

		$format = get_post_format();
		if ( 'link' === $format && ! is_single() ) {
			return;
		}

		$svg_icon = '';
		$style = $this->atts['style'];

		if( 'text-date' === $style ) {
			$svg_icon = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve" width="12" stroke="#a7a9b8">
							<path fill="none" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M12,12L12,12 c-2.761,0-5-2.239-5-5V6c0-2.761,2.239-5,5-5h0c2.761,0,5,2.239,5,5v1C17,9.761,14.761,12,12,12z" stroke-linejoin="miter"></path>
							<path data-color="color-2" fill="none" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M22,20.908 c0-1.8-1.197-3.383-2.934-3.856C17.172,16.535,14.586,16,12,16s-5.172,0.535-7.066,1.052C3.197,17.525,2,19.108,2,20.908V23h20 V20.908z" stroke-linejoin="miter"></path>
						</svg>';
		}

		printf( '<span class="author vcard"><span class="screen-reader-text">%1$s </span><a class="url fn n" href="%2$s">%4$s%3$s</a> </span>',
			_x( 'Author', 'Used before post author name.', '_' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			get_the_author(),
			$svg_icon
		);
	}
	
	protected function entry_time() {

		printf( '<time class="lqd-lp-date pos-rel z-index-2" datetime="%s">', get_the_date( 'c' ) );
		echo liquid_helper()->liquid_post_date();
		echo '</time>';
		
		
	}

	protected function entry_time_to_read() {

		$time_to_read = liquid_helper()->get_option( 'post-time-read' );
		if( empty( $time_to_read ) ) {
			return;
		}

		printf( '<span class="post-time-read"><i class="fa fa-book"></i> %s</span>',
				esc_html( $time_to_read )
		);

	}
	
	/**
	 * [entry_term_classes description]
	 * @method entry_term_classes
	 * @return [type]             [description]
	 */
	protected function entry_term_classes() {

		$postcats = get_the_category();
		$cat_slugs = array();
		if ( count( $postcats ) > 0 ) :
			foreach ( $postcats as $postcat ):
				$cat_slugs[] = 	$postcat->slug;
			endforeach;
		endif;
		
		return implode( ' ', $cat_slugs );
		

	}

	protected function entry_comments() {

		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments">';
			comments_popup_link( __( '<i class="fa fa-comment"></i>No Opinions', 'landinghub-core' ), __( '<i class="fa fa-comment"></i>1 Opinion', 'landinghub-core' ), __( '<i class="fa fa-comment"></i>% Opinions', 'landinghub-core' ) );
			echo '</span>';
		}
	}
	
	protected function entry_thumbnail( $size = 'liquid-thumbnail', $attr = '', $background = false ) {
		
		//Check
		if ( post_password_required() || is_attachment() ) {
			return;
		}
		$figure_classnames = '';
		
		if( 'rounded' === $this->atts['style'] ) {
			$figure_classnames = 'rounded';
		}
		elseif( 'square' === $this->atts['style'] ) {
			$figure_classnames = 'round';
		}		
		
		$src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', false );
		$src = liquid_get_resized_image_src( $src, $size );		
		
		$format = get_post_format();
		$style = $this->atts['style'];
		$url = 'link' == $format ? liquid_helper()->get_option( 'post-link-url' ) : get_permalink();
		$target = 'link' == $format ? 'target="_blank"' : '';
		
		if( has_post_thumbnail() ) {

			if( 'style01' == $this->atts['style'] ) {
				printf( '<div class="lqd-lp-img"><figure class="border-radius-2 overflow-hidden">' );
				liquid_the_post_thumbnail( 'liquid-style1-lb', array( 'class' => 'w-100' ), true );
				echo '</figure></div>';
			}
			elseif( 'style02-alt' == $this->atts['style'] ) {
				printf( '<div class="lqd-lp-img lqd-overlay w-100 h-100"><figure class="w-100 h-100 overflow-hidden">' );	
				liquid_the_post_thumbnail( 'liquid-style3-lb', array( 'class' => 'w-100' ), true );
				echo '<div class="lqd-lp-content-bg lqd-overlay"></div>';
				echo '</figure></div>';
			}
			elseif( 'style03' == $this->atts['style'] ) {
				printf( '<div class="lqd-lp-img mb-5"><figure class="pos-rel overflow-hidden border-radius-5">' );	
				liquid_the_post_thumbnail( 'liquid-style1-lb', array( 'class' => 'w-100' ), true );
				echo '<div class="lqd-overlay align-items-center justify-content-center">
			<div class="lqd-overlay lqd-overlay-bg"></div><!-- /.lqd-overlay lqd-overlay-bg -->
			<i class="lqd-icn-ess icon-md-arrow-forward"></i>
		</div><!-- /.lqd-overlay align-items-center justify-content-center -->';
				echo '</figure></div>';
			}
			elseif( 'style04' == $this->atts['style'] ) {
				printf( '<div class="lqd-lp-img w-25"><figure class="pos-rel overflow-hidden border-radius-5">' );	
				liquid_the_post_thumbnail( 'liquid-style4-lb', array( 'class' => 'w-100' ), true );
				echo '</figure></div>';
			}
			elseif( 'style05' == $this->atts['style'] ) {
				printf( '<div class="lqd-lp-img mb-5 mb-md-0 w-md-50 w-100"><figure class="overflow-hidden border-radius-5">' );	
				liquid_the_post_thumbnail( 'liquid-style5-lb', array( 'class' => 'w-100' ), true );
				echo '</figure></div>';
			}
			elseif( 'style06' == $this->atts['style'] ) {
				printf( '<figure>' );	
				liquid_the_post_thumbnail( 'liquid-style6-lb', array( 'class' => 'w-100' ), true );
				echo '</figure>';
			}
			elseif( 'style06-alt' == $this->atts['style'] || 'style23' == $this->atts['style'] ) {
				printf( '<figure>' );	
				liquid_the_post_thumbnail( 'liquid-style6-alt-lb', array( 'class' => 'w-100' ), true );
				echo '</figure>';
			}
			elseif( 'style07' == $this->atts['style'] ) {
				printf( '<div class="lqd-lp-img overflow-hidden border-radius-5 mb-6"><figure>' );	
				liquid_the_post_thumbnail( 'liquid-style5-lb', array( 'class' => 'w-100' ), true );
				echo '</figure></div>';
			}
			elseif( 'style09' == $this->atts['style'] ) {
				liquid_the_post_thumbnail( 'liquid-style9-lb', array( 'class' => 'w-100' ), true );
			}
			elseif( 'style10' == $this->atts['style'] ) {
				printf( '<div class="lqd-lp-img lqd-overlay"><figure class="pos-rel bg-cover bg-center w-100">' );	
				liquid_the_post_thumbnail( 'liquid-style5-lb', array( 'class' => 'w-100' ), true );
				echo '</figure></div>';
			}
			elseif( 'style11' == $this->atts['style'] ) {
				printf( '<div class="lqd-lp-img lqd-overlay"><figure class="pos-rel bg-cover bg-center w-100">' );	
				liquid_the_post_thumbnail( 'liquid-style5-lb', array( 'class' => 'w-100' ), true );
				echo '</figure></div>';
			}
			elseif( 'style13' == $this->atts['style'] ) {
				printf( '<figure class="pos-rel overflow-hidden">' );	
				liquid_the_post_thumbnail( 'liquid-style13-lb', array( 'class' => 'w-100' ), true );
				echo '</figure>';
			}
			elseif( 'style14' == $this->atts['style'] ) {
				printf( '<figure class="pos-rel bg-cover bg-center w-100">' );	
				liquid_the_post_thumbnail( 'liquid-style5-lb', array( 'class' => 'w-100' ), true );
				echo '</figure>';
			}
			elseif( 'style17' == $this->atts['style'] ) {
				printf( '<figure class="pos-rel bg-cover bg-center w-100">' );	
				liquid_the_post_thumbnail( 'liquid-style18-lb', array( 'class' => 'w-100' ), true );
				echo '</figure>';
			}
			elseif( 'style16' == $this->atts['style'] ) {
				printf( '<figure class="pos-rel bg-cover bg-center w-100">' );	
				liquid_the_post_thumbnail( $size, array( 'class' => 'w-100' ), true );
				echo '</figure>';
			}
			elseif( 'style18' == $this->atts['style'] ) {
				printf( '<figure>' );	
				liquid_the_post_thumbnail( 'liquid-style18-lb', array( 'class' => 'w-100' ), true );
				echo '</figure>';
			}
			elseif( 'style19' == $this->atts['style'] ) {
				printf( '<figure class="pos-rel overflow-hidden">' );	
				liquid_the_post_thumbnail( 'liquid-style1-lb', array( 'class' => 'w-100' ), true );
				echo '</figure>';
			}
			elseif( 'style20' == $this->atts['style'] ) {
				printf( '<figure class="pos-rel">' );	
				liquid_the_post_thumbnail( 'liquid-style1-lb', array( 'class' => 'w-100' ), true );
				echo '</figure>';
			}
			elseif( 'style21' == $this->atts['style'] ) {
				printf( '<figure class="pos-abs pos-tl w-100 h-100">' );
				liquid_the_post_thumbnail( 'liquid-style1-lb', array( 'class' => 'w-100' ), true );
				echo '<div class="lqd-overlay align-items-center justify-content-center"><i class="lqd-icn-ess icon-md-arrow-forward"></i></div><!-- /.lqd-overlay align-items-center justify-content-center -->';
				echo '</figure>';
			}
			elseif( 'style22' == $this->atts['style'] || 'style22-alt' == $this->atts['style'] ) {
					printf( '<figure>' );
					liquid_the_post_thumbnail( $size, array( 'class' => 'w-100' ), true );
					echo '</figure>';
			}
			else {
				printf( '<figure class="lqd-lp-img %s">', $figure_classnames );
				liquid_the_post_thumbnail( $size, $attr, true );
				echo '</figure>';
				
			}

		}
	
	}

	// AJAX Helpers ------------------------------------------------

	/**
	 * @param $search_string
	 *
	 * @return array
	 */
	public function include_field_search( $search_string ) {
		$query = $search_string;
		$data = array();
		$args = array(
			's' => $query,
			'post_type' => $this->post_type,
		);
		$args['vc_search_by_title_only'] = true;
		$args['numberposts'] = - 1;
		if ( 0 === strlen( $args['s'] ) ) {
			unset( $args['s'] );
		}
		add_filter( 'posts_search', 'vc_search_by_title_only', 500, 2 );
		$posts = get_posts( $args );
		if ( is_array( $posts ) && ! empty( $posts ) ) {
			foreach ( $posts as $post ) {
				$data[] = array(
					'value' => $post->ID,
					'label' => $post->post_title
				);
			}
		}

		return $data;
	}

	/**
	 * @param $data_arr
	 *
	 * @return array
	 */
	function exclude_field_search( $data_arr ) {

		$term = isset( $data_arr['term'] ) ? $data_arr['term'] : '';
		$data = array();
		$args = array(
			's' => $term,
			'post_type' => $this->post_type,
		);
		$args['vc_search_by_title_only'] = true;
		$args['numberposts'] = - 1;
		if ( 0 === strlen( $args['s'] ) ) {
			unset( $args['s'] );
		}
		add_filter( 'posts_search', 'vc_search_by_title_only', 500, 2 );
		$posts = get_posts( $args );
		if ( is_array( $posts ) && ! empty( $posts ) ) {
			foreach ( $posts as $post ) {
				$data[] = array(
					'value' => $post->ID,
					'label' => $post->post_title
				);
			}
		}

		return $data;
	}
	
	protected function get_button() {

		if ( empty( $this->atts['link_label'] ) ) {
			return;
		}

		$classes = array(
			'btn', 
			'btn-sm', 
			'btn-solid', 
			'border-none',
			'circle',
			'wide',
			'btn-hover-reveal',
			'lh-175', 
		);
		$attributes = liquid_get_link_attributes( $this->atts['link'], '#' );
		$attributes['class'] = ld_helper()->sanitize_html_classes( $classes );
		
		echo '<a' . ld_helper()->html_attributes( $attributes ) . '>
				<span>
					<span class="btn-txt">' . esc_html( $this->atts['link_label'] ) . '</span>
					<span class="btn-icon">
						<i class="lqd-icn-ess icon-md-arrow-round-forward"></i>
					</span>
				</span>
			</a>';
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
			'search' => $search_string,
		) );
		if ( is_array( $vc_taxonomies ) && ! empty( $vc_taxonomies ) ) {
			foreach ( $vc_taxonomies as $t ) {
				if ( is_object( $t ) ) {
					$data[] = vc_get_term_object( $t );
				}
			}
		}

		return $data;
	}

	public function generate_css() {
		
		extract( $this->atts );
		
		$elements     = array();
		$id = '.' .$this->get_id();
		$excerpt_font_inline_style = '';
		/*
		if( 'yes' !== $use_theme_fonts ) {

			// Build the data array
			$excerpt_font_data = $this->get_fonts_data( $excerpt_font );

			// Build the inline style
			$excerpt_font_inline_style = $this->google_fonts_style( $excerpt_font_data );

			// Enqueue the right font
			$this->enqueue_google_fonts( $excerpt_font_data );

		}
		*/
		$elements[ liquid_implode( '%1$s .lqd-lp-excerpt' ) ] = array( $excerpt_font_inline_style );
		$elements[ liquid_implode( '%1$s .lqd-lp-excerpt' ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ liquid_implode( '%1$s .lqd-lp-excerpt' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ liquid_implode( '%1$s .lqd-lp-excerpt' ) ]['font-weight'] = !empty( $fw ) ? $fw : '';
		$elements[ liquid_implode( '%1$s .lqd-lp-excerpt' ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';
		$elements[ liquid_implode( '%1$s .lqd-lp-excerpt' ) ]['text-transform'] = !empty( $transform ) ? $transform : '';
		
		if ( !empty( $excerpt_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-lp-excerpt' ) ]['color'] = $excerpt_color;
		}
		if ( !empty( $btn_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-lp-read-more' ) ]['color'] = $btn_color;
		}
		if ( !empty( $hover_btn_color ) ) {
			$elements[ liquid_implode( '%1$s:hover .lqd-lp-read-more' ) ]['color'] = $hover_btn_color;
		}
		
		if( isset( $columns_gap ) ) {
			$gap = $columns_gap . 'px';
	
			$elements[ liquid_implode( '%1$s .lqd-lp-row' ) ] = array(
				'margin-inline-start' => '-' . $gap,
				'margin-inline-end' => '-' . $gap
			);
			
			$elements[ liquid_implode( '%1$s .lqd-lp-column' ) ] = array(
				'padding-inline-start' => $gap,
				'padding-inline-end' => $gap
			);
		}
		if( isset( $bottom_gap ) ) { 
			$elements[ liquid_implode( '%1$s .lqd-lp-column' ) ]['margin-bottom']  = $bottom_gap .'px';
		}
		
		if ( !empty( $title_size ) ) {
			$elements[ liquid_implode( '%1$s .lqd-lp .lqd-lp-title' ) ]['font-size'] = $title_size;
		}
		if ( !empty( $title_weight ) ) {
			$elements[ liquid_implode( '%1$s .lqd-lp .lqd-lp-title' ) ]['font-weight'] = $title_weight . '!important';
		}
		if ( isset( $title_mt ) && '0' !== $title_mt ) {
			$elements[ liquid_implode( '%1$s .lqd-lp .lqd-lp-title' ) ]['margin-top'] = $title_mt . 'px !important';
		}
		if ( isset( $title_mb ) && '0' !== $title_mb ) {
			$elements[ liquid_implode( '%1$s .lqd-lp .lqd-lp-title' ) ]['margin-bottom'] = $title_mb . 'px !important';
		}
		if ( !empty( $title_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-lp .lqd-lp-title a' ) ]['color'] = $title_color;
		}
		if( !empty( $hover_title_color ) ) {
			if  ( $style === 'style18' ) {
				$elements[ liquid_implode( '%1$s .lqd-lp .lqd-lp-title a:hover' ) ]['color'] = $hover_title_color;
			} else {
				$elements[liquid_implode( '%1$s .lqd-lp:hover .lqd-lp-title a' )]['color'] = $hover_title_color;
			}
		}
		if( !empty( $underline_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-lp h2 .split-inner:before' ) ]['background'] = $underline_color;
		}
		if( !empty( $hover_underline_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-lp h2 .split-inner:after' ) ]['background'] = $hover_underline_color;
		}
		
		if ( !empty( $overlay_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-lp .lqd-lp-content-bg, %1$s .lqd-lp .lqd-lp-img .lqd-overlay' ) ]['background'] = $overlay_color;
		}

		if ( !empty( $bg_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-lp' ) ]['background'] = $bg_color;
		}
		

		$this->dynamic_css_parser( $id, $elements );

	}

	public function generate_post_css() {
		
		$elements     = array();
		$id           = '.post-' . get_the_ID();

		$this->dynamic_css_parser( $id, $elements );

	}
}
new LD_Blog;