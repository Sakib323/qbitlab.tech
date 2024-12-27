<?php 

$priority = 1;
$section  = 'button';
$prefix   = 'button_';

$font_weights = array(
	'200',
	'200italic',
	'300',
	'300italic',
	'regular',
	'italic',
	'500',
	'500italic',
	'600',
	'600italic',
	'700',
	'700italic',
	'800',
	'800italic',
	'900',
	'900italic',
);

// Button
Sala_Kirki::add_section( $section, array(
	'title'    => esc_html__( 'Button', 'sala' ),
	'priority' => $priority++,
) );

// Content
Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => 'notice_button',
	'label'    => esc_html__( 'Button', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
] );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => $prefix . 'style',
	'label'       => esc_html__( 'Style', 'sala' ),
	'description' => esc_html__( 'Select default button that displays on site.', 'sala' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => $default[$prefix . 'style'],
	'choices'     => [
		'normal'      => esc_attr__('Normal', 'sala'),
		'full-filled' => esc_attr__('Full Filled', 'sala'),
	],
) );

Sala_Kirki::add_field( 'theme', array(
	'type'      => 'multicolor',
	'settings'  => $prefix . 'color',
	'label'     => esc_html__( 'Color', 'sala' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'normal' => esc_attr__( 'Normal', 'sala' ),
		'hover'  => esc_attr__( 'Hover', 'sala' ),
	),
	'default'     => array(
		'normal' => $default[$prefix . 'color'],
		'hover'  => $default[$prefix . 'hover_color'],
	),
	'output'      => array(
		array(
			'choice'   => 'normal',
			'element'  => '.sala-button',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '.sala-button:hover',
			'property' => 'color',
		),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'      => 'multicolor',
	'settings'  => $prefix . 'background_color',
	'label'     => esc_html__( 'Background Color', 'sala' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'normal' => esc_attr__( 'Normal', 'sala' ),
		'hover'  => esc_attr__( 'Hover', 'sala' ),
	),
	'default'     => array(
		'normal' => $default[$prefix . 'background_color'],
		'hover'  => $default[$prefix . 'hover_background_color'],
	),
	'output'      => array(
		array(
			'choice'   => 'normal',
			'element'  => '.sala-button',
			'property' => 'background-color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '.sala-button:hover',
			'property' => 'background-color',
		),
	),
) );

Sala_Kirki::add_field('theme', [
    'type'      => 'spacing',
    'settings'  => $prefix . 'padding',
    'label'     => esc_attr__('Padding', 'sala'),
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
            'element'  => '.sala-button',
            'property' => 'padding',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'slider',
    'settings'  => $prefix . 'radius',
    'label'     => esc_attr__('Radius', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => $default[$prefix . 'radius'],
    'choices'   => array(
        'min'  => 0,
        'max'  => 50,
        'step' => 1,
    ),
    'output'    => array(
        array(
            'element'  => '.sala-button',
            'property' => 'border-radius',
            'units'    => 'px',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'select',
    'settings'  => $prefix . 'border',
    'label'     => esc_attr__('Border', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => $default[$prefix . 'border'],
    'choices'   => [
        'none'   => esc_attr__('None', 'sala'),
        'solid'  => esc_attr__('Solid', 'sala'),
        'double' => esc_attr__('Double', 'sala'),
        'dashed' => esc_attr__('Dashed', 'sala'),
        'groove' => esc_attr__('Groove', 'sala'),
    ],
    'output'    => array(
        array(
            'element'  => '.sala-button',
            'property' => 'border-style',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'color-alpha',
    'settings'  => $prefix . 'border_color',
    'label'     => esc_attr__('Border Color', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => $default[$prefix . 'border_color'],
    'output'    => array(
        array(
            'element'  => '.sala-button',
            'property' => 'border-color',
        ),
    ),
    'active_callback' => [
        [
            'setting'  => $prefix . 'border',
            'operator' => '!==',
            'value'    => 'none',
        ]
    ],
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'spacing',
    'settings'  => $prefix . 'border_width',
    'label'     => esc_attr__('Border Width', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => array(
        'top'    => '1px',
        'right'  => '1px',
        'bottom' => '1px',
        'left'   => '1px',
    ),
	'output'          => array(
        array(
            'element'  => '.sala-button',
            'property' => 'border-width',
        ),
    ),
    'active_callback' => [
        [
            'setting'  => $prefix . 'border',
            'operator' => '!==',
            'value'    => 'none',
        ]
    ],
]);

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'typography',
	'label'       => esc_attr__( 'Font Settings', 'sala' ),
	'description' => esc_attr__( 'These settings control the typography for all button text.', 'sala' ),
	'section'     => $section,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => $default[$prefix . 'font_family'],
		'font-size'      => $default[$prefix . 'font_size'],
		'line-height'    => $default[$prefix . 'line_height'],
		'variant'        => $default[$prefix . 'variant'],
		'letter-spacing' => $default[$prefix . 'letter_spacing'],
		'text-transform' => $default[$prefix . 'text_transform'],
	),
	'choices'     => array(
		'variant' => $font_weights,
	),
	'output' => [
        [
            'element' => '.sala-button',
        ],
    ],
) );