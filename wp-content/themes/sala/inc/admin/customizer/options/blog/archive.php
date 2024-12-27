<?php

// Blog archive
Sala_Kirki::add_section( 'blog_archive', array(
	'title'    => esc_html__( 'Blog Archive', 'sala' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => 'blog_archive_customize',
	'label'    => esc_html__( 'Blog Archive', 'sala' ),
	'section'  => 'blog_archive',
	'priority' => $priority++,
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'radio-image',
	'settings'  => 'blog_archive_sidebar_position',
	'label'     => esc_html__( 'Sidebar Layout', 'sala' ),
	'section'   => 'blog_archive',
	'transport' => 'auto',
	'priority'  => $priority++,
	'default'   => $default['blog_archive_sidebar_position'],
	'choices'   => [
		'left'  => get_template_directory_uri() . '/inc/admin/customizer/assets/images/left-sidebar.png',
		'none'  => get_template_directory_uri() . '/inc/admin/customizer/assets/images/no-sidebar.png',
		'right' => get_template_directory_uri() . '/inc/admin/customizer/assets/images/right-sidebar.png',
	],
	'preset' => array(
		'left' => array(
			'settings' => array(
				'blog_desktop_column' => '2',
				'blog_tablet_column'  => '1',
				'blog_mobile_column'  => '1',
			),
		),
		'none' => array(
			'settings' => array(
				'blog_desktop_column' => '3',
				'blog_tablet_column'  => '2',
				'blog_mobile_column'  => '1',
			),
		),
		'right' => array(
			'settings' => array(
				'blog_desktop_column' => '2',
				'blog_tablet_column'  => '1',
				'blog_mobile_column'  => '1',
			),
		),
	),
] );

Sala_Kirki::add_field( 'theme', array(
	'type'            => 'select',
	'settings'        => 'blog_archive_active_sidebar',
	'label'           => esc_html__( 'Sidebar', 'sala' ),
	'description'     => esc_html__( 'Select sidebar that will display on blog archive pages.', 'sala' ),
	'section'         => 'blog_archive',
	'priority'        => $priority++,
	'default'         => $default['blog_archive_active_sidebar'],
	'choices'         => Sala_Helper::get_registered_sidebars(),
	'active_callback' => [
		[
			'setting'  => 'blog_archive_sidebar_position',
			'operator' => '!==',
			'value'    => 'none',
		]
	],
) );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'slider',
	'settings'  => 'blog_archive_sidebar_width',
	'label'     => esc_html__( 'Sidebar Width', 'sala' ),
	'section'   => 'blog_archive',
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => $default['blog_archive_sidebar_width'],
	'choices'   => [
		'min'  => 270,
		'max'  => 420,
		'step' => 1,
	],
	'output'    => array(
        array(
            'element'  => '#secondary.sidebar-blog-archive',
            'property' => 'flex-basis',
            'units'    => 'px',
			'media_query' 	=> '@media (min-width: 992px)',
        ),
		array(
            'element'  => '#secondary.sidebar-blog-archive',
            'property' => 'max-width',
            'units'    => 'px',
			'media_query' 	=> '@media (min-width: 992px)',
        ),
    ),
	'active_callback' => [
		[
			'setting'  => 'blog_archive_sidebar_position',
			'operator' => '!==',
			'value'    => 'none',
		]
	],
] );

Sala_Kirki::add_field('theme', [
    'type'     => 'select',
    'settings' => 'blog_archive_page_title_layout',
    'label'    => esc_html__( 'Page Title', 'sala' ),
    'section'  => 'blog_archive',
    'priority' => $priority++,
    'default'  => $default['blog_archive_page_title_layout'],
    'choices'  => Sala_Page_Title::get_list(true),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'blog_archive_display_categories',
    'label'    => esc_html__( 'Display Head Categories', 'sala' ),
    'section'  => 'blog_archive',
    'priority' => $priority++,
    'default'  => $default['blog_archive_display_categories'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'blog_archive_display_count_categories',
    'label'    => esc_html__( 'Display Count Categories', 'sala' ),
    'section'  => 'blog_archive',
    'priority' => $priority++,
    'default'  => $default['blog_archive_display_count_categories'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
	'active_callback' => [
        [
			'setting'  => 'blog_archive_display_categories',
			'operator' => '==',
			'value'    => 'show',
		]
	],
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'blog_archive_display_action',
    'label'    => esc_html__( 'Display Head Action', 'sala' ),
    'section'  => 'blog_archive',
    'priority' => $priority++,
    'default'  => $default['blog_archive_display_action'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'blog_archive_display_count_post',
    'label'    => esc_html__( 'Display Count Post', 'sala' ),
    'section'  => 'blog_archive',
    'priority' => $priority++,
    'default'  => $default['blog_archive_display_count_post'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
	'active_callback' => [
        [
			'setting'  => 'blog_archive_display_action',
			'operator' => '==',
			'value'    => 'show',
		]
	],
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'blog_archive_display_post_filter',
    'label'    => esc_html__( 'Display Post Filter', 'sala' ),
    'section'  => 'blog_archive',
    'priority' => $priority++,
    'default'  => $default['blog_archive_display_post_filter'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
	'active_callback' => [
        [
			'setting'  => 'blog_archive_display_action',
			'operator' => '==',
			'value'    => 'show',
		]
	],
]);

Sala_Kirki::add_field( 'theme', [
	'type'     => 'select',
	'settings' => 'blog_archive_pagination_type',
	'label'    => esc_html__( 'Pagination Type', 'sala' ),
	'section'  => 'blog_archive',
	'priority' => $priority++,
	'default'  => $default['blog_archive_pagination_type'],
	'choices'  => [
		'navigation' => esc_attr__( 'Navigation Number', 'sala' ),
		'loadmore'   => esc_attr__( 'Load More', 'sala' ),
		'infinite'   => esc_attr__( 'Infinity Scroll', 'sala' ),
	],
] );

Sala_Kirki::add_field('theme', [
    'type'      => 'radio-buttonset',
    'settings'  => 'blog_archive_pagination_position',
    'label'     => esc_html__( 'Pagination Position', 'sala' ),
    'section'   => 'blog_archive',
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => $default['blog_archive_pagination_position'],
    'choices'   => array(
        'left'   => esc_attr__('Left', 'sala'),
        'center' => esc_attr__('Center', 'sala'),
        'right'  => esc_attr__('Right', 'sala'),
    ),
]);

Sala_Kirki::add_field( 'theme', [
	'type'            => 'notice',
	'settings'        => 'blog_column',
	'label'           => esc_html__( 'Grid Column', 'sala' ),
	'section'         => 'blog_archive',
	'priority'        => $priority++,
	'active_callback' => [
		[
			'setting'  => 'blog_archive_post_layout',
			'operator' => 'in',
			'value'    => array('grid','masonry'),
		]
	],
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'radio-image',
	'settings'  => 'blog_desktop_column',
	'label'     => esc_html__( 'Desktop', 'sala' ),
	'section'   => 'blog_archive',
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => $default['blog_desktop_column'],
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
			'setting'  => 'blog_archive_post_layout',
			'operator' => 'in',
			'value'    => array('grid','masonry'),
		]
	],
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'radio-image',
	'settings'  => 'blog_tablet_column',
	'label'     => esc_html__( 'Tablet', 'sala' ),
	'section'   => 'blog_archive',
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => $default['blog_tablet_column'],
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
			'setting'  => 'blog_archive_post_layout',
			'operator' => 'in',
			'value'    => array('grid','masonry'),
		]
	],
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'radio-image',
	'settings'  => 'blog_mobile_column',
	'label'     => esc_html__( 'Mobile', 'sala' ),
	'section'   => 'blog_archive',
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => $default['blog_mobile_column'],
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
			'setting'  => 'blog_archive_post_layout',
			'operator' => 'in',
			'value'    => array('grid','masonry'),
		]
	],
] );

Sala_Kirki::add_field('theme', array(
    'type'     => 'number',
    'settings' => 'blog_content_post_gutter',
    'label'    => esc_html__( 'Gutter', 'sala' ),
    'section'  => 'blog_archive',
    'priority' => $priority++,
    'default'  => $default['blog_content_post_gutter'],
    'choices'  => [
		'min'  => 0,
		'max'  => 100,
		'step' => 1,
	],
	'active_callback' => [
		[
			'setting'  => 'blog_archive_post_layout',
			'operator' => 'in',
			'value'    => array('grid','masonry'),
		]
	],
));

Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => 'blog_content_post',
	'label'    => esc_html__( 'Content Post', 'sala' ),
	'section'  => 'blog_archive',
	'priority' => $priority++,
] );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'radio-image',
	'settings' => 'blog_archive_post_layout',
	'label'    => esc_html__( 'Content Layout', 'sala' ),
	'section'  => 'blog_archive',
	'priority' => $priority++,
	'default'  => $default['blog_archive_post_layout'],
	'choices'  => [
		'default' => get_template_directory_uri() . '/inc/admin/customizer/assets/images/layout-default.png',
		'grid'    => get_template_directory_uri() . '/inc/admin/customizer/assets/images/layout-grid.png',
		'list'    => get_template_directory_uri() . '/inc/admin/customizer/assets/images/layout-list.png',
		'masonry' => get_template_directory_uri() . '/inc/admin/customizer/assets/images/layout-masonry.png',
	],
	'preset' => array(
		'default' => array(
			'settings' => array(
				'blog_archive_sidebar_position'    => 'none',
				'blog_content_post_image_size'     => '840x540',
				'blog_archive_pagination_position' => 'left',
				'blog_content_post_excerpt'        => 'show',
				'blog_content_post_excerpt_number' => 35,
				'blog_desktop_column'              => '1',
				'blog_tablet_column'               => '1',
				'blog_mobile_column'               => '1',
			),
		),
		'grid' => array(
			'settings' => array(
				'blog_archive_sidebar_position'    => 'none',
				'blog_content_post_image_size'     => '740x740',
				'blog_archive_pagination_position' => 'center',
				'blog_content_post_excerpt'        => 'show',
				'blog_content_post_excerpt_number' => 15,
				'blog_desktop_column'              => '3',
				'blog_tablet_column'               => '2',
				'blog_mobile_column'               => '1',
			),
		),
		'list' => array(
			'settings' => array(
				'blog_archive_sidebar_position'    => 'none',
				'blog_content_post_image_size'     => '470x370',
				'blog_archive_pagination_position' => 'center',
				'blog_content_post_excerpt'        => 'show',
				'blog_content_post_excerpt_number' => 30,
				'blog_desktop_column'              => '1',
				'blog_tablet_column'               => '1',
				'blog_mobile_column'               => '1',
			),
		),
		'masonry' => array(
			'settings' => array(
				'blog_archive_sidebar_position'    => 'none',
				'blog_archive_pagination_position' => 'center',
				'blog_content_post_excerpt'        => 'show',
				'blog_content_post_excerpt_number' => 15,
				'blog_desktop_column'              => '3',
				'blog_tablet_column'               => '2',
				'blog_mobile_column'               => '1',
			),
		),
	),
] );

Sala_Kirki::add_field('theme', array(
    'type'     => 'radio-buttonset',
    'settings' => 'blog_content_post_card',
    'label'    => esc_html__('Display Card Style', 'sala'),
    'section'  => 'blog_archive',
    'priority' => $priority++,
    'default'  => $default['blog_content_post_card'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
	'active_callback' => [
		[
			'setting'  => 'blog_content_post_box',
			'operator' => '==',
			'value'    => 'hide',
		],
		[
			'setting'  => 'blog_content_post_box_background',
			'operator' => '==',
			'value'    => 'hide',
		]
	],
));

Sala_Kirki::add_field('theme', array(
    'type'     => 'radio-buttonset',
    'settings' => 'blog_content_post_box',
    'label'    => esc_html__('Display Box Style', 'sala'),
    'section'  => 'blog_archive',
    'priority' => $priority++,
    'default'  => $default['blog_content_post_box'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
	'active_callback' => [
		[
			'setting'  => 'blog_content_post_card',
			'operator' => '==',
			'value'    => 'hide',
		],
		[
			'setting'  => 'blog_content_post_box_background',
			'operator' => '==',
			'value'    => 'hide',
		]
	],
));

Sala_Kirki::add_field('theme', array(
    'type'     => 'radio-buttonset',
    'settings' => 'blog_content_post_box_background',
    'label'    => esc_html__('Display Box Background Style', 'sala'),
    'section'  => 'blog_archive',
    'priority' => $priority++,
    'default'  => $default['blog_content_post_box_background'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
	'active_callback' => [
		[
			'setting'  => 'blog_content_post_card',
			'operator' => '==',
			'value'    => 'hide',
		],
		[
			'setting'  => 'blog_content_post_box',
			'operator' => '==',
			'value'    => 'hide',
		]
	],
));

Sala_Kirki::add_field( 'theme', [
	'type'            => 'text',
	'settings'        => 'blog_content_post_image_size',
	'label'           => esc_html__( 'Image size', 'sala' ),
	'section'         => 'blog_archive',
	'priority'        => $priority++,
	'default'         => $default['blog_content_post_image_size'],
	'active_callback' => [
		[
			'setting'  => 'blog_archive_post_layout',
			'operator' => '!==',
			'value'    => 'masonry',
		]
	],
] );

Sala_Kirki::add_field('theme', array(
    'type'     => 'radio-buttonset',
    'settings' => 'blog_content_post_categories',
    'label'    => esc_html__('Display Categories', 'sala'),
    'section'  => 'blog_archive',
    'priority' => $priority++,
    'default'  => $default['blog_content_post_categories'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
));

Sala_Kirki::add_field('theme', array(
    'type'     => 'radio-buttonset',
    'settings' => 'blog_content_post_time',
    'label'    => esc_html__('Display Time', 'sala'),
    'section'  => 'blog_archive',
    'priority' => $priority++,
    'default'  => $default['blog_content_post_time'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
));

Sala_Kirki::add_field('theme', array(
    'type'     => 'radio-buttonset',
    'settings' => 'blog_content_post_comment',
    'label'    => esc_html__('Display Comment', 'sala'),
    'section'  => 'blog_archive',
    'priority' => $priority++,
    'default'  => $default['blog_content_post_comment'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
));

Sala_Kirki::add_field('theme', array(
    'type'     => 'radio-buttonset',
    'settings' => 'blog_content_post_excerpt',
    'label'    => esc_html__('Display Excerpt', 'sala'),
    'section'  => 'blog_archive',
    'priority' => $priority++,
    'default'  => $default['blog_content_post_excerpt'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
));

Sala_Kirki::add_field('theme', array(
    'type'     => 'radio-buttonset',
    'settings' => 'blog_content_post_button',
    'label'    => esc_html__('Display Button', 'sala'),
    'section'  => 'blog_archive',
    'priority' => $priority++,
    'default'  => $default['blog_content_post_button'],
    'choices'  => array(
        'hide' => esc_attr__('Hide', 'sala'),
        'show' => esc_attr__('Show', 'sala'),
    ),
));

Sala_Kirki::add_field('theme', array(
    'type'     => 'number',
    'settings' => 'blog_content_post_excerpt_number',
    'label'    => esc_html__( 'Excerpt Word', 'sala' ),
    'section'  => 'blog_archive',
    'priority' => $priority++,
    'default'  => $default['blog_content_post_excerpt_number'],
    'choices'  => [
		'min'  => 0,
		'max'  => 50,
		'step' => 1,
	],
	'active_callback' => [
		[
			'setting'  => 'blog_content_post_excerpt',
			'operator' => '==',
			'value'    => 'show',
		]
	],
));

Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => 'blog_archive_header',
	'label'    => esc_html__( 'Header', 'sala' ),
	'section'  => 'blog_archive',
	'priority' => $priority++,
] );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'blog_archive_header_type',
	'label'       => esc_html__( 'Header Style', 'sala' ),
	'description' => esc_html__( 'Select header style that displays on blog archive pages.', 'sala' ),
	'section'     => 'blog_archive',
	'priority'    => $priority++,
	'default'     => $default['blog_archive_header_type'],
	'choices'     => Sala_Customize::sala_get_headers(),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'blog_archive_header_overlay',
	'label'    => esc_html__( 'Header Overlay', 'sala' ),
	'section'  => 'blog_archive',
	'priority' => $priority++,
	'default'  => $default['blog_archive_header_overlay'],
	'choices'  => array(
		''  => esc_attr__( 'Default', 'sala' ),
		'0' => esc_attr__( 'No', 'sala' ),
		'1' => esc_attr__( 'Yes', 'sala' ),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'blog_archive_header_float',
	'label'    => esc_html__( 'Header Float', 'sala' ),
	'section'  => 'blog_archive',
	'priority' => $priority++,
	'default'  => $default['blog_archive_header_float'],
	'choices'  => array(
		''  => esc_attr__( 'Default', 'sala' ),
		'0' => esc_attr__( 'No', 'sala' ),
		'1' => esc_attr__( 'Yes', 'sala' ),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'blog_archive_header_skin',
	'label'    => esc_html__( 'Header Skin', 'sala' ),
	'section'  => 'blog_archive',
	'priority' => $priority++,
	'default'  => $default['blog_archive_header_skin'],
	'choices'  => array(
		''      => esc_attr__( 'Default', 'sala' ),
		'dark'  => esc_attr__( 'Dark', 'sala' ),
		'light' => esc_attr__( 'Light', 'sala' ),
	),
) );
