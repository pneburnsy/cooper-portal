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

	<div class="lqd-testi-quote mb-1 px-4 py-4">
		<?php $this->get_quote(); ?>
		<?php $this->get_rating( 'mt-4' ) ?>
	</div><!-- /.lqd-testi-quote -->

	<div class="lqd-testi-info d-flex flex-wrap px-4 py-3">

		<div class="lqd-testi-details d-flex flex-wrap flex-row-reverse justify-content-between w-100">
			<?php $this->get_avatar( 'mx-0' ) ?>
			<div class="lqd-testi-np">
				<?php $this->get_name( 'h3', 'font-weight-medium' ) ?>
				<?php $this->get_position() ?>
			</div><!-- /.lqd-testi-np -->

		</div><!-- /.lqd-testi-details -->

	</div><!-- /.lqd-testi-info -->
	
</div><!-- /.lqd-testi lqd-testi-brd -->