<?php

$priority = 1;
$section  = 'social_sharing';

// Layout
Sala_Kirki::add_section( $section, array(
	'title'    => esc_attr__( 'Social Sharing', 'sala' ),
	'priority' => $priority++,
) );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'multicheck',
	'settings'    => 'social_sharing_item_enable',
	'label'       => esc_attr__( 'Sharing Links', 'sala' ),
	'description' => esc_attr__( 'Check to the box to enable social share links.', 'sala' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array( 'facebook', 'twitter', 'linkedin', 'tumblr' ),
	'choices'     => array(
		'facebook' => esc_attr__( 'Facebook', 'sala' ),
		'twitter'  => esc_attr__( 'Twitter', 'sala' ),
		'linkedin' => esc_attr__( 'Linkedin', 'sala' ),
		'tumblr'   => esc_attr__( 'Tumblr', 'sala' ),
		'email'    => esc_attr__( 'Email', 'sala' ),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'sortable',
	'settings'    => 'social_sharing_order',
	'label'       => esc_attr__( 'Order', 'sala' ),
	'description' => esc_attr__( 'Controls the order of social share links.', 'sala' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'facebook',
		'twitter',
		'linkedin',
		'tumblr',
		'email',
	),
	'choices'     => array(
		'facebook' => esc_attr__( 'Facebook', 'sala' ),
		'twitter'  => esc_attr__( 'Twitter', 'sala' ),
		'linkedin' => esc_attr__( 'Linkedin', 'sala' ),
		'tumblr'   => esc_attr__( 'Tumblr', 'sala' ),
		'email'    => esc_attr__( 'Email', 'sala' ),
	),
) );
