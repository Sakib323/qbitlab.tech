<?php

$priority = 1;
$section  = 'header_search_icon';

Sala_Kirki::add_section( $section, array(
	'title'    => esc_html__( 'Search Icon', 'sala' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => $section,
	'label'    => esc_html__( 'Search Icon', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
] );

Sala_Kirki::add_field('theme', [
    'type'      => 'radio-buttonset',
    'settings'  => 'header_search_icon_tab_style',
    'label'     => esc_html__('Icon', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 'normal',
    'choices'   => array(
        'normal' => esc_attr__('Normal', 'sala'),
        'hover'  => esc_attr__('Hover', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'            => 'color-alpha',
    'settings'        => 'header_search_icon_color',
    'label'           => esc_html__('Color', 'sala'),
    'section'         => $section,
    'priority'        => $priority++,
    'transport'       => 'auto',
    'default'         => '#ffffff',
    'active_callback' => [
        [
            'setting'  => 'header_search_icon_tab_style',
            'operator' => '==',
            'value'    => 'normal',
        ]
    ],
    'output'          => array(
        array(
            'element'  => '.ux-element.header-search-icon .icon-search a',
            'property' => 'color',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'            => 'color-alpha',
    'settings'        => 'header_search_icon_background_color',
    'label'           => esc_html__('Background', 'sala'),
    'section'         => $section,
    'priority'        => $priority++,
    'transport'       => 'auto',
    'default'         => '',
    'active_callback' => [
        [
            'setting'  => 'header_search_icon_tab_style',
            'operator' => '==',
            'value'    => 'normal',
        ]
    ],
    'output'          => array(
        array(
            'element'  => '.ux-element.header-search-icon .icon-search a',
            'property' => 'background-color',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'            => 'color-alpha',
    'settings'        => 'header_search_icon_hover_color',
    'label'           => esc_html__('Color', 'sala'),
    'section'         => $section,
    'priority'        => $priority++,
    'transport'       => 'auto',
    'default'         => '',
    'active_callback' => [
        [
            'setting'  => 'header_search_icon_tab_style',
            'operator' => '==',
            'value'    => 'hover',
        ]
    ],
    'output'          => array(
        array(
            'element'  => '.ux-element.header-search-icon .icon-search a:hover',
            'property' => 'color',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'            => 'color-alpha',
    'settings'        => 'header_search_icon_hover_background_color',
    'label'           => esc_html__('Background', 'sala'),
    'section'         => $section,
    'priority'        => $priority++,
    'transport'       => 'postMessage',
    'default'         => '',
    'active_callback' => [
        [
            'setting'  => 'header_search_icon_tab_style',
            'operator' => '==',
            'value'    => 'hover',
        ]
    ],
    'output'          => array(
        array(
            'element'  => '.ux-element.header-search-icon .icon-search a:hover',
            'property' => 'background-color',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'slider',
    'settings'  => 'header_search_icon_size',
    'label'     => esc_html__('Size', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => 16,
    'choices'   => array(
        'min'  => 0,
        'max'  => 50,
        'step' => 1,
    ),
    'output'    => array(
        array(
            'element'  => '.ux-element.header-search-icon .icon-search a',
            'property' => 'font-size',
            'units'    => 'px',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'slider',
    'settings'  => 'header_search_icon_radius',
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
            'element'  => '.ux-element.header-search-icon .icon-search a',
            'property' => 'border-radius',
            'units'    => 'px',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'radio-buttonset',
    'settings'  => 'header_search_icon_border',
    'label'     => esc_html__('Border', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => 'none',
    'choices'   => array(
        'none'  => esc_attr__('None', 'sala'),
        'solid' => esc_attr__('Solid', 'sala'),
    ),
    'output'    => array(
        array(
            'element'  => '.ux-element.header-search-icon .icon-search a',
            'property' => 'border-style',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'slider',
    'settings'  => 'header_search_icon_border_width',
    'label'     => esc_html__('Border Width', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => 0,
    'choices'   => array(
        'min'  => 0,
        'max'  => 20,
        'step' => 1,
    ),
    'output'    => array(
        array(
            'element'  => '.ux-element.header-search-icon .icon-search a',
            'property' => 'border-width',
            'units'    => 'px',
        ),
    ),
    'active_callback' => [
        [
            'setting'  => 'header_search_icon_border',
            'operator' => '!==',
            'value'    => 'none',
        ]
    ],
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'color-alpha',
    'settings'  => 'header_search_icon_border_color',
    'label'     => esc_html__('Border Color', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => '#e19859',
    'output'    => array(
        array(
            'element'  => '.ux-element.header-search-icon .icon-search a',
            'property' => 'border-color',
        ),
    ),
    'active_callback' => [
        [
            'setting'  => 'header_search_icon_border',
            'operator' => '!==',
            'value'    => 'none',
        ]
    ],
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'spacing',
    'settings'  => 'header_search_icon_padding',
    'label'     => esc_html__('Padding', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => array(
        'top'    => '0px',
        'right'  => '0px',
        'bottom' => '0px',
        'left'   => '0px',
    ),
    'output'    => array(
        array(
            'element'  => '.ux-element.header-search-icon .icon-search a',
            'property' => 'padding',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'notice',
    'settings' => 'header_search_icon_responsive',
    'label'    => esc_attr__('Responsive', 'sala'),
    'section'  => $section,
    'priority' => $priority++,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'toggle',
    'settings'  => 'header_search_icon_desktop_hidden',
    'label'     => esc_html__('Hide On Desktop', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 0,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'toggle',
    'settings'  => 'header_search_icon_tablet_hidden',
    'label'     => esc_html__('Hide On Tablet', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 0,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'toggle',
    'settings'  => 'header_search_icon_mobile_hidden',
    'label'     => esc_html__('Hide On Mobile', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 0,
]);
