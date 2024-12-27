<?php

$section  = 'pre_loading';
$prefix   = 'pre_loading_';
$priority = 1;

// Page Loading Effect
Sala_Kirki::add_section( $section, array(
	'title'    => esc_html__( 'Pre Loading', 'sala' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'radio',
	'settings' => 'type_loading_effect',
	'label'    => esc_html__( 'Type Loading Effect', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => $default['type_loading_effect'],
	'choices'  => [
		'none'          => esc_attr__( 'None', 'sala' ),
		'css_animation' => esc_attr__( 'CSS Animation', 'sala' ),
		'image'         => esc_attr__( 'Image', 'sala' ),
	],
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'color-alpha',
	'settings'  => 'page_loading_effect_bg_color',
	'label'     => esc_html__( 'Background Color', 'sala' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => '#fff',
	'output'    => array(
		array(
			'element'  => '.page-loading-effect',
			'property' => 'background-color',
		),
	),
] );

Sala_Kirki::add_field( 'theme', [
	'type'      => 'color-alpha',
	'settings'  => 'page_loading_effect_shape_color',
	'label'     => esc_html__( 'Shape Color', 'sala' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => $default['accent_color'],
	'output'    => array(
		array(
			'element'  => '.sala-ldef-circle > span,.sala-ldef-facebook span,.sala-ldef-heart span,.sala-ldef-heart span:after,
			.sala-ldef-heart span:before,.sala-ldef-roller span:after,.sala-ldef-default span,.sala-ldef-ellipsis span,
			.sala-ldef-grid span,.sala-ldef-spinner span:after',
			'property' => 'background-color',
		),
		array(
			'element'  => '.sala-ldef-ripple span',
			'property' => 'border-color',
		),
		array(
			'element'  => '.sala-ldef-dual-ring:after,.sala-ldef-ring span,.sala-ldef-hourglass:after',
			'property' => 'border-top-color',
		),
		array(
			'element'  => '.sala-ldef-dual-ring:after,.sala-ldef-hourglass:after',
			'property' => 'border-bottom-color',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'type_loading_effect',
			'operator' => '=',
			'value'    => 'css_animation',
		),
	),
] );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'radio-buttonset',
	'settings' => 'animation_loading_effect',
	'label'    => esc_html__( 'Animation Type', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => $default['animation_loading_effect'],
	'choices'  => [
		'css-1'  => '<span class="sala-ldef-circle sala-ldef-loading"><span></span></span>',
		'css-2'  => '<span class="sala-ldef-dual-ring sala-ldef-loading"></span>',
		'css-3'  => '<span class="sala-ldef-facebook sala-ldef-loading"><span></span><span></span><span></span></span>',
		'css-4'  => '<span class="sala-ldef-heart sala-ldef-loading"><span></span></span>',
		'css-5'  => '<span class="sala-ldef-ring sala-ldef-loading"><span></span><span></span><span></span><span></span></span>',
		'css-6'  => '<span class="sala-ldef-roller sala-ldef-loading"><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span></span>',
		'css-7'  => '<span class="sala-ldef-default sala-ldef-loading"><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span></span>',
		'css-8'  => '<span class="sala-ldef-ellipsis sala-ldef-loading"><span></span><span></span><span></span><span></span></span>',
		'css-9'  => '<span class="sala-ldef-grid sala-ldef-loading"><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span></span>',
		'css-10' => '<span class="sala-ldef-hourglass sala-ldef-loading"></span>',
		'css-11' => '<span class="sala-ldef-ripple sala-ldef-loading"><span></span><span></span></span>',
		'css-12' => '<span class="sala-ldef-spinner sala-ldef-loading"><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span></span>',
	],
	'active_callback' => array(
		array(
			'setting'  => 'type_loading_effect',
			'operator' => '=',
			'value'    => 'css_animation',
		),
	),
] );

Sala_Kirki::add_field( 'theme', [
	'type'     => 'image',
	'settings' => 'image_loading_effect',
	'label'    => esc_html__( 'Image', 'sala' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => $default['image_loading_effect'],
	'active_callback' => array(
		array(
			'setting'  => 'type_loading_effect',
			'operator' => '=',
			'value'    => 'image',
		),
	),
] );
