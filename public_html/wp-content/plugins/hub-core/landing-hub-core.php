<?php
/*
Plugin Name: Hub Core
Plugin URI: https://hub.liquid-themes.com/
Description: Intelligent and Powerful Elements Plugin, exclusively for Hub WordPress Theme.
Version: 4.1
Author: Liquid Themes
Author URI: https://themeforest.net/user/liquidthemes
Text Domain: landinghub-core
*/

//Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'LD_ADDONS_PATH', plugin_dir_path( __FILE__ ) );
define( 'LD_ADDONS_URL', plugin_dir_url( __FILE__ ) );
define( 'ENVATO_HOSTED_SITE', true );
define( 'LD_ADDONS_VERSION', get_file_data( __FILE__, array('Version' => 'Version'), false)['Version']);

include_once LD_ADDONS_PATH . 'extras/redux-framework/redux-framework.php';
include_once LD_ADDONS_PATH . 'includes/liquid-base.php';

class Liquid_Addons extends Liquid_Base {

	/**
	 * Hold an instance of Liquid_Addons class.
	 * @var Liquid_Addons
	 */
	protected static $instance = null;

	/**
	 * [$params description]
	 * @var array
	 */
	public $params = array();

	/**
	 * Main Liquid_Addons instance.
	 *
	 * @return Liquid_Addons - Main instance.
	 */
	public static function instance() {

		if ( null == self::$instance ) {
			self::$instance = new Liquid_Addons();
		}

		return self::$instance;
	}

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		spl_autoload_register( array( $this, 'auto_load' ) );
		$this->includes();
		$this->add_action( 'plugins_loaded', 'load_plugin_textdomain' );
		$this->add_action( 'admin_init', 'libs_init', 10, 1 );
		$this->add_action( 'admin_init', 'liquid_update_theme' );
		$this->add_action( 'admin_init', 'multiple_post_thumbnail' );
		$this->add_action( 'redux/extensions/before', 'load_redux_extensions', 0 );
		// If Redux is running as a plugin, this will remove the demo notice and links
		$this->add_action( 'redux/loaded', 'remove_demo' );
		$this->add_action( 'liquid_init', 'init_hooks' );
		$this->add_action( 'admin_notices', 'activate_theme_notice' );
		$this->add_filter( 'wp_kses_allowed_html', 'wp_kses_allowed_html', 10, 2 );
		$this->add_filter( 'tuc_request_update_query_args-One', 'autoupdate_verify' );

		$this->add_filter( 'vc_add_element_categories', 'vc_woo_custom_layuts_elements_tabs', 15 );
		$this->add_filter( 'vc_add_element_categories', 'vc_pf_single_post_elements_tabs', 25 );

	}
	
	/**
	 * Remove the demo link and the notice of integrated demo from the redux-framework plugin
	 * @method remove_demo
	 * @return [type]      [description]
	 */
	function remove_demo() {

		if ( class_exists( 'ReduxFrameworkPlugin' ) ) {

			remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::instance(), 'plugin_metalinks' ), null, 2);
			remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
		}
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'landinghub-core', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	/**
	 * [Auto load libraries]
	 * @method auto_load
	 *
	 * @param $class
	 *
	 * @return type
	 * @since    1.0.0
	 */
	public function auto_load( $class ) {
		if ( strpos( $class, 'Liquid' ) !== false ) {
			$class_dir  = LD_ADDONS_PATH . 'libs' . DIRECTORY_SEPARATOR . 'core-importer' . DIRECTORY_SEPARATOR;
			$class_dir_ = LD_ADDONS_PATH . 'libs' . DIRECTORY_SEPARATOR . 'liquid-api' . DIRECTORY_SEPARATOR;
			$class_name = str_replace( '_', DIRECTORY_SEPARATOR, $class ) . '.php';
			if ( file_exists( $class_dir . $class_name ) ) {
				require_once $class_dir . $class_name;
			}
			if ( file_exists( $class_dir_ . $class_name ) ) {
				require_once $class_dir_ . $class_name;
			}
		}
	}

	public function multiple_post_thumbnail() {
		//Add Multi Featured Image
		include_once $this->plugin_dir() . 'extensions/multiple-post-thumbnails/multiple-post-thumbnails.php';
	}

	/**
	 * [includes description]
	 * @method includes
	 *
	 * @return [type]   [description]
	 */
	public function includes() {

		include_once $this->plugin_dir() . 'includes/liquid-helpers.php';
		include_once $this->plugin_dir() . 'extensions/extensions.init.php';
		include_once $this->plugin_dir() . 'libs/updater/plugin-update-checker.php';
		include_once $this->plugin_dir() . 'extras/mailchimp/mailchimp.php';

		//Load extensions
		// Redux use any font
		include_once $this->plugin_dir() . 'extensions/redux-custom-fonts/redux-use-any-font.php';
		include_once $this->plugin_dir() . 'extensions/redux-custom-fonts/redux-custom-fonts.php';

		//Custom icons by user
		include_once $this->plugin_dir() . 'extensions/redux-custom-icons/redux-custom-icons.php';

	}

	/**
	 * Init redux framework
	 * @method redux_init
	 */
	public function redux_init() {

		$this->add_action( 'redux/extensions/before', 'load_redux_extensions', 0 );
		$this->add_action( 'redux/liquid_one_opt/field/class/typography', 'register_typography' );
		$this->add_action( 'redux/liquid_one_opt/field/class/liquid_colorpicker', 'register_liquid_colorpicker' );
		$this->add_action( 'redux/liquid_one_opt/field/class/liquid_link_color', 'register_liquid_link_color' );
		$this->add_action( 'redux/liquid_one_opt/field/class/color_rgba', 'register_color_rgba' );
		$this->add_action( 'redux/liquid_one_opt/field/class/iconpicker', 'register_iconpicker' );

        $theme_option = get_option('liquid_one_opt');
		if ( isset($theme_option['enable-hub-optimization']) && $theme_option['enable-hub-optimization'] === 'on' &&
		     ( ! isset( $_GET['preview'] ) || $_GET['preview'] !== 'true' ) ) {
			if ( is_admin() || ( function_exists( 'vc_is_inline' ) && vc_is_inline() ) ) {
				new Liquid_Meta_Boxes;
			}
		} else {
			new Liquid_Meta_Boxes;
		}

		new Liquid_Theme_Options;

		new Liquid_Dynamic_CSS;
		if ( class_exists( 'Liquid_Responsive_CSS' ) ) {
			new Liquid_Responsive_CSS;
		}

	}

	/**
	 * [load_redux_extensions description]
	 * @method load_redux_extensions
	 * @return [type]                [description]
	 */
	public function load_redux_extensions( $redux ) {

		$path = $this->plugin_dir() . 'extensions/';
		$exts = array( 'metaboxes', 'repeater' );

		foreach ( $exts as $ext ) {

			$extension_class = 'ReduxFramework_extension_' . $ext;
			$class_file      = $path . 'redux-' . $ext . '/extension_' . $ext . '.php';
			$class_file      = apply_filters( 'redux/extension/' . $redux->args['opt_name'] . '/' . $ext, $class_file );

			if ( ! class_exists( $extension_class ) && $class_file ) {
				require_once( $class_file );
				$extension = new $extension_class( $redux );
			}
		}
	}

	/**
	 * [register_gradient description]
	 * @method register_gradient
	 * @return [type]              [description]
	 */
	public function register_iconpicker() {
		return $this->plugin_dir() . 'extensions/redux-iconpicker/field_iconpicker.php';
	}

	/**
	 * [register_liquid_link_color description]
	 * @method register_liquid_link_color
	 * @return [type]              [description]
	 */
	public function register_liquid_link_color() {
		return $this->plugin_dir() . 'extensions/redux-liquid-link-color/field_liquid_link_color.php';
	}

	/**
	 * [register_liquid_colorpicker description]
	 * @method register_liquid_colorpicker
	 * @return [type]              [description]
	 */
	public function register_liquid_colorpicker() {
		return $this->plugin_dir() . 'extensions/redux-liquid-colorpicker/field_liquid_colorpicker.php';
	}

	/**
	 * [register_typography description]
	 * @method register_typography
	 * @return [type]              [description]
	 */
	public function register_typography() {
		return $this->plugin_dir() . 'extensions/redux-typography/field_typography.php';
	}

	/**
	 * [register_color_rgba description]
	 * @method register_color_rgba
	 * @return [type]              [description]
	 */
	public function register_color_rgba() {
		return $this->plugin_dir() . 'extensions/redux-color-rgba/field_color_rgba.php';
	}


	public function liquid_update_theme() {

		if ( defined( 'ENVATO_HOSTED_SITE' ) ) {
			return;
		}
		Puc_v4_Factory::buildUpdateChecker( 'http://api.liquidthemes.com/products/One/update.php', get_template_directory(), get_template() );

	}

	/**
	 * [init_hooks description]
	 * @method init_hooks
	 *
	 * @return [type]     [description]
	 */
	public function init_hooks() {

		$this->assets_css     = plugins_url( '/assets/css', __FILE__ );
		$this->assets_vendors = plugins_url( '/assets/vendors', __FILE__ );
		$this->assets_js      = plugins_url( '/assets/js', __FILE__ );

		include_once $this->plugin_dir() . 'extras/liquid-extras.php';
		include_once $this->plugin_dir() . 'includes/params/liquid-default-params.php';
		include_once $this->plugin_dir() . 'includes/params/terms/liquid-category-color.php';

		if ( class_exists( 'WPBakeryShortCode' ) ) {
			include_once $this->plugin_dir() . 'includes/liquid-shortcode.php';

			include_once $this->plugin_dir() . 'includes/params/liquid-extra-params.php';

			include_once $this->plugin_dir() . 'includes/params/liquid-icon-params.php';
			include_once $this->plugin_dir() . 'includes/params/liquid-font-params.php';
			include_once $this->plugin_dir() . 'includes/params/liquid-header-params.php';
		}

		$this->add_action( 'admin_print_scripts-post.php', 'enqueue', 99 );
		$this->add_action( 'admin_print_scripts-post-new.php', 'enqueue', 99 );
		$this->add_action( 'admin_print_scripts-widgets.php', 'enqueue_widgets', 99 );

		$this->add_action( 'vc_load_default_params', 'reload_vc_js' );
		$this->add_action( 'vc_load_iframe_jscss', 'vc_frontend_jscss' );
		$this->add_action( 'init', 'load_post_types', 1 );

        $theme_option = get_option('liquid_one_opt');
        if ( isset($theme_option['enable-hub-optimization']) && $theme_option['enable-hub-optimization'] === 'on' &&
		     ( ! isset( $_GET['preview'] ) || $_GET['preview'] !== 'true' ) ) {
			if ( is_admin() || ( function_exists( 'vc_is_inline' ) && vc_is_inline() ) ) {
				$this->add_action( 'init', 'init', 25 );
			} else {
				$this->add_action( 'wp', 'init', 25 );
			}
		} else {
			$this->add_action( 'init', 'init', 25 );
		}

		$this->add_action( 'init', 'redux_init' );
		$this->add_action( 'widgets_init', 'load_widgets', 25 );

		if ( class_exists( 'Vc_Manager' ) && class_exists( 'WPBakeryShortCode' ) ) {
			$this->add_action( 'admin_enqueue_scripts', 'vc_liquid_css' );
		}
		$this->add_action( 'admin_enqueue_scripts', 'redux_liquid_css', 999 );
		$this->add_action( 'wp_enqueue_scripts', 'plugin_css', 99 );

	}

	public function activate_theme_notice() {

		if ( did_action( 'liquid_init' ) > 0 ) {
			return;
		}
		?>
        <div class="updated not-h2">
            <p>
                <strong><?php esc_html_e( 'Please activate the Hub WordPress Theme to use Hub Core plugin.', 'landinghub-core' ); ?></strong>
            </p>
			<?php
			$screen = get_current_screen();
			if ( $screen->base != 'themes' ):
				?>
                <p>
                    <a href="<?php echo esc_url( admin_url( 'themes.php' ) ); ?>"><?php esc_html_e( 'Activate theme', 'landinghub-core' ); ?></a>
                </p>
			<?php endif; ?>
        </div>
		<?php
	}

	/**
	 * [init description]
	 * @method init
	 *
	 * @return [type] [description]
	 */
	public function init() {
		if ( class_exists( 'Vc_Manager' ) && class_exists( 'WPBakeryShortCode' ) ) {
			$this->init_vc();
			$this->vc_integration();
			$this->load_shortcodes();
			$this->vc_liquid_templates();
		}
	}

	/**
	 * [Load plugin libraries]
	 * @method libs_init
	 *
	 * @return type
	 * @since    1.0.0
	 */
	public function libs_init() {
		global $LiquidCore;//to do rename the libs core class
		$LiquidCore                            = new LiquidCore();
		$LiquidCore['path']                    = LD_ADDONS_PATH;
		$LiquidCore['url']                     = LD_ADDONS_URL;
		$LiquidCore['version']                 = '1.0';
		$LiquidCore['LiquidRedirect']          = new LiquidRedirect();
		$LiquidCore['LiquidEnvato']            = new LiquidEnvato();
		$LiquidCore['LiquidCheck']             = new LiquidCheck();
		$LiquidCore['LiquidNotices']           = new LiquidNotices();
		$LiquidCore['LiquidLog']               = new LiquidLog();
		$LiquidCore['LiquidDownload']          = new LiquidDownload( $LiquidCore );
		$LiquidCore['LiquidReset']             = new LiquidReset( $LiquidCore );
		$LiquidCore['LiquidThemeDemoImporter'] = new LiquidThemeDemoImporter( $LiquidCore );
		apply_filters( 'liquid/config', $LiquidCore );

		return $LiquidCore->run();
	}

	/**
	 * [Accsess the libs core class]
	 * @method liquid_libs_core
	 *
	 * @return object|null
	 * @since    1.0.0
	 */
	public function liquid_libs_core( $class = '' ) {
		global $LiquidCore;
		if ( isset( $class ) ) {
			return $LiquidCore;
		} else {
			if ( is_object( $LiquidCore[ $class ] ) ) {
				return $LiquidCore[ $class ];
			}
		}
	}

	/**
	 * [Show login notice for users]
	 * @method liquid_login_notice
	 *
	 * @return object|null
	 * @since    1.0.0
	 */
	public function liquid_login_notice() {
		$LiquidCore = $this->liquid_libs_core();
		if ( $LiquidCore['LiquidCheck']->logged_in_mail() === null && ! isset( $_GET['refresh'] ) && $LiquidCore['LiquidNotices']->get_cookie_timer() != 1 ) {
			$message = sprintf( wp_kses_post( __( '<a href="%s">Log in</a> with your Envato account to take full advantage of <strong>One theme</strong>', 'landinghub-core' ) ), $LiquidCore['LiquidEnvato']->login_url() );
			$LiquidCore['LiquidNotices']->admin_notice( $message, array(
				'type'        => 'info',
				'classes'     => 'liquid-login-notice',
				'dismissTime' => 'liquid_dissmiss_timer'
			) );
		} elseif ( ! $LiquidCore['LiquidCheck']->is_vaild() && ! isset( $_GET['refresh'] ) ) {
			$message = sprintf( wp_kses_post( __( 'We couldn\'t find <strong>One theme</strong> with the logged in account <a href="%s">Log in with different account</a>', 'landinghub-core' ) ), $LiquidCore['LiquidEnvato']->login_url() );
			$LiquidCore['LiquidNotices']->admin_notice( $message, array(
				'type'        => 'error',
				'classes'     => 'liquid-login-notice liquid-not-vaild',
				'dismissTime' => 'liquid_dissmiss_timer'
			) );
		}
	}

	public function autoupdate_verify( $query_args ) {
		$LiquidCore   = $this->liquid_libs_core();
		$liquid_token = $LiquidCore['LiquidCheck']->get_token();
		if ( isset( $liquid_token ) && $liquid_token != '' ) {
			$query_args['token'] = $liquid_token;
		} else {
			$query_args['token'] = '';
		}

		return $query_args;
	}

	/**
	 * Load vc scripts
	 */
	public function enqueue() {

		//Load jquery UI css. Removed due to issue with redux styling issues in pages meta 
		// wp_enqueue_style( 'jquery-ui', $this->assets_css . '/jquery-ui.min.css' );
		// wp_enqueue_style( 'jquery-ui-structure', $this->assets_css . '/jquery-ui.structure.min.css' );
		// wp_enqueue_style( 'jquery-ui-theme', $this->assets_css . '/jquery-ui.theme.min.css' );

		//Animated icon font
		wp_enqueue_style( 'liquid-animated-icons', $this->assets_vendors . '/animated-icons/style.css' );

		wp_enqueue_style( 'ld-colorpicker', $this->assets_css . '/liquid-colorpicker.css' );
		wp_enqueue_script( 'liquid-grapick', $this->assets_vendors . '/grapick/grapick.min.js', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'liquid-colorpicker', $this->assets_js . '/plugin.liquidColorPicker.min.js', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'ld-vc-script', $this->assets_js . '/vc-script.js', array( 'jquery' ), '1.0.0', true );

		if ( function_exists( 'vc_mode' ) && 'admin_frontend_editor' === vc_mode() ) {
			wp_enqueue_script( 'ld-vc-frontend-script', $this->assets_js . '/vc-script-frontend.js', array(
				'jquery',
				'ld-vc-script'
			), '1.0.0', true );
			wp_enqueue_style( 'lqd-admin-frontend', $this->assets_css . '/liquid-vc.min.css' );
		}

	}

	/**
	 * Loand vc scripts
	 */
	public function vc_frontend_jscss() {
		wp_enqueue_style( 'ld-vc-frontend', $this->assets_css . '/vc-frontend-style.min.css' );
	}

	public function vc_liquid_css() {
		wp_enqueue_style( 'lqd-admin', $this->assets_css . '/liquid-vc.min.css', array( 'js_composer' ) );
		if ( is_rtl() ) {
			wp_enqueue_style( 'lqd-admin-rtl', $this->assets_css . '/liquid-vc-rtl.min.css', array( 'lqd-admin' ) );
		}
	}

	public function redux_liquid_css() {
		wp_enqueue_style( 'lqd-redux', $this->assets_css . '/liquid-redux.min.css', array() );
		if ( is_rtl() ) {
			wp_enqueue_style( 'lqd-redux-rtl', $this->assets_css . '/liquid-redux-rtl.min.css', array() );
		}
	}

	public function plugin_css() {
		if ( ! class_exists( 'Liquid_Elementor_Addons' ) && ! defined('ELEMENTOR_VERSION') ){
			wp_enqueue_style( 'landinghub-core', $this->assets_css . '/landinghub-core.min.css', array() );
		}
	}


	/**
	 * [load_post_types description]
	 * @method load_post_types
	 *
	 * @return [type]          [description]
	 */
	public function load_post_types() {
		require_if_theme_supports( 'liquid-header', $this->plugin_dir() . 'post-types/liquid-header.php' );
		require_if_theme_supports( 'liquid-footer', $this->plugin_dir() . 'post-types/liquid-footer.php' );
		require_if_theme_supports( 'liquid-mega-menu', $this->plugin_dir() . 'post-types/liquid-mega-menu.php' );
		require_if_theme_supports( 'liquid-product-layout', $this->plugin_dir() . 'post-types/liquid-product-layout.php' );
		require_if_theme_supports( 'liquid-product-sizeguide', $this->plugin_dir() . 'post-types/liquid-product-size-guide.php' );
		require_if_theme_supports( 'liquid-sticky-atc', $this->plugin_dir() . 'post-types/liquid-product-sticky-atc.php' );
	}

	/**
	 * [vc_liquid_templates description]
	 * @method vc_liquid_templates
	 *
	 * @return [type]  [description]
	 */
	public function vc_liquid_templates() {

		$liquid_templates = new Liquid_Vc_Templates_Panel_Editor();

		return $liquid_templates->init();

	}

	/**
	 * [init_vc description]
	 * @method init_vc
	 *
	 * @return [type]  [description]
	 */
	public function init_vc() {

		global $vc_manager;
		$vc_manager->setIsAsTheme();
		$vc_manager->disableUpdater();

		$list = array(
			'page',
			'post',
			'product',
			'liquid-header',
			'liquid-footer',
			'liquid-mega-menu',
			'liquid-portfolio',
			'ld-product-layout'
		);
		$vc_manager->setEditorDefaultPostTypes( $list );

		//disable VC update notifications
		if ( is_admin() ) {

			if ( ! isset( $_COOKIE['vchideactivationmsg'] ) ) {
				setcookie( 'vchideactivationmsg', '1', strtotime( '+3 years' ), '/' );
			}

			if ( ! isset( $_COOKIE['vchideactivationmsg_vc11'] ) ) {
				setcookie( 'vchideactivationmsg_vc11', ( defined( 'WPB_VC_VERSION' ) ? WPB_VC_VERSION : '1' ), strtotime( '+3 years' ), '/' );
			}
		}

		include_once $this->plugin_dir() . 'includes/params/liquid-gradient-param.php';
		include_once $this->plugin_dir() . 'includes/params/liquid-colorpicker-param.php';
		include_once $this->plugin_dir() . 'includes/params/liquid-select-image-param.php';
		include_once $this->plugin_dir() . 'includes/params/liquid-slider-param.php';
		include_once $this->plugin_dir() . 'includes/params/liquid-subheading-param.php';
		include_once $this->plugin_dir() . 'includes/params/liquid-responsive-param.php';
		include_once $this->plugin_dir() . 'includes/params/liquid-responsive-css-editor.php';
		include_once $this->plugin_dir() . 'includes/params/liquid-responsive-margin-param.php';
		include_once $this->plugin_dir() . 'includes/params/liquid-responsive-alignment-param.php';
		include_once $this->plugin_dir() . 'includes/params/liquid-responsive-textfield-param.php';
		include_once $this->plugin_dir() . 'includes/params/liquid-responsive-columns-param.php';
		include_once $this->plugin_dir() . 'includes/params/liquid-responsive-hide-param.php';
		include_once $this->plugin_dir() . 'includes/params/shape-divider-param/liquid-shape-divider-param.php';
		include_once $this->plugin_dir() . 'includes/params/liquid-attach-image-param.php';
		include_once $this->plugin_dir() . 'includes/params/liquid-checkbox-param.php';
		include_once $this->plugin_dir() . 'includes/params/liquid-button-set-param.php';
		include_once $this->plugin_dir() . 'includes/params/liquid-multiple-dropdown-param.php';

		// Set new theme directory
		$dir = get_stylesheet_directory() . '/templates/vc';
		if ( ! is_dir( $dir ) ) {
			$dir = get_template_directory() . '/templates/vc';
		}
		vc_set_shortcodes_templates_dir( $dir );
	}

	/**
	 * [vc_integration description]
	 * @method vc_integration
	 *
	 * @return [type]         [description]
	 */
	public function vc_integration() {

	}

	/**
	 * [load_shortcodes description]
	 * @method load_shortcodes
	 *
	 * @return [type]          [description]
	 */
	public function load_shortcodes() {

		//List of shortcodes in APLHABETICAL ORDER!!!!
		$shortcodes = array(
			'accordion',
			'animated-frames-container',
			'animated-frame',
			'asymmetric-slider',
			'blog',
			'banner',
			'1button',
			'carousel-tab',
			'carousel-marquee-tab',
			'carousel-falcate',
			'carousel-stack',
			'carousel-gallery',
			'counter',
			'countdown',
			'content-box',
			'contact-form',
			'custom-menu',
			'icon-box',
			'd-banner',
			'd-depth-banner',
			'distorse-gallery',
			'image-text-slider',
			'bananas',
			'testimonial',
			'testi-carousel',
			'price-table',
			'process-box-container',
			'process-box',
			'team-members-circular',
			'team-member',
			'tabs',
			'tooltip-image',
			'typewriter',
			'particles',
			'progressbar',
			'promo',
			'misc',
			'modal-window',
			//'section-title',
			'social-icons',
			'shop-banner',
			'simple-heading',
			'simple-menu',
			'spacer',
			'slideshow',
			'slideshow-2',
			'images-group-container',
			'images-group-element',
			'images-comparison',
			'image-trail',
			'fancy-heading',
			'flipbox',
			'freakin-image',
			'fullproj',
			'gallery',
			'google-map',
			'instagram',
			'tweet',
			'milestone',
			'message',
			'masked-image',
			'newsletter',
			'roadmap',
			'roadmap-item',

			'icon-box-circle',
			'icon-box-circle-item',

			'image-overlay-text',

			'media',
			'media-element',

			'list',

			'pointer-tooltip',

			//'timeline',
			//'timeline-item',
			'header-fullproj',
			'header-trigger',
			'header-iconbox',
			'header-social-icons',
			'header-spacing',
			'header-search',
			'header-woo-search',
			'header-separator',
			'header-sidedrawer',
			'header-dropdown',
			'header-lang-switcher',
			'header-menu',
			'header-scroll-indicator',
			'header-image',
			'header-text',
			'header-button',
			'hotspots',
			//'header-zcollapsed-fullscreen',
			'header-cart',
			'header-custom-menu',

			'woo-products',
			'woo-products-list',
			'woo-product-image',
			'woo-product-title',
			'woo-product-description',
			'woo-product-rating',
			'woo-product-price',
			'woo-product-add-to-cart',
			'woo-product-meta',
			'woo-product-sharing',
			'woo-product-tabs',
			'woo-product-upsell',
			'woo-product-related',
			'woo-product-hooks',

			'pf-single-title',
			'pf-single-cover',
			'pf-single-meta',
			'pf-single-nav',
			'pf-single-related',
		);

        $shortcodes = apply_filters('load_shortcodes', $shortcodes);

		//Add portfolio sc if One Portfolio is enabled
		if ( class_exists( 'Liquid_Portfolio' ) ) {
			array_push( $shortcodes, 'portfolio-listing' );
		};

		// Order Shortcodes
		sort( $shortcodes );

		foreach ( $shortcodes as $shortcode ) {

			$file = $this->plugin_dir() . "shortcodes/{$shortcode}/liquid-{$shortcode}.php";

			if ( file_exists( $file ) ) {
				require_once $file;
			}
		}
	}

	public function vc_woo_custom_layuts_elements_tabs( $tabs ) {

		global $post_type;

		if ( 'ld-product-layout' !== $post_type ) {

			foreach ( $tabs as $key => $tab ) {
				if ( 'Product Layout' === $tab['name'] ) {
					unset( $tabs[ $key ] );
				}
			}

			return $tabs;
		}

		return $tabs;

	}

	public function vc_pf_single_post_elements_tabs( $tabs ) {

		global $post_type;

		if ( 'liquid-portfolio' !== $post_type ) {

			foreach ( $tabs as $key => $tab ) {
				if ( 'Portfolio Components' === $tab['name'] ) {
					unset( $tabs[ $key ] );
				}
			}

			return $tabs;
		}

		return $tabs;

	}

	/**
	 * [load_widgets description]
	 * @method load_widgets
	 *
	 * @return [type]       [description]
	 */
	public function load_widgets() {

		//List of widgets in APLHABETICAL ORDER!!!!
		$widgets = array(
			'Liquid_Newsletter_Widget',
			'Liquid_Trending_Posts_Widget',
			'Liquid_Latest_Posts_Widget',
			'Liquid_Social_Followers_Widget',
			'Liquid_Next_Post_Widget',
		);

		if ( class_exists( 'Woocommerce' ) ) {
			array_push( $widgets, 'Liquid_Woo_Products_Widget' );
		};

		foreach ( $widgets as $widget ) {
			if ( file_exists( $this->plugin_dir() . "widgets/{$widget}.class.php" ) ) {
				require_once( $this->plugin_dir() . "widgets/{$widget}.class.php" );
				register_widget( $widget );
			}
		}
	}

	/**
	 * Load widget scripts
	 */
	public function enqueue_widgets() {
		//wp_enqueue_script( 'rs-widgets',   $this->assets_js . '/widgets.js' ,  array('jquery','select2'), '1.0.0', true );
		wp_enqueue_media();
	}

	/**
	 * Reload JS
	 */
	public function reload_vc_js() {
		//echo '<script type="text/javascript">(function($){ $(document).ready( function(){ $.reloadPlugins(); }); })(jQuery);</script>';
	}

	/**
	 * Plugin activation
	 */
	public static function activate() {
		flush_rewrite_rules();
	}

	/**
	 * Plugin deactivation
	 */
	public static function deactivate() {
		flush_rewrite_rules();
	}

	public function plugin_uri() {
		return plugin_dir_url( __FILE__ );
	}

	public function plugin_dir() {
		return LD_ADDONS_PATH;
	}

	public function wp_kses_allowed_html( $tags, $context ) {

		if ( 'post' !== $context ) {
			return $tags;
		}

		$tags['style'] = array( 'types' => array() );

		return $tags;
	}
}

/**
 * Main instance of Liquid_Theme.
 *
 * Returns the main instance of Liquid_Theme to prevent the need to use globals.
 *
 * @return Liquid_Theme
 */
function liquid_addons() {
	return Liquid_Addons::instance();
}

liquid_addons(); // init i

register_activation_hook( __FILE__, array( 'Liquid_Addons', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Liquid_Addons', 'deactivate' ) );