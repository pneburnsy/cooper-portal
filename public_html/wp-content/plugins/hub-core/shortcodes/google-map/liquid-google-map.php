<?php
/**
* Shortcode Google map
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Google_Map extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_google_map';
		$this->title       = esc_html__( 'Fancy Google Maps', 'landinghub-core' );
		$this->description = esc_html__( 'Add a custom Google map', 'landinghub-core' );
		$this->icon        = 'la la-map';
		$this->scripts     = 'google-maps-api';
		$this->defaults    = array();
		$this->show_settings_on_create = true;

		parent::__construct();
	}
	
	public function get_params() {

		$url = liquid_addons()->plugin_uri() . '/assets/img/sc-preview/google-maps/';
		$general = array(

			array(
				'type'        => 'select_preview',
				'param_name'  => 'style',
				'heading'     => esc_html__( 'Map Style', 'landinghub-core' ),
				'description' => '.',
				'value'       => array(

					array(
						'value' => 'assassinsCreedIV',
						'label' => esc_html__( 'Assassins Creed IV', 'landinghub-core' ),
						'image' => $url . 'assassins-creed-IV.jpg'
					),
					array(
						'label' => esc_html__( 'Blue Essence', 'landinghub-core' ),
						'value' => 'blueEssence',
						'image' => $url . 'blue-essence.jpg'
					),
					array(
						'label' => esc_html__( 'Classic', 'landinghub-core' ),
						'value' => 'classic',
						'image' => $url . 'classic.jpg'
					),
					array(
						'label' => esc_html__( 'Light Monochrome', 'landinghub-core' ),
						'value' => 'lightMonochrome',
						'image' => $url . 'light-monochrome.jpg'
					),
					array(
						'label' => esc_html__( 'Unsaturated Browns', 'landinghub-core' ),
						'value' => 'unsaturatedBrowns',
						'image' => $url . 'unsaturated-browns.jpg'
					),
					array(
						'label' => esc_html__( 'WY', 'landinghub-core' ),
						'value' => 'wy',
						'image' => $url . 'wy.jpg'
					),
					array(
						'label' => esc_html__( 'Even Lighter', 'landinghub-core' ),
						'value' => 'evenLighter',
						'image' => $url . 'even-lighter.jpg'
					),
					array(
						'label' => esc_html__( 'Shades of Gray', 'landinghub-core' ),
						'value' => 'shadesOfGray',
						'image' => $url . 'shades-of-gray.jpg'
					),
				),
				'admin_label' => true,
				'save_always' => true,				
			),
			
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Address', 'landinghub-core' ),
				'param_name'  => 'address',
				'admin_label' => true,
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'map_height',
				'heading'     => esc_html__( 'Height', 'landinghub-core' ),
				'description' => esc_html__( 'Set custom google map height, in px. eg 250px', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'map_marker',
				'heading'    => esc_html__( 'Marker', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'None', 'landinghub-core' )   => 'no',
					esc_html__( 'Custom', 'landinghub-core' ) => 'custom',
					esc_html__( 'Animated Circles', 'landinghub-core' )   => 'html_marker'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			
			array(
				'type'       => 'colorpicker',
				'param_name' => 'color_marker',
				'heading'	 => esc_html__( 'Marker Color', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'map_marker',
					'value'   => array( 'html_marker' )
				),				
			),

			array(
				'type'       => 'attach_image',
				'param_name' => 'custom_marker',
				'heading'    => esc_html__( 'Custom Marker', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'map_marker',
					'value'   => array( 'custom' )
				),
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'        => 'checkbox',
				'param_name'  => 'multiple_markers',
				'heading'     => esc_html__( 'Multiple markers?', 'landinghub-core' ),
				'description' => esc_html__( 'Enable multiple markers on map', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'dependency' => array(
					'element' => 'adv_opts',
					'is_empty' => true,
				),
			),

			array(
				'type'       => 'param_group',
				'param_name' => 'marker_coordinates',
				'heading'    => esc_html__( 'Marker\'s coordinates', 'landinghub-core' ),
				'params'     => array(
					array(
						'type'        => 'textfield',
						'param_name'  => 'lat',
						'heading'     => esc_html__( 'Latitude', 'landinghub-core' ),
						'description' => esc_html__( 'Marker Latitude', 'landinghub-core' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
					),

					array(
						'type'        => 'textfield',
						'param_name'  => 'long',
						'heading'     => esc_html__( 'Longitude', 'landinghub-core' ),
						'description' => esc_html__( 'Marker Longitude', 'landinghub-core' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_col-sm-6'
					)
				),
				'dependency' => array(
					'element' => 'multiple_markers',
					'value' => 'yes'
				),
			),
			
		);

		$socials = vc_map_integrate_shortcode( 'ld_social_icons', 'si_', esc_html__( 'Social Identities', 'landinghub-core' ), 
			array(
				'exclude' => array(
					'primary_color',
					'el_id',
					'el_class'
				),
			),
			array(
				'element' => 'show_infobox',
				'value'   => 'yes'	
			)
		);

		$map = array(
			array(
				'type'       => 'dropdown',
				'param_name' => 'map_type',
				'heading'    => esc_html__( 'Map Type', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Roadmap', 'landinghub-core' )	=> 'roadmap',
					esc_html__( 'Satellite', 'landinghub-core' )	=> 'satellite',
					esc_html__( 'Hybrid', 'landinghub-core' )	=> 'hybrid',
					esc_Html__( 'Terrain', 'landinghub-core' )	=> 'terrain',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'zoom',
				'heading'     => esc_html__( 'Zoom', 'landinghub-core' ),
				'value'       => 14,
				'edit_field_class' => 'vc_col-sm-6'
			),

			array(
				'type'       => 'liquid_checkbox',
				'param_name' => 'map_controls',
				'heading'    => esc_html__( 'Enable/Disable controls', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Fullscreen', 'landinghub-core' )  => 'fullscreenControl',
					esc_html__( 'Pan', 'landinghub-core' )         => 'panControl',
					esc_html__( 'Rotate', 'landinghub-core' )      => 'rotateControl',
					esc_html__( 'Scale', 'landinghub-core' )       => 'scaleControl',
					esc_Html__( 'Scrollwheel', 'landinghub-core' ) => 'scrollwheel',
					esc_html__( 'Street View', 'landinghub-core' ) => 'streetViewControl',
					esc_html__( 'Zoom', 'landinghub-core' )        => 'zoomControl',
				)
			),



		);

		foreach( $map as &$param ) {
			$param['group'] = esc_html__( 'Map Options', 'landinghub-core' );
		}

		$this->params = array_merge( $general, $socials, $map );

		$this->add_extras();
	}

	protected function get_marker() {

		if( empty( $this->atts['map_marker'] ) || 'no' == $this->atts['map_marker'] ) {
			return;
		}

		if( 'custom' == $this->atts['map_marker'] && $url = liquid_get_image( $this->atts['custom_marker'] ) ) {
			return $url;
		}
		if( 'html_marker' ==  $this->atts['map_marker'] ) {
			return liquid_addons()->plugin_uri() . 'assets/img/markers/map-pin.svg';	
		}

		return liquid_addons()->plugin_uri() . 'assets/img/markers/' . $this->atts['map_marker'] . '.svg';
	}

	protected function get_coordinates() {

		if( empty( $this->atts['multiple_markers'] ) ) {
			return;
		}

		$items = vc_param_group_parse_atts( $this->atts['marker_coordinates'] );
		$items = array_filter( $items );

		if( empty( $items ) ) {
			return;
		}

		$data = array();

		foreach( $items as $item ) {
			$data[] = array( ''. esc_attr( $item['lat'] ) . '', '' . esc_attr( $item['long'] ) . '' );
		}

		return $data;

	}
	
	protected function get_social() {

		$data = vc_map_integrate_parse_atts( $this->slug, 'ld_social_icons', $this->atts, 'si_' );
		if ( $data ) {

			$si = visual_composer()->getShortCode( 'ld_social_icons' )->shortcodeClass();

			if ( is_object( $si ) ) {
				echo $si->render( array_filter( $data ) );
			}
		}
	}


	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();

		if( !empty( $color_marker ) ) {
			$elements[ liquid_implode( '%1$s .lqd-custom-map-marker, .lqd-custom-map-marker div' ) ]['background-color'] = $color_marker;
		}

		$this->dynamic_css_parser( $id, $elements );
	}		
	
}
new LD_Google_Map;