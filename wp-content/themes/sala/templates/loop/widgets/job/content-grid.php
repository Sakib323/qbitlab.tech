<?php

while ( $sala_query->have_posts() ) :
	$sala_query->the_post();
	$classes    = array( 'grid-item', 'post-item', 'job-item' );
	?>
	<article id="job-<?php the_ID(); ?>" <?php post_class( implode( ' ', $classes ) ); ?>>
		<div class="job-item-wrapper">
			<div class="job-detail">
				<h3><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a></h3>
				<p><?php echo esc_html( get_the_excerpt() ); ?></p>
			</div>
			<div class="job-button">
				<a href="<?php echo esc_url( get_permalink() ); ?>" class="btn"><?php echo esc_html( 'Detail', 'sala' ); ?></a>
			</div>
		</div>
	</article>
<?php
endwhile;
