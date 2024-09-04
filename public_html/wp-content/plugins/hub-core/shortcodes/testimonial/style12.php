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

	<div class="d-flex flex-wrap">

		<div class="lqd-testi-left-sec w-10">
		
			<div class="lqd-testi-extra mt-2">
				<svg class="lqd-testi-quote-icon" xmlns="http://www.w3.org/2000/svg" width="38" height="29" viewBox="0 0 38 29">
					<path fill="#348EF5" d="M54.5068359,11.9578125 C49.6617596,14.3406369 47.2392578,17.1404136 47.2392578,20.3572266 C49.3043723,20.595509 51.0120375,21.4394133 52.3623047,22.8889648 C53.7125719,24.3385164 54.3876953,26.0163967 54.3876953,27.9226563 C54.3876953,29.948057 53.7324284,31.6557222 52.421875,33.0457031 C51.1113216,34.435684 49.4632261,35.1306641 47.4775391,35.1306641 C45.2535696,35.1306641 43.3274821,34.22719 41.6992188,32.4202148 C40.0709554,30.6132397 39.2568359,28.4190884 39.2568359,25.8376953 C39.2568359,18.093516 43.5855687,12.0372614 52.2431641,7.66875 L54.5068359,11.9578125 Z M32.7041016,11.9578125 C27.8193115,14.3406369 25.3769531,17.1404136 25.3769531,20.3572266 C27.4817814,20.595509 29.2093031,21.4394133 30.5595703,22.8889648 C31.9098375,24.3385164 32.5849609,26.0163967 32.5849609,27.9226563 C32.5849609,29.948057 31.9197658,31.6557222 30.5893555,33.0457031 C29.2589452,34.435684 27.6009214,35.1306641 25.6152344,35.1306641 C23.3912649,35.1306641 21.4751057,34.22719 19.8666992,32.4202148 C18.2582927,30.6132397 17.4541016,28.4190884 17.4541016,25.8376953 C17.4541016,18.093516 21.7629777,12.0372614 30.3808594,7.66875 L32.7041016,11.9578125 Z" transform="translate(-17 -7)"/>
				</svg>
			</div><!-- /.lqd-testi-extra -->

		</div><!-- /.lqd-testi-left-sec -->

		<div class="lqd-testi-right-sec w-90 px-5">

			<div class="d-flex flex-column flex-grow">
		
				<div class="lqd-testi-quote mb-5">
					<?php $this->get_quote(); ?>
				</div><!-- /.lqd-testi-quote -->
		
			</div><!-- /.d-flex flex-column -->
		
			<div class="lqd-testi-details">
				<?php $this->get_avatar() ?>
				<div class="lqd-testi-np">
					<?php $this->get_name() ?>
					<?php $this->get_position() ?>
				</div><!-- /.lqd-testi-np -->

			</div><!-- /.lqd-testi-details -->

		</div><!-- /.lqd-testi-right-sec -->

	</div><!-- /.d-flex flex-wrap -->

</div><!-- /.lqd-testi lqd-testi-card -->