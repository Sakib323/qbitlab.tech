<?php 
if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if (  Sala_Helper::setting( 'single_post_display_sharing' ) == 'hide' ) {
	return;
}

$social_sharing = Sala_Helper::setting( 'social_sharing_item_enable' );
if ( empty( $social_sharing ) ) {
	return;
}
?>
<div class="post-share">
	<div class="share-label">
		<?php esc_html_e( 'Share', 'sala' ); ?>
	</div>
	
	<div class="share-list">
		<?php Sala_Templates::get_sharing_list(); ?>
	</div>
</div>