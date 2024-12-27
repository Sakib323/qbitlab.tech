<?php

// Single Product
Sala_Kirki::add_section( 'single_product', array(
	'title'    => esc_html__( 'Single Product', 'sala' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => 'single_product_customize',
	'label'    => esc_html__( 'Single Product', 'sala' ),
	'section'  => 'single_product',
	'priority' => $priority++,
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'radio-image',
	'settings'  => 'single_product_sidebar_position',
	'label'     => esc_html__( 'Sidebar Layout', 'sala' ),
	'section'   => 'single_product',
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => $default['single_product_sidebar_position'],
	'choices'   => [
		'left'  => get_template_directory_uri() . '/inc/admin/customizer/assets/images/left-sidebar.png',
		'none'  => get_template_directory_uri() . '/inc/admin/customizer/assets/images/no-sidebar.png',
		'right' => get_template_directory_uri() . '/inc/admin/customizer/assets/images/right-sidebar.png',
	],
] );

Sala_Kirki::add_field( 'theme', array(
	'type'            => 'select',
	'settings'        => 'single_product_active_sidebar',
	'label'           => esc_html__( 'Sidebar', 'sala' ),
	'description'     => esc_html__( 'Select sidebar that will display on shop archive pages.', 'sala' ),
	'section'         => 'single_product',
	'priority'        => $priority++,
	'default'         => $default['single_product_active_sidebar'],
	'choices'         => Sala_Helper::get_registered_sidebars(),
	'active_callback' => [
		[
			'setting'  => 'single_product_sidebar_position',
			'operator' => '!==',
			'value'    => 'none',
        ]
	],
) );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'slider',
	'settings'  => 'single_product_sidebar_width',
	'label'     => esc_html__( 'Sidebar Width', 'sala' ),
	'section'   => 'single_product',
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => $default['single_product_sidebar_width'],
	'choices'   => [
		'min'  => 270,
		'max'  => 420,
		'step' => 1,
	],
    'output'    => array(
        array(
            'element'  => '#secondary.sidebar-single-product',
            'property' => 'flex-basis',
            'units'    => 'px',
        ),
		array(
            'element'  => '#secondary.sidebar-single-product',
            'property' => 'max-width',
            'units'    => 'px',
        ),
    ),
	'active_callback' => [
		[
			'setting'  => 'single_product_sidebar_position',
			'operator' => '!==',
			'value'    => 'none',
        ],
	],
] );

Sala_Kirki::add_field('theme', [
    'type'     => 'select',
    'settings' => 'single_product_page_title_layout',
    'label'    => esc_html__( 'Page Title', 'sala' ),
    'section'  => 'single_product',
    'priority' => $priority++,
    'default'  => $default['single_product_page_title_layout'],
    'choices'  => Sala_Page_Title::get_list(true),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'single_product_breadcrumb_enable',
    'label'    => esc_html__( 'Display Breadcrumb', 'sala' ),
    'section'  => 'single_product',
    'priority' => $priority++,
    'default'  => $default['single_product_breadcrumb_enable'],
    'choices'  => array(
        '0' => esc_attr__('Hide', 'sala'),
        '1' => esc_attr__('Show', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'single_product_sale_flash_enable',
    'label'    => esc_html__( 'Display Sale Flash', 'sala' ),
    'section'  => 'single_product',
    'priority' => $priority++,
    'default'  => $default['single_product_sale_flash_enable'],
    'choices'  => array(
        '0' => esc_attr__('Hide', 'sala'),
        '1' => esc_attr__('Show', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'single_product_images_enable',
    'label'    => esc_html__( 'Display Images', 'sala' ),
    'section'  => 'single_product',
    'priority' => $priority++,
    'default'  => $default['single_product_images_enable'],
    'choices'  => array(
        '0' => esc_attr__('Hide', 'sala'),
        '1' => esc_attr__('Show', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'single_product_title_enable',
    'label'    => esc_html__( 'Display Title', 'sala' ),
    'section'  => 'single_product',
    'priority' => $priority++,
    'default'  => $default['single_product_title_enable'],
    'choices'  => array(
        '0' => esc_attr__('Hide', 'sala'),
        '1' => esc_attr__('Show', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'single_product_rating_enable',
    'label'    => esc_html__( 'Display Rating', 'sala' ),
    'section'  => 'single_product',
    'priority' => $priority++,
    'default'  => $default['single_product_rating_enable'],
    'choices'  => array(
        '0' => esc_attr__('Hide', 'sala'),
        '1' => esc_attr__('Show', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'single_product_price_enable',
    'label'    => esc_html__( 'Display Price', 'sala' ),
    'section'  => 'single_product',
    'priority' => $priority++,
    'default'  => $default['single_product_price_enable'],
    'choices'  => array(
        '0' => esc_attr__('Hide', 'sala'),
        '1' => esc_attr__('Show', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'single_product_excerpt_enable',
    'label'    => esc_html__( 'Display Excerpt', 'sala' ),
    'section'  => 'single_product',
    'priority' => $priority++,
    'default'  => $default['single_product_excerpt_enable'],
    'choices'  => array(
        '0' => esc_attr__('Hide', 'sala'),
        '1' => esc_attr__('Show', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'single_product_add_to_cart_enable',
    'label'    => esc_html__( 'Display Button "Add to Cart"', 'sala' ),
    'section'  => 'single_product',
    'priority' => $priority++,
    'default'  => $default['single_product_add_to_cart_enable'],
    'choices'  => array(
        '0' => esc_attr__('Hide', 'sala'),
        '1' => esc_attr__('Show', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'single_product_meta_enable',
    'label'    => esc_html__( 'Display Meta', 'sala' ),
    'section'  => 'single_product',
    'priority' => $priority++,
    'default'  => $default['single_product_meta_enable'],
    'choices'  => array(
        '0' => esc_attr__('Hide', 'sala'),
        '1' => esc_attr__('Show', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'single_product_tabs_enable',
    'label'    => esc_html__( 'Display Tabs', 'sala' ),
    'section'  => 'single_product',
    'priority' => $priority++,
    'default'  => $default['single_product_tabs_enable'],
    'choices'  => array(
        '0' => esc_attr__('Hide', 'sala'),
        '1' => esc_attr__('Show', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'single_product_up_sells_enable',
    'label'    => esc_html__( 'Display Upsells', 'sala' ),
    'section'  => 'single_product',
    'priority' => $priority++,
    'default'  => $default['single_product_up_sells_enable'],
    'choices'  => array(
        '0' => esc_attr__('Hide', 'sala'),
        '1' => esc_attr__('Show', 'sala'),
    ),
]);

Sala_Kirki::add_field('theme', [
    'type'     => 'radio-buttonset',
    'settings' => 'single_product_related_enable',
    'label'    => esc_html__( 'Display Related', 'sala' ),
    'section'  => 'single_product',
    'priority' => $priority++,
    'default'  => $default['single_product_related_enable'],
    'choices'  => array(
        '0' => esc_attr__('Hide', 'sala'),
        '1' => esc_attr__('Show', 'sala'),
    ),
]);

Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => 'single_product_header',
	'label'    => esc_attr__( 'Header', 'sala' ),
	'section'  => 'single_product',
	'priority' => $priority++,
] );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'single_product_header_type',
	'label'       => esc_html__( 'Header Style', 'sala' ),
	'description' => esc_html__( 'Select header style that displays on single product page.', 'sala' ),
	'section'     => 'single_product',
	'priority'    => $priority++,
	'default'     => $default['single_product_header_type'],
	'choices'     => Sala_Customize::sala_get_headers(),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_product_header_overlay',
	'label'    => esc_html__( 'Header Overlay', 'sala' ),
	'section'  => 'single_product',
	'priority' => $priority++,
	'default'  => $default['single_product_header_overlay'],
	'choices'  => array(
		''  => esc_html__( 'Default', 'sala' ),
		'0' => esc_html__( 'No', 'sala' ),
		'1' => esc_html__( 'Yes', 'sala' ),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_product_header_float',
	'label'    => esc_html__( 'Header Float', 'sala' ),
	'section'  => 'single_product',
	'priority' => $priority++,
	'default'  => $default['single_product_header_float'],
	'choices'  => array(
		''  => esc_attr__( 'Default', 'sala' ),
		'0' => esc_attr__( 'No', 'sala' ),
		'1' => esc_attr__( 'Yes', 'sala' ),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_product_header_skin',
	'label'    => esc_html__( 'Header Skin', 'sala' ),
	'section'  => 'single_product',
	'priority' => $priority++,
	'default'  => $default['single_product_header_skin'],
	'choices'  => array(
		''      => esc_html__( 'Default', 'sala' ),
		'dark'  => esc_html__( 'Dark', 'sala' ),
		'light' => esc_html__( 'Light', 'sala' ),
	),
) );
