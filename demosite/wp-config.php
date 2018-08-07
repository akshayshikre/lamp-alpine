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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'demosite');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '#|wJ9?@oQ[<,S2(-D^tkTu-zt[%%%M&G*4tDNe,b7_S9y0aTdw?pt0#>:8-Xz`+t');
define('SECURE_AUTH_KEY',  'CHQ[*1TJSE}doHaq,:amn*WS7ARW(%flB@G||xu6q=Au+|GdI13t~ @zyX#0+!1U');
define('LOGGED_IN_KEY',    'kv*As5$ EN,2hyN`u*u9JMRWWRHIOn&,0>}{p*KWfgRQ*k@2^>MB34#{9NN63ch9');
define('NONCE_KEY',        'Io{h]Uh}MU#5R4W%l?a|>>Q2cnfq}#P$rts%&+ZWQxAV@(Z}9GT,VU}a<*atYaU]');
define('AUTH_SALT',        '1fv,ofCG&28u.gP3|/pdxLbeQ8j0M6.+o^R-cb.^A9SvPhuv6FpKiZ6D+ }iVGzw');
define('SECURE_AUTH_SALT', 'yFr0%.Pl7aA6il|jkCy1=g9|IxNu}$.1v&~KOxknDyMEh|@emxfsN>f+LHkmN!VK');
define('LOGGED_IN_SALT',   'D3-yGXq%<<Sd~8lg8f:SR|l!EnA+.D95Ak16r%)=F49fvBgL>SYSUDr.R-mbFjJK');
define('NONCE_SALT',       'P=,WRU K,>d3kgCx=6&N{vacyoE^]LpH!bt}6qG7OeaMp F^73Ly@CTJOZM4zUW0');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
