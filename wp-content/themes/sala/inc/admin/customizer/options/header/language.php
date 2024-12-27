<?php

$priority = 1;
$section  = 'header_lang';

Sala_Kirki::add_section( $section, array(
    'title'    => esc_html__('Language', 'sala'),
    'panel'    => $panel,
    'priority' => $priority++,
));

Sala_Kirki::add_field('theme', [
    'type'     => 'notice',
    'settings' => $section,
    'label'    => esc_html__('Language', 'sala'),
    'section'  => $section,
    'priority' => $priority++,
]);

Sala_Kirki::add_field( 'theme', [
	'type'     => 'select',
	'settings' => 'header_lang_type',
	'label'    => esc_html__( 'Type', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'custom',
	'choices'  => [
		'custom'    => esc_attr__('Custom', 'sala'),
		'shortcode' => esc_attr__('Shortcode', 'sala'),
		'menu'      => esc_attr__('Language Menu', 'sala'),
	],
] );

Sala_Kirki::add_field('theme', array(
    'type'         => 'repeater',
    'settings'     => 'header_lang_option',
    'section'      => $section,
    'priority'     => $priority++,
    'button_label' => esc_attr__('Add New Language', 'sala'),
    'row_label'    => array(
        'type'  => 'field',
        'field' => 'label',
    ),
    'default'      => array(
        array(
            'label' => esc_attr__('En', 'sala'),
            'name'  => esc_attr__('en', 'sala'),
        ),
        array(
            'label' => esc_attr__('Fr', 'sala'),
            'name'  => esc_attr__('fr', 'sala'),
        ),
    ),
    'fields'       => array(
        'label' => array(
            'type'        => 'text',
            'label'       => esc_attr__('Label', 'sala'),
            'description' => esc_attr__('Enter your language label', 'sala'),
            'default'     => '',
        ),
        'name'  => array(
            'type'        => 'text',
            'label'       => esc_attr__('Code', 'sala'),
            'description' => esc_attr__('Enter your language code', 'sala'),
            'default'     => '',
        ),
    ),
    'active_callback' => [
		[
			'setting'  => 'header_lang_type',
			'operator' => '==',
			'value'    => 'custom',
		]
	],
));

Sala_Kirki::add_field('theme', [
    'type'            => 'text',
    'settings'        => 'header_lang_shortcode',
    'label'           => esc_html__('Shortcode', 'sala'),
    'section'         => $section,
    'priority'        => $priority++,
    'transport'       => 'auto',
    'active_callback' => [
		[
			'setting'  => 'header_lang_type',
			'operator' => '==',
			'value'    => 'shortcode',
		]
	],
]);

Sala_Kirki::add_field('theme', [
	'type'            => 'custom',
	'settings'        => 'custom_setting',
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => '<p style="margin:0;">' . __( 'Go to Appearance -> Menus and create a menu and choose display location as "Language Menu"', 'sala' ) . '</p>',
	'active_callback' => [
		[
			'setting'  => 'header_lang_type',
			'operator' => '==',
			'value'    => 'menu',
		]
	],
] );

Sala_Kirki::add_field('theme', [
    'type'      => 'radio-buttonset',
    'settings'  => 'header_lang_border',
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
            'element'  => '.ux-element.header-lang .inner-lang',
            'property' => 'border-style',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'slider',
    'settings'  => 'header_lang_border_width',
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
            'element'  => '.ux-element.header-lang .inner-lang',
            'property' => 'border-width',
            'units'    => 'px',
        ),
    ),
    'active_callback' => [
        [
            'setting'  => 'header_lang_border',
            'operator' => '!==',
            'value'    => 'none',
        ]
    ],
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'slider',
    'settings'  => 'header_lang_border_radius',
    'label'     => esc_html__('Border Radius', 'sala'),
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
            'element'  => '.ux-element.header-lang .inner-lang',
            'property' => 'border-radius',
            'units'    => 'px',
        ),
    ),
    'active_callback' => [
        [
            'setting'  => 'header_lang_border',
            'operator' => '!==',
            'value'    => 'none',
        ]
    ],
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'color-alpha',
    'settings'  => 'header_lang_border_color',
    'label'     => esc_html__('Border Color', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => '#e19859',
    'output'    => array(
        array(
            'element'  => '.ux-element.header-lang .inner-lang',
            'property' => 'border-color',
        ),
    ),
    'active_callback' => [
        [
            'setting'  => 'header_lang_border',
            'operator' => '!==',
            'value'    => 'none',
        ]
    ],
]);

Sala_Kirki::add_field('theme', array(
    'type'     => 'spacing',
    'settings' => 'header_lang_padding',
    'label'    => esc_html__('Padding', 'sala'),
    'section'  => $section,
    'priority' => $priority++,
    'default'  => [
        'top'    => '0px',
        'right'  => '0px',
        'bottom' => '0px',
        'left'   => '0px',
    ],
    'transport' => 'auto',
    'output'    => [
        [
            'element'  => '.ux-element.header-lang .inner-lang',
            'property' => 'padding',
        ],
    ],
));

Sala_Kirki::add_field('theme', [
    'type'     => 'notice',
    'settings' => 'header_lang_responsive',
    'label'    => esc_html__('Responsive', 'sala'),
    'section'  => $section,
    'priority' => $priority++,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'toggle',
    'settings'  => 'header_lang_desktop_hidden',
    'label'     => esc_html__('Hide On Desktop', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 0,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'toggle',
    'settings'  => 'header_lang_tablet_hidden',
    'label'     => esc_html__('Hide On Tablet', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 1,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'toggle',
    'settings'  => 'header_lang_mobile_hidden',
    'label'     => esc_html__('Hide On Mobile', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 1,
]);
