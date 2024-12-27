<?php
$panel    = 'page_title';
$priority = 1;

// Page Title Panel
Sala_Kirki::add_panel( $panel, array(
	'title' => esc_attr__( 'Page Title', 'sala' ),
	'priority' => $priority++,
) );
