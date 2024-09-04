<?php

extract( $atts );

// classes
$classes = array( 
	'lqd-pb-container',
	$this->get_class( $template ),
	$el_class, 
	$this->get_id() 
);

$row_classes = $this->get_row_classes();

$this->generate_css();

global $liquid_pb_style;
$liquid_pb_style = $atts['template'];

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">

	<div class="<?php echo ld_helper()->sanitize_html_classes( $row_classes ); ?>">
	<?php
		// $this->columnize_content( $content );
		echo ld_helper()->do_the_content( $content );
	?>
	</div><!-- /.row -->

</div><!-- /.lqd-pb-container -->