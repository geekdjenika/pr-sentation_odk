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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'baseodk' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '|(>TMKy1X<KiUr)4phRYg_!|:memDU6cLqxb3Bhj6:5i&1;,wv-pubLPEpc3Qcd%' );
define( 'SECURE_AUTH_KEY',  '}|tcdJ_LVoQq~n &:pETPZRFd;|I8yp!^KtGl :n:{@Q2vlZ^G5TN}DaSZTBlLm^' );
define( 'LOGGED_IN_KEY',    '$q4;E162wQX`0n$8S_$h<OFs`um;H_l[>x4TdLMt(G5?.3kD#~%A>b{U-NOQMJiJ' );
define( 'NONCE_KEY',        'Xw HSg~<(xmEor`rDkn589 oTwa5]`<Ttxb!!t9vKGI?Q>e-B,!EW+0r7s~|2m%,' );
define( 'AUTH_SALT',        '}jYlOG==q]giYm9*T]sAE_L_*O6YFXbg-nr~hg&Olks*9:kB7!tY*&H?Nc1*;aer' );
define( 'SECURE_AUTH_SALT', '-/su(5>b]oZY.RJ5($w#5!j&9PKO4AT!POzjx>gS!-iRSeRTq$tGUD~JE[cJq504' );
define( 'LOGGED_IN_SALT',   'yu)&<%[,$*!mHWdg k1d(S6tR]?L%S}(6kzEexJy_?SJh_*RTn?JQl~$XJZ$$7?G' );
define( 'NONCE_SALT',       ']G)f c9jZag*^>NJlJ{A^(2{|4[qf%@a0~A/1JNspEh7 v(--`:t6VSp+@pE{DRT' );

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



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
