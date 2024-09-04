<?php
/**
* Shortcode Liquid Carousel
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Carousel_Falcate extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug         = 'ld_carousel_falcate';
		$this->title        = esc_html__( 'Carousel Falcate', 'landinghub-core' );
		$this->icon         = 'la la-arrows';
		$this->show_settings_on_create = true;
		$this->scripts      = array( 'flickity', 'jquery-momentum' );
		$this->description  = esc_html__( 'Create a carousel falcate.', 'landinghub-core' );
		$this->is_container = true;

		parent::__construct();
	}

	public function get_params() {

		$this->params = array(); 
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

		$this->dynamic_css_parser( $id, $elements );
	}

}
new LD_Carousel_Falcate;
class WPBakeryShortCode_LD_Carousel_Falcate extends WPBakeryShortCodesContainer {}