<?php
$priority = 1;
$section  = 'notices';
$prefix   = 'notice_';

// Notices
Sala_Kirki::add_section( $section, array(
	'title'    => esc_attr__( 'Notices', 'sala' ),
	'priority' => $priority++,
) );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => 'notice_content_notices',
	'label'    => esc_html__( 'Notices', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
] );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'notice_cookie_enable',
	'label'       => esc_html__( 'Cookie Notice', 'sala' ),
	'description' => esc_html__( 'The notice about cookie auto show when a user visits the site.', 'sala' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Hide', 'sala' ),
		'1' => esc_html__( 'Show', 'sala' ),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'textarea',
	'settings'    => 'notice_cookie_messages',
	'label'       => esc_html__( 'Messages', 'sala' ),
	'description' => esc_html__( 'Enter the messages that displays for cookie notice.', 'sala' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'We use cookies to ensure that we give you the best experience on our website. If you continue to use this site we will assume that you are happy with it.', 'sala' ),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'text',
	'settings' => 'notice_cookie_button_text',
	'label'    => esc_html__( 'Button Text', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => esc_html__( 'Accept all cookies', 'sala' ),
) );
