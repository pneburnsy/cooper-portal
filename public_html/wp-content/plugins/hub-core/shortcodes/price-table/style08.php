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

	<div class="lqd-pt-inner pt-6 pb-5">

		<div class="lqd-pt-bg lqd-overlay round"></div>

		<div class="lqd-pt-head pos-rel px-5 pb-4 text-center">
			<?php $this->get_price(); ?>
			<?php $this->get_title( 'font-weight-medium mb-1' ); ?>
		</div>

		<div class="lqd-pt-body pos-rel pt-3 px-5 px-md-8">
			<?php $this->get_features() ?>
		</div>

		<div class="lqd-pt-foot pos-rel pt-3 text-center">
			<?php $this->get_button(); ?>
		</div>

	</div>
</div>