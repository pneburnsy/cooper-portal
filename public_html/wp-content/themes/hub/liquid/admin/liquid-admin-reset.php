<?php
/**
* Liquid Themes Theme Framework
* The Liquid_Admin_Dashboard base class
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Liquid_Admin_Reset extends Liquid_Admin_Page {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		$this->id = 'liquid-reset';
		$this->page_title = esc_html__( 'Reset', 'hub' );
		$this->menu_title = esc_html__( 'Reset', 'hub' );
		$this->parent = 'liquid';
		$this->position = '70';
		$this->theme_slug = 'hub';

		add_action( 'wp_ajax_liquid_reset_wordpress_before', function(){
			$this->liquid_reset_wp_before();
			wp_send_json_success();
		} );
		add_action( 'wp_ajax_liquid_reset_wordpress', function(){
			$this->liquid_reset_wp();
			wp_send_json_success();
		} );

		//$this->add_action( 'admin_init',  'do_reinstall');

		parent::__construct();
	}

	/**
	 * [display description]
	 * @method display
	 * @return [type]  [description]
	 */
	public function display() {
		include_once( get_template_directory() . '/liquid/admin/views/liquid-reset.php' );
	}

	function liquid_reset_wp_before() {
		$active_plugins = get_option('active_plugins');
		set_transient('liquid_active_plugins', $active_plugins, 400);
		remove_all_actions('update_option_active_plugins');
		update_option('active_plugins', array());
	}

	function liquid_reset_wp() {
		global $current_user, $wpdb;
		
		// only admins can reset; double-check
		if (!current_user_can('administrator')) {
			return false;
		}

		// make sure the function is available to us
		if (!function_exists('wp_install')) {
			require ABSPATH . '/wp-admin/includes/upgrade.php';
		}

		// save values that need to be restored after reset
		$blogname = get_option('blogname');
		$blog_public = get_option('blog_public');
		$wplang = get_option('wplang');
		$siteurl = get_option('siteurl');
		$home = get_option('home');
		$upload_dir = wp_get_upload_dir();
		$active_theme = wp_get_theme();
		$active_plugins = get_transient('liquid_active_plugins');
		$l = trim( get_option( $this->theme_slug . '_purchase_code' ) );
		$e = get_option( $this->theme_slug . '_register_email', false );
		$s = get_option( $this->theme_slug . '_purchase_code_status', false );


		// delete custom tables with WP's prefix
		$prefix = str_replace('_', '\_', $wpdb->prefix);
		$tables = $wpdb->get_col("SHOW TABLES LIKE '{$prefix}%'");

		foreach ($tables as $table) {
			$wpdb->query("DROP TABLE $table");
		}

		$old_user_pass = $current_user->user_pass;

		// suppress errors
		$result = @wp_install($blogname, $current_user->user_login, $current_user->user_email, $blog_public, '', md5(rand()), $wplang);
		$user_id = $result['user_id'];

		// restore user pass
		$query = $wpdb->prepare("UPDATE {$wpdb->users} SET user_pass = %s, user_activation_key = %s WHERE ID = %d LIMIT 1", array($old_user_pass, '', $user_id));
		$wpdb->query($query);
		$current_user->user_pass = $old_user_pass;

		// delete uploads folder
    	$this->liquid_reset_wp_uploads($upload_dir['basedir'], $upload_dir['basedir']);

		// restore rest of the settings
		update_option('siteurl', $siteurl);
		update_option('home', $home);
		update_option( $this->theme_slug . '_purchase_code', $l );
		update_option( $this->theme_slug . '_register_email', $e );
		update_option( $this->theme_slug . '_purchase_code_status', $s );

		// remove password nag
		if ( get_user_meta($user_id, 'default_password_nag') ) {
			update_user_meta($user_id, 'default_password_nag', false);
		}
		if ( get_user_meta($user_id, $wpdb->prefix . 'default_password_nag') ) {
			update_user_meta($user_id, $wpdb->prefix . 'default_password_nag', false);
		}

		// reactivate theme
		switch_theme($active_theme->get_stylesheet());

		// reactivate all plugins
		foreach ($active_plugins as $plugin_file) {
			activate_plugin($plugin_file);
		}

		// log out and log in the old/new user
		// since the password doesn't change this is potentially unnecessary
		wp_clear_auth_cookie();
		wp_set_auth_cookie($user_id);
		wp_safe_redirect(admin_url( 'admin.php?page=liquid-setup' ));
	
	}

	function liquid_reset_wp_uploads($folder, $base_folder) {

		$files = array_diff(scandir($folder), array('.', '..'));

		foreach ($files as $file) {
			if (is_dir($folder . DIRECTORY_SEPARATOR . $file)) {
				$this->liquid_reset_wp_uploads($folder . DIRECTORY_SEPARATOR . $file, $base_folder);
			} else {
				@unlink($folder . DIRECTORY_SEPARATOR . $file);
			}
		}

		if ($folder != $base_folder) {
			@rmdir($folder);
		}

	}

}
new Liquid_Admin_Reset;
