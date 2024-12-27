<?php

namespace Sala_Elementor;

use Elementor\Controls_Manager;
use Elementor\Core\Base\Document;

defined( 'ABSPATH' ) || exit;

class Widget_Modern_Site_Logo extends Base {

	public function get_name() {
		return 'sala-site-logo';
	}

	public function get_title() {
		return esc_html__( 'Mordern Site Logo', 'sala' );
	}

	public function get_icon_part() {
		return 'eicon-site-logo';
	}

	public function get_keywords() {
		return [ 'logo' ];
	}

	protected function register_controls() {
		$this->add_image_section();

		parent::register_controls();
	}

	private function add_image_section() {
		$this->start_controls_section( 'image_section', [
			'label' => esc_html__( 'Image', 'sala' ),
		] );

		$this->add_responsive_control( 'logo_max_width', [
			'label'      => esc_html__( 'Max Width', 'sala' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'unit' => 'px',
				'size' => 100,
			],
			'size_units' => [ 'px', '%' ],
			'range'      => [
				'%'  => [
					'min' => 100,
					'max' => 1000,
				],
				'px' => [
					'min' => 100,
					'max' => 1000,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .site-logo img' => 'max-width: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'align', [
			'label'        => esc_html__( 'Alignment', 'sala' ),
			'type'         => Controls_Manager::CHOOSE,
			'options'      => Widget_Utils::get_control_options_horizontal_alignment(),
			'default'      => 'left',
			'selectors_dictionary' => [
				'left'    => 'flex-start',
				'center' => 'center',
				'right' => 'flex-end',
			],
			'selectors'            => [
				'{{WRAPPER}} .site-logo' => 'display: flex; justify-content: {{VALUE}}',
			],
		] );

		$this->add_control( 'link', [
			'label'         => esc_html__( 'Link', 'sala' ),
			'type'          => Controls_Manager::URL,
			'placeholder'   => esc_html__( 'https://your-link.com', 'sala' ),
			'show_external' => true,
			'default'       => [
				'url'         => '',
				'is_external' => true,
				'nofollow'    => true,
			],
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$logo        = '';
		$logo_retina = '';
		$logo_dark         = get_theme_mod( 'logo_dark', '' );
		$logo_dark_retina  = get_theme_mod( 'logo_dark_retina', '' );
		$logo_light        = get_theme_mod( 'logo_light', '' );
		$logo_light_retina = get_theme_mod( 'logo_light_retina', '' );
		$enable_dark_theme = get_theme_mod( 'enable_dark_theme', 0 );

		if( $enable_dark_theme ) {

			if( $logo_light ) {
				$logo = $logo_light;
			}

			if( $logo_light_retina ) {
				$logo_retina = $logo_light_retina;
			}

		} else {

			if( $logo_dark ) {
				$logo = $logo_dark;
			}

			if( $logo_dark_retina ) {
				$logo_retina = $logo_dark_retina;
			}

		}

		if( $settings['link']['url'] ){
			$site_url = $settings['link']['url'];
		} else {
			$site_url = home_url('/');
		}

		$site_name = get_bloginfo('name', 'display');

		?>
		<div class="site-logo ux-element" data-id="site-logo">
			<?php if ( !empty($logo) ) : ?>
				<a href="<?php echo esc_url($site_url); ?>" title="<?php echo esc_attr($site_name); ?>">
					<img class="site-main-logo" src="<?php echo esc_url($logo); ?>" data-retina="<?php echo esc_attr($logo_retina); ?>" alt="<?php echo esc_attr($site_name); ?>">
					<img class="site-dark-logo hide" src="<?php echo esc_url($logo_light); ?>" data-retina="<?php echo esc_attr($logo_light_retina); ?>" alt="<?php echo esc_attr($site_name); ?>">
				</a>
			<?php else : ?>
				<?php $blog_info = get_bloginfo( 'name' ); ?>
				<?php if ( !empty($blog_info) ) : ?>
					<span class="site-title"><?php bloginfo( 'name' ); ?></span>
					<p><?php bloginfo( 'description' ); ?></p>
				<?php endif; ?>
			<?php endif; ?>
		</div>
		<?php
	}
}
