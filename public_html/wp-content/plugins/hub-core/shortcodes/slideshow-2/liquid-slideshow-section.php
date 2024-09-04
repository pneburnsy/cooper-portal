<?php
/**
* Shortcode Tab Section
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

// Tab Section Container Class
VcShortcodeAutoloader::getInstance()->includeClass( 'WPBakeryShortCode_VC_Tta_Section' );
class WPBakeryShortCode_Ld_Slideshow_section extends WPBakeryShortCode_VC_Tta_Section {
	/**
	 * @param $width
	 * @param $i
	 *
	 * @return string
	 */
	public function mainHtmlBlockParams( $width, $i ) {
		$sortable = ( vc_user_access_check_shortcode_all( $this->shortcode ) ? 'wpb_sortable' : $this->nonDraggableClass );

		return 'data-element_type="' . $this->settings['base'] . '" class="wpb_' . $this->settings['base'] . ' ' . $sortable . ' wpb_vc_tta_section wpb_content_holder vc_shortcodes_container"' . $this->customAdminBlockParams();
	}
}

/**
* LD_Shortcode
*/
class LD_Slideshow_Section extends LD_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug          = 'ld_slideshow_section';
		$this->title         = esc_html__( 'Slider Section', 'landinghub-core' );
		$this->description   = esc_html__( 'Section for slider.', 'landinghub-core' );
		$this->icon          = 'icon-wpb-ui-tta-section';
		$this->is_container  = true;
		//$this->allowed_container_element = 'vc_row';
		$this->show_settings_on_create = true;
		$this->scripts      = array( 'flickity', 'threejs' );
		$this->as_child      = array( 'only' => 'ld_slideshow_2' );
		// $this->as_parent     = array( 'only' => 'ld_fancy_heading' );
		$this->js_view       = 'VcBackendTtaSectionView';
		$this->custom_markup = '<div class="vc_tta-panel-heading">
		    <h4 class="vc_tta-panel-title vc_tta-controls-icon-position-left"><a href="javascript:;" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-accordion data-vc-container=".vc_tta-container"><span class="vc_tta-title-text">{{ section_title }}</span><i class="vc_tta-controls-icon vc_tta-controls-icon-plus"></i></a></h4>
		</div>
		<div class="vc_tta-panel-body">
			{{ editor_controls }}
			<div class="{{ container-class }}">
			{{ content }}
			</div>
		</div>';

		parent::__construct();
	}

	public function get_params() {
		
		$this->params = array(
			array(
				'type' => 'textfield',
				'param_name' => 'title',
				'heading' => esc_html__( 'Item title', 'js_composer' ),
				'std' => 'Item'
			),
			array(
				'type'       => 'liquid_attach_image',
				'param_name' => 'image',
				'heading'    => esc_html__( 'Image', 'landinghub-core' ),
				'descripton' => esc_html__( 'Add image from gallery or upload new', 'landinghub-core' ),
			),
		);
		
	}

	public function render( $atts, $content = '' ) {

		global $liquid_slideshow_items;

		$atts = vc_map_get_attributes( $this->slug, $atts );
		$atts = $this->before_output( $atts, $content );
		$atts['_id'] = uniqid( $this->slug .'_' );
		$atts['content'] = ld_helper()->do_the_content( $content );

		$liquid_slideshow_items[]  = $atts;
	}
}
new LD_Slideshow_Section;