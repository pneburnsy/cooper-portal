<?php

extract( $atts );

$classes = array(
	'lqd-pf-meta-nav', 
	'lqd-pf-meta-nav-not-classic', 
	'lqd-pf-meta-nav-not-classic-outline', 
	'd-flex align-items-center', 
	'justify-content-center',
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
	
	<?php if( $next_post_ID ): ?>
	<a href="<?php echo esc_url( $next_post_link ); ?>" class="lqd-pf-nav-link lqd-pf-nav-next d-flex flex-row-reverse align-items-center">
		<span class="d-flex flex-column">
			<span class="lqd-pf-nav-link-subtitle">
				<span><?php esc_html_e( 'next project', 'landinghub-core' ); ?></span>
				<i class="lqd-icn-ess icon-md-arrow-round-forward"></i>
			</span>
			<span class="lqd-pf-nav-link-title <?php echo $tag_to_inherite; ?>"><?php echo esc_html( $next_post_title ); ?></span>
		</span>
	</a><!-- /.lqd-pf-nav-link lqd-pf-nav-next -->
	<?php elseif( $prev_post_ID ): ?>
	<a href="<?php echo esc_url( $prev_post_link ); ?>" class="lqd-pf-nav-link lqd-pf-nav-next d-flex flex-row-reverse align-items-center">
		<span class="d-flex flex-column">
			<span class="lqd-pf-nav-link-subtitle">
				<span><?php esc_html_e( 'previous project', 'landinghub-core' ); ?></span>
				<i class="lqd-icn-ess icon-md-arrow-round-forward"></i>
			</span>
			<span class="lqd-pf-nav-link-title h1"><?php echo esc_html( $prev_post_title ); ?></span>
		</span>
	</a><!-- /.lqd-pf-nav-link lqd-pf-nav-next -->	
	<?php endif; ?>

</div><!-- /.lqd-pf-meta-nav -->