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

		<div class="lqd-pt-bg lqd-overlay border-radius-8"></div>
		
		<?php if( !empty( $title ) ) { ?>
		<span class="lqd-pt-label text-uppercase ltr-sp-1 font-weight-semibold round"><?php echo $title; ?></span>
		<?php } ?>

		<div class="lqd-pt-head pos-rel py-3">
			<?php $this->get_price(); ?>
			<?php $this->get_description(); ?>
		</div>

		<div class="lqd-pt-body pos-rel">
			<?php $this->get_features() ?>
		</div>
		<?php if( !empty( $footer_text ) ) { ?>
		<div class="lqd-pt-foot pos-rel py-4">
			<?php echo wp_kses_post( $footer_text ); ?>
		</div>
		<?php } ?>

	</div>
</div>