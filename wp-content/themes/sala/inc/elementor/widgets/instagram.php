<?php

namespace Sala_Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || exit;

class Widget_Instagram extends Base {

	public function get_name() {
		return 'sala-instagram';
	}

	public function get_title() {
		return esc_html__( 'Instagram', 'sala' );
	}

	public function get_icon_part() {
		return 'eicon-instagram-gallery';
	}

	public function get_keywords() {
		return [ 'media', 'instagram' ];
	}

	protected function register_controls() {
		$this->add_content_section();

		$this->add_image_style_section();

		$this->add_overlay_style_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'sala-instagram' );

		$media_array = $this->scrape_instagram( $settings['number_items'] );
		if ( is_wp_error( $media_array ) ) {
			?>
			<div class="sala-instagram--error">
				<?php echo '<p>' . $media_array->get_error_message() . '</p>'; ?>
			</div>
			<?php
		} else {
			?>
			<div <?php $this->print_attributes_string( 'wrapper' ); ?>>
				<div class="sala-grid">
					<?php foreach ( $media_array as $item ) { ?>
						<div class="grid-item sala-box">
							<div class="image sala-image">
								<a href="<?php echo esc_url( $item['permalink'] ); ?>"
									<?php if ( 'yes' === $settings['link_target'] ) : ?>
										target="_blank"
									<?php endif; ?>
                                   rel="nofollow"
								>
									<img src="<?php echo esc_url( $item[ 'image_src' ] ); ?>"
									     alt="<?php esc_attr_e( 'Instagram Image', 'sala' ); ?>"/>
								</a>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
			<?php
		}
	}

	private function add_content_section() {
		$this->start_controls_section( 'content_section', [
			'label' => esc_html__( 'Content', 'sala' ),
		] );

		$this->add_control(
			'access_token',
			[
				'label'       => esc_html__( 'Instagram Access Token', 'sala' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'description' => wp_kses_post( __( '(<a href="https://www.youtube.com/watch?v=X2ndbJAnQKM" target="_blank">Lookup your Access Token</a>)', 'sala' ) ),
			]
		);

		$this->add_control( 'number_items', [
			'label'   => esc_html__( 'Number Items', 'sala' ),
			'type'    => Controls_Manager::NUMBER,
			'min'     => 1,
			'max'     => 12,
			'step'    => 1,
			'default' => 6,
		] );

		$this->add_responsive_control( 'columns', [
			'label'          => esc_html__( 'Columns', 'sala' ),
			'type'           => Controls_Manager::NUMBER,
			'min'            => 1,
			'max'            => 12,
			'step'           => 1,
			'default'        => 6,
			'tablet_default' => 3,
			'mobile_default' => 2,
			'selectors'      => [
				'{{WRAPPER}} .sala-grid' => 'grid-template-columns: repeat( {{VALUE}}, 1fr);',
			],
		] );

		$this->add_responsive_control( 'column_gutter', [
			'label'     => esc_html__( 'Column Gutter', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min'  => 0,
					'max'  => 200,
					'step' => 5,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .sala-grid' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'row_gutter', [
			'label'     => esc_html__( 'Row Gutter', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min'  => 0,
					'max'  => 200,
					'step' => 5,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .sala-grid' => 'grid-row-gap: {{SIZE}}{{UNIT}};',
			],
			'separator' => 'after',
		] );

		$this->add_control( 'link_target', [
			'label' => esc_html__( 'Open links in a new tab.', 'sala' ),
			'type'  => Controls_Manager::SWITCHER,
		] );

		$this->end_controls_section();
	}

	private function add_image_style_section() {
		$this->start_controls_section( 'image_style_section', [
			'label' => esc_html__( 'Image', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'image_border_radius', [
			'label'      => esc_html__( 'Border Radius', 'sala' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%' ],
			'range'      => [
				'px' => [
					'min' => 0,
					'max' => 200,
				],
				'%'  => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .sala-image, {{WRAPPER}} .sala-image img' => 'border-radius: {{SIZE}}{{UNIT}}',
			],
		] );

		$this->start_controls_tabs( 'image_effects_tabs' );

		$this->start_controls_tab( 'image_effects_normal_tab', [
			'label' => esc_html__( 'Normal', 'sala' ),
		] );

		$this->add_group_control( Group_Control_Css_Filter::get_type(), [
			'name'     => 'css_filters',
			'selector' => '{{WRAPPER}} .image img',
		] );

		$this->add_control( 'image_opacity', [
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
				'{{WRAPPER}} .image img' => 'opacity: {{SIZE}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'image_effects_hover_tab', [
			'label' => esc_html__( 'Hover', 'sala' ),
		] );

		$this->add_group_control( Group_Control_Css_Filter::get_type(), [
			'name'     => 'css_filters_hover',
			'selector' => '{{WRAPPER}} .grid-item:hover .image img',
		] );

		$this->add_control( 'image_opacity_hover', [
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
				'{{WRAPPER}} .grid-item:hover .image img' => 'opacity: {{SIZE}};',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function add_overlay_style_section() {
		$this->start_controls_section( 'overlay_style_section', [
			'label' => esc_html__( 'Overlay', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'overlay_background',
			'selector' => '{{WRAPPER}} .overlay',
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'overlay_typography',
			'label'    => esc_html__( 'Typography', 'sala' ),
			'selector' => '{{WRAPPER}} .image-meta',
		] );

		$this->end_controls_section();
	}

	/**
	 * Quick-and-dirty Instagram web scrape
	 * based on https://gist.github.com/cosmocatalano/4544576
	 *
	 * @param string $username Instagram username that get on url.
	 * @param int    $slice    Number of images want to get. Max up to 12 images.
	 *
	 * @return array|\WP_Error
	 */
	private function scrape_instagram( $slice ) {

		$token         = ! empty( $settings['access_token'] ) ? $settings['access_token'] : 'IGQVJYV0tsMWtkbXVNNnl0SFB4M3ZAtcHZAjVDhkXzZAWY19kQUhrU0x6RUktTy1NQ3dHRllmYmpoZAzQ4M2NpTWtKdlVhX0lXRXNsVzJnZA2hGVXJnVlh2QjY5NkM3bDE0Y2Y4dUJoZAlZANSGtNbEJLdkVKRwZDZD';
		$response      = wp_remote_get( 'https://graph.instagram.com/me/media?fields=id%2Ccaption%2Cmedia_type%2Cmedia_url%2Ccomment%2Clike%2Cpermalink%2Cusername%2Cthumbnail_url&limit=200&access_token=' . esc_attr( $token ) );
		if ( is_wp_error( $response ) ) {
			echo '<p>' . esc_html__( 'Incorrect user ID specified.', 'sala' ) . '</p>';
			return;
		}
		$response_body = json_decode( $response['body'] );
		if ( empty( $response_body ) ) {
			echo '<p>' . esc_html__( 'Incorrect user ID specified.', 'sala' ) . '</p>';
			return;
		}

		if ( ! isset( $response_body->data ) || ! is_array( $response_body->data ) || count( $response_body->data ) == 0 ) {
			echo '<p>' . esc_html__( 'Incorrect user ID specified.', 'sala' ) . '</p>';
			return;
		}

		foreach ( $response_body->data as $item ) {
			$image = [];
			$image['permalink'] = $item->permalink;
			$image['image_src'] = $item->media_url;
			$image['caption'] =	 isset($item->caption) ? $item->caption : NULL;
			$this->_userName    = $item->username;
			$this->_items[]     = $image;
		}

		$transient_name = "instagram-media-" . sanitize_title_with_dashes( $this->_userName );

		$cached_images = get_transient( $transient_name );

		// If the photos not cached, then get from server.
		if ( false === $cached_images ) {

			$cached_images = array();

			foreach ( $this->_items as $image ) {
				$cached_images[] = array(
					'permalink'   => $image['permalink'],
					'image_src'       => $image['image_src'],
					'caption'      => $image['caption'],
				);
			}

			if ( empty( $cached_images ) ) {
				return new \WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'sala' ) );
			}

			set_transient( $transient_name, $cached_images, apply_filters( 'sala_instagram_cache_time', DAY_IN_SECONDS * 2 ) );
		}

		$photos_array = array_slice( $cached_images, 0, $slice );

		return $photos_array;
	}

	/**
	 * Generate rounded number
	 * Example: 11200 --> 11K
	 *
	 * @param $number
	 *
	 * @return string
	 */
	private function round_number( $number ) {
		if ( $number > 999 && $number <= 999999 ) {
			$result = floor( $number / 1000 ) . ' K';
		} elseif ( $number > 999999 ) {
			$result = floor( $number / 1000000 ) . ' M';
		} else {
			$result = $number;
		}

		return $result;
	}
}
