<?php

namespace IGD;

defined( 'ABSPATH' ) || exit();

class Block {
	/**
	 * @var null
	 */
	protected static $instance = null;

	public function __construct() {
		add_filter( 'block_categories_all', [ $this, 'filter_block_categories' ], 10, 2 );
		add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue_editor_assets' ] );
		add_action( 'init', [ $this, 'register_block' ] );
	}

	public function register_block() {
		if ( igd_fs()->can_use_premium_code__premium_only() ) {
			register_block_type( 'igd/browser', [
				'render_callback' => [ $this, 'render_module_block' ],
			] );
			register_block_type( 'igd/uploader', [
				'render_callback' => [ $this, 'render_module_block' ],
			] );
			register_block_type( 'igd/gallery', [
				'render_callback' => [ $this, 'render_module_block' ],
			] );
			register_block_type( 'igd/media', [
				'render_callback' => [ $this, 'render_module_block' ],
			] );
			register_block_type( 'igd/search', [
				'render_callback' => [ $this, 'render_module_block' ],
			] );
		}

		register_block_type( 'igd/embed', [
			'render_callback' => [ $this, 'render_module_block' ],
		] );
		register_block_type( 'igd/download', [
			'render_callback' => [ $this, 'render_module_block' ],
		] );
		register_block_type( 'igd/view', [
			'render_callback' => [ $this, 'render_module_block' ],
		] );

		register_block_type( 'igd/shortcodes', [
			'render_callback' => [ $this, 'render_module_shortcode_block' ],
		] );
	}

	public function render_module_shortcode_block( $attributes, $content ) {
		$id = ! empty( $attributes['id'] ) ? $attributes['id'] : [];

		return Shortcode::instance()->render_shortcode( [ 'id' => $id ] );
	}

	public function render_module_block( $attributes, $content ) {
		$data = ! empty( $attributes['data'] ) ? $attributes['data'] : [];

		return Shortcode::instance()->render_shortcode( [], $data );
	}

	function filter_block_categories( $block_categories, $editor_context ) {
		if ( ! empty( $editor_context->post ) ) {
			$new_categories = [
				[
					'slug'  => 'igd-category',
					'title' => __( 'Integrate Google Drive', 'integrate-google-drive' ),
					'icon'  => null,
				]
			];

			$block_categories = array_merge( $block_categories, $new_categories );
		}

		return $block_categories;
	}

	function enqueue_editor_assets() {
		wp_enqueue_style( 'igd-block-editor', IGD_URL . '/block/build/editor.css', [], IGD_VERSION );

		wp_enqueue_script( 'igd-blocks', IGD_URL . '/block/build/index.js', array( 'igd-admin', ), IGD_VERSION, true );
		wp_set_script_translations( 'igd-blocks', 'integrate-google-drive', IGD_PATH . '/languages' );
	}

	/**
	 * @return Block|null
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

}

Block::instance();


