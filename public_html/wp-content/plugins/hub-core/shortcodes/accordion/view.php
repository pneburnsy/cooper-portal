<?php
extract( $atts );

// Enqueue Conditional Script
$this->scripts();

if ( empty( $items ) ) {
	echo '';
}

// classes
$classes = array(
	'accordion',
	$this->get_size(),
	$this->get_active_style(),
	$this->get_heading_shadow(),
	$this->get_items_shadow(),
	$this->get_items_fill(),
	$this->get_color_classname(),
	$borders,
	$border_round,
	$body_border_round,
	$expander_position,
	$expander_size,

	$el_class,
	$this->get_id()
);

// icons
$icon        = liquid_get_icon( $atts, true );
$icon_active = liquid_get_icon( $atts, true, 'active_' );

$icon        = ! empty( $icon ) ? $icon[ 'icon' ] : 'fa fa-plus';
$icon_active = ! empty( $icon_active ) ? $icon_active[ 'icon' ] : 'fa fa-minus';

$active_tab = ! empty( $active_tab ) ? intval( $active_tab ) - 1 : 0;

$this->generate_css();
?>
<div class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>" id="<?php echo $this->get_id() ?>"
     role="tablist" aria-multiselectable="true">

	<?php
	if ( $items ) {
		$is_front_editor = vc_is_inline() && vc_frontend_editor()->post_shortcodes;
		foreach ( $items as $i => $item ):
			$in = $i == $active_tab ? ' in' : '';
			$active      = $i == $active_tab ? ' active' : '';
			$expanded    = $i == $active_tab ? 'true' : 'false';
			$collapsed   = $i == $active_tab ? '' : 'collapsed';

			if ( $is_front_editor ) {

				foreach ( vc_frontend_editor()->post_shortcodes as $post_shortcode ) {
					$post_shortcode = (array) json_decode( rawurldecode( $post_shortcode ) );
					if ( $post_shortcode[ 'tag' ] === $item[ 'tag' ] && $post_shortcode[ 'attrs' ]->tab_id === $item[ 'tab_id' ] ) {
						$post_shortcode[ 'attrs' ] = (array) $post_shortcode[ 'attrs' ];
						$shortcode                 = (array) $post_shortcode;
						break;
					}
				}

				$shortcode_obj = visual_composer()->getShortCode( $shortcode[ 'tag' ] );
				$shortcode     = apply_filters( 'vc_frontend_editor_to_string', $shortcode, $shortcode_obj );

			}

			if ( $is_front_editor ) { ?>
                <div class="vc_element" data-tag="<?php echo esc_attr( $item[ 'tag' ] ); ?>"
                data-shortcode-controls="<?php echo esc_attr( wp_json_encode( $shortcode_obj->shortcodeClass()->getControlsList() ) ); ?>"
                data-model-id="<?php echo esc_attr( $shortcode[ 'id' ] ); ?>">
			<?php } ?>
            <div class="accordion-item panel <?php echo $active ?> <?php echo $item[ 'extra' ]; ?>">

                <div class="accordion-heading" role="tab" id="heading_<?php echo $this->get_id( $item ) ?>" data-id="<?php echo $this->get_id( $item ) ?>">
                    <h4 class="accordion-title" data-controls="<?php echo $this->get_id( $item ) ?>">
                        <a class="<?php echo $collapsed ?>" data-toggle="collapse"
                           data-parent="#<?php echo $this->get_id() ?>" href="#<?php echo $this->get_id( $item ) ?>"
                           aria-expanded="<?php echo $expanded ?>" aria-controls="<?php echo $this->get_id( $item ) ?>">

							<?php if ( $item[ 'icon' ][ 'type' ] ) {
								printf( '<span class="accordion-title-icon mr-2"><i class="%s"></i></span>', $item[ 'icon' ][ 'icon' ] );
							} ?>

							<?php echo wp_kses_data( $item[ 'title' ] ) ?>

							<?php if ( 'yes' === $show_icon ) { ?>
                                <span class="accordion-expander">
						<i class="<?php echo $icon ?>"></i>
						<i class="<?php echo $icon_active ?>"></i>
					</span>
							<?php } ?>

                        </a>

                    </h4>
                </div>

                <div id="<?php echo $this->get_id( $item ) ?>" class="accordion-collapse collapse<?php echo $in ?>"
                     role="tabpanel" aria-labelledby="heading_<?php echo $this->get_id( $item ) ?>">
                    <div class="accordion-content">
						<?php echo $item[ 'content' ]; ?>
                    </div>
                </div>
            </div>
			<?php if ( $is_front_editor ) { ?>
            </div>
		<?php }
		endforeach;
	} else {
		echo vc_container_anchor();
	} ?>
</div>