<?php

$panel    = 'shop';
$priority = 1;

// Shop Panel
Sala_Kirki::add_panel( $panel, array(
	'title'    => esc_html__( 'Shop', 'sala' ),
	'priority' => $priority++,
) );