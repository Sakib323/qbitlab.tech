<?php

namespace Sala_Elementor;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;

defined( 'ABSPATH' ) || exit;

class Widget_Product_Categories extends Base {

	const PRODUCT_CATEGORY = 'product_cat';
	private $terms = [];

	public function get_name() {
		return 'sala-product-categories';
	}

	public function get_title() {
		return esc_html__( 'Product Categories', 'sala' );
	}

	public function get_icon_part() {
		return 'eicon-gallery-grid';
	}

	public function get_keywords() {
		return [ 'product', 'categories' ];
	}

	public function get_script_depends() {
		return [ 'sala-group-widget-grid' ];
	}

	protected function register_controls() {
		$this->add_layout_section();

		$this->add_grid_section();

		$this->add_query_section();

		$this->add_image_style_section();
	}

	private function add_layout_section() {
		$this->start_controls_section( 'layout_section', [
			'label' => esc_html__( 'Layout', 'sala' ),
		] );

		$this->add_control( 'layout', [
			'label'   => esc_html__( 'Layout', 'sala' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'grid'    => esc_html__( 'Grid', 'sala' ),
				'masonry' => esc_html__( 'Masonry', 'sala' ),
				'metro'   => esc_html__( 'Metro', 'sala' ),
			],
			'default' => 'grid',
		] );

		$this->add_responsive_control( 'zigzag_height', [
			'label'     => esc_html__( 'Zigzag Height', 'sala' ),
			'type'      => Controls_Manager::NUMBER,
			'step'      => 1,
			'condition' => [
				'layout' => 'masonry',
			],
		] );

		$this->add_control( 'zigzag_reversed', [
			'label'     => esc_html__( 'Zigzag Reversed?', 'sala' ),
			'type'      => Controls_Manager::SWITCHER,
			'condition' => [
				'layout' => 'masonry',
			],
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

		$this->add_control( 'metro_image_size_width', [
			'label'     => esc_html__( 'Image Size', 'sala' ),
			'type'      => Controls_Manager::NUMBER,
			'step'      => 1,
			'default'   => 480,
			'condition' => [
				'layout' => 'metro',
			],
		] );

		$this->add_control( 'metro_image_ratio', [
			'label'     => esc_html__( 'Image Ratio', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max'  => 2,
					'min'  => 0.10,
					'step' => 0.01,
				],
			],
			'default'   => [
				'size' => 1,
			],
			'condition' => [
				'layout' => 'metro',
			],
		] );

		$this->add_control( 'thumbnail_default_size', [
			'label'        => esc_html__( 'Use Default Thumbnail Size', 'sala' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => '1',
			'return_value' => '1',
			'separator'    => 'before',
			'condition'    => [
				'layout!' => 'metro',
			],
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'      => 'thumbnail',
			'default'   => 'full',
			'condition' => [
				'layout!'                 => 'metro',
				'thumbnail_default_size!' => '1',
			],
		] );

		$this->end_controls_section();
	}

	private function add_grid_section() {
		$this->start_controls_section( 'grid_options_section', [
			'label' => esc_html__( 'Grid Options', 'sala' ),
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

		$metro_layout_repeater = new Repeater();

		$metro_layout_repeater->add_control( 'size', [
			'label'   => esc_html__( 'Item Size', 'sala' ),
			'type'    => Controls_Manager::SELECT,
			'default' => '1:1',
			'options' => Widget_Utils::get_grid_metro_size(),
		] );

		$this->add_control( 'grid_metro_layout', [
			'label'       => esc_html__( 'Metro Layout', 'sala' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $metro_layout_repeater->get_controls(),
			'default'     => [
				[ 'size' => '2:2' ],
				[ 'size' => '1:1' ],
				[ 'size' => '1:1' ],
				[ 'size' => '1:1' ],
				[ 'size' => '2:2' ],
				[ 'size' => '1:1' ],
			],
			'title_field' => '{{{ size }}}',
			'condition'   => [
				'layout' => 'metro',
			],
		] );

		$this->end_controls_section();
	}

	private function add_query_section() {
		$this->start_controls_section( 'query_section', [
			'label' => esc_html__( 'Query', 'sala' ),
		] );

		$this->add_control( 'source', [
			'label'       => esc_html__( 'Source', 'sala' ),
			'type'        => Controls_Manager::SELECT,
			'options'     => [
				''                      => esc_html__( 'Show All', 'sala' ),
				'by_id'                 => esc_html__( 'Manual Selection', 'sala' ),
				'by_parent'             => esc_html__( 'By Parent', 'sala' ),
				'current_subcategories' => esc_html__( 'Current Subcategories', 'sala' ),
			],
			'label_block' => true,
		] );

		$categories = get_terms( [
			'taxonomy'   => self::PRODUCT_CATEGORY,
			'hide_empty' => false,
		] );

		$options = [];
		foreach ( $categories as $category ) {
			$options[ $category->term_id ] = $category->name;
		}

		$this->add_control( 'categories', [
			'label'       => esc_html__( 'Categories', 'sala' ),
			'type'        => Controls_Manager::SELECT2,
			'options'     => $options,
			'default'     => [],
			'label_block' => true,
			'multiple'    => true,
			'condition'   => [
				'source' => 'by_id',
			],
		] );

		$parent_options = [ '0' => esc_html__( 'Only Top Level', 'sala' ) ] + $options;
		$this->add_control(
			'parent', [
			'label'     => esc_html__( 'Parent', 'sala' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => '0',
			'options'   => $parent_options,
			'condition' => [
				'source' => 'by_parent',
			],
		] );

		$this->add_control( 'hide_empty', [
			'label'     => esc_html__( 'Hide Empty', 'sala' ),
			'type'      => Controls_Manager::SWITCHER,
			'default'   => 'yes',
			'label_on'  => 'Hide',
			'label_off' => 'Show',
		] );

		$this->add_control( 'number', [
			'label'     => esc_html__( 'Categories Count', 'sala' ),
			'type'      => Controls_Manager::NUMBER,
			'default'   => '4',
			'condition' => [
				'source!' => 'by_id',
			],
		] );

		$this->add_control( 'orderby', [
			'label'     => esc_html__( 'Order By', 'sala' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'name',
			'options'   => [
				'name'        => esc_html__( 'Name', 'sala' ),
				'slug'        => esc_html__( 'Slug', 'sala' ),
				'description' => esc_html__( 'Description', 'sala' ),
				'count'       => esc_html__( 'Count', 'sala' ),
			],
			'condition' => [
				'source!' => 'by_id',
			],
		] );

		$this->add_control( 'order', [
			'label'     => esc_html__( 'Order', 'sala' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'desc',
			'options'   => [
				'asc'  => esc_html__( 'ASC', 'sala' ),
				'desc' => esc_html__( 'DESC', 'sala' ),
			],
			'condition' => [
				'source!' => 'by_id',
			],
		] );

		$this->end_controls_section();
	}

	private function add_image_style_section() {
		$this->start_controls_section( 'images_style_section', [
			'label' => esc_html__( 'Images', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->start_controls_tabs( 'images_effects' );

		$this->start_controls_tab( 'images_effects_normal_tab', [
			'label' => esc_html__( 'Normal', 'sala' ),
		] );

		$this->add_group_control( Group_Control_Css_Filter::get_type(), [
			'name'     => 'css_filters',
			'selector' => '{{WRAPPER}} .image',
		] );

		$this->add_control( 'images_opacity', [
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
				'{{WRAPPER}} .image' => 'opacity: {{SIZE}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'images_effects_hover_tab', [
			'label' => esc_html__( 'Hover', 'sala' ),
		] );

		$this->add_group_control( Group_Control_Css_Filter::get_type(), [
			'name'     => 'css_filters_hover',
			'selector' => '{{WRAPPER}} .grid-item:hover .image',
		] );

		$this->add_control( 'images_opacity_hover', [
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
				'{{WRAPPER}} .grid-item:hover .image' => 'opacity: {{SIZE}};',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function query_terms() {
		$settings = $this->get_settings_for_display();

		$attributes = [
			'taxonomy'   => self::PRODUCT_CATEGORY,
			'number'     => $settings['number'],
			'hide_empty' => ( 'yes' === $settings['hide_empty'] ) ? true : false,
		];

		switch ( $settings['source'] ) {
			case 'by_id':
				$attributes['include'] = $settings['categories'];
				$attributes['orderby'] = 'include';
				break;
			case 'by_parent' :
				$attributes['parent']  = $settings['parent'];
				$attributes['orderby'] = $settings['orderby'];
				$attributes['order']   = $settings['order'];
				break;
			case 'current_subcategories':
				$attributes['parent']  = get_queried_object_id();
				$attributes['orderby'] = $settings['orderby'];
				$attributes['order']   = $settings['order'];
				break;
			default:
				$attributes['orderby'] = $settings['orderby'];
				$attributes['order']   = $settings['order'];
				break;
		}

		$this->terms = get_terms( $attributes );
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->query_terms();

		if ( empty( $this->terms ) ) {
			return;
		}

		$this->add_render_attribute( 'grid-wrapper', 'class', 'sala-grid-wrapper sala-product-categories' );

		$this->add_render_attribute( 'content-wrapper', 'class', 'sala-grid lazy-grid' );

		if ( 'metro' === $settings['layout'] ) {
			$this->add_render_attribute( 'grid-wrapper', 'class', 'sala-grid-metro' );
		}

		$grid_options = $this->get_grid_options( $settings );

		$this->add_render_attribute( 'content-wrapper', 'data-grid', wp_json_encode( $grid_options ) );
		?>
		<div <?php $this->print_attributes_string( 'grid-wrapper' ); ?>>
			<div <?php $this->print_attributes_string( 'content-wrapper' ); ?>>
				<div class="grid-sizer"></div>

				<?php if ( 'metro' === $settings['layout'] ) : ?>
					<?php $this->print_metro_grid(); ?>
				<?php else: ?>
					<?php $this->print_grid(); ?>
				<?php endif; ?>

			</div>
		</div>
		<?php
	}

	protected function get_grid_options( array $settings ) {
		if( $settings['layout'] == 'boxed' || $settings['layout'] == 'background' ){
			$grid = 'masonry';
		} else {
			$grid = $settings['layout'];
		}

		$grid_options = [
			'type'  => $grid,
			'ratio' => $settings['metro_image_ratio']['size'],
		];

		// Columns.
		if ( ! empty( $settings['grid_columns'] ) ) {
			$grid_options['columns'] = $settings['grid_columns'];
		}

		if ( ! empty( $settings['grid_columns_tablet'] ) ) {
			$grid_options['columnsTablet'] = $settings['grid_columns_tablet'];
		}

		if ( ! empty( $settings['grid_columns_mobile'] ) ) {
			$grid_options['columnsMobile'] = $settings['grid_columns_mobile'];
		}

		// Gutter
		if ( ! empty( $settings['grid_gutter'] ) ) {
			$grid_options['gutter'] = $settings['grid_gutter'];
		}

		if ( ! empty( $settings['grid_gutter_tablet'] ) ) {
			$grid_options['gutterTablet'] = $settings['grid_gutter_tablet'];
		}

		if ( ! empty( $settings['grid_gutter_mobile'] ) ) {
			$grid_options['gutterMobile'] = $settings['grid_gutter_mobile'];
		}

		// Zigzag height.
		if ( ! empty( $settings['zigzag_height'] ) ) {
			$grid_options['zigzagHeight'] = $settings['zigzag_height'];
		}

		if ( ! empty( $settings['zigzag_height_tablet'] ) ) {
			$grid_options['zigzagHeightTablet'] = $settings['zigzag_height_tablet'];
		}

		if ( ! empty( $settings['zigzag_height_mobile'] ) ) {
			$grid_options['zigzagHeightMobile'] = $settings['zigzag_height_mobile'];
		}

		if ( ! empty( $settings['zigzag_reversed'] ) && 'yes' === $settings['zigzag_reversed'] ) {
			$grid_options['zigzagReversed'] = 1;
		}

		return $grid_options;
	}

	private function print_grid() {
		$settings   = $this->get_settings_for_display();
		$image_size = \Sala_Image::elementor_parse_image_size( $settings, '300x300' );

		foreach ( $this->terms as $term ) {
			$thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
			$link         = get_term_link( $term );
			?>
			<div class="grid-item">
				<a href="<?php echo esc_url( $link ); ?>" class="product-cat-wrapper sala-box cat-link link-secret">
					<?php $this->print_image( $thumbnail_id, $image_size ); ?>

					<div class="product-cat-info">
						<h5 class="product-cat-name"><?php echo esc_html( $term->name ); ?></h5>
					</div>
				</a>
			</div>
			<?php
		}
	}

	private function print_metro_grid() {
		$settings     = $this->get_settings_for_display();
		$metro_layout = [];

		if ( isset( $settings['grid_metro_layout'] ) ) {
			foreach ( $settings['grid_metro_layout'] as $key => $value ) {
				$metro_layout[] = $value['size'];
			}
		}

		if ( count( $metro_layout ) < 1 ) {
			return;
		}

		$metro_layout_count = count( $metro_layout );
		$metro_item_count   = 0;
		$count              = count( $settings['gallery'] );

		$index = 0;
		foreach ( $this->terms as $term ) {
			$thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
			$link         = get_term_link( $term );
			$index++;
			$item_key = 'image_key_' . $index;

			$size   = $metro_layout[ $metro_item_count ];
			$ratio  = explode( ':', $size );
			$ratioW = $ratio[0];
			$ratioH = $ratio[1];

			$this->add_render_attribute( $item_key, [
				'class'       => 'grid-item grid-item-height',
				'data-width'  => $ratioW,
				'data-height' => $ratioH,
			] );

			$_image_width  = $settings['metro_image_size_width'];
			$_image_height = $_image_width * $settings['metro_image_ratio']['size'];
			if ( in_array( $ratioW, array( '2' ) ) ) {
				$_image_width *= 2;
			}

			if ( in_array( $ratioH, array( '1.3', '2' ) ) ) {
				$_image_height *= 2;
			}

			$_image_size = "{$_image_width}x{$_image_height}";
			?>
			<div <?php $this->print_render_attribute_string( $item_key ); ?>>
				<a href="<?php echo esc_url( $link ); ?>" class="product-cat-wrapper sala-box cat-link link-secret">
					<?php $this->print_image( $thumbnail_id, $_image_size ); ?>

					<div class="product-cat-info">
						<h5 class="product-cat-name"><?php echo esc_html( $term->name ); ?></h5>
					</div>
				</a>
			</div>
			<?php
			$metro_item_count++;
			if ( $metro_item_count == $count || $metro_layout_count == $metro_item_count ) {
				$metro_item_count = 0;
			}
			?>
			<?php
		}
	}

	private function print_image( $thumbnail_id, $image_size ) {
		?>
		<div class="sala-image image">
		<?php if ( ! empty( $thumbnail_id ) ) : ?>
			<?php \Sala_Image::the_attachment_by_id( array(
				'id'   => $thumbnail_id,
				'size' => $image_size,
			) ); ?>
		<?php else: ?>
			<?php echo wc_placeholder_img(); ?>
		<?php endif; ?>
		</div><?php
	}
}
