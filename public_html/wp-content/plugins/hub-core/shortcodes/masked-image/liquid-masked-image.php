<?php
/**
* Shortcode Masked Image Element
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly
	
/**
* LD_Shortcode
*/
class LD_Masked_Image extends LD_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug            = 'ld_masked_image';
		$this->title           = esc_html__( 'Masked Image', 'landinghub-core' );
		$this->description     = esc_html__( 'Add masked image', 'landinghub-core' );
		$this->icon            = 'la la-image';

		parent::__construct();
	}
	
	public function get_params() {
		
		$this->params = array(

			array(
				'type'       => 'liquid_attach_image',
				'param_name' => 'image',
				'heading'    => esc_html__( 'Image', 'landinghub-core' ),
				'descripton' => esc_html__( 'Add image from gallery or upload new', 'landinghub-core' ),
			),
			array(
				'type'             => 'textfield',
				'param_name'       => 'bg_pos_x',
				'heading'          => esc_html__( 'Background Position X', 'landinghub-core' ),
				'description'      => esc_html__( 'Add Background position on axe X with px, for ex. 24px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'textfield',
				'param_name'       => 'bg_pos_y',
				'heading'          => esc_html__( 'Background Position Y', 'landinghub-core' ),
				'description'      => esc_html__( 'Add Background position on axe Y with px, for ex. 24px', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Absolute Position?', 'landinghub-core' ),
				'param_name'  => 'absolute_pos',
				'description' => esc_html__( 'If checked the position will be set absolute', 'landinghub-core' ),
				'value'       => array( esc_html__( 'Yes', 'landinghub-core' ) => 'yes' ),
				'group'       => esc_html__( 'Design Options', 'landinghub-core' ),
			),
			//Position
			array(
				'type'       => 'liquid_responsive',
				'heading'    => esc_html__( 'Position', 'landinghub-core' ),
				'description' => esc_html__( 'Add positions for the element, use px or %', 'landinghub-core' ),
				'css'        => 'position',
				'param_name' => 'position',
				'group'      => esc_html__( 'Design Options', 'landinghub-core' ),
			),
			
			
		);

		$this->add_extras();
	
	}

	protected function get_image() {

		// check
		if( empty( $this->atts['image'] ) ) {
			return;
		}
		
		$alt = get_post_meta( $this->atts['image'], '_wp_attachment_image_alt', true );
		$image_opts = array();
		
		if( preg_match( '/^\d+$/', $this->atts['image'] ) ){
			$image  = '<figure class="clip-svg bg-cover bg-cente" data-responsive-bg="true">' . wp_get_attachment_image( $this->atts['image'], 'full', false, $image_opts ) . '</figure>';
		} else {
			$image = '<figure class="clip-svg bg-cover bg-cente" data-responsive-bg="true"><img src="' . esc_url( $this->atts['image'] ) . '" alt="' . esc_attr( $alt ) . '" /></figure>';
		}

		echo $image;

	}
	
	
	protected function get_svg() {
		
		$unique_id = 'svg-' . $this->get_id();
		
		echo '<svg class="scene" viewBox="140 140 140 140">
						<defs>
							<clipPath id="' . $unique_id . '" clipPathUnits="objectBoundingBox" transform="scale(0.00158)">
								<path
									vector-effect="non-scaling-stroke"
									fill="black"
									d="M212.625,0.091 C319.112,-2.992 719.225,71.583 615.507,328.179 C511.789,584.775 250.263,624.292 112.94,568.057 C-24.383,511.822 -12.023,229.89 23.583,138.127 C59.189,46.364 106.138,3.174 212.625,0.091 Z"
									pathdata:id="M362.5,4 C487,4 631,-44 631,201.5 C631,447 538,623.5 310.5,581.5 C83,539.5 -29.917,266.627 7,156.5 C43.917,46.373 238,4 362.5,4 Z;M370,18 C494.5,18 627,-56.5 627,189 C627,434.5 405.5,573.5 155.5,581 C-94.5,588.5 23.083,175.127 60,65 C96.917,-45.127 245.5,18 370,18 Z"
								/>
							</clipPath>
						</defs>
					</svg>';
	}
	

	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();
		
		if( ! empty( $absolute_pos ) ) {
			$elements[ liquid_implode( '%1$s' ) ]['position'] = 'absolute';
		}	
		
		$responsive_pos = liquid_Responsive_Param::generate_css( 'position', $position, $this->get_id() );
		$elements['media']['position'] = $responsive_pos;
		$elements[ liquid_implode( '%1$s .clip-svg' ) ]['clip-path'] = 'url(#svg-' . $this->get_id() . ' )';
		$elements[ liquid_implode( '%1$s .clip-svg' ) ]['-webkit-clip-path'] = 'url(#svg-' . $this->get_id() . ' )';
		
		if( !empty( $bg_pos_x ) ) {
			$elements[ liquid_implode( '%1$s .clip-svg' ) ]['background-position-x'] = $bg_pos_x;	
		}
		if( !empty( $bg_pos_y ) ) {
			$elements[ liquid_implode( '%1$s .clip-svg' ) ]['background-position-y'] = $bg_pos_y;
		}
		
		$this->dynamic_css_parser( $id, $elements );
	}
	
}
new LD_Masked_Image;