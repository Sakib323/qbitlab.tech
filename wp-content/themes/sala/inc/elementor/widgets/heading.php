<?php

namespace Sala_Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Core\Schemes\Typography as Scheme_Typography;

defined( 'ABSPATH' ) || exit;

class Widget_Heading extends Base {

	public function get_name() {
		return 'sala-heading';
	}

	public function get_title() {
		return esc_html__( 'Modern Heading', 'sala' );
	}

	public function get_icon_part() {
		return 'eicon-heading';
	}

	public function get_keywords() {
		return [ 'heading', 'title', 'text' ];
	}

	protected function register_controls() {
		$this->add_title_section();

		$this->add_description_section();

		$this->add_sub_title_section();

		$this->add_wrapper_style_section();

		$this->add_title_style_section();

		$this->add_divider_style_section();

		$this->add_description_style_section();

		$this->add_sub_title_style_section();
	}

	private function add_title_section() {
		$this->start_controls_section( 'title_section', [
			'label' => esc_html__( 'Heading', 'sala' ),
		] );

		$this->add_control( 'title', [
			'label'       => esc_html__( 'Text', 'sala' ),
			'type'        => Controls_Manager::TEXTAREA,
			'dynamic'     => [
				'active' => true,
			],
			'placeholder' => esc_html__( 'Enter your title', 'sala' ),
			'default'     => esc_html__( 'Add Your Heading Text Here', 'sala' ),
			'description' => esc_html__( 'Wrap any words with &lt;mark&gt;&lt;/mark&gt; tag to make them highlight.', 'sala' ),
		] );

		$this->add_control( 'title_link', [
			'label'     => esc_html__( 'Link', 'sala' ),
			'type'      => Controls_Manager::URL,
			'dynamic'   => [
				'active' => true,
			],
			'default'   => [
				'url' => '',
			],
			'separator' => 'before',
		] );

		$this->add_control( 'title_link_animate', [
			'label'        => esc_html__( 'Link Animate', 'sala' ),
			'type'         => Controls_Manager::SELECT,
			'options'      => [
				''                  => esc_html__( 'None', 'sala' ),
				'animate-border'    => esc_html__( 'Animate Border', 'sala' ),
				'animate-border-02' => esc_html__( 'Animate Border 02', 'sala' ),
			],
			'default'      => '',
			'prefix_class' => 'sala-link-',
		] );

		$this->add_control( 'title_size', [
			'label'   => esc_html__( 'HTML Tag', 'sala' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'h1'   => 'H1',
				'h2'   => 'H2',
				'h3'   => 'H3',
				'h4'   => 'H4',
				'h5'   => 'H5',
				'h6'   => 'H6',
				'div'  => 'div',
				'span' => 'span',
				'p'    => 'p',
			],
			'default' => 'h2',
		] );

		$this->add_control( 'view', [
			'label'   => esc_html__( 'View', 'sala' ),
			'type'    => Controls_Manager::HIDDEN,
			'default' => 'traditional',
		] );

		// Divider.
		$this->add_control( 'divider_enable', [
			'label' => esc_html__( 'Display Divider', 'sala' ),
			'type'  => Controls_Manager::SWITCHER,
		] );

		$this->end_controls_section();
	}

	private function add_description_section() {
		$this->start_controls_section( 'description_section', [
			'label' => esc_html__( 'Description', 'sala' ),
		] );

		$this->add_control( 'description', [
			'label'   => esc_html__( 'Text', 'sala' ),
			'type'    => Controls_Manager::WYSIWYG,
			'dynamic' => [
				'active' => true,
			],
		] );

		$this->end_controls_section();
	}

	private function add_sub_title_section() {
		$this->start_controls_section( 'sub_title_section', [
			'label' => esc_html__( 'Secondary Heading', 'sala' ),
		] );

		$this->add_control( 'sub_title_text', [
			'label'   => esc_html__( 'Text', 'sala' ),
			'type'    => Controls_Manager::TEXTAREA,
			'dynamic' => [
				'active' => true,
			],
		] );

		$this->add_control( 'sub_title_size', [
			'label'   => esc_html__( 'HTML Tag', 'sala' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'h1'   => 'H1',
				'h2'   => 'H2',
				'h3'   => 'H3',
				'h4'   => 'H4',
				'h5'   => 'H5',
				'h6'   => 'H6',
				'div'  => 'div',
				'span' => 'span',
				'p'    => 'p',
			],
			'default' => 'h3',
		] );

		$this->end_controls_section();
	}

	private function add_wrapper_style_section() {
		$this->start_controls_section( 'wrapper_style_section', [
			'tab'   => Controls_Manager::TAB_STYLE,
			'label' => esc_html__( 'Wrapper', 'sala' ),
		] );

		$this->add_responsive_control( 'align', [
			'label'     => esc_html__( 'Text Align', 'sala' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => Widget_Utils::get_control_options_text_align_full(),
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}}' => 'text-align: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'max_width', [
			'label'          => esc_html__( 'Max Width', 'sala' ),
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
					'min' => 1,
					'max' => 1600,
				],
			],
			'selectors'      => [
				'{{WRAPPER}} .sala-modern-heading' => 'width: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'alignment', [
			'label'                => esc_html__( 'Alignment', 'sala' ),
			'type'                 => Controls_Manager::CHOOSE,
			'options'              => Widget_Utils::get_control_options_horizontal_alignment(),
			'selectors_dictionary' => [
				'left'  => 'flex-start',
				'right' => 'flex-end',
			],
			'selectors'            => [
				'{{WRAPPER}} .elementor-widget-container' => 'display: flex; justify-content: {{VALUE}}',
			],
		] );

		$this->end_controls_section();
	}

	private function add_title_style_section() {
		$this->start_controls_section( 'title_style_section', [
			'label'     => esc_html__( 'Heading', 'sala' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'title!' => '',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .heading-primary',
		] );

		$this->add_group_control( Group_Control_Text_Shadow::get_type(), [
			'name'     => 'text_shadow',
			'selector' => '{{WRAPPER}} .heading-primary',
		] );

		$this->add_control( 'blend_mode', [
			'label'     => esc_html__( 'Blend Mode', 'sala' ),
			'type'      => Controls_Manager::SELECT,
			'options'   => [
				''            => esc_html__( 'Normal', 'sala' ),
				'multiply'    => 'Multiply',
				'screen'      => 'Screen',
				'overlay'     => 'Overlay',
				'darken'      => 'Darken',
				'lighten'     => 'Lighten',
				'color-dodge' => 'Color Dodge',
				'saturation'  => 'Saturation',
				'color'       => 'Color',
				'difference'  => 'Difference',
				'exclusion'   => 'Exclusion',
				'hue'         => 'Hue',
				'luminosity'  => 'Luminosity',
			],
			'selectors' => [
				'{{WRAPPER}} .heading-primary' => 'mix-blend-mode: {{VALUE}}',
			],
			'separator' => 'none',
		] );

		$this->start_controls_tabs( 'title_style_tabs' );

		$this->start_controls_tab( 'title_style_normal_tab', [
			'label' => esc_html__( 'Normal', 'sala' ),
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'title',
			'selector' => '{{WRAPPER}} .heading-primary',
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'title_style_hover_tab', [
			'label' => esc_html__( 'Hover', 'sala' ),
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'title_hover',
			'selector' => '{{WRAPPER}} .heading-primary > a:hover',
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control( 'highlight_heading', [
			'label'     => esc_html__( 'Highlight Words', 'sala' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_highlight',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .heading-primary mark',
		] );

		$this->add_group_control( Group_Control_Text_Stroke::get_type(), [
			'name'     => 'title_highlight_text_stroke',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .heading-primary mark',
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'title_highlight',
			'selector' => '{{WRAPPER}} .heading-primary mark',
		] );

		/**
		 * Title Line Animate
		 */
		$line_condition = [
			'title_link_animate' => [
				'animate-border',
				'animate-border-02',
			],
		];

		$this->add_control( 'title_animate_line_heading', [
			'label'     => esc_html__( 'Line', 'sala' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
			'condition' => $line_condition,
		] );

		$this->add_responsive_control( 'title_animate_line_height', [
			'label'      => esc_html__( 'Height', 'sala' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'min'  => 1,
					'max'  => 5,
					'step' => 1,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .heading-primary a mark:before, {{WRAPPER}} .heading-primary a mark:after' => 'height: {{SIZE}}{{UNIT}};',
			],
			'condition'  => $line_condition,
		] );

		$this->add_control( 'title_animate_line_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .heading-primary a mark:before, {{WRAPPER}} .heading-primary a mark:after' => 'background: {{VALUE}};',
			],
			'condition' => $line_condition,
		] );

		$this->add_control( 'hover_title_animate_line_color', [
			'label'     => esc_html__( 'Hover Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .heading-primary a mark:after' => 'background: {{VALUE}};',
			],
			'condition' => [
				'title_link_animate' => [
					'animate-border',
				],
			],
		] );

		$this->add_control( 'title_mark_bg_color', [
			'label'     => esc_html__( 'Mark Background Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .elementor-heading-title mark:after' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'heading_spacing', [
			'label'      => esc_html__( 'Spacing', 'sala' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'unit' => 'px',
			],
			'size_units' => [ 'px', '%', 'em' ],
			'range'      => [
				'%'  => [
					'min' => 0,
					'max' => 100,
				],
				'px' => [
					'min' => 0,
					'max' => 200,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .heading-primary-wrap .heading-primary' => 'margin-bottom: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();
	}

	private function add_description_style_section() {
		$this->start_controls_section( 'description_style_section', [
			'label'     => esc_html__( 'Description', 'sala' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'description!' => '',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'description',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .heading-description',
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'description',
			'selector' => '{{WRAPPER}} .heading-description',
		] );

		$this->add_responsive_control( 'description_max_width', [
			'label'          => esc_html__( 'Max Width', 'sala' ),
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
					'min' => 1,
					'max' => 1600,
				],
			],
			'selectors'      => [
				'{{WRAPPER}} .heading-description' => 'max-width: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();
	}

	private function add_divider_style_section() {
		$this->start_controls_section( 'divider_style_section', [
			'label'     => esc_html__( 'Divider', 'sala' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'divider_enable' => 'yes',
			],
		] );

		$this->add_responsive_control( 'divider_width', [
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
					'min' => 1,
					'max' => 1600,
				],
			],
			'selectors'      => [
				'{{WRAPPER}} .heading-divider' => 'width: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'divider_height', [
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
					'min' => 1,
					'max' => 1600,
				],
			],
			'selectors'      => [
				'{{WRAPPER}} .heading-divider' => 'height: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_control( 'divider_pos', [
			'label'     => esc_html__( 'Position', 'sala' ),
			'type'      => Controls_Manager::SELECT,
			'options'   => [
				'inherit'     => esc_html__( 'Default', 'sala' ),
				'absolute'    => 'Absolute',
				'fixed'       => 'Fixed',
			],
			'default' => 'inherit',
			'selectors' => [
				'{{WRAPPER}} .heading-divider' => 'position: {{VALUE}}',
			],
			'separator' => 'none',
		] );

		$this->add_control( 'divider_horizontal', [
				'label' => __( 'Horizontal Orientation', 'sala' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'sala' ),
						'icon' => 'far fa-arrow-to-left',
					],
					'right' => [
						'title' => __( 'Right', 'sala' ),
						'icon' => 'far fa-arrow-to-right',
					],
				],
				'default' => 'left',
				'toggle' => false,
				'condition' => [
					'divider_pos' => [ 'absolute', 'fixed' ],
				],
			]
		);

		$this->add_responsive_control( 'divider_horizontal_offset', [
			'label'          => esc_html__( 'Offset', 'sala' ),
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
			'size_units'     => [ 'px', '%', 'vw', 'vh' ],
			'range'          => [
				'%'  => [
					'min' => -200,
					'max' => 200,
				],
				'px' => [
					'min' => -1000,
					'max' => 1000,
				],
				'vw' => [
					'min' => -200,
					'max' => 200,
				],
				'vh' => [
					'min' => -200,
					'max' => 200,
				],
			],
			'condition' => [
				'divider_pos' => [ 'absolute', 'fixed' ],
			],
		] );

		$this->add_control( 'divider_vertical', [
				'label' => __( 'Vertical Orientation', 'sala' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'sala' ),
						'icon' => 'far fa-arrow-to-top',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'sala' ),
						'icon' => 'far fa-arrow-to-bottom',
					],
				],
				'default' => 'top',
				'toggle' => false,
				'condition' => [
					'divider_pos' => [ 'absolute', 'fixed' ],
				],
			]
		);

		$this->add_responsive_control( 'divider_vertical_offset', [
			'label'          => esc_html__( 'Offset', 'sala' ),
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
			'size_units'     => [ 'px', '%', 'vw', 'vh' ],
			'range'          => [
				'%'  => [
					'min' => -200,
					'max' => 200,
				],
				'px' => [
					'min' => -1000,
					'max' => 1000,
				],
				'vw' => [
					'min' => -200,
					'max' => 200,
				],
				'vh' => [
					'min' => -200,
					'max' => 200,
				],
			],
			'condition' => [
				'divider_pos' => [ 'absolute', 'fixed' ],
			],
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'divider',
			'types'    => [ 'classic', 'gradient' ],
			'selector' => '{{WRAPPER}} .heading-divider',
		] );

		$this->end_controls_section();
	}

	private function add_sub_title_style_section() {
		$this->start_controls_section( 'sub_title_style_section', [
			'label'     => esc_html__( 'Secondary Heading', 'sala' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'sub_title_text!' => '',
			],
		] );

		$this->add_control( 'sub_title_inline', [
			'label' => esc_html__( 'Inline', 'sala' ),
			'type'  => Controls_Manager::SWITCHER,
			'default'        => 'yes',
			'selectors'  => [
				'{{WRAPPER}} .heading-secondary-wrap' => 'display: inline-block;',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'sub_title',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .heading-secondary',
		] );

		$this->start_controls_tabs( 'sub_title_style_tabs' );

		$this->start_controls_tab( 'sub_title_style_normal_tab', [
			'label' => esc_html__( 'Normal', 'sala' ),
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'sub_title',
			'selector' => '{{WRAPPER}} .heading-secondary',
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'sub_title_style_hover_tab', [
			'label' => esc_html__( 'Hover', 'sala' ),
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'sub_title_hover',
			'selector' => '{{WRAPPER}} .heading-secondary > a:hover',
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control( 'sub_title_spacing', [
			'label'      => esc_html__( 'Spacing', 'sala' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'unit' => 'px',
			],
			'size_units' => [ 'px', '%', 'em' ],
			'range'      => [
				'%'  => [
					'min' => 0,
					'max' => 100,
				],
				'px' => [
					'min' => 0,
					'max' => 200,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .heading-secondary-wrap .heading-secondary' => 'margin-bottom: {{SIZE}}{{UNIT}};',
			],
			'separator'  => 'before',
		] );

		$this->add_responsive_control( 'sub_title_max_width', [
			'label'          => esc_html__( 'Max Width', 'sala' ),
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
					'min' => 1,
					'max' => 1600,
				],
			],
			'selectors'      => [
				'{{WRAPPER}} .heading-secondary' => 'max-width: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_control( 'sub_padding', [
			'label'      => esc_html__( 'Padding', 'sala' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .heading-secondary-wrap .elementor-heading-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'sala-modern-heading' );
		?>
		<div <?php $this->print_attributes_string( 'wrapper' ); ?>>
			<?php $this->print_sub_title( $settings ); ?>

			<?php $this->print_title( $settings ); ?>

			<?php $this->print_divider( $settings ); ?>

			<?php $this->print_description( $settings ); ?>
		</div>
		<?php
	}

	protected function content_template() {
		// @formatter:off
		?>
		<#
		var title = settings.title;
		var title_html = '';

		if ( ''  !== title ) {
			if ( '' !== settings.title_link.url ) {
				title = '<a href="' + settings.title_link.url + '">' + title + '</a>';
			}

			view.addRenderAttribute( 'title', 'class', 'heading-primary elementor-heading-title' );

			view.addInlineEditingAttributes( 'title' );

			title_html = '<' + settings.title_size  + ' ' + view.getRenderAttributeString( 'title' ) + '>' + title + '</' + settings.title_size + '>';
			title_html = '<div class="heading-primary-wrap">' + title_html + '</div>';
		}

		var sub_title_html = '';

		if ( settings.sub_title_text ) {
			sub_title_html = settings.sub_title_text;

			view.addRenderAttribute( 'sub_title', 'class', 'heading-secondary elementor-heading-title' );

			sub_title_html = '<' + settings.sub_title_size  + ' ' + view.getRenderAttributeString( 'sub_title' ) + '>' + sub_title_html + '</' + settings.sub_title_size + '>';

			sub_title_html = '<div class="heading-secondary-wrap">' + sub_title_html + '</div>';
		}
		#>
		<div class="sala-modern-heading">

			<# if ( '' !== sub_title_html ) { #>
				<# print( sub_title_html ); #>
			<# } #>

			<# print( title_html ); #>

			<# if ( 'yes' === settings.divider_enable ) { #>
				<div class="heading-divider-wrap">
					<div class="heading-divider"></div>
				</div>
			<# } #>

			<# if ( settings.description ) { #>
				<div class="heading-description-wrap">
					<div class="heading-description">{{{ settings.description }}}</div>
				</div>
			<# } #>
		</div>
		<?php
		// @formatter:off
	}

	private function print_title(array $settings) {
		if ( empty( $settings['title'] ) ) {
			return;
		}

		// .elementor-heading-title -> Default color from section + column.
		$this->add_render_attribute( 'title', 'class', 'heading-primary elementor-heading-title' );

		$this->add_inline_editing_attributes( 'title' );

		$title = $settings['title'];

		if ( ! empty( $settings['title_link']['url'] ) ) {
			$this->add_link_attributes( 'url', $settings['title_link'] );

			$title = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $title );
		}
		?>
		<div class="heading-primary-wrap">
			<?php printf( '<%1$s %2$s>%3$s</%1$s>', $settings['title_size'], $this->get_render_attribute_string( 'title' ), $title ); ?>
		</div>
		<?php
	}

	private function print_sub_title(array $settings) {
		if( empty( $settings['sub_title_text'] ) ) {
			return;
		}

		// .elementor-heading-title -> Default color from section + column.
		$this->add_render_attribute( 'sub_title', 'class', 'heading-secondary elementor-heading-title' );
		?>
		<div class="heading-secondary-wrap">
			<?php printf( '<%1$s %2$s>%3$s</%1$s>', $settings['sub_title_size'], $this->get_render_attribute_string( 'sub_title' ), $settings['sub_title_text'] ); ?>
		</div>
		<?php
	}

	private function print_description(array $settings) {
		if( empty( $settings['description'] ) ) {
			return;
		}

		$this->add_render_attribute( 'description', 'class', 'heading-description' );
		?>
		<div class="heading-description-wrap">
			<div <?php $this->print_attributes_string( 'description' ); ?>>
				<?php echo wp_kses_post($settings['description']); ?>
			</div>
		</div>
	<?php
    }

    private function print_divider(array $settings) {
		if( empty( $settings['divider_enable'] ) || 'yes' !== $settings['divider_enable'] ) {
			return;
		}
		$css = array();
		if( !empty( $settings['divider_horizontal'] ) && !empty( $settings['divider_horizontal_offset'] )  ) {
			$css[] = $settings['divider_horizontal'] . ': ' . $settings['divider_horizontal_offset']['size'] . $settings['divider_horizontal_offset']['unit'] ;
		}
		if( !empty( $settings['divider_vertical'] ) && !empty( $settings['divider_vertical_offset'] )  ) {
			$css[] = $settings['divider_vertical'] . ': ' . $settings['divider_vertical_offset']['size'] . $settings['divider_vertical_offset']['unit'];
		}
		?>
		<div class="heading-divider-wrap">
			<div class="heading-divider" style="<?php echo implode(';', $css); ?>"></div>
		</div>
	    <?php
 	}
}
