<?php 

extract( $atts );

$items = vc_param_group_parse_atts( $items );

$this->generate_css();

$menu_fill =
	$bg_color || $bg_hcolor ||
	$sticky_bg_color || $sticky_bg_hcolor ||
	$sticky_light_bg_color || $sticky_light_bg_hcolor ||
	$sticky_dark_bg_color || $sticky_dark_bg_hcolor ? 'menu-items-has-fill' : '';

$toggle_fill = $add_toggle && ( $toggle_bg_color || $toggle_active_bg_color ) ? 'toggle-has-fill' : '';

$items_border = $border_color || $border_hcolor ? 'menu-items-has-border' : '';

$classes = array(
	'lqd-fancy-menu',
	'lqd-custom-menu',
	$menu_fill,
	$items_border,
	$toggle_fill,
	$menu_alignment,
	$items_decoration,
	$sticky ? 'lqd-sticky-menu' : '',
	$sticky && $cm_sticky_type ? $cm_sticky_type : '',
	$mobile_add_toggle === 'yes' ? 'lqd-custom-menu-mobile-collapsible' : '',
	$this->add_magnetic_items(),
	$this->add_auto_expand_items(),
	$el_class,
	$this->get_id()
);

$ul_classes = array(
	'reset-ul',
	$this->get_inline_nav(),
	$dropdown_collapsed !== 'yes' ? 'in is-active' : '',
	$add_toggle ? 'collapse lqd-custom-menu-dropdown w-100' : ''
);

$toggle_classes = array(
	'lqd-custom-menu-dropdown-btn',
	'd-flex',
	'align-items-center',
	$toggle_shape,
	$dropdown_collapsed !== 'yes' ? 'is-active' : ''
);

$scroll_ind = '';
$scroll_data = array();
if ( 'yes' === $localscroll ) { 
	$scroll_data['data-localscroll'] = true;
	$scroll_data['data-localscroll-options'] = wp_json_encode( array(
		"itemsSelector" => "> li > a",
		"trackWindowScroll" => true,
		"includeParentAsOffset" => $sticky ? true : false,
		"offsetElements" => "[data-sticky-header] .lqd-head-sec-wrap:not(.lqd-hide-onstuck), #wpadminbar"
	));
}

$is_sticky_default = $sticky && $cm_sticky_type === 'lqd-sticky-menu-default';
$is_sticky_floating = $sticky && $cm_sticky_type === 'lqd-sticky-menu-floating';

?>
<div  
	class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>"
	<?php if( $is_sticky_default ) { ?>
		data-pin="true" 
		data-pin-options='{ "start": "top+=1 top", "offset": "[data-sticky-header] .lqd-head-sec-wrap:not(.lqd-hide-onstuck), [data-sticky-header] .lqd-mobile-sec, #wpadminbar", "duration": "last-link" }' 
		data-move-element='{ "target": ".vc_row" }'
	<?php } else if ( $is_sticky_floating ) { ?>
		data-inview="true"
		data-inview-options='{ "toggleBehavior": "toggleInView" }'
	<?php }	?>
>
<?php if( 'yes' === $add_toggle || 'yes' === $mobile_add_toggle ) { ?>
<span class="<?php echo ld_helper()->sanitize_html_classes( $toggle_classes ) ?>" data-target="#<?php echo $this->get_id() ?>" data-toggle="collapse" data-ld-toggle="true" data-toggle-options='{ "closeOnOutsideClick": {"ifNotIn": "#lqd-site-content"} }'>

	<?php if ( 'yes' === $add_toggle ) { ?>
	<span class="d-inline-flex mr-3">
		<?php $this->get_the_icon(); ?>
	</span>
	<?php } ?>
	
	<?php if( !empty( $toggle_button_text ) || ! empty($mobile_toggle_button_text) ) { ?>
		<span class="toggle-label">
			<?php if( !empty( $toggle_button_text ) ) { ?>
				<?php echo wp_kses_post( do_shortcode( $toggle_button_text ) )?>
			<?php } else if ( ! empty($mobile_toggle_button_text) ) { ?>
				<?php echo wp_kses_post( do_shortcode( $mobile_toggle_button_text ) )?>
			<?php } ?>
		</span>
	<?php } ?>

	<span class="expander-icon ml-auto lh-1 d-inline-flex">
		<i class="lqd-icn-ess icon-ion-ios-arrow-down"></i>
	</span>
</span>
<?php } ?>

<?php if( 'wp_menus' === $source ) : ?>
<?php

	if ( 'yes' === $add_scroll_indicator ) {
		$scroll_ind = '<span class="lqd-scrl-indc lqd-scrl-indc-h lqd-scrl-indc-scale" data-lqd-scroll-indicator="true" data-scrl-indc-options=\'{ "scrollingTarget": "siblingsHref", "dir": "x", "scale": true, "start": "top bottom", "end": "top top-=99.65%", "waitForElementMove": '. $is_sticky_default .' }\'>
			<span class="lqd-scrl-indc-inner">
				<span class="lqd-scrl-indc-line">
					<span class="lqd-scrl-indc-el"></span>
				</span>
			</span>
		</span>';
	}

	if( is_nav_menu( $menu_slug ) ) {
		wp_nav_menu( array(
			'menu'           => $menu_slug,
			'container'      => 'ul',
			'container_id'   => '',
			'menu_id'        => $this->get_id(),
			'before'         => false,
			'after'          => $scroll_ind,
			'menu_class'     => esc_attr( implode( ' ', $ul_classes ) ),
			'items_wrap'     => '<ul id="%1$s" class="%2$s" ' . ld_helper()->html_attributes( $scroll_data ) . '>%3$s</ul>',
			'walker'         => class_exists( 'Liquid_Mega_Menu_Walker' ) ? new Liquid_Mega_Menu_Walker : '',
		 ) );
	 }
	 else {
		wp_nav_menu( array(
			'container'   => 'ul',
			'container_id'   => '',
			'menu_id'        => $this->get_id(),
			'before'      => false,
			'after'       => $scroll_ind,
			'menu_class'     => esc_attr( implode( ' ', $ul_classes ) ),
			'items_wrap'     => '<ul id="%1$s" class="%2$s" ' . ld_helper()->html_attributes( $scroll_data ) . '>%3$s</ul>',
			'walker'         => class_exists( 'Liquid_Mega_Menu_Walker' ) ? new Liquid_Mega_Menu_Walker : '',
		));

	};
?>
<?php else: ?>
	<ul class="<?php echo ld_helper()->sanitize_html_classes( $ul_classes ) ?>" id="<?php echo $this->get_id() ?>" <?php echo ld_helper()->html_attributes( $scroll_data ); ?>>
	<?php
		foreach ( $items as $item ) {
			if ( empty( $item['url'] ) ) {
				continue;
			}
			$icon = $badge = $badge_color = '';
			if( !empty( $item['icon_classname'] ) ) {
				$icon = '<span class="link-icon ' . $item['icon_alignment'] . ' ' . $icon_pos . '"><i class="' . $item['icon_classname'] . '"></i></span>';	
			}
			
			$attr = array( 
				'href' => esc_url( $item['url'] ), 
				'target' => esc_attr( isset($item['target']) ? $item['target'] : '' )
			);

			if ( 'yes' === $add_scroll_indicator ) {
				$scroll_ind = '<span class="lqd-scrl-indc lqd-scrl-indc-h lqd-scrl-indc-scale" data-lqd-scroll-indicator="true" data-scrl-indc-options=\'{ "scrollingTarget": "' . $attr['href'] . '", "dir": "x", "scale": true, "start": "top bottom", "end": "top top-=99.65%", "waitForElementMove": '. $is_sticky_default .' }\'>
					<span class="lqd-scrl-indc-inner">
						<span class="lqd-scrl-indc-line">
							<span class="lqd-scrl-indc-el"></span>
						</span>
					</span>
				</span>';
			}
			
			if( !empty( $item['badge'] ) ) {
				if( !empty( $item['badge_color'] ) ) {
					$badge_color = 'style="--badge-color: ' . $item['badge_color'] . ';"';	
				}
				$badge = '<span class="link-badge" ' . $badge_color . '>' . $item['badge'] . '</span>';
			}
			
			printf( '<li><a%s>%s %s%s</a>%s</li>', ld_helper()->html_attributes( $attr ), $icon, do_shortcode( $item['label'] ), $badge, $scroll_ind );
		}
	?>
	</ul>
<?php endif; ?>
</div>