jQuery(document).ready(function($) {
  "use strict";

  $('.uxper-media-upload-wrap').each(function(index, value) {
    var $el = $(this),
      uxper_media_frame,
      $mediaImage = $el.children('.uxper-media-image'),
      $media_input = $el.find('.uxper-media');
    $(this).children('.uxper-media-open').on('click', function(e) {

      e.preventDefault();

      // If the frame already exists, re-open it.
      if (uxper_media_frame) {
        uxper_media_frame.open();
        return;
      }

      uxper_media_frame = wp.media.frames.uxper_media_frame = wp.media({
        title: 'Insert Media',
        button: {
          text: 'Select'
        },
        className: 'media-frame uxper-media-frame',
        frame: 'select',
        multiple: false,
        library: {
          type: 'audio'
        },
      });

      uxper_media_frame.on('select', function() {
        var attachment = uxper_media_frame.state().get('selection').first().toJSON();
          /*thumbnail = attachment.sizes && attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url,
          obj = {
            width: attachment.width,
            height: attachment.height,
            id: attachment.id,
            url: attachment.url,
            thumbnail: thumbnail
          };*/
        $el.find('.uxper-media-remove').show();
        $mediaImage.html('<img src="' + attachment.url + '" />');
        //$media_input.val(JSON.stringify(obj));
        console.log(attachment.url);
        $media_input.val(attachment.url);
      });

      // Finally, open up the frame, when everything has been set.
      uxper_media_frame.open();
    });

    // REMOVE MEDIA
    $(this).on('click', '.uxper-media-remove', function(e) {
      e.preventDefault();

      $mediaImage.empty();
      $media_input.val('');
      $(this).hide();
    });
  });
});
