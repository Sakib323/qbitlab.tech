<?php

namespace Sala_Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || exit;

abstract class Posts_Base extends Base {

	/**
	 * @var \WP_Query
	 */
	private $_query      = null;
	private $_query_args = null;

	abstract protected function get_post_type();

	abstract protected function get_post_category();

	public function query_posts() {
		$settings          = $this->get_settings_for_display();
		$post_type         = $this->get_post_type();
		$this->_query      = Module_Query_Base::instance()->get_query( $settings, $post_type );
		$this->_query_args = Module_Query_Base::instance()->get_query_args();
	}

	protected function get_query() {
		return $this->_query;
	}

	protected function get_query_args() {
		return $this->_query_args;
	}

	protected function register_controls() {
		$this->register_query_section();
	}

	protected function get_query_author_object() {
		return;
	}

	protected function get_query_orderby_options() {
		$options = [
			'date'           => esc_html__( 'Date', 'sala' ),
			'ID'             => esc_html__( 'Post ID', 'sala' ),
			'author'         => esc_html__( 'Author', 'sala' ),
			'title'          => esc_html__( 'Title', 'sala' ),
			'modified'       => esc_html__( 'Last modified date', 'sala' ),
			'parent'         => esc_html__( 'Post/page parent ID', 'sala' ),
			'comment_count'  => esc_html__( 'Number of comments', 'sala' ),
			'menu_order'     => esc_html__( 'Menu order/Page Order', 'sala' ),
			'meta_value'     => esc_html__( 'Meta value', 'sala' ),
			'meta_value_num' => esc_html__( 'Meta value number', 'sala' ),
			'rand'           => esc_html__( 'Random order', 'sala' ),
		];

		$post_type = $this->get_post_type();

		if ( 'product' === $post_type ) {
			$options = array_merge( $options, [
				'woo_featured'     => esc_html__( 'Featured Products', 'sala' ),
				'woo_best_selling' => esc_html__( 'Best Selling Products', 'sala' ),
				'woo_on_sale'      => esc_html__( 'On Sale Products', 'sala' ),
				'woo_top_rated'    => esc_html__( 'Top Rated Products', 'sala' ),
			] );
		}

		return $options;
	}

	protected function register_query_section() {
		$this->start_controls_section( 'query_section', [
			'label' => esc_html__( 'Query', 'sala' ),
		] );

		$this->add_control( 'query_source', [
			'label'   => esc_html__( 'Source', 'sala' ),
			'type'    => Controls_Manager::SELECT,
			'options' => array(
				'custom_query'  => esc_html__( 'Custom Query', 'sala' ),
				'current_query' => esc_html__( 'Current Query', 'sala' ),
			),
			'default' => 'custom_query',
		] );

		$this->start_controls_tabs( 'query_args_tabs', [
			'condition' => [
				'query_source!' => [ 'current_query' ],
			],
		] );

		$this->start_controls_tab( 'query_include_tab', [
			'label' => esc_html__( 'Include', 'sala' ),
		] );

		$this->add_control( 'query_include', [
			'label'       => esc_html__( 'Include By', 'sala' ),
			'label_block' => true,
			'type'        => Controls_Manager::SELECT2,
			'multiple'    => true,
			'options'     => [
				'terms'   => esc_html__( 'Term', 'sala' ),
				'authors' => esc_html__( 'Author', 'sala' ),
			],
			'condition'   => [
				'query_source!' => [ 'current_query' ],
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'query_exclude_tab', [
			'label' => esc_html__( 'Exclude', 'sala' ),
		] );

		$this->add_control( 'query_exclude', [
			'label'       => esc_html__( 'Exclude By', 'sala' ),
			'label_block' => true,
			'type'        => Controls_Manager::SELECT2,
			'multiple'    => true,
			'options'     => [
				'terms'   => esc_html__( 'Term', 'sala' ),
				'authors' => esc_html__( 'Author', 'sala' ),
			],
			'condition'   => [
				'query_source!' => [ 'current_query' ],
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control( 'show_sticky_post', [
			'label'        => esc_html__( 'Show Sticky Post', 'sala' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => '0',
		] );

		$this->add_control( 'query_number', [
			'label'       => esc_html__( 'Items per page', 'sala' ),
			'description' => esc_html__( 'Number of items to show per page. Input "-1" to show all posts. Leave blank to use global setting.', 'sala' ),
			'type'        => Controls_Manager::NUMBER,
			'min'         => -1,
			'max'         => 100,
			'step'        => 1,
			'condition'   => [
				'query_source!' => [ 'current_query' ],
			],
			'separator'   => 'before',
		] );

		$this->add_control( 'query_orderby', [
			'label'       => esc_html__( 'Order by', 'sala' ),
			'description' => esc_html__( 'Select order type. If "Meta value" or "Meta value Number" is chosen then meta key is required.', 'sala' ),
			'type'        => Controls_Manager::SELECT,
			'options'     => $this->get_query_orderby_options(),
			'default'     => 'date',
			'condition'   => [
				'query_source!' => [ 'current_query' ],
			],
		] );

		$this->add_control( 'query_sort_meta_key', [
			'label'     => esc_html__( 'Meta key', 'sala' ),
			'type'      => Controls_Manager::TEXT,
			'condition' => [
				'query_orderby' => [
					'meta_value',
					'meta_value_num',
				],
				'query_source!' => [ 'current_query' ],
			],
		] );

		$this->add_control( 'query_order', [
			'label'     => esc_html__( 'Sort order', 'sala' ),
			'type'      => Controls_Manager::SELECT,
			'options'   => array(
				'DESC' => esc_html__( 'Descending', 'sala' ),
				'ASC'  => esc_html__( 'Ascending', 'sala' ),
			),
			'default'   => 'DESC',
			'condition' => [
				'query_source!' => [ 'current_query' ],
			],
		] );

		$this->end_controls_section();
	}

	protected function add_pagination_section() {
		$this->start_controls_section( 'pagination_section', [
			'label' => esc_html__( 'Pagination', 'sala' ),
		] );

		$this->add_control( 'pagination_type', [
			'label'   => esc_html__( 'Pagination', 'sala' ),
			'type'    => Controls_Manager::SELECT,
			'options' => array(
				''           => esc_html__( 'None', 'sala' ),
				'navigation' => esc_html__( 'Navigation', 'sala' ),
				'loadmore'   => esc_html__( 'Button', 'sala' ),
				'infinite'   => esc_html__( 'Infinite Scroll', 'sala' ),
			),
			'default' => '',
		] );

		$this->end_controls_section();
	}

	protected function add_pagination_style_section() {
		$this->start_controls_section( 'pagination_style_section', [
			'label'     => esc_html__( 'Pagination', 'sala' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'pagination_type!' => '',
			],
		] );

		$this->add_responsive_control( 'pagination_alignment', [
			'label'     => esc_html__( 'Alignment', 'sala' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'flex-start' => [
					'title' => esc_html__( 'Left', 'sala' ),
					'icon'  => 'eicon-h-align-left',
				],
				'center' => [
					'title' => esc_html__( 'Center', 'sala' ),
					'icon'  => 'eicon-h-align-center',
				],
				'flex-end' => [
					'title' => esc_html__( 'Right', 'sala' ),
					'icon'  => 'eicon-h-align-right',
				],
			],
			'default'   => 'center',
			'selectors' => [
				'{{WRAPPER}} .sala-pagination' => 'justify-content: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'pagination_spacing', [
			'label'       => esc_html__( 'Spacing', 'sala' ),
			'type'        => Controls_Manager::SLIDER,
			'placeholder' => '70',
			'range'       => [
				'px' => [
					'min' => 0,
					'max' => 200,
				],
			],
			'selectors'   => [
				'{{WRAPPER}} .sala-pagination' => 'padding-top: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'      => 'pagination_typography',
			'selector'  => '{{WRAPPER}} .nav-link',
			'condition' => [
				'pagination_type' => 'navigation',
			],
		] );

		$this->start_controls_tabs( 'pagination_style_tabs' );

		$this->start_controls_tab( 'pagination_style_normal_tab', [
			'label' => esc_html__( 'Normal', 'sala' ),
		] );

		$this->add_control( 'pagination_link_color', [
			'label'     => esc_html__( 'Link Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .navigation-buttons' => 'color: {{VALUE}};',
				'{{WRAPPER}} .page-pagination'    => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'pagination_style_hover_tab', [
			'label' => esc_html__( 'Hover', 'sala' ),
		] );

		$this->add_control( 'pagination_link_hover_color', [
			'label'     => esc_html__( 'Link Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .nav-link:hover'           => 'color: {{VALUE}};',
				'{{WRAPPER}} .page-pagination .current' => 'color: {{VALUE}};',
				'{{WRAPPER}} .page-pagination a:hover'  => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control( 'pagination_loading_heading', [
			'label'     => esc_html__( 'Loading Icon', 'sala' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'pagination_loading_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .sala-infinite-loader .sk-wrap' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_section();
	}

	protected function add_filter_section() {
		$this->start_controls_section( 'filter_section', [
			'label' => esc_html__( 'Filter', 'sala' ),
		] );

		$this->add_control( 'filter_enable', [
			'label' => esc_html__( 'Show Filter', 'sala' ),
			'type'  => Controls_Manager::SWITCHER,
		] );

		$post_type = $this->get_post_type();

		if( get_theme_mod('sala_portfolio', 0) && $post_type == 'portfolio' ){
			$terms = get_terms( array(
				'taxonomy' => 'portfolio_category',
			) );
		} else {
			$terms = get_categories();
		}


		if( $terms ){
			$list_cate_post = array(
				'' => esc_html__( 'Select option', 'sala' ),
			);
			foreach($terms as $term) {
				$list_cate_post[$term->term_id] = $term->name;
			}

			$this->add_control( 'list_cate_show', [
				'label'   	=> esc_html__( 'Choose Category Show', 'sala' ),
				'type'    	=> Controls_Manager::SELECT2,
				'multiple'	=> true,
				'options' 	=> $list_cate_post,
				'default' 	=> '',
			] );
		}

		$this->add_control( 'filter_style', [
			'label'   => esc_html__( 'Style', 'sala' ),
			'type'    => Controls_Manager::SELECT,
			'options' => array(
				'01' => '01',
			),
			'default' => '01',
		] );

		$this->add_control( 'filter_counter', [
			'label'        => esc_html__( 'Show Counter', 'sala' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => '1',
			'condition'    => [
				'filter_style!' => '',
			],
		] );

		if( $post_type == 'post' ){

			$this->add_control( 'filter_counter_post', [
				'label'        => esc_html__( 'Show Counter Post', 'sala' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => '1',
			] );

			$this->add_control( 'filter_sort_by_category', [
				'label'        => esc_html__( 'Show Sort By Category', 'sala' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => '1',
			] );

			$this->add_control( 'filter_sort_by_tag', [
				'label'        => esc_html__( 'Show Sort By Tag', 'sala' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => '1',
			] );

		}

		$this->add_control( 'filter_in_grid', [
			'label'        => esc_html__( 'In Grid', 'sala' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => '1',
			'condition'    => [
				'filter_style!' => '',
			],
		] );

		$this->end_controls_section();
	}

	protected function add_filter_style_section() {
		$this->start_controls_section( 'filter_style_section', [
			'label'     => esc_html__( 'Filter', 'sala' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'filter_enable' => 'yes',
			],
		] );

		$this->add_responsive_control( 'filter_spacing', [
			'label'      => esc_html__( 'Spacing', 'sala' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'min'  => 0,
					'max'  => 200,
					'step' => 1,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .sala-grid-filter' => 'padding-bottom: {{SIZE}}{{UNIT}}',
			],
		] );

		$this->add_responsive_control( 'filter_alignment', [
			'label'     => esc_html__( 'Alignment', 'sala' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => Widget_Utils::get_control_options_horizontal_alignment(),
			'default'   => 'center',
			'selectors' => [
				'{{WRAPPER}} .sala-grid-filter' => 'text-align: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'filter_link_typography',
			'label'    => esc_html__( 'Link Typography', 'sala' ),
			'selector' => '{{WRAPPER}} .btn-filter .filter-text',
		] );

		$this->start_controls_tabs( 'filter_link_tabs' );

		$this->start_controls_tab( 'filter_link_normal', [
			'label' => esc_html__( 'Normal', 'sala' ),
		] );

		$this->add_control( 'filter_link_color', [
			'label'     => esc_html__( 'Link Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .btn-filter' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'filter_link_hover', [
			'label' => esc_html__( 'Hover', 'sala' ),
		] );

		$this->add_control( 'filter_link_hover_color', [
			'label'     => esc_html__( 'Link Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .btn-filter.current, {{WRAPPER}} .btn-filter:hover' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control( 'filter_counter_style_heading', [
			'label'     => esc_html__( 'Filter Counter', 'sala' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
			'condition' => [
				'filter_counter' => '1',
			],
		] );

		$this->add_control( 'filter_counter_text_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .btn-filter .filter-counter' => 'color: {{VALUE}};',
			],
			'condition' => [
				'filter_counter' => '1',
			],
		] );

		$this->add_control( 'filter_counter_background_color', [
			'label'     => esc_html__( 'Background', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .btn-filter .filter-counter'        => 'background: {{VALUE}};',
				'{{WRAPPER}} .btn-filter .filter-counter:before' => 'border-top-color: {{VALUE}};',
			],
			'condition' => [
				'filter_counter' => '1',
			],
		] );

		$this->end_controls_section();
	}

	protected function add_sorting_section() {
		$this->start_controls_section( 'result_count_sorting_section', [
			'label' => esc_html__( 'Result Count & Sorting', 'sala' ),
		] );

		$this->add_control( 'show_result_count', [
			'label'        => esc_html__( 'Show Result Count', 'sala' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => '1',
		] );

		$this->add_control( 'show_ordering', [
			'label'        => esc_html__( 'Show Order', 'sala' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => '1',
		] );

		$this->end_controls_section();
	}

	protected function get_sort_options() {
		return [
			''           => esc_html__( 'Default', 'sala' ),
			'popularity' => esc_html__( 'Popularity', 'sala' ),
			'date'       => esc_html__( 'Latest', 'sala' ),
			'price'      => esc_html__( 'Price: low to high', 'sala' ),
			'price-desc' => esc_html__( 'Price: high to low', 'sala' ),
		];
	}

	/**
	 * Check if layout is grid|masonry
	 *
	 * @return bool
	 */
	protected function is_grid() {
		$settings = $this->get_settings_for_display();
		if ( ! empty( $settings['layout'] ) &&
		     in_array( $settings['layout'], array(
			     'grid',
			     'masonry',
				 'boxed',
				 'background',
		     ), true ) ) {
			return true;
		}

		return false;
	}

	protected function get_grid_options( array $settings ) {
		if( $settings['layout'] == 'boxed' || $settings['layout'] == 'background' ){
			$grid = 'masonry';
		} else {
			$grid = $settings['layout'];
		}

		$post_type = $this->get_post_type();
		if( $post_type == 'portfolio' ){
			$grid = $settings['layout'];
		}

		$grid_options = [
			'type'  => $grid,
		];

		// Columns.
		if ( ! empty( $settings['grid_columns'] ) ) {
			$grid_options['columns'] = $settings['grid_columns'];
		}

		if ( ! empty( $settings['grid_columns_tablet'] ) ) {
			$grid_options['columnsTablet'] = $settings['grid_columns_tablet'];
		} else {
			$grid_options['columnsTablet'] = '2';
		}

		if ( ! empty( $settings['grid_columns_mobile'] ) ) {
			$grid_options['columnsMobile'] = $settings['grid_columns_mobile'];
		} else {
			$grid_options['columnsMobile'] = '1';
		}

		// Gutter
		if ( ! empty( $settings['grid_gutter'] ) ) {
			$grid_options['gutter'] = $settings['grid_gutter'];
		}

		if ( ! empty( $settings['grid_gutter_tablet'] ) ) {
			$grid_options['gutterTablet'] = $settings['grid_gutter_tablet'];
		} else {
			$grid_options['gutterTablet'] = 40;
		}

		if ( ! empty( $settings['grid_gutter_mobile'] ) ) {
			$grid_options['gutterMobile'] = $settings['grid_gutter_mobile'];
		} else {
			$grid_options['gutterMobile'] = 30;
		}

		// Row Gap
		if ( ! empty( $settings['row_gap'] ) ) {
			$grid_options['RowGap'] = $settings['row_gap'];
		}

		if ( ! empty( $settings['row_gap_tablet'] ) ) {
			$grid_options['RowGapTablet'] = $settings['row_gap_tablet'];
		} else {
			$grid_options['RowGapTablet'] = 40;
		}

		if ( ! empty( $settings['row_gap_mobile'] ) ) {
			$grid_options['RowGapMobile'] = $settings['row_gap_mobile'];
		} else {
			$grid_options['RowGapMobile'] = 30;
		}

		return $grid_options;
	}

	protected function print_pagination( $query, $settings ) {
		$number          = ! empty( $settings['query_number'] ) ? $settings['query_number'] : get_option( 'posts_per_page' );
		$pagination_type = $settings['pagination_type'];

		// Set up paginated links.
		$links = paginate_links( array(
			'total'     => $query->max_num_pages,
			'current'   => $query->query['paged'],
			'prev_text' => '<i class="far fa-long-arrow-left"></i>' . esc_html__('Prev', 'sala'),
			'next_text' => esc_html__('Next', 'sala') . '<i class="far fa-long-arrow-right"></i>',
			'type'      => 'list',
			'end_size'  => 1,
			'mid_size'  => 1,
		) );

		$pagination_classes = array('sala-pagination', $pagination_type);
		if ( $pagination_type !== '' && $query->found_posts > $number ) {
			switch ($pagination_type) {
				case 'navigation':
					?>
						<div class="<?php echo join(' ', $pagination_classes); ?>">
							<?php echo wp_kses_post($links); ?>
						</div><!-- .pagination -->
					<?php
					break;

				case 'loadmore':
					?>
						<div class="<?php echo join(' ', $pagination_classes); ?>">
							<a class="sala-loadmore-button sala-button uppercase" href="#">
								<i class="fal fa-redo"></i>
								<?php esc_html_e('Load More', 'sala'); ?>
							</a>
							<div class="sala-loader"><div class="dot-spin"></div></div>
						</div><!-- .pagination -->
						<div class="sala-pagination-messages">
							<?php esc_html_e('End of Content', 'sala'); ?>
						</div>
					<?php
					break;

				case 'infinite':
						?>
							<div class="<?php echo join(' ', $pagination_classes); ?>">
								<div class="sala-loader"><div class="dot-falling"></div></div>
							</div><!-- .pagination -->
							<div class="sala-pagination-messages">
								<?php esc_html_e('End of Content', 'sala'); ?>
							</div>
						<?php
						break;

				default:

					break;
			}
		}
	}

	protected function print_filter( $total = 0, $list = '' ) {
		$settings  = $this->get_settings_for_display();
		$category  = $this->get_post_category();
		$post_type = $this->get_post_type();
		if( get_theme_mod('sala_portfolio', 0) && $post_type == 'portfolio' ){
			$category = 'portfolio_category';
			$this->add_render_attribute( 'filter', 'class', 'sala-portfolio-taxonomy sala-portfolio-elm' );
		} else {
			$this->add_render_attribute( 'filter', 'class', 'sala-blog-categories sala-blog-elm' );
		}

		if ( empty( $settings['filter_enable'] ) || 'yes' !== $settings['filter_enable'] ) {
			return;
		}



		if ( '1' === $settings['filter_counter'] ) {
			$this->add_render_attribute( 'filter', 'class', 'show-filter-counter' );
		}

		if ( '1' === $settings['filter_counter'] ) {
			$this->add_render_attribute( 'filter', 'data-filter-counter', true );
		}

		$current_cat = '';

		$btn_filter_class     = 'btn-filter';
		$btn_filter_all_class = $btn_filter_class;

		if ( '' === $current_cat ) {
			$btn_filter_all_class .= ' current';
		}
		?>
		<div <?php $this->print_render_attribute_string( 'filter' ) ?>>
			<?php ob_start(); ?>
			<ul class="list-categories">
				<li>
					<a href="<?php echo esc_url( get_post_type_archive_link( $post_type ) ); ?>"
					class="<?php echo esc_attr( $btn_filter_all_class ); ?>"
					data-filter="*" data-filter-count="<?php echo esc_attr( $total ); ?>">
						<span class="filter-text"><?php esc_html_e( 'All', 'sala' ); ?></span>
						<span class="filter-count"><?php echo sprintf( esc_html__( '(%s)', 'sala' ), $total ); ?></span>
					</a>
				</li>
				<?php
				if ( $list === '' ) {
					$_categories = get_terms( array(
						'taxonomy'   => $category,
						'hide_empty' => true,
					) );

					foreach ( $_categories as $term ) {
						if( $settings['list_cate_show'] ){
							if( in_array($term->term_id, $settings['list_cate_show']) ){
								$current_filter_class = $btn_filter_class;

								if ( $term->term_id === $current_cat ) {
									$current_filter_class .= ' current';
								}

								$term_link = get_term_link( $term );
								printf( '<li><a href="%s" class="%s" data-filter="%s" data-filter-count="%s"><span class="filter-text">%s</span> <span class="filter-count">(%s)</span></a></li>',
									esc_url( $term_link ),
									esc_attr( $current_filter_class ),
									esc_attr( "{$category}:{$term->slug}" ),
									$term->count,
									$term->name,
									$term->count
								);
							}
						}
					}
				} else {
					$list = explode( ', ', $list );
					foreach ( $list as $item ) {
						$value = explode( ':', $item );

						$term = get_term_by( 'slug', $value[1], $value[0] );

						if ( $term === false ) {
							continue;
						}

						$term_link = get_term_link( $term );

						if( in_array($term->term_id, $settings['list_cate_show']) ){

							printf( '<li><a href="%s" class="btn-filter" data-filter="%s" data-filter-count="%s"><span class="filter-text">%s</span> <span class="filter-count">(%s)</span></a></li>',
								esc_url( $term_link ),
								esc_attr( "{$value[0]}:{$value[1]}" ),
								$term->count,
								$value[1],
								$term->count
							);

						}
					}
				}
				?>
			</ul>
			<?php
			$output = ob_get_clean();

			if ( '1' === $settings['filter_in_grid'] ) {
				printf( '<div class="container"><div class="row"><div class="col-md-12">%1$s</div></div></div>', $output );
			} else {
				echo '' . $output;
			}
			?>
		</div>
		<?php
	}

	protected function print_action( $query ) {

		$settings  = $this->get_settings_for_display();

		$current    = max( 1, $query->get( 'paged' ) );
		$per_page 	= $query->get( 'posts_per_page' );
		$total    	= $query->found_posts;
		if ( '1' === $settings['filter_counter_post'] || '1' === $settings['filter_sort_by_category'] || '1' === $settings['filter_sort_by_tag'] ) {
		?>
		<div class="sala-blog-action">
			<?php if ( '1' === $settings['filter_counter_post'] ) { ?>
			<div class="result-count">
			<?php
				if ( 1 === $total ) {
					_e( 'Showing the single result', 'sala' );
				} elseif ( $total <= $per_page || -1 === $per_page ) {
					/* translators: %d: total results */
					printf( _n( 'Showing all %d result', 'Showing all %d results', $total, 'sala' ), $total );
				} else {
					$first = ( $per_page * $current ) - $per_page + 1;
					$last  = min( $total, $per_page * $current );
					/* translators: 1: first result 2: last result 3: total results */
					printf( _nx( 'Showing %1$d&ndash;%2$d of %3$d result', 'Showing %1$d&ndash;%2$d of %3$d results', $total, 'with first and last result', 'sala' ), $first, $last, $total );
				}
			?>
			</div>
			<?php } ?>
			<?php
				if ( '1' === $settings['filter_sort_by_category'] || '1' === $settings['filter_sort_by_tag'] ) {
					$queried_object = get_queried_object();
					if($queried_object){
						$selected = $queried_object->slug;
					} else {
						$selected = '';
					}

					if(get_permalink( get_option( 'page_for_posts' ) )){
						$blog_url = get_permalink( get_option( 'page_for_posts' ) );
					} else {
						$blog_url = home_url();
					}
			?>
			<div class="blog-filter">
				<form action="#" method="GET" class="blog-filter-form sala-filter-form" data-homeurl="<?php echo esc_url(home_url()); ?>" data-url="<?php echo esc_url($blog_url); ?>">
					<?php if( '1' === $settings['filter_sort_by_category'] ) { ?>
					<div class="form-group">
						<?php wp_dropdown_categories( array(
							'taxonomy'		   => 'category',
							'hide_empty'       => 1,
							'name'             => 'category',
							'orderby'          => 'name',
							'selected'         => $selected,
							'hierarchical'     => true,
							'class'            => 'nice-select',
							'value_field'      => 'slug',
							'show_option_none' => esc_html__( 'All Categories', 'sala' )
						) ); ?>
					</div>
					<?php } ?>
					<?php if( '1' === $settings['filter_sort_by_tag'] ) { ?>
					<div class="form-group">
						<?php wp_dropdown_categories( array(
							'taxonomy'		   => 'post_tag',
							'hide_empty'       => 1,
							'name'             => 'tag',
							'orderby'          => 'name',
							'selected'         => $selected,
							'hierarchical'     => true,
							'class'            => 'nice-select',
							'value_field'      => 'slug',
							'show_option_none' => esc_html__( 'Tags', 'sala' )
						) ); ?>
					</div>
					<?php } ?>
				</form>
			</div>
			<?php } ?>
		</div>
		<?php } ?>
		<?php
	}
}
