<?php
/**
 * Sala Alert
 */

if ( isset( $_POST['purchase_code'] ) ) {
    $purchase_info = Sala_Panel::check_purchase_code( sanitize_key( $_POST['purchase_code'] ) );
    update_option( 'sala_purchase_code', $_POST['purchase_code'] );
}
$purchase_code = get_option( 'sala_purchase_code' );
$purchase_class = '';
$verified = '';
if( $purchase_code ) {
    $purchase_code_info = Sala_Panel::check_purchase_code( $purchase_code );
    if( $purchase_code_info['status_code'] === 200 ) {
        $purchase_class = 'verified hidden-code';
        $verified = 'verified';
    }
}
?>

<?php
$update      = Sala_Panel::check_theme_update();
$new_version = isset( $update['new_version'] ) ? $update['new_version'] : SALA_THEME_VERSION;
$get_info    = Sala_Panel::get_info();

if ( $update ) {
    ?>
    <div class="section-sala alert-wrap alert-success">
        <div class="msg-update">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><rect x="0" fill="none" width="24" height="24"></rect><g><path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm1 15h-2v-2h2v2zm0-4h-2l-.5-6h3l-.5 6z"></path></g></svg>
            <div class="inner-msg">
            <?php
            if ( Sala_Panel::check_valid_update() ) {
                printf( __( 'There is a new version of %1$s available. <a href="%2$s" %3$s>View version %4$s details</a> or <a href="%5$s" %6$s>update now</a>.',
                    'sala' ),
                    SALA_THEME_NAME,
                    esc_url( add_query_arg( 'action',
                        'sala_get_changelogs',
                        admin_url( 'admin-ajax.php' ) ) ),
                        sprintf( 'class="thickbox" name="Changelogs" aria-label="%s"',
                        esc_attr( sprintf( __( 'View %1$s version %2$s details', 'sala' ),
                            SALA_THEME_NAME,
                            SALA_THEME_VERSION ) ) ),
                    $new_version,
                    wp_nonce_url( self_admin_url( 'update.php?action=upgrade-theme&theme=' ) . SALA_THEME_SLUG,
                        'upgrade-theme_' . SALA_THEME_SLUG ),
                    sprintf( 'id="update-theme" aria-label="%s"',
                        esc_attr( sprintf( __( 'Update %s now', 'sala' ), SALA_THEME_NAME ) ) ) );
            } else {
                printf( __( 'There is a new version of %1$s available. <strong>Please enter your purchase code to update the theme.</strong>',
                    'sala' ),
                    SALA_THEME_NAME );
            }
            ?>
            </div>
        </div>
    </div>
    <?php
}