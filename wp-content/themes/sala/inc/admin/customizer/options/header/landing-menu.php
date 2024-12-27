<?php

$priority = 1;
$section  = 'header_landing_menu';

Sala_Kirki::add_section($section, array(
    'title'    => esc_html__('Landing Menu', 'sala'),
    'panel'    => $panel,
    'priority' => $priority++,
));

Sala_Kirki::add_field('theme', [
    'type'     => 'notice',
    'settings' => 'landing_menu',
    'label'    => esc_html__('Landing Menu', 'sala'),
    'section'  => $section,
    'priority' => $priority++,
]);

Sala_Kirki::add_field( 'theme', [
	'type'      => 'slider',
	'settings'  => 'landing_menu_font_size',
	'label'     => esc_html__( 'Font Size', 'sala' ),
	'section'   => $section,
    'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => '15',
	'choices'   => [
		'min'  => 10,
		'max'  => 60,
		'step' => 1,
	],
    'output'    => array(
        array(
            'element'  => '.ux-element.desktop-menu .menu>li>a',
            'property' => 'font-size',
            'units'    => 'px',
        ),
    ),
] );

Sala_Kirki::add_field('theme', [
    'type'      => 'spacing',
    'settings'  => 'landing_menu_item_padding',
    'label'     => esc_html__('Item Padding', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => array(
        'top'    => '20px',
        'right'  => '20px',
        'bottom' => '20px',
        'left'   => '20px',
    ),
    'output'    => array(
        array(
            'element'  => '.ux-element.desktop-menu .menu>li>a',
            'property' => 'padding',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'notice',
    'settings' => 'landing_menu_responsive',
    'label'    => esc_html__('Responsive', 'sala'),
    'section'  => $section,
    'priority' => $priority++,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'toggle',
    'settings'  => 'landing_menu_desktop_hidden',
    'label'     => esc_html__('Hide On Desktop', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 0,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'toggle',
    'settings'  => 'landing_menu_tablet_hidden',
    'label'     => esc_html__('Hide On Tablet', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 1,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'toggle',
    'settings'  => 'landing_menu_mobile_hidden',
    'label'     => esc_html__('Hide On Mobile', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 1,
]);
