<?php

// Shop archive
Sala_Kirki::add_section( 'product_archive', array(
	'title'    => esc_html__( 'Shop Archive', 'sala' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => 'product_archive_customize',
	'label'    => esc_html__( 'Shop Archive', 'sala' ),
	'section'  => 'product_archive',
	'priority' => $priority++,
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'radio-image',
	'settings'  => 'product_archive_sidebar_position',
	'label'     => esc_html__( 'Sidebar Layout', 'sala' ),
	'section'   => 'product_archive',
	'transport' => 'auto',
	'priority'  => $priority++,
	'default'   => $default['product_archive_sidebar_position'],
	'choices'   => [
		'left'  => get_template_directory_uri() . '/inc/admin/customizer/assets/images/left-sidebar.png',
		'none'  => get_template_directory_uri() . '/inc/admin/customizer/assets/images/no-sidebar.png',
		'right' => get_template_directory_uri() . '/inc/admin/customizer/assets/images/right-sidebar.png',
	],
	'preset' => array(
		'left' => array(
			'settings' => array(
				'product_archive_desktop_column' => '2',
				'product_archive_tablet_column'  => '1',
				'product_archive_mobile_column'  => '1',
			),
		),
		'none' => array(
			'settings' => array(
				'product_archive_desktop_column' => '3',
				'product_archive_tablet_column'  => '2',
				'product_archive_mobile_column'  => '1',
			),
		),
		'right' => array(
			'settings' => array(
				'product_archive_desktop_column' => '2',
				'product_archive_tablet_column'  => '1',
				'product_archive_mobile_column'  => '1',
			),
		),
	),
] );

Sala_Kirki::add_field( 'theme', array(
	'type'            => 'select',
	'settings'        => 'product_archive_active_sidebar',
	'label'           => esc_html__( 'Sidebar', 'sala' ),
	'description'     => esc_html__( 'Select sidebar that will display on shop archive pages.', 'sala' ),
	'section'         => 'product_archive',
	'priority'        => $priority++,
	'default'         => $default['product_archive_active_sidebar'],
	'choices'         => Sala_Helper::get_registered_sidebars(),
	'active_callback' => [
		[
			'setting'  => 'product_archive_sidebar_position',
			'operator' => '!==',
			'value'    => 'none',
		]
	],
) );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'slider',
	'settings'  => 'product_archive_sidebar_width',
	'label'     => esc_html__( 'Sidebar Width', 'sala' ),
	'section'   => 'product_archive',
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => $default['product_archive_sidebar_width'],
	'choices'   => [
		'min'  => 270,
		'max'  => 420,
		'step' => 1,
	],
	'output'    => array(
        array(
            'element'  => '#secondary.sidebar-product-archive',
            'property' => 'flex-basis',
            'units'    => 'px',
        ),
		array(
            'element'  => '#secondary.sidebar-product-archive',
            'property' => 'max-width',
            'units'    => 'px',
        ),
    ),
	'active_callback' => [
		[
			'setting'  => 'product_archive_sidebar_position',
			'operator' => '!==',
			'value'    => 'none',
		]
	],
] );

Sala_Kirki::add_field('theme', [
    'type'     => 'select',
    'settings' => 'product_archive_page_title_layout',
    'label'    => esc_html__( 'Page Title', 'sala' ),
    'section'  => 'product_archive',
    'priority' => $priority++,
    'default'  => $default['product_archive_page_title_layout'],
    'choices'  => Sala_Page_Title::get_list(true),
]);

Sala_Kirki::add_field('theme', [
    'type'      => 'radio-buttonset',
    'settings'  => 'product_archive_sorting',
    'label'     => esc_html__( 'Display Head Sorting', 'sala' ),
    'section'   => 'product_archive',
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => $default['product_archive_sorting'],
    'choices'   => array(
        '0' => esc_attr__('Hide', 'sala'),
        '1' => esc_attr__('Show', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', array(
    'type'      => 'number',
    'settings'  => 'product_archive_number_item',
    'label'     => esc_html__( 'Number Item', 'sala' ),
    'section'   => 'product_archive',
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => $default['product_archive_number_item'],
    'choices'   => [
		'min'  => 0,
		'max'  => 50,
		'step' => 1,
	],
));

Sala_Kirki::add_field( 'theme', [
	'type'      => 'select',
	'settings'  => 'product_archive_pagination_type',
	'label'     => esc_html__( 'Pagination Type', 'sala' ),
	'section'   => 'product_archive',
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => $default['product_archive_pagination_type'],
	'choices'   => [
		'navigation' => esc_attr__( 'Navigation Number', 'sala' ),
		'loadmore'   => esc_attr__( 'Load More', 'sala' ),
		'infinite'   => esc_attr__( 'Infinity Scroll', 'sala' ),
	],
] );

Sala_Kirki::add_field('theme', [
    'type'      => 'radio-buttonset',
    'settings'  => 'product_archive_pagination_position',
    'label'     => esc_html__( 'Pagination Position', 'sala' ),
    'section'   => 'product_archive',
    'priority'  => $priority++,
    'transport' => 'auto',
    'default'   => $default['product_archive_pagination_position'],
    'choices'   => array(
        'left'   => esc_attr__('Left', 'sala'),
        'center' => esc_attr__('Center', 'sala'),
        'right'  => esc_attr__('Right', 'sala'),
    ),
]);

Sala_Kirki::add_field( 'theme', [
	'type'            => 'notice',
	'settings'        => 'product_archive_column',
	'label'           => esc_html__( 'Grid Column', 'sala' ),
	'section'         => 'product_archive',
	'priority'        => $priority++,
	'active_callback' => [
		[
			'setting'  => 'product_archive_layout',
			'operator' => 'in',
			'value'    => array('grid','masonry'),
		]
	],
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'radio-image',
	'settings'  => 'product_archive_desktop_column',
	'label'     => esc_html__( 'Desktop', 'sala' ),
	'section'   => 'product_archive',
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => $default['product_archive_desktop_column'],
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
			'setting'  => 'product_archive_layout',
			'operator' => 'in',
			'value'    => array('grid','masonry'),
		]
	],
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'radio-image',
	'settings'  => 'product_archive_tablet_column',
	'label'     => esc_html__( 'Tablet', 'sala' ),
	'section'   => 'product_archive',
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => $default['product_archive_tablet_column'],
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
			'setting'  => 'product_archive_layout',
			'operator' => 'in',
			'value'    => array('grid','masonry'),
		]
	],
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'radio-image',
	'settings'  => 'product_archive_mobile_column',
	'label'     => esc_html__( 'Mobile', 'sala' ),
	'section'   => 'product_archive',
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => $default['product_archive_mobile_column'],
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
			'setting'  => 'product_archive_layout',
			'operator' => 'in',
			'value'    => array('grid','masonry'),
		]
	],
] );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => 'product_archive',
	'label'    => esc_html__( 'Content Post', 'sala' ),
	'section'  => 'product_archive',
	'priority' => $priority++,
] );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'radio-image',
	'settings' => 'product_archive_layout',
	'label'    => esc_html__( 'Content Layout', 'sala' ),
	'section'  => 'product_archive',
	'priority' => $priority++,
	'default'  => $default['product_archive_layout'],
	'choices'  => [
		'grid'    => get_template_directory_uri() . '/inc/admin/customizer/assets/images/layout-grid.png',
		'masonry' => get_template_directory_uri() . '/inc/admin/customizer/assets/images/layout-masonry.png',
	],
	'preset' => array(
		'grid' => array(
			'settings' => array(
				'product_archive_pagination_position' => 'center',
				'product_archive_desktop_column'      => '3',
				'product_archive_tablet_column'       => '2',
				'product_archive_mobile_column'       => '1',
			),
		),
		'masonry' => array(
			'settings' => array(
				'product_archive_pagination_position' => 'center',
				'product_archive_desktop_column'      => '3',
				'product_archive_tablet_column'       => '2',
				'product_archive_mobile_column'       => '1',
			),
		),
	),
] );

Sala_Kirki::add_field( 'theme', [
	'type'            => 'text',
	'settings'        => 'product_archive_image_size',
	'label'           => esc_html__( 'Image size', 'sala' ),
	'section'         => 'product_archive',
	'priority'        => $priority++,
	'default'         => $default['product_archive_image_size'],
	'active_callback' => [
		[
			'setting'  => 'product_archive_layout',
			'operator' => '!==',
			'value'    => 'masonry',
		]
	],
] );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => 'product_archive_header',
	'label'    => esc_html__( 'Header', 'sala' ),
	'section'  => 'product_archive',
	'priority' => $priority++,
] );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'product_archive_header_type',
	'label'       => esc_html__( 'Header Style', 'sala' ),
	'description' => esc_html__( 'Select header style that displays on shop page.', 'sala' ),
	'section'     => 'product_archive',
	'priority'    => $priority++,
	'default'     => $default['product_archive_header_type'],
	'choices'     => Sala_Customize::sala_get_headers(),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'product_archive_header_overlay',
	'label'    => esc_html__( 'Header Overlay', 'sala' ),
	'section'  => 'product_archive',
	'priority' => $priority++,
	'default'  => $default['product_archive_header_overlay'],
	'choices'  => array(
		''  => esc_attr__( 'Default', 'sala' ),
		'0' => esc_attr__( 'No', 'sala' ),
		'1' => esc_attr__( 'Yes', 'sala' ),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'product_archive_header_float',
	'label'    => esc_html__( 'Header Float', 'sala' ),
	'section'  => 'product_archive',
	'priority' => $priority++,
	'default'  => $default['product_archive_header_float'],
	'choices'  => array(
		''  => esc_attr__( 'Default', 'sala' ),
		'0' => esc_attr__( 'No', 'sala' ),
		'1' => esc_attr__( 'Yes', 'sala' ),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'product_archive_header_skin',
	'label'    => esc_html__( 'Header Skin', 'sala' ),
	'section'  => 'product_archive',
	'priority' => $priority++,
	'default'  => $default['product_archive_header_skin'],
	'choices'  => array(
		''      => esc_attr__( 'Default', 'sala' ),
		'dark'  => esc_attr__( 'Dark', 'sala' ),
		'light' => esc_attr__( 'Light', 'sala' ),
	),
) );
