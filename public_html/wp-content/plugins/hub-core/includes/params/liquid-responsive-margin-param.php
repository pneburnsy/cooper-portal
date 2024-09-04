<?php
/**
* Liquid Responsive Margin
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
 * [liquid_param_select_preview description]
 * @method liquid_param_select_preview
 * @param  [type]               $settings [description]
 * @param  [type]               $value    [description]
 * @return [type]                         [description]
 */
/*
vc_add_shortcode_param( 'css_responsive_editor', 'liquid_param_responsive_options' );
function liquid_param_responsive_options( $settings, $value ) {

	return 'Hi';
	
}
*/
if( ! class_exists( 'Liquid_Responsive_Margin' ) ) {

	class Liquid_Responsive_Margin  {
		
		/**
		 * @var array
		 */
		protected $layers = array( 'margin', 'content' );
		/**
		 * @var array
		 */
		protected $positions = array( 'top', 'right', 'bottom', 'left' );
		/**
		 * @var array
		 */
		protected $devices = array( 'all', 'small', 'medium', 'large' );

		protected $descriptions = array(
			'small'   => 'All screen sizes',
			'medium'  => 'Small screens (mobile) and up. Values inherit from the smaller screens if they are left blank.', 
			'large'  => 'Medium screens (tablets) and up. Values inherit from the smaller screens if they are left blank.',
			'all' => 'Large screens (desktops) and up. Values inherit from the smaller screens if they are left blank.'
		);
		
		function __construct() {

			if ( function_exists( 'vc_add_shortcode_param' ) ) {
				vc_add_shortcode_param( 'responsive_margin', array( $this, 'responsive_param' ) );
			}
		}

		function responsive_param( $settings, $value ) {
			
			$label = isset( $settings['label'] ) ? $settings['label'] : esc_html__( 'Responsive Margin', 'landinghub-core' );
			$values = $this->get_responsive_values( $value );
			$output = '<div class="liquid-responsive-single-css-editor-container vc_css-editor">';
				
			$devices = $this->devices;
			$descriptions = $this->descriptions;
			$i = 0;

			foreach( $devices as $device ) {
				
				$active = ( $i == 0 ) ? 'active' : '';
				
				$output .= '<h3 class="liquid-responsive-css-heading '. $device .' ' . $active . '" data-target="'. $device .'" title="' . $descriptions[ $device ] . '">' . $device  . '</h3>';
				$output .= '<div class="liquid-main-responsive-wrapper" data-size="'. $device .'">';
				$output .= '<div class="liquid-inner-wrap">';
				$output .=  $this->onionLayout( $device, $values );	
				$output .= '</div>';
				$output .= '</div>';
				
				$i++;	
			};
			
			$output .= '</div>';
			$output .= '<input placeholder="-" name="' . $settings['param_name'] . '" class="wpb_vc_param_value  ' . $settings['param_name'] . ' ' . $settings['type'] . '_field" type="hidden" value="' . $value . '" />';
			
			return $output;
			
		}
		
		public static function get_responsive_values( $value ) {
			return vc_parse_multi_attribute( $value, array( 'margin_top_large' => '', 'margin_right_large' => '', 'margin_bottom_large' => '', 'margin_left_large' => '', 'margin_top_medium' => '', 'margin_right_medium' => '', 'margin_bottom_medium' => '', 'margin_left_medium' => '', 'margin_top_small' => '', 'margin_right_small' => '', 'margin_bottom_small' => '', 'margin_left_small' => '', 'border_top_small' => '' ) );
		}

		/**
		 * @return string
		 */
		function onionLayout( $prefix = '', $values = array() ) {

			$output = '<div class="vc_layout-onion">'
			          . '    <div class="vc_margin">' . $this->layerControls( 'margin', $prefix, $values )
			          . '    	<div class="vc_content"><i></i></div>'
			          . '    </div>'
			          . '</div>';

			return $output;
		}
		
		/**
		 * @param $name
		 * @param string $prefix
		 *
		 * @return string
		 */
		protected function layerControls( $name, $prefix = '', $values = array() ) {

			$output = '<label>' . $name . '</label>';

			foreach ( $this->positions as $pos ) {
				$output .= '<input type="number" name="' . $name . '_' . $pos . ( '' !== $prefix ? '_' . $prefix : '' ) . '" data-name="' . $name . '-' . $pos . ( '' !== $prefix ? '-' . $prefix : '' ) . '" class="vc_' . $pos . '" placeholder="-" value="' .  $values['' . $name . '_' . $pos . ( '' !== $prefix ? '_' . $prefix : '' ) . ''] . '">';
			}

			return $output;
		
		}
		
		public static function generate_css( $value, $id = '' ) {
			
			if( empty( $value ) ){
				return;
			}
			
			$values = Liquid_Responsive_Margin::get_responsive_values( $value );
			$resolutions = array( 'all', 'small', 'medium', 'large' );
			$positions = array( 'top', 'right', 'bottom', 'left' );
			$atts = array( 'margin' );
			$media_query = array(
				'small'  => '@media (min-width: 768px)',
				'medium'  => '@media (min-width: 992px)',
				'large' => '@media (min-width: 1200px)',
			);
			
			$res_css = '';
			$res_style = array( 'all' => '', 'small' => '', 'medium' => '', 'large' => '' );

			foreach ( $atts as $attr ) {
				foreach( $positions as $pos ) {

					if(  isset( $values['' . $attr . '_' . $pos .'_small'] ) && $values['' . $attr . '_' . $pos .'_small'] != '' ) {
						$res_style['small'] .= $attr . '-' . $pos . ':' . $values['' . $attr . '_' . $pos .'_small'] . 'px !important; ';	
					}
					if(  isset( $values['' . $attr . '_' . $pos .'_medium'] ) && $values['' . $attr . '_' . $pos .'_medium'] != '' ) {
						$res_style['medium'] .= $attr . '-' . $pos . ':' . $values['' . $attr . '_' . $pos .'_medium'] . 'px !important; ';
					} 
					if(  isset( $values['' . $attr . '_' . $pos .'_large'] ) && $values['' . $attr . '_' . $pos .'_large'] != '' ) {
						$res_style['large'] .= $attr . '-' . $pos . ':' . $values['' . $attr . '_' . $pos .'_large'] . 'px !important; ';
					} 
				}
			}			

			if( isset( $res_style['small'] ) && $res_style['small'] !== '' ) {
				$res_css .= $media_query['small'] . ' { '. '.' . $id . ' {' . $res_style['small'] . ' }  } ';
			}
			if( isset( $res_style['medium'] ) && $res_style['medium'] !== '' ) {
				$res_css .= $media_query['medium'] . ' { '. '.' . $id . ' {' . $res_style['medium'] . ' }  } ';
			}
			if( isset( $res_style['large'] ) && $res_style['large'] !== '' ) {
				$res_css .= $media_query['large'] . ' { '. '.' . $id . ' {' . $res_style['large'] . ' }  } ';
			}

			return $res_css;		
		}
	}
}

new Liquid_Responsive_Margin;