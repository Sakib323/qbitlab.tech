<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'UXPER_Accordion_Field' ) ) {
	class UXPER_Accordion_Field {

		static function template( $field, $meta ) {
			$field = wp_parse_args( $field, array(
				'multi_open' => false,
				'active'     => 0
			) );

			echo '<ul class="uxper-accordion" data-multi-open="' . $field['multi_open'] . '" >';

			foreach ( $field['items'] as $item ) {
				printf(
					'<li class="accordion-section">
        		<a href="#" class="accordion-title">%s</a>
        		<div class="accordion-content">',
					$item['title']
				);
				if ( isset( $item['fields'] ) && ! empty( $item['fields'] ) ) {
					Uxper_Framework_Helper::render_form( $item['fields'], $meta );
				}
				echo '</div></li>';
			}
			echo '</ul>';
		}

		static function enqueue_scripts() {
			wp_enqueue_style( 'uxper-accordion', UXPER_CSS_URL . 'accordion.css' );

			wp_enqueue_script( 'uxper-accordion', UXPER_JS_URL . 'accordion.js', array(
				'jquery-core'
			), false, true );
		}
	}
}