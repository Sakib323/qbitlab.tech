<?php

namespace Sala_Elementor;

use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color as Scheme_Color;

defined( 'ABSPATH' ) || exit;

class Widget_Separator extends Base {

	public function get_name() {
		return 'sala-separator';
	}

	public function get_title() {
		return esc_html__( 'Separator', 'sala' );
	}

	public function get_icon_part() {
		return 'eicon-divider';
	}

	public function get_keywords() {
		return [ 'divider', 'hr', 'line', 'border', 'separator' ];
	}

	protected function register_controls() {
		$this->start_controls_section( 'separator_section', [
			'label' => esc_html__( 'Separator', 'sala' ),
		] );

		$this->add_control( 'style', [
			'label'   => esc_html__( 'Style', 'sala' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'vertical-line'   => esc_html__( 'Vertical Line', 'sala' ),
				'horizontal-line' => esc_html__( 'Horizontal Line', 'sala' ),
			],
			'default' => 'vertical-line',
		] );

		$this->add_control( 'play_animate', [
			'label'        => esc_html__( 'Play Animate', 'sala' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => '1',
			'condition'    => [
				'style' => array( 'vertical-line' ),
			],
		] );

		$this->add_control( 'color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'scheme'    => [
				'type'  => Scheme_Color::get_type(),
				'value' => Scheme_Color::COLOR_1,
			],
			'selectors' => [
				'{{WRAPPER}} .sala-separator .inner' => 'color: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'align', [
			'label'        => esc_html__( 'Alignment', 'sala' ),
			'type'         => Controls_Manager::CHOOSE,
			'options'      => Widget_Utils::get_control_options_horizontal_alignment(),
			'prefix_class' => 'elementor%s-align-',
			'default'      => 'center',
		] );

		$this->add_responsive_control( 'width', [
			'label'      => esc_html__( 'Width', 'sala' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ '%', 'px' ],
			'range'      => [
				'px' => [
					'max' => 1000,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .sala-separator .inner' => 'width: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'height', [
			'label'      => esc_html__( 'Height', 'sala' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ '%', 'px' ],
			'range'      => [
				'px' => [
					'max' => 1000,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .sala-separator .inner' => 'height: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'sala-separator' );
		$this->add_render_attribute( 'wrapper', 'class', $settings['style'] );

		if ( $settings['play_animate'] === '1' ) {
			$this->add_render_attribute( 'wrapper', 'class', 'play-animate' );
		}
		?>
		<div <?php $this->print_attributes_string( 'wrapper' ); ?>>
			<div class="inner"></div>
		</div>
		<?php
	}

	protected function content_template() {
		// @formatter:off
		?>
		<#
		view.addRenderAttribute( 'wrapper', 'class', 'sala-separator' );

		view.addRenderAttribute( 'wrapper', 'class', settings.style );

		if( settings.play_animate === '1' ) {
			view.addRenderAttribute( 'wrapper', 'class', 'play-animate' );
		}
		#>
		<div {{{ view.getRenderAttributeString( 'wrapper' ) }}}>
			<div class="inner"></div>
		</div>
		<?php
		// @formatter:off
	}
}
