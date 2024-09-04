<?php
extract( $atts );

$classes = array( 
	'lqd-testi',
	'overflow-hidden',
	$this->get_classes( $template ), 

	$el_class, 
	$this->get_id() 
);

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>">

	<div class="lqd-testi-details d-flex align-items-stretch w-40">
		<?php $this->get_avatar(); ?>
	</div><!-- /.lqd-testi-details -->

	<div class="d-flex flex-column justify-content-center w-60 py-5 px-6">

		<div class="lqd-testi-quote mb-5">
			<?php $this->get_quote(); ?>
		</div><!-- /.lqd-testi-quote -->
	
		<div class="lqd-testi-info d-flex flex-wrap justify-content-between">
	
			<div class="lqd-testi-details">
	
				<div class="lqd-testi-np">
					<?php $this->get_name() ?>
					<?php $this->get_position() ?>
				</div><!-- /.lqd-testi-np -->
	
			</div><!-- /.lqd-testi-details -->
	
			<?php $this->get_social_icon(); ?>
	
		</div><!-- /.lqd-testi-info -->

	</div><!-- /.d-flex flex-column justify-content-center -->
	
</div><!-- /.lqd-testi lqd-testi-card -->