jQuery(document).ready(function($) {
  "use strict";

  $('.uxper-switch-field').each(function() {
    var $el = $(this),
      wrapper = $(this).siblings('.uxper-switch');
    wrapper.children(".option").on('click', function(e) {
      wrapper.find(".active").removeClass("active");
      $(this).addClass("active");
      $el.val($(this).data('value'));
    });
  });

});
