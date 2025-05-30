<?php

//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL
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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'stackcachewordpress-32303388f0');

/** MySQL database username */
define('DB_USER', 'stackcachewordpress-32303388f0');

/** MySQL database password */
define('DB_PASSWORD', '6f9e0baf3ef6');

/** MySQL hostname */
define('DB_HOST', 'shareddb-e.mvps.stackdb.net');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'eKAvK3A9IYWJ3l+M+WPr5NYc3kXnU8N9');
define('SECURE_AUTH_KEY',  '4PkuHu8Ta9DUXqzzUJSZOTASURkv/m7b');
define('LOGGED_IN_KEY',    'dETCI7k1dFlV+/g3zsj9PgQ1q0zuL/L/');
define('NONCE_KEY',        'GKDJvrStQE98JL2HW2l8mIQle7lzfIF1');
define('AUTH_SALT',        'r4Ur8VL7MM90FrW2Ffncpyz8UwTwQByh');
define('SECURE_AUTH_SALT', 'KBLTB+0a/gd55w3wj16joztXFy31wxmd');
define('LOGGED_IN_SALT',   'M4j8ng01CW2nROtyKMnqZHGDeYrcaGoB');
define('NONCE_SALT',       '1AYaMp8+6yfi9hbg4SX6V4FyemkWMLvl');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'ae_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
