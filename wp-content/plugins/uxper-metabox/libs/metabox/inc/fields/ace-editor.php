<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'UXPER_Ace_Editor_Field' ) ) {
	class UXPER_Ace_Editor_Field {
		static function template( $field, $post_metas ) {

			$field = wp_parse_args( $field, array(
				'title'      => '',
				'default'    => '',
				'full_width' => true,
				'mode'       => 'css',
				'theme'      => 'monokai',
				'minLines'   => 10,
				'maxLines'   => 30,
			) );

			$field['subtitle'] = isset( $field['subtitle'] ) ? '<p class="uxper-form-sub-title">' . $field['subtitle'] . '</p>' : '';
			$field['desc']     = isset( $field['desc'] ) ? '<p class="uxper-form-description">' . $field['desc'] . '</p>' : '';

			$classes = array();

			if ( $field['full_width'] == true ) {
				$classes[] = 'uxper-form-full';
			}

			$value = isset( $post_metas[ $field['id'] ] ) ? $post_metas[ $field['id'] ] : $field['default'];
			//$value = esc_textarea($value);
			//$value = json_decode($value);
			return sprintf(
				'<div class="uxper-form-wrapper %s">
					<div class="uxper-form-title">
            <label class="uxper-form-label">%s</label>%s
          </div>
					<div class="uxper-form-control">
						<div class="uxper-ace-editor">
							<pre id="%s_editor" class="ace-editor" data-mode="%s" data-theme="%s">%s</pre>
							%s
							<textarea class="form-textarea" name="%s">%s</textarea>
						</div>
					</div>
				</div>',
				implode( ' ', $classes ),
				$field['title'],
				$field['subtitle'],
				$field['id'],
				$field['mode'],
				$field['theme'],
				$value,
				$field['desc'],
				$field['id'],
				$value
			);
		}

		static function enqueue_scripts() {
			wp_enqueue_script( 'uxper-ace-editor-plugin', UXPER_ASSETS_URL . 'ace-editor/src-min-noconflict/ace.js', array(
				'jquery-core'
			), false, true );

			wp_enqueue_script( 'uxper-ace-editor-js', UXPER_JS_URL . 'ace-editor.js', array(
				'jquery-core'
			), false, true );
		}
	}
}