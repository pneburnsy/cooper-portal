<?php
/**
* Shortcode Animated Frames Container
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly
	
/**
* LD_Shortcode
*/
class LD_Animated_Frames_Container extends LD_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug            = 'ld_animated_frames_container';
		$this->title           = esc_html__( 'Animated Frames Container', 'landinghub-core' );
		$this->description     = esc_html__( 'Animated Frames Container.', 'landinghub-core' );
		$this->icon            = 'la la-image';
		$this->content_element = true;
		$this->is_container    = true;
		$this->as_parent       = array( 'only' => array( 'ld_animated_frame' ) );
		$this->show_settings_on_create = true;

		$this->default_content = '
		[ld_animated_frame title="' . sprintf( '%s %d', 'Frame', 1 ) . '"][/ld_animated_frame]
		[ld_animated_frame title="' . sprintf( '%s %d', 'Frame', 2 ) . '"][/ld_animated_frame]
		[ld_animated_frame title="' . sprintf( '%s %d', 'Frame', 3 ) . '"][/ld_animated_frame]';

		parent::__construct();
	}

	public function get_params() {
		
		$this->params = array(
			array(
				'type'        => 'checkbox',
				'param_name'  => 'enable_scrolable',
				'heading'     => esc_html__( 'Scrollable', 'landinghub-core' ),
				'description' => esc_html__( 'Check to enable scrollable effect', 'landinghub-core' ),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'enable_autoplay',
				'heading'     => esc_html__( 'Autoplay?', 'landinghub-core' ),
				'description' => esc_html__( 'Check to enable autoplay', 'landinghub-core' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'autoplay_timeout',
				'heading'     => esc_html__( 'Autoplay Delay', 'landinghub-core' ),
				'description' => esc_html__( 'Add delay in milliseconds', 'landinghub-core' ),
				'std' => '4000',
				'dependency'  => array(
					'element' => 'enable_autoplay',
					'value'   => 'true',
				),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'enable_counter',
				'heading'     => esc_html__( 'Navigation Counter?', 'landinghub-core' ),
				'description' => esc_html__( 'Enable navigation counter', 'landinghub-core' ),
				'std' 		  => 'true',
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'enable_arrows',
				'heading'     => esc_html__( 'Navigation Arrows?', 'landinghub-core' ),
				'description' => esc_html__( 'Enable navigation arrows', 'landinghub-core' ),
				'std' 		  => 'true',
			),
			array(
				'type'       => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'frame_color',
				'heading'    => esc_html__( 'Frame Color', 'landinghub-core' ),
				'group'      => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4 vc_column-with-padding'
			),
			array(
				'type'       => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'arrows_color',
				'heading'    => esc_html__( 'Arrows Color', 'landinghub-core' ),
				'group'      => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4'
			),
			array(
				'type'       => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'arrows_hcolor',
				'heading'    => esc_html__( 'Arrows Hover Color', 'landinghub-core' ),
				'group'      => esc_html__( 'Design Options', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-4'
			),
		);
		$this->add_extras();

	}
	
	protected function get_opts() {

		if ( !$this->atts['enable_scrolable'] && !$this->atts['enable_autoplay']){
			return;
		}

		$opts = array();
		
		if( $this->atts['enable_scrolable'] ) {
			$opts['scrollable'] = true;
			$opts['forceDisablingWindowScroll'] = true;
		}
		if( $this->atts['enable_autoplay'] ) {
			$autoplay_timeout = $this->atts['autoplay_timeout'];
			$opts['autoplay'] = true;
			$opts['autoplayTimeout'] = $autoplay_timeout ? $autoplay_timeout : '4000';
		}

		echo ' data-af-options=\'' . wp_json_encode( $opts ) . '\'';
		
	}
	
	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();

		if( !empty( $frame_color ) ) {
			$elements[ liquid_implode( '%1$s' ) ]['background'] = $frame_color;
		}
		if( !empty( $arrows_color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-af-slidenav__item svg' ) ]['stroke'] = $arrows_color;
		}
		if( !empty( $arrows_hcolor ) ) {
			$elements[ liquid_implode( '%1$s .lqd-af-slidenav__item:hover svg' ) ]['stroke'] = $arrows_hcolor;
		}
		if ( !$enable_counter ){
			$elements[ liquid_implode( '%1$s .lqd-af-slidenum' ) ]['display'] = 'none';
		}
		if ( !$enable_arrows ){
			$elements[ liquid_implode( '%1$s .lqd-af-slidenav' ) ]['display'] = 'none';
		}
		
		$this->dynamic_css_parser( $id, $elements );
	}


}
new LD_Animated_Frames_Container;
class WPBakeryShortCode_LD_Animated_Frames_Container extends WPBakeryShortCodesContainer {}