<?php 

$section  = 'site_identity';
$priority = 1;

// Site Identity
Sala_Kirki::add_section( $section, array(
	'title'    => esc_html__( 'Site Identity', 'sala' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );
