<?php
/**
 * Single Product Share
 *
 * Sharing plugins can hook into here or you can add your own code directly.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/share.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


do_action( 'woocommerce_share' ); // Sharing plugins can hook into here.

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */

?>

<div class="social-share">
    <div class="list-social-icon">
		<span><?php echo esc_html__( 'Share', 'sala' ); ?></span>
        <a class="facebook" onclick="window.open('https://www.facebook.com/sharer.php?u=<?php echo urlencode( get_permalink() ); ?>','sharer', 'toolbar=0,status=0');" href="javascript:void(0)">
			<i class="fab fa-facebook-f"></i>
        </a>

        <a class="twitter" onclick="popUp=window.open('https://twitter.com/share?url=<?php echo urlencode( get_permalink()); ?>','sharer','scrollbars=yes');popUp.focus();return false;" href="javascript:void(0)">
			<i class="fab fa-twitter"></i>
        </a>

        <a class="instagram" onclick="window.open('https://www.instagram.com/sharer.php?u=<?php echo urlencode( get_permalink() ); ?>','sharer', 'toolbar=0,status=0');" href="javascript:void(0)">
			<i class="fab fa-instagram"></i>
        </a>
    </div>
</div>
