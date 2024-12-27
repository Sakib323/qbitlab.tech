<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'UXPER_Image_Select_Field' ) ) {
	class UXPER_Image_Select_Field {
		static function template( $field, $post_metas ) {

			$field = wp_parse_args( $field, array(
				'title'   => '',
				'options' => array(),
				'default' => ''
			) );

			$field['subtitle'] = isset( $field['subtitle'] ) ? '<p class="uxper-form-sub-title">' . $field['subtitle'] . '</p>' : '';
			$field['desc']     = isset( $field['desc'] ) ? '<p class="uxper-form-description">' . $field['desc'] . '</p>' : '';

			$value = isset( $post_metas[ $field['id'] ] ) ? esc_attr( $post_metas[ $field['id'] ] ) : $field['default'];

			$list = '';

			foreach ( $field['options'] as $val => $label ) {
				$list .= sprintf( '
          <img data-value="%s" src="%s" class="%s" />',
					$val,
					$label,
					$value == $val ? 'active' : ''
				);
			}

			return sprintf( '<div class="uxper-form-wrapper">
          <div class="uxper-form-title">
            <label class="uxper-form-label">%s</label>%s
          </div>
          <div class="uxper-form-control">
            <div class="uxper-form-image-select">
              <input type="hidden" name="%s" id="%s" class="image-select-input">
              %s
              %s
            </div>
          </div>
				</div>', $field['title'], $field['subtitle'], $field['id'], $field['id'], $list, $field['desc'] );
		}

		static function enqueue_scripts() {
			wp_enqueue_script( 'uxper-image-select', UXPER_JS_URL . 'image-select.js', array(
				'jquery-core'
			), false, true );
		}
	}
}