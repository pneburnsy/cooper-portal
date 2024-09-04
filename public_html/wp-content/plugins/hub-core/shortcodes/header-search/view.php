<?php

// Enqueue Conditional Script
$this->generate_css();

$style = isset( $atts['style'] ) ? $atts['style'] : 'default';

$search_type = $atts['search_type'];
if ( $search_type == 'custom' && empty( $atts['custom_search_type'] ) ) {
	$search_type = 'all';
} else if ( $search_type == 'custom' && !empty( $atts['custom_search_type'] ) ) {
	$search_type = $atts['custom_search_type'];
}

// check
$located = locate_template( "templates/header/header-search-$style.php" );

if ( !file_exists( $located ) ) {
	$located = locate_template( 'templates/header/header-search.php' );
}
?>
<div class="header-module <?php echo $atts['show_on_mobile'] ?>">
	<?php include $located; ?>
</div>