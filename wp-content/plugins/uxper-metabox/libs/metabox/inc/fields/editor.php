<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'UXPER_Editor_Field' ) ) {
	class UXPER_Editor_Field {
		static function template( $field, $post_metas ) {

			$field = wp_parse_args( $field, array(
				'options'    => array(
					'textarea_rows' => 8
				),
				'full_width' => true
			) );

			$field['subtitle'] = isset( $field['subtitle'] ) ? '<p class="uxper-form-sub-title">' . $field['subtitle'] . '</p>' : '';
			$field['desc']     = isset( $field['desc'] ) ? '<p class="uxper-form-description">' . $field['desc'] . '</p>' : '';

			$classes = array();

			if ( $field['full_width'] == true ) {
				$classes[] = 'uxper-form-full';
			}

			$value = isset( $post_metas[ $field['id'] ] ) ? $post_metas[ $field['id'] ] : '';

			// Using output buffering because wp_editor() echos directly
			ob_start();

			// Use new wp_editor() since WP 3.3
			wp_editor( $value, $field['id'], $field['options'] );

			$editor = ob_get_clean();

			printf( '
				<div class="uxper-form-wrapper %s">
					<div class="uxper-form-title">
            <label class="uxper-form-label">%s</label>%s
          </div>
          <div class="uxper-form-control">%s</div>
          %s
				</div>',
				implode( ' ', $classes ),
				$field['title'],
				$field['subtitle'],
				$editor,
				$field['desc']
			);
		}
	}
}