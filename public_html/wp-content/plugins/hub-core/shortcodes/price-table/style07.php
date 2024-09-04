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
	<div class="lqd-pt-inner p-sm-4 p-5 py-md-6 text-center">

		<div class="lqd-pt-bg lqd-overlay round"></div>
		<div class="lqd-pt-head pos-rel">
			<?php $this->get_title(); ?>
			<?php $this->get_price(); ?>
			<?php $this->get_description(); ?>
		</div>
		<div class="lqd-pt-body pos-rel mt-4 py-3">
			<?php $this->get_features() ?>
		</div>
		<div class="lqd-pt-foot pos-rel pb-2">
			<?php $this->get_button(); ?>
		</div>

	</div>
</div>