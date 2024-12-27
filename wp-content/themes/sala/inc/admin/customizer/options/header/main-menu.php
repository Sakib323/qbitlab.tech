<?php

$priority = 1;
$section  = 'header_main_menu';

Sala_Kirki::add_section($section, array(
    'title'    => esc_html__('Main Menu', 'sala'),
    'panel'    => $panel,
    'priority' => $priority++,
));

Sala_Kirki::add_field('theme', [
    'type'     => 'notice',
    'settings' => 'main_menu',
    'label'    => esc_html__('Main Menu', 'sala'),
    'section'  => $section,
    'priority' => $priority++,
]);

Sala_Kirki::add_field( 'theme', [
	'type'      => 'slider',
	'settings'  => 'main_menu_font_size',
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
    'type'      => 'color-alpha',
    'settings'  => 'main_menu_color',
    'label'     => esc_html__('Color', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => '',
    'output'    => array(
        array(
            'element'  => 'header.site-header .main-menu.ux-element.desktop-menu .menu > li > a',
            'property' => 'color',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'color-alpha',
    'settings'  => 'darkmode_main_menu_color',
    'label'     => esc_html__('Darkmode Color', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => '',
    'output'    => array(
        array(
            'element'  => 'body.sala-dark-scheme header.site-header .main-menu.ux-element.desktop-menu .menu > li > a',
            'property' => 'color',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'color-alpha',
    'settings'  => 'main_menu_line_color',
    'label'     => esc_html__('Line Color', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => '',
    'output'    => array(
        array(
            'element'  => 'header.site-header .main-menu.ux-element.desktop-menu .menu > li > a .menu-item-wrap::after',
            'property' => 'border-color',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'color-alpha',
    'settings'  => 'darkmode_main_menu_line_color',
    'label'     => esc_html__('Darkmode Line Color', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => '',
    'output'    => array(
        array(
            'element'  => 'body.sala-dark-scheme header.site-header .main-menu.ux-element.desktop-menu .menu > li > a .menu-item-wrap::after',
            'property' => 'border-color',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'color-alpha',
    'settings'  => 'main_menu_submenu_background',
    'label'     => esc_html__('Submenu Background Color', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => '',
    'output'    => array(
        array(
            'element'  => 'header.site-header .main-menu.ux-element.desktop-menu .menu ul.sub-menu',
            'property' => 'background-color',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'color-alpha',
    'settings'  => 'darkmode_main_menu_submenu_background',
    'label'     => esc_html__('Darkmode Submenu Background Color', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => '',
    'output'    => array(
        array(
            'element'  => 'body.sala-dark-scheme header.site-header .main-menu.ux-element.desktop-menu .menu ul.sub-menu',
            'property' => 'background-color',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'color-alpha',
    'settings'  => 'main_menu_submenu_color',
    'label'     => esc_html__('Submenu Color', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => '',
    'output'    => array(
        array(
            'element'  => 'header.site-header .main-menu.ux-element.desktop-menu .menu ul.sub-menu li a',
            'property' => 'color',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'color-alpha',
    'settings'  => 'darkmode_main_menu_submenu_color',
    'label'     => esc_html__('Darkmode Submenu Color', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => '',
    'output'    => array(
        array(
            'element'  => 'body.sala-dark-scheme header.site-header .main-menu.ux-element.desktop-menu .menu ul.sub-menu li a',
            'property' => 'color',
        ),
    ),
]);


Sala_Kirki::add_field('theme', [
    'type'      => 'spacing',
    'settings'  => 'main_menu_item_padding',
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
    'settings' => 'main_menu_responsive',
    'label'    => esc_html__('Responsive', 'sala'),
    'section'  => $section,
    'priority' => $priority++,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'toggle',
    'settings'  => 'main_menu_desktop_hidden',
    'label'     => esc_html__('Hide On Desktop', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 0,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'toggle',
    'settings'  => 'main_menu_tablet_hidden',
    'label'     => esc_html__('Hide On Tablet', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 1,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'toggle',
    'settings'  => 'main_menu_mobile_hidden',
    'label'     => esc_html__('Hide On Mobile', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 1,
]);
