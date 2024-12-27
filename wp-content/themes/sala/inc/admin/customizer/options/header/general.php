<?php

$priority = 1;
$section  = 'header_general';
$prefix   = 'header_';

Sala_Kirki::add_section( $section, array(
	'title'    => esc_html__( 'General', 'sala' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => $prefix . 'notice_general',
	'label'    => esc_html__( 'General', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
] );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => $prefix . 'type',
	'label'       => esc_html__( 'Header Style', 'sala' ),
	'description' => esc_html__( 'Select header style that displays on site.', 'sala' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => $default[$prefix . 'type'],
	'choices'     => Sala_Customize::sala_get_headers(false),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'top_bar_type',
	'label'       => esc_html__( 'Topbar Style', 'sala' ),
	'description' => esc_html__( 'Select top bar style that displays on site.', 'sala' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => Sala_Global::get_list_topbar(),
) );

Sala_Kirki::add_field('theme', [
    'type'            => 'color-alpha',
    'settings'        => 'header_background_color',
    'label'           => esc_html__('Background Color', 'sala'),
    'section'         => $section,
    'priority'        => $priority++,
    'transport'       => 'auto',
    'default'         => '',
    'output'          => array(
        array(
            'element'  => 'body #wrapper header.site-header',
            'property' => 'background-color',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'            => 'color-alpha',
    'settings'        => 'header_dark_background_color',
    'label'           => esc_html__('Darkmode Background Color', 'sala'),
    'section'         => $section,
    'priority'        => $priority++,
    'transport'       => 'auto',
    'default'         => '',
    'output'          => array(
        array(
            'element'  => 'body.sala-dark-scheme #wrapper header.site-header',
            'property' => 'background-color',
        ),
    ),
]);

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'overlay',
	'label'    => esc_html__( 'Header Overlay', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => $default[$prefix . 'overlay'],
	'choices'  => array(
		'0' => esc_attr__( 'No', 'sala' ),
		'1' => esc_attr__( 'Yes', 'sala' ),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'float',
	'label'    => esc_html__( 'Header Float', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => $default[$prefix . 'float'],
	'choices'  => array(
		'0' => esc_attr__( 'No', 'sala' ),
		'1' => esc_attr__( 'Yes', 'sala' ),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'skin',
	'label'    => esc_html__( 'Header Skin', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => $default[$prefix . 'skin'],
	'choices'  => array(
		'dark'  => esc_attr__( 'Dark', 'sala' ),
		'light' => esc_attr__( 'Light', 'sala' ),
	),
	'preset' => array(
		'dark' => array(
			'settings' => array(
				'header_device_color' => '#fff',
			),
		),
		'light' => array(
			'settings' => array(
				'header_device_color' => '#0d0909',
			),
		),
	),
) );
