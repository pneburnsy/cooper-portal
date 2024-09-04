<?php
/**
* Shortcode Liquid Carousel
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Carousel_Stack extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug         = 'ld_carousel_stack';
		$this->title        = esc_html__( 'Carousel Stack', 'landinghub-core' );
		$this->icon         = 'la la-arrows';
		$this->scripts      = array( 'flickity', 'draggabilly' );
		$this->description  = esc_html__( 'Create a carousel stack.', 'landinghub-core' );
		$this->js_view       = 'VcBackendTtaTabsView';
		$this->as_parent     = array( 'only' => 'ld_carousel_stack_section' );
		$this->custom_markup = '<div class="vc_tta-container" data-vc-action="collapse">
			<div class="vc_general vc_tta vc_tta-tabs vc_tta-color-backend-tabs-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-spacing-1 vc_tta-tabs-position-top vc_tta-controls-align-left">
				<div class="vc_tta-tabs-container">'
				. '<ul class="vc_tta-tabs-list">'
					. '<li class="vc_tta-tab" data-vc-tab data-vc-target-model-id="{{ model_id }}" data-element_type="ld_carousel_stack_section"><a href="javascript:;" data-vc-tabs data-vc-container=".vc_tta" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-target-model-id="{{ model_id }}"><span class="vc_tta-title-text">Tab</span></a></li>'
				. '</ul>
				</div>
				<div class="vc_tta-panels vc_clearfix {{container-class}}">
					{{ content }}
				</div>
			</div>
		</div>';
		$this->default_content = '
			[ld_carousel_stack_section title="Tab"][/ld_carousel_stack_section]
			[ld_carousel_stack_section title="Tab"][/ld_carousel_stack_section]
			[ld_carousel_stack_section title="Tab"][/ld_carousel_stack_section]';
		$this->admin_enqueue_js = array( vc_asset_url( 'lib/vc_tabs/vc-tabs.min.js' ) );

		parent::__construct();
	}

	public function get_params() {

		$this->params = array(); 
		$this->add_extras();
	}
	
	public function before_output( $atts, &$content ) {

		global $liquid_carousel_stack_tabs;

		$liquid_carousel_stack_tabs = array();

		//parse ld_tab_section shortcode
		do_shortcode( $content );

		$atts['items'] = $liquid_carousel_stack_tabs;

		return $atts;
	}
	
	protected function get_content() {

		$out = '';

		if ( $this->atts['items'] ) {
			foreach ( $this->atts[ 'items' ] as $tab ) {
				if ( vc_is_inline() && vc_frontend_editor()->post_shortcodes ) {
					$out .= $tab['content'];
				} else {
					$out .= sprintf( '<div class="carousel-item"><span class="lqd-carousel-handle"></span>%1$s</div>', $tab['content'] );
				}
			}
		} else {
			$out .= vc_container_anchor();
		}

		echo $out;
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
				
				$content = str_replace( $start, '<div class="' . $item_classname . '"><span class="lqd-carousel-handle"></span>' . $start, $content );
				$content = str_replace( $end, $end . '</div>', $content );
			}
			else {
				preg_match_all( '/' . $pattern . '/s', $content, $matches );

				foreach( array_unique( $matches[0] ) as $replace ) {
					$content = str_replace( $replace, '<div class="' . $item_classname . '"><span class="lqd-carousel-handle"></span>' . $replace . '</div>', $content );
				}
			}

		}
	}

	protected function generate_css() {

		extract( $this->atts );
		$elements = array();
		$queries_css = '';

		$id = '.' . $this->get_id();

		$this->dynamic_css_parser( $id, $elements );
	}

}
new LD_Carousel_Stack;
// Carousel stack section
include_once 'liquid-carousel-section.php';