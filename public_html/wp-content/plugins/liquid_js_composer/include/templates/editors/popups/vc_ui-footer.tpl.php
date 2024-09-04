<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
?>
<div class="vc_ui-panel-footer-container" data-vc-ui-element="panel-footer">
	<div class="vc_ui-panel-footer">
		<div class="vc_ui-button-group">
			<?php foreach ( $controls as $control ) : ?>
				<?php
				extract( shortcode_atts( array(
					'name' => '',
					'label' => '',
					'css_classes' => '',
					'style' => 'default',
				), (array) $control ) );
				?>
				<button
					class="<?php echo strlen( $css_classes ) > 0 ? ' ' . esc_attr( $css_classes ) : ''; ?>"
					data-vc-ui-element="button-<?php echo esc_attr( $name ); ?>"><?php echo esc_html( $label ); ?></button>
			<?php endforeach ?>
			</span>
		</div>
	</div>
</div>
