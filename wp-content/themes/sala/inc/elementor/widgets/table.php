<?php

namespace Sala_Elementor;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;

defined( 'ABSPATH' ) || exit;

class Widget_Table extends Base {

	public function get_name() {
		return 'sala-table';
	}

	public function get_title() {
		return esc_html__( 'Table', 'sala' );
	}

	public function get_icon_part() {
		return 'eicon-table';
	}

	public function get_keywords() {
		return [ 'table' ];
	}

	protected function register_controls() {
		$this->start_controls_section( 'layout_section', [
			'label' => esc_html__( 'Layout', 'sala' ),
		] );

		$this->add_control( 'style', [
			'label'   => esc_html__( 'Style', 'sala' ),
			'type'    => Controls_Manager::SELECT,
			'default' => '01',
			'options' => [
				'01' => '01',
				'02' => '02',
			],
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'table_head_section', [
			'label' => esc_html__( 'Table Header', 'sala' ),
		] );

		$table_header = new Repeater();

		$table_header->add_control( 'action', [
			'label'       => esc_html__( 'Action', 'sala' ),
			'description' => esc_html__( 'You have started a new row. Please add new cells in your row by clicking Add Item button below.', 'sala' ),
			'type'        => Controls_Manager::SELECT,
			'default'     => 'Cell',
			'options'     => [
				'Row'  => esc_html__( 'Start New Row', 'sala' ),
				'Cell' => esc_html__( 'Add New Cell', 'sala' ),
			],
		] );

		$table_header->add_control( 'text', [
			'label'     => esc_html__( 'Text', 'sala' ),
			'type'      => Controls_Manager::TEXTAREA,
			'default'   => esc_html__( 'Sample', 'sala' ),
			'condition' => [
				'action' => 'Cell',
			],
		] );

		$this->add_control( 'table_head', [
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $table_header->get_controls(),
			'default'     => [
				[
					'action' => 'Row',
				],
				[
					'action' => 'Cell',
					'text'   => 'Sample #1',
				],
				[
					'action' => 'Cell',
					'text'   => 'Sample #2',
				],
				[
					'action' => 'Cell',
					'text'   => 'Sample #3',
				],
			],
			'title_field' => '{{{ action }}}',
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'table_body_section', [
			'label' => esc_html__( 'Table Content', 'sala' ),
		] );

		$table_content = new Repeater();

		$table_content->add_control( 'action', [
			'label'       => esc_html__( 'Action', 'sala' ),
			'description' => esc_html__( 'You have started a new row. Please add new cells in your row by clicking Add Item button below.', 'sala' ),
			'type'        => Controls_Manager::SELECT,
			'default'     => 'Cell',
			'options'     => [
				'Row'  => esc_html__( 'Start New Row', 'sala' ),
				'Cell' => esc_html__( 'Add New Cell', 'sala' ),
				'Full' => esc_html__( 'Row Full Size', 'sala' ),
			],
		] );

		$table_content->add_control( 'row_background_color', [
			'label'     => esc_html__( 'Background Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}};',
			],
			'condition' => [
				'action' => 'Row',
			],
		] );

		$table_content->add_control( 'row_background_color_darkmode', [
			'label'     => esc_html__( 'Background Color Darkmode', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'body.sala-dark-scheme {{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}};',
			],
			'condition' => [
				'action' => 'Row',
			],
		] );

		$table_content->add_control( 'text', [
			'label'     => esc_html__( 'Text', 'sala' ),
			'type'      => Controls_Manager::TEXTAREA,
			'default'   => esc_html__( 'Sample', 'sala' ),
			'condition' => [
				'action' => array( 'Cell', 'Full' ),
			],
		] );

		$table_content->add_control( 'icon', [
			'label' => esc_html__( 'Icon', 'sala' ),
			'type'  => Controls_Manager::ICONS,
			'label_block' => true,
			'condition' => [
				'action' => array( 'Cell', 'Full' ),
			],
		] );

		$table_content->add_control( 'ic_color', [
			'label'     => esc_html__( 'Icon Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} {{CURRENT_ITEM}} i' => 'color: {{VALUE}};',
			],
			'condition' => [
				'action' => array( 'Cell', 'Full' ),
			],
		] );

		$this->add_control( 'table_body', [
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $table_content->get_controls(),
			'default'     => [
				[
					'action' => 'Row',
				],
				[
					'action' => 'Cell',
					'text'   => 'Sample #1',
				],
				[
					'action' => 'Cell',
					'text'   => 'Sample #2',
				],
				[
					'action' => 'Cell',
					'text'   => 'Sample #3',
				],
			],
			'title_field' => '{{{ elementor.helpers.renderIcon( this, icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}} {{{ text }}}',
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'table_head_style_section', [
			'label' => esc_html__( 'Table Header', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'      => 'table_head_typography',
			'selector'  => '{{WRAPPER}} th',
			'separator' => 'after',
		] );

		$this->add_responsive_control( 'table_head_padding', [
			'label'      => esc_html__( 'Padding', 'sala' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'separator'  => 'after',
		] );

		$this->add_responsive_control( 'table_head_align', [
			'label'     => esc_html__( 'Text Align', 'sala' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => Widget_Utils::get_control_options_text_align(),
			'selectors' => [
				'{{WRAPPER}} th' => 'text-align: {{VALUE}};',
			],
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'table_body_style_section', [
			'label' => esc_html__( 'Table Content', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->start_controls_tabs( 'toggle_skin_tabs' );

		$this->start_controls_tab( 'toggle_skin_normal_tab', [
			'label' => esc_html__( 'Normal', 'sala' ),
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'table_body_typography',
			'selector' => '{{WRAPPER}} td',
		] );

		$this->add_responsive_control( 'table_body_padding', [
			'label'      => esc_html__( 'Padding', 'sala' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'table_body_align', [
			'label'     => esc_html__( 'Text Align', 'sala' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => Widget_Utils::get_control_options_text_align(),
			'selectors' => [
				'{{WRAPPER}} td' => 'text-align: {{VALUE}};',
			],
			'separator'  => 'after',
		] );

		$this->add_control( 'icon_font_size', [
			'label'     => esc_html__( 'Font Size Icon', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 8,
					'max' => 60,
				],
			],
			'selectors' => [
				'{{WRAPPER}} span.icon i' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_control( 'icon_align', [
			'label'       => esc_html__( 'Icon Position', 'sala' ),
			'type'        => Controls_Manager::CHOOSE,
			'options'     => [
				'left'  => [
					'title' => esc_html__( 'Left', 'sala' ),
					'icon'  => 'eicon-h-align-left',
				],
				'right' => [
					'title' => esc_html__( 'Right', 'sala' ),
					'icon'  => 'eicon-h-align-right',
				],
			],
			'default'     => 'left',
			'toggle'      => false,
			'label_block' => false,
		] );

		$this->add_control( 'icon_indent', [
			'label'     => esc_html__( 'Spacing', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max' => 50,
				],
			],
			'selectors' => [
				'{{WRAPPER}} span.icon-left i'  => 'margin-right: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} span.icon-right i' => 'margin-left: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'toggle_skin_active_tab', [
			'label' => esc_html__( 'Full Size', 'sala' ),
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'table_body_fs_typography',
			'selector' => '{{WRAPPER}} td.fullsize',
		] );

		$this->add_control( 'fs_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} td.fullsize' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'fs_icon_font_size', [
			'label'     => esc_html__( 'Font Size Icon', 'sala' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 8,
					'max' => 60,
				],
			],
			'selectors' => [
				'{{WRAPPER}} td.fullsize span.icon i' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_control( 'fs_pos', [
			'label'     => esc_html__( 'Icon Position', 'sala' ),
			'type'      => Controls_Manager::SELECT,
			'options'   => [
				'static'     => esc_html__( 'Default', 'sala' ),
				'absolute'    => 'Absolute',
				'fixed'       => 'Fixed',
			],
			'default' => 'inherit',
			'selectors' => [
				'{{WRAPPER}} td.fullsize span.icon i' => 'position: {{VALUE}}',
			],
			'separator' => 'none',
		] );

		$this->add_control( 'fs_horizontal', [
				'label' => __( 'Horizontal Orientation', 'sala' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'sala' ),
						'icon' => 'far fa-arrow-to-left',
					],
					'right' => [
						'title' => __( 'Right', 'sala' ),
						'icon' => 'far fa-arrow-to-right',
					],
				],
				'default' => 'left',
				'toggle' => false,
				'condition' => [
					'fs_pos' => [ 'absolute', 'fixed' ],
				],
			]
		);

		$this->add_responsive_control( 'fs_horizontal_offset', [
			'label'          => esc_html__( 'Offset', 'sala' ),
			'type'           => Controls_Manager::SLIDER,
			'default'        => [
				'unit' => 'px',
			],
			'tablet_default' => [
				'unit' => 'px',
			],
			'mobile_default' => [
				'unit' => 'px',
			],
			'size_units'     => [ 'px', '%', 'vw', 'vh' ],
			'range'          => [
				'%'  => [
					'min' => -200,
					'max' => 200,
				],
				'px' => [
					'min' => -1000,
					'max' => 1000,
				],
				'vw' => [
					'min' => -200,
					'max' => 200,
				],
				'vh' => [
					'min' => -200,
					'max' => 200,
				],
			],
			'condition' => [
				'fs_pos' => [ 'absolute', 'fixed' ],
			],
		] );

		$this->add_control( 'fs_vertical', [
				'label' => __( 'Vertical Orientation', 'sala' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'sala' ),
						'icon' => 'far fa-arrow-to-top',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'sala' ),
						'icon' => 'far fa-arrow-to-bottom',
					],
				],
				'default' => 'top',
				'toggle' => false,
				'condition' => [
					'fs_pos' => [ 'absolute', 'fixed' ],
				],
			]
		);

		$this->add_responsive_control( 'fs_vertical_offset', [
			'label'          => esc_html__( 'Offset', 'sala' ),
			'type'           => Controls_Manager::SLIDER,
			'default'        => [
				'unit' => 'px',
			],
			'tablet_default' => [
				'unit' => 'px',
			],
			'mobile_default' => [
				'unit' => 'px',
			],
			'size_units'     => [ 'px', '%', 'vw', 'vh' ],
			'range'          => [
				'%'  => [
					'min' => -200,
					'max' => 200,
				],
				'px' => [
					'min' => -1000,
					'max' => 1000,
				],
				'vw' => [
					'min' => -200,
					'max' => 200,
				],
				'vh' => [
					'min' => -200,
					'max' => 200,
				],
			],
			'condition' => [
				'fs_pos' => [ 'absolute', 'fixed' ],
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$css = array();
		if( !empty( $settings['fs_horizontal'] ) && !empty( $settings['fs_horizontal_offset'] )  ) {
			$css[] = $settings['fs_horizontal'] . ': ' . $settings['fs_horizontal_offset']['size'] . $settings['fs_horizontal_offset']['unit'] ;
		}
		if( !empty( $settings['fs_vertical'] ) && !empty( $settings['fs_vertical_offset'] )  ) {
			$css[] = $settings['fs_vertical'] . ': ' . $settings['fs_vertical_offset']['size'] . $settings['fs_vertical_offset']['unit'];
		}

		$this->add_render_attribute( 'wrapper', 'class', 'sala-table' );
		$this->add_render_attribute( 'wrapper', 'class', 'style-' . $settings['style'] );
		?>
		<div <?php $this->print_attributes_string( 'wrapper' ); ?>>
			<table>
				<?php if ( ! empty( $settings['table_head'] ) ) { ?>
					<thead>
					<?php
					$th_count  = count( $settings['table_head'] );
					$thl_count = 0;
					?>
					<?php foreach ( $settings['table_head'] as $item ) : ?>
						<?php
						$thl_count += 1;
						if ( $item['action'] === 'Row' ) :
							echo '<tr>';
						else:
							echo '<th>' . $item['text'] . '</th>';
						endif;

						if ( $thl_count === $th_count ) {
							echo '</tr>';
						}
						?>
					<?php endforeach; ?>
					</thead>
				<?php } ?>

				<?php if ( ! empty( $settings['table_body'] ) ) { ?>
					<tbody>
					<?php
					$tb_count  = count( $settings['table_body'] );
					$tbl_count = 0;
					?>
					<?php
						foreach ( $settings['table_body'] as $item ) :
							$item_key = 'item_' . $item['_id'];

					?>
						<?php
						$tbl_count += 1;
						if ( $item['action'] === 'Row' ) :
							$this->add_render_attribute( $item_key, 'class', [
								'item',
								'elementor-repeater-item-' . $item['_id'],
							] );
							echo '<tr ' . $this->get_render_attribute_string( $item_key ) . '>';
						else:
							if ( $item['action'] === 'Full' ) :

								$this->add_render_attribute( $item_key, 'class', [
									'item',
									'fullsize',
									'elementor-repeater-item-' . $item['_id'],
								] );

								echo '<td colspan="4" ' . $this->get_render_attribute_string( $item_key ) . '>';

							else :

								$this->add_render_attribute( $item_key, 'class', [
									'item',
									'elementor-repeater-item-' . $item['_id'],
								] );

								echo '<td ' . $this->get_render_attribute_string( $item_key ) . '>';

							endif;

							if ( ! empty( $item['icon'] ) && $settings['icon_align'] === 'left' ) :
								echo '<span class="icon icon-left" style="' . implode(';', $css) . '">';
								$this->render_icon( $settings, $item['icon'], [ 'aria-hidden' => 'true' ], false, 'icon' );
								echo '</span>';
							endif;

							echo $item['text'];

							if ( ! empty( $item['icon'] ) && $settings['icon_align'] === 'right' ) :
								echo '<span class="icon icon-right" style="' . implode(';', $css) . '">';
								$this->render_icon( $settings, $item['icon'], [ 'aria-hidden' => 'true' ], false, 'icon' );
								echo '</span>';
							endif;

							echo '</td>';

						endif;

						if ( $tbl_count === $tb_count ) {
							echo '</tr>';
						}
						?>
					<?php endforeach; ?>
					</tbody>
				<?php } ?>
			</table>
		</div>
		<?php
	}

	protected function content_template() {
		// @formatter:off
		?>
		<#
		view.addRenderAttribute( 'wrapper', 'class', 'sala-table' );
		view.addRenderAttribute( 'wrapper', 'class', 'style-' + settings.style );

		#>
		<div <# {{{ view.getRenderAttributeString( 'wrapper' ) }}} #> >
			<table>
				<# if ( settings.table_head ) { #>
				<thead>
					<#
					var th_count = settings.table_head.length;
					var thl_count = 0;

					_.each( settings.table_head, function( item, index ) {

						thl_count += 1;
					#>
					<# if ( item.action === 'Row' ) { #>
						<tr>
							<# } else { #>
							<th>{{{ item.text }}}</th>
							<# } #>

							<# if ( thl_count === th_count ) { #>
						</tr>
						<# } #>
					<# }); #>
				</thead>
				<# } #>

				<# if ( settings.table_body ) { #>
					<tbody>
					<#
					var tb_count = settings.table_body.length;
					var tbl_count = 0;

						_.each( settings.table_body, function( item, index ) {
							var iconHTML = elementor.helpers.renderIcon( view, item.icon, { 'aria-hidden': true }, 'i' , 'object' );
							tbl_count += 1;
						#>
						<# if ( item.action === 'Row' ) { #>

							<tr>
						<# } else { #>

							<td>

							<# if ( iconHTML.rendered && settings.icon_align == 'left' ) { #>
							<span class="icon icon-left">
								{{{ iconHTML.value }}}
							</span>
							<# } #>

								{{{ item.text }}}

							<# if ( iconHTML.rendered && settings.icon_align == 'right' ) { #>
							<span class="icon icon-right">
								{{{ iconHTML.value }}}
							</span>
							<# } #>

							</td>

						<# } #>

						<# if ( tbl_count === tb_count ) { #>
							</tr>
						<# } #>
					<# }); #>
					</tbody>
				<# } #>
			</table>
		</div>
		<?php
		// @formatter:off
	}
}
