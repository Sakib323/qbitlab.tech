(
	function( $ ) {
		'use strict';

		var SalaTimeLineHandler = function( $scope, $ ) {

			function goToByScroll(id) {
				// Remove "link" from the ID
				id = id.replace("link", "");

				$( '.timeline-item.item .timeline-dot' ).removeClass( 'current' );

				$("#" + id).find( '.timeline-dot' ).addClass( 'current' );

				// Scroll
				$('html,body').animate({
					scrollTop: $("#" + id).offset().top
				}, 'slow');
			}

			$( '.scroll-to-timeline' ).on( 'click', function(e) {
				// Prevent a page reload when a link is pressed
				e.preventDefault();
				// Call the scroll function
				goToByScroll(this.id);

				$( '.scroll-to-timeline' ).not( this ).removeClass( 'current' );

				$( this ).addClass('current' );

			});

			$( '.timeline-item' ).on( 'mouseenter', function(e) {
				// Prevent a page reload when a link is pressed
				e.preventDefault();
				// Call the scroll function
				var id = $( this ).attr( 'id' );

				$( '.timeline-list .navigation a' ).removeClass( 'current' );

				$( '#link' + id ).addClass('current' );

			});

			$( '.timeline-item' ).on( 'mouseleave', function(e) {
				// Prevent a page reload when a link is pressed
				e.preventDefault();
				// Call the scroll function
				var id = $( this ).attr( 'id' );

				$( '.timeline-list .navigation a' ).removeClass( 'current' );

				$( '#link' + id ).removeClass('current' );

			});

			if( $(window).width() > 767  ){
				$( '.sala-timeline' ).each( function() {
					var _timeline_height = $( this ).find( '.timeline-list' ).outerHeight();
					var navigation_width = $( this ).find( '.navigation' ).outerWidth();
					$( this ).find( '.navigation' ).css( 'height', navigation_width + 'px' );
					$( this ).find( '.timeline-item' ).css( 'top', '-' + navigation_width + 'px' );
					$( this ).find( '.timeline-list' ).css( 'height', _timeline_height + 'px' );
				});
			}
		};

		$( window ).on( 'elementor/frontend/init', function() {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/sala-timeline.default', SalaTimeLineHandler );
		} );
	}
)( jQuery );
