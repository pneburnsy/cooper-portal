<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class HUB_AI {

	private static $_instance = null;

	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
    }

    public function __construct() {

		$this->theme_option = get_option( 'liquid_one_opt' );
		if ( isset( $this->theme_option['hubai'] ) && $this->theme_option['hubai'] === 'on' ) {
			$this->init();
		}
    }

    function init(){

		$this->options();
        $this->hooks();

    }

    function hooks() {

        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
        
        add_action( 'admin_footer', [ $this, 'template' ] );
        add_action( 'edit_form_after_title', [ $this, 'print_hub_ai_button' ] );

		add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'editor_style' ] );
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'editor_script' ] );
        
        add_action( 'wp_ajax_hub_ai_post_actions', [$this, 'post_actions'] );
        add_action( 'wp_ajax_hub_ai_add_log', [$this, 'add_log'] );
        add_action( 'wp_ajax_hub_ai_update_post', [$this, 'update_post'] );
        add_action( 'wp_ajax_hub_ai_get_images', [$this, 'get_images_from_unsplash'] );
        add_action( 'wp_ajax_hub_ai_gutenberg', [$this, 'gutenberg_editor'] );
        add_action( 'wp_ajax_hub_ai_elementor', [$this, 'elementor_editor'] );

    }

	function enqueue_scripts() {

		global $pagenow;

		if ( in_array( $pagenow, [ 'post.php' ] ) ) {
			wp_enqueue_script( 
				'hub-ai-script',
				get_template_directory_uri() . '/liquid/assets/vendors/hub-ai/script.js',
				['jquery'],
				null
			);

			wp_localize_script( 'hub-ai-script', 'hub_ai', array(
				'logoUrl'	=> get_template_directory_uri() . '/liquid/assets/vendors/hub-ai/hub.svg',
			) );
		
			wp_enqueue_style( 
				'hub-ai-style',
				get_template_directory_uri() . '/liquid/assets/vendors/hub-ai/style.css',
				[]
			);
		}
		
	}

	function editor_style() {

		wp_enqueue_style( 'hub-ai-editor-style',
			get_template_directory_uri() . '/liquid/assets/vendors/hub-ai/style-editor.css',
			[]
		);

		wp_enqueue_style( 'jquery-confirm', get_template_directory_uri() . '/liquid/assets/css/jquery-confirm.min.css' );

	}

	function editor_script() {

		wp_enqueue_script( 'hub-ai-editor-script', 
			get_template_directory_uri() . '/liquid/assets/vendors/hub-ai/script-editor.js',
			[ 'elementor-editor', 'jquery' ], 
			null,
			true
		);

		wp_enqueue_script( 'jquery-confirm', get_template_directory_uri() . '/liquid/assets/js/jquery-confirm.min.js', [ 'jquery' ], false, true );

	}

	function options() {

		$this->api_key = isset( $this->theme_option['hubai_api_key'] ) && $this->theme_option['hubai_api_key'] ? $this->theme_option['hubai_api_key'] : ''; 
		$this->api_key_unsplash = isset( $this->theme_option['hubai_api_key_unsplash'] ) && $this->theme_option['hubai_api_key_unsplash'] ? $this->theme_option['hubai_api_key_unsplash'] : '';
		$this->model = isset( $this->theme_option['hubai_model'] ) && $this->theme_option['hubai_model'] ? $this->theme_option['hubai_model'] : 'text-davinci-003';
		$this->max_tokens = isset( $this->theme_option['hubai_max_tokens'] ) && $this->theme_option['hubai_max_tokens'] ? intval( $this->theme_option['hubai_max_tokens'] ) : 2048;
		
	}

    function is_chat_prompt() {

        if ( in_array( $this->model, array( 'gpt-3.5-turbo', 'gpt-3.5-turbo-0301' ) ) ){
            return true;
        }

        return false;

    }

	function add_log() {

    	$log = get_option( 'hub_ai_logs' );

		if ( isset( $_POST['log'] ) ) {
			$log_message = sanitize_text_field( $_POST['log'] );
			$log .= $log_message . '<br>';
			update_option( 'hub_ai_logs', $log );
			wp_send_json( [
				'message' => $log_message
			] );
		}

    }

    function print_hub_ai_button() {

        global $current_screen;

        if ( $current_screen->id !== 'post' ) {
            return;
        }

        ?>
            <div class="hub-ai-action components-button edit-post-fullscreen-mode-close hub-ai-action-classic"><img class="hub-ai-logo" alt="Hub AI" src="<?php echo esc_url( get_template_directory_uri() . '/liquid/assets/vendors/hub-ai/hub.svg' ); ?>"> Hub AI</div>
        <?php
    }

	function get_string_between( $string, $start, $end ){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

    function template() {

        global $current_screen;

        if ( $current_screen->id !== 'post' ) {
            return;
        }

        ?>
            <div class="hub-ai-template">
                <div class="hub-ai-template-wrapper">
                    <div class="hub-ai-template-header">
                        <div class="components-button is-pressed has-icon logo"><img class="hub-ai-logo" alt="Hub AI" src="<?php echo esc_url( get_template_directory_uri() . '/liquid/assets/vendors/hub-ai/hub.svg' ); ?>"> Hub AI</div>
                        <div class="components-button is-pressed has-icon hub-ai-template--close"><span class="dashicons dashicons-no-alt"></span></div>
                    </div>
                    <div class="hub-ai-template-content">
                        <form id="hub-ai-form" class="hub-ai-form" action="hub-ai-action" method="post">

                            <div class="form-field">
                                <label for="operation"><?php esc_html_e( 'Operation:', 'hub' ); ?></label>
                                <select name="operation" id="operation" required>
                                    <option value="post"><?php esc_html_e( 'Post Generator', 'hub' ); ?></option>
                                </select>
                            </div>
                            
                            <div class="form-field">
                                <label for="prompt"><?php esc_html_e( 'Prompt:', 'hub' ); ?></label>
                                <input type="text" id="prompt" placeholder="wp site optimization" required>
                                <p class="description">
                                    <?php esc_html_e( 'Define the blog post subject. Examples: wordpress plugin installation', 'hub' ); ?> 
                                </p>
                            </div>

                            <div class="form-field options">
                                <p><?php esc_html_e( 'Select items to create:', 'hub' ); ?></p>
                                <input type="checkbox" id="image" name="options" value="image" checked>
                                <label for="image"><?php esc_html_e( 'Image', 'hub' ); ?></label>
                            </div>

                            <div class="form-field half">
                                <label for="language"><?php esc_html_e( 'Language:', 'hub' ); ?></label>
                                <select name="language" id="language">
                                    <option value="en">🇬🇧 English (en)</option>
                                    <option value="zh">🇨🇳 中文 (zh)</option>
                                    <option value="hi">🇮🇳 हिन्दी (hi)</option>
                                    <option value="es">🇪🇸 Español (es)</option>
                                    <option value="fr">🇫🇷 Français (fr)</option>
                                    <option value="bn">🇧🇩 বাংলা (bn)</option>
                                    <option value="ar">🇸🇦 العربية (ar)</option>
                                    <option value="ru">🇷🇺 Русский (ru)</option>
                                    <option value="pt">🇵🇹 Português (pt)</option>
                                    <option value="id">🇮🇩 Bahasa Indonesia (id)</option>
                                    <option value="ur">🇵🇰 اردو (ur)</option>
                                    <option value="ja">🇯🇵 日本語 (ja)</option>
                                    <option value="de">🇩🇪 Deutsch (de)</option>
                                    <option value="jv">🇮🇩 Basa Jawa (jv)</option>
                                    <option value="pa">🇮🇳 ਪੰਜਾਬੀ (pa)</option>
                                    <option value="te">🇮🇳 తెలుగు (te)</option>
                                    <option value="mr">🇮🇳 मराठी (mr)</option>
                                    <option value="ko">🇰🇷 한국어 (ko)</option>
                                    <option value="tr">🇹🇷 Türkçe (tr)</option>
                                    <option value="ta">🇮🇳 தமிழ் (ta)</option>
                                    <option value="it">🇮🇹 Italiano (it)</option>
                                    <option value="vi">🇻🇳 Tiếng Việt (vi)</option>
                                    <option value="th">🇹🇭 ไทย (th)</option>
                                    <option value="pl">🇵🇱 Polski (pl)</option>
                                    <option value="fa">🇮🇷 فارسی (fa)</option>
                                    <option value="uk">🇺🇦 Українська (uk)</option>
                                    <option value="ms">🇲🇾 Bahasa Melayu (ms)</option>
                                    <option value="ro">🇷🇴 Română (ro)</option>
                                    <option value="nl">🇳🇱 Nederlands (nl)</option>
                                    <option value="hu">🇭🇺 Magyar (hu)</option>
                                </select>
                            </div>

                            <div class="form-field half">
                                <label for="tone-of-voice"><?php esc_html_e( 'Tone of voice:', 'hub' ); ?></label>
                                <select>
                                    <option value="professional"><?php _e( 'Professional', 'hub' ); ?></option>
                                    <option value="funny"><?php _e( 'Funny', 'hub' ); ?></option>
                                    <option value="casual"><?php _e( 'Casual', 'hub' ); ?></option>
                                    <option value="excited"><?php _e( 'Excited' , 'hub' ); ?></option>
                                    <option value="witty"><?php _e( 'Witty', 'hub' ); ?></option>
                                    <option value="sarcastic"><?php _e( 'Sarcastic', 'hub' ); ?></option>
                                    <option value="feminine"><?php _e( 'Feminine', 'hub' ); ?></option>
                                    <option value="masculine"><?php _e( 'Masculine', 'hub' ); ?></option>
                                    <option value="bold"><?php _e( 'Bold', 'hub' ); ?></option>
                                    <option value="dramatic"><?php _e( 'Dramatic', 'hub' ); ?></option>
                                    <option value="grumpy"><?php _e( 'Grumpy', 'hub' ); ?></option>
                                    <option value="secretive"><?php _e( 'Secretive', 'hub' ); ?></option>
                                </select>
                            </div>

                            <div class="form-field">
                                <label for="temperature"><?php esc_html_e( 'Temperature:', 'hub' ); ?></label>
                                <input type="number" name="temperature" id="temperature" value="0.7" min="0" max="1" step="0.1" required>
                                <p class="description"><?php esc_html_e( 'The temperature determines how greedy the generative model is. 1 is more creativity, 0 is less creativity.', 'hub' ); ?></p>
                            </div>

                            <div class="form-field">
                                <button type="submit" class="button button-primary">
                                    <div class="lds-ripple"><div></div><div></div></div>
                                    <span><?php esc_html_e( 'Generate', 'hub' ); ?></span>
                                </button>
                            </div>

                            <?php wp_nonce_field( 'hub-ai-form-response', 'security' ); ?>
                        </form>

                        <!-- result -->
                        <form id="hub-ai-form-result" class="hub-ai-form" action="hub-ai-result" method="post">
                            <h1 class="hub-ai-form--title"><?php esc_html_e( 'Result', 'hub' ); ?></h1>
                            <div class="form-field">
                                <label for="title"><?php esc_html_e( 'Post Title:', 'hub' ); ?></label>
                                <input type="text" id="title" required>
                            </div>
                            
                            <div class="form-field">
                                <label for="content"><?php esc_html_e( 'Post Content:', 'hub' ); ?></label>
                                <textarea name="content" id="content" cols="30" rows="10" required></textarea>
                            </div>

                            <div class="form-field">
                                <label for="tags"><?php esc_html_e( 'Post Tags:', 'hub' ); ?></label>
                                <input type="text" id="tags" required>
                            </div>

                            <div class="form-field generated-images">
                                <p><?php esc_html_e( 'Select Featured Image:', 'hub'); ?></p>
                            </div>

                            <div class="form-field">
                                <p class="description"><?php esc_html_e( 'Please leave blank the fields you do not wish to import.', 'hub' ); ?></p>
                            </div>

                            <input type="hidden" name="post_id" id="post_id" value="<?php echo esc_attr( get_the_ID() ); ?>">

                            <div class="form-field">
                                <button type="submit" class="button button-primary">
                                    <div class="lds-ripple"><div></div><div></div></div>
                                    <span><?php esc_html_e('Insert Data (Override current Post Data)', 'hub'); ?></span>
                                </button>
                                <div class="description hub-ai-recreate"><?php printf( '%s <u>%s</u>', __( "Didn't you like the result?", "hub-ai" ), __("Recreate", "hub-ai") ); ?></div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        <?php
    }

    function post_actions() {

        check_ajax_referer( 'hub-ai-form-response', 'security' );

        if ( empty( $_POST['prompt'] ) ) {
            wp_send_json( [
                'error' => true,
                'message' => __( 'Prompt is required!', 'hub' )
            ] );
        }
       
        if ( empty( $_POST['operation'] ) ) {
            wp_send_json( [
                'error' => true,
                'message' => __( 'Operation is required!', 'hub' )
            ] );
        }

        $operation = sanitize_text_field( $_POST['operation'] );
        $prompt_value = sanitize_text_field( $_POST['prompt'] );
        $language = !empty( $_POST['language'] ) ? sanitize_text_field( $_POST['language'] ) : 'en';
        $tone_of_voice = !empty( $_POST['tone_of_voice'] ) ? sanitize_text_field( $_POST['language'] ) : 'professional';

        switch( $operation ) {
            case 'post':
                $prompt = "write blog post about {$prompt_value} with title, content and tags in {$language} language and the tone of voice should be {$tone_of_voice} as JSON format (content lenght: 300-500).";
                break;

        }

        $temperature = !empty($_POST['temperature']) ? (int) $_POST['temperature'] : 0.7;

		$response = $this->openai_remote_post(
			[
				'prompt' => [
					'chat' => [
						[
							'role' => 'system',
							'content' => "Write a blog post in {$language} language about the title I'm going to give you. Have title, content and tags fields in it. The tone of voice should be {$tone_of_voice}, use html tags and return this output as JSON."
						],[
							'role' => 'user',
							'content' => $prompt_value
						]
					],
					'text' => $prompt
				],
				'temperature' => $temperature
			]
		);

		$output = $response['output'];

		if ( $this->is_chat_prompt() ) {
			$json = json_decode( str_replace( [ '\n    ', '\n' ], '', $output ) );
			$title = $json->title;
			$content = $json->content;
			$tags = $json->tags;

		} else {
			$json = $output;
			$title = $this->get_string_between($json, '"title": "', '",');
			$content = $this->get_string_between($json, '"content": "', '",');
			$tags = $this->get_string_between($json, '"tags": [', ']');
			$tags = str_replace(['"', "\n", "        "], ['', '', ''], $tags);
		}

		$image_value = sanitize_text_field( $_POST['image'] );
		$image = !empty( $image_value ) ? $image_value : 'false';

		$total_tokens = sprintf( 'This operation spend %s tokens', $response['total_tokens']);

		wp_send_json( [
			'message' => 'Generated!',
			'response_body' => $response_body,
			'post' => [
				'title' => $title,
				'content' => $content,
				'tags' => $tags,
				'image' => $image
			],
			'total_tokens' => $total_tokens,
		] );  
        
    }

    function update_post() {

        if ( empty( $posts = $_POST['posts'] ) ) {
            wp_send_json( [
                'error' => true,
                'message' => __( 'Data is null!', 'hub' ),
            ] );
        }

        $args = [
            'ID'            => $posts['post_id'],
            'post_title'    => $posts['title'],
            'post_content'  => $posts['content'],
            'post_status'   => 'draft',
        ];

        $update_post = wp_update_post( $args );

        if ( is_wp_error( $update_post ) ) {
            wp_send_json( [
                'error' => true,
                'message' => $update_post->get_error_messages()
            ] );
        } else {
            wp_set_post_tags( $posts['post_id'], $posts['tags'], false );

            if ( !empty( $posts['image'] ) ) {
                $this->insert_image( $posts['post_id'], $posts['image'] );
            }
           
            wp_send_json( [
                'message' => __( 'Post Updated. Post ID:' . $posts['post_id'], 'hub' ),
                'posts' => $posts,
                'redirect' => admin_url( 'post.php?post=' . $update_post . '&action=edit' )
            ] );
        }
        
    }

    function get_images_from_unsplash() {

        $queries = explode( ',', sanitize_text_field( $_POST['query'] ) );
        //shuffle($queries);
        $query = ltrim($queries[0]);

        if ( empty( $this->api_key_unsplash ) ) {

            wp_send_json( [
                //'error' => true,
                'message' => __( 'Unsplash API Key is missing! Go to the settings and add your API key', 'hub' ),
            ] );
        }

        $api_params = [
            'client_id' => $this->api_key_unsplash,
            'query' => $query,
            'per_page' => 4
        ];
    
        // https://unsplash.com/documentation
        $response = wp_remote_get( 
            add_query_arg( $api_params, "https://api.unsplash.com/search/photos" ),
            array( 'timeout' => 15 )
        );
    
        if ( ! is_wp_error( $response ) ) {
            $response_body = json_decode( wp_remote_retrieve_body( $response ), true );

            if ( $error = $response_body['errors'][0] ) {
                wp_send_json( [
                    'error' => true,
                    'message' => $error
                ] );
            }

            $response_body = $response_body['results'];
            $out = '<div class="generated-images-wrapper">';
                foreach ( $response_body as $key => $images ) { 
                $out .= '<div class="generated-images-option">';
                $out .= sprintf( 
                        '<input type="radio" id="%s" name="generated-image" value="%s" %s>',
                        esc_attr( 'generated-image-' . $key ),
                        esc_url( $images['urls']['full'] ),
                        $key === 0 ? 'checked' : ''
                    );
                $out .= sprintf( '<label for="%s"><img src="%s">%s %s</label></div>', esc_attr( 'generated-image-' . $key ), esc_url( $images['urls']['full'] ), __( 'Option', 'hub' ), ++$key  );
                } 
            $out .= '</div>';

            wp_send_json( [
                'message' => $out,
            ] );
            
        } else {
            wp_send_json( [
                'error' => true,
                'message' => $response->get_error_message()
            ] );
        }
    
    }

    function insert_image( $post_id, $image_url ) {

        // Get the path to the uploads directory
        $upload_dir = wp_upload_dir();
        $image_data = file_get_contents($image_url);
        // $filename = basename($image_url);
        $filename = sanitize_file_name(parse_url($image_url)['path']) . '.jpg';
    
        // Save the image to the uploads directory
        if ( wp_mkdir_p($upload_dir['path']) ) {
            $file = $upload_dir['path'] . '/' . $filename;
        } else {
            $file = $upload_dir['basedir'] . '/' . $filename;
        }
    
        file_put_contents($file, $image_data);
    
        // Get the attachment ID for the image
        $wp_filetype = wp_check_filetype($filename, null );
        $attachment = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_title' => sanitize_file_name(str_replace('.jpg','', $filename)),
            'post_content' => '',
            'post_status' => 'inherit'
        );
        $attachment_id = wp_insert_attachment( $attachment, $file, $post_id );
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $attachment_data = wp_generate_attachment_metadata( $attachment_id, $file );
        wp_update_attachment_metadata( $attachment_id, $attachment_data );
    
        // Set the attachment ID as the featured image for the post
        set_post_thumbnail($post_id, $attachment_id);
    
    }

    function gutenberg_editor() {

        $prompt_value = sanitize_text_field( $_POST['data']['prompt'] );
        $prompt_content = sanitize_text_field( $_POST['data']['content'] );
        $temperature = !empty($_POST['temperature']) ? (int) $_POST['temperature'] : 0.7;

		$response = $this->openai_remote_post( 
			[
				'prompt' => [
					'chat' => [ 
						[
							'role' => 'user',
							'content' => "{$prompt_value} {$prompt_content}"
						]
					],
					'text' => "{$prompt_value} {$prompt_content}"
				],
				'temperature' => $temperature
			]
		);

		$output = str_replace( [ '\n' ], '', $response['output'] );
		$total_tokens = sprintf( 'This operation spend %s tokens', $response['total_tokens'] );

		wp_send_json( [
			'output' => $output,
			'total_tokens' =>  $prompt_value . '->' . $total_tokens,
		] );
        
    }

    function elementor_editor() {

		$prompt = sanitize_text_field( $_POST['data']['prompt'] );
		$temperature = !empty($_POST['temperature']) ? (int) $_POST['temperature'] : 0.7;

		$response = $this->openai_remote_post( 
			[
			 'prompt' => [
				'chat' => [ 
					[
                        'role' => 'system',
                        'content' => "You are a CSS writer. Write css for the value given to you. Example output: 'selector{value}'. Auto detect data, for example use img tag for image, use h1 tag for title. If there is no data to write CSS or response is not css, write 'error'."
                    ],
                    [
                        'role' => 'user',
                        'content' => "{$prompt}"
                    ]
				],
				'text' => "Write css for this {$prompt}. Example output: 'selector{value}'. Auto detect data, for example use img tag for image, use h1 tag for title. If there is no data to write CSS or response is not css, write 'error'."
			 ],
			 'temperature' => $temperature
			]
		);

		$output = $response['output'];
		$total_tokens = $response['total_tokens'];

		if ( $output === 'error' ) {
			wp_send_json( [
				'error' => true,
				'message' => __( 'Your request is invalid. Please request interest in the generate CSS.', 'hub' ),
			] );
		}

		$total_tokens = sprintf( 'This operation spent %s tokens', $total_tokens );

		wp_send_json( [
			'output' => $output,
			'total_tokens' =>  $prompt . '->' . $total_tokens,
		] );
        
    }

	function openai_remote_post( $data ) {

		// Check data
		if ( ! $data ) {
			wp_send_json( [
                'error' => true,
                'message' => __( 'Someting went wrong!' )
            ] );
		}

		$prompt = $data['prompt'];
        $temperature = isset($data['temperature']) ? (int) $data['temperature'] : 0.7;
        
		// check model type
        if ( $this->is_chat_prompt() ) {
            $endpoint = 'https://api.openai.com/v1/chat/completions';
            $body = [
                'temperature' => $temperature, 
                'max_tokens' => $this->max_tokens,
                'model' => $this->model,
                'messages' => $prompt['chat']
            ];
        } else {
            $endpoint = 'https://api.openai.com/v1/completions';
            $body = [
                'prompt' => $prompt['text'], 
                'temperature' => $temperature, 
                'max_tokens' => $this->max_tokens,
                'model' => $this->model,
            ];
        }

        $args = array(
            'headers' => array(
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer $this->api_key"
            ),
            'body' => json_encode( $body ),
            'timeout' => 300,
        );

        $response = wp_remote_post( $endpoint, $args );

        if ( is_wp_error( $response ) ) {
			 wp_send_json( [
                'error' => true,
                'message' => $response->get_error_message()
            ] );
		}

		$response_body = json_decode( wp_remote_retrieve_body( $response ) );

		if ( isset( $response_body->error->message ) ) {
			wp_send_json( [
				'error' => true,
				'message' => $response_body->error->message
			] );
		} else {

			if ( $response_body->choices[0]->finish_reason === 'length' ) {
				wp_send_json( [
					'error' => true,
					'message' => __( 'Operation failed: Max Token value is not enougth for this prompt!', 'hub' ),
				] );
			}

			if ( $this->is_chat_prompt() ) {
				$output = $response_body->choices[0]->message->content;
			} else {
				$output = $response_body->choices[0]->text;
			}

			return [ 'output' => $output, 'total_tokens' => $response_body->usage->total_tokens ];
			
		}


	}

}
HUB_AI::instance();
