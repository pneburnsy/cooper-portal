<?php

extract( $atts );

// classes
$classes = array( 

	'lqd-pb',

	//$el_class, 
	$this->get_id() 
);

$this->generate_css();

?>
<div class="lqd-pb-column col-md-12">
	<div id="<?php echo $this->get_id() ?>" class="<?php echo $this->get_id(); ?> lqd-pb lqd-pb-style-6 lqd-pb-shaped lqd-pb-circle d-flex align-items-center">
		<div class="lqd-pb-icon-container pos-rel">
			<div class="lqd-pb-icon lqd-pb-active-shape d-flex align-items-center justify-content-center">
				<?php $this->get_icon(); ?>
				<?php $this->get_image(); ?>
			</div><!-- /.lqd-pb-icon -->
		</div><!-- /.lqd-pb-icon-container -->
		<div class="lqd-pb-content">
			<?php $this->get_title( 'mt-0 h5' ); ?>
			<?php $this->get_content(); ?>
		</div><!-- /.lqd-pb-content -->
	</div><!-- /.lqd-pb lqd-pb-style-6 -->
</div><!-- .lqd-pb-column -->