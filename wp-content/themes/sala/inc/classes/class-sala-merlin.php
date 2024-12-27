<?php
/**
 * This file define demos for the theme.
 */

function sala_import_list_demos() {
	return array(
		'01' => array(
			'name'              => esc_html__( 'City Guide', 'sala' ),
			'description'       => esc_html__( 'After importing this demo, your site will have all data like wp.getsala.com', 'sala' ),
			'preview_image_url' => SALA_THEME_URI . '/assets/import/01/screenshot.png',
			'media_package_url' => 'https://www.dropbox.com/s/8r4ldslwe54plzw/sala-media-01.zip?dl=1',
		),

		'02' => array(
			'name'              => esc_html__( 'Bussiness Listing', 'sala' ),
			'description'       => esc_html__( 'After importing this demo, your site will have all data like wp.getsala.com', 'sala' ),
			'preview_image_url' => SALA_THEME_URI . '/assets/import/02/screenshot.png',
			'media_package_url' => 'https://www.dropbox.com/s/eyjgowq6eiqjrug/sala-media-02.zip?dl=1',
		),
	);
}
add_filter( 'sala_import_demos', 'sala_import_list_demos' );
