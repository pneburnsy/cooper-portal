<?php
extract( $atts );

$classes = array( 
	'lqd-testi',
	$this->get_classes( $template ), 

	$el_class, 
	$this->get_id() 
);

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>">

	<div class="d-flex flex-column flex-grow">

		<div class="lqd-testi-info d-flex flex-wrap align-items-center justify-content-between mb-2">
			<div class="lqd-testi-np">
				<?php $this->get_name( 'h3', 'font-weight-medium' ) ?>
			</div><!-- /.lqd-testi-np -->
			<?php $this->get_social_icon(); ?>	
		</div><!-- /.lqd-testi-info -->

		<div class="lqd-testi-quote mb-1">
			<?php $this->get_quote(); ?>
		</div><!-- /.lqd-testi-quote -->

		<div class="lqd-testi-details">
			<?php $this->get_time( 'font-weight-medium' ); ?>
		</div><!-- /.lqd-testi-details -->

	</div><!-- /.d-flex flex-column -->

	<div class="lqd-testi-details">
		<?php $this->get_avatar() ?>
	</div><!-- /.lqd-testi-details -->

</div><!-- /.lqd-testi lqd-testi-card -->