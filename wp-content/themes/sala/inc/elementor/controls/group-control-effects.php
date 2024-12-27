<?php

namespace Sala_Elementor;

use Elementor\Group_Control_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Group_Control_Effect extends Group_Control_Base {

	protected static $fields;

	/**
	 * Get group control type.
	 *
	 * Retrieve the group control type.
	 *
	 * @since  2.5.0
	 * @access public
	 * @static
	 */
	public static function get_type() {
		return 'motion_fx';
	}

	/**
	 * Init fields.
	 *
	 * Initialize group control fields.
	 *
	 * @since  2.5.0
	 * @access protected
	 */
	protected function init_fields() {
		$fields = [
			'motion_fx_scrolling' => [
				'label' => __( 'Scrolling Effects', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => __( 'Off', 'elementor' ),
				'label_on' => __( 'On', 'elementor' ),
				'render_type' => 'ui',
				'frontend_available' => true,
			],
		];

		$this->prepare_effects( 'scrolling', $fields );

		$fields['motion_fx_mouse'] = [
			'label' => __( 'Mouse Effects', 'elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'label_off' => __( 'Off', 'elementor' ),
			'label_on' => __( 'On', 'elementor' ),
			'separator' => 'before',
			'render_type' => 'none',
			'frontend_available' => true,
		];

		$this->prepare_effects( 'mouse', $fields );

		return $fields;
	}

	protected function get_default_options() {
		return [
			'popover' => false,
		];
	}

	private function get_scrolling_effects() {
		return [
			'translateY' => [
				'label' => __( 'Vertical Scroll', 'elementor' ),
				'fields' => [
					'direction' => [
						'label' => __( 'Direction', 'elementor' ),
						'type' => Controls_Manager::SELECT,
						'options' => [
							'up' => __( 'Up', 'elementor' ),
							'down' => __( 'Down', 'elementor' ),
						],
						'default' => 'up'
					],
					'speed' => [
						'label' => __( 'Speed', 'elementor' ),
						'type' => Controls_Manager::SLIDER,
						'default' => [
							'size' => 0.2,
						],
						'range' => [
							'px' => [
								'max' => 4,
								'step' => 0.1,
							],
						],
					],
				],
			],
			'translateX' => [
				'label' => __( 'Horizontal Scroll', 'elementor' ),
				'fields' => [
					'direction' => [
						'label' => __( 'Direction', 'elementor' ),
						'type' => Controls_Manager::SELECT,
						'options' => [
							'left' => __( 'To Left', 'elementor' ),
							'right' => __( 'To Right', 'elementor' ),
						],
						'default' => 'left'
					],
					'speed' => [
						'label' => __( 'Speed', 'elementor' ),
						'type' => Controls_Manager::SLIDER,
						'default' => [
							'size' => 0.2,
						],
						'range' => [
							'px' => [
								'max' => 4,
								'step' => 0.1,
							],
						],
					],
				],
			],
		];
	}

	// private function get_scrolling_effects() {
	// 	return [
	// 		'opacity' => [
	// 			'label' => __( 'Transparency', 'elementor-pro' ),
	// 			'fields' => [
	// 				'direction' => [
	// 					'label' => __( 'Direction', 'elementor-pro' ),
	// 					'type' => Controls_Manager::SELECT,
	// 					'default' => 'out-in',
	// 					'options' => [
	// 						'out-in' => 'Fade In',
	// 						'in-out' => 'Fade Out',
	// 						'in-out-in' => 'Fade Out In',
	// 						'out-in-out' => 'Fade In Out',
	// 					],
	// 				],
	// 				'level' => [
	// 					'label' => __( 'Level', 'elementor-pro' ),
	// 					'type' => Controls_Manager::SLIDER,
	// 					'default' => [
	// 						'size' => 10,
	// 					],
	// 					'range' => [
	// 						'px' => [
	// 							'min' => 1,
	// 							'max' => 10,
	// 							'step' => 0.1,
	// 						],
	// 					],
	// 				],
	// 				'range' => [
	// 					'label' => __( 'Viewport', 'elementor-pro' ),
	// 					'type' => Controls_Manager::SLIDER,
	// 					'default' => [
	// 						'sizes' => [
	// 							'start' => 20,
	// 							'end' => 80,
	// 						],
	// 						'unit' => '%',
	// 					],
	// 					'labels' => [
	// 						__( 'Bottom', 'elementor-pro' ),
	// 						__( 'Top', 'elementor-pro' ),
	// 					],
	// 					'scales' => 1,
	// 					'handles' => 'range',
	// 				],
	// 			],
	// 		],
	// 		'blur' => [
	// 			'label' => __( 'Blur', 'elementor-pro' ),
	// 			'fields' => [
	// 				'direction' => [
	// 					'label' => __( 'Direction', 'elementor-pro' ),
	// 					'type' => Controls_Manager::SELECT,
	// 					'default' => 'out-in',
	// 					'options' => [
	// 						'out-in' => 'Fade In',
	// 						'in-out' => 'Fade Out',
	// 						'in-out-in' => 'Fade Out In',
	// 						'out-in-out' => 'Fade In Out',
	// 					],
	// 				],
	// 				'level' => [
	// 					'label' => __( 'Level', 'elementor-pro' ),
	// 					'type' => Controls_Manager::SLIDER,
	// 					'default' => [
	// 						'size' => 7,
	// 					],
	// 					'range' => [
	// 						'px' => [
	// 							'min' => 1,
	// 							'max' => 15,
	// 						],
	// 					],
	// 				],
	// 				'range' => [
	// 					'label' => __( 'Viewport', 'elementor-pro' ),
	// 					'type' => Controls_Manager::SLIDER,
	// 					'default' => [
	// 						'sizes' => [
	// 							'start' => 20,
	// 							'end' => 80,
	// 						],
	// 						'unit' => '%',
	// 					],
	// 					'labels' => [
	// 						__( 'Bottom', 'elementor-pro' ),
	// 						__( 'Top', 'elementor-pro' ),
	// 					],
	// 					'scales' => 1,
	// 					'handles' => 'range',
	// 				],
	// 			],
	// 		],
	// 		'rotateZ' => [
	// 			'label' => __( 'Rotate', 'elementor-pro' ),
	// 			'fields' => [
	// 				'direction' => [
	// 					'label' => __( 'Direction', 'elementor-pro' ),
	// 					'type' => Controls_Manager::SELECT,
	// 					'options' => [
	// 						'' => __( 'To Left', 'elementor-pro' ),
	// 						'negative' => __( 'To Right', 'elementor-pro' ),
	// 					],
	// 				],
	// 				'speed' => [
	// 					'label' => __( 'Speed', 'elementor-pro' ),
	// 					'type' => Controls_Manager::SLIDER,
	// 					'default' => [
	// 						'size' => 1,
	// 					],
	// 					'range' => [
	// 						'px' => [
	// 							'max' => 10,
	// 							'step' => 0.1,
	// 						],
	// 					],
	// 				],
	// 				'affectedRange' => [
	// 					'label' => __( 'Viewport', 'elementor-pro' ),
	// 					'type' => Controls_Manager::SLIDER,
	// 					'default' => [
	// 						'sizes' => [
	// 							'start' => 0,
	// 							'end' => 100,
	// 						],
	// 						'unit' => '%',
	// 					],
	// 					'labels' => [
	// 						__( 'Bottom', 'elementor-pro' ),
	// 						__( 'Top', 'elementor-pro' ),
	// 					],
	// 					'scales' => 1,
	// 					'handles' => 'range',
	// 				],
	// 			],
	// 		],
	// 		'scale' => [
	// 			'label' => __( 'Scale', 'elementor-pro' ),
	// 			'fields' => [
	// 				'direction' => [
	// 					'label' => __( 'Direction', 'elementor-pro' ),
	// 					'type' => Controls_Manager::SELECT,
	// 					'default' => 'out-in',
	// 					'options' => [
	// 						'out-in' => 'Scale Up',
	// 						'in-out' => 'Scale Down',
	// 						'in-out-in' => 'Scale Down Up',
	// 						'out-in-out' => 'Scale Up Down',
	// 					],
	// 				],
	// 				'speed' => [
	// 					'label' => __( 'Speed', 'elementor-pro' ),
	// 					'type' => Controls_Manager::SLIDER,
	// 					'default' => [
	// 						'size' => 4,
	// 					],
	// 					'range' => [
	// 						'px' => [
	// 							'min' => -10,
	// 							'max' => 10,
	// 						],
	// 					],
	// 				],
	// 				'range' => [
	// 					'label' => __( 'Viewport', 'elementor-pro' ),
	// 					'type' => Controls_Manager::SLIDER,
	// 					'default' => [
	// 						'sizes' => [
	// 							'start' => 20,
	// 							'end' => 80,
	// 						],
	// 						'unit' => '%',
	// 					],
	// 					'labels' => [
	// 						__( 'Bottom', 'elementor-pro' ),
	// 						__( 'Top', 'elementor-pro' ),
	// 					],
	// 					'scales' => 1,
	// 					'handles' => 'range',
	// 				],
	// 			],
	// 		],
	// 	];
	// }

	private function get_mouse_effects() {
		return [
			'mouseTrack' => [
				'label' => __( 'Mouse Track', 'elementor' ),
				'fields' => [
					'direction' => [
						'label' => __( 'Direction', 'elementor' ),
						'type' => Controls_Manager::SELECT,
						'default' => 'opposite',
						'options' => [
							'opposite' => __( 'Opposite', 'elementor' ),
							'direct' => __( 'Direct', 'elementor' ),
						],
					],
					'speed' => [
						'label' => __( 'Speed', 'elementor' ),
						'type' => Controls_Manager::SLIDER,
						'default' => [
							'size' => 40,
						],
						'range' => [
							'px' => [
								'max' => 100,
								'step' => 10,
							],
						],
					],
				],
			],
			'tilt' => [
				'label' => __( '3D Tilt', 'elementor' ),
				'fields' => [
					'direction' => [
						'label' => __( 'Direction', 'elementor' ),
						'type' => Controls_Manager::SELECT,
						'default' => 'opposite',
						'options' => [
							'opposite' => __( 'Opposite', 'elementor' ),
							'direct' => __( 'Direct', 'elementor' ),
						],
					],
					'speed' => [
						'label' => __( 'Speed', 'elementor' ),
						'type' => Controls_Manager::SLIDER,
						'default' => [
							'size' => 40,
						],
						'range' => [
							'px' => [
								'max' => 100,
								'step' => 10,
							],
						],
					],
				],
			],
		];
	}

	private function prepare_effects( $effects_group, array &$fields ) {
		$method_name = "get_{$effects_group}_effects";

		$effects = $this->$method_name();

		foreach ( $effects as $effect_name => $effect_args ) {
			$args = [
				'label' => $effect_args['label'],
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'condition' => [
					'motion_fx_' . $effects_group => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			];

			if ( ! empty( $effect_args['separator'] ) ) {
				$args['separator'] = $effect_args['separator'];
			}

			$fields[ $effect_name . '_effect' ] = $args;

			$effect_fields = $effect_args['fields'];

			$first_field = & $effect_fields[ key( $effect_fields ) ];

			$first_field['popover']['start'] = true;

			end( $effect_fields );

			$last_field = & $effect_fields[ key( $effect_fields ) ];

			$last_field['popover']['end'] = true;

			reset( $effect_fields );

			foreach ( $effect_fields as $field_name => $field ) {
				$field = array_merge( $field, [
					'condition' => [
						'motion_fx_' . $effects_group => 'yes',
						$effect_name . '_effect' => 'yes',
					],
					'render_type' => 'none',
					'frontend_available' => true,
				] );

				$fields[ $effect_name . '_' . $field_name ] = $field;
			}
		}
	}
}
