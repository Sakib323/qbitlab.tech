<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'UXPER_Select_Field' ) ) {
	class UXPER_Select_Field {
		static function template( $field, $post_metas ) {

			$field = wp_parse_args( $field, array(
				'options' => array(),
				'change'  => array(),
				'default' => ''
			) );

			$field['subtitle'] = isset( $field['subtitle'] ) ? '<p class="uxper-form-sub-title">' . $field['subtitle'] . '</p>' : '';
			$field['desc']     = isset( $field['desc'] ) ? '<p class="uxper-form-description">' . $field['desc'] . '</p>' : '';

			$value = isset( $post_metas[ $field['id'] ] ) ? esc_attr( $post_metas[ $field['id'] ] ) : $field['default'];

			$list = '';

			foreach ( $field['options'] as $val => $label ) {
				$list .= sprintf( '
          <option value="%s" %s>%s</option>',
					$val,
					selected( $value, $val, false ),
					$label
				);
			}
			$dataChange = '';
			if ( ! empty( $field['change'] ) ) {
				$dataChange = "data-change='" . json_encode( $field['change'], JSON_UNESCAPED_UNICODE ) . "'";
			}

			return sprintf( '<div class="uxper-form-wrapper">
          <div class="uxper-form-title">
            <label class="uxper-form-label" for="%s">%s</label>%s
          </div>
          <div class="uxper-form-control">
            <select name="%s" id="%s" class="uxper-form-select" %s>%s</select>
            %s
          </div>
				</div>', $field['id'], $field['title'], $field['subtitle'], $field['id'], $field['id'], $dataChange, $list, $field['desc'] );
		}

		static function enqueue_scripts() {
			wp_enqueue_script( 'uxper-select', UXPER_JS_URL . 'select.js', array(
				'jquery-core'
			), false, true );
		}
	}
}