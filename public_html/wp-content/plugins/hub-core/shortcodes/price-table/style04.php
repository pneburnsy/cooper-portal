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

	<div class="lqd-pt-inner py-6">

		<div class="lqd-pt-bg lqd-overlay"></div>

		<div class="lqd-pt-head pos-rel px-3 pb-5">

			<?php $this->get_title( 'font-weight-semibold text-uppercase ltr-sp-2 mt-0 mb-3' ); ?>
			<?php $this->get_price(); ?>
			<?php $this->get_description(); ?>

		</div>

		<div class="lqd-pt-body pos-rel px-3 py-3">
			<?php $this->get_features() ?>
		</div>

		<div class="lqd-pt-foot pos-rel px-3 pt-5">
			<?php $this->get_button(); ?>
			<?php $this->get_footer_text(); ?>

		</div>

	</div>
</div>