<?php

$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
$format = get_post_format();

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

<?php $this->entry_thumbnail(); ?>

<div class="lqd-lp-content pl-md-8 w-md-50 w-100">

	<header class="lqd-lp-header">

		<div class="lqd-lp-meta d-flex align-items-center">
		
			<?php $this->entry_tags( 'lqd-lp-cat-shaped lqd-lp-cat-border reset-ul inline-ul pos-rel z-index-3 font-weight-bold text-uppercase ltr-sp-1' ); ?>

			<time class="lqd-lp-date pos-rel ms-4 ml-4" datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo liquid_helper()->liquid_post_date(); ?></time>
			<?php if ( liquid_helper()->get_option( 'blog-post-modified-date' ) === 'yes' && get_the_date() != get_the_modified_date() ){ ?>
				<time class="lqd-lp-date pos-rel ms-4 ml-4" datetime="<?php echo get_the_modified_date( 'c' ); ?>"><?php echo get_the_modified_date(); ?></time>
			<?php } ?>

		</div>

		<?php $this->entry_title( 'mt-3 mb-4 h5' ); ?>

	</header>

	<?php $this->entry_content('lqd-lp-excerpt w-80 mb-3'); ?>

	<footer class="lqd-lp-footer mt-4">

		<div class="lqd-lp-meta">
			<div class="lqd-lp-author d-flex flex-wrap align-items-center pos-rel">
				<a href="<?php echo esc_url( $author_url ); ?>" class="lqd-overlay z-index-3"></a>
				<figure class="border-radius-circle overflow-hidden">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), '50', get_option( 'avatar_default', 'mystery' ), get_the_author(), array( 'class' => 'w-100' ) ); ?>
				</figure>
				<div class="lqd-lp-author-info ms-3 ml-3 mx-3">
					<h3 class="mt-0 mb-0"><?php echo get_the_author(); ?></h3>
				</div>
			</div>
		</div>
	</footer>

</div>

<?php $this->overlay_link(); ?>
