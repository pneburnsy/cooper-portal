<?php
/**
* Shortcode Process Box Container
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly
	
/**
* LD_Shortcode
*/
class LD_Process_Box_Container extends LD_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug            = 'ld_process_box_container';
		$this->title           = esc_html__( 'Process Box Container', 'landinghub-core' );
		$this->description     = esc_html__( 'Create a process box container', 'landinghub-core' );
		$this->icon            = 'la la-table';
		$this->content_element = true;
		$this->is_container    = true;
		$this->as_parent       = array( 'only' => 'ld_process_box' );
		$this->show_settings_on_create = true;

		$this->default_content = '
		[ld_process_box title="' . sprintf( '%s %d', 'Process Box', 1 ) . '"][/ld_process_box]
		[ld_process_box title="' . sprintf( '%s %d', 'Process Box', 2 ) . '"][/ld_process_box]';

		parent::__construct();
	}

	public function get_params() {
		
		$url = liquid_addons()->plugin_uri() . '/assets/img/sc-preview/process-box/';
		
		$this->params = array(
			array(
				'type'        => 'select_preview',
				'param_name'  => 'template',
				'heading'     => esc_html__( 'Style', 'landinghub-core' ),
				'admin_label' => true,
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
				),
				'save_always' => true,
			),
			array(
				'type' => 'liquid_colorpicker',
				'only_solid' => true,
				'param_name' => 'sep_color',
				'heading' => esc_html__( 'Separator Color', 'landinghub-core' ),
				'group' => esc_html__( 'Design Options', 'landinghub-core' ),
				'dependency' => array(
					'element' => 'template',
					'value' => array( 'style01', 'style05' ),
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
		);
		
		
		$this->add_extras();
	}

	protected function get_row_classes() {

		$style = $this->atts['template'];
		$classes = array('lqd-pb-row', 'row', 'd-md-flex');

		if (
			$style === 'style02' ||
			$style === 'style03' ||
			$style === 'style06' ||
			$style === 'style08'
		) {
			$classes[] = 'flex-column';
		}

		return implode(' ', $classes);

	}
	
	protected function get_class( $style ) {

		$hash = array(
			'style01'  => 'lqd-pb-nums lqd-pb-icon-between',
			'style02'  => 'lqd-pb-icons lqd-pb-nums',
			'style03'  => 'lqd-pb-nums lqd-pb-zigzag',
			'style04'  => 'lqd-pb-icons lqd-pb-nums',
			'style05'  => 'lqd-pb-nums lqd-pb-icon-between-middle',
			'style06'  => 'lqd-pb-icons lqd-pb-zigzag-2',
			'style07'  => 'lqd-pb-icons lqd-pb-nums',
			'style08'  => 'lqd-pb-nums lqd-pb-icons',
			'style09'  => 'lqd-pb-nums',

		);

		return $hash[ $style ];
	}
	
	protected function columnize_content( &$content ) {

		global $shortcode_tags;

		// Find all registered tag names in $content.
		preg_match_all( '@\[([^<>&/\[\]\x00-\x20=]++)@', $content, $matches );
		$tagnames = array_intersect( array_keys( $shortcode_tags ), $matches[1] );
		$pattern = get_shortcode_regex();
		$style = $this->atts['template'];
		
		$item_classname = array(
			'lqd-pb-column'
		);
		if( 
			'style01' === $style || 
			'style04' === $style || 
			'style05' === $style || 
			'style07' === $style 
		) {
			$item_classname[] = 'col-md-4';
		}
		elseif( 
			'style02' === $style || 
			'style06' === $style || 
			'style08' === $style 
		) {
			$item_classname[] = 'col-md-12';
		}
		elseif( 'style03' === $style ) {
			$item_classname[] = 'col-sm-6';
		}
		elseif( 'style09' === $style ) {
			$item_classname[] = 'col-md-3 col-sm-6';
		}

		foreach( $tagnames as $tag ) {
			$start = "[$tag";
			$end = "[/$tag]";

			if( ld_helper()->str_contains( $end, $content ) ) {
				$content = str_replace( $start, '<div class="' . implode( ' ', $item_classname ) . '">' . $start, $content );
				$content = str_replace( $end, $end . '</div>', $content );
			}
			else {
				preg_match_all( '/' . $pattern . '/s', $content, $matches );

				foreach( array_unique( $matches[0] ) as $replace ) {
					$content = str_replace( $replace, '<div class="' . implode( ' ', $item_classname ) . '">' . $replace . '</div>', $content );
				}
			}

		}
	}
	
	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();
		
		if( !empty( $sep_color ) ) {
			$elements[ liquid_implode( '%1$s.lqd-pb-icon-between .lqd-pb-column:not(:last-child):after, %1$s.lqd-pb-icon-between-middle .lqd-pb-column:not(:last-child):after' ) ]['color'] = $sep_color;
		}
		
		$this->dynamic_css_parser( $id, $elements );
	}
}
new LD_Process_Box_Container;
class WPBakeryShortCode_LD_Process_Box_Container extends WPBakeryShortCodesContainer {}