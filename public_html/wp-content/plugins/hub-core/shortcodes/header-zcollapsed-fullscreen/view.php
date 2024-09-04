<?php

extract( $atts );

$classes = array(
	'collapse', 
	'navbar-collapse',
	'navbar-fullscreen',
	
	$el_class,
	$this->get_id()
);

$this->generate_css();

//$classes = apply_filters( 'liquid_header_collapsed_classes', $classes );
	
?>
<div class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>" id="main-header-collapse">

	<div class="lqd-fsh-bg">

		<div class="lqd-fsh-bg-side-container lqd-fsh-bg-before-container">
			<span></span>
		</div><!-- /.lqd-fsh-bg-side-container -->

		<div class="container lqd-fsh-bg-container px-0">
			<div class="row lqd-fsh-bg-row mx-0">
				<div class="col-md-3 px-0 lqd-fsh-bg-col">
					<span></span>
				</div><!-- /.col-md-3 -->
				<div class="col-md-3 px-0 lqd-fsh-bg-col">
					<span></span>
				</div><!-- /.col-md-3 -->
				<div class="col-md-3 px-0 lqd-fsh-bg-col">
					<span></span>
				</div><!-- /.col-md-3 -->
				<div class="col-md-3 px-0 lqd-fsh-bg-col">
					<span></span>
				</div><!-- /.col-md-3 -->
			</div><!-- /.row -->
		</div><!-- /.container -->

		<div class="lqd-fsh-bg-side-container lqd-fsh-bg-after-container">
			<span></span>
		</div><!-- /.lqd-fsh-bg-side-container -->

	</div><!-- /.lqd-fsh-bg -->

	<div class="header-modules-container">
		<div class="container">
		<?php echo ld_helper()->do_the_content( $content ); ?>
		</div>
	</div><!-- /.header-modules-container -->
	
</div><!-- /.navbar-collapse -->