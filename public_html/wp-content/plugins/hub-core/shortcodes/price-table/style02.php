<?php
extract( $atts );

$classes = array( 
	'lqd-pt', 
	$this->get_featured(), 
	$this->get_class( $template ), 
	$el_class,
	$this->get_id() 
);

// Enqueue Conditional Script
$this->scripts();
$this->generate_css();

?>
<div class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>" id="<?php echo $this->get_id(); ?>">
	<div class="lqd-pt-inner px-5 py-4">

		<div class="lqd-pt-bg lqd-overlay"></div>

		<div class="lqd-pt-head pos-rel">

			<?php $this->get_title( 'font-weight-normal mb-3' ); ?>
			<?php $this->get_price(); ?>

		</div>

		<div class="lqd-pt-body pos-rel">
			<?php $this->get_features() ?>
		</div>
		
		<div class="lqd-pt-foot pos-rel mt-4">
			<?php $this->get_button()?>
		</div>

	</div>
</div>