<?php
/**
* Shortcode Porftfolio Single Title
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Pf_Single_Meta extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug = 'ld_single_portfolio_meta';
		$this->title = esc_html__( 'Portfolio Single Meta', 'landinghub-core' );
		$this->icon = 'la la-folder';
		$this->description = esc_html__( 'Display Portfolio Single Post Meta', 'landinghub-core' );
		// $this->category    = esc_html__( 'Portfolio Components', 'landinghub-core' );
		
		parent::__construct();
	}

	public function get_params() {
		
		$this->params = array(
			array(
				'type'       => 'dropdown',
				'param_name' => 'columns',
				'heading'    => esc_html__( 'Columns', 'landinghub-core' ),
				'value'      => array(
					esc_html__( '1', 'landinghub-core' ) => 1,
					esc_html__( '2', 'landinghub-core' ) => 2,
					esc_html__( '3', 'landinghub-core' ) => 3,
				),
				'std' => 2
			),
			array( 
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'color',
				'heading'     => esc_html__( 'Color', 'landinghub-core' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
			),
			
		);
		
	}
	
	public function get_pf_single_meta() {
		
		$atts = get_post_meta( get_the_ID(), 'portfolio-attributes', true );
		if( !is_array( $atts ) ) {
			return;
		}
		
		$out = '';
		
		foreach ( $atts as $attr ) {
	
			if( !empty( $attr ) ) {
				$attr = explode( "|", $attr );
				$label = isset( $attr[0] ) ? $attr[0] : '';
				$value = isset( $attr[1] ) ? $attr[1] : $label;	
				
				$out .= '<div class="lqd-pf-single-meta-part">';
				if( $label ) { 
					$out .= '<p class="my-0">' . esc_html( $label ) . '</p>';	
				}
				$out .= '<p class="my-0">'. do_shortcode( $value ) . '</p>';
				$out .= '</div>';
			}
		}
		
		echo $out;
	}
	
protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();

		if( ! empty( $color ) && isset( $color ) ) {
			$elements[ liquid_implode( '%1$s .lqd-pf-single-meta-part' ) ]['color'] = $color;
		}

		$this->dynamic_css_parser( $id, $elements );

	}
	
}
new LD_Pf_Single_Meta;