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
	<div class="lqd-fb-inner">

		<div class="lqd-fb-content">
			<div class="lqd-fb-content-inner">
				
				<?php if( !empty( $title ) ) { ?>
				<div class="lqd-fb-title pos-rel d-inline-flex mb-2">
					<<?php echo $tag; ?> class="lqd-fb-content-title my-0"><?php $this->get_title(); ?></<?php echo $tag; ?>>
					<i class="lqd-icn-ess icon-ion-ios-arrow-forward"></i>
				</div>
				<?php } ?>
				
				<?php if( !empty( $content ) ) { ?>
				<p class="my-0 mb-3"><?php $this->get_content(); ?></p>
				<?php } ?>
				
				<?php $this->get_button() ?>
			</div>
		</div>

	</div>
</div>