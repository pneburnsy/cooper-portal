<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$total_templates = visual_composer()->templatesPanelEditor()->loadDefaultTemplates();
$templates_total_count = count( $total_templates );
?>
<div id="vc_no-content-helper" class="vc_welcome">
	<?php
	if ( vc_user_access()->part( 'shortcodes' )->checkStateAny( true, 'custom', null )->get() && vc_user_access_check_shortcode_all( 'vc_row' ) && vc_user_access_check_shortcode_all( 'vc_column' ) ) :
		?>
		<div class="vc_welcome-brand vc_welcome-visible-e">
			<img src="<?php echo esc_url( vc_asset_url( 'liquid/logo/liquid-logo.svg' ) ); ?>" alt="">
		</div>
		<div class="vc_welcome-header vc_welcome-visible-e">
			<h1><?php esc_html_e( 'Let\'s Get Started', 'js_composer' ); ?></h1>
			<p><?php esc_html_e( 'Choose a pre-built inner page, section template or add custom elements to start building your page.', 'js_composer' ); ?></p>
		</div>
		<?php
		if ( vc_user_access()->part( 'shortcodes' )->checkStateAny( true, 'custom', null )
				->get() && vc_user_access_check_shortcode_all( 'vc_row' ) && vc_user_access_check_shortcode_all( 'vc_column' ) ) :
			?>
			<div class="vc_welcome-visible-ne">
				<a id="vc_not-empty-add-element" class="vc_add-element-not-empty-button" title="<?php esc_attr_e( 'Add Element', 'js_composer' ); ?>" data-vc-element="add-element-action">
					<i class="la la-plus"></i>
				</a>
				<?php if ( $templates_total_count > 0 && vc_user_access()->part( 'templates' )->can()->get() ) : ?>
				<a id="vc_templates-more-layouts-ne" class="vc_add-element-not-empty-button" href="#">
					<i class="la la-swatchbook"></i>
				</a>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<p class="vc_ui-help-block vc_welcome-visible-e">
			<?php echo sprintf( esc_html__( 'Don\'t know where to start? %s.', 'js_composer' ), '<a href="https://docs.liquid-themes.com/" target="_blank">' . esc_html__( 'Visit our knowledge base', 'js_composer' ) . '</a>' ); ?>
		</p>
		<div class="vc_ui-btn-group vc_welcome-visible-e">
			<?php
			if ( vc_user_access()->part( 'shortcodes' )->checkStateAny( true, 'custom', null )
					->get() && vc_user_access_check_shortcode_all( 'vc_row' ) && vc_user_access_check_shortcode_all( 'vc_column' ) ) :
				?>
			<a id="vc_no-content-add-element" class="vc_general vc_ui-button vc_ui-button-shape-rounded vc_ui-button-info vc_welcome-visible-e"
					title="<?php esc_attr_e( 'Add Element', 'js_composer' ); ?>"
					data-vc-element="add-element-action" href="#">
				<i class="la la-plus"></i>
				<span><?php esc_html_e( 'Add element', 'js_composer' ); ?></span>
				</a>
				<?php
			endif;
			if ( $templates_total_count > 0 && vc_user_access()->part( 'templates' )->can()->get() ) :
				?>
			<a id="vc_templates-more-layouts" class="vc_general vc_ui-button vc_ui-button-shape-rounded vc_ui-button-info" href="#">
				<i class="la la-plus"></i>
				<span><?php esc_html_e( 'Add Section Template', 'js_composer' ); ?></span>
			</a>
			<?php
			endif;
			if ( $templates_total_count > 0 && vc_user_access()->part( 'templates' )->can()->get() ) :
				?>
			<a id="vc_templates-more-pages" class="vc_general vc_ui-button vc_ui-button-shape-rounded vc_ui-button-info" href="#">
				<i class="la la-plus"></i>
				<span><?php esc_html_e( 'Add Inner Pages', 'js_composer' ); ?></span>
			</a><?php endif; ?>
		</div>
	<?php endif; ?>
</div>
