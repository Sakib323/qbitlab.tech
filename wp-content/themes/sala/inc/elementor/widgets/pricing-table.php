<?php

namespace Sala_Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;

defined( 'ABSPATH' ) || exit;

class Widget_Pricing_Table extends Base {

	public function get_name() {
		return 'sala-pricing-table';
	}

	public function get_title() {
		return esc_html__( 'Pricing Table', 'sala' );
	}

	public function get_icon_part() {
		return 'eicon-price-table';
	}

	public function get_keywords() {
		return [ 'modern', 'pricing', 'table' ];
	}

	public function get_script_depends() {
		return [
			'sala-widget-pricing-table',
		];
	}

	protected function register_controls() {
		$this->add_layout_section();

		$this->add_header_section();

		$this->add_pricing_section();

		$this->add_features_section();

		$this->add_footer_section();

		$this->add_ribbon_section();

		$this->add_general_style_section();

		$this->add_features_style_section();

		$this->register_common_button_style_section();

		$this->add_ribbon_style_section();

	}

	private function add_layout_section() {
		$this->start_controls_section( 'layout_section', [
			'label' => esc_html__( 'Layout', 'sala' ),
		] );

		$this->add_control( 'style', [
			'label'        => esc_html__( 'Style', 'sala' ),
			'type'         => Controls_Manager::SELECT,
			'options'      => [
				'01' => esc_html__( '01', 'sala' ),
				'02' => esc_html__( '02', 'sala' ),
			],
			'default'      => '01',
			'prefix_class' => 'sala-pricing-style-',
		] );

		$this->add_responsive_control( 'alignment', [
			'label'        => esc_html__( 'Alignment', 'sala' ),
			'type'         => Controls_Manager::CHOOSE,
			'options'      => Widget_Utils::get_control_options_text_align(),
			'prefix_class' => 'elementor%s-align-',
			'default'      => '',
		] );

		$this->add_control( 'additional', [
			'label'        => esc_html__( 'Additional', 'sala' ),
			'type'         => Controls_Manager::SELECT,
			'options'      => [
				'' => esc_html__( 'None', 'sala' ),
				'add_image' => esc_html__( 'Image', 'sala' ),
				'add_icon' => esc_html__( 'Icon', 'sala' ),
			],
			'default'      => '',
		] );

		$this->add_control( 'image', [
			'label'   => esc_html__( 'Image', 'sala' ),
			'type'    => Controls_Manager::MEDIA,
			'dynamic' => [
				'active' => true,
			],
			'condition' => [
				'additional' => 'add_image',
			],
		] );

		$this->add_control( 'box_icon', [
			'label'      => esc_html__( 'Icon', 'sala' ),
			'show_label' => false,
			'type'       => Controls_Manager::ICONS,
			'default'    => [
				'value'   => 'fas fa-star',
				'library' => 'fa-solid',
			],
			'condition' => [
				'additional' => 'add_icon',
			],
		] );

		$this->add_control( 'box_icon_size', [
			'label'     => esc_html__( 'Icon Size', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 10,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .sala-pricing .sala-image i' => 'font-size: {{SIZE}}{{UNIT}};',
			],
			'condition' => [
				'additional' => 'add_icon',
			],
		] );

		$this->add_control( 'additional_top', [
			'label'     => esc_html__( 'Additional Top', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => -500,
					'max' => 500,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .sala-pricing .sala-image' => 'top: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_control( 'additional_right', [
			'label'     => esc_html__( 'Additional Right', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => -500,
					'max' => 500,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .sala-pricing .sala-image' => 'right: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();
	}

	private function add_header_section() {
		$this->start_controls_section( 'header_section', [
			'label' => esc_html__( 'Header', 'sala' ),
		] );

		$this->add_control( 'heading', [
			'label'   => esc_html__( 'Title', 'sala' ),
			'type'    => Controls_Manager::TEXT,
			'default' => esc_html__( 'Enter your title', 'sala' ),
		] );

		$this->add_control( 'sub_heading', [
			'label' => esc_html__( 'Description', 'sala' ),
			'type'  => Controls_Manager::TEXT,
		] );

		$this->add_control( 'heading_tag', [
			'label'   => esc_html__( 'Heading Tag', 'sala' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'h2' => 'H2',
				'h3' => 'H3',
				'h4' => 'H4',
				'h5' => 'H5',
				'h6' => 'H6',
			],
			'default' => 'h3',
		] );

		$this->end_controls_section();
	}

	private function add_pricing_section() {
		$this->start_controls_section( 'pricing_section', [
			'label' => esc_html__( 'Pricing', 'sala' ),
		] );

		$this->add_control( 'currency', [
			'label'   => esc_html__( 'Currency', 'sala' ),
			'type'    => Controls_Manager::TEXT,
			'default' => '$',
		] );

		$this->add_control( 'price', [
			'label'   => esc_html__( 'Price', 'sala' ),
			'type'    => Controls_Manager::TEXT,
			'default' => '39.99',
		] );

		$this->add_control( 'period', [
			'label'   => esc_html__( 'Period', 'sala' ),
			'type'    => Controls_Manager::TEXT,
			'default' => esc_html__( 'Monthly', 'sala' ),
		] );

		$this->add_control( 'pricing_description', [
			'label' => esc_html__( 'Pricing Description', 'sala' ),
			'type'  => Controls_Manager::TEXT,
		] );

		$this->end_controls_section();
	}

	private function add_features_section() {
		$this->start_controls_section( 'features_section', [
			'label' => esc_html__( 'Features', 'sala' ),
		] );

		$repeater = new Repeater();

		$repeater->add_control( 'text', [
			'label'       => esc_html__( 'Text', 'sala' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'Text', 'sala' ),
			'label_block' => true,
		] );

		$repeater->add_control( 'icon', [
			'label' => esc_html__( 'Icon', 'sala' ),
			'type'  => Controls_Manager::ICONS,
		] );

		$repeater->add_control( 'icon_color', [
			'label'     => esc_html__( 'Icon Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} {{CURRENT_ITEM}} i' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'features', [
			/*'label'       => esc_html__( 'Features', 'sala' ),
			'show_label'  => false,*/
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
			'title_field' => '{{{ elementor.helpers.renderIcon( this, icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}} {{{ text }}}',
		] );

		$this->end_controls_section();
	}

	private function add_footer_section() {
		$this->start_controls_section( 'footer_section', [
			'label' => esc_html__( 'Footer', 'sala' ),
		] );

		$this->add_group_control( Group_Control_Button::get_type(), [
			'name' => 'button',
		] );

		$this->add_control( 'note', [
			'label'       => esc_html__( 'Note', 'sala' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'No credit card required', 'sala' ),
			'label_block' => true,
		] );

		$this->add_control( 'note_color', [
			'label'     => esc_html__( 'Note Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .sala-pricing .note' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_section();
	}

	private function add_ribbon_section() {
		$this->start_controls_section( 'ribbon_section', [
			'label' => esc_html__( 'Ribbon', 'sala' ),
		] );

		$this->add_control( 'show_ribbon', [
			'label' => esc_html__( 'Show', 'sala' ),
			'type'  => Controls_Manager::SWITCHER,
		] );

		$this->add_control( 'ribbon_style', [
			'label'        => esc_html__( 'Style', 'sala' ),
			'type'         => Controls_Manager::SELECT,
			'options'      => [
				'01' => esc_html__( '01', 'sala' ),
				'02' => esc_html__( '02', 'sala' ),
			],
			'default'      => '01',
			'prefix_class' => 'ribbon-style-',
			'condition' => [
				'show_ribbon' => 'yes',
			],
		] );

		$this->add_control( 'ribbon_title', [
			'label'     => esc_html__( 'Title', 'sala' ),
			'type'      => Controls_Manager::TEXT,
			'default'   => esc_html__( 'Popular', 'sala' ),
			'condition' => [
				'show_ribbon' => 'yes',
			],
		] );

		$this->end_controls_section();
	}

	private function add_general_style_section() {
		$this->start_controls_section( 'general_style_section', [
			'label'     => esc_html__( 'General', 'sala' ),
			'tab'       => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'general_text_color', [
			'label'     => esc_html__( 'Text Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .title, {{WRAPPER}} .price-wrap-inner > div,{{WRAPPER}} .pricing-description,{{WRAPPER}} .sala-pricing-features li' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_section();
	}

	private function add_features_style_section() {
		$this->start_controls_section( 'features_style_section', [
			'label'     => esc_html__( 'Features', 'sala' ),
			'tab'       => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'features_padding', [
			'label'      => esc_html__( 'Padding', 'sala' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .sala-pricing-features li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'margin', [
			'label'      => esc_html__( 'Margin', 'sala' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .sala-pricing-features' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_group_control( Group_Control_Advanced_Border::get_type(), [
			'name'     => 'features_border',
			'selector' => '{{WRAPPER}} .sala-pricing-features li',
		] );

		$this->end_controls_section();
	}

	private function add_ribbon_style_section() {
		$this->start_controls_section( 'ribbon_style_section', [
			'label'     => esc_html__( 'Ribbon', 'sala' ),
			'tab'       => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'ribbon_background', [
			'label'     => esc_html__( 'Background', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .sala-pricing .sala-pricing-ribbon' => 'background: {{VALUE}};',
			],
		] );

		$this->add_control( 'ribbon_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .sala-pricing .sala-pricing-ribbon' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'ribbon_top', [
			'label'     => esc_html__( 'Top', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => -200,
					'max' => 200,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .sala-pricing .sala-pricing-ribbon' => 'top: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_control( 'ribbon_right', [
			'label'     => esc_html__( 'Right', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => -200,
					'max' => 200,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .sala-pricing .sala-pricing-ribbon' => 'right: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'sala-pricing' );

		$this->add_render_attribute( 'heading', 'class', 'title' );
		?>
		<div <?php $this->print_attributes_string( 'wrapper' ); ?>>
			<div class="inner">

				<?php if ( $settings['ribbon_style'] == '01' ) : ?>

				<?php $this->print_pricing_ribbon(); ?>

				<?php endif; ?>

				<?php if ( ! empty( $settings['image']['url'] ) ) : ?>
					<div class="sala-image image">
						<?php echo \Sala_Image::get_elementor_attachment( [
							'settings' => $settings,
						] ); ?>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $settings['box_icon'] ) ) : ?>
					<div class="sala-image image">
						<?php $this->render_icon( $settings, $settings['box_icon'], [ 'aria-hidden' => 'true' ], false, 'icon' ); ?>
					</div>
				<?php endif; ?>



				<div class="sala-pricing-header">
					<?php if ( ! empty( $settings['heading'] ) ) : ?>
						<div class="heading-wrap">
							<?php printf( '<%1$s %2$s>%3$s</%1$s>', $settings['heading_tag'], $this->get_render_attribute_string( 'heading' ), $settings['heading'] ); ?>
						</div>
						<?php if ( $settings['ribbon_style'] == '02' ) : ?>

							<?php $this->print_pricing_ribbon(); ?>

						<?php endif; ?>
					<?php endif; ?>

					<?php if ( ! empty( $settings['sub_heading'] ) ) : ?>
						<div class="sub-heading-wrap">
							<?php echo esc_html( $settings['sub_heading'] ); ?>
						</div>
					<?php endif; ?>
				</div>

				<?php $this->print_pricing(); ?>

				<div class="sala-pricing-body">
					<?php if ( $settings['features'] && count( $settings['features'] ) > 0 ) { ?>
						<ul class="sala-pricing-features" data-count="<?php echo count($settings['features']); ?>">
							<?php foreach ( $settings['features'] as $item ) {
								$item_key = 'item_' . $item['_id'];
								$this->add_render_attribute( $item_key, 'class', [
									'item',
									'elementor-repeater-item-' . $item['_id'],
								] );
								?>
								<li <?php $this->print_render_attribute_string( $item_key ); ?>>
									<?php if ( ! empty( $item['icon']['value'] ) ) { ?>
										<div class="sala-icon icon">
											<?php $this->render_icon( $settings, $item['icon'], [ 'aria-hidden' => 'true' ], false, 'icon' ); ?>
										</div>
									<?php } ?>
									<?php echo wp_kses( $item['text'], 'sala-default' ); ?>
								</li>
							<?php } ?>
						</ul>
					<?php } ?>
				</div>

				<?php $this->print_pricing_footer(); ?>

			</div>
		</div>
		<?php
	}

	private function print_pricing_ribbon() {
		$settings = $this->get_settings_for_display();

		if ( 'yes' !== $settings['show_ribbon'] || empty( $settings['ribbon_title'] ) ) {
			return;
		}
		?>
		<div class="sala-pricing-ribbon">
			<span><?php echo esc_html( $settings['ribbon_title'] ); ?></span>
		</div>
		<?php
	}

	private function print_pricing() {
		$settings = $this->get_settings_for_display();

		if ( $settings['price'] === '' ) {
			return;
		}
		?>
		<div class="price-wrap">
			<div class="price-wrap-inner">

				<?php if ( ! empty( $settings['currency'] ) ) : ?>
					<div class="sala-pricing-currency"><?php echo esc_html( $settings['currency'] ); ?></div>
				<?php endif; ?>

				<div class="sala-pricing-price"><?php echo esc_html( $settings['price'] ); ?></div>

				<?php if ( ! empty( $settings['period'] ) && '02' !== $settings['style'] ) : ?>
					<div class="sala-pricing-period"><?php echo esc_html( $settings['period'] ); ?></div>
				<?php endif; ?>
			</div>

			<?php if ( ! empty( $settings['period'] ) && '02' === $settings['style'] ) : ?>
				<div class="sala-pricing-period"><?php echo esc_html( $settings['period'] ); ?></div>
			<?php endif; ?>

			<?php if ( ! empty( $settings['pricing_description'] ) ) : ?>
				<div class="pricing-description">
					<?php echo esc_html( $settings['pricing_description'] ); ?>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}

	private function print_pricing_footer() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['button_text'] ) || empty( $settings['button_link'] ) ) {
			return;
		}
		?>
		<div class="sala-pricing-footer">
			<?php $this->render_common_button(); ?>
		</div>
		<?php if ( ! empty( $settings['note'] ) ) : ?>
			<div class="note">
				<?php echo esc_html( $settings['note'] ); ?>
			</div>
		<?php endif; ?>
		<?php
	}
}
