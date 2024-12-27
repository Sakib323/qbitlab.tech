<?php

namespace Sala_Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography as Scheme_Typography;
use Elementor\Utils;

defined( 'ABSPATH' ) || exit;

class Widget_Content_Toggle extends Base {

	public function get_name() {
		return 'sala-content-toggle';
	}

	public function get_title() {
		return esc_html__( 'Content Toggle', 'sala' );
	}

	public function get_icon_part() {
		return 'eicon-dual-button';
	}

	public function get_keywords() {
		return [ 'modern', 'toggle' ];
	}

	protected function register_controls() {
		$this->add_primary_section();

		$this->add_sercondary_section();

		$this->add_discount_section();

		$this->add_toggle_style_section();

		$this->add_discount_style_section();

	}

	private function add_primary_section() {
		$this->start_controls_section( 'primary_section', [
			'label' => esc_html__( 'Primary', 'sala' ),
		] );

		$this->add_control( 'primary_label', [
			'label'   => esc_html__( 'Label', 'sala' ),
			'type'    => Controls_Manager::TEXT,
			'default' => esc_html__( 'Monthly', 'sala' ),
		] );

		$this->add_control( 'primary_style', [
			'label'        => esc_html__( 'Content Type', 'sala' ),
			'type'         => Controls_Manager::SELECT,
			'options'      => [
				'image' => esc_html__( 'Image', 'sala' ),
				'content' => esc_html__( 'Content', 'sala' ),
				'template' => esc_html__( 'Saved Templates', 'sala' ),
			],
			'default'      => 'content',
			'prefix_class' => 'sala-pricing-style-',
		] );

		$this->add_control( 'primary_image', [
			'label' => esc_html__( 'Image', 'sala' ),
			'type'  => Controls_Manager::MEDIA,
			'default' => [
				'url' => Utils::get_placeholder_image_src(),
			],
			'condition' => [
				'primary_style' => 'image',
			],
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'      => 'primary_image',
			// Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
			'default'   => 'full',
			'separator' => 'none',
			'condition' => [
				'primary_style' => 'image',
			],
		] );

		$this->add_control( 'primary_content', [
			'label'   => esc_html__( 'Content', 'sala' ),
			'type'    => Controls_Manager::WYSIWYG,
			'condition' => [
				'primary_style' => 'content',
			],
		] );

		$this->add_control( 'primary_saved_templates', [
			'label'        	=> esc_html__( 'Saved Templates', 'sala' ),
			'type'         	=> Controls_Manager::SELECT,
			'options'   	=> Widget_Utils::saved_templates(),
			'default'      	=> '',
			'condition' 	=> [
				'primary_style' => 'template',
			],
		] );

		$this->end_controls_section();
	}

	private function add_sercondary_section() {
		$this->start_controls_section( 'sercondary_section', [
			'label' => esc_html__( 'Sercondary', 'sala' ),
		] );

		$this->add_control( 'set_default', [
			'label'     => esc_html__( 'Set Default', 'sala' ),
			'type'      => Controls_Manager::SWITCHER,
		] );

		$this->add_control( 'sercondary_label', [
			'label'   => esc_html__( 'Label', 'sala' ),
			'type'    => Controls_Manager::TEXT,
			'default' => esc_html__( 'Anually', 'sala' ),
		] );

		$this->add_control( 'sercondary_style', [
			'label'        => esc_html__( 'Content Type', 'sala' ),
			'type'         => Controls_Manager::SELECT,
			'options'      => [
				'image' => esc_html__( 'Image', 'sala' ),
				'content' => esc_html__( 'Content', 'sala' ),
				'template' => esc_html__( 'Saved Templates', 'sala' ),
			],
			'default'      => 'content',
			'prefix_class' => 'sala-pricing-style-',
		] );

		$this->add_control( 'sercondary_image', [
			'label' => esc_html__( 'Image', 'sala' ),
			'type'  => Controls_Manager::MEDIA,
			'condition' => [
				'sercondary_style' => 'image',
			],
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'      => 'sercondary_image',
			// Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
			'default'   => 'full',
			'separator' => 'none',
			'condition' => [
				'sercondary_style' => 'image',
			],
		] );

		$this->add_control( 'sercondary_content', [
			'label'   => esc_html__( 'Content', 'sala' ),
			'type'    => Controls_Manager::WYSIWYG,
			'condition' => [
				'sercondary_style' => 'content',
			],
		] );

		$this->add_control( 'sercondary_saved_templates', [
			'label'        	=> esc_html__( 'Saved Templates', 'sala' ),
			'type'         	=> Controls_Manager::SELECT,
			'options'   	=> Widget_Utils::saved_templates(),
			'default'      	=> '',
			'condition' 	=> [
				'sercondary_style' => 'template',
			],
		] );

		$this->end_controls_section();
	}

	private function add_discount_section() {
		$this->start_controls_section( 'discount_section', [
			'label' => esc_html__( 'Discount', 'sala' ),
		] );

		$this->add_control( 'discount_left', [
			'label'     => esc_html__( 'Discount Left', 'sala' ),
			'type'      => Controls_Manager::SWITCHER,
		] );

		$this->add_control( 'discount_label', [
			'label'   => esc_html__( 'Label', 'sala' ),
			'type'    => Controls_Manager::TEXT,
			'default' => esc_html__( 'Save 20%', 'sala' ),
		] );

		$this->end_controls_section();
	}

	private function add_toggle_style_section() {
		$this->start_controls_section( 'toggle_style_section', [
			'label'     => esc_html__( 'Toggle', 'sala' ),
			'tab'       => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'toggle_width', [
			'label'      => esc_html__( 'Width', 'sala' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ '%', 'px' ],
			'range'      => [
				'%'  => [
					'max'  => 100,
					'step' => 1,
				],
				'px' => [
					'max'  => 200,
					'step' => 1,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .toggle-wrap .switch' => 'width: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_control( 'toggle_height', [
			'label'      => esc_html__( 'Height', 'sala' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ '%', 'px' ],
			'range'      => [
				'%'  => [
					'max'  => 100,
					'step' => 1,
				],
				'px' => [
					'max'  => 200,
					'step' => 1,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .toggle-wrap .switch' => 'height: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_control( 'toggle_radius', [
			'label'      => esc_html__( 'Border Radius', 'sala' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .toggle-wrap .switch .slider' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'toggle_skin_heading', [
			'label' => esc_html__( 'Skin', 'sala' ),
			'type'  => Controls_Manager::HEADING,
		] );

		$this->start_controls_tabs( 'toggle_skin_tabs' );

		$this->start_controls_tab( 'toggle_skin_normal_tab', [
			'label' => esc_html__( 'Normal', 'sala' ),
		] );

		$this->add_control( 'toggle_border_color', [
			'label'     => esc_html__( 'Border', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .toggle-wrap .switch .slider' => 'border-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'toggle_bg_color', [
			'label'     => esc_html__( 'Background Border', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .toggle-wrap .switch .slider' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'toggle_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .toggle-wrap .switch .slider:before' => 'background-color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'toggle_skin_active_tab', [
			'label' => esc_html__( 'Active', 'sala' ),
		] );

		$this->add_control( 'toggle_active_border_color', [
			'label'     => esc_html__( 'Border', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .toggle-wrap .switch.active .slider' => 'border-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'toggle_active_bg_color', [
			'label'     => esc_html__( 'Background Border', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .toggle-wrap .switch.active .slider' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'toggle_active_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .toggle-wrap .switch.active .slider:before' => 'background-color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function add_discount_style_section() {
		$this->start_controls_section( 'discount_style_section', [
			'label'     => esc_html__( 'Discount', 'sala' ),
			'tab'       => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'discount_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .toggle-wrap .discount' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'discount_label',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .toggle-wrap .discount .discount-text',
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'sala-pricing-plan' );
		if( $settings['set_default'] ){
			$this->add_render_attribute( 'wrapper', 'class', 'sercondary' );
		} else {
			$this->add_render_attribute( 'wrapper', 'class', 'primary' );
		}

		$this->add_render_attribute( 'heading', 'class', 'title' );
		?>
		<div <?php $this->print_attributes_string( 'wrapper' ); ?>>
			<div class="inner">

				<div class="sala-pricing-plan-header">
					<div class="toggle-wrap">
						<?php if ( ! empty( $settings['discount_label'] ) && $settings['discount_left'] == 'yes' ) : ?>
						<span class="discount left"><span class="discount-text"><?php echo esc_html( $settings['discount_label'] ); ?><span class="discount-bg"></span></span></span>
						<?php endif; ?>
						<?php if ( ! empty( $settings['primary_label'] ) ) : ?>
						<span><?php echo esc_html( $settings['primary_label'] ); ?></span>
						<?php endif; ?>
						<span class="switch <?php echo $settings['set_default'] ? 'active' : '' ?>"><span class="slider"></span></span>
						<?php if ( ! empty( $settings['sercondary_label'] ) ) : ?>
						<span><?php echo esc_html( $settings['sercondary_label'] ); ?></span>
						<?php endif; ?>
						<?php if ( ! empty( $settings['discount_label'] ) && $settings['discount_left'] != 'yes' ) : ?>
						<span class="discount right"><span class="discount-text"><span class="discount-bg"></span><?php echo esc_html( $settings['discount_label'] ); ?></span></span>
						<?php endif; ?>
					</div>
				</div>
				<div class="sala-pricing-plan-main">
					<div class="pricing-plan-item pricing-plan-primary <?php echo empty($settings['set_default']) ? 'active' : '' ?>">

						<?php if ( $settings['primary_style'] === 'image' && $settings['primary_image'] ) : ?>
							<div class="primary-image">
							<?php echo \Sala_Image::get_elementor_attachment( [
								'settings' 	=> $settings,
								'image_key'	=> 'primary_image',
							] ); ?>
							</div>
						<?php endif; ?>

						<?php if ( $settings['primary_style'] === 'content' && $settings['primary_content'] ) : ?>
							<div class="primary-content">
								<?php echo '' . $this->parse_text_editor( $settings['primary_content'] ); ?>
							</div>
						<?php endif; ?>

						<?php if ( $settings['primary_style'] === 'template' && $settings['primary_saved_templates'] ) : ?>
							<div class="primary-template">
								<?php echo do_shortcode('[sala-template id="' . $settings['primary_saved_templates'] . '"]'); ?>
							</div>
						<?php endif; ?>

					</div>

					<div class="pricing-plan-item pricing-plan-sercondary <?php echo $settings['set_default'] ? 'active' : '' ?>">

						<?php if ( $settings['sercondary_style'] === 'image' && $settings['sercondary_image'] ) : ?>
							<div class="sercondary-image">
							<?php echo \Sala_Image::get_elementor_attachment( [
								'settings' 	=> $settings,
								'image_key'	=> 'sercondary_image',
							] ); ?>
							</div>
						<?php endif; ?>

						<?php if ( $settings['sercondary_style'] === 'content' && $settings['sercondary_content'] ) : ?>
							<div class="sercondary-content">
								<?php echo '' . $this->parse_text_editor( $settings['sercondary_content'] ); ?>
							</div>
						<?php endif; ?>

						<?php if ( $settings['sercondary_style'] === 'template' && $settings['sercondary_saved_templates'] ) : ?>
							<div class="sercondary-template">
								<?php echo do_shortcode('[sala-template id="' . $settings['sercondary_saved_templates'] . '"]'); ?>
							</div>
						<?php endif; ?>

					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
