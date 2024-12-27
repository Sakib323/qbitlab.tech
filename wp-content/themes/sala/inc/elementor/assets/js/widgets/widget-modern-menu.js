(
	function( $ ) {
		'use strict';

		var SalaModernMenuHandler = function( $scope, $ ) {
			$('.elementor-widget-sala-modern-menu ul.elementor-nav-menu>li.menu-item-has-children>a').append('<span class="sub-arrow"><i class="fa"></i></span>');
		};

		$( window ).on( 'elementor/frontend/init', function() {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/sala-modern-menu.default', SalaModernMenuHandler );
		} );
	}
)( jQuery );
