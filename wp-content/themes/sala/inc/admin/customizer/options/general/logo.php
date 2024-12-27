<?php

$section  = 'logo';
$prefix   = 'logo_';
$priority = 1;

// Logo
Sala_Kirki::add_section( $section, array(
	'title'    => esc_html__( 'Logo', 'sala' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Sala_Kirki::add_field('theme', array(
    'type'     => 'number',
    'settings' => $prefix . 'width',
    'label'    => esc_html__('Logo Width', 'sala'),
    'section'  => $section,
    'priority' => $priority++,
    'default'  => $default[$prefix . 'width'],
    'choices'  => [
		'min'  => 0,
		'max'  => 800,
		'step' => 1,
	],
    'output'    => array(
		array(
			'element'  => '.site-logo img',
			'property' => 'width',
			'units'    => 'px',
		),
	),
));

Sala_Kirki::add_field( 'theme', [
	'type'     => 'image',
	'settings' => $prefix . 'dark',
	'label'    => esc_html__( 'Logo Dark', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => $default[$prefix . 'dark'],
] );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'image',
	'settings' => $prefix . 'dark_retina',
	'label'    => esc_html__( 'Logo Dark Retina', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => $default[$prefix . 'dark_retina'],
] );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'image',
	'settings' => $prefix . 'light',
	'label'    => esc_html__( 'Logo Light', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => $default[$prefix . 'light'],
] );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'image',
	'settings' => $prefix . 'light_retina',
	'label'    => esc_html__( 'Logo Light Retina', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => $default[$prefix . 'light_retina'],
] );
