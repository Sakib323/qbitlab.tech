"use strict";

var _wp = wp,
    apiFetch = _wp.apiFetch;
jQuery(function ($) {
  var gutenify_virtual_realityRedirectToKitPage = function gutenify_virtual_realityRedirectToKitPage(res) {
    // if( res?.status && 'active' === res.status ) {
    window.location = "".concat(window.gutenify_virtual_reality.gutenify_kit_gallery); // }
  }; // Activate Gutenify.


  $(document).on('click', '.gutenify-virtual-reality-activate-gutenify', function () {
    $(this).html('<span class="dashicons dashicons-update"></span> Loading...').addClass('gutenify-virtual-reality-importing-gutenify');
    apiFetch({
      path: '/wp/v2/plugins/gutenify/gutenify',
      method: 'POST',
      data: {
        "status": "active"
      }
    }).then(function (res) {
      gutenify_virtual_realityRedirectToKitPage(res);
    })["catch"](function () {
      gutenify_virtual_realityRedirectToKitPage({});
    });
  });
  $(document).on('click', '.gutenify-virtual-reality-install-gutenify', function () {
    $(this).html('<span class="dashicons dashicons-update"></span> Loading...').addClass('gutenify-virtual-reality-importing-gutenify');
    apiFetch({
      path: '/wp/v2/plugins',
      method: 'POST',
      data: {
        "slug": "gutenify",
        "status": "active"
      }
    }).then(function (res) {
      gutenify_virtual_realityRedirectToKitPage(res);
    })["catch"](function () {
      gutenify_virtual_realityRedirectToKitPage({});
    });
  });
  $(document).on('click', '.gutenify-virtual-reality-admin-notice .notice-dismiss', function () {
    console.log(ajaxurl + "?action=gutenify_virtual_reality_hide_theme_info_noticebar");
    apiFetch({
      url: ajaxurl + "?action=gutenify_virtual_reality_hide_theme_info_noticebar&gutenify_virtual_reality-nonce-name=".concat(window.gutenify_virtual_reality.gutenify_virtual_reality_nonce),
      method: 'POST'
    }).then(function (res) {
      console.log(res);
    })["catch"](function (res) {
      console.log(res);
    });
  });
});