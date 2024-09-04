<?php

extract( $atts );

// classes
$classes = array( 
	'iconbox', 
	$position,
	$alignment,
	$items_alignment,
	$border_radius,
	$shadow,
	$heading_gradient,
	$this->get_shape(),
	$this->get_size(),
	$this->get_heading_size(),
	$this->get_heading_icon_onhover_classnames(),
	$this->get_fill(),
	$this->get_hover_fill(),
	$this->get_toggleable(),
	$this->get_ripple_classnames(),
	$this->get_animated_icon_classname(),
	$get_bubble_classname,
	$get_content_hover_classname,
	$scale_bg,
	$i_linked,
	$el_class,
	$this->get_id(),
	trim( vc_shortcode_custom_css_class( $css ) )
);

// Enqueue Conditional Script
$this->scripts();

$this->generate_css();

$svg_attributes = $this->get_svg_attributes();

?>

<div class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>" id="<?php echo $this->get_id(); ?>" <?php echo ld_helper()->html_attributes( $svg_attributes ) ?> <?php echo $this->get_border_opts() ?> <?php echo $this->get_toggleable_opts() ?>>
	
	<?php if( 'floating' === $label_position ) { ?>
		<?php $this->get_label(); ?>
	<?php } ?>	
	
	<?php $this->get_the_icon() ?>
	
	<?php if( 
			'iconbox-inline' === $position || 
			'yes' === $toggleable          || 
			'iconbox-bubble' === $get_bubble_classname 
			) {
		$this->get_title();
	} ?>
	
	<?php echo $this->before_icon_box_content() ?>
	
	<?php if( 'in_content' === $label_position ) { ?>
		<?php $this->get_label(); ?>
	<?php } ?>
	
	<?php if( 
			'iconbox-inline' !== $position && 
			'yes' !== $toggleable && 
			'iconbox-bubble' !== $get_bubble_classname 
			) { $this->get_title(); } 
	?>
	<?php $this->get_content() ?>
	<?php $this->get_button() ?>
	
	<?php echo $this->after_icon_box_content() ?>
	
	<?php $this->get_overlay_link(); ?>

</div>
