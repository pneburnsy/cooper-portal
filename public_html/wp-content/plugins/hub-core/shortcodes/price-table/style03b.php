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

$border = '';

?>
<div class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>" id="<?php echo $this->get_id(); ?>">
	<div class="lqd-pt-inner">

		<div class="lqd-pt-bg lqd-overlay"></div>
		<?php $this->get_featured_tag(); ?>

		<div class="lqd-pt-head pos-rel pt-8 px-7 px-md-9">

			<?php $this->get_title( 'font-weight-semibold text-uppercase ltr-sp-2 my-0' ); ?>
			<?php $this->get_price(); ?>
			<?php $this->get_description(); ?>

		</div>

		<div class="lqd-pt-body pos-rel pt-4 pb-9 px-7 px-md-9">
			<?php $this->get_features() ?>
		</div>

		<div class="lqd-pt-foot pos-rel py-3 px-md-2 text-center">
			<?php $this->get_button()?>
		</div>

	</div>
</div>