<?php

namespace Sala_Elementor;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

defined( 'ABSPATH' ) || exit;

//@todo Not compatible with WPML.

class Widget_Timeline extends Base {

	public function get_name() {
		return 'sala-timeline';
	}

	public function get_title() {
		return esc_html__( 'Timeline', 'sala' );
	}

	public function get_icon_part() {
		return 'eicon-time-line';
	}

	public function get_keywords() {
		return [ 'timeline' ];
	}

	public function get_script_depends() {
		return [ 'sala-widget-timeline' ];
	}

	protected function register_controls() {
		$this->start_controls_section( 'layout_section', [
			'label' => esc_html__( 'Layout', 'sala' ),
		] );

		$this->add_control( 'style', [
			'label'        => esc_html__( 'Style', 'sala' ),
			'type'         => Controls_Manager::SELECT,
			'default'      => '01',
			'options'      => [
				'01'       => esc_html__( '01', 'sala' ),
				'02' 		=> esc_html__( '02', 'sala' ),
				'03' 		=> esc_html__( '03', 'sala' ),
			],
			'prefix_class' => 'style-',
		] );

		$this->add_control( 'show_time_nav', [
			'label'     	=> esc_html__( 'Time Navigation', 'sala' ),
			'type'      	=> Controls_Manager::SWITCHER,
			'default'      	=> '0',
			'condition'    => [
				'style!' => '03',
			],
		] );

		$repeater = new Repeater();

		$repeater->add_control( 'gallery', [
			'label'      => esc_html__( 'Add Images', 'sala' ),
			'type'       => Controls_Manager::GALLERY,
			'show_label' => false,
			'dynamic'    => [
				'active' => true,
			],
		] );

		$repeater->add_control( 'date', [
			'label' => esc_html__( 'Date', 'sala' ),
			'type'  => Controls_Manager::DATE_TIME,
		] );

		$repeater->add_control( 'title', [
			'label'       => esc_html__( 'Title', 'sala' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'Title', 'sala' ),
			'label_block' => true,
		] );

		$repeater->add_control( 'description', [
			'label' => esc_html__( 'Description', 'sala' ),
			'type'  => Controls_Manager::WYSIWYG,
		] );

		$this->add_control( 'items', [
			'label'       => esc_html__( 'Items', 'sala' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
				[
					'title'       => esc_html__( 'Step #1', 'sala' ),
					'description' => esc_html__( 'Suspe ndisse suscipit sagittis leo sit met condimentum estibulum issim Lorem ipsum dolor sit amet, consectetur cium', 'sala' ),
				],
				[
					'title'       => esc_html__( 'Step #2', 'sala' ),
					'description' => esc_html__( 'Suspe ndisse suscipit sagittis leo sit met condimentum estibulum issim Lorem ipsum dolor sit amet, consectetur cium', 'sala' ),
				],
				[
					'title'       => esc_html__( 'Step #3', 'sala' ),
					'description' => esc_html__( 'Suspe ndisse suscipit sagittis leo sit met condimentum estibulum issim Lorem ipsum dolor sit amet, consectetur cium', 'sala' ),
				],
				[
					'title'       => esc_html__( 'Step #4', 'sala' ),
					'description' => esc_html__( 'Suspe ndisse suscipit sagittis leo sit met condimentum estibulum issim Lorem ipsum dolor sit amet, consectetur cium', 'sala' ),
				],
			],
			'title_field' => '{{{ title }}}',
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'      => 'thumbnail',
			'separator' => 'none',
		] );

		$this->end_controls_section();

		$this->add_box_section();

		$this->add_line_section();

		$this->add_styling_section();
	}

	private function add_box_section() {
		$this->start_controls_section( 'box_section', [
			'label' => esc_html__( 'Box', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'box_padding', [
			'label'      => esc_html__( 'Padding', 'sala' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .timeline-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();
	}

	private function add_line_section() {
		$this->start_controls_section( 'line_section', [
			'label' => esc_html__( 'Line', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'line_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .timeline-line' => 'border-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'dot_heading', [
			'label'     => esc_html__( 'Dot', 'sala' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'dot_background_color', [
			'label'     => esc_html__( 'Background Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .timeline-dot::after' => 'background: {{VALUE}};',
			],
		] );

		$this->add_control( 'dot_border_color', [
			'label'     => esc_html__( 'Border Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .timeline-dot::after' => 'border-color: {{VALUE}};',
			],
		] );

		$this->end_controls_section();
	}

	private function add_styling_section() {
		$this->start_controls_section( 'styling_section', [
			'label' => esc_html__( 'Content', 'sala' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'show_content_divider', [
			'label'     	=> esc_html__( 'Show Divider', 'sala' ),
			'type'      	=> Controls_Manager::SWITCHER,
			'default'      	=> '0',
		] );

		$this->add_responsive_control( 'content_padding', [
			'label'      => esc_html__( 'Padding', 'sala' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .content-main .content-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'content_background', [
			'label'     => esc_html__( 'Background Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .content-main .content-inner' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'title_heading', [
			'label'     => esc_html__( 'Title', 'sala' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'label'    => esc_html__( 'Typography', 'sala' ),
			'selector' => '{{WRAPPER}} .title',
		] );

		$this->add_control( 'title_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .title' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'description_heading', [
			'label'     => esc_html__( 'Description', 'sala' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'description_typography',
			'label'    => esc_html__( 'Typography', 'sala' ),
			'selector' => '{{WRAPPER}} .description',
		] );

		$this->add_control( 'description_color', [
			'label'     => esc_html__( 'Color', 'sala' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .description' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_section();
	}



	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'sala-timeline' );

		$divider 	= $settings['show_content_divider'] ? 'divider' : '';

		?>
		<div <?php $this->print_attributes_string( 'wrapper' ); ?>>
			<div class="timeline-line"></div>
			<?php if ( $settings['items'] && count( $settings['items'] ) > 0 ) { ?>
				<div class="timeline-list sala-entrance-animation-queue">

					<?php if ( $settings['show_time_nav'] === 'yes' ) : ?>
					<nav class="navigation">
						<?php foreach ( $settings['items'] as $key => $item ) { ?>
							<?php
							$date = mysql2date( 'jS M', $item['date'] );
							$id = mysql2date( 'jSM', $item['date'] );
							?>
							<div class="navigation-date"><a href="#" id="link<?php echo esc_attr( $id ); ?>" class="scroll-to-timeline"><?php echo esc_html( $date ); ?></a></div>
						<?php } ?>
					</nav>
					<?php endif; ?>

					<?php
						foreach ( $settings['items'] as $key => $item ) {
							$id = mysql2date( 'jSM', $item['date'] );
					?>
						<div id="<?php echo esc_attr( $id ); ?>" class="timeline-item item">
							<div class="timeline-dot"></div>
							<?php if ( $settings['style'] === '01' ) : ?>
								<div class="content-wrap">
									<div class="content-header">
										<div class="content-inner">
											<?php if ( ! empty( $item['date'] ) ) : ?>
												<?php
												$month = mysql2date( 'F', $item['date'] );
												$year  = mysql2date( 'Y', $item['date'] );
												?>
												<div class="timeline-date">
													<div
														class="timeline-date--month"><?php echo esc_html( $month ); ?></div>
													<div class="timeline-date--year"><?php echo esc_html( $year ); ?></div>
												</div>
											<?php endif; ?>
											<div class="sala-image image">
												<?php
													$image_size = \Sala_Image::elementor_parse_image_size( $settings, '1170x670' );

													foreach ( $item['gallery'] as $image ) {

														?>
														<div class="image-item">
															<?php \Sala_Image::the_attachment_by_id( array(
																'id'   => $image['id'],
																'size' => $image_size,
															) ); ?>
														</div>
														<?php
													}
												?>
											</div>
										</div>
									</div>

									<div class="content-main <?php echo $divider; ?>">
										<div class="content-inner">
											<?php if ( ! empty( $item['title'] ) ) : ?>
												<h5 class="title"><?php echo esc_html( $item['title'] ); ?></h5>
											<?php endif; ?>

											<?php if ( isset( $item['description'] ) ) : ?>
												<div class="description">
													<?php echo '' . $this->parse_text_editor( $item['description'] ); ?>
												</div>
											<?php endif; ?>
										</div>
									</div>
								</div>
							<?php elseif ( $settings['style'] === '02' ) : ?>
								<div class="content-wrap">
									<div class="content-header">
										<div class="content-inner">
										</div>
									</div>

									<div class="content-main <?php echo $divider; ?>">
										<div class="content-inner">

											<div class="content-inner-avatar">

												<?php
													$image_size = \Sala_Image::elementor_parse_image_size( $settings, '1170x670' );

													foreach ( $item['gallery'] as $image ) {

														?>
														<div class="sala-image image">
															<?php \Sala_Image::the_attachment_by_id( array(
																'id'   => $image['id'],
																'size' => $image_size,
															) ); ?>
														</div>
														<?php
													}
												?>

											</div>

											<div class="content-inner-info">

												<?php if ( ! empty( $item['date'] ) ) : ?>
													<?php
													$time 	= mysql2date( 'H:i A', $item['date'] );
													?>
													<div class="timeline-time"><?php echo esc_html( $time ); ?></div>
												<?php endif; ?>

												<?php if ( ! empty( $item['title'] ) ) : ?>
													<h5 class="title"><?php echo esc_html( $item['title'] ); ?></h5>
												<?php endif; ?>

												<?php if ( isset( $item['description'] ) ) : ?>
													<div class="description">
														<?php echo '' . $this->parse_text_editor( $item['description'] ); ?>
													</div>
												<?php endif; ?>

											</div>
										</div>
									</div>
								</div>
							<?php elseif ( $settings['style'] === '03' ) : ?>
								<div class="content-wrap">
									<div class="content-main <?php echo $divider; ?>">
										<div class="content-inner">

											<div class="content-inner-info">

												<?php if ( ! empty( $item['date'] ) ) : ?>
													<?php
													$month = mysql2date( 'm', $item['date'] );
													$year  = mysql2date( 'Y', $item['date'] );
													?>
													<div class="timeline-date"><?php echo esc_html( $month ) . '/' . esc_html( $year ); ?></div>
												<?php endif; ?>

												<?php if ( ! empty( $item['title'] ) ) : ?>
													<h5 class="title"><?php echo esc_html( $item['title'] ); ?></h5>
												<?php endif; ?>

												<?php if ( isset( $item['description'] ) ) : ?>
													<div class="description">
														<?php echo '' . $this->parse_text_editor( $item['description'] ); ?>
													</div>
												<?php endif; ?>

											</div>
										</div>
									</div>
								</div>
							<?php endif; ?>
						</div>
					<?php } ?>


				</div>
			<?php } ?>
		</div>
		<?php
	}
}
