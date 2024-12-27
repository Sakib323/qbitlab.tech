<?php

$priority = 1;
$section  = 'io';

// IO Control
Sala_Kirki::add_section( $section, array(
	'title'    => esc_html__( 'Import / Export', 'sala' ),
	'priority' => 9999,
) );

Sala_Kirki::add_field( 'theme', [
	'type'        => 'custom',
	'settings'    => 'import_control',
	'label'       => esc_html__( 'Import', 'sala' ),
	'description' => esc_html__( 'Click the button below to import the customization settings for this theme.', 'sala' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '<div class="import-control io-control"><button name="Import" id="sala-customizer-import" class="button-primary button">' . __( 'Import', 'sala' ) . '</button><input type="file" id="import-file" name="import-file" style="display:none;"/></div>',
] );

Sala_Kirki::add_field( 'theme', [
	'type'        => 'custom',
	'settings'    => 'export_control',
	'label'       => esc_html__( 'Export', 'sala' ),
	'description' => esc_html__( 'Click the button below to export the customization settings for this theme.', 'sala' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '<div class="export-control io-control"><a href="' . get_site_url() . '/wp-admin/options.php?page=sala_export_customizer_options" id="sala-customizer-export" class="button-primary button">' . __( 'Export', 'sala' ) . '</a></div>',
] );

if ( WP_DEBUG ) {
    Sala_Kirki::add_field('theme', [
		'type'        => 'custom',
		'settings'    => 'export_demo_control',
		'label'       => esc_html__('Export for Demo', 'sala'),
		'description' => esc_html__('Click the button below to export the customization settings for this theme.', 'sala'),
		'section'     => $section,
		'priority'    => $priority++,
		'default'     => '<div class="export-control io-control"><form action=""><input type="submit" class="button-primary button" name="export" value="' . __('Export', 'sala') . '"/></form></div>',
	]);
}

Sala_Kirki::add_field( 'theme', array(
    'type'        => 'custom',
    'settings'    => 'reset_control',
    'label'       => esc_html__( 'Reset', 'sala' ),
    'description' => esc_html__( 'Click the button below to reset the customization settings for this theme.', 'sala' ),
    'section'     => $section,
    'priority'    => $priority++,
    'default'     => '<div class="reset-control io-control"><button name="Reset" id="sala-customizer-reset" class="button-primary button">' . __( 'Reset Options', 'sala' ) . '</button></div>',
) );
