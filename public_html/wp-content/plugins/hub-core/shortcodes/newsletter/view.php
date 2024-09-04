<?php

extract( $atts );

$classes = array( 
	'ld-sf',
	$this->get_class( $style ), 
	$this->get_btn_class( $btn_style ), 
	$this->get_btn_eql(), 
	$show_inline,
	$inputs_size, 
	$inputs_radius, 
	$inputs_border, 
	$inputs_shadow, 
	$btn_state, 
	$btn_position,
	$btn_shrink,
	$el_class, 
	$this->get_id() 

);
// Enqueue Conditional Script
$this->scripts();
$this->generate_css();

?>
<div id="<?php echo $this->get_id(); ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>" >

	<form class="ld_subscribe_form ld_sf_form" method="post" action="<?php echo the_permalink() ?>">
		<p class="ld_sf_paragraph">
			<?php if( $enable_name_field ) { ?>
				<input type="text" class="ld_sf_text ld_sf_name" name="fname" placeholder="<?php echo esc_attr( $placeholder_nametext ) ?>" />
			<?php } ?>
			<input type="email" class="ld_sf_text ld_sf_email" name="email" placeholder="<?php echo esc_attr( $placeholder_text ) ?>" />
		</p>
		<?php $this->get_submit_button(); ?>
		<input type="hidden" class="ld_sf_list_id" name="list_id" value="<?php echo $list_id ?>">
		<?php wp_nonce_field( 'ld-mailchimp-form' ); ?>
	</form>
	<div class="ld_sf_response"></div>
</div>