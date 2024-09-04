<?php
/**
* Shortcode Header Menu
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Header_Image extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_header_image';
		$this->title       = esc_html__( 'Logo', 'landinghub-core' );
		$this->description = esc_html__( 'Add logo', 'landinghub-core' );
		$this->icon        = 'la la-file-image-o';
		$this->category    = esc_html__( 'Header Modules', 'landinghub-core' );

		parent::__construct();

	}
	
	public function get_params() {

		$this->params = array(
			
			
			array(
				'type'        => 'checkbox',
				'param_name'  => 'uselogo',
				'heading'     => esc_html__( 'Use Logo From Theme Options?', 'landinghub-core' ),
				'description' => esc_html__( 'Use logo set in theme options panel', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'std'         => 'yes',
			),
			array(
				'type'       => 'liquid_attach_image',
				'param_name' => 'image',
				'heading'    => esc_html__( 'Image', 'landinghub-core' ),
				'descripton' => esc_html__( 'Add image from gallery or upload new', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'uselogo',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'liquid_attach_image',
				'param_name' => 'retina_image',
				'heading'    => esc_html__( 'Retina Image', 'landinghub-core' ),
				'descripton' => esc_html__( 'Add retina image from gallery or upload new', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'uselogo',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'liquid_attach_image',
				'param_name' => 'light_image',
				'heading'    => esc_html__( 'Light Image', 'landinghub-core' ),
				'descripton' => esc_html__( 'Add image from gallery or upload new', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'uselogo',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'liquid_attach_image',
				'param_name' => 'retina_light_image',
				'heading'    => esc_html__( 'Retina Light Image', 'landinghub-core' ),
				'descripton' => esc_html__( 'Add retina image from gallery or upload new', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'uselogo',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'liquid_attach_image',
				'param_name' => 'dark_image',
				'heading'    => esc_html__( 'Dark Image', 'landinghub-core' ),
				'descripton' => esc_html__( 'Add image from gallery or upload new', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'uselogo',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'liquid_attach_image',
				'param_name' => 'retina_dark_image',
				'heading'    => esc_html__( 'Retina Dark Image', 'landinghub-core' ),
				'descripton' => esc_html__( 'Add retina image from gallery or upload new', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'uselogo',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'liquid_attach_image',
				'param_name' => 'hover_image',
				'heading'    => esc_html__( 'Hover Image', 'landinghub-core' ),
				'descripton' => esc_html__( 'Add image from gallery or upload new', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'uselogo',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'liquid_attach_image',
				'param_name' => 'hover_retina_image',
				'heading'    => esc_html__( 'Hover Retina Image', 'landinghub-core' ),
				'descripton' => esc_html__( 'Add retina image from gallery or upload new', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'uselogo',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'checkbox',
				'param_name'  => 'linkhome',
				'heading'     => esc_html__( 'Link to homepage?', 'landinghub-core' ),
				'description' => esc_html__( 'Link the logo to homepage', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'edit_field_class' => 'vc_col-sm-6',
				'std'         => 'yes',
			),
			array(
				'type'       => 'vc_link',
				'param_name' => 'link',
				'heading'    => esc_html__( 'Url', 'landinghub-core' ),
				'descripton' => esc_html__( 'Input an url for the logo', 'landinghub-core' ),
				'dependency' => array(
					'element'  => 'linkhome',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			
			array(
				'type'        => 'checkbox',
				'param_name'  => 'visiblemobile',
				'heading'     => esc_html__( 'Show Only on Mobile Devices?', 'landinghub-core' ),
				'description' => esc_html__( 'Enable to make logo visible on large screens and only show on mobile.', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'lqd-visible-mobile' ),
				'edit_field_class' => 'vc_col-sm-6',
				'std'         => '',
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'sticky_show_onsticky',
				'heading'     => esc_html__( 'Show Only on Sticky?', 'landinghub-core' ),
				'description' => esc_html__( 'Enable if you want the logo to show when header is sticky.', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'lqd-show-onstuck' ),
				'edit_field_class' => 'vc_col-sm-6',
				'std'         => '',
			),
			
			array(
				'type'        => 'checkbox',
				'param_name'  => 'usestickylogo',
				'heading'     => esc_html__( 'Use Sticky Logo From Theme Options?', 'landinghub-core' ),
				'description' => esc_html__( 'Use sticky logo set in theme options panel', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'std'         => 'yes'
			),
			array(
				'type'       => 'liquid_attach_image',
				'param_name' => 'sticky_image',
				'heading'    => esc_html__( 'Sticky Image', 'landinghub-core' ),
				'descripton' => esc_html__( 'Add image from gallery or upload new for sticky header', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'usestickylogo',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'liquid_attach_image',
				'param_name' => 'retina_sticky_image',
				'heading'    => esc_html__( 'Retina Sticky Image', 'landinghub-core' ),
				'descripton' => esc_html__( 'Add retina image from gallery or upload new for sticky header', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'usestickylogo',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'useshapelogo',
				'heading'     => esc_html__( 'Use Shape for Logo?', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'navbar-brand-solid' ),
				'std'         => ''
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'shape_logo_style',
				'heading'    => esc_html__( 'Shape Logo Style', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Default', 'landinghub-core' ) => '',
					esc_html__( 'Round', 'landinghub-core' )  => 'navbar-brand-round',
					esc_html__( 'Circle', 'landinghub-core' ) => 'navbar-brand-circle',
				),
				'dependency' => array(
					'element' => 'useshapelogo',
					'value'   => 'navbar-brand-solid',
				),
			),
			array( 
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'shape_color',
				'heading'     => esc_html__( 'Shape Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'useshapelogo',
					'value'   => 'navbar-brand-solid',
				),				
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'alignment',
				'heading'    => esc_html__( 'Logo Alignment', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Default', 'landinghub-core' ) => '',
					esc_html__( 'Center', 'landinghub-core' )  => 'justify-content-lg-center',
					esc_html__( 'Right', 'landinghub-core' )   => 'justify-content-lg-end',
				),
			),
			array(
				'type'       => 'subheading',
				'param_name' => 'spacing_subheading',
				'heading'    => esc_html__( 'Spacing', 'landinghub-core' ),
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'padding_top',
				'heading'     => esc_html__( 'Top space', 'landinghub-core' ),
				'description' => esc_html__( 'Add top padding for logo', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 100,
				'step'        => 1,
				'std'         => 30,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'padding_right',
				'heading'     => esc_html__( 'Right space', 'landinghub-core' ),
				'description' => esc_html__( 'Add right padding for logo', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 100,
				'step'        => 1,
				'std'         => 0,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'padding_bottom',
				'heading'     => esc_html__( 'Bottom space', 'landinghub-core' ),
				'description' => esc_html__( 'Add bottom padding for logo', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 100,
				'step'        => 1,
				'std'         => 30,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'padding_left',
				'heading'     => esc_html__( 'Left space', 'landinghub-core' ),
				'description' => esc_html__( 'Add left padding for sticky logo', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 100,
				'step'        => 1,
				'std'         => 0,
				'edit_field_class' => 'vc_col-sm-6',
			),
			
			array(
				'type'       => 'subheading',
				'param_name' => 'sticky_spacing_subheading',
				'heading'    => esc_html__( 'Sticky Spacing', 'landinghub-core' ),
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'sticky_padding_top',
				'heading'     => esc_html__( 'Sticky Top space', 'landinghub-core' ),
				'description' => esc_html__( 'Add top padding for sticky logo', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 100,
				'step'        => 1,
				'std'         => 30,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'sticky_padding_right',
				'heading'     => esc_html__( 'Sticky Right space', 'landinghub-core' ),
				'description' => esc_html__( 'Add right padding for sticky logo', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 100,
				'step'        => 1,
				'std'         => 0,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'sticky_padding_bottom',
				'heading'     => esc_html__( 'Sticky Bottom space', 'landinghub-core' ),
				'description' => esc_html__( 'Add bottom padding for sticky logo', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 100,
				'step'        => 1,
				'std'         => 30,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'sticky_padding_left',
				'heading'     => esc_html__( 'Sticky Left space', 'landinghub-core' ),
				'description' => esc_html__( 'Add left padding for sticky logo', 'landinghub-core' ),
				'min'         => 0,
				'max'         => 100,
				'step'        => 1,
				'std'         => 0,
				'edit_field_class' => 'vc_col-sm-6',
			),

		);
		
		$this->add_extras();

	}
	
	protected function get_image() {
		
		$src         = get_template_directory_uri() . '/assets/img/logo/logo-1.svg';
		$retina_src  = $scrset = '';
		
		$logo = $this->atts['image'];
		$retina_logo = $this->atts['retina_image'];
		
		if( $this->atts['uselogo'] ) {
			$img_array    = liquid_helper()->get_option( 'header-logo' );
			$retina_array = liquid_helper()->get_option( 'header-logo-retina' );
			
			if( is_array( $img_array ) && !empty( $img_array['url'] ) ) {
				$src = esc_url( $img_array['url'] );
			}
			
			if( is_array( $retina_array ) && !empty( $retina_array['url'] ) ) {
				$retina_src = esc_url( $retina_array['url'] );
			}
			else {
				$retina_src = '';
			}
		}
		else {
			if( $logo ) {
				$src = liquid_get_image( $logo, 'full' );
			}
			if( $retina_logo ) {
				$retina_src = liquid_get_image( $retina_logo, 'full' );
			}
		}
		
		$alt = get_bloginfo( 'title' );
		$image_opts = array(
			'class' => 'logo-default',
			'alt' => esc_attr( $alt ),
		);

		if( !empty( $retina_src ) ) {
			$scrset = 'srcset="' . $retina_src . ' 2x"';
		}

		$image = sprintf( '<img class="logo-default" src="%s" alt="%s" %s />', $src, $alt, $scrset );
		
		return $image;

	}
	
	protected function get_sticky_image() {
	
		$src = $retina_src  = $scrset = $image = '';
		
		$logo = $this->atts['sticky_image'];
		$retina_logo = $this->atts['retina_sticky_image'];

		if( $this->atts['usestickylogo'] ) {
			$img_array    = liquid_helper()->get_option( 'header-sticky-logo' );
			$retina_array = liquid_helper()->get_option( 'header-sticky-logo-retina' );
			
			if( is_array( $img_array ) && !empty( $img_array['url'] ) ) {
				$src = esc_url( $img_array['url'] );
			}
			
			if( is_array( $retina_array ) && !empty( $retina_array['url'] ) ) {
				$retina_src = esc_url( $retina_array['url'] );
			}
			else {
				$retina_src = '';
			}
		}
		else {
			if( $logo ) {
				$src = liquid_get_image( $logo, 'full' );
			}
			if( $retina_logo ) {
				$retina_src = liquid_get_image( $retina_logo, 'full' );
			}
		}
		
		$alt = get_bloginfo( 'title' );
		$image_opts = array(
			'class' => 'logo-sticky',
			'alt' => esc_attr( $alt ),
		);

		if( !empty( $retina_src ) ) {
			$scrset = 'srcset="' . $retina_src . ' 2x"';
		}

		if( !empty( $src ) ) {
			$image = sprintf( '<img class="logo-sticky" src="%s" alt="%s" %s />', $src, $alt, $scrset );	
		}
		
		return $image;
		
	}
	
	protected function get_light_image() {
	
		$src = $retina_src  = $scrset = $image = '';
		
		$logo = $this->atts['light_image'];
		$retina_logo = $this->atts['retina_light_image'];

		if( $this->atts['uselogo'] ) {
			$img_array    = liquid_helper()->get_option( 'header-light-logo' );
			$retina_array = liquid_helper()->get_option( 'header-light-logo-retina' );
			
			if( is_array( $img_array ) && !empty( $img_array['url'] ) ) {
				$src = esc_url( $img_array['url'] );
			}
			
			if( is_array( $retina_array ) && !empty( $retina_array['url'] ) ) {
				$retina_src = esc_url( $retina_array['url'] );
			}
			else {
				$retina_src = '';
			}
		}
		else {
			if( $logo ) {
				$src = liquid_get_image( $logo, 'full' );
			}
			if( $retina_logo ) {
				$retina_src = liquid_get_image( $retina_logo, 'full' );
			}
		}
		
		$alt = get_bloginfo( 'title' );
		$image_opts = array(
			'class' => 'logo-sticky',
			'alt' => esc_attr( $alt ),
		);

		if( !empty( $retina_src ) ) {
			$scrset = 'srcset="' . $retina_src . ' 2x"';
		}

		if( !empty( $src ) ) {
			$image = sprintf( '<img class="logo-light" src="%s" alt="%s" %s />', $src, $alt, $scrset );	
		}
		
		return $image;
		
	}
	
	protected function get_dark_image() {
	
		$src = $retina_src  = $scrset = $image = '';
		
		$logo = $this->atts['dark_image'];
		$retina_logo = $this->atts['retina_dark_image'];

		if( $this->atts['uselogo'] ) {
			$img_array    = liquid_helper()->get_option( 'header-dark-logo' );
			$retina_array = liquid_helper()->get_option( 'header-dark-logo-retina' );
			
			if( is_array( $img_array ) && !empty( $img_array['url'] ) ) {
				$src = esc_url( $img_array['url'] );
			}
			
			if( is_array( $retina_array ) && !empty( $retina_array['url'] ) ) {
				$retina_src = esc_url( $retina_array['url'] );
			}
			else {
				$retina_src = '';
			}
		}
		else {
			if( $logo ) {
				$src = liquid_get_image( $logo, 'full' );
			}
			if( $retina_logo ) {
				$retina_src = liquid_get_image( $retina_logo, 'full' );
			}
		}
		
		$alt = get_bloginfo( 'title' );
		$image_opts = array(
			'class' => 'logo-sticky',
			'alt' => esc_attr( $alt ),
		);

		if( !empty( $retina_src ) ) {
			$scrset = 'srcset="' . $retina_src . ' 2x"';
		}

		if( !empty( $src ) ) {
			$image = sprintf( '<img class="logo-dark" src="%s" alt="%s" %s />', $src, $alt, $scrset );	
		}
		
		return $image;
		
	}
	
	protected function get_hover_image() {
		
		 
		$src = $retina_src  = $scrset = $image = '';
		
		$logo = $this->atts['hover_image'];
		$retina_logo = $this->atts['hover_retina_image'];
		
		if( $this->atts['uselogo'] ) {
			$img_array    = liquid_helper()->get_option( 'hover-header-logo' );
			$retina_array = liquid_helper()->get_option( 'hover-header-logo-retina' );
			
			if( is_array( $img_array ) && !empty( $img_array['url'] ) ) {
				$src = esc_url( $img_array['url'] );
			}
			
			if( is_array( $retina_array ) && !empty( $retina_array['url'] ) ) {
				$retina_src = esc_url( $retina_array['url'] );
			}
			else {
				$retina_src = '';
			}
		}
		else {
			if( $logo ) {
				$src = liquid_get_image( $logo, 'full' );
			}
			if( $retina_logo ) {
				$retina_src = liquid_get_image( $retina_logo, 'full' );
			}
		}
		
		$alt = get_bloginfo( 'title' );
		$image_opts = array(
			'class' => 'logo-default',
			'alt' => esc_attr( $alt ),
		);

		if( !empty( $retina_src ) ) {
			$scrset = 'srcset="' . $retina_src . ' 2x"';
		}
		
		if( !empty( $src ) ) {
			$image = sprintf( '<span class="navbar-brand-hover"><img class="logo-default" src="%s" alt="%s" %s /></span>', $src, $alt, $scrset );	
		}
		
		return $image;

	}

	protected function get_mobile_logo() {

		$src = $retina_src = $retina_logo = $logo = $scrset = '';
		
		$img_array    = liquid_helper()->get_option( 'menu-logo' );
		$retina_array = liquid_helper()->get_option( 'menu-logo-retina' );		

		if( empty( $img_array['url'] ) ) {
			return;
		}
		$src = esc_url( $img_array['url'] );
		
		if( is_array( $retina_array ) && !empty( $retina_array['url'] ) ) {
			$retina_src = esc_url( $retina_array['url'] );
		}
		else {
			$retina_src = '';
		}
		
		if( !empty( $retina_src ) ) {
			$scrset	= 'srcset="' . $retina_src . ' 2x"';	
		}
		
		$alt = get_bloginfo( 'title' );
		$image = sprintf( '<img class="mobile-logo-default" src="%s" alt="%s" %s />', $src, $alt, $scrset );
		
		return $image;
		
	}
	
	protected function get_logo() {
		
		$image        = $this->get_image();
		$hover_image  = $this->get_hover_image();
		$sticky_image = $this->get_sticky_image();
		
		$light_image  = $this->get_light_image();
		$dark_image   = $this->get_dark_image();

		if( empty( $image ) ) {
			return;
		}
		
		if( !empty( $mobile_logo ) ) {
			$image = $mobile_logo . $image;
		}
		
		$href = esc_url( home_url( '/' ) );
		$custom_link = liquid_get_link_attributes( $this->atts['link'], false );
		
		if( !empty ( $custom_link['href'] ) && !$this->atts['linkhome'] ) {
			$href = $custom_link['href'];	
		}
		
		printf( '<a class="navbar-brand" href="%s" rel="home"><span class="navbar-brand-inner">%s %s %s %s %s</span></a>', $href, $light_image, $dark_image, $hover_image,$sticky_image, $image ) ;
		
	}

	protected function get_mobile_trigger() {}

	protected function get_shape() {

		$classname = 'navbar-brand-plain';

		if ( 'navbar-brand-solid' === $this->atts['useshapelogo'] ) {
			$classname = 'navbar-brand-solid';
		}

		return $classname;

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

		if( '30' !== $padding_top ) {
			$elements[ liquid_implode( '%1$s' ) ]['padding-top'] = $padding_top . 'px';
		}
		if( '0' !== $padding_right ) {
			$elements[ liquid_implode( '%1$s' ) ]['padding-inline-end'] = $padding_right . 'px';
		}
		if( '30' !== $padding_top ) {
			$elements[ liquid_implode( '%1$s' ) ]['padding-bottom'] = $padding_bottom . 'px';
		}
		if( '0' !== $padding_left ) {
			$elements[ liquid_implode( '%1$s' ) ]['padding-inline-start'] = $padding_left . 'px';
		}
		
		if( '30' !== $sticky_padding_top ) {
			$elements[ liquid_implode( '.is-stuck %1$s' ) ]['padding-top'] = $sticky_padding_top . 'px';
		}
		if( '0' !== $sticky_padding_right ) {
			$elements[ liquid_implode( '.is-stuck %1$s' ) ]['padding-inline-end'] = $sticky_padding_right . 'px';
		}
		if( '30' !== $sticky_padding_top ) {
			$elements[ liquid_implode( '.is-stuck %1$s' ) ]['padding-bottom'] = $sticky_padding_bottom . 'px';
		}
		if( '0' !== $sticky_padding_left ) {
			$elements[ liquid_implode( '.is-stuck %1$s' ) ]['padding-inline-start'] = $sticky_padding_left . 'px';
		}
		
		if( !empty( $shape_color ) ) {
			$elements[ liquid_implode( '%1$s .navbar-brand-inner' ) ]['background'] = $shape_color;
		}
		


		$this->dynamic_css_parser( $id, $elements );

	}

}
new LD_Header_Image;