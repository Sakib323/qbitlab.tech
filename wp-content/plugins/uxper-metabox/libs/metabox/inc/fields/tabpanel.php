<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'UXPER_Tabpanel_Field' ) ) {
	class UXPER_Tabpanel_Field {
		static function template( $field, $meta ) {
			$field['id'] = isset( $field['id'] ) ? $field['id'] : '';
			$classes     = array( 'uxper-tabpanel' );

			if ( isset( $field['display'] ) && $field['display'] == 'horizontal' ) {
				$classes[] = 'uxper-tabpanel-horizontal';
			} else {
				$classes[] = 'uxper-tabpanel-vertical';
			}

			$navs = $tabs = '';

			foreach ( $field['items'] as $tab ) {
				$icon = '';
				if ( isset( $tab['icon'] ) ) {
					$icon = self::render_icon( $tab['icon'] );
				}
				ob_start();
				printf(
					'<li>
						<a href="#">%s <span class="nav-tab-title">%s</span></a>
					</li>', $icon, $tab['title']
				);
				$navs .= ob_get_contents();
				ob_clean();

				ob_start();
				echo '<div class="tab">';
				if ( isset( $tab['fields'] ) && ! empty( $tab['fields'] ) ) {
					Uxper_Framework_Helper::render_form( $tab['fields'], $meta );
				}
				echo '</div>';
				$tabs .= ob_get_contents();
				ob_clean();
			}

			printf(
				'<div id="%s" class="%s">
					<ul class="uxper-nav-tabs">%s</ul>
					<div class="uxper-tab-content">%s</div>
				</div>', $field['id'], implode( ' ', $classes ), $navs, $tabs
			);
		}

		static function render_icon( $icon ) {
			if ( substr( $icon, 0, 3 ) == 'fa-' ) {
				$icon = '<i class="fa ' . $icon . '"></i>';
			} elseif ( substr( $icon, 0, 10 ) == 'dashicons-' ) {
				$icon = '<i class="dashicons ' . $icon . '"></i>';
			}

			return $icon;
		}

		static function enqueue_scripts() {
			wp_enqueue_style( 'uxper-tabpanel', UXPER_CSS_URL . 'tabpanel.css' );

			wp_enqueue_script( 'uxper-tabpanel', UXPER_JS_URL . 'tabpanel.js', array(
				'jquery-core'
			), false, true );
		}
	}
}