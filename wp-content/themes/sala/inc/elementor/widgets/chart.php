<?php

namespace Sala_Elementor;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || exit;

class Widget_Chart extends Base {

	public function get_name() {
		return 'sala-chart';
	}

	public function get_title() {
		return esc_html__( 'Modern Chart', 'sala' );
	}

	public function get_icon_part() {
		return 'eicon-skill-bar';
	}

	public function get_keywords() {
		return [ 'modern', 'chart' ];
	}

	public function get_script_depends() {
		return [ 'sala-widget-chart' ];
	}

	protected function register_controls() {
		$this->add_list_section();

		$this->add_styling_section();

		$this->add_text_style_section();

		$this->add_icon_style_section();
	}

	private function add_list_section() {
		$this->start_controls_section( 'list_section', [
			'label' => esc_html__( 'List', 'sala' ),
		] );

		$this->add_control( 'circle_right', [
			'label' => esc_html__( 'Circle Right', 'sala' ),
			'type'  => Controls_Manager::SWITCHER,
		] );

		$repeater = new Repeater();

		$repeater->add_control( 'item_color', [
			'label'   	=> esc_html__( 'Color', 'sala' ),
			'type'    	=> Controls_Manager::COLOR,
			'default'	=> '#c6db03',
			'selectors' => [
				'{{WRAPPER}} {{CURRENT_ITEM}} .icon' => 'background-color: {{VALUE}};',
			],
		] );

		$repeater->add_control( 'number', [
			'label'   => esc_html__( 'Number', 'sala' ),
			'type'    => Controls_Manager::NUMBER,
			'default' => 75,
			'min'     => 1,
			'max'     => 100,
		] );

		$repeater->add_control( 'text', [
			'label'       => esc_html__( 'Text', 'sala' ),
			'type'        => Controls_Manager::TEXTAREA,
			'default'     => esc_html__( 'Text', 'sala' ),
			'label_block' => true,
		] );

		$this->add_control( 'items', [
			'label'       => esc_html__( 'Items', 'sala' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
				[
					'text' => esc_html__( 'List Item #1', 'sala' ),
				],
				[
					'text' => esc_html__( 'List Item #2', 'sala' ),
				],
				[
					'text' => esc_html__( 'List Item #3', 'sala' ),
				],
			],
		] );

		$this->end_controls_section();
	}

	private function add_styling_section() {
		$this->start_controls_section( 'styling_section', [
			'label' => esc_html__( 'Styling', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'box_padding', [
			'label'      => esc_html__( 'Padding', 'sala' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .sala-chart .item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'background_color', [
			'label'   	=> esc_html__( 'Background Color', 'sala' ),
			'type'    	=> Controls_Manager::COLOR,
			'default'	=> '#ffffff',
		] );

		$this->end_controls_section();
	}

	private function add_text_style_section() {
		$this->start_controls_section( 'text_style_section', [
			'label' => esc_html__( 'Text', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'margin', [
			'label'      => esc_html__( 'Margin', 'sala' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .chart-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'text_typography',
			'label'    => esc_html__( 'Typography', 'sala' ),
			'selector' => '{{WRAPPER}} .text',
		] );

		$this->start_controls_tabs( 'text_style_tabs' );

		$this->start_controls_tab( 'text_style_normal_tab', [
			'label' => esc_html__( 'Normal', 'sala' ),
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'text',
			'selector' => '{{WRAPPER}} .text',
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'text_style_hover_tab', [
			'label' => esc_html__( 'Hover', 'sala' ),
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'hover_text',
			'selector' => '{{WRAPPER}} .link:hover .text',
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function add_icon_style_section() {
		$this->start_controls_section( 'icon_style_section', [
			'label' => esc_html__( 'Icon', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'icon_space', [
			'label'     => esc_html__( 'Spacing', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .icon' => 'margin-right: {{SIZE}}{{UNIT}};',
				'body.rtl {{WRAPPER}} .icon' => 'margin-left: {{SIZE}}{{UNIT}};',
				'body.rtl {{WRAPPER}} .icon' => 'margin-right: 0',
			],
		] );

		$this->add_responsive_control( 'width', [
			'label'          => esc_html__( 'Width', 'sala' ),
			'type'           => Controls_Manager::SLIDER,
			'default'        => [
				'unit' => 'px',
			],
			'tablet_default' => [
				'unit' => 'px',
			],
			'mobile_default' => [
				'unit' => 'px',
			],
			'size_units'     => [ 'px', '%' ],
			'range'          => [
				'%'  => [
					'min' => 1,
					'max' => 100,
				],
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors'      => [
				'{{WRAPPER}} .icon' => 'width: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'height', [
			'label'          => esc_html__( 'Height', 'sala' ),
			'type'           => Controls_Manager::SLIDER,
			'default'        => [
				'unit' => 'px',
			],
			'tablet_default' => [
				'unit' => 'px',
			],
			'mobile_default' => [
				'unit' => 'px',
			],
			'size_units'     => [ 'px', '%' ],
			'range'          => [
				'%'  => [
					'min' => 1,
					'max' => 100,
				],
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors'      => [
				'{{WRAPPER}} .icon' => 'height: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_control(
			'icon_radius',
			[
				'label' => __( 'Border Radius', 'sala' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if( $settings['circle_right'] === 'yes' ){
			$circle_right = 'circle-right';
		} else {
			$circle_right = '';
		}

		$this->add_render_attribute( 'wrapper', 'class', [
			'sala-chart',
			$circle_right,
		] );

		?>
		<div <?php $this->print_attributes_string( 'wrapper' ); ?>>

			<div class="sala-chart-list">
				<?php if ( $settings['items'] && count( $settings['items'] ) > 0 ) {
					$conic_gradient = array();
					$x = 0;
					foreach ( $settings['items'] as $key => $item ) {
						$item_key = 'item_' . $item['_id'];
						$this->add_render_attribute( $item_key, 'class', [
							'item',
							'elementor-repeater-item-' . $item['_id'],
						] );

						array_push($conic_gradient, $item['item_color'] . ' ' . $x . '%');
						$x += $item['number'];
						array_push($conic_gradient, $item['item_color'] . ' ' . $x . '%');

						?>
						<div <?php $this->print_attributes_string( $item_key ); ?>>

							<div class="chart-list">
								<div class="icon"></div>
								<?php if ( isset( $item['text'] ) ) { ?>
									<div class="text">
										<?php echo wp_kses_post( $item['text'] ); ?>: <?php echo wp_kses_post( $item['number'] ); ?>%
									</div>
								<?php } ?>
							</div>

						</div>
						<?php
					}
				}
				?>
			</div>
			<?php
				$conic_gradient_css = implode(", ", $conic_gradient);
				$bg = $settings['background_color'];
			?>
			<figure class="pie-chart" data-bg="<?php esc_attr_e( $bg ); ?>" style="background:
				radial-gradient(
					circle closest-side,
					<?php echo $bg; ?> 0,
					<?php echo $bg; ?> 49%,
					transparent 49%,
					transparent 100%,
					<?php echo $bg; ?> 0
				),
				conic-gradient(
					<?php echo $conic_gradient_css; ?>
			);"></figure>
		</div>
		<?php
	}


}
