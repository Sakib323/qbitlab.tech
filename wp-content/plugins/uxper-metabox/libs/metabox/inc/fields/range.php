<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'UXPER_Range_Field' ) ) {
	class UXPER_Range_Field {
		static function template( $field, $post_metas ) {

			$field = wp_parse_args( $field, array(
				'handles' => 1,
				'min'     => 0,
				'max'     => 100,
				'step'    => 1,
				'default' => ''
			) );

			$field['subtitle'] = isset( $field['subtitle'] ) ? '<p class="uxper-form-sub-title">' . $field['subtitle'] . '</p>' : '';
			$field['desc']     = isset( $field['desc'] ) ? '<p class="uxper-form-description">' . $field['desc'] . '</p>' : '';

			$value = isset( $post_metas[ $field['id'] ] ) ? esc_attr( $post_metas[ $field['id'] ] ) : $field['default'];

			$data = '';

			$type = 'single';
			if ( $field['handles'] == 2 ) {
				$type = 'double';
			}

			return sprintf(
				'<div class="uxper-form-wrapper">
					<div class="uxper-form-title">
            <label class="uxper-form-label">%s</label>%s
          </div>
					<div class="uxper-form-control">
						<input type="text" name="%s" class="uxper-range-field" data-type="%s" value="%s" />
						%s
					</div>
				</div>',
				$field['title'],
				$field['subtitle'],
				$field['id'],
				$type,
				$value,
				$field['desc']
			);
		}

		static function enqueue_scripts() {
			wp_enqueue_style( 'uxper-range', UXPER_CSS_URL . 'range.css' );

			wp_enqueue_script( 'ion-range', UXPER_JS_URL . 'ion.rangeSlider.js', array(
				'jquery-core'
			), false, true );

			wp_enqueue_script( 'uxper-range', UXPER_JS_URL . 'range.js', array(
				'jquery-core'
			), false, true );
		}
	}
}