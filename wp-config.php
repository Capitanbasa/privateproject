<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'triplebackup');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');//*

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
define('FS_METHOD', 'direct');



/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'fxJ;-WB+:t%z]n]iBtQm5KPMCNM< [(IEDDhYw)K>O>Cj4_{vadgH7|Rn2-&ZZS/');
define('SECURE_AUTH_KEY',  '[X^#fdw:$>S//*GS)%/1eW]>E7d&F{e@SX|nUM0c4NOLM~+X`vSY%f0{b[2iaF4R');
define('LOGGED_IN_KEY',    '~+{T#t+v1_]0JBse;tjJ`,/v/j5,d=_zL2Nzik|#Nh=Q/9P}Xx*@E$ul8*Pd3pym');
define('NONCE_KEY',        'ma7ekK [I=cX Z|*Fi/%@|fo@zz~,zcC|~!2nk5SB~Y>7F 6rKt|.(*GJs#keiF3');
define('AUTH_SALT',        'T]Qb/bDilEZVXt*U!]%+QiIItKl#)]Il)!8^_hAf(-h>n&Pd^H%a^ZC?{.p?c(fw');
define('SECURE_AUTH_SALT', 'J&,Do|oUP}0i_mK.MGX#x8]GHLBg&b2&uB07v+V!H2>mIi@`0*>W!~RyUNh|VS.*');
define('LOGGED_IN_SALT',   '61U b7_aN?40P+^f1*&-GaRn77ka7s{)-.`59?PgG)9JuXt&9Q29>L`OP[N}OjO|');
define('NONCE_SALT',       'bDF$s>UVRb?0J2wSzFK4cXSm?TPNqa+::</wu{hu!w?Y~)-hAOr.DP1Qj@BwX2Vm');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);
 
 // Use dev versions of core JS and CSS files (only needed if you are modifying these core files)
 define( 'SCRIPT_DEBUG', true );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
