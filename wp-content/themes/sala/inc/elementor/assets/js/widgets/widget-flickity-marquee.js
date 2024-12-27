(
	function( $ ) {
		'use strict';

		var SalaFlickityMarqueeHandler = function( $scope, $ ) {
			var $element = $scope.find( '.sala-flickity-marquee' );

			var requestId = '';

			const mainTicker = new Flickity('.sala-flickity-marquee', {
			  	accessibility: true,
				resize: true,
				wrapAround: true,
				prevNextButtons: false,
				pageDots: false,
				percentPosition: true,
				setGallerySize: true,
			});

			// Set initial position to be 0
			mainTicker.x = 0;

			// Start the marquee animation
			play();

			// Main function that 'plays' the marquee.
			function play() {
			  // Set the decrement of position x
			  mainTicker.x -= 1.5;

			  // Settle position into the slider
			  mainTicker.settle(mainTicker.x);

			  // Set the requestId to the local variable
			  requestId = window.requestAnimationFrame(play);
			}

			// Main function to cancel the animation.
			function pause() {
			  if(requestId) {
			    // Cancel the animation
			    window.cancelAnimationFrame(requestId)

			    // Reset the requestId for the next animation.
			    requestId = undefined;
			  }
			}

			//Pause on hover/focus
			$('.sala-flickity-marquee').on('mouseenter focusin', e => {
			  	pause();
			})

			// Unpause on mouse out / defocus
			$('.sala-flickity-marquee').on('mouseleave', e => {
			  	play();
			});

		};

		$( window ).on( 'elementor/frontend/init', function() {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/sala-flickity-marquee.default', SalaFlickityMarqueeHandler );
		} );
	}
)( jQuery );
