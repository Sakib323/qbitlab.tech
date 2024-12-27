<?php
if (!class_exists('Sala_Widget_Popular_Posts')) {
    class Sala_Widget_Popular_Posts extends Sala_Widget
    {
        public function __construct()
        {
            $this->widget_cssclass = 'sala-widget-popular_posts';
            $this->widget_description = esc_html__("Popular posts widget", 'sala');
            $this->widget_id = 'sala_popular_posts';
            $this->widget_name = esc_html__('Sala - Popular Posts', 'sala');
            $this->settings = array(
                'title' => array(
                    'type' => 'text',
                    'std' => esc_html__('Popular Posts','sala'),
                    'label' => esc_html__('Title','sala')
                ),
                'number' => array(
                    'type'  => 'number',
                    'std'   => '6',
                    'label' => esc_html__('Number of posts to show', 'sala')
                ),
                'cate' => array(
                    'type' => 'checkbox',
                    'std' => 'true',
                    'label' => esc_html__('Show post categories', 'sala')
                ),
				'date' => array(
                    'type' => 'checkbox',
                    'std' => 'true',
                    'label' => esc_html__('Show post date', 'sala')
                ),
            );
            parent::__construct();
        }

        function widget($args, $instance)
        {
            if ( $this->get_cached_widget( $args ) )
                return;
            extract( $args, EXTR_SKIP );
            $title   	= empty( $instance['title'] ) ? '' : apply_filters( 'widget_title', $instance['title'] );
            $number   	= empty( $instance['number'] ) ? '' : apply_filters( 'widget_number', $instance['number'] );
            $cate   	= empty( $instance['cate'] ) ? '' : apply_filters( 'widget_cate', $instance['cate'] );
			$date   	= empty( $instance['date'] ) ? '' : apply_filters( 'widget_cate', $instance['date'] );
            ob_start();
            echo wp_kses_post($args['before_widget']);
            ?>

            <?php
            $arr = array(
                'post_type' => 'post',
                'numberposts' => $number,
                'orderby' => 'date',
                'order' => 'DESC'
            );
            $posts = get_posts( $arr );

            ?>

            <?php if(!empty($title)) { ?>
                <h3 class="widget-title"><?php echo esc_html($title); ?></h3>
            <?php } ?>

            <div class="sala-popular-posts listing-posts">
                <?php
                foreach( $posts as $post ) {
                    $postid    = $post->ID;
                    $size      = 'medium';
                    $categores = wp_get_post_categories($postid);
                    $size      = '140x140';
                    $attach_id = get_post_thumbnail_id($postid);
                    $thumb_url = Sala_Helper::sala_image_resize($attach_id, $size);

                    ?>

                    <article class="post">
                        <div class="inner-post-wrap">

                            <!-- post thumbnail -->
                            <?php if ( $thumb_url ) : ?>
                            <div class="entry-post-thumbnail">
                                <a href="<?php echo get_the_permalink($postid); ?>">
                                    <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute($postid); ?>">
                                </a>
                            </div>
                            <?php endif; ?>

                            <div class="entry-post-detail">

                                <!-- list categories -->
                                <?php if( $categores && $cate ) : ?>
                                <ul class="post-categories">
                                    <?php
                                    foreach ($categores as $category) {
                                        $cate = get_category($category);
                                    ?>
                                        <li><a href="<?php echo get_category_link($cate); ?>"><?php echo esc_html($cate->name); ?></a></li>
                                    <?php } ?>
                                </ul>
                                <?php endif; ?>

                                <!-- post title -->
                                <h3 class="post-title"><a href="<?php echo get_the_permalink($postid); ?>" rel="bookmark"><?php echo get_the_title($postid); ?></a></h3>

								<!-- post date -->
								<?php if( $date ) : ?>
									<p class="post-date"><?php echo get_the_date(); ?></p>
								<?php endif; ?>

                                <?php if( is_sticky($postid) ) { ?>
                                    <span class="is-sticky"><?php esc_html_e('Featured','sala'); ?></span>
                                <?php } ?>

                            </div>

                        </div>
                    </article><!-- #post-## -->
                <?php } ?>
            </div>

            <?php
            echo wp_kses_post($args['after_widget']);
            $content = ob_get_clean();
            echo $content;
            $this->cache_widget( $args, $content );
        }
    }
}
