<?php

$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
$format = get_post_format();

/*
if( 'audio' === $format ) {
	$this->entry_thumbnail();
}
*/
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
$this->entry_thumbnail();
?>
<header class="lqd-lp-header mb-5">

	<div class="lqd-lp-meta lqd-lp-meta-dot-between d-flex flex-wrap align-items-center font-weight-bold text-uppercase ltr-sp-1">

		<?php $this->entry_tags( 'lqd-lp-cat-shaped lqd-lp-cat-solid reset-ul inline-ul pos-rel z-index-3' ); ?>

		<?php $this->entry_time(); ?>

	</div>
	
	<?php $this->entry_title( 'h5 mt-4 pos-rel z-index-2' ); ?>

</header>

<footer class="lqd-lp-footer mt-5">

	<div class="lqd-lp-meta">

		<div class="lqd-lp-author d-flex flex-wrap align-items-center pos-rel z-index-3">
			<a href="<?php echo esc_url( $author_url ); ?>" class="lqd-overlay"></a>
			<figure class="border-radius-circle overflow-hidden">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), '50', get_option( 'avatar_default', 'mystery' ), get_the_author(), array( 'class' => 'w-100' ) ); ?>
			</figure>
			<div class="lqd-lp-author-info ms-3 ml-3">
				<h3 class="mt-0 mb-0 font-weight-medium"><?php echo get_the_author(); ?></h3>
			</div>
		</div>

	</div>
</footer>

<?php $this->overlay_link(); ?>