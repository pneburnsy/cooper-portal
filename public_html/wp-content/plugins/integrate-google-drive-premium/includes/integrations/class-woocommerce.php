<?php

namespace IGD;

defined( 'ABSPATH' ) || exit;


class WooCommerce {
	/**
	 * @var null
	 */
	protected static $instance = null;

	public function __construct() {
		add_action( 'woocommerce_download_file_force', [ $this, 'do_download' ], 1 );
		add_action( 'woocommerce_download_file_xsendfile', [ $this, 'do_download' ], 1 );
		add_action( 'woocommerce_download_file_redirect', [ $this, 'do_download' ], 1 );
	}

	public function do_download( $file_url ) {
		if ( ! strpos( $file_url, 'igd-wc-download' ) ) {
			return;
		}

		$parts = parse_url( $file_url );
		parse_str( $parts['query'], $query_args );


		$id         = $query_args['id'];
		$account_id = $query_args['account_id'];
		$is_folder  = ! empty( $query_args['is_folder'] );

		if ( $is_folder ) {
			igd_download_zip( [ $id ], '', $account_id );
		} else {
			$download_url = admin_url( 'admin-ajax.php?action=igd_download&id=' . $id . '&accountId=' . $account_id );
			wp_redirect( $download_url );
		}

		exit();

	}


	/**
	 * @return WooCommerce|null
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

}

WooCommerce::instance();