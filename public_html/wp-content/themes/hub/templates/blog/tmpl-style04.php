<?php

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

<header class="lqd-lp-header ps-3 pl-3">

	<div class="lqd-lp-meta lqd-lp-meta-dot-between d-flex flex-wrap align-items-center font-weight-bold text-uppercase ltr-sp-1">

		<?php $this->entry_tags( 'lqd-lp-cat-plain reset-ul inline-ul pos-rel z-index-3' ); ?>

		<?php $this->entry_time(); ?>

	</div>

	<?php $this->entry_title( 'mt-2 mb-0 h5' ); ?>

</header>

<?php $this->overlay_link(); ?>

