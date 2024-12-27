<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'UXPER_Radio_Field' ) ) {
	class UXPER_Radio_Field {
		static function template( $field, $post_metas ) {

			$field = wp_parse_args( $field, array(
				'options' => array(),
				'default' => '',
				'inline'  => false
			) );

			$field['subtitle'] = isset( $field['subtitle'] ) ? '<p class="uxper-form-sub-title">' . $field['subtitle'] . '</p>' : '';
			$field['desc']     = isset( $field['desc'] ) ? '<p class="uxper-form-description">' . $field['desc'] . '</p>' : '';

			$classes = array(
				'uxper-radio-field'
			);

			if ( $field['inline'] ) {
				$classes[] = 'uxper-list-inline';
			}

			$value = isset( $post_metas[ $field['id'] ] ) ? $post_metas[ $field['id'] ] : $field['default'];

			$list = '';
			if ( ! empty( $field['options'] ) ) {
				$list .= '<ul class="' . implode( ' ', $classes ) . '">';
				$tpl = '<li><label><input type="radio" class="uxper-radio" name="%s" value="%s" %s /> %s</label></li>';

				foreach ( $field['options'] as $val => $label ) {
					$list .= sprintf( $tpl, $field['id'], $val, checked( $val, $value, false ), $label );
				}
				$list .= '</ul>';
			}

			return sprintf(
				'<div class="uxper-form-wrapper">
          <div class="uxper-form-title">
            <label class="uxper-form-label">%s</label>%s
          </div>
					<div class="uxper-form-control">%s %s</div>
				</div>', $field['title'], $field['subtitle'], $list, $field['desc'] );
		}
	}
}