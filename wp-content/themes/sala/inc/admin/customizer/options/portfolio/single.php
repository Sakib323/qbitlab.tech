<?php

// Single portfolio
Sala_Kirki::add_section( 'single_portfolio', array(
	'title'    => esc_html__( 'Single Portfolio', 'sala' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => 'single_portfolio_customize',
	'label'    => esc_html__( 'Single Portfolio', 'sala' ),
	'section'  => 'single_portfolio',
	'priority' => $priority++,
] );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'select',
	'settings' => 'single_portfolio_layout',
	'label'    => esc_html__( 'Layout Style', 'sala' ),
	'section'  => 'single_portfolio',
	'priority' => $priority++,
	'default'  => $default['single_portfolio_layout'],
	'choices'  => [
		'01' => esc_attr__( '01', 'sala' ),
		'02' => esc_attr__( '02', 'sala' ),
		'03' => esc_attr__( '03', 'sala' ),
	],
] );

Sala_Kirki::add_field('theme', [
    'type'     => 'select',
    'settings' => 'single_portfolio_page_title_layout',
    'label'    => esc_html__( 'Page Title', 'sala' ),
    'section'  => 'single_portfolio',
    'priority' => $priority++,
    'default'  => $default['single_portfolio_page_title_layout'],
    'choices'  => Sala_Page_Title::get_list(true),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'single_portfolio_display_taxonomy',
    'label'    => esc_html__( 'Display Taxonomy', 'sala' ),
    'section'  => 'single_portfolio',
    'priority' => $priority++,
    'default'  => $default['single_portfolio_display_taxonomy'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'single_portfolio_display_title',
    'label'    => esc_html__( 'Display Portfolio Title', 'sala' ),
    'section'  => 'single_portfolio',
    'priority' => $priority++,
    'default'  => $default['single_portfolio_display_title'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'single_portfolio_display_meta',
    'label'    => esc_html__( 'Display Portfolio Meta', 'sala' ),
    'section'  => 'single_portfolio',
    'priority' => $priority++,
    'default'  => $default['single_portfolio_display_meta'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'single_portfolio_gallery',
    'label'    => esc_html__( 'Display Gallery', 'sala' ),
    'section'  => 'single_portfolio',
    'priority' => $priority++,
    'default'  => $default['single_portfolio_gallery'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'single_portfolio_gallery_title',
    'label'    => esc_html__( 'Display Gallery Title', 'sala' ),
    'section'  => 'single_portfolio',
    'priority' => $priority++,
    'default'  => $default['single_portfolio_gallery_title'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
	'active_callback' => [
		[
			'setting'  => 'single_portfolio_gallery',
			'operator' => '==',
			'value'    => 'show',
		]
	],
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'single_portfolio_video_enable',
    'label'    => esc_html__( 'Display Video', 'sala' ),
    'section'  => 'single_portfolio',
    'priority' => $priority++,
    'default'  => $default['single_portfolio_video_enable'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
	'active_callback' => [
		[
			'setting'  => 'single_portfolio_layout',
			'operator' => '!=',
			'value'    => '03',
		]
	],
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'single_portfolio_video_title_enable',
    'label'    => esc_html__( 'Display Video Title', 'sala' ),
    'section'  => 'single_portfolio',
    'priority' => $priority++,
    'default'  => $default['single_portfolio_video_title_enable'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
	'active_callback' => [
		[
			'setting'  => 'single_portfolio_layout',
			'operator' => '!=',
			'value'    => '03',
		],
		[
			'setting'  => 'single_portfolio_video_enable',
			'operator' => '==',
			'value'    => 'show',
		]
	],
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'single_portfolio_paginate',
    'label'    => esc_html__( 'Display Paginate', 'sala' ),
    'section'  => 'single_portfolio',
    'priority' => $priority++,
    'default'  => $default['single_portfolio_paginate'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'single_portfolio_display_related',
    'label'    => esc_html__( 'Display Related Portfolio', 'sala' ),
    'section'  => 'single_portfolio',
    'priority' => $priority++,
    'default'  => $default['single_portfolio_display_related'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
]);

Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => 'single_portfolio_header',
	'label'    => esc_attr__( 'Header', 'sala' ),
	'section'  => 'single_portfolio',
	'priority' => $priority++,
] );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'single_portfolio_header_type',
	'label'       => esc_html__( 'Header Style', 'sala' ),
	'description' => esc_html__( 'Select header style that displays on portfolio archive pages.', 'sala' ),
	'section'     => 'single_portfolio',
	'priority'    => $priority++,
	'default'     => $default['single_portfolio_header_type'],
	'choices'     => Sala_Customize::sala_get_headers(),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_portfolio_header_overlay',
	'label'    => esc_html__( 'Header Overlay', 'sala' ),
	'section'  => 'single_portfolio',
	'priority' => $priority++,
	'default'  => $default['single_portfolio_header_overlay'],
	'choices'  => array(
		''  => esc_html__( 'Default', 'sala' ),
		'0' => esc_html__( 'No', 'sala' ),
		'1' => esc_html__( 'Yes', 'sala' ),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_portfolio_header_float',
	'label'    => esc_html__( 'Header Float', 'sala' ),
	'section'  => 'single_portfolio',
	'priority' => $priority++,
	'default'  => $default['single_portfolio_header_float'],
	'choices'  => array(
		''  => esc_attr__( 'Default', 'sala' ),
		'0' => esc_attr__( 'No', 'sala' ),
		'1' => esc_attr__( 'Yes', 'sala' ),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_portfolio_header_skin',
	'label'    => esc_html__( 'Header Skin', 'sala' ),
	'section'  => 'single_portfolio',
	'priority' => $priority++,
	'default'  => $default['single_portfolio_header_skin'],
	'choices'  => array(
		''      => esc_html__( 'Default', 'sala' ),
		'dark'  => esc_html__( 'Dark', 'sala' ),
		'light' => esc_html__( 'Light', 'sala' ),
	),
) );
