<?php

$priority = 1;
$section  = 'color';

// Color
Sala_Kirki::add_section( $section, array(
	'title'    => esc_html__( 'Color', 'sala' ),
	'priority' => $priority++,
) );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'notice',
	'settings' => 'notice_light_color',
	'label'    => esc_html__( 'Light Theme', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'color-alpha',
	'settings'  => 'text_color',
	'label'     => esc_html__( 'Text Color', 'sala' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => $default['text_color'],
	'output'    => array(
		array(
			'element'  => 'body',
			'property' => 'color',
		),
	),
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'color-alpha',
	'settings'  => 'accent_color',
	'label'     => esc_html__( 'Accent Color', 'sala' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => $default['accent_color'],
	'output'    => array(
        array(
            'element'  => '.accent-color,.sala-blog-categories li.active a,.sala-pagination li .page-numbers.current,.sala-pagination li a:hover',
            'property' => 'color',
        ),
		array(
            'element'  => '.sala-blog-categories li.active a,
			.wp-block-search .wp-block-search__button,
			.sala-swiper .swiper-nav-button:hover,blockquote,
			select:focus,textarea:focus,
			input[type="text"]:focus,input[type="email"]:focus,
			input[type="password"]:focus,input[type="number"]:focus,
			input[type="search"]:focus',
            'property' => 'border-color',
        ),
		array(
            'element'  => '.page-scroll-up,.widget_calendar #today,.widget .tagcloud a:hover,.widget_search .search-submit:hover,.sala-swiper .swiper-nav-button:hover,
			.widget_product_search .search-submit:hover,.search-form .search-submit:hover,.single .post-tags a:hover,.wp-block-search .wp-block-search__button,.wp-block-tag-cloud a:hover',
            'property' => 'background-color',
        ),
    ),
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'color-alpha',
	'settings'  => 'primary_color',
	'label'     => esc_html__( 'Heading Color', 'sala' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => $default['primary_color'],
	'output'    => array(
        array(
            'element'  => 'h1,h2,h3,h4,h5,h6,.heading-font,strong,b',
            'property' => 'color',
        ),
    ),
] );

Sala_Kirki::add_field( 'theme', array(
	'type'      => 'multicolor',
	'settings'  => 'link_color',
	'label'     => esc_html__( 'Link Color', 'sala' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'normal' => esc_attr__( 'Normal', 'sala' ),
		'hover'  => esc_attr__( 'Hover', 'sala' ),
	),
	'default'     => array(
		'normal' => $default['primary_color'],
		'hover'  => $default['accent_color'],
	),
	'output'      => array(
		array(
			'choice'   => 'normal',
			'element'  => 'a',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => 'a:hover,a:focus,.widget_rss li a:hover',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '.main-menu.desktop-menu .menu > li > a .menu-item-wrap::after',
			'property' => 'border-color',
		),
	),
) );

