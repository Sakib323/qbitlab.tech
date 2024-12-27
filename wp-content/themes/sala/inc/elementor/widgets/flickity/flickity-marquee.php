<?php

namespace Sala_Elementor;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || exit;

class Widget_Flickity_Marquee extends Base {

	public function get_name() {
		return 'sala-flickity-marquee';
	}

	public function get_title() {
		return esc_html__( 'Flickity Marquee', 'sala' );
	}

	public function get_icon_part() {
		return 'eicon-slider-push';
	}

	public function get_keywords() {
		return [ 'flickity' ];
	}

	public function get_script_depends() {
		return [ 'sala-widget-flickity-marquee' ];
	}

	protected function register_controls() {
		$this->add_list_section();

		$this->add_styling_section();

		$this->add_text_style_section();
	}

	private function add_list_section() {
		$this->start_controls_section( 'list_section', [
			'label' => esc_html__( 'Text List', 'sala' ),
		] );

		$repeater = new Repeater();

		$repeater->add_control( 'text', [
			'label'       => esc_html__( 'Text', 'sala' ),
			'type'        => Controls_Manager::TEXTAREA,
			'default'     => esc_html__( 'Text', 'sala' ),
			'label_block' => true,
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
				[
					'text' => esc_html__( 'List Item #3', 'sala' ),
				],
			],
			'title_field' => '',
		] );

		$this->end_controls_section();
	}

	private function add_styling_section() {
		$this->start_controls_section( 'styling_section', [
			'label' => esc_html__( 'Styling', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'box_padding', [
			'label'      => esc_html__( 'Padding', 'sala' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .sala-list .item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'enable_divider', [
			'label'     	=> esc_html__( 'Enable Divider', 'sala' ),
			'type'      	=> Controls_Manager::SWITCHER,
			'default'      	=> '0',
		] );

		$this->add_control( 'line_color', [
			'label'     => esc_html__( 'Line Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .text:after' => 'background-color: {{VALUE}};',
			],
			'condition' => [
				'enable_divider' => 'yes',
			],
		] );

		$this->end_controls_section();
	}

	private function add_text_style_section() {
		$this->start_controls_section( 'text_style_section', [
			'label' => esc_html__( 'Text', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'text_typography',
			'label'    => esc_html__( 'Typography', 'sala' ),
			'selector' => '{{WRAPPER}} .text',
		] );

		$this->add_control( 'text_color', [
			'label'     => esc_html__( 'Text Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .text' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'sala-list sala-flickity-marquee' );

		?>
		<div <?php $this->print_attributes_string( 'wrapper' ); ?>>
			<?php if ( $settings['items'] && count( $settings['items'] ) > 0 ) {
				foreach ( $settings['items'] as $key => $item ) {
					$divider	= '';
					$item_key 	= 'item_' . $item['_id'];

					if( $settings['enable_divider'] == 'yes' ){
						$divider = 'has-divider';
					}

					$this->add_render_attribute( $item_key, [
						'class' => [
							'item',
							$divider,
						],
					] );
					?>
					<div <?php $this->print_attributes_string( $item_key ); ?>>

						<div class="list-header">

							<div class="text-wrap">
								<?php if ( isset( $item['text'] ) ) { ?>
									<div class="text">
										<?php echo wp_kses_post( $item['text'] ); ?>
									</div>
								<?php } ?>
							</div>

						</div>

					</div>
					<?php
				}
			}
			?>
		</div>
		<?php
	}

	protected function content_template() {
		// @formatter:off
		?>
		<div class="sala-list sala-flickity-marquee">
			<# _.each( settings.items, function( item, index ) { #>
				<#
					var divider = '';
					if ( 'yes' == settings.enable_divider ) {
						divider = 'has-divider';
					}
				#>
				<div class="item {{{ divider }}}">

					<div class="list-header">

						<div class="text-wrap">
							<#	if ( '' !== item.text ) { #>
								<span class="text">{{{ item.text }}}</span>
							<# } #>
						</div>

					</div>

				</div>
			<# }); #>
		</div>
		<?php
		// @formatter:off
	}
}
