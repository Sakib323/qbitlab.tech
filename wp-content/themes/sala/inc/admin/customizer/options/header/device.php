<?php

$priority = 1;
$section  = 'header_device';

Sala_Kirki::add_section( $section, array(
	'title'    => esc_html__( 'Device', 'sala' ),
	'panel'    => $panel,
	'priority' => $priority++,
));

Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => $section,
	'label'    => esc_html__( 'Device', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'color-alpha',
    'settings'  => 'header_device_color',
    'label'     => esc_html__('Color', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => '#0d0909',
    'output'    => array(
        array(
            'element'  => '.ux-element.header-device>span',
            'property' => 'background',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'slider',
    'settings'  => 'header_device_width',
    'label'     => esc_html__('Width', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => 1,
    'choices'   => array(
        'min'  => 0,
        'max'  => 50,
        'step' => 1,
    ),
    'output'    => array(
        array(
            'element'  => '.ux-element.header-device>span',
            'property' => 'width',
            'units'    => 'px',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'slider',
    'settings'  => 'header_device_height',
    'label'     => esc_html__('Height', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => 30,
    'choices'   => array(
        'min'  => 0,
        'max'  => 200,
        'step' => 1,
    ),
    'output'    => array(
        array(
            'element'  => '.ux-element.header-device>span',
            'property' => 'height',
            'units'    => 'px',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'slider',
    'settings'  => 'header_device_radius',
    'label'     => esc_html__('Radius', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => 0,
    'choices'   => array(
        'min'  => 0,
        'max'  => 50,
        'step' => 1,
    ),
    'output'    => array(
        array(
            'element'  => '.ux-element.header-device>span',
            'property' => 'border-radius',
            'units'    => 'px',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'notice',
    'settings' => 'header_device_responsive',
    'label'    => esc_html__('Responsive', 'sala'),
    'section'  => $section,
    'priority' => $priority++,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'toggle',
    'settings'  => 'header_device_desktop_hidden',
    'label'     => esc_html__('Hide On Desktop', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 0,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'toggle',
    'settings'  => 'header_device_tablet_hidden',
    'label'     => esc_html__('Hide On Tablet', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 0,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'toggle',
    'settings'  => 'header_device_mobile_hidden',
    'label'     => esc_html__('Hide On Mobile', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 0,
]);
