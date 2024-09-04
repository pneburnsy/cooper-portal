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

		<div class="lqd-fb-img">
			<figure>
				<?php $this->get_image(false, false); ?>
			</figure>
			<span class="lqd-fb-icn">
				<i class="lqd-icn-ess icon-ion-ios-arrow-forward"></i>
			</span>
		</div>

		<div class="lqd-fb-content">
			<?php if( !empty( $title ) ) { ?>
			<<?php echo $tag; ?> class="lqd-fb-content-title my-0"><?php $this->get_title(); ?></<?php echo $tag; ?>>
			<?php } ?>
			
		</div>

		<?php $this->get_overlay_link() ?>

	</div>
</div>