<?php

namespace IGD;

defined( 'ABSPATH' ) || exit;

use IGD\Elementor\Browser_Widget;
use IGD\Elementor\Uploader_Widget;
use IGD\Elementor\Gallery_Widget;
use IGD\Elementor\Media_Widget;
use IGD\Elementor\Search_Widget;
use IGD\Elementor\Embed_Widget;
use IGD\Elementor\Download_Widget;
use IGD\Elementor\View_Widget;

use IGD\Elementor\Shortcodes_Widget;

class Elementor {
	/**
	 * @var null
	 */
	protected static $instance = null;

	public function __construct() {
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_categories' ] );
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
		add_action( 'elementor/frontend/before_enqueue_scripts', [ $this, 'frontend_scripts' ] );
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'editor_scripts' ] );

		if ( ! igd_fs()->can_use_premium_code__premium_only() ) {
			add_filter( 'elementor/editor/localize_settings', [ $this, 'promote_pro_elements' ] );
		}
	}

	public function promote_pro_elements( $config ) {
		$promotion_widgets = [];

		if ( isset( $config['promotionWidgets'] ) ) {
			$promotion_widgets = $config['promotionWidgets'];
		}

		$combine_array = array_merge( $promotion_widgets, [
			[
				'name'       => 'igd_browser',
				'title'      => __( 'File Browser', 'integrate-google-drive' ),
				'icon'       => 'igd-browser',
				'categories' => '["integrate_google_drive"]',
			],
			[
				'name'       => 'igd_uploader',
				'title'      => __( 'File Uploader', 'integrate-google-drive' ),
				'icon'       => 'igd-uploader',
				'categories' => '["integrate_google_drive"]',
			],
			[
				'name'       => 'igd_gallery',
				'title'      => __( 'Photo Gallery', 'integrate-google-drive' ),
				'icon'       => 'igd-gallery',
				'categories' => '["integrate_google_drive"]',
			],
			[
				'name'       => 'igd_media',
				'title'      => __( 'Media Player', 'integrate-google-drive' ),
				'icon'       => 'igd-media',
				'categories' => '["integrate_google_drive"]',
			],
			[
				'name'       => 'igd_search',
				'title'      => __( 'Search Box', 'integrate-google-drive' ),
				'icon'       => 'igd-search',
				'categories' => '["integrate_google_drive"]',
			],
		] );

		$config['promotionWidgets'] = $combine_array;

		return $config;
	}

	public function editor_scripts() {
		wp_enqueue_style( 'igd-elementor-editor', IGD_ASSETS . '/css/elementor-editor.css', [], IGD_VERSION );
	}

	public function frontend_scripts() {
		wp_enqueue_style( 'igd-elementor-frontend', IGD_ASSETS . '/css/elementor-frontend.css', [], IGD_VERSION );

		wp_enqueue_script( 'igd-elementor', IGD_ASSETS . '/js/elementor.js', [ 'jquery' ], IGD_VERSION, true );
		Enqueue::instance()->frontend_scripts();
	}

	public function register_widgets( $widgets_manager ) {

		//Pro Widgets
		if ( igd_fs()->can_use_premium_code__premium_only() ) {
			include_once IGD_PATH . '/elementor/class-elementor-browser-widget__premium_only.php';
			include_once IGD_PATH . '/elementor/class-elementor-uploader-widget__premium_only.php';
			include_once IGD_PATH . '/elementor/class-elementor-gallery-widget__premium_only.php';
			include_once IGD_PATH . '/elementor/class-elementor-media-widget__premium_only.php';
			include_once IGD_PATH . '/elementor/class-elementor-search-widget__premium_only.php';


			$widgets_manager->register_widget_type( new Browser_Widget() );
			$widgets_manager->register_widget_type( new Uploader_Widget() );
			$widgets_manager->register_widget_type( new Gallery_Widget() );
			$widgets_manager->register_widget_type( new Media_Widget() );
			$widgets_manager->register_widget_type( new Search_Widget() );
		}

		include_once IGD_PATH . '/elementor/class-elementor-embed-widget.php';
		include_once IGD_PATH . '/elementor/class-elementor-download-widget.php';
		include_once IGD_PATH . '/elementor/class-elementor-view-widget.php';
		include_once IGD_PATH . '/elementor/class-elementor-shortcodes-widget.php';

		$widgets_manager->register_widget_type( new Embed_Widget() );
		$widgets_manager->register_widget_type( new Download_Widget() );
		$widgets_manager->register_widget_type( new View_Widget() );
		$widgets_manager->register_widget_type( new Shortcodes_Widget() );
	}

	public function add_categories( $elements_manager ) {
		$elements_manager->add_category( 'integrate_google_drive', [
				'title' => __( 'Integrate Google Drive', 'integrate-google-drive' ),
				'icon'  => 'fa fa-plug',
			]
		);
	}

	/**
	 * @return Elementor|null
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

}

Elementor::instance();