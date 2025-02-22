<?php

namespace Sala_Elementor;

use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit;

class Widget_Contact_Form_7 extends Form_Base {

	public function get_name() {
		return 'sala-contact-form-7';
	}

	public function get_title() {
		return esc_html__( 'Contact Form 7', 'sala' );
	}

	public function get_keywords() {
		return [ 'contact', 'form' ];
	}

	private function get_form_list() {
		$forms = [];

		$cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

		if ( $cf7 ) {
			foreach ( $cf7 as $cform ) {
				$forms[ $cform->ID ] = $cform->post_title;
			}
		} else {
			$forms[0] = esc_html__( 'No contact forms found', 'sala' );
		}

		return $forms;
	}

	/**
	 * Get first key of array
	 *
	 * @see array_key_first()
	 *
	 * @param $arr
	 *
	 * @return int|string
	 */
	private function get_form_default( $arr ) {
		foreach ( $arr as $key => $unused ) {
			return $key;
		}

		return 0;
	}

	protected function register_controls() {
		$this->add_content_section();

		$this->add_form_style_section();

		$this->add_field_style_section();

		$this->add_button_style_section();
	}

	private function add_content_section() {
		$this->start_controls_section( 'content_section', [
			'label' => esc_html__( 'Layout', 'sala' ),
		] );

		$form_list    = $this->get_form_list();
		$form_default = $this->get_form_default( $form_list );

		$this->add_control( 'form_id', [
			'label'   => esc_html__( 'Select Form', 'sala' ),
			'type'    => Controls_Manager::SELECT,
			'options' => $form_list,
			'default' => $form_default,
		] );

		$this->end_controls_section();
	}

	private function add_form_style_section() {
		$this->start_controls_section( 'form_style_section', [
			'label' => esc_html__( 'Form', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control(
			'column_gap',
			[
				'label'     => esc_html__( 'Columns Gap', 'sala' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 20,
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 60,
					],
				],
				'selectors' => [
					'{{WRAPPER}} *[class*=col-]' => 'padding-right: calc( {{SIZE}}{{UNIT}}/2 ); padding-left: calc( {{SIZE}}{{UNIT}}/2 );',
					'{{WRAPPER}} .row'           => 'margin-left: calc( -{{SIZE}}{{UNIT}}/2 ); margin-right: calc( -{{SIZE}}{{UNIT}}/2 );',
				],
			]
		);

		$this->add_control(
			'row_gap',
			[
				'label'     => esc_html__( 'Rows Gap', 'sala' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 20,
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 60,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .form-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$form_id  = isset( $settings['form_id'] ) ? $settings['form_id'] : 0;

		$this->add_render_attribute( 'box', 'class', 'sala-contact-form-7' );
		?>
		<div <?php $this->print_render_attribute_string( 'box' ) ?>>
			<?php echo do_shortcode( '[contact-form-7 id="' . $form_id . '"]' ); ?>
		</div>
		<?php
	}
}
