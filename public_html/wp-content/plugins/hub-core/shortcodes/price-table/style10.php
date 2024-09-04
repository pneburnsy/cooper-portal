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
	<div class="lqd-pt-inner text-center py-7">

		<div class="lqd-pt-bg lqd-overlay border-radius-5"></div>
		
		<?php $this->get_featured_tag(); ?>

		<div class="lqd-pt-head pos-rel px-5 pb-6">
			<?php $this->get_price(); ?>
		</div>

		<div class="lqd-pt-body pos-rel pt-5 pb-6 px-5">
			<?php $this->get_features() ?>
		</div>

		<div class="lqd-pt-foot pos-rel px-5">
			<?php $this->get_button(); ?>
		</div>

	</div>
</div>