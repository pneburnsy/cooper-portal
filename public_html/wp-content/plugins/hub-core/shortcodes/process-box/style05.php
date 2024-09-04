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
	<div  id="<?php echo $this->get_id() ?>" class="<?php echo $this->get_id(); ?> lqd-pb lqd-pb-style-5 lqd-pb-shaped lqd-pb-circle d-flex align-items-center justify-content-md-center">
		<div class="lqd-pb-num-container mr-4">
			<div class="lqd-pb-num lqd-pb-active-shape"></div>
		</div><!-- /.lqd-pb-num-container -->
		<div class="lqd-pb-content">
			<?php $this->get_title( 'my-0 h6' ); ?>
		</div><!-- /.lqd-pb-content -->
	</div><!-- /.lqd-pb lqd-pb-style-5 -->
</div><!-- .lqd-pb-column -->