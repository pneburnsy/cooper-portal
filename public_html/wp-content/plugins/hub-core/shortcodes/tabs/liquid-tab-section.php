<?php
/**
* Shortcode Liquid Tab Section
*/

if( ! defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

// Tab Section Container Class
VcShortcodeAutoloader::getInstance()->includeClass( 'WPBakeryShortCode_VC_Tta_Section' );
class WPBakeryShortCode_Ld_tab_section extends WPBakeryShortCode_VC_Tta_Section {
	/**
	 * @param $width
	 * @param $i
	 *
	 * @return string
	 */
	public function mainHtmlBlockParams( $width, $i ) {
		$sortable = ( vc_user_access_check_shortcode_all( $this->shortcode ) ? 'wpb_sortable' : $this->nonDraggableClass );

		return 'data-element_type="' . $this->settings['base'] . '" class="wpb_' . $this->settings['base'] . ' ' . $sortable . ' wpb_vc_tta_section wpb_content_holder vc_shortcodes_container"' . $this->customAdminBlockParams();
	}
}


/**
* LD_Shortcode
*/
class LD_Tab_Section extends LD_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug          = 'ld_tab_section';
		$this->title         = esc_html__( 'Tab Section', 'landinghub-core' );
		$this->description   = esc_html__( 'Section for Tabs.', 'landinghub-core' );
		$this->icon          = 'la la-border-all';
		$this->base					 = 'vc_tta_section';
		$this->is_container  = true;
		$this->allowed_container_element = 'vc_row';
		$this->show_settings_on_create = false;
		$this->as_child      = array( 'only' => 'ld_tabs' );
		$this->js_view       = 'VcBackendTtaSectionView';
		$this->custom_markup = '<div class="vc_tta-panel-heading">
		    <h4 class="vc_tta-panel-title vc_tta-controls-icon-position-left"><a href="javascript:;" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-accordion data-vc-container=".vc_tta-container"><span class="vc_tta-title-text">{{ section_title }}</span><i class="vc_tta-controls-icon vc_tta-controls-icon-plus"></i></a></h4>
		</div>
		<div class="vc_tta-panel-body">
			{{ editor_controls }}
			<div class="{{ container-class }}">
			{{ content }}
			</div>
		</div>';

		parent::__construct();
	}

	public function get_params() {

		$this->params = array_merge(
			array(

				array( 'id' => 'title' ),
				array(
					'type'       => 'textfield',
					'param_name' => 'desc',
					'heading'    => esc_html__( 'Short Description', 'landinghub-core' ),
					'description' => esc_html__( 'Add short description for tab, works only for some tabs styles', 'landinghub-core' ),
				),
				
				array(
					'type'       => 'el_id',
					'param_name' => 'tab_id',
					'settings'   => array(
						'auto_generate' => true,
					),
					'heading'     => esc_html__( 'Section ID', 'landinghub-core' ),
					'description' => wp_kses_post( __( 'Enter section ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'landinghub-core' ) ),
				),

				array(
					'type'       => 'subheading',
					'param_name' => 'sh_separator',
					'heading'    => esc_html__( 'Normal State Colors', 'landinghub-core' ),
					'group' => esc_html__( 'Design Options', 'landinghub-core' ),
				),
				array(
					'type'        => 'liquid_colorpicker',
					'only_solid'  => true,
					'param_name'  => 'primary_color',
					'heading'     => esc_html__( 'Primary Color', 'landinghub-core' ),
					'description' => esc_html__( 'Pick a primary color for tabs. This option only works for style 14.', 'landinghub-core' ),
					'group' => esc_html__( 'Design Options', 'landinghub-core' ),
					'edit_field_class' => 'vc_column-with-padding vc_col-sm-4',
				),
				array(
					'type'        => 'liquid_colorpicker',
					'only_solid'  => true,
					'param_name'  => 'secondary_color',
					'heading'     => esc_html__( 'Secondary Color', 'landinghub-core' ),
					'description' => esc_html__( 'Pick a primary color for tabs. This will create a gradient. This option only works for style 14.', 'landinghub-core' ),
					'group' => esc_html__( 'Design Options', 'landinghub-core' ),
					'edit_field_class' => 'vc_column-with-padding vc_col-sm-4',
				),

				array(
					'type'       => 'subheading',
					'param_name' => 'sh_separator',
					'heading'    => esc_html__( 'Active State Colors', 'landinghub-core' ),
					'group' => esc_html__( 'Design Options', 'landinghub-core' ),
				),
				array(
					'type'        => 'liquid_colorpicker',
					'only_solid'  => true,
					'param_name'  => 'primary_hcolor',
					'heading'     => esc_html__( 'Primary Color', 'landinghub-core' ),
					'description' => esc_html__( 'Pick a primary color for tabs. This option only works for style 14.', 'landinghub-core' ),
					'group' => esc_html__( 'Design Options', 'landinghub-core' ),
					'edit_field_class' => 'vc_column-with-padding vc_col-sm-4',
				),
				array(
					'type'        => 'liquid_colorpicker',
					'only_solid'  => true,
					'param_name'  => 'secondary_hcolor',
					'heading'     => esc_html__( 'Secondary Color', 'landinghub-core' ),
					'description' => esc_html__( 'Pick a primary color for tabs. This will create a gradient. This option only works for style 14.', 'landinghub-core' ),
					'group' => esc_html__( 'Design Options', 'landinghub-core' ),
					'dependency' => array(
						'element' => 'style',
						'value'   => array( 'style14' ),
					),
					'edit_field_class' => 'vc_column-with-padding vc_col-sm-4',
				),

			),

			liquid_get_icon_params( false, '', array( 'fontawesome', 'linea' ), array( 'align', 'color', 'size', 'hcolor' ) )
		);

		$this->add_extras();
	}

	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' .$this->get_id();

		if ( !empty($primary_color) ) {
			$elements[ liquid_implode( '.lqd-tabs .lqd-tabs-nav > %1$s > a .lqd-tabs-nav-txt span' ) ]['background'] = $primary_color;
		}
		if ( !empty($primary_color) && !empty($secondary_color) ) {
			$elements[ liquid_implode( '.lqd-tabs .lqd-tabs-nav > %1$s > a .lqd-tabs-nav-txt span' ) ]['background'] = 'linear-gradient(to right, ' . $primary_color . ', ' . $secondary_color . ')';
		}
		
		if ( !empty($primary_hcolor) ) {
			$elements[ liquid_implode( '.lqd-tabs .lqd-tabs-nav > %1$s > a .lqd-tabs-nav-txt:before' ) ]['background'] = $primary_hcolor;
		}
		if ( !empty($primary_hcolor) && !empty($secondary_hcolor) ) {
			$elements[ liquid_implode( '.lqd-tabs .lqd-tabs-nav > %1$s > a .lqd-tabs-nav-txt:before' ) ]['background'] = 'linear-gradient(to right, ' . $primary_hcolor . ', ' . $secondary_hcolor . ')';
		}

		$this->dynamic_css_parser( $id, $elements );
		
	}

	public function render( $atts, $content = '' ) {

		global $liquid_accordion_tabs;

		$atts                = vc_map_get_attributes( $this->slug, $atts );
		$atts                = $this->before_output( $atts, $content );
		$atts[ '_id' ]       = $atts[ 'tab_id' ];
		$atts[ 'icon' ]      = liquid_get_icon( $atts );
		$atts[ 'tag' ]       = $this->slug;
		$atts[ 'unique_id' ] = uniqid( 'ld_tab_section-' );
		$atts[ 'shortcode' ] = '';

		$action = vc_post_param( 'action' );
		if ( 'vc_load_shortcode' === $action ) {

			return '<div id="' . $atts['tab_id'] . '" role="tabpanel" class="lqd-tabs-pane fade"><div class="lqd-panel-body"><div data-js-panel-body>' . vc_container_anchor() . '</div></div></div>';

		} else {

			if ( vc_is_inline() && vc_frontend_editor()->post_shortcodes ) {

				foreach ( vc_frontend_editor()->post_shortcodes as $shortcode ) {
					$shortcode = (array) json_decode( rawurldecode( $shortcode ) );
					if ( $shortcode[ 'tag' ] === $this->slug && $shortcode[ 'attrs' ]->tab_id === $atts[ 'tab_id' ] ) {
						$shortcode[ 'attrs' ] = (array) $shortcode[ 'attrs' ];
						$atts[ 'shortcode' ]  = (array) $shortcode;
						break;
					}
				}

				if ( ! is_null($atts[ 'shortcode' ]) ){
					$atts[ 'content' ] = ld_helper()->do_the_content( $this->toString( $atts[ 'shortcode' ], $content ), false );
				}
			} else {
				$atts[ 'content' ] = ld_helper()->do_the_content( $content, false );
			}
		}

		$liquid_accordion_tabs[] = $atts;
		
	}

	public $first = true;

	public function toString( $shortcode, $content ) {
		$shortcode_obj = visual_composer()->getShortCode( $shortcode['tag'] );
		$shortcode = apply_filters( 'vc_frontend_editor_to_string', $shortcode, $shortcode_obj );

		$output = sprintf( '
<div class="vc_element" data-tag="%s" data-shortcode-controls="%s" data-model-id="%s" data-vc-content=".lqd-panel-body" data-tab-pane-id="%s">
	<div id="%s" role="tabpanel" class="lqd-tabs-pane fade %s">
		<div data-vc-content=".lqd-panel-body">
			<div class="lqd-panel-body">
				<div data-js-panel-body>%s%s</div>
			</div>
		</div>
	</div>
</div>',
			esc_attr( $shortcode['tag'] ),
			esc_attr( wp_json_encode( $shortcode_obj->shortcodeClass()->getControlsList() ) ),
			esc_attr( $shortcode['id'] ),
			esc_attr( $shortcode['attrs']['tab_id'] ),
			esc_attr( $shortcode['attrs']['tab_id'] ),
			( $this->first ? ' active in' : '' ),
			vc_container_anchor(),
			do_shortcode( $content )
		);

		$this->first = false;

		return $output;
	}
}
new LD_Tab_Section;