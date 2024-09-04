<?php 

extract( $atts );

$items = vc_param_group_parse_atts( $items );

$this->generate_css();

$menu_fill = $bg_color || $bg_hcolor ? 'menu-items-has-fill' : '';
$items_border = $border_color || $border_hcolor ? 'menu-items-has-border' : '';

$classes = array(
	'lqd-fancy-menu',
	'lqd-simple-menu',
	$menu_fill,
	$items_border,
	$this->get_id()
);

$ul_classes = array(
	'lqd-simple-menu-ul',
	'reset-ul',
	$this->get_inline_nav()
);


?>
<div class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>">
<?php if( 'wp_menus' === $source ) : ?>
<?php

	if( is_nav_menu( $menu_slug ) ) {
		wp_nav_menu( array(
			'menu'           => $menu_slug,
			'container'      => 'ul',
			'container_id'   => '',
			'menu_id'        => $this->get_id(),
			'link_before'    => '',
			'link_after'     => '',
			'menu_class'     => esc_attr( implode( ' ', $ul_classes ) ),
			'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'walker'         => class_exists( 'Liquid_Mega_Menu_Walker' ) ? new Liquid_Mega_Menu_Walker : '',
		 ) );
	 }
	 else {
		wp_nav_menu( array(
			'container'   => 'ul',
			'container_id'   => '',
			'menu_id'        => $this->get_id(),
			'link_before' => '',
			'link_after'  => '',
			'menu_class'     => esc_attr( implode( ' ', $ul_classes ) ),
			'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'walker'         => class_exists( 'Liquid_Mega_Menu_Walker' ) ? new Liquid_Mega_Menu_Walker : '',
		));

	};
?>
<?php else: ?>
	<ul class="<?php echo ld_helper()->sanitize_html_classes( $ul_classes ) ?>">
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
				//'target' => '_blank' 
			);
			
			if( !empty( $item['badge'] ) ) {
				if( !empty( $item['badge_color'] ) ) {
					$badge_color = 'style="--badge-color: ' . $item['badge_color'] . ';"';	
				}
				$badge = '<span class="link-badge" ' . $badge_color . '>' . $item['badge'] . '</span>';
			}
			
			printf( '<li><a%s>%s %s%s</a></li>', ld_helper()->html_attributes( $attr ), $icon, do_shortcode( $item['label'] ), $badge );
		}
	?>
	</ul>
<?php endif; ?>
</div>