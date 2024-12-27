<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
   exit;
}

/**
 * Helper functions
 */
if ( ! class_exists( 'Sala_Helper' ) )
{

	class Sala_Helper
	{
		/**
		 * The constructor.
		 */
		function __construct() {
			add_action( 'delete_attachment', array( $this, 'sala_delete_resized_images' ) );
			add_filter( 'body_class', array( $this, 'body_class' ) );
			add_filter( 'comment_form_fields', array( $this, 'sala_comment_form_fields' ), 10, 1 );
			add_post_type_support( 'page', 'excerpt' );
			add_post_type_support( 'portfolio', 'excerpt' );
		}


		/**
		 * Get Setting
		 */
	    public static function setting($key, $default = '')
	    {
	    	$option = '';
	    	$option = Sala_Kirki::get_option( 'theme', $key );

	        return ( !empty($option) ) ? $option : $default;
	    }

	    /**
		 * Clean Variable
		 */
	    public static function sala_clean( $var ) {
	        if ( is_array( $var ) ) {
	            return array_map( 'sala_clean', $var );
	        } else {
	            return is_scalar( $var ) ? sanitize_text_field( $var ) : $var;
	        }
	    }

	    /**
		 * Body Class
		 */
	    public static function body_class($classes)
		{

			$enable_rtl_mode = Sala_Helper::setting('enable_rtl_mode', 0);

			if ( is_rtl() || $enable_rtl_mode ) {
				$classes[] = 'rtl';
			}

			$enable_dark_theme = get_theme_mod( 'enable_dark_theme', 0 );

			if( $enable_dark_theme ){
				$classes[] = 'sala-dark-scheme';
			}

			$layout_content 						= Sala_Helper::setting('layout_content');
			$site_layout    						= Sala_Helper::get_post_meta( 'site_layout', '' );
			$portfolio_archive_sidebar_position 	= Sala_Helper::setting( 'portfolio_archive_sidebar_position' );
			$single_portfolio_sidebar_position 		= Sala_Helper::setting( 'single_portfolio_sidebar_position' );
			$post_archive_sidebar_position 			= Sala_Helper::setting( 'post_archive_sidebar_position' );
			$single_post_sidebar_position 			= Sala_Helper::setting( 'single_post_sidebar_position' );

			if( $site_layout === '' ) {
				$classes[] = $layout_content;
			}else{
				$classes[] = $site_layout;
			}

			if ( get_theme_mod('sala_portfolio', 0) && Sala_Portfolio::instance()->is_archive() ) {
				if( $portfolio_archive_sidebar_position === 'left' ) {
					$classes[] = 'left-sidebar';
				} elseif ( $portfolio_archive_sidebar_position === 'none' ) {
					$classes[] = 'no-sidebar';
				} elseif ( $portfolio_archive_sidebar_position === 'right' ) {
					$classes[] = 'right-sidebar';
				}
			} elseif ( Sala_Post::instance()->is_archive() ) {
				if( $post_archive_sidebar_position === 'left' ) {
					$classes[] = 'left-sidebar';
				} elseif ( $post_archive_sidebar_position === 'none' ) {
					$classes[] = 'no-sidebar';
				} elseif ( $post_archive_sidebar_position === 'right' ) {
					$classes[] = 'right-sidebar';
				}
			} elseif ( is_singular() ) {
				$post_type = get_post_type();

				switch ( $post_type ) {
					case 'post':
						if( $single_post_sidebar_position === 'left' ) {
							$classes[] = 'left-sidebar';
						} elseif ( $single_post_sidebar_position === 'none' ) {
							$classes[] = 'no-sidebar';
						} elseif ( $single_post_sidebar_position === 'right' ) {
							$classes[] = 'right-sidebar';
						}
						break;

					case 'portfolio':
						if( $single_portfolio_sidebar_position === 'left' ) {
							$classes[] = 'left-sidebar';
						} elseif ( $single_portfolio_sidebar_position === 'none' ) {
							$classes[] = 'no-sidebar';
						} elseif ( $single_portfolio_sidebar_position === 'right' ) {
							$classes[] = 'right-sidebar';
						}
						break;

					default:
						$classes[] = 'right-sidebar';
						break;
				}
			}

			$body_class = Sala_Helper::get_post_meta( 'body_class', '' );
			if ( $body_class !== '' ) {
				$classes[] = $body_class;
			}

			return $classes;
		}

		/**
		 * Move comment field to the last
		 * @param $comment_fields
		 * @return mixed
		 */
		function sala_comment_form_fields($comment_fields) {
			if (isset($comment_fields['comment'])) {
				$comment_field = $comment_fields['comment'];
				unset($comment_fields['comment']);
				$comment_fields['comment'] = $comment_field;
			}

			return $comment_fields;
		}

		/**
		 * Header Class
		 */
		public static function header_class($class = '') {
			$classes = array('site-header');

			$header_type    = Sala_Global::instance()->get_header_type();
			$header_overlay = Sala_Global::instance()->get_header_overlay();
			$header_float   = Sala_Global::instance()->get_header_float();
			$header_skin    = Sala_Global::instance()->get_header_skin();

			$single_post_layout = Sala_Helper::setting('single_post_layout', '01');

			if ( $header_overlay === '1' ) {
				$classes[] = 'header-sticky';
			}

			if ( $header_float === '1' ) {
				$classes[] = 'header-float';
			}

			$classes[] = "header-{$header_skin}";

			if ( ! empty( $class ) ) {
				if ( ! is_array( $class ) ) {
					$class = preg_split( '#\s+#', $class );
				}
				$classes = array_merge( $classes, $class );
			} else {
				// Ensure that we always coerce class to being an array.
				$class = array();
			}

			$classes = apply_filters( 'sala_header_class', $classes, $class );

			echo join(' ', $classes);
		}

		/**
		 * Send email
		 */
	    public static function sala_send_email($email, $email_type, $args = array())
	    {
	        $message = get_theme_mod('content_' . $email_type, '');
	        $subject = get_theme_mod('subject_' . $email_type, '');

	        foreach ($args as $key => $val) {
	            $subject = str_replace('%' . $key, $val, $subject);
	            $message = str_replace('%' . $key, $val, $message);
	        }
	        $headers = apply_filters( 'sala_contact_mail_header', array('charset=UTF-8'));
	        @wp_mail(
	            $email,
	            $subject,
	            $message,
	            $headers
	        );
	    }

		/**
		 * Get Template
		 */
		public static function sala_get_template($slug, $args = array()) {
			if ( $args && is_array($args) ) {
				extract($args);
			}
			$located = locate_template(array("templates/{$slug}.php"));

			if ( !file_exists($located) ) {
				_doing_it_wrong(__FUNCTION__, sprintf('<code>%s</code> does not exist.', $slug), '1.0');
				return;
			}
			include($located);
		}

		/**
		 * Check File Base
		 */
		public static function check_file_base($name, $path) {
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
			WP_Filesystem();
			global $wp_filesystem;

			$upload_dir = wp_upload_dir();
			$logger_dir = $upload_dir['basedir'] . '/sala/header';
			$file       =  trailingslashit( $logger_dir ) . $name . '.' . $path;
			$check_file = file_exists($file);

			return $check_file;
		}

		/**
		 * Get Content File Base
		 */
		public static function get_content_file_base($name, $path) {
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
			WP_Filesystem();
			global $wp_filesystem;

			$upload_dir = wp_upload_dir();
			$logger_dir = $upload_dir['basedir'] . '/sala/header';
			$file       = $name . '.' . $path;
			$content    = $wp_filesystem->get_contents( trailingslashit( $logger_dir ) . $file );

			return $content;
		}

		public static function w3c_iframe( $iframe ) {
			$iframe = str_replace( 'frameborder="0"', '', $iframe );
			$iframe = str_replace( 'frameborder="no"', '', $iframe );
			$iframe = str_replace( 'scrolling="no"', '', $iframe );
			$iframe = str_replace( 'gesture="media"', '', $iframe );
			$iframe = str_replace( 'allow="encrypted-media"', '', $iframe );

			return $iframe;
		}

		public static function get_post_meta( $name, $default = false ) {
			global $sala_page_options;

			if ( $sala_page_options != false && isset( $sala_page_options[ $name ] ) ) {
				return $sala_page_options[ $name ];
			}

			return $default;
		}

		public static function get_the_post_meta( $options, $name, $default = false ) {
			if ( $options != false && isset( $options[ $name ] ) ) {
				return $options[ $name ];
			}

			return $default;
		}

		public static function get_registered_sidebars( $default_option = false, $empty_option = true ) {
			global $wp_registered_sidebars;
			$sidebars = array();
			if ( $empty_option === true ) {
				$sidebars['none'] = esc_html__( 'No Sidebar', 'sala' );
			}
			if ( $default_option === true ) {
				$sidebars['default'] = esc_html__( 'Default', 'sala' );
			}
			foreach ( $wp_registered_sidebars as $sidebar ) {
				$sidebars[ $sidebar['id'] ] = $sidebar['name'];
			}

			return $sidebars;
		}

	    /**
		 * Allowed_html
		 */
	    public static function sala_kses_allowed_html() {
	    	$allowed_tags = array(
				'a' => array(
					'id'    => array(),
					'class' => array(),
					'href'  => array(),
					'rel'   => array(),
					'title' => array(),
				),
				'abbr' => array(
					'title' => array(),
				),
				'b' => array(),
				'blockquote' => array(
					'cite'  => array(),
				),
				'cite' => array(
					'title' => array(),
				),
				'code' => array(),
				'del' => array(
					'datetime' => array(),
					'title' => array(),
				),
				'dd' => array(),
				'div' => array(
					'class' => array(),
					'title' => array(),
					'style' => array(),
				),
				'dl' => array(),
				'dt' => array(),
				'em' => array(),
				'h1' => array(),
				'h2' => array(),
				'h3' => array(),
				'h4' => array(),
				'h5' => array(),
				'h6' => array(),
				'i' => array(
					'class' => array(),
				),
				'img' => array(
					'alt'    => array(),
					'class'  => array(),
					'height' => array(),
					'src'    => array(),
					'width'  => array(),
				),
				'li' => array(
					'class' => array(),
				),
				'ol' => array(
					'class' => array(),
				),
				'p' => array(
					'class' => array(),
				),
				'q' => array(
					'cite' => array(),
					'title' => array(),
				),
				'span' => array(
					'class' => array(),
					'title' => array(),
					'style' => array(),
				),
				'strike' => array(),
				'strong' => array(),
				'ul' => array(
					'class' => array(),
				),
			);

			return $allowed_tags;
		}

		/**
		 * Image size
		 */
		public static function sala_image_resize( $data, $image_size ) {
	        if( preg_match( '/\d+x\d+/', $image_size) ){
	            $image_sizes = explode( 'x', $image_size );
	            $image_src  = self::sala_image_resize_id($data, $image_sizes[0], $image_sizes[1], true);
	        }else{
	            if(!in_array( $image_size, array('full','thumbnail'))){
	                $image_size = 'full';
	            }
	            $image_src = wp_get_attachment_image_src($data, $image_size);
	            if ( $image_src && ! empty( $image_src[0] ) ) {
	                $image_src = $image_src[0];
	            }
	        }
	        return $image_src;
	    }

		/**
		 * Image resize by url
		 */
	    public static function sala_image_resize_url( $url, $width = NULL, $height = NULL, $crop = true, $retina = false ) {

	        global $wpdb;

	        if (empty($url))
	            return new WP_Error('no_image_url', esc_html__('No image URL has been entered.', 'sala'), $url);

	        if (class_exists('Jetpack') && method_exists('Jetpack', 'get_active_modules') && in_array('photon', Jetpack::get_active_modules())) {
	            $args_crop = array(
	                'resize' => $width . ',' . $height,
	                'crop' => '0,0,' . $width . 'px,' . $height . 'px'
	            );
	            $url = jetpack_photon_url($url, $args_crop);
	        }

	        // Get default size from database
	        $width = ($width) ? $width : get_option('thumbnail_size_w');
	        $height = ($height) ? $height : get_option('thumbnail_size_h');

	        // Allow for different retina sizes
	        $retina = $retina ? ($retina === true ? 2 : $retina) : 1;

	        // Get the image file path
	        $file_path = parse_url($url);
	        $file_path = SALA_THEME_URI . $file_path['path'];
	        $wp_upload_folder = wp_upload_dir();
	        $wp_upload_folder = $wp_upload_folder['basedir'];
	        $file_path = explode('/uploads/', $file_path);
	        if (is_array($file_path)) {
	            if (count($file_path) > 1) {
	                $file_path = $wp_upload_folder . '/' . $file_path[1];
	            } elseif (count($file_path) > 0) {
	                $file_path = $wp_upload_folder . '/' . $file_path[0];
	            } else {
	                $file_path = '';
	            }
	        }

	        // Check for Multisite
	        if (is_multisite()) {
	            global $blog_id;
	            $blog_details = get_blog_details($blog_id);
	            $file_path = str_replace($blog_details->path . 'files/', '/wp-content/blogs.dir/' . $blog_id . '/files/', $file_path);
	        }

	        // Destination width and height variables
	        $dest_width = $width * $retina;
	        $dest_height = $height * $retina;

	        // File name suffix (appended to original file name)
	        $suffix = "{$dest_width}x{$dest_height}";

	        // Some additional info about the image
	        $info = pathinfo($file_path);
	        $dir = $info['dirname'];
	        $ext = $info['extension'];
	        $name = wp_basename($file_path, ".$ext");

	        if ('bmp' == $ext) {
	            return new WP_Error('bmp_mime_type', esc_html__('Image is BMP. Please use either JPG or PNG.', 'sala'), $url);
	        }

	        // Suffix applied to filename
	        $suffix = "{$dest_width}x{$dest_height}";

	        // Get the destination file name
	        $dest_file_name = "{$dir}/{$name}-{$suffix}.{$ext}";

	        if (!file_exists($dest_file_name)) {

	            /*
	             *  Bail if this image isn't in the Media Library.
	             *  We only want to resize Media Library images, so we can be sure they get deleted correctly when appropriate.
	             */
	            $query = $wpdb->prepare("SELECT * FROM $wpdb->posts WHERE guid='%s'", $url);
	            $get_attachment = $wpdb->get_results($query);
	            // if (!$get_attachment)
	            //     return array('url' => $url, 'width' => $width, 'height' => $height);

	            // Load Wordpress Image Editor
	            $editor = wp_get_image_editor($file_path);
	            if (is_wp_error($editor))
	                return array('url' => $url, 'width' => $width, 'height' => $height);

	            // Get the original image size
	            $size = $editor->get_size();
	            $orig_width = $size['width'];
	            $orig_height = $size['height'];

	            $src_x = $src_y = 0;
	            $src_w = $orig_width;
	            $src_h = $orig_height;

	            if ($crop) {

	                $cmp_x = $orig_width / $dest_width;
	                $cmp_y = $orig_height / $dest_height;

	                // Calculate x or y coordinate, and width or height of source
	                if ($cmp_x > $cmp_y) {
	                    $src_w = round($orig_width / $cmp_x * $cmp_y);
	                    $src_x = round(($orig_width - ($orig_width / $cmp_x * $cmp_y)) / 2);
	                } else if ($cmp_y > $cmp_x) {
	                    $src_h = round($orig_height / $cmp_y * $cmp_x);
	                    $src_y = round(($orig_height - ($orig_height / $cmp_y * $cmp_x)) / 2);
	                }

	            }

	            // Time to crop the image!
	            $editor->crop($src_x, $src_y, $src_w, $src_h, $dest_width, $dest_height);

	            // Now let's save the image
	            $saved = $editor->save($dest_file_name);

	            // Get resized image information
	            $resized_url = str_replace(wp_basename($url), wp_basename($saved['path']), $url);
	            $resized_width = $saved['width'];
	            $resized_height = $saved['height'];
	            $resized_type = $saved['mime-type'];

	            // Add the resized dimensions to original image metadata (so we can delete our resized images when the original image is delete from the Media Library)
	            if( $get_attachment ) {
	            	$metadata = wp_get_attachment_metadata($get_attachment[0]->ID);
		            if (isset($metadata['image_meta'])) {
		                $metadata['image_meta']['resized_images'][] = $resized_width . 'x' . $resized_height;
		                wp_update_attachment_metadata($get_attachment[0]->ID, $metadata);
		            }
	            }

	            // Create the image array
	            $image_array = array(
	                'url' => $resized_url,
	                'width' => $resized_width,
	                'height' => $resized_height,
	                'type' => $resized_type
	            );

	        } else {
	            $image_array = array(
	                'url' => str_replace(wp_basename($url), wp_basename($dest_file_name), $url),
	                'width' => $dest_width,
	                'height' => $dest_height,
	                'type' => $ext
	            );
	        }

	        // Return image array
	        return $image_array;
	    }

		/**
		 * Image resize by id
		 */
	    public static function sala_image_resize_id( $images_id, $width = NULL, $height = NULL, $crop = true, $retina = false ) {
	        $output = '';
	        $image_src = wp_get_attachment_image_src($images_id, 'full');
	        if ($image_src) {
	            $resize = self::sala_image_resize_url($image_src[0], $width, $height, $crop, $retina);
	            if ($resize != null && is_array($resize)) {
	                $output = $resize['url'];
	            }
	        }
	        return $output;
	    }

	    /**
		 * Delete resized images
		 */
		public static function sala_delete_resized_images($post_id) {
	        // Get attachment image metadata
	        $metadata = wp_get_attachment_metadata($post_id);
	        if (!$metadata)
	            return;

	        // Do some bailing if we cannot continue
	        if (!isset($metadata['file']) || !isset($metadata['image_meta']['resized_images']))
	            return;
	        $pathinfo = pathinfo($metadata['file']);
	        $resized_images = $metadata['image_meta']['resized_images'];

	        // Get Wordpress uploads directory (and bail if it doesn't exist)
	        $wp_upload_dir = wp_upload_dir();
	        $upload_dir = $wp_upload_dir['basedir'];
	        if (!is_dir($upload_dir))
	            return;

	        // Delete the resized images
	        foreach ($resized_images as $dims) {

	            // Get the resized images filename
	            $file = $upload_dir . '/' . $pathinfo['dirname'] . '/' . $pathinfo['filename'] . '-' . $dims . '.' . $pathinfo['extension'];

	            // Delete the resized image
	            @unlink($file);
	        }
	    }

	}

	new Sala_Helper();
}

