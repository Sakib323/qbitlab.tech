<?php
/**
 * Custom content for the generated child theme's functions.php file.
 *
 * @param string $output Generated content.
 * @param string $slug Parent theme slug.
 */
function sala_generate_child_functions_php( $output, $slug ) {

	$slug_no_hyphens = strtolower( preg_replace( '#[^a-zA-Z]#', '', $slug ) );

	$output = "
		<?php
		/**
		 * Theme functions and definitions.
		 */
		function {$slug_no_hyphens}_child_enqueue_styles() {

		    if ( SCRIPT_DEBUG ) {
		        wp_enqueue_style( '{$slug}-style' , get_template_directory_uri() . '/style.css' );
		    }

		    wp_enqueue_style( '{$slug}-child-style',
		        get_stylesheet_directory_uri() . '/style.css',
		        array( '{$slug}-style' ),
		        wp_get_theme()->get('Version')
		    );
		}

		add_action(  'wp_enqueue_scripts', '{$slug_no_hyphens}_child_enqueue_styles' );\n
	";

	// Let's remove the tabs so that it displays nicely.
	$output = trim( preg_replace( '/\t+/', '', $output ) );

	// Filterable return.
	return $output;
}
add_filter( 'merlin_generate_child_functions_php', 'sala_generate_child_functions_php', 10, 2 );

/**
 * Define the demo import files (local files).
 *
 * You have to use the same filter as in above example,
 * but with a slightly different array keys: local_*.
 * The values have to be absolute paths (not URLs) to your import files.
 * To use local import files, that reside in your theme folder,
 * please use the below code.
 * Note: make sure your import files are readable!
 */
function sala_merlin_local_import_files() {
	return array(
		array(
			'import_file_name'             => 'LTR',
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'assets/import/01/content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'assets/import/01/widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'assets/import/01/customizer.dat',
			'import_preview_image_url'     => trailingslashit( get_template_directory() ) . 'assets/import/01/screenshot.png',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'sala' ),
			'preview_url'                  => 'https://sala.uxper.co/',
		),
		array(
			'import_file_name'             => 'RTL',
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'assets/import/02/content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'assets/import/02/widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'assets/import/02/customizer.dat',
			'import_preview_image_url'     => trailingslashit( get_template_directory() ) . 'assets/import/02/screenshot.png',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'sala' ),
			'preview_url'                  => 'https://salartl.uxper.co/',
		),
	);
}
add_filter( 'merlin_import_files', 'sala_merlin_local_import_files' );

/**
 * Execute custom code before the whole import content has started.
 */
function sala_merlin_before_content_import_setup() {
	$args = array(
		'post_type' => 'page'
	);

	$pages = get_posts( $args );

	if (is_array($pages) && count($pages) > 0) {

		// Delete all Page
		foreach($pages as $page){

			wp_delete_post($page->ID, true);

		}
	}

	delete_option('woocommerce_shop_page_id');
	delete_option('woocommerce_cart_page_id');
	delete_option('woocommerce_checkout_page_id');
	delete_option('woocommerce_myaccount_page_id');
}
add_action( 'import_start', 'sala_merlin_before_content_import_setup' );

/**
 * Execute custom code after the whole import has finished.
 */
function sala_merlin_after_import_setup($selected_import_index) {
	import_page_options($selected_import_index);
	import_menus($selected_import_index);
	import_elementor_options($selected_import_index);
	import_woocommerce_pages();
}
add_action( 'merlin_after_all_import', 'sala_merlin_after_import_setup' );

/**
 * Page Options
 */
function import_page_options($demo) {

	$pages = get_data( $demo, 'page_options' );

	if ( is_array( $pages ) ) {

		if ( ! empty( $pages['show_on_front'] ) ) {
			update_option( 'show_on_front', $pages['show_on_front'] );
		}

		if ( ! empty( $pages['page_on_front'] ) ) {
			$page = get_page_by_title( $pages['page_on_front'] );

			update_option( 'page_on_front', $page->ID );
		}

		if ( ! empty( $pages['page_for_posts'] ) ) {
			$page = get_page_by_title( $pages['page_for_posts'] );

			update_option( 'page_for_posts', $page->ID );
		}
	}
}

/**
 * Import menus
 */
function import_menus($demo) {

	global $wpdb;

	$sala_terms_table = $wpdb->prefix . "terms";
	$menu_data        = get_data( $demo, 'menus' );
	$menu_array       = array();

	if ( ! empty( $menu_data ) ) {

		foreach ( $menu_data as $registered_menu => $menu_slug ) {

			$term_rows = $wpdb->get_results( "SELECT * FROM $sala_terms_table where slug='{$menu_slug}'", ARRAY_A );

			if ( isset( $term_rows[0]['term_id'] ) ) {
				$term_id_by_slug = $term_rows[0]['term_id'];
			} else {
				$term_id_by_slug = null;
			}

			$menu_array[ $registered_menu ] = $term_id_by_slug;
		}
		set_theme_mod( 'nav_menu_locations', array_map( 'absint', $menu_array ) );

	}
}

/**
 * Import WooCommerce pages
 */
function import_woocommerce_pages() {

	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}

	$woopages = array(
		'woocommerce_shop_page_id'      => 'Shop',
		'woocommerce_cart_page_id'      => 'Cart',
		'woocommerce_checkout_page_id'  => 'Checkout',
		'woocommerce_myaccount_page_id' => 'My Account',
	);

	foreach ( $woopages as $woo_page_name => $woo_page_title ) {
		$woopage = get_page_by_title( $woo_page_title );
		if ( isset( $woopage ) && $woopage->ID ) {
			update_option( $woo_page_name, $woopage->ID );
		}
	}

	$notices = array_diff( get_option( 'woocommerce_admin_notices', array() ), array(
		'install',
		'update',
	) );
	update_option( 'woocommerce_admin_notices', $notices );
	delete_option( '_wc_needs_pages' );
	delete_transient( '_wc_activation_redirect' );
}

/**
 * Elementor Options
 */
function import_elementor_options($demo) {
	if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
		return;
	}

	$settings = get_data( $demo, 'elementor' );

	if ( is_array( $settings ) ) {
		foreach ( $settings as $option => $value ) {
			update_option( $option, $value );
		}
	}
}

/**
 * Read export files
 */
function get_data( $demo, $type, $unserialize = true ) {
	if( ! isset($demo) ) {
		$demo = '01';
	}else{
		$demo = intval($demo) + 1;
	}

	if( $demo < 10 ) {
		$demo = '0' . $demo;
	}

	$file = SALA_THEME_DIR . '/assets/import/' . $demo . '/' . $type . '.txt';

	if ( ! file_exists( $file ) ) {
		return '';
	}

	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	WP_Filesystem();
	global $wp_filesystem;

	$file_content = $wp_filesystem->get_contents( $file );

	return $unserialize ? @unserialize( $file_content ) : $file_content;
}
