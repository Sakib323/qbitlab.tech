<?php
while ( $sala_query->have_posts() ) :
	$sala_query->the_post();
	$classes = array( 'grid-item', 'post-item', 'sala-box' );
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<div class="inner-post-wrap">

			<?php if ( ! empty( $settings['show_thumbnail'] ) ) { ?>
				<?php get_template_part('templates/post/post', 'thumbnail', array( 'image_size' => 'full' )); ?>
			<?php } ?>

			<div class="post-detail">
				<?php if ( 'post' === get_post_type() && 'yes' === $settings['show_meta'] ) : ?>
				<div class="post-meta">
					<?php if( $settings['show_meta_category'] === 'yes' ) : ?>
					<div class="post-cate">
						<?php echo get_the_category_list(); ?>
					</div>
					<?php endif; ?>

					<?php if( $settings['show_meta_date'] === 'yes' ) : ?>
					<div class="post-time">
						<?php printf('<span>%1$s</span>', esc_html(get_the_time(get_option('date_format')))); ?>
					</div>
					<?php endif; ?>

					<?php if( $settings['show_meta_comments'] === 'yes' ) : ?>
					<div class="post-comment">
						<span>
						<i class="fal fa-comment-alt"></i>
						<?php
							$comments_number = get_comments_number();
							printf('(%1$s)', esc_html($comments_number));
						?>
						</span>
					</div>
					<?php endif; ?>
				</div>
				<?php endif; ?>

				<?php if( !empty(get_the_title()) ) : ?>
				<div class="post-title">
					<h3 class="entry-title heading-font">
						<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php echo get_the_title(); ?><?php if( is_sticky() ) { echo '<span>' . esc_html( 'Featured', 'sala' ) . '</span>'; } ?></a>
					</h3>
				</div>
				<?php endif; ?>

				<?php if (  'yes' === $settings['show_excerpt'] ) { ?>
					<?php get_template_part( 'templates/post/post', 'excerpt' ); ?>
				<?php } ?>

				<?php if (  'yes' === $settings['show_read_more'] ) { ?>
					<div class="btn-readmore">
						<a href="<?php the_permalink(); ?>">
							<?php esc_html_e('Read More', 'sala'); ?>
						</a>
					</div>
				<?php } ?>
			</div>

		</div>
	</div>
<?php
endwhile;
