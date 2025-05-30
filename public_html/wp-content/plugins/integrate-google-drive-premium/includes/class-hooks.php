<?php

namespace IGD;

defined( 'ABSPATH' ) || exit();


class Hooks {
	/**
	 * @var null
	 */
	protected static $instance = null;

	public function __construct() {

		//Handle uninstall
		igd_fs()->add_action( 'after_uninstall', [ $this, 'uninstall' ] );

		$settings = get_option( 'igd_settings' );
		if ( ! empty( $settings['ownApp'] ) && ! empty( $settings['clientID'] ) && ! empty( $settings['clientSecret'] ) ) {

			add_filter( 'igd/client_id', function () use ( $settings ) {
				return $settings['clientID'];
			} );

			add_filter( 'igd/client_secret', function () use ( $settings ) {
				return $settings['clientSecret'];
			} );

			add_filter( 'igd/redirect_uri', function () {
				return admin_url( '?action=integrate-google-drive-authorization' );
			} );
		}

		// IGD render form upload field data
		add_filter( 'igd_render_form_field_data', [ $this, 'render_form_field_data' ], 10, 2 );


		if ( igd_fs()->can_use_premium_code__premium_only() ) {

			// add new cron schedules
			add_filter( 'cron_schedules', [ $this, 'cron_schedules__premium_only' ] );
			add_action( 'init', [ $this, 'init_cron_job__premium_only' ] );

			// Sync cloud files
			add_action( 'igd_sync_interval', 'igd_delete_cache' );

			// Email Notification
			if ( igd_get_settings( 'emailNotifications', false ) ) {
				add_action( 'igd_send_notification', [ $this, 'send_notification__premium_only' ], 10, 3 );
			}

			// Automatic creates private folders
			if ( igd_get_settings( 'autoPrivateFolders', false ) ) {
				add_action( 'user_register', [ $this, 'create_user_folder' ] );
				add_action( 'gform_user_registered', [ $this, 'create_user_folder' ] );

				if ( igd_get_settings( 'deleteAutoPrivateFolders', false ) ) {
					add_action( 'delete_user', [ $this, 'delete_user_folder' ] );
				}
			}
		}

		add_action( 'template_redirect', [ $this, 'direct_content' ] );
	}

	public function create_user_folder( $user_id ) {
		Private_Folders::instance()->create_user_folder( $user_id );
	}

	public function delete_user_folder( $user_id ) {
		Private_Folders::instance()->delete_user_folder( $user_id );
	}

	public function direct_content() {

		if ( ! empty( $_GET['direct_file'] ) ) {

			$file = $_GET['direct_file'];

			$file = json_decode( base64_decode( $file ), true );

			if ( empty( $file['permissions'] ) ) {
				$file['permissions'] = [];
			}

			$is_dir = igd_is_dir( $file['type'] );

			add_filter( 'show_admin_bar', '__return_false' );

			// Remove all WordPress actions
			remove_all_actions( 'wp_head' );
			remove_all_actions( 'wp_print_styles' );
			remove_all_actions( 'wp_print_head_scripts' );
			remove_all_actions( 'wp_footer' );

			// Handle `wp_head`
			add_action( 'wp_head', 'wp_enqueue_scripts', 1 );
			add_action( 'wp_head', 'wp_print_styles', 8 );
			add_action( 'wp_head', 'wp_print_head_scripts', 9 );
			add_action( 'wp_head', 'wp_site_icon' );

			// Handle `wp_footer`
			add_action( 'wp_footer', 'wp_print_footer_scripts', 20 );

			// Handle `wp_enqueue_scripts`
			remove_all_actions( 'wp_enqueue_scripts' );

			// Also remove all scripts hooked into after_wp_tiny_mce.
			remove_all_actions( 'after_wp_tiny_mce' );

			if ( $is_dir ) {
				Enqueue::instance()->frontend_scripts();
			}

			$type = $is_dir ? 'browser' : 'embed';

			?>

			<!doctype html>
			<html lang="<?php language_attributes(); ?>">
			<head>
				<meta charset="<?php bloginfo( 'charset' ); ?>">
				<meta name="viewport"
				      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
				<meta http-equiv="X-UA-Compatible" content="ie=edge">
				<title><?php echo esc_html($file['name']); ?></title>

				<?php do_action( 'wp_head' ); ?>

				<?php if ( 'embed' == $type ) { ?>
					<style>
                        html, body {
                            margin: 0;
                            padding: 0;
                            width: 100%;
                            height: 100%;
                        }

                        #igd-direct-content {
                            width: 100%;
                            height: 100vh;
                            overflow: hidden;
                            position: relative;
                        }

                        #igd-direct-content:after {
                            content: '';
                            width: 60px;
                            height: 55px;
                            position: absolute;
                            opacity: 1;
                            right: 12px;
                            top: 0;
                            z-index: 10000000;
                            background-color: #d1d1d1;
                            cursor: default !important;
                        }

                        #igd-direct-content .igd-embed {
                            width: 100%;
                            height: 100%;
                            border: none;
                        }
					</style>
				<?php } ?>

			</head>
			<body>

			<div id="igd-direct-content">
				<?php

				$data = [
					'folders'            => [ $file ],
					'type'               => $type,
					'allowPreviewPopout' => false,
				];

				echo Shortcode::instance()->render_shortcode( [], $data );

				?>
			</div>

			<?php do_action( 'wp_footer' ); ?>

			</body>
			</html>

			<?php
			exit();
		}
	}

	public function send_notification__premium_only( $type, $file_ids, $account_id ) {

		$files = [];

		if ( ! empty( $file_ids ) ) {
			foreach ( $file_ids as $file_id ) {
				$files[] = App::instance( $account_id )->get_file_by_id( $file_id );
			}
		}


		$user_id   = get_current_user_id();
		$user_name = __( 'An anonymous user', 'integrate-google-drive' );
		$ext       = __( 'files', 'integrate-google-drive' );

		if ( $user_id ) {
			$user_name = get_user_by( 'id', $user_id )->user_login;
		}

		if ( count( $files ) == 1 ) {
			$ext = $files[0]['name'];
		}

		$subject =
			// translators: %1$s: user name, %2$s: file name
			sprintf( __( '%1$s downloaded %2$s', 'integrate-google-drive' ), $user_name, $ext );

		if ( 'upload' == $type ) {
			$upload_folder_id   = ! empty( $files[0]['parents'] ) ? $files[0]['parents'][0] : '';
			$upload_folder_name = ! empty( $upload_folder_id ) ? App::instance( $account_id )->get_file_by_id( $upload_folder_id )['name'] : '';

			$ext     =
				// translators: %1$s: file name, %2$s: folder name
				sprintf( __( '%1$s files to %2$s.', 'integrate-google-drive' ), count( $files ), $upload_folder_name );
			$subject =
				// translators: %1$s: user name, %2$s: file name
				sprintf( __( '%1$s uploaded %2$s', 'integrate-google-drive' ), $user_name, $ext );
		} elseif ( 'delete' == $type ) {
			$ext     =
				// translators: %1$s: file name
				sprintf( __( '(%1$s) file(s)', 'integrate-google-drive' ), count( $files ) );
			$subject =
				// translators: %1$s: user name, %2$s: file name
				sprintf( __( '%1$s deleted %2$s', 'integrate-google-drive' ), $user_name, $ext );
		}

		ob_start();
		include_once IGD_INCLUDES . '/views/notification-email__premium_only.php';
		$message = ob_get_clean();

		$headers = [
			'Content-Type: text/html; charset=UTF-8',
			'From: ' . get_bloginfo( 'name' ) . ' <' . get_bloginfo( 'admin_email' ) . '>',
		];

		$to = igd_get_settings( 'notificationEmail', get_option( 'admin_email' ) );
		if ( ! empty( $to ) ) {
			wp_mail( $to, $subject, $message, $headers );
		}
	}

	public function render_form_field_data( $data, $as_html ) {
		$uploaded_files = json_decode( $data, 1 );

		if ( empty( $uploaded_files ) ) {
			return $data;
		}

		$first_file = $uploaded_files[0];
		$parent_id  = $first_file['parents'][0];

		// Render TEXT only
		if ( ! $as_html ) {
			$formatted_value = sprintf( '%d file(s) uploaded to Google Drive:', count( $uploaded_files ) );
			$formatted_value .= "\r\n";
			foreach ( $uploaded_files as $file ) {
				$formatted_value .= $file['name'] . "\r\n";
			}

			return $formatted_value;
		}

		$folder_location = sprintf( '<a style="text-decoration: none; font-weight: bold; color: #15c" href="https://drive.google.com/drive/folders/%1$s"><strong>Google Drive</strong></a>', $parent_id );
		$heading         = sprintf( '<h3 style="margin-bottom: 15px;">%1$d file(s) uploaded to %2$s</h3>', count( $uploaded_files ), $folder_location );

		// Render HTML
		ob_start();

		echo $heading;

		foreach ( $uploaded_files as $file ) { ?>
			<div
				style="display: block; margin-bottom: 10px; padding: 10px; border: 1px solid #ddd;background-color: #FAFAFA;">
				<img alt="File Icon" height="16" src="<?php echo esc_url( $file['iconLink'] ); ?>"
				     style="margin-right:7px;height:auto;width:16px;max-width:16px;vertical-align: middle;" width="16">
				<a style="text-decoration: none; font-weight: 500; color: #15c;vertical-align: middle;"
				   href="<?php printf( 'https://drive.google.com/file/d/%1$s/view?usp=drivesdk', $file['id'] ); ?>"
				   target="_blank"><?php echo esc_html( $file['name'] ); ?></a>
			</div>
		<?php }

		//Remove any newlines
		return trim( preg_replace( '/\s+/', ' ', ob_get_clean() ) );
	}

	public function cron_schedules__premium_only( $schedules ) {
		$settings = get_option( 'igd_settings' );
		$interval = ! empty( $settings['syncInterval'] ) ? $settings['syncInterval'] : 'never';

		if ( 'never' != $interval ) {

			if ( 'custom' == $interval ) {
				$interval = intval( $settings['customSyncInterval'] );

				if ( $interval < 60 ) {
					return $schedules;
				}

			}

			$schedules['igd_sync_interval'] = [
				'interval' => $interval,
				'display'  => __( 'Integrate Google Drive Synchronize Interval', 'integrate-google-drive' )
			];
		}

		return $schedules;
	}

	public function init_cron_job__premium_only() {

		$settings = get_option( 'igd_settings' );

		$hook = 'igd_sync_interval';

		$interval = ! empty( $settings['syncInterval'] ) ? $settings['syncInterval'] : 'never';

		if ( 'never' != $interval ) {

			$scheduled_interval = igd_get_scheduled_interval( $hook );

			if ( 'custom' == $interval ) {
				$interval = intval( $settings['customSyncInterval'] );
			}

			// If settings changed clear previous hook
			if ( $scheduled_interval != $interval || $interval < 60 ) {
				wp_clear_scheduled_hook( $hook );
			}

			if ( ! wp_next_scheduled( $hook ) ) {
				wp_schedule_event( time(), 'igd_sync_interval', $hook );
			}
		} else {
			wp_clear_scheduled_hook( $hook );
		}
	}

	public function uninstall() {

		//Remove cron
		$timestamp = wp_next_scheduled( 'igd_sync_interval' );
		if ( $timestamp ) {
			wp_unschedule_event( $timestamp, 'igd_sync_interval' );
		}

		//Delete data
		if ( igd_get_settings( 'deleteData', false ) ) {
			delete_option( 'igd_tokens' );
			delete_option( 'igd_accounts' );
			delete_option( 'igd_settings' );
			delete_option( 'igd_cached_folders' );

			igd_delete_cache();
		}

	}


	/**
	 * @return Hooks|null
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

}

Hooks::instance();