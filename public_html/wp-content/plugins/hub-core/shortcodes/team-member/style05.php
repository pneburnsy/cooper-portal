<?php

extract( $atts );

// classes
$classes = array(
	'lqd-tm',
	'lqd-tm-style-5',
	'pos-rel',
	'round',
	'overflow-hidden',
	$el_class, 
	$this->get_id()
);

$this->generate_css();

?>
<div class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">

	<div class="lqd-tm-img pos-rel">
		<?php $this->get_image( true ); ?>
	</div>
		
	<div class="lqd-tm-details lqd-overlay align-items-end">
		<div class="lqd-tm-details-inner d-flex align-items-end justify-content-between w-100 p-4 px-md-7 py-md-5 h-100">
			<div class="d-flex flex-column justify-content-end w-80 h-100">
				<?php $this->get_social(); ?>
				<?php $this->get_name( 'mt-0 mb-2' ); ?>
				<?php $this->get_position( 'my-0' ); ?>
			</div>
			<div class="lqd-tm-details-icon ml-auto">
				<i class="lqd-icn-ess icon-md-arrow-forward"></i>
			</div>
		</div>
	</div>

	<?php $this->get_overlay_link(); ?>

</div>