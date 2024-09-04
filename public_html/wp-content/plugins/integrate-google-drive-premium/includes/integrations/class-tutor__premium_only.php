<?php

namespace IGD;

use TUTOR\Input;

class Tutor {

	private static $instance = null;

	public function __construct() {

		add_filter( 'tutor_preferred_video_sources', array( $this, 'add_preferred_video_sources' ) );

		add_action( 'tutor_after_video_meta_box_item', array( $this, 'add_video_meta_box_item' ), 10, 2 );

		add_action( 'tutor_after_video_source_icon', array( $this, 'add_video_source_icon' ) );

		add_action( 'tutor_save_course', array( $this, 'save_course_video' ), 10, 2 );

		//Save lesson video
		add_action( 'save_post_' . \tutor()->lesson_post_type, array( $this, 'save_lesson_meta' ) );

		//handle attachment
		add_action( 'tutor_lesson_edit_modal_form_after', array( $this, 'render_attachment_field' ) );

		//Display attachments
		add_action( 'tutor_global/after/attachments', array( $this, 'display_attachments' ) );

		//Enqueue scripts
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

	}

	public function enqueue_admin_scripts() {
		if ( wp_script_is( 'igd-admin', 'registered' ) ) {
			wp_enqueue_script( 'igd-tutor', IGD_ASSETS . '/js/tutor.js', array( 'igd-admin' ), IGD_VERSION, true );
		}
	}

	public function display_attachments() {

		$open_mode_view = apply_filters( 'tutor_pro_attachment_open_mode', null ) == 'view' ? ' target="_blank" ' : null;

		$attachments = get_post_meta( get_the_ID(), '_igd_tutor_attachments', true );
		$attachments = is_array( $attachments ) ? $attachments : array();

		if ( ! empty( $attachments ) ) {
			?>
			<div class="tutor-course-attachments tutor-row">
				<?php foreach ( $attachments as $attachment ) {
					$download_link = admin_url( "admin-ajax.php?action=igd_download&id={$attachment['id']}&accountId={$attachment['accountId']}" );

					$size = size_format( $attachment['size'], 2 );

					?>
					<div class="tutor-col-md-6 tutor-mt-16">
						<div class="tutor-course-attachment tutor-card tutor-card-sm">
							<div class="tutor-card-body">
								<div class="tutor-row">
									<div class="tutor-col tutor-overflow-hidden">
										<div
											class="tutor-fs-6 tutor-fw-medium tutor-color-black tutor-text-ellipsis tutor-mb-4"><?php echo esc_html( $attachment['name'] ); ?></div>
										<div
											class="tutor-fs-7 tutor-color-muted"><?php esc_html_e( 'Size', 'integrate-google-drive' ); ?>
											: <?php echo esc_html( $size ); ?></div>
									</div>

									<div class="tutor-col-auto">
										<a href="<?php echo esc_url( $download_link ); ?>"
										   class="tutor-iconic-btn tutor-iconic-btn-secondary tutor-stretched-link" <?php echo esc_attr( $open_mode_view ? $open_mode_view : "download={$attachment['name']}" ); ?>>
											<span class="tutor-icon-download" aria-hidden="true"></span>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>

			<style>
                .tutor-course-attachment:has([download="."]) {
                    display: none;
                }
			</style>

			<?php
		}
	}

	public function render_attachment_field( $post ) {
		$post_id = $post->ID;

		$attachments = get_post_meta( $post_id, '_igd_tutor_attachments', true );

		$attachments = is_array( $attachments ) ? $attachments : array();

		if ( ! empty( $attachments ) ) {
			foreach ( $attachments as $attachment ) {
				printf( '<input type="hidden" name="igd_tutor_attachments[%s][id]" value="%s" />', $attachment['id'], $attachment['id'] );
				printf( '<input type="hidden" name="igd_tutor_attachments[%s][accountId]" value="%s" />', $attachment['id'], $attachment['accountId'] );
				printf( '<input type="hidden" name="igd_tutor_attachments[%s][name]" value="%s" />', $attachment['id'], $attachment['name'] );
				printf( '<input type="hidden" name="igd_tutor_attachments[%s][size]" value="%s" />', $attachment['id'], $attachment['size'] );
			}
		}
	}

	public function save_lesson_meta( $post_ID ) {
		$video_source = sanitize_text_field( tutor_utils()->array_get( 'video.source', $_POST ) );

		if ( '-1' === $video_source ) {
			delete_post_meta( $post_ID, '_video' );
		} elseif ( $video_source ) {

			// Sanitize data through helper method.
			$video = Input::sanitize_array(
				$_POST['video'] ?? array(), //phpcs:ignore
				array(
					'source_external_url' => 'esc_url',
					'source_embedded'     => 'wp_kses_post',

					'source_google_drive' => 'esc_url',
					'name_google_drive'   => 'sanitize_text_field',
					'size_google_drive'   => 'sanitize_text_field',
				),
				true
			);

			update_post_meta( $post_ID, '_video', $video );

		}

		$attachments = tutor_utils()->array_get( 'igd_tutor_attachments', $_POST );

		if ( empty( $_POST['tutor_attachments'] ) && ! empty( $attachments ) ) {
			$_POST['tutor_attachments'] = array( - 1 );

			update_post_meta( $post_ID, '_tutor_attachments', $_POST['tutor_attachments'] );

		} elseif ( is_array( $_POST['tutor_attachments'] ) && count( $_POST['tutor_attachments'] ) == 1 && $_POST['tutor_attachments'][0] != '-1' ) {
			$_POST['tutor_attachments'] = array_filter( $_POST['tutor_attachments'], function ( $value ) {
				return $value !== '-1';
			} );

			update_post_meta( $post_ID, '_tutor_attachments', $_POST['tutor_attachments'] );
		}

		if ( ! empty( $attachments ) ) {
			update_post_meta( $post_ID, '_igd_tutor_attachments', $attachments );
		} else {
			delete_post_meta( $post_ID, '_igd_tutor_attachments' );
		}

	}

	public function save_course_video( $post_ID, $post ) {
		$additional_data_edit = Input::post( '_tutor_course_additional_data_edit' );

		// Additional data like course intro video.
		if ( $additional_data_edit ) {
			// Sanitize data through helper method.
			$video = Input::sanitize_array(
				$_POST['video'] ?? array(), //phpcs:ignore
				array(
					'source_embedded'     => 'wp_kses_post',
					'source_external_url' => 'esc_url',

					'source_google_drive' => 'esc_url',
					'name_google_drive'   => 'sanitize_text_field',
					'size_google_drive'   => 'sanitize_text_field',
				),
				true
			);

			$video_source = tutor_utils()->array_get( 'source', $video );

			if ( - 1 !== $video_source ) {
				update_post_meta( $post_ID, '_video', $video );
			} else {
				delete_post_meta( $post_ID, '_video' );
			}
		}

	}

	public function add_preferred_video_sources( $sources ) {
		$sources['google_drive'] = [
			'title' => __( 'Google Drive', 'integrate-google-drive' ),
			'icon'  => 'tutor-icon-brand-google-drive',
		];

		return $sources;
	}

	public function add_video_meta_box_item( $tutor_video_input_state, $post ) {
		$video             = maybe_unserialize( get_post_meta( $post->ID, '_video', true ) );
		$videoSource       = tutor_utils()->avalue_dot( 'source', $video );
		$sourceGoogleDrive = tutor_utils()->avalue_dot( 'source_google_drive', $video );
		$nameGoogleDrive   = tutor_utils()->avalue_dot( 'name_google_drive', $video );
		$sizeGoogleDrive   = tutor_utils()->avalue_dot( 'size_google_drive', $video );
		$formatSize        = $sizeGoogleDrive ? size_format( $sizeGoogleDrive, 2 ) : '';

		?>
		<div
			class="tutor-mt-16 video-metabox-source-item video_source_wrap_google_drive tutor-dashed-uploader <?php echo $sourceGoogleDrive ? 'tutor-has-video' : ''; ?>"
			style="<?php tutor_video_input_state( $videoSource, 'google_drive' ); ?>">

			<div class="video-metabox-source-google_drive-upload">
				<p class="video-upload-icon"><i class="tutor-icon-upload-icon-line"></i></p>
				<p><strong><?php esc_html_e( 'Select Your Video', 'integrate-google-drive' ); ?></strong></p>
				<p><?php esc_html_e( 'File Format: ', 'integrate-google-drive' ); ?> <span
						class="tutor-color-black">mp4, m4v, webm, ogv, flv, mov, avi, wmv, mkv, mpg, mpeg,3gp</span>
				</p>

				<div class="video_source_upload_wrap_google_drive">
					<button
						class="igd-tutor-button video_upload_btn tutor-btn tutor-btn-secondary tutor-btn-md">
						<?php esc_html_e( 'Browse Video', 'integrate-google-drive' ); ?>
					</button>
				</div>
			</div>

			<div class="google_drive-video-data">

				<div class="tutor-col-lg-12 tutor-mb-16">
					<div class="tutor-card">
						<div class="tutor-card-body">
							<div class="tutor-row tutor-align-center">
								<div class="tutor-col tutor-overflow-hidden">

									<div
										class="video-data-title tutor-fs-6 tutor-fw-medium tutor-color-black tutor-text-ellipsis tutor-mb-4">
										<?php echo esc_html( $nameGoogleDrive ); ?>
									</div>

									<div class="tutor-fs-7 tutor-color-muted">
										<?php esc_html_e( 'Size', 'integrate-google-drive' ); ?>:
										<span
											class="video-data-size"><?php echo esc_html( $formatSize ); ?></span>
									</div>

									<input type="hidden" name="video[source_google_drive]"
									       value="<?php echo esc_attr( tutor_utils()->avalue_dot( 'source_google_drive', $video ) ); ?>">
									<input type="hidden" name="video[name_google_drive]"
									       value="<?php echo esc_attr( tutor_utils()->avalue_dot( 'name_google_drive', $video ) ); ?>">
									<input type="hidden" name="video[size_google_drive]"
									       value="<?php echo esc_attr( tutor_utils()->avalue_dot( 'size_google_drive', $video ) ); ?>">
								</div>

								<div class="tutor-col-auto">
										<span
											class="tutor-igd-delete-video tutor-iconic-btn tutor-iconic-btn-secondary"
											role="button">
											<span class="tutor-icon-times" aria-hidden="true"></span>
										</span>
								</div>

							</div>
						</div>
					</div>
				</div>

				<?php

				//phpcs:ignore
				echo '<div class="tutor-fs-6 tutor-fw-medium tutor-color-secondary tutor-mb-12" >' . __( 'Upload Video Poster', 'integrate-google-drive' ) . '</div>';

				// Load thumbnail segment.
				tutor_load_template_from_custom_path(
					tutor()->path . '/views/fragments/thumbnail-uploader.php',
					array(
						'media_id'   => tutor_utils()->avalue_dot( 'poster', $video ),
						'input_name' => 'video[poster]',
					),
					false
				);

				?>
			</div>

		</div>
		<?php
	}

	public
	function add_video_source_icon() { ?>
		<i class="tutor-icon-brand-google-drive" data-for="google_drive"></i>
		<?php
	}

	public
	static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

}

Tutor::instance();