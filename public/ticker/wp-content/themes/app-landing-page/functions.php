<?php
/**
 * App Landing Page functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package App_Landing_Page
 */

$app_landing_page_theme_data = wp_get_theme();	
if( ! defined( 'APP_LANDING_PAGE_THEME_VERSION' ) )	define( 'APP_LANDING_PAGE_THEME_VERSION', $app_landing_page_theme_data->get( 'Version' ) );
if( ! defined( 'APP_LANDING_PAGE_THEME_NAME' ) ) define( 'APP_LANDING_PAGE_THEME_NAME', $app_landing_page_theme_data->get( 'Name' ) );
if( ! defined( 'APP_LANDING_PAGE_THEME_TEXTDOMAIN' ) ) define( 'APP_LANDING_PAGE_THEME_TEXTDOMAIN', $app_landing_page_theme_data->get( 'TextDomain' ) );

/**
 * Implement the Custom functions.
 */
require get_template_directory() . '/inc/custom-functions.php';

/**
 * Custom template function for this theme.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Meta Box.
 */
require get_template_directory() . '/inc/metabox.php';

/**
 * Widget
 */
require get_template_directory() . '/inc/widgets/widgets.php';
/**
 * Info 
 */
require get_template_directory() . '/inc/customizer/info.php';

/**
 * Plugin Recommendation
*/
require get_template_directory() . '/inc/tgmpa/recommended-plugins.php';

/**
 * Getting Started
*/
require get_template_directory() . '/inc/getting-started/getting-started.php';

/**
 * Add theme compatibility function for woocommerce if active
*/
if( app_landing_page_is_woocommerce_activated() ){
    require get_template_directory() . '/inc/woocommerce-functions.php';    
}

remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );
function custom_menu() { 

  add_menu_page( 
      'Page Title', 
      'Menu Title', 
      'edit_posts', 
      'menu_slug', 
      'page_callback_function', 
      'dashicons-media-spreadsheet' 

     );
}