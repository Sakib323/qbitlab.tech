(
	function( $ ) {
		'use strict';

		var SalaHeadingTypedHandler = function( $scope, $ ) {
			$( '.heading-typed' ).each( function() {
				var _this = $( this )[0];
				var speed = $( this ).attr( 'data-speed' );
				var loop = $( this ).attr( 'data-loop' );
				var loop_val = false;
				if( loop == 'yes' ){
					loop_val = true;
				}
				var typed = new Typed(_this, {
					stringsElement: '.typed-strings',
					typeSpeed: parseInt(speed),
					smartBackspace: true,
					loop: loop_val,
				});
			});
		};

		$( window ).on( 'elementor/frontend/init', function() {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/sala-heading-typed.default', SalaHeadingTypedHandler );
		} );
	}
)( jQuery );
