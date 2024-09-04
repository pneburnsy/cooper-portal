<?php

extract( $atts );

// Enqueue Conditional Script
$this->scripts();

$classes = array( 
	'lqd-bnnr-1', 
	'd-flex',
	'flex-column', 
	'flex-md-row', 
	'overflow-hidden', 
	'border-radius-10',

	$el_class, 
	$this->get_id()

);

$this->generate_css();

?>

<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>">
	<div class="lqd-bnnr-left d-flex align-items-center">
		<div class="lqd-bnnr-in">
			<h3 class="mt-0 mb-5"><?php echo $this->get_title(); ?></h3>
			<?php $this->get_button(); ?>
		</div><!-- /.lqd-bnnr-in -->
	</div><!-- /.lqd-bnnr-left -->
	<div class="lqd-bnnr-right">
		<div class="lqd-bnnr-in">
			<figure>
				<?php $this->get_image(); ?>
			</figure>
		</div><!-- /.lqd-bnnr-in -->
	</div><!-- /.lqd-bnnr-right -->
</div><!-- /.lqd-bnnr-1 -->