<?php

$priority = 1;
$section  = 'header_canvas_mb_menu';

Sala_Kirki::add_section($section, array(
    'title'    => esc_html__('Canvas Mobile Menu', 'sala'),
    'panel'    => $panel,
    'priority' => $priority++,
));

Sala_Kirki::add_field('theme', [
    'type'     => 'notice',
    'settings' => 'canvas_mb_menu',
    'label'    => esc_html__('Canvas Mobile Menu', 'sala'),
    'section'  => $section,
    'priority' => $priority++,
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'canvas_mb_menu_sidebar_skin',
    'label'    => esc_html__('Sidebar Skin', 'sala'),
    'section'  => $section,
    'priority' => $priority++,
    'default'  => 'skin-light',
    'choices'  => array(
        'skin-light' => esc_attr__('Light', 'sala'),
        'skin-dark'  => esc_attr__('Dark', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'radio-buttonset',
    'settings'  => 'canvas_mb_menu_sidebar_position',
    'label'     => esc_html__('Sidebar Position', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 'canvas-left',
    'choices'   => array(
        'canvas-left'   => esc_attr__('Left', 'sala'),
        'canvas-center' => esc_attr__('Center', 'sala'),
        'canvas-right'  => esc_attr__('Right', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'color-alpha',
    'settings'  => 'canvas_mb_menu_overlay_color',
    'label'     => esc_html__('Overlay', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => 'rgba( 0, 0, 0, 0.8)',
    'output'    => array(
        array(
            'element'  => 'header.site-header .ux-element.canvas-mb-menu .bg-overlay',
            'property' => 'background-color',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'radio-buttonset',
    'settings'  => 'canvas_mb_menu_tab_style',
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
    'settings'        => 'canvas_mb_menu_color',
    'label'           => esc_html__('Color', 'sala'),
    'section'         => $section,
    'priority'        => $priority++,
    'transport'       => 'auto',
    'default'         => '#1a1a1a',
    'active_callback' => [
        [
            'setting'  => 'canvas_mb_menu_tab_style',
            'operator' => '==',
            'value'    => 'normal',
        ]
    ],
    'output'          => array(
        array(
            'element'  => '.ux-element.canvas-mb-menu .icon-menu',
            'property' => 'color',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'            => 'color-alpha',
    'settings'        => 'canvas_mb_menu_background_color',
    'label'           => esc_html__('Background', 'sala'),
    'section'         => $section,
    'priority'        => $priority++,
    'transport'       => 'auto',
    'default'         => '',
    'active_callback' => [
        [
            'setting'  => 'canvas_mb_menu_tab_style',
            'operator' => '==',
            'value'    => 'normal',
        ]
    ],
    'output'          => array(
        array(
            'element'  => '.ux-element.canvas-mb-menu .icon-menu',
            'property' => 'background-color',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'            => 'color-alpha',
    'settings'        => 'canvas_mb_menu_hover_color',
    'label'           => esc_html__('Color', 'sala'),
    'section'         => $section,
    'priority'        => $priority++,
    'transport'       => 'auto',
    'default'         => '',
    'active_callback' => [
        [
            'setting'  => 'canvas_mb_menu_tab_style',
            'operator' => '==',
            'value'    => 'hover',
        ]
    ],
    'output'          => array(
        array(
            'element'  => '.ux-element.canvas-mb-menu .icon-menu:hover',
            'property' => 'color',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'            => 'color-alpha',
    'settings'        => 'canvas_mb_menu_hover_background_color',
    'label'           => esc_html__('Background', 'sala'),
    'section'         => $section,
    'priority'        => $priority++,
    'transport'       => 'auto',
    'default'         => '',
    'active_callback' => [
        [
            'setting'  => 'canvas_mb_menu_tab_style',
            'operator' => '==',
            'value'    => 'hover',
        ]
    ],
    'output'          => array(
        array(
            'element'  => '.ux-element.canvas-mb-menu .icon-menu:hover',
            'property' => 'background-color',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'radio-buttonset',
    'settings'  => 'canvas_mb_menu_border',
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
            'element'  => '.ux-element.canvas-mb-menu .icon-menu',
            'property' => 'border-style',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'slider',
    'settings'  => 'canvas_mb_menu_border_width',
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
            'element'  => '.ux-element.canvas-mb-menu .icon-menu',
            'property' => 'border-width',
            'units'    => 'px',
        ),
    ),
    'active_callback' => [
        [
            'setting'  => 'canvas_mb_menu_border',
            'operator' => '!==',
            'value'    => 'none',
        ]
    ],
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'color-alpha',
    'settings'  => 'canvas_mb_menu_border_color',
    'label'     => esc_html__('Border Color', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => '#e19859',
    'output'    => array(
        array(
            'element'  => '.ux-element.canvas-mb-menu .icon-menu',
            'property' => 'border-color',
        ),
    ),
    'active_callback' => [
        [
            'setting'  => 'canvas_mb_menu_border',
            'operator' => '!==',
            'value'    => 'none',
        ]
    ],
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'spacing',
    'settings'  => 'canvas_mb_menu_padding',
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
            'element'  => '.ux-element.canvas-mb-menu .icon-menu',
            'property' => 'padding',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'notice',
    'settings' => 'canvas_mb_menu_responsive',
    'label'    => esc_html__('Responsive', 'sala'),
    'section'  => $section,
    'priority' => $priority++,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'toggle',
    'settings'  => 'canvas_mb_menu_desktop_hidden',
    'label'     => esc_html__('Hide On Desktop', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 1,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'toggle',
    'settings'  => 'canvas_mb_menu_tablet_hidden',
    'label'     => esc_html__('Hide On Tablet', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 0,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'toggle',
    'settings'  => 'canvas_mb_menu_mobile_hidden',
    'label'     => esc_html__('Hide On Mobile', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 0,
]);
