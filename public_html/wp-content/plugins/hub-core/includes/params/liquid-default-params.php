<?php
/**
* Default Params
*/

if( !defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

/**
 * [liquid_default_params description]
 * @method liquid_default_params
 * @return [type]               [description]
 */
function liquid_default_params() {

	$params = array(

		'title' => array(
			'type'          => 'textfield',
			'param_name'	=> 'title',
			'heading'		=> esc_html__( 'Title', 'landinghub-core' ),
			'admin_label'	=> true
		),

		'label' => array(
			'type'			=> 'textfield',
			'param_name'	=> 'label',
			'heading'		=> esc_html__( 'Label', 'landinghub-core' ),
			'admin_label'	=> true
		),

		'limit' => array(
			'type'        => 'textfield',
			'param_name'  => 'limit',
			'heading'     => esc_html__( 'Limit', 'landinghub-core' ),
			'admin_label' => true
		),

		'link' => array(
			'type'        => 'vc_link',
			'param_name'  => 'link',
			'heading'     => esc_html__( 'URL (Link)', 'landinghub-core' ),
			'description' => esc_html__( 'Add link to button.', 'landinghub-core' )
		),

		'network' => array(
			'type'       => 'dropdown',
			'param_name' => 'network',
			'heading'    => esc_html__( 'Network', 'landinghub-core' ),
			'value'      => array(
				esc_html__( 'Amazon', 'landinghub-core' )          => 'fa-amazon',
				esc_html__( 'Behance', 'landinghub-core' )         => 'fa-behance',
				esc_html__( 'Behance Square', 'landinghub-core' )  => 'fa-behance-square',
				esc_html__( 'Codepen', 'landinghub-core' )         => 'fa-codepen',
				esc_html__( 'Deviantart', 'landinghub-core' )      => 'fa-deviantart',
				esc_html__( 'Digg', 'landinghub-core' )            => 'fa-digg',
				esc_html__( 'Dribbble', 'landinghub-core' )        => 'fa-dribbble',
				esc_html__( 'Facebook', 'landinghub-core' )        => 'fa-facebook',
				esc_html__( 'Facebook Square', 'landinghub-core' ) => 'fa-facebook-square',
				esc_html__( 'Flickr', 'landinghub-core' )          => 'fa-flickr',
				esc_html__( 'Github', 'landinghub-core' )         => 'fa-github',
				esc_html__( 'Google', 'landinghub-core' )         => 'fa-google',
				esc_html__( 'Google Plus', 'landinghub-core' )    => 'fa-google-plus',
				esc_html__( 'Instagram', 'landinghub-core' )      => 'fa-instagram',
				esc_html__( 'Jsfiddle', 'landinghub-core' )       => 'fa-jsfiddle',
				esc_html__( 'Line', 'landinghub-core' )       	  => 'fa-line',
				esc_html__( 'Linkedin', 'landinghub-core' )       => 'fa-linkedin',
				esc_html__( 'Medium', 'landinghub-core' )         => 'fa-medium',
				esc_html__( 'Paypal', 'landinghub-core' )         => 'fa-paypal',
				esc_html__( 'Pinterest', 'landinghub-core' )      => 'fa-pinterest',
				esc_html__( 'Pinterest P', 'landinghub-core' )    => 'fa-pinterest-p',
				esc_html__( 'Reddit', 'landinghub-core' )         => 'fa-reddit',
				esc_html__( 'Reddit Square', 'landinghub-core' )  => 'fa-reddit-square',
				esc_html__( 'RSS', 'landinghub-core' )            => 'fa-rss',
				esc_html__( 'RSS Square', 'landinghub-core' )     => 'fa-rss-square',
				esc_html__( 'Skype', 'landinghub-core' )          => 'fa-skype',
				esc_html__( 'Slack', 'landinghub-core' )          => 'fa-slack',
				esc_html__( 'Snapchat', 'landinghub-core' )       => 'fa-snapchat',
				esc_html__( 'Sound Cloud', 'landinghub-core' )    => 'fa-soundcloud',
				esc_html__( 'Spotify', 'landinghub-core' )        => 'fa-spotify',
				esc_html__( 'Stack Overflow', 'landinghub-core' ) => 'fa-stack-overflow',
				esc_html__( 'TikTok', 'landinghub-core' )         => 'fa-tiktok',
				esc_html__( 'Telegram', 'landinghub-core' )       => 'fa-telegram',
				esc_html__( 'Trello', 'landinghub-core' )         => 'fa-trello',
				esc_html__( 'Tumblr', 'landinghub-core' )         => 'fa-tumblr',
				esc_html__( 'Twitch', 'landinghub-core' )         => 'fa-twitch',
				esc_html__( 'Twitter', 'landinghub-core' )        => 'fa-twitter',
				esc_html__( 'Twitter Square', 'landinghub-core' ) => 'fa-twitter-square',
				esc_html__( 'Vimeo', 'landinghub-core' )          => 'fa-vimeo',
				esc_html__( 'Wordpress', 'landinghub-core' )      => 'fa-wordpress',
				esc_html__( 'Youtube', 'landinghub-core' )   	  => 'fa-youtube',
				esc_html__( 'Youtube Play', 'landinghub-core' )   => 'fa-youtube-play',
				esc_html__( 'Weixin', 'landinghub-core' )         => 'fa-weixin',
				esc_html__( 'Weibo', 'landinghub-core' )          => 'fa-weibo',
				esc_html__( 'WhatsApp', 'landinghub-core' )       => 'fa-whatsapp',
				esc_html__( 'Yahoo', 'landinghub-core' )          => 'fa-yahoo',
				esc_html__( 'Tencent-weibo', 'landinghub-core' )  => 'fa-tencent-weibo',
				esc_html__( 'Renren', 'landinghub-core' )         => 'fa-renren',
				esc_html__( 'Qq', 'landinghub-core' )             => 'fa-qq',				
				
			),
			'admin_label' => true
		)
	);

	ld_helper()->add_params($params);
}
liquid_default_params(); // Init


/**
 * [liquid_get_network_class description]
 * @method liquid_get_network_class
 * @param  [type]                  $network [description]
 * @return [type]                           [description]
 */
function liquid_get_network_class( $network ) {

	$hash = array(
		'fa-facebook' => array(
			'bg' => 'bg-facebook',
			'icon' => 'fa fa-facebook',
			'text' => 'Facebook'
		),		
		'fa-facebook-square' => array(
			'bg' => 'bg-facebook-square',
			'icon' => 'fa fa-facebook-square',
			'text' => 'Facebook'
		),
		'fa-twitch' => array(
			'bg' => 'bg-twitch',
			'icon' => 'fa fa-twitch',
			'text' => 'Twitch'
		),
		
		'fa-twitter' => array(
			'bg' => 'bg-twitter',
			'icon' => 'fa fa-twitter',
			'text' => 'Twitter'
		),
		'fa-twitter-square' => array(
			'bg' => 'bg-twitter-square',
			'icon' => 'fa fa-twitter-square',
			'text' => 'Twitter Square'
		),
		'fa-youtube' => array(
			'bg' => 'bg-youtube',
			'icon' => 'fa fa-youtube',
			'text' => 'Youtube'
		),
		'fa-youtube-play' => array(
			'bg' => 'bg-youtube-play',
			'icon' => 'fa fa-youtube-play',
			'text' => 'Youtube Play'
		),

		'fa-google' => array(
			'bg' => 'bg-google',
			'icon' => 'fa fa-google',
			'text' => 'Google'
		),
		'fa-google-plus' => array(
			'bg' => 'bg-google-plus',
			'icon' => 'fa fa-google-plus',
			'text' => 'Google+'
		),
		'fa-instagram' => array(
			'bg' => 'bg-instagram',
			'icon' => 'fa fa-instagram',
			'text' => 'Instagram'
		),
		'fa-flickr' => array(
			'bg' => 'bg-flickr',
			'icon' => 'fa fa-flickr',
			'text' => 'Flickr'
		),
		'fa-pinterest' => array(
			'bg' => 'bg-pinterest',
			'icon' => 'fa fa-pinterest',
			'text' => 'Pinterest'
		),
		'fa-pinterest-p' => array(
			'bg' => 'bg-pinterest-p',
			'icon' => 'fa fa-pinterest-p',
			'text' => 'Pinterest P'
		),
		'fa-vimeo' => array(
			'bg' => 'bg-vimeo',
			'icon' => 'fa fa-vimeo',
			'text' => 'Vimeo'
		),
		'fa-linkedin' => array(
			'bg' => 'bg-linkedin',
			'icon' => 'fa fa-linkedin',
			'text' => 'Linkedin'
		),
		'fa-github' => array(
			'bg' => 'bg-github',
			'icon' => 'fa fa-github',
			'text' => 'Github'
		),
		'fa-dribbble' => array(
			'bg' => 'bg-dribbble',
			'icon' => 'fa fa-dribbble',
			'text' => 'Dribbble'
		),
		'fa-skype' => array(
			'bg' => 'bg-skype',
			'icon' => 'fa fa-skype',
			'text' => 'Skype'
		),
		'fa-behance' => array(
			'bg' => 'bg-behance',
			'icon' => 'fa fa-behance',
			'text' => 'Behance'
		),
		'fa-behance-square' => array(
			'bg' => 'bg-behance',
			'icon' => 'fa fa-behance-square',
			'text' => 'Behance Square'
		),
		'fa-rss' => array(
			'bg' => 'bg-rss',
			'icon' => 'fa fa-rss',
			'text' => 'Rss'
		),
		'fa-codepen' => array(
			'bg' => 'bg-codepen',
			'icon' => 'fa fa-codepen',
			'text' => 'Codepen'
		),
		'fa-deviantart' => array(
			'bg' => 'bg-deviantart',
			'icon' => 'fa fa-deviantart',
			'text' => 'Devianart'
		),
		'fa-digg' => array(
			'bg' => 'bg-digg',
			'icon' => 'fa fa-digg',
			'text' => 'Digg'
		),
		'fa-jsfiddle' => array(
			'bg' => 'bg-jsfiddle',
			'icon' => 'fa fa-jsfiddle',
			'text' => 'Jsfiddle'
		),
		'fa-medium' => array(
			'bg' => 'bg-medium',
			'icon' => 'fa fa-medium',
			'text' => 'Medium'
		),
		'fa-paypal' => array(
			'bg' => 'bg-paypal',
			'icon' => 'fa fa-paypal',
			'text' => 'Paypal'
		),
		'fa-reddit' => array(
			'bg' => 'bg-reddit',
			'icon' => 'fa fa-reddit',
			'text' => 'Reddit'
		),
		'fa-reddit-square' => array(
			'bg' => 'bg-reddit-square',
			'icon' => 'fa fa-reddit-square',
			'text' => 'Reddit Square'
		),
		'fa-slack' => array(
			'bg' => 'bg-slack',
			'icon' => 'fa fa-slack',
			'text' => 'Slack'
		),
		'fa-snapchat' => array(
			'bg' => 'bg-snapchat',
			'icon' => 'fa fa-snapchat',
			'text' => 'Snapchat'
		),
		'fa-soundcloud' => array(
			'bg' => 'bg-soundcloud',
			'icon' => 'fa fa-soundcloud',
			'text' => 'Soundcloud'
		),
		'fa-spotify' => array(
			'bg' => 'bg-spotify',
			'icon' => 'fa fa-spotify',
			'text' => 'Spotify'
		),
		'fa-stack-overflow' => array(
			'bg' => 'bg-stack-overflow',
			'icon' => 'fa fa-stack-overflow',
			'text' => 'Stack Overflow'
		),
		'fa-telegram' => array(
			'bg' => 'bg-telegram',
			'icon' => 'fa fa-telegram',
			'text' => 'Telegram'
		),
		'fa-trello' => array(
			'bg' => 'bg-trello',
			'icon' => 'fa fa-trello',
			'text' => 'Trello'
		),
		'fa-tumblr' => array(
			'bg' => 'bg-tumblr',
			'icon' => 'fa fa-tumblr',
			'text' => 'Tumblr'
		),
		'fa-wordpress' => array(
			'bg' => 'bg-wordpress',
			'icon' => 'fa fa-wordpress',
			'text' => 'WordPress'
		),
		'fa-whatsapp' => array(
			'bg' => 'bg-whatsapp',
			'icon' => 'fa fa-whatsapp',
			'text' => 'Whatsapp'
		),
		'fa-tiktok' => array(
			'bg' => 'bg-whatsapp',
			'icon' => 'fab fa-tiktok',
			'text' => 'TikTok'
		),
	);

	return $hash[ $network ];
}


/**
 * [liquid_get_link_attributes description]
 * @method liquid_get_link_attributes
 * @param  [type]                    $link     [description]
 * @param  boolean                   $fallback [description]
 * @return [type]                              [description]
 */
function liquid_get_link_attributes( $link, $fallback = true ) {

	// fallback to home_url
	$attributes['href'] = $fallback && is_bool( $fallback ) ? esc_url( home_url('/') ) : $fallback;

	// Link
	$link = ( '||' === $link ) ? '' : $link;
	$link = vc_build_link( $link );
	if ( strlen( $link['url'] ) > 0 ) {

		$attributes['href'] = esc_url( trim( $link['url'] ) );
		$attributes['title'] = esc_attr( trim( $link['title'] ) );
			if ( ! empty( $link['target'] ) ) {
				$attributes['target'] = esc_attr( trim( $link['target'] ) );
			}
	}

	return $attributes;
}

/**
 * [liquid_get_image description]
 * @method liquid_get_image
 * @param  [type]          $attachment_id [description]
 * @return [type]                         [description]
 */
function liquid_get_image( $attachment_id ) {

	if( ! $attachment_id || ! is_numeric( $attachment_id ) ) {
		return '';
	}

	$url = wp_get_attachment_url( $attachment_id );

	return $url ? esc_url( $url ) : false;
}

/**
 * [liquid_get_image_src description]
 * @method liquid_get_image_src
 * @param  [type]              $attachment_id [description]
 * @return [type]                             [description]
 */
function liquid_get_image_src( $attachment_id, $size = 'full' ) {

	if( ! $attachment_id || ! is_numeric( $attachment_id ) ) {
		return '';
	}

	$attachment = wp_get_attachment_image_src( $attachment_id, $size );
	if( !empty( $attachment ) && !empty( $attachment[0] ) ) {
		$attachment[0] = esc_url( $attachment[0] );
	}
	else {
		$attachment = false;
	}

	return $attachment;
}

/**
 * [liquid_include_svg description]
 * @method liquid_include_svg
 * @param  [type]            $attachment_id [description]
 * @return [type]                           [description]
 */
function liquid_include_svg( $attachment_id ) {

	if( ! $attachment_id || ! is_numeric( $attachment_id ) ) {
		return '';
	}

	$url = get_attached_file( $attachment_id );

	return $url ? $url : false;
}

/**
 * [liquid_get_animation_preset description]
 * @method liquid_get_animation_preset
 * @param  [type]                  $preset [description]
 * @return [type]                           [description]
 */
function liquid_get_animation_preset( $preset ) {

	$hash = array(

		'Fade In' => array(
			'from' => array( 'opacity' => 0 ),
			'to'   => array( 'opacity' => 1 ),
		),
		'Fade In Down' => array(
			'from' => array( 'opacity' => 0, 'translateY' => -150 ),
			'to'   => array( 'opacity' => 1, 'translateY' => 0 ),
		),
		'Fade In Up' => array(
			'from' => array( 'opacity' => 0, 'translateY' => 150 ),
			'to'   => array( 'opacity' => 1, 'translateY' => 0 ),
		),
		'Fade In Left' => array(
			'from' => array( 'opacity' => 0, 'translateX' => -150 ),
			'to'   => array( 'opacity' => 1, 'translateX' => 0 ),
		),
		'Fade In Right' => array(
			'from' => array( 'opacity' => 0, 'translateX' => 150 ),
			'to'   => array( 'opacity' => 1, 'translateX' => 0 ),
		),
		'Flip In Y' => array(
			'from' => array( 'opacity' => 0, 'translateX' => 150, 'rotateY' => 30 ),
			'to'   => array( 'opacity' => 1, 'translateX' => 0, 'rotateY' => 0 ),
		),
		'Flip In X' => array(
			'from' => array( 'opacity' => 0, 'translateY' => 150, 'rotateX' => -30 ),
			'to'   => array( 'opacity' => 1, 'translateY' => 0, 'rotateX' => 0 ),
		),
		'Scale Up' => array(
			'from' => array( 'opacity' => 0, 'scale' => 0.75 ),
			'to'   => array( 'opacity' => 1, 'scale' => 1 ),
		),
		'Scale Down' => array(
			'from' => array( 'opacity' => 0, 'scale' => 1.25 ),
			'to'   => array( 'opacity' => 1, 'scale' => 1 ),
		),

	);
	
	return $hash[ $preset ];
}


/**
 * [liquid_get_parallax_preset description]
 * @method liquid_get_parallax_preset
 * @param  [type]                  $preset [description]
 * @return [type]                           [description]
 */
function liquid_get_parallax_preset( $preset ) {

	$hash = array(

		'fadeIn' => array(
			'from' => array( 'opacity' => 0, 'y' => 0 ),
			'to'   => '',
		),
		'fadeInDownLong' => array(
			'from' => array( 'y' => '-100%', 'opacity' => 0 ),
			'to'   => array( 'y' => '0%', 'opacity' => 1 ),
		),
		'fadeInDownShort' => array(
			'from' => array( 'opacity' => 0, 'y' => -35 ),
			'to'   => '',
		),
		'fadeInLeftLong' => array(
			'from' => array( 'y' => 0, 'x' => '-100%', 'opacity' => 0 ),
			'to'   => array( 'x' => '0%', 'opacity' => 1 ),
		),
		'fadeInLeftShort' => array(
			'from' => array( 'y' => 0, 'x' => -35, 'opacity' => 0 ),
			'to'   => '',
		),
		'fadeInRightLong' => array(
			'from' => array( 'y' => 0, 'x' => '100%', 'opacity' => 0 ),
			'to'   => array( 'x' => '0%', 'opacity' => 1 ),
		),
		'fadeInRightShort' => array(
			'from' => array( 'y' => 0, 'x' => 35, 'opacity' => 0 ),
			'to'   => '',
		),
		'fadeInUpLong' => array(
			'from' => array( 'y' => '100%', 'opacity' => 0 ),
			'to'   => array( 'y' => '0%', 'opacity' => 1 ),
		),
		'fadeInUpShort' => array(
			'from' => array( 'y' => 35, 'opacity' => 0 ),
			'to'   => '',
		),
		'slideDownLong' => array(
			'from' => array( 'y' => '-100%' ),
			'to'   => array( 'y' => '0%' ),
		),
		'slideLeftLong' => array(
			'from' => array( 'y' => 0, 'x' => '-100%', ),
			'to'   => array( 'x' => '0%' ),
		),
		'slideLeftShort' => array(
			'from' => array( 'y' => 0, 'x' => -35 ),
			'to'   => '',
		),
		'slideRightLong' => array(
			'from' => array( 'y' => 0, 'x' => '100%' ),
			'to'   => array( 'x' => '0%' ),
		),
		'slideRightShort' => array(
			'from' => array( 'y' => 0, 'x' => 35 ),
			'to'   => '',
		),
		'slideUpLong' => array(
			'from' => array( 'y' => '100%' ),
			'to'   => array( 'y' => '0%' ),
		),
		'slideUpShort' => array(
			'from' => array( 'y' => 35 ),
			'to'   => '',
		),
		'rotateInX' => array(
			'from' => array( 'y' => 35, 'rotationX' => -35, 'opacity' => 0 ),
			'to'   => '',
		),
		'rotateOutX' => array(
			'from' => array( 'y' => 0 ),
			'from' => array( 'y' => 35, 'rotationX' => -35, 'opacity' => 0 )
		),
		'rotateInY' => array(
			'from' => array( 'x' => 35, 'rotationY' => -35, 'opacity' => 0 ),
			'to'   => '',
		),
		'rotateOutY' => array(
			'from' => array( 'x' => 0 ),
			'from' => array( 'x' => 35, 'rotationY' => -35, 'opacity' => 0 )
		),
		'zoomIn' => array(
			'from' => array( 'scale' => 0.5, 'y' => 0, 'opacity' => 0 ),
			'to'   => '',
		),
		'zoomOut' => array(
			'from' => array( 'y' => 0 ),
			'to' => array( 'scale' => 0.5, 'opacity' => 0 ),
		),
	);

	return $hash[ $preset ];

}


