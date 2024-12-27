<?php

// Portfolio archive
Sala_Kirki::add_section( 'portfolio_archive', array(
	'title'    => esc_html__( 'Portfolio Archive', 'sala' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => 'portfolio_archive_customize',
	'label'    => esc_html__( 'Portfolio Archive', 'sala' ),
	'section'  => 'portfolio_archive',
	'priority' => $priority++,
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'radio-image',
	'settings'  => 'portfolio_archive_sidebar_position',
	'label'     => esc_html__( 'Sidebar Layout', 'sala' ),
	'section'   => 'portfolio_archive',
	'transport' => 'auto',
	'priority'  => $priority++,
	'default'   => $default['portfolio_archive_sidebar_position'],
	'choices'   => [
		'left'  => get_template_directory_uri() . '/inc/admin/customizer/assets/images/left-sidebar.png',
		'none'  => get_template_directory_uri() . '/inc/admin/customizer/assets/images/no-sidebar.png',
		'right' => get_template_directory_uri() . '/inc/admin/customizer/assets/images/right-sidebar.png',
	],
	'preset' => array(
		'left' => array(
			'settings' => array(
				'portfolio_desktop_column' => '2',
				'portfolio_tablet_column'  => '1',
				'portfolio_mobile_column'  => '1',
			),
		),
		'none' => array(
			'settings' => array(
				'portfolio_desktop_column' => '3',
				'portfolio_tablet_column'  => '2',
				'portfolio_mobile_column'  => '1',
			),
		),
		'right' => array(
			'settings' => array(
				'portfolio_desktop_column' => '2',
				'portfolio_tablet_column'  => '1',
				'portfolio_mobile_column'  => '1',
			),
		),
	),
] );

Sala_Kirki::add_field( 'theme', array(
	'type'            => 'select',
	'settings'        => 'portfolio_archive_active_sidebar',
	'label'           => esc_html__( 'Sidebar', 'sala' ),
	'description'     => esc_html__( 'Select sidebar that will display on portfolio archive pages.', 'sala' ),
	'section'         => 'portfolio_archive',
	'priority'        => $priority++,
	'default'         => $default['portfolio_archive_active_sidebar'],
	'choices'         => Sala_Helper::get_registered_sidebars(),
	'active_callback' => [
		[
			'setting'  => 'portfolio_archive_sidebar_position',
			'operator' => '!==',
			'value'    => 'none',
		]
	],
) );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'slider',
	'settings'  => 'portfolio_archive_sidebar_width',
	'label'     => esc_html__( 'Sidebar Width', 'sala' ),
	'section'   => 'portfolio_archive',
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => $default['portfolio_archive_sidebar_width'],
	'choices'   => [
		'min'  => 270,
		'max'  => 420,
		'step' => 1,
	],
	'output'    => array(
        array(
            'element'  => '#secondary.sidebar-portfolio-archive',
            'property' => 'flex-basis',
            'units'    => 'px',
        ),
		array(
            'element'  => '#secondary.sidebar-portfolio-archive',
            'property' => 'max-width',
            'units'    => 'px',
        ),
    ),
	'active_callback' => [
		[
			'setting'  => 'portfolio_archive_sidebar_position',
			'operator' => '!==',
			'value'    => 'none',
		]
	],
] );

Sala_Kirki::add_field('theme', [
    'type'     => 'select',
    'settings' => 'portfolio_archive_page_title_layout',
    'label'    => esc_html__( 'Page Title', 'sala' ),
    'section'  => 'portfolio_archive',
    'priority' => $priority++,
    'default'  => $default['portfolio_archive_page_title_layout'],
    'choices'  => Sala_Page_Title::get_list(true),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'portfolio_archive_display_taxonomy',
    'label'    => esc_html__( 'Display Head Taxonomy', 'sala' ),
    'section'  => 'portfolio_archive',
    'priority' => $priority++,
    'default'  => $default['portfolio_archive_display_taxonomy'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'portfolio_archive_display_count_taxonomy',
    'label'    => esc_html__( 'Display Count Taxonomy', 'sala' ),
    'section'  => 'portfolio_archive',
    'priority' => $priority++,
    'default'  => $default['portfolio_archive_display_count_taxonomy'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
	'active_callback' => [
        [
			'setting'  => 'portfolio_archive_display_taxonomy',
			'operator' => '==',
			'value'    => 'show',
		]
	],
]);

Sala_Kirki::add_field( 'theme', [
	'type'     => 'select',
	'settings' => 'portfolio_archive_pagination_type',
	'label'    => esc_html__( 'Pagination Type', 'sala' ),
	'section'  => 'portfolio_archive',
	'priority' => $priority++,
	'default'  => $default['portfolio_archive_pagination_type'],
	'choices'  => [
		'navigation' => esc_attr__( 'Navigation Number', 'sala' ),
		'loadmore'   => esc_attr__( 'Load More', 'sala' ),
		'infinite'   => esc_attr__( 'Infinity Scroll', 'sala' ),
	],
] );

Sala_Kirki::add_field('theme', [
    'type'      => 'radio-buttonset',
    'settings'  => 'portfolio_archive_pagination_position',
    'label'     => esc_html__( 'Pagination Position', 'sala' ),
    'section'   => 'portfolio_archive',
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => $default['portfolio_archive_pagination_position'],
    'choices'   => array(
        'left'   => esc_attr__('Left', 'sala'),
        'center' => esc_attr__('Center', 'sala'),
        'right'  => esc_attr__('Right', 'sala'),
    ),
]);

Sala_Kirki::add_field( 'theme', [
	'type'            => 'notice',
	'settings'        => 'portfolio_column',
	'label'           => esc_html__( 'Grid Column', 'sala' ),
	'section'         => 'portfolio_archive',
	'priority'        => $priority++,
	'active_callback' => [
		[
			'setting'  => 'portfolio_archive_post_layout',
			'operator' => 'in',
			'value'    => array('grid','masonry'),
		]
	],
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'radio-image',
	'settings'  => 'portfolio_desktop_column',
	'label'     => esc_html__( 'Desktop', 'sala' ),
	'section'   => 'portfolio_archive',
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => $default['portfolio_desktop_column'],
	'choices'   => [
		'1' => get_template_directory_uri() . '/inc/admin/customizer/assets/images/col-1.png',
		'2' => get_template_directory_uri() . '/inc/admin/customizer/assets/images/col-2.png',
		'3' => get_template_directory_uri() . '/inc/admin/customizer/assets/images/col-3.png',
		'4' => get_template_directory_uri() . '/inc/admin/customizer/assets/images/col-4.png',
		'5' => get_template_directory_uri() . '/inc/admin/customizer/assets/images/col-5.png',
		'6' => get_template_directory_uri() . '/inc/admin/customizer/assets/images/col-6.png',
	],
	'active_callback' => [
		[
			'setting'  => 'portfolio_archive_post_layout',
			'operator' => 'in',
			'value'    => array('grid','masonry'),
		]
	],
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'radio-image',
	'settings'  => 'portfolio_tablet_column',
	'label'     => esc_html__( 'Tablet', 'sala' ),
	'section'   => 'portfolio_archive',
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => $default['portfolio_tablet_column'],
	'choices'   => [
		'1' => get_template_directory_uri() . '/inc/admin/customizer/assets/images/col-1.png',
		'2' => get_template_directory_uri() . '/inc/admin/customizer/assets/images/col-2.png',
		'3' => get_template_directory_uri() . '/inc/admin/customizer/assets/images/col-3.png',
		'4' => get_template_directory_uri() . '/inc/admin/customizer/assets/images/col-4.png',
		'5' => get_template_directory_uri() . '/inc/admin/customizer/assets/images/col-5.png',
		'6' => get_template_directory_uri() . '/inc/admin/customizer/assets/images/col-6.png',
	],
	'active_callback' => [
		[
			'setting'  => 'portfolio_archive_post_layout',
			'operator' => 'in',
			'value'    => array('grid','masonry'),
		]
	],
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'radio-image',
	'settings'  => 'portfolio_mobile_column',
	'label'     => esc_html__( 'Mobile', 'sala' ),
	'section'   => 'portfolio_archive',
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => $default['portfolio_mobile_column'],
	'choices'   => [
		'1' => get_template_directory_uri() . '/inc/admin/customizer/assets/images/col-1.png',
		'2' => get_template_directory_uri() . '/inc/admin/customizer/assets/images/col-2.png',
		'3' => get_template_directory_uri() . '/inc/admin/customizer/assets/images/col-3.png',
		'4' => get_template_directory_uri() . '/inc/admin/customizer/assets/images/col-4.png',
		'5' => get_template_directory_uri() . '/inc/admin/customizer/assets/images/col-5.png',
		'6' => get_template_directory_uri() . '/inc/admin/customizer/assets/images/col-6.png',
	],
	'active_callback' => [
		[
			'setting'  => 'portfolio_archive_post_layout',
			'operator' => 'in',
			'value'    => array('grid','masonry'),
		]
	],
] );

Sala_Kirki::add_field('theme', array(
    'type'     => 'number',
    'settings' => 'portfolio_content_post_gutter',
    'label'    => esc_html__( 'Gutter', 'sala' ),
    'section'  => 'portfolio_archive',
    'priority' => $priority++,
    'default'  => $default['portfolio_content_post_gutter'],
    'choices'  => [
		'min'  => 0,
		'max'  => 100,
		'step' => 1,
	],
));

Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => 'portfolio_content_post',
	'label'    => esc_html__( 'Content Portfolio', 'sala' ),
	'section'  => 'portfolio_archive',
	'priority' => $priority++,
] );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'radio-image',
	'settings' => 'portfolio_archive_post_layout',
	'label'    => esc_html__( 'Content Layout', 'sala' ),
	'section'  => 'portfolio_archive',
	'priority' => $priority++,
	'default'  => $default['portfolio_archive_post_layout'],
	'choices'  => [
		'grid'    	=> get_template_directory_uri() . '/inc/admin/customizer/assets/images/layout-grid.png',
		'masonry' 	=> get_template_directory_uri() . '/inc/admin/customizer/assets/images/layout-masonry.png',
		'metro'    	=> get_template_directory_uri() . '/inc/admin/customizer/assets/images/layout-metro.png',
		'mosaic'    => get_template_directory_uri() . '/inc/admin/customizer/assets/images/layout-mosaic.png',
	],
	'preset' => array(
		'grid' => array(
			'settings' => array(
				'portfolio_content_post_image_size'     => '740x740',
				'portfolio_archive_pagination_position' => 'center',
				'portfolio_content_post_excerpt'        => 'show',
				'portfolio_content_post_excerpt_number' => 15,
				'portfolio_desktop_column'              => '2',
				'portfolio_tablet_column'               => '2',
				'portfolio_mobile_column'               => '1',
				'portfolio_content_post_gutter'			=> '60',
			),
		),
		'masonry' => array(
			'settings' => array(
				'portfolio_archive_pagination_position' => 'center',
				'portfolio_content_post_excerpt'        => 'show',
				'portfolio_content_post_excerpt_number' => 15,
				'portfolio_desktop_column'              => '2',
				'portfolio_tablet_column'               => '2',
				'portfolio_mobile_column'               => '1',
				'portfolio_content_post_gutter'			=> '60',
			),
		),
		'metro' => array(
			'settings' => array(
				'portfolio_content_post_image_size'     => '1480x1080',
				'portfolio_archive_pagination_position' => 'center',
				'portfolio_content_post_excerpt'        => 'show',
				'portfolio_content_post_excerpt_number' => 15,
				'portfolio_desktop_column'              => '6',
				'portfolio_tablet_column'               => '2',
				'portfolio_mobile_column'               => '1',
				'portfolio_content_post_gutter'			=> '60',
			),
		),
		'mosaic' => array(
			'settings' => array(
				'portfolio_archive_pagination_position' => 'center',
				'portfolio_content_post_excerpt'        => 'show',
				'portfolio_content_post_excerpt_number' => 15,
				'portfolio_desktop_column'              => '2',
				'portfolio_tablet_column'               => '2',
				'portfolio_mobile_column'               => '1',
				'portfolio_content_post_gutter'			=> '90',
			),
		),
	),
] );

Sala_Kirki::add_field('theme', array(
    'type'     => 'radio-buttonset',
    'settings' => 'portfolio_content_post_card',
    'label'    => esc_html__('Display Card Style', 'sala'),
    'section'  => 'portfolio_archive',
    'priority' => $priority++,
    'default'  => $default['portfolio_content_post_card'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
	'active_callback' => [
		[
			'setting'  => 'portfolio_archive_post_layout',
			'operator' => '==',
			'value'    => 'grid',
		]
	],
));

Sala_Kirki::add_field('theme', array(
    'type'     => 'radio-buttonset',
    'settings' => 'portfolio_content_minimal_style',
    'label'    => esc_html__('Display Minimal Style', 'sala'),
    'section'  => 'portfolio_archive',
    'priority' => $priority++,
    'default'  => $default['portfolio_content_minimal_style'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
));

Sala_Kirki::add_field('theme', array(
    'type'     => 'radio-buttonset',
    'settings' => 'portfolio_content_modern_style',
    'label'    => esc_html__('Display Modern Style', 'sala'),
    'section'  => 'portfolio_archive',
    'priority' => $priority++,
    'default'  => $default['portfolio_content_minimal_style'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
));

Sala_Kirki::add_field( 'theme', [
	'type'            => 'text',
	'settings'        => 'portfolio_content_post_image_size',
	'label'           => esc_html__( 'Image size', 'sala' ),
	'section'         => 'portfolio_archive',
	'priority'        => $priority++,
	'default'         => $default['portfolio_content_post_image_size'],
	'active_callback' => [
		[
			'setting'  => 'portfolio_archive_post_layout',
			'operator' => '!==',
			'value'    => 'masonry',
		]
	],
] );

Sala_Kirki::add_field('theme', array(
    'type'     => 'radio-buttonset',
    'settings' => 'portfolio_content_post_taxonomy',
    'label'    => esc_html__('Display Taxonomy', 'sala'),
    'section'  => 'portfolio_archive',
    'priority' => $priority++,
    'default'  => $default['portfolio_content_post_taxonomy'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
));

Sala_Kirki::add_field('theme', array(
    'type'     => 'radio-buttonset',
    'settings' => 'portfolio_content_post_excerpt',
    'label'    => esc_html__('Display Excerpt', 'sala'),
    'section'  => 'portfolio_archive',
    'priority' => $priority++,
    'default'  => $default['portfolio_content_post_excerpt'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
));

Sala_Kirki::add_field('theme', array(
    'type'     => 'radio-buttonset',
    'settings' => 'portfolio_content_post_button',
    'label'    => esc_html__('Display Button', 'sala'),
    'section'  => 'portfolio_archive',
    'priority' => $priority++,
    'default'  => $default['portfolio_content_post_button'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
));

Sala_Kirki::add_field('theme', array(
    'type'     => 'number',
    'settings' => 'portfolio_content_post_excerpt_number',
    'label'    => esc_html__( 'Excerpt Word', 'sala' ),
    'section'  => 'portfolio_archive',
    'priority' => $priority++,
    'default'  => $default['portfolio_content_post_excerpt_number'],
    'choices'  => [
		'min'  => 0,
		'max'  => 50,
		'step' => 1,
	],
	'active_callback' => [
		[
			'setting'  => 'portfolio_content_post_excerpt',
			'operator' => '==',
			'value'    => 'show',
		]
	],
));

Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => 'portfolio_archive_header',
	'label'    => esc_html__( 'Header', 'sala' ),
	'section'  => 'portfolio_archive',
	'priority' => $priority++,
] );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'portfolio_archive_header_type',
	'label'       => esc_html__( 'Header Style', 'sala' ),
	'description' => esc_html__( 'Select header style that displays on portfolio archive pages.', 'sala' ),
	'section'     => 'portfolio_archive',
	'priority'    => $priority++,
	'default'     => $default['portfolio_archive_header_type'],
	'choices'     => Sala_Customize::sala_get_headers(),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'portfolio_archive_header_overlay',
	'label'    => esc_html__( 'Header Overlay', 'sala' ),
	'section'  => 'portfolio_archive',
	'priority' => $priority++,
	'default'  => $default['portfolio_archive_header_overlay'],
	'choices'  => array(
		''  => esc_attr__( 'Default', 'sala' ),
		'0' => esc_attr__( 'No', 'sala' ),
		'1' => esc_attr__( 'Yes', 'sala' ),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'portfolio_archive_header_float',
	'label'    => esc_html__( 'Header Float', 'sala' ),
	'section'  => 'portfolio_archive',
	'priority' => $priority++,
	'default'  => $default['portfolio_archive_header_float'],
	'choices'  => array(
		''  => esc_attr__( 'Default', 'sala' ),
		'0' => esc_attr__( 'No', 'sala' ),
		'1' => esc_attr__( 'Yes', 'sala' ),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'portfolio_archive_header_skin',
	'label'    => esc_html__( 'Header Skin', 'sala' ),
	'section'  => 'portfolio_archive',
	'priority' => $priority++,
	'default'  => $default['portfolio_archive_header_skin'],
	'choices'  => array(
		''      => esc_attr__( 'Default', 'sala' ),
		'dark'  => esc_attr__( 'Dark', 'sala' ),
		'light' => esc_attr__( 'Light', 'sala' ),
	),
) );
