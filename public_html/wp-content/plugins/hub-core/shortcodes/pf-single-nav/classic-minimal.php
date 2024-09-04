<?php

extract( $atts );

$classes = array(
	'lqd-pf-meta-nav', 
	'lqd-pf-meta-nav-classic',
	'lqd-pf-meta-nav-classic-minimal',
	'd-flex', 
	'align-items-sm-center', 
	'justify-content-between',
	$this->get_id() 
);

$this->generate_css();

$prev_post_obj   = get_adjacent_post( false, '', true, 'liquid-portfolio-category' );
$prev_post_ID    = isset( $prev_post_obj->ID ) ? $prev_post_obj->ID : '';
$prev_post_link  = get_permalink( $prev_post_ID );
$prev_post_title = get_the_title( $prev_post_ID );

$next_post_obj   = get_adjacent_post( false, '', false, 'liquid-portfolio-category' );
$next_post_ID    = isset( $next_post_obj->ID ) ? $next_post_obj->ID : '';
$next_post_link  = get_permalink( $next_post_ID );
$next_post_title = get_the_title( $next_post_ID );

?>

<div class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">
	
	<?php if( $prev_post_ID ): ?>
	<a href="<?php echo esc_url( $prev_post_link ); ?>" class="lqd-pf-nav-link lqd-pf-nav-prev d-flex align-items-center">
		<span class="d-flex">
			<span class="lqd-pf-nav-link-title d-flex align-items-center"><i class="lqd-icn-ess icon-ion-ios-arrow-back"></i> <?php esc_html_e( 'Previous', 'landinghub-core' ); ?></span>
		</span>
	</a><!-- /.lqd-pf-nav-link lqd-pf-nav-prev -->
	<?php endif; ?>

	<?php if( function_exists( 'liquid_portfolio_archive_link' ) ) { ?>
		<?php echo liquid_portfolio_archive_link(); ?>
	<?php } ?>

	<?php if( $next_post_ID ): ?>
	<a href="<?php echo esc_url( $next_post_link ); ?>" class="lqd-pf-nav-link lqd-pf-nav-next d-flex flex-row-reverse align-items-center">
		<span class="d-flex text-right">
			<span class="lqd-pf-nav-link-title d-flex align-items-center"><?php esc_html_e( 'Next', 'landinghub-core' ); ?> <i class="lqd-icn-ess icon-ion-ios-arrow-forward"></i></span>
		</span>
	</a><!-- /.lqd-pf-nav-link lqd-pf-nav-next -->
	<?php endif; ?>

</div><!-- /.lqd-pf-meta-nav -->