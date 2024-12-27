<?php

$priority = 1;
$section  = 'layout';
$prefix   = 'layout_';

// Layout
Sala_Kirki::add_section( $section, array(
	'title'    => esc_attr__( 'Layout', 'sala' ),
	'priority' => $priority++,
) );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'radio-image',
	'settings'  => 'layout_content',
	'label'     => esc_attr__( 'Layout Type', 'sala' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'postMessage',
	'default'   => $default['layout_content'],
	'choices'   => [
		'boxed'     => get_template_directory_uri() . '/inc/admin/customizer/assets/images/boxed.png',
		'fullwidth' => get_template_directory_uri() . '/inc/admin/customizer/assets/images/full-width.png',
	],
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'slider',
	'settings'  => 'boxed_width',
	'label'     => esc_attr__( 'Boxed Width', 'sala' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => $default['boxed_width'],
	'choices'   => [
		'min'  => 400,
		'max'  => 1920,
		'step' => 1,
	],
	'active_callback' => [
		[
			'setting'  => 'layout_content',
			'operator' => '==',
			'value'    => 'boxed',
		]
	],
	'output'    => array(
        array(
            'element'  => 'body.boxed',
            'property' => 'max-width',
            'units'    => 'px',
        ),
    ),
] );

// Background
Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => 'notice_bg_color',
	'label'    => esc_html__( 'Background', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'color-alpha',
	'settings'  => 'body_background_color',
	'label'     => esc_html__( 'Body Background', 'sala' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => $default['body_background_color'],
	'output'    => array(
        array(
            'element'  => 'body',
            'property' => 'background-color',
        ),
    ),
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'color-alpha',
	'settings'  => 'content_background_color',
	'label'     => esc_html__( 'Content Background', 'sala' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => $default['content_background_color'],
	'output'    => array(
        array(
            'element'  => 'body.boxed',
            'property' => 'background-color',
        ),
    ),
	'active_callback' => [
		[
			'setting'  => 'layout_content',
			'operator' => '==',
			'value'    => 'boxed',
		]
	],
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'image',
	'settings'  => 'bg_body_image',
	'label'     => esc_html__( 'Body BG Image', 'sala' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => $default['bg_body_image'],
	'output'    => array(
        array(
            'element'  => 'html',
            'property' => 'background-image',
        ),
    ),
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'select',
	'settings'  => 'bg_body_size',
	'label'     => esc_html__( 'Background Size', 'sala' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => $default['bg_body_size'],
	'choices'   => [
		'auto'    => esc_attr__( 'Auto', 'sala' ),
		'cover'   => esc_attr__( 'Cover', 'sala' ),
		'contain' => esc_attr__( 'Contain', 'sala' ),
		'initial' => esc_attr__( 'Initial', 'sala' ),
	],
	'output'    => array(
        array(
            'element'  => 'html',
            'property' => 'background-size',
        ),
    ),
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'select',
	'settings'  => 'bg_body_repeat',
	'label'     => esc_html__( 'Background Repeat', 'sala' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => $default['bg_body_repeat'],
	'choices'   => [
		'no-repeat' => esc_attr__( 'No Repeat', 'sala' ),
		'repeat'    => esc_attr__( 'Repeat', 'sala' ),
		'repeat-x'  => esc_attr__( 'Repeat X', 'sala' ),
		'repeat-y'  => esc_attr__( 'Repeat Y', 'sala' ),
	],
	'output'    => array(
        array(
            'element'  => 'html',
            'property' => 'background-repeat',
        ),
    ),
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'select',
	'settings'  => 'bg_body_position',
	'label'     => esc_html__( 'Background Position', 'sala' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => $default['bg_body_position'],
	'choices'   => [
		'left top'      => esc_attr__( 'Left Top', 'sala' ),
		'left center'   => esc_attr__( 'Left Center', 'sala' ),
		'left bottom'   => esc_attr__( 'Left Bottom', 'sala' ),
		'right top'     => esc_attr__( 'Right Top', 'sala' ),
		'right center'  => esc_attr__( 'Right Center', 'sala' ),
		'right bottom'  => esc_attr__( 'Right Bottom', 'sala' ),
		'center top'    => esc_attr__( 'Center Top', 'sala' ),
		'center center' => esc_attr__( 'Center Center', 'sala' ),
		'center bottom' => esc_attr__( 'Center Bottom', 'sala' ),
	],
	'output'    => array(
        array(
            'element'  => 'html',
            'property' => 'background-position',
        ),
    ),
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'select',
	'settings'  => 'bg_body_attachment',
	'label'     => esc_html__( 'Background Attachment', 'sala' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => $default['bg_body_attachment'],
	'choices'   => [
		'scroll' => esc_attr__( 'Scroll', 'sala' ),
		'fixed'  => esc_attr__( 'Fixed', 'sala' ),
	],
	'output'    => array(
        array(
            'element'  => 'html',
            'property' => 'background-attachment',
        ),
    ),
] );
