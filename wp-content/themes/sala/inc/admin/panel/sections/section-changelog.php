<div class="section-sala section-changelog">
    <div class="entry-heading">
        <h4><?php esc_html_e('Changelogs', 'sala'); ?></h4>
    </div>

    <div class="wrap-content">
        <table class="table-changelogs">
            <thead>
                <tr>
                    <th><?php esc_html_e('Version', 'sala'); ?></th>
                    <th><?php esc_html_e('Description', 'sala'); ?></th>
                    <th><?php esc_html_e('Date', 'sala'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php echo Sala_Panel::get_changelogs( true ); ?>
            </tbody>
        </table>
    </div><!-- end .wrap-content -->
</div>