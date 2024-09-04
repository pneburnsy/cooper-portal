<?php
/*
 * Page 404
*/

$this->sections[] = array (
	'title'  => esc_html__( 'Hub AI', 'hub' ),
	'icon'   => 'el el-magic',
	'fields' => array(
		array(
			'id'       => 'hubai',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Enable Hub AI', 'hub' ),
			'subtitle' => esc_html__( 'Enable the Power of AI with Hub AI: Enhance Your ChatGPT Experience to New Heights.', 'hub' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'hub' ),
				'off'  => esc_html__( 'Off', 'hub' )
			),
			'default'  => 'on'
		),
		array(
			'id'       => 'hubai_api_key',
			'type'     => 'text',
			'title'    => esc_html__( 'OpenAI API Key', 'hub' ),
			'desc'     => wp_kses_post( sprintf( '%s <a href="https://platform.openai.com/account/api-keys" target="_blank">https://platform.openai.com/account/api-keys</a>', __( 'You can find your API key at', 'hub' ) ) ),
			'required' => array( 'hubai', '=', 'on' ),
		),
		array(
			'id'       => 'hubai_api_key_unsplash',
			'type'     => 'text',
			'title'    => esc_html__( 'Unsplash API Key', 'hub' ),
			'desc'     => wp_kses_post( sprintf( '%s <a href="https://unsplash.com/oauth/applications" target="_blank">https://unsplash.com/oauth/applications</a>', __( 'You can find your API key at', 'hub' ) ) ),
			'required' => array( 'hubai', '=', 'on' ),
		),
		array(
			'id'       => 'hubai_model',
			'type'     => 'select',
			'title'    => esc_html__( 'Model', 'hub' ),
			'options'  => array(
				'gpt-3.5-turbo' => esc_html__( 'gpt-3.5-turbo', 'hub' ),
				'text-davinci-003' => esc_html__( 'text-davinci-003', 'hub' ),
				'text-curie-001' => esc_html__( 'text-curie-001', 'hub' ),
				'text-babbage-001' => esc_html__( 'text-babbage-001', 'hub' ),
				'text-ada-001' => esc_html__( 'text-ada-001', 'hub' ),
			),
			'desc'     => wp_kses_post( sprintf( 'GPT models can understand and generate natural language. <a href="https://platform.openai.com/docs/models" target="_blank">%s</a>', __( 'More info', 'hub' ) ) ),
			'default'  => 'text-davinci-003',
			'required' => array( 'hubai', '=', 'on' ),
		),
		array(
			'id'       => 'hubai_max_tokens',
			'type'     => 'text',
			'title'    => esc_html__( 'Max Tokens', 'hub' ),
			'desc'     => esc_html__( 'Limits the maximum number of tokens a language model can process at once in OpenAI', 'hub' ),
			'default'  => 2048,
			'required' => array( 'hubai', '=', 'on' ),
		),
	)
);
