<?php

extract( $atts );

$classes = array( 
	'lqd-scrl-indc',
	$this->get_id()
);

$this->generate_css();

?>
<div class="header-module">
	<div class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>" id="<?php echo $this->get_id(); ?>" data-lqd-scroll-indicator="true">
		<a href="#wrap" data-localscroll="true">
			<span class="lqd-scrl-indc-inner">
				<span class="lqd-scrl-indc-txt"><?php esc_html_e( 'scroll', 'landinghub-core' ) ?></span>
				<span class="lqd-scrl-indc-line">
					<span class="lqd-scrl-indc-el"></span>
				</span>
			</span>
		</a>
	</div><!-- /.lqd-scrl-indc -->
</div><!-- /.header-module -->