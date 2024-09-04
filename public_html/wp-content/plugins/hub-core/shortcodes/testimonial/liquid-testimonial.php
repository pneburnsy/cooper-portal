<?php
/**
* Shortcode Liquid Testimonial
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Testimonial extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_testimonial';
		$this->title       = esc_html__( 'Testimonial', 'landinghub-core' );
		$this->description = esc_html__( 'Add testimonial', 'landinghub-core' );
		$this->icon        = 'la la-comment';
		$this->show_settings_on_create = true;

		parent::__construct();

	}
	
	/**
	 * [get_params description]
	 * @method get_params
	 * @return array()
	 */
	public function get_params() {

		$url = liquid_addons()->plugin_uri() . '/assets/img/sc-preview/testimonial/';

		$this->params = array(

			array(
				'type'       => 'select_preview',
				'param_name' => 'template',
				'heading'    => esc_html__( 'Style', 'landinghub-core' ),
				'value' => array(
					array(
						'value' => 'style01',
						'label' => esc_html__( 'Style 1', 'landinghub-core' ),
						'image' => $url . 'style01.jpg'
					),
					array(
						'label' => esc_html__( 'Style 2', 'landinghub-core' ),
						'value' => 'style02',
						'image' => $url . 'style02.jpg'
					),
					array(
						'label' => esc_html__( 'Style 3', 'landinghub-core' ),
						'value' => 'style03',
						'image' => $url . 'style03.jpg'
					),
					array(
						'label' => esc_html__( 'Style 4', 'landinghub-core' ),
						'value' => 'style04',
						'image' => $url . 'style04.jpg'
					),
					array(
						'label' => esc_html__( 'Style 5', 'landinghub-core' ),
						'value' => 'style05',
						'image' => $url . 'style05.jpg'
					),
					array(
						'label' => esc_html__( 'Style 6', 'landinghub-core' ),
						'value' => 'style06',
						'image' => $url . 'style06.jpg'
					),
					array(
						'label' => esc_html__( 'Style 7', 'landinghub-core' ),
						'value' => 'style07',
						'image' => $url . 'style07.jpg'
					),
					array(
						'label' => esc_html__( 'Style 8', 'landinghub-core' ),
						'value' => 'style08',
						'image' => $url . 'style08.jpg'
					),
					array(
						'label' => esc_html__( 'Style 9', 'landinghub-core' ),
						'value' => 'style09',
						'image' => $url . 'style09.jpg'
					),
					array(
						'label' => esc_html__( 'Style 10', 'landinghub-core' ),
						'value' => 'style10',
						'image' => $url . 'style10.jpg'
					),
					array(
						'label' => esc_html__( 'Style 11', 'landinghub-core' ),
						'value' => 'style11',
						'image' => $url . 'style11.jpg'
					),
					array(
						'label' => esc_html__( 'Style 12', 'landinghub-core' ),
						'value' => 'style12',
						'image' => $url . 'style12.jpg'
					),
					array(
						'label' => esc_html__( 'Style 13', 'landinghub-core' ),
						'value' => 'style13',
						'image' => $url . 'style13.jpg'
					),
					array(
						'label' => esc_html__( 'Style 14', 'landinghub-core' ),
						'value' => 'style14',
						'image' => $url . 'style14.jpg'
					),
					array(
						'label' => esc_html__( 'Style 15', 'landinghub-core' ),
						'value' => 'style15',
						'image' => $url . 'style15.jpg'
					),
					array(
						'label' => esc_html__( 'Style 16', 'landinghub-core' ),
						'value' => 'style16',
						'image' => $url . 'style16.jpg'
					),
					array(
						'label' => esc_html__( 'Style 17', 'landinghub-core' ),
						'value' => 'style17',
						'image' => $url . 'style17.jpg'
					),
				),
			),
			array( 
				'id' => 'title', 
				'heading' => esc_html__( 'Name', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding' 
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'position',
				'heading'     => esc_html__( 'Position', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'liquid_attach_image',
				'param_name'  => 'avatar',
				'heading'     => esc_html__( 'Avatar', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'       => 'textarea_html',
				'param_name' => 'content',
				'holder'     => 'div',
				'heading'    => esc_html__( 'Text', 'landinghub-core' )
			),
			array(
				'type'       => 'subheading',
				'param_name' => 'sh_additional',
				'heading'    => esc_html__( 'Additional', 'landinghub-core' ),
			),
			array(
				'type'        => 'liquid_attach_image',
				'param_name'  => 'image',
				'heading'     => esc_html__( 'Client Image', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'template',
					'value'   => array( 'style05', 'style16' ),
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'       => 'liquid_slider',
				'param_name' => 'rating',
				'heading'    => esc_html__( 'Rating/Stars', 'landinghub-core' ),
				'min'        => 0,
				'max'        => 5,
				'step'       => 1,
				'std'        => 0,
				'dependency'  => array(
					'element' => 'template',
					'value'   => array( 'style02', 'style05', 'style09', 'style11' ),
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'date_time',
				'heading'     => esc_html__( 'Data/Time', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'template',
					'value'   => array( 'style04' ),
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'id' => 'network',
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'  => array(
					'element' => 'template',
					'value'   => array( 'style03', 'style04', 'style08', 'style07' ),
				),
			),
			
			//Design Options
			array(
				'type'       => 'liquid_responsive',
				'heading'    => esc_html__( 'Margin', 'landinghub-core' ),
				'description' => esc_html__( 'Add margins for the element, use px or %', 'landinghub-core' ),
				'css'        => 'margin',
				'param_name' => 'margin',
				'group'      => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-md-6',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'bg_color',
				'heading'     => esc_html__( 'Background color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the background', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'template',
					'value_not_equal_to'   => array( 'style12', 'style13', 'style14' ),
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'border_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Border color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for borders', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'template',
					'value'   => array( 'style09', 'style15' ),
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'secondary_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Secondary color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a secondary color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'template',
					'value'   => array( 'style10', 'style12', 'style16' ),
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'text_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Text color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the testimonial text', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'title_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Title color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the title', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'pos_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Position color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the position', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'star_color',
				'only_solid'  => true,
				'heading'     => esc_html__( 'Star/Rating color', 'landinghub-core' ),
				'description' => esc_html__( 'Pick a color for the star/rating', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency'  => array(
					'element' => 'template',
					'value'   => array( 'style02', 'style05', 'style09', 'style11' ),
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			
			
		);

		$this->add_extras();
	}

	/**
	 * [get_avatar description]
	 * @method get_avatar
	 */
	protected function get_avatar( $classnames = null ) {

		// check
		if( empty( $this->atts['avatar'] ) ) {
			return '';
		}

		$alt = $this->atts['title'];
		$avatar = '';

		if( preg_match( '/^\d+$/', $this->atts['avatar'] ) ){
			
			if( 'style07' === $this->atts['template'] || 'style16' === $this->atts['template'] ) {
				$avatar = wp_get_attachment_image( $this->atts['avatar'], 'full', false, array( 'alt' => esc_html( $alt ), 'class' => 'invisible' ) );	
			}
			else {
				$avatar = wp_get_attachment_image( $this->atts['avatar'], 'full', false, array( 'alt' => esc_html( $alt ), 'class' => 'circle' ) );	
			}
			// check
			if( ! $avatar ) {
				return;
			}
		} else {
			$avatar = esc_url( $this->atts['avatar'] );
			if( 'style07' === $this->atts['template'] || 'style16' === $this->atts['template'] ) {
				$avatar = sprintf( '<img class="invisible" src="%s" alt="%s" />', $avatar, esc_html( $alt ) );
			}
			else {
				// Default
				$avatar = sprintf( '<img class="circle" src="%s" alt="%s" />', $avatar, esc_html( $alt ) );
			}
		}

		if( 'style07' === $this->atts['template'] || 'style16' === $this->atts['template'] ) {
			$avatar = sprintf( '<figure class="lqd-testi-avatar w-100 m-0" data-responsive-bg="true">%s</figure>', $avatar );
		}
		elseif( 'style17' === $this->atts['template'] ) {
			$avatar = sprintf( '<figure class="lqd-testi-avatar circle overflow-hidden mx-0 mb-2">%s</figure>', $avatar );
		}
		else {
			// Default
			$avatar = sprintf( '<figure class="lqd-testi-avatar %s">%s</figure>', $classnames, $avatar );
		}
		

		echo $avatar;
	}

	/**
	 * [get_avatar description]
	 * @method get_avatar
	 */
	protected function get_image( $classnames = null ) {

		// check
		if( empty( $this->atts['image'] ) ) {
			return '';
		}
		
		$image = '';

		$alt = $this->atts['title'];

		if( preg_match( '/^\d+$/', $this->atts['image'] ) ){

			$image = wp_get_attachment_image( $this->atts['image'], 'full', false, array( 'alt' => esc_html( $alt ) ) );
			// check

			if( ! $image ) {
				return;
			}
		} else {
			$image = sprintf( '<img src="%s" alt="%s" />', esc_url( $this->atts['image'] ), esc_html( $alt ) );
		}

		// Default
		$image = sprintf( '<figure>%s</figure>', $image );

		echo $image;
	}
	
	protected function get_social_icon() {
		
		// check
		if( empty( $this->atts['network'] ) ) {
			return '';
		}		
		$net = liquid_get_network_class( $this->atts['network'] );
		
		printf( '<div class="lqd-testi-social-icon branded-text"><i class="%s"></i></div>', $net['icon'] );
		
	}

	/**
	 * [get_quote description]
	 * @method get_quote
	 */
	protected function get_quote() {

		// check
		if( empty( $this->atts['content'] ) ) {
			return '';
		}
		$content = ld_helper()->do_the_content( $this->atts['content'] );

		// Default
		$content = sprintf( '<blockquote>%s</blockquote>', $content );

		echo $content;
	}
	
	/**
	 * [get_name description]
	 * @method get_name
	 */
	protected function get_name( $tag = 'h3', $classes = null ) {
		
		$name = $this->atts['title'];
		if( empty( $name ) ) {
			return;
		}
		$classnames = '';
		if( !empty( $classes ) ) {
			$classnames = 'class="' . $classes . '"';
		}

		printf( '<%1$s %3$s>%2$s</%1$s>', $tag, esc_html( $name ), $classnames );
	}
	
	/**
	 * [get_position description]
	 * @method get_position
	 */
	protected function get_position( $tag = 'h4', $classes = null ) {
		
		$style    = $this->atts['template'];
		$position = $this->atts['position'];
		if( empty( $position ) ) {
			return;
		}
		
		if( !empty( $classes ) ) {
			$classes = 'class="' . $classes . '"';
		}		

		printf( '<%1$s %3$s>%2$s</%1$s>', $tag, esc_html( $position ), $classes );
		
	}
	
	protected function get_shadow() {
		
		if( 'testi_s04' !== $this->atts['style'] ) {
			return;
		}
		
		if( !$this->atts['enable_shadow'] ) {
			return;
		}
		
		return 'testimonial-quote-shadowed';
	}

	/**
	 * [get_rating description]
	 * @method get_rating
	 */	
	protected function get_rating( $class = null ) {
		
		$out = '';
		$rating = $this->atts['rating'];
		if( empty( $rating ) ) {
			return;
		}
		
		$active = '';

		$out .= '<ul class="lqd-star-rating ' . $class . '">';
		for( $i = 1; $i <= 5; $i++ ) {
			if( $i <= $rating ) {
				$active = ' active';
			}
			else {
				$active = '';
			}
			$out .= '<li><i class="fa fa-star' . $active . '"></i></li> ';
		}
		$out .= '</ul>';
		
		echo $out;
	}
	
	/**
	 * [get_rating description]
	 * @method get_rating
	 */	
	protected function get_time( $class = null ) {
		
		$time = $this->atts['date_time'];
		$style = $this->atts['template'];

		if( empty( $time ) ) {
			return;
		}

		if( ! empty( $class ) ) {
			$class = 'class="lqd-testi-time ' . $class . '"';
		}
		else {
			$class = 'class="lqd-testi-time"';
		}

		printf( '<span %1$s>%2$s</span>', $class,  esc_html( $time ) );
		
	}
	
	protected function get_fill_bg_classname() {

		if( empty( $this->atts['fill_bg_color'] ) ) {
			return;
		}
		
		return 'testimonial-fill-onhover';

	}


	/**
	 * [get_details description]
	 * @method get_details
	 */
	protected function get_details() {

		extract( $this->atts );

		// check
		if( empty( $title ) && empty( $company_name ) ) {
			return '';
		}

		printf( '<div class="%s">%s</div>', join( ' ', $classes ), ( $title . $meta . $company_logo ) );
	}
	
	/**
	 * [get_classes description]
	 * @method get_classes
	 */
	protected function get_classes( $style ) {

		$hash = array(
			'style01' => 'd-flex flex-column-reverse lqd-testi-card lqd-testi-shadow-xs lqd-testi-details-lg lqd-testi-quote-18 lqd-testi-avatar-72',
			'style02' => 'd-flex flex-column lqd-testi-card lqd-testi-shadow-none lqd-testi-details-sm lqd-testi-quote-18 lqd-testi-avatar-60 lqd-testi-bubble-all',
			'style03' => 'd-flex flex-column lqd-testi-card lqd-testi-shadow-xs lqd-testi-quote-21 lqd-testi-avatar-60',
			'style04' => 'd-flex flex-row-reverse lqd-testi-card lqd-testi-shadow-xxl lqd-testi-quote-15 lqd-testi-avatar-65',
			'style05' => 'd-flex flex-column lqd-testi-card lqd-testi-details-sm lqd-testi-quote-22 lqd-testi-avatar-48',
			'style06' => 'd-flex flex-column lqd-testi-card lqd-testi-details-sm lqd-testi-quote-21 lqd-testi-avatar-48 pt-8 pb-8 text-center',
			'style07' => 'd-flex flex-wrap align-items-stretch p-0 lqd-testi-card lqd-testi-shadow-lg lqd-testi-quote-21',
			'style08' => 'd-flex flex-column-reverse lqd-testi-card lqd-testi-shadow-none lqd-testi-details-sm lqd-testi-quote-16 lqd-testi-avatar-48',
			'style09' => 'd-flex flex-column-reverse lqd-testi-brd round lqd-testi-details-sm lqd-testi-quote-16 lqd-testi-avatar-48',
			'style10' => 'd-flex flex-column lqd-testi-card lqd-testi-shadow-none lqd-testi-details-sm lqd-testi-quote-18 lqd-testi-avatar-65 text-center',
			'style11' => 'd-flex flex-column lqd-testi-card lqd-testi-shadow-sm lqd-testi-details-sm lqd-testi-quote-18 lqd-testi-avatar-48 text-center',
			'style12' => 'lqd-testi-quote-18 lqd-testi-avatar-65',
			'style13' => 'd-flex flex-wrap lqd-testi-details-sm lqd-testi-quote-25 lqd-testi-avatar-72',
			'style14' => 'd-flex flex-column-reverse lqd-testi-details-xl lqd-testi-quote-22 lqd-testi-avatar-90',
			'style15' => 'd-flex flex-wrap lqd-testi-bubble round lqd-testi-details-lg lqd-testi-quote-25',
			'style16' => 'd-flex flex-wrap align-items-stretch p-0 lqd-testi-card lqd-testi-shadow-xl lqd-testi-quote-27',
			'style17' => 'lqd-testi-avatar-85 lqd-testi-details-sm lqd-testi-quote-16 text-center lqd-testi-bubble-alt',
		);

		return isset( $hash[ $style ] ) ? $hash[ $style ] : 'testimonial';
	}

	/**
	 * [generate_css description]
	 * @method generate_css
	 */
	protected function generate_css() {

		extract( $this->atts );

		$id = '.' . $this->get_id();
		$elements = array();
		
		$responsive_margin = Liquid_Responsive_Param::generate_css( 'margin', $margin, $this->get_id() );
		$elements['media']['margin'] = $responsive_margin;
		
		if( !empty( $bg_color ) && 'style15' !== $template && 'style17' !== $template ) {
			$elements[ liquid_implode( '%1$s' ) ]['background'] = $bg_color;
		}

		if ( !empty( $bg_color ) && 'style02' === $template ) {
			$elements[ liquid_implode( '%1$s:after' ) ]['border-top-color'] = $bg_color;
		}
		if ( !empty( $bg_color ) && 'style15' === $template ) {
			$elements[ liquid_implode( '%1$s .lqd-testi-inner' ) ]['background'] = $bg_color;
			$elements[ liquid_implode( '%1$s:after' ) ]['border-left-color'] = $bg_color;
		}
		if ( !empty( $bg_color ) && 'style17' === $template ) {
			$elements[ liquid_implode( '%1$s .lqd-testi-quote' ) ]['background'] = $bg_color;
			$elements[ liquid_implode( '%1$s .lqd-testi-quote:after' ) ]['border-top-color'] = $bg_color;
		}
		if( !empty( $border_color ) ) {
			$elements[ liquid_implode( '%1$s' ) ]['border-color'] = $border_color;
		}
		
		if( !empty( $secondary_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-testi-quote-icon path, %1$s .lqd-testi-quote-icon circle' ) ]['fill'] = $secondary_color;
		}
		if( !empty( $text_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-testi-quote' ) ]['color'] = $text_color;
		}
		if( !empty( $title_color ) ) {
			$elements[ liquid_implode( '%1$s h3' ) ]['color'] = $title_color;
		}
		if( !empty( $pos_color ) ) {
			$elements[ liquid_implode( '%1$s h4' ) ]['color'] = $pos_color;
		}
		if( !empty( $star_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-star-rating .active' ) ]['color'] = $star_color;
		}

		$this->dynamic_css_parser( $id, $elements );

	}
}
new LD_Testimonial;