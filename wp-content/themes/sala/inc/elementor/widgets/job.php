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

class Widget_Job extends Posts_Base {

	public function get_name() {
		return 'sala-job';
	}

	public function get_title() {
		return esc_html__( 'Job', 'sala' );
	}

	public function get_icon_part() {
		return 'eicon-tools';
	}

	public function get_keywords() {
		return [ 'job' ];
	}

	protected function get_post_type() {
		return 'job';
	}

	protected function get_post_category() {
		return 'category';
	}

	public function get_script_depends() {
		return [
			'sala-grid-query',
			'sala-widget-grid-job',
		];
	}

	public function is_reload_preview_required() {
		return false;
	}

	protected function register_controls() {

		$this->add_grid_section();

		$this->add_pagination_section();

		$this->add_button_style_section();

		$this->add_pagination_style_section();

		parent::register_controls();
	}

	private function add_grid_section() {
		$this->start_controls_section( 'grid_options_section', [
			'label'     => esc_html__( 'Grid Options', 'sala' ),
		] );

		$this->add_responsive_control( 'grid_columns', [
			'label'          => esc_html__( 'Columns', 'sala' ),
			'type'           => Controls_Manager::NUMBER,
			'min'            => 1,
			'max'            => 12,
			'step'           => 1,
			'default'        => 1,
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

	private function add_button_style_section() {
		$this->start_controls_section( 'button_style_section', [
			'label' => esc_html__( 'Button', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'button_spacing', [
			'label'     => esc_html__( 'Button Spacing', 'sala' ),
			'type'      => Controls_Manager::NUMBER,
			'min'       => 0,
			'max'       => 200,
			'step'      => 1,
			'default'   => 0,
			'selectors' => [
				'{{WRAPPER}} .job-button' => 'margin-top: {{VALUE}}px;',
			],
		] );


		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$settings['layout'] = 'grid';
		$this->query_posts();
		/**
		 * @var $query \WP_Query
		 */
		$query     = $this->get_query();
		$post_type = $this->get_post_type();

		$this->add_render_attribute( 'wrapper', 'class', [
			'sala-grid-wrapper sala-job-wrapper',
		] );

		$this->add_render_attribute( 'content-wrapper', 'class', 'sala-grid sala-job sala-job-' . $settings['layout'] );

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
					get_template_part( 'templates/loop/widgets/job/content', $settings['layout'] );
					?>
				</div>

				<?php $this->print_pagination( $query, $settings ); ?>

				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
		</div>

		<?php
	}
}
