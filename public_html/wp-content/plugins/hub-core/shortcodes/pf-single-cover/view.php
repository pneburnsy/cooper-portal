<?php

extract( $atts );

$classes = array(
	'lqd-pf-single-cover',
	'pos-rel',
	$this->get_id() 
);

$this->generate_css();

$attachment = get_post( get_post_thumbnail_id() );

?>

<div class="<?php echo ld_helper()->sanitize_html_classes( $classes )  ?>">

	<figure class="lqd-pf-single-cover-img d-flex">
		<?php liquid_the_post_thumbnail( 'liquid-large', array()); ?>
	</figure>

	<div class="lqd-overlay align-items-center justify-content-center text-center p-9 p-md-3">
		<?php the_title( '<h1 class="lqd-pf-single-title my-0">', '</h1>' ); ?>
	</div><!-- /.lqd-overlay -->

	<div class="pos-abs pos-b pos-r pos-l text-center pb-6">
		<a class="pf-scroll-down-link" href="#" data-localscroll="true" data-localscroll-options='{"scrollBelowSection": true}'>
			<i class="lqd-icn-ess icon-ion-ios-arrow-down"></i>
		</a>
	</div><!-- /.lqd-overlay -->

</div><!-- /.lqd-pf-single-cover -->