<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options() {
		// Access the WordPress Categories via an Array.
		$of_categories     = array();
		$of_categories_obj = get_categories( 'hide_empty=0' );
		foreach ( $of_categories_obj as $of_cat ) {
			$of_categories[ $of_cat->cat_ID ] = $of_cat->cat_name;
		}

		// Access the WordPress Pages via an Array.
		$of_pages      = array();
		$of_pages_obj  = get_pages( 'sort_column=post_parent,menu_order' );
		$of_pages['0'] = 'Select a page:';
		foreach ( $of_pages_obj as $of_page ) {
			$of_pages[ $of_page->ID ] = $of_page->post_title;
		}

		// Set the Options Array.
		global $of_options;
		$of_options = array();

		$of_options[] = array(
			'name' => 'Global Settings',
			'type' => 'heading',
		);

		$of_options[] = array(
			'name' => 'Header Scripts',
			'desc' => 'Add custom scripts inside HEAD tag. You need to have a SCRIPT tag around scripts.',
			'id'   => 'html_scripts_header',
			'std'  => '',
			'type' => 'textarea',
		);

		$of_options[] = array(
			'name' => 'Footer Scripts',
			'desc' => 'Add custom scripts you might want to be loaded in the footer of your website. You need to have a SCRIPT tag around scripts.',
			'id'   => 'html_scripts_footer',
			'std'  => '',
			'type' => 'textarea',
		);

		$of_options[] = array(
			'name' => 'Body Scripts - Top',
			'desc' => 'Add custom scripts just after the BODY tag opened. You need to have a SCRIPT tag around scripts.',
			'id'   => 'html_scripts_after_body',
			'std'  => '',
			'type' => 'textarea',
		);

		$of_options[] = array(
			'name' => 'Body Scripts - Bottom',
			'desc' => 'Add custom scripts just before the BODY tag closed. You need to have a SCRIPT tag around scripts.',
			'id'   => 'html_scripts_before_body',
			'std'  => '',
			'type' => 'textarea',
		);

		$of_options[] = array(
			'name' => 'Custom CSS',
			'type' => 'heading',
		);

		$of_options[] = array(
			'name' => 'All screens',
			'desc' => 'Add custom CSS here',
			'id'   => 'html_custom_css',
			'std'  => '',
			'type' => 'textarea',
		);

		$of_options[] = array(
			'name' => 'Tablets and down',
			'desc' => 'Add custom CSS here for tablets and mobile',
			'id'   => 'html_custom_css_tablet',
			'std'  => '',
			'type' => 'textarea',
		);

		$of_options[] = array(
			'name' => 'Mobile only',
			'desc' => 'Add custom CSS here for mobile view',
			'id'   => 'html_custom_css_mobile',
			'std'  => '',
			'type' => 'textarea',
		);

		// Performance.
		$of_options[] = array(
			'name' => 'Performance',
			'type' => 'heading',
		);

		$of_options[] = array(
			'name' => '',
			'type' => 'info',
			'desc' => '<p style="font-size:14px">Use with caution! Disable if you have plugin compatibility problems.</p>',
		);

		$of_options[] = array(
			'name' => 'Disable Emoji Script',
			'type' => 'checkbox',
			'id'   => 'disable_emoji',
			'std'  => 0,
			'desc' => 'Remove WP emoji scripts from front-end.',
		);

		$of_options[] = array(
			'name' => 'Disable Embeds',
			'type' => 'checkbox',
			'id'   => 'disable_embeds',
			'std'  => 0,
			'desc' => 'Remove Wordpress Embeds functionality.',
		);

		$of_options[] = array(
			'name' => 'Disable theme style.css',
			'type' => 'checkbox',
			'id'   => 'sala_disable_style_css',
			'std'  => 0,
			'desc' => 'Disable loading of theme style.css. This file is only needed if you have added custom CSS to that file.',
		);

		$of_options[] = array(
			'name' => 'Disable Block library css',
			'type' => 'checkbox',
			'id'   => 'disable_blockcss',
			'std'  => 0,
			'desc' => 'Remove default block library css coming from WordPress',
		);

		$of_options[] = array(
			'name' => 'Disable jQuery Migrate',
			'type' => 'checkbox',
			'id'   => 'jquery_migrate',
			'std'  => 0,
			'desc' => 'Remove jQuery Migrate. Most up-to-date front-end code and plugins don’t require jquery-migrate.min.js. More often than not, keeping this - simply adds unnecessary load to your site.',
		);

		// Advanced.
		$of_options[] = array(
			'name' => 'Advanced',
			'type' => 'heading',
		);

		$of_options[] = array(
			'name' => 'Enable Smooth Scroll',
			'type' => 'checkbox',
			'id'   => 'smooth_scroll_enable',
			'std'  => 1,
			'desc' => 'Smooth scrolling experience for websites.',
		);

		$of_options[] = array(
			'name' => 'Go To Top Button',
			'id'   => 'scroll_top_enable',
			'desc' => 'Turn on to show go to top button.',
			'std'  => 1,
			'type' => 'checkbox',
		);

		$of_options[] = array(
			'name' => 'Content Protected',
			'type' => 'checkbox',
			'id'   => 'content_protected_enable',
			'std'  => 0,
			'desc' => 'Turn on to enable content protected feature.',
		);

		$of_options[] = array(
			'name' => 'Site Search',
			'type' => 'heading',
		);

		$of_options[] = array(
			'name' => 'Live Search',
			'id'   => 'live_search',
			'desc' => 'Enable live search for products, pages and posts.',
			'std'  => 1,
			'type' => 'checkbox',
		);

		$of_options[] = array(
			'name' => 'Search placeholder',
			'id'   => 'search_placeholder',
			'desc' => 'Change the search field placeholder.',
			'type' => 'text',
		);

		$of_options[] = array(
			'name' => 'Instagram',
			'type' => 'heading',
		);

		$of_options[] = array(
			'name' => 'Accounts',
			'std'  => sala_facebook_accounts_html(),
			'desc' => sala_facebook_login_button_html(),
			'type' => 'info'
		);

		$of_options[] = array(
			'name' => 'Google APIs',
			'type' => 'heading',
		);

		$of_options[] = array(
			'name' => 'Google Maps API',
			'desc' => "Enter Google Maps API key here to enable Maps. You can generate one here: <a target='_blank' href='https://developers.google.com/maps/documentation/javascript/get-api-key'>Google Maps API</a>",
			'id'   => 'google_map_api',
			'std'  => '',
			'type' => 'text',
		);

		$of_options[] = array(
			'name' => 'Maintenance Mode',
			'type' => 'heading',
		);

		$of_options[] = array(
			'name' => 'Maintenance Mode',
			'id'   => 'maintenance_mode',
			'desc' => 'Enable Maintenance Mode for all users except admins.',
			'std'  => 0,
			'type' => 'checkbox',
		);

		$of_options[] = array(
			'name' => 'Admin Notice',
			'id'   => 'maintenance_mode_admin_notice',
			'desc' => 'Show admin notice when Maintenance Mode is enabled.',
			'std'  => 1,
			'type' => 'checkbox',
		);

		$of_options[] = array(
			'name'    => 'Custom Maintenance Page',
			'id'      => 'maintenance_mode_page',
			'desc'    => 'Set a custom page as maintenance page. Only this page will be visible for visitors.',
			'std'     => 0,
			'type'    => 'select',
			'options' => $of_pages,
		);

		$of_options[] = array(
			'name' => 'Maintenance Mode Text',
			'desc' => 'The text that will be visible to your customers when accessing maintenance screen.',
			'id'   => 'maintenance_mode_text',
			'std'  => 'Please check back soon.',
			'type' => 'text',
		);

		// Color Mode.
		$of_options[] = array(
			'name' => 'Color Mode',
			'type' => 'heading',
		);

		$of_options[] = array(
			'name' => 'Dark Mode',
			'type' => 'checkbox',
			'id'   => 'enable_dark_theme',
			'std'  => 0,
			'desc' => 'Enable dark color scheme for your website',
		);

		$of_options[] = array(
			'name' => 'Color Mode Switcher',
			'type' => 'checkbox',
			'id'   => 'enable_dark_mode_switcher',
			'std'  => 0,
			'desc' => 'Enable color mode switcher for your website',
		);

		$of_options[] = array(
			'name' => 'Dark Mode Switcher Text (Dark)',
			'desc' => 'The text that will be visible to dark mode switcher.',
			'id'   => 'dark_mode_dark',
			'std'  => 'Dark',
			'type' => 'text',
		);

		$of_options[] = array(
			'name' => 'Dark Mode Switcher Text (Light)',
			'desc' => 'The text that will be visible to dark mode switcher.',
			'id'   => 'dark_mode_light',
			'std'  => 'Light',
			'type' => 'text',
		);

		// Post Type.
		$of_options[] = array(
			'name' => 'Post Type',
			'type' => 'heading',
		);

		$of_options[] = array(
			'name' => 'Enable Portfolio',
			'id'   => 'sala_portfolio',
			'desc' => 'Enable portfolio',
			'std'  => 0,
			'type' => 'checkbox',
		);

		$of_options[] = array(
			'name' => 'Enable Job',
			'id'   => 'sala_job',
			'desc' => 'Enable job',
			'std'  => 0,
			'type' => 'checkbox',
		);

		// Email.
		$of_options[] = array(
			'name' => 'Email Template',
			'type' => 'heading',
		);

		$of_options[] = array(
			'name' => 'Register New User ( For User )',
			'desc' => 'Email content sent to users after successful registration.',
			'id'   => 'register_user_user',
			'type' => 'group',
		);

		$of_options[] = array(
			'name' => 'Register New User ( For Admin )',
			'desc' => 'Email content sent to admin after successful registration.',
			'id'   => 'register_user_admin',
			'type' => 'group',
		);

		// Setup page.
		$of_options[] = array(
			'name' => 'Setup Page',
			'type' => 'heading',
		);

		$of_options[] = array(
			'name'    => 'Sign In',
			'id'      => 'sign_in',
			'desc'    => 'Set a custom page as Sign In.',
			'std'     => 0,
			'type'    => 'select',
			'options' => $of_pages,
		);

		$of_options[] = array(
			'name'    => 'Sign Up',
			'id'      => 'sign_up',
			'desc'    => 'Set a custom page as Sign Up.',
			'std'     => 0,
			'type'    => 'select',
			'options' => $of_pages,
		);

		$of_options[] = array(
			'name'    => 'Terms & Conditions',
			'id'      => 'terms',
			'desc'    => 'Set a custom page as Terms & Conditions.',
			'std'     => 0,
			'type'    => 'select',
			'options' => $of_pages,
		);

		$of_options[] = array(
			'name'    => 'Privacy Policy',
			'id'      => 'privacy_policy',
			'desc'    => 'Set a custom page as Privacy Policy.',
			'std'     => 0,
			'type'    => 'select',
			'options' => $of_pages,
		);

		$of_options[] = array(
			'name'    => 'Forgot Password',
			'id'      => 'forgot_password',
			'desc'    => 'Set a custom page as Forgot Password.',
			'std'     => 0,
			'type'    => 'select',
			'options' => $of_pages,
		);

		$of_options[] = array(
			'name'    => 'Reset Password',
			'id'      => 'reset_password',
			'desc'    => 'Set a custom page as Reset Password.',
			'std'     => 0,
			'type'    => 'select',
			'options' => $of_pages,
		);

		// Yoast options.
		if ( class_exists( 'WPSEO_Frontend' ) ) {
			$of_options[] = array(
				'name' => 'Yoast Primary Category',
				'id'   => 'wpseo_primary_term',
				'desc' => 'Use Yoast primary category on product category pages and elements.',
				'std'  => 0,
				'type' => 'checkbox',
			);

			$of_options[] = array(
				'name'  => 'Yoast Breadcrumbs',
				'id'    => 'wpseo_breadcrumb',
				'desc'  => 'Use Yoast breadcrumbs on product category pages, single product pages and elements.',
				'std'   => 0,
				'folds' => 1,
				'type'  => 'checkbox',
			);

			$of_options[] = array(
				'name' => '',
				'id'   => 'wpseo_breadcrumb_remove_last',
				'desc' => 'Remove the last static crumb on single product pages (product title).',
				'std'  => 1,
				'fold' => 'wpseo_breadcrumb',
				'type' => 'checkbox',
			);
		}

		// Backup Options.
		$of_options[] = array(
			'name' => 'Backup and Import',
			'type' => 'heading',
		);

		$of_options[] = array(
			'name' => 'Backup and Restore Options',
			'id'   => 'of_backup',
			'std'  => '',
			'type' => 'backup',
			'desc' => 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
		);

		$of_options[] = array(
			'name' => 'Transfer Theme Options Data',
			'id'   => 'of_transfer',
			'std'  => '',
			'type' => 'transfer',
			'desc' => 'You can transfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
		);

	}//End function: of_options()
}//End chack if function exists: of_options()
