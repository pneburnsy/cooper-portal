<?php

extract( $atts );

$classes = array( 
	'lqd-fb',
	$this->get_class( $template ), 
	$ct_alignment,
	$el_class, 
	$this->get_id() 
);

// Enqueue Conditional Script
$this->scripts();
$this->generate_css();
$link = liquid_get_link_attributes( $this->atts['img_link'], false );

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>">
	<div class="lqd-fb-inner">

		<div
		class="lqd-fb-img overflow-hidden"
		data-custom-animations="true"
		data-ca-options='{ "triggerHandler": "inview", "animationTarget": "figure", "duration": 1200, "initValues": { "scale": 1.15, "opacity": 0 }, "animations": { "scale": 1, "opacity": 1 } }'>
			<figure>
				<?php $this->get_image( false, false ); ?>
			</figure>
		</div>

		<div class="lqd-fb-content pos-rel px-3 py-4 d-flex flex-column">
			<div class="lqd-fb-content-inner pos-rel">
				<?php if( !empty( $title ) ) { ?>
				<<?php echo $tag; ?> class="lqd-fb-content-title mt-0 h4"><?php $this->get_title(); ?></<?php echo $tag; ?>>
				<?php } ?>
				<?php if( !empty( $content ) ) { ?>
				<p><?php $this->get_content(); ?></p>
				<?php } ?>
			</div>
		</div>

		<a <?php echo ld_helper()->html_attributes( $link ) ?> class="lqd-overlay"></a>

	</div>
</div>