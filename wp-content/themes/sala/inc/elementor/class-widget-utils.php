<?php

namespace Sala_Elementor;

defined( 'ABSPATH' ) || exit;

class Widget_Utils {

	public static function get_control_options_horizontal_alignment() {

		if( is_rtl() ) {

		}

		return [
			'left'   => [
				'title' => esc_html__( 'Left', 'sala' ),
				'icon'  => 'eicon-h-align-left',
			],
			'center' => [
				'title' => esc_html__( 'Center', 'sala' ),
				'icon'  => 'eicon-h-align-center',
			],
			'right'  => [
				'title' => esc_html__( 'Right', 'sala' ),
				'icon'  => 'eicon-h-align-right',
			],
		];
	}

	public static function get_control_options_horizontal_alignment_full() {
		return [
			'left'    => [
				'title' => esc_html__( 'Left', 'sala' ),
				'icon'  => 'eicon-h-align-left',
			],
			'center'  => [
				'title' => esc_html__( 'Center', 'sala' ),
				'icon'  => 'eicon-h-align-center',
			],
			'right'   => [
				'title' => esc_html__( 'Right', 'sala' ),
				'icon'  => 'eicon-h-align-right',
			],
			'stretch' => [
				'title' => esc_html__( 'Stretch', 'sala' ),
				'icon'  => 'eicon-h-align-stretch',
			],
		];
	}

	public static function get_control_options_vertical_alignment() {
		return [
			'top'    => [
				'title' => esc_html__( 'Top', 'sala' ),
				'icon'  => 'eicon-v-align-top',
			],
			'middle' => [
				'title' => esc_html__( 'Middle', 'sala' ),
				'icon'  => 'eicon-v-align-middle',
			],
			'bottom' => [
				'title' => esc_html__( 'Bottom', 'sala' ),
				'icon'  => 'eicon-v-align-bottom',
			],
		];
	}

	public static function get_control_options_vertical_full_alignment() {
		return [
			'top'     => [
				'title' => esc_html__( 'Top', 'sala' ),
				'icon'  => 'eicon-v-align-top',
			],
			'middle'  => [
				'title' => esc_html__( 'Middle', 'sala' ),
				'icon'  => 'eicon-v-align-middle',
			],
			'bottom'  => [
				'title' => esc_html__( 'Bottom', 'sala' ),
				'icon'  => 'eicon-v-align-bottom',
			],
			'stretch' => [
				'title' => esc_html__( 'Stretch', 'sala' ),
				'icon'  => 'eicon-v-align-stretch',
			],
		];
	}

	public static function get_control_options_text_align() {
		return [
			'left'   => [
				'title' => esc_html__( 'Left', 'sala' ),
				'icon'  => 'eicon-text-align-left',
			],
			'center' => [
				'title' => esc_html__( 'Center', 'sala' ),
				'icon'  => 'eicon-text-align-center',
			],
			'right'  => [
				'title' => esc_html__( 'Right', 'sala' ),
				'icon'  => 'eicon-text-align-right',
			],
		];
	}

	public static function get_control_options_text_align_full() {
		return [
			'left'    => [
				'title' => esc_html__( 'Left', 'sala' ),
				'icon'  => 'eicon-text-align-left',
			],
			'center'  => [
				'title' => esc_html__( 'Center', 'sala' ),
				'icon'  => 'eicon-text-align-center',
			],
			'right'   => [
				'title' => esc_html__( 'Right', 'sala' ),
				'icon'  => 'eicon-text-align-right',
			],
			'justify' => [
				'title' => esc_html__( 'Justified', 'sala' ),
				'icon'  => 'eicon-text-align-justify',
			],
		];
	}

	public static function get_button_style() {
		return [
			'flat'         => esc_html__( 'Flat', 'sala' ),
			'border'       => esc_html__( 'Border', 'sala' ),
			'thick-border' => esc_html__( 'Thick Border', 'sala' ),
			'text'         => esc_html__( 'Text', 'sala' ),
			'bottom-line'  => esc_html__( 'Bottom Line', 'sala' ),
			'left-line'    => esc_html__( 'Left Line', 'sala' ),
		];
	}


	public static function saved_templates() {

		$elementor_library = array();

		$args = array(
			'post_type'			=> 'elementor_library',
			'posts_per_page'	=> -1,
		);
		// The Query
		$the_query = new \WP_Query( $args );

		// The Loop
		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$elementor_library[get_the_ID()] = get_the_title();
			}
		}
		/* Restore original Post Data */
		wp_reset_postdata();

		return $elementor_library;
	}
	/**
	 * Get recommended social icons for control ICONS.
	 *
	 * @return array
	 */
	public static function get_recommended_social_icons() {
		return [
			'fa-brands' => [
				'android',
				'apple',
				'behance',
				'bitbucket',
				'codepen',
				'delicious',
				'deviantart',
				'digg',
				'dribbble',
				'envelope',
				'facebook',
				"facebook-f",
				"facebook-messenger",
				"facebook-square",
				'flickr',
				'foursquare',
				'free-code-camp',
				'github',
				'gitlab',
				'globe',
				'houzz',
				'instagram',
				'jsfiddle',
				'link',
				'linkedin',
				'medium',
				'meetup',
				'mix',
				'mixcloud',
				'odnoklassniki',
				'pinterest',
				'product-hunt',
				'reddit',
				'rss',
				'shopping-cart',
				'skype',
				'slideshare',
				'snapchat',
				'soundcloud',
				'spotify',
				'stack-overflow',
				'steam',
				'telegram',
				'thumb-tack',
				'tripadvisor',
				'tumblr',
				'twitch',
				'twitter',
				'viber',
				'vimeo',
				'vk',
				'weibo',
				'weixin',
				'whatsapp',
				'wordpress',
				'xing',
				'yelp',
				'youtube',
				'500px',
			],
		];
	}

	public static function get_grid_metro_size() {
		return [
			'1:1'   => esc_html__( 'Width 1 - Height 1', 'sala' ),
			'1:2'   => esc_html__( 'Width 1 - Height 2', 'sala' ),
			'1:0.7' => esc_html__( 'Width 1 - Height 70%', 'sala' ),
			'1:1.3' => esc_html__( 'Width 1 - Height 130%', 'sala' ),
			'2:1'   => esc_html__( 'Width 2 - Height 1', 'sala' ),
			'2:2'   => esc_html__( 'Width 2 - Height 2', 'sala' ),
		];
	}
}
