<?php

extract( $atts );

$sc_js = $this->load_js_sc();

// Enqueue Conditional Script
$this->scripts( $sc_js );

$classes = array(
	'lqd-af-slide',
	$el_class, 
	$this->get_id() 
);

$link = liquid_get_link_attributes( $overlay_link, false );

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">
	
	<div class="lqd-af-slide__img">
		<div class="lqd-af-slide__img__inner">
			<?php $this->get_image(); ?>
			<span class="liquid-overlay-link"></span>
		</div>
	</div><!-- /.lqd-af-slide__img -->

	<div class="lqd-af-slide__content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<?php $this->get_title(); ?>
					<?php $this->get_content(); ?>
					<div class="lqd-af-slide__link">
						<?php $this->get_button(); ?>
					</div><!-- /.lqd-af-slide__link -->
					<?php if ( !empty( $link['href'] ) ) : ?>
						<a <?php echo ld_helper()->html_attributes( $link );?> class="lqd-overlay z-index-5"></a>
					<?php endif; ?>
				</div><!-- /.col-md-12 -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div><!-- /.lqd-af-slide__content -->

	<?php if ( !empty( $link['href'] ) ) : ?>
		<a <?php echo ld_helper()->html_attributes( $link );?> class="lqd-overlay z-index-4"></a>
	<?php endif; ?>

</div><!-- /.slide -->
