<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * @package App_Landing_Page
*/

if ( ! function_exists( 'app_landing_page_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function app_landing_page_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on App Landing Page, use a find and replace
	 * to change 'app-landing-page' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'app-landing-page', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'app-landing-page' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-list',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'app_landing_page_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Custom Image Size
	add_image_size( 'app-landing-page-banner', 1366, 750, true );
	add_image_size( 'app-landing-page-featured', 170, 170, true );
    add_image_size( 'app-landing-page-with-sidebar', 750, 340, true );
    add_image_size( 'app-landing-page-without-sidebar', 1140, 437, true );
    add_image_size( 'app-landing-page-video-image', 795, 450 , true );
    add_image_size( 'app-landing-page-recent-post', 78, 58, true );
    add_image_size( 'app-landing-page-intro', 341, 466, true );
    add_image_size( 'app-landing-page-features-image', 341, 533, true );

    /* Custom Logo */
    add_theme_support( 'custom-logo', array(    	
    	'header-text' => array( 'site-title', 'site-description' ),
    ) );

}
endif;
add_action( 'after_setup_theme', 'app_landing_page_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function app_landing_page_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'app_landing_page_content_width', 750 );
}
add_action( 'after_setup_theme', 'app_landing_page_content_width', 0 );

/**
* Adjust content_width value according to template.
*/
function app_landing_page_template_redirect_content_width() {
	// Full Width in the absence of sidebar.
	if( is_page() ){
	   $sidebar_layout = app_landing_page_sidebar_layout();
       if( ( $sidebar_layout == 'no-sidebar' ) || ! ( is_active_sidebar( 'right-sidebar' ) )) $GLOBALS['content_width'] = 1140;
	}elseif ( ! ( is_active_sidebar( 'right-sidebar' ) ) ) {
		$GLOBALS['content_width'] = 1170;
	}
}
add_action( 'template_redirect', 'app_landing_page_template_redirect_content_width' );

if ( ! function_exists( 'app_landing_page_scripts' ) ) :
/**
 * Enqueue scripts and styles.
 */
function app_landing_page_scripts() {
    // Use minified libraries if SCRIPT_DEBUG is false
    $build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

  	$app_landing_page_query_args = array(
  		'family' => 'Lato:400,400italic,700,900,300',
  	);
    $ed_scrollbar = get_theme_mod( 'app_landing_page_ed_scrollbar', '' );

    wp_enqueue_style( 'app-landing-page-google-fonts', add_query_arg( $app_landing_page_query_args, "//fonts.googleapis.com/css" ) );
    wp_enqueue_style( 'animate.light', get_template_directory_uri() . '/css' . $build . '/animate' . $suffix . '.css' );
    wp_enqueue_style( 'app-landing-page-style', get_stylesheet_uri(), array(), APP_LANDING_PAGE_THEME_VERSION );
    
    wp_enqueue_script( 'jquery-ui-datepicker' );

    if( app_landing_page_is_woocommerce_activated() ){
      wp_enqueue_style( 'woocommerce', get_template_directory_uri() . '/css' . $build . '/woocommerce' . $suffix . '.css' );
    }

    wp_enqueue_script( 'all', get_template_directory_uri() . '/js' . $build . '/all' . $suffix . '.js', array( 'jquery' ), '5.6.3', true );
    wp_enqueue_script( 'v4-shims', get_template_directory_uri() . '/js' . $build . '/v4-shims' . $suffix . '.js', array( 'jquery' ), '5.6.3', true );
    
    wp_enqueue_script( 'wow', get_template_directory_uri() . '/js' . $build . '/wow' . $suffix . '.js', array('jquery'), '1.1.2', true );
    wp_enqueue_script( 'jquery-countdown', get_template_directory_uri() . '/js' . $build . '/jquery.countdown' . $suffix . '.js', array('jquery'), '2.1.0', true );
    if ( $ed_scrollbar ) {
      wp_enqueue_script( 'nice-scroll', get_template_directory_uri() . '/js' . $build . '/nice-scroll' . $suffix . '.js', array('jquery'), '3.6.6', true );
    }

    wp_enqueue_script( 'app-landing-page-custom', get_template_directory_uri() . '/js' . $build . '/custom' . $suffix . '.js', array('jquery'), APP_LANDING_PAGE_THEME_VERSION, true );

    $app_landing_page_year = get_theme_mod( 'app_landing_page_date_year', date('Y') );
    $app_landing_page_month = get_theme_mod( 'app_landing_page_date_month', date('m') );
    $app_landing_page_date_odd = get_theme_mod( 'app_landing_page_date_day_odd', date('j') );
    $app_landing_page_date_even = get_theme_mod( 'app_landing_page_date_day_even', date('j') );
    $app_landing_page_date_leap = get_theme_mod( 'app_landing_page_date_day_leap', date('j') );
    $app_landing_page_date_noleap = get_theme_mod( 'app_landing_page_date_day_noleap', date('j') );
    $app_landing_page_year_modified = $app_landing_page_year + date('Y') - 1 ;

    if( ( $app_landing_page_year && $app_landing_page_month) && ( $app_landing_page_date_odd || $app_landing_page_date_even || $app_landing_page_date_leap || $app_landing_page_date_noleap ) ) {
     
        if( ( $app_landing_page_date_even ) && ( ( ( ( $app_landing_page_month % 2 ) == 0 ) && ( $app_landing_page_month < 8 )  ) || ( ( ( $app_landing_page_month % 2 ) != 0 ) && ( $app_landing_page_month > 7 ) ) ) && ( $app_landing_page_month != 2 ) && ( $app_landing_page_year ) ){ 
            $app_landing_page_date_modified = $app_landing_page_date_even; 
        }elseif( $app_landing_page_month == 2 ){
            if( ( ( ( $app_landing_page_year_modified % 4 == 0 ) && ( $app_landing_page_year_modified % 100 != 0 ) ) || ( $app_landing_page_year_modified % 400 == 0 ) ) && $app_landing_page_date_leap ){
                $app_landing_page_date_modified = $app_landing_page_date_leap;
            }else{
                if( $app_landing_page_date_noleap ) $app_landing_page_date_modified = $app_landing_page_date_noleap; 
            }
        }else{ 
            $app_landing_page_date_modified = $app_landing_page_date_odd; 
        }
     
        if( $app_landing_page_year_modified && $app_landing_page_month && $app_landing_page_date_modified ){
            $app_landing_page_date =  $app_landing_page_year_modified .'/'. $app_landing_page_month .'/'. $app_landing_page_date_modified; 
        }else{
            $app_landing_page_date = date( 'Y/m/d' );
        }

        $app_landing_page_array = array(
            'date'         => esc_attr( $app_landing_page_date ),
            'ed_scrollbar' => get_theme_mod( 'app_landing_page_ed_scrollbar', '' ),
        );
        wp_localize_script( 'app-landing-page-custom', 'app_landing_page_data', $app_landing_page_array );
    }
 
  	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
  		wp_enqueue_script( 'comment-reply' );
  	}
}
endif;
add_action( 'wp_enqueue_scripts', 'app_landing_page_scripts' );

if( ! function_exists( 'app_landing_page_admin_scripts' ) ) :
/**
 * Enqueue admin scripts and styles.
*/
function app_landing_page_admin_scripts(){
    wp_enqueue_style( 'app-landing-page-admin', get_template_directory_uri() . '/inc/css/admin.css', '', APP_LANDING_PAGE_THEME_VERSION );
}
endif; 
add_action( 'admin_enqueue_scripts', 'app_landing_page_admin_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function app_landing_page_body_classes( $classes ) {
  
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

    // Adds a class of custom-background-image to sites with a custom background image.
    if ( get_background_image() ) {
        $classes[] = 'custom-background-image';
    }
    
    // Adds a class of custom-background-color to sites with a custom background color.
    if ( get_background_color() != 'ffffff' ) {
        $classes[] = 'custom-background-color';
    }

    if(is_page()){
        $app_landing_page_post_class = app_landing_page_sidebar_layout(); 
        if( $app_landing_page_post_class == 'no-sidebar' )
        $classes[] = 'full-width';
    }

    if( !( is_active_sidebar( 'right-sidebar' )) || is_page_template( 'template-home.php' ) || is_404() ) {
        $classes[] = 'full-width'; 
    }

	return $classes;
}
add_filter( 'body_class', 'app_landing_page_body_classes' );

/**
 * Flush out the transients used in app_landing_page_categorized_blog.
 */
function app_landing_page_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'app_landing_page_categories' );
}
add_action( 'edit_category', 'app_landing_page_category_transient_flusher' );
add_action( 'save_post', 'app_landing_page_category_transient_flusher' );

if( ! function_exists( 'app_landing_page_change_comment_form_default_fields' ) ) :
/**
 * Change Comment form default fields i.e. author, email & url.
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function app_landing_page_change_comment_form_default_fields( $fields ){    
    // get the current commenter if available
    $commenter = wp_get_current_commenter();
 
    // core functionality
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $required = ( $req ? " required" : '' );
    $author   = ( $req ? __( 'Name*', 'app-landing-page' ) : __( 'Name', 'app-landing-page' ) );
    $email    = ( $req ? __( 'Email*', 'app-landing-page' ) : __( 'Email', 'app-landing-page' ) );
 
    // Change just the author field
    $fields['author'] = '<p class="comment-form-author"><label class="screen-reader-text" for="author">' . esc_html__( 'Name', 'app-landing-page' ) . '<span class="required">*</span></label><input id="author" name="author" placeholder="' . esc_attr( $author ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $required . ' /></p>';
    
    $fields['email'] = '<p class="comment-form-email"><label class="screen-reader-text" for="email">' . esc_html__( 'Email', 'app-landing-page' ) . '<span class="required">*</span></label><input id="email" name="email" placeholder="' . esc_attr( $email ) . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . $required. ' /></p>';
    
    $fields['url'] = '<p class="comment-form-url"><label class="screen-reader-text" for="url">' . esc_html__( 'Website', 'app-landing-page' ) . '</label><input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'app-landing-page' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'; 
    
    return $fields;    
}
endif;
add_filter( 'comment_form_default_fields', 'app_landing_page_change_comment_form_default_fields' );

if( ! function_exists( 'app_landing_page_change_comment_form_defaults' ) ) :
/**
 * Change Comment Form defaults
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function app_landing_page_change_comment_form_defaults( $defaults ){    
    $defaults['comment_field'] = '<p class="comment-form-comment"><label class="screen-reader-text" for="comment">' . esc_html__( 'Comment', 'app-landing-page' ) . '</label><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'app-landing-page' ) . '" cols="45" rows="8" aria-required="true" required></textarea></p>';
    
    return $defaults;    
}
endif;
add_filter( 'comment_form_defaults', 'app_landing_page_change_comment_form_defaults' );

if ( ! function_exists( 'app_landing_page_excerpt_more' ) ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... * 
 */
function app_landing_page_excerpt_more( $more ) {
	return is_admin() ? $more : ' &hellip; ';
}
endif;
add_filter( 'excerpt_more', 'app_landing_page_excerpt_more' );

if ( ! function_exists( 'app_landing_page_excerpt_length' ) ) :
/**
 * Changes the default 55 character in excerpt 
*/
function app_landing_page_excerpt_length( $length ) {
	return is_admin() ? $length : 40;
}
endif;
add_filter( 'excerpt_length', 'app_landing_page_excerpt_length', 999 );

if( ! function_exists( 'app_landing_page_escape_text_tags' ) ) :
/**
 * Remove new line tags from string
 *
 * @param $text
 * @return string
 */
function app_landing_page_escape_text_tags( $text ) {
    return (string) str_replace( array( "\r", "\n" ), '', strip_tags( $text ) );
}
endif;

if( ! function_exists( 'app_landing_page_single_post_schema' ) ) :
/**
 * Single Post Schema
 *
 * @return string
 */
function app_landing_page_single_post_schema() {
    if ( is_singular( 'post' ) ) {
        global $post;
        $custom_logo_id = get_theme_mod( 'custom_logo' );

        $site_logo   = wp_get_attachment_image_src( $custom_logo_id , 'the-schema-pro-schema' );
        $images      = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
        $excerpt     = app_landing_page_escape_text_tags( $post->post_excerpt );
        $content     = $excerpt === "" ? mb_substr( app_landing_page_escape_text_tags( $post->post_content ), 0, 110 ) : $excerpt;
        $schema_type = ! empty( $custom_logo_id ) && has_post_thumbnail( $post->ID ) ? "BlogPosting" : "Blog";

        $args = array(
            "@context"  => "https://schema.org",
            "@type"     => $schema_type,
            "mainEntityOfPage" => array(
                "@type" => "WebPage",
                "@id"   => esc_url( get_permalink( $post->ID ) )
            ),
            "headline"  => esc_html( get_the_title( $post->ID ) ),
            "datePublished" => esc_html( get_the_time( DATE_ISO8601, $post->ID ) ),
            "dateModified"  => esc_html( get_post_modified_time(  DATE_ISO8601, __return_false(), $post->ID ) ),
            "author"        => array(
                "@type"     => "Person",
                "name"      => app_landing_page_escape_text_tags( get_the_author_meta( 'display_name', $post->post_author ) )
            ),
            "description" => ( class_exists('WPSEO_Meta') ? WPSEO_Meta::get_value( 'metadesc' ) : $content )
        );

        if ( has_post_thumbnail( $post->ID ) ) :
            $args['image'] = array(
                "@type"  => "ImageObject",
                "url"    => $images[0],
                "width"  => $images[1],
                "height" => $images[2]
            );
        endif;

        if ( ! empty( $custom_logo_id ) ) :
            $args['publisher'] = array(
                "@type"       => "Organization",
                "name"        => esc_html( get_bloginfo( 'name' ) ),
                "description" => wp_kses_post( get_bloginfo( 'description' ) ),
                "logo"        => array(
                    "@type"   => "ImageObject",
                    "url"     => $site_logo[0],
                    "width"   => $site_logo[1],
                    "height"  => $site_logo[2]
                )
            );
        endif;

        echo '<script type="application/ld+json">';
        if ( version_compare( PHP_VERSION, '5.4.0' , '>=' ) ) {
            echo wp_json_encode( $args, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
        } else {
            echo wp_json_encode( $args );
        }
        echo '</script>';
    }
}
endif;
add_action( 'wp_head', 'app_landing_page_single_post_schema' );

if( ! function_exists( 'app_landing_page_admin_notice' ) ) :
/**
 * Addmin notice for getting started page
*/
function app_landing_page_admin_notice(){
    global $pagenow;
    $theme_args      = wp_get_theme();
    $meta            = get_option( 'app_landing_page_admin_notice' );
    $name            = $theme_args->__get( 'Name' );
    $current_screen  = get_current_screen();
    
    if( 'themes.php' == $pagenow && !$meta ){
        
        if( $current_screen->id !== 'dashboard' && $current_screen->id !== 'themes' ){
            return;
        }

        if( is_network_admin() ){
            return;
        }

        if( ! current_user_can( 'manage_options' ) ){
            return;
        } ?>

        <div class="welcome-message notice notice-info">
            <div class="notice-wrapper">
                <div class="notice-text">
                    <h3><?php esc_html_e( 'Congratulations!', 'app-landing-page' ); ?></h3>
                    <p><?php printf( __( '%1$s is now installed and ready to use. Click below to see theme documentation, plugins to install and other details to get started.', 'app-landing-page' ), esc_html( $name ) ); ?></p>
                    <p><a href="<?php echo esc_url( admin_url( 'themes.php?page=app-landing-page-getting-started' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Go to the getting started.', 'app-landing-page' ); ?></a></p>
                    <p class="dismiss-link"><strong><a href="?app_landing_page_admin_notice=1"><?php esc_html_e( 'Dismiss', 'app-landing-page' ); ?></a></strong></p>
                </div>
            </div>
        </div>
    <?php }
}
endif;
add_action( 'admin_notices', 'app_landing_page_admin_notice' );

if( ! function_exists( 'app_landing_page_update_admin_notice' ) ) :
/**
 * Updating admin notice on dismiss
*/
function app_landing_page_update_admin_notice(){
    if ( isset( $_GET['app_landing_page_admin_notice'] ) && $_GET['app_landing_page_admin_notice'] = '1' ) {
        update_option( 'app_landing_page_admin_notice', true );
    }
}
endif;
add_action( 'admin_init', 'app_landing_page_update_admin_notice' );