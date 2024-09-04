<?php 
	
	$theme = liquid_helper()->get_current_theme();
	
?>
<nav class="lqd-dsd-menubard">

	<span class="lqd-dsd-logo">
		<img src="<?php echo get_template_directory_uri() . '/liquid/assets/img/dashboard/hubbig.svg'; ?>" alt="<?php echo esc_attr( $theme->name ); ?>">
		<?php printf( '<span class="lqd-v">%s</span>', $theme->version ); ?>
	</span>

	<ul class="lqd-dsd-menu">
		<li class="<?php echo liquid_helper()->active_tab( 'liquid' ); ?>">
			<a href="<?php echo liquid_helper()->dashboard_page_url(); ?>">
				<span><?php esc_html_e( 'Activation', 'hub' ); ?></span>
			</a>
		</li>
		<li>
			<a href="<?php echo esc_url(admin_url( 'admin.php?page=liquid-setup' )); ?>">
				<span><?php esc_html_e( 'Setup Wizard', 'hub' ); ?></span>
			</a>
		</li>
		<?php if ( !class_exists( 'Liquid_Elementor_Addons' ) && (class_exists( 'Liquid_Elementor_Addons' ) || class_exists( 'Liquid_Addons' ))): ?>
		<li class="<?php echo liquid_helper()->active_tab( 'liquid-performances' ); ?>">
			<a href="<?php echo esc_url(admin_url( 'customize.php?autofocus[panel]=optimization&autofocus[section]=optimization' )); ?>">
				<span><?php esc_html_e( 'Performance', 'hub' ); ?></span>
			</a>
		</li>
		<?php endif; ?>
		<li>
			<a href="<?php echo esc_url(admin_url( 'admin.php?page=liquid-reset' )); ?>">
				<span><?php esc_html_e( 'Reset', 'hub' ); ?></span>
			</a>
		</li>
		<li>
			<a href="<?php echo esc_url(admin_url( 'admin.php?page=liquid-about' )); ?>">
				<span><?php esc_html_e( 'Update', 'hub' ); ?></span>
			</a>
		</li>
		<li>
			<a href="https://docs.liquid-themes.com/collection/174-hub-wordpress-theme" target="_blank">
				<i class="lqd-icn-ess icon-md-help-circle"></i>
				<span><?php esc_html_e( 'Documentations', 'hub' ); ?></span>
			</a>
		</li>
	</ul>

</nav>
