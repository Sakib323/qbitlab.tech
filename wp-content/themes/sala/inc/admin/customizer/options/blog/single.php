<?php

// Single post
Sala_Kirki::add_section( 'single_post', array(
	'title'    => esc_html__( 'Single Post', 'sala' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => 'single_post_customize',
	'label'    => esc_html__( 'Single Post', 'sala' ),
	'section'  => 'single_post',
	'priority' => $priority++,
] );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'select',
	'settings' => 'single_post_layout',
	'label'    => esc_html__( 'Layout Style', 'sala' ),
	'section'  => 'single_post',
	'priority' => $priority++,
	'default'  => $default['single_post_layout'],
	'choices'  => [
		'01' => esc_attr__( '01', 'sala' ),
		'02' => esc_attr__( '02', 'sala' ),
	],
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'radio-image',
	'settings'  => 'single_post_sidebar_position',
	'label'     => esc_html__( 'Sidebar Layout', 'sala' ),
	'section'   => 'single_post',
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => $default['single_post_sidebar_position'],
	'choices'   => [
		'left'  => get_template_directory_uri() . '/inc/admin/customizer/assets/images/left-sidebar.png',
		'none'  => get_template_directory_uri() . '/inc/admin/customizer/assets/images/no-sidebar.png',
		'right' => get_template_directory_uri() . '/inc/admin/customizer/assets/images/right-sidebar.png',
	],
] );

Sala_Kirki::add_field( 'theme', array(
	'type'            => 'select',
	'settings'        => 'single_post_active_sidebar',
	'label'           => esc_html__( 'Sidebar', 'sala' ),
	'description'     => esc_html__( 'Select sidebar that will display on blog archive pages.', 'sala' ),
	'section'         => 'single_post',
	'priority'        => $priority++,
	'default'         => $default['single_post_active_sidebar'],
	'choices'         => Sala_Helper::get_registered_sidebars(),
	'active_callback' => [
		[
			'setting'  => 'single_post_sidebar_position',
			'operator' => '!==',
			'value'    => 'none',
        ],
	],
) );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'slider',
	'settings'  => 'single_post_sidebar_width',
	'label'     => esc_html__( 'Sidebar Width', 'sala' ),
	'section'   => 'single_post',
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => $default['single_post_sidebar_width'],
	'choices'   => [
		'min'  => 270,
		'max'  => 420,
		'step' => 1,
	],
	'output'    => array(
        array(
            'element'  => '#secondary.sidebar-single-post',
            'property' => 'flex-basis',
            'units'    => 'px',
			'media_query' => '@media (min-width: 992px)',
        ),
		array(
            'element'  => '#secondary.sidebar-single-post',
            'property' => 'max-width',
            'units'    => 'px',
			'media_query' => '@media (min-width: 992px)',
        ),
		array(
            'element'  			=> '.single-post #primary',
            'property' 			=> 'flex-basis',
            'value_pattern'   	=> 'calc( 100% - $px )',
			'media_query' 		=> '@media (min-width: 992px)',
        ),
		array(
            'element'  			=> '.single-post #primary',
            'property' 			=> 'max-width',
            'value_pattern'   	=> 'calc( 100% - $px )',
			'media_query' 		=> '@media (min-width: 992px)',
        ),
    ),
	'active_callback' => [
		[
			'setting'  => 'single_post_sidebar_position',
			'operator' => '!==',
			'value'    => 'none',
        ],
	],
] );

Sala_Kirki::add_field('theme', [
    'type'     => 'select',
    'settings' => 'single_post_page_title_layout',
    'label'    => esc_html__( 'Page Title', 'sala' ),
    'section'  => 'single_post',
    'priority' => $priority++,
    'default'  => $default['single_post_page_title_layout'],
    'choices'  => Sala_Page_Title::get_list(true),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'single_post_title_fullscreen',
    'label'    => esc_html__( 'Display Title Fullscreen', 'sala' ),
    'section'  => 'single_post',
    'priority' => $priority++,
    'default'  => $default['single_post_title_fullscreen'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
	'active_callback' => [
        [
			'setting'  => 'single_post_layout',
			'operator' => '==',
			'value'    => '02',
		]
	],
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'single_post_boxed',
    'label'    => esc_html__( 'Display Boxed', 'sala' ),
    'section'  => 'single_post',
    'priority' => $priority++,
    'default'  => $default['single_post_boxed'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'single_post_display_categories',
    'label'    => esc_html__( 'Display Categories', 'sala' ),
    'section'  => 'single_post',
    'priority' => $priority++,
    'default'  => $default['single_post_display_categories'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'single_post_display_date_time',
    'label'    => esc_html__( 'Display Time', 'sala' ),
    'section'  => 'single_post',
    'priority' => $priority++,
    'default'  => $default['single_post_display_date_time'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'single_post_display_comment_count',
    'label'    => esc_html__( 'Display Comment Count', 'sala' ),
    'section'  => 'single_post',
    'priority' => $priority++,
    'default'  => $default['single_post_display_comment_count'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'single_post_display_title',
    'label'    => esc_html__( 'Display Post Title', 'sala' ),
    'section'  => 'single_post',
    'priority' => $priority++,
    'default'  => $default['single_post_display_title'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'single_post_display_featured_image',
    'label'    => esc_html__( 'Display Featured Image', 'sala' ),
    'section'  => 'single_post',
    'priority' => $priority++,
    'default'  => $default['single_post_display_featured_image'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'single_post_display_tags',
    'label'    => esc_html__( 'Display Tags', 'sala' ),
    'section'  => 'single_post',
    'priority' => $priority++,
    'default'  => $default['single_post_display_tags'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'single_post_display_sharing',
    'label'    => esc_html__( 'Display Sharing', 'sala' ),
    'section'  => 'single_post',
    'priority' => $priority++,
    'default'  => $default['single_post_display_sharing'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'single_post_display_author',
    'label'    => esc_html__( 'Display Author Info', 'sala' ),
    'section'  => 'single_post',
    'priority' => $priority++,
    'default'  => $default['single_post_display_author'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'single_post_display_related',
    'label'    => esc_html__( 'Display Related Post', 'sala' ),
    'section'  => 'single_post',
    'priority' => $priority++,
    'default'  => $default['single_post_display_related'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'single_post_display_comments',
    'label'    => esc_attr__( 'Display Comments', 'sala' ),
    'section'  => 'single_post',
    'priority' => $priority++,
    'default'  => $default['single_post_display_comments'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
]);

Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => 'single_post_header',
	'label'    => esc_attr__( 'Header', 'sala' ),
	'section'  => 'single_post',
	'priority' => $priority++,
] );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'single_post_header_type',
	'label'       => esc_html__( 'Header Style', 'sala' ),
	'description' => esc_html__( 'Select header style that displays on blog archive pages.', 'sala' ),
	'section'     => 'single_post',
	'priority'    => $priority++,
	'default'     => $default['single_post_header_type'],
	'choices'     => Sala_Customize::sala_get_headers(),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_post_header_overlay',
	'label'    => esc_html__( 'Header Overlay', 'sala' ),
	'section'  => 'single_post',
	'priority' => $priority++,
	'default'  => $default['single_post_header_overlay'],
	'choices'  => array(
		''  => esc_html__( 'Default', 'sala' ),
		'0' => esc_html__( 'No', 'sala' ),
		'1' => esc_html__( 'Yes', 'sala' ),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_post_header_float',
	'label'    => esc_html__( 'Header Float', 'sala' ),
	'section'  => 'single_post',
	'priority' => $priority++,
	'default'  => $default['single_post_header_float'],
	'choices'  => array(
		''  => esc_attr__( 'Default', 'sala' ),
		'0' => esc_attr__( 'No', 'sala' ),
		'1' => esc_attr__( 'Yes', 'sala' ),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_post_header_skin',
	'label'    => esc_html__( 'Header Skin', 'sala' ),
	'section'  => 'single_post',
	'priority' => $priority++,
	'default'  => $default['single_post_header_skin'],
	'choices'  => array(
		''      => esc_html__( 'Default', 'sala' ),
		'dark'  => esc_html__( 'Dark', 'sala' ),
		'light' => esc_html__( 'Light', 'sala' ),
	),
) );
