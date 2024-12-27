<?php

$priority = 1;
$section  = 'header_contact';

Sala_Kirki::add_section( $section, array(
	'title'    => esc_html__( 'Contact', 'sala' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => $section,
	'label'    => esc_html__( 'Contact', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
] );

Sala_Kirki::add_field('theme', array(
    'type'         => 'repeater',
    'settings'     => 'header_contact_info',
    'section'      => $section,
    'priority'     => $priority++,
    'button_label' => esc_html__('Add New Contact', 'sala'),
    'row_label'    => array(
        'type'  => 'field',
        'field' => 'text',
    ),
    'default'      => array(
        array(
            'text'       => esc_attr__( '+ 41 463 23 445', 'sala' ),
            'icon_class' => 'fal fa-mobile',
            'link_url'   => 'tel:4146323445',
        ),
    ),
    'fields'       => array(
        'text'       => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Text', 'sala' ),
            'description' => esc_attr__( 'Enter your hint text for your icon', 'sala' ),
            'default'     => '',
        ),
        'icon_class' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Icon Class', 'sala' ),
            'description' => esc_attr__( 'This will be the icon class for your link', 'sala' ),
            'default'     => '',
        ),
        'link_url'   => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Link URL', 'sala' ),
            'description' => esc_attr__( 'This will be the link URL', 'sala' ),
            'default'     => '',
        ),
    ),
));

Sala_Kirki::add_field('theme', [
    'type'     => 'checkbox',
    'settings' => 'header_contact_info_blank',
    'label'    => esc_html__('Open in new window', 'sala'),
    'section'  => $section,
    'priority' => $priority++,
    'default'  => '',
]);

Sala_Kirki::add_field('theme', array(
    'type'     => 'radio-buttonset',
    'settings' => 'header_contact_info_show_text',
    'label'    => esc_html__('Display Text', 'sala'),
    'section'  => $section,
    'priority' => $priority++,
    'default'  => 'show',
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
));

Sala_Kirki::add_field('theme', array(
    'type'     => 'radio-buttonset',
    'settings' => 'header_contact_info_show_icon',
    'label'    => esc_html__('Display Icon', 'sala'),
    'section'  => $section,
    'priority' => $priority++,
    'default'  => 'show',
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
));

Sala_Kirki::add_field('theme', [
    'type'     => 'notice',
    'settings' => 'header_contact_responsive',
    'label'    => esc_html__('Responsive', 'sala'),
    'section'  => $section,
    'priority' => $priority++,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'toggle',
    'settings'  => 'header_contact_desktop_hidden',
    'label'     => esc_html__('Hide On Desktop', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 0,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'toggle',
    'settings'  => 'header_contact_tablet_hidden',
    'label'     => esc_html__('Hide On Tablet', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 1,
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'toggle',
    'settings'  => 'header_contact_mobile_hidden',
    'label'     => esc_html__('Hide On Mobile', 'sala'),
    'section'   => $section,
    'priority'  => $priority++,
    'transport' => 'postMessage',
    'default'   => 1,
]);
