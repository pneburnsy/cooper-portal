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

	<div class="lqd-testi-quote mb-0">
		<?php $this->get_quote(); ?>
	</div><!-- /.lqd-testi-quote -->

	<div class="lqd-testi-info mb-5">

		<div class="lqd-testi-details">
			<?php $this->get_avatar() ?>
			<div class="lqd-testi-np">
				<?php $this->get_name( 'h3', 'font-weight-medium' ) ?>
				<?php $this->get_position( 'h4', 'font-weight-light' ) ?>
			</div><!-- /.lqd-testi-np -->

		</div><!-- /.lqd-testi-details -->

	</div><!-- /.lqd-testi-info -->
	
</div><!-- /.lqd-testi lqd-testi-card -->