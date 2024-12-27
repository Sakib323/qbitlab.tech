<?php

$section  = 'header_column';
$priority = 1;

Sala_Kirki::add_section( $section, array(
	'title'    => esc_html__( 'Column', 'sala' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => $section,
	'label'    => esc_html__( 'Column', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'select',
	'settings'  => 'hb_column_width',
	'label'     => esc_html__( 'Width', 'sala' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'postMessage',
	'default'   => '',
	'choices'   => [
		''     => esc_attr__('Default', 'sala'),
		'auto' => esc_attr__('Auto', 'sala'),
		'10'   => esc_attr__('10', 'sala'),
		'20'   => esc_attr__('20', 'sala'),
		'30'   => esc_attr__('30', 'sala'),
		'40'   => esc_attr__('40', 'sala'),
		'50'   => esc_attr__('50', 'sala'),
		'60'   => esc_attr__('60', 'sala'),
		'70'   => esc_attr__('70', 'sala'),
		'80'   => esc_attr__('80', 'sala'),
		'90'   => esc_attr__('90', 'sala'),
		'100'  => esc_attr__('100', 'sala'),
	],
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'select',
	'settings'  => 'hb_column_width_tablet',
	'label'     => esc_html__( 'Tablet Width', 'sala' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'postMessage',
	'default'   => '',
	'choices'   => [
		''     => esc_attr__('Default', 'sala'),
		'auto' => esc_attr__('Auto', 'sala'),
		'10'   => esc_attr__('10', 'sala'),
		'20'   => esc_attr__('20', 'sala'),
		'30'   => esc_attr__('30', 'sala'),
		'40'   => esc_attr__('40', 'sala'),
		'50'   => esc_attr__('50', 'sala'),
		'60'   => esc_attr__('60', 'sala'),
		'70'   => esc_attr__('70', 'sala'),
		'80'   => esc_attr__('80', 'sala'),
		'90'   => esc_attr__('90', 'sala'),
		'100'  => esc_attr__('100', 'sala'),
	],
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'select',
	'settings'  => 'hb_column_width_mobile',
	'label'     => esc_html__( 'Mobile Width', 'sala' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'postMessage',
	'default'   => '',
	'choices'   => [
		''     => esc_attr__('Default', 'sala'),
		'auto' => esc_attr__('Auto', 'sala'),
		'10'   => esc_attr__('10', 'sala'),
		'20'   => esc_attr__('20', 'sala'),
		'30'   => esc_attr__('30', 'sala'),
		'40'   => esc_attr__('40', 'sala'),
		'50'   => esc_attr__('50', 'sala'),
		'60'   => esc_attr__('60', 'sala'),
		'70'   => esc_attr__('70', 'sala'),
		'80'   => esc_attr__('80', 'sala'),
		'90'   => esc_attr__('90', 'sala'),
		'100'  => esc_attr__('100', 'sala'),
	],
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'select',
	'settings'  => 'hb_column_horizontal_align',
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
	'settings'  => 'hb_column_bg_color',
	'label'     => esc_html__( 'Background Color', 'sala' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'postMessage',
	'default'   => '#ffffff',
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'color-alpha',
	'settings'  => 'hb_column_bg_color',
	'label'     => esc_html__( 'Background Color', 'sala' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'postMessage',
	'default'   => '#ffffff',
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'select',
	'settings'  => 'hb_column_border',
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
	'settings'        => 'hb_column_border_color',
	'label'           => esc_html__( 'Border Color', 'sala' ),
	'section'         => $section,
	'priority'        => $priority++,
	'transport'       => 'postMessage',
	'default'         => '#000',
	'active_callback' => [
		[
			'setting'  => 'hb_column_border',
			'operator' => '!==',
			'value'    => 'none',
		]
	],
] );

Sala_Kirki::add_field('theme', [
    'type'      => 'spacing',
    'settings'  => 'hb_column_border_width',
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
            'setting'  => 'hb_column_border',
            'operator' => '!==',
            'value'    => 'none',
        ]
    ],
]);

Sala_Kirki::add_field( 'theme', [
	'type'      => 'slider',
	'settings'  => 'hb_column_padding_top',
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
	'settings'  => 'hb_column_padding_bottom',
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
	'settings'  => 'hb_column_padding_left',
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
	'settings'  => 'hb_column_padding_right',
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
