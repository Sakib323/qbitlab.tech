<?php

namespace Sala_Elementor;

use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit;

//@todo Not compatible with WPML.

class Widget_Shape_Blur extends Base {

	public function get_name() {
		return 'sala-shape-blur';
	}

	public function get_title() {
		return esc_html__( 'Shape Blur', 'sala' );
	}

	public function get_icon_part() {
		return 'eicon-square';
	}

	public function get_keywords() {
		return [ 'shape-blur', 'step' ];
	}

	protected function register_controls() {

		$this->start_controls_section( 'layout_section', [
			'label' => esc_html__( 'Layout', 'sala' ),
		] );

		$this->add_control( 'shape_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .shape-blur' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'shape_height', [
			'label'     => esc_html__( 'Height', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%' ],
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 500,
				],
				'%' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'default'   => [
				'unit' => 'px',
				'size' => 200,
			],
			'selectors' => [
				'{{WRAPPER}} .shape-blur' => 'height: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'shape_width', [
			'label'     => esc_html__( 'Width', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%' ],
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 500,
				],
				'%' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'default'   => [
				'unit' => 'px',
				'size' => 200,
			],
			'selectors' => [
				'{{WRAPPER}} .shape-blur' => 'width: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_control( 'shape_radius', [
			'label'      => esc_html__( 'Border Radius', 'sala' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .shape-blur' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'shape_opacity', [
			'label'     => esc_html__( 'Opacity', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max'  => 1,
					'min'  => 0.10,
					'step' => 0.01,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .shape-blur' => 'opacity: {{SIZE}};',
			],
		] );

		$this->add_responsive_control( 'filter_blur', [
			'label'     => esc_html__( 'Filter Blur', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'default'   => [
				'unit' => 'px',
				'size' => 50,
			],
			'selectors' => [
				'{{WRAPPER}} .shape-blur' => 'filter: blur({{SIZE}}{{UNIT}});',
			],
		] );

		$this->add_responsive_control( 'shape_top', [
			'label'     => esc_html__( 'Top', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => -300,
					'max' => 300,
				],
			],
			'default'   => [
				'unit' => 'px',
				'size' => 0,
			],
			'selectors' => [
				'{{WRAPPER}} .shape-blur' => 'top: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'shape_right', [
			'label'     => esc_html__( 'Right', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => -300,
					'max' => 300,
				],
			],
			'default'   => [
				'unit' => 'px',
				'size' => 0,
			],
			'selectors' => [
				'{{WRAPPER}} .shape-blur' => 'right: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'shape_left', [
			'label'     => esc_html__( 'Left', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => -300,
					'max' => 300,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .shape-blur' => 'left: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'shape_bottom', [
			'label'     => esc_html__( 'Bottom', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => -300,
					'max' => 300,
				],
			],
			'default'   => [
				'unit' => 'px',
				'size' => 0,
			],
			'selectors' => [
				'{{WRAPPER}} .shape-blur' => 'bottom: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings 			= $this->get_settings_for_display();

		?>
		<div class="shape-blur"></div>
		<?php
	}
}
