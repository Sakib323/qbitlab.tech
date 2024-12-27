<?php

$priority = 1;
$section  = 'header_button_01';

Sala_Kirki::add_section($section, array(
    'title'    => esc_html__('Button 01', 'sala'),
    'panel'    => $panel,
    'priority' => $priority++,
));

Sala_Kirki::add_field('theme', [
    'type'     => 'notice',
    'settings' => $section,
    'label'    => esc_html__('Button 01', 'sala'),
    'section'  => $section,
    'priority' => $priority++,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'text',
    'settings'  => 'header_button_01_text',
    'label'     => esc_html__('Text', 'sala'),
    'help'      => esc_html__('if logo image is removed, site title text (in h1 tag) will be displayed.', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => esc_attr__('Buy Now', 'sala'),
]);

Sala_Kirki::add_field('theme', [
    'type'            => 'link',
    'settings'        => 'header_button_01_link',
    'label'           => esc_html__('Link', 'sala'),
    'section'         => $section,
    'priority'        => $priority++,
    'transport'       => 'postMessage',
    'default'         => '',
]);

Sala_Kirki::add_field('theme', [
    'type'            => 'checkbox',
    'settings'        => 'header_button_01_blank',
    'label'           => esc_html__('Open in new window', 'sala'),
    'section'         => $section,
    'priority'        => $priority++,
    'default'         => '',
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'radio-buttonset',
    'settings'  => 'header_button_01_tab_style',
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
    'settings'        => 'header_button_01_color',
    'label'           => esc_html__('Text Color', 'sala'),
    'section'         => $section,
    'priority'        => $priority++,
    'transport'       => 'auto',
    'default'         => '#fff',
    'active_callback' => [
        [
            'setting'  => 'header_button_01_tab_style',
            'operator' => '==',
            'value'    => 'normal',
        ]
    ],
    'output'          => array(
        array(
            'element'  => 'header.site-header .header-button-01 a.sala-button',
            'property' => 'color',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'            => 'color-alpha',
    'settings'        => 'header_button_01_background_color',
    'label'           => esc_html__('Background Color', 'sala'),
    'section'         => $section,
    'priority'        => $priority++,
    'transport'       => 'auto',
    'default'         => '#0057FC',
    'active_callback' => [
        [
            'setting'  => 'header_button_01_tab_style',
            'operator' => '==',
            'value'    => 'normal',
        ]
    ],
    'output'          => array(
        array(
            'element'  => 'header.site-header .header-button-01 a.sala-button',
            'property' => 'background-color',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'            => 'color-alpha',
    'settings'        => 'header_button_01_hover_color',
    'label'           => esc_html__('Text Color', 'sala'),
    'section'         => $section,
    'priority'        => $priority++,
    'default'         => '',
    'active_callback' => [
        [
            'setting'  => 'header_button_01_tab_style',
            'operator' => '==',
            'value'    => 'hover',
        ]
    ],
    'output'    => array(
        array(
            'element'  => 'header.site-header .header-button-01 a:hover',
            'property' => 'color',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'            => 'color-alpha',
    'settings'        => 'header_button_01_hover_background_color',
    'label'           => esc_html__('Background Color', 'sala'),
    'section'         => $section,
    'priority'        => $priority++,
    'default'         => '#1043B2',
    'active_callback' => [
        [
            'setting'  => 'header_button_01_tab_style',
            'operator' => '==',
            'value'    => 'hover',
        ]
    ],
    'output'    => array(
        array(
            'element'  => 'header.site-header .header-button-01 a:hover',
            'property' => 'background-color',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'select',
    'settings' => 'header_button_01_icon',
    'label'    => esc_html__('Icon', 'sala'),
    'section'  => $section,
    'priority' => $priority++,
    'default'  => 'fal fa-concierge-bell',
    'choices'  => array(
        'none'                   => esc_attr__('None', 'sala'),
        'fal fa-concierge-bell'  => esc_attr__( 'Concierge Bell', 'sala' ),
        'fal fa-calendar-alt'    => esc_attr__( 'Calendar', 'sala' ),
        'fal fa-bed'             => esc_attr__( 'Bed', 'sala' ),
        'fal fa-island-tropical' => esc_attr__( 'Island', 'sala' ),
        'fal fa-map'             => esc_attr__( 'Map', 'sala' ),
        'fal fa-map-marked'      => esc_attr__( 'Map Marked', 'sala' ),
        'fal fa-plane-departure' => esc_attr__( 'Plane', 'sala' ),
        'fal fa-suitcase'        => esc_attr__( 'Suitcase', 'sala' ),
        'fal fa-passport'        => esc_attr__( 'Passport', 'sala' ),
        'fal fa-hotel'           => esc_attr__( 'Hotel', 'sala' ),
        'fal fa-tree-palm'       => esc_attr__( 'Coconut', 'sala' ),
        'fal fa-umbrella-beach'  => esc_attr__( 'Beach', 'sala' ),
		'fal fa-edit'  			 => esc_attr__( 'Edit', 'sala' ),
		'fab fa-twitter'  		 => esc_attr__( 'Twitter', 'sala' ),
    )
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'radio-buttonset',
    'settings'  => 'header_button_01_icon_mb_show',
    'label'     => esc_html__('Show Icon On Desktop', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'default'   => 'false',
    'choices'   => array(
        'true' => esc_attr__('True', 'sala'),
        'false'  => esc_attr__('False', 'sala'),
    ),
    'active_callback' => [
        [
            'setting'  => 'header_button_01_icon',
            'operator' => '!==',
            'value'    => 'none',
        ]
    ],
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'radio-buttonset',
    'settings'  => 'header_button_01_icon_position',
    'label'     => esc_html__('Icon Position', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'default'   => 'before',
    'choices'   => array(
        'before' => esc_attr__('Before', 'sala'),
        'after'  => esc_attr__('After', 'sala'),
    ),
    'active_callback' => [
        [
            'setting'  => 'header_button_01_icon',
            'operator' => '!==',
            'value'    => 'none',
        ]
    ],
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'slider',
    'settings'  => 'header_button_01_radius',
    'label'     => esc_html__('Radius', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => 3,
    'choices'   => array(
        'min'  => 0,
        'max'  => 50,
        'step' => 1,
    ),
    'output'    => array(
        array(
            'element'  => 'header.site-header .header-button-01 a.sala-button',
            'property' => 'border-radius',
            'units'    => 'px',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'select',
    'settings'  => 'header_button_01_border',
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
            'element'  => 'header.site-header .header-button-01 a.sala-button',
            'property' => 'border-style',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'color-alpha',
    'settings'  => 'header_button_01_border_color',
    'label'     => esc_html__('Border Color', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => '#e19859',
    'output'    => array(
        array(
            'element'  => 'header.site-header .header-button-01 a.sala-button',
            'property' => 'border-color',
        ),
    ),
    'active_callback' => [
        [
            'setting'  => 'header_button_01_border',
            'operator' => '!==',
            'value'    => 'none',
        ]
    ],
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'slider',
    'settings'  => 'header_button_01_border_top',
    'label'     => esc_attr__('Border Top', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => 1,
    'choices'   => array(
        'min'  => 0,
        'max'  => 10,
        'step' => 1,
    ),
    'output'    => array(
        array(
            'element'  => 'header.site-header .header-button-01 a.sala-button',
            'property' => 'border-top-width',
            'units'    => 'px',
        ),
    ),
    'active_callback' => [
        [
            'setting'  => 'header_button_01_border',
            'operator' => '!==',
            'value'    => 'none',
        ]
    ],
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'slider',
    'settings'  => 'header_button_01_border_right',
    'label'     => esc_attr__('Border Right', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => 1,
    'choices'   => array(
        'min'  => 0,
        'max'  => 10,
        'step' => 1,
    ),
    'output'    => array(
        array(
            'element'  => 'header.site-header .header-button-01 a.sala-button',
            'property' => 'border-right-width',
            'units'    => 'px',
        ),
    ),
    'active_callback' => [
        [
            'setting'  => 'header_button_01_border',
            'operator' => '!==',
            'value'    => 'none',
        ]
    ],
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'slider',
    'settings'  => 'header_button_01_border_bottom',
    'label'     => esc_attr__('Border Bottom', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => 1,
    'choices'   => array(
        'min'  => 0,
        'max'  => 10,
        'step' => 1,
    ),
    'output'    => array(
        array(
            'element'  => 'header.site-header .header-button-01 a.sala-button',
            'property' => 'border-bottom-width',
            'units'    => 'px',
        ),
    ),
    'active_callback' => [
        [
            'setting'  => 'header_button_01_border',
            'operator' => '!==',
            'value'    => 'none',
        ]
    ],
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'slider',
    'settings'  => 'header_button_01_border_left',
    'label'     => esc_attr__('Border Left', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => 1,
    'choices'   => array(
        'min'  => 0,
        'max'  => 10,
        'step' => 1,
    ),
    'output'    => array(
        array(
            'element'  => 'header.site-header .header-button-01 a.sala-button',
            'property' => 'border-left-width',
            'units'    => 'px',
        ),
    ),
    'active_callback' => [
        [
            'setting'  => 'header_button_01_border',
            'operator' => '!==',
            'value'    => 'none',
        ]
    ],
]);

Sala_Kirki::add_field('theme', array(
    'type'     => 'radio-buttonset',
    'settings' => 'header_button_01_size',
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
    'settings' => 'header_button_01_align',
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

Sala_Kirki::add_field('theme', [
    'type'      => 'radio-buttonset',
    'settings'  => 'header_button_01_transform',
    'label'     => esc_html__('Align', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => 'none',
    'choices'   => array(
        'none'      => esc_attr__('Normal', 'sala'),
        'lowercase' => esc_attr__('Lowercase', 'sala'),
        'uppercase' => esc_attr__('Uppercase', 'sala'),
    ),
    'output'   => array(
        array(
            'element'  => 'header.site-header .header-button-01 a.sala-button',
            'property' => 'text-transform',
        ),
    ),
]);

Sala_Kirki::add_field('theme', array(
    'type'     => 'radio-buttonset',
    'settings' => 'header_button_01_width',
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
    'type'      => 'slider',
    'settings'  => 'header_button_01_width',
    'label'     => esc_html__('Max Width', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => 300,
    'choices'   => array(
        'min'  => 0,
        'max'  => 300,
        'step' => 1,
    ),
    'output'    => array(
        array(
            'element'  => 'header.site-header .header-button-01 a.sala-button',
            'property' => 'max-width',
            'units'    => 'px',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'spacing',
    'settings'  => 'header_button_01_padding',
    'label'     => esc_html__('Padding', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => array(
        'top'    => '11px',
        'right'  => '32px',
        'bottom' => '11px',
        'left'   => '32px',
    ),
    'output'    => array(
        array(
            'element'  => 'header.site-header .header-button-01 a.sala-button',
            'property' => 'padding',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'notice',
    'settings' => 'header_button_01_responsive',
    'label'    => esc_attr__('Responsive', 'sala'),
    'section'  => $section,
    'priority' => $priority++,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'toggle',
    'settings'  => 'header_button_01_desktop_hidden',
    'label'     => esc_html__('Hide On Desktop', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 0,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'toggle',
    'settings'  => 'header_button_01_tablet_hidden',
    'label'     => esc_html__('Hide On Tablet', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 0,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'toggle',
    'settings'  => 'header_button_01_mobile_hidden',
    'label'     => esc_html__('Hide On Mobile', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 0,
]);
