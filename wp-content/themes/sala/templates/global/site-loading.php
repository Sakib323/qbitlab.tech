<?php
if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$type_loading_effect      = Sala_Helper::setting('type_loading_effect');
$animation_loading_effect = Sala_Helper::setting('animation_loading_effect');
$image_loading_effect     = Sala_Helper::setting('image_loading_effect');

$args = array('css-1'  => '<span class="sala-ldef-circle sala-ldef-loading"><span></span></span>','css-2'  => '<span class="sala-ldef-dual-ring sala-ldef-loading"></span>','css-3'=> '<span class="sala-ldef-facebook sala-ldef-loading"><span></span><span></span><span></span></span>','css-4'  => '<span class="sala-ldef-heart sala-ldef-loading"><span></span></span>','css-5'  => '<span class="sala-ldef-ring sala-ldef-loading"><span></span><span></span><span></span><span></span></span>','css-6'  => '<span class="sala-ldef-roller sala-ldef-loading"><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span></span>','css-7'  => '<span class="sala-ldef-default sala-ldef-loading"><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span></span>','css-8'  => '<span class="sala-ldef-ellipsis sala-ldef-loading"><span></span><span></span><span></span><span></span></span>','css-9'  => '<span class="sala-ldef-grid sala-ldef-loading"><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span></span>','css-10'  => '<span class="sala-ldef-hourglass sala-ldef-loading"></span>','css-11'  => '<span class="sala-ldef-ripple sala-ldef-loading"><span></span><span></span></span>','css-12'  => '<span class="sala-ldef-spinner sala-ldef-loading"><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span></span>');
?>

<?php if( $type_loading_effect !== 'none' ){ ?>
	<div id="page-preloader" class="page-loading-effect">
		<div class="bg-overlay"></div>

		<div class="page-loading-inner">
			<?php if( $type_loading_effect == 'css_animation' ) { ?>
				<?php echo wp_kses( $args[ $animation_loading_effect ], Sala_Helper::sala_kses_allowed_html() ); ?>
			<?php } ?>

			<?php if( $type_loading_effect == 'image' ) { ?>
				<img src="<?php echo esc_url( $image_loading_effect ); ?>" alt="<?php esc_attr_e('Image Effect','sala'); ?>">
			<?php } ?>
		</div>
	</div>
<?php } ?>
