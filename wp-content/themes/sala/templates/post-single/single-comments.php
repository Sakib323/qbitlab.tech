<?php 
    // If comments are open or we have at least one comment, load up the comment template.
    if ( ( comments_open() || get_comments_number() ) && Sala_Helper::setting('single_post_display_comments') ) {
        comments_template();
    }
?>