<?php

$priority = 1;
$section  = 'page';
$prefix   = 'page_';

// Layout
Sala_Kirki::add_section( $section, array(
	'title'    => esc_attr__( 'Page', 'sala' ),
	'priority' => $priority++,
) );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => $prefix . 'notice_header',
	'label'    => esc_html__( 'Header', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
] );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => $prefix . 'header_type',
	'label'       => esc_html__( 'Header Style', 'sala' ),
	'description' => esc_html__( 'Select header style that displays on blog archive pages.', 'sala' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => $default[$prefix . 'header_type'],
	'choices'     => Sala_Customize::sala_get_headers(),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'header_overlay',
	'label'    => esc_html__( 'Header Overlay', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => $default[$prefix . 'header_overlay'],
	'choices'  => array(
		''  => esc_attr__( 'Default', 'sala' ),
		'0' => esc_attr__( 'No', 'sala' ),
		'1' => esc_attr__( 'Yes', 'sala' ),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'header_float',
	'label'    => esc_html__( 'Header Float', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => $default[$prefix . 'header_float'],
	'choices'  => array(
		''  => esc_attr__( 'Default', 'sala' ),
		'0' => esc_attr__( 'No', 'sala' ),
		'1' => esc_attr__( 'Yes', 'sala' ),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'header_skin',
	'label'    => esc_html__( 'Header Skin', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => $default[$prefix . 'header_skin'],
	'choices'  => array(
		''      => esc_attr__( 'Default', 'sala' ),
		'dark'  => esc_attr__( 'Dark', 'sala' ),
		'light' => esc_attr__( 'Light', 'sala' ),
	),
) );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => $prefix . 'notice_sidebar',
	'label'    => esc_html__( 'Sidebar', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'radio-image',
	'settings'  => $prefix . 'sidebar_position',
	'label'     => esc_html__( 'Sidebar Layout', 'sala' ),
	'section'   => $section,
	'transport' => 'auto',
	'priority'  => $priority++,
	'default'   => $default[$prefix . 'sidebar_position'],
	'choices'   => [
		'left'  => get_template_directory_uri() . '/inc/admin/customizer/assets/images/left-sidebar.png',
		'none'  => get_template_directory_uri() . '/inc/admin/customizer/assets/images/no-sidebar.png',
		'right' => get_template_directory_uri() . '/inc/admin/customizer/assets/images/right-sidebar.png',
	],
] );

Sala_Kirki::add_field( 'theme', array(
	'type'            => 'select',
	'settings'        => $prefix . 'active_sidebar',
	'label'           => esc_html__( 'Sidebar', 'sala' ),
	'description'     => esc_html__( 'Select sidebar that will display on blog archive pages.', 'sala' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => $default[$prefix . 'active_sidebar'],
	'choices'         => Sala_Helper::get_registered_sidebars(),
	'active_callback' => [
		[
			'setting'  => $prefix . 'sidebar_position',
			'operator' => '!==',
			'value'    => 'none',
		]
	],
) );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'slider',
	'settings'  => $prefix . 'sidebar_width',
	'label'     => esc_html__( 'Sidebar Width', 'sala' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => $default[$prefix . 'sidebar_width'],
	'choices'   => [
		'min'  => 270,
		'max'  => 420,
		'step' => 1,
	],
	'active_callback' => [
		[
			'setting'  => $prefix . 'sidebar_position',
			'operator' => '!==',
			'value'    => 'none',
		]
	],
] );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => $prefix . 'notice_page_title',
	'label'    => esc_html__( 'Page Title', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
] );

Sala_Kirki::add_field('theme', [
    'type'     => 'select',
    'settings' => $prefix . 'page_title_layout',
    'label'    => esc_html__( 'Page Title', 'sala' ),
    'section'  => $section,
    'priority' => $priority++,
    'default'  => $default[$prefix . 'page_title_layout'],
    'choices'  => Sala_Page_Title::get_list(true),
]);
