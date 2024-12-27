(
	function( $ ) {
		'use strict';

		function isInViewport(node) {
			var rect = node.getBoundingClientRect()
			return (
				(rect.height > 0 || rect.width > 0) &&
				rect.bottom >= 0 &&
				rect.right >= 0 &&
				rect.top <= (window.innerHeight || document.documentElement.clientHeight) &&
				rect.left <= (window.innerWidth || document.documentElement.clientWidth)
			)
		}

		elementor.channels.editor.on( 'section:activated', function( sectionName, editor ) {
			var editedElement = editor.getOption( 'editedElementView' );

			if ( sectionName == null ) {
				return;
			}

			var widgetType = editedElement.model.get( 'widgetType' );

			// Flipped true site on edit.
			if ( 'sala-flip-box' === widgetType ) {
				var isBackSection = false;

				if ( - 1 !== sectionName.indexOf( 'back_side_section' ) || - 1 !== sectionName.indexOf( 'button_style_section' ) ) {
					isBackSection = true;
				}

				editedElement.$el.toggleClass( 'sala-flip-box--flipped', isBackSection );

				var $backLayer = editedElement.$el.find( '.back-side' );

				if ( isBackSection ) {
					$backLayer.css( 'transition', 'none' );
				}

				if ( ! isBackSection ) {
					setTimeout( function() {
						$backLayer.css( 'transition', '' );
					}, 10 );
				}
			}

			// Edit heading wrapper style.
			if ( 'sala-heading' === widgetType && 'wrapper_style_section' === sectionName ) {
				editedElement.$el.addClass( 'sala-heading-wrapper-editing' );
			} else {
				editedElement.$el.removeClass( 'sala-heading-wrapper-editing' );
			}

			// Force show arrows when editing arrows of any widgets has swiper.
			if ( 'swiper_arrows_style_section' === sectionName ) {
				editedElement.$el.addClass( 'sala-swiper-arrows-editing' );
			} else {
				editedElement.$el.removeClass( 'sala-swiper-arrows-editing' );
			}

			// Force show marker overlay when editing.
			if ( 'markers_popup_style_section' === sectionName ) {
				editedElement.$el.addClass( 'sala-map-marker-overlay-editing' );
			} else {
				editedElement.$el.removeClass( 'sala-map-marker-overlay-editing' );
			}
		} );


		elementor.channels.editor.on( 'section:activated', function( sectionName, editor ) {

			elementor.channels.editor.on('change',function( view ) {
				var editedElement = editor.getOption( 'editedElementView' );
				var changed = view.elementSettingsModel.changed;


				if( changed['motion_fx_mouseTrack_effect'] === 'yes' ){

					editedElement.$el.parents( '.elementor' ).on('mousemove', function(e) {

						var w = $(window).width();
						var h = $(window).height();

						editedElement.$el.each(function(i, el) {
							var offset = 40;
							var direction = 'opposite';

							var offsetX = 0.5 - e.pageX / w;
							var offsetY = 0.5 - (e.pageY - $(window).scrollTop()) / h;

							var translate = "translate3d(" + Math.round(offsetX * offset) + "px," + Math.round(offsetY * offset) + "px, 0px)";
							$(el).css({
								'-webkit-transform': translate,
								'transform': translate,
								'moz-transform': translate
							});
						});
					});

				} else {

					editedElement.$el.each(function(i, el) {

						var translate = 'inherit';
						$(el).css({
							'-webkit-transform': translate,
							'transform': translate,
							'moz-transform': translate
						});

					});

					editedElement.$el.parents( '.elementor' ).on('mousemove', function(e) {

						editedElement.$el.each(function(i, el) {

							var translate = 'inherit';
							$(el).css({
								'-webkit-transform': translate,
								'transform': translate,
								'moz-transform': translate
							});

						});

					});

				}

				if( changed['motion_fx_tilt_effect'] === 'yes' ){

					editedElement.$el.parents( '.elementor' ).on('mousemove', function(e) {

						var w = $(window).width();
						var h = $(window).height();

						editedElement.$el.each(function(i, el) {
							var offset = 40;
							var direction = 'opposite';

							var offsetX = 0.5 - e.pageX / w;
							var offsetY = 0.5 - (e.pageY - $(window).scrollTop()) / h;

							if( direction == 'opposite' ){
								var tiltX = Math.round(offsetY * offset);
								var tiltY = Math.round(offsetX * offset);
							} else if( direction == 'direct' ){
								var tiltX = - Math.round(offsetY * offset);
								var tiltY = - Math.round(offsetX * offset);
							}
							var translate = "rotateX(var(--rotateX))rotateY(var(--rotateY))";
							$(el).addClass( 'sala-tilt' );
							$(el).find( '> .elementor-widget-container' ).css({
								'--rotateX': tiltX + 'deg',
								'--rotateY': tiltY + 'deg',
								'-webkit-transform': translate,
								'transform': translate,
								'moz-transform': translate
							});
						});
					});

				} else {

					editedElement.$el.find( '> .elementor-widget-container' ).css({
						'-webkit-transform': 'inherit',
						'transform': 'inherit',
						'moz-transform': 'inherit'
					});

					editedElement.$el.parents( '.elementor' ).on('mousemove', function(e) {

						editedElement.$el.each(function(i, el) {

							editedElement.$el.find( '> .elementor-widget-container' ).css({
								'-webkit-transform': 'inherit',
								'transform': 'inherit',
								'moz-transform': 'inherit'
							});

						});

					});

				}
			});
		});

	}
)( jQuery );
