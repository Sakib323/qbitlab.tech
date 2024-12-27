(
	function( $ ) {
		'use strict';

		var SalaChartHandler = function( $scope, $ ) {

			$( '.sala-mode-switcher' ).on( 'click', function(e) {
				e.preventDefault();
				var bg = $( '.pie-chart' ).data( 'bg' );
				var style = $( '.pie-chart' ).attr( 'style' );
				if( $( 'body' ).hasClass( 'sala-dark-scheme' ) ){
					style = style.replace(bg, "#252428");
					style = style.replace(bg, "#252428");
					style = style.replace(bg, "#252428");
				} else {
					style = style.replace("#252428", bg);
					style = style.replace("#252428", bg);
					style = style.replace("#252428", bg);
				}
				$( '.pie-chart' ).attr( 'style', style );
			});

		};

		$( window ).on( 'elementor/frontend/init', function() {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/sala-chart.default', SalaChartHandler );
		} );
	}
)( jQuery );
