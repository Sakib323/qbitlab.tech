<?php

namespace Sala_Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;

defined( 'ABSPATH' ) || exit;

class Widget_Social_Networks extends Base {

	public function get_name() {
		return 'sala-social-networks';
	}

	public function get_title() {
		return esc_html__( 'Social Networks', 'sala' );
	}

	public function get_icon_part() {
		return 'eicon-social-icons';
	}

	public function get_keywords() {
		return [ 'social', 'networks' ];
	}

	protected function register_controls() {
		$this->add_content_section();

		$this->add_style_section();

		$this->add_icon_style_section();

		$this->add_text_style_section();
	}

	private function add_content_section() {
		$this->start_controls_section( 'content_section', [
			'label' => esc_html__( 'Content', 'sala' ),
		] );

		$this->add_control( 'view', [
			'label'   => esc_html__( 'View', 'sala' ),
			'type'    => Controls_Manager::HIDDEN,
			'default' => 'traditional',
		] );

		$this->add_control( 'style', [
			'label'   => esc_html__( 'Style', 'sala' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'icons'              				=> esc_html__( 'Icons', 'sala' ),
				'large-icons'        				=> esc_html__( 'Large Icons', 'sala' ),
				'flat-rounded-icon'  				=> esc_html__( 'Flat Rounded Icon', 'sala' ),
				'solid-rounded-icon' 				=> esc_html__( 'Solid Rounded Icon', 'sala' ),
				'icon-title'         				=> esc_html__( 'Icon + Title', 'sala' ),
				'title'              				=> esc_html__( 'Title', 'sala' ),
				'solid-rounded-title'              	=> esc_html__( 'Solid Rounded Title', 'sala' ),
			],
			'default' => 'icons',
		] );

		$this->add_control( 'layout', [
			'label'   => esc_html__( 'Layout', 'sala' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'inline'      => esc_html__( 'Inline', 'sala' ),
				'list'        => esc_html__( 'List', 'sala' ),
				'two-columns' => esc_html__( '2 Columns', 'sala' ),
			],
			'default' => 'inline',
		] );

		$this->add_group_control( Group_Control_Tooltip::get_type(), [
			'name' => 'tooltip',
		] );

		$repeater = new Repeater();

		$repeater->add_control( 'title', [
			'label'       => esc_html__( 'Title', 'sala' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'Title', 'sala' ),
			'label_block' => true,
		] );

		$repeater->add_control( 'link', [
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

		$repeater->add_control( 'icon', [
			'label'       => esc_html__( 'Icon', 'sala' ),
			'type'        => Controls_Manager::ICONS,
			'default'     => [
				'value'   => 'fab fa-facebook-square',
				'library' => 'fa-brands',
			],
			'recommended' => Widget_Utils::get_recommended_social_icons(),
		] );

		$repeater->add_control( 'icon_color', [
			'label'     => esc_html__( 'Icon Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} {{CURRENT_ITEM}} .link-icon' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'items', [
			'label'       => esc_html__( 'Items', 'sala' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
				[
					'title' => esc_html__( 'Facebook', 'sala' ),
					'link'  => [
						'url'         => '#',
						'is_external' => true,
						'nofollow'    => true,
					],
					'icon'  => [
						'value'   => 'fab fa-facebook-square',
						'library' => 'fa-brands',
					],
				],
				[
					'title' => esc_html__( 'Twitter', 'sala' ),
					'link'  => [
						'url'         => '#',
						'is_external' => true,
						'nofollow'    => true,
					],
					'icon'  => [
						'value'   => 'fab fa-twitter',
						'library' => 'fa-brands',
					],
				],
				[
					'title' => esc_html__( 'Instagram', 'sala' ),
					'link'  => [
						'url'         => '#',
						'is_external' => true,
						'nofollow'    => true,
					],
					'icon'  => [
						'value'   => 'fab fa-instagram',
						'library' => 'fa-brands',
					],
				],
				[
					'title' => esc_html__( 'Linkedin', 'sala' ),
					'link'  => [
						'url'         => '#',
						'is_external' => true,
						'nofollow'    => true,
					],
					'icon'  => [
						'value'   => 'fab fa-linkedin',
						'library' => 'fa-brands',
					],
				],
			],
			'title_field' => '{{{ title }}}',
		] );

		$this->end_controls_section();
	}

	private function add_style_section() {
		$this->start_controls_section( 'style_section', [
			'label' => esc_html__( 'Style', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'items_vertical_spacing', [
			'label'      => esc_html__( 'Items Vertical Spacing', 'sala' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'max'  => 200,
					'step' => 1,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .layout-list .item + .item'                     => 'margin-top: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .layout-two-columns .item:nth-child(2) ~ .item' => 'margin-top: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_control( 'items_horizontal_spacing', [
			'label'      => esc_html__( 'Items Horizontal Spacing', 'sala' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'max'  => 200,
					'step' => 1,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .layout-inline .item:not(:last-child)'                     => 'margin-right: {{SIZE}}{{UNIT}};',
				'body.rtl {{WRAPPER}} .layout-inline .item:not(:first-child)'            => 'margin-left: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'alignment', [
			'label'     => esc_html__( 'Alignment', 'sala' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => Widget_Utils::get_control_options_text_align(),
			'selectors' => [
				'{{WRAPPER}}' => 'text-align: {{VALUE}};',
			],
		] );

		$this->start_controls_tabs( 'style_tabs' );

		$this->start_controls_tab( 'style_normal_tab', [
			'label' => esc_html__( 'Normal', 'sala' ),
		] );

		$this->add_control( 'color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .link' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'background_color', [
			'label'     => esc_html__( 'Background Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .link' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'border_color', [
			'label'     => esc_html__( 'Border Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .link' => 'border-color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'style_hover_tab', [
			'label' => esc_html__( 'Hover', 'sala' ),
		] );

		$this->add_control( 'hover_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .link:hover' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'background_hover_color', [
			'label'     => esc_html__( 'Background Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .link:hover' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'border_hover_color', [
			'label'     => esc_html__( 'Border Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .link:hover' => 'border-color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function add_icon_style_section() {
		$this->start_controls_section( 'icon_style_section', [
			'label' => esc_html__( 'Icon', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'icon_font_size', [
			'label'     => esc_html__( 'Font Size', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 8,
					'max' => 30,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .link-icon' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->start_controls_tabs( 'icon_style_tabs' );

		$this->start_controls_tab( 'icon_style_normal_tab', [
			'label' => esc_html__( 'Normal', 'sala' ),
		] );

		$this->add_control( 'icon_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .link-icon' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'icon_style_hover_tab', [
			'label' => esc_html__( 'Hover', 'sala' ),
		] );

		$this->add_control( 'icon_hover_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .link:hover .link-icon' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function add_text_style_section() {
		$this->start_controls_section( 'text_style_section', [
			'label'     => esc_html__( 'Text', 'sala' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'style' => [
					'icon-title',
					'title',
					'solid-rounded-title',
				],
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title',
			'selector' => '{{WRAPPER}} .link-text',
		] );

		$this->start_controls_tabs( 'title_style_tabs' );

		$this->start_controls_tab( 'title_style_normal_tab', [
			'label' => esc_html__( 'Normal', 'sala' ),
		] );

		$this->add_control( 'title_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .link-text' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'title_style_hover_tab', [
			'label' => esc_html__( 'Hover', 'sala' ),
		] );

		$this->add_control( 'title_hover_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .link:hover .link-text' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		extract( $settings );

		$this->add_render_attribute( 'wrapper', 'class', 'sala-social-networks' );

		if ( ! empty( $settings['style'] ) ) {
			$this->add_render_attribute( 'wrapper', 'class', 'style-' . $settings['style'] );
		}

		if ( ! empty( $settings['layout'] ) ) {
			$this->add_render_attribute( 'wrapper', 'class', 'layout-' . $settings['layout'] );
		}

		$link_classes = 'link';

		if ( ! empty( $settings['tooltip_enable'] ) && 'yes' === $settings['tooltip_enable'] ) {
			$link_classes .= " hint--bounce hint--{$settings['tooltip_position']}";

			if ( $settings['tooltip_skin'] !== '' ) {
				$link_classes .= " hint--{$settings['tooltip_skin']}";
			}
		}

		if ( $settings['items'] && count( $settings['items'] ) > 0 ) {
			ob_start();
			foreach ( $settings['items'] as $key => $item ) {
				$item_key      = 'item_' . $item['_id'];
				$item_link_key = 'item_link_' . $item['_id'];
				$_icon         = $link_content = '';

				$this->add_render_attribute( $item_key, 'class', [
					'item',
					'elementor-repeater-item-' . $item['_id'],
				] );

				if ( isset( $item['icon'] ) ) {
					$_icon = $this->get_icons_html( $item['icon'], [ 'class' => 'link-icon' ] );
				}

				if ( in_array( $settings['style'], array(
					'icons',
					'large-icons',
					'icon-title',
					'flat-rounded-icon',
					'solid-rounded-icon',
				) ) ) {
					$link_content .= $_icon;
				}

				if ( in_array( $settings['style'], array( 'icon-title', 'title', 'solid-rounded-title' ) ) ) {
					$link_content .= '<span class="link-text">' . $item['title'] . '</span>';
				}

				$this->add_render_attribute( $item_link_key, 'class', $link_classes );

				if ( ! empty( $item['title'] ) ) {
					$this->add_render_attribute( $item_link_key, 'aria-label', $item['title'] );
				}

				if ( ! empty( $item['link']['url'] ) ) {
					$this->add_link_attributes( $item_link_key, $item['link'] );
				}
				?>
				<li <?php $this->print_render_attribute_string( $item_key ); ?>>
					<a <?php $this->print_render_attribute_string( $item_link_key ); ?>>
						<?php echo "{$link_content}"; ?>
					</a>
				</li>
				<?php
			}
			$template = ob_get_clean();
		}
		?>
		<div <?php $this->print_attributes_string( 'wrapper' ); ?>>
			<?php echo '<ul class="list">' . $template . '</ul>'; ?>
		</div>
		<?php
	}

	protected function content_template() {
		// @formatter:off
		?>
		<div class="sala-social-networks style-{{ settings.style }} layout-{{ settings.layout }}">
			<ul class="list">
				<#
				var iconsHTML = {};
				var linkClass = 'link';

				if ( settings.tooltip_enable === 'yes' ) {
					linkClass += ' hint--bounce hint--' + settings.tooltip_position;

					if ( settings.tooltip_skin !== '' ) {
						linkClass += ' hint--' + settings.tooltip_skin;
					}
				}

				if ( settings.items ) {
					_.each( settings.items, function( item, index ) {
				#>
				<li class="item">
					<# if ( item.link && item.link.url ) { #>
					<a href="{{{ item.link.url }}}" class="{{{ linkClass }}}" aria-label="{{{ item.title }}}">

						<#
						var iconStyles = ["icons", "large-icons", "icon-title", "flat-rounded-icon", "solid-rounded-icon"];
						var textStyles = ["title", "icon-title", "solid-rounded-title"];
						#>

						<# if ( item.icon && iconStyles.indexOf( settings.style ) >= 0 ) { #>
							<# iconsHTML[ index ] = elementor.helpers.renderIcon( view, item.icon, {'class' : 'link-icon'}, 'i', 'object' ); #>
							{{{ iconsHTML[ index ].value }}}
						<# } #>

						<# if ( textStyles.indexOf( settings.style ) >= 0 ) { #>
							<span class="link-text">{{{ item.title }}}</span>
						<# } #>

					</a>
					<# } #>
				</li>
				<#
				} );
				}
				#>
			</ul>
		</div>
		<?php
		// @formatter:off
	}
}
