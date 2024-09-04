<?php
/**
* Shortcode Liquid Carousel
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_D_Banner extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug         = 'ld_d_banner';
		$this->title        = esc_html__( '3D Banner', 'landinghub-core' );
		$this->icon         = 'la la-arrows';
		$this->scripts      = array( 'flickity', 'jquery-ytplayer', 'wp-mediaelement' );
		$this->description  = esc_html__( 'Create a 3D banner.', 'landinghub-core' );
		$this->show_settings_on_create = true;

		parent::__construct();
	}

	public function get_params() {
		
		$button = vc_map_integrate_shortcode( 'ld_button', 'ib_', esc_html__( 'Button', 'landinghub-core' ),
			array(
				'exclude' => array(
					'el_id',
					'el_class',
					'sh_shadowbox',
					'enable_row_shadowbox',
					'button_box_shadow',
					'hover_button_box_shadow'
				),
			),
			array(
				'element' => 'show_button',
				'value' => 'yes',
			)
		);
		
		$general = array(
			
			array(
				'type'        => 'dropdown',
				'param_name'  => 'template',
				'heading'     => esc_html__( 'Banner type', 'landinghub-core' ),
				'description' => esc_html__( 'Select type of the banner', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'Default', 'landinghub-core' )       => 'image',
					esc_html__( 'Image Gallery', 'landinghub-core' ) => 'gallery',
					esc_html__( 'Video', 'landinghub-core' )         => 'video'
				),
			),
			array(
				'id'          => 'title',
				'edit_field_class' => 'vc_col-sm-8',
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'use_custom_fonts_title',
				'heading'     => esc_html__( 'Custom font?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to use custom font for title', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type'        => 'attach_images',
				'param_name'  => 'images',
				'heading'     => esc_html__( 'Gallery Images', 'landinghub-core' ),
				'description' => esc_html__( 'Add images to show in the gallery', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'template',
					'value'   => 'gallery',
				),
			),
			array(
				'type'       => 'liquid_attach_image',
				'param_name' => 'image',
				'heading'    => esc_html__( 'Image', 'landinghub-core' ),
				'descripton' => esc_html__( 'Add image from gallery or upload new', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'template',
					'value'   => 'image',
				),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'YouTube link', 'landinghub-core' ),
				'param_name'  => 'video_url',
				'value'       => 'https://www.youtube.com/watch?v=cVEemOmHw9Y',
				// default video url
				'description' => esc_html__( 'Add YouTube link.', 'landinghub-core' ),
				'dependency'  => array(
					'element'   => 'template',
					'value' => 'video',
				),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'show_button',
				'heading'    => esc_html__( 'Show Button', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'No', 'landinghub-core' )  => '',
					esc_html__( 'Yes', 'landinghub-core' ) => 'yes'
				),
			),
			array( 
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'revealer_color',
				'heading'     => esc_html__( 'Reveal Background Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
			),
			array( 
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'title_color',
				'heading'     => esc_html__( 'Title Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6'
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
				'group' => esc_html__( 'Title Typo', 'landinghub-core' ),
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
				'group' => esc_html__( 'Title Typo', 'landinghub-core' ),
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
				'group' => esc_html__( 'Title Typo', 'landinghub-core' ),
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
				'group' => esc_html__( 'Title Typo', 'landinghub-core' ),
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
				'group' => esc_html__( 'Title Typo', 'landinghub-core' ),
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
				'group'      => esc_html__( 'Title Typo', 'landinghub-core' ),
				'dependency' => array(
					'element'            => 'use_theme_fonts',
					'value_not_equal_to' => 'yes',
				),
			),
			*/

		);
		
		$this->params = array_merge( $general, $button );
		
		//print_r( $button );
		
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
	
	protected function get_image() {

		// check
		if( empty( $this->atts['image'] ) ) {
			return;
		}
		
		$image_opts = array(
			'class' => 'invisible pos-abs'
		);
		$alt = get_post_meta( $this->atts['image'], '_wp_attachment_image_alt', true );
		
		if( preg_match( '/^\d+$/', $this->atts['image'] ) ){
			$retina_image = wp_get_attachment_image_src( $this->atts['image'], 'full' );
			$image  = wp_get_attachment_image( $this->atts['image'], 'full', false, $image_opts );
		} else {
			$image = '<img class="invisible pos-abs" src="' . esc_url( $this->atts['image'] ) . '" alt="' . esc_attr( $alt ) . '" />';
		}
		
		$image = sprintf( '<figure class="bg-cover bg-center pos-rel" data-responsive-bg="true">%s</figure>', $image );
		
		echo $image;
	}
	
	protected function get_button() {

		if ( empty( $this->atts['show_button'] ) ) {
			return;
		}

		$data = vc_map_integrate_parse_atts( $this->slug, 'ld_button', $this->atts, 'ib_' );
		if ( $data ) {

			$btn = visual_composer()->getShortCode( 'ld_button' )->shortcodeClass();

			if ( is_object( $btn ) ) {
				echo '<div class="lqd-bnr-3d-btn">' . $btn->render( array_filter( $data ) ) . '</div>';
			}
		}
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
		$elements[ liquid_implode( '%1$s .lqd-bnr-3d-heading' ) ] = array( $text_font_inline_style );
		$elements[ liquid_implode( '%1$s .lqd-bnr-3d-heading' ) ]['font-size'] = !empty( $fs ) ? $fs : '';
		$elements[ liquid_implode( '%1$s .lqd-bnr-3d-heading' ) ]['line-height'] = !empty( $lh ) ? $lh : '';
		$elements[ liquid_implode( '%1$s .lqd-bnr-3d-heading' ) ]['font-weight'] = !empty( $fw ) ? $fw . ' !important' : '';
		$elements[ liquid_implode( '%1$s .lqd-bnr-3d-heading' ) ]['letter-spacing'] = !empty( $ls ) ? $ls : '';
		
		if( ! empty( $title_color ) && isset( $title_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-bnr-3d-heading' ) ]['color'] = $title_color;
		}
		if( !empty( $revealer_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-bnr-3d-borders span:before,%1$s .lqd-bnr-3d-borders span:after' ) ]['background'] = $revealer_color;
		}
		

		$this->dynamic_css_parser( $id, $elements );
	}

}
new LD_D_Banner;