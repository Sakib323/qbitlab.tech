<?php

namespace Sala_Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;
use Elementor\Core\Schemes\Typography as Scheme_Typography;

defined( 'ABSPATH' ) || exit;

class Widget_Button extends Base {

	public function get_name() {
		return 'sala-button';
	}

	public function get_title() {
		return esc_html__( 'Advanced Button', 'sala' );
	}

	public function get_icon_part() {
		return 'eicon-button';
	}

	protected function register_controls() {
		$this->add_button_settings_section();

		$this->add_button_badge_section();

		$this->add_wrapper_section();

		$this->add_skin_section();

		$this->add_text_style_section();

		$this->add_icon_style_section();

		$this->add_badge_style_section();
	}

	private function add_button_settings_section() {
		$this->start_controls_section( 'button_settings_section', [
			'label' => esc_html__( 'Button', 'sala' ),
		] );

		$this->add_control( 'style', [
			'label'   => esc_html__( 'Style', 'sala' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'flat',
			'options' => Widget_Utils::get_button_style(),
		] );

		$this->add_control( 'text', [
			'label'       => esc_html__( 'Text', 'sala' ),
			'type'        => Controls_Manager::TEXT,
			'dynamic'     => [
				'active' => true,
			],
			'default'     => esc_html__( 'Click here', 'sala' ),
			'placeholder' => esc_html__( 'Click here', 'sala' ),
		] );

		$this->add_control( 'icon', [
			'label'       => esc_html__( 'Icon', 'sala' ),
			'type'        => Controls_Manager::ICONS,
			'label_block' => true,
		] );

		$this->add_control( 'action', [
			'label'       => esc_html__( 'Action', 'sala' ),
			'description' => esc_html__( 'To make smooth scroll action work then input button link like this: #about-us-section.', 'sala' ),
			'type'        => Controls_Manager::SELECT,
			'default'     => '',
			'options'     => [
				''              => esc_html__( 'Normal', 'sala' ),
				'smooth_scroll' => esc_html__( 'Smooth scroll to a section', 'sala' ),
				'popup_video'   => esc_html__( 'Open Popup Video', 'sala' ),
			],
		] );

		$this->add_control( 'link', [
			'label'       => esc_html__( 'Link', 'sala' ),
			'type'        => Controls_Manager::URL,
			'dynamic'     => [
				'active' => true,
			],
			'placeholder' => esc_attr__( 'https://your-link.com', 'sala' ),
			'default'     => [
				'url' => '#',
			],
		] );

		$this->add_control( 'view', [
			'label'   => esc_html__( 'View', 'sala' ),
			'type'    => Controls_Manager::HIDDEN,
			'default' => 'traditional',
		] );

		$this->add_control( 'button_css_id', [
			'label'       => esc_html__( 'Button ID', 'sala' ),
			'type'        => Controls_Manager::TEXT,
			'dynamic'     => [
				'active' => true,
			],
			'default'     => '',
			'title'       => esc_html__( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'sala' ),
			'label_block' => false,
			'description' => wp_kses( __( 'Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows <code>A-z 0-9</code> & underscore chars without spaces.', 'sala' ), 'sala-default' ),
			'separator'   => 'before',
		] );

		$this->end_controls_section();
	}

	private function add_button_badge_section() {
		$this->start_controls_section( 'button_badge_section', [
			'label' => esc_html__( 'Badge', 'sala' ),
		] );

		$this->add_control( 'badge_text', [
			'label'       => esc_html__( 'Text', 'sala' ),
			'type'        => Controls_Manager::TEXT,
			'dynamic'     => [
				'active' => true,
			],
			'placeholder' => esc_html__( '$59', 'sala' ),
		] );

		$this->end_controls_section();
	}

	private function add_wrapper_section() {
		$this->start_controls_section( 'button_wrapper_section', [
			'label' => esc_html__( 'Wrapper', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'alignment', [
			'label'        => esc_html__( 'Alignment', 'sala' ),
			'type'         => Controls_Manager::CHOOSE,
			'options'      => Widget_Utils::get_control_options_text_align(),
			'prefix_class' => 'elementor%s-align-',
			'default'      => '',
		] );

		$this->add_control( 'size', [
			'label'          => esc_html__( 'Size', 'sala' ),
			'type'           => Controls_Manager::SELECT,
			'default'        => 'nm',
			'options'        => [
				'custom' => esc_html__( 'Custom', 'sala' ),
				'xs'     => esc_html__( 'Extra Small', 'sala' ),
				'sm'     => esc_html__( 'Small', 'sala' ),
				'nm'     => esc_html__( 'Normal', 'sala' ),
				'lg'     => esc_html__( 'Large', 'sala' ),
			],
			'style_transfer' => true,
		] );

		$this->add_control( 'min_height', [
			'label'      => esc_html__( 'Min Height', 'sala' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'max'  => 100,
					'step' => 1,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .sala-ele-button' => 'min-height: {{SIZE}}{{UNIT}};',
			],
			'condition'  => [
				'size' => 'custom',
			],
		] );

		$this->add_control( 'width', [
			'label'      => esc_html__( 'Width', 'sala' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ '%', 'px' ],
			'range'      => [
				'%'  => [
					'max'  => 100,
					'step' => 1,
				],
				'px' => [
					'max'  => 1000,
					'step' => 1,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .sala-ele-button' => 'width: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'padding', [
			'label'      => esc_html__( 'Padding', 'sala' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .sala-ele-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'rounded', [
			'label'      => esc_html__( 'Rounded', 'sala' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .sala-ele-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();
	}

	private function add_skin_section() {
		$this->start_controls_section( 'skin_section', [
			'label' => esc_html__( 'Skin', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->start_controls_tabs( 'button_skin_tabs' );

		$this->start_controls_tab( 'button_skin_normal_tab', [
			'label' => esc_html__( 'Normal', 'sala' ),
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'button',
			'types'    => [ 'classic', 'gradient' ],
			'selector' => '{{WRAPPER}} .sala-ele-button:before',
		] );

		$this->add_control( 'button_border_color', [
			'label'     => esc_html__( 'Border', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .sala-ele-button' => 'border-color: {{VALUE}};',
			],
			'condition' => [
				'style!' => [ 'flat', 'bottom-line', 'left-line' ],
			],
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'button_box_shadow',
			'selector' => '{{WRAPPER}} .sala-ele-button',
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'button_skin_hover_tab', [
			'label' => esc_html__( 'Hover', 'sala' ),
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'button_hover',
			'types'    => [ 'classic', 'gradient' ],
			'selector' => '{{WRAPPER}} .sala-ele-button:after',
		] );

		$this->add_control( 'button_hover_border_color', [
			'label'     => esc_html__( 'Border', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .sala-ele-button:hover' => 'border-color: {{VALUE}};',
			],
			'condition' => [
				'style!' => [ 'flat', 'bottom-line', 'left-line' ],
			],
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'button_hover_box_shadow',
			'selector' => '{{WRAPPER}} .sala-ele-button:hover',
		] );

		$this->add_control( 'hover_animation', [
			'label' => esc_html__( 'Hover Animation', 'sala' ),
			'type'  => Controls_Manager::HOVER_ANIMATION,
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function add_text_style_section() {
		$this->start_controls_section( 'text_style_section', [
			'label' => esc_html__( 'Text', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'text',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
			'selector' => '{{WRAPPER}} .sala-ele-button',
		] );

		$this->start_controls_tabs( 'text_style_tabs' );

		$this->start_controls_tab( 'text_style_normal_tab', [
			'label' => esc_html__( 'Normal', 'sala' ),
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'text',
			'selector' => '{{WRAPPER}} .sala-ele-button .button-text',
		] );

		$this->add_control( 'button_line_color', [
			'label'     => esc_html__( 'Line', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .sala-ele-button.style-bottom-line .button-content-wrapper:before' => 'background: {{VALUE}};',
				'{{WRAPPER}} .sala-ele-button.style-left-line .button-content-wrapper:before'   => 'background: {{VALUE}};',
			],
			'condition' => [
				'style' => [ 'bottom-line', 'left-line' ],
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'text_style_hover_tab', [
			'label' => esc_html__( 'Hover', 'sala' ),
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'hover_text',
			'selector' => '{{WRAPPER}} .sala-ele-button:hover .button-text',
		] );

		$this->add_control( 'hover_button_line_color', [
			'label'     => esc_html__( 'Line', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .sala-ele-button.style-bottom-line .button-content-wrapper:after' => 'background: {{VALUE}};',
				'{{WRAPPER}} .sala-ele-button.style-left-line .button-content-wrapper:after'   => 'background: {{VALUE}};',
			],
			'condition' => [
				'style' => [ 'bottom-line', 'left-line' ],
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function add_icon_style_section() {
		$this->start_controls_section( 'icon_section', [
			'label'     => esc_html__( 'Icon', 'sala' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'icon[value]!' => '',
			],
		] );

		$this->add_control( 'icon_align', [
			'label'       => esc_html__( 'Position', 'sala' ),
			'type'        => Controls_Manager::CHOOSE,
			'options'     => [
				'left'  => [
					'title' => esc_html__( 'Left', 'sala' ),
					'icon'  => 'eicon-h-align-left',
				],
				'right' => [
					'title' => esc_html__( 'Right', 'sala' ),
					'icon'  => 'eicon-h-align-right',
				],
			],
			'default'     => 'left',
			'toggle'      => false,
			'label_block' => false,
		] );

		$this->add_control( 'icon_indent', [
			'label'     => esc_html__( 'Spacing', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max' => 50,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .sala-ele-button.icon-left .button-icon'  => 'margin-right: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .sala-ele-button.icon-right .button-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'icon_font_size', [
			'label'     => esc_html__( 'Font Size', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 8,
					'max' => 30,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .sala-ele-button .button-icon' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->start_controls_tabs( 'icon_skin_tabs' );

		$this->start_controls_tab( 'icon_skin_normal_tab', [
			'label' => esc_html__( 'Normal', 'sala' ),
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'icon',
			'selector' => '{{WRAPPER}} .sala-ele-button .button-icon',
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'icon_skin_hover_tab', [
			'label' => esc_html__( 'Hover', 'sala' ),
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'icon_hover',
			'selector' => '{{WRAPPER}} .sala-ele-button:hover .button-icon',
		] );


		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function add_badge_style_section() {
		$this->start_controls_section( 'badge_style_section', [
			'label'     => esc_html__( 'Badge', 'sala' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'badge_text!' => '',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'badge',
			'selector' => '{{WRAPPER}} .button-badge',
		] );

		$this->add_control( 'badge_text_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .button-badge' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'badge_background_color', [
			'label'     => esc_html__( 'Background', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .button-badge' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'badge_padding', [
			'label'      => esc_html__( 'Padding', 'sala' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .sala-ele-button .button-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'badge_rounded', [
			'label'      => esc_html__( 'Rounded', 'sala' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .sala-ele-button .button-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'sala-ele-button-wrapper' );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'button', $settings['link'] );
			$this->add_render_attribute( 'button', 'class', 'sala-ele-button-link' );
		}

		$this->add_render_attribute( 'button', 'class', 'sala-ele-button' );
		$this->add_render_attribute( 'button', 'role', 'button' );

		if ( ! empty( $settings['button_css_id'] ) ) {
			$this->add_render_attribute( 'button', 'id', $settings['button_css_id'] );
		}

		if ( ! empty( $settings['style'] ) ) {
			$this->add_render_attribute( 'button', 'class', 'style-' . $settings['style'] );
		}

		if ( ! empty( $settings['size'] ) ) {
			$this->add_render_attribute( 'button', 'class', 'sala-ele-button-' . $settings['size'] );
		}

		if ( ! empty( $settings['action'] ) ) {
			switch ( $settings['action'] ) {
				case 'smooth_scroll';
					$this->add_render_attribute( 'button', 'class', 'smooth-scroll-link' );
					break;
				case 'popup_video';
					$this->add_render_attribute( 'wrapper', 'class', 'sala-popup-video' );
					break;
			}
		}

		if ( ! empty( $settings['icon_align'] ) ) {
			$this->add_render_attribute( 'button', 'class', 'icon-' . $settings['icon_align'] );
		}

		if ( $settings['hover_animation'] ) {
			$this->add_render_attribute( 'button', 'class', 'elementor-animation-' . $settings['hover_animation'] );
		}

		?>
		<div <?php $this->print_attributes_string( 'wrapper' ); ?>>
			<a <?php $this->print_attributes_string( 'button' ); ?>>
				<?php $this->render_text(); ?>

				<?php $this->print_badge(); ?>
			</a>
		</div>
		<?php
	}

	private function print_badge() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['badge_text'] ) ) {
			return;
		}
		?>
		<div class="button-badge">
			<div class="badge-text"><?php echo esc_html( $settings['badge_text'] ); ?></div>
		</div>
		<?php
	}

	protected function content_template() {
		// @formatter:off
		?>
		<#
		view.addRenderAttribute( 'text', 'class', 'button-text' );

		view.addInlineEditingAttributes( 'text', 'none' );

		var iconHTML = elementor.helpers.renderIcon( view, settings.icon, { 'aria-hidden': true }, 'i' , 'object' );
		#>
		<div class="sala-ele-button-wrapper">
			<a id="{{ settings.button_css_id }}"
			   class="sala-ele-button style-{{ settings.style }} sala-ele-button-{{ settings.size }} elementor-animation-{{ settings.hover_animation }} icon-{{ settings.icon_align }}"
			   href="{{ settings.link.url }}" role="button">
				<div class="button-content-wrapper">

					<# if ( iconHTML.rendered && settings.icon_align == 'left' ) { #>
					<span class="button-icon">
						{{{ iconHTML.value }}}
					</span>
					<# } #>

					<# if ( settings.text ) { #>
						<span {{{ view.getRenderAttributeString( 'text' ) }}}>{{{ settings.text }}}</span>
					<# } #>

					<# if ( iconHTML.rendered && settings.icon_align == 'right' ) { #>
					<span class="button-icon">
						{{{ iconHTML.value }}}
					</span>
					<# } #>

				</div>

				<# if( settings.badge_text ) { #>
					<div class="button-badge">
						<div class="badge-text">{{{ settings.badge_text }}}</div>
					</div>
				<# } #>
			</a>
		</div>
		<?php
		// @formatter:off
	}

	private function render_text() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( [
			'content-wrapper' => [
				'class' => 'button-content-wrapper',
			],
			'icon'      => [
				'class' => [
					'button-icon',
				],
			],
			'text'            => [
				'class' => 'button-text',
			],
		] );

		$this->add_inline_editing_attributes( 'text', 'none' );
		?>
		<div <?php $this->print_attributes_string( 'content-wrapper' ); ?>>
			<?php if ( ! empty( $settings['icon'] ) && $settings['icon_align'] === 'left' ) : ?>
				<span <?php $this->print_attributes_string( 'icon' ); ?>>
					<?php Icons_Manager::render_icon($settings['icon']); ?>
				</span>
			<?php endif; ?>

			<?php if( ! empty( $settings['text']) ) : ?>
				<span <?php $this->print_attributes_string( 'text' ); ?>><?php echo esc_html( $settings['text'] ); ?></span>
			<?php endif; ?>

			<?php if ( ! empty( $settings['icon'] ) && $settings['icon_align'] === 'right' ) : ?>
				<span <?php $this->print_attributes_string( 'icon' ); ?>>
					<?php Icons_Manager::render_icon($settings['icon']); ?>
				</span>
			<?php endif; ?>
		</div>
		<?php
	}
}
