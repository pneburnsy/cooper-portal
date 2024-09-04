<?php 

extract( $atts );

$this->generate_css();

$classes = array(
	'main-nav',
	$align_counter,
	$this->get_id()
);

$args = '';

if( !empty( $hover_style ) ) {
	$classes[] = "main-nav-hover-$hover_style";
}
$classes[] = "nav align-items-lg-stretch justify-content-lg-$align_items";

$classes = apply_filters( 'liquid_header_nav_classes', $classes );

$default_args = array(
	'toggleType' => 'fade',
	'handler' => 'mouse-in-out',	
);
$args = wp_parse_args( $args, $default_args );
$args = apply_filters( 'liquid_header_nav_args', $args );

?>
<div class="header-module module-primary-nav pos-stc">
	<div class="collapse navbar-collapse <?php echo $ddmenu_hover_style; ?> <?php echo $visible; ?> <?php echo $this->add_magnetic_items() ?>" id="main-header-collapse" aria-expanded="false" role="navigation">
	<?php
	
		if( is_nav_menu( $menu_slug ) ) :
	
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'menu'           => $menu_slug,
				'container'      => 'ul',
				'before'         => false,
				'after'          => false,
				'link_before'    => '',
				'link_after'     => '<span class="submenu-expander"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="32" viewBox="0 0 21 32" style="width: 1em; height: 1em;"><path fill="currentColor" d="M10.5 18.375l7.938-7.938c.562-.562 1.562-.562 2.125 0s.562 1.563 0 2.126l-9 9c-.563.562-1.5.625-2.063.062L.437 12.562C.126 12.25 0 11.876 0 11.5s.125-.75.438-1.063c.562-.562 1.562-.562 2.124 0z"></path></svg></span>',
				'menu_id'        => 'primary-nav',
				'menu_class'     => esc_attr( implode( ' ', $classes ) ),
				'items_wrap'     => '<ul id="%1$s" class="%2$s" data-submenu-options=\'' . wp_json_encode( $args ) . '\' ' . $this->add_local_scroll() . '>%3$s</ul>',
				'walker'         => class_exists( 'Liquid_Mega_Menu_Walker' ) ? new Liquid_Mega_Menu_Walker : '',
			 ) );
	
		 else:
	
			wp_nav_menu( array(
				'container'   => 'ul',
				'before'      => false,
				'after'       => false,
				'link_before' => '',
				'link_after'  => '<span class="submenu-expander"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="32" viewBox="0 0 21 32" style="width: 1em; height: 1em;"><path fill="currentColor" d="M10.5 18.375l7.938-7.938c.562-.562 1.562-.562 2.125 0s.562 1.563 0 2.126l-9 9c-.563.562-1.5.625-2.063.062L.437 12.562C.126 12.25 0 11.876 0 11.5s.125-.75.438-1.063c.562-.562 1.562-.562 2.124 0z"></path></svg></span>',
				'menu_class'     => esc_attr( implode( ' ', $classes ) ),
				'items_wrap'     => '<ul id="%1$s" class="%2$s" data-submenu-options=\'' . wp_json_encode( $args ) . '\' >%3$s</ul>',
				'walker'         => class_exists( 'Liquid_Mega_Menu_Walker' ) ? new Liquid_Mega_Menu_Walker : '',
			));
	
		endif;
	?>
	</div><!-- /.navbar-collapse -->
</div><!-- /.header-module -->