<?php

namespace Sala_Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || exit;

//@todo Not compatible with WPML.

class Widget_Form_Location extends Form_Base {

	public function get_name() {
		return 'sala-form-location';
	}

	public function get_title() {
		return esc_html__( 'Form Location', 'sala' );
	}

	public function get_icon_part() {
		return 'eicon-map-pin';
	}

	public function get_keywords() {
		return [ 'form-location', 'form' ];
	}

	protected function register_controls() {

		$this->start_controls_section( 'layout_section', [
			'label' => esc_html__( 'Layout', 'sala' ),
		] );

		$this->add_control( 'icon', [
			'label'      => esc_html__( 'Icon', 'sala' ),
			'show_label' => false,
			'type'       => Controls_Manager::ICONS,
			'default'    => [
				'value'   => 'far fa-map-marker-alt',
				'library' => 'fa-solid',
			],
		] );

		$this->add_control( 'form_redirect', [
			'label'       => esc_html__( 'Form Redirect', 'sala' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'default'     => 'https://sala.uxper.co/contact-01/',
		] );

		$this->end_controls_section();

		$this->add_field_style_section();

		$this->add_button_style_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$redirect = '';
		if( $settings['form_redirect'] ){
			$redirect = $settings['form_redirect'];
		}

		$is_svg = isset( $settings['icon']['library'] ) && 'svg' === $settings['icon']['library'] ? true : false;

		if ( $is_svg ) {
			$this->add_render_attribute( 'icon', 'class', [
				'sala-svg-icon',
			] );
		}
		?>
		<div class="sala-form-location">
			<form action="<?php echo esc_url($redirect); ?>" method="POST">
				<div class="field-group field-select">
					<div class="field-icon">
						<?php $this->render_icon( $settings, $settings['icon'], [ 'aria-hidden' => 'true' ], $is_svg, 'icon' ); ?>
					</div>
					<select name="sala_location" class="form-input nice-select" aria-label="<?php esc_attr_e( 'Location', 'woocommerce' ); ?>">
						<option value=""><?php echo esc_html__( 'Select location', 'sala' ); ?></option>
						<option value="FR"><?php echo esc_html__( 'France', 'sala' ); ?></option>
						<option value="GB"><?php echo esc_html__( 'United Kingdom', 'sala' ); ?></option>
						<option value="US"><?php echo esc_html__( 'United States', 'sala' ); ?></option>
					</select>
				</div>
				<div class="field-group form-submit">
					<input type="hidden" name="redirect" value="<?php echo esc_url($redirect); ?>">
					<button><?php echo esc_html__( 'Start', 'sala' ); ?></button>
				</div>
			</form>
		</div>
		<?php
	}
}
