(
	function( $ ) {
		'use strict';

		var SalaTestimonialStackHandler = function( $scope, $ ) {

			var maxHeight = Math.max.apply(null, $("#elasticstack .grid-item").map(function () {
				return $(this).height();
			}).get());

			$("#elasticstack .grid-item").css( 'height', maxHeight + 'px' );

			var elasticstackheight = maxHeight + 100;

			$("#elasticstack").css( 'height', elasticstackheight + 'px' );

			var $element = document.getElementById( 'elasticstack' );

			var dragback = $("#elasticstack").data( 'dragback' );

			var dragmax = $("#elasticstack").data( 'dragmax' );

			new ElastiStack( $element, {
				// distDragBack: if the user stops dragging the image in a area that does not exceed [distDragBack]px
				// for either x or y then the image goes back to the stack
				distDragBack : dragback,
				// distDragMax: if the user drags the image in a area that exceeds [distDragMax]px
				// for either x or y then the image moves away from the stack
				distDragMax : dragmax,
				// callback
				onUpdateStack : function( current ) { return false; }
			} );

		};

		$( window ).on( 'elementor/frontend/init', function() {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/sala-testimonial-stack.default', SalaTestimonialStackHandler );
		} );
	}
)( jQuery );
