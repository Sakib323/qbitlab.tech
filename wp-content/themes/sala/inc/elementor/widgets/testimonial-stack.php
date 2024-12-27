<?php

namespace Sala_Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Core\Schemes\Color as Scheme_Color;

defined( 'ABSPATH' ) || exit;

class Widget_Testimonial_Stack extends Base {

	private $current_item_key;
	private $current_item;

	protected function get_current_key() {
		return $this->current_item_key;
	}

	protected function get_current_item() {
		return $this->current_item;
	}

	public function get_name() {
		return 'sala-testimonial-stack';
	}

	public function get_title() {
		return esc_html__( 'Testimonial Stack', 'sala' );
	}

	public function get_icon_part() {
		return 'eicon-parallax';
	}

	public function get_keywords() {
		return [ 'testimonial', 'stack' ];
	}

	public function get_script_depends() {
		return [ 'sala-widget-testimonial-stack' ];
	}

	protected function register_controls() {
		$this->add_layout_section();
		$this->add_content_section();
		$this->add_navigation_section();
		$this->add_box_style_section();
		$this->add_content_style_section();
		$this->add_quote_style_section();
	}

	private function add_layout_section() {
		$this->start_controls_section( 'layout_section', [
			'label' => esc_html__( 'Layout', 'sala' ),
		] );

		$this->add_control( 'align', [
			'label'        => esc_html__( 'Image Align', 'sala' ),
			'type'         => Controls_Manager::SELECT,
			'default'      => 'left',
			'options'      => [
				'left' => esc_html__( 'Left', 'sala' ),
				'right' => esc_html__( 'Right', 'sala' ),
			],
			'render_type'  => 'template',
			'prefix_class' => 'sala-align-',
		] );

		$this->add_responsive_control( 'drag_back', [
			'label'      => esc_html__( 'Drag Back', 'sala' ),
			'description' => esc_html__( 'If the user stops dragging the image in a area that does not exceed [distDragBack]px then the image goes back to the stack', 'sala' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'unit' => 'px',
				'size' => 200,
			],
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'min' => 100,
					'max' => 1000,
				],
			],
		] );

		$this->add_responsive_control( 'drag_max', [
			'label'      => esc_html__( 'Drag Max', 'sala' ),
			'description' => esc_html__( 'If the user drags the image in a area that exceeds [distDragMax]px then the image moves away from the stack', 'sala' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'unit' => 'px',
				'size' => 450,
			],
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'min' => 100,
					'max' => 1000,
				],
			],
		] );

		$this->add_control( 'show_quote', [
			'label' => esc_html__( 'Show Quote', 'sala' ),
			'type'  => Controls_Manager::SWITCHER,
		] );

		$this->add_control( 'quote', [
			'label' => esc_html__( 'Quote', 'sala' ),
			'type'  => Controls_Manager::MEDIA,
			'condition' => [
				'show_quote' => 'yes',
			],
		] );

		$this->end_controls_section();
	}

	private function add_content_section() {
		$this->start_controls_section( 'content_section', [
			'label' => esc_html__( 'Content', 'sala' ),
		] );

		$repeater = new Repeater();

		$repeater->add_control( 'thumbnail', [
			'label' => esc_html__( 'Thumbnail', 'sala' ),
			'type'  => Controls_Manager::MEDIA,
		] );

		$repeater->add_control( 'title', [
			'label'       => esc_html__( 'Title', 'sala' ),
			'label_block' => true,
			'type'        => Controls_Manager::TEXT,
		] );

		$repeater->add_control( 'content', [
			'label' => esc_html__( 'Content', 'sala' ),
			'type'  => Controls_Manager::TEXTAREA,
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

		$placeholder_image_src = Utils::get_placeholder_image_src();

		$this->add_control( 'items', [
			'label'       => esc_html__( 'Items', 'sala' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
				[
					'thumbnail' => [ 'url' => $placeholder_image_src ],
					'content'   => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'sala' ),
					'name'      => esc_html__( 'John Doe', 'sala' ),
					'position'  => esc_html__( 'CEO', 'sala' ),
				],
				[
					'thumbnail' => [ 'url' => $placeholder_image_src ],
					'content'   => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'sala' ),
					'name'      => esc_html__( 'John Doe', 'sala' ),
					'position'  => esc_html__( 'CEO', 'sala' ),
				],
				[
					'thumbnail' => [ 'url' => $placeholder_image_src ],
					'content'   => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'sala' ),
					'name'      => esc_html__( 'John Doe', 'sala' ),
					'position'  => esc_html__( 'CEO', 'sala' ),
				],
			],
			'separator'   => 'after',
			'title_field' => '{{{ name }}}',
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'           => 'thumbnail',
			'default'        => 'full',
			'fields_options' => [
				'size' => [
					'label' => esc_html__( 'Thumbnail Size', 'sala' ),
				],
			],
		] );

		$this->end_controls_section();
	}

	private function add_navigation_section() {
		$this->start_controls_section( 'navigation_section', [
			'label' => esc_html__( 'Navigation', 'sala' ),
		] );

		$this->add_control( 'navigation_show', [
			'label' => esc_html__( 'Show Navigation', 'sala' ),
			'type'  => Controls_Manager::SWITCHER,
		] );

		$this->add_control( 'navigation_image_show', [
			'label' => esc_html__( 'Show Navigation Image', 'sala' ),
			'type'  => Controls_Manager::SWITCHER,
			'condition' => [
				'navigation_show' => 'yes',
			],
		] );

		$this->add_control( 'icon_next', [
			'label'      => esc_html__( 'Icon Next', 'sala' ),
			'type'       => Controls_Manager::ICONS,
			'default'    => [
				'value'   => 'fal fa-long-arrow-right',
				'library' => 'fa-solid',
			],
			'condition' => [
				'navigation_show' => 'yes',
				'navigation_image_show!' => 'yes',
			],
		] );

		$this->add_control( 'icon_prev', [
			'label'      => esc_html__( 'Icon Prev', 'sala' ),
			'type'       => Controls_Manager::ICONS,
			'default'    => [
				'value'   => 'fal fa-long-arrow-left',
				'library' => 'fa-solid',
			],
			'condition' => [
				'navigation_show' => 'yes',
				'navigation_image_show!' => 'yes',
			],
		] );

		$this->add_control( 'image_next', [
			'label' => esc_html__( 'Thumbnail Next', 'sala' ),
			'type'  => Controls_Manager::MEDIA,
			'condition' => [
				'navigation_show' => 'yes',
				'navigation_image_show' => 'yes',
			],
		] );

		$this->add_control( 'image_prev', [
			'label' => esc_html__( 'Thumbnail Prev', 'sala' ),
			'type'  => Controls_Manager::MEDIA,
			'condition' => [
				'navigation_show' => 'yes',
				'navigation_image_show' => 'yes',
			],
		] );

		$this->end_controls_section();
	}

	private function add_box_style_section() {
		$this->start_controls_section( 'box_style_section', [
			'label' => esc_html__( 'Box', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
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
					'min' => 300,
					'max' => 1600,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .sala-testimonial-stack #elasticstack' => 'width: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'box_padding', [
			'label'      => esc_html__( 'Padding', 'sala' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .sala-testimonial-stack #elasticstack .grid-item .testimonial-main-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'box_radius', [
			'label'      => esc_html__( 'Border Radius', 'sala' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .sala-testimonial-stack .grid-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'box_background_color', [
			'label'     => esc_html__( 'Background Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .sala-testimonial-stack #elasticstack .grid-item' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'box_shadow',
			'selector' => '{{WRAPPER}} .sala-testimonial-stack #elasticstack .grid-item',
		] );

		$this->end_controls_section();
	}

	private function add_content_style_section() {
		$this->start_controls_section( 'content_style_section', [
			'label' => esc_html__( 'Content', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
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
				'{{WRAPPER}} #elasticstack .text' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'text_typography',
			'label'    => esc_html__( 'Typography', 'sala' ),
			'selector' => '{{WRAPPER}} #elasticstack .text',
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
				'{{WRAPPER}} #elasticstack .name' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'name_typography',
			'label'    => esc_html__( 'Typography', 'sala' ),
			'selector' => '{{WRAPPER}} #elasticstack .name',
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
				'{{WRAPPER}} #elasticstack .position' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'position_typography',
			'label'    => esc_html__( 'Typography', 'sala' ),
			'selector' => '{{WRAPPER}} #elasticstack .position',
		] );

		$this->end_controls_section();
	}

	private function add_quote_style_section() {
		$this->start_controls_section( 'quote_style_section', [
			'label' => esc_html__( 'Quote', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
			'condition' => [
				'show_quote' => 'yes',
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
				'{{WRAPPER}} #elasticstack .quote' => 'top: {{SIZE}}{{UNIT}};',
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
				'{{WRAPPER}} #elasticstack .quote' => 'right: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'sala-testimonial-stack' );
		?>

		<div <?php $this->print_attributes_string( 'wrapper' ); ?>>

			<div id="elasticstack" class="inner" data-dragback="<?php echo $settings['drag_back']['size']; ?>" data-dragmax="<?php echo $settings['drag_max']['size']; ?>">
				<?php foreach ( $settings['items'] as $item ) : ?>
					<?php
					$item_id                = $item['_id'];
					$this->current_item     = $item;
					$this->current_item_key = 'item_' . $item_id;

					$this->add_render_attribute( $this->get_current_key(), [
						'class' => [
							'grid-item',
							'elementor-repeater-item-' . $item_id,
						],
					] );
					?>
					<div <?php $this->print_attributes_string( $this->get_current_key() ); ?>>
						<?php
						$this->add_render_attribute( $this->get_current_key() . '-testimonial', [
							'class' => 'sala-box testimonial-item',
						] );
						?>
						<div <?php $this->print_attributes_string( $this->get_current_key() . '-testimonial' ); ?>>
							<?php $this->print_testimonial_thumbnail(); ?>

							<?php $this->print_testimonial_main_content(); ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

			<div class="elasticstack-nav">
				<?php $this->print_icon_prev($settings); ?>
				<?php $this->print_icon_next($settings); ?>
			</div>

		</div>
		<?php
	}

	private function print_testimonial_rating( $rating = 5 ) {
		$full_stars = intval( $rating );
		$template   = '';

		$template .= str_repeat( '<span class="fa fa-star"></span>', $full_stars );

		$half_star = floatval( $rating ) - $full_stars;

		if ( $half_star != 0 ) {
			$template .= '<span class="fa fa-star-half-alt"></span>';
		}

		$empty_stars = intval( 5 - $rating );
		$template    .= str_repeat( '<span class="far fa-star"></span>', $empty_stars );

		echo '<div class="testimonial-rating">' . $template . '</div>';
	}

	private function print_testimonial_cite() {
		$item = $this->get_current_item();

		if ( empty( $item['name'] ) && empty( $item['position'] ) ) {
			return;
		}

		$html = '<div class="cite">';
		if ( ! empty( $item['name'] ) ) {
			$html .= '<h6 class="name">' . $item['name'] . '</h6>';
		}
		if ( ! empty( $item['position'] ) ) {
			$html .= '<span class="position">' . $item['position'] . '</span>';
		}
		$html .= '</div>';

		echo '' . $html;
	}

	private function print_testimonial_info() {
		?>
		<div class="info">
			<?php $this->print_testimonial_cite(); ?>
		</div>
		<?php
	}

	private function print_testimonial_thumbnail() {
		$settings = $this->get_settings_for_display();
		$item     = $this->get_current_item();

		if ( empty( $item['thumbnail']['url'] ) ) {
			return;
		}
		?>
		<div class="sala-image thumbnail">
			<?php echo \Sala_Image::get_elementor_attachment( [
				'settings'       => $item,
				'image_key'      => 'thumbnail',
				'image_size_key' => 'thumbnail',
				'size_settings'  => $settings,
			] ); ?>
		</div>
		<?php
	}

	private function print_testimonial_main_content() {
		$settings = $this->get_settings_for_display();
		$item     = $this->get_current_item();
		?>
		<div class="testimonial-main-content">
			<div class="quote">
				<?php echo \Sala_Image::get_elementor_attachment( [
					'settings'       => $settings,
					'image_key'      => 'quote',
				] ); ?>
			</div>
			<div class="content-wrap">
				<?php $this->print_layout(); ?>
			</div>
		</div>
		<?php
	}

	private function print_icon_next( array $settings ) {
		$this->add_render_attribute( 'icon_next', 'class', [
			'sala-icon-next',
			'icon',
		] );

		$is_svg = isset( $settings['icon_next']['library'] ) && 'svg' === $settings['icon_next']['library'] ? true : false;

		if ( $is_svg ) {
			$this->add_render_attribute( 'icon_next', 'class', [
				'sala-svg-icon',
			] );
		}
		if( $settings['image_next'] ){
		?>
			<div <?php $this->print_attributes_string( 'icon_next' ); ?>>
				<span class="elasticstack-next">
					<?php echo \Sala_Image::get_elementor_attachment( [
						'settings'  => $settings,
						'image_key' => 'image_next',
					] ); ?>
				</span>
			</div>
		<?php
			} else {
		?>
			<div <?php $this->print_attributes_string( 'icon_next' ); ?>>
				<span class="elasticstack-next">
					<?php $this->render_icon( $settings, $settings['icon_next'], [ 'aria-hidden' => 'true' ], $is_svg, 'icon_next' ); ?>
				</span>
			</div>
		<?php
		}
	}

	private function print_icon_prev( array $settings ) {
		$this->add_render_attribute( 'icon_prev', 'class', [
			'sala-icon-prev',
			'icon',
		] );

		$is_svg = isset( $settings['icon_prev']['library'] ) && 'svg' === $settings['icon_prev']['library'] ? true : false;

		if ( $is_svg ) {
			$this->add_render_attribute( 'icon_prev', 'class', [
				'sala-svg-icon',
			] );
		}
		if( $settings['image_prev'] ){
		?>
			<div <?php $this->print_attributes_string( 'icon_prev' ); ?>>
				<span class="elasticstack-prev">
					<?php echo \Sala_Image::get_elementor_attachment( [
						'settings'  => $settings,
						'image_key' => 'image_prev',
					] ); ?>
				</span>
			</div>
		<?php
			} else {
		?>
			<div <?php $this->print_attributes_string( 'icon_prev' ); ?>>
				<span class="elasticstack-prev">
					<?php $this->render_icon( $settings, $settings['icon_prev'], [ 'aria-hidden' => 'true' ], $is_svg, 'icon_prev' ); ?>
				</span>
			</div>
		<?php
		}
	}

	private function print_layout() {
		$settings = $this->get_settings_for_display();
		$item     = $this->get_current_item();
		?>

		<?php if ( $item['content'] ) : ?>
			<div class="content">
				<?php if ( ! empty( $item['title'] ) ): ?>
					<h4 class="title"><?php echo esc_html( $item['title'] ); ?></h4>
				<?php endif; ?>

				<div class="text">
					<?php echo wp_kses( $item['content'], 'sala-default' ); ?>
				</div>

				<?php if ( ! empty( $item['rating'] ) ): ?>
					<?php $this->print_testimonial_rating( $item['rating'] ); ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php $this->print_testimonial_info(); ?>

		<?php
	}
}
