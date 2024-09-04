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

	<div class="lqd-testi-extra mt-3 mb-5">
		<?php $this->get_rating() ?>
	</div><!-- /.lqd-testi-extra -->

	<div class="lqd-testi-quote mb-7">
		<?php $this->get_quote(); ?>
	</div><!-- /.lqd-testi-quote -->

	<div class="lqd-testi-info mb-1">

		<div class="lqd-testi-details d-flex flex-column">
			<?php $this->get_avatar( 'mx-0 mb-2' ) ?>
			<div class="lqd-testi-np">
				<?php $this->get_name( 'h3', 'font-weight-medium' ) ?>
				<?php $this->get_position() ?>
			</div><!-- /.lqd-testi-np -->

		</div><!-- /.lqd-testi-details -->

	</div><!-- /.lqd-testi-info -->
	
</div><!-- /.lqd-testi lqd-testi-card -->