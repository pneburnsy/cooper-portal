<?php

extract( $atts );

$classes = array(
	'lqd-af',
	$el_class, 
	$this->get_id() 
);

$this->generate_css();
	
?>
<div class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>" data-liquid-animatedframes="true" <?php $this->get_opts(); ?>>
	<div class="lqd-af-slides">
		<?php echo ld_helper()->do_the_content( $content ); ?>
	</div><!-- /.slides -->
	
	<nav class="lqd-af-slidenav">
		<button class="lqd-af-slidenav__item lqd-af-slidenav__item--prev">
			<i class="lqd-icn-ess icon-ion-ios-arrow-down"></i>
		</button>
		<button class="lqd-af-slidenav__item lqd-af-slidenav__item--next">
			<i class="lqd-icn-ess icon-ion-ios-arrow-up"></i>
		</button>
	</nav>

	<div class="lqd-af-slidenum">
		<span class="lqd-af-slidenum__line lqd-af-slidenum__line--before"></span>
		<div class="lqd-af-slidenum__nums">
			<span class="lqd-af-slidenum__current pos-rel overflow-hidden"> </span>
			<span class="lqd-af-slidenum__total"></span>
		</div><!-- /.lqd-af-slidenum__nums -->
		<span class="lqd-af-slidenum__line lqd-af-slidenum__line--after"></span>
	</div><!-- /.lqd-af-slidenum -->

</div>