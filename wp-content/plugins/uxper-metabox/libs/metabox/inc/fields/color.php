<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'UXPER_Color_Field' ) ) {
	class UXPER_Color_Field {
		static function template( $field, $post_metas ) {

			$field = wp_parse_args( $field, array(
				'default' => '',
			) );

			$field['subtitle'] = isset( $field['subtitle'] ) ? '<p class="uxper-form-sub-title">' . $field['subtitle'] . '</p>' : '';
			$field['desc']     = isset( $field['desc'] ) ? '<p class="uxper-form-description">' . $field['desc'] . '</p>' : '';

			$value = isset( $post_metas[ $field['id'] ] ) ? esc_attr( $post_metas[ $field['id'] ] ) : $field['default'];

			return sprintf( '
        <div class="uxper-form-wrapper">
          <div class="uxper-form-title">
            <label class="uxper-form-label">%s</label>%s
          </div>
          <div class="uxper-form-control">
            <input name="%s" id="%s" class="uxper-form-color" value="%s" />
            %s
          </div>
        </div>', $field['title'], $field['subtitle'], $field['id'], $field['id'], $value, $field['desc'] );
		}

		static function enqueue_scripts() {
			wp_enqueue_style( 'spectrum', UXPER_ASSETS_URL . 'spectrum/spectrum.css', false, '1.0.0' );

			wp_enqueue_script( 'spectrum', UXPER_ASSETS_URL . 'spectrum/spectrum.js', array(
				'jquery-core'
			), false, true );

			wp_enqueue_script( 'uxper-color', UXPER_JS_URL . 'color.js', array(
				'jquery-core'
			), false, true );
		}
	}
}