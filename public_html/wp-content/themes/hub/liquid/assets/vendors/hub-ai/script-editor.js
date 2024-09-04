( function () {
	var $ = jQuery;

	function handleEditor() {

		$( document ).on( 'click', '.hub-ai-el-action', function ( e ) {

			const element = $( e.target ).closest( '.elementor-control-field' );
			// Find the Ace Editor's text layer within the selected element
			const editorTextLayer = element.find( '.ace_editor' );
			const editor = ace.edit( editorTextLayer[ 0 ] ); // Create Ace Editor instance from text layer

			jQuery.confirm( {
				columnClass: 'hub-ai-el-popup',
				//type: 'dark',
				title: 'Hub AI <div id="hub-ai-modal-ripple" class="lds-ripple" style="position:relative;left:10px;top:-6px"><div></div><div></div></div>',
				content: `
				<p>Explain to Hub AI what you want to do. Keep it short.</p>
				<input id="hub-ai-el-prompt" placeholder="Enter prompt..." type="text" required />
				<p>Examples:</p>
				<div class="hub-ai-examples">
				<span>change h1 color to red </span>
				<span>text hover color should be blue</span>
				<span>when hover image add 10px roundness</span>
				<span>change woocommerce product price color to #112233</span>
				</div>`,
				closeIcon: true,
				closeIconClass: 'dashicons dashicons-no',
				buttons: {
					new: {
						btnClass: 'btn-blue',
						text: 'Confirm →',
						action: function () {
							var $modal = this;
							if ( $( '#hub-ai-el-prompt' ).val() !== '' ) {
								$( '#hub-ai-modal-ripple' ).css( 'display', 'inline' );
								jQuery.post( ajaxurl, { action: 'hub_ai_elementor', data: { action: $( e.target ).data( 'action' ), prompt: $( '#hub-ai-el-prompt' ).val(), } }, function ( response ) {
									if ( response.error ) {
										$( '#hub-ai-modal-ripple' ).css( 'display', 'none' );
										alert( response.message );
									} else {
										editor.getSession().getDocument().insert( editor.getCursorPosition(), response.output );
										$modal.close();
										add_log( response.total_tokens );
									}
								} );
							} else {
								alert( 'Prompt field is empty!' );
							}
							// prevent the modal from closing
							return false;
						}
					},
				}
			} );


			//console.log(props);
		} );

		$( document ).on( 'click', '.hub-ai-examples span', function ( e ) {
			$( '#hub-ai-el-prompt' ).val( $( this ).text() );
		} );

	}

	$( window ).on( 'elementor:init', handleEditor );

	// Logging actions
	function add_log( message ) {
		$.ajax( {
			url: ajaxurl,
			type: 'POST',
			data: {
				action: 'hub_ai_add_log',
				log: get_log_time() + message,
			},
			success: function ( data ) {
				//console.log(data.message);
			}
		} );
	}

	function get_log_time() {
		let date = new Date().toLocaleString();
		return '[' + date + '] - ';
	}

} )( jQuery );