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

<div class="lqd-lp-img w-100 pos-rel overflow-hidden mb-4">
	<?php $this->entry_thumbnail(); ?>
</div>

<div class="lqd-lp-contents w-100 d-flex flex-column">

	<header class="lqd-lp-header">
		<div class="lqd-lp-meta d-flex align-items-center justify-content-between mb-3">
			<time class="lqd-lp-date d-inline-flex align-items-center" datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo liquid_helper()->liquid_post_date(); ?></time>
		</div>
		<h2 class="lqd-lp-title mt-1 mb-3 h5"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	</header>

	<?php $this->entry_content( 'lqd-lp-excerpt' ); ?>

</div>

<?php $this->overlay_link(); ?>
