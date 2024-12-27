<?php

namespace Sala_Elementor;

use Elementor\Group_Control_Base;
use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit;

/**
 * Elementor tooltip control.
 *
 * A base control for creating tooltip control.
 *
 * @since 1.0.0
 */
class Group_Control_Tooltip extends Group_Control_Base {

	protected static $fields;

	public static function get_type() {
		return 'tooltip';
	}

	protected function init_fields() {
		$fields = [];

		$fields['skin'] = [
			'label'   => esc_html__( 'Tooltip Skin', 'sala' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				''        => esc_html__( 'Black', 'sala' ),
				'white'   => esc_html__( 'White', 'sala' ),
				'primary' => esc_html__( 'Primary', 'sala' ),
			],
			'default' => '',
		];

		$fields['position'] = [
			'label'   => esc_html__( 'Tooltip Position', 'sala' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'top'          => esc_html__( 'Top', 'sala' ),
				'right'        => esc_html__( 'Right', 'sala' ),
				'bottom'       => esc_html__( 'Bottom', 'sala' ),
				'left'         => esc_html__( 'Left', 'sala' ),
				'top-left'     => esc_html__( 'Top Left', 'sala' ),
				'top-right'    => esc_html__( 'Top Right', 'sala' ),
				'bottom-left'  => esc_html__( 'Bottom Left', 'sala' ),
				'bottom-right' => esc_html__( 'Bottom Right', 'sala' ),
			],
			'default' => 'top',
		];

		return $fields;
	}

	protected function get_default_options() {
		return [
			'popover' => [
				'starter_title' => _x( 'Tooltip', 'Tooltip Control', 'sala' ),
				'starter_name'  => 'enable',
				'starter_value' => 'yes',
				'settings'      => [
					'render_type' => 'template',
				],
			],
		];
	}
}
