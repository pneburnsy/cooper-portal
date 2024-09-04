<?php

extract( $atts );

// Enqueue Conditional Script
$this->scripts();

$classes = array( 
	'carousel-container',
	'lqd-carousel-stack',

	$el_class, 
	$this->get_id() 
);

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">
	
	<div class="carousel-items" data-lqd-flickity='{ "watchCSS": true }'>
		<?php
			
			//print_r( $content );
			
			//$this->columnize_content( $content );
			//echo ld_helper()->do_the_content( $content );
		?>
		<?php
			$this->get_content();
		?>
	</div>
	
	<div class="lqd-carousel-stack-nav">
		<button class="lqd-carousel-stack-btn lqd-carousel-stack-prev">
			<svg width="6" height="10" viewBox="0 0 6 10" xmlns="http://www.w3.org/2000/svg">
				<path d="M5.863 8.387L4.75 9.5L0 4.75L4.75 0L5.863 1.113L2.229 4.75L5.863 8.387Z"/>
			</svg>
		</button>
		<button class="lqd-carousel-stack-btn lqd-carousel-stack-next">
			<svg width="6" height="10" viewBox="0 0 6 10" xmlns="http://www.w3.org/2000/svg">
				<path d="M-2.43187e-05 8.387L1.11298 9.5L5.86298 4.75L1.11298 0L-2.43187e-05 1.113L3.63398 4.75L-2.43187e-05 8.387Z" />
			</svg>
		</button>
	</div>
	
</div>