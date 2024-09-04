<?php
/**
* Shortcode Tab
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Slideshow_2 extends LD_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug          = 'ld_slideshow_2';
		$this->title         = esc_html__( 'Vertical Slider', 'landinghub-core' );
		$this->description   = esc_html__( 'Create a vertical slider', 'landinghub-core' );
		$this->scripts      = array( 'flickity' );
		$this->icon          = 'la la-random';
		$this->show_settings_on_create = true;
		$this->is_container  = true;
		$this->show_settings_on_create = false;
		$this->js_view       = 'VcBackendTtaTabsView';
		$this->as_parent     = array( 'only' => 'ld_slideshow_section' );
		$this->custom_markup = '<div class="vc_tta-container" data-vc-action="collapse">
			<div class="vc_general vc_tta vc_tta-tabs vc_tta-color-backend-tabs-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-spacing-1 vc_tta-tabs-position-top vc_tta-controls-align-left">
				<div class="vc_tta-tabs-container">'
				. '<ul class="vc_tta-tabs-list">'
					. '<li class="vc_tta-tab" data-vc-tab data-vc-target-model-id="{{ model_id }}" data-element_type="ld_slideshow_section"><a href="javascript:;" data-vc-tabs data-vc-container=".vc_tta" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-target-model-id="{{ model_id }}"><span class="vc_tta-title-text">{{ section_title }}</span></a></li>'
				. '</ul>
				</div>
				<div class="vc_tta-panels vc_clearfix {{container-class}}">
					{{ content }}
				</div>
			</div>
		</div>';
		$this->default_content = '
			[ld_slideshow_section title="' . sprintf( '%s', 'Item 1' ) . '"][/ld_slideshow_section]
			[ld_slideshow_section title="' . sprintf( '%s', 'Item 2' ) . '"][/ld_slideshow_section]';
		$this->admin_enqueue_js = array( vc_asset_url( 'lib/vc_tabs/vc-tabs.min.js' ) );

		parent::__construct();
	}

	/**
	 * Get params
	 * @return array
	 */
	public function get_params() {

		$this->params = array(
			
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_title',
				'heading'     => esc_html__( 'Custom font?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use custom font for menu labels', 'landinghub-core' ),
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
				'group' => esc_html__( 'Menu Typo', 'landinghub-core' ),
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
				'group' => esc_html__( 'Menu Typo', 'landinghub-core' ),
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
				'group' => esc_html__( 'Menu Typo', 'landinghub-core' ),
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
				'group' => esc_html__( 'Menu Typo', 'landinghub-core' ),
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
				'group' => esc_html__( 'Menu Typo', 'landinghub-core' ),
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
				'group'      => esc_html__( 'Menu Typo', 'landinghub-core' ),
				'dependency' => array(
					'element'            => 'use_theme_fonts',
					'value_not_equal_to' => 'yes',
				),
			),
			*/
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'overlay_bg',
				'heading'     => esc_html__( 'Overlay Background', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'color',
				'heading'     => esc_html__( 'Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'hover_color',
				'heading'     => esc_html__( 'Hover Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'height',
				'heading'     => esc_html__( 'Height', 'landinghub-core' ),
				'description' => esc_html__( 'Add height with px, for ex. 45px', 'landinghub-core' ),
			),
			
		);

		$this->add_extras();
	}

	public function before_output( $atts, &$content ) {

		global $liquid_slideshow_items;

		$liquid_accordion_tabs = array();

		//parse ld_tab_section shortcode
		do_shortcode( $content );

		$atts['items'] = $liquid_slideshow_items;

		return $atts;
	}

	protected function get_content() {

		$out = ''; $first = true;

			foreach( $this->atts['items'] as $item ) {

				$out .= '<li class="z-index-3 pt-3 px-3 m-0 pt-md-9 px-md-9 mt-md-4 pos-abs pos-tl '. ( $first ? 'is-active' : '' ) .'">' . $item['content'] . '</li>';
				$first = false;
			}

		echo $out;
	}
	
	protected function get_images() {

		$out = ''; $first = true;

			foreach( $this->atts['items'] as $item ) {
												
				$alt    = get_post_meta( $item['image'], '_wp_attachment_image_alt', true );
				$image  = '<img class="pos-abs pos-tl w-100 h-100" src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="' . wp_get_attachment_image_url( $item['image'], 'full', false  ) . '" alt="' . esc_attr( $alt ) . '" />';

				$out .= '<figure class="pos-abs overflow-hidden '. ( $first ? 'is-active' : '' ) .'">
								' . $image . '
							</figure>';

				$first = false;
			}

		echo $out;
	}
	
	protected function get_nav() {

		$out = ''; $first = true;

			foreach( $this->atts['items'] as $item ) {

				$out .= '<li class="d-flex align-items-end p-4 p-md-8 pos-rel '. ( $first ? 'is-active' : '' ) .'">
							<a class="lqd-webgl-slideshow-link" href="#">
								<span class="d-inline-flex">' . $item['title'] . '</span>
							</a>
						</li>';

				$first = false;
			}

		echo $out;
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
		$id = '.' .$this->get_id();

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
		$elements[ liquid_implode( '%1$s li' ) ] = array( $text_font_inline_style );
		$elements[ liquid_implode( '%1$s li' ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ liquid_implode( '%1$s li' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ liquid_implode( '%1$s li' ) ]['font-weight'] = !empty( $fw ) ? $fw . ' !important' : '';
		$elements[ liquid_implode( '%1$s li' ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';
		
		if( !empty( $overlay_bg ) && isset( $overlay_bg ) ) {
			$elements[ liquid_implode( '%1$s .lqd-slsh-alt-scrn:after' ) ]['background'] = $overlay_bg;
		}
		if( !empty( $color ) && isset( $color ) ) {
			$elements[ liquid_implode( '%1$s a' ) ]['color'] = $color;
		}
		if( !empty( $hover_color ) && isset( $hover_color ) ) {
			$elements[ liquid_implode( '%1$s a:hover' ) ]['color'] = $hover_color;
		}
		if( !empty( $height ) ) {
			$elements[ liquid_implode( '%1$s .lqd-slsh-alt-scrn' ) ]['height'] = $height;
		}


		$this->dynamic_css_parser( $id, $elements );
	}
}
new LD_Slideshow_2;

// Accordion Tab
include_once 'liquid-slideshow-section.php';