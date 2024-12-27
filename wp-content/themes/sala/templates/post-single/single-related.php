<?php
if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
$results = Sala_Post::instance()->get_related_posts( array(
	'post_id'      => get_the_ID(),
	'number_posts' => 3,
) );

$single_post_display_related = Sala_Helper::setting('single_post_display_related');
if( $single_post_display_related == 'single_post_display_related' || $results == false ){
	return;
}
?>
<div class="post-related">
    <div class="block-heading">
        <h3 class="entry-title"><?php esc_html_e('Related Posts', 'sala'); ?></h3>
    </div>

    <div class="sala-swiper-slider sala-slider"
		data-lg-items="2"
		data-lg-gutter="30"
		data-sm-items="1"
		data-nav="1"
		data-auto-height="1"
		data-slides-per-group="inherit"
		>
        <div class="swiper-inner">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php while ( $results->have_posts() ) : $results->the_post(); ?>
                        <?php
                            $post_id   = get_the_ID();
                            $attach_id = get_post_thumbnail_id($post_id);
                            $blog_content_post_image_size = Sala_Helper::setting('blog_content_post_image_size');
                            $thumb_url = Sala_Helper::sala_image_resize($attach_id, $blog_content_post_image_size);
                        ?>
                        <div class="swiper-slide">
                            <div id="post-<?php the_ID(); ?>" <?php post_class( array('grid-item', 'sala-box') ); ?>>
                                <?php if ( has_post_thumbnail() ) : ?>
                                <div class="related-post-thumbnail sala-image">
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>">
                                    </a>
                                </div>
                                <?php endif; ?>

                                <div class="related-post-detail">
                                    <div class="related-post-meta">
                                        <div class="post-cate">
                                            <?php echo get_the_category_list(); ?>
                                        </div>
                                    </div>

                                    <?php if( !empty(get_the_title()) ) : ?>
                                    <div class="related-post-title">
                                        <?php
                                        the_title( '<h3 class="entry-title heading-font"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
                                        ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php wp_reset_postdata();endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</div>
