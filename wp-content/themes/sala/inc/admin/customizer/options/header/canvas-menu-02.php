<?php

$priority = 1;
$section  = 'header_canvas_menu_02';

Sala_Kirki::add_section($section, array(
    'title'    => esc_html__('Canvas Menu 02', 'sala'),
    'panel'    => $panel,
    'priority' => $priority++,
));

Sala_Kirki::add_field('theme', [
    'type'     => 'notice',
    'settings' => 'canvas_menu_02',
    'label'    => esc_html__('Canvas Menu 02', 'sala'),
    'section'  => $section,
    'priority' => $priority++,
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'canvas_menu_02_sidebar_skin',
    'label'    => esc_html__('Sidebar Skin', 'sala'),
    'section'  => $section,
    'priority' => $priority++,
    'default'  => 'skin-default',
    'choices'  => array(
        'skin-default' => esc_attr__('Default', 'sala'),
        'skin-light'   => esc_attr__('Light', 'sala'),
        'skin-dark'    => esc_attr__('Dark', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'radio-buttonset',
    'settings'  => 'canvas_menu_02_sidebar_position',
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
    'settings'  => 'canvas_menu_02_overlay_color',
    'label'     => esc_html__('Overlay', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => 'rgba( 0, 0, 0, 0.8)',
    'output'    => array(
        array(
            'element'  => 'header.site-header .ux-element.canvas-menu .bg-overlay',
            'property' => 'background-color',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'radio-buttonset',
    'settings'  => 'canvas_menu_02_tab_style',
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
    'settings'        => 'canvas_menu_02_color',
    'label'           => esc_html__('Color', 'sala'),
    'section'         => $section,
    'priority'        => $priority++,
    'transport'       => 'auto',
    'default'         => '#1a1a1a',
    'active_callback' => [
        [
            'setting'  => 'canvas_menu_02_tab_style',
            'operator' => '==',
            'value'    => 'normal',
        ]
    ],
    'output'          => array(
        array(
            'element'  => '.ux-element.canvas-menu .icon-menu circle',
            'property' => 'fill',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'            => 'color-alpha',
    'settings'        => 'canvas_menu_02_background_color',
    'label'           => esc_html__('Background', 'sala'),
    'section'         => $section,
    'priority'        => $priority++,
    'transport'       => 'auto',
    'default'         => '',
    'active_callback' => [
        [
            'setting'  => 'canvas_menu_02_tab_style',
            'operator' => '==',
            'value'    => 'normal',
        ]
    ],
    'output'          => array(
        array(
            'element'  => '.ux-element.canvas-menu .icon-menu',
            'property' => 'background-color',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'            => 'color-alpha',
    'settings'        => 'canvas_menu_02_hover_color',
    'label'           => esc_html__('Color', 'sala'),
    'section'         => $section,
    'priority'        => $priority++,
    'transport'       => 'auto',
    'default'         => '',
    'active_callback' => [
        [
            'setting'  => 'canvas_menu_02_tab_style',
            'operator' => '==',
            'value'    => 'hover',
        ]
    ],
    'output'          => array(
        array(
            'element'  => '.ux-element.canvas-menu .icon-menu:hover circle',
            'property' => 'fill',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'            => 'color-alpha',
    'settings'        => 'canvas_menu_02_hover_background_color',
    'label'           => esc_html__('Background', 'sala'),
    'section'         => $section,
    'priority'        => $priority++,
    'transport'       => 'auto',
    'default'         => '',
    'active_callback' => [
        [
            'setting'  => 'canvas_menu_02_tab_style',
            'operator' => '==',
            'value'    => 'hover',
        ]
    ],
    'output'          => array(
        array(
            'element'  => '.ux-element.canvas-menu .icon-menu:hover',
            'property' => 'background-color',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'radio-buttonset',
    'settings'  => 'canvas_menu_02_border',
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
            'element'  => '.ux-element.canvas-menu .icon-menu',
            'property' => 'border-style',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'slider',
    'settings'  => 'canvas_menu_02_border_width',
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
            'element'  => '.ux-element.canvas-menu .icon-menu',
            'property' => 'border-width',
            'units'    => 'px',
        ),
    ),
    'active_callback' => [
        [
            'setting'  => 'canvas_menu_02_border',
            'operator' => '!==',
            'value'    => 'none',
        ]
    ],
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'color-alpha',
    'settings'  => 'canvas_menu_02_border_color',
    'label'     => esc_html__('Border Color', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => '#e19859',
    'output'    => array(
        array(
            'element'  => '.ux-element.canvas-menu .icon-menu',
            'property' => 'border-color',
        ),
    ),
    'active_callback' => [
        [
            'setting'  => 'canvas_menu_02_border',
            'operator' => '!==',
            'value'    => 'none',
        ]
    ],
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'spacing',
    'settings'  => 'canvas_menu_02_padding',
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
            'element'  => '.ux-element.canvas-menu .icon-menu',
            'property' => 'padding',
        ),
    ),
]);

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'multicheck',
	'settings' => 'canvas_menu_02_social_enable',
	'label'    => esc_attr__( 'Socials', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => array( 'facebook', 'twitter', 'linkedin', 'tumblr' ),
	'choices'  => array(
		'facebook'    => esc_attr__( 'Facebook', 'sala' ),
		'twitter'     => esc_attr__( 'Twitter', 'sala' ),
		'linkedin'    => esc_attr__( 'Linkedin', 'sala' ),
		'instagram'   => esc_attr__( 'Instagram', 'sala' ),
		'tripadvisor' => esc_attr__( 'Tripadvisor', 'sala' ),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'sortable',
	'settings' => 'canvas_menu_02_social_order',
	'label'    => esc_attr__( 'Order', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => array(
		'facebook',
		'twitter',
		'linkedin',
		'instagram',
		'tripadvisor',
	),
	'choices'     => array(
		'facebook'    => esc_attr__( 'Facebook', 'sala' ),
		'twitter'     => esc_attr__( 'Twitter', 'sala' ),
		'linkedin'    => esc_attr__( 'Linkedin', 'sala' ),
		'instagram'   => esc_attr__( 'Instagram', 'sala' ),
		'tripadvisor' => esc_attr__( 'Tripadvisor', 'sala' ),
	),
) );

Sala_Kirki::add_field('theme', [
    'type'     => 'notice',
    'settings' => 'canvas_menu_02_responsive',
    'label'    => esc_html__('Responsive', 'sala'),
    'section'  => $section,
    'priority' => $priority++,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'toggle',
    'settings'  => 'canvas_menu_02_desktop_hidden',
    'label'     => esc_html__('Hide On Desktop', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 0,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'toggle',
    'settings'  => 'canvas_menu_02_tablet_hidden',
    'label'     => esc_html__('Hide On Tablet', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 0,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'toggle',
    'settings'  => 'canvas_menu_02_mobile_hidden',
    'label'     => esc_html__('Hide On Mobile', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 0,
]);
