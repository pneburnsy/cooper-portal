<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Renders navigation bar for Editors.
 */
class Vc_Navbar {
	/**
	 * @var array
	 */
	protected $controls = array(
		'add_element',
		'templates',
		'pages',
		'custom_css',
		'save_backend',
		'preview',
		'frontend'
	);
	/**
	 * @var string
	 */
	protected $brand_url = 'https://liquid-themes.com/?utm_campaign=VCplugin&utm_source=vc_user&utm_medium=backend_editor';
	/**
	 * @var string
	 */
	protected $css_class = 'vc_navbar';
	/**
	 * @var string
	 */
	protected $controls_filter_name = 'vc_nav_controls';
	/**
	 * @var bool|WP_Post
	 */
	protected $post = false;

	/**
	 * @param WP_Post $post
	 */
	public function __construct( WP_Post $post ) {
		$this->post = $post;
	}

	/**
	 * Generate array of controls by iterating property $controls list.
	 * vc_filter: vc_nav_controls - hook to override list of controls
	 * @return array - list of arrays witch contains key name and html output for button.
	 */
	public function getControls() {
		$control_list = array();
		foreach ( $this->controls as $control ) {
			$method = vc_camel_case( 'get_control_' . $control );
			if ( method_exists( $this, $method ) ) {
				$control_list[] = array(
					$control,
					$this->$method(),
				);
			}
		}

		return apply_filters( $this->controls_filter_name, $control_list );
	}

	/**
	 * Get current post.
	 * @return null|WP_Post
	 */
	public function post() {
		if ( $this->post ) {
			return $this->post;
		} else {
			$this->post = get_post();
		}

		return $this->post;
	}

	/**
	 * Render template.
	 */
	public function render() {
		vc_include_template( 'editors/navbar/navbar.tpl.php', array(
			'css_class' => $this->css_class,
			'controls' => $this->getControls(),
			'nav_bar' => $this,
			'post' => $this->post(),
		) );
	}

	/**
	 * vc_filter: vc_nav_front_logo - hook to override WPBakery Page Builder logo
	 * @return string
	 */
	public function getLogo() {
		$output = '<a id="vc_logo" class="vc_navbar-brand" title="' . esc_attr__( 'WPBakery Page Builder', 'js_composer' ) . '" href="' . esc_url( $this->brand_url ) . '" target="_blank">' . esc_attr__( 'WPBakery Page Builder', 'js_composer' ) . '</a>';

		return apply_filters( 'vc_nav_front_logo', $output );
	}

	/**
	 * @return string
	 * @throws \Exception
	 */
	public function getControlCustomCss() {
		if ( ! vc_user_access()->part( 'post_settings' )->can()->get() ) {
			return '';
		}

		return '<li><a id="vc_post-settings-button" href="javascript:;" class="vc_icon-btn vc_post-settings" title="' . esc_attr__( 'Page settings', 'js_composer' ) . '">' . '<span id="vc_post-css-badge" class="vc_badge vc_badge-custom-css" style="display: none;">' . esc_attr__( 'CSS', 'js_composer' ) . '</span><i class="la la-cog"></i></a>' . '</li>';
	}

	/**
	 * @return string
	 * @throws \Exception
	 */
	public function getControlAddElement() {
		if ( vc_user_access()->part( 'shortcodes' )->checkStateAny( true, 'custom', null )
				->get() && vc_user_access_check_shortcode_all( 'vc_row' ) && vc_user_access_check_shortcode_all( 'vc_column' ) ) {
			return '<li>' . '	<a href="javascript:;" class="vc_btn vc_element-button" data-model-id="vc_element" id="vc_add-new-element" title="' . '' . esc_attr__( 'Add new element', 'js_composer' ) . '">' . '    <i class="la la-plus"></i><span>' . esc_html__( 'Add element', 'js_composer' ) . '</span>' . '	</a>' . '</li>';
		}

		return '';
	}

	/**
	 * @return string
	 * @throws \Exception
	 */
	public function getControlTemplates() {
		if ( ! vc_user_access()->part( 'templates' )->can()->get() ) {
			return '';
		}

		return '<li><a href="javascript:;" class="vc_btn vc_templates-button"  id="vc_templates-editor-button" title="' . esc_attr__( 'Templates', 'js_composer' ) . '"><i class="la la-plus"></i><span>' . esc_html__( 'Add Section Template', 'js_composer' ) . '</span>' . '	</a></li>';
	}

	/**
	 * @return string
	 * @throws \Exception
	 */
	public function getControlPages() {
		if ( ! vc_user_access()->part( 'templates' )->can()->get() ) {
			return '';
		}

		return '<li><a href="javascript:;" class="vc_btn vc_pages-button"  id="vc_pages-editor-button" title="' . esc_attr__( 'Inner Pages', 'js_composer' ) . '"><i class="la la-plus"></i><span>' . esc_html__( 'Add Inner Pages', 'js_composer' ) . '</span>' . '	</a></li>';
	}

	/**
	 * @return string
	 * @throws \Exception
	 */
	public function getControlFrontend() {
		if ( ! vc_enabled_frontend() ) {
			return '';
		}

		return '<li style="display: none;">' . '<a href="' . esc_url( vc_frontend_editor()->getInlineUrl() ) . '" class="vc_btn vc_btn-primary vc_btn-sm vc_navbar-btn" id="wpb-edit-inline">' . esc_html__( 'Frontend', 'js_composer' ) . '</a>' . '</li>';
	}

	/**
	 * @return string
	 */
	public function getControlPreview() {
		return '';
	}

	/**
	 * @return string
	 */
	public function getControlSaveBackend() {
		return '<li class="vc_save-backend">' . '<a href="javascript:;" class="vc_btn vc_btn-grey vc_btn-sm vc_navbar-btn vc_control-preview">' . esc_attr__( 'Preview', 'js_composer' ) . '</a>' . '<a class="vc_btn vc_btn-sm vc_navbar-btn vc_btn-primary vc_control-save" id="wpb-save-post">' . esc_attr__( 'Update', 'js_composer' ) . '</a>' . '</li>';
	}
}
