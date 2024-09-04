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

	<div class="lqd-testi-quote pos-rel p-6 mb-6">
		<?php $this->get_quote(); ?>
	</div><!-- /.lqd-testi-quote -->
	
	<div class="lqd-testi-details d-flex flex-column">

		<?php $this->get_avatar(); ?>
		<div class="lqd-testi-np">
			<?php $this->get_name( 'h3', 'font-weight-bold' ) ?>
			<?php $this->get_position( 'h4', 'font-weight-bold text-uppercase ltr-sp-1' ) ?>
		</div><!-- /.lqd-testi-np -->

	</div><!-- /.lqd-testi-details -->
	
</div><!-- /.lqd-testi lqd-testi-card -->