<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$editAccess = vc_user_access_check_shortcode_edit( $shortcode );
$allAccess = vc_user_access_check_shortcode_all( $shortcode );
$moveAccess = vc_user_access()->part( 'dragndrop' )->checkStateAny( true, null )->get();
// @codingStandardsIgnoreStart
?>
<div class="vc_controls<?php echo ! empty( esc_attr( $extended_css ) ) ? ' ' . esc_attr( $extended_css ) : ''; ?>">
	<div class="vc_controls-<?php echo esc_attr( $position ); ?>">
		<a class="<?php echo esc_attr( $name_css_class ); ?>">
				<span class="vc_btn-content" title="<?php
						if ( $allAccess && $moveAccess ) :
						printf( esc_attr__( 'Drag to move %s', 'js_composer' ), esc_attr( $name ) );
						?>"><i class="la la-arrows"></i>
							<?php
							else : print( esc_attr( $name ) );
								echo '">';
							endif;
							echo esc_html( $name ); ?></span>
		</a>
		<?php foreach ( $controls as $control ) : ?>
			<?php if ( 'add' === $control && $add_allowed ) : ?>
				<a class="vc_control-btn vc_control-btn-prepend vc_edit" href="#"
						title="<?php printf( esc_attr__( 'Prepend to %s', 'js_composer' ), esc_attr( $name ) ); ?>"><span
							class="vc_btn-content"><i class="la la-plus"></i></span></a>
			<?php elseif ( $editAccess && 'edit' === $control ) : ?>
				<a class="vc_control-btn vc_control-btn-edit" href="#"
						title="<?php printf( esc_attr__( 'Edit %s', 'js_composer' ), esc_attr( $name ) ); ?>"><span
							class="vc_btn-content"><i class="la la-pen"></i></span></a>
			<?php elseif ( $allAccess && 'clone' === $control ) : ?>
				<a class="vc_control-btn vc_control-btn-clone" href="#"
						title="<?php printf( esc_attr__( 'Clone %s', 'js_composer' ), esc_attr( $name ) ); ?>"><span
							class="vc_btn-content"><i class="la la-copy"></i></span></a>
			<?php elseif ( $allAccess && 'delete' === $control ) : ?>
				<a class="vc_control-btn vc_control-btn-delete" href="#"
						title="<?php printf( esc_attr__( 'Delete %s', 'js_composer' ), esc_attr( $name ) ); ?>"><span
							class="vc_btn-content"><i class="la la-times"></i></span></a>
			<?php endif ?>
		<?php endforeach ?>
	</div>
</div>
<?php
// @codingStandardsIgnoreEnd
