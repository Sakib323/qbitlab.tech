(
	function( $ ) {
		'use strict';

		var SalaGridHandler = function( $scope, $ ) {
			var $element = $scope.find( '.sala-grid-wrapper' );

			$element.SalaGridLayout();
		};



		$( window ).on( 'elementor/frontend/init', function() {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/sala-image-gallery.default', SalaGridHandler );
			elementorFrontend.hooks.addAction( 'frontend/element_ready/sala-testimonial-grid.default', SalaGridHandler );
			elementorFrontend.hooks.addAction( 'frontend/element_ready/sala-product-categories.default', SalaGridHandler );
		} );
	}
)( jQuery );
