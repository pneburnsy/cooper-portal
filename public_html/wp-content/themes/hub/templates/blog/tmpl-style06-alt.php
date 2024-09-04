<?php

$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
$format = get_post_format();

if( 'audio' === $format ) {
	$this->entry_thumbnail();
}
?>

<div class="lqd-lp-img overflow-hidden">

	<?php $this->entry_thumbnail(); ?>

	<div class="lqd-lp-meta text-uppercase font-weight-bold pos-rel z-index-3">
		<?php $this->entry_tags( 'lqd-lp-cat-shaped lqd-lp-cat-solid reset-ul inline-ul font-weight-bold text-uppercase ltr-sp-1' ); ?>
	</div>

</div>

<header class="lqd-lp-header pt-4 ps-3 pe-3 px-3">

	<div class="lqd-lp-meta lqd-lp-meta-dot-between d-flex flex-wrap align-items-center">

		<div class="lqd-lp-author pos-rel z-index-3">
			<div class="lqd-lp-author-info">
				<h3 class="mt-0 mb-0"><a href="<?php echo esc_url( $author_url ); ?>"><?php echo get_the_author(); ?></a></h3>
			</div>
		</div>

		<?php $this->entry_time(); ?>

	</div>

	<?php $this->entry_title( 'mt-2 mb-0 h5' ); ?>

</header>

<?php $this->entry_content( 'lqd-lp-excerpt pt-2 pb-4 ps-3 pe-3 px-3' ); ?>

<?php $this->overlay_link(); ?>
