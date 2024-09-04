<?php
/**
* Shortcode Gallery
*/

if( !defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

/**
* RA_Shortcode
*/
class LD_Gallery extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_gallery';
		$this->title       = esc_html__( 'Gallery', 'landinghub-core' );
		$this->icon        = 'la la-square';
		$this->description = esc_html__( 'Create a gallery.', 'landinghub-core' );
		$this->scripts     = array( 'flickity' );
		$this->styles      = array( 'flickity' );

		parent::__construct();
	}

	public function get_params() {

		$this->params = array(

			array(
				'type'        => 'attach_images',
				'param_name'  => 'images',
				'heading'     => esc_html__( 'Gallery Images', 'landinghub-core' ),
				'description' => esc_html__( 'Add images to show in the gallery', 'landinghub-core' )
			),

		);
	}

	protected function get_attachments() {

		$images = explode( ',', $this->atts['images'] );

		if( empty( $images ) ) {
			return;
		}

		$args = array(
			'posts_per_page' => -1,
			'include'        => $images,
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'orderby'        => 'post__in',

			// improve query performance
			'ignore_sticky_posts'    => true,
			'no_found_rows'          => true,
			'update_post_term_cache' => false,
			'update_post_meta_cache' => false
		);

		return get_posts( $args );
	}
}
new LD_Gallery;