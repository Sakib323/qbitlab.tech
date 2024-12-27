<?php
$author_id  = get_the_author_meta('ID');
$user_name  = get_the_author_meta('display_name');
$avatar_url = get_avatar_url($author_id);
$author_avatar_image_url = get_the_author_meta('author_avatar_image_url', $author_id);
if( !empty($author_avatar_image_url) ){
    $avatar_url = $author_avatar_image_url;
}

$author_facebook_url  = get_the_author_meta(SALA_METABOX_PREFIX . 'author_facebook_url', $author_id);
$author_twitter_url   = get_the_author_meta(SALA_METABOX_PREFIX . 'author_twitter_url', $author_id);
$author_linkedin_url  = get_the_author_meta(SALA_METABOX_PREFIX . 'author_linkedin_url', $author_id);
$author_pinterest_url = get_the_author_meta(SALA_METABOX_PREFIX . 'author_pinterest_url', $author_id);
$author_instagram_url = get_the_author_meta(SALA_METABOX_PREFIX . 'author_instagram_url', $author_id);
$author_youtube_url   = get_the_author_meta(SALA_METABOX_PREFIX . 'author_youtube_url', $author_id);
?>

<?php if( !empty(get_the_author_meta( 'description' )) ) { ?>
<div class="post-author post-author-bio">
	<?php if($avatar_url) : ?>
	<div class="inner-left align-center">
		<div class="entry-avatar">
			<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
				<img src="<?php echo esc_url($avatar_url); ?>" alt="<?php echo esc_attr($user_name); ?>">
			</a>
		</div>
	</div>
	<?php endif; ?>

	<div class="inner-right">
		<div class="head-author">
			<h3 class="entry-title"><?php the_author_posts_link(); ?></h3>
			<?php if( $author_facebook_url || $author_twitter_url || $author_linkedin_url || $author_pinterest_url || $author_instagram_url || $author_youtube_url ) : ?>
                <ul class="list-info">
                    <?php if( !empty($author_facebook_url) ) : ?>
                    <li>
                        <a class="facebook hint--top" href="<?php echo esc_attr($author_facebook_url); ?>" target="_blank" aria-label="<?php esc_attr_e( 'Facebook', 'sala' ); ?>"><i class="fab fa-facebook-f"></i></a>
                    </li>
                    <?php endif; ?>

                    <?php if( !empty($author_twitter_url) ) : ?>
                    <li>
                        <a class="twitter hint--top" href="<?php echo esc_attr($author_twitter_url); ?>" target="_blank" aria-label="<?php esc_attr_e( 'Twitter', 'sala' ); ?>"><i class="fab fa-twitter"></i></a>
                    </li>
                    <?php endif; ?>

                    <?php if( !empty($author_linkedin_url) ) : ?>
                    <li>
                        <a class="linkedin hint--top" href="<?php echo esc_attr($author_linkedin_url); ?>" target="_blank" aria-label="<?php esc_attr_e( 'Linkedin', 'sala' ); ?>"><i class="fab fa-linkedin-in"></i></a>
                    </li>
                    <?php endif; ?>

                    <?php if( !empty($author_pinterest_url) ) : ?>
                    <li>
                        <a class="pinterest hint--top" href="<?php echo esc_attr($author_pinterest_url); ?>" target="_blank" aria-label="<?php esc_attr_e( 'Pinterest', 'sala' ); ?>"><i class="fab fa-pinterest"></i></a>
                    </li>
                    <?php endif; ?>

                    <?php if( !empty($author_instagram_url) ) : ?>
                    <li>
                        <a class="instagram hint--top" href="<?php echo esc_attr($author_instagram_url); ?>" target="_blank" aria-label="<?php esc_attr_e( 'Instagram', 'sala' ); ?>"><i class="fab fa-instagram"></i></a>
                    </li>
                    <?php endif; ?>

                    <?php if( !empty($author_youtube_url) ) : ?>
                    <li>
                        <a class="youtube hint--top" href="<?php echo esc_attr($author_youtube_url); ?>" target="_blank" aria-label="<?php esc_attr_e( 'Youtube', 'sala' ); ?>"><i class="fab fa-youtube"></i></a>
                    </li>
                    <?php endif; ?>
                </ul>
            <?php endif; ?>
		</div>

        <p class="entry-bio">
            <?php the_author_meta( 'description' ); ?>
        </p>
    </div>
</div>
<?php } ?>
