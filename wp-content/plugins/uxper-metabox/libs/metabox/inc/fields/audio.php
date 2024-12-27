<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'UXPER_Audio_Field' ) ) {
	class UXPER_Audio_Field {
		static function template( $field, $post_metas ) {

			$field['subtitle'] = isset( $field['subtitle'] ) ? '<p class="uxper-form-sub-title">' . $field['subtitle'] . '</p>' : '';
			$field['desc']     = isset( $field['desc'] ) ? '<p class="uxper-form-description">' . $field['desc'] . '</p>' : '';

			$value = isset( $post_metas[ $field['id'] ] ) && $post_metas[ $field['id'] ] != null ? $post_metas[ $field['id'] ] : '';

			return sprintf( '
				<div class="uxper-form-wrapper">
      		<div class="uxper-form-title">
            <label class="uxper-form-label">%s</label>%s
          </div>
      		<div class="uxper-form-control">
						<div class="uxper-media-upload-wrap">
							<p><input type="url" class="uxper-media" name="%s" value="%s" /></p>
							<a class="uxper-media-open uxper-button success"><i class="fa fa-upload"></i>%s</a>
							<a class="uxper-media-remove uxper-button danger" style="display:%s"><i class="fa fa-trash-o"></i>%s</a>
						</div>
					</div>
				</div>',
				$field['title'],
				$field['subtitle'],
				$field['id'],
				$value,
				__( 'Upload', 'uxper' ),
				$value != '' ? 'inline-block' : 'none',
				__( 'Remove', 'uxper' )
			);
		}

		static function enqueue_scripts() {
			// This function loads in the required media files for the media manager
			wp_enqueue_media();

			wp_enqueue_script( 'uxper-media', UXPER_JS_URL . 'audio.js', array(
				'jquery-core'
			), false, true );
		}
	}
}
