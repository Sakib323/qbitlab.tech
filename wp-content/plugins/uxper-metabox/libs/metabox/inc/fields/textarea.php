<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'UXPER_Textarea_Field' ) ) {
	class UXPER_Textarea_Field {
		static function template( $field, $post_metas ) {

			$field = wp_parse_args( $field, array(
				'title'      => '',
				'default'    => '',
				'full_width' => true
			) );

			$classes = array();

			if ( $field['full_width'] == true ) {
				$classes[] = 'uxper-form-full';
			}

			$field['subtitle'] = isset( $field['subtitle'] ) ? '<p class="uxper-form-sub-title">' . $field['subtitle'] . '</p>' : '';
			$field['desc']     = isset( $field['desc'] ) ? '<p class="uxper-form-description">' . $field['desc'] . '</p>' : '';

			$value = isset( $post_metas[ $field['id'] ] ) ? $post_metas[ $field['id'] ] : $field['default'];

			return sprintf( '<div class="uxper-form-wrapper %s">
          <div class="uxper-form-title">
            <label class="uxper-form-label" for="%s">%s</label>%s
          </div>
          <div class="uxper-form-control">
            <textarea name="%s" id="%s" class="form-textarea" rows="5">%s</textarea>
            %s
          </div>
        </div>', implode( ' ', $classes ), $field['id'], $field['title'], $field['subtitle'], $field['id'], $field['id'], $value, $field['desc'] );
		}
	}
}