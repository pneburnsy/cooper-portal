<?php

/**
* Liquid Responsive Textfield Param
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

if( !class_exists( 'Liquid_Responsive_Texfield_Param' ) ) {

	class Liquid_Responsive_Texfield_Param  {
		
		
		protected $css = null;
		
		/**
		 * @var array
		 */
		protected $positions = array( 'text' );

		/**
		 * @var array
		 */
		protected $devices = array( 'small', 'medium', 'large', 'all' );
		
		protected $icons = array(
			'all'   => 'las la-desktop',
			'small'  => 'las la-mobile', 
			'medium'  => 'las la-tablet la-rotate-n-90', 
			'large' => 'las la-tablet'
		);
		protected $descriptions = array(
			'small'   => 'All screen sizes',
			'medium'  => 'Small screens (mobile) and up. Values inherit from the smaller screens if they are left blank. ', 
			'large'  => 'Medium screens (tablets) and up. Values inherit from the smaller screens if they are left blank. ',
			'all' => 'Large screens (desktops) and up. Values inherit from the smaller screens if they are left blank. '
		);
		
		function __construct() {

			if ( function_exists( 'vc_add_shortcode_param' ) ) {
				vc_add_shortcode_param( 'responsive_textfield', array( $this, 'responsive_param' ) );
			}

		}
		
		function responsive_param( $settings, $value ) {
			
			$label = isset( $settings['label'] ) ? $settings['label'] : esc_html__( 'Responsive Textfield', 'landinghub-core' );
			$devices = $this->devices;
			$icons  = $this->icons;
			$descriptions  = $this->descriptions;
			
			if ( strpos( $value, 'text_' ) !== false ) {
				$values = $this->get_responsive_values( $value );
			}
			else {
				$value = 'text_small:' . $value . '';
			}

			$values = $this->get_responsive_values( $value );
			$attribute = isset( $settings['css'] ) ? $settings['css'] : '';
			$this->css = $attribute;
			

			$output .= '<div class="liquid-responsive-container vc_css-editor">';
				
			
			foreach( $devices as $device ) {
				
				$output .= '<h3 class="liquid-responsive-css-heading '. $device .'" data-target="'. $device .'" title="' . $descriptions[ $device ] . '"><i class="' . $icons[ $device ] . '"></i> ' . $attribute . '</h3>';
				$output .= '<div class="liquid-main-responsive-wrapper" data-size="'. $device .'">';
				$output .= '<div class="liquid-inner-wrap">';
				$output .=  $this->onionLayout( $device, $values );	
				$output .= '</div>';
				$output .= '</div>';
				
			};
			
			$output .= '</div>';

			$output .= '<input placeholder="-" name="' . $settings['param_name'] . '" class="wpb_vc_param_value  ' . $settings['param_name'] . ' ' . $settings['type'] . '_field" type="hidden" value="' . $value . '" />';
			
			return $output;

		}

		public static function get_responsive_values( $value ) {
			
			return vc_parse_multi_attribute( $value, array( 'text_all' => '', 'text_large' => '', 'text_medium' => '', 'text_small' => '' ) );
		}
		
		/**
		 * @return string
		 */
		function onionLayout( $prefix = '', $values = array() ) {

			$output =$this->layerControls( $this->css, $prefix, $values )
							. '<div class="vc_content"><i></i></div>';

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
			$output .= '<input placeholder="-" type="text" name="text' . ( '' !== $prefix ? '_' . $prefix : '' ) . '" data-name="text' . ( '' !== $prefix ? '-' . $prefix : '' ) . '" class="vc_textfield wpb-textinput" value="' .  $values['text_'.$prefix] . '">';


			return $output;
		
		}
		
		public static function generate_css( $css,  $value, $id = '' ) {
			
			if( empty( $value ) ){
				return;
			}

			$values = Liquid_Responsive_Texfield_Param::get_responsive_values( $value );

			$resolutions = array( 'all','small', 'medium', 'large' );
			$positions = array( 'text' );
			
			$atts = array( $css );

			$media_query = array(
				'medium'  => '@media (min-width: 768px)',
				'large'   => '@media (min-width: 992px)',
				'all'     => '@media (min-width: 1200px)',
			);
			
			$res_css = '';
			$res_style = array( 'all' => '', 'small' => '', 'medium' => '', 'large' => '' );


			if(  isset( $values[ 'text_all'] ) && $values[ 'text_all'] != '' ) {
				$res_style['all'] .= $css . ':' . $values[ 'text_all'] . ';';
			}
			if(  isset( $values[ 'text_small'] ) && $values[ 'text_small'] != '' ) {
				$res_style['small'] .= $css . ':' . $values[ 'text_small'] . ';';
			}
			if(  isset( $values[ 'text_medium'] ) && $values[ 'text_medium'] != '' ) {
				$res_style['medium'] .= $css . ':' . $values[ 'text_medium'] . ';';
			}
			if(  isset( $values[ 'text_large'] ) && $values[ 'text_large'] != '' ) {
				$res_style['large'] .= $css . ':' . $values[ 'text_large'] . ';';
			}

			if( isset( $res_style['small'] ) && $res_style['small'] !== '' ) {
				$res_css .= '.' . $id . ' {' . $res_style['small'] . ' } ';
			}
			if( isset( $res_style['medium'] ) && $res_style['medium'] !== '' ) {
				$res_css .= $media_query['medium'] . ' { '. '.' . $id . ' {' . $res_style['medium'] . ' }  } ';
			}
			if( isset( $res_style['large'] ) && $res_style['large'] !== '' ) {
				$res_css .= $media_query['large'] . ' { '. '.' . $id . ' {' . $res_style['large'] . ' }  } ';
			}
			if( isset( $res_style['all'] ) && $res_style['all'] !== '' ) {
				$res_css .= $media_query['all'] . ' { '. '.' . $id . ' {' . $res_style['all'] . ' }  } ';
			}

			return $res_css;		
		}
			
	}
	
}

new Liquid_Responsive_Texfield_Param;