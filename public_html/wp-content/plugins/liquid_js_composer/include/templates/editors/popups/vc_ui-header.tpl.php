<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
?>
<!-- param window header-->
<div
	class="<?php echo esc_attr( $header_css_class ); ?> vc_ui-panel-header-container <?php echo ( isset( $stacked_bottom ) && $stacked_bottom ) || ! isset( $stacked_bottom ) ? 'vc_ui-panel-header-o-stacked-bottom' : ''; ?>"
	data-vc-ui-element="panel-heading">
	<div class="vc_ui-panel-header">
		<?php if ( isset( $title ) ) : ?>
			<div class="vc_ui-panel-header-heading">
				<h3 data-vc-ui-element="panel-title"><?php echo esc_html( $title ) ?></h3>
				<div class="vc_ui-panel-header-controls">
					<?php foreach ( $controls as $key => $control ) : ?>
						<?php if ( is_array( $control ) && isset( $control['template'] ) ) : ?>
							<?php vc_include_template( $control['template'], isset( $control['variables'] ) ? $control['variables'] : array() ); ?>
						<?php else : ?>
							<button type="button" class="vc_general vc_ui-control-button vc_ui-<?php echo esc_attr( $control ); ?>-button" data-vc-ui-element="button-<?php echo esc_attr( $control ); ?>">
								<i class="vc-composer-icon vc-c-icon-<?php echo esc_attr( $control ); ?>"></i></button>
						<?php endif ?>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif ?>
		<div class="vc_ui-panel-header-content" data-vc-ui-element="panel-header-content">
			<?php if ( isset( $content_template ) && ! empty( $content_template ) ) : ?>
				<?php vc_include_template( $content_template, isset( $template_variables ) && is_array( $template_variables ) ? $template_variables : array() ); ?>
			<?php endif ?>
		</div>
		<div class="vc_ui-panel-header-header vc_ui-grid-gap" data-vc-panel-container=".vc_ui-panel-header-container">
			<?php if ( isset( $search_template ) && ! empty( $search_template ) ) : ?>
				<?php vc_include_template( $search_template ); ?>
			<?php endif ?>
		</div>
		<?php if ( ! isset( $title ) ) : ?>
			<div class="vc_ui-panel-header-controls">
				<?php foreach ( $controls as $key => $control ) : ?>
					<?php if ( is_array( $control ) && isset( $control['template'] ) ) : ?>
						<?php vc_include_template( $control['template'], isset( $control['variables'] ) ? $control['variables'] : array() ); ?>
					<?php else : ?>
						<button type="button" class="vc_general vc_ui-control-button vc_ui-<?php echo esc_attr( $control ); ?>-button" data-vc-ui-element="button-<?php echo esc_attr( $control ); ?>">
							<i class="vc-composer-icon vc-c-icon-<?php echo esc_attr( $control ); ?>"></i></button>
					<?php endif ?>
				<?php endforeach; ?>
			</div>
		<?php endif ?>
	</div>
</div>
