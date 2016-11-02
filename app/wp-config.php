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
define('DB_NAME', 'zentdb4672');
// define('DB_NAME', 'zent');

/** MySQL database username */
define('DB_USER', 'root');
// define('DB_USER', 'zent');

/** MySQL database password */
define('DB_PASSWORD', 'root');
// define('DB_PASSWORD', 'o53e9xiedxod52I');

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
define('AUTH_KEY',         'z8!0 ^rv;,&>;,4p(vbcO:D0aN|2K4=~G0h_C>RKkFKTa5Sf|WodbJ2iIe$3^8Nz');
define('SECURE_AUTH_KEY',  '5!ZN;h30jq:-TZ=d|Ln+qr|OKTff -_V y{?JS}R6_?Y[Nr0PP>[-,)MO<]Y|TVl');
define('LOGGED_IN_KEY',    'z=CW.w3Mwl01)au]k%BIpYmNXb#RB^7%AX9H3m|?jc$)~a#YtOoT:>aJx*idF7F?');
define('NONCE_KEY',        'C7A*Q mr2T<[i6T.0s*&W5lSjIX^sW7M]TIL2zikG1q{+cG(TcNcZZ[BSys|^`Tg');
define('AUTH_SALT',        'CMzg.z|$a+%yx/@!uu{!FNn6|D8M[WyJ,):w}ys]H&,?d.+%~/y;zBJ#PG`VFOI}');
define('SECURE_AUTH_SALT', 'J@}uWfh9Mq|/:bU?UG`:,gUkQK#3WXe3u]gpz1^GEnihD1b(dMcDr0.]P;W4}_.r');
define('LOGGED_IN_SALT',   '.#9Mxr+Y;,6-zu^^Siwgmxm5qVmil[KpGn#qLWFDRnSoSNkxV*lbt*lO!(+l,,T)');
define('NONCE_SALT',       '0d.nhrimZ#gsm,`{2.JvmX!vzH{}ABQFq]x)H`(-Ah:kfmMnV<j<Ga6S~dnY^6a)');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'f34_';

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
