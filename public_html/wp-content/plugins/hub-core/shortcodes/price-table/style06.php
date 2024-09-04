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
	<div class="lqd-pt-inner py-5 px-4 px-md-6">

		<div class="lqd-pt-bg lqd-overlay border-radius-12"></div>

		<div class="lqd-pt-head pos-rel text-center">
			<?php $this->get_title( 'font-weight-medium text-uppercase ltr-sp-2 mt-0 mb-5' ); ?>
			<br>
			<?php $this->get_price(); ?>
		</div>

		<div class="lqd-pt-body pos-rel py-6">
			<?php $this->get_features() ?>
		</div>

		<div class="lqd-pt-foot pos-rel text-center pt-1 pb-5">
			<?php $this->get_button(); ?>
		</div>

	</div>
</div>