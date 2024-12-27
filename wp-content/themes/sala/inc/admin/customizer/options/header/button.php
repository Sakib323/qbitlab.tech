<?php

$priority = 1;
$section  = 'header_button';

Sala_Kirki::add_section($section, array(
    'title'    => esc_html__('Button', 'sala'),
    'panel'    => $panel,
    'priority' => $priority++,
));

Sala_Kirki::add_field('theme', [
    'type'     => 'notice',
    'settings' => $section,
    'label'    => esc_html__('Button', 'sala'),
    'section'  => $section,
    'priority' => $priority++,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'text',
    'settings'  => 'header_button_text',
    'label'     => esc_html__('Text', 'sala'),
    'help'      => esc_html__('if logo image is removed, site title text (in h1 tag) will be displayed.', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => esc_attr__('Book Now', 'sala'),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'link',
    'settings'  => 'header_button_link',
    'label'     => esc_html__('Link', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => '',
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'checkbox',
    'settings' => 'header_button_blank',
    'label'    => esc_html__('Open in new window', 'sala'),
    'section'  => $section,
    'priority' => $priority++,
    'default'  => '',
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'radio-buttonset',
    'settings'  => 'header_button_tab_style',
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
    'settings'        => 'header_button_color',
    'label'           => esc_html__('Text Color', 'sala'),
    'section'         => $section,
    'priority'        => $priority++,
    'transport'       => 'auto',
    'default'         => '#fff',
    'active_callback' => [
        [
            'setting'  => 'header_button_tab_style',
            'operator' => '==',
            'value'    => 'normal',
        ]
    ],
    'output'          => array(
        array(
            'element'  => '.header-button a',
            'property' => 'color',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'            => 'color-alpha',
    'settings'        => 'header_button_background_color',
    'label'           => esc_html__('Background Color', 'sala'),
    'section'         => $section,
    'priority'        => $priority++,
    'transport'       => 'auto',
    'default'         => '#e19859',
    'active_callback' => [
        [
            'setting'  => 'header_button_tab_style',
            'operator' => '==',
            'value'    => 'normal',
        ]
    ],
    'output'          => array(
        array(
            'element'  => '.header-button a',
            'property' => 'background-color',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'            => 'color-alpha',
    'settings'        => 'header_button_hover_color',
    'label'           => esc_html__('Text Color', 'sala'),
    'section'         => $section,
    'priority'        => $priority++,
    'default'         => '',
    'active_callback' => [
        [
            'setting'  => 'header_button_tab_style',
            'operator' => '==',
            'value'    => 'hover',
        ]
    ],
]);

Sala_Kirki::add_field('theme', [
    'type'            => 'color-alpha',
    'settings'        => 'header_button_hover_background_color',
    'label'           => esc_html__('Background Color', 'sala'),
    'section'         => $section,
    'priority'        => $priority++,
    'default'         => '',
    'active_callback' => [
        [
            'setting'  => 'header_button_tab_style',
            'operator' => '==',
            'value'    => 'hover',
        ]
    ],
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'slider',
    'settings'  => 'header_button_radius',
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
            'element'  => '.header-button a',
            'property' => 'border-radius',
            'units'    => 'px',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'select',
    'settings'  => 'header_button_border',
    'label'     => esc_html__('Border', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => 'none',
    'choices'   => [
        'none'   => esc_attr__('None', 'sala'),
        'solid'  => esc_attr__('Solid', 'sala'),
        'double' => esc_attr__('Double', 'sala'),
        'dashed' => esc_attr__('Dashed', 'sala'),
        'groove' => esc_attr__('Groove', 'sala'),
    ],
    'output'    => array(
        array(
            'element'  => '.header-button a',
            'property' => 'border-style',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'color-alpha',
    'settings'  => 'header_button_border_color',
    'label'     => esc_html__('Border Color', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => '#e19859',
    'output'    => array(
        array(
            'element'  => '.header-button a.sala-button',
            'property' => 'border-color',
        ),
    ),
    'active_callback' => [
        [
            'setting'  => 'header_button_border',
            'operator' => '!==',
            'value'    => 'none',
        ]
    ],
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'spacing',
    'settings'  => 'header_button_border_width',
    'label'     => esc_html__('Border Width', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => array(
        'top'    => '1px',
        'right'  => '1px',
        'bottom' => '1px',
        'left'   => '1px',
    ),
    'active_callback' => [
        [
            'setting'  => 'header_button_border',
            'operator' => '!==',
            'value'    => 'none',
        ]
    ],
]);

Sala_Kirki::add_field('theme', array(
    'type'     => 'radio-buttonset',
    'settings' => 'header_button_size',
    'label'    => esc_html__('Size', 'sala'),
    'section'  => $section,
    'priority' => $priority++,
    'default'  => 'm',
    'choices'  => array(
        'xs' => esc_attr__('XS', 'sala'),
        's'  => esc_attr__('S', 'sala'),
        'm'  => esc_attr__('M', 'sala'),
        'l'  => esc_attr__('L', 'sala'),
        'xl' => esc_attr__('XL', 'sala'),
    ),
));

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'header_button_align',
    'label'    => esc_html__('Align', 'sala'),
    'section'  => $section,
    'priority' => $priority++,
    'default'  => 'align-left',
    'choices'  => array(
        'align-left'    => esc_attr__('Left', 'sala'),
        'align-center'  => esc_attr__('Center', 'sala'),
        'align-right'   => esc_attr__('Right', 'sala'),
        'align-justify' => esc_attr__('Justify', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', array(
    'type'     => 'radio-buttonset',
    'settings' => 'header_button_width',
    'label'    => esc_html__('Width', 'sala'),
    'section'  => $section,
    'priority' => $priority++,
    'default'  => 'default',
    'choices'  => array(
        'default'   => esc_attr__('Default', 'sala'),
        'inline'    => esc_attr__('Inline', 'sala'),
        'fullwidth' => esc_attr__('Full Width', 'sala'),
    ),
));

Sala_Kirki::add_field('theme', [
    'type'     => 'notice',
    'settings' => 'header_button_responsive',
    'label'    => esc_attr__('Responsive', 'sala'),
    'section'  => $section,
    'priority' => $priority++,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'toggle',
    'settings'  => 'header_button_desktop_hidden',
    'label'     => esc_html__('Hide On Desktop', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 0,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'toggle',
    'settings'  => 'header_button_tablet_hidden',
    'label'     => esc_html__('Hide On Tablet', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 0,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'toggle',
    'settings'  => 'header_button_mobile_hidden',
    'label'     => esc_html__('Hide On Mobile', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 0,
]);
