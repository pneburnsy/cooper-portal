<?php
/**
* Shortcode Liquid Carousel Marquee Tab
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Carousel_Marquee_Tab extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug         = 'ld_carousel_marquee_tab';
		$this->title        = esc_html__( 'Carousel Marquee', 'landinghub-core' );
		$this->icon         = 'la la-exchange-alt';
		$this->scripts      = array( 'flickity' );
		$this->description  = esc_html__( 'Create a marquee carousel.', 'landinghub-core' );
		$this->is_container  = true;
		$this->js_view       = 'VcBackendTtaTabsView';
		$this->as_parent     = array( 'only' => 'ld_carousel_marquee_section' );
		$this->custom_markup = '<div class="vc_tta-container" data-vc-action="collapse">
			<div class="vc_general vc_tta vc_tta-tabs vc_tta-color-backend-tabs-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-spacing-1 vc_tta-tabs-position-top vc_tta-controls-align-left">
				<div class="vc_tta-tabs-container">'
				. '<ul class="vc_tta-tabs-list">'
					. '<li class="vc_tta-tab" data-vc-tab data-vc-target-model-id="{{ model_id }}" data-element_type="ld_carousel_marquee_section"><a href="javascript:;" data-vc-tabs data-vc-container=".vc_tta" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-target-model-id="{{ model_id }}"><span class="vc_tta-title-text">Tab</span></a></li>'
				. '</ul>
				</div>
				<div class="vc_tta-panels vc_clearfix {{container-class}}">
					{{ content }}
				</div>
			</div>
		</div>';
		$this->default_content = '
			[ld_carousel_marquee_section title="Carousel Item"][/ld_carousel_marquee_section]
			[ld_carousel_marquee_section title="Carousel Item"][/ld_carousel_marquee_section]
			[ld_carousel_marquee_section title="Carousel Item"][/ld_carousel_marquee_section]';
		$this->admin_enqueue_js = array( vc_asset_url( 'lib/vc_tabs/vc-tabs.min.js' ) );

		parent::__construct();
	}

	public function get_params() {
		
		$options = array(
			array(
				'type'        => 'textfield',
				'param_name'  => 'marquee_speed',
				'heading'     => esc_html__( 'Speed', 'landinghub-core' ),
				'description' => esc_html__( 'Marquee speed. A number starting from 0. Default is 2', 'landinghub-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Cell Align', 'landinghub-core' ),
				'description' => esc_html__( 'Cells alignment.', 'landinghub-core' ),
				'param_name'  => 'cellalign',
				'value'       => array(
					esc_Html__( 'Left', 'landinghub-core' )   => 'left',
					esc_html__( 'Center', 'landinghub-core' ) => 'center',
					esc_html__( 'Right', 'landinghub-core' )  => 'right',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Fade Sides Carousel', 'landinghub-core' ),
				'description' => esc_html__( 'Fade the carousel right and left sides of the viewport.', 'landinghub-core' ),
				'param_name'  => 'fadesides',
				'value'       => array(
					esc_html__( 'Disable', 'landinghub-core' )  => '',
					esc_html__( 'Enable', 'landinghub-core' ) => 'lqd-fade-sides'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Draggable', 'landinghub-core' ),
				'description' => esc_html__( 'Enable/Disable draggableity of the carousel.', 'landinghub-core' ),
				'param_name'  => 'draggable',
				'value'       => array(
					esc_html__( 'Enable', 'landinghub-core' )  => 'yes',
					esc_html__( 'Disable', 'landinghub-core' ) => 'no'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Pause on hover', 'landinghub-core' ),
				'description' => esc_html__( 'Enable pause on hover carousel.', 'landinghub-core' ),
				'param_name'  => 'pause_on_hover',
				'value'       => array(
					esc_html__( 'Disable', 'landinghub-core' ) => '',
					esc_html__( 'Enable', 'landinghub-core' )  => 'yes',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Random Vertical Position', 'landinghub-core' ),
				'description' => esc_html__( 'Randomly position carousel cells.', 'landinghub-core' ),
				'param_name'  => 'randomveroffset',
				'value'       => array(
					esc_html__( 'Disable', 'landinghub-core' ) => '',
					esc_html__( 'Enable', 'landinghub-core' )  => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Reverse', 'landinghub-core' ),
				'description' => esc_html__( 'Reverse direction.', 'landinghub-core' ),
				'param_name'  => 'reverse',
				'value'       => array(
					esc_html__( 'Disable', 'landinghub-core' ) => '',
					esc_html__( 'Enable', 'landinghub-core' )  => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'shadow',
				'heading'     => esc_html__( 'Shadow', 'landinghub-core' ),
				'description' => esc_html__( 'Set shadow to items', 'landinghub-core' ),
				'value' => array(
					esc_html__( 'None', 'landinghub-core' ) => '',
					esc_html__( 'All Items', 'landinghub-core' ) => 'carousel-shadow-all',
				),
			),

		);
		foreach( $options as &$param ) {
			$param['group'] = esc_html__( 'Carousel Options', 'landinghub-core' );
		}
		
		$this->params = array_merge( 
			array(
				// Params goes here
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Auto Columns Width', 'landinghub-core' ),
					'description' => esc_html__( 'Set columns widths automatically based on their content widths.', 'landinghub-core' ),
					'param_name'  => 'columns_auto_width',
					'value'       => array(
						esc_html__( 'Disable', 'landinghub-core' ) => '',
						esc_html__( 'Enable', 'landinghub-core' )  => 'yes'
					)
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'auto_width_padding',
					'heading'     => esc_html__( 'Items Padding', 'landinghub-core' ),
					'description' => esc_html__( 'Set the space between each item.', 'landinghub-core' ),
					'value'				=> '15px',
					'dependency'  => array(
						'element' => 'columns_auto_width',
						'value'   => array( 'yes' )
					)
				),
				array(
					'type'        => 'responsive_columns',
					'param_name'  => 'columns',
					'heading'     => esc_html__( 'Number of Columns', 'landinghub-core' ),
					'std'         => 'md:3|sm:2|xs:1|spacing_xs:15px',
					'dependency'  => array(
						'element' => 'columns_auto_width',
						'value_not_equal_to'   => array( 'yes' )
					)
				),
			
			), $options ); 

		$this->add_extras();
	}
	
	public function before_output( $atts, &$content ) {

		global $liquid_carousel_marquee_tabs;

		$liquid_carousel_marquee_tabs = array();

		//parse ld_tab_section shortcode
		do_shortcode( $content );

		$atts['items'] = $liquid_carousel_marquee_tabs;

		return $atts;
	}
	
	protected function get_content() {

		$out = $columns = $has_width = '';
		
		$columns = vc_parse_multi_attribute( $this->atts[ 'columns' ] );
		if( !empty( $columns['xs'] ) || !empty( $columns['sm'] ) || !empty( $columns['md'] ) || !empty( $columns['lg'] ) ) {
			$has_width = ' has-width';
		}

		if ( $this->atts['items'] ) {
			foreach ( $this->atts[ 'items' ] as $tab ) {
				if ( vc_is_inline() && vc_frontend_editor()->post_shortcodes ) {
					$out .= $tab['content'];
				} else {
					$out .= sprintf( '<div class="carousel-item' . $has_width . '"><div class="carousel-item-inner"><div class="carousel-item-content">%1$s</div></div></div>', $tab['content'] );
				}
			}
		} else {
			$out .= vc_container_anchor();
		}

		echo $out;
	}

	protected function columnize_content( &$content ) {

		global $shortcode_tags;

		// Find all registered tag names in $content.
		preg_match_all( '@\[([^<>&/\[\]\x00-\x20=]++)@', $content, $matches );
		$tagnames = array_intersect( array_keys( $shortcode_tags ), $matches[1] );
		$pattern = get_shortcode_regex();
		
		$item_classname = 'carousel-item';

		foreach( $tagnames as $tag ) {
			$start = "[$tag";
			$end = "[/$tag]";

			if( ld_helper()->str_contains( $end, $content ) ) {
				$content = str_replace( $start, '<div class="' . $item_classname . '">' . $start, $content );
				$content = str_replace( $end, $end . '</div>', $content );
			}
			else {
				preg_match_all( '/' . $pattern . '/s', $content, $matches );

				foreach( array_unique( $matches[0] ) as $replace ) {
					$content = str_replace( $replace, '<div class="' . $item_classname . '">' . $replace . '</div>', $content );
				}
			}

		}
	}

	protected function get_options() {

		$opts = array();
		$raw = $this->atts;
		$ids = array(

			'cellalign'            => 'cellAlign',
			'draggable'            => 'draggable',
			'randomveroffset'      => 'randomVerOffset',
			'pause_on_hover'       => 'pauseAutoPlayOnHover',
			'reverse'       			 => 'rightToLeft',
			'marquee_speed'        => 'marqueeTickerSpeed',
			'columns_auto_width'   => 'columnsAutoWidth',
			
		);

		unset(
			$raw['content'],
			$raw['columns'],
			$raw['items'],
			$raw['fadesides'],
			$raw['shadow'],
			$raw['_id'],
			$raw['el_id'],
			$raw['el_class'],	
			$raw['auto_width_padding']
		);

		$raw = array_filter( $raw );
		$custom_opts = $arr = $offset_value = array();

		foreach( $raw as $id => $val ) {

			// Casting
			if( 'yes' === $val ) {
				$val = true;
			}
			if( 'no' === $val || '' === $val ) {
				$val = false;
			}
			else{
				$opts[ $ids[ $id ] ] = $val;
			}

		}
		
		$defaults = array(
			'marquee'    => true,
			'wrapAround' => true,	
			'equalHeightCells' => true,
			'middleAlignContent' => true
		);

		$opts = wp_parse_args( $opts, $defaults );

		echo " data-lqd-flickity='" . stripslashes( wp_json_encode( $opts ) ) ."'";
	}


	protected function get_randomveroffset() {

		$classname = '';

		if ( 'yes' === $this->atts['randomveroffset'] ) {
			$classname = 'carousel-items-random-v-offset';
		}

		return $classname;

	}

	protected function generate_css() {

		extract( $this->atts );
		$elements = array();
		$queries_css = '';

		$id = '.' . $this->get_id();
		
		if( !empty( $columns ) && empty($columns_auto_width) ) {
			
			$columns = vc_parse_multi_attribute( $columns );

			if( isset( $columns['xs'] ) ) {
				$width = 100/$columns['xs'];	
				$elements[liquid_implode( '.carousel-container%1$s .carousel-item' )]['width'] = $width . '%';
				$elements[liquid_implode( '.carousel-container%1$s .carousel-item' )]['flex-basis'] = $width . '%';
			}
			if( !empty( $columns['spacing_xs'] ) ) {
				$elements[liquid_implode( '.carousel-container%1$s .carousel-item' )]['padding-inline-start']      = $columns['spacing_xs'];
				$elements[liquid_implode( '.carousel-container%1$s .carousel-item' )]['padding-inline-end']     = $columns['spacing_xs'];
				$elements[liquid_implode( '.carousel-container%1$s .carousel-items.row' )]['margin-inline-start']  = '-' . $columns['spacing_xs'];
				$elements[liquid_implode( '.carousel-container%1$s .carousel-items.row' )]['margin-inline-end'] = '-' . $columns['spacing_xs'];
			}
			
			if( isset( $columns['sm'] ) || !empty( $columns['spacing_sm'] ) ) {
				
				$queries_css .= '@media (min-width: 768px) {';
					if( isset( $columns['sm'] ) ) {
						$width = 100/$columns['sm'];
						$queries_css .= '.carousel-container' . $id . ' .carousel-item { width:' . $width . '%; flex-basis: ' . $width . '%; }';
					}
					if( !empty( $columns['spacing_sm'] ) ) {
						$queries_css .= '.carousel-container' . $id . ' .carousel-item { padding-inline-start:' . $columns['spacing_sm'] . ';padding-inline-end:' . $columns['spacing_sm'] . ';}';
						$queries_css .= '.carousel-container' . $id . ' .carousel-items.row { margin-inline-start:-' . $columns['spacing_sm'] . ';margin-inline-end:-' . $columns['spacing_sm'] . ';}';
					}
					
				$queries_css .= '}';
			}
			if( isset( $columns['md'] ) || !empty( $columns['spacing_md'] ) ) {
				
				$queries_css .= '@media (min-width: 992px) {';
					if( isset( $columns['md'] ) ) {
						$width = 100/$columns['md'];
						$queries_css .= '.carousel-container' . $id . ' .carousel-item { width:' . $width . '%; flex-basis: ' . $width . '%; }';
					}
					if( !empty( $columns['spacing_md'] ) ) {
						$queries_css .= '.carousel-container' . $id . ' .carousel-item { padding-inline-start:' . $columns['spacing_md'] . ';padding-inline-end:' . $columns['spacing_md'] . ';}';
						$queries_css .= '.carousel-container' . $id . ' .carousel-items.row { margin-inline-start:-' . $columns['spacing_md'] . ';margin-inline-end:-' . $columns['spacing_md'] . ';}';
					}
				$queries_css .= '}';
			}
			if( isset( $columns['lg'] ) || !empty( $columns['spacing_lg'] ) ) {
				
				$queries_css .= '@media (min-width: 1200px) {';
					if( isset( $columns['lg'] ) ) {
						$width = 100/$columns['lg'];
						$queries_css .= '.carousel-container' . $id . ' .carousel-item { width:' . $width . '%; flex-basis: ' . $width . '%; }';
					}
					if( !empty( $columns['spacing_lg'] ) ) {
						$queries_css .= '.carousel-container' . $id . ' .carousel-item { padding-inline-start:' . $columns['spacing_lg'] . ';padding-inline-end:' . $columns['spacing_lg'] . ';}';
						$queries_css .= '.carousel-container' . $id . ' .carousel-items.row { margin-inline-start:-' . $columns['spacing_lg'] . ';margin-inline-end:-' . $columns['spacing_lg'] . ';}';
					}
				$queries_css .= '}';
			}
		}

		if ( !empty( $auto_width_padding ) ) {
			$elements[liquid_implode( '.carousel-container%1$s .carousel-item' )]['margin-inline-start'] = $auto_width_padding;
			$elements[liquid_implode( '.carousel-container%1$s .carousel-item' )]['margin-inline-end'] = $auto_width_padding;
		}

		$elements['media']['responsive'] = $queries_css;

		$this->dynamic_css_parser( $id, $elements );
	}

}
new LD_Carousel_Marquee_Tab;

// Carousel Tab
include_once 'liquid-carousel-section.php';