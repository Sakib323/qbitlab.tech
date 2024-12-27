<?php

namespace Sala_Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Core\Base\Document;

defined( 'ABSPATH' ) || exit;

class Widget_Portfolio_Modern extends Posts_Base {

	public function get_name() {
		return 'sala-portfolio';
	}

	public function get_title() {
		return esc_html__( 'Portfolio Modern', 'sala' );
	}

	public function get_icon_part() {
		return 'eicon-gallery-justified';
	}

	public function get_keywords() {
		return [ 'portfolio' ];
	}

	protected function get_post_type() {
		return 'portfolio';
	}

	protected function get_post_category() {
		return 'category';
	}

	public function get_script_depends() {
		return [
			'sala-grid-query',
			'sala-widget-grid-portfolio',
		];
	}

	public function is_reload_preview_required() {
		return false;
	}

	protected function register_controls() {
		$this->add_layout_section();

		$this->add_grid_section();

		$this->add_filter_section();

		$this->add_pagination_section();

		$this->add_thumbnail_style_section();

		$this->add_pagination_style_section();

		parent::register_controls();
	}

	private function add_layout_section() {
		$this->start_controls_section( 'layout_section', [
			'label' => esc_html__( 'Layout', 'sala' ),
		] );

		$this->add_control( 'layout', [
			'label'   => esc_html__( 'Layout', 'sala' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'grid'    		=> esc_html__( 'Grid', 'sala' ),
				'metro'    		=> esc_html__( 'Metro', 'sala' ),
				'masonry'   	=> esc_html__( 'Masonry', 'sala' ),
				'mosaic'    	=> esc_html__( 'Mosaic', 'sala' ),
			],
			'default' => 'grid',
		] );

		$this->add_control( 'type', [
			'label'   => esc_html__( 'Type', 'sala' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'classic'    		=> esc_html__( 'Classic', 'sala' ),
				'minimal'    		=> esc_html__( 'Minimal', 'sala' ),
				'modern'   			=> esc_html__( 'Modern', 'sala' ),
			],
			'default' => 'classic',
		] );

		$this->add_control( 'hover_effect', [
			'label'        => esc_html__( 'Hover Effect', 'sala' ),
			'type'         => Controls_Manager::SELECT,
			'options'      => [
				''         => esc_html__( 'None', 'sala' ),
				'zoom-in'  => esc_html__( 'Zoom In', 'sala' ),
				'zoom-out' => esc_html__( 'Zoom Out', 'sala' ),
			],
			'default'      => '',
			'prefix_class' => 'sala-animation-',
		] );

		$this->add_control( 'show_thumbnail', [
			'label'        => esc_html__( 'Show Thumbnail', 'sala' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => '1',
			'return_value' => '1',
			'separator'    => 'before',
		] );

		$this->add_control( 'thumbnail_default_size', [
			'label'        => esc_html__( 'Use Default Thumbnail Size', 'sala' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => '1',
			'return_value' => '1',
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'      => 'thumbnail',
			'default'   => 'full',
			'condition' => [
				'thumbnail_default_size!' => '1',
			],
		] );

		$this->add_meta_controls();

		$this->end_controls_section();
	}

	private function add_meta_controls() {

		$this->add_control( 'show_meta_category', [
			'label'     => esc_html__( 'Show Category', 'sala' ),
			'type'      => Controls_Manager::SWITCHER,
			'label_off' => esc_html__( 'Show', 'sala' ),
			'label_on'  => esc_html__( 'Hide', 'sala' ),
			'default'   => 'yes',
		] );

	}

	private function add_grid_section() {
		$this->start_controls_section( 'grid_options_section', [
			'label'     => esc_html__( 'Grid Options', 'sala' ),
			'condition' => [
				'layout!' => [
					'list',
					'default',
				],
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
		] );

		$this->add_responsive_control( 'grid_gutter', [
			'label'   => esc_html__( 'Gutter', 'sala' ),
			'type'    => Controls_Manager::NUMBER,
			'min'     => 0,
			'max'     => 200,
			'step'    => 1,
			'default' => 30,
		] );

		$this->add_responsive_control( 'row_gap', [
			'label'   => esc_html__( 'Gap', 'sala' ),
			'type'    => Controls_Manager::NUMBER,
			'min'     => 0,
			'max'     => 200,
			'step'    => 1,
			'default' => 60,
		] );

		$this->end_controls_section();
	}

	private function add_thumbnail_style_section() {
		$this->start_controls_section( 'thumbnail_style_section', [
			'label' => esc_html__( 'Thumbnail', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'thumbnail_border_radius', [
			'label'     => esc_html__( 'Border Radius', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 200,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .portfolio-thumbnail' => 'border-radius: {{SIZE}}{{UNIT}}',
			],
		] );

		$this->start_controls_tabs( 'thumbnail_effects_tabs' );

		$this->start_controls_tab( 'thumbnail_effects_normal_tab', [
			'label' => esc_html__( 'Normal', 'sala' ),
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'thumbnail_box_shadow',
			'selector' => '{{WRAPPER}} .portfolio-thumbnail',
		] );

		$this->add_group_control( Group_Control_Css_Filter::get_type(), [
			'name'     => 'css_filters',
			'selector' => '{{WRAPPER}} .portfolio-thumbnail img',
		] );

		$this->add_control( 'thumbnail_opacity', [
			'label'     => esc_html__( 'Opacity', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max'  => 1,
					'min'  => 0.10,
					'step' => 0.01,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .portfolio-thumbnail img' => 'opacity: {{SIZE}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'thumbnail_effects_hover_tab', [
			'label' => esc_html__( 'Hover', 'sala' ),
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'thumbnail_box_shadow_hover',
			'selector' => '{{WRAPPER}} .sala-box:hover .portfolio-thumbnail',
		] );

		$this->add_group_control( Group_Control_Css_Filter::get_type(), [
			'name'     => 'css_filters_hover',
			'selector' => '{{WRAPPER}} .sala-box:hover .portfolio-thumbnail img',
		] );

		$this->add_control( 'thumbnail_opacity_hover', [
			'label'     => esc_html__( 'Opacity', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max'  => 1,
					'min'  => 0.10,
					'step' => 0.01,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .sala-box:hover .portfolio-thumbnail img' => 'opacity: {{SIZE}};',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->query_posts();
		/**
		 * @var $query \WP_Query
		 */
		$query     = $this->get_query();
		$post_type = $this->get_post_type();

		$this->add_render_attribute( 'wrapper', 'class', [
			'sala-grid-wrapper sala-portfolio-wrapper',
		] );

		if( $settings['layout'] == 'metro' ){
			$this->add_render_attribute( 'content-wrapper', 'class', 'sala-grid sala-portfolio sala-portfolio-' . $settings['layout'] . ' sala-' . $settings['type'] );
		} elseif( $settings['layout'] == 'mosaic' ){
			$this->add_render_attribute( 'content-wrapper', 'class', 'sala-grid sala-portfolio sala-portfolio-' . $settings['layout'] . ' sala-' . $settings['type'] );
		} else {
			$this->add_render_attribute( 'content-wrapper', 'class', 'sala-grid sala-portfolio sala-portfolio-' . $settings['layout'] . ' sala-' . $settings['type'] );
		}

		$grid_options = $this->get_grid_options( $settings );


		$this->add_render_attribute( 'content-wrapper', 'data-grid', wp_json_encode( $grid_options ) );

		if ( 'current_query' === $settings['query_source'] ) {
			$this->add_render_attribute( 'wrapper', 'data-query-main', '1' );
		}

		if ( ! empty( $settings['pagination_type'] ) && $query->found_posts > $settings['query_number'] ) {
			$this->add_render_attribute( 'wrapper', 'data-pagination', $settings['pagination_type'] );
		}

		if ( ! empty( $settings['pagination_custom_button_id'] ) ) {
			$this->add_render_attribute( 'wrapper', 'data-pagination-custom-button-id', $settings['pagination_custom_button_id'] );
		}
		?>

		<div <?php $this->print_attributes_string( 'wrapper' ); ?>>
			<?php if ( $query->have_posts() ) : ?>
				<?php
				$sala_grid_query['source']        = $settings['query_source'];
				$sala_grid_query['action']        = "{$post_type}_infinite_load";
				$sala_grid_query['max_num_pages'] = $query->max_num_pages;
				$sala_grid_query['found_posts']   = $query->found_posts;
				$sala_grid_query['count']         = $query->post_count;
				$sala_grid_query['query_vars']    = $this->get_query_args();
				$sala_grid_query['settings']      = $settings;
				$sala_grid_query['widget_query']  = true;
				$sala_grid_query                  = htmlspecialchars( wp_json_encode( $sala_grid_query ) );
				?>
				<input type="hidden" class="sala-query-input" <?php echo 'value="' . $sala_grid_query . '"'; ?>/>

				<?php $this->print_filter( $query->found_posts ); ?>

				<div <?php $this->print_attributes_string( 'content-wrapper' ); ?>>
					<div class="grid-sizer"></div>
					<?php
					set_query_var( 'sala_query', $query );
					set_query_var( 'settings', $settings );
					get_template_part( 'templates/loop/widgets/portfolio/content', $settings['layout'] );
					?>
				</div>

				<?php $this->print_pagination( $query, $settings ); ?>

				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
		</div>
		<?php
	}
}
