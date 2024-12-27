<?php
Sala_Kirki::add_section( 'page_title_general', array(
	'title' => esc_attr__( 'General', 'sala' ),
	'panel' => $panel,
) );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'page_title_layout',
	'label'       => esc_attr__( 'Global Page Title', 'sala' ),
	'description' => esc_attr__( 'Select default title bar that displays on all pages.', 'sala' ),
	'section'     => 'page_title_general',
	'priority'    => $priority++,
	'default'     => '01',
	'choices'     => [
		'none' 	=> esc_attr__( 'None', 'sala' ),
		'01' 	=> esc_attr__('01', 'sala'),
		'02' 	=> esc_attr__('02', 'sala'),
		'03' 	=> esc_attr__('03', 'sala'),
		'04' 	=> esc_attr__('04', 'sala'),
	],
) );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => 'page_title_general_heading',
	'label'    => esc_attr__( 'Heading', 'sala' ),
	'section'  => 'page_title_general',
	'priority' => $priority++,
] );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'page_title_search_title',
	'label'       => esc_attr__( 'Search Heading', 'sala' ),
	'description' => esc_attr__( 'Enter text prefix that displays on search results page.', 'sala' ),
	'section'     => 'page_title_general',
	'priority'    => $priority++,
	'default'     => esc_attr__( 'Search results for: ', 'sala' ),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'page_title_home_title',
	'label'       => esc_attr__( 'Home Heading', 'sala' ),
	'description' => esc_attr__( 'Enter text that displays on front latest posts page.', 'sala' ),
	'section'     => 'page_title_general',
	'priority'    => $priority++,
	'default'     => esc_attr__( 'Blog', 'sala' ),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'page_title_archive_category_title',
	'label'       => esc_attr__( 'Archive Category Heading', 'sala' ),
	'description' => esc_attr__( 'Enter text prefix that displays on archive category page.', 'sala' ),
	'section'     => 'page_title_general',
	'priority'    => $priority++,
	'default'     => esc_attr__( 'Category: ', 'sala' ),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'page_title_archive_tag_title',
	'label'       => esc_attr__( 'Archive Tag Heading', 'sala' ),
	'description' => esc_attr__( 'Enter text prefix that displays on archive tag page.', 'sala' ),
	'section'     => 'page_title_general',
	'priority'    => $priority++,
	'default'     => esc_attr__( 'Tag: ', 'sala' ),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'page_title_archive_author_title',
	'label'       => esc_attr__( 'Archive Author Heading', 'sala' ),
	'description' => esc_attr__( 'Enter text prefix that displays on archive author page.', 'sala' ),
	'section'     => 'page_title_general',
	'priority'    => $priority++,
	'default'     => esc_attr__( 'Author: ', 'sala' ),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'page_title_archive_year_title',
	'label'       => esc_attr__( 'Archive Year Heading', 'sala' ),
	'description' => esc_attr__( 'Enter text prefix that displays on archive year page.', 'sala' ),
	'section'     => 'page_title_general',
	'priority'    => $priority++,
	'default'     => esc_attr__( 'Year: ', 'sala' ),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'page_title_archive_month_title',
	'label'       => esc_attr__( 'Archive Month Heading', 'sala' ),
	'description' => esc_attr__( 'Enter text prefix that displays on archive month page.', 'sala' ),
	'section'     => 'page_title_general',
	'priority'    => $priority++,
	'default'     => esc_attr__( 'Month: ', 'sala' ),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'page_title_archive_day_title',
	'label'       => esc_attr__( 'Archive Day Heading', 'sala' ),
	'description' => esc_attr__( 'Enter text prefix that displays on archive day page.', 'sala' ),
	'section'     => 'page_title_general',
	'priority'    => $priority++,
	'default'     => esc_attr__( 'Day: ', 'sala' ),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'page_title_single_blog_title',
	'label'       => esc_attr__( 'Single Blog Heading', 'sala' ),
	'description' => esc_attr__( 'Enter text that displays on single blog posts. Leave blank to use post title.', 'sala' ),
	'section'     => 'page_title_general',
	'priority'    => $priority++,
	'default'     => esc_attr__( 'Blog', 'sala' ),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'page_title_archive_portfolio_title',
	'label'       => esc_attr__( 'Archive Portfolio Heading', 'sala' ),
	'description' => esc_attr__( 'Enter text that displays on archive portfolio pages.', 'sala' ),
	'section'     => 'page_title_general',
	'priority'    => $priority++,
	'default'     => esc_attr__( 'Portfolios', 'sala' ),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'page_title_single_portfolio_title',
	'label'       => esc_attr__( 'Single Portfolio Heading', 'sala' ),
	'description' => esc_attr__( 'Enter text that displays on single portfolio pages. Leave blank to use portfolio title.', 'sala' ),
	'section'     => 'page_title_general',
	'priority'    => $priority++,
	'default'     => esc_attr__( 'Portfolio', 'sala' ),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'page_title_single_product_title',
	'label'       => esc_attr__( 'Single Product Heading', 'sala' ),
	'description' => esc_attr__( 'Enter text that displays on single product pages. Leave blank to use product title.', 'sala' ),
	'section'     => 'page_title_general',
	'priority'    => $priority++,
	'default'     => esc_attr__( 'Our Shop', 'sala' ),
) );
