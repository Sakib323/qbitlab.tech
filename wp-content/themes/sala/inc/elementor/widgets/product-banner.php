<?php

namespace Sala_Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Repeater;

defined( 'ABSPATH' ) || exit;

class Widget_Product_Banner extends Base {

	/**
	 * @var \WC_Product $product
	 */
	private $product = null;

	public function get_name() {
		return 'sala-product-banner';
	}

	public function get_title() {
		return esc_html__( 'Product Banner', 'sala' );
	}

	public function get_icon_part() {
		return 'eicon-image-rollover';
	}

	public function get_keywords() {
		return [ 'banner', 'product' ];
	}

	protected function register_controls() {
		$this->add_content_section();

		$this->add_box_style_section();

		$this->add_content_style_section();

		$this->add_badge_style_section();
	}

	private function add_content_section() {
		$this->start_controls_section( 'content_section', [
			'label' => esc_html__( 'Content', 'sala' ),
		] );

		$products = array();

		$args	= array(
			'post_type'		=> 'product',
			'posts_per_page'	=> -1,
		);

		// The Query
		$the_query = new \WP_Query( $args );

		// The Loop
		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$products[get_the_ID()]	= get_the_title();
			}

		}
		/* Restore original Post Data */
		wp_reset_postdata();

		$this->add_control( 'product_id', [
			'label'        => esc_html__( 'Product', 'sala' ),
			'type'         => Controls_Manager::SELECT,
			'options'      => $products,
			'default'      => '',
		] );

		$this->add_control( 'style', [
			'label'   => esc_html__( 'Style', 'sala' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'01' => '01',
			],
			'default' => '01',
		] );

		$this->add_control( 'hover_effect', [
			'label'        => esc_html__( 'Hover Effect', 'sala' ),
			'type'         => Controls_Manager::SELECT,
			'options'      => [
				''         => esc_html__( 'None', 'sala' ),
				'zoom-in'  => esc_html__( 'Zoom In', 'sala' ),
				'zoom-out' => esc_html__( 'Zoom Out', 'sala' ),
				'move-up'  => esc_html__( 'Move Up', 'sala' ),
			],
			'default'      => '',
			'prefix_class' => 'sala-animation-',
		] );

		$this->add_control( 'image', [
			'label'   => esc_html__( 'Choose Image', 'sala' ),
			'type'    => Controls_Manager::MEDIA,
			'dynamic' => [
				'active' => true,
			],
			'default' => [
				'url' => Utils::get_placeholder_image_src(),
			],
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'      => 'image',
			// Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
			'default'   => 'full',
			'separator' => 'none',
		] );

		$this->add_control( 'show_category', [
			'label'   => esc_html__( 'Show Category', 'sala' ),
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
		] );

		$this->add_control( 'show_sale_badge', [
			'label' => esc_html__( 'Show Sale Badge', 'sala' ),
			'type'  => Controls_Manager::SWITCHER,
		] );

		$this->add_control( 'show_best_selling_badge', [
			'label' => esc_html__( 'Show Best Selling Badge', 'sala' ),
			'type'  => Controls_Manager::SWITCHER,
		] );

		$this->add_control( 'title_size', [
			'label'   => esc_html__( 'Title HTML Tag', 'sala' ),
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

		$repeater = new Repeater();

		$repeater->add_control( 'text', [
			'label'       => esc_html__( 'Text', 'sala' ),
			'type'        => Controls_Manager::TEXTAREA,
			'default'     => esc_html__( 'Text', 'sala' ),
			'label_block' => true,
		] );

		$repeater->add_control( 'icon', [
			'label' => esc_html__( 'Icon', 'sala' ),
			'type'  => Controls_Manager::ICONS,
		] );

		$this->add_control( 'items', [
			'label'       => esc_html__( 'Items', 'sala' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
				[
					'text' => esc_html__( 'List Item #1', 'sala' ),
				],
				[
					'text' => esc_html__( 'List Item #2', 'sala' ),
				],
			],
			'title_field' => '{{{ elementor.helpers.renderIcon( this, icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}} {{{ text }}}',
		] );

		$this->end_controls_section();
	}

	private function add_box_style_section() {
		$this->start_controls_section( 'box_style_section', [
			'label' => esc_html__( 'Box', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'box_padding', [
			'label'      => esc_html__( 'Padding', 'sala' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .sala-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'text_align', [
			'label'     => esc_html__( 'Alignment', 'sala' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => Widget_Utils::get_control_options_text_align_full(),
			'selectors' => [
				'{{WRAPPER}} .sala-box' => 'text-align: {{VALUE}};',
			],
		] );

		$this->end_controls_section();
	}

	private function add_content_style_section() {
		$this->start_controls_section( 'content_style_section', [
			'label' => esc_html__( 'Content', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

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
				'{{WRAPPER}} .content-inner' => 'max-width: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_control( 'image_title', [
			'label' => esc_html__( 'Image', 'sala' ),
			'type'  => Controls_Manager::HEADING,
		] );

		$this->add_control( 'category_style_heading', [
			'label'     => esc_html__( 'Category', 'sala' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'category_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .banner-product-category' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'category_typography',
			'selector' => '{{WRAPPER}} .banner-product-category',
		] );

		$this->add_control( 'title_style_heading', [
			'label'     => esc_html__( 'Title', 'sala' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'title_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .banner-product-title' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'selector' => '{{WRAPPER}} .banner-product-title',
		] );

		$this->add_control( 'price_style_heading', [
			'label'     => esc_html__( 'Price', 'sala' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_responsive_control( 'price_margin', [
			'label'      => esc_html__( 'Margin', 'sala' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .banner-product-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'button_style_heading', [
			'label'     => esc_html__( 'Button', 'sala' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_responsive_control( 'button_margin', [
			'label'      => esc_html__( 'Margin', 'sala' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .product-banner-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();
	}

	private function add_badge_style_section() {
		$this->start_controls_section( 'badge_style_section', [
			'label' => esc_html__( 'Badge', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'badge_size', [
			'label'     => esc_html__( 'Size', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 50,
					'max' => 150,
				],
			],
			'default'   => [
				'unit' => 'px',
				'size' => '',
			],
			'selectors' => [
				'{{WRAPPER}} .product-banner-badge' => 'width: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_control( 'badge_background_color', [
			'label'     => esc_html__( 'Background Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .product-banner-badge' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'badge_value_style_heading', [
			'label'     => esc_html__( 'Value', 'sala' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'badge_value_color', [
			'label'     => esc_html__( 'Value Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .product-banner-badge .badge-value' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'badge_value_typography',
			'selector' => '{{WRAPPER}} .product-banner-badge .badge-value',
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$product_id = $settings['product_id'];

		if ( empty( $product_id ) && ! function_exists( 'wc_get_product' ) ) {
			return;
		}

		$this->product = wc_get_product( $product_id );

		$image_size     = '580x580';
		$attach_id      = get_post_thumbnail_id( $product_id );
		$thumb_url      = \Sala_Helper::sala_image_resize($attach_id, $image_size);

		//Thumnail default woocommerce
		$thumbnail = wp_get_attachment_image_src($attach_id,'woocommerce_thumbnail');
		$thumbnail_cropped = get_query_var('thumbnail_cropped');
		if( empty($image_size) ){
			if( isset($thumbnail[0]) ){
				if( $thumbnail_cropped == '' || $thumbnail_cropped == 'cropped' ){
					$thumb_url = $thumbnail[0];
					if( isset($thumbnail_hover[0]) ) {
						$thumb_hover_url = $thumbnail_hover[0];
					}
				}
			}
		}

		$product = get_product($product_id);

		$box_tag = 'div';
		$this->add_render_attribute( 'wrapper', 'class', 'sala-product-banner sala-box link-secret style-' . $settings['style'] );
		?>
		<?php printf( '<%1$s %2$s>', $box_tag, $this->get_render_attribute_string( 'wrapper' ) ); ?>

		<?php if ( ! empty( $settings['image']['url'] ) ) : ?>
			<div class="sala-image image">
				<?php echo \Sala_Image::get_elementor_attachment( [
					'settings' => $settings,
				] ); ?>
			</div>
		<?php elseif(!empty($attach_id)) : ?>
			<div class="sala-image image">
				<img class="featured-thumbnail" src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_html(get_the_title($product_id)); ?>">
			</div>
		<?php endif; ?>

		<div class="product-content-wrap">
			<div class="product-content-inner">

				<?php if ( ! empty( $settings['show_sale_badge'] ) && 'yes' === $settings['show_sale_badge'] && $this->product->is_on_sale() ) : ?>
					<div class="product-banner-badge on-sale-badge">
						<?php $this->print_sale_badge(); ?>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $settings['show_best_selling_badge'] ) && 'yes' === $settings['show_best_selling_badge'] ) : ?>
					<div class="product-banner-badge best-selling-badge">
						<span class="badge-value"><?php esc_html_e( 'Best', 'sala' ); ?></span><span
							class="badge-text"><?php esc_html_e( 'Selling', 'sala' ); ?></span>
					</div>
				<?php endif; ?>

				<div class="product-banner-content">
					<div class="content-inner">
						<?php if ( ! empty( $settings['show_category'] ) && 'yes' === $settings['show_category'] ) : ?>
							<?php
							$cats = $this->product->get_category_ids();
							if ( ! empty( $cats ) ) {
								$first_cat = $cats[0];
								$cat       = get_term_by( 'id', $first_cat, 'product_cat' );

								if ( $cat instanceof \WP_Term ) {
									echo '<div class="banner-product-category">' . $cat->name . '</div>';
								}
							}
							?>
						<?php endif; ?>
						<?php
						$this->add_render_attribute( 'title', 'class', 'banner-product-title' );

						printf( '<%1$s %2$s>%3$s</%1$s>', $settings['title_size'], $this->get_render_attribute_string( 'title' ), $this->product->get_title() );
						?>

						<?php
							$price_align = '';
							if( $settings['text_align'] == 'left' ){
								$price_align = 'left';
							} elseif( $settings['text_align'] == 'center' ){
								$price_align = 'center';
							} elseif( $settings['text_align'] == 'right' ){
								$price_align = 'right';
							}
						?>

						<div class="banner-product-price <?php echo $price_align; ?>">
							<?php echo $this->product->get_price_html(); ?>
						</div>

						<div class="banner-product-desc">
							<?php echo $this->product->get_description(); ?>
						</div>

						<?php \Sala_Templates::render_button( [
							'text'          => esc_html__( 'Buy now', 'sala' ),
							'size'          => 'm',
							'style'			=> 'full-filled',
							'wrapper_class' => 'product-banner-button',
							'link'          => [
								'url'         => wc_get_cart_url() . $product->add_to_cart_url(),
								'is_external' => false,
								'nofollow'    => false,
							],
						] ) ?>

						<div class="banner-product-featured">

							<?php if ( $settings['items'] && count( $settings['items'] ) > 0 ) {
								foreach ( $settings['items'] as $key => $item ) {
									$item_key = 'item_' . $item['_id'];
									$this->add_render_attribute( $item_key, 'class', 'item' );

									$link_tag = 'div';

									$item_link_key = 'item_link_' . $item['_id'];

									$this->add_render_attribute( $item_link_key, 'class', 'link' );

									if ( ! empty( $item['link']['url'] ) ) {
										$link_tag = 'a';
										$this->add_link_attributes( $item_link_key, $item['link'] );
									}
									?>
									<div <?php $this->print_attributes_string( $item_key ); ?>>

										<?php if ( ! empty( $item['icon']['value'] ) ) { ?>
											<div class="sala-icon icon">
												<?php $this->render_icon( $settings, $item['icon'], [ 'aria-hidden' => 'true' ], false, 'icon' ); ?>
											</div>
										<?php } else { ?>
											<?php echo '' . $global_icon_html; ?>
										<?php } ?>

										<div class="text-wrap">
											<?php if ( isset( $item['text'] ) ) { ?>
												<div class="text">
													<?php echo wp_kses_post( $item['text'] ); ?>
												</div>
											<?php } ?>
										</div>

									</div>
									<?php
								}
							}
							?>

						</div>

					</div>
				</div>

			</div>
		</div>
		<?php printf( '</%1$s>', $box_tag ); ?>
		<?php
	}

	protected function print_sale_badge() {
		$product = $this->product;

		if ( $product->is_type( 'simple' ) || $product->is_type( 'external' ) ) {
			$_regular_price = $product->get_regular_price();
			$_sale_price    = $product->get_sale_price();

			$percentage = round( ( ( $_regular_price - $_sale_price ) / $_regular_price ) * 100 );

			echo '<span class="badge-value">' . "-{$percentage}%" . '</span>';
		} else {
			echo esc_html__( 'Sale !', 'sala' );
		}
	}
}
