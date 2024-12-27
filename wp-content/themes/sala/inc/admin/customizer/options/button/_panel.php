<?php

$priority = 2;
$panel    = 'button';

// Blog Panel
Sala_Kirki::add_panel( $panel, array(
	'title'    => esc_html__( 'Button', 'sala' ),
	'priority' => $priority++,
) );
