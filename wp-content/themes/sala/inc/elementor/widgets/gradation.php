<?php

namespace Sala_Elementor;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || exit;

//@todo Not compatible with WPML.

class Widget_Gradation extends Base {

	public function get_name() {
		return 'sala-gradation';
	}

	public function get_title() {
		return esc_html__( 'Gradation', 'sala' );
	}

	public function get_icon_part() {
		return 'eicon-navigation-horizontal';
	}

	public function get_keywords() {
		return [ 'gradation', 'step' ];
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

		$this->add_responsive_control( 'grid_columns', [
			'label'          => esc_html__( 'Columns', 'sala' ),
			'type'           => Controls_Manager::NUMBER,
			'min'            => 1,
			'max'            => 12,
			'step'           => 1,
			'default'        => 3,
			'tablet_default' => 2,
			'mobile_default' => 1,
			'condition'    => [
				'style' => '02',
			],
		] );

		$repeater = new Repeater();

		$repeater->add_control( 'title', [
			'label'       => esc_html__( 'Title', 'sala' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'Title', 'sala' ),
			'label_block' => true,
		] );

		$repeater->add_control( 'description', [
			'label' => esc_html__( 'Description', 'sala' ),
			'type'  => Controls_Manager::TEXTAREA,
		] );

		$this->add_control( 'items', [
			'label'       => esc_html__( 'Items', 'sala' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
				[
					'title'       => esc_html__( 'Step #1', 'sala' ),
					'description' => esc_html__( 'Suspe ndisse suscipit sagittis leo sit met condimentum estibulum issim Lorem ipsum dolor sit amet, consectetur cium', 'sala' ),
				],
				[
					'title'       => esc_html__( 'Step #2', 'sala' ),
					'description' => esc_html__( 'Suspe ndisse suscipit sagittis leo sit met condimentum estibulum issim Lorem ipsum dolor sit amet, consectetur cium', 'sala' ),
				],
				[
					'title'       => esc_html__( 'Step #3', 'sala' ),
					'description' => esc_html__( 'Suspe ndisse suscipit sagittis leo sit met condimentum estibulum issim Lorem ipsum dolor sit amet, consectetur cium', 'sala' ),
				],
			],
			'title_field' => '{{{ title }}}',
		] );

		$this->end_controls_section();

		$this->add_styling_section();
	}

	private function add_styling_section() {
		$this->start_controls_section( 'styling_section', [
			'label' => esc_html__( 'Styling', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'text_align', [
			'label'     => esc_html__( 'Text Align', 'sala' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => Widget_Utils::get_control_options_text_align(),
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .item' => 'text-align: {{VALUE}};',
			],
		] );

		$this->add_control( 'count_heading', [
			'label'     => esc_html__( 'Count', 'sala' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'count_color', [
			'label'     => esc_html__( 'Background Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .count' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'count_space', [
			'label'     => esc_html__( 'Spacing', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 60,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .count-wrap' => 'margin-right: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_control( 'title_heading', [
			'label'     => esc_html__( 'Title', 'sala' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'label'    => esc_html__( 'Typography', 'sala' ),
			'selector' => '{{WRAPPER}} .title',
		] );

		$this->add_control( 'title_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .title' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'description_heading', [
			'label'     => esc_html__( 'Description', 'sala' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'description_typography',
			'label'    => esc_html__( 'Typography', 'sala' ),
			'selector' => '{{WRAPPER}} .description',
		] );

		$this->add_control( 'description_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .description' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute( 'wrappers', 'class', 'sala-gradation-style-' . $settings['style'] );
		$this->add_render_attribute( 'wrapper', 'class', 'sala-gradation column-' . $settings['grid_columns'] );
		?>
		<div <?php $this->print_attributes_string( 'wrappers' ); ?>>
			<div <?php $this->print_attributes_string( 'wrapper' ); ?>>
				<?php
				$loop_count = 0;
				if ( $settings['items'] && count( $settings['items'] ) > 0 ) {
					foreach ( $settings['items'] as $key => $item ) {
						$loop_count++;
						?>
						<div class="item">

							<div class="count-wrap">
								<div class="count"><?php echo esc_html( $loop_count ); ?></div>
							</div>

							<div class="content-wrap">
								<?php if ( isset( $item['title'] ) && $item['title'] != '' ) : ?>
									<h4 class="title"><?php echo esc_html( $item['title'] ); ?></h4>
								<?php endif; ?>

								<?php if ( isset( $item['description'] ) && $item['description'] != '' ) : ?>
									<div class="description"><?php echo esc_html( $item['description'] ); ?></div>
								<?php endif; ?>
							</div>
						</div>
						<?php
					}
				}
				?>
			</div>
		</div>
		<?php
	}
}
