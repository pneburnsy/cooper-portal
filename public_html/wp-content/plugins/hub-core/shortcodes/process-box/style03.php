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
<div class="lqd-pb-column col-sm-6">
	<div id="<?php echo $this->get_id() ?>" class="<?php echo $this->get_id(); ?> lqd-pb lqd-pb-style-3 lqd-pb-shaped lqd-pb-circle d-flex">
		<div class="lqd-pb-num-container">
			<div class="lqd-pb-num lqd-pb-active-shape">
				<div class="lqd-pb-shape-border">
					<svg xmlns="http://www.w3.org/2000/svg" width="127" height="126" viewBox="0 0 127 126">
						<path fill="none" stroke-dasharray="0 9.9" stroke-linecap="round" stroke-width="2.2" d="M61.5,123 C95.4655121,123 123,95.4655121 123,61.5 C123,27.5344879 95.4655121,0 61.5,0 C27.5344879,0 0,27.5344879 0,61.5 C0,95.4655121 27.5344879,123 61.5,123 Z" transform="translate(2 1)"/>
					</svg>
				</div><!-- /.lqd-pb-shape-border -->
			</div>
		</div><!-- /.lqd-pb-num-container -->
		<div class="lqd-pb-content">
			<?php $this->get_title( 'h5' ); ?>
			<?php $this->get_content(); ?>
		</div><!-- /.lqd-pb-content -->
	</div><!-- /.lqd-pb lqd-pb-style-3 -->
</div><!-- .lqd-pb-column -->