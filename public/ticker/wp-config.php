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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'ticker' );

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
define( 'AUTH_KEY',         '7F)BbUg!uQ}:G<y-v)EwtO/2^ww8I`UgiYjUX->p-C78Z15M%Z&>l7tO4;#Wi(A/' );
define( 'SECURE_AUTH_KEY',  '%q|cc6l`?)B9/6#%>F%gjx96j{Rw(OT,i_2E]!Pn4c1CM9Ggfk&>;zT>eAE]3R+H' );
define( 'LOGGED_IN_KEY',    'd-NP=b2/T%&d0I$KzvT`}<T0NbF(g3V/H<aNXM%geUM}(zB<pU_a8%U0X$8pG^u@' );
define( 'NONCE_KEY',        '6w_oHdHQ#p{6hPl(x_zdk`:g}tDLP*}8w:a=.&6S.)|:k7=*dw)jwFNxp+p>o!x^' );
define( 'AUTH_SALT',        'r74XtYf6`fJ^6_}LYjNj`k(G`b02EoVV>sA~Vhi#8;w*kd5WC?9n]%ZS[A)SEY+T' );
define( 'SECURE_AUTH_SALT', '0Z?Bfzk16@Y~wXUfH_pf[H3u k!.<O9]MH9=Q!u`,x5gnHPF,IgMceK4*EnWVOC&' );
define( 'LOGGED_IN_SALT',   'QGs-9LY,)(s+Mz!WE@U2o)*5t&b(YE=n1vGdJxpe});d]VG f4n lahz *J[}xyS' );
define( 'NONCE_SALT',       'hemwS?L1,7K,5[UHZw+,R[+S*`0i{*D=eh.AK[},+F$0*_@q;3TsMO$lV<Q<=,>v' );
define( 'WP_HOME', 'https://wf.newscentral.ng/ticker/' );
define( 'WP_SITEURL', 'https://wf.newscentral.ng/ticker/' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'ticker';

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
define( 'FS_METHOD', 'direct' );
