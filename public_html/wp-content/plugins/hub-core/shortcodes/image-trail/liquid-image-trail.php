<?php
/**
* Shortcode Liquid Carousel
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Image_Trail extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug         = 'ld_image_trail';
		$this->title        = esc_html__( 'Image Trail', 'landinghub-core' );
		$this->icon            = 'la la-image';
		$this->description  = esc_html__( 'Create an image trail', 'landinghub-core' );
		$this->show_settings_on_create = true;

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
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Height', 'landinghub-core' ),
				'param_name'       => 'height',
				'value'            => '',
				'description'      => esc_html__( 'Entre height with px, ex. 150px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			//Design Options
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Absolute Position?', 'landinghub-core' ),
				'param_name'  => 'absolute_pos',
				'description' => esc_html__( 'If checked the position will be set absolute', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_col-md-offset-6',
			),
			array(
				'type'       => 'liquid_responsive',
				'heading'    => esc_html__( 'Margin', 'landinghub-core' ),
				'description' => esc_html__( 'Add margins for the element, use px or %', 'landinghub-core' ),
				'css'        => 'margin',
				'param_name' => 'margin',
				'group'      => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			//Position
			array(
				'type'       => 'liquid_responsive',
				'heading'    => esc_html__( 'Position', 'landinghub-core' ),
				'description' => esc_html__( 'Add positions for the element, use px or %', 'landinghub-core' ),
				'css'        => 'position',
				'param_name' => 'position',
				'group'      => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			

		);

		$this->add_extras();
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

	
	protected function generate_css() {
		
		extract( $this->atts );
		$elements = array();

		$id = '.' . $this->get_id();

		if( !empty( $height ) ) {
			$elements[ liquid_implode( '%1$s' ) ]['height'] = $height;
		}
		if( ! empty( $absolute_pos ) ) {
			$elements[ liquid_implode( '%1$s' ) ]['position'] = 'absolute';
		}
		$responsive_pos = Liquid_Responsive_Param::generate_css( 'position', $position, $this->get_id() );
		$elements['media']['position'] = $responsive_pos;

		$responsive_margin = Liquid_Responsive_Param::generate_css( 'margin', $margin, $this->get_id() );
		$elements['media']['margin'] = $responsive_margin;

		$this->dynamic_css_parser( $id, $elements );
	}

}

new LD_Image_Trail;