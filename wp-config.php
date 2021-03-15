<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

define('FS_METHOD','direct');

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'db_digiwp' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '6r`*IM?&MoDx{w6ITC!$^cz$d$3wv^dWws$GlnoJ1ePxshH2Pd>%Mm#&nXfG]q2L' );
define( 'SECURE_AUTH_KEY',  'm+5/1yyb^9vC(tJy^g!I@-kAK2n.:(,fw!a>0q$s]}MxSs_9 =-C-GSerwf1BF`n' );
define( 'LOGGED_IN_KEY',    '^-OyA`+5^%46ZiG?ZXF6q<%+HZ?8^KL0^rXjlnn[b);,|k?lQ9rlUcs/!32d`Txe' );
define( 'NONCE_KEY',        'LfVTx[|~VmH]#sulw>Ztzu; ;x!5aua33c0F~[4Gxpi9amFr;amNmrR~ib3a%5Vg' );
define( 'AUTH_SALT',        'ZH/FlwPux=`b-8RDx(K}HL<-2^MF&rx;&;w}eHYcF[M0oPZXjck%s18Zur8J&uI#' );
define( 'SECURE_AUTH_SALT', '`6:E`kJ}#vtA9E_f-:D`_/Jp39&{3k35+,u>Z@O3~i/{:v2!@7@^RN;2?Cwdse*X' );
define( 'LOGGED_IN_SALT',   '43$OkodeLjs/ r)+T0^J4k!9eZ6fyw`tDF/>:[w~W&`. ~@tV6fPamLTW/fb9uJR' );
define( 'NONCE_SALT',       '6cN6F-@}!/1Ew[ZN Lb@Dsb3 FT=<B&L{pj%%-M]1FHvdN&R@d6]na[P[)D1}3O5' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
