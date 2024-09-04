<?php

extract( $atts );



// Enqueue Conditional Script
$this->scripts();

$classes = array( 
	'lqd-slsh-alt',	
	$el_class, 
	$this->get_id() 
);

$this->generate_css();

?>

<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">

	<div class="lqd-slsh-alt-scrn overflow-hidden" data-lqd-slideshow="true" data-inview="true">

		<span class="lqd-slsh-alt-loader d-inline-flex pos-abs z-index-3">
			<span class="d-inline-flex circle"></span>
		</span>

		<div class="lqd-slsh-alt-scrn-inner pos-rel overflow-hidden h-100">

			<div class="lqd-slsh-alt-ext pos-abs pos-tl w-100 px-md-7">
			
				<ul class="reset-ul pos-rel">
				<?php $this->get_content(); ?>
				</ul>

			</div><!-- /.lqd-slsh-alt-ext -->

			<div class="lqd-slsh-alt-images w-100 h-100 z-index-0 pos-abs pos-tl">
			<?php $this->get_images() ?>
			</div><!-- /.lqd-slsh-alt-images -->
		
			
			<div class="lqd-slsh-alt-menu w-100 h-100 z-index-2 pos-abs pos-tl">

				<ul class="reset-ul d-flex flex-column w-100 h-100 text-vertical pos-abs pos-tl">
				<?php $this->get_nav() ?>
				</ul>

			</div><!-- /.lqd-slsh-alt-menu -->

		</div><!-- /.lqd-slsh-alt-scrn-inner -->

		<span class="lqd-extra-cursor pos-fix"></span>

	</div><!-- /.lqd-slsh-alt-scrn -->

</div><!-- /.lqd-slsh-alt -->