<?php
/**
* Shortcode Liquid Carousel
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Carousel_Gallery extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug         = 'ld_carousel_gallery';
		$this->title        = esc_html__( 'Mobile Gallery', 'landinghub-core' );
		$this->icon         = 'la la-arrows';
		$this->scripts      = array( 'flickity' );
		$this->show_settings_on_create = true;
		$this->description  = esc_html__( 'Create a mobile gallery.', 'landinghub-core' );

		parent::__construct();
	}

	public function get_params() {
		
		$options = array(
			
			
			array(
				'type'        => 'subheading',
				'heading'     => esc_html__( 'Layout', 'landinghub-core' ),
				'param_name'  => 'sh_layout',
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Initial Index', 'landinghub-core' ),
				'description' => esc_html__( 'Zero-based index of the initial selected cell.', 'landinghub-core' ),
				'param_name'  => 'initialindex',
				'edit_field_class' => 'vc_col-sm-6'
			),

			// Behavior
			array(
				'type'        => 'subheading',
				'heading'     => esc_html__( 'Behavior', 'landinghub-core' ),
				'param_name'  => 'sh_behavior',
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Autoplay', 'landinghub-core' ),
				'description' => esc_html__( 'Automatically advances to the next cell.', 'landinghub-core' ),
				'param_name'  => 'autoplay',
				'value'       => array(
					esc_html__( 'No', 'landinghub-core' )  => '',
					esc_html__( 'Yes', 'landinghub-core' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Autoplay time', 'landinghub-core' ),
				'description' => esc_html__( 'i.e. 1500 will advance cells every 1.5 seconds.', 'landinghub-core' ),
				'param_name'  => 'autoplaytime',
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'autoplay',
					'value'   => array( 'yes' )
				)
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Pause AutoPlay On Hover', 'landinghub-core' ),
				'description' => esc_html__( 'Auto play pause when user hovers over carousel', 'landinghub-core' ),
				'param_name'  => 'pauseautoplayonhover',
				'value'       => array(
					esc_html__( 'No', 'landinghub-core' )  => 'no',
					esc_html__( 'Yes', 'landinghub-core' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'autoplay',
					'value'   => array( 'yes' )
				)
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Draggable', 'landinghub-core' ),
				'description' => esc_html__( 'Enables dragging and flicking.', 'landinghub-core' ),
				'param_name'  => 'draggable',
				'value'       => array(
					esc_html__( 'Yes', 'landinghub-core' ) => '',
					esc_html__( 'No', 'landinghub-core' )  => 'no'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Free Scroll', 'landinghub-core' ),
				'description' => esc_html__( 'Enables content to be freely scrolled.', 'landinghub-core' ),
				'param_name'  => 'freescroll',
				'value'       => array(
					esc_html__( 'No', 'landinghub-core' )  => '',
					esc_html__( 'Yes', 'landinghub-core' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Carousel loop', 'landinghub-core' ),
				'description' => esc_html__( 'Loop for infinite scrolling.', 'landinghub-core' ),
				'param_name'  => 'wraparound',
				'value'       => array(
					esc_html__( 'No', 'landinghub-core' )  => '',
					esc_html__( 'Yes', 'landinghub-core' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
		);
			
		$this->params = array_merge( array(

				// Params goes here
				array(
					'type'        => 'dropdown',
					'param_name'  => 'template',
					'heading'     => esc_html__( 'Style', 'landinghub-core' ),
					'value'       => array(
						esc_html__( 'Mobile', 'landinghub-core' )  => 'mobile',
						esc_html__( 'Laptop', 'landinghub-core' )  => 'device',
					),
				),
				array(
					'type'        => 'attach_images',
					'param_name'  => 'images',
					'heading'     => esc_html__( 'Gallery Images', 'landinghub-core' ),
					'description' => esc_html__( 'Add images to show in the gallery', 'landinghub-core' ),
					'admin_label' => true,
				),
			), $options ); 

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

	protected function columnize_content( &$content ) {

		global $shortcode_tags;

		// Find all registered tag names in $content.
		preg_match_all( '@\[([^<>&/\[\]\x00-\x20=]++)@', $content, $matches );
		$tagnames = array_intersect( array_keys( $shortcode_tags ), $matches[1] );
		$pattern = get_shortcode_regex();
		
		$item_classname = 'carousel-item col-xs-12';

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

	protected function get_options() {

		$opts = array();
		$raw = $this->atts;
		$ids = array(
			'initialindex'         => 'initialIndex',
			'autoplay'             => 'autoPlay',
			'autoplaytime'         => 'autoplaytime',
			'pauseautoplayonhover' => 'pauseAutoPlayOnHover',
			'draggable'            => 'draggable',
			'freescroll'           => 'freeScroll',
			'wraparound'           => 'wrapAround',
			'navappend'            => 'buttonsAppendTo',
			'navarrow'             => 'navArrow',
			'navoffset'            => 'navOffsets',
			
		);

		unset(
			$raw['style'],
			$raw['title'],
			$raw['content'],		
			
			$raw['_id'],
			$raw['el_id'],
			$raw['el_class']
		);

		$raw = array_filter( $raw );
		$custom_opts = $arr = $offset_value = array();

		foreach( $raw as $id => $val ) {

			// Casting
			if( 'yes' === $val ) {
				$val = true;
			}
			if( 'no' === $val || '' === $val ) {
				$val = false;
			}
			if( in_array( $id, array( 'initialindex', 'autoplaytime' ) ) ) {
				$val = intval( $val );
			}

			if( in_array( $id, array( 'prev', 'next', 'navarrow' ) ) ) {
				
				if( 'navarrow' === $id && 'custom' !== $val ){
					$opts[ $ids[ 'navarrow' ] ] = $val;
				}
				else {

					if( 'next' === $id ) {
						$val = !empty( $val ) ? vc_value_from_safe( $val, true ) : '<i class=\"fa fas fa-angle-left\"></i>';
						$custom_opts['next'] = $val;
					}
					if( 'prev' === $id ) {
						$val = !empty( $val ) ? vc_value_from_safe( $val, true ) : '<i class=\"fa fas fa-angle-right\"></i>';
						$custom_opts['prev'] = $val;
					}
					$opts[ $ids[ 'navarrow' ] ] = $custom_opts;
				}
			}
			elseif( 'navoffset' === $id ) {

				$offset_values = explode( ',', $val );

				foreach( $offset_values as $value ) {

					$arr = explode( ':', $value );
					$offset_value[ $arr[0] ] = $arr[1] ;

				}

				$opts[ $ids[ 'navoffset' ] ] = array( 'nav' => $offset_value);

			} 
			elseif( 'prevoffset' === $id )	 {
				if( !empty( $val ) ) {
					$opts[ $ids[ 'navoffset' ] ]['prev'] = $val;	
				}
			}
			elseif( 'nextoffset' === $id )	 {
				if( !empty( $val ) ) {
					$opts[ $ids[ 'navoffset' ] ]['next'] = $val;
				}
			}
			elseif ( 'navappend' === $id ) {

				if ( 'custom_id' === $val && !empty( $opts[ $ids[ 'navappend_id' ] ] ) ) {

					$opts[ $ids[ 'navappend' ] ] = $opts[ $ids[ 'navappend_id' ] ];

				} else {

					$opts[ $ids[ $id ] ] = $val;
					
				}

			}
			else{
				$opts[ $ids[ $id ] ] = $val;
			}

		}

		if( !empty( $opts ) ) {
			echo " data-lqd-flickity='" . stripslashes( wp_json_encode( $opts ) ) ."'";
		}
		else {
			echo " data-lqd-flickity=true";
		}
	}

	protected function generate_css() {

		extract( $this->atts );
		$elements = array();

		$id = '.' . $this->get_id();	

		$this->dynamic_css_parser( $id, $elements );
	}

}
new LD_Carousel_Gallery;