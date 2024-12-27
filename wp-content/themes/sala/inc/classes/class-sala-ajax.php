<?php

if ( !defined( 'ABSPATH' ) ){
	exit;
}

if ( !class_exists('Sala_Ajax_Include') ){

	/**
     *  Class Sala_Ajax
     */
	class Sala_Ajax_Include
	{

		/**
		 * The constructor.
		 */
		public function __construct() {

			// Login
			add_action('wp_ajax_get_login_user', array( $this, 'get_login_user' ) );
			add_action('wp_ajax_nopriv_get_login_user', array( $this, 'get_login_user' ) );

			// Register
			add_action('wp_ajax_get_register_user', array( $this, 'get_register_user' ) );
			add_action('wp_ajax_nopriv_get_register_user', array( $this, 'get_register_user' ) );

			// Forgot password
            add_action( 'wp_ajax_sala_forgot_password_ajax', array( $this, 'forgot_password_ajax') );
            add_action( 'wp_ajax_nopriv_sala_forgot_password_ajax', array( $this, 'forgot_password_ajax') );

			// Reset password
			add_action( 'wp_ajax_change_password_ajax', array( $this, 'change_password_ajax') );
            add_action( 'wp_ajax_nopriv_change_password_ajax', array( $this, 'change_password_ajax') );

		}

		//////////////////////////////////////////////////////////////////
		// Ajax Login
		//////////////////////////////////////////////////////////////////
		function get_login_user() {
			$email    	= $_POST['email'];
			$password 	= $_POST['password'];
			$rememberme = $_POST['rememberme'];

			$user_login = $email;

			if( is_email($email) ) {
				$current_user = get_user_by( 'email', $email );
				$user_login   = $current_user->user_login;
			}

			$array = array();
			$array['user_login']    = $user_login;
			$array['user_password'] = $password;
			if( $rememberme === 'yes' ){
				$array['remember']      = true;
			} else {
				$array['remember']      = false;
			}
			$user = wp_signon( $array, false );

			if ( !is_wp_error($user) ) {
				$msg = esc_html__('Login success', 'sala');
				echo json_encode( array( 'success' => true, 'messages' => $msg, 'class' => 'text-success', 'redirect' => home_url() ) );
			}else{
				$msg = esc_html__('Username or password is wrong. Please try again', 'sala');
				echo json_encode( array( 'success' => false, 'messages' => $msg, 'class' => 'text-error', 'redirect' => '' ) );
			}
			wp_die();
		}

		//////////////////////////////////////////////////////////////////
		// Ajax Register
		//////////////////////////////////////////////////////////////////
		function get_register_user() {
			$firstname  	= $_POST['firstname'];
			$lastname   	= $_POST['lastname'];
			$email      	= $_POST['email'];
			$password   	= $_POST['password'];
			$user_login 	= $firstname.$lastname;
			$userdata = array(
				'user_login' => $user_login,
				'first_name' => $firstname,
				'last_name'  => $lastname,
				'user_email' => $email,
				'user_pass'  => $password
			);
			$user_id = wp_insert_user( $userdata );
			if( $user_id == 0 ){
				$user_login = substr( $email,  0, strpos($email, '@' ));
				$userdata = array(
					'user_login' => $user_login,
					'first_name' => $firstname,
					'last_name'  => $lastname,
					'user_email' => $email,
					'user_pass'  => $password
				);
				$user_id = wp_insert_user( $userdata );
			}
			$msg     = '';
			if( !is_wp_error($user_id) ) {
				$creds = array();
				$creds['user_login']    = $user_login;
				$creds['user_email']    = $email;
				$creds['user_password'] = $password;
				$creds['remember']      = true;
				$user = wp_signon( $creds, false );
				$msg  = esc_html__('Register success', 'sala');

				$args = array(
                    'username' 		=> $user_login,
                    'useremail' 	=> $email,
                    'userpass' 		=> $password,
					'website_url' 	=> get_option('siteurl'),
					'website_name' 	=> get_option('blogname')
                );

				Sala_Helper::sala_send_email($email, 'register_user_user', $args);

				Sala_Helper::sala_send_email(get_option( 'admin_email' ), 'register_user_admin', $args);

				$users  = get_user_by( 'login', $user_login );

				echo json_encode( array( 'success' => true, 'messages' => $msg, 'class' => 'text-success', 'redirect' => home_url() ) );

			}else{
				$msg = esc_html__('Username/Email address is existing', 'sala');
				echo json_encode( array( 'success' => false, 'messages' => $msg, 'class' => 'text-error' ) );
			}
			wp_die();
		}

		//////////////////////////////////////////////////////////////////
		// Ajax forgot password
		//////////////////////////////////////////////////////////////////
        public function forgot_password_ajax() {
            check_ajax_referer('sala_forgot_password_ajax_nonce', 'sala_security_forgot_password');
            $allowed_html = array();
            $user_login = wp_kses( $_POST['user_login'], $allowed_html );

            if ( empty( $user_login ) ) {
                echo json_encode(array( 'success' => false, 'class' => 'text-warning', 'message' => esc_html__('Enter a username or email address.', 'sala') ) );
                wp_die();
            }

            if ( strpos( $user_login, '@' ) ) {
                $user_data = get_user_by( 'email', trim( $user_login ) );
                if ( empty( $user_data ) ) {
                    echo json_encode(array('success' => false, 'class' => 'text-error', 'message' => esc_html__('There is no user registered with that email address.', 'sala')));
                    wp_die();
                }
            } else {
                $login = trim( $user_login );
                $user_data = get_user_by('login', $login);

                if ( !$user_data ) {
                    echo json_encode(array( 'success' => false, 'class' => 'text-error', 'message' => esc_html__('Invalid username', 'sala') ) );
                    wp_die();
                }
            }
            $user_login = $user_data->user_login;
            $user_email = $user_data->user_email;
            $key = get_password_reset_key( $user_data );

            if ( is_wp_error( $key ) ) {
                echo json_encode(array( 'success' => false, 'message' => $key ) );
                wp_die();
            }

			$reset_password = get_theme_mod( 'reset_password' );

            $message = esc_html__('Someone has requested a password reset for the following account:', 'sala' ) . "\r\n\r\n";
            $message .= network_home_url( '/' ) . "\r\n\r\n";
            $message .= sprintf(esc_html__('Username: %s', 'sala'), $user_login) . "\r\n\r\n";
            $message .= esc_html__('If this was a mistake, just ignore this email and nothing will happen.', 'sala') . "\r\n\r\n";
            $message .= esc_html__('To reset your password, visit the following address:', 'sala') . "\r\n\r\n";
            $message .= '<' . get_permalink($reset_password) . '?action=rp&key=' . $key . '&login=' . rawurlencode($user_login) . ">\r\n";

            if ( is_multisite() )
                $blogname = $GLOBALS['current_site']->site_name;
            else
                $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

            $title = sprintf( esc_html__('[%s] Password Reset', 'sala'), $blogname );
            $title = apply_filters( 'retrieve_password_title', $title, $user_login, $user_data );
            $message = apply_filters( 'retrieve_password_message', $message, $key, $user_login, $user_data );
            if ( $message && !wp_mail( $user_email, wp_specialchars_decode( $title ), $message ) ) {
                echo json_encode(array('success' => false, 'class' => 'text-error', 'message' => esc_html__('The email could not be sent.', 'sala') . "\r\n" . esc_html__('Possible reason: your host may have disabled the mail() function.', 'sala')));
                wp_die();
            } else {
                echo json_encode(array('success' => true, 'class' => 'text-success', 'message' => esc_html__('Please, Check your email to get new password', 'sala') ));
                wp_die();
            }
        }

		//////////////////////////////////////////////////////////////////
		// Ajax reset password
		//////////////////////////////////////////////////////////////////
        public function change_password_ajax() {
            $new_password  	= $_POST['new_password'];
            $login  		= $_POST['login'];
            $user_data 		= get_user_by('login', $login);
			$signin 		= get_theme_mod( 'sign_in' );

			if( !empty($login)){
				$password 		= wp_set_password( $new_password, $user_data->ID );
				echo json_encode(array('success' => true, 'class' => 'text-success', 'message' => esc_html__('Please, re-login!', 'sala'), 'redirect' => get_permalink( $signin ) ));
			} else {
				echo json_encode(array('success' => false, 'class' => 'text-error', 'message' => esc_html__('Error!', 'sala') ));
			}

            wp_die();
        }

	}

	new Sala_Ajax_Include();
}
