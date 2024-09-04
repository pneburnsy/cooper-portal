<?php
/**
* Shortcode Timeline Item
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly
	
/**
* LD_Shortcode
*/
class LD_Timeline_Item extends LD_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug            = 'ld_timeline_item';
		$this->title           = esc_html__( 'Timeline Item', 'landinghub-core' );
		$this->description     = esc_html__( 'Add timeline item', 'landinghub-core' );
		$this->icon            = 'la la-clock-o';
		$this->as_child        = array( 'only' => 'ld_timeline' );

		parent::__construct();
	}

	public function get_params() {
		
		$this->params = array(
			
			array(
				'id'               => 'title',
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'heading_weight',
				'heading'    => esc_html__( 'Title Weight', 'landinghub-core' ),
				'value'      => array(
					esc_html__( 'Default', 'landinghub-core' )   => '',
					esc_html__( 'Light', 'landinghub-core' )     => 'font-weight-light',
					esc_html__( 'Normal', 'landinghub-core' )    => 'font-weight-normal',
					esc_html__( 'Medium', 'landinghub-core' )    => 'font-weight-medium',
					esc_html__( 'Semi Bold', 'landinghub-core' ) => 'font-weight-semibold',
					esc_html__( 'Bold', 'landinghub-core' )      => 'font-weight-bold',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'             => 'textfield',
				'param_name'       => 'subtitle',
				'heading'          => esc_html__( 'Subtitle', 'landinghub-core' ),
				'description'      => esc_html__( 'Add subtitle to timeline item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'textfield',
				'param_name'       => 'year',
				'heading'          => esc_html__( 'Timeline Year', 'landinghub-core' ),
				'description'      => esc_html__( 'Add year to timeline item', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'liquid_attach_image',
				'param_name' => 'image',
				'heading'    => esc_html__( 'Image', 'landinghub-core' ),
				'descripton' => esc_html__( 'Add image from gallery or upload new', 'landinghub-core' ),
			),
			array(
				'type'       => 'textarea_html',
				'param_name' => 'content',
				'heading'    => esc_html__( 'Text', 'landinghub-core' ),
				'holder'     => 'div'
			),

		);
		$this->add_extras();
	
	}

	protected function get_title() {

		// check
		if( empty( $this->atts['title'] ) ) {
			return '';
		}

		$weight = $this->atts['heading_weight'];

		if( !empty ( $weight ) ) {
			$weight	 = ' ' . $weight;
		}

		$title = sprintf( '<h3 class="mt-md-4 mt-lg-0 mb-3%s">%s</h3>', $weight, $this->atts['title'] );


		echo $title;
	}
	
	protected function get_subtitle() {

		// check
		if( empty( $this->atts['subtitle'] ) ) {
			return '';
		}

		$subtitle = sprintf( '<h6 class="my-0">%s</h6>', $this->atts['subtitle'] );

		echo $subtitle;
	}
	
	protected function get_year() {

		// check
		if( empty( $this->atts['year'] ) ) {
			return '';
		}

		$year = sprintf( '<span class="col-md-2 ld-timeline-date font-weight-medium mt-md-0 mt-4">%s</span><!-- /.ld-timeline-date -->', $this->atts['year'] );

		echo $year;
	}
	
	protected function get_image() {

		// check
		if( empty( $this->atts['image'] ) ) {
			return;
		}

		$alt = $this->atts['title'];
		
		if( preg_match( '/^\d+$/', $this->atts['image'] ) ){
			$image  = wp_get_attachment_image( $this->atts['image'], 'full', false, array( 'alt' => esc_attr( $alt ) ) );
		} else {
			$image = '<img src="' . esc_url( $this->atts['image'] ) . '" alt="' . esc_attr( $alt ) . '" />';
		}

		$image = sprintf( '<figure class="col-md-5 ld-timeline-img">%s</figure>', $image );

		echo $image;

	}
	
	protected function get_content() {

		// check
		if( empty( $this->atts['content'] ) ) {
			return '';
		}

		$content = ld_helper()->do_the_content( $this->atts['content'] );

		echo '<hr>' . $content;
	}
	
	protected function generate_css() {

		$elements = array();
		extract( $this->atts );
		$id = '.' .$this->get_id();

		$this->dynamic_css_parser( $id, $elements );
	}

}
new LD_Timeline_Item;