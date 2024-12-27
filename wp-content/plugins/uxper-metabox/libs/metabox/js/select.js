jQuery(document).ready(function($) {
  "use strict";

  $('.uxper-form-select').each(function(i, o) {
    var $el = $(this);
    var $data = $(this).data('change');
    if ($data) {
      $el.on('change', function(e) {
        var val = $el.val();
        $.each($data, function(key, value) {
          if (val == key) {
            $.each(value, function(k, v) {
              var element = $('#' + k);
              if (element.hasClass('uxper-form-color')) {
                element.spectrum("set", v);
              } else {
                element.val(v);
              }
            });
            return false;
          }
        });
        console.log('done');
      });
    }
  });
});
