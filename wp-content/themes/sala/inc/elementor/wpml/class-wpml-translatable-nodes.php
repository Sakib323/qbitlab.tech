<?php

namespace Sala_Elementor;

defined( 'ABSPATH' ) || exit;

class WPML_Translatable_Nodes {

	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function initialize() {
		add_action( 'init', [ $this, 'wp_init' ] );
	}

	public function wp_init() {
		add_filter( 'wpml_elementor_widgets_to_translate', [ $this, 'wpml_widgets_to_translate_filter' ] );
	}

	public function get_translatable_node() {
		require_once SALA_ELEMENTOR_DIR . '/wpml/class-translate-widget-google-map.php';
		require_once SALA_ELEMENTOR_DIR . '/wpml/class-translate-widget-list.php';
		require_once SALA_ELEMENTOR_DIR . '/wpml/class-translate-widget-attribute-list.php';
		require_once SALA_ELEMENTOR_DIR . '/wpml/class-translate-widget-pricing-table.php';
		require_once SALA_ELEMENTOR_DIR . '/wpml/class-translate-widget-table.php';
		require_once SALA_ELEMENTOR_DIR . '/wpml/class-translate-widget-modern-carousel.php';
		require_once SALA_ELEMENTOR_DIR . '/wpml/class-translate-widget-modern-slider.php';
		require_once SALA_ELEMENTOR_DIR . '/wpml/class-translate-widget-team-member-carousel.php';
		require_once SALA_ELEMENTOR_DIR . '/wpml/class-translate-widget-testimonial-carousel.php';

		$widgets['sala-attribute-list'] = [
			'fields'            => [],
			'integration-class' => '\Sala_Elementor\Translate_Widget_Attribute_List',
		];

		$widgets['sala-heading'] = [
			'fields' => [
				[
					'field'       => 'title',
					'type'        => esc_html__( 'Modern Heading: Primary', 'sala' ),
					'editor_type' => 'AREA',
				],
				'title_link' => [
					'field'       => 'url',
					'type'        => esc_html__( 'Modern Heading: Link', 'sala' ),
					'editor_type' => 'LINE',
				],
				[
					'field'       => 'description',
					'type'        => esc_html__( 'Modern Heading: Description', 'sala' ),
					'editor_type' => 'AREA',
				],
				[
					'field'       => 'sub_title_text',
					'type'        => esc_html__( 'Modern Heading: Secondary', 'sala' ),
					'editor_type' => 'AREA',
				],
			],
		];

		$widgets['elementor-button'] = [
			'fields' => [
				[
					'field'       => 'text',
					'type'        => esc_html__( 'Button: Text', 'sala' ),
					'editor_type' => 'LINE',
				],
				[
					'field'       => 'badge_text',
					'type'        => esc_html__( 'Button: Badge', 'sala' ),
					'editor_type' => 'LINE',
				],
				'link' => [
					'field'       => 'url',
					'type'        => esc_html__( 'Button: Link', 'sala' ),
					'editor_type' => 'LINK',
				],
			],
		];

		$widgets['sala-banner'] = [
			'fields' => [
				[
					'field'       => 'title_text',
					'type'        => esc_html__( 'Banner: Title', 'sala' ),
					'editor_type' => 'LINE',
				],
				'link' => [
					'field'       => 'url',
					'type'        => esc_html__( 'Banner: Link', 'sala' ),
					'editor_type' => 'LINK',
				],
			],
		];

		$widgets['sala-circle-progress-chart'] = [
			'fields' => [
				[
					'field'       => 'inner_content_text',
					'type'        => esc_html__( 'Circle Chart: Text', 'sala' ),
					'editor_type' => 'LINE',
				],
			],
		];

		$widgets['sala-flip-box'] = [
			'fields' => [
				[
					'field'       => 'title_text_a',
					'type'        => esc_html__( 'Flip Box: Front Title', 'sala' ),
					'editor_type' => 'LINE',
				],
				[
					'field'       => 'description_text_a',
					'type'        => esc_html__( 'Flip Box: Front Description', 'sala' ),
					'editor_type' => 'AREA',
				],
				[
					'field'       => 'title_text_b',
					'type'        => esc_html__( 'Flip Box: Back Title', 'sala' ),
					'editor_type' => 'LINE',
				],
				[
					'field'       => 'description_text_b',
					'type'        => esc_html__( 'Flip Box: Back Description', 'sala' ),
					'editor_type' => 'AREA',
				],
				[
					'field'       => 'button_text',
					'type'        => esc_html__( 'Flip Box: Button Text', 'sala' ),
					'editor_type' => 'LINE',
				],
				'link' => [
					'field'       => 'url',
					'type'        => esc_html__( 'Flip Box: Link', 'sala' ),
					'editor_type' => 'LINK',
				],
			],
		];

		$widgets['sala-google-map'] = [
			'fields'            => [],
			'integration-class' => '\Sala_Elementor\Translate_Widget_Google_Map',
		];

		$widgets['sala-icon'] = [
			'fields' => [
				'link' => [
					'field'       => 'url',
					'type'        => esc_html__( 'Icon: Link', 'sala' ),
					'editor_type' => 'LINK',
				],
			],
		];

		$widgets['sala-icon-box'] = [
			'fields' => [
				[
					'field'       => 'title_text',
					'type'        => esc_html__( 'Icon Box: Title', 'sala' ),
					'editor_type' => 'LINE',
				],
				[
					'field'       => 'description_text',
					'type'        => esc_html__( 'Icon Box: Description', 'sala' ),
					'editor_type' => 'AREA',
				],
				'link'        => [
					'field'       => 'url',
					'type'        => esc_html__( 'Icon Box: Link', 'sala' ),
					'editor_type' => 'LINK',
				],
				[
					'field'       => 'button_text',
					'type'        => esc_html__( 'Icon Box: Button', 'sala' ),
					'editor_type' => 'LINE',
				],
				'button_link' => [
					'field'       => 'url',
					'type'        => esc_html__( 'Icon Box: Button Link', 'sala' ),
					'editor_type' => 'LINK',
				],
			],
		];

		$widgets['sala-image-box'] = [
			'fields' => [
				[
					'field'       => 'title_text',
					'type'        => esc_html__( 'Image Box: Title', 'sala' ),
					'editor_type' => 'LINE',
				],
				[
					'field'       => 'description_text',
					'type'        => esc_html__( 'Image Box: Content', 'sala' ),
					'editor_type' => 'AREA',
				],
				'link' => [
					'field'       => 'url',
					'type'        => esc_html__( 'Image Box: Link', 'sala' ),
					'editor_type' => 'LINK',
				],
				[
					'field'       => 'button_text',
					'type'        => esc_html__( 'Image Box: Button', 'sala' ),
					'editor_type' => 'LINE',
				],
			],
		];

		$widgets['sala-list'] = [
			'fields'            => [],
			'integration-class' => '\Sala_Elementor\Translate_Widget_List',
		];

		$widgets['sala-popup-video'] = [
			'fields' => [
				[
					'field'       => 'video_text',
					'type'        => esc_html__( 'Popup Video: Text', 'sala' ),
					'editor_type' => 'LINE',
				],
				'video_url' => [
					'field'       => 'url',
					'type'        => esc_html__( 'Popup Video: Link', 'sala' ),
					'editor_type' => 'LINK',
				],
				[
					'field'       => 'poster_caption',
					'type'        => esc_html__( 'Popup Video: Caption', 'sala' ),
					'editor_type' => 'AREA',
				],
			],
		];

		$widgets['sala-pricing-table'] = [
			'fields'            => [
				[
					'field'       => 'heading',
					'type'        => esc_html__( 'Pricing Table: Heading', 'sala' ),
					'editor_type' => 'LINE',
				],
				[
					'field'       => 'sub_heading',
					'type'        => esc_html__( 'Pricing Table: Description', 'sala' ),
					'editor_type' => 'LINE',
				],
				[
					'field'       => 'currency',
					'type'        => esc_html__( 'Pricing Table: Currency', 'sala' ),
					'editor_type' => 'LINE',
				],
				[
					'field'       => 'price',
					'type'        => esc_html__( 'Pricing Table: Price', 'sala' ),
					'editor_type' => 'LINE',
				],
				[
					'field'       => 'period',
					'type'        => esc_html__( 'Pricing Table: Period', 'sala' ),
					'editor_type' => 'LINE',
				],
				[
					'field'       => 'button_text',
					'type'        => esc_html__( 'Pricing Table: Button', 'sala' ),
					'editor_type' => 'LINE',
				],
				'button_link' => [
					'field'       => 'url',
					'type'        => esc_html__( 'Pricing Table: Button Link', 'sala' ),
					'editor_type' => 'LINK',
				],
			],
			'integration-class' => '\Sala_Elementor\Translate_Widget_Pricing_Table',
		];

		$widgets['sala-table'] = [
			'fields'            => [],
			'integration-class' => [
				'\Sala_Elementor\Translate_Widget_Pricing_Table_Head',
				'\Sala_Elementor\Translate_Widget_Pricing_Table_Body',
			],
		];

		$widgets['sala-team-member'] = [
			'fields' => [
				[
					'field'       => 'name',
					'type'        => esc_html__( 'Team Member: Name', 'sala' ),
					'editor_type' => 'LINE',
				],
				[
					'field'       => 'content',
					'type'        => esc_html__( 'Team Member: Content', 'sala' ),
					'editor_type' => 'AREA',
				],
				[
					'field'       => 'position',
					'type'        => esc_html__( 'Team Member: Position', 'sala' ),
					'editor_type' => 'LINE',
				],
				'profile' => [
					'field'       => 'url',
					'type'        => esc_html__( 'Team Member: Profile', 'sala' ),
					'editor_type' => 'LINK',
				],
			],
		];

		$widgets['sala-modern-carousel'] = [
			'fields'            => [],
			'integration-class' => '\Sala_Elementor\Translate_Widget_Modern_Carousel',
		];

		$widgets['sala-modern-slider'] = [
			'fields'            => [],
			'integration-class' => '\Sala_Elementor\Translate_Widget_Modern_Slider',
		];

		$widgets['sala-team-member-carousel'] = [
			'fields'            => [],
			'integration-class' => '\Sala_Elementor\Translate_Widget_Team_Member_Carousel',
		];

		$widgets['sala-testimonial-carousel'] = [
			'fields'            => [],
			'integration-class' => '\Sala_Elementor\Translate_Widget_Testimonial_Carousel',
		];

		return $widgets;
	}

	public function wpml_widgets_to_translate_filter( $widgets ) {
		$sala_widgets = $this->get_translatable_node();

		foreach ( $sala_widgets as $widget_name => $widget ) {
			$widgets[ $widget_name ]               = $widget;
			$widgets[ $widget_name ]['conditions'] = [
				'widgetType' => $widget_name,
			];
		}

		return $widgets;
	}
}

WPML_Translatable_Nodes::instance()->initialize();
