<article id="post-<?php the_ID(); ?>" <?php post_class( array('grid-item', 'sala-box') ); ?>>
	<div class="inner-post-wrap">

		<?php get_template_part( 'templates/post/post', 'thumbnail' ); ?>

		<div class="post-detail">
			<?php
				if ( 'post' === get_post_type() ) :
					get_template_part( 'templates/post/post', 'meta' );
				endif;
			?>

			<?php if( !empty(get_the_title()) ) : ?>
			<div class="post-title">
				<?php
				the_title( '<h3 class="entry-title heading-font"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
				?>
				<?php if( is_sticky() ) { echo '<span>' . esc_html( 'Featured', 'sala' ) . '</span>'; } ?>
			</div>
			<?php endif; ?>

			<?php get_template_part( 'templates/post/post', 'excerpt' ); ?>

			<?php get_template_part( 'templates/post/post', 'button' ); ?>
		</div>

	</div>
</article>
