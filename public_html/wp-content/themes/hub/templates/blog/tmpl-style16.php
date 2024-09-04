
<?php

$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
$format = get_post_format();

if ( class_exists( 'Liquid_Elementor_Addons' ) && defined( 'ELEMENTOR_VERSION' )){
	$show_read_more_button = $this->entry_read_more_button();
} else {
	$show_read_more_button = 'yes';
}

if( 'audio' === $format ) {
	$this->entry_thumbnail();
}
/*
elseif( 'video' === $format ) {
?>
<div class="post-video">
	<?php $this->entry_thumbnail() ?>
	<?php $this->entry_tags() ?>
</div>
<?php
}
*/
?>

<div class="lqd-lp-img border-radius-4 overflow-hidden pos-rel mb-5">
	<?php $this->entry_thumbnail( 'liquid-style16-lb' ); ?>
</div>

<header class="lqd-lp-header mb-3">
	<?php $this->entry_title( 'h5 m-0' ); ?>
</header>

<?php $this->entry_content( 'lqd-lp-excerpt mb-3' ); ?>

<?php if( $show_read_more_button === 'yes' ) : ?>
<footer class="lqd-lp-footer pos-rel z-index-2 pt-1">
	<a href="<?php the_permalink(); ?>" class="btn btn-naked text-uppercase ltr-sp-1 size-sm font-weight-bold lqd-lp-read-more">
		<span class="btn-line btn-line-before d-inline-block pos-rel"></span>
		<span class="btn-txt d-inline-block"><?php esc_html_e( 'Continue Reading', 'hub' ); ?></span>
		<span class="btn-line btn-line-after d-inline-block pos-rel">
			<svg class="d-inline-block pos-abs" xmlns="http://www.w3.org/2000/svg" width="12" height="32" viewBox="0 0 12 32" style="height: 2em;"><path fill="currentColor" d="M8.375 16L.437 8.062C-.125 7.5-.125 6.5.438 5.938s1.563-.563 2.126 0l9 9c.562.562.624 1.5.062 2.062l-9.063 9.063c-.312.312-.687.437-1.062.437s-.75-.125-1.063-.438c-.562-.562-.562-1.562 0-2.125z"></path></svg>
		</span>
	</a>
</footer>
<?php endif; ?>

<?php $this->overlay_link(); ?>

