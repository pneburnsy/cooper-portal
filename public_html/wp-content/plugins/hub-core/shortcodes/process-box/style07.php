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
	<div id="<?php echo $this->get_id() ?>" class="<?php echo $this->get_id(); ?> lqd-pb lqd-pb-style-7 lqd-pb-shaped lqd-pb-circle">
		<div class="lqd-pb-icon-container mb-6">
			<div class="lqd-pb-icon">
				<?php $this->get_icon(); ?>
				<?php $this->get_image(); ?>
			</div><!-- /.lqd-pb-icon -->
		</div><!-- /.lqd-pb-icon-container -->
		<div class="lqd-pb-content d-flex">
			<div class="lqd-pb-num-container mr-4">
				<div class="lqd-pb-num lqd-pb-active-shape"></div>
			</div><!-- /.lqd-pb-num-container -->
			<div class="lqd-pb-contents-inner">
				<?php $this->get_title( 'mt-0 mb-3 h5' ); ?>
				<?php $this->get_content(); ?>
			</div><!-- /.lqd-pb-contents-inner -->
		</div><!-- /.lqd-pb-content -->
	</div><!-- /.lqd-pb lqd-pb-style-7 -->
</div><!-- .lqd-pb-column -->