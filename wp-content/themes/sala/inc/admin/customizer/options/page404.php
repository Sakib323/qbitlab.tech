<?php
$priority = 1;
$section  = 'page404';
$prefix   = 'page404_';

// Notices
Sala_Kirki::add_section( $section, array(
	'title'    => esc_attr__( '404 Page', 'sala' ),
	'priority' => $priority++,
) );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => 'page404_background_body',
	'label'       => esc_html__( 'Background', 'sala' ),
	'description' => esc_html__( 'Controls outer background area in boxed mode.', 'sala' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'background-color'      => '#fff',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'fixed',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => '.error404',
		),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'image',
	'settings' => 'page404_image',
	'label'    => esc_html__( 'Image', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => SALA_IMAGES . '/page-404-image.png',
) );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'page404_title',
	'label'       => esc_html__( 'Title', 'sala' ),
	'description' => esc_html__( 'Controls the title that display on error 404 page.', 'sala' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Page not found!', 'sala' ),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'editor',
	'settings'    => 'page404_text',
	'label'       => esc_html__( 'Text', 'sala' ),
	'description' => esc_html__( 'Controls the text that display below title', 'sala' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( "This could be because of a typo, an out of date link, or that the page you requested doesn't exist.", 'sala' ),
) );
