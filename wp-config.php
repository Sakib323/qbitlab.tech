<?php

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u882501274_Vsd7s' );

/** Database username */
define( 'DB_USER', 'u882501274_wYivl' );

/** Database password */
define( 'DB_PASSWORD', 'doQNnmaTrg' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'BOgp<#Tk[{/o-b`J!v/~>fODYnNpH0^6t/w1xgBt;8Y73d@7S4w7A7wZBd BZ63{' );
define( 'SECURE_AUTH_KEY',   ' |kO4#d9,g];5:KOAX7rDB-onM86Frh0;i+h{KW?|= MC^.d_<.*}SBlz.uLN:,~' );
define( 'LOGGED_IN_KEY',     'A%Ndx+QdtPxkd_M6a-D)~s6{[BXc9;0:5nOIONkvL5a#?{jj7$Gc2&1=G2QOC3Y:' );
define( 'NONCE_KEY',         ' s,dkln|rbXaZ=VN[q[ZuQ feX3`nwfYL$CkX. ^#oL1cZ!neLfi7YaX~skeHYQj' );
define( 'AUTH_SALT',         '|sB!$Xr^w~QP-g-`<#!8ktj8]p>`>S/|7zX)hs)B;f5RpZR|oN c2IFk::BJ*Muz' );
define( 'SECURE_AUTH_SALT',  '6<q_+/y27pMwj@z7knieYYdA(>uU.f]*890GL6_V:o9yKuSQNyx91m4i]lO7YZ.u' );
define( 'LOGGED_IN_SALT',    'j5i0N5p}-$-NOX,[h$ZQN?%CX.j)hT1Zwfpkv&<_.??/4i-(~K3 WWy{^r/{zc)=' );
define( 'NONCE_SALT',        '9;qGBy<ov%D8@m:pkv[tTlShU[FDR/]y q|1Oas}l^Nq$@|Y%-$S,&,g[`F~BFh&' );
define( 'WP_CACHE_KEY_SALT', 'B#rgH87o?%f<I$~<4<uajGuv8p%<cz]:24il<A`?~}+7H^EbZ@oZaDJZX:Xa%5?B' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );


/* Add any custom values between this line and the "stop editing" line. */



define( 'FS_METHOD', 'direct' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
