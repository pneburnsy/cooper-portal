<?php
/**
* Shortcode Header Search
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Header_Search extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_header_search';
		$this->title       = esc_html__( 'Header Search', 'landinghub-core' );
		$this->description = esc_html__( 'Header search form', 'landinghub-core' );
		$this->icon        = 'la la-search';
		$this->category    = esc_html__( 'Header Modules', 'landinghub-core' );

		parent::__construct();
	}

	public function get_params() {
		
		$url = liquid_addons()->plugin_uri() . '/assets/img/sc-preview/header-search/';

		$general = array(
			array(
				'type'       => 'select_preview',
				'heading'    => esc_html__( 'Style', 'landinghub-core' ),
				'param_name' => 'style',
				'value'      => array(

					array(
						'label' => esc_html__( 'Default', 'landinghub-core' ),
						'value' => 'default',
						'image' => $url . 'default.jpg',
					),
					array(
						'label' => esc_html__( 'Frame', 'landinghub-core' ),
						'value' => 'frame',
						'image' => $url . 'frame.jpg',								
					),
					array(
						'label' => esc_html__( 'Slide Top', 'landinghub-core' ),
						'value' => 'slide-top',
						'image' => $url . 'slidetop.jpg',
					),
					array(
						'label' => esc_html__( 'Zoom Out', 'landinghub-core' ),
						'value' => 'zoom-out',
						'image' => $url . 'zoomout.jpg',
					),

				),
				'description' => esc_html__( 'Select search type for the header', 'infinite-addons' ),
				'admin_label' => true,
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'search_type',
				'heading'    => esc_html__( 'Search by', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'All', 'landinghub-core' )    => 'all',
					esc_html__( 'Post', 'landinghub-core' )  => 'post',
					esc_html__( 'Product', 'landinghub-core' )  => 'product',
					esc_html__( 'Custom', 'landinghub-core' ) => 'custom',
				),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'custom_search_type',
				'heading'     => esc_html__( 'Custom post type', 'landinghub-core' ),
				'description' => esc_html__( 'Enter the custom post type slug.', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'search_type',
					'value' => array( 'custom' ),
				),
			),
			array(
				'type'       => 'subheading',
				'param_name' => 'show_hide_parts',
				'heading'    => esc_html__( 'Show/Hide Parts', 'landinghub-core' ),
			),
			array(
				'type'        => 'liquid_button_set',
				'param_name'  => 'show_icon',
				'heading'     => esc_html__( 'Show Icon?', 'landinghub-core' ),
				'description' => esc_html__( 'Enable if you want to show the icon.', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Yes', 'landinghub-core' ) => 'lqd-module-show-icon',
					esc_html__( 'No', 'landinghub-core' )  => 'lqd-module-hide-icon',
				),
				'std' => 'lqd-module-show-icon',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'liquid_button_set',
				'param_name'  => 'show_on_mobile',
				'heading'     => esc_html__( 'Show on Mobile', 'landinghub-core' ),
				'description' => esc_html__( 'Enable if you want to display it on mobile devices', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Yes', 'landinghub-core' ) => 'lqd-show-on-mobile',
					esc_html__( 'No', 'landinghub-core' )  => '',
				),
				'std' => '',
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'icon_styling',
				'heading'    => esc_html__( 'Icon Styling', 'landinghub-core' ),
			),
			array(
				'type'        => 'liquid_button_set',
				'param_name'  => 'icon_style',
				'heading'     => esc_html__( 'Icon Style', 'landinghub-core' ),
				'description' => esc_html__( 'Select a style for the icon.', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Plain', 'landinghub-core' ) => 'lqd-module-icon-plain',
					esc_html__( 'Outlined', 'landinghub-core' )  => 'lqd-module-icon-outline',
				),
				'std' => 'lqd-module-icon-plain',
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'extra_texts',
				'heading'    => esc_html__( 'Icon Texts', 'landinghub-core' ),
			),
			array(
				'type'       => 'textarea',
				'param_name' => 'icon_text',
				'heading'    => esc_html__( 'Search Icon Text', 'landinghub-core' ),
				'description' => esc_html__( 'The text will be shown next to the search icon.', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_list',
				'heading'     => esc_html__( 'Custom Font?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use custom font for lists items', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'icon_text',
					'not_empty' => true
				)
			),
			array(
				'type'        => 'liquid_button_set',
				'param_name' => 'icon_text_align',
				'heading'    => esc_html__( 'Icon Text Alignment.', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Left', 'landinghub-core' ) => 'lqd-module-trigger-txt-left',
					esc_html__( 'Right', 'landinghub-core' )  => 'lqd-module-trigger-txt-right',
				),
				'std' => 'lqd-module-trigger-txt-left',
				'dependency' => array(
					'element' => 'icon_text',
					'not_empty' => true
				),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'scheme',
				'heading'     => esc_html__( 'Color Scheme', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Light', 'landinghub-core' ) => '',
					esc_html__( 'Dark', 'landinghub-core' )    => 'lqd-module-search-dark',
				),
				'dependency' => array(
					'element' => 'style',
					'value' => array( 'slide-top' ),
				),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'description',
				'heading'     => esc_html__( 'Description', 'landinghub-core' ),
				'description' => esc_html__( 'Description under serchform', 'landinghub-core' ),
				'std' => 'Type and hit enter',
				'dependency' => array(
					'element' => 'style',
					'value' => array( 'frame', 'slide-top', 'zoom-out' ),
				),
			),
			//Suggestion Fields
			array(
				'type'        => 'textfield',
				'param_name'  => 'suggestions_title',
				'heading'     => esc_html__( 'Title', 'landinghub-core' ),
				'description' => esc_html__( 'Add title for suggestions', 'landinghub-core' ),
				'std' => 'May We Suggest?',
				'dependency' => array(
					'element' => 'style',
					'value' => array( 'frame', 'zoom-out' ),
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),
			array(
				'type'        => 'textarea',
				'param_name'  => 'suggestions',
				'heading'     => esc_html__( 'Suggestion Text', 'landinghub-core' ),
				'description' => esc_html__( 'Add text for suggestions. for ex. #drone #funny #catgif #broken #lost', 'landinghub-core' ),
				'std' => '#drone #funny #catgif #broken #lost',
				'dependency' => array(
					'element' => 'style',
					'value' => array( 'frame', 'zoom-out' ),
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'suggestions_title2',
				'heading'     => esc_html__( 'Title 2', 'landinghub-core' ),
				'description' => esc_html__( 'Add title for suggestions', 'landinghub-core' ),
				'std' => 'Is It This?',
				'dependency' => array(
					'element' => 'style',
					'value' => array( 'frame', 'zoom-out' ),
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),
			array(
				'type'        => 'textarea',
				'param_name'  => 'suggestions2',
				'heading'     => esc_html__( 'Suggestion Text 2', 'landinghub-core' ),
				'description' => esc_html__( 'Add text for suggestions. for ex. #drone #funny #catgif #broken #lost', 'landinghub-core' ),
				'std' => '#drone #funny #catgif #broken #lost',
				'dependency' => array(
					'element' => 'style',
					'value' => array( 'frame', 'zoom-out' ),
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'suggestions_title3',
				'heading'     => esc_html__( 'Title 3', 'landinghub-core' ),
				'description' => esc_html__( 'Add title for suggestions', 'landinghub-core' ),
				'std' => 'Needle, Where Art Thou?',
				'dependency' => array(
					'element' => 'style',
					'value' => array( 'frame' ),
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),
			array(
				'type'        => 'textarea',
				'param_name'  => 'suggestions3',
				'heading'     => esc_html__( 'Suggestion Text 3', 'landinghub-core' ),
				'description' => esc_html__( 'Add text for suggestions. for ex. #drone #funny #catgif #broken #lost', 'landinghub-core' ),
				'std' => '#drone #funny #catgif #broken #lost',				
				'dependency' => array(
					'element' => 'style',
					'value' => array( 'frame' ),
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			//Typo Options
			array(
				'type'        => 'textfield',
				'param_name'  => 'fs_txt',
				'heading'     => esc_html__( 'Font Size', 'landinghub-core' ),
				'description' => esc_html__( 'Example: 20px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3 vc_column-with-padding',
				'dependency' => array(
					'element' => 'use_custom_fonts_list',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Icon Text', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'lh_txt',
				'heading'     => esc_html__( 'Line-Height', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_list',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Icon Text', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'fw_txt',
				'heading'     => esc_html__( 'Font Weight', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_list',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Icon Text', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'ls_txt',
				'heading'     => esc_html__( 'Letter Spacing', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
				'dependency' => array(
					'element' => 'use_custom_fonts_list',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Icon Text', 'landinghub-core' ),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'transform_txt',
				'heading'    => esc_html__( 'Transformation', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Default', 'landinghub-core' )    => '',
					esc_html__( 'Uppercase', 'landinghub-core' )  => 'uppercase',
					esc_html__( 'Lowercase', 'landinghub-core' )  => 'lowercase',
					esc_html__( 'Capitalize', 'landinghub-core' ) => 'capitalize',
				),
				'dependency' => array(
					'element' => 'use_custom_fonts_list',
					'value'   => 'true',
				),
				'group' => esc_html__( 'Icon Text', 'landinghub-core' ),
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'fs',
				'heading'     => esc_html__( 'Icon Size', 'landinghub-core' ),
				'description' => esc_html__( 'Example: 20px', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'primary_color',
				'heading'     => esc_html__( 'Primary Color', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options' ),
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'sticky_colors',
				'heading'    => esc_html__( 'Sticky Colors', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'sticky_primary_color',
				'heading'     => esc_html__( 'Primary Color', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options' ),
			),
			
			array(
				'type'       => 'subheading',
				'param_name' => 'sticky_light_colors',
				'heading'    => esc_html__( 'Colors Over Light Rows', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'sticky_light_primary_color',
				'heading'     => esc_html__( 'Primary Color', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options' ),
			),

			array(
				'type'       => 'subheading',
				'param_name' => 'sticky_dark_colors',
				'heading'    => esc_html__( 'Colors Over Dark Rows', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'sticky_dark_primary_color',
				'heading'     => esc_html__( 'Primary Color', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options' ),
			),
		);
		
		$icon = liquid_get_icon_params( false, '', array( 'fontawesome', 'linea' ), array( 'align', 'margin-inline-start', 'hcolor', 'margin-inline-end' ), 'i_' );
		
		$this->params = array_merge( $general, $icon );

		$this->add_extras();
	}

	public function generate_css() {

		extract($this->atts);

		$elements = array();
		$id = '.' . $this->get_id();
		$out = '';
		
		if( !empty( $fs ) ) {
			$elements['.ld-module-search .ld-module-trigger']['font-size'] = $fs;
		}

		if( !empty( $primary_color ) ) {
			$elements['.ld-module-search .ld-module-trigger']['color'] = $primary_color;	
		}
		
		if( !empty( $i_color ) ) {
			$elements['.ld-module-search .ld-module-trigger-icon i']['color'] = $i_color;
		}
		if( !empty( $i_size ) ) {
			$elements['.ld-module-search .ld-module-trigger-icon i']['font-size'] = $i_size;
		}

		if( !empty( $sticky_primary_color ) ) {
			$elements['.is-stuck .ld-module-search .ld-module-trigger']['color'] = $sticky_primary_color;	
		}

		if( !empty( $sticky_light_primary_color ) ) {
			$elements['.lqd-active-row-light.header-module .ld-module-search .ld-module-trigger']['color'] = $sticky_light_primary_color;	
		}

		if( !empty( $sticky_dark_primary_color ) ) {
			$elements['.lqd-active-row-dark.header-module .ld-module-search .ld-module-trigger']['color'] = $sticky_dark_primary_color;	
		}

		$elements[ liquid_implode( '.ld-module-search .ld-module-trigger-txt' ) ]['font-size'] = !empty( $fs_txt ) ? $fs_txt : '';
		$elements[ liquid_implode( '.ld-module-search .ld-module-trigger-txt' ) ]['line-height'] = !empty( $lh_txt ) ? $lh_txt : '';
		$elements[ liquid_implode( '.ld-module-search .ld-module-trigger-txt' ) ]['font-weight'] = !empty( $fw_txt ) ? $fw_txt : '';
		$elements[ liquid_implode( '.ld-module-search .ld-module-trigger-txt' ) ]['letter-spacing'] = !empty( $ls_txt ) ? $ls_txt : '';
		$elements[ liquid_implode( '.ld-module-search .ld-module-trigger-txt' ) ]['text-transform'] = !empty( $transform_txt ) ? $transform_txt : '';
		
		$this->dynamic_css_parser( $id, $elements );

	}
}
new LD_Header_Search;