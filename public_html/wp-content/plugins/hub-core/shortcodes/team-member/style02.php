<?php

extract( $atts );

// classes
$classes = array(
	'lqd-tm',
	'lqd-tm-style-2',
	'pos-rel',
	$el_class, 
	$this->get_id()
);

$this->generate_css();
$gradient_id = uniqid( 'gradient-' )

?>
<div class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">

	<?php $this->get_image(); ?>
	<div
		class="lqd-tm-details pb-3 pos-rel"
		data-custom-animations="true"
		data-ca-options='{ "triggerHandler": "inview", "animationTarget": "h3,p,.social-icon", "duration": 1200, "delay": 120,  "startDelay": 450, "initValues": { "y": 30, "opacity": 0 }, "animations": { "y": 0, "opacity": 1 } }'
	>

		<svg xmlns="http://www.w3.org/2000/svg" width="226.173" height="196.905" viewBox="0 0 226.173 196.905">
			<defs>
				<linearGradient id="<?php echo $gradient_id ?>" x1="0%" x2="100%" y1="6.867%" y2="100%">
					<stop offset="0%" />
					<stop offset="100%" />
				</linearGradient>
			</defs>
			<path fill="url(#<?php echo $gradient_id ?>)" d="M125.863-21.726c20.781,25.2,32.563,58.254,26.345,87.708-6.218,29.618-30.6,55.635-57.272,63.49C68.1,137.489,38.81,127.18,6.574,114.744-25.662,102.472-60.679,87.908-69.843,63.2c-9-24.709,7.854-59.726,31.418-85.58,23.727-25.854,54-42.545,84.108-42.217C75.628-64.271,105.082-46.926,125.863-21.726Z" transform="translate(153.869 132.302) rotate(180)"/>
		</svg>
		<?php $this->get_name( 'mt-0 mb-2' ); ?>
		<?php $this->get_position( 'my-0' ); ?>
		<?php $this->get_social(); ?>

	</div>

	<?php $this->get_overlay_link(); ?>

</div>