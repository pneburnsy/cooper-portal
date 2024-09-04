<?php

extract( $atts );

$classes = array( 
	'lqd-fb',
	$this->get_class( $template ), 

	$el_class, 
	$this->get_id() 
);

// Enqueue Conditional Script
$this->scripts();

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>">
	<div class="lqd-fb-inner d-flex flex-wrap align-items-stretch">

		<div class="w-45 d-flex align-items-stretch">
			<div class="lqd-fb-img d-flex align-items-stretch w-100">
				<figure class="w-100" data-responsive-bg="true">
					<?php $this->get_image( false, true ); ?>
					<?php $this->get_overlay_link() ?>
				</figure>
			</div>
		</div>

		<div class="w-55">
			<div class="lqd-fb-content pos-rel">
				<div class="lqd-fb-bg lqd-overlay"></div>
				<div class="lqd-fb-hover-overlay lqd-overlay"></div>
				<div class="lqd-fb-content-inner pos-rel py-6 px-5">
					
					<?php if( !empty( $title ) ) { ?>
					<<?php echo $tag; ?> class="lqd-fb-content-title my-0 mb-3 font-weight-semibold"><?php $this->get_title(); ?></<?php echo $tag; ?>>
					<?php } ?>
					
					<?php if( !empty( $content ) ) { ?>
					<p class="my-0 mb-3"><?php $this->get_content(); ?></p>
					<?php } ?>

				</div>
			</div>
		</div>

	</div>
</div>