(
	function( $ ) {
		'use strict';

		var SalaPricingTableHandler = function( $scope, $ ) {

		};

		$( window ).on( 'elementor/frontend/init', function() {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/sala-pricing-table.default', SalaPricingTableHandler );
		} );
	}
)( jQuery );
