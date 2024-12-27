<?php

namespace Sala_Elementor;

use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit;

//@todo Not compatible with WPML.

class Widget_Shape_Divider extends Base {

	public function get_name() {
		return 'sala-shape-divider';
	}

	public function get_title() {
		return esc_html__( 'Shape Divider', 'sala' );
	}

	public function get_icon_part() {
		return 'eicon-square';
	}

	public function get_keywords() {
		return [ 'shape-divider', 'step' ];
	}

	protected function register_controls() {

		$this->start_controls_section( 'layout_section', [
			'label' => esc_html__( 'Layout', 'sala' ),
		] );

		$this->add_control( 'style', [
			'label'   => esc_html__( 'Style', 'sala' ),
			'type'    => Controls_Manager::SELECT,
			'default' => '01',
			'options' => [
				'01' => '01',
				'02' => '02',
			],
		] );

		$this->add_control( 'color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
		] );

		$this->add_control( 'color_dark', [
			'label'     => esc_html__( 'Color Dark', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
		] );

		$this->add_responsive_control( 'shape_size', [
			'label'     => esc_html__( 'Size', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'%' => [
					'min' => -500,
					'max' => 500,
				],
			],
			'default'   => [
				'unit' => '%',
				'size' => 170,
			],
		] );

		$this->add_responsive_control( 'shape_height', [
			'label'     => esc_html__( 'Height', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'%' => [
					'min' => 0,
					'max' => 500,
				],
			],
			'default'   => [
				'unit' => '%',
				'size' => 100,
			],
			'selectors' => [
				'{{WRAPPER}} .shape-divider' => 'height: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'shape_width', [
			'label'     => esc_html__( 'Width', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 500,
				],
			],
			'default'   => [
				'unit' => 'px',
				'size' => 200,
			],
			'selectors' => [
				'{{WRAPPER}} .shape-divider' => 'width: {{SIZE}}{{UNIT}};',
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
				'{{WRAPPER}} .shape-divider' => 'top: {{SIZE}}{{UNIT}};',
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
				'size' => -90,
			],
			'selectors' => [
				'{{WRAPPER}} .shape-divider' => 'right: {{SIZE}}{{UNIT}};',
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
				'{{WRAPPER}} .shape-divider' => 'left: {{SIZE}}{{UNIT}};',
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
				'{{WRAPPER}} .shape-divider' => 'bottom: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings 			= $this->get_settings_for_display();
		$enable_dark_theme 	= get_theme_mod( 'enable_dark_theme', 0 );
		$color 				= '#ffffff';
		$colo_dark 			= '#252428';

		if( $settings['color'] ){
			$color = $settings['color'];
		}
		if( $settings['color_dark'] ){
			$color_dark = $settings['color_dark'];
		}

		if( $enable_dark_theme ){
			if( $settings['style'] == '01' ){
				$style = 'background: radial-gradient(circle at 224% 25%, rgba(255, 255, 255, 0) 67%, rgba(255, 255, 255, 0) 50%, ' . $color_dark . ' 50%, ' . $color_dark . ' 100%); background-size: ' . esc_attr( $settings['shape_size']['size'] . $settings['shape_size']['unit'] ) . ' 200% !important;';
			} else {
				$style = 'background: radial-gradient(circle at -224% 25%, rgba(255, 255, 255, 0) 67%, rgba(255, 255, 255, 0) 50%, ' . $color_dark . ' 50%, ' . $color_dark . ' 100%); background-size: ' . esc_attr( $settings['shape_size']['size'] . $settings['shape_size']['unit'] ) . ' 200% !important;';
			}
		} else {
			if( $settings['style'] == '01' ){
				$style = 'background: radial-gradient(circle at 224% 25%, rgba(255, 255, 255, 0) 67%, rgba(255, 255, 255, 0) 50%, ' . $color . ' 50%, ' . $color . ' 100%); background-size: ' . esc_attr( $settings['shape_size']['size'] . $settings['shape_size']['unit'] ) . ' 200% !important;';
			} else {
				$style = 'background: radial-gradient(circle at -224% 25%, rgba(255, 255, 255, 0) 67%, rgba(255, 255, 255, 0) 50%, ' . $color . ' 50%, ' . $color . ' 100%); background-size: ' . esc_attr( $settings['shape_size']['size'] . $settings['shape_size']['unit'] ) . ' 200% !important;';
			}
		}


		?>
		<div class="shape-divider layout-<?php echo esc_attr( $settings['style'] ); ?>" style="<?php echo $style; ?>"></div>
		<?php
	}
}
