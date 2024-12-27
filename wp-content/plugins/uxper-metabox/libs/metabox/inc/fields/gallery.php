<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'UXPER_Gallery_Field' ) ) {
	class UXPER_Gallery_Field {
		static function template( $field, $post_metas ) {

			$field['subtitle'] = isset( $field['subtitle'] ) ? '<p class="uxper-form-sub-title">' . $field['subtitle'] . '</p>' : '';
			$field['desc']     = isset( $field['desc'] ) ? '<p class="uxper-form-description">' . $field['desc'] . '</p>' : '';

			$value = isset( $post_metas[ $field['id'] ] ) && $post_metas[ $field['id'] ] != null ? $post_metas[ $field['id'] ] : '';

			$valEncoded = '';

			ob_start();
			if ( ! empty( $value ) ) {
				$valEncoded = htmlspecialchars( json_encode( $value ) );
				foreach ( $value as $attachment ) {
					printf(
						'<li class="image" data-attachment-id="%s" >
							<img src="%s" />
							<ul class="actions">
								<li>
									<a href="#" class="uxper-gallery-remove" title="Delete"><i class="fa fa-times-circle-o"></i></a>
								</li>
							</ul>
						</li>',
						$attachment['id'],
						$attachment['thumbnail']
					);
				}
			}

			$list = ob_get_clean();

			return sprintf( '
				<div class="uxper-form-wrapper">
      		<div class="uxper-form-title">
            <label class="uxper-form-label">%s</label>%s
          </div>
      		<div class="uxper-form-control">
						<div class="uxper-gallery-upload-wrap">
							<ul class="uxper-gallery-images">%s</ul>
							<a class="uxper-gallery-open uxper-button success"><i class="fa fa-upload"></i>%s</a>
							<a class="uxper-gallery-clear uxper-button danger" style="display:%s"><i class="fa fa-trash-o"></i>%s</a>
							<input type="hidden" class="uxper-gallery" name="%s" value="%s" />
						</div>
					</div>
				</div>',
				$field['title'],
				$field['subtitle'],
				$list,
				__( 'Upload', 'uxper' ),
				! empty( $value ) ? 'inline-block' : 'none',
				__( 'Clear', 'uxper' ),
				$field['id'],
				$valEncoded
			);
		}

		static function enqueue_scripts() {
			// This function loads in the required media files for the media manager
			wp_enqueue_media();

			wp_enqueue_script( 'uxper-gallery', UXPER_JS_URL . 'gallery.js', array(
				'jquery-core'
			), false, true );
		}

		static function standardize( $value ) {
			return json_decode( $value[0], true );
		}
	}
}