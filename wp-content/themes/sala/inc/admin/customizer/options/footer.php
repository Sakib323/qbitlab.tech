<?php

$priority = 1;
$section  = 'footer';
$prefix   = 'footer_';

// Footer
Sala_Kirki::add_section( $section, array(
	'title'    => esc_html__( 'Footer', 'sala' ),
	'priority' => $priority++,
) );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => $prefix . 'notice',
	'label'    => esc_html__( 'Footer Customize', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
] );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'select',
	'settings' => $prefix . 'type',
	'label'    => esc_html__( 'Footer Type', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => $default[$prefix . 'type'],
	'choices'  => Sala_Customize::sala_get_footers(),
] );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'copyright_enable',
	'label'       => esc_html__( 'Display Copyright', 'sala' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Hide', 'sala' ),
		'1' => esc_html__( 'Show', 'sala' ),
	),
) );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'text',
	'settings' => $prefix . 'copyright_text',
	'label'    => esc_html__( 'Copyright', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => $default[$prefix . 'copyright_text'],
] );
