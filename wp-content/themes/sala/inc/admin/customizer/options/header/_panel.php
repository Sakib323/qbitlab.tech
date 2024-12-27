<?php

$panel    = 'header';
$priority = 1;

// Header Panel
Sala_Kirki::add_panel( $panel, array(
	'title'    => esc_html__( 'Header', 'sala' ),
	'priority' => $priority++,
) );
