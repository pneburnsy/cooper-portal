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

	<div class="lqd-testi-details d-flex align-items-stretch w-100 w-sm-50">
		<?php $this->get_avatar(); ?>
	</div>

	<div class="d-flex flex-column justify-content-center w-100 w-sm-50 p-md-9 p-5">

		<div class="lqd-testi-extra mb-2">
			<svg class="lqd-testi-quote-icon-gradient" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="150" height="131" viewBox="0 0 281.155 245.956">
				<defs>
					<linearGradient id="testi-icon-gradient" x1="0.5" x2="0.5" y2="1" gradientUnits="objectBoundingBox">
						<stop offset="0" stop-color="#e5e9f2" stop-opacity="0.243" />
						<stop offset="1" stop-color="#737579" stop-opacity="0" />
					</linearGradient>
				</defs>
				<path d="M0-37.9v-70.289q0-57.659,26.358-95.549,27.457-38.988,80.173-53.266a12.548,12.548,0,0,1,11.257,2.2,12.28,12.28,0,0,1,5.217,10.433v18.67a12.849,12.849,0,0,1-2.471,7.413,11.344,11.344,0,0,1-6.315,4.668Q57.11-192.758,57.11-134.55H96.647a25.419,25.419,0,0,1,18.67,7.688,25.419,25.419,0,0,1,7.688,18.67V-37.9a25.419,25.419,0,0,1-7.688,18.67,25.419,25.419,0,0,1-18.67,7.688H26.358a25.419,25.419,0,0,1-18.67-7.688A25.419,25.419,0,0,1,0-37.9ZM184.508-11.545H254.8a25.419,25.419,0,0,0,18.67-7.688,25.419,25.419,0,0,0,7.688-18.67v-70.289a25.419,25.419,0,0,0-7.688-18.67,25.419,25.419,0,0,0-18.67-7.688H215.259q0-58.208,57.11-79.075a11.344,11.344,0,0,0,6.315-4.668,12.849,12.849,0,0,0,2.471-7.413v-18.67a12.28,12.28,0,0,0-5.217-10.433,12.548,12.548,0,0,0-11.257-2.2q-52.717,14.277-80.173,53.266-26.358,37.89-26.358,95.549V-37.9a25.419,25.419,0,0,0,7.688,18.67A25.419,25.419,0,0,0,184.508-11.545Z" transform="translate(0 257.5)" fill="url(#testi-icon-gradient)" />
			</svg>
		</div>

		<div class="lqd-testi-quote mb-3">
			<?php $this->get_quote(); ?>
		</div>
		
		<div class="lqd-testi-info mb-5">
			<div class="lqd-testi-details">
				<div class="lqd-testi-np">
					<?php $this->get_name( 'h3', 'font-weight-medium' ) ?>
					<?php $this->get_position( 'h4', 'font-weight-regular' ) ?>
				</div>
			</div>
		</div>
	
		<div class="lqd-testi-extra">
			<?php $this->get_image(); ?>
		</div>
		
	</div>
	
</div>