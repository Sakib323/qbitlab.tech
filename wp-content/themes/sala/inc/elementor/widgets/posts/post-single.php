<?php

namespace Sala_Elementor;

use Elementor\Controls_Manager;
use Elementor\Core\Base\Document;

defined( 'ABSPATH' ) || exit;

class Widget_Post_Single extends Posts_Base {

	public function get_name() {
		return 'sala-post';
	}

	public function get_title() {
		return esc_html__( 'Post Single', 'sala' );
	}

	public function get_icon_part() {
		return 'eicon-single-post';
	}

	public function get_keywords() {
		return [ 'post' ];
	}

	protected function get_post_type() {
		return 'post';
	}

	protected function get_post_category() {
		return 'category';
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
				'01'    => esc_html__( 'Standard Post', 'sala' ),
				'02'    => esc_html__( 'Background Post', 'sala' ),
				'03'    => esc_html__( 'Featured Image Post', 'sala' ),
			],
			'default' => '01',
		] );

		$this->add_control( 'boxed', [
			'label'     => esc_html__( 'Boxed Container', 'sala' ),
			'type'      => Controls_Manager::SWITCHER,
			'label_on'  => esc_html__( 'Show', 'sala' ),
			'label_off' => esc_html__( 'Hide', 'sala' ),
		] );

		$this->add_control( 'sidebar', [
			'label'     => esc_html__( 'Sidebar', 'sala' ),
			'type'      => Controls_Manager::SWITCHER,
			'label_on'  => esc_html__( 'Show', 'sala' ),
			'label_off' => esc_html__( 'Hide', 'sala' ),
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if( $settings['boxed'] === 'yes' ){
			$ctn_class = 'container-boxed';
		} else {
			$ctn_class = '';
		}

		if( $settings['sidebar'] === 'yes' ){
			$sb_class = 'has-sidebar';
		} else {
			$sb_class = 'no-sidebar';
		}

		$args = array(
			'post_type'			=> 'post',
			'posts_per_page'	=> 1
		);
		$the_query = new \WP_Query( $args );
		if ( $the_query->have_posts() ) {
			if( $settings['layout'] === '01' ){
		?>
			<div class="single elm-post-single">
				<div class="site-content single-post-01 <?php echo esc_attr($sb_class); ?>">
					<div class="container <?php echo esc_attr($ctn_class); ?>">
						<div class="row">
							<div id="primary" class="content-area">

								<?php
								/* Start the loop */
								while ( $the_query->have_posts() ) { $the_query->the_post();
								?>
									<div class="heading-post">
										<?php get_template_part( 'templates/post-single/single', 'meta' ); ?>

										<?php get_template_part( 'templates/post-single/single', 'title' ); ?>

										<?php get_template_part( 'templates/post-single/single', 'author' ); ?>
									</div>

									<?php get_template_part( 'templates/post-single/single', 'thumbnail' ); ?>

									<article <?php post_class('area-post'); ?>>

										<div class="inner-post-wrap">

											<div class="post-content">
												<?php
												echo str_replace( '<meta charset="utf-8">', '', get_the_content() );
												wp_link_pages(array(
													'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'sala') . '</span>',
													'after'       => '</div>',
													'link_before' => '<span class="page-link">',
													'link_after'  => '</span>',
												));
												?>
											</div>

											<div class="post-bottom">
												<?php get_template_part( 'templates/post-single/single', 'tags' ); ?>

												<?php get_template_part( 'templates/post-single/single', 'social-share' ); ?>
											</div>

										</div>

										<?php get_template_part( 'templates/post-single/single', 'author-bio' ); ?>

										<?php get_template_part( 'templates/post-single/single', 'comments' ); ?>

										<?php get_template_part( 'templates/post-single/single', 'related' ); ?>

									</article>
								<?php
								}
								wp_reset_postdata();
								/* End of the loop */
								?>

							</div>
							<?php if( $settings['sidebar'] === 'yes' ){ ?>
							<aside id="secondary" class="sidebar-right sidebar-single-post">
								<div class="inner-sidebar" itemscope="itemscope">
									<?php dynamic_sidebar( 'blog_sidebar' ); ?>
								</div>
							</aside>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		<?php
			} else {

				if( $settings['layout'] === '03' ){
					$class = 'fullscreen';
				} else {
					$class = '';
				}

		?>
			<div class="single elm-post-single">
				<div class="site-content single-post-02 <?php echo esc_attr($sb_class); ?>">
					<?php
						/* Start the loop */
						while ( $the_query->have_posts() ) { $the_query->the_post();
					?>
					<div class="heading-post <?php echo esc_attr($class); ?>" style="background-image:url(<?php get_template_part( 'templates/post-single/single', 'thumbnail-url' ); ?>)">

						<div class="container <?php echo esc_attr($ctn_class); ?>">

							<div class="container-boxed-inner">

								<?php get_template_part( 'templates/post-single/single', 'meta' ); ?>

								<?php get_template_part( 'templates/post-single/single', 'title' ); ?>

								<?php get_template_part( 'templates/post-single/single', 'author' ); ?>

							</div>

						</div>

					</div>
					<div class="container <?php echo esc_attr($ctn_class); ?>">

						<div class="row">

							<div id="primary" class="content-area">

									<article <?php post_class('area-post'); ?>>

										<div class="inner-post-wrap">

											<div class="post-content">
												<?php
												echo str_replace( '<meta charset="utf-8">', '', get_the_content() );
												wp_link_pages(array(
													'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'sala') . '</span>',
													'after'       => '</div>',
													'link_before' => '<span class="page-link">',
													'link_after'  => '</span>',
												));
												?>
											</div>

											<div class="post-bottom">
												<?php get_template_part( 'templates/post-single/single', 'tags' ); ?>

												<?php get_template_part( 'templates/post-single/single', 'social-share' ); ?>
											</div>

										</div>

										<?php get_template_part( 'templates/post-single/single', 'author-bio' ); ?>

										<?php get_template_part( 'templates/post-single/single', 'comments' ); ?>

										<?php get_template_part( 'templates/post-single/single', 'related' ); ?>

									</article>

							</div>

							<?php if( $settings['sidebar'] === 'yes' ){ ?>
								<aside id="secondary" class="sidebar-right sidebar-single-post">
									<div class="inner-sidebar" itemscope="itemscope">
										<?php dynamic_sidebar( 'blog_sidebar' ); ?>
									</div>
								</aside>
							<?php } ?>

						</div>

					</div>

					<?php
						}
						wp_reset_postdata();
						/* End of the loop */
					?>

				</div>
			</div>
		<?php
			}
		}
	}
}
