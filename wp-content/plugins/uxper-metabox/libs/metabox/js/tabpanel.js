jQuery(document).ready(function($) {
  "use strict";

  $('.uxper-tabpanel').each(function(index, element) {
    var $el = $(this),
      id = $(this).attr('id'),
      active = localStorage.getItem(id);
    if (!active) {
      active = 0;
    }
    $(this).children('.uxper-nav-tabs').children().eq(active).addClass('active');
    $(this).children('.uxper-tab-content').children().eq(active).addClass('active');

    $el.children('.uxper-nav-tabs').on('click', 'a', function(e) {
      e.preventDefault();

      $(this).parent('li').siblings().removeClass('active');
      $(this).parent('li').addClass('active');

      var tabpanel = $(this).parents('.uxper-tabpanel').first();
      var index = $(this).parent().index();
      localStorage.setItem(id, index);
      tabpanel.children('.uxper-tab-content').children().removeClass('active');
      tabpanel.children('.uxper-tab-content').children().eq(index).addClass('active');

    });
  });
});
