(function($) {

	vc.events.on("app.render", function() {
		vc.frame_window.liquidElements(vc.frame_window.jQuery);
	})

	vc.events.on(`shortcodeView:ready:vc_row shortcodeView:updated:vc_row shortcodeView:ready:vc_row_inner shortcodeView:updated:vc_row_inner`, model => {

		if ( ! model.view ) return;
		
		const $el = model.view.$el;
		
		vc.frame_window.jQuery('[data-slideshow-bg]', vc.frame_window.jQuery($el)).liquidSlideshowBG();
		vc.frame_window.jQuery('.vc_row[data-parallax]', vc.frame_window.jQuery($el)).liquidParallax();
		vc.frame_window.jQuery('.row-bg[data-parallax]', vc.frame_window.jQuery($el)).liquidParallax();
		vc.frame_window.jQuery('.vc_row[data-custom-animations]', vc.frame_window.jQuery($el)).liquidCustomAnimations();
		vc.frame_window.jQuery($('[data-pin=true]').get().reverse(), vc.frame_window.jQuery($el)).liquidPin();
		vc.frame_window.jQuery('[data-shrink-borders]', vc.frame_window.jQuery($el)).liquidShrinkBorders();

	});

	vc.events.on(`shortcodeView:ready:vc_column shortcodeView:updated:vc_column shortcodeView:ready:vc_column_inner shortcodeView:updated:vc_column_inner`, model => {

		if ( ! model.view ) return;
		
		const $el = model.view.$el;
		
		// const $circleProgressbar = vc.frame_window.jQuery('[data-progressbar].ld-prgbr-circle', vc.frame_window.jQuery($el));
		vc.frame_window.jQuery('[data-slideshow-bg]', vc.frame_window.jQuery($el)).liquidSlideshowBG();
		vc.frame_window.jQuery('> .wpb_column', vc.frame_window.jQuery($el)).liquidParallax();
		vc.frame_window.jQuery('.wpb_wrapper', vc.frame_window.jQuery($el)).liquidCustomAnimations();
		vc.frame_window.jQuery($('[data-pin=true]').get().reverse(), vc.frame_window.jQuery($el)).liquidPin();
		// if ( $circleProgressbar.length ) {
		// 	vc.frame_window.jQuery('.ld-prgbr-circle-container'. $circleProgressbar).circleProgress();
		// }

	});

	vc.events.on(
		`shortcodeView:ready:ld_blog shortcodeView:updated:ld_blog
		shortcodeView:ready:ld_portfolio_listing shortcodeView:updated:ld_portfolio_listing`,
	model => {

		if ( ! model.view ) return;
		
		const $el = model.view.$el;
		
		vc.frame_window.jQuery('[data-liquid-masonry]', vc.frame_window.jQuery($el)).liquidMasonry({bypassCheck: true});
		vc.frame_window.jQuery('[data-lqd-flickity]', vc.frame_window.jQuery($el)).liquidCarousel({bypassCheck: true});
		vc.frame_window.jQuery('[data-fittext]', vc.frame_window.jQuery($el)).liquidFitText();
		vc.frame_window.jQuery('[data-split-text]', vc.frame_window.jQuery($el)).liquidSplitText()
		vc.frame_window.jQuery('[data-parallax]', vc.frame_window.jQuery($el)).liquidParallax();

	});

	vc.events.on(`shortcodeView:ready:ld_fancy_heading shortcodeView:updated:ld_fancy_heading`, model => {

		if ( ! model.view ) return;
		
		const $el = model.view.$el;

		vc.frame_window.jQuery('[data-parallax]', vc.frame_window.jQuery($el)).liquidParallax();
		vc.frame_window.jQuery('[data-fittext]', vc.frame_window.jQuery($el)).liquidFitText();
		vc.frame_window.jQuery('[data-split-text]', vc.frame_window.jQuery($el)).liquidSplitText();
		vc.frame_window.jQuery('[data-custom-animations]', vc.frame_window.jQuery($el)).liquidCustomAnimations();
		vc.frame_window.jQuery('[data-text-rotator]', vc.frame_window.jQuery($el)).liquidTextRotator();
		vc.frame_window.jQuery('[data-inview]', vc.frame_window.jQuery($el)).liquidInView();

	});

	vc.events.on(`shortcodeView:ready:ld_icon_box shortcodeView:updated:ld_icon_box`, model => {

		if ( ! model.view ) return;
		
		const $el = model.view.$el;

		vc.frame_window.jQuery('[data-animate-icon]', vc.frame_window.jQuery($el)).liquidAnimatedIcon();
		vc.frame_window.jQuery('[data-slideelement-onhover]', vc.frame_window.jQuery($el)).liquidSlideElement();

	});

	vc.events.on(`shortcodeView:ready:ld_google_map shortcodeView:updated:ld_google_map`, model => {

		if ( ! model.view ) return;
		
		const $el = model.view.$el;

		vc.frame_window.jQuery('[data-plugin-map]', vc.frame_window.jQuery($el)).liquidMap();

	});

	vc.events.on(`shortcodeView:ready:ld_button shortcodeView:updated:ld_button`, model => {

		if ( ! model.view ) return;
		
		const $el = model.view.$el;

		vc.frame_window.jQuery('[data-localscroll]', vc.frame_window.jQuery($el)).liquidLocalScroll();

	});

	vc.events.on(`shortcodeView:ready:ld_button shortcodeView:updated:ld_button`, model => {

		if ( ! model.view ) return;
		
		const $el = model.view.$el;

		vc.frame_window.jQuery('[data-split-text]', vc.frame_window.jQuery($el)).liquidSplitText();
		vc.frame_window.jQuery('[data-transition-delay]', vc.frame_window.jQuery($el)).liquidTransitionDelay();
		vc.frame_window.jQuery('[data-custom-animations]', vc.frame_window.jQuery($el)).liquidCustomAnimations();

	});

	vc.events.on(`shortcodeView:ready:ld_typewriter shortcodeView:updated:ld_typewriter`, model => {

		if ( ! model.view ) return;
		
		const $el = model.view.$el;

		vc.frame_window.jQuery('[data-typewriter]', vc.frame_window.jQuery($el)).liquidTypewriter();

	});

	vc.events.on(`shortcodeView:ready:ld_freakin_image shortcodeView:updated:ld_freakin_image`, model => {

		if ( ! model.view ) return;
		
		const $el = model.view.$el;

		vc.frame_window.jQuery('[data-inview]', vc.frame_window.jQuery($el)).liquidInView();

	});

	vc.events.on(`shortcodeView:ready:ld_content_box shortcodeView:updated:ld_content_box`, model => {

		if ( ! model.view ) return;
		
		const $el = model.view.$el;

		vc.frame_window.jQuery('[data-responsive-bg]', vc.frame_window.jQuery($el)).liquidResponsiveBG();
		vc.frame_window.jQuery('[data-parallax]', vc.frame_window.jQuery($el)).liquidParallax();
		vc.frame_window.jQuery('[data-fittext]', vc.frame_window.jQuery($el)).liquidFitText();
		vc.frame_window.jQuery('[data-split-text]', vc.frame_window.jQuery($el)).liquidSplitText();
		vc.frame_window.jQuery('[data-custom-animations]', vc.frame_window.jQuery($el)).liquidCustomAnimations();
		vc.frame_window.jQuery('[data-inview]', vc.frame_window.jQuery($el)).liquidInView();
		vc.frame_window.jQuery('[data-hover3d]', vc.frame_window.jQuery($el)).liquidHover3d();
		vc.frame_window.jQuery('[data-reveal]', vc.frame_window.jQuery($el)).liquidReveal();
		vc.frame_window.jQuery('[data-slideelement-onhover]', vc.frame_window.jQuery($el)).liquidSlideElement();

	});

	vc.events.on(`shortcodeView:ready:ld_asymmetric_slider shortcodeView:updated:ld_asymmetric_slider`, model => {

		if ( ! model.view ) return;
		
		const $el = model.view.$el;

		vc.frame_window.jQuery('[data-fittext]', vc.frame_window.jQuery($el)).liquidFitText();
		vc.frame_window.jQuery('[data-split-text]', vc.frame_window.jQuery($el)).liquidSplitText();
		vc.frame_window.jQuery('[data-asym-slider]', vc.frame_window.jQuery($el)).liquidAsymmetricSlider();

	});

	vc.events.on(`shortcodeView:ready:ld_bananas_banner shortcodeView:updated:ld_bananas_banner`, model => {

		if ( ! model.view ) return;
		
		const $el = model.view.$el;

		vc.frame_window.jQuery('[data-parallax]', vc.frame_window.jQuery($el)).liquidParallax();

	});

	// vc.events.on(`shortcodeView:ready:ld_carousel_falcate shortcodeView:updated:ld_carousel_falcate`, model => {

	// 	if ( ! model.view ) return;
		
	// 	const $el = model.view.$el;

	// 	_.defer(() => {
	// 		if ( $el.find('.carousel-item').length ) {
	// 			vc.frame_window.jQuery('.carousel-falcate', vc.frame_window.jQuery($el)).liquidCarouselFalcate();
	// 		}
	// 	});

	// });

	vc.events.on(`shortcodeView:ready:ld_carousel_gallery shortcodeView:updated:ld_carousel_gallery`, model => {

		if ( ! model.view ) return;
		
		const $el = model.view.$el;

		vc.frame_window.jQuery('[data-lqd-flickity]', vc.frame_window.jQuery($el)).liquidCarousel({bypassCheck: true});

	});
	

	vc.events.on(`shortcodeView:ready:ld_d_banner shortcodeView:updated:ld_d_banner`, model => {

		if ( ! model.view ) return;
		
		const $el = model.view.$el;

		vc.frame_window.jQuery('[data-fittext]', vc.frame_window.jQuery($el)).liquidFitText();
		vc.frame_window.jQuery('[data-split-text]', vc.frame_window.jQuery($el)).liquidSplitText()
		vc.frame_window.jQuery('[data-custom-animations]', vc.frame_window.jQuery($el)).liquidCustomAnimations();
		vc.frame_window.jQuery('[data-hover3d]', vc.frame_window.jQuery($el)).liquidHover3d();

	});

	vc.events.on(`shortcodeView:ready:ld_d_depth_banner shortcodeView:updated:ld_d_depth_banner`, model => {

		if ( ! model.view ) return;
		
		const $el = model.view.$el;

		vc.frame_window.jQuery('[data-lqd-fake3d]', vc.frame_window.jQuery($el)).liquidFake3d();

	});

	vc.events.on(`shortcodeView:ready:ld_distorse_gallery shortcodeView:updated:ld_distorse_gallery`, model => {

		if ( ! model.view ) return;
		
		const $el = model.view.$el;

		vc.frame_window.jQuery('[data-lqd-img-trail]', vc.frame_window.jQuery($el)).liquidImageTrail();
		vc.frame_window.jQuery('[data-lqd-dist-gal]', vc.frame_window.jQuery($el)).liquidDistortedImageGallery();

	});

	vc.events.on(`shortcodeView:ready:ld_fullproj shortcodeView:updated:ld_fullproj`, model => {

		if ( ! model.view ) return;
		
		const $el = model.view.$el;

		vc.frame_window.jQuery('[data-lqd-fullproj]', vc.frame_window.jQuery($el)).liquidFullscreenProject();
		vc.frame_window.jQuery('[data-custom-animations]', vc.frame_window.jQuery($el)).liquidCustomAnimations();
		vc.frame_window.jQuery('[data-active-onhover]', vc.frame_window.jQuery($el)).liquidSetActiveOnhover();

	});

	vc.events.on(`shortcodeView:ready:ld_imgage_overlay_text shortcodeView:updated:ld_imgage_overlay_text`, model => {

		if ( ! model.view ) return;
		
		const $el = model.view.$el;

		vc.frame_window.jQuery('[data-inview]', vc.frame_window.jQuery($el)).liquidInView();
		vc.frame_window.jQuery('[data-hover3d]', vc.frame_window.jQuery($el)).liquidHover3d();
		vc.frame_window.jQuery('[data-webglhover]', vc.frame_window.jQuery($el)).liquidWebGLHover();

	});

	vc.events.on(`shortcodeView:ready:ld_imgtxt_slider shortcodeView:updated:ld_imgtxt_slider`, model => {

		if ( ! model.view ) return;
		
		const $el = model.view.$el;

		vc.frame_window.jQuery('[data-custom-animations]', vc.frame_window.jQuery($el)).liquidCustomAnimations();

	});

	vc.events.on(`shortcodeView:ready:ld_image_trail shortcodeView:updated:ld_image_trail`, model => {

		if ( ! model.view ) return;
		
		const $el = model.view.$el;

		vc.frame_window.jQuery('[data-lqd-img-trail]', vc.frame_window.jQuery($el)).liquidImageTrail();

	});

	vc.events.on(`shortcodeView:ready:ld_masked_image shortcodeView:updated:ld_masked_image`, model => {

		if ( ! model.view ) return;
		
		const $el = model.view.$el;

		vc.frame_window.jQuery('[data-dynamic-shape]', vc.frame_window.jQuery($el)).liquidDynamicShape();

	});

	vc.events.on(`shortcodeView:ready:ld_progressbar shortcodeView:updated:ld_progressbar`, model => {

		if ( ! model.view ) return;
		
		const $el = model.view.$el;

		vc.frame_window.jQuery('[data-progressbar]', vc.frame_window.jQuery($el)).liquidProgressbar();

	});

	vc.events.on(`shortcodeView:ready:ld_promo shortcodeView:updated:ld_promo`, model => {

		if ( ! model.view ) return;
		
		const $el = model.view.$el;

		vc.frame_window.jQuery('[data-split-text]', vc.frame_window.jQuery($el)).liquidSplitText()
		vc.frame_window.jQuery('[data-dynamic-shape]', vc.frame_window.jQuery($el)).liquidDynamicShape();
		vc.frame_window.jQuery('[data-custom-animations]', vc.frame_window.jQuery($el)).liquidCustomAnimations();
		vc.frame_window.jQuery('[data-reveal]', vc.frame_window.jQuery($el)).liquidReveal();

	});

	vc.events.on(`shortcodeView:ready:ld_shop_banner shortcodeView:updated:ld_shop_banner`, model => {

		if ( ! model.view ) return;
		
		const $el = model.view.$el;

		vc.frame_window.jQuery('[data-hover3d]', vc.frame_window.jQuery($el)).liquidHover3d();

	});

	vc.events.on(`shortcodeView:ready:ld_slideshow shortcodeView:updated:ld_slideshow`, model => {

		if ( ! model.view ) return;
		
		const $el = model.view.$el;

		vc.frame_window.jQuery('[data-fittext]', vc.frame_window.jQuery($el)).liquidFitText();
		vc.frame_window.jQuery('[data-split-text]', vc.frame_window.jQuery($el)).liquidSplitText()
		vc.frame_window.jQuery('[data-lqd-flickity]', vc.frame_window.jQuery($el)).liquidCarousel({bypassCheck: true});
		vc.frame_window.jQuery('[data-custom-animations]', vc.frame_window.jQuery($el)).liquidCustomAnimations();

	});

	vc.events.on(`shortcodeView:ready:ld_team_member shortcodeView:updated:ld_team_member`, model => {

		if ( ! model.view ) return;
		
		const $el = model.view.$el;

		vc.frame_window.jQuery('[data-custom-animations]', vc.frame_window.jQuery($el)).liquidCustomAnimations();
		vc.frame_window.jQuery('[data-reveal]', vc.frame_window.jQuery($el)).liquidReveal();

	});

	vc.events.on(`shortcodeView:ready:ld_team_members_circular shortcodeView:updated:ld_team_members_circular`, model => {

		if ( ! model.view ) return;
		
		const $el = model.view.$el;

		vc.frame_window.jQuery('[data-custom-animations]', vc.frame_window.jQuery($el)).liquidCustomAnimations();

	});

	vc.events.on(`shortcodeView:ready:ld_woo_products_list shortcodeView:updated:ld_woo_products_list`, model => {

		if ( ! model.view ) return;
		
		const $el = model.view.$el;

		vc.frame_window.jQuery('[data-liquid-masonry]', vc.frame_window.jQuery($el)).liquidMasonry({bypassCheck: true});
		vc.frame_window.jQuery('[data-lqd-flickity]', vc.frame_window.jQuery($el)).liquidCarousel({bypassCheck: true});

	});

	vc.events.on(`shortcodeView:ready:ld_images_comparison shortcodeView:updated:ld_images_comparison`, model => {

		if ( ! model.view ) return;
		
		const $el = model.view.$el;

		vc.frame_window.jQuery('.cd-image-container', vc.frame_window.jQuery($el)).liquidImageComparison();

	});

	vc.events.on(`shortcodeView:ready:ld_countdown shortcodeView:updated:ld_countdown`, model => {

		if ( ! model.view ) return;
		
		const $el = model.view.$el;

		vc.frame_window.jQuery('[data-plugin-countdown=true]', vc.frame_window.jQuery($el)).liquidCountdown();

	});

	vc.events.on(`shortcodeView:ready:ld_counter shortcodeView:updated:ld_counter`, model => {

		if ( ! model.view ) return;
		
		const $el = model.view.$el;

		vc.frame_window.jQuery('[data-enable-counter]', vc.frame_window.jQuery($el)).liquidCounter();

	});
	
})(window.jQuery);

(function( $ ) {
	'use strict';

	vc.events.on("app.render", function() {

		if ( vc.frame_window.jQuery('#lqd-site-content[data-liquid-stack]').length ) {

			vc.frame_window.jQuery('#lqd-site-content[data-liquid-stack]').liquidStack({
				sectionSelector: '#lqd-contents-wrap > .vc_vc_row'
			});

		}

	})

})( window.jQuery );

(function( $ ) {
	'use strict';
	window.InlineShortcodeView_vc_accordion = window.InlineShortcodeViewContainer.extend( {
		events: {},
		childTag: 'vc_accordion_tab',
		defaultSectionTitle: window.i18nLocale.section,
		initialize: function() {
			_.bindAll( this, 'buildSortable', 'updateSorting' );
			window.InlineShortcodeView_vc_accordion.__super__.initialize.call(this);
		},
		render: function() {
			this.$accordion = this.$el.find('.accordion');
			window.InlineShortcodeView_vc_accordion.__super__.render.call(this);
			_.bindAll(this, 'buildAccordion');
			this.content();
			this.content().removeClass('vc_element-container');
			this.buildAccordion();
			return this;
		},
		content: function() {
			if ( ! this.$content ) {
				this.$content = this.$accordion;
				// this.$el.find('.vc_container-anchor:first').remove();
			}
			return this.$content;
		},
		addControls: function() {
			this.$controls = $('<div class="no-controls"></div>');
			this.$controls.appendTo(this.$el);
			return this;
		},
		addElement: function(e) {
			e && e.preventDefault();
			this.addSection('parent.prepend' === $(e.currentTarget).data('vcControl'));
		},
		appendElement: function(e) {
			return this.addElement(e);
		},
		prependElement: function(e) {
			return this.addElement(e);
		},
		addSection: function( prepend ) {
			
			let shortcode = this.childTag;
			const params = {
				shortcode: shortcode,
				parent_id: this.model.get( 'id' ),
				isActiveSection: true,
				params: {
					title: this.defaultSectionTitle
				}
			};
			if (prepend) {
				vc.activity = 'prepend';
				params.order = this.getSiblingsFirstPositionIndex();
			}
			vc.builder.create(params);
			for (let i = vc.builder.models.length - 1; i >= 0; i --) {
				shortcode = vc.builder.models[i].get('shortcode');
			}
			vc.builder.render();
		},
		buildAccordion: function() {
			vc.frame_window.vc_iframe.addActivity(() => {
				vc.frame_window.jQuery(this.$accordion).liquidAccordion();
			});
		},
		getSiblingsFirstPositionIndex: function() {
			let order = 0;
			const shortcodeFirst = vc.shortcodes.sort().findWhere({parent_id: this.model.get('id')});
			if ( shortcodeFirst ) {
				order = shortcodeFirst.get('order') - 1;
			}
			return order;
		},
		changed: function() {
			window.InlineShortcodeView_vc_accordion.__super__.changed.call(this);
			_.defer( this.buildSortable );
		},
		updated: function() {
			window.InlineShortcodeView_vc_accordion.__super__.updated.call(this);
			_.defer( this.buildSortable );
		},
		buildSortable: function() {
			if ( ! vc_user_access().shortcodeEdit( this.model.get( 'shortcode' ) ) ) {
				return
			}
			if ( this.$el ) {
				this.$el.find('.accordion').sortable({
					forcePlaceholderSize: true,
					placeholder: 'vc_placeholder-row',
					start: this.startSorting,
					over: function(event, ui) {
						ui.placeholder.css( { maxWidth: ui.placeholder.parent().width() } );
						ui.placeholder.removeClass( 'vc_hidden-placeholder' );
					},
					items: '.vc_vc_accordion_tab',
					handle: '.accordion-title, .vc_child-element-move',
					update: this.updateSorting
				});
			}
		},
		startSorting: function(event, ui) {
			ui.placeholder.width( ui.item.width() );
		},
		updateSorting: function(event, ui) {
			this.getPanelsList().each((i, item) => {
				const $this = $(item);
				const modelId = $this.parent().data('modelId');
				const shortcode = vc.shortcodes.get(modelId);
				shortcode.save({ 'order': this.getIndex($this)}, {silent: true});
			} );
		},
		getIndex: function( $element ) {
			return $element.index();
		},
		getPanelsList: function() {
			return this.$accordion.find('.accordion-item');
		},
	} );
})( window.jQuery );

(function( $ ) {
	'use strict';
	window.InlineShortcodeView_vc_accordion_tab = window.InlineShortcodeViewContainerWithParent.extend( {
		controls_selector: '#vc_controls-template-vc_tta_section',
		events: {
			'click > .vc_controls .vc_element .vc_control-btn-delete': 'destroy',
			'click > .vc_controls .vc_element .vc_control-btn-edit': 'edit',
			'click > .vc_controls .vc_element .vc_control-btn-clone': 'clone',
			'click > .vc_controls .vc_element .vc_control-btn-prepend': 'prependElement',
			'click > .vc_controls .vc_control-btn-append': 'appendElement',
			'click > .vc_controls .vc_parent .vc_control-btn-delete': 'destroyParent',
			'click > .vc_controls .vc_parent .vc_control-btn-edit': 'editParent',
			'click > .vc_controls .vc_parent .vc_control-btn-clone': 'cloneParent',
			'click > .vc_controls .vc_parent .vc_control-btn-prepend': 'addSibling',
			'click .accordion-content > [data-js-panel-body].vc_empty-element': 'appendElement',
			'click > .vc_controls .vc_control-btn-switcher': 'switchControls',
			'mouseenter': 'resetActive',
			'mouseleave': 'holdActive'
		},
		render: function() {
			window.InlineShortcodeView_vc_accordion_tab.__super__.render.call(this);
			this.$collapse = vc.frame_window.jQuery(this.$el.find('.accordion-collapse'));
			this.$parent = vc.frame_window.jQuery(this.parent_view.$accordion);
			_.bindAll(this, 'initAccordion', 'activeAccordion', 'addExpanderIcons');
			_.defer( this.initAccordion );
			_.defer( this.activeAccordion );
			_.defer( this.addExpanderIcons );
			return this;
		},
		changed: function() {
			if ( this.allowAddControlOnEmpty() && ! this.$el.find('.vc_element[data-tag]').length ) {
				this.$el.addClass('vc_empty');
				this.content().addClass('vc_empty-element');
			} else {
				this.$el.removeClass('vc_empty');
				this.content().removeClass('vc_empty-element');
			}
		},
		destroy: function(e) {
			var parent_id = this.model.get('parent_id');
			window.InlineShortcodeView_vc_accordion_tab.__super__.destroy.call(this, e);
			if ( ! vc.shortcodes.where({parent_id: parent_id}).length ) {
				vc.shortcodes.get(parent_id).destroy();
			}
		},
		allowAddControl: function() {
			return vc_user_access().shortcodeAll('vc_accordion_tab');
		},
		addExpanderIcons: function() {
			const parentModel = window.vc.shortcodes.get(this.model.get('parent_id'));
			const $link = this.$el.find('[data-toggle=collapse]');
			let $expander = $link.children('.accordion-expander');
			let $idleIcon = $expander.find('i:first');
			let $activeIcon = $expander.find('i:last');
			let idleIconClass;
			let activeIconClass;

			switch (parentModel.get('params').i_type) {
				case 'fontawesome':
					idleIconClass = parentModel.get('params')['i_icon_fontawesome'];
					break;
				case 'linea':
					idleIconClass = parentModel.get('params')['i_icon_linea'];
					break;
				default:
					idleIconClass = '';
					break;
			};
			switch (parentModel.get('params').active_type) {
				case 'fontawesome':
					activeIconClass = parentModel.get('params')['active_icon_fontawesome'];
					break;
				case 'linea':
					activeIconClass = parentModel.get('params')['active_icon_linea'];
					break;
				default:
					activeIconClass = '';
					break;
			};

			if ( ! $expander.length ) {
				$expander = $(`<span class="accordion-expander" />`);
			}

			if ( idleIconClass !== '' ) {
				$expander.length && $idleIcon.length ? $idleIcon.attr('class', idleIconClass) : $expander.append(`<i class="${idleIconClass}" />`);
			}
			if ( activeIconClass !== '' ) {
				$expander.length && $activeIcon.length ? $activeIcon.attr('class', activeIconClass) : $expander.append(`<i class="${activeIconClass}" />`);
			}

			! $link.children('.accordion-expander').length && $link.append($expander);

		},
		initAccordion: function() {
			this.$collapse.on('show.bs.collapse hide.bs.collapse', ev => {
				this.model.set('isActiveSection', ev.type === 'show');
			})
		},
		activeAccordion: function() {
			const tabId = this.model.getParam('tab_id');
			const $collapse = window.vc.frame_window.jQuery(`#${tabId}`);
			if ( this.model.get('isActiveSection') ) {
				$collapse.collapse('show');
			} else {
				$collapse.collapse('hide');
			}
		},
		parentChanged: function() {
			window.InlineShortcodeView_vc_accordion_tab.__super__.parentChanged.call(this);
			_.defer( this.addExpanderIcons );
			return this;
		}
	} );

	function lqdMapChildEvents( model ) {
		var child_tag = 'vc_accordion_tab';
		window.vc.events.on(`shortcodes:${child_tag}:add:parent:${model.get('id')}`, model => {
			const parent_model = window.vc.shortcodes.get( model.get( 'parent_id' ) );
			const activeTabParam = parent_model.getParam('active_tab');
			const active_tab_index = activeTabParam === '' ? 1 : activeTabParam;
			const models = _.pluck(
				_.sortBy( window.vc.shortcodes.where({parent_id: parent_model.get('id')}), model => model.get('order') ),
				'id'
			);
			if ( models.indexOf( model.get('id') ) === active_tab_index - 1 ) {
				model.set('isActiveSection', true);
			}
			return model;
		});
		window.vc.events.on(`shortcodes:${child_tag}:clone:parent:${model.get('id')}`, model => {
			if ( window.vc.lqdSectionActiveOnClone ) {
				model.set('isActiveSection', true);
			}
			window.vc.lqdSectionActiveOnClone = false;
		});
	}

	window.vc.events.on( 'shortcodes:vc_accordion:add', lqdMapChildEvents );

})( window.jQuery );

(function($) {
	'use strict';

	window.InlineShortcodeView_ld_carousel_tab = window.InlineShortcodeViewContainer.extend({
		childTag: 'ld_carousel_section',
		$carouselNavElement: null,
		events: {
			'click > .vc_controls .vc_control-btn-delete': 'destroy',
			'click > .vc_controls .vc_control-btn-edit': 'edit',
			'click > .vc_controls .vc_control-btn-clone': 'clone',
			'click > .vc_controls .vc_control-btn-append': 'appendElement',
			'click > .vc_controls .vc_control-btn-prepend': 'prependElement',
			'click > .vc_controls .vc_control-btn-layout': 'changeLayout',
			'click > .vc_controls .vc_control-btn-control-slide': 'changeSlide',
			'click > .vc_controls .vc_control-btn-control-playpause': 'controlPlayPause',
			'click > .vc_controls .vc_control-btn-switcher': 'switchControls',
		},
		initialize: function() {
			_.bindAll(this, 'buildSortable', 'updateSorting', 'togglePlayPauseBtn');
			window.InlineShortcodeView_ld_carousel_tab.__super__.initialize.call(this);
		},
		render: function() {
			window.InlineShortcodeView_ld_carousel_tab.__super__.render.call(this);
			_.bindAll(this, 'initCarousel', 'appendToCarousel', 'repositionCarousel', 'resizeCarousel', 'removeCell', 'getPluginData', 'changeSlide');
			this.$carouselEl = vc.frame_window.jQuery(this.$el).find('[data-lqd-flickity]');
			window.vc.frame_window.vc_iframe.addActivity(this.initCarousel);
			return this;
		},
		content: function() {
			if ( ! this.$content ) {
				this.$content = this.$el.find('[data-lqd-flickity]');
				this.$el.find('.vc_container-anchor:first').remove();
			} else if ( this.$content.find('.flickity-slider').length ) {
				this.$content.removeClass('vc_element-container');
				this.$content = this.$content.find('.flickity-slider').addClass('vc_element-container');
			}
			return this.$content;
		},
		addControls: function() {
			window.InlineShortcodeView_ld_carousel_tab.__super__.addControls.call( this );
			if ( ! this.$carouselControls ) {
				const $prevBtn = $('<a class="vc_control-btn vc_control-btn-control-slide" href="#" title="Previous Slide" data-vc-control="previous" target="_blank"><span class="vc_btn-content"><i class="la la-arrow-left"></i></span></a>');
				const $nextBtn = $('<a class="vc_control-btn vc_control-btn-control-slide" href="#" title="Next Slide" data-vc-control="next" target="_blank"><span class="vc_btn-content"><i class="la la-arrow-right"></i></span></a>');
				const $playPauseBtn = $('<a class="vc_control-btn vc_control-btn-control-playpause" href="#" title="Play/Pause" data-vc-control="play-pause" target="_blank"><span class="vc_btn-content"><i class="la la-play"></i><i class="la la-pause"></i></span></a>');
				this.$carouselControls = $(`<div class="vc_controls-element vc_controls vc_controls-carousel"><div class="vc_controls-out-tc"></div></div>`);
				this.$carouselControls.appendTo(this.$el);
				this.$carouselControls.children().append([$prevBtn, $nextBtn, $playPauseBtn]);
			}
			return this;
		},
		addElement: function(e) {
			if (e && e.preventDefault ) {
				e.preventDefault();
			};
			vc.builder.create({
				shortcode: this.childTag,
				parent_id: this.model.get('id'),
				params: {
					title: window.i18nLocale.section
				}
			}).render();
		},
		parentChanged: function() {
			window.InlineShortcodeView_ld_carousel_tab.__super__.parentChanged.call( this );
			_.defer( this.repositionCarousel );
		},
		changed: function() {
			window.InlineShortcodeView_ld_carousel_tab.__super__.changed.call( this );
			_.defer( this.buildSortable );
			_.defer( this.togglePlayPauseBtn );
		},
		beforeUpdate: function() {
			window.InlineShortcodeView_ld_carousel_tab.__super__.beforeUpdate.call( this );
			vc.frame_window.jQuery(this.getPluginData().carouselNavElement).remove();
		},
		updated: function() {
			window.InlineShortcodeView_ld_carousel_tab.__super__.updated.call( this );
			_.defer( this.repositionCarousel );
			_.defer( this.buildSortable );
			_.defer( this.togglePlayPauseBtn );
		},
		buildSortable: function() {
			if ( ! vc_user_access().shortcodeEdit(this.model.get('shortcode')) ) {
				return;
			}
			if ( this.$el ) {
				this.$el.find('.carousel-items').sortable( {
					items: '.carousel-item',
					handle: '.element-ld_carousel_section .vc_element-move, .element-ld_carousel_marquee_section .vc_element-move',
					tolerance: "pointer",
					placeholder: 'carousel-item',
					start: this.startSorting.bind(this),
					update: this.updateSorting.bind(this),
					stop: this.stopSorting.bind(this),
				} );
			}
		},
		startSorting: function(event, ui) {
			this.$el.addClass('lqd-carousel-sorting');
			ui.placeholder.addClass('lqd-carousel-item-dragging');
			ui.item.addClass('lqd-carousel-item-dragging hidden');
			this.$el.find('.carousel-items').sortable('refreshPositions');
		},
		updateSorting: function(event, ui) {
			const childModels = vc.shortcodes.where({parent_id: this.model.get('id')});
			childModels.forEach((childModel, index) => {
				const {id, view} = childModel;
				const shortcode = vc.shortcodes.get(id);
				shortcode.save({'order': view.$el.index()}, { silent: true });
			});
		},
		stopSorting: function(event, ui) {
			this.$el.removeClass('lqd-carousel-sorting');
			ui.placeholder.removeClass('lqd-carousel-item-dragging');
			ui.item.removeClass('lqd-carousel-item-dragging hidden');
			this.repositionCarousel();
		},
		initCarousel: function() {
			if ( ! this.getPluginData() ) {
				this.$carouselEl.liquidCarousel({bypassCheck: true, draggable: false});
			}
		},
		appendToCarousel: function($el) {
			const pluginData = this.getPluginData();
			if ( pluginData && pluginData.flickityData && $el ) {
				pluginData.flickityData.append($el, true)
			}
		},
		repositionCarousel: function() {
			const pluginData = this.getPluginData();
			if ( pluginData && pluginData.flickityData ) {
				const {flickityData} = pluginData;
				flickityData.reloadCells();
				flickityData.reposition();
			};
		},
		resizeCarousel: function() {
			const pluginData = this.getPluginData();
			if ( pluginData && pluginData.flickityData ) {
				const {flickityData} = pluginData;
				flickityData.resize();
			};
		},
		removeCell: function($el) {
			if ( ! $el ) return;
			const pluginData = this.getPluginData();
			if ( ! pluginData ) return;
			if ( pluginData.flickityData ) {
				const {flickityData} = pluginData;
				flickityData.remove($el);
			};
		},
		getPluginData: function() {
			return this.$carouselEl.data('plugin_liquidCarousel');
		},
		togglePlayPauseBtn: function() {
			const autoplay = this.model.getParam('autoplay');
			const isMarquee = vc.shortcodes.get(this.model.get('id')).get('shortcode') === 'ld_carousel_marquee_tab';
			if ( autoplay === 'yes' || isMarquee ) {
				this.$carouselControls.removeClass('playpause-hide');
			} else if ( autoplay === '' ) {
				this.$carouselControls.addClass('playpause-hide');
			}
		},
		changeSlide: function(e) {
			e && e.preventDefault && e.preventDefault();
			const $btn = $(e.currentTarget);
			const control = $btn.attr('data-vc-control');
			const pluginData = this.getPluginData();
			if ( ! pluginData || ! control ) return;
			if ( pluginData.flickityData ) {
				const {flickityData} = pluginData;
				flickityData[control]();
			};
		},
		controlPlayPause: function(e) {
			e && e.preventDefault && e.preventDefault();
			const pluginData = this.getPluginData();
			if ( ! pluginData ) return;
			if ( pluginData.flickityData ) {
				if ( pluginData.options.marquee ) {
					const isPaused = pluginData.marqueeIsPaused;
					isPaused ? pluginData.marqueePlay() : pluginData.marqueePause();
				} else {
					pluginData.flickityData.player.state === 'playing' ? pluginData.flickityData.pausePlayer() : pluginData.flickityData.playPlayer();
				}
			};
		},
		destroy: function(e) {
			e && e.preventDefault && e.preventDefault();
			vc.frame_window.jQuery(this.getPluginData().carouselNavElement).remove();
			window.InlineShortcodeView_ld_carousel_tab.__super__.destroy.call( this );
		},
	});

	window.InlineShortcodeView_ld_carousel_marquee_tab = window.InlineShortcodeView_ld_carousel_tab.extend({

	});

})( window.jQuery );


(function ( $ ) {
	'use strict';

	window.InlineShortcodeView_ld_carousel_section = window.InlineShortcodeViewContainerWithParent.extend({
		events: {
			'click > .vc_controls .vc_control-btn-delete': 'destroy',
			'click > .vc_controls .vc_control-btn-edit': 'edit',
			'click > .vc_controls .vc_control-btn-clone': 'clone',
			'click > .vc_controls .vc_control-btn-prepend': 'prependElement',
			'click > .vc_controls .vc_control-btn-append': 'appendElement',
			'click > .vc_empty-element': 'appendElement',
			'click > .vc_controls .vc_control-btn-switcher': 'switchControls',
			'mouseenter': 'resetActive',
			'mouseleave': 'holdActive'
		},
		controls_selector: '#vc_controls-template-container-in',
		render: function() {
			window.InlineShortcodeView_ld_carousel_section.__super__.render.call(this);
			this.$el.addClass('carousel-item has-one-child');
			if ( ! this.$el.children('.carousel-item-inner').children('.carousel-item-content').length ) {
				this.$el.children('.carousel-item-inner').wrapInner('<div class="carousel-item-content" />');
			}
			_.bindAll(this, 'appendSection');
			this.appendSection();
			return this;
		},
		allowAddControl: function() {
			return vc_user_access().shortcodeAll('ld_carousel_section');
		},
		destroy: function(e) {
			e && e.preventDefault && e.preventDefault();
			const parentModel = vc.shortcodes.get(this.model.get('parent_id'))
			if ( parentModel.view ) {
				parentModel.view.removeCell(this.$el);
			}
			window.InlineShortcodeView_ld_carousel_section.__super__.destroy.call(this);
		},
		changed: function() {
			window.InlineShortcodeView_ld_carousel_section.__super__.changed.call(this);
			_.defer(() => {
				const parentModel = vc.shortcodes.get(this.model.get('parent_id'))
				if ( parentModel.view ) {
					parentModel.view.resizeCarousel();
				}
			})
		},
		appendSection: function() {
			const parentModel = vc.shortcodes.get(this.model.get('parent_id'))
			if ( parentModel.view ) {
				parentModel.view.appendToCarousel(this.$el);
				parentModel.view.repositionCarousel();
			}
		}
	});

	window.InlineShortcodeView_ld_carousel_marquee_section = window.InlineShortcodeView_ld_carousel_section.extend({

	});

})( window.jQuery );


(function ($) {
	'use strict';
	window.InlineShortcodeView_ld_custom_menu = window.InlineShortcodeView.extend({
		initialize: function() {
			window.InlineShortcodeView_ld_particles.__super__.initialize.call(this);
			_.bindAll(this, 'setID', 'checkAndRemoveExisting', 'addPlaceholder');
		},
		render: function() {
			window.InlineShortcodeView_ld_custom_menu.__super__.render.call(this);
			this.setID();
			this.addPlaceholder();
			vc.frame_window.vc_iframe.addActivity(() => {
				vc.frame_window.jQuery('[data-pin=true]', vc.frame_window.jQuery(this.el)).liquidPin();
				vc.frame_window.jQuery('[data-move-element]', vc.frame_window.jQuery(this.el)).liquidMoveElement();
				vc.frame_window.jQuery('[data-localscroll]', vc.frame_window.jQuery(this.el)).liquidLocalScroll();
				vc.frame_window.jQuery('[data-inview]', vc.frame_window.jQuery(this.el)).liquidInView();
			});
			return this;
		},
		beforeUpdate: function() {
			window.InlineShortcodeView_ld_particles.__super__.beforeUpdate.call(this);
			this.checkAndRemoveExisting();
		},
		updated: function() {
			this.addPlaceholder();
		},
		addPlaceholder: function() {
			if ( this.model.getParam('sticky') === 'yes' ) {
				this.$el.addClass('lqd-fe-show-placeholder');
			} else {
				this.$el.removeClass('lqd-fe-show-placeholder');
			}
		},
		setID: function() {
			this.$el.children('.lqd-fancy-menu').attr('data-id', `lqd-fm-${this.model.get('id')}`);
		},
		checkAndRemoveExisting: function() {
			const $existingEl = this.$el.closest('.vc_row').children('.pin-spacer');
			if ( $existingEl.length && $existingEl.find(`[data-id="lqd-fm-${this.model.get('id')}"]`).length ) {
				$existingEl.remove();
			}
		},
		destroy(e) {
			e && e.preventDefault && e.preventDefault();
			e && e.stopPropagation && e.stopPropagation();
			this.checkAndRemoveExisting();
			window.InlineShortcodeView_ld_particles.__super__.destroy.call(this);
		},
	});
})(window.jQuery);

(function ($) {
	'use strict';
	window.InlineShortcodeView_ld_images_group_container = window.InlineShortcodeViewContainer.extend({
		childTag: 'ld_images_group_element',
		initialize: function() {
			window.InlineShortcodeView_ld_particles.__super__.initialize.call(this);
			_.bindAll(this, 'setID', 'checkAndRemoveExisting', 'addPlaceholder');
		},
		render: function() {
			// _.bindAll(this, 'buildSortable', 'updateSorting');
			window.InlineShortcodeView_ld_images_group_container.__super__.render.call(this);
			this.setID();
			this.addPlaceholder();
			this.content().removeClass('vc_element-container');
			vc.frame_window.vc_iframe.addActivity(() => {
				vc.frame_window.jQuery('[data-parallax]', vc.frame_window.jQuery(this.$el)).liquidParallax();
				vc.frame_window.jQuery('[data-custom-animations]', vc.frame_window.jQuery(this.$el)).liquidCustomAnimations();
				vc.frame_window.jQuery('[data-move-element]', vc.frame_window.jQuery(this.$el)).liquidMoveElement();
			});
			return this;
		},
		addControls: function() {
			this.$controls = $( '<div class="no-controls"></div>' );
			this.$controls.appendTo(this.$el);
			return this;
		},
		changed: function() {
			window.InlineShortcodeView_ld_images_group_container.__super__.changed.call(this);
			// _.defer(this.buildSortable);
		},
		updated: function() {
			window.InlineShortcodeView_ld_images_group_container.__super__.updated.call(this);
			this.addPlaceholder();
			// _.defer(this.buildSortable);
		},
		beforeUpdate: function() {
			window.InlineShortcodeView_ld_particles.__super__.beforeUpdate.call(this);
			this.checkAndRemoveExisting();
		},
		addElement: function(e) {
			if ( e && e.preventDefault ) {
				e.preventDefault();
			}
			vc.builder.create({
				shortcode: this.childTag,
				parent_id: this.model.get('id'),
			}).render();
		},
		addPlaceholder: function() {
			if ( this.model.getParam('move_to_parent_row') === 'yes' ) {
				this.$el.addClass('lqd-fe-show-placeholder');
			} else {
				this.$el.removeClass('lqd-fe-show-placeholder');
			}
		},
		setID: function() {
			this.$el.children('.lqd-imggrp-container').attr('data-id', `lqd-fi-${this.model.get('id')}`);
		},
		buildSortable: function() {
			vc_user_access().shortcodeEdit(this.model.get("shortcode")) && this.$el && this.$el.find(".lqd-imggrp-inner").sortable({
				forcePlaceholderSize: !0,
				placeholder: "vc_placeholder-row",
				start: this.startSorting,
				over: function(event, ui) {
					ui.placeholder.css({
						maxWidth: ui.placeholder.parent().width()
					}), ui.placeholder.removeClass("vc_hidden-placeholder")
				},
				items: "> .vc_element",
				handle: ".vc_element .vc_element-move",
				update: this.updateSorting
			})
		},
		startSorting: function(event, ui) {
			ui.placeholder.width(ui.item.width())
		},
		updateSorting: function(event, ui) {
			this.$el.find('.lqd-imggrp-inner').find("> .vc_element").each(function() {
				const $this = $(this);
				const model_id = $this.data("modelId");
				vc.shortcodes.get(model_id).save({
					order: $this.index()
				}, {
					silent: !0
				})
			});
		},
		checkAndRemoveExisting: function() {
			const $existingEl = this.$el.closest('.vc_row').children(`[data-id="lqd-fi-${this.model.get('id')}"]`);
			if ( $existingEl.length ) {
				$existingEl.remove();
			}
		},
		destroy(e) {
			e && e.preventDefault && e.preventDefault();
			e && e.stopPropagation && e.stopPropagation();
			this.checkAndRemoveExisting();
			window.InlineShortcodeView_ld_particles.__super__.destroy.call(this);
		},
	});
})(window.jQuery);

(function ($) {
	'use strict';
	window.InlineShortcodeView_ld_images_group_element = window.InlineShortcodeViewContainerWithParent.extend({
		events: {
			'click .lqd-imggrp-single > .vc_controls .vc_element .vc_control-btn-delete': 'destroy',
			'click .lqd-imggrp-single > .vc_controls .vc_element .vc_control-btn-edit': 'edit',
			'click .lqd-imggrp-single > .vc_controls .vc_element .vc_control-btn-clone': 'clone',
			'click .lqd-imggrp-single > .vc_controls .vc_element .vc_control-btn-prepend': 'prependElement',
			'click .lqd-imggrp-single > .vc_controls .vc_control-btn-append': 'appendElement',
			'click .lqd-imggrp-single > .vc_controls .vc_parent .vc_control-btn-delete': 'destroyParent',
			'click .lqd-imggrp-single > .vc_controls .vc_parent .vc_control-btn-edit': 'editParent',
			'click .lqd-imggrp-single > .vc_controls .vc_parent .vc_control-btn-clone': 'cloneParent',
			'click .lqd-imggrp-single > .vc_controls .vc_parent .vc_control-btn-prepend': 'addSibling',
			'click .lqd-imggrp-single > .vc_controls .vc_parent .vc_control-btn-layout': 'changeLayout',
			'click > .vc_empty-element > .lqd-imggrp-img-container': 'appendElement',
			'click .lqd-imggrp-single > .vc_controls .vc_control-btn-switcher': 'switchControls'
		},
		render: function() {
			window.InlineShortcodeView_ld_images_group_element.__super__.render.call(this);
			vc.frame_window.vc_iframe.addActivity(() => {
				vc.frame_window.jQuery('[data-parallax]', vc.frame_window.jQuery(this.$el)).liquidParallax();
				vc.frame_window.jQuery('[data-inview]', vc.frame_window.jQuery(this.$el)).liquidInView();
				vc.frame_window.jQuery('[data-hover3d]', vc.frame_window.jQuery(this.$el)).liquidHover3d();
				vc.frame_window.jQuery('[data-reveal]', vc.frame_window.jQuery(this.$el)).liquidReveal();
			});
			return this;
		},
		updated: function() {
			window.InlineShortcodeView_ld_images_group_element.__super__.updated.call(this);
			if ( this.model.getParam('image') !== '' ) {
				this.$el.children().removeClass('vc_empty-element');
			} else {
				this.$el.children().addClass('vc_empty-element');
			}
		},
		changed: function() {
			window.InlineShortcodeView_ld_images_group_element.__super__.changed.call(this);
			if ( this.model.getParam('image') !== '' ) {
				this.$el.children().removeClass('vc_empty-element');
			} else {
				this.$el.children().addClass('vc_empty-element');
			}
		},
		addControls: function() {
			window.InlineShortcodeView_ld_images_group_element.__super__.addControls.call(this);
			this.$controls.appendTo(this.$el.find('.lqd-imggrp-single'));
		},
		destroy: function(e) {
			const parentId = this.model.get('parent_id');
			window.InlineShortcodeView_ld_images_group_element.__super__.destroy.call(this, e);
			const parentModel = vc.shortcodes.get(parentId);
			if ( !vc.shortcodes.where({ parent_id: parentId }).length && parentModel.get('shortcode') === 'ld_images_group_container' ) {
				parentModel.destroy();
			}
		},
	});
})(window.jQuery);

(function ($) {

	vc.events.on('shortcodeView:ready shortcodeView:updated', () => {
		
		if ( vc.frame_window.liquidLazyload ) {
			vc.frame_window.liquidLazyload.update();
		}

	});

	vc.events.on(
		`shortcodeView:ready:vc_row shortcodeView:updated:vc_row shortcodeView:ready:vc_row_inner shortcodeView:updated:vc_row_inner
		shortcodeView:ready:vc_column shortcodeView:updated:vc_column shortcodeView:ready:vc_column_inner shortcodeView:updated:vc_column_inner`,
		model =>
	{

		if ( ! model.view ) return;
		
		const $el = model.view.$el;
		
		$('[data-row-bg]:not([data-slideshow-bg])', vc.frame_window.jQuery($el)).liquidRowBG();

	});

})(window.jQuery);

(function($) {
	'use strict';

	window.InlineShortcodeView_ld_tabs = window.InlineShortcodeViewContainer.extend( {
		defaultSectionTitle: window.i18nLocale.tab,
		childTag: 'ld_tab_section',
		events: {},
		render: function() {
			window.InlineShortcodeView_ld_tabs.__super__.render.call(this);
			_.bindAll( this, 'createTabs', 'sectionUpdated', 'buildSortableNavigation', 'updateSortingNavigation', 'removeLiStyles', 'updatePanelsPositions', 'initTabs' );
			this.createTabs();
			_.defer(this.buildSortableNavigation);
			this.initTabs();
			this.content().removeClass('vc_element-container');
			return this;
		},
		addControls: function() {
			this.$controls = $( '<div class="no-controls"></div>' );
			this.$controls.appendTo(this.$el);
			return this;
		},
		content: function () {
			if ( ! this.$content ) {
				this.$content = this.$el.find('.lqd-tabs-content');
				this.$el.find('.vc_container-anchor:first').remove();
			}
			return this.$content;
		},
		addElement: function(e) {
			if ( e && e.preventDefault ) {
				e.preventDefault();
			}
			vc.builder.create({
				shortcode: this.childTag,
				parent_id: this.model.get('id'),
				params: {
					title: window.i18nLocale.tab
				}
			}).render();
		},
		changed: function () {
			if ( this.allowAddControlOnEmpty() ) {
				if ( ! this.$el.find( '.vc_element[data-tag]' ).length ) {
					this.$el.addClass('vc_empty').find('.lqd-tabs-content').addClass('vc_empty-element');
				} else {
					this.$el.removeClass('vc_empty').find('.lqd-tabs-content').removeClass('vc_empty-element');
				}
			}
		},
		createTabs: function() {
			var models = _.sortBy(
				vc.shortcodes.where({ parent_id: this.model.get('id') }),
				model => model.get( 'order' )
			);
			_.each( models, model => {this.sectionUpdated( model, true )}, this );
		},
		sectionUpdated: function(model, justAppend) {

			const tabStyle = this.model.getParam('style');
			const sectionId = model.get('id');

			const $navigation = this.$el.find('.lqd-tabs-nav');
			const tabPaneId = model.getParam('tab_id');
			const title = model.getParam( 'title' );
			const description = model.getParam('desc');
			const $tabEl = $navigation.find(`[data-controls=${tabPaneId}]`);
			const htmlTemplate = vc.frame_window.jQuery(`script[data-lqd-tab-nav-style=${tabStyle}]`).html();
			const template = _.template(htmlTemplate);
			let tabAdded = false;
			let icon;

			switch (model.get('params').i_type) {
				case 'fontawesome':
					icon = model.get('params')['i_icon_fontawesome'];
					break;
				case 'linea':
					icon = model.get('params')['i_icon_linea'];
					break;
				default:
					icon = '';
					break;
			};

			const $navLi = $(template({href: `#${tabPaneId}`, aria_controls: tabPaneId, section_id: sectionId, icon_class: icon, title, description}));
			
			if ( $tabEl.length ) {
				$tabEl.html( $navLi.children() );
			} else {
				if ( ! justAppend ) {
					const models = _.pluck(
						_.sortBy( vc.shortcodes.where({ parent_id: this.model.get('id') }), childModel => childModel.get('order') ),
						'id'
					);
					const index = models.indexOf( model.get( 'id' ) ) - 1;
					if ( index > - 1 && $navigation.find( 'li:eq(' + index + ')' ).length ) {
						$navLi.insertAfter( $navigation.find( 'li:eq(' + index + ')' ) );
						tabAdded = true;
					}
				}
				if ( !tabAdded ) {
					$navLi.appendTo($navigation);
				}
			}

			return this;

		},
		buildSortableNavigation: function() {
			if ( !vc_user_access().shortcodeEdit( this.model.get( 'shortcode' ) ) ) {
				return;
			}
			const $navigation = this.$el.find('.lqd-tabs-nav');
			$navigation.sortable( {
				items: '> li',
				forcePlaceholderSize: true,
				placeholder: 'vc_placeholder-tta-tab',
				helper: this.renderSortingHelper,
				start: function( event, ui ) {
					ui.placeholder.width( ui.item.width() );
				},
				over: function(event, ui) {
					ui.placeholder.css( { maxWidth: ui.placeholder.parent().width() } );
					ui.placeholder.removeClass( 'vc_hidden-placeholder' );
				},
				stop: this.removeLiStyles,
				update: this.updateSortingNavigation
			} );
		},
		removeLiStyles: function(event, ui) {
			ui.item.removeAttr('style');
		},
		updateSortingNavigation: function(event, ui) {
			const $tabs = this.$el.find('.lqd-tabs-nav');
			$tabs.find('> li').each((i, li) => {
				const $li = $(li);
				const modelId = this.$el.find($li.children().attr('href')).parent().data('model-id');
				const shortcode = vc.shortcodes.get( modelId );
				shortcode.save( { 'order': $li.index() }, {silent: true} );
			} );
			this.removeLiStyles(event, ui);
			this.updatePanelsPositions($tabs);
		},
		updatePanelsPositions: function($tabs) {
			const $panels = this.$el.find('.lqd-tabs-content');
			const $elements = [];
			const tabSortableData = $tabs.sortable( 'toArray', { attribute: 'data-controls' } );
			_.each( tabSortableData, function(value) {
				$elements.push( $panels.find(`#${value}`).parent());
			}, this );
			$panels.prepend($elements);
		},
		renderSortingHelper: function(event, currentItem) {
			const helper = currentItem;
			const currentItemWidth = currentItem.width() + 1;
			const currentItemHeight = currentItem.height();
			helper.width( currentItemWidth );
			helper.height( currentItemHeight );
			return helper;
		},
		getNextTab: function($viewTab) {
			const $navigationSections = this.$el.find('.lqd-tabs-nav').children();
			const lastIndex = $navigationSections.length - 1;
			const viewTabIndex = $viewTab.index();
			let $nextTab;

			if ( viewTabIndex !== lastIndex ) {
				$nextTab = $navigationSections.eq( viewTabIndex + 1 );
			} else {
				$nextTab = $navigationSections.eq( viewTabIndex - 1 );
			}

			return $nextTab;
		},
		removeSection: function(modelId) {
			const $sectionEl = vc.shortcodes.get(modelId).view.$el;
			const $tabPane = $sectionEl.children('.lqd-tabs-pane');
			const tabPaneId = $tabPane.attr('id');
			const $viewTab = this.$el.find(`[data-controls=${tabPaneId}]`);
			const tabIsActive = $viewTab.hasClass('active');
			
			if ( tabIsActive ) {
				const $nextTab = this.getNextTab($viewTab);
				vc.frame_window.jQuery($nextTab).find('a').trigger('click');
			}

			$viewTab.remove();
		},
		initTabs: function() {
			window.vc.frame_window.vc_iframe.addActivity(() => {
				vc.frame_window.jQuery(this.$el.find('.lqd-tabs')).liquidTab();
			})
		}

	} );

})( window.jQuery );


(function ( $ ) {
	'use strict';
	
	window.vc.lqdSectionActiveOnClone = false;
	window.InlineShortcodeView_ld_tab_section = window.InlineShortcodeViewContainerWithParent.extend( {
		events: {
			'click > .vc_controls [data-vc-control="destroy"]': 'destroy',
			'click > .vc_controls [data-vc-control="edit"]': 'edit',
			'click > .vc_controls [data-vc-control="clone"]': 'clone',
			'click > .vc_controls [data-vc-control="prepend"]': 'prependElement',
			'click > .vc_controls [data-vc-control="append"]': 'appendElement',
			'click > .vc_controls [data-vc-control="parent.destroy"]': 'destroyParent',
			'click > .vc_controls [data-vc-control="parent.edit"]': 'editParent',
			'click > .vc_controls [data-vc-control="parent.clone"]': 'cloneParent',
			'click > .vc_controls [data-vc-control="parent.append"]': 'addSibling',
			'click .lqd-panel-body > [data-js-panel-body].vc_empty-element': 'appendElement',
			'click > .vc_controls .vc_control-btn-switcher': 'switchControls',
			'mouseenter': 'resetActive',
			'mouseleave': 'holdActive'
		},
		controls_selector: '#vc_controls-template-vc_tta_section',
		activeClass: 'active in',
		render: function () {
			window.InlineShortcodeView_ld_tab_section.__super__.render.call(this);
			_.bindAll(this, 'refreshContent', 'initTabs', 'activeTab');
			this.refreshContent();
			_.defer(this.initTabs);
			window.vc.frame_window.vc_iframe.addActivity(this.activeTab);
			return this;
		},
		allowAddControl: function () {
			return vc_user_access().shortcodeAll('ld_tab_section');
		},
		addSibling: function (e) {
			window.InlineShortcodeView_ld_tab_section.__super__.addSibling.call(this, e);
		},
		clone: function (e) {
			vc.lqdSectionActiveOnClone = true;
			window.InlineShortcodeView_ld_tab_section.__super__.clone.call(this, e);
		},
		parentChanged: function () {
			window.InlineShortcodeView_ld_tab_section.__super__.parentChanged.call(this);
			this.refreshContent(true);
			this.activeTab();
			return this;
		},
		refreshContent: function(noSectionUpdate) {

			const parentModel = vc.shortcodes.get( this.model.get('parent_id') );

			if ( _.isObject(parentModel) && ! noSectionUpdate && parentModel.view && parentModel.view.sectionUpdated ) {
				parentModel.view.sectionUpdated( this.model );
			}

			return this;

		},
		changed: function() {
			if ( this.allowAddControlOnEmpty() && ! this.$el.find('.vc_element[data-tag]').length ) {
				this.$el.addClass('vc_empty').find('.lqd-panel-body > [data-js-panel-body]').addClass('vc_empty-element');
			} else {
				this.$el.removeClass('vc_empty').find('.lqd-panel-body > [data-js-panel-body].vc_empty-element').removeClass('vc_empty-element');
			}
		},
		destroy: function(e) {
			const parentId = this.model.get('parent_id');
			const parentModel = vc.shortcodes.get(parentId);
			if ( !vc.shortcodes.where( { parent_id: parentId } ).length ) {
				parentModel.destroy();
			} else {
				if ( parentModel.view && parentModel.view.removeSection ) {
					parentModel.view.removeSection(this.model.get('id') );
				}
			}
			window.InlineShortcodeView_ld_tab_section.__super__.destroy.call(this, e);
		},
		setAsActiveSection: function(isActive) {
			this.model.set('isActiveSection', isActive);
		},
		isAsActiveSection: function() {
			return this.model.get('isActiveSection');
		},
		initTabs: function() {
			const $tabPane = vc.frame_window.jQuery(this.$el).children('.lqd-tabs-pane');
			const tabPaneId = $tabPane.attr('id');
			const $liEl = vc.frame_window.jQuery(`[data-controls=${tabPaneId}]`);

			vc.frame_window.jQuery($liEl.children('a')).on('shown.bs.tab hidden.bs.tab', ev => {
				this.setAsActiveSection(ev.type === 'shown');
			});
		},
		activeTab: function() {
			if ( this.isAsActiveSection() ) {
				const tabId = this.model.getParam('tab_id');
				const $trigger = window.vc.frame_window.jQuery(`[data-controls=${tabId}] > a`);
				const $tabPane = window.vc.frame_window.jQuery(`#${tabId}`);
				$trigger.trigger('click');
				$tabPane.addClass(this.activeClass);
			}
		}
	} );

	function lqdMapChildEvents( model ) {
		var child_tag = 'ld_tab_section';
		window.vc.events.on(`shortcodes:${child_tag}:add:parent:${model.get('id')}`, model => {
			const parent_model = window.vc.shortcodes.get( model.get( 'parent_id' ) );
			let active_tab_index = 1;
			const models = _.pluck(
				_.sortBy( window.vc.shortcodes.where({parent_id: parent_model.get('id')}), model => model.get('order') ),
			'id' );
			if ( models.indexOf( model.get('id') ) === active_tab_index - 1 ) {
				model.set( 'isActiveSection', true );
			}
			return model;
		});
		window.vc.events.on(`shortcodes:${child_tag}:clone:parent:${model.get('id')}`, model => {
			if ( window.vc.lqdSectionActiveOnClone ) {
				model.set( 'isActiveSection', true );
			}
			window.vc.lqdSectionActiveOnClone = false;
		});
	}

	window.vc.events.on( 'shortcodes:ld_tabs:add', lqdMapChildEvents );

})( window.jQuery );


(function ($) {
	'use strict';
	window.InlineShortcodeView_ld_media = window.InlineShortcodeViewContainer.extend({
		childTag: 'ld_media_element',
		// initialize: function() {
		// 	_.bindAll(this, 'buildSortable', 'updateSorting');
		// 	window.InlineShortcodeView_ld_media.__super__.initialize.call(this);
		// },
		render: function() {
			window.InlineShortcodeView_ld_media.__super__.render.call(this);
			this.content().removeClass('vc_element-container');
			_.bindAll(this, 'initMasonry', 'addMasonryItem', 'layoutMasonry', 'reloadItems', 'removeMasonryItem', 'getPluginData');
			this.$masonryEl = vc.frame_window.jQuery(this.$el).find('[data-liquid-masonry]');
			this.$customAnimationEl = vc.frame_window.jQuery(this.$el).find('[data-custom-animations]');
			vc.frame_window.vc_iframe.addActivity(this.initMasonry);
			return this;
		},
		addControls: function() {
			this.$controls = $( '<div class="no-controls"></div>' );
			this.$controls.appendTo(this.$el);
			return this;
		},
		parentChanged: function() {
			window.InlineShortcodeView_ld_media.__super__.parentChanged.call( this );
			_.defer( this.layoutMasonry );
		},
		changed: function() {
			window.InlineShortcodeView_ld_media.__super__.changed.call( this );
			// _.defer( this.buildSortable );
		},
		updated: function() {
			window.InlineShortcodeView_ld_media.__super__.updated.call( this );
			_.defer( this.layoutMasonry );
			// _.defer( this.buildSortable );
		},
		initMasonry: function() {
			this.$customAnimationEl.liquidCustomAnimations();
			if ( ! this.getPluginData() ) {
				this.$masonryEl.liquidMasonry({bypassCheck: true, itemSelector: '.vc_ld_media_element'});
			}
		},
		addElement: function(e) {
			if ( e && e.preventDefault ) {
				e.preventDefault();
			}
			vc.builder.create({
				shortcode: this.childTag,
				parent_id: this.model.get('id'),
			}).render();
		},
		buildSortable: function() {
			if ( ! vc_user_access().shortcodeEdit(this.model.get('shortcode')) ) {
				return;
			}
			if ( this.$el ) {
				this.$el.find('.ld-media-row').sortable( {
					tolerance: "pointer",
					placeholder: 'vc_ld_media_element',
					items: '.vc_ld_media_element',
					handle: '.vc_child-element-move',
					start: this.startSorting.bind(this),
					update: this.updateSorting.bind(this),
					stop: this.stopSorting.bind(this),
				} );
			}
		},
		startSorting: function(event, ui) {
			this.$el.addClass('lqd-masonry-sorting');
			this.$el.find('.ld-media-row').sortable('refreshPositions');
		},
		updateSorting: function(event, ui) {
			const childModels = vc.shortcodes.where({parent_id: this.model.get('id')});
			childModels.forEach((childModel, index) => {
				const {id, view} = childModel;
				const shortcode = vc.shortcodes.get(id);
				shortcode.save({'order': view.$el.index()}, { silent: true });
			});
		},
		stopSorting: function(event, ui) {
			this.$el.removeClass('lqd-masonry-sorting');
			this.reloadItems();
		},
		addMasonryItem: function($el) {
			const pluginData = this.getPluginData();
			if ( pluginData && pluginData.isoData && $el ) {
				pluginData.isoData.appended($el)
			}
		},
		layoutMasonry: function() {
			const pluginData = this.getPluginData();
			if ( pluginData && pluginData.isoData ) {
				const {isoData} = pluginData;
				isoData.layout();
			};
		},
		reloadItems: function() {
			const pluginData = this.getPluginData();
			if ( pluginData && pluginData.isoData ) {
				const {isoData} = pluginData;
				isoData.reloadItems();
			};
		},
		removeMasonryItem: function($el) {
			if ( ! $el ) return;
			const pluginData = this.getPluginData();
			if ( ! pluginData ) return;
			if ( pluginData && pluginData.isoData ) {
				const {isoData} = pluginData;
				isoData.remove($el);
			};
		},
		getPluginData: function() {
			return this.$masonryEl.data('plugin_liquidMasonry');
		},
	});
})(window.jQuery);

(function ($) {
	'use strict';
	window.InlineShortcodeView_ld_media_element = window.InlineShortcodeView_vc_column.extend({
		events: {
			'click > .vc_controls [data-vc-control="destroy"]': 'destroy',
			'click > .vc_controls [data-vc-control="edit"]': 'edit',
			'click > .vc_controls [data-vc-control="clone"]': 'clone',
			'click > .vc_controls [data-vc-control="prepend"]': 'prependElement',
			'click > .vc_controls [data-vc-control="append"]': 'appendElement',
			'click > .vc_controls [data-vc-control="parent.destroy"]': 'destroyParent',
			'click > .vc_controls [data-vc-control="parent.edit"]': 'editParent',
			'click > .vc_controls [data-vc-control="parent.clone"]': 'cloneParent',
			'click > .vc_controls [data-vc-control="parent.append"]': 'addSibling',
			'click > .vc_empty-element': 'edit',
			'click > .vc_controls .vc_control-btn-switcher': 'switchControls',
			'mouseenter': 'resetActive',
			'mouseleave': 'holdActive'
		},
		controls_selector: '#vc_controls-template-vc_tta_section',
		render: function() {
			window.InlineShortcodeView_ld_media_element.__super__.render.call(this);
			_.bindAll(this, 'appendItem');
			this.appendItem();
			return this;
		},
		changed: function() {
			window.InlineShortcodeView_ld_media_element.__super__.changed.call(this);
			_.defer(() => {
				const parentModel = vc.shortcodes.get(this.model.get('parent_id'))
				if ( parentModel.view ) {
					parentModel.view.layoutMasonry();
				}
			})
		},
		appendItem: function() {
			const parentModel = vc.shortcodes.get(this.model.get('parent_id'))
			if ( parentModel.view ) {
				parentModel.view.addMasonryItem(this.$el);
				// parentModel.view.layoutMasonry();
			}
		},
		destroy: function(e) {
			e && e.preventDefault && e.preventDefault();
			const parentModel = vc.shortcodes.get(this.model.get('parent_id'))
			if ( parentModel.view ) {
				parentModel.view.removeMasonryItem(this.$el);
				parentModel.view.layoutMasonry();
			}
			window.InlineShortcodeView_ld_images_group_element.__super__.destroy.call(this, e);
		},
	});
})(window.jQuery);

(function ($) {
	'use strict';
	window.InlineShortcodeView_ld_animated_frames_container = window.InlineShortcodeViewContainer.extend({
		childTag: 'ld_animated_frame',
		render: function() {
			window.InlineShortcodeView_ld_animated_frames_container.__super__.render.call(this);
			const frames = vc.shortcodes.where({parent_id: this.model.get('id')});
			vc.frame_window.vc_iframe.addActivity(() => {
				vc.frame_window.jQuery('[data-liquid-animatedframes]', vc.frame_window.jQuery(this.$el)).liquidAnimatedFrames({current: frames.length - 1});
				vc.frame_window.jQuery('[data-lqd-fake3d]', vc.frame_window.jQuery(this.$el)).liquidFake3d();
			});
			return this;
		},
		addControls: function() {
			this.$controls = $( '<div class="no-controls"></div>' );
			this.$controls.appendTo(this.$el);
			return this;
		},
		addElement: function(e) {
			if ( e && e.preventDefault ) {
				e.preventDefault();
			}
			vc.builder.create({
				shortcode: this.childTag,
				parent_id: this.model.get('id'),
				params: {
					title: 'Frame',
					content: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.'
				}
			}).render();
		}
	});
})(window.jQuery);

(function ($) {
	'use strict';
	window.InlineShortcodeView_ld_animated_frame = window.InlineShortcodeView_vc_column.extend({
		events: {
			'click .lqd-af-slide__img > .vc_controls [data-vc-control="destroy"]': 'destroy',
			'click .lqd-af-slide__img > .vc_controls [data-vc-control="edit"]': 'edit',
			'click .lqd-af-slide__img > .vc_controls [data-vc-control="clone"]': 'clone',
			'click .lqd-af-slide__img > .vc_controls [data-vc-control="prepend"]': 'prependElement',
			'click .lqd-af-slide__img > .vc_controls [data-vc-control="append"]': 'appendElement',
			'click .lqd-af-slide__img > .vc_controls [data-vc-control="parent.destroy"]': 'destroyParent',
			'click .lqd-af-slide__img > .vc_controls [data-vc-control="parent.edit"]': 'editParent',
			'click .lqd-af-slide__img > .vc_controls [data-vc-control="parent.clone"]': 'cloneParent',
			'click .lqd-af-slide__img > .vc_controls [data-vc-control="parent.append"]': 'addSibling',
			// 'click .lqd-panel-body > [data-js-panel-body].vc_empty-element': 'appendElement',
			'click .lqd-af-slide__img > .vc_controls .vc_control-btn-switcher': 'switchControls',
			'mouseenter': 'resetActive',
			'mouseleave': 'holdActive'
		},
		controls_selector: '#vc_controls-template-vc_tta_section',
		initialize: function() {
			window.InlineShortcodeView_ld_animated_frame.__super__.initialize.call(this);
			_.bindAll(this, 'getFrameIndex', 'activeFrame');
			this.frameIndex = this.getFrameIndex();
		},
		render: function() {
			window.InlineShortcodeView_ld_animated_frame.__super__.render.call(this);
			_.bindAll(this, 'appendToAnimatedFrames');
			_.defer(this.appendToAnimatedFrames);
			vc.frame_window.vc_iframe.addActivity(() => {
				vc.frame_window.jQuery('[data-split-text]', vc.frame_window.jQuery(this.$el)).liquidSplitText();
			});
			return this;
		},
		addControls: function() {
			window.InlineShortcodeView_ld_images_group_element.__super__.addControls.call(this);
			this.$controls.appendTo(this.$el.find('.lqd-af-slide__img'));
		},
		getFrameIndex: function() {
			return _.indexOf( vc.shortcodes.where({parent_id: this.model.get('parent_id')}), this.model );
		},
		appendToAnimatedFrames: function() {

			const parentModel = vc.shortcodes.get(this.model.get('parent_id'));
			const $animateFrameEl = vc.frame_window.jQuery(parentModel.view.$el.children('[data-liquid-animatedframes]'))
			
			if ( $animateFrameEl.length && $animateFrameEl.data('plugin_liquidAnimatedFrames') ) {
				
				const pluginData = $animateFrameEl.data('plugin_liquidAnimatedFrames');
				let elInArray = false;
				_.each(pluginData.DOM.slides, slide => {
					if ( $(slide).is(this.el) ) return elInArray = true;
				})
				if ( !elInArray ) {
					pluginData.DOM.slides.push(this.el);
					pluginData.slidesTotal = ++pluginData.slidesTotal;
				}

			}

		},
		updated: function() {
			window.InlineShortcodeView_ld_images_group_element.__super__.updated.call(this);
			this.activeFrame(this.$el);
		},
		destroy: function(e) {
			window.InlineShortcodeView_ld_images_group_element.__super__.destroy.call(this, e);
			const parentId = this.model.get('parent_id');
			const parentModel = vc.shortcodes.get(parentId);
			if ( !vc.shortcodes.where({ parent_id: parentId }).length ) {
				parentModel.destroy();
			} else {
				const frames = vc.shortcodes.where({parent_id: parentId});
				const nextFrame = frames[this.frameIndex + 1] ? frames[this.frameIndex + 1] : frames[this.frameIndex - 1];
				const $animateFrameEl = vc.frame_window.jQuery(parentModel.view.$el.children('[data-liquid-animatedframes]'))
				const pluginData = $animateFrameEl.data('plugin_liquidAnimatedFrames');
				if ( nextFrame ) {
					pluginData.DOM.slides.splice(this.frameIndex, 1);
					pluginData.slidesTotal = --pluginData.slidesTotal;
					this.activeFrame(nextFrame.view.$el);
				}
			}
		},
		activeFrame: function($el) {
			const parentModel = vc.shortcodes.get(this.model.get('parent_id'));
			const $animateFrameEl = vc.frame_window.jQuery(parentModel.view.$el.children('[data-liquid-animatedframes]'))

			$el.addClass('lqd-af-slide--current').siblings().removeClass('lqd-af-slide--current');
			$el.find('.lqd-af-slide__img, .lqd-af-slide__link, .lqd-af-slide__img__inner, .lqd-af-slide__img__inner > figure').css({
				transform: 'translate(0, 0)'
			});
			$el.find('.lqd-af-slide__link').css({
				opacity: 1
			});
			
			if ( $animateFrameEl.length && $animateFrameEl.data('plugin_liquidAnimatedFrames') ) {
				$animateFrameEl.data('plugin_liquidAnimatedFrames').current = $el.index();
			}

			console.log($animateFrameEl.data('plugin_liquidAnimatedFrames'));

		}

	});
})(window.jQuery);

(function ($) {
	'use strict';
	window.InlineShortcodeView_ld_particles = window.InlineShortcodeView.extend({
		initialize: function() {	
			window.InlineShortcodeView_ld_particles.__super__.initialize.call(this);
			_.bindAll(this, 'setID', 'checkAndRemoveExisting', 'addPlaceholder');
		},
		render: function() {

			window.InlineShortcodeView_ld_particles.__super__.render.call(this);
			
			this.setID();
			this.addPlaceholder();
			
			vc.frame_window.vc_iframe.addActivity(() => {
				vc.frame_window.jQuery('[data-move-element]', vc.frame_window.jQuery(this.el)).liquidMoveElement();
				vc.frame_window.jQuery('[data-particles]', vc.frame_window.jQuery(this.el)).liquidParticles();
			});
			
			return this;
			
		},
		beforeUpdate: function() {
			window.InlineShortcodeView_ld_particles.__super__.beforeUpdate.call(this);
			this.checkAndRemoveExisting();
		},
		updated: function() {
			this.addPlaceholder();
		},
		addPlaceholder: function() {
			if ( this.model.getParam('as_bg') === 'yes' ) {
				this.$el.addClass('lqd-fe-show-placeholder');
			} else {
				this.$el.removeClass('lqd-fe-show-placeholder');
			}
		},
		setID: function() {
			this.$el.children('.ld-particles-container').attr('data-id', `lqd-particles-${this.model.get('id')}`);
		},
		checkAndRemoveExisting: function() {
			const $existingEl = this.$el.closest('.vc_row').children('.lqd-particles-bg-wrap');
			if ( $existingEl.length && $existingEl.find(`[data-id="lqd-particles-${this.model.get('id')}"]`).length ) {
				$existingEl.remove();
			}
		},
		destroy(e) {
			e && e.preventDefault && e.preventDefault();
			e && e.stopPropagation && e.stopPropagation();
			this.checkAndRemoveExisting();
			window.InlineShortcodeView_ld_particles.__super__.destroy.call(this);
		},
	});
})(window.jQuery);

(function ($) {
	'use strict';
	window.InlineShortcodeView_ld_process_box_container = window.InlineShortcodeViewContainer.extend({
		childTag: 'ld_process_box',
		render: function() {
			window.InlineShortcodeView_ld_process_box_container.__super__.render.call(this);
			return this;
		},
		addControls: function() {
			this.$controls = $( '<div class="no-controls"></div>' );
			this.$controls.appendTo(this.$el);
			return this;
		},
		content: function() {
			if ( ! this.$content ) {
				this.$content = this.$el.find('.lqd-pb-row');
				this.$el.find('.vc_container-anchor:first').remove();
			}
			return this.$content;
		},
		addElement: function(e) {
			if ( e && e.preventDefault ) {
				e.preventDefault();
			}
			vc.builder.create({
				shortcode: this.childTag,
				parent_id: this.model.get('id'),
				params: {
					title: 'Process Box Item',
				}
			}).render();
		}
	});
})(window.jQuery);

(function ($) {
	'use strict';
	window.InlineShortcodeView_ld_process_box = window.InlineShortcodeViewContainerWithParent.extend({
		events: {
			'click > .vc_controls [data-vc-control="destroy"]': 'destroy',
			'click > .vc_controls [data-vc-control="edit"]': 'edit',
			'click > .vc_controls [data-vc-control="clone"]': 'clone',
			'click > .vc_controls [data-vc-control="prepend"]': 'prependElement',
			'click > .vc_controls [data-vc-control="append"]': 'appendElement',
			'click > .vc_controls [data-vc-control="parent.destroy"]': 'destroyParent',
			'click > .vc_controls [data-vc-control="parent.edit"]': 'editParent',
			'click > .vc_controls [data-vc-control="parent.clone"]': 'cloneParent',
			'click > .vc_controls [data-vc-control="parent.append"]': 'addSibling',
			// 'click .lqd-panel-body > [data-js-panel-body].vc_empty-element': 'appendElement',
			'click > .vc_controls .vc_control-btn-switcher': 'switchControls',
			'mouseenter': 'resetActive',
			'mouseleave': 'holdActive'
		},
		controls_selector: '#vc_controls-template-vc_tta_section',
		render: function() {
			window.InlineShortcodeView_ld_process_box.__super__.render.call(this);
			const columnClassnames = [...this.$el.children('.lqd-pb-column').get(0).classList].filter(classname => classname.includes('col-'));
			this.$el.addClass(`lqd-pb-column ${columnClassnames.join(' ')}`);
			return this;
		},

	});
})(window.jQuery);

(function ($) {
	'use strict';
	window.InlineShortcodeView_ld_roadmap = window.InlineShortcodeViewContainer.extend({
		childTag: 'ld_roadmap_item',
		render: function() {
			window.InlineShortcodeView_ld_roadmap.__super__.render.call(this);
			vc.frame_window.vc_iframe.addActivity(() => {
				vc.frame_window.jQuery('[data-custom-animations]', vc.frame_window.jQuery(this.$el)).liquidCustomAnimations();
			});
			return this;
		},
		addControls: function() {
			this.$controls = $( '<div class="no-controls"></div>' );
			this.$controls.appendTo(this.$el);
			return this;
		},
		addElement: function(e) {
			if ( e && e.preventDefault ) {
				e.preventDefault();
			}
			vc.builder.create({
				shortcode: this.childTag,
				parent_id: this.model.get('id'),
				params: {
					title: 'Roadmap Item',
				}
			}).render();
		}
	});
})(window.jQuery);

(function ($) {
	'use strict';
	window.InlineShortcodeView_ld_roadmap_item = window.InlineShortcodeViewContainerWithParent.extend({
		events: {
			'click > .vc_controls [data-vc-control="destroy"]': 'destroy',
			'click > .vc_controls [data-vc-control="edit"]': 'edit',
			'click > .vc_controls [data-vc-control="clone"]': 'clone',
			'click > .vc_controls [data-vc-control="prepend"]': 'prependElement',
			'click > .vc_controls [data-vc-control="append"]': 'appendElement',
			'click > .vc_controls [data-vc-control="parent.destroy"]': 'destroyParent',
			'click > .vc_controls [data-vc-control="parent.edit"]': 'editParent',
			'click > .vc_controls [data-vc-control="parent.clone"]': 'cloneParent',
			'click > .vc_controls [data-vc-control="parent.append"]': 'addSibling',
			// 'click .lqd-panel-body > [data-js-panel-body].vc_empty-element': 'appendElement',
			'click > .vc_controls .vc_control-btn-switcher': 'switchControls',
			'mouseenter': 'resetActive',
			'mouseleave': 'holdActive'
		},
		controls_selector: '#vc_controls-template-vc_tta_section',
		render: function() {
			window.InlineShortcodeView_ld_roadmap_item.__super__.render.call(this);
			return this;
		},
	});
})(window.jQuery);