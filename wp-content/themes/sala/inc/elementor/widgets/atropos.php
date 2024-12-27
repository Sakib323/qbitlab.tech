<?php

namespace Sala_Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;

defined( 'ABSPATH' ) || exit;

class Widget_Atropos extends Base {

	public function get_name() {
		return 'sala-atropos';
	}

	public function get_title() {
		return esc_html__( 'Atropos', 'sala' );
	}

	public function get_icon_part() {
		return 'eicon-instagram-nested-gallery';
	}

	public function get_keywords() {
		return [ 'image', 'photo', 'visual', 'layer' ];
	}

	protected function register_controls() {
		$this->add_artboard_section();

		$this->add_layers_section();

		$this->add_artboard_style_section();
	}

	private function add_artboard_section() {
		$this->start_controls_section( 'artboard_section', [
			'label' => esc_html__( 'Artboard', 'sala' ),
		] );

		$this->add_responsive_control( 'width', [
			'label'      => esc_html__( 'Width', 'sala' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'size' => 500,
				'unit' => 'px',
			],
			'size_units' => [ '%', 'px' ],
			'range'      => [
				'%'  => [
					'min' => 5,
					'max' => 100,
				],
				'px' => [
					'min' => 1,
					'max' => 1920,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .atropos' => 'width: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'height', [
			'label'      => esc_html__( 'Height', 'sala' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'size' => 500,
				'unit' => 'px',
			],
			'size_units' => [ '%', 'px' ],
			'range'      => [
				'%'  => [
					'min' => 5,
					'max' => 100,
				],
				'px' => [
					'min' => 1,
					'max' => 1000,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .atropos' => 'height: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'alignment', [
			'label'     => esc_html__( 'Alignment', 'sala' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => Widget_Utils::get_control_options_horizontal_alignment(),
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}}' => 'text-align: {{VALUE}};',
			],
		] );

		$this->add_control( 'shadow_enable', [
			'label' => esc_html__( 'Shadow Enable', 'sala' ),
			'type'  => Controls_Manager::SWITCHER,
			'default' => 'yes',
		] );

		$this->add_control( 'highlight_enable', [
			'label' => esc_html__( 'Highlight Enable', 'sala' ),
			'type'  => Controls_Manager::SWITCHER,
			'default' => 'yes',
		] );

		$this->add_control( 'duration', [
			'label'      => esc_html__( 'Duration', 'sala' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'min'  => 100,
					'max'  => 1000,
					'step' => 100,
				],
			],
		] );

		$this->add_control( 'shadow_scale', [
			'label'      => esc_html__( 'Shadow Scale', 'sala' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'min'  => -2,
					'max'  => 2,
					'step' => 0.1,
				],
			],
		] );

		$this->end_controls_section();
	}

	private function add_layers_section() {
		$this->start_controls_section( 'layers_section', [
			'label' => esc_html__( 'Layers', 'sala' ),
		] );

		$this->add_control( 'image_background', [
			'label' => esc_html__( 'Image Background', 'sala' ),
			'type'  => Controls_Manager::MEDIA,
		] );

		$repeater = new Repeater();

		$repeater->start_controls_tabs( 'layer_tabs' );

		$repeater->start_controls_tab( 'layer_content_tab', [
			'label' => esc_html__( 'Content', 'sala' ),
		] );

		$repeater->add_control( 'style', [
			'label'   => esc_html__( 'Style', 'sala' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'text' 			=> 'Text',
				'textarea' 		=> 'Textarea',
				'img' 			=> 'Image',
			],
			'default' => 'img',
		] );

		$repeater->add_control( 'text', [
			'label'       => esc_html__( 'Text', 'sala' ),
			'type'        => Controls_Manager::TEXT,
			'dynamic'     => [
				'active' => true,
			],
			'default'     => '',
			'placeholder' => esc_html__( 'Enter your title', 'sala' ),
			'label_block' => true,
			'condition'  => [
				'style' => 'text',
			],
		] );

		$repeater->add_control( 'textarea', [
			'label'       => esc_html__( 'Description', 'sala' ),
			'type'        => Controls_Manager::TEXTAREA,
			'default'     => '',
			'placeholder' => esc_html__( 'Enter your description', 'sala' ),
			'separator'   => 'none',
			'dynamic'     => [
				'active' => true,
			],
			'rows'        => 10,
			'show_label'  => false,
			'condition'  => [
				'style' => 'textarea',
			],
		] );

		$repeater->add_control( 'image', [
			'label' => esc_html__( 'Image', 'sala' ),
			'type'  => Controls_Manager::MEDIA,
			'condition'  => [
				'style' => 'img',
			],
		] );

		$repeater->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'      => 'image',
			'default'   => 'full',
			'separator' => 'before',
			'condition'  => [
				'style' => 'img',
			],
		] );

		$repeater->end_controls_tab();

		$repeater->start_controls_tab( 'layer_position_tab', [
			'label' => esc_html__( 'Position', 'sala' ),
		] );

		$repeater->add_responsive_control( 'width', [
			'label'      => esc_html__( 'Width', 'sala' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ '%', 'px' ],
			'range'      => [
				'%'  => [
					'min' => 5,
					'max' => 100,
				],
				'px' => [
					'min' => 1,
					'max' => 1920,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} {{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}};',
			],
		] );

		$repeater->add_responsive_control( 'height', [
			'label'      => esc_html__( 'Height', 'sala' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ '%', 'px' ],
			'range'      => [
				'%'  => [
					'min' => 5,
					'max' => 100,
				],
				'px' => [
					'min' => 1,
					'max' => 1000,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} {{CURRENT_ITEM}}' => 'height: {{SIZE}}{{UNIT}};',
			],
		] );

		$repeater->add_responsive_control( 'top', [
			'label'      => esc_html__( 'Top', 'sala' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ '%', 'px' ],
			'range'      => [
				'%'  => [
					'min' => 0,
					'max' => 100,
				],
				'px' => [
					'min' => -500,
					'max' => 500,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}{{UNIT}};',
			],
		] );

		$repeater->add_responsive_control( 'left', [
			'label'      => esc_html__( 'Left', 'sala' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ '%', 'px' ],
			'range'      => [
				'%'  => [
					'min' => 0,
					'max' => 100,
				],
				'px' => [
					'min' => -500,
					'max' => 500,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}};',
			],
		] );

		$repeater->end_controls_tab();

		$repeater->start_controls_tab( 'layer_style_tab', [
			'label' => esc_html__( 'Style', 'sala' ),
		] );

		$repeater->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'box_shadow',
			'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
		] );

		$repeater->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'label'    => esc_html__( 'Typography', 'sala' ),
			'selector' => '{{WRAPPER}} .atropos-title',
			'condition'  => [
				'style' => 'text',
			],
		] );

		$repeater->add_control( 'text_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .atropos-title' => 'color: {{VALUE}};',
			],
			'condition'  => [
				'style' => 'text',
			],
		] );

		$repeater->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'textarea_typography',
			'label'    => esc_html__( 'Typography', 'sala' ),
			'selector' => '{{WRAPPER}} .atropos-textarea',
			'condition'  => [
				'style' => 'textarea',
			],
		] );

		$repeater->add_control( 'textarea_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .atropos-textarea' => 'color: {{VALUE}};',
			],
			'condition'  => [
				'style' => 'textarea',
			],
		] );

		$repeater->add_control( 'offset', [
			'label'      => esc_html__( 'Offset', 'sala' ),
			'type'       => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max'  => 10,
					'min'  => -10,
				],
			],
		] );

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control( 'layers', [
			'type'   => Controls_Manager::REPEATER,
			'fields' => $repeater->get_controls(),
		] );

		$this->end_controls_section();
	}

	private function add_artboard_style_section() {
		$this->start_controls_section( 'artboard_style_section', [
			'label' => esc_html__( 'Artboard', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'artboard_box_shadow',
			'selector' => '{{WRAPPER}} .atropos',
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if( $settings['shadow_enable'] == 'yes' ){
			$shadow = 'true';
		} else {
			$shadow = 'false';
		}

		if( $settings['highlight_enable'] == 'yes' ){
			$highlight = 'true';
		} else {
			$highlight = 'false';
		}

		if( $settings['duration']['size'] ){
			$duration = $settings['duration']['size'];
		} else {
			$duration = '300';
		}

		if( $settings['shadow_scale']['size'] ){
			$shadow_scale = $settings['shadow_scale']['size'];
		} else {
			$shadow_scale = '0.8';
		}

		$this->add_render_attribute( 'atropos', 'class', 'atropos sala-atropos' );
		?>
		<div <?php $this->print_attributes_string( 'atropos' ); ?> data-shadow="<?php esc_attr_e( $shadow ); ?>" data-highlight="<?php esc_attr_e( $highlight ); ?>" data-duration="<?php esc_attr_e( $duration ); ?>" data-shadowscale="<?php esc_attr_e( $shadow_scale ); ?>">
			<div class="atropos-scale">
				<div class="atropos-rotate">
					<div class="atropos-inner">
						<?php
						echo \Sala_Image::get_elementor_attachment( [
							'settings' => $settings,
							'image_key' => 'image_background',
						] );
						?>
					<?php
						if ( ! empty( $settings['layers'] ) ) {
							foreach ( $settings['layers'] as $key => $layer ) {
								$item_key = 'item_' . $layer['_id'];
								$this->add_render_attribute( $item_key, 'class', [
									'atropos-item',
									'elementor-repeater-item-' . $layer['_id'],
								] );

								if( $layer['offset']['size'] ){
									$offset = $layer['offset']['size'];
								} else {
									$offset = 0;
								}

								?>
								<div <?php $this->print_attributes_string( $item_key ); ?> data-atropos-offset="<?php echo esc_attr( $offset ); ?>" style="z-index: <?php echo esc_attr( $key ); ?>">
									<?php

										if( $layer['style'] == 'text' ){
											echo '<h3 class="atropos-title">' . $layer['text'] . '</h3>';
										} else if( $layer['style'] == 'textarea' ){
											echo '<div class="atropos-textarea">' . $layer['textarea'] . '</div>';
										} else if( $layer['style'] == 'img' ){
											echo \Sala_Image::get_elementor_attachment( [
												'settings' => $layer,
											] );
										}

									?>
								</div>
								<?php
							}
						}
					?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
