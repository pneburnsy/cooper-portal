<?php

// check
if( !liquid_helper()->is_woocommerce_active() || is_admin() || !is_object( WC()->cart ) ) {
	return;
}

$order_count = WC()->cart->get_cart_contents_count();
$is_empty    = WC()->cart->is_empty();
$sub_total   = WC()->cart->get_cart_subtotal();
$cart_id     = uniqid( 'cart-' );


if ( class_exists( 'Liquid_Elementor_Addons' ) ){
	$show_icon = ($show_icon === 'yes') ? 'lqd-module-show-icon' : 'lqd-module-hide-icon';
	$show_counter = ($show_counter === 'yes') ? 'lqd-module-show-badge' : 'lqd-module-hide-badge';
} else {
	$icon_opts = liquid_get_icon( $atts );
	$icon      = !empty( $icon_opts['type'] ) && ! empty( $icon_opts['icon'] ) ? $icon_opts['icon'] : 'lqd-icn-ess icon-ld-cart';
	$show_icon =  $atts['show_icon'];
	$show_counter =  $atts['show_counter'];
}

$cart_text =  $atts['cart_text'];
$icon_text =  $atts['icon_text'];
$icon_text_align =  $atts['icon_text_align'];
$icon_style =  $atts['icon_style'];
$counter_style =  $atts['counter_style'];

$trigger_class = array(
	'ld-module-trigger',
	'collapsed',
	$icon_text_align,
	$show_icon,
	$icon_style,
	$counter_style
);

?>

<div class="ld-module-cart ld-module-cart-dropdown d-flex align-items-center">
	
	<span class="<?php echo liquid_helper()->sanitize_html_classes( $trigger_class ) ?>" data-ld-toggle="true" data-toggle="collapse" data-target="<?php echo '#' . esc_attr( $cart_id ); ?>" aria-controls="<?php echo esc_attr( $cart_id ) ?>" aria-expanded="false" data-toggle-options='{ "type": "hoverFade" }'>
		<?php if ( 'lqd-module-show-icon' === $show_icon )  { ?>
			<span class="ld-module-trigger-icon">
			<?php if ( class_exists( 'Liquid_Elementor_Addons' )) : ?>
					<?php if ( empty($icon['value']) ): ?>
						<svg xmlns="http://www.w3.org/2000/svg" width="32" height="30" viewBox="0 0 32 30" style="width: 1em; height: 1em;"><path fill="currentColor" d="M.884.954c-.435.553-.328 1.19.25 1.488.272.141.878.183 2.641.183h2.287l1.67 7.657c.917 4.21 1.778 7.909 1.912 8.218.296.683.854 1.284 1.606 1.73l.563.333h15.125l.527-.283c.703-.375 1.39-1.079 1.667-1.706.231-.525 2.368-10.476 2.368-11.028 0-.17-.138-.445-.307-.614l-.307-.307H19.952c-10.306 0-10.939-.013-11.002-.219-.037-.12-.318-1.37-.624-2.778-.452-2.078-.608-2.602-.83-2.782C7.25.648 6.906.625 4.183.625h-3.04l-.259.33M29.25 8.733c0 .492-1.89 8.957-2.056 9.211-.443.676-.49.68-7.846.68-6.505 0-6.802-.011-7.185-.245-.22-.133-.487-.376-.594-.54-.106-.162-.634-2.303-1.172-4.755l-.978-4.46h9.915c5.553 0 9.916.048 9.916.109M12.156 25.118c-1.06.263-1.802 1.153-1.882 2.256-.07.971.13 1.506.792 2.116l.553.51h1.186c1.16 0 1.197-.01 1.648-.405 1.374-1.207 1.136-3.45-.455-4.282-.424-.221-1.345-.32-1.842-.196m12.74 0c-.594.15-1.288.745-1.615 1.386-.537 1.052-.261 2.333.669 3.1.461.38.53.397 1.59.397 1.272 0 1.65-.156 2.162-.895.62-.895.651-1.845.093-2.82-.525-.92-1.818-1.44-2.899-1.167M13.18 27.196a.716.716 0 0 1 .196.429c0 .248-.312.625-.517.625a.618.618 0 0 1-.608-.623c0-.553.55-.808.929-.43m12.704-.068c.37.198.325.838-.07 1.018-.258.118-.355.103-.563-.084-.304-.276-.317-.531-.043-.834.238-.264.342-.279.676-.1"></path></svg>
					<?php else: ?>
						<?php \Elementor\Icons_Manager::render_icon( $atts['icon'], [ 'aria-hidden' => 'true' ] ); ?>
					<?php endif; ?>
				<?php else: ?>
					<i class="<?php echo esc_attr( $icon ) ?>"></i>
				<?php endif; ?>
				<span class="ld-module-trigger-close-cross"></span>
			</span>
		<?php } ?>
		<span class="ld-module-trigger-txt"><?php echo do_shortcode($icon_text) ?></span>
		<?php if ( 'lqd-module-show-badge' === $show_counter )  { ?>
			<?php printf( '<span class="ld-module-trigger-count ld-module-trigger-count-sup header-cart-fragments">%s</span>', $order_count ); ?>
		<?php } ?>
	</span>
	
	<div class="ld-module-dropdown collapse pos-abs" id="<?php echo esc_attr( $cart_id ) ?>" aria-expanded="false">
		<div class="ld-cart-contents">
			<div class="header-quickcart">
				<?php liquid_woocommerce_header_cart() ?>
			</div>
			
			<?php if( !$is_empty && !empty( $cart_text ) ) { ?>
			<div class="ld-cart-message">
				<?php echo wp_kses_post( do_shortcode( $cart_text ) ); ?>
			</div>
			<?php } ?>
			
		</div>
	</div>

</div>