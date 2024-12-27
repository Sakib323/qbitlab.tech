<?php
/* Add Header builder */
function sala_customizer_header_builder(){
	global $header_elements;
    ?>
		<div class="header-builder">
			<div class="hb-action">
				<a href="#"><?php esc_html_e('Click Here to Builder Header', 'sala'); ?></a>
			</div>

			<div class="hb-enabled">
				<div class="hb-control">
					<h3 class="left title"><?php esc_html_e('Header Builder', 'sala'); ?></h3>

					<div class="change-device center">
						<a class="enable-desktop active" data-device="desktop"><span class="dashicons dashicons-desktop"></span></a>
						<a class="enable-tablet" data-device="tablet"><span class="dashicons dashicons-tablet"></span></a>
						<a class="enable-mobile" data-device="mobile"><span class="dashicons dashicons-smartphone"></span></a>
					</div>

					<div class="right">
						<a class="button header-close-button"><?php esc_html_e('✕ Close', 'sala'); ?></a>
						<a class="button button-secondary header-preset-button" data-section="header-presets"><?php esc_html_e('Presets', 'sala'); ?></a>
						<a href="#" target="_blank" class="button"><?php esc_html_e('Tutorial', 'sala'); ?></a>
						<a class="button button-primary header-delete-button"><?php esc_html_e('Delete', 'sala'); ?></a>
						<a class="button button-primary header-save-button"><?php esc_html_e('Save', 'sala'); ?></a>
					</div>
				</div>
				<div class="hb-list hb-drop">
					<span class="row" data-id="row"><i class="dashicons dashicons-move"></i><?php esc_html_e('Row', 'sala'); ?></span>
					<span class="column" data-id="column"><i class="dashicons dashicons-move"></i><?php esc_html_e('Column', 'sala'); ?></span>
					<?php
					$header_elements = Sala_Customize::header_elements();
					foreach ($header_elements as $key => $value) {
						echo '<span class="element" data-id="' . $key . '"><i class="dashicons dashicons-move"></i>' . $value . '</span>';
					}
					?>
				</div>

				<div class="hb-list-content">
					<div class="row" data-id="row">
						<div class="column-wrap" data-col="100">
							<div class="hb-empty-column"><div class="inner"><i class="fal fa-plus"></i></div></div>
							<div class="builder-table-control"><span class="btn-control btn-edit"></span><span class="btn-control btn-delete"></span></div>
						</div>
					</div>
					<div class="column-wrap column-wrap column" data-id="column"><div class="hb-empty-column"><div class="inner"><i class="fal fa-plus"></i></div></div></div>

					<?php echo Sala_Templates::site_logo('dark'); ?>
					<?php echo Sala_Templates::main_menu(); ?>
					<?php echo Sala_Templates::landing_menu(); ?>
					<?php echo Sala_Templates::canvas_menu(); ?>
					<?php echo Sala_Templates::canvas_menu_02(); ?>
					<?php echo Sala_Templates::canvas_mb_menu(); ?>
					<?php echo Sala_Templates::header_device(); ?>
					<?php echo Sala_Templates::header_lang(); ?>
					<?php echo Sala_Templates::header_contact(); ?>
					<?php echo Sala_Templates::header_search_icon(); ?>
					<?php echo Sala_Templates::header_search_input(); ?>
					<?php echo Sala_Templates::header_account(); ?>
					<?php
						if ( class_exists( 'WooCommerce' ) ) {
							echo Sala_Templates::header_cart();
						}
					?>
					<?php echo Sala_Templates::header_button_01(); ?>
					<?php echo Sala_Templates::header_custom_html_01(); ?>
					<?php echo Sala_Templates::header_custom_html_02(); ?>
				</div>
			</div>
		</div>
    <?php
}
add_action('sala_before_header', 'sala_customizer_header_builder');
