<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'UXPER_Message_Field' ) ) {
	class UXPER_Message_Field {
		static function template( $field, $post_metas ) {

			$field = wp_parse_args( $field, array(
				'title'   => '',
				'message' => '',
				'kind'    => 'info',
			) );

			$classes   = array( 'uxper-message' );
			$classes[] = 'uxper-message-' . $field['kind'];
			$title     = '';
			if ( $field['title'] != '' ) {
				$title = '<h4 class="uxper-message-title">' . $field['title'] . '</h4>';
			}

			return sprintf( '
        <div><div class="%s">
          %s
          <div class="uxper-message-body">%s</div>
        </div></div>', implode( ' ', $classes ), $title, $field['message'] );
		}

		static function enqueue_scripts() {
			wp_enqueue_style( 'uxper-message', UXPER_CSS_URL . 'message.css' );
		}
	}
}