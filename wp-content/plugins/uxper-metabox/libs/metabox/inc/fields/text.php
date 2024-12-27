<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'UXPER_Text_Field' ) ) {
	class UXPER_Text_Field {
		static function template( $field, $post_metas ) {

			$field = wp_parse_args( $field, array(
				'title'   => '',
				'default' => ''
			) );

			$field['subtitle'] = isset( $field['subtitle'] ) ? '<p class="uxper-form-sub-title">' . $field['subtitle'] . '</p>' : '';
			$field['desc']     = isset( $field['desc'] ) ? '<p class="uxper-form-description">' . $field['desc'] . '</p>' : '';

			$value = isset( $post_metas[ $field['id'] ] ) ? esc_attr( $post_metas[ $field['id'] ] ) : $field['default'];

			return sprintf( '<div class="uxper-form-wrapper">
          <div class="uxper-form-title">
            <label class="uxper-form-label" for="%s">%s</label>%s
          </div>
          <div class="uxper-form-control">
            <input type="text" name="%s" class="uxper-form-text uxper-form-control" id="%s" value="%s" />
            %s
          </div>
        </div>', $field['id'], $field['title'], $field['subtitle'], $field['id'], $field['id'], $value, $field['desc'] );
		}
	}
}