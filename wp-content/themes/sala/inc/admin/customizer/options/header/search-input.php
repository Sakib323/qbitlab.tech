<?php

$priority = 1;
$section  = 'header_search_input';

Sala_Kirki::add_section( $section, array(
	'title'    => esc_html__( 'Search Input', 'sala' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => $section,
	'label'    => esc_html__( 'Search Input', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
] );

Sala_Kirki::add_field('theme', [
    'type'      => 'radio-buttonset',
    'settings'  => 'header_search_input_border',
    'label'     => esc_html__('Border', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => 'solid',
    'choices'   => array(
        'none'  => esc_attr__('None', 'sala'),
        'solid' => esc_attr__('Solid', 'sala'),
    ),
    'output'    => array(
        array(
            'element'  => '.ux-element.header-search-input .area-search',
            'property' => 'border-style',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'slider',
    'settings'  => 'header_search_input_border_width',
    'label'     => esc_html__('Border Width', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => 1,
    'choices'   => array(
        'min'  => 0,
        'max'  => 20,
        'step' => 1,
    ),
    'output'    => array(
        array(
            'element'  => '.ux-element.header-search-input .area-search',
            'property' => 'border-width',
            'units'    => 'px',
        ),
    ),
    'active_callback' => [
        [
            'setting'  => 'header_search_input_border',
            'operator' => '!==',
            'value'    => 'none',
        ]
    ],
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'color-alpha',
    'settings'  => 'header_search_input_border_color',
    'label'     => esc_html__('Border Color', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => '#666666',
    'output'    => array(
        array(
            'element'  => '.ux-element.header-search-input .area-search',
            'property' => 'border-color',
        ),
    ),
    'active_callback' => [
        [
            'setting'  => 'header_search_input_border',
            'operator' => '!==',
            'value'    => 'none',
        ]
    ],
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'color-alpha',
    'settings'  => 'header_search_input_field_background_color',
    'label'     => esc_html__('Background Color', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => '',
    'output'    => array(
        array(
            'element'  => '.ux-element.header-search-input .input-search',
            'property' => 'background-color',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'spacing',
    'settings'  => 'header_search_input_padding',
    'label'     => esc_html__('Padding', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => array(
        'top'    => '8px',
        'right'  => '50px',
        'bottom' => '8px',
        'left'   => '10px',
    ),
    'output'    => array(
        array(
            'element'  => '.ux-element.header-search-input .input-search',
            'property' => 'padding',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'slider',
    'settings'  => 'header_search_input_width',
    'label'     => esc_html__('Width', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => 70,
    'choices'   => array(
        'min'  => 0,
        'max'  => 100,
        'step' => 1,
    ),
    'output'    => array(
        array(
            'element'  => '.ux-element.header-search-input',
            'property' => 'width',
            'units'    => '%',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'slider',
    'settings'  => 'header_search_input_radius',
    'label'     => esc_attr__('Radius', 'sala'),
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
            'element'  => '.ux-element.header-search-input .input-search',
            'property' => 'border-radius',
            'units'    => 'px',
        ),
    ),
]);

Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => 'header_search_input_icon',
	'label'    => esc_html__( 'Icon', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
] );

Sala_Kirki::add_field('theme', [
    'type'      => 'slider',
    'settings'  => 'header_search_input_size',
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
            'element'  => '.ux-element.header-search-input .icon-search',
            'property' => 'font-size',
            'units'    => 'px',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'radio-buttonset',
    'settings'  => 'header_search_input_tab_style',
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
    'settings'        => 'header_search_input_color',
    'label'           => esc_html__('Color', 'sala'),
    'section'         => $section,
    'priority'        => $priority++,
    'transport'       => 'auto',
    'default'         => $default['accent_color'],
    'active_callback' => [
        [
            'setting'  => 'header_search_input_tab_style',
            'operator' => '==',
            'value'    => 'normal',
        ]
    ],
    'output'          => array(
        array(
            'element'  => '.ux-element.header-search-input .icon-search',
            'property' => 'color',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'            => 'color-alpha',
    'settings'        => 'header_search_input_background_color',
    'label'           => esc_html__('Background', 'sala'),
    'section'         => $section,
    'priority'        => $priority++,
    'transport'       => 'auto',
    'default'         => '',
    'active_callback' => [
        [
            'setting'  => 'header_search_input_tab_style',
            'operator' => '==',
            'value'    => 'normal',
        ]
    ],
    'output'          => array(
        array(
            'element'  => '.ux-element.header-search-input .icon-search',
            'property' => 'background-color',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'            => 'color-alpha',
    'settings'        => 'header_search_input_hover_color',
    'label'           => esc_html__('Color', 'sala'),
    'section'         => $section,
    'priority'        => $priority++,
    'transport'       => 'postMessage',
    'default'         => '',
    'active_callback' => [
        [
            'setting'  => 'header_search_input_tab_style',
            'operator' => '==',
            'value'    => 'hover',
        ]
    ],
    'output'          => array(
        array(
            'element'  => '.ux-element.header-search-input .icon-search:hover',
            'property' => 'color',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'            => 'color-alpha',
    'settings'        => 'header_search_input_hover_background_color',
    'label'           => esc_html__('Background', 'sala'),
    'section'         => $section,
    'priority'        => $priority++,
    'transport'       => 'postMessage',
    'default'         => '',
    'active_callback' => [
        [
            'setting'  => 'header_search_input_tab_style',
            'operator' => '==',
            'value'    => 'hover',
        ]
    ],
    'output'          => array(
        array(
            'element'  => '.ux-element.header-search-input .icon-search:hover',
            'property' => 'background-color',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'notice',
    'settings' => 'header_search_input_responsive',
    'label'    => esc_html__('Responsive', 'sala'),
    'section'  => $section,
    'priority' => $priority++,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'toggle',
    'settings'  => 'header_search_input_desktop_hidden',
    'label'     => esc_html__('Hide On Desktop', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 0,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'toggle',
    'settings'  => 'header_search_input_tablet_hidden',
    'label'     => esc_html__('Hide On Tablet', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 0,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'toggle',
    'settings'  => 'header_search_input_mobile_hidden',
    'label'     => esc_html__('Hide On Mobile', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 0,
]);
