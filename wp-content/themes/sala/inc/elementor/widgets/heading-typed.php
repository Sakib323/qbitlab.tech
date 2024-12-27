<?php

namespace Sala_Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Core\Schemes\Typography as Scheme_Typography;

defined( 'ABSPATH' ) || exit;

class Widget_Heading_Typed extends Base {

	public function get_name() {
		return 'sala-heading-typed';
	}

	public function get_title() {
		return esc_html__( 'Modern Heading Typed', 'sala' );
	}

	public function get_icon_part() {
		return 'eicon-heading';
	}

	public function get_keywords() {
		return [ 'heading', 'title', 'text' ];
	}

	public function get_script_depends() {
		return [ 'typed', 'sala-widget-heading-typed' ];
	}

	protected function register_controls() {
		$this->add_title_section();

		$this->add_title_style_section();
	}

	private function add_title_section() {
		$this->start_controls_section( 'title_section', [
			'label' => esc_html__( 'Heading', 'sala' ),
		] );

		$this->add_control( 'title', [
			'label'       => esc_html__( 'Text', 'sala' ),
			'type'        => Controls_Manager::TEXTAREA,
			'dynamic'     => [
				'active' => true,
			],
			'placeholder' => esc_html__( 'Enter your title', 'sala' ),
			'default'     => esc_html__( 'Add Your Heading Text Here', 'sala' ),
			'description' => esc_html__( 'Enter strings, one row at a time.', 'sala' ),
		] );

		$this->end_controls_section();
	}

	private function add_title_style_section() {
		$this->start_controls_section( 'title_style_section', [
			'label'     => esc_html__( 'Heading', 'sala' ),
			'tab'       => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .heading-typed, {{WRAPPER}} .typed-cursor',
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'background_image',
			'types'    => [ 'gradient' ],
			'selector' => '{{WRAPPER}} .heading-typed, {{WRAPPER}} .typed-cursor',
		] );

		$this->add_control( 'typed_speed', [
			'label'          => esc_html__( 'Speed', 'sala' ),
			'type'           => Controls_Manager::NUMBER,
			'default'        => 100,
		] );

		$this->add_control( 'typed_loop', [
			'label' => esc_html__( 'Loop', 'sala' ),
			'type'  => Controls_Manager::SWITCHER,
			'default'        => 'yes',
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'sala-modern-heading-typed' );
		?>
		<div <?php $this->print_attributes_string( 'wrapper' ); ?>>
			<?php $this->print_title( $settings ); ?>
		</div>
		<?php
	}

	private function print_title(array $settings) {
		if ( empty( $settings['title'] ) ) {
			return;
		}

		// .elementor-heading-title -> Default color from section + column.
		$this->add_render_attribute( 'title', 'class', 'elementor-heading-title' );

		$this->add_inline_editing_attributes( 'title' );

		$title = $settings['title'];
		$typed_speed = $settings['typed_speed'];
		$typed_loop = $settings['typed_loop'];
		$title = explode("\n", $title);
		?>
		<div class="typed-strings">
			<?php
				foreach( $title as $text ){
			?>
			<p><?php echo $text; ?></p>
			<?php
				}
			?>
		</div>
		<div class="heading-typed" data-speed="<?php echo esc_attr($typed_speed); ?>" data-loop="<?php echo esc_attr($typed_loop); ?>"></div>
		<?php
	}
}
