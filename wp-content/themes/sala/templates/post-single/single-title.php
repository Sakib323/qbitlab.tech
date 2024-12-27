<?php 
if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$single_post_display_title = Sala_Helper::setting('single_post_display_title');
if( $single_post_display_title == 'hide' ) {
	return;
}
?>
<div class="post-title">
    <h1 class="entry-title heading-font"><?php the_title(); ?></h1>
</div>