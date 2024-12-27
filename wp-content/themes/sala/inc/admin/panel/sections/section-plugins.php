<?php
$sala_tgm_plugins       = apply_filters( 'sala_tgm_plugins', array() );
$installed_plugins      = class_exists( 'TGM_Plugin_Activation' ) ? TGM_Plugin_Activation::$instance->plugins : array();
$required_plugins_count = 0;
?>
<div class="section-sala section-plugins">
    <div class="entry-heading">
        <h4><?php esc_html_e('Plugins', 'sala'); ?></h4>
        <p><?php esc_html_e('Please install and activate plugins to use all functionality.', 'sala'); ?></p>
    </div>

    <div class="wrap-content">
        <?php if ( ! empty( $sala_tgm_plugins ) && class_exists( 'TGM_Plugin_Activation' ) ) : ?>
            <div class="list-item">
                <?php foreach ( $sala_tgm_plugins as $plugin ) : ?>
                    <?php
                    $plugin_obj = $installed_plugins[ $plugin['slug'] ];

                    $css_class = '';
                    if ( $plugin['required'] ) {
                        if ( class_exists( $plugin['slug'] ) ) {
                            $css_class .= 'plugin-activated';
                        } else {
                            $css_class .= 'plugin-deactivated';
                        }
                    }

                    $thumb = isset( $plugin['thumb'] ) ? esc_html( $plugin['thumb'] ) : SALA_THEME_URI . '/assets/images/placeholder.png';
                    $version = isset( $plugin['version'] ) ? sprintf( __( ' - %1$s', 'sala' ), '<span class="version">' . $plugin['version'] . '</span>' ) : '';
                    ?>
                    <div class="item <?php echo esc_attr($css_class); ?>">
                        <div class="entry-detail">
                            <?php if( $thumb ) : ?>
                            <div class="plugin-thumb">
                                <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_html( $plugin['name'] ); ?>">
                            </div>
                            <?php endif; ?>

                            <div class="plugin-name">
                                <div class="entry-name">
                                    <?php echo sprintf( __( '%1$s %2$s', 'sala' ), $plugin['name'], $version); ?>
                                </div>
                                <div class="plugin-type">
                                    <span><?php echo !empty($plugin['required']) ? esc_html__( '(Required)', 'sala' ) : esc_html__( '(Recommended)', 'sala' ); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="plugin-action">
                            <?php echo Sala_Panel::get_plugin_action( $plugin_obj ); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php else : ?>

            <p><?php esc_html_e( "This theme doesn't require any plugins.", 'sala' ); ?></p>

        <?php endif; ?>

    </div><!-- end .wrap-content -->
</div>
