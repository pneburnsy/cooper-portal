<?php

extract( $atts );

$classes = array(
	'lqd-pf-single-meta', 
	'columns-'.$columns,
	'd-flex',
	'flex-wrap',
	'justify-content-between',
	$this->get_id() 
);

$this->generate_css();

?>

<div class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">
	<?php $this->get_pf_single_meta(); ?>
</div><!-- /.lqd-pf-single-meta -->