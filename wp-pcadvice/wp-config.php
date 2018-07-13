<?php

/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', '1850458_pcadvice');

/** MySQL database username */
define('DB_USER', '1850458_pcadvice');

/** MySQL database password */
define('DB_PASSWORD', '1850458_pcadvice');

/** MySQL hostname */
define('DB_HOST', 'fdb13.biz.nf');

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
define('AUTH_KEY',         '#mOMWLK;[+fnQ873x5+*2|8%|Y#4;HU@YJ:v!,[At:U(M*J@l8y3`Rvb}xb(;OPH');
define('SECURE_AUTH_KEY',  'cG*UAS&b-?n<Pr7}|_$o3]qJ_~/:9Q0[2#^6Hy>-V}RC%U:1jhPZYn}.&?1%eAhi');
define('LOGGED_IN_KEY',    'Xk[&d{yyLMW B5+Y0.+L@oT-V@?V|xWcpedo48io!NaunjRC$<]E-2H+bg=o9.hY');
define('NONCE_KEY',        'on6}&)1myqm$7in.tZuhNJ`WbJvV;1<4H]+9K-C<KxZvp8~1.)#-p^|g0&P$FH|-');
define('AUTH_SALT',        'f4-cJ$D>5 N+#/)yhn7W?_m-%/;K@{/Unlp5AuP6[Llz5xl^`QkWw/#w~1j /Ct-');
define('SECURE_AUTH_SALT', 'YtQ%qO@*&XUi*:j9bfq A/1+`rCn{#4kdI-7BXV/V+2vvD[5DN6RXsf|1cy}f=?K');
define('LOGGED_IN_SALT',   '>Ub5@V0S0HU;cdAA~=4+qqrzb(K<GvP_O4}33!gN=qEH!!e>,mb]B./IKxjR3=hW');
define('NONCE_SALT',       'x_2ED1f+-21 pg/|J6-j{z`$N_Tdl8-+28o{[_n_)&ryf]su<(j|I`VWp7E(QX>]');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', true);
// define('WP_DEBUG', false);

define( 'AUTOSAVE_INTERVAL', 60);
define('WP_POST_REVISIONS', 5);

/* Multisite */
define( 'WP_ALLOW_MULTISITE', true );

define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', 'pcadvice.co.nf');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
