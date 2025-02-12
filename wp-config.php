<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'task_db' );

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
define( 'AUTH_KEY',         '@69Fwj7<h->4QAJ-*7@6}{}?a)xn^2TQ_U&LvEE1%fD556lGu:vQwYRr7]Wf!lo+' );
define( 'SECURE_AUTH_KEY',  '[kxj. DSAaH28={%I*KV_rPTR:NQYfxKhEwM&w!rn:_9@ER!;>6:{YL/E{|@:|)%' );
define( 'LOGGED_IN_KEY',    '.f~M,s?9uO7Wwdo(bfAx6zV:13$Afh.:1LX,Q2-u:S.FAk5tTU:L]_[4ccd5b&#/' );
define( 'NONCE_KEY',        'B^B,:{x0|L nZ,p`5f;>$jt~jld]C$leSLgL.1ib-UD/=:#!:s9;AXz%N)O}`k?s' );
define( 'AUTH_SALT',        'guJ1mKPWuK,<.1v}a/f_$(ZO Q2rQ.k!0jKwcwpK]@#7+C*6Nh[?nH;%]Q=4}lER' );
define( 'SECURE_AUTH_SALT', 'RW]X$zZB>C*.6EQtmqfgQqow+(xQsFg2[BFk<;W2q}VQt<}N{;y98YG;_m2y4F`E' );
define( 'LOGGED_IN_SALT',   '~{+UEgcpQs#_*{;%{hRHwtMw3h3n#b~6gEu=9j7Q%Y$cd7mN[[O!143@09a{SNCG' );
define( 'NONCE_SALT',       'X24{>^~~X/yk]nGkGEq=F*=IYc}!t/WGZM=7mBh[g9G@IJ+Nz@8PwHVq~E`W1NQ_' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
