<div class="section-sala section-welcome">
    <div class="entry-heading">
        <div class="theme-logo"></div>

        <div class="inner-heading">
            <h3><?php esc_html_e( 'Welcome to Sala Theme', 'sala'); ?></h3>
            <p><?php esc_html_e("We've assembled some links to get you started", 'sala'); ?></p>
        </div>
    </div>

    <div class="wrap-column wrap-column-3 col-started">
        <div class="panel-column">
            <div class="entry-heading">
                <h4><?php esc_html_e('Get Started', 'sala'); ?></h4>
            </div>
            <div class="entry-detail">
                <a href="<?php echo esc_url(admin_url('admin.php?page=sala-setup')); ?>" class="button button-primary"><?php esc_html_e( 'Setup Wizard', 'sala' ); ?></a>
                <p class="info">
                    <span><?php esc_html_e('or,', 'sala') ?></span>
                    <a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>"><?php esc_html_e( 'Customize your site', 'sala' ); ?></a>
                </p>
            </div>
        </div>

        <div class="panel-column col-update">
            <div class="entry-heading">
                <h4>
                    <?php esc_html_e('Update', 'sala'); ?>
                </h4>
            </div>
            <div class="entry-detail">
                <div class="box-detail">
                    <span class="entry-title"><?php esc_html_e( 'Current Version', 'sala'); ?></span>
                    <p><?php echo esc_html(SALA_THEME_VERSION); ?></p>
                </div>
                <div class="box-detail">
                    <span class="entry-title">
                        <?php esc_html_e( 'Lastest Version', 'sala'); ?>

                        <?php
                        $update = Sala_Panel::check_theme_update();
                        $new_version = isset( $update['new_version'] ) ? $update['new_version'] : SALA_THEME_VERSION;

                        if ( Sala_Panel::check_valid_update() && $update ) {

                            printf( __( '<a class="button sala-update" href="%1$s" %2$s>Update now</a>', 'sala' ), wp_nonce_url( self_admin_url( 'update.php?action=upgrade-theme&theme=' ) . SALA_THEME_SLUG, 'upgrade-theme_' . SALA_THEME_SLUG ), sprintf( 'id="update-theme" aria-label="%s"', esc_attr( sprintf( __( 'Update %s now', 'sala' ), SALA_THEME_NAME ) ) ) );
                        }
                        ?>
                    </span>
                    <p><?php echo esc_html($new_version); ?></p>
                </div>
            </div>
        </div>

        <div class="panel-column col-support">
            <div class="entry-heading">
                <h4><?php esc_html_e('Support', 'sala'); ?></h4>
            </div>
            <div class="entry-detail">
                <div class="box-detail">
                    <a class="entry-title" href="<?php echo esc_attr($get_info['docs']); ?>" target="_blank"><?php esc_html_e( 'Online Documentation', 'sala'); ?></a>
                    <p><?php esc_html_e('Detailed instruction to get the right way with our theme.', 'sala'); ?></p>
                </div>
                <div class="box-detail">
                    <a class="entry-title" href="<?php echo esc_attr($get_info['support']); ?>" target="_blank"><?php esc_html_e( 'Request Support', 'sala'); ?></a>
                    <p><?php esc_html_e('Need help? Our users enjoy premium 24/7 support.', 'sala'); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
