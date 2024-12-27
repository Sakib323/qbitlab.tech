<?php

namespace Sala_Elementor;

use Elementor\Controls_Manager;
use Elementor\Core\Base\Document;

defined( 'ABSPATH' ) || exit;

class Widget_Portfolio_Single extends Posts_Base {

	public function get_name() {
		return 'sala-portfolio-single';
	}

	public function get_title() {
		return esc_html__( 'Portfolio Single', 'sala' );
	}

	public function get_icon_part() {
		return 'eicon-kit-parts';
	}

	public function get_keywords() {
		return [ 'portfolio' ];
	}

	protected function get_post_type() {
		return 'portfolio';
	}

	protected function get_post_category() {
		return 'portfolio_category';
	}

	public function is_reload_preview_required() {
		return false;
	}

	protected function register_controls() {
		$this->add_layout_section();

		parent::register_controls();
	}

	private function add_layout_section() {
		$this->start_controls_section( 'layout_section', [
			'label' => esc_html__( 'Layout', 'sala' ),
		] );

		$this->add_control( 'layout', [
			'label'   => esc_html__( 'Layout', 'sala' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'01'    => esc_html__( 'Layout 01', 'sala' ),
				'02'    => esc_html__( 'Layout 02', 'sala' ),
				'03'    => esc_html__( 'Layout 03', 'sala' ),
			],
			'default' => '01',
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$args = array(
			'post_type'			=> 'portfolio',
			'posts_per_page'	=> 1
		);
		$the_query = new \WP_Query( $args );
		if ( $the_query->have_posts() ) {
			if( $settings['layout'] === '01' ) {
		?>
		<div class="single">
			<div class="site-content single-portfolio-01">

				<div id="primary" class="content-area">

					<?php
					/* Start the loop */
					while ( $the_query->have_posts() ) { $the_query->the_post();
						$sala_portfolio_options = maybe_unserialize( get_post_meta( get_the_ID(), 'sala_portfolio_options', true ) );
						$sliders 				= $sala_portfolio_options['portfolio_content_gallery'];
						$url 					= $sala_portfolio_options['portfolio_video_url'];
						$thumbnail 				= $sala_portfolio_options['portfolio_video_thumbnail'];
					?>
						<div class="container">
							<div class="heading-portfolio">
								<?php get_template_part( 'templates/portfolio-single/single', 'title' ); ?>

								<?php get_template_part( 'templates/portfolio-single/single', 'excerpt' ); ?>

								<?php get_template_part( 'templates/portfolio-single/single', 'meta' ); ?>
							</div>

							<article <?php post_class('area-post'); ?>>

								<div class="inner-portfolio-wrap">

									<div class="portfolio-content">
										<?php
										echo str_replace( '<meta charset="utf-8">', '', get_the_content() );
										?>
									</div>

								</div>

							</article>

						</div>

						<div class="portfolio-slider">

							<div class="block-heading">
								<h3 class="entry-title"><?php esc_html_e( 'An explosive brand', 'sala' ); ?></h3>
								<p><?php esc_html_e( 'Duis sodales dolor nisl purus mollis. Cras dictum vitae est a lacinia. Nunc posuere sodales consequat.', 'sala' ); ?></p>
							</div>

							<div class="sala-swiper-slider sala-slider"
								data-lg-items="2"
								data-lg-gutter="30"
								data-sm-items="1"
								data-nav="0"
								data-centered="1"
								data-loop="1"
								data-pagination="1"
								data-auto-height="0"
								data-slides-per-group="inherit"
								>
								<div class="swiper-inner">
									<div class="swiper-container">
										<div class="swiper-wrapper">
											<?php foreach( $sliders as $slider ) { ?>
												<?php
													$thumb_url = $slider['url'];
												?>
												<div class="swiper-slide">
													<div class="item">
														<?php if ( $thumb_url ) : ?>
															<img src="<?php echo esc_url( $thumb_url ); ?>" alt="">
														<?php endif; ?>
													</div>
												</div>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>

						</div>

						<div class="container">
							<div class="portfolio-video">
								<?php

								if( $thumbnail == '' ){
									$thumbnail = SALA_THEME_URI . '/assets/images/no-image.jpg';
								}

								$embed = wp_oembed_get( $url );
                                $embed = str_replace( 'frameborder="0"', '', $embed );
								if ( $embed ) {

								$wrap_classes = 'entry-portfolio-video';
								?>
								<div class="<?php echo esc_attr( $wrap_classes ); ?>">
									<?php echo '<div class="thumb-preview"><a href="#embed-popup" class="btn-sala-popup icon"><i class="fas fa-play"></i></a><img class="thumb" src="' . $thumbnail  . '" alt="" /></div><div class="sala-popup" id="embed-popup"><div class="bg-overlay"></div><div class="embed-responsive-16by9 embed-responsive">' . $embed . '</div></div>'; ?>
								</div>
								<?php } ?>
							</div>
						</div>

						<p class="thankyou"><?php esc_html_e( 'Thank you for watching!', 'sala' ); ?></p>

						<?php get_template_part( 'templates/portfolio-single/single', 'paginate' ); ?>

						<?php get_template_part( 'templates/portfolio-single/single', 'related' ); ?>

					<?php
					}
					wp_reset_postdata();
					/* End of the loop */
					?>

				</div>

			</div>
		</div>
		<?php
			} elseif( $settings['layout'] === '02' ) {
		?>
		<div class="single">
			<div class="site-content single-portfolio-02">

				<div id="primary" class="content-area">

					<?php
					/* Start the loop */
					while ( $the_query->have_posts() ) { $the_query->the_post();
						$sala_portfolio_options = maybe_unserialize( get_post_meta( get_the_ID(), 'sala_portfolio_options', true ) );
						$sliders 				= $sala_portfolio_options['portfolio_content_gallery'];
						$url 					= $sala_portfolio_options['portfolio_video_url'];
						$thumbnail 				= $sala_portfolio_options['portfolio_video_thumbnail'];
					?>
						<div class="portfolio-video">
							<?php

							if( $thumbnail == '' ){
								$thumbnail = SALA_THEME_URI . '/assets/images/no-image.jpg';
							}

							$embed = wp_oembed_get( $url );
                            $embed = str_replace( 'frameborder="0"', '', $embed );
							if ( $embed ) {

							$wrap_classes = 'entry-portfolio-video';
							?>
							<div class="<?php echo esc_attr( $wrap_classes ); ?>">
								<?php echo '<div class="thumb-preview"><a href="#embed-popup" class="btn-sala-popup icon"><i class="fas fa-play"></i></a><img class="thumb" src="' . $thumbnail  . '"  alt="" /></div><div class="sala-popup" id="embed-popup"><div class="bg-overlay"></div><div class="embed-responsive-16by9 embed-responsive">' . $embed . '</div></div>'; ?>
							</div>
							<?php } ?>
						</div>

						<div class="container">
							<div class="heading-portfolio">
								<div class="heading-portfolio-left">

									<?php get_template_part( 'templates/portfolio-single/single', 'title' ); ?>

									<?php get_template_part( 'templates/portfolio-single/single', 'excerpt' ); ?>

								</div>

								<?php get_template_part( 'templates/portfolio-single/single', 'meta' ); ?>
							</div>

							<article <?php post_class('area-post'); ?>>

								<div class="inner-portfolio-wrap">

									<div class="portfolio-content">
										<?php
										echo str_replace( '<meta charset="utf-8">', '', get_the_content() );
										?>
									</div>

								</div>

							</article>

						</div>

						<div class="portfolio-slider">

							<div class="block-heading">
								<h3 class="entry-title"><?php esc_html_e( 'An explosive brand', 'sala' ); ?></h3>
								<p><?php esc_html_e( 'Duis sodales dolor nisl purus mollis. Cras dictum vitae est a lacinia. Nunc posuere sodales consequat.', 'sala' ); ?></p>
							</div>

							<div class="sala-swiper-slider sala-slider"
								data-lg-items="2"
								data-lg-gutter="30"
								data-sm-items="1"
								data-nav="0"
								data-centered="1"
								data-loop="1"
								data-pagination="1"
								data-auto-height="0"
								data-slides-per-group="inherit"
								>
								<div class="swiper-inner">
									<div class="swiper-container">
										<div class="swiper-wrapper">
											<?php foreach( $sliders as $slider ) { ?>
												<?php
													$thumb_url = $slider['url'];
												?>
												<div class="swiper-slide">
													<div class="item">
														<?php if ( $thumb_url ) : ?>
															<img src="<?php echo esc_url( $thumb_url ); ?>" alt="">
														<?php endif; ?>
													</div>
												</div>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>

						</div>

						<p class="thankyou"><?php esc_html_e( 'Thank you for watching!', 'sala' ); ?></p>

						<?php get_template_part( 'templates/portfolio-single/single', 'paginate' ); ?>

						<?php get_template_part( 'templates/portfolio-single/single', 'related' ); ?>

					<?php
					}
					wp_reset_postdata();
					/* End of the loop */
					?>

				</div>

			</div>
		</div>
		<?php
			} elseif( $settings['layout'] === '03' ) {
		?>
		<div class="single">
			<div class="site-content single-portfolio-03">

				<div id="primary" class="content-area">

					<?php
					/* Start the loop */
					while ( $the_query->have_posts() ) { $the_query->the_post();
						$sala_portfolio_options = maybe_unserialize( get_post_meta( get_the_ID(), 'sala_portfolio_options', true ) );
						$sliders 				= $sala_portfolio_options['portfolio_content_gallery'];
						$url 					= $sala_portfolio_options['portfolio_video_url'];
						$thumbnail 				= $sala_portfolio_options['portfolio_video_thumbnail'];
					?>

						<div class="container">
							<div class="inner-content-wrap">

								<div class="inner-content-left">

									<div class="inner-content-left-wrap">

										<div class="inner-left-head">
											<?php get_template_part( 'templates/portfolio-single/single', 'title' ); ?>
										</div>

										<div class="inner-left-bottom">
											<?php get_template_part( 'templates/portfolio-single/single', 'meta' ); ?>

											<div class="info">
												<?php get_template_part( 'templates/portfolio-single/single', 'excerpt' ); ?>
												<?php get_template_part( 'templates/portfolio-single/single', 'author' ); ?>
											</div>

										</div>

									</div>

								</div>

								<div class="inner-content-right">

									<div class="portfolio-slider">

										<?php
											$sala_portfolio_options = maybe_unserialize( get_post_meta( get_the_ID(), 'sala_portfolio_options', true ) );
											$sliders 		= $sala_portfolio_options['portfolio_content_gallery'];
										?>

										<div class="no-swiper"
											data-lg-items="2"
											data-lg-gutter="30"
											data-sm-items="1"
											data-nav="0"
											data-centered="1"
											data-loop="1"
											data-pagination="1"
											data-auto-height="0"
											data-slides-per-group="inherit"
											>
											<div class="swiper-inner">
												<div class="swiper-container">
													<div class="swiper-wrapper">
														<?php foreach( $sliders as $slider ) { ?>
															<?php
																$thumb_url = $slider['url'];
															?>
															<div class="swiper-slide">
																<div class="item">
																	<?php if ( $thumb_url ) : ?>
																		<img src="<?php echo esc_url( $thumb_url ); ?>" alt="">
																	<?php endif; ?>
																</div>
															</div>
														<?php } ?>
													</div>
												</div>
											</div>
										</div>

										<p class="thankyou"><?php esc_html_e( 'Thank you for watching!', 'sala' ); ?></p>

									</div>
								</div>
							</div>
						</div>

						<?php get_template_part( 'templates/portfolio-single/single', 'paginate' ); ?>

						<?php get_template_part( 'templates/portfolio-single/single', 'related' ); ?>

					<?php
					}
					wp_reset_postdata();
					/* End of the loop */
					?>

				</div>

			</div>
		</div>
		<?php
			}
		}
	}
}
