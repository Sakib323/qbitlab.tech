<?php

namespace Sala_Elementor;

use Elementor\Element_Base;

defined( 'ABSPATH' ) || exit;

class Control_Init {

	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function initialize() {
		require_once SALA_ELEMENTOR_DIR . '/class-font-awesome-pro.php';
		require_once SALA_ELEMENTOR_DIR . '/class-font-elementor.php';

		/**
		 * Register Controls.
		 */
		add_action( 'elementor/controls/controls_registered', array( $this, 'init_controls' ) );

		/**
		 * Edit Controls.
		 */
		// Add custom Motion Effect - Entrance Animation.
		add_filter( 'elementor/controls/animations/additional_animations', [
			$this,
			'add_custom_entrance_animations',
		] );

		/**
		 * Add custom shape divider
		 */
		add_filter( 'elementor/shapes/additional_shapes', [ $this, 'add_custom_shape_divider' ] );

		add_action( 'elementor/element/section/section_effects/after_section_start', [ $this, 'add_controls_group_to_element' ] );
		add_action( 'elementor/element/column/section_effects/after_section_start', [ $this, 'add_controls_group_to_element' ] );
		add_action( 'elementor/element/common/section_effects/after_section_start', [ $this, 'add_controls_group_to_element' ] );

		add_action( 'elementor/element/section/section_background/before_section_end', [ $this, 'add_controls_group_to_element_background' ] );
		add_action( 'elementor/element/column/section_style/before_section_end', [ $this, 'add_controls_group_to_element_background' ] );
	}

	public function add_custom_shape_divider( $additional_shapes ) {
		$additional_shapes['center-curve'] = [
			'title'        => esc_html__( 'Curve Alt', 'sala' ),
			'has_negative' => true,
			'height_only'  => true,
			'url'          => get_template_directory_uri() . '/assets/shape-divider/center-curve.svg',
			'path'         => get_template_directory() . '/assets/shape-divider/center-curve.svg',
		];

		$additional_shapes['tilt-curve'] = [
			'title'       => esc_html__( 'Tile Curve', 'sala' ),
			'has_flip'    => true,
			'height_only' => true,
			'url'         => get_template_directory_uri() . '/assets/shape-divider/curve-tilt.svg',
			'path'        => get_template_directory() . '/assets/shape-divider/curve-tilt.svg',
		];

		$additional_shapes['mountain-alt'] = [
			'title'       => esc_html__( 'Mountain Alt', 'sala' ),
			'has_flip'    => true,
			'height_only' => true,
			'url'         => get_template_directory_uri() . '/assets/shape-divider/mountain-alt.svg',
			'path'        => get_template_directory() . '/assets/shape-divider/mountain-alt.svg',
		];

		$additional_shapes['flash'] = [
			'title'       => esc_html__( 'Flash', 'sala' ),
			'has_flip'    => true,
			'height_only' => true,
			'url'         => get_template_directory_uri() . '/assets/shape-divider/flash-bg.svg',
			'path'        => get_template_directory() . '/assets/shape-divider/flash-bg.svg',
		];

		return $additional_shapes;
	}

	public function add_custom_entrance_animations( $animations ) {
		$animations['By Sala'] = [
			'salaFadeInDown'   => 'Sala - Fade In Down',
			'salaFadeInLeft'   => 'Sala - Fade In Left',
			'salaFadeInRight'  => 'Sala - Fade In Right',
			'salaFadeInUp'     => 'Sala - Fade In Up',
			'SalaSlideInDown'  => 'Sala - Slide In Down',
			'SalaSlideInLeft'  => 'Sala - Slide In Left',
			'SalaSlideInRight' => 'Sala - Slide In Right',
			'SalaSlideInUp'    => 'Sala - Slide In Up',
			'SalaJump'    	   => 'Sala - Jump',
		];

		return $animations;
	}

	public function add_controls_group_to_element( Element_Base $element ) {
		$exclude = [];

		$selector = '{{WRAPPER}}';

		if ( $element instanceof Element_Section ) {
			$exclude[] = 'motion_fx_mouse';
		} elseif ( $element instanceof Element_Column ) {
			$selector .= ' > .elementor-widget-wrap';
		} else {
			$selector .= ' > .elementor-widget-container';
		}

		$element->add_group_control(
			Group_Control_Effect::get_type(),
			[
				'name' => 'motion_fx',
				'selector' => $selector,
				'exclude' => $exclude,
			]
		);
	}

	public function add_controls_group_to_element_background( Element_Base $element ) {
		$element->start_injection( [
			'of' => 'background_bg_width_mobile',
		] );

		$element->add_group_control(
			Group_Control_Effect::get_type(),
			[
				'name' => 'background_motion_fx',
				'exclude' => [
					'rotateZ_effect',
					'tilt_effect',
					'transform_origin_x',
					'transform_origin_y',
				],
			]
		);

		$options = [
			'separator' => 'before',
			'conditions' => [
				'relation' => 'or',
				'terms' => [
					[
						'name' => 'background_background',
						'value' => 'classic',
					],
					[
						'terms' => [
							[
								'name' => 'background_background',
								'value' => 'gradient',
							],
							[
								'name' => 'background_color',
								'operator' => '!==',
								'value' => '',
							],
							[
								'name' => 'background_color_b',
								'operator' => '!==',
								'value' => '',
							],
						],
					],
				],
			],
		];

		$element->update_control( 'background_motion_fx_motion_fx_scrolling', $options );

		$element->update_control( 'background_motion_fx_motion_fx_mouse', $options );

		$element->end_injection();
	}

	/**
	 * @param \Elementor\Controls_Manager $controls_manager
	 *
	 * Include controls files and register them
	 */
	public function init_controls( $controls_manager ) {
		// Include controls files.
		require_once SALA_ELEMENTOR_DIR . '/controls/group-control-text-gradient.php';
		require_once SALA_ELEMENTOR_DIR . '/controls/group-control-text-stroke.php';
		require_once SALA_ELEMENTOR_DIR . '/controls/group-control-advanced-border.php';
		require_once SALA_ELEMENTOR_DIR . '/controls/group-control-button.php';
		require_once SALA_ELEMENTOR_DIR . '/controls/group-control-tooltip.php';

		// Include controls files.
		require_once SALA_ELEMENTOR_DIR . '/controls/group-control-effects.php';

		// Group Control.
		$controls_manager->add_group_control( Group_Control_Text_Gradient::get_type(), new Group_Control_Text_Gradient() );
		$controls_manager->add_group_control( Group_Control_Text_Stroke::get_type(), new Group_Control_Text_Stroke() );
		$controls_manager->add_group_control( Group_Control_Advanced_Border::get_type(), new Group_Control_Advanced_Border() );
		$controls_manager->add_group_control( Group_Control_Button::get_type(), new Group_Control_Button() );
		$controls_manager->add_group_control( Group_Control_Tooltip::get_type(), new Group_Control_Tooltip() );

		$controls_manager->add_group_control( Group_Control_Effect::get_type(), new Group_Control_Effect() );
	}

}

Control_Init::instance()->initialize();
