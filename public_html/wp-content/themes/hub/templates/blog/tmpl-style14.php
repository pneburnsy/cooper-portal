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

<div class="lqd-lp-img lqd-overlay">
	<?php $this->entry_thumbnail(); ?>
</div>

<div class="lqd-lp-contents lqd-overlay d-flex flex-column justify-content-end p-4">

	<div class="lqd-lp-content-bg lqd-overlay"></div>

	<div class="lqd-lp-header-bottom pos-rel">

		<header class="lqd-lp-header">

			<div class="lqd-lp-meta lqd-lp-meta-solid d-inline-flex no-padding p-0">
				
				<?php if( 1 === $i ) { ?>
				<time class="lqd-lp-date pt-1 pb-1 ps-2 pe-2 px-3" datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo liquid_helper()->liquid_post_date(); ?></time>
				<?php } ?>
				
				<?php $this->entry_tags( 'lqd-lp-cat d-inline-flex align-items-center reset-ul inline-ul pos-rel z-index-3 pt-1 pb-1 ps-2 pe-2 px-2' ); ?>
				
			</div>
			
			<h2 class="lqd-lp-title mt-4 mb-2 h5" data-fittext="true" data-fittext-options='{ "compressor": 1.5, "minFontSize": 24, "maxFontSize": "currentFontSize" }'>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>	

			<?php if( 1 === $i ) { ?>
			<div class="lqd-lp-author d-inline-flex flex-wrap align-items-center pos-rel z-index-3">
				<div class="lqd-lp-author-info">
					<h3 class="mt-0 mb-1"><?php esc_html_e( 'Posted by', 'hub' ); ?> <a href="<?php echo esc_url( $author_url ); ?>"><?php echo get_the_author(); ?></a></h3>
				</div>
			</div>
			<?php } ?>

		</header>

	</div>

</div>

<?php $this->overlay_link(); ?>
