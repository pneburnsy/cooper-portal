<?php

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

$this->sections[] = array(
	'title'  => esc_html__( 'Woocommerce', 'hub' ),
	'icon'   => 'el-icon-shopping-cart'
);

$this->sections[] = array(
	'title'  => esc_html__( 'General', 'hub' ),
	'subsection' => true,
	'fields' => array(
		array(
			'id'       => 'wc-shop-fullwidth',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Fullwidth?', 'hub' ),
			'subtitle' => esc_html__( 'Makes the shop, category and taxonomy layout fullwidth', 'hub' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'hub' ),
				'off'  => esc_html__( 'Off', 'hub' )
			),
			'default'  => 'off'
		),
		array(
			'id'    => 'wc-archive-product-style',
			'type'  => 'select',	
			'title' => esc_html__( 'Woo Category Product Style', 'hub' ),
			'desc'  => esc_html__( 'Select a style for products to display on archive page', 'hub' ),
			'options' => array(
				'default'                => esc_html__( 'Default', 'hub' ),
				'classic'                => esc_html__( 'Classic', 'hub' ),
				'classic-alt'            => esc_html__( 'Classic 2', 'hub' ),
				'minimal'                => esc_html__( 'Minimal', 'hub' ),
				'minimal-2'              => esc_html__( 'Minimal 2', 'hub' ),
				'minimal-hover-shadow'   => esc_html__( 'Minimal Hover Shadow', 'hub' ),
				'minimal-hover-shadow-2' => esc_html__( 'Minimal Hover Shadow 2', 'hub' ),
			),
			'default' => 'default'
		),
		array(
			'id'       => 'wc-archive-title-bar-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Woo Category Title Bar', 'hub' ),
			'subtitle' => esc_html__( 'Turn on to show the woo category title bar', 'hub' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'hub' ),
				'off'  => esc_html__( 'Off', 'hub' )
			),
			'default'  => 'on'
		),
		array(
			'id'       => 'wc-ajax-filter',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Woo Ajax filter', 'hub' ),
			'subtitle' => esc_html__( 'Enable WooCommerce Ajax filter', 'hub' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'hub' ),
				'off'  => esc_html__( 'Off', 'hub' )
			),
			'default'  => 'off'
		),
		array(
			'id'       => 'wc-ajax-pagination',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Woo Ajax pagination', 'hub' ),
			'subtitle' => esc_html__( 'Enable WooCommerce Ajax pagination', 'hub' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'hub' ),
				'off'  => esc_html__( 'Off', 'hub' )
			),
			'default'  => 'off'
		),
		array(
			'id'       => 'wc-ajax-pagination-type',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Woo Ajax pagination type', 'hub' ),
			'subtitle' => esc_html__( 'Controls WooCommerce Ajax pagination type', 'hub' ),
			'options'  => array(
				'classic' => esc_html__( 'Classic', 'hub' ),
				'scroll'  => esc_html__( 'Scroll', 'hub' ),
				'button'  => esc_html__( 'Button', 'hub' ),
			),
			'default'  => 'classic',
			'required' => array(
				'wc-ajax-pagination',
				'equals',
				'on'
			),
		),
		array(
			'id'       => 'wc-ajax-pagination-button-text',
			'type'	   => 'text',
			'title'    => esc_html__( 'Woo Ajax pagination button text', 'hub' ),
			'subtitle' => esc_html__( 'Controls WooCommerce Ajax button text', 'hub' ),
			'default'  => esc_html__( 'Load more products', 'hub' ),
			'required' => array(
				'wc-ajax-pagination-type',
				'equals',
				'button'
			),
		),
		array(
			'id'       => 'wc-archive-title-bar-heading',
			'type'	   => 'text',
			'title'    => esc_html__( 'Woo Category Title', 'hub' ),
			'subtitle' => esc_html__( 'Controls the title text that displays in the woo category', 'hub' ),
		),
		array(
			'id'       => 'wc-archive-title-bar-subheading',
			'type'	   => 'text',
			'title'    => esc_html__( 'Woo Category Subtitle', 'hub' ),
			'subtitle' => esc_html__( 'Controls the subtitle text that displays in the woo category', 'hub' )
		),
		//Sorters/product result
		array(
			'id'       => 'wc-archive-breadcrumb',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Breadcrumb', 'hub' ),
			'subtitle' => esc_html__( 'Turn on to show breadcrumb', 'hub' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'hub' ),
				'off'  => esc_html__( 'Off', 'hub' )
			),
			'default'  => 'off'
		),
		array(
			'id'       => 'wc-archive-grid-list',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Grid/List', 'hub' ),
			'subtitle' => esc_html__( 'Turn on to show grid/list selector', 'hub' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'hub' ),
				'off'  => esc_html__( 'Off', 'hub' )
			),
			'default'  => 'off'
		),
		array(
			'id'       => 'wc-archive-image-gallery',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Show Gallery?', 'hub' ),
			'subtitle' => esc_html__( 'Enable to show images from the gallery', 'hub' ),
			'options'  => array(
				'on'   => esc_html__( 'Yes', 'hub' ),
				'off'  => esc_html__( 'No', 'hub' )
			),
			'default'  => 'off'
		),
		array(
			'id'       => 'wc-archive-show-number',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Show Products Limiter', 'hub' ),
			'subtitle' => esc_html__( 'Turn on to show products limits on the page', 'hub' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'hub' ),
				'off'  => esc_html__( 'Off', 'hub' )
			),
			'default'  => 'off'
		),
		array(
			'id'       => 'wc-archive-show-product-cats',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Show Widgetized Side Drawer', 'hub' ),
			'subtitle' => esc_html__( 'Turn on to enable widgetized side drawer', 'hub' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'hub' ),
				'off'  => esc_html__( 'Off', 'hub' )
			),
			'default'  => 'off'
		),
		array(
			'id'      => 'wc-widget-side-drawer-label',
			'type'    => 'text',
			'title'   => esc_html__( 'Label For Side Drawer', 'hub' ),
			'default' => esc_html__( 'Filter Products', 'hub' ),
			'required' => array(
				'wc-archive-show-product-cats',
				'equals',
				'on'
			),
		),
		array(
			'id'       => 'wc-widget-side-drawer-sidebar-id',
			'type'     => 'select',
			'title'    => esc_html__( 'Widgetized Side Drawer', 'hub' ),
			'subtitle' => esc_html__( 'Choose the widgetized area to display in the side drawer.', 'hub' ),
			'data'     => 'sidebars',
			'required' => array(
				'wc-archive-show-product-cats',
				'equals',
				'on'
			),
		),
		array(
			'id'      => 'wc-widget-side-drawer-mobile',
			'type'	  => 'button_set',
			'title'   => esc_html__( 'Show  on Mobile only?', 'hub' ),
			'subtitle' => esc_html__( 'Show the widgetized side drawer only for mobile devices?', 'hub' ),
			'options'  => array(
				'yes'   => esc_html__( 'Yes', 'hub' ),
				'no'  => esc_html__( 'No', 'hub' )
			),
			'default'  => 'no',
			'required' => array(
				'wc-archive-show-product-cats',
				'equals',
				'on'
			),
		),
		array(
			'id'       => 'wc-archive-result-count',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Result Count', 'hub' ),
			'subtitle' => esc_html__( 'Turn on to show result count on shop/category page', 'hub' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'hub' ),
				'off'  => esc_html__( 'Off', 'hub' )
			),
			'default'  => 'off'
		),
		array(
			'id'       => 'wc-archive-sorter-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Sorter By', 'hub' ),
			'subtitle' => esc_html__( 'Turn on to show sorterby on shop/category page', 'hub' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'hub' ),
				'off'  => esc_html__( 'Off', 'hub' )
			),
			'default'  => 'off'
		),
		array(
			'id'      => 'ld_woo_products_per_page',
			'type'    => 'text',	
			'title'   => esc_html__( 'Number of Products Displayed per Page', 'hub' ),
			'desc'    => esc_html__( 'This option works with predefined WooCommerce catalog page and category pages', 'hub' ),
			'default' => '9'
		),
		array(
			'id'      => 'ld_woo_columns',
			'type'    => 'slider',
			'title'   => esc_html__( 'Number of Products Per Row', 'hub' ),
			'desc'    => esc_html__( 'Define number of products per row to display on your predefined WooCommerce page and category pages', 'hub' ),
			'min'     => 1,
			'max'     => 6,
			'default' => 3
		),
	) 
);

$this->sections[] = array(
	'title'  => esc_html__( 'Product Single', 'hub' ),
	'subsection' => true,
	'fields' => array(
		array(
			'id'       => 'product-page-style',
			'type'     => 'select',
			'title'    => esc_html( 'Product Single Style', 'hub' ),
			'subtitle' => esc_html__( 'Select a style for the single product page', 'hub' ),
			'options'  => array(
				'0'    => esc_html__( 'Default', 'hub' ),
				'1'    => esc_html__( 'Style 1', 'hub' ),
				'2'    => esc_html__( 'Style 2', 'hub' ),
				'3'    => esc_html__( 'Style 3', 'hub' ),
			),
			'default' => '0'
		),
		array(
			'id'       => 'wc-custom-layout-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Woo Single Product Layout', 'hub' ),
			'subtitle' => esc_html__( 'Turn on to enable custom layouts', 'hub' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'hub' ),
				'off'  => esc_html__( 'Off', 'hub' )
			),
			'default'  => 'off'
		),
		array(
			'id'       =>'wc-custom-layout',
			'type'     => 'select',
			'title'    => esc_html__( 'Product Layout', 'hub' ),
			'subtitle' => esc_html__( 'Select a layout for the product single page', 'hub' ),
			'data'     => 'post',
			'args' => array( 
				'post_type' => 'ld-product-layout', 
				'posts_per_page' => -1 
			),
			'required' => array(
				'wc-custom-layout-enable',
				'equals',
				'on'
			),
		),
		array(
			'id'       => 'wc-title-bar-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Single Product Title Wrapper', 'hub' ),
			'options'  => array(
				'on'  => esc_html__( 'On', 'hub' ),
				'off' => esc_html__( 'Off', 'hub' )
			),
			'default'  => 'on'
		),
		array(
			'id'       => 'wc-add-to-cart-ajax-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Ajax add to cart ( single product )', 'hub' ),
			'subtitle' => esc_html__( 'Turn on enable ajax add to cart on single product page', 'hub' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'hub' ),
				'off'  => esc_html__( 'Off', 'hub' )
			),
			'default'  => 'off'
		),
		array(
			'id'       => 'wc-share-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Woo Single Product Share', 'hub' ),
			'subtitle' => esc_html__( 'Turn on to show the share links', 'hub' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'hub' ),
				'off'  => esc_html__( 'Off', 'hub' )
			),
			'default'  => 'on'
		),
		array(
			'id'      => 'ld_woo_related_columns',
			'type'    => 'slider',	
			'title'   => esc_html__( 'Number of Related Products', 'hub' ),
			'desc'    => esc_html__( 'Define number of related products.', 'hub' ),
			'min'     => 1,
			'max'     => 6,
			'default' => 4
		),
		array(
			'id'      => 'ld_woo_cross_sell_columns',
			'type'    => 'slider',
			'title'   => esc_html__( 'Number of Displayed Cross-sells', 'hub' ),
			'desc'    => esc_html__( 'Define number of cross-sells display.', 'hub' ),
			'min'     => 1,
			'max'     => 6,
			'default' => 2
		),	
		array(
			'id'      => 'ld_woo_up_sell_columns',
			'type'    => 'slider',
			'title'   => esc_html__( 'Number of Displayed Up-sells', 'hub' ),
			'desc'    => esc_html__( 'Define number of up-sells display.', 'hub' ),
			'min'     => 1,
			'max'     => 6,
			'default' => 4
		),
	) 
);

$this->sections[] = array(
	'title'  => esc_html__( 'Mini Cart & Offcanvas', 'hub' ),
	'subsection' => true,
	'fields' => array(
		array(
			'id'       => 'wc_cart_tag',
			'type'     => 'select',
			'title'    => esc_html( 'Empty Cart Text HTML tag', 'hub' ),
			'subtitle' => esc_html__( 'Select a html tag', 'hub' ),
			'options'  => array(
				'h1'   => esc_html( 'H1', 'hub' ),
				'h2'   => esc_html( 'H2', 'hub' ),
				'h3'   => esc_html( 'H3', 'hub' ),
				'h4'   => esc_html( 'H4', 'hub' ),
				'h5'   => esc_html( 'H5', 'hub' ),
				'h6'   => esc_html( 'H6', 'hub' ),
				'div'  => esc_html( 'div', 'hub' ),
				'span' => esc_html( 'span', 'hub' ),
				'p'    => esc_html( 'p', 'hub' ),
			),
			'default' => 'h3'
		),
		array(
			'id'       => 'wc_cart_content_before',
			'type'     => 'editor',
			'title'    => esc_html__( 'Cart Before', 'hub' ),
			'subtitle' => '',
		),
		array(
			'id'       => 'wc_cart_content_products_before',
			'type'     => 'editor',
			'title'    => esc_html__( 'Cart Products Before', 'hub' ),
			'subtitle' => '',
		),
		array(
			'id'       => 'wc_cart_content_products_after',
			'type'     => 'editor',
			'title'    => esc_html__( 'Cart Products After', 'hub' ),
			'subtitle' => '',
		),
		array(
			'id'       => 'wc_cart_content_after',
			'type'     => 'editor',
			'title'    => esc_html__( 'Cart After', 'hub' ),
			'subtitle' => '',
		),
	) 
);

$this->sections[] = array(
	'title'  => esc_html__( 'Advanced', 'hub' ),
	'subsection' => true,
	'fields' => array(
		array(
			'id'       => 'wc_minimum_order_amount',
			'type'	   => 'text',
			'title'    => esc_html__( 'Minimum Order Amount', 'hub' ),
			'subtitle' => esc_html__( "Set decimal minimum order amount. Example: 50. If you don't want to use it, type '0' or leave it empty.", 'hub' ),
			'default'  => '0',
		),
		array(
			'id'       => 'wc_minimum_order_amount_text',
			'type'	   => 'textarea',
			'title'    => esc_html__( 'Minimum Order Amount Text', 'hub' ),
			'subtitle' => esc_html__( "Add notice text. 1st % is total amount, 2nd % is minimum amount.", 'hub' ),
			'default'  => esc_html__( "Your current order total is %s — you must have an order with a minimum of %s to place your order", 'hub' ),
			'required' => array( 
				array( 'wc_minimum_order_amount', '>', '0' ),
			)
		),
		array(
			'id'       => 'wc_maximum_order_amount',
			'type'	   => 'text',
			'title'    => esc_html__( 'Maximum Order Amount', 'hub' ),
			'subtitle' => esc_html__( "Set decimal maximum order amount. Example: 50. If you don't want to use it, type '0' or leave it empty.", 'hub' ),
			'default'  => '0',
		),
		array(
			'id'       => 'wc_maximum_order_amount_text',
			'type'	   => 'textarea',
			'title'    => esc_html__( 'Maximum Order Amount Text', 'hub' ),
			'subtitle' => esc_html__( "Add notice text. 1st % is total amount, 2nd % is maximum amount.", 'hub' ),
			'default'  => esc_html__( "Your current order total is %s — you must have an order with a maximum of %s to place your order", 'hub' ),
			'required' => array( 
				array( 'wc_maximum_order_amount', '>', '0' ),
			)
		),
	) 
);