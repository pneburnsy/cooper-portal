<?php
/**
 * Shortcode Header Woo Search
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * LD_Shortcode
 */
class LD_Header_Woo_Search extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug                    = 'ld_header_woo_search';
		$this->title                   = esc_html__( 'Header Product Search', 'landinghub-core' );
		$this->description             = esc_html__( 'Header woo products search form', 'landinghub-core' );
		$this->icon                    = 'la la-search';
		$this->category                = esc_html__( 'Header Modules', 'landinghub-core' );
		$this->show_settings_on_create = false;

		wp_enqueue_script( 'ld-header-woo-search', plugin_dir_url( __FILE__ ) . 'header-woo-search.js', [ 'jquery' ], '1.0.0', true );

		add_action( 'wp_ajax_liquid_wc_get_products_by_input_text', [ $this, 'get_products_by_input_text' ] );
		add_action( 'wp_ajax_nopriv_liquid_wc_get_products_by_input_text', [ $this, 'get_products_by_input_text' ] );

		parent::__construct();
	}

	public function get_params() {

		$this->params = [
			[
				'type'        => 'liquid_button_set',
				'param_name'  => 'enable_ajax',
				'heading'     => esc_html__( 'Enable Ajax', 'landinghub-core' ),
				'description' => esc_html__( 'Enable if you want to show result search under search form.', 'landinghub-core' ),
				'value'       => [
					esc_html__( 'On', 'landinghub-core' )  => 'on',
					esc_html__( 'Off', 'landinghub-core' ) => 'off',
				],
				'std'         => 'off'
			],
			[
				'type'        => 'liquid_button_set',
				'param_name'  => 'enable_category_dropdown',
				'heading'     => esc_html__( 'Enable Category Dropdown', 'landinghub-core' ),
				'description' => esc_html__( 'Enable if you want to show category dropdown on search form.', 'landinghub-core' ),
				'value'       => [
					esc_html__( 'On', 'landinghub-core' )  => 'on',
					esc_html__( 'Off', 'landinghub-core' ) => 'off',
				],
				'std'         => 'off'
			],
			[
				'type'        => 'liquid_button_set',
				'param_name'  => 'show_on_mobile',
				'heading'     => esc_html__( 'Show on Mobile', 'landinghub-core' ),
				'description' => esc_html__( 'Enable if you want to display it on mobile devices', 'landinghub-core' ),
				'value'       => array(
					esc_html__( 'Yes', 'landinghub-core' ) => 'lqd-show-on-mobile',
					esc_html__( 'No', 'landinghub-core' )  => '',
				),
				'std' => '',
			]
		];

		$this->add_extras();

	}

	public function generate_css() {

		$elements = [];
		$id       = '.' . $this->get_id();

		$this->dynamic_css_parser( $id, $elements );

	}

	public function get_search_results_wrap_start() {
		return '<div class="liquid-wc-product-search-results"><ul class="reset-ul">';
	}

	public function get_search_results_wrap_end() {
		return '</ul></div>';
	}

	public function get_search_results_list_item( $product_id ) {

		$product = wc_get_product( $product_id );

		if ( ! $product ) {
			return '';
		}

		ob_start(); ?>
			<li class="ld-wc-search-result py-3">
				<a href="<?php echo esc_url( $product->get_permalink() ); ?>" class="d-flex align-items-center px-2">
					<div class="ld-wc-search-result--thumbnail">
						<?php echo $product->get_image(); ?>
					</div>
					<div class="ld-wc-search-result--meta pl-3">
						<h4><?php esc_html_e( $product->get_name() ); ?></h4>
						<p><?php echo wp_kses_post( $product->get_short_description() ); ?></p>
						<p class="my-0 ld-wc-search-result--price">
							<?php echo $product->get_price_html(); ?>
						</p>
					</div>
				</a>
			</li>
		<?php
		return ob_get_clean();
	}

	public function get_search_results_view_all() {
		return '<li class="ld-wc-search-view-all"><a href="#">' . esc_html( 'View all results', 'landinghub-core' ) . '</a>';
	}

	public function get_products_by_input_text() {

		$search_text = strval( $_POST[ 'searchText' ] );
		$category_id = intval( $_POST[ 'termId' ] );

		$args = [
			'post_type'      => 'product',
			's'              => $search_text,
			'posts_per_page' => 5,
		];

		if ( $category_id ) {

			$parent_category = get_term( $category_id, 'product_cat' );
			$categories      = get_term_children( $parent_category->term_id, 'product_cat' );
			$categories      = array_merge( $categories, [ $parent_category->term_id ] );

			$args[ 'tax_query' ] = [
				[
					'taxonomy' => 'product_cat',
					'field'    => 'term_id',
					'terms'    => $categories,
					'operator' => 'IN'
				]
			];
		}

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) {

			$products       = [];
			$found_products = $query->get_posts();

			foreach ( $found_products as $product ) {
				$products[] = $this->get_search_results_list_item( $product->ID );
			}

			if ( $query->found_posts > $query->post_count ) {
				$output = $this->get_search_results_wrap_start() . implode( '', $products ) . $this->get_search_results_view_all() . $this->get_search_results_wrap_end();
			} else {
				$output = $this->get_search_results_wrap_start() . implode( '', $products ) . $this->get_search_results_wrap_end();
			}

		} else {
			ob_start();
			wc_no_products_found();
			$output = $this->get_search_results_wrap_start() . ob_get_clean() . $this->get_search_results_wrap_end();
		}

		wp_send_json_success( [ 'html' => $output ] );
	}
}

new LD_Header_Woo_Search;