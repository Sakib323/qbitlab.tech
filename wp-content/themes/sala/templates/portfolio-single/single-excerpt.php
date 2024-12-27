<?php
if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if( get_the_excerpt() === '' ) {
	return;
}
?>
<div class="portfolio-excerpt">
	<p><?php echo get_the_excerpt(); ?></p>
</div>
