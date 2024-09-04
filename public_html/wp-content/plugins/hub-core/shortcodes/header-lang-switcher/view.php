<?php 

extract( $atts );
$classes = array(
	'ld-dropdown-menu',
	$hover_style,

	$this->get_id()
);

$dropdown_id = uniqid( 'dropdown-' );

// qTRanslate-x
$active_name = $content = '';

if( function_exists( 'qtranxf_generateLanguageSelectCode' ) ) {

	global $q_config;

	$url = is_404() ? get_option('home') : '';

	foreach(qtranxf_getSortedLanguages() as $language) {
		$alt = $q_config['language_name'][$language] . '(' . $language . ')';
		$classes = array( 'lang-' . $language );

		if( $language == $q_config['language'] ) {
			$classes[]   = 'active';
			$active_name = $q_config['language_name'][$language];
		}

		$content .= sprintf(
			'<li class="%1$s"><a href="%2$s" class="qtranxs_text qtranxs_text_%3$s" hreflang="%3$s" title="%4$s">%5$s</a></li>',
			implode( ' ', $classes ),
			qtranxf_convertURL( $url, $language, false, true ),
			$language,
			$alt,
			$q_config['language_name'][$language]
		);
	}
}
// Polylang
elseif( function_exists( 'pll_the_languages' ) && PLL() instanceof PLL_Frontend ) {

	$switcher = new PLL_Switcher;
	// @link : https://polylang.wordpress.com/documentation/documentation-for-developers/functions-reference/  
	$content = $switcher->the_languages( PLL()->links, array(
		'echo' => false,
		'show_flags' => $display_flags ? 1 : 0,
	) );

	$active_name = PLL()->links->curlang->name;
}
// WPML
elseif( function_exists( 'icl_get_languages' ) ) {
	$active_name = ICL_LANGUAGE_NAME;

	$languages = icl_get_languages( 'skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str' );
	$img = '';

	if( !empty( $languages ) ) {
		foreach( $languages as $language ) {

			if ( $display_flags ) {
				$img = '<img src="' . esc_url($language['country_flag_url']) . '" alt="' . $language['language_code'] . '" /> ';
			} 

			if( ! $language['active'] ) {
				$content .= '<li>' . $img . '<a href="' . esc_url( $language['url'] ) . '">' . $language['native_name'] . '</a></li>';
			}
		}
	}

	if ( $display_flags ) {
		$active_name = '<img src="' . esc_url($languages[ICL_LANGUAGE_CODE]['country_flag_url']) . '" alt="' . $languages[ICL_LANGUAGE_CODE]['language_code'] . '" />' . ICL_LANGUAGE_NAME;
	} 

}

$this->generate_css();

?>

<div class="header-module <?php echo $show_on_mobile; ?>">
	<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>">

		<span class="ld-module-trigger" role="button" data-ld-toggle="true" data-toggle="collapse" data-target="<?php echo '#' . $dropdown_id; ?>" aria-controls="<?php echo $dropdown_id ?>" aria-expanded="false">
			<span class="ld-module-trigger-txt"><?php echo $img . $active_name ?> <i class="lqd-icn-ess icon-ion-ios-arrow-down"></i></span>
		</span>

		<div class="ld-module-dropdown left collapse" id="<?php echo $dropdown_id ?>" aria-expanded="false">
			<div class="ld-dropdown-menu-content">
				<ul>
				<?php echo $content ?>
				</ul>
			</div>
		</div>
		
	</div>
</div>