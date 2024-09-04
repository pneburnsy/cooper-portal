<?php
/**
* Shortcode Carousel Section
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

// Tab Section Container Class
VcShortcodeAutoloader::getInstance()->includeClass( 'WPBakeryShortCode_VC_Tta_Section' );
class WPBakeryShortCode_Ld_carousel_marquee_section extends WPBakeryShortCode_VC_Tta_Section {
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
class LD_Carousel_Marquee_Section extends LD_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug          = 'ld_carousel_marquee_section';
		$this->title         = esc_html__( 'Section', 'landinghub-core' );
		$this->description   = esc_html__( 'Section for Carousel.', 'landinghub-core' );
		$this->icon          = 'la la-columns';
		$this->is_container  = true;
		$this->allowed_container_element = 'vc_row';
		$this->show_settings_on_create = false;
		$this->as_child      = array( 'only' => 'ld_carousel_marquee_tab' );
		$this->js_view       = 'VcBackendTtaSectionView';
		$this->custom_markup = '<div class="vc_tta-panel-heading">
		    <h4 class="vc_tta-panel-title vc_tta-controls-icon-position-left"><a href="javascript:;" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-accordion data-vc-container=".vc_tta-container"><span class="vc_tta-title-text">Section</span><i class="vc_tta-controls-icon vc_tta-controls-icon-plus"></i></a></h4>
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
					'id' => 'title',
					'std' => 'Section',
				),
				array(
					'type' => 'el_id',
					'param_name' => 'tab_id',
					'settings' => array(
						'auto_generate' => true,
					),
					'heading'     => esc_html__( 'Section ID', 'landinghub-core' ),
					'description' =>  wp_kses_post( __( 'Enter section ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'landinghub-core' ) ),
				),
				// CSS
				array(
					'type'        => 'textfield',
					'param_name'  => 'el_class',
					'heading'     => esc_html__( 'Extra class name', 'landinghub-core' ),
					'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'landinghub-core' ),
					'group'       => esc_html__( 'Extras', 'landinghub-core' )
				),
		);
		
	}

	public function render( $atts, $content = '' ) {

		global $liquid_carousel_marquee_tabs;

		$atts = vc_map_get_attributes( $this->slug, $atts );
		$atts = $this->before_output( $atts, $content );
		$atts['_id'] = uniqid( $this->slug .'_' );
		$atts['content'] = ld_helper()->do_the_content( $content, false );

		$action = vc_post_param( 'action' );
		if ( 'vc_load_shortcode' === $action ) {

			return '<div class="carousel-item-inner"><div class="carousel-item-content"><div data-js-panel-body>' . vc_container_anchor() . '</div></div></div>';

		} else {

			if ( vc_is_inline() && vc_frontend_editor()->post_shortcodes ) {

				foreach ( vc_frontend_editor()->post_shortcodes as $shortcode ) {
					$shortcode = (array) json_decode( rawurldecode( $shortcode ) );
					if ( $shortcode[ 'tag' ] === $this->slug && $shortcode[ 'attrs' ]->tab_id === $atts[ 'tab_id' ] ) {
						$shortcode[ 'attrs' ] = (array) $shortcode[ 'attrs' ];
						$atts[ 'shortcode' ]  = (array) $shortcode;
						break;
					}
				}

				$atts[ 'content' ] = ld_helper()->do_the_content( $this->toString( $atts[ 'shortcode' ], $content ), false );
			} else {
				$atts[ 'content' ] = ld_helper()->do_the_content( $content, false );
			}
		}

		$liquid_carousel_marquee_tabs[]  = $atts;
	}

	public function toString( $shortcode, $content ) {
		$shortcode_obj = visual_composer()->getShortCode( $shortcode['tag'] );
		$shortcode = apply_filters( 'vc_frontend_editor_to_string', $shortcode, $shortcode_obj );

		$output = sprintf( '
<div class="vc_element carousel-item" data-tag="%s" data-shortcode-controls="%s" data-model-id="%s">
	<div class="carousel-item-inner"><div class="carousel-item-content"><div data-js-panel-body>%s%s</div></div></div>
</div>',
			esc_attr( $shortcode['tag'] ),
			esc_attr( wp_json_encode( $shortcode_obj->shortcodeClass()->getControlsList() ) ),
			esc_attr( $shortcode['id'] ),
			vc_container_anchor(),
			do_shortcode( $content )
		);

		return $output;
	}
}
new LD_Carousel_Marquee_Section;