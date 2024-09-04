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

		<div class="lqd-fb-img overflow-hidden">
			<?php $this->get_image( true, true ); ?>
			<?php $this->get_overlay_link() ?>
		</div>

		<div class="lqd-fb-content pos-rel">
			<div class="lqd-fb-bg lqd-overlay"></div>
			<div class="lqd-fb-hover-overlay lqd-overlay"></div>
			<div class="lqd-fb-content-inner pos-rel text-center p-5">

				<?php if( !empty( $title ) ) { ?>
				<<?php echo $tag; ?> class="lqd-fb-content-title my-0 mb-3 font-weight-normal"><?php $this->get_title(); ?></<?php echo $tag; ?>>
				<?php } ?>
				
				<?php if( !empty( $content ) ) { ?>
				<p class="my-0"> <?php $this->get_content(); ?></p>
				<?php } ?>

			</div>
			
			
			<?php if( 'yes' === $show_button ) { ?>
			<div class="lqd-fb-footer text-center py-3 px-5">
				<?php $this->get_button() ?>
			</div>
			<?php } ?>
			
		</div>

	</div>
</div>