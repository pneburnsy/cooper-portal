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
<div class="lqd-pb-column col-md-3 col-sm-6">
	<div id="<?php echo $this->get_id() ?>" class="<?php echo $this->get_id(); ?> lqd-pb lqd-pb-style-9 lqd-pb-shaped lqd-pb-circle text-center">
		<div class="lqd-pb-num-container mb-4">
			<div class="lqd-pb-num lqd-pb-active-shape mx-auto"></div>
		</div><!-- /.lqd-pb-num-container -->
		<div class="lqd-pb-content px-md-4">
			<?php $this->get_title( 'mt-0 mb-3 h5' ); ?>
			<?php $this->get_content(); ?>
		</div><!-- /.lqd-pb-content -->
	</div><!-- /.lqd-pb lqd-pb-style-8 -->
</div><!-- .lqd-pb-column -->