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
<div class="lqd-pb-column col-md-4">
	<div id="<?php echo $this->get_id() ?>" class="<?php echo $this->get_id(); ?> lqd-pb lqd-pb-style-4 lqd-pb-shaped lqd-pb-circle text-center">
		<div class="lqd-pb-icon-container mb-5">
			<div class="lqd-pb-icon lqd-pb-active-shape mx-auto d-flex align-items-center justify-content-center">
				<?php $this->get_icon(); ?>
				<?php $this->get_image(); ?>
			</div><!-- /.lqd-pb-icon -->
			<div class="lqd-pb-num-container">
				<div class="lqd-pb-num"></div>
			</div><!-- /.lqd-pb-num-container -->
		</div><!-- /.lqd-pb-icon-container -->
		<div class="lqd-pb-content px-md-7">
			<?php $this->get_title( 'mt-0 mb-2 h5' ); ?>
			<?php $this->get_content(); ?>
		</div><!-- /.lqd-pb-content -->
	</div><!-- /.lqd-pb lqd-pb-style-4 -->
</div><!-- .lqd-pb-column -->