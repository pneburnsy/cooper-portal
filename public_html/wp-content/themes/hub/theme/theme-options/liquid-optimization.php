<?php
/*
 * Optimization Section
*/

$this->sections[] = array(
    'title'  => esc_html__( 'Performance', 'hub' ),
    'icon'   => 'el el-dashboard'  
);

if ( class_exists( 'Liquid_Elementor_Addons' ) && defined( 'ELEMENTOR_VERSION' ) ){
$this->sections[] = array(
    'title'  => esc_html__( 'General Settings', 'hub' ),
    'subsection' => true,
    'desc' => esc_html__( 'We recommend keeping the optimization options disabled while developing the website. You can enable this option to boost the performance once you are done with the development.', 'hub' ),  
    'fields' => array(
        array(
            'id' => 'enable_optimized_files',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Enable Optimize Files', 'hub' ),
            'subtitle' => esc_html__( 'Switch on to enable the optimize files.', 'hub' ),
            'description' => wp_kses_post( '<div class="notice-yellow">This option is used to reduce size of CSS and JS files. Once activated all files will be called separately as per your page’s need. JS files can be combined via Performance > JS > Combine JS option. Please note that CSS files will be combined automatically.</div>', 'hub' ),
            'options'  => array(
                'on'   => esc_html__( 'On', 'hub' ),
                'off'  => esc_html__( 'Off', 'hub' ),
            ),
            'default' => 'off'
        ),
    )
);
}

if ( !class_exists( 'Liquid_Elementor_Addons' ) && !defined( 'ELEMENTOR_VERSION' ) ){
$this->sections[] = array(
    'title'  => esc_html__( 'Optimization', 'hub' ),
    'subsection' => true,
    'desc' => esc_html__( 'We recommend keeping the optimization options disabled while developing the website. You can enable this option to boost the performance once you are done with the development.', 'hub' ),  
    'fields' => array(
        array(
            'id' => 'enable-hub-optimization',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Hub Optimization', 'hub' ),
            'subtitle' => esc_html__( 'Switch on to enable the Hub Optimization', 'hub' ),
            'options'  => array(
                'on'   => esc_html__( 'On', 'hub' ),
                'off'  => esc_html__( 'Off', 'hub' ),
            ),
            'default' => 'off'
        ),
        array(
            'id' => 'enable-hub-header-cache',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Hub Header Cache', 'hub' ),
            'subtitle' => esc_html__( 'Switch on to enable the Hub Header Cache', 'hub' ),
            'options'  => array(
                'on'   => esc_html__( 'On', 'hub' ),
                'off'  => esc_html__( 'Off', 'hub' ),
            ),
            'default' => 'off',
            'required' => array(
                'enable-hub-optimization',
                '=',
                'on'
            ),
        ),
    )
);

}

if ( class_exists( 'Liquid_Elementor_Addons' ) && defined( 'ELEMENTOR_VERSION' ) ){
    $optimized_bootsrap =  array(
        'id' => 'optimized_bootstrap',
        'type'     => 'button_set',
        'title'    => esc_html__( 'Optimize Bootstrap', 'hub' ),
        'subtitle' => wp_kses_post( 'Load a lite version of Bootstrap containing only necesessary CSS for Hub.', 'hub' ),
        'options'  => array(
            'on'   => esc_html__( 'On', 'hub' ),
            'off'  => esc_html__( 'Off', 'hub' ),
        ),
        'default' => 'off'
    );
} else {
    $optimized_bootsrap = array();
}

$this->sections[] = array(
    'title'  => esc_html__( 'CSS', 'hub' ),
    'subsection' => true,
    'fields' => array(
        $optimized_bootsrap,
        array(
            'id'       => 'disable_css',
            'type'     => 'select',
            'multi'    => true,
            'title'    => __('Disable Styles', 'hub'), 
            'subtitle' => __('Selected styles will be removed from all pages.', 'hub'),
            'options'  => array(
                'wp-block-library' => 'Gutenberg Library',
                'wp-block-library-theme' => 'Gutenberg Library Theme',
                'wc-block-style' => 'Gutenberg Woocommerce',
                'wc-blocks-vendors-style' => 'Gutenberg Woocommerce Vendors'
            ),
        )
    )
);

$js_options = array();
if ( class_exists( 'Liquid_Elementor_Addons' ) && defined( 'ELEMENTOR_VERSION' ) ){
$js_options[] = array(
    'id' => 'combine_js',
    'type'     => 'button_set',
    'title'    => esc_html__( 'Combine 3rd party JS', 'hub' ),
    'subtitle' => wp_kses_post( 'Combine 3rd party JavaScript files coming from Hub into 1 file.', 'hub' ),
    'options'  => array(
        'on'   => esc_html__( 'Yes', 'hub' ),
        'off'  => esc_html__( 'No', 'hub' ),
    ),
    'default' => 'off',
    'required' => array(
        'enable_optimized_files',
        '=',
        'on'
    ),
);
}
$js_options[] = array(
    'id' => 'manage_liquid_scripts',
    'type'     => 'button_set',
    'title'    => esc_html__( 'Manage Theme Scripts', 'hub' ),
    'subtitle' => wp_kses_post( 'This settings for advanced users. Manage js files.', 'hub' ),
    'options'  => array(
        'on'   => esc_html__( 'Yes', 'hub' ),
        'off'  => esc_html__( 'No', 'hub' ),
    ),
    'default' => 'off',
    'required' => array(
        'lqd_disabled_opts',
        '=',
        'on'
    ),
);

if ( is_array( get_option('liquid_scrips') ) ){
    foreach ( get_option('liquid_scrips') as $key => $name){
        $js_options[] = array(
            'id'       => 'lqd-script-' . $key,
            'type'     => 'button_set',
            'title'    => $name,
            'options' => array(
                'enq' => esc_html__( 'Load', 'hub' ),
                'default' => esc_html__( 'Default', 'hub' ),
                'deq' => esc_html__( 'Remove', 'hub' ),
             ), 
            'default' => 'default',
            'required' => array(
                'manage_liquid_scripts',
                '=',
                'on'
            ),
        );
    }
}

$js_options[] =  array(
    'id' => 'jquery_rearrange',
    'type'     => 'button_set',
    'title'    => esc_html__( 'Load jQuery in Footer', 'hub' ),
    'subtitle' => wp_kses_post( 'Load all jQuery libraries in the footer. This can reduce the boot time of your site but may prevent some 3rd party plugins from working.', 'hub' ),
    'options'  => array(
        'on'   => esc_html__( 'Yes', 'hub' ),
        'off'  => esc_html__( 'No', 'hub' ),
    ),
    'default' => 'off'
);

$js_options[] =  array(
    'id' => 'disable_carousel_on_mobile',
    'type'     => 'button_set',
    'title'    => esc_html__( 'Disable Carousel on Mobile', 'hub' ),
    'subtitle' => wp_kses_post( 'Disable JavaScript carousel functionality on mobile. But still carousels will be draggable.', 'hub' ),
    'options'  => array(
        'on'   => esc_html__( 'Yes', 'hub' ),
        'off'  => esc_html__( 'No', 'hub' ),
    ),
    'default' => 'off'
);

$js_options[] =  array(
    'id' => 'disable_liquid_animations_on_mobile',
    'type'     => 'button_set',
    'title'    => esc_html__( 'Disable Liquid Animations on Mobile', 'hub' ),
    'subtitle' => wp_kses_post( 'Disable Custom Aimations for better performance and page scores for mobile.', 'hub' ),
    'options'  => array(
        'on'   => esc_html__( 'Yes', 'hub' ),
        'off'  => esc_html__( 'No', 'hub' ),
    ),
    'default' => 'off'
);

$js_options[] = array(
    'id'         => 'menage_liquid_custom_scripts',
    'type'       => 'repeater',
    'title'      => __( 'Manage Custom Scripts', 'hub' ),
    'subtitle'   => __( 'Add queue or dequeue custom scripts', 'hub' ),
    'sortable' => true,
    'group_values' => true,
    'bind_title' => 'handle',
    'fields'     => array(
        array(
            'id'          => 'action',
            'type'        => 'select',
            'title'       => __( 'Choose Action', 'hub' ),
            'options'     => array(
                'deq'     => __( 'Dequeue Script', 'hub' ),
                'enq'     => __( 'Enqueue Script', 'hub' ),
            ),
            'default'     => 'deq',
        ),
        array(
            'id'          => 'handle',
            'type'        => 'text',
            'title'       => __( 'Handle Name', 'hub' ),
            'placeholder' => __( 'my-custom-script', 'hub' ),
        ),
    )
);

$this->sections[] = array(
    'title'  => esc_html__( 'JS', 'hub' ),
    'subsection' => true, 
    'fields' => $js_options
);

// Fonts & Icons
$this->sections[] = array(
    'title'  => esc_html__( 'Fonts & Icon', 'hub' ),
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'google_font_display',
            'type'     => 'select',
            'multi'    => false,
            'title'    => __('Google Fonts Load', 'hub'), 
            'subtitle' => __('Font-display property defines how font files are loaded and displayed by the browser. Set the way Google Fonts are being loaded by selecting the font-display property (Default: Auto).', 'hub'),
            'options'  => array(
                'auto' => __('Auto - Default', 'hub'),
                'block' => __('Block', 'hub'),
                'swap' => __('Swap', 'hub'),
                'fallback' => __('Fallback', 'hub'),
                'optional' => __('Optional', 'hub'),
            ),
            'default' => 'swap',
        ),
        array(
            'id' => 'load_fontawesome',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Font Awesome v4', 'hub' ),
            'subtitle' => esc_html__( 'Load Font Awesome Icon Library', 'hub' ),
            'options'  => array(
                'on'   => esc_html__( 'Load', 'hub' ),
                'off'  => esc_html__( 'Don\'t load', 'hub' ),
            )
        ),
        array(
            'id' => 'load_fontawesome_v5',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Font Awesome v5', 'hub' ),
            'subtitle' => esc_html__( 'Load Font Awesome Icon Library (v5.15.4)', 'hub' ),
            'options'  => array(
                'on'   => esc_html__( 'Load', 'hub' ),
                'off'  => esc_html__( 'Don\'t load', 'hub' ),
            )
        ),
        array(
            'id' => 'preload_liquid_icons',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Request Preload for Liquid Icons', 'hub' ),
            'subtitle' => esc_html__( 'Preload is a way of telling the browser to request a resource before the browser feels the needs of it. If you get a lqd-essentials.woff2 on Google PageSpeed, enable it.', 'hub' ),
            'options'  => array(
                'on'   => esc_html__( 'Yes', 'hub' ),
                'off'  => esc_html__( 'No', 'hub' ),
            ),
            'default' => 'on'
        ),
        array(
            'id'       => 'custom_fonts_display',
            'type'     => 'select',
            'multi'    => false,
            'title'    => __('Custom Fonts Load', 'hub'), 
            'subtitle' => __('Font-display property defines how font files are loaded and displayed by the browser. Set the way Font Icons are being loaded by selecting the font-display property (Default: Auto).', 'hub'),
            'options'  => array(
                'auto' => __('Auto - Default', 'hub'),
                'block' => __('Block', 'hub'),
                'swap' => __('Swap', 'hub'),
                'fallback' => __('Fallback', 'hub'),
                'optional' => __('Optional', 'hub'),
            ),
            'default' => 'swap',
        ),
        array(
            'id' => 'preload_liquid_custom_fonts',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Request Preload for Custom Fonts', 'hub' ),
            'subtitle' => esc_html__( 'Preload is a way of telling the browser to request a resource before the browser feels the needs of it. If you get a "yours custom font" on Google PageSpeed, enable it.', 'hub' ),
            'options'  => array(
                'on'   => esc_html__( 'Yes', 'hub' ),
                'off'  => esc_html__( 'No', 'hub' ),
            ),
            'default' => 'on'
        )
    )
);

// Lazy Load
$this->sections[] = array(
    'title'  => esc_html__( 'Lazy Load', 'hub' ),
    'subsection' => true,
    'fields' => array(
        array(
			'id'       => 'enable-lazy-load',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Lazy Load', 'hub' ),
			'subtitle' => esc_html__( 'Lazy load enables images to load only when they are in the viewport. Therefore, lazy load boosts the performance.', 'hub' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'hub' ),
				'off'  => esc_html__( 'Off', 'hub' ),
			),
			'default' => 'on'
		),
        array(
			'id'       => 'lazy_load_offset',
			'type'     => 'slider',
			'title'    => esc_html__( 'Offset', 'hub' ),
			'subtitle' => esc_html__( 'Lazy Load vertical offset', 'hub' ),
			'default'  => 500,
			'max'      => 1000,
			'required' => array(
				'enable-lazy-load',
				'=',
				'on'
			),
		),
        array(
			'id'       => 'lazy_load_nth',
			'type'     => 'slider',
			'title'    => esc_html__( 'Lazy Load from nth image', 'hub' ),
			'subtitle' => esc_html__( 'Don\'t Lazy Load the first X image. When you set 1, the lazy load will apply all images', 'hub' ),
			'default'  => 2,
			'min'      => 1,
			'max'      => 10,
			'required' => array(
				'enable-lazy-load',
				'=',
				'on'
			),
		),
        array(
		    'id'       => 'lazy_load_exclude',
		    'type'     => 'textarea',
		    'title'    => esc_html__( 'Exclude custom images', 'hub'),
		    'subtitle' => esc_html__( 'Enter the image url for each line you want to disable lazy load', 'hub' ),
            'required' => array(
				'enable-lazy-load',
				'=',
				'on'
			),
		)
    )
);

// Plugins

$plugins_options = array(
    array(
        'id' => 'disable_wp_emojis',
        'type'     => 'button_set',
        'title'    => esc_html__( 'WP Emojis', 'hub' ),
        'subtitle' => wp_kses_post( 'Just disable this. Who in this world uses Wordpress emojis? :-) Ugh', 'hub' ),
        'options'  => array(
            'on'   => esc_html__( 'Load', 'hub' ),
            'off'  => esc_html__( 'Don\'t load', 'hub' ),
        ),
        'default' => 'on'
    ),
);

if ( defined( 'WPCF7_PLUGIN' ) ) {
    $plugins_options[] =  array(
        'id' => 'disable_cf7_js',
        'type'     => 'button_set',
        'title'    => esc_html__( 'Contact Form 7 JS', 'hub' ),
        'subtitle' => wp_kses_post( 'Disabling this can prevent AJAX form validation and AJAX form submits.', 'hub' ),
        'options'  => array(
            'on'   => esc_html__( 'Load', 'hub' ),
            'off'  => esc_html__( 'Don\'t load', 'hub' ),
        ),
        'default' => 'on'
    );

    $plugins_options[] =  array(
        'id' => 'disable_cf7_css',
        'type'     => 'button_set',
        'title'    => esc_html__( 'Contact Form 7 CSS', 'hub' ),
        'subtitle' => wp_kses_post( 'Contact Form 7 default styles.', 'hub' ),
        'options'  => array(
            'on'   => esc_html__( 'Load', 'hub' ),
            'off'  => esc_html__( 'Don\'t load', 'hub' ),
        ),
        'default' => 'on'
    );
}
if ( class_exists( 'WooCommerce' ) ) {
    $plugins_options[] =  array(
        'id' => 'disable_wc_cart_fragments',
        'type'     => 'button_set',
        'title'    => esc_html__( 'Woocommerce Cart Fragments JS', 'hub' ),
        'subtitle' => wp_kses_post( 'This controls updating cart usinig AJAX without refreshing page.', 'hub' ),
        'options'  => array(
            'on'   => esc_html__( 'Load', 'hub' ),
            'off'  => esc_html__( 'Don\'t load', 'hub' ),
        ),
        'default' => 'on'
    );
}

if ( defined('ELEMENTOR_VERSION') ){
    $plugins_options[] = array(
        'id'       => 'elementor_animations_css',
        'type'     => 'button_set',
        'title'    => esc_html__( 'Elementor animations CSS file', 'hub' ),
        'subtitle' => wp_kses_post( 'Disable this if you don\'t use Elementor  animations. This won\'t affect Liquid Custom Animations.', 'hub' ),
        'options'  => array(
            'on'   => esc_html__( 'Load', 'hub' ),
            'off'  => esc_html__( 'Don\'t load', 'hub' ),
        ),
        'default' => 'on'
    );

    $plugins_options[] = array(
        'id'       => 'elementor_icons_css',
        'type'     => 'button_set',
        'title'    => esc_html__( 'Elementor icons CSS file', 'hub' ),
        'subtitle' => wp_kses_post( 'Control whether you want to load Elementor "eicons" or not. ', 'hub' ),
        'options'  => array(
            'on'   => esc_html__( 'Load', 'hub' ),
            'off'  => esc_html__( 'Don\'t load', 'hub' ),
        ),
        'default' => 'on'
    );

    $plugins_options[] = array(
        'id'       => 'elementor_dialog_js',
        'type'     => 'button_set',
        'title'    => esc_html__( 'Elementor dialog.js library', 'hub' ),
        'subtitle' => wp_kses_post( 'If you don\'t use Elementor popups, disable this JavaScript file. ', 'hub' ),
        'options'  => array(
            'on'   => esc_html__( 'Load', 'hub' ),
            'off'  => esc_html__( 'Don\'t load', 'hub' ),
        ),
        'default' => 'on'
    );

    $plugins_options[] =  array(
        'id'       => 'elementor_frontend_js',
        'type'     => 'button_set',
        'title'    => esc_html__( 'Elementor frontend.js', 'hub' ),
        'subtitle' => wp_kses_post( 'This file controls some features like background slideshow, kenburns, elementor carousels, video background etc. Disabling this may break some Elementor featues.', 'hub' ),
        'options'  => array(
            'on'   => esc_html__( 'Load', 'hub' ),
            'off'  => esc_html__( 'Don\'t load', 'hub' ),
        ),
        'default' => 'on'
    );
}



$this->sections[] = array(
    'title'  => esc_html__( 'Plugins', 'hub' ),
    'subsection' => true,
    'fields' => $plugins_options
);