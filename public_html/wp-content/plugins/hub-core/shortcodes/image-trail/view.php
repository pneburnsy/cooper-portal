<?php

extract( $atts );

// classes
$classes = array( 
	'lqd-img-trail',

	$el_class, 
	$this->get_id() 
);

$this->generate_css();
$attachments  = $this->get_attachments();

?>
<div id="<?php echo $this->get_id(); ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>" data-lqd-img-trail="true">

	<div class="lqd-img-trail-array">
		
		<?php
		foreach ( $attachments as $attachment ) {
			
			$alt = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );
			$src = wp_get_attachment_image_url( $attachment->ID, 'full', false );
			printf( '<img class="lqd-img-trail-img" src="%s" alt="%s" />', $src, $alt );

		}

		?>

	</div><!--/lqd-img-trail-array-->

</div><!-- /.lqd-img-trail -->