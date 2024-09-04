<?php

extract( $atts );

// classes
$classes = array(
	'lqd-tm', 
	'lqd-tm-style-6', 
	'pos-rel', 
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
		<div class="lqd-tm-details-inner d-flex align-items-end justify-content-between w-100 p-5">

			<div class="d-flex text-vertical align-items-center">
				<?php $this->get_name( 'mt-0' ); ?>
				<?php $this->get_position( 'my-0' ); ?>
			</div>

			<div class="lqd-tm-details-icon ml-auto">
				<i class="lqd-icn-ess icon-md-arrow-forward"></i>
			</div>
		</div>
	</div>

	<?php $this->get_overlay_link(); ?>

</div>