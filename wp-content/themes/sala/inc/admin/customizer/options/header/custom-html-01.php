<?php

$priority = 1;
$section  = 'header_custom_html_01';

Sala_Kirki::add_section( $section, array(
	'title'    => esc_html__( 'Custom HTML 01', 'sala' ),
	'panel'    => $panel,
	'priority' => $priority++,
));

Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => $section,
	'label'    => esc_html__( 'Custom HTML 01', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'editor',
    'settings'  => 'header_custom_html_01_content',
    'label'     => esc_html__('Content', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'default'   => esc_html__('Custom HTML Content 01', 'sala'),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'color-alpha',
    'settings'  => 'header_custom_html_01_color',
    'label'     => esc_html__('Text Color', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => '',
    'output'    => array(
        array(
            'element'  => '.header-custom-html-01',
            'property' => 'color',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'color-alpha',
    'settings'  => 'header_custom_html_01_bg_color',
    'label'     => esc_html__('Background Color', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => '',
    'output'    => array(
        array(
            'element'  => '.header-custom-html-01',
            'property' => 'background',
        ),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'spacing',
    'settings'  => 'header_custom_html_01_padding',
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
            'element'  => '.header-custom-html-01',
            'property' => 'padding',
        ),
    ),
]);

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => 'header_custom_html_01_typography',
	'label'       => esc_html__( 'Typography', 'sala' ),
	'description' => esc_html__( 'Controls the typography for text.', 'sala' ),
	'section'     => $section,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'font-size'      => '16px',
		'line-height'    => '1.75',
		'variant'        => '400',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output'      => array(
		array(
			'element' => '.header-custom-html-01',
		),
	),
) );
