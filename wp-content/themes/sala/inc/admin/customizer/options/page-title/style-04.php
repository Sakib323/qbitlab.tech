<?php
$section = 'page_title_04';
$prefix  = 'page_title_04_';

Sala_Kirki::add_section( $section , array(
	'title' => esc_attr__( 'Style 04', 'sala' ),
	'panel' => $panel,
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'background_type',
	'label'    => esc_html__( 'Background Type', 'sala' ),
	'section'  => $section,
	'default'  => 'classic',
	'choices'  => array(
		'classic'  => esc_html__( 'Classic', 'sala' ),
		'gradient' => esc_html__( 'Gradient', 'sala' ),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'      => 'background',
	'settings'  => $prefix . 'background',
	'label'     => esc_html__( 'Background Classic', 'sala' ),
	'section'   => $section,
	'transport' => 'auto',
	'default'   => array(
		'background-color'      => '',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
		'background-position'   => 'center center',
	),
	'output'          => array(
		array(
			'element' => '.page-title-04 .page-title-bg',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => $prefix . 'background_type',
			'operator' => '==',
			'value'    => 'classic',
		),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'      => 'multicolor',
	'settings'  => $prefix . 'background_gradient',
	'label'     => esc_html__( 'Background Gradient', 'sala' ),
	'section'   => $section,
	'transport' => 'auto',
	'choices'   => array(
		'color_1' => esc_attr__( 'Color 1', 'sala' ),
		'color_2' => esc_attr__( 'Color 2', 'sala' ),
	),
	'default'         => array(
		'color_1' => '#fff',
		'color_2' => '#eceefa',
	),
	'active_callback' => array(
		array(
			'setting'  => $prefix . 'background_type',
			'operator' => '==',
			'value'    => 'gradient',
		),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'bg_overlay_color',
	'label'       => esc_html__( 'Background Overlay', 'sala' ),
	'section'     => $section,
	'transport'   => 'auto',
	'default'     => 'rgba(0, 0, 0, 0)',
	'output'      => array(
		array(
			'element'  => '.page-title-04 .page-title-bg:before',
			'property' => 'background-color',
		),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'border_width',
	'label'     => esc_html__( 'Border Bottom Width', 'sala' ),
	'section'   => $section,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 50,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-title-04 .page-title-inner',
			'property' => 'border-bottom-width',
			'units'    => 'px',
		),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'border_color',
	'label'       => esc_html__( 'Border Color', 'sala' ),
	'section'     => $section,
	'transport'   => 'auto',
	'default'     => 'rgba(0, 0, 0, 0)',
	'output'      => array(
		array(
			'element'  => '.page-title-04 .page-title-inner',
			'property' => 'border-bottom-color',
		),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'padding_top',
	'label'     => esc_html__( 'Padding Top', 'sala' ),
	'section'   => $section,
	'transport' => 'auto',
	'default'   => 80,
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-title-04 .page-title-inner',
			'property' => 'padding-top',
			'units'    => 'px',
		),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'padding_bottom',
	'label'     => esc_html__( 'Padding Bottom', 'sala' ),
	'section'   => $section,
	'transport' => 'auto',
	'default'   => 80,
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-title-04 .page-title-inner',
			'property' => 'padding-bottom',
			'units'    => 'px',
		),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'margin_bottom',
	'label'     => esc_html__( 'Margin Bottom', 'sala' ),
	'section'   => $section,
	'default'   => 50,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-title.page-title-04',
			'property' => 'margin-bottom',
			'units'    => 'px',
		),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'notice',
	'settings' => $prefix . 'heading',
	'label'    => esc_attr__( 'Heading', 'sala' ),
	'section'  => $section,
) );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'heading_typography',
	'label'       => esc_html__( 'Font Family', 'sala' ),
	'description' => esc_html__( 'Controls the font family for the page title heading.', 'sala' ),
	'section'     => $section,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '600',
		'font-size'      => '56px',
		'line-height'    => '1.11',
		'letter-spacing' => '',
		'text-transform' => '',
		'color'          => $default['primary_color'],
	),
	'output'      => array(
		array(
			'element' => '.page-title-04 .heading',
		),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'notice',
	'settings' => $prefix . 'breadcrumb',
	'label'    => esc_attr__( 'Breadcrumb', 'sala' ),
	'section'  => $section,
) );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'breadcrumb_typography',
	'label'       => esc_html__( 'Typography', 'sala' ),
	'description' => esc_html__( 'Controls the typography for the breadcrumb text.', 'sala' ),
	'section'     => $section,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'font-size'      => '16px',
		'line-height'    => '1.75',
		'variant'        => '400',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output'      => array(
		array(
			'element' => '.page-title-04 .sala_breadcrumb li, .page-title-04 .sala_breadcrumb li a',
		),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'breadcrumb_text_color',
	'label'       => esc_html__( 'Text Color', 'sala' ),
	'section'     => $section,
	'transport'   => 'auto',
	'default'     => $default['primary_color'],
	'output'      => array(
		array(
			'element'  => '.page-title-04 .sala_breadcrumb li',
			'property' => 'color',
		),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => $prefix . 'breadcrumb_link_color',
	'label'       => esc_html__( 'Link Color', 'sala' ),
	'section'     => $section,
	'transport'   => 'auto',
	'choices'     => array(
		'normal' => esc_attr__( 'Normal', 'sala' ),
		'hover'  => esc_attr__( 'Hover', 'sala' ),
	),
	'default'     => array(
		'normal' => $default['text_color'],
		'hover'  => $default['primary_color'],
	),
	'output'      => array(
		array(
			'choice'   => 'normal',
			'element'  => '.page-title-04 .sala_breadcrumb a',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '.page-title-04 .sala_breadcrumb a:hover',
			'property' => 'color',
		),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'breadcrumb_separator_color',
	'label'       => esc_html__( 'Separator Color', 'sala' ),
	'section'     => $section,
	'default'     => $default['text_color'],
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '.page-title-04 .sala_breadcrumb li + li:before',
			'property' => 'color',
		),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'notice',
	'settings' => $prefix . 'responsive',
	'label'    => esc_attr__( 'Responsive', 'sala' ),
	'section'  => $section,
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'notice',
	'settings' => $prefix . 'desktop',
	'label'    => esc_attr__( 'Desktop', 'sala' ),
	'section'  => $section,
) );

Sala_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'md_heading_font_size',
	'label'     => esc_html__( 'Heading Font Size', 'sala' ),
	'section'   => $section,
	'default'   => 42,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-04 .page-title-inner .heading',
			'property'    => 'font-size',
			'units'       => 'px',
			'media_query' => Sala_Customize::get_md_media_query(),
		),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'md_padding_top',
	'label'     => esc_html__( 'Padding Top', 'sala' ),
	'section'   => $section,
	'transport' => 'auto',
	'default'   => 100,
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-04 .page-title-inner',
			'property'    => 'padding-top',
			'units'       => 'px',
			'media_query' => Sala_Customize::get_md_media_query(),
		),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'md_padding_bottom',
	'label'     => esc_html__( 'Padding Bottom', 'sala' ),
	'section'   => $section,
	'transport' => 'auto',
	'default'   => 100,
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-04 .page-title-inner',
			'property'    => 'padding-bottom',
			'units'       => 'px',
			'media_query' => Sala_Customize::get_md_media_query(),
		),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'md_margin_bottom',
	'label'     => esc_html__( 'Margin Bottom', 'sala' ),
	'section'   => $section,
	'transport' => 'auto',
	'default'   => 50,
	'choices'   => array(
		'min'  => 0,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-title.page-title-04',
			'property' => 'margin-bottom',
			'units'    => 'px',
			'media_query' => Sala_Customize::get_md_media_query(),
		),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'notice',
	'settings' => $prefix . 'tablet',
	'label'    => esc_attr__( 'Tablet', 'sala' ),
	'section'  => $section,
) );

Sala_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'sm_heading_font_size',
	'label'     => esc_html__( 'Heading Font Size', 'sala' ),
	'section'   => $section,
	'default'   => 36,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-04 .page-title-inner .heading',
			'property'    => 'font-size',
			'units'       => 'px',
			'media_query' => Sala_Customize::get_sm_media_query(),
		),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'sm_padding_top',
	'label'     => esc_html__( 'Padding Top', 'sala' ),
	'section'   => $section,
	'transport' => 'auto',
	'default'   => 50,
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-04 .page-title-inner',
			'property'    => 'padding-top',
			'units'       => 'px',
			'media_query' => Sala_Customize::get_sm_media_query(),
		),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'sm_padding_bottom',
	'label'     => esc_html__( 'Padding Bottom', 'sala' ),
	'section'   => $section,
	'transport' => 'auto',
	'default'   => 50,
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-04 .page-title-inner',
			'property'    => 'padding-bottom',
			'units'       => 'px',
			'media_query' => Sala_Customize::get_sm_media_query(),
		),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'sm_margin_bottom',
	'label'     => esc_html__( 'Margin Bottom', 'sala' ),
	'section'   => $section,
	'transport' => 'auto',
	'default'   => 30,
	'choices'   => array(
		'min'  => 0,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-title.page-title-04',
			'property' => 'margin-bottom',
			'units'    => 'px',
			'media_query' => Sala_Customize::get_sm_media_query(),
		),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'     => 'notice',
	'settings' => $prefix . 'mobile',
	'label'    => esc_attr__( 'Mobile', 'sala' ),
	'section'  => $section,
) );

Sala_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'xs_heading_font_size',
	'label'     => esc_html__( 'Heading Font Size', 'sala' ),
	'section'   => $section,
	'default'   => 30,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-04 .page-title-inner .heading',
			'property'    => 'font-size',
			'units'       => 'px',
			'media_query' => Sala_Customize::get_xs_media_query(),
		),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'xs_padding_top',
	'label'     => esc_html__( 'Padding Top', 'sala' ),
	'section'   => $section,
	'transport' => 'auto',
	'default'   => 30,
	'choices'   => array(
		'min'  => 20,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-04 .page-title-inner',
			'property'    => 'padding-top',
			'units'       => 'px',
			'media_query' => Sala_Customize::get_xs_media_query(),
		),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'xs_padding_bottom',
	'label'     => esc_html__( 'Padding Bottom', 'sala' ),
	'section'   => $section,
	'transport' => 'auto',
	'default'   => 30,
	'choices'   => array(
		'min'  => 20,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-04 .page-title-inner',
			'property'    => 'padding-bottom',
			'units'       => 'px',
			'media_query' => Sala_Customize::get_xs_media_query(),
		),
	),
) );

Sala_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'xs_margin_bottom',
	'label'     => esc_html__( 'Margin Bottom', 'sala' ),
	'section'   => $section,
	'transport' => 'auto',
	'default'   => 0,
	'choices'   => array(
		'min'  => 0,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-title.page-title-04',
			'property' => 'margin-bottom',
			'units'    => 'px',
			'media_query' => Sala_Customize::get_xs_media_query(),
		),
	),
) );
