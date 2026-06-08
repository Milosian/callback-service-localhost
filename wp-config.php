<?php
define('WP_CACHE', true); // Added by SpeedyCache

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
define( 'DB_NAME', 'if036252646_wp497' );

/** Database username */
define( 'DB_USER', '36252646_5' );

/** Database password */
define( 'DB_PASSWORD', 'p(0VY11S1!' );

/** Database hostname */
define( 'DB_HOST', 'sql213.byetcluster.com' );

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
define( 'AUTH_KEY',         'r2bkx4kwxpgptowt2aylbf6k4umofec5x7yvtrsqruhjfwn0fkpcyqnxuje9g4hc' );
define( 'SECURE_AUTH_KEY',  '01mzp9msrrwo2t8iopd2otu5eweryccyngwzjwk2wl6yscg8pvgl2wub1zm3qmmr' );
define( 'LOGGED_IN_KEY',    '6rjlskuiwrfuxovw7akbtml4r1tn1bpaa4njdytigiaqgnim9ognk1qjospks1bp' );
define( 'NONCE_KEY',        'q1sicyrjskyl6t3sb2cvuxtibhtbzf1s7mqyazt70wuyknn2bvsc2ynyikezxt5z' );
define( 'AUTH_SALT',        'lkexfx03bvsmtqvucrjre9pk68lazmhxjsdna7xixwtfxzthrbhu6bwu7nkhcotc' );
define( 'SECURE_AUTH_SALT', 'hcdgv9jibjsvtalblsoagnt0i2iyyqugofwsutr1mpetuix3cfpjtsg1z1beqvpd' );
define( 'LOGGED_IN_SALT',   'yqn91fc7v7voaglest1juhxxpfca7vf91wlvyg6ezpcohevvcyyoksw9aubezn27' );
define( 'NONCE_SALT',       'tdjwtfxqarl2cjqyjd41dsmb5tginfmvas54dr6b91qsgbbbz1ggswrb5yfnrjxy' );

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
$table_prefix = 'wpm1_';

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

// define('CALLBACK_API_URL', 'http://localhost:3000/api/callback');