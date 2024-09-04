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
<div id="<?php echo $this->get_id() ?>" class="<?php echo $this->get_id(); ?> lqd-pb lqd-pb-style-2 lqd-pb-shaped lqd-pb-circle d-flex align-items-center p-4 px-sm-7 pos-rel">
	<div class="lqd-pb-num-container mr-5 pos-rel">
		<div class="lqd-pb-num lqd-pb-active-shape"></div>
	</div><!-- /.lqd-pb-num-container -->
	<div class="lqd-pb-content pos-rel">
	<?php $this->get_title( 'my-md-0 h5' ); ?>
	</div><!-- /.lqd-pb-content -->
	<div class="lqd-pb-icon-container ml-auto pos-rel">
		<div class="lqd-pb-icon">
			<?php $this->get_icon(); ?>
			<?php $this->get_image(); ?>
		</div><!-- /.lqd-pb-icon -->
	</div><!-- /.lqd-pb-icon-container -->
</div><!-- /.lqd-pb lqd-pb-style-1 -->
</div><!-- .lqd-pb-column -->