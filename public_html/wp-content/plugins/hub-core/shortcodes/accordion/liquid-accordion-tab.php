<?php

/**
* Shortcode Accordion
*/

if( ! defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Accordion_Tab extends LD_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug         = 'vc_accordion_tab';
		$this->title        = esc_html__( 'Accordion Section', 'landinghub-core' );
		$this->icon         = 'la la-grip-lines';
		$this->description  = esc_html__( 'Create an accordion.', 'landinghub-core' );
		$this->is_container = true;
		$this->js_view      = 'VcAccordionTabView';
		$this->allowed_container_element = 'vc_row';
		$this->deprecated   = '';
		$this->as_child     = array( 'only' => 'vc_accordion' );

		parent::__construct();
	}

	public function get_params() {

		$this->params = array_merge(
		
			array(
	
				array( 'id' => 'title' ),
				
				array(
					'type' => 'el_id',
					'param_name' => 'tab_id',
					'settings' => array(
						'auto_generate' => true,
					),
					'heading'     => esc_html__( 'Section ID', 'landinghub-core' ),
					'description' =>  wp_kses_post( __( 'Enter section ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'landinghub-core' ) ),
				),
				// CSS
				array(
					'type'        => 'textfield',
					'param_name'  => 'el_class',
					'heading'     => esc_html__( 'Extra class name', 'landinghub-core' ),
					'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'landinghub-core' ),
					'group'       => esc_html__( 'Extras', 'landinghub-core' )
				),
			),
			liquid_get_icon_params( true, '', array( 'fontawesome', 'linea' ), array( 'align', 'color', 'hcolor', 'size' ) )
		
		);
	

	}

	public $active_tab = true;

	public function render( $atts, $content = '' ) {

		global $liquid_accordion_tabs;

		$atts = vc_map_get_attributes( $this->slug, $atts );
		$atts = $this->before_output( $atts, $content );
		$atts['_id'] = $atts['tab_id'];
		$atts['extra'] = $atts['el_class'];
		$content = $content === '[vc_container_anchor]' ? '<div data-js-panel-body>' . $content . '</div>': $content;
		$atts['content'] = ld_helper()->do_the_content( $content, false );
		$atts['icon'] = liquid_get_icon( $atts );
		$atts['tag'] = $this->slug;

		$action = vc_post_param( 'action' );

		if ( 'vc_load_shortcode' === $action ) {

			$in = $this->active_tab ? ' in' : '';
			$active = $this->active_tab ? ' active' : '';
			$expanded = $this->active_tab ? 'true' : 'false';
			$collapsed = $this->active_tab ? '' : 'collapsed';

			$this->active_tab = false;

			$out = '';

			$out .= '<div class="accordion-item panel ' . $active . ' ' . $atts['extra'] .'">
						<div class="accordion-heading" role="tab" id="heading_' . $this->get_id( $atts ) . '" data-id="' . $this->get_id( $atts ) . '">
							<h4 class="accordion-title" data-controls="' . $this->get_id( $atts ) . '">
								<a class="' . $collapsed . '" data-toggle="collapse" data-parent="" href="#' . $this->get_id( $atts ) . '" aria-expanded="' . $expanded . '" aria-controls="' . $this->get_id( $atts ) . '">';

				if( $atts['icon']['type'] ) {
					$out .= '		<span class="accordion-title-icon mr-2"><i class="' . $atts['icon']['icon'] . '"></i></span>';
				}

				$out .= wp_kses_data( $atts['title'] );

				$out .= '			<span class="accordion-expander">
										<i class="fa fa-plus"></i>
										<i class="fa fa-minus"></i>
									</span>';

				$out .= '		</a>
							</h4>
						</div>
						<div id="' . $this->get_id( $atts ) . '" class="accordion-collapse collapse' . $in . '" role="tabpanel" aria-labelledby="heading_' . $this->get_id( $atts ) . '">
							<div class="accordion-content"><div data-js-panel-body>' . vc_container_anchor() . '</div></div>
						</div>
					</div>';

			return $out;

		}

		$liquid_accordion_tabs[]  = $atts;
	}

}
new LD_Accordion_Tab;