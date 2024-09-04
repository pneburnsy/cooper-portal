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

	<?php $this->get_featured_tag(); ?>
	
	<div class="lqd-pt-inner pb-6">

		<div class="lqd-pt-bg lqd-overlay"></div>

		<div class="lqd-pt-head pos-rel">

			<?php if( !empty( $title ) ) { ?>
			<h4 class="lqd-pt-title mt-0 mb-0"><?php echo $title; ?></h4>
			<?php } ?>
			
			<?php if( !empty( $subtitle ) ) { ?>
			<p><?php echo $subtitle; ?></p>
			<?php } ?>

			<?php $this->get_price(); ?>
			<?php $this->get_description(); ?>

		</div>

		<div class="lqd-pt-body pos-rel px-md-6 px-3 py-3">
			<?php $this->get_features() ?>
		</div>

		<div class="lqd-pt-foot pos-rel p-3">
			<?php $this->get_button(); ?>
		</div>

	</div>
</div>