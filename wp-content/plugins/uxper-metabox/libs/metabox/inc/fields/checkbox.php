<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'UXPER_Checkbox_Field' ) ) {
	class UXPER_Checkbox_Field {
		static function template( $field, $post_metas ) {

			$field = wp_parse_args( $field, array(
				'options' => array(),
				'inline'  => false,
				'default' => array()
			) );

			$field['subtitle'] = isset( $field['subtitle'] ) ? '<p class="uxper-form-sub-title">' . $field['subtitle'] . '</p>' : '';
			$field['desc']     = isset( $field['desc'] ) ? '<p class="uxper-form-description">' . $field['desc'] . '</p>' : '';

			$classes = array( 'uxper-checkbox-field' );

			if ( $field['inline'] ) {
				$classes[] = 'uxper-list-inline';
			}

			$value = isset( $post_metas[ $field['id'] ] ) ? $post_metas[ $field['id'] ] : $field['default'];
			$value = (array) $value;

			$list = '';
			if ( ! empty( $field['options'] ) ) {
				$list .= '<ul class="' . implode( ' ', $classes ) . '">';
				$tpl = '<li><label><input type="checkbox" class="uxper-checkbox" name="%s" value="%s" %s /> %s</label></li>';

				foreach ( $field['options'] as $val => $label ) {
					$list .= sprintf(
						$tpl,
						$field['id'] . '[]',
						$val,
						checked( in_array( $val, $value ), 1, false ),
						$label
					);
				}
				$list .= '</ul>';
			}

			return sprintf(
				'<div class="uxper-form-wrapper">
					<div class="uxper-form-title">
            <label class="uxper-form-label">%s</label>%s
          </div>
					<div class="uxper-form-control">%s %s</div>
				</div>',
				$field['title'],
				$field['subtitle'],
				$list,
				$field['desc']
			);
		}
	}
}