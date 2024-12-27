(function($) {
  'use strict';
	 $(document).ready(function () {
		$(".product-category-btn").click(function () {
			if ($(window).outerWidth() > 991) {
				if ($(this).parent().hasClass("active")) {
					$(".canvas").addClass("canvas75").removeClass("canvas100");
					$(".slider5 .slider-area .tns-nav").css("width","75%");
				} else {
					$(".canvas").addClass("canvas100").removeClass("canvas75");
					$(".slider5 .slider-area .tns-nav").css("width", "100%");
				}
			}
		});
	 });
	 if($("body").hasClass("slider5")){
		$(".slider-overlay").show();
	}
}(jQuery));
