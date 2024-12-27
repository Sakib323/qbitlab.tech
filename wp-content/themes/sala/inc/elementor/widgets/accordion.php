<?php

namespace Sala_Elementor;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;

defined( 'ABSPATH' ) || exit;

class Widget_Accordion extends Base {

	public function get_name() {
		return 'sala-accordion';
	}

	public function get_title() {
		return esc_html__( 'Modern Accordion/Toggle', 'sala' );
	}

	public function get_icon_part() {
		return 'eicon-accordion';
	}

	public function get_keywords() {
		return [ 'modern', 'accordion', 'tabs', 'toggle' ];
	}

	public function get_script_depends() {
		return [ 'sala-widget-accordion' ];
	}

	protected function register_controls() {
		$this->add_content_section();

		$this->add_styling_section();

		$this->add_icon_primary_style_section();

		$this->add_title_style_section();

		$this->add_icon_style_section();

		$this->add_number_style_section();

		$this->add_content_style_section();
	}

	private function add_content_section() {
		$this->start_controls_section( 'content_section', [
			'label' => esc_html__( 'Items', 'sala' ),
		] );

		$this->add_control( 'style', [
			'label'        => esc_html__( 'Style', 'sala' ),
			'type'         => Controls_Manager::SELECT,
			'default'      => '01',
			'options'      => [
				'01' => '01',
				'02' => '02',
				'03' => '03',
				'04' => '04',
				'05' => '05',
			],
			'prefix_class' => 'sala-accordion-style-',
		] );

		$this->add_control( 'id_control', [
			'label'       	=> esc_html__( 'Slide Control', 'sala' ),
			'type'        	=> Controls_Manager::TEXT,
			'default' 		=> '',
			'description'   => esc_html__( 'ID of the controlled silder', 'sala' ),
		] );

		$this->add_control( 'type', [
			'label'   => esc_html__( 'Type', 'sala' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'accordion' => esc_html__( 'Accordion', 'sala' ),
				'toggle'    => esc_html__( 'Toggle', 'sala' ),
			],
			'default' => 'accordion',
		] );

		$this->add_control( 'show_content', [
			'label'     	=> esc_html__( 'Show Content', 'sala' ),
			'type'      	=> Controls_Manager::SWITCHER,
			'default'      	=> '0',
		] );

		$this->add_control( 'active_first_item', [
			'label'              => esc_html__( 'Active First Item', 'sala' ),
			'type'               => Controls_Manager::SWITCHER,
			'return_value'       => '1',
			'frontend_available' => true,
		] );

		$repeater = new Repeater();

		$repeater->add_control( 'icon_primary', [
			'label'       => esc_html__( 'Icon', 'sala' ),
			'type'        => Controls_Manager::ICONS,
			'default'     => [
				'value'   => '',
				'library' => 'fa-brands',
			],
			'recommended' => Widget_Utils::get_recommended_social_icons(),
		] );

		$repeater->add_control( 'current_icon_primary_color', [
			'label'     => esc_html__( 'Icon Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} {{CURRENT_ITEM}} .link-icon' => 'color: {{VALUE}};',
			],
		] );

		$repeater->add_control( 'number', [
			'label'       => esc_html__( 'Number', 'sala' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => '',
			'label_block' => true,
			'dynamic'     => [
				'active' => true,
			],
		] );

		$repeater->add_control( 'title', [
			'label'       => esc_html__( 'Title', 'sala' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'Accordion Title', 'sala' ),
			'label_block' => true,
			'dynamic'     => [
				'active' => true,
			],
		] );

		$repeater->add_control( 'content', [
			'label'   => esc_html__( 'Content', 'sala' ),
			'type'    => Controls_Manager::WYSIWYG,
			'default' => esc_html__( 'Accordion Content', 'sala' ),
		] );

		$this->add_control( 'items', [
			'label'       => esc_html__( 'Items', 'sala' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
				[
					'title'   => esc_html__( 'Accordion #1', 'sala' ),
					'content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'sala' ),
				],
				[
					'title'   => esc_html__( 'Accordion #2', 'sala' ),
					'content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'sala' ),
				],
				[
					'title'   => esc_html__( 'Accordion #3', 'sala' ),
					'content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'sala' ),
				],
			],
			'title_field' => '{{{ title }}}',
		] );

		$this->add_control( 'view', [
			'label'   => esc_html__( 'View', 'sala' ),
			'type'    => Controls_Manager::HIDDEN,
			'default' => 'traditional',
		] );

		$this->add_control( 'icon', [
			'label'       => esc_html__( 'Icon', 'sala' ),
			'type'        => Controls_Manager::ICONS,
			'separator'   => 'before',
			'default'     => [
				'value'   => 'fas fa-plus-circle',
				'library' => 'fa-solid',
			],
			'recommended' => [
				'fa-solid'   => [
					'plus',
					'plus-square',
					'folder-plus',
					'cart-plus',
					'calendar-plus',
					'search-plus',
				],
				'fa-regular' => [
					'plus-square',
					'plus-circle',
					'calendar-plus',
				],
			],
			'skin'        => 'inline',
			'label_block' => false,
		] );

		$this->add_control( 'active_icon', [
			'label'       => esc_html__( 'Active Icon', 'sala' ),
			'type'        => Controls_Manager::ICONS,
			'default'     => [
				'value'   => 'fas fa-minus-circle',
				'library' => 'fa-solid',
			],
			'recommended' => [
				'fa-solid'   => [
					'minus',
					'minus-circle',
					'minus-square',
					'folder-minus',
					'calendar-minus',
					'search-minus',
				],
				'fa-regular' => [
					'minus-square',
					'calendar-minus',
				],
			],
			'skin'        => 'inline',
			'label_block' => false,
			'condition'   => [
				'icon[value]!' => '',
			],
		] );

		$this->add_control( 'title_html_tag', [
			'label'     => esc_html__( 'Title HTML Tag', 'sala' ),
			'type'      => Controls_Manager::SELECT,
			'options'   => [
				'h1'  => 'H1',
				'h2'  => 'H2',
				'h3'  => 'H3',
				'h4'  => 'H4',
				'h5'  => 'H5',
				'h6'  => 'H6',
				'div' => 'div',
			],
			'default'   => 'h6',
			'separator' => 'before',
		] );

		$this->end_controls_section();
	}

	private function add_styling_section() {
		$this->start_controls_section( 'style_section', [
			'label' => esc_html__( 'Style', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'border_color', [
			'label'     => esc_html__( 'Border Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .accordion-section' => 'border-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'background_color', [
			'label'     => esc_html__( 'Background Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .accordion-section' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'border_hover_color', [
			'label'     => esc_html__( 'Border Hover Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .accordion-section:hover' => 'border-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'background_hover_color', [
			'label'     => esc_html__( 'Background Hover Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .accordion-section:hover' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'border_active_color', [
			'label'     => esc_html__( 'Border Active Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .accordion-section.active' => 'border-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'background_active_color', [
			'label'     => esc_html__( 'Background Active Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .accordion-section.active' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'hidden_border_top', [
			'label'              => esc_html__( 'Hidden Border Top', 'sala' ),
			'type'               => Controls_Manager::SWITCHER,
			'return_value'       => 'unset',
			'frontend_available' => true,
			'selectors' => [
				'{{WRAPPER}} .accordion-section:first-child' => 'border-top: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'accordion_spacing', [
			'label'     => esc_html__( 'Spacing', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'body {{WRAPPER}} .sala-accordion .accordion-section + .accordion-section' => 'margin: {{SIZE}}{{UNIT}} 0 0 0;',
			],
		] );

		$this->end_controls_section();
	}

	private function add_icon_primary_style_section() {
		$this->start_controls_section( 'icon_primary_style_section', [
			'label'     => esc_html__( 'Icon Primary', 'sala' ),
			'tab'       => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'icon_primary_width', [
			'label'      => esc_html__( 'Width', 'sala' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'unit' => 'px',
			],
			'size_units' => [ 'px', '%' ],
			'range'      => [
				'%'  => [
					'min' => 1,
					'max' => 100,
				],
				'px' => [
					'min' => 1,
					'max' => 1600,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .accordion-icon-primary' => 'width: {{SIZE}}{{UNIT}}; text-align: center;',
			],
		] );

		$this->add_responsive_control( 'icon_primary_height', [
			'label'      => esc_html__( 'Height', 'sala' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'unit' => 'px',
			],
			'size_units' => [ 'px', '%' ],
			'range'      => [
				'%'  => [
					'min' => 1,
					'max' => 100,
				],
				'px' => [
					'min' => 1,
					'max' => 1600,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .accordion-icon-primary' => 'height: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'icon_primary_line_height', [
			'label'      => esc_html__( 'Line Height', 'sala' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'unit' => 'px',
			],
			'size_units' => [ 'px', '%' ],
			'range'      => [
				'%'  => [
					'min' => 1,
					'max' => 100,
				],
				'px' => [
					'min' => 1,
					'max' => 1600,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .accordion-icon-primary' => 'line-height: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'icon_primary_size', [
			'label'     => esc_html__( 'Size', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 3,
					'max' => 20,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .sala-accordion .accordion-icon-primary' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'icon_primary_space', [
			'label'     => esc_html__( 'Spacing', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'body:not(.rtl) {{WRAPPER}} .sala-accordion .accordion-icon-primary' => 'margin: 0 {{SIZE}}{{UNIT}} 0 0;',
				'body.rtl {{WRAPPER}} .sala-accordion .accordion-icon-primary' => 'margin: 0 0 0 {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_control( 'icon_primary_padding', [
			'label'      => esc_html__( 'Padding', 'sala' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .accordion-icon-primary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'icon_primary_radius', [
			'label'      => esc_html__( 'Border Radius', 'sala' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .accordion-icon-primary' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->start_controls_tabs( 'icon_primary_color_tabs' );

		$this->start_controls_tab( 'icon_primary_color_tab', [
			'label' => esc_html__( 'Normal', 'sala' ),
		] );

		$this->add_control( 'icon_primary_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .accordion-icon-primary' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'icon_primary_border_color', [
			'label'     => esc_html__( 'Border Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .accordion-icon-primary' => 'border-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'icon_primary_background_color', [
			'label'     => esc_html__( 'Background', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .accordion-icon-primary' => 'background-color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'icon_primary_active_color_tab', [
			'label' => esc_html__( 'Active', 'sala' ),
		] );

		$this->add_control( 'icon_primary_active_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .accordion-section.active .accordion-icon-primary, {{WRAPPER}} .accordion-section:hover .accordion-icon-primary' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'icon_primary_active_border_color', [
			'label'     => esc_html__( 'Border Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .accordion-section.active .accordion-icon-primary, {{WRAPPER}} .accordion-section:hover .accordion-icon-primary' => 'border-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'icon_primary_active_background_color', [
			'label'     => esc_html__( 'Background', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .accordion-section.active .accordion-icon-primary, {{WRAPPER}} .accordion-section:hover .accordion-icon-primary' => 'background-color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function add_title_style_section() {
		$this->start_controls_section( 'title_style_section', [
			'label' => esc_html__( 'Title', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'label'    => esc_html__( 'Typography', 'sala' ),
			'selector' => '{{WRAPPER}} .accordion-title',
		] );

		$this->start_controls_tabs( 'title_style_tabs' );

		$this->start_controls_tab( 'title_style_normal_tab', [
			'label' => esc_html__( 'Normal', 'sala' ),
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'text',
			'selector' => '{{WRAPPER}} .accordion-title',
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'title_style_hover_tab', [
			'label' => esc_html__( 'Hover', 'sala' ),
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'hover_text',
			'selector' => '{{WRAPPER}} .accordion-section.active .accordion-title, {{WRAPPER}} .accordion-section:hover .accordion-title',
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control( 'min_height', [
			'label'     => esc_html__( 'Min Height', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'selectors' => [
				'{{WRAPPER}} .accordion-header' => 'min-height: {{SIZE}}{{UNIT}}',
			],
		] );

		$this->end_controls_section();
	}

	private function add_icon_style_section() {
		$this->start_controls_section( 'icon_style_section', [
			'label'     => esc_html__( 'Icon', 'sala' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'icon[value]!' => '',
			],
		] );

		$this->add_control( 'icon_align', [
			'label'   => esc_html__( 'Alignment', 'sala' ),
			'type'    => Controls_Manager::CHOOSE,
			'options' => [
				'left'  => [
					'title' => esc_html__( 'Start', 'sala' ),
					'icon'  => 'eicon-h-align-left',
				],
				'right' => [
					'title' => esc_html__( 'End', 'sala' ),
					'icon'  => 'eicon-h-align-right',
				],
			],
			'default' => 'right',
			'toggle'  => false,
		] );

		$this->start_controls_tabs( 'icon_color_tabs' );

		$this->start_controls_tab( 'icon_color_tab', [
			'label' => esc_html__( 'Normal', 'sala' ),
		] );

		$this->add_control( 'icon_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .opened-icon' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'icon_active_color_tab', [
			'label' => esc_html__( 'Active', 'sala' ),
		] );

		$this->add_control( 'icon_active_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .accordion-header:hover .opened-icon, {{WRAPPER}} .closed-icon' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control( 'icon_size', [
			'label'     => esc_html__( 'Size', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 3,
					'max' => 20,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .sala-accordion .accordion-icons' => 'font-size: {{SIZE}}{{UNIT}};',
			],
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
				'body:not(.rtl) {{WRAPPER}} .sala-accordion.sala-accordion-icon-right .accordion-icons' => 'margin: 0 0 0 {{SIZE}}{{UNIT}};',
				'body:not(.rtl) {{WRAPPER}} .sala-accordion.sala-accordion-icon-left .accordion-icons'  => 'margin: 0 {{SIZE}}{{UNIT}} 0 0;',
				'body.rtl {{WRAPPER}} .sala-accordion.sala-accordion-icon-right .accordion-icons'       => 'margin: 0 {{SIZE}}{{UNIT}} 0 0;',
				'body.rtl {{WRAPPER}} .sala-accordion.sala-accordion-icon-left .accordion-icons'        => 'margin: 0 0 0 {{SIZE}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();
	}

	private function add_number_style_section() {
		$this->start_controls_section( 'number_style_section', [
			'label' => esc_html__( 'Number', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'number_margin', [
			'label'      => esc_html__( 'Margin', 'sala' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .accordion-number' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'number_typography',
			'label'    => esc_html__( 'Typography', 'sala' ),
			'selector' => '{{WRAPPER}} .accordion-number',
		] );

		$this->start_controls_tabs( 'number_style_tabs' );

		$this->start_controls_tab( 'number_style_normal_tab', [
			'label' => esc_html__( 'Normal', 'sala' ),
		] );

		$this->add_control( 'number_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .accordion-number' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'number_style_hover_tab', [
			'label' => esc_html__( 'Hover', 'sala' ),
		] );

		$this->add_control( 'number_hover_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .accordion-section.active .accordion-number, {{WRAPPER}} .accordion-section:hover .accordion-number' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function add_content_style_section() {
		$this->start_controls_section( 'content_style_section', [
			'label' => esc_html__( 'Content', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'content_padding', [
			'label'      => esc_html__( 'Padding', 'sala' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .accordion-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'content_typography',
			'label'    => esc_html__( 'Typography', 'sala' ),
			'selector' => '{{WRAPPER}} .accordion-content',
		] );

		$this->start_controls_tabs( 'content_style_tabs' );

		$this->start_controls_tab( 'content_style_normal_tab', [
			'label' => esc_html__( 'Normal', 'sala' ),
		] );

		$this->add_control( 'content_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .accordion-content' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'content_style_hover_tab', [
			'label' => esc_html__( 'Hover', 'sala' ),
		] );

		$this->add_control( 'content_hover_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .accordion-section.active .accordion-content, {{WRAPPER}} .accordion-section:hover .accordion-content' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Do nothing if there is not any items.
		if ( empty( $settings['items'] ) || count( $settings['items'] ) <= 0 ) {
			return;
		}

		$this->add_render_attribute( 'wrapper', 'class', 'sala-accordion sala-accordion-control' );

		$this->add_render_attribute( 'wrapper_data', 'data-id', $settings['id_control'] );

		if ( 'toggle' === $settings['type'] ) {
			$this->add_render_attribute( 'wrapper', 'data-multi-open', '1' );
		}

		$has_icon = ! empty( $settings['icon']['value'] ) ? true : false;

		if ( $has_icon ) {
			$this->add_render_attribute( 'wrapper', 'class', 'sala-accordion-icon-' . $settings['icon_align'] );
		}
		?>
		<div <?php $this->print_attributes_string( 'wrapper' ); ?> <?php $this->print_attributes_string( 'wrapper_data' ); ?>>
			<?php
			$loop_count = 0;
			foreach ( $settings['items'] as $key => $item ) {

				if ( empty( $item['title'] ) || empty( $item['content'] ) ) {
					continue;
				}

				$loop_count++;
				$item_key = 'item_' . $item['_id'];
				$this->add_render_attribute( $item_key, 'class', [
					'accordion-section',
					'elementor-repeater-item-' . $item['_id'],
				] );

				if ( ! empty( $settings['active_first_item'] ) && 1 === $loop_count ) {
					$this->add_render_attribute( $item_key, 'class', 'active' );
				}

				if( $settings['show_content'] ){
					$show_content = 'show';
				} else {
					$show_content = '';
				}

				?>
				<?php if( $item['number'] ) : ?>
					<div class="accordion-number"><?php echo $item['number']; ?></div>
				<?php endif; ?>
				<div <?php $this->print_attributes_string( $item_key ); ?>>
					<div class="accordion-header">
						<div class="accordion-icon-primary">
							<?php echo $this->get_icons_html( $item['icon_primary'], [ 'class' => 'link-icon' ] ); ?>
						</div>
						<div class="accordion-title-wrapper">
							<?php printf( '<%1$s class="accordion-title">%2$s</%1$s>', $settings['title_html_tag'], esc_html( $item['title'] ) ); ?>
						</div>
						<?php if ( $has_icon ) : ?>
							<div class="accordion-icons">
								<span
									class="accordion-icon opened-icon"><?php Icons_Manager::render_icon( $settings['icon'] ); ?></span>
								<span
									class="accordion-icon closed-icon"><?php Icons_Manager::render_icon( $settings['active_icon'] ); ?></span>
							</div>
						<?php endif; ?>
					</div>
					<div class="accordion-content <?php echo $show_content; ?>">
						<?php echo '' . $this->parse_text_editor( $item['content'] ); ?>
					</div>
				</div>
			<?php } ?>
		</div>
		<?php
	}

	protected function content_template() {
		// @formatter:off
		?>
		<#
		var iconHTML = elementor.helpers.renderIcon( view, settings.icon, { 'aria-hidden': true }, 'i' , 'object' );
		var iconActiveHTML = elementor.helpers.renderIcon( view, settings.active_icon, { 'aria-hidden': true }, 'i' , 'object' );

		view.addRenderAttribute( 'wrapper', 'class', 'sala-accordion' );

		view.addRenderAttribute( 'wrapper_data', 'data-id', settings.id_control );

		if ( 'toggle' === settings.type ) {
			view.addRenderAttribute( 'wrapper', 'data-multi-open', '1' );
		}

		if ( iconHTML.rendered ) {
			view.addRenderAttribute( 'wrapper', 'class', 'sala-accordion-icon-' + settings.icon_align);
		}

		var loopCount = 0;
		#>
		<div {{{ view.getRenderAttributeString( 'wrapper' ) }}} {{{ view.getRenderAttributeString( 'wrapper_data' ) }}}>
			<# _.each( settings.items, function( item, index ) { #>
				<#
				if ( '' === item.title || '' === item.content ) {
					return;
				}

				loopCount++;
				var itemKey = 'item_' + item._id;
				view.addRenderAttribute( itemKey, 'class', 'accordion-section' );
				var iconPrimaryHTML = elementor.helpers.renderIcon( view, item.icon_primary, { 'aria-hidden': true }, 'i' , 'object' );

				var show_content = '';
				if ( settings.show_content ) {
					var show_content = 'show';
				}
				#>
				<# if ( item.number ) { #>
				<div class="accordion-number">
					{{{ item.number }}}
				</div>
				<# } #>
				<div {{{ view.getRenderAttributeString( itemKey ) }}}>

					<div class="accordion-header">
						<# if ( iconPrimaryHTML.rendered ) { #>
						<div class="accordion-icon-primary">
							{{{ iconPrimaryHTML.value }}}
						</div>
						<# } #>
						<div class="accordion-title-wrapper">
							<{{{ settings.title_html_tag }}} class="accordion-title">
								{{{ item.title }}}
							</{{{ settings.title_html_tag }}}>
						</div>
						<# if ( iconHTML.rendered ) { #>
							<div class="accordion-icons">
								<span class="accordion-icon opened-icon">
									{{{ iconHTML.value }}}
								</span>
								<# if ( iconActiveHTML.rendered ) { #>
								<span class="accordion-icon closed-icon">
									{{{ iconActiveHTML.value }}}
								</span>
								<# } #>
							</div>
						<# } #>
					</div>
					<div class="accordion-content {{{ show_content }}}">{{{ item.content }}}</div>
				</div>
			<# }); #>
		</div>
		<?php
		// @formatter:off
	}
}
