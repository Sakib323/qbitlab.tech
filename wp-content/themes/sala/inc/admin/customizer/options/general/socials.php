<?php

$section  = 'socials';
$prefix   = 'socials_';
$priority = 1;

// Socials Profile
Sala_Kirki::add_section( $section, array(
	'title'    => esc_html__( 'Socials', 'sala' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'user_account',
	'label'    => esc_html__( 'User Account', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => $default['user_account'],
	'choices'  => array(
		'0' => esc_attr__( 'No', 'sala' ),
		'1' => esc_attr__( 'Yes', 'sala' ),
	),
) );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'text',
	'settings' => 'url_phone',
	'label'    => esc_html__( 'Phone', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => $default['url_phone'],
] );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'text',
	'settings' => 'url_email',
	'label'    => esc_html__( 'Email', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => $default['url_email'],
] );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'text',
	'settings' => 'url_facebook',
	'label'    => esc_html__( 'Facebook', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => $default['url_facebook'],
] );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'text',
	'settings' => 'url_twitter',
	'label'    => esc_html__( 'Twitter', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => $default['url_twitter'],
] );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'text',
	'settings' => 'url_instagram',
	'label'    => esc_html__( 'Instagram', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => $default['url_instagram'],
] );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'text',
	'settings' => 'url_youtube',
	'label'    => esc_html__( 'Youtube', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => $default['url_youtube'],
] );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'text',
	'settings' => 'url_google_plus',
	'label'    => esc_html__( 'Google Plus', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => $default['url_google_plus'],
] );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'text',
	'settings' => 'url_skype',
	'label'    => esc_html__( 'Skype', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => $default['url_skype'],
] );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'text',
	'settings' => 'url_linkedin',
	'label'    => esc_html__( 'Linkedin', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => $default['url_linkedin'],
] );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'text',
	'settings' => 'url_pinterest',
	'label'    => esc_html__( 'Pinterest', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => $default['url_pinterest'],
] );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'text',
	'settings' => 'url_slack',
	'label'    => esc_html__( 'Slack', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => $default['url_slack'],
] );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'text',
	'settings' => 'url_rss',
	'label'    => esc_html__( 'RSS', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => $default['url_rss'],
] );
