<?php
/**
* Shortcode Team Member
*/

if( !defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Team_Member extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_team_member';
		$this->title       = esc_html__( 'Team Member', 'landinghub-core' );
		$this->description = esc_html__( 'Add Team member', 'landinghub-core' );
		$this->icon        = 'la la-user-circle';
		$this->show_settings_on_create = true;

		parent::__construct();
	}
	
	public function get_params() {
		
		$url = liquid_addons()->plugin_uri() . '/assets/img/sc-preview/team-member/';

		$general = array(
			
			array(
				'type'        => 'select_preview',
				'param_name'  => 'template',
				'heading'     => esc_html__( 'Style', 'landinghub-core' ),
				'value'       => array(
					
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

				),
				'save_always' => true,
			),
			array(
				'type'        => 'liquid_attach_image',
				'param_name'  => 'image',
				'heading'     => esc_html__( 'Team Member Image', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'name',
				'heading'     => esc_html__( 'Team Member Name', 'landinghub-core' ),
				'admin_label' => true
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'position',
				'heading'     => esc_html__( 'Team Member Position', 'landinghub-core' ),
				'admin_label' => true,
			),
			array(
				'id' => 'link'
			),
			
		);

		$socials = array(

			array(
				'type'       => 'param_group',
				'param_name' => 'socials',
				'heading'    => esc_html__( 'Social link', 'landinghub-core' ),
				'params'     => array(

					array(
						'id' => 'network',
						'edit_field_class' => 'vc_column-with-padding vc_col-sm-6'
					),

					array(
						'type'        => 'textfield',
						'param_name'  => 'url',
						'heading'     => esc_html__( 'URL (Link)', 'landinghub-core' ),
						'description' => esc_html__(  'Add social link', 'landinghub-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					)
				)
			)
		);

		foreach( $socials as &$param ) {
			$param['group'] = esc_html__( 'Social Identites', 'landinghub-core' );
		}

		$design = array(

			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'accent_color',
				'heading'     => esc_html__( 'Accent Color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4 vc_column-with-padding'
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'title_color',
				'heading'     => esc_html__( 'Title Color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4'
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'pos_color',
				'heading'     => esc_html__( 'Position Color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4'
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'social_color',
				'heading'     => esc_html__( 'Social Icon Color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4 vc_column-with-padding'
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'social_hcolor',
				'heading'     => esc_html__( 'Social Icon Hover Color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4'
			),

			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'stop_color',
				'heading'     => esc_html__( 'Stop Color', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				'dependency' => array(
					'element' => 'template',
					'value'   => 'style02'
				),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'stop_color2',
				'heading'     => esc_html__( 'Stop Color 2', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'template',
					'value'   => 'style02'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			
		);

		foreach( $design as &$param ) {
			$param['group'] = esc_html__( 'Design Options', 'landinghub-core' );
		}

		$this->params = array_merge( $general, $socials, $design );

		$this->add_extras();
	}
	
	protected function get_name( $classnames = '' ) {

		// check
		if( empty( $this->atts['name'] ) ) {
			return;
		}
		if( !empty( $classnames ) ) {
			$classnames = ' class="' . $classnames . '"';
		}
		$name = esc_html( $this->atts['name'] );

		printf( '<h3%s>%s</h3>', $classnames, $name );

	}

	protected function get_position( $classnames = '' ) {

		// check
		if( empty( $this->atts['position'] ) ) {
			return;
		}
		
		if( !empty( $classnames ) ) {
			$classnames = ' class="' . $classnames . '"';
		}

		$template = $this->atts['template'];
		$position = esc_html( $this->atts['position'] );

		if ( 'style02' === $template ) {
			printf( '<p%s>%s</p>', $classnames, $position );
		} else {
			printf( '<h6%s>%s</h6>', $classnames, $position );
		}
		
	}

	protected function get_image( $only_figure = false ) {

		// check
		if( empty( $this->atts['image'] ) ) {
			return;
		}
		
		$alt = get_post_meta( $this->atts['image'], '_wp_attachment_image_alt', true );

		if( preg_match( '/^\d+$/', $this->atts['image'] ) ){
			$image = liquid_get_image_src( $this->atts['image'] );
			$html  = wp_get_attachment_image( $this->atts['image'], 'full', false, array( 'alt' => esc_attr( $alt ), 'class' => 'w-100' ) );
		} else {
			$src  = esc_url( $this->atts['image'] );
			$html = '<img class="w-100" src="' . $src . '" alt="' . esc_attr( $alt ) . '" />';
		}
		
		if( $only_figure ) {
			printf( '<figure>%1$s</figure>', $html );
		}
		else {
			printf( '<div class="lqd-tm-img"><figure>%1$s</figure></div>', $html );
		}
		

		
	}
	
	protected function get_content() {

		// check
		if( empty( $this->atts['content'] ) ) {
			return '';
		}

		$content = ld_helper()->do_the_content( $this->atts['content'] );

		echo $content;
	}

	protected function get_social() {

		$socials  = (array) vc_param_group_parse_atts( $this->atts['socials'] );
		$template = $this->atts['template'];

		// check
		if( empty( $socials ) ) {
			return;
		}

		$out = '';

		foreach ( $socials as $social ) {
			if ( empty( $social['url'] ) ) {
				continue;
			}

			$net = liquid_get_network_class( $social['network'] );
			$attr = array( 'href' => esc_url( $social['url'] ) );
		
			$out .= sprintf( '<li><a%s><i class="%s"></i></a></li>',
				ld_helper()->html_attributes( $attr ), $net['icon']
			);

		}

		$social_classnames = '';

		if ( 'style01' !== $template && 'style02' !== $template && 'style05' !== $template ) {
			$social_classnames = 'social-icon vertical social-icon-lg';
		} else {
			$social_classnames = 'social-icon social-icon-md pos-rel mt-4';
		}
		
		printf( '<ul class="' . $social_classnames . '">%s</ul>', $out );

	}
	
	protected function get_details( $param = null ) {
		
		if( empty( $param ) ) {
			return;
		}

		if( 'email' === $param ) {
			$icon = 'fa-envelope-o';
		}
		else {
			$icon = 'fa-phone';
		}
		
		$value = $this->atts[ $param ];

		if( empty( $value ) ) {
			return;
		}

		echo '<div class="iconbox iconbox-inline iconbox-xs iconbox-heading-xs">
				<span class="iconbox-icon-container">
					<i class="fa ' . $icon . '"></i>
				</span>
				<h3>' . esc_html( $value ) . '</h3>
			</div><!-- /.iconbox -->';

	}
	
	protected function get_overlay_link() {
		
		$link = liquid_get_link_attributes( $this->atts['link'], false );
		
		if( empty( $link['href']) ) {
			return;
		}
		$link['class'] = 'liquid-overlay-link';

		echo '<a'. ld_helper()->html_attributes( $link ) .'></a>';
		
	}
	
	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' .$this->get_id();
		
		if( !empty( $accent_color ) ) {

			if ( 'style01' === $template ) {
				$elements[ liquid_implode( '%1$s .block-revealer__element' ) ]['background'] = $accent_color . ' !important';
			}
			if ( 'style03' === $template ) {
				$elements[ liquid_implode( '%1$s .lqd-tm-socials' ) ]['background'] = $accent_color;
				$elements[ liquid_implode( '%1$s .block-revealer__element' ) ]['background'] = $accent_color . ' !important';
			}
			if ( 'style04' === $template || 'style05' === $template || 'style06' === $template ) {
				$elements[ liquid_implode( '%1$s .lqd-tm-details' ) ]['background'] = $accent_color;
			}
			
		}
		
		if( !empty( $stop_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-tm-details svg stop:first-child' ) ]['stop-color'] = $stop_color;
		}
		if( !empty( $stop_color2 ) ) {
			$elements[ liquid_implode( '%1$s .lqd-tm-details svg stop:last-child' ) ]['stop-color'] = $stop_color2;
		}
		
		if( !empty( $title_color ) ) {
			$elements[ liquid_implode( '%1$s h3' ) ]['color'] = $title_color;
			$elements[ liquid_implode( '%1$s .lqd-tm-details-icon' ) ]['color'] = $title_color;
		}

		if( !empty( $pos_color ) ) {
			if ( 'style02' === $template ) {
				$elements[ liquid_implode( '%1$s p' ) ]['color'] = $pos_color;
			} else {
				$elements[ liquid_implode( '%1$s h6' ) ]['color'] = $pos_color;
			}
		}

		if( !empty( $social_color ) ) {
			$elements[ liquid_implode( '%1$s .social-icon a' ) ]['color'] = $social_color;
		}

		if( !empty( $social_hcolor ) ) {
			$elements[ liquid_implode( '%1$s .social-icon a:hover' ) ]['color'] = $social_hcolor;
		}

		$this->dynamic_css_parser( $id, $elements );
	}

}
new LD_Team_Member;