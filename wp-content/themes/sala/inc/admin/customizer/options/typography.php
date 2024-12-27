<?php 

$priority = 1;
$section  = 'typography';
$prefix   = 'typography_';

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

// Typography
Sala_Kirki::add_section( $section, array(
	'title'    => esc_html__( 'Typography', 'sala' ),
	'priority' => $priority++,
) );

// Body Font
Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => $prefix . 'notice_body_font',
	'label'    => esc_html__( 'Body Font', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
] );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'body',
	'label'       => esc_html__( 'Font Settings', 'sala' ),
	'description' => esc_html__( 'These settings control the typography for all body text.', 'sala' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => $default['font-family'],
		'font-size'      => $default['font-size'],
		'variant'        => $default['variant'],
		'line-height'    => $default['line-height'],
		'letter-spacing' => $default['letter-spacing'],
	),
	'choices'     => array(
		'variant' => $font_weights,
	),
	'output'      => array(
		array(
			'element' => 'body',
		),
	),
) );

// Heading Font
Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => $prefix . 'notice_heading_font',
	'label'    => esc_html__( 'Heading Font', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
] );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'heading',
	'label'       => esc_html__( 'Font Settings', 'sala' ),
	'description' => esc_html__( 'These settings control the typography for all heading text.', 'sala' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => $default['heading-font-family'],
		'line-height'    => $default['heading-line-height'],
		'variant'        => $default['heading-variant'],
		'letter-spacing' => $default['heading-letter-spacing'],
	),
	'choices'     => array(
		'variant' => $font_weights,
	),
	'output' => [
        [
            'element' => 'h1,h2,h3,h4,h5,h6,.heading-font,strong',
        ],
    ],
) );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h1_font_size',
	'label'       => esc_html__( 'Font size', 'sala' ),
	'description' => esc_html__( 'H1', 'sala' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 64,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h1',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h2_font_size',
	'description' => esc_html__( 'H2', 'sala' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 48,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h2',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h3_font_size',
	'description' => esc_html__( 'H3', 'sala' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 36,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h3',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h4_font_size',
	'description' => esc_html__( 'H4', 'sala' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 28,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h4',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h5_font_size',
	'description' => esc_html__( 'H5', 'sala' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 22,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h5',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h6_font_size',
	'description' => esc_html__( 'H6', 'sala' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 18,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h6',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );