<?php
extract( $atts );

// Enqueue Conditional Script
$this->scripts();

$icon = liquid_get_icon( $atts );

// check
if( !$title && !isset( $icon['icon'] ) ) {
	return;
}

$this->generate_css();

$classes = array( 
	'btn',
	$style,
	$transformation,
	$i_separator,
	$hover_txt_effect,
	$this->get_size(),
	$this->get_custom_size_classname(),
	$this->get_shape(),
	$this->get_border(),
	$border_width,
	$this->get_width(),
	$this->get_gradient_border(),
	$this->get_gradient(),
	
	$this->if_lightbox(),
	
	//Icon Classes
	$this->get_icon_pos(),
	$i_shape_size,
	$i_shape,
	$i_shape_style,	
	$i_shape_bw,	
	$i_ripple,
	$i_hover_reveal,
	
	!empty( $title ) ? 'btn-has-label' : 'btn-no-label',
	$el_class,
	$this->get_id(),
	trim( vc_shortcode_custom_css_class( $css ) )
);

$attributes = liquid_get_link_attributes( $link, '#' );
$attributes['class'] = ld_helper()->sanitize_html_classes( $classes );

if( !empty( $image_caption ) ) {
	$attributes['data-fresco-caption'] = $image_caption;
} 

if( 'modal_window' === $link_type ) {
	$attributes['data-lity'] = isset( $anchor_id ) ? esc_url( $anchor_id ) : '#modal-box';
	$attributes['href'] = isset( $anchor_id ) ? esc_url( $anchor_id ) : '#modal-box';
}
elseif( 'local_scroll' === $link_type ) {
	$attributes['data-localscroll'] = true;
	$attributes['href'] = isset( $anchor_id ) ? esc_url( $anchor_id ) : '#';
	if( !empty( $scroll_speed ) ) {
		$attributes['data-localscroll-options'] = wp_json_encode( array( 'scrollSpeed' => $scroll_speed ) );	
	}
	
}
elseif( 'scroll_to_section' === $link_type ) {
	$attributes['data-localscroll'] = true;
	if( !empty( $scroll_speed ) ) {
		$attributes['data-localscroll-options'] = wp_json_encode( array( 'scrollBelowSection' => true, 'scrollSpeed' => $scroll_speed ) );	
	}
	else {
		$attributes['data-localscroll-options'] = wp_json_encode( array( 'scrollBelowSection' => true ) );	
	}
	
	$attributes['href'] = '#';
}


?>
<a<?php echo ld_helper()->html_attributes( $attributes ) ?> >
	<span>
	<?php $this->get_gradient_bg(); ?>
	
		<?php if( !empty( $title ) ) { ?>
			<span class="btn-txt" data-text="<?php echo esc_attr( ! empty($title_secondary) ? $title_secondary : $title ) ?>" <?php $this->get_hover_text_opts(); ?>><?php echo wp_kses_post( do_shortcode( $title ) ); ?></span>
		<?php } ?>
	
	<?php
		if( $icon['type'] ) {
			if ( isset( $icon['icon'] ) ){
				printf( '<span class="btn-icon">%s<i class="%s"></i></span>', $this->get_gradient_hover_icon_bg(), $icon['icon'] );
			} elseif ( isset( $icon['src'] ) ) {
				printf( '<span class="btn-icon">%s<img src="%s" style="width:%s" alt="%s"></span>', $this->get_gradient_hover_icon_bg(), esc_url($icon['src']), esc_attr($i_size), esc_attr( $title ) );
			}
		}
	?>
	<?php
		if( $icon['type'] && 'btn-hover-swp' === $i_hover_reveal ) {
			printf( '<span class="btn-icon"><i class="%s"></i></span>', $icon['icon'] );
		}
	?>
	<?php $this->get_gradient_hover_bg(); ?>
	<?php $this->get_border_svg(); ?>
	</span>
</a>
