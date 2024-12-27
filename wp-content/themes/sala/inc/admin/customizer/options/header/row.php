<?php

$priority = 1;
$section  = 'header_row';

Sala_Kirki::add_section( $section, array(
	'title'    => esc_html__( 'Row', 'sala' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => $section,
	'label'    => esc_html__( 'Row', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'select',
	'settings'  => 'hb_row_width',
	'label'     => esc_html__( 'Content Width', 'sala' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'postMessage',
	'default'   => 'boxed',
	'choices'   => [
		'fullwidth'       => esc_attr__('Fullwidth', 'sala'),
		'container'       => esc_attr__('Boxed', 'sala'),
		'container-fluid' => esc_attr__('Fluid', 'sala'),
	],
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'select',
	'settings'  => 'hb_row_horizontal_align',
	'label'     => esc_html__( 'Horizontal Align', 'sala' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'postMessage',
	'default'   => 'default',
	'choices'   => [
		'normal'        => esc_attr__('Default', 'sala'),
		'flex-start'    => esc_attr__('Start', 'sala'),
		'center'        => esc_attr__('Center', 'sala'),
		'flex-end'      => esc_attr__('End', 'sala'),
		'space-between' => esc_attr__('Space Between', 'sala'),
		'space-around'  => esc_attr__('Space Around', 'sala'),
		'space-evenly'  => esc_attr__('Space Evenly', 'sala'),
	],
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'color-alpha',
	'settings'  => 'hb_row_bg_color',
	'label'     => esc_html__( 'Background Color', 'sala' ),
	'section'   => $section,
	'transport' => 'postMessage',
	'default'   => '#ffffff',
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'color-alpha',
	'settings'  => 'hb_row_bg_color',
	'label'     => esc_html__( 'Background Color', 'sala' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'postMessage',
	'default'   => '#ffffff',
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'select',
	'settings'  => 'hb_row_border',
	'label'     => esc_html__( 'Border', 'sala' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'postMessage',
	'default'   => 'none',
	'choices'   => [
		'none'   => esc_attr__('None', 'sala'),
		'solid'  => esc_attr__('Solid', 'sala'),
		'double' => esc_attr__('Double', 'sala'),
		'dashed' => esc_attr__('Dashed', 'sala'),
		'groove' => esc_attr__('Groove', 'sala'),
	],
] );

Sala_Kirki::add_field( 'theme', [
	'type'            => 'color-alpha',
	'settings'        => 'hb_row_border_color',
	'label'           => esc_html__( 'Border Color', 'sala' ),
	'section'         => $section,
	'priority'        => $priority++,
	'transport'       => 'postMessage',
	'default'         => '#000',
	'active_callback' => [
		[
			'setting'  => 'hb_row_border',
			'operator' => '!==',
			'value'    => 'none',
		]
	],
] );

Sala_Kirki::add_field('theme', [
    'type'      => 'spacing',
    'settings'  => 'hb_row_border_width',
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
            'setting'  => 'hb_row_border',
            'operator' => '!==',
            'value'    => 'none',
        ]
    ],
]);

Sala_Kirki::add_field( 'theme', [
	'type'      => 'slider',
	'settings'  => 'hb_row_padding_top',
	'label'     => esc_html__( 'Padding Top', 'sala' ),
	'section'   => $section,
    'priority'  => $priority++,
	'transport' => 'postMessage',
	'default'   => 0,
	'choices'   => [
		'min'  => 0,
		'max'  => 300,
		'step' => 1,
	],
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'slider',
	'settings'  => 'hb_row_padding_bottom',
	'label'     => esc_html__( 'Padding Bottom', 'sala' ),
	'section'   => $section,
    'priority'  => $priority++,
	'transport' => 'postMessage',
	'default'   => 0,
	'choices'   => [
		'min'  => 0,
		'max'  => 300,
		'step' => 1,
	],
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'slider',
	'settings'  => 'hb_row_padding_left',
	'label'     => esc_html__( 'Padding Left', 'sala' ),
	'section'   => $section,
    'priority'  => $priority++,
	'transport' => 'postMessage',
	'default'   => 0,
	'choices'   => [
		'min'  => 0,
		'max'  => 300,
		'step' => 1,
	],
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'slider',
	'settings'  => 'hb_row_padding_right',
	'label'     => esc_html__( 'Padding Right', 'sala' ),
	'section'   => $section,
    'priority'  => $priority++,
	'transport' => 'postMessage',
	'default'   => 0,
	'choices'   => [
		'min'  => 0,
		'max'  => 300,
		'step' => 1,
	],
] );
