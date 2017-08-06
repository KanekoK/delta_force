<?php
/**
 * Dylan functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package The Dylan
 * @since The Dylan 1.0
 */

if ( ! function_exists( 'the_dylan_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */

function the_dylan_setup() {

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'html5', array( 'gallery', 'caption' ) );
	add_theme_support( 'title-tag' );
	
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	add_editor_style();
	add_image_size( 'the-dylan-widget-post-thumb',  80, 80, true );
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 400,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */

	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'the-dylan' ),
		'footer' => esc_html__( 'Footer Menu', 'the-dylan' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */

	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */

	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'the_dylan_custom_background_args', array(
		'default-color' => '#f2f2f2',
		'default-image' => '',
	) ) );
}

endif; // the_dylan_setup
add_action( 'after_setup_theme', 'the_dylan_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */

function the_dylan_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'the_dylan_content_width', 640 );
}

add_action( 'after_setup_theme', 'the_dylan_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function the_dylan_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'the-dylan' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer One', 'the-dylan' ),
		'id' => 'footer-one-widget',
		'before_widget' => '<div id="footer-one" class="widget footer-widget">',
		'after_widget' => "</div>",
		'before_title' => '<h1>',
		'after_title' => '</h1>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Two', 'the-dylan' ),
		'id' => 'footer-two-widget',
		'before_widget' => '<div id="footer-two" class="widget footer-widget">',
		'after_widget' => "</div>",
		'before_title' => '<h1>',
		'after_title' => '</h1>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Three', 'the-dylan' ),
		'id' => 'footer-three-widget',
		'before_widget' => '<div id="footer-three" class="widget footer-widget">',
		'after_widget' => "</div>",
		'before_title' => '<h1>',
		'after_title' => '</h1>',
	) );
}

add_action( 'widgets_init', 'the_dylan_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function the_dylan_scripts() {
	
	wp_enqueue_script( 'the-dylan-responsive-js', get_template_directory_uri() . '/js/responsive.js', array( 'jquery' ) );
	wp_enqueue_script( 'prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.min.js', array('jquery'));
	wp_enqueue_script( 'the-dylan-custom-js', get_template_directory_uri() . '/js/custom.js', array('jquery') );
	wp_enqueue_script( 'the-dylan-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'the-dylan-ie-responsive', get_template_directory_uri() . "/js/ie-responsive.js");

	wp_enqueue_style( 'the-dylan-responsive', get_template_directory_uri() .'/assets/css/responsive.css', array(), false ,'screen' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() .'/assets/css/font-awesome.min.css' );
	wp_enqueue_style( 'prettyPhoto', get_template_directory_uri() .'/assets/css/prettyPhoto.min.css' );
	wp_enqueue_style( 'google-fonts', the_dylan_fonts_url(), array(), null );
	wp_enqueue_style( 'the-dylan-style', get_stylesheet_uri() );

	wp_enqueue_script( 'the-dylan-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	
	$slider_speed = 6000;
	if ( get_theme_mod( 'the_dylan_slider_speed_setting' ) ) {
		$slider_speed = get_theme_mod( 'the_dylan_slider_speed_setting' ) ;
	}
	wp_localize_script( "the-dylan-custom-js", "slider_speed", array('vars' => $slider_speed) );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'the_dylan_scripts' );

add_filter('wp_get_attachment_link', 'the_dylan_add_rel_attribute');
function the_dylan_add_rel_attribute($link) {
	global $post;
	return str_replace('<a href', '<a rel="prettyPhoto[gallery]" href', $link);
}


if ( ! function_exists( 'the_dylan_fonts_url' ) ) :
function the_dylan_fonts_url() {
	$content_font = get_theme_mod('the_dylan_main_google_font_list', 'Lato');
	$header_font = get_theme_mod('the_dylan_header_google_font_list', 'Lato');
	$fonts     = array();

	$fonts[] = $content_font.'|'.$header_font;
	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( $fonts ) ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

if(!is_user_logged_in()){
	add_filter( 'comment_form_defaults', 'the_dylan_remove_textarea' );
}

function the_dylan_remove_textarea($defaults)
{
    $defaults['comment_field'] = '';
    return $defaults;
}

add_filter( 'comment_form_default_fields', 'the_dylan_comment_fields', 10 );
function the_dylan_comment_fields( $fields ) {
 
	// get the current commenter if available
	$commenter = wp_get_current_commenter();
 
	// core functionality
	$req      = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$html_req = ( $req ? " required='required'" : '' );
 
	// Change just the author field
	$fields = array(
	'comment_notes_after' => ' ',
	'comment_field' => '<div class="row"><div class="col-md-8"><p class="comment-form-comment"><textarea id="comment" name="comment" aria-required="true" placeholder="'.__( 'Your Message...', 'the-dylan' ).'" rows="8" cols="37" wrap="hard"></textarea></p></div>',
	  
	'author' =>
		  '<div class="col-md-4"><p class="comment-form-author">' .
		  '<input id="author" placeholder="'. __('Your name *...', 'the-dylan') .'" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
		  '" size="30"' . $aria_req . ' />' . ( $req ? '<span style="color:red" class="required"></span>' : '' ) . '</p>',

	'email' =>
		  '<p class="comment-form-email">' .
		  '<input id="email" placeholder="'. __('Your email *...', 'the-dylan') .'" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
		  '" size="30"' . $aria_req . ' />' . ( $req ? '<span style="color:red" class="required"></span>' : '' ) . '</p>',

	'url' =>
		 '<p class="comment-form-url">' .
		  '<input id="url" placeholder="'. __('Your website...', 'the-dylan') .'" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
		  '" size="30" /></p></div></div>'
	  
	  
	);
	return $fields;
 
}

require get_template_directory() . '/inc/google-fonts.php';

require get_template_directory() . '/inc/widget.php';


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

