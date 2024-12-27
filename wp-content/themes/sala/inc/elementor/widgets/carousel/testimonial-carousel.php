<?php

namespace Sala_Elementor;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || exit;

class Widget_Testimonial_Carousel extends Static_Carousel {

	private $slider_looped_slides = 4;

	public function get_name() {
		return 'sala-testimonial';
	}

	public function get_title() {
		return esc_html__( 'Testimonial Carousel', 'sala' );
	}

	public function get_icon_part() {
		return 'eicon-testimonial-carousel';
	}

	public function get_keywords() {
		return [ 'testimonial', 'carousel' ];
	}

	protected function register_controls() {
		$this->add_layout_section();

		$this->add_box_style_section();

		$this->add_content_style_section();

		$this->add_image_style_section();

		$this->add_logo_style_section();

		$this->add_quote_style_section();

		$this->add_image_highlight_style_section();

		parent::register_controls();

		$this->update_controls();
	}

	private function update_controls() {
		$this->update_responsive_control( 'swiper_items', [
			'default'        => '1',
			'tablet_default' => '1',
			'mobile_default' => '1',
		] );

		$this->update_responsive_control( 'swiper_gutter', [
			'default' => 30,
		] );

		$this->update_control( 'slides', [
			'title_field' => '{{{ name }}}',
		] );
	}

	private function add_layout_section() {
		$this->start_controls_section( 'layout_section', [
			'label' => esc_html__( 'Layout', 'sala' ),
		] );

		$this->add_control( 'style', [
			'label'        => esc_html__( 'Style', 'sala' ),
			'type'         => Controls_Manager::SELECT,
			'default' 	   => '01',
			'options'      => [
				'01' => esc_html__( '01', 'sala' ),
				'02' => esc_html__( '02', 'sala' ),
			],
			'render_type'  => 'template',
			'prefix_class' => 'sala-testimonial-style-',
		] );

		$this->add_control( 'layout', [
			'label'        => esc_html__( 'Layout', 'sala' ),
			'type'         => Controls_Manager::SELECT,
			'default'      => 'image-left',
			'options'      => [
				'image-left'    => esc_html__( 'Image Left', 'sala' ),
				'image-inline'  => esc_html__( 'Image Inline', 'sala' ),
				'image-stacked' => esc_html__( 'Image Stacked', 'sala' ),
				'image-top'     => esc_html__( 'Image Top Overlap', 'sala' ),
				'image-top-02'  => esc_html__( 'Image Top', 'sala' ),
				'image-above'   => esc_html__( 'Image Above', 'sala' ),
			],
			'render_type'  => 'template',
			'prefix_class' => 'layout-',
			'condition'    => [
				'style' => '01',
			],
		] );

		$this->add_control( 'image_position', [
			'label'        => esc_html__( 'Info Position', 'sala' ),
			'type'         => Controls_Manager::CHOOSE,
			'label_block'  => false,
			'default'      => 'below',
			'options'      => [
				'above'  => [
					'title' => esc_html__( 'Above', 'sala' ),
					'icon'  => 'eicon-v-align-top',
				],
				'below'  => [
					'title' => esc_html__( 'Below', 'sala' ),
					'icon'  => 'eicon-v-align-bottom',
				],
				'bottom' => [
					'title' => esc_html__( 'Bottom', 'sala' ),
					'icon'  => 'eicon-v-align-stretch',
				],
			],
			'render_type'  => 'template',
			'prefix_class' => 'image-position-',
			'condition'    => [
				'layout' => [
					'image-inline',
					'image-stacked',
				],
			],
		] );

		$this->add_control( 'cite_layout', [
			'label'        => esc_html__( 'Cite Layout', 'sala' ),
			'label_block'  => false,
			'type'         => Controls_Manager::CHOOSE,
			'default'      => 'block',
			'options'      => [
				'block'  => [
					'title' => esc_html__( 'Default', 'sala' ),
					'icon'  => 'eicon-editor-list-ul',
				],
				'inline' => [
					'title' => esc_html__( 'Inline', 'sala' ),
					'icon'  => 'eicon-ellipsis-h',
				],
			],
			'prefix_class' => 'sala-testimonial-cite-layout-',
			'condition'    => [
				'style' => '01',
			],
		] );

		$this->add_control( 'show_quote', [
			'label' => esc_html__( 'Show Quote', 'sala' ),
			'type'  => Controls_Manager::SWITCHER,
			'condition'    => [
				'style' => '01',
			],
		] );

		$this->add_control( 'image_highlight', [
			'label' => esc_html__( 'Image Highlight', 'sala' ),
			'type'  => Controls_Manager::SWITCHER,
			'condition'    => [
				'style' => '01',
			],
		] );

		$this->end_controls_section();
	}

	private function add_box_style_section() {
		$this->start_controls_section( 'box_style_section', [
			'label' => esc_html__( 'Box', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'box_alignment', [
			'label'     => esc_html__( 'Alignment', 'sala' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => Widget_Utils::get_control_options_text_align(),
			'selectors' => [
				'{{WRAPPER}} .swiper-slide' => 'text-align: {{VALUE}}',
			],
		] );

		$this->add_responsive_control( 'box_max_width', [
			'label'      => esc_html__( 'Max Width', 'sala' ),
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
				'{{WRAPPER}} .testimonial-item' => 'width: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'box',
			'selector' => '{{WRAPPER}} .testimonial-item',
		] );

		$this->add_responsive_control( 'box_padding', [
			'label'      => esc_html__( 'Padding', 'sala' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .testimonial-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control(
			'border_style',
			[
				'label' => __( 'Style', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => __( 'None', 'elementor' ),
					'solid' => __( 'Solid', 'elementor' ),
					'double' => __( 'Double', 'elementor' ),
					'dotted' => __( 'Dotted', 'elementor' ),
					'dashed' => __( 'Dashed', 'elementor' ),
				],
				'default' => 'none',
				'selectors' => [
					'{{WRAPPER}} .testimonial-item' => 'border-style: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'border_width',
			[
				'label' => __( 'Border Width', 'sala' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .testimonial-item' => 'border-width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'border_color',
			[
				'label' => __( 'Border Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-item' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'toggle_border_radius',
			[
				'label' => __( 'Border Radius', 'sala' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .testimonial-item' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();
	}

	private function add_content_style_section() {
		$this->start_controls_section( 'content_style_section', [
			'label' => esc_html__( 'Content', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'content_box_padding', [
			'label'      => esc_html__( 'Padding', 'sala' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .content-wrap .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control(
			'content_background_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .content-wrap .content' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_toggle_border_radius',
			[
				'label' => __( 'Border Radius', 'sala' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .content-wrap .content' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);


		$this->add_responsive_control( 'content_max_width', [
			'label'      => esc_html__( 'Max Width', 'sala' ),
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
				'{{WRAPPER}} .content-wrap' => 'width: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'content_alignment', [
			'label'                => esc_html__( 'Alignment', 'sala' ),
			'type'                 => Controls_Manager::CHOOSE,
			'options'              => Widget_Utils::get_control_options_horizontal_alignment(),
			'selectors_dictionary' => [
				'left'  => 'flex-start',
				'right' => 'flex-end',
			],
			'selectors'            => [
				'{{WRAPPER}} .testimonial-main-content' => 'justify-content: {{VALUE}}',
			],
		] );

		$this->add_control( 'content_text_align', [
			'label'        => esc_html__( 'Text Align', 'sala' ),
			'label_block'  => false,
			'type'         => Controls_Manager::CHOOSE,
			'default'      => 'center',
			'options'      => Widget_Utils::get_control_options_text_align(),
			'prefix_class' => 'align-',
			//'render_type'  => 'template',
			'selectors'    => [
				'{{WRAPPER}} .content-wrap' => 'text-align: {{VALUE}};',
			],
		] );

		$this->add_control( 'show_content_quote', [
			'label' => esc_html__( 'Show Quote', 'sala' ),
			'type'  => Controls_Manager::SWITCHER,
		] );

		$this->add_control( 'title_heading', [
			'label'     => esc_html__( 'Title', 'sala' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'title_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .title' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'label'    => esc_html__( 'Typography', 'sala' ),
			'selector' => '{{WRAPPER}} .title',
		] );

		$this->add_responsive_control( 'title_margin', [
			'label'      => esc_html__( 'Margin', 'sala' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'text_heading', [
			'label'     => esc_html__( 'Text', 'sala' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'text_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .text' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'text_typography',
			'label'    => esc_html__( 'Typography', 'sala' ),
			'selector' => '{{WRAPPER}} .text',
		] );

		$this->add_control( 'name_heading', [
			'label'     => esc_html__( 'Name', 'sala' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'name_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .name' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'name_typography',
			'label'    => esc_html__( 'Typography', 'sala' ),
			'selector' => '{{WRAPPER}} .name',
		] );

		$this->add_control( 'position_heading', [
			'label'     => esc_html__( 'Position', 'sala' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'position_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .position' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'position_typography',
			'label'    => esc_html__( 'Typography', 'sala' ),
			'selector' => '{{WRAPPER}} .position',
		] );

		$this->add_responsive_control( 'position_spacing', [
			'label'     => esc_html__( 'Spacing', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 500,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .position' => 'margin-top: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();
	}

	private function add_image_style_section() {
		$this->start_controls_section( 'image_style_section', [
			'label' => esc_html__( 'Image', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'image_spacing', [
			'label'     => esc_html__( 'Spacing', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 500,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .info' => 'padding-top: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'image_size_width', [
				'label'     => esc_html__( 'Width', 'sala' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 30,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .image img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control( 'image_size_height', [
				'label'     => esc_html__( 'Height', 'sala' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 30,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .image img' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'sala' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .image img' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();
	}

	private function add_logo_style_section() {
		$this->start_controls_section( 'logo_style_section', [
			'label' => esc_html__( 'Logo', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'logo_size_height', [
				'label'     => esc_html__( 'Height', 'sala' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 30,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .logo img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control( 'logo_alignment', [
			'label'     => esc_html__( 'Alignment', 'sala' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => Widget_Utils::get_control_options_text_align(),
			'selectors' => [
				'{{WRAPPER}} .logo' => 'text-align: {{VALUE}}',
			],
		] );

		$this->add_responsive_control( 'logo_spacing', [
			'label'     => esc_html__( 'Spacing', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 500,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .logo' => 'margin-top: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();
	}

	private function add_quote_style_section() {
		$this->start_controls_section( 'quote_style_section', [
			'label' => esc_html__( 'Quote', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
			'condition'    => [
				'show_quote' => 'yes',
			],
		] );

		$this->add_responsive_control( 'quote_icon_size', [
			'label'     => esc_html__( 'Size', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 10,
					'max' => 200,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .quote i' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'quote_top', [
			'label'      => esc_html__( 'Top', 'sala' ),
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
					'min' => -500,
					'max' => 500,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .quote' => 'top: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'quote_left', [
			'label'      => esc_html__( 'Left', 'sala' ),
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
					'min' => -500,
					'max' => 500,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .quote' => 'left: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'quote_right', [
			'label'      => esc_html__( 'Right', 'sala' ),
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
					'min' => -500,
					'max' => 500,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .quote' => 'right: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'quote_bottom', [
			'label'      => esc_html__( 'Bottom', 'sala' ),
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
					'min' => -500,
					'max' => 500,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .quote' => 'bottom: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_control( 'quote_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .quote i' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_section();
	}

	private function add_image_highlight_style_section() {
		$this->start_controls_section( 'image_highlight_style_section', [
			'label' => esc_html__( 'Image Highlight', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
			'condition'    => [
				'image_highlight' => 'yes',
			],
		] );

		$this->add_responsive_control( 'image_highlight_top', [
			'label'      => esc_html__( 'Top', 'sala' ),
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
					'min' => -500,
					'max' => 500,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .image.image-highlight:after' => 'top: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'image_highlight_left', [
			'label'      => esc_html__( 'Left', 'sala' ),
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
					'min' => -500,
					'max' => 500,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .image.image-highlight:after' => 'left: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_control( 'image_bg_color', [
			'label'     => esc_html__( 'Background Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .image.image-highlight:after' => 'background-color: {{VALUE}};',
			],
		] );

		$this->end_controls_section();
	}

	protected function add_repeater_controls( Repeater $repeater ) {
		$repeater->add_control( 'title', [
			'label'       => esc_html__( 'Title', 'sala' ),
			'label_block' => true,
			'type'        => Controls_Manager::TEXT,
		] );

		$repeater->add_control( 'content', [
			'label' => esc_html__( 'Content', 'sala' ),
			'type'  => Controls_Manager::TEXTAREA,
		] );

		$repeater->add_control( 'image', [
			'label' => esc_html__( 'Avatar', 'sala' ),
			'type'  => Controls_Manager::MEDIA,
		] );

		$repeater->add_control( 'name', [
			'label'   => esc_html__( 'Name', 'sala' ),
			'type'    => Controls_Manager::TEXT,
			'default' => esc_html__( 'John Doe', 'sala' ),
		] );

		$repeater->add_control( 'position', [
			'label'   => esc_html__( 'Position', 'sala' ),
			'type'    => Controls_Manager::TEXT,
			'default' => esc_html__( 'CEO', 'sala' ),
		] );

		$repeater->add_control( 'rating', [
			'label' => esc_html__( 'Rating', 'sala' ),
			'type'  => Controls_Manager::NUMBER,
			'min'   => 0,
			'max'   => 5,
			'step'  => 0.1,
		] );

		$repeater->add_control( 'show_logo', [
			'label' => esc_html__( 'Show Logo', 'sala' ),
			'type'  => Controls_Manager::SWITCHER,
		] );

		$repeater->add_control( 'logo_company', [
			'label' => esc_html__( 'Logo Company', 'sala' ),
			'type'  => Controls_Manager::MEDIA,
			'condition' => [
				'show_logo' => 'yes',
			],
		] );
	}

	protected function get_repeater_defaults() {
		$placeholder_image_src = Utils::get_placeholder_image_src();

		return [
			[
				'content'  => esc_html__( 'I am slide content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'sala' ),
				'name'     => esc_html__( 'John Doe', 'sala' ),
				'position' => esc_html__( 'Web Design', 'sala' ),
				'image'    => [ 'url' => $placeholder_image_src ],
			],
			[
				'content'  => esc_html__( 'I am slide content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'sala' ),
				'name'     => esc_html__( 'John Doe', 'sala' ),
				'position' => esc_html__( 'Web Design', 'sala' ),
				'image'    => [ 'url' => $placeholder_image_src ],
			],
			[
				'content'  => esc_html__( 'I am slide content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'sala' ),
				'name'     => esc_html__( 'John Doe', 'sala' ),
				'position' => esc_html__( 'Web Design', 'sala' ),
				'image'    => [ 'url' => $placeholder_image_src ],
			],
		];
	}

	protected function update_slider_settings( $settings, $slider_settings ) {
		if ( 'image-above' === $settings['layout'] ) {
			$slider_settings['class'][]            = 'sala-main-swiper';
			$slider_settings['data-looped-slides'] = $this->slider_looped_slides;
		}

		return $slider_settings;
	}

	private function get_testimonial_rating_template( $rating = 5 ) {
		$full_stars = intval( $rating );
		$template   = '';

		$template .= str_repeat( '<span class="fa fa-star"></span>', $full_stars );

		$half_star = floatval( $rating ) - $full_stars;

		if ( $half_star != 0 ) {
			$template .= '<span class="fa fa-star-half-alt"></span>';
		}

		$empty_stars = intval( 5 - $rating );
		$template    .= str_repeat( '<span class="far fa-star"></span>', $empty_stars );

		return '<div class="testimonial-rating">' . $template . '</div>';
	}

	private function print_testimonial_cite() {
		$slide = $this->get_current_slide();
		$settings = $this->get_settings_for_display();

		if ( empty( $slide['name'] ) && empty( $slide['position'] ) ) {
			return;
		}

		$html = '<div class="cite">';

		if ( ! empty( $slide['rating'] ) && 'image-inline' !== $settings['layout'] ):
			$html .= $this->get_testimonial_rating_template( $slide['rating'] );
		endif;

		if ( ! empty( $slide['name'] ) ) {
			$html .= '<h4 class="name">' . $slide['name'] . '</h4>';
		}
		if ( ! empty( $slide['position'] ) ) {
			$html .= '<span class="position">' . $slide['position'] . '</span>';
		}
		$html .= '</div>';

		echo '' . $html;
	}

	private function print_testimonial_avatar() {
		$slide = $this->get_current_slide();
		$settings = $this->get_settings_for_display();

		if ( empty( $slide['image']['url'] ) ) {
			return;
		}

		if( 'yes' === $settings['image_highlight'] ){
			$highlight = 'image-highlight';
		} else {
			$highlight = '';
		}
		?>
		<div class="image <?php echo esc_attr( $highlight ); ?>">
			<?php
				if ( 'yes' === $settings['show_quote'] ) {
					echo '<span class="quote"><i class="fas fa-quote-right"></i></span>';
				}
			?>
			<?php echo \Sala_Image::get_elementor_attachment( [
				'settings'       => $slide,
				'image_size_key' => 'image_size',
			] ); ?>
		</div>
		<?php
	}

	private function print_testimonial_info() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="info">
			<?php if ( ! in_array( $settings['layout'], [ 'image-top', 'image-top-02', 'image-left', 'image-right' ], true ) ) : ?>
				<?php $this->print_testimonial_avatar(); ?>
			<?php endif; ?>

			<?php $this->print_testimonial_cite(); ?>

			<?php if ( 'above' != $settings['image_position'] ) : ?>
				<?php $this->print_testimonial_logo(); ?>
			<?php endif; ?>

		</div>
		<?php
	}

	private function print_testimonial_main_content() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="testimonial-main-content">
			<div class="content-wrap">
				<?php if ( 'image-above' === $settings['layout'] ) : ?>
					<?php $this->print_layout_image_above(); ?>
				<?php else: ?>
					<?php $this->print_layout(); ?>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}

	private function print_testimonial_logo() {
		$slide = $this->get_current_slide();

		if ( empty( $slide['logo_company']['url'] ) ) {
			return;
		}
		?>
		<div class="logo">
			<?php echo \Sala_Image::get_elementor_attachment( [
				'settings'       => $slide,
				'image_key'      => 'logo_company',
				'image_size_key' => 'image_size',
			] ); ?>
		</div>
		<?php
	}

	protected function print_slide() {
		$settings = $this->get_settings_for_display();
		$item_key = $this->get_current_key();
		$this->add_render_attribute( $item_key . '-testimonial', [
			'class' => 'testimonial-item',
		] );
		?>
		<div <?php $this->print_attributes_string( $item_key . '-testimonial' ); ?>>

			<?php if ( in_array( $settings['layout'], [ 'image-top', 'image-left' ], true ) ) : ?>
				<?php $this->print_testimonial_avatar(); ?>
			<?php endif; ?>



			<?php if ( in_array( $settings['style'], [ '02' ], true ) ) : ?>

				<div class="content-left">
					<?php $this->print_testimonial_main_content(); ?>
					<?php $this->print_testimonial_cite(); ?>
				</div>

				<div class="content-right">
					<?php $this->print_testimonial_avatar(); ?>
				</div>

			<?php else : ?>

				<?php $this->print_testimonial_main_content(); ?>

			<?php endif; ?>
		</div>
		<?php
	}

	private function print_layout_image_above() {
		$settings = $this->get_settings_for_display();
		$slide = $this->get_current_slide();
		?>
		<?php if ( $slide['content'] ) : ?>
			<div class="content">
				<?php if (  'yes' === $settings['show_content_quote'] ) : ?>
					<div class="quote-wrap">
						<svg width="48" height="32" viewBox="0 0 48 32" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M18.4821 14.8746C17.2442 14.1592 15.8688 13.6966 14.4401 13.5153C13.0115 13.3339 11.5598 13.4375 10.1739 13.8198C10.1018 13.8415 10.028 13.857 9.95311 13.8661C9.98286 12.895 10.3021 11.953 10.8721 11.1543C12.133 9.04127 14.5457 6.72195 17.5332 6.54807C17.7855 6.53351 18.0239 6.43127 18.2048 6.26008C18.3857 6.08889 18.4971 5.8602 18.5185 5.61586L18.9128 1.10691C18.9256 0.959015 18.9051 0.810177 18.8526 0.670778C18.8001 0.531378 18.7169 0.404772 18.6088 0.299788C18.5012 0.194207 18.3709 0.11295 18.2272 0.0618041C18.0835 0.0106577 17.93 -0.00912097 17.7776 0.00387687C11.2983 0.527535 1.60648 5.63943 0.260793 13.8742C-0.628968 19.3214 0.800412 25.1177 3.90091 28.6413C4.74751 29.6737 5.8206 30.5101 7.04211 31.0895C8.26363 31.6689 9.60287 31.9768 10.9624 31.9909C12.7099 32.0585 14.4511 31.7488 16.0603 31.0841C17.6695 30.4195 19.1067 29.4165 20.268 28.1476C21.1824 27.0966 21.8439 25.861 22.2042 24.5307C22.5646 23.2004 22.6147 21.8088 22.351 20.4574C22.1592 19.3111 21.7142 18.2186 21.0464 17.2549C20.3785 16.2913 19.5038 15.4792 18.4821 14.8746ZM18.655 26.8376C17.6891 27.8754 16.4983 28.6928 15.1682 29.2309C13.838 29.769 12.4016 30.0145 10.962 29.9497C9.90597 29.9378 8.86633 29.6947 7.92057 29.2386C6.97482 28.7825 6.14733 28.1251 5.49978 27.3155C2.82335 24.2748 1.55211 19.0006 2.33767 14.1935C3.43279 7.4907 10.996 3.14164 16.7066 2.19249L16.4947 4.61446C12.3796 5.31597 9.41665 8.98943 8.37494 11.4571C7.65994 13.1509 7.66699 14.5163 8.39598 15.3015C8.69648 15.6015 9.08272 15.8073 9.50487 15.8923C9.92703 15.9773 10.3657 15.9376 10.7644 15.7783C11.8673 15.4791 13.0209 15.3984 14.1566 15.5411C15.2923 15.6838 16.3867 16.047 17.3747 16.6089C18.1429 17.0653 18.8004 17.6775 19.3019 18.4036C19.8035 19.1297 20.1373 19.9524 20.2805 20.8154C20.488 21.8733 20.4498 22.9629 20.1686 24.0046C19.8874 25.0464 19.3703 26.0142 18.655 26.8376ZM47.8336 20.4573C47.6418 19.3111 47.1968 18.2187 46.5291 17.255C45.8614 16.2914 44.9868 15.4793 43.9653 14.8746C42.7273 14.1589 41.3517 13.6962 39.9229 13.5149C38.4941 13.3335 37.0422 13.4373 35.6562 13.8198C35.5841 13.8415 35.5102 13.857 35.4354 13.8661C35.4652 12.895 35.7845 11.953 36.3545 11.1543C37.6154 9.04127 40.0284 6.72195 43.0155 6.54807C43.2677 6.5336 43.5061 6.43138 43.687 6.26016C43.8678 6.08894 43.979 5.86019 44.0002 5.61586L44.3945 1.10691C44.4076 0.959017 44.3872 0.810134 44.3349 0.670667C44.2825 0.5312 44.1994 0.404512 44.0913 0.299455C43.9833 0.194398 43.8529 0.113508 43.7093 0.0624366C43.5657 0.0113653 43.4123 -0.00865451 43.2598 0.00377567C36.7805 0.527944 27.0881 5.63933 25.7441 13.8741C24.8539 19.3213 26.2832 25.1176 29.3842 28.6417C30.2307 29.674 31.3037 30.5102 32.525 31.0895C33.7464 31.6689 35.0854 31.9768 36.4448 31.9908C38.1923 32.0584 39.9334 31.7487 41.5426 31.0842C43.1518 30.4196 44.5889 29.4168 45.7504 28.148C46.6649 27.0969 47.3264 25.8612 47.6867 24.5309C48.0471 23.2005 48.0973 21.8088 47.8336 20.4573ZM44.138 26.8381C43.172 27.8758 41.9811 28.693 40.651 29.2311C39.3209 29.7691 37.8845 30.0147 36.445 29.9503C35.3891 29.9383 34.3496 29.6953 33.4039 29.2393C32.4583 28.7833 31.6308 28.126 30.9833 27.3166C28.3063 24.2749 27.0361 19.0011 27.8206 14.1945C28.9153 7.49172 36.4789 3.14266 42.1891 2.19351L41.978 4.61497C37.8634 5.31648 34.9001 8.98994 33.8578 11.4576C33.1428 13.1515 33.1503 14.5168 33.8789 15.302C34.1797 15.6016 34.566 15.8071 34.9881 15.8921C35.4103 15.9771 35.8489 15.9376 36.2477 15.7788C37.3505 15.4798 38.5041 15.3993 39.6396 15.542C40.7752 15.6847 41.8695 16.0477 42.8574 16.6094C43.6257 17.0658 44.2832 17.678 44.7848 18.404C45.2864 19.1301 45.6202 19.9529 45.7633 20.8159C45.9707 21.8738 45.9325 22.9633 45.6513 24.0051C45.3702 25.0468 44.8532 26.0147 44.138 26.8381Z" fill="#999999"/>
						</svg>
					</div>
				<?php endif; ?>
				<div class="text">
					<?php echo wp_kses( $slide['content'], 'sala-default' ); ?>
				</div>
			</div>
		<?php endif; ?>

		<?php $this->print_testimonial_cite(); ?>

		<?php
	}

	private function print_layout() {
		$slide    = $this->get_current_slide();
		$settings = $this->get_settings_for_display();
		?>
		<?php if ( 'image-top-02' === $settings['layout'] ) : ?>
			<?php $this->print_testimonial_avatar(); ?>
		<?php endif; ?>

		<?php if ( 'above' === $settings['image_position'] ) : ?>
			<?php $this->print_testimonial_info(); ?>
		<?php endif; ?>

		<?php if ( $slide['content'] ) : ?>
			<div class="content">
				<?php if (  'yes' === $settings['show_content_quote'] ) : ?>
					<div class="quote-wrap">
						<svg width="48" height="32" viewBox="0 0 48 32" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M18.4821 14.8746C17.2442 14.1592 15.8688 13.6966 14.4401 13.5153C13.0115 13.3339 11.5598 13.4375 10.1739 13.8198C10.1018 13.8415 10.028 13.857 9.95311 13.8661C9.98286 12.895 10.3021 11.953 10.8721 11.1543C12.133 9.04127 14.5457 6.72195 17.5332 6.54807C17.7855 6.53351 18.0239 6.43127 18.2048 6.26008C18.3857 6.08889 18.4971 5.8602 18.5185 5.61586L18.9128 1.10691C18.9256 0.959015 18.9051 0.810177 18.8526 0.670778C18.8001 0.531378 18.7169 0.404772 18.6088 0.299788C18.5012 0.194207 18.3709 0.11295 18.2272 0.0618041C18.0835 0.0106577 17.93 -0.00912097 17.7776 0.00387687C11.2983 0.527535 1.60648 5.63943 0.260793 13.8742C-0.628968 19.3214 0.800412 25.1177 3.90091 28.6413C4.74751 29.6737 5.8206 30.5101 7.04211 31.0895C8.26363 31.6689 9.60287 31.9768 10.9624 31.9909C12.7099 32.0585 14.4511 31.7488 16.0603 31.0841C17.6695 30.4195 19.1067 29.4165 20.268 28.1476C21.1824 27.0966 21.8439 25.861 22.2042 24.5307C22.5646 23.2004 22.6147 21.8088 22.351 20.4574C22.1592 19.3111 21.7142 18.2186 21.0464 17.2549C20.3785 16.2913 19.5038 15.4792 18.4821 14.8746ZM18.655 26.8376C17.6891 27.8754 16.4983 28.6928 15.1682 29.2309C13.838 29.769 12.4016 30.0145 10.962 29.9497C9.90597 29.9378 8.86633 29.6947 7.92057 29.2386C6.97482 28.7825 6.14733 28.1251 5.49978 27.3155C2.82335 24.2748 1.55211 19.0006 2.33767 14.1935C3.43279 7.4907 10.996 3.14164 16.7066 2.19249L16.4947 4.61446C12.3796 5.31597 9.41665 8.98943 8.37494 11.4571C7.65994 13.1509 7.66699 14.5163 8.39598 15.3015C8.69648 15.6015 9.08272 15.8073 9.50487 15.8923C9.92703 15.9773 10.3657 15.9376 10.7644 15.7783C11.8673 15.4791 13.0209 15.3984 14.1566 15.5411C15.2923 15.6838 16.3867 16.047 17.3747 16.6089C18.1429 17.0653 18.8004 17.6775 19.3019 18.4036C19.8035 19.1297 20.1373 19.9524 20.2805 20.8154C20.488 21.8733 20.4498 22.9629 20.1686 24.0046C19.8874 25.0464 19.3703 26.0142 18.655 26.8376ZM47.8336 20.4573C47.6418 19.3111 47.1968 18.2187 46.5291 17.255C45.8614 16.2914 44.9868 15.4793 43.9653 14.8746C42.7273 14.1589 41.3517 13.6962 39.9229 13.5149C38.4941 13.3335 37.0422 13.4373 35.6562 13.8198C35.5841 13.8415 35.5102 13.857 35.4354 13.8661C35.4652 12.895 35.7845 11.953 36.3545 11.1543C37.6154 9.04127 40.0284 6.72195 43.0155 6.54807C43.2677 6.5336 43.5061 6.43138 43.687 6.26016C43.8678 6.08894 43.979 5.86019 44.0002 5.61586L44.3945 1.10691C44.4076 0.959017 44.3872 0.810134 44.3349 0.670667C44.2825 0.5312 44.1994 0.404512 44.0913 0.299455C43.9833 0.194398 43.8529 0.113508 43.7093 0.0624366C43.5657 0.0113653 43.4123 -0.00865451 43.2598 0.00377567C36.7805 0.527944 27.0881 5.63933 25.7441 13.8741C24.8539 19.3213 26.2832 25.1176 29.3842 28.6417C30.2307 29.674 31.3037 30.5102 32.525 31.0895C33.7464 31.6689 35.0854 31.9768 36.4448 31.9908C38.1923 32.0584 39.9334 31.7487 41.5426 31.0842C43.1518 30.4196 44.5889 29.4168 45.7504 28.148C46.6649 27.0969 47.3264 25.8612 47.6867 24.5309C48.0471 23.2005 48.0973 21.8088 47.8336 20.4573ZM44.138 26.8381C43.172 27.8758 41.9811 28.693 40.651 29.2311C39.3209 29.7691 37.8845 30.0147 36.445 29.9503C35.3891 29.9383 34.3496 29.6953 33.4039 29.2393C32.4583 28.7833 31.6308 28.126 30.9833 27.3166C28.3063 24.2749 27.0361 19.0011 27.8206 14.1945C28.9153 7.49172 36.4789 3.14266 42.1891 2.19351L41.978 4.61497C37.8634 5.31648 34.9001 8.98994 33.8578 11.4576C33.1428 13.1515 33.1503 14.5168 33.8789 15.302C34.1797 15.6016 34.566 15.8071 34.9881 15.8921C35.4103 15.9771 35.8489 15.9376 36.2477 15.7788C37.3505 15.4798 38.5041 15.3993 39.6396 15.542C40.7752 15.6847 41.8695 16.0477 42.8574 16.6094C43.6257 17.0658 44.2832 17.678 44.7848 18.404C45.2864 19.1301 45.6202 19.9529 45.7633 20.8159C45.9707 21.8738 45.9325 22.9633 45.6513 24.0051C45.3702 25.0468 44.8532 26.0147 44.138 26.8381Z" fill="#999999"/>
						</svg>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $slide['title'] ) ): ?>
					<h4 class="title"><?php echo esc_html( $slide['title'] ); ?></h4>
				<?php endif; ?>

				<div class="text">
					<?php echo wp_kses( $slide['content'], 'sala-default' ); ?>
				</div>

				<?php
				if ( ! empty( $slide['rating'] ) && 'image-inline' === $settings['layout'] ):
					echo $this->get_testimonial_rating_template( $slide['rating'] );
				endif;
				?>
			</div>
		<?php endif; ?>

		<?php if ( 'above' === $settings['image_position'] ) : ?>
			<?php $this->print_testimonial_logo(); ?>
		<?php endif; ?>

		<?php if ( in_array( $settings['image_position'], array(
				'below',
				'bottom',
			), true ) || in_array( $settings['layout'], array(
				'image-top',
				'image-top-02',
				'image-left',
				'image-right',
			), true ) ) : ?>
			<?php $this->print_testimonial_info(); ?>
		<?php endif; ?>

		<?php
	}

	/**
	 * Print Avatar Thumbs Slider
	 */
	protected function after_slider() {
		$settings = $this->get_active_settings();

		if ( 'image-above' !== $settings['layout'] ) {
			return;
		}

		$this->add_render_attribute( '_wrapper', 'class', 'sala-swiper-slider-linked-yes' );

		$testimonial_thumbs_template = '';

		foreach ( $settings['slides'] as $slide ) :
			if ( $slide['image']['url'] ) :
				$testimonial_thumbs_template .= '<div class="swiper-slide"><div class="post-thumbnail"><div class="image">' . \Sala_Image::get_elementor_attachment( [
						'settings'       => $slide,
						'image_size_key' => 'image_size',
					] ) . '</div></div></div>';
			endif;
		endforeach;

		?>
		<div class="sala-swiper-slider sala-slider-widget sala-testimonial-pagination style-01 sala-thumbs-swiper"
		     data-lg-items="3"
		     data-lg-gutter="30"
		     data-slide-to-clicked-slide="1"
		     data-centered="1"
		     data-loop="1"
		     data-looped-slides="<?php echo esc_attr( $this->slider_looped_slides ); ?>"
		>
			<div class="swiper-inner">
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<?php echo '' . $testimonial_thumbs_template; ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
