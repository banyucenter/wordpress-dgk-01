<?php
/*
    Our portfolio:  http://themeforest.net/user/xstheme/portfolio
    Thanks for using our theme!
    xstheme - 2018
*/
/**
 * define
 *
 * @return void 
 */
defined( 'XOOAPP_VERSION' )    or  define( 'XOOAPP_VERSION',    '1.0.0' );
define( 'XOOAPP_URL', get_template_directory_uri() );
define( 'XOOAPP_INCLUDES', get_template_directory(). '/includes/' );
define( 'XOOAPP_CSS', get_template_directory_uri(). '/assets/css/' );
define( 'XOOAPP_JS', get_template_directory_uri(). '/assets/js/' );



/**
 * basic after setup theme function.
 */
require XOOAPP_INCLUDES. 'xst-after-setup.php';

/**
 * themes all style and scripts
 */
require XOOAPP_INCLUDES. 'styles-scripts/xst-styles-scripts.php';

/**
 * widget
 *
 * @return void 
 */

require XOOAPP_INCLUDES. 'widgets/xst-widgets.php';

/**
 * themes nav walker
 */
require XOOAPP_INCLUDES. 'wp-bootstrap-navwalker.php';

/**
 * Implement the Custom Header feature.
 */
require XOOAPP_INCLUDES. 'custom-header.php';

/**
 * Custom template tags for this theme.
 */
require XOOAPP_INCLUDES. 'template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require XOOAPP_INCLUDES. 'template-functions.php';

/**
 * Customizer additions.
 */
require XOOAPP_INCLUDES. 'customizer.php';

/**
 * recommanded plugin additions.
 */
require_once XOOAPP_INCLUDES .'tgmpa.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require XOOAPP_INCLUDES. 'jetpack.php';
}


