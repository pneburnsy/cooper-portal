<?php

extract( $atts );

// classes
$classes = array(
	'lqd-tm',
	'lqd-tm-style-4',
	'pos-rel',
	'round',
	'overflow-hidden',
	'text-center',
	$el_class, 
	$this->get_id()
);

$this->generate_css();

?>

<div class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">

	<div class="lqd-tm-img pos-rel">
		<?php $this->get_image( true ); ?>
	</div>
		
	<div class="lqd-tm-details lqd-overlay flex-column align-items-center justify-content-end p-6">
		<?php $this->get_social(); ?>
		<div class="lqd-tm-details-inner">
			<?php $this->get_name( 'mt-0 mb-2' ); ?>
			<?php $this->get_position( 'my-0' ); ?>
		</div>
	</div>

	<?php $this->get_overlay_link(); ?>

</div>