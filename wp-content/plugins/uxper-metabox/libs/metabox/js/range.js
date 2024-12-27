jQuery(document).ready(function($) {
  "use strict";

  $('.uxper-range-field').each(function() {
    $(this).ionRangeSlider({
    	input_values_separator: ','
    });
  });

});
