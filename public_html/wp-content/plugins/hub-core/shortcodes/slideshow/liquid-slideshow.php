<?php
/**
* Shortcode Liquid Slideshow
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Slideshow extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug         = 'ld_slideshow';
		$this->title        = esc_html__( 'Slideshow', 'landinghub-core' );
		$this->icon         = 'la la-arrows';
		$this->scripts      = array( 'flickity' );
		$this->description  = esc_html__( 'Create a slideshow.', 'landinghub-core' );
		$this->show_settings_on_create = true;

		parent::__construct();
	}

	public function get_params() {
		
		$this->params = array(
			// Params goes here
			array(
				'type'        => 'responsive_columns',
				'param_name'  => 'columns',
				'heading'     => esc_html__( 'Number of Columns', 'landinghub-core' ),
				'std'         => 'md:3|sm:2|xs:1|spacing_xs:15px',
			),
			array(
				'type'       => 'param_group',
				'param_name' => 'identities',
				'heading'    => esc_html__( 'Slides', 'landinghub-core' ),
				'params'     => array(

					array(
						'id' => 'title',
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'description',
						'heading'     => esc_html__( 'Description', 'landinghub-core' ),
						'description' => esc_html__(  'Add description', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'       => 'liquid_attach_image',
						'param_name' => 'image',
						'heading'    => esc_html__( 'Image', 'landinghub-core' ),
						'descripton' => esc_html__( 'Add image from gallery or upload new', 'landinghub-core' ),
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'url',
						'heading'     => esc_html__( 'URL (Link)', 'landinghub-core' ),
						'description' => esc_html__(  'Add link', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
					array(
						'type'        => 'checkbox',
						'param_name'  => 'target',
						'heading'     => esc_html__( 'Open in new tab?', 'landinghub-core' ),
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'btn_label',
						'heading'     => esc_html__( 'Button Label', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					),
				)
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_title',
				'heading'     => esc_html__( 'Custom font?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use custom font for title', 'landinghub-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'overlay_bg',
				'heading'     => esc_html__( 'Overlay Background', 'landinghub-core' ),
				'description' => esc_html__( 'Pick an overlay background', 'landinghub-core' ),
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
				'group'      => esc_html__( 'Typo', 'landinghub-core' ),
				'dependency' => array(
					'element'            => 'use_theme_fonts',
					'value_not_equal_to' => 'yes',
				),
			),
			*/
			
			
		); 
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

	protected function generate_css() {

		extract( $this->atts );
		$elements = array();
	
		$queries_css = '';

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
		$elements[ liquid_implode( '%1$s h2' ) ] = array( $text_font_inline_style );
		$elements[ liquid_implode( '%1$s h2' ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ liquid_implode( '%1$s h2' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ liquid_implode( '%1$s h2' ) ]['font-weight'] = !empty( $fw ) ? $fw : '';
		$elements[ liquid_implode( '%1$s h2' ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';
		$elements[ liquid_implode( '%1$s h2' ) ]['color'] = !empty( $color ) ? $color : '';
		
		if( !empty( $overlay_bg ) ) {
			$elements[ liquid_implode( '%1$s .lqd-slsh-overlay-bg' ) ]['background'] = $overlay_bg;
		}
		
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

		$elements['media']['responsive'] = $queries_css;
		
		

		$this->dynamic_css_parser( $id, $elements );
	}

}
new LD_Slideshow;