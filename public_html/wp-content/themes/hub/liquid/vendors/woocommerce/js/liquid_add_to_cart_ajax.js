(($) => {

	const $addToCartBtn = $('.single_add_to_cart_button');
	
	$addToCartBtn.on('click', function(e) {
		
		e.preventDefault();
		
		const $btn = $(e.currentTarget);
		var btnData = {};

		// Fetch changes that are directly added by calling $btn.data( key, value )
		$.each( $btn.data(), function( key, value ) {
			btnData[ key ] = value;
		});

		// Fetch data attributes in $btn. Give preference to data-attributes because they can be directly modified by javascript
		// while `.data` are jquery specific memory stores.
		$.each( $btn[0].dataset, function( key, value ) {
			btnData[ key ] = value;
		});

		if ( ! btnData.product_name ) {
			const $nameInput = $btn.siblings('input.lqd-product-name');
			if ( $nameInput.length ) {
				btnData['product_name'] = $nameInput.val();
			}
		}

		// Trigger event.
		$( document.body ).trigger( 'adding_to_cart', [ $btn, btnData ] );
		
		const $quickCart = $('div.header-quickcart');
		const $wooMsg = $('.lqd-woo-added-msg');
		const product_id = $('input[name=product_id]').val() || $btn.val();
		const variation_id = $('input[name="variation_id"]').val();
		const quantity = $('input[name="quantity"]').val();
		let data = 'action=liquid_add_cart_single&product_id=' + product_id + '&quantity=' + quantity;
		
		if ( variation_id != '' ) {
			data = 'action=liquid_add_cart_single&product_id=' + product_id + '&variation_id=' + variation_id + '&quantity=' + quantity;
		}
		
		$btn.addClass('adding-to-cart loading');
		$wooMsg.fadeIn().addClass('adding-to-cart').removeClass('added-to-cart');
		
		$.ajax ({
			url: liquid_ajax_object.ajax_url,
			type:'POST',
			data: data,
			success:function(results) {
				
				$wooMsg.removeClass('adding-to-cart').addClass('added-to-cart');
				$quickCart.empty().append( results );

				$('.header-cart-fragments').html($('.item-count', $quickCart).first().html());
				$btn.removeClass('adding-to-cart loading');
	
				setTimeout(function () { 
					$wooMsg.fadeOut();
				}, 6000);

				// Trigger event so themes can refresh other areas.
				$( document.body ).trigger( 'added_to_cart', [ results.fragments, results.cart_hash, $btn ] );
	
			}
		});
	});

	$(document).ajaxComplete(function(e) {
		
		if ($(e.target.activeElement).is('a.button.yith-wcqv-button')) {
			
			$addToCartBtn.on('click', function(e) {
	
				e.preventDefault();

				const $quickCart = $('div.header-quickcart');
				const $wooMsg = $('.lqd-woo-added-msg');
				const product_id = $('input[name=product_id]').val() || $(this).val();
				const variation_id = $('input[name="variation_id"]').val();
				const quantity = $('input[name="quantity"]').val();
				let data = 'action=liquid_add_cart_single&product_id=' + product_id + '&quantity=' + quantity;
	
				if ( variation_id != '' ) {
					data = 'action=liquid_add_cart_single&product_id=' + product_id + '&variation_id=' + variation_id + '&quantity=' + quantity;
				}
				
				$(this).addClass('adding-to-cart');
				$wooMsg.fadeIn().addClass('adding-to-cart').removeClass('added-to-cart');
				
				$.ajax ({
					url: liquid_ajax_object.ajax_url,
					type: 'POST',
					data: data,
					
					success:function(results) {
						
						
						$wooMsg.removeClass('adding-to-cart').addClass('added-to-cart');
						$quickCart.empty().append( results );

						$('.header-cart-fragments').html($('.item-count', $quickCart).first().html());
						$addToCartBtn.removeClass('adding-to-cart');
	
						setTimeout(function () { 
							$('#yith-quick-view-modal').removeClass('open');
						}, 6000);
	
					}
				});
				
			});
		}
		
	});

})(jQuery);
