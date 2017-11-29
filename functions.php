<?php
/**
 * Unwritten Future functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link http://codex.wordpress.org/Theme_Development
 * @link http://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 *
 */

/** table of contents

1. Settings & variables:
	content width
	version compare
	options values

2. Setup:
	uwf_setup - Set up theme defaults and registers support for various WordPress features.
	uwf_widgets_init - Initialize widgets

3. Meta
	uwf_wp_title - more specific title element
	uwf_font_url - Google fonts
	uwf_scripts - load scripts and css dynamically
	uwf_custom_css - loads custom css from theme options
	uwf_custom_js - loads custom javascript from theme options

4. Content
	uwf_navigation_title - returns title for navigation
	uwf_body_classes - extends default WP body classes
	uwf_post_classes - extends default WP post classes

5. shortcodes
	uwf_html - shortcode for including raw HTML (to evade filter)

6. Admin
	uwf_register_options,
	uwf_theme_options,
	uwf_theme_options_page,
	uwf_theme_options_help,
	uwf_validate_options - create options page
	uwf_add_editor_perms - give users with "editor" role access to theme options (menus, widgets, etc.)
	

*/


/**
 * 1. Setting variables
 * -----------------------------------------------------------
 */

/**
 * Set up the content width value based on the theme's design.
 *
 * @see uwf_content_width()
 *
 * @since uwf 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 747;
}

/**
 * uwf only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

/**
 * uwf options values
 */
global $uwf_options, $uwf_js_options;
$uwf_options = array(
	
	// for php
	'logo_url' => get_template_directory_uri() . '/images/logo.png',
	'navigation_title' => 'Navigation',
	'footer_cols' => 3,
	'google_fonts' => '',
	'custom_css' => '',
	'custom_js' => '',
	'editor_perms' => 0,

	// to pass to javascript
	'validateForms' => 1,
	'fixFooter' => 0,
	'shortenLinks' => 1,
	'shortenLinksSelector' => 'a',
	'externalLinks' => 1,
	'externalLinksExceptions' => '',
	'sectionNavigationSelector' => '.section-navigation',
	'sectionNavigationPadding' => 20,
	'mobileBreakPoint' => 768,
	'mobileMenuDirection' => 'left',
	'onThisPageHeading' => 'h2',
	'onThisPageNav' => '#on-this-page',
	'onThisPageMinimumSections' => 2,
);
$uwf_options = get_option( 'uwf_options', $uwf_options );



/**
 * 2. Setup functions
 * -----------------------------------------------------------
 */


/**
 * uwf setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 * @since uwf 1.0
 */
if ( ! function_exists( 'uwf_setup' ) ) :
function uwf_setup() {

	/*
	 * Make uwf available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on uwf, use a find and
	 * replace to change 'uwf' to the name of your theme in all
	 * template files.
	 */

	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 'css/editor-style.css', uwf_font_url() ) );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 160, 160, true );
	add_image_size( 'uwf-full-width', 800, 450, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Top primary menu', 'uwf' ),
		'secondary' => __( 'Secondary menu in left sidebar', 'uwf' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
/*
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
	) );
*/

}
endif; // uwf_setup
add_action( 'after_setup_theme', 'uwf_setup' );

/**
 * Register uwf widget areas.
 *
 * @since uwf 1.0
 *
 * @return void
 */
if ( ! function_exists( 'uwf_widgets_init' ) ) :
function uwf_widgets_init() {
	global $uwf_options;

		switch ( $uwf_options['footer_cols'] ) {
			case 1:
				$footer_widget_class = 'col-sm-12';
				break;
			case 2:
				$footer_widget_class = 'col-sm-6';
				break;
			case 3:
				$footer_widget_class = 'col-sm-4';
				break;
			case 4:
				$footer_widget_class = 'col-sm-6 col-md-3';
				break;
		}

	// register widgets here
	// require get_template_directory() . '/inc/widgets.php';
	// register_widget( 'Webskillet14_Widget' );

	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'uwf' ),
		'id'            => 'sidebar',
		'description'   => __( 'Main sidebar', 'uwf' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Highlighted', 'uwf' ),
		'id'            => 'highlighted',
		'description'   => __( 'Additional widget area that appears above the content.', 'uwf' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Swaths', 'uwf' ),
		'id'            => 'swaths',
		'description'   => __( 'Widgets appear as horizontal swaths below the content, above the footer.', 'uwf' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Utility Widget Area', 'uwf' ),
		'id'            => 'utility',
		'description'   => __( 'Appears just above the footer on mobile, on iPads and larger devices is placed in upper right-hand corner using absolute positioning', 'uwf' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area', 'uwf' ),
		'id'            => 'footer',
		'description'   => __( 'Appears in the footer section of the site. Theme setting configures whether they appear in 1, 2, 3 or 4 columns.', 'uwf' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s col-xs-12 '.$footer_widget_class.'">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Modals', 'uwf' ),
		'id'            => 'modals',
		'description'   => __( 'Any widget placed in this area can be opened as a modal by linking to its id attribute', 'uwf' ),
		'before_widget' => '<aside id="%1$s" class="widget modal %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
endif;
add_action( 'widgets_init', 'uwf_widgets_init' );



/**
 * 3. Meta functions
 * -----------------------------------------------------------
 */

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since uwf 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
if ( ! function_exists( 'uwf_wp_title' ) ) :
function uwf_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'uwf' ), max( $paged, $page ) );
	}

	return $title;
}
endif;
add_filter( 'wp_title', 'uwf_wp_title', 10, 2 );



/**
 * Register Google fonts for uwf.
 *
 * @since uwf 1.0
 *
 * @return string
 */
if ( ! function_exists( 'uwf_font_url' ) ) :
function uwf_font_url() {
	global $uwf_options;
	$font_url = '';
	if ($uwf_options['google_fonts']) {
		$font_url = add_query_arg( 'family', $uwf_options['google_fonts'], "https://fonts.googleapis.com/css" );
	}

	return $font_url;
}
endif;

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since uwf 1.0
 *
 * @return void
 */
if ( ! function_exists( 'uwf_scripts' ) ) :
function uwf_scripts() {
	global $uwf_options, $uwf_js_options;
	$css_deps = array();

	/**
	 * css
	 */

	// Add Google fonts.
	$font_url = uwf_font_url();
	if ($font_url) {
		wp_enqueue_style( 'uwf-googlefonts', $font_url, array(), null );
		$css_deps[] = 'uwf-googlefonts';
	}

	// Load our reset and bootstrap
	wp_enqueue_style( 'uwf-reset', get_template_directory_uri() . '/css/reset.css', $css_deps, '20131205' );
	$css_deps[] = 'uwf-reset';
	wp_enqueue_style( 'uwf-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', $css_deps, '20131205' );
	$css_deps[] = 'uwf-bootstrap';

	// Load our compass/sass stylesheet, where all of the actual styles happen
	wp_enqueue_style( 'uwf-screen', get_template_directory_uri() . '/css/screen.css', $css_deps );

	// Wordpress-specific styles
	wp_enqueue_style( 'uwf-wp', get_template_directory_uri() . '/css/wp.css', $css_deps );
	
	// we don't load our main theme stylesheet, because it does not include any actual styling
	// wp_enqueue_style( 'uwf-style', get_stylesheet_uri(), $css_deps );

	// Load the print stylesheet
	wp_enqueue_style( 'uwf-print', get_template_directory_uri() . '/css/print.css', array( 'uwf-screen' ), '20131205', 'print' );

	/**
	 * javascript
	 */

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	// options to pass to Javascript
	$options_to_pass = array(
		'validateForms',
		'fixFooter',
		'shortenLinks',
		'shortenLinksSelector',
		'externalLinks',
		'externalLinksExceptions',
		'sectionNavigationSelector',
		'sectionNavigationPadding',
		'mobileBreakPoint',
		'mobileMenuDirection',
		'onThisPageHeading',
		'onThisPageNav',
		'onThisPageMinimumSections',
	);
	$options_to_pass_boolean = array(
		'validateForms',
		'fixFooter',
		'shortenLinks',
		'externalLinks',
	);
	foreach ($options_to_pass as $option_key) {
		$uwf_js_options[$option_key] = isset($uwf_options[$option_key]) ? $uwf_options[$option_key] : '';
		if (in_array($option_key, $options_to_pass_boolean)) { $uwf_js_options[$option_key] = (bool) $uwf_js_options[$option_key]; }
	}
	
	// localize text for javascript
	$uwf_text = array(
		'dismissMenu' => __('Dismiss menu'),
		'openSubmenu' => __('Open submenu'),
		'closeSubmenu' => __('Close submenu'),
		'dismissMessage' => __('Dismiss message'),
		'dismissModal' => __('Dismiss modal'),
		'opensNewWindow' => __('Opens in a new window'),
		'backToTop' => __('Back to top'),
		'link' => '('.__('link').')',
	);

	wp_enqueue_script( 'uwf-modernizr', get_template_directory_uri() . '/js/modernizr.js', array(), '20140213' );
	wp_enqueue_script( 'uwf-fastclick', get_template_directory_uri() . '/js/fastclick.min.js', array(), '20160116' );
	wp_enqueue_script( 'uwf-hammer', get_template_directory_uri() . '/js/hammer.min.js', array(), '20160116' );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'uwf-jquery-validate', get_template_directory_uri() . '/js/jquery.validate.js', array( 'jquery' ), '20160116' );
	wp_enqueue_script( 'uwf-uwfutil', get_template_directory_uri() . '/js/uwfutil.js', array('uwf-modernizr', 'uwf-fastclick', 'uwf-hammer', 'jquery', 'uwf-jquery-validate'), '20160414' );
	wp_localize_script( 'uwf-uwfutil', 'uwfOptions', $uwf_js_options);
	wp_localize_script( 'uwf-uwfutil', 'uwfText', $uwf_text);
}
endif;
add_action( 'wp_enqueue_scripts', 'uwf_scripts' );

/**
 * Add custom css and js from theme options
 *
 * @since uwf 1.0
 *
 * @return void
 */
if ( ! function_exists( 'uwf_custom_css' ) ) :
function uwf_custom_css() {
	global $uwf_options;
	$custom_css = trim($uwf_options['custom_css']);
	if ($custom_css) { echo "<style>\n".$custom_css."\n</style>"; }
}
endif;
add_action( 'wp_head', 'uwf_custom_css', 8 );

if ( ! function_exists( 'uwf_custom_js' ) ) :
function uwf_custom_js() {
	global $uwf_options;
	$custom_js = trim($uwf_options['custom_js']);
	if ($custom_js) { echo "<script>\n".$custom_js."\n</script>"; }
}
endif;
add_action( 'wp_head', 'uwf_custom_js', 9 );



/**
 * 4. Content functions
 * -----------------------------------------------------------
 */

if ( ! function_exists( 'uwf_get_logo' ) ) :
function uwf_get_logo() {
	global $uwf_options;
	$output = '';
	if ($uwf_options['logo_url']) {
		$output .= '<img src="'.$uwf_options['logo_url'].'" />';
	}
	return $output;
}
endif;

if ( ! function_exists( 'uwf_navigation_title' ) ) :
function uwf_navigation_title() {
	global $uwf_options;
	$output = __(($uwf_options['navigation_title'] ? $uwf_options['navigation_title'] : 'Navigation'), 'uwf');
	echo $output;
}
endif;

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Presence of header image.
 * 3. Index views.
 * 4. Full-width content layout.
 * 5. Presence of footer widgets.
 * 6. Single views.
 * 7. Featured content layout.
 *
 * @since uwf 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
if ( ! function_exists( 'uwf_body_classes' ) ) :
function uwf_body_classes( $classes ) {
	global $uwf_options;

	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( get_header_image() ) {
		$classes[] = 'header-image';
	} else {
		$classes[] = 'masthead-fixed';
	}

	if ( is_archive() || is_search() || is_home() ) {
		$classes[] = 'list-view';
	}

	if ( ( ! is_active_sidebar( 'sidebar' ) )
		|| is_attachment() ) {
		$classes[] = 'full-width';
	}

	if ( is_singular() && ! is_front_page() ) {
		$classes[] = 'singular';
	}

	if ( is_front_page() ) {
		$classes[] = 'front';
	} else {
		$classes[] = 'not-front';
	}

	return $classes;
}
endif;
add_filter( 'body_class', 'uwf_body_classes' );

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @since uwf 1.0
 *
 * @param array $classes A list of existing post class values.
 * @return array The filtered post class list.
 */
if ( ! function_exists( 'uwf_post_classes' ) ) :
function uwf_post_classes( $classes ) {
	if ( ! post_password_required() && has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	}

	return $classes;
}
endif;
add_filter( 'post_class', 'uwf_post_classes' );


/**
 * 5. Shortcodes
 * -----------------------------------------------------------
 */

if ( ! function_exists( 'uwf_html' ) ) :
function uwf_html( $atts, $content ) {
	$content = preg_replace('#</?p>|<br ?/?>#','',$content);
	return $content;
}
endif;
add_shortcode('html', 'uwf_html');

/**
 * displays one or more summaries using WP_Query
 * attributes can be any of the parameters for WP_Query:
 * https://codex.wordpress.org/Class_Reference/WP_Query#Parameters
 * EXCEPT fields and those which require associative arrays:
 * tax_query, date_query, meta_query and the orderby array option
 * parameters which take simple arrays should have arguments separated by commas
 */
if (! function_exists( 'uwf_post_summary' ) ) :
function uwf_post_summary( $atts, $content ) {

	// global variable so that individual posts aren't displayed multiple times
	global $uwf_post_summaries_displayed;
	if (!isset($uwf_post_summaries_displayed)) { $uwf_post_summaries_displayed = array(); }

	$available_parameters = array(
		'author',
		'author_name',
		'cat',
		'category_name',
		'tag',
		'tag_id',
		's',
		'p',
		'name',
		'page_id',
		'pagename',
		'post_parent',
		'has_password',
		'post_password',
		'nopaging',
		'posts_per_page',
		'posts_per_archive_page',
		'offset',
		'paged',
		'page',
		'ignore_sticky_posts',
		'order',
		'orderby',
		'year',
		'monthnum',
		'w',
		'day',
		'hour',
		'minute',
		'second',
		'm',
		'meta_key',
		'meta_value',
		'meta_value_num',
		'meta_compare',
		'perm',
		'post_mime_time',
		'cache_results',
		'update_post_meta_cache',
		'update_post_term_cache',
	);
	$available_parameters_array = array(
		'author__in',
		'author__not_in',
		'category__and',
		'category__in',
		'category__not_in',
		'tag__and',
		'tag__in',
		'tag__not_in',
		'tag_slug__and',
		'tag_slug__in',
		'post_parent__in',
		'post_parent__not_in',
		'post__in',
		'post__not_in',
		'post_name__in',
		'post_type',
		'post_status',
	);

	$params = array(
		'orderby' => 'date',
		'order' => 'DESC',
		'post__not_in' => $uwf_post_summaries_displayed,
	);

	foreach ( $available_parameters as $param_key) {
		if ( isset($atts[$param_key]) ) {
			$params[$param_key] = $atts[$param_key];
		}
	}

	foreach ( $available_parameters_array as $param_key) {
		if ( isset($atts[$param_key]) ) {
			if ($param_key == 'post__not_in') {
				$params['post__not_in'] = array_merge( $params['post__not_in'], explode(',',$atts['post__not_in']) );
			} else {
				$params[$param_key] = explode(',',$atts[$param_key]);
			}
		}
	}

	// special attributes: n, display_thumbnail, post_thumbnail_size, read_more
	if (!isset($params['posts_per_page'])) {
		$params['posts_per_page'] = isset($atts['n']) ? $atts['n'] : -1;
	}
	$display_thumbnail = isset($atts['display_thumbnail']) && $atts['display_thumbnail'];
	$post_thumbnail_size = isset($atts['post_thumbnail_size']) ? $atts['post_thumbnail_size'] : 'post-thumbnail';
	$readmore = isset($atts['read_more']) ? $atts['read_more'] : 'Read more';

	$r = new WP_Query( $params );
	if ($r->have_posts()) {
		while ( $r->have_posts() ) {
			$r->the_post();
			$output .= '<div class="post-summary">';
			$output .= '<h2 class="post-summary-title">'.get_the_title().'</h2>';
			if ($display_thumbnail) {
				$output .= '<div class="post-summary-thumbnail">'.get_the_post_thumbnail($r->ID, $post_thumbnail_size).'</div>';
			}
			$output .= '<div class="post-summary-content">'.apply_filters( 'the_content', get_the_content($readmore) ).'</div>';
			$output .= '</div>';
		}
	}
	wp_reset_postdata();

	// add any 
	if (isset($atts['p'])) {
		$post_summarys_displayed = explode( ',' , $atts['p'] );
		$uwf_post_summaries_displayed = array_merge( $uwf_post_summaries_displayed, $post_summarys_displayed );
	}

	return $output;

}
endif;
add_shortcode( 'post-summary', 'uwf_post_summary' );


/**
 * 6. Administration
 * -----------------------------------------------------------
 */

if ( is_admin() ) : // Load only if we are viewing an admin page

if ( ! function_exists('uwf_enqueue_admin_scripts') ) :
function uwf_enqueue_admin_scripts(){
	wp_register_script( 'uwf-admin-js', get_template_directory_uri() . '/js/admin.js', array ( 'jquery', 'media-upload', 'thickbox' ) );
	wp_register_style( 'uwf-admin-css', get_template_directory_uri() . '/css/admin.css', array ( 'dashicons', 'wp-admin', 'buttons' ) );
	if ( get_current_screen() -> id == 'appearance_page_theme_options' ) {

		wp_enqueue_script('jquery');

		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');

		wp_enqueue_script('media-upload');
		wp_enqueue_script('uwf-admin-js');

		wp_enqueue_style('uwf-admin-css');
	}
}
endif;
add_action( 'admin_enqueue_scripts', 'uwf_enqueue_admin_scripts' );

if ( ! function_exists( 'uwf_register_options' ) ) :
function uwf_register_options() {
	global $pagenow;

	// Register settings and call sanitation functions
	register_setting( 'uwf_theme_options', 'uwf_options', 'uwf_validate_options' );

	// set up text filter to change button on media uploader when we're choosing a logo
	if ( $pagenow == 'media-upload.php' || $pagenow == 'async-upload.php' ) {
		add_filter( 'gettext', 'uwf_replace_thickbox_text', 1, 3 );
	}
}
endif;
add_action( 'admin_init', 'uwf_register_options' );

if ( ! function_exists( 'uwf_replace_thickbox_text' ) ) :
function uwf_replace_thickbox_text($translated_text, $text, $domain) {
	if ($text == 'Insert into Post') {
		$referer = strpos( wp_get_referer(), 'uwf-settings' );
		if ($referer !== false) {
			return __('Select as logo', 'uwf' );
		}
	}
	return $translated_text;
}
endif;

if ( ! function_exists( 'uwf_theme_options' ) ) :
function uwf_theme_options() {

	// Add theme options page to the admin menu
	$theme_page_hook = add_theme_page( 'Theme Options', 'Theme Options', 'edit_theme_options', 'theme_options', 'uwf_theme_options_page' );
	add_action( 'load-' . $theme_page_hook, 'uwf_theme_options_help' );
}
endif;
add_action( 'admin_menu', 'uwf_theme_options' );

// Function to generate options page
if ( ! function_exists( 'uwf_theme_options_page' ) ) :
function uwf_theme_options_page() {
	global $uwf_options;

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false; // This checks whether the form has just been submitted. ?>

	<div class="wrap">

	<?php echo "<h2>" . get_current_theme() . __( ' Theme Options' ) . "</h2>";
	// This shows the page's name and an icon if one has been provided ?>

	<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
	<div class="updated notice is-dismissible"><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
	<?php endif; // If the form has just been submitted, this shows the notification ?>

	<form method="post" action="options.php">

	<?php $settings = get_option( 'uwf_options', $uwf_options ); ?>
	
	<?php settings_fields( 'uwf_theme_options' );
	/* This function outputs some hidden fields required by the form,
	including a nonce, a unique number used to ensure the form has been submitted from the admin page
	and not somewhere else, very important for security */ ?>

	<table class="form-table"><tbody>

	<tr valign="top"><th scope="row"><label for="logo_url">Logo</label></th>
	<td>
	<div id="logo_url_preview" style="width: 100px; float: left; margin-right: 20px;<?php echo $settings['logo_url'] ? '' : ' display: none;'; ?>">
		<?php if ($settings['logo_url']) : ?><img src="<?php echo esc_url($settings['logo_url']); ?>" style="max-width: 100%;" /><?php endif; ?>
	</div>
	<input type="text" id="logo_url" name="uwf_options[logo_url]" value="<?php echo esc_url($settings['logo_url']); ?>" />
	<div style="margin-bottom: 5px;"><button class="button" id="logo_url_upload_button" style="display: none;"><span class="dashicons dashicons-upload"></span> Upload or choose <?php echo $settings['logo_url'] ? 'another ' : ''; ?>logo</button></div>
	<div><button class="button" id="logo_url_delete_button"<?php echo $settings['logo_url'] ? '' : ' style="display: none;"'; ?>><span class="dashicons dashicons-no"></span> Remove logo</button></div>
	</td>
	</tr>

	<tr valign="top">
		<th scope="row">Display</th>
		<td>
			<p><label for="google_fonts">Google Fonts</label> <input id="google_fonts" name="uwf_options[google_fonts]" type="text" value="<?php  esc_attr_e($settings['google_fonts']); ?>" />
			<span class="dashicons dashicons-editor-help" title="More information available in the help dropdown"></span></p>
			<p></p>
		</td>
	</tr>
	
	<tr valign="top">
		<th scope="row">Main Menu</th>
		<td>
			<p><label for="navigation_title">Navigation Title</label> <input id="navigation_title" name="uwf_options[navigation_title]" type="text" value="<?php  esc_attr_e($settings['navigation_title']); ?>" /></p>
			<p><label for="mobileBreakPoint">Mobile break point (in pixels):</label>
				<input type="text" id="mobileBreakPoint" name="uwf_options[mobileBreakPoint]" value="<?php esc_attr_e($settings['mobileBreakPoint']); ?>" /></p>
			<p><label for="mobileMenuDirection">Mobile menu direction:</label>
				<select id="mobileMenuDirection" name="uwf_options[mobileMenuDirection]">
					<option value="left" <?php selected( $settings['mobileMenuDirection'], 'left' ); ?>>left</option>
					<option value="right" <?php selected( $settings['mobileMenuDirection'], 'right' ); ?>>right</option>
				</select>
			</p>
		</td>
	</tr>

	<tr valign="top"><th scope="row">Forms</th>
		<td>
			<p><input type="checkbox" id="validateForms" name="uwf_options[validateForms]" value="1" <?php checked( true, $settings['validateForms'] ); ?> /> <label for="validateForms">Validate all forms by default</label></p>
		</td>
	</tr>
	
	<tr valign="top">
		<th scope="row">Links</th>
		<td>
			<p><input type="checkbox" id="shortenLinks" name="uwf_options[shortenLinks]" value="1" <?php checked( true, $settings['shortenLinks'] ); ?> /> <label for="shortenLinks">Shorten links to fit within their containers</label></p>
			<p><label for="shortenLinksSelector">jQuery selector for links:</label> <input type="text" id="sectionNavigationSelector" name="uwf_options[shortenLinksSelector]" value="<?php esc_attr_e($settings['shortenLinksSelector']); ?>" /></p>
			<p><input type="checkbox" id="externalLinks" name="uwf_options[externalLinks]" value="1" <?php checked( true, $settings['externalLinks'] ); ?> /> <label for="externalLinks">Open external links in a new window</label></p>
			<p><label for="externalLinksExceptions">jQuery selector for external links that should <strong>not</strong> be opened in a new window:</label> <input type="text" id="externalLinksExceptions" name="uwf_options[externalLinksExceptions]" value="<?php esc_attr_e($settings['externalLinksExceptions']); ?>" /></p>
		</td>
	</tr>
	
	<tr valign="top">
		<th scope="row">Scrolling in-page navigation</th>
		<td>
			<p><label for="sectionNavigationSelector">jQuery selector for anchor links:</label> <input type="text" id="sectionNavigationSelector" name="uwf_options[sectionNavigationSelector]" value="<?php esc_attr_e($settings['sectionNavigationSelector']); ?>" /></p>
			<p><label for="sectionNavigationPadding">Top-of-page padding (in pixels):</label> <input type="text" id="sectionNavigationPadding" name="uwf_options[sectionNavigationPadding]" value="<?php esc_attr_e($settings['sectionNavigationPadding']); ?>" /></p>
		</td>
	</tr>
	
	<tr valign="top">
		<th scope="row">"On This Page" Menu</th>
		<td>
			<p><label for="onThisPageHeading">Headers to use to generate:</label> <select id="onThisPageHeading" name="uwf_options[onThisPageHeading]">
				<option value="h1" <?php selected( $settings['onThisPageHeading'], 'h1' ); ?>>h1</option>
				<option value="h2" <?php selected( $settings['onThisPageHeading'], 'h2' ); ?>>h2</option>
				<option value="h3" <?php selected( $settings['onThisPageHeading'], 'h3' ); ?>>h3</option>
				<option value="h4" <?php selected( $settings['onThisPageHeading'], 'h4' ); ?>>h4</option>
				<option value="h5" <?php selected( $settings['onThisPageHeading'], 'h5' ); ?>>h5</option>
				<option value="h6" <?php selected( $settings['onThisPageHeading'], 'h6' ); ?>>h6</option>
			</select></p>
			<p><label for="onThisPageNav">jQuery selector for element to contain menu:</label> <input type="text" id="onThisPageNav" name="uwf_options[onThisPageNav]" value="<?php esc_attr_e($settings['onThisPageNav']); ?>" /></p>
			<p><label for="onThisPageMinimumSections">Minimum sections that must be present to trigger "on this page" navigation:</label> <input type="text" id="onThisPageMinimumSections" name="uwf_options[onThisPageMinimumSections]" value="<?php esc_attr_e($settings['onThisPageMinimumSections']); ?>" /></p>
	
		</td>
	</tr>
	
	<tr valign="top">
		<th scope="row">Footer</th>
		<td>
			<p><label for="footer_cols">Columns in Footer Widget Area</label> <select id="footer_cols" name="uwf_options[footer_cols]">
				<option value="1" <?php selected( $settings['footer_cols'], 1 ); ?>>1</option>
				<option value="2" <?php selected( $settings['footer_cols'], 2 ); ?>>2</option>
				<option value="3" <?php selected( $settings['footer_cols'], 3 ); ?>>3</option>
				<option value="4" <?php selected( $settings['footer_cols'], 4 ); ?>>4</option>
			</select></p>
			<p><input type="checkbox" id="fixFooter" name="uwf_options[fixFooter]" value="1" <?php checked( true, $settings['fixFooter'] ); ?> /> <label for="fixFooter">Fix footer to the bottom of the window if content is less than full height</label></p>
		</td>
	</tr>
	
	<tr valign="top">
		<th><label for="custom_css">Custom CSS</label></th>
		<td><textarea id="custom_css" name="uwf_options[custom_css]"><?php esc_attr_e($settings['custom_css']); ?></textarea></td>
	</tr>

	<tr valign="top">
		<th scope="row"><label for="custom_js">Custom Javascript</label></th>
		<td><textarea id="custom_js" name="uwf_options[custom_js]"><?php esc_attr_e($settings['custom_js']); ?></textarea></td>
	</tr>

	<tr valign="top"><th scope="row">Editor Permissions</th>
	<td>
	<input type="checkbox" id="editor_perms" name="uwf_options[editor_perms]" value="1" <?php checked( true, $settings['editor_perms'] ); ?> />
	<label for="editor_perms">Give users with Editor role access to theme options (widgets, menus, etc.)</label>
	</td>
	</tr>

	</table>

	<p class="submit"><input type="submit" id="options-form-submit" class="button-primary" value="Save Options" /></p>

	</form>

	</div>

	<?php
}
endif;

if ( ! function_exists( 'uwf_theme_options_help' ) ) :
function uwf_theme_options_help() {
	$screen = get_current_screen();

	$screen->add_help_tab( array(
		'id'       => 'uwf-theme-google-fonts',
		'title'    => __( 'Google Fonts' ),
		'content'  => '
<p>Whatever text is entered for this option will be appended to <strong>https://fonts.googleapis.com/css?family=</strong> in a <link> element in the head &mdash; so if, for example, Google gives you this code to add to your website:</p>
<code>&lt;link href=\'https://fonts.googleapis.com/css?family=Roboto:400,500italic\' rel=\'stylesheet\' type=\'text/css\'&gt;</code>
<p>enter <strong>Roboto:400,500italic</strong> as the Google Fonts option.</p>
		',
	));

}
endif;

if ( ! function_exists( 'uwf_validate_options' ) ) :
function uwf_validate_options( $input ) {
	global $uwf_options;

	$settings = get_option( 'uwf_options', $uwf_options );

	$input['logo_url'] = esc_url( $input['logo_url'] );
	
	// We strip all tags from text fields, to avoid vulnerablilties like XSS
	$input['google_fonts'] = wp_filter_nohtml_kses( $input['google_fonts'] );
	$input['navigation_title'] = wp_filter_nohtml_kses( $input['navigation_title'] );
	$input['shortenLinksSelector'] = wp_filter_nohtml_kses( $input['shortenLinksSelector'] );
	$input['externalLinksExceptions'] = wp_filter_nohtml_kses( $input['externalLinksExceptions'] );
	$input['sectionNavigationSelector'] = wp_filter_nohtml_kses( $input['sectionNavigationSelector'] );
	$input['onThisPageNav'] = wp_filter_nohtml_kses( $input['onThisPageNav'] );
	
	// validate checkboxes
	$checkboxes = array( 'editor_perms', 'validateForms', 'fixFooter', 'shortenLinks', 'externalLinks' );
	foreach ($checkboxes as $checkbox) {
		if ( ! isset( $input[$checkbox] ) )
			$input[$checkbox] = null;
		// We verify if the input is a boolean value
		$input[$checkbox] = ( $input[$checkbox] == 1 ? 1 : 0 );
	}
	
	// validate integer inputs
	$integers = array( 'sectionNavigationPadding', 'mobileBreakPoint', 'onThisPageMinimumSections' );
	foreach ($integers as $integer) {
		$input[$integer] = intval($input[$integer]);
	}
	
	return $input;
}
endif;

if ( ! function_exists( 'uwf_add_editor_perms' ) ) :
function uwf_add_editor_perms() {
	global $uwf_options;
	$role = get_role( 'editor' );
	if ($uwf_options['editor_perms']) {
		$role->add_cap( 'edit_theme_options' );
	} else {
		$role->remove_cap( 'edit_theme_options' );
	}
}
endif;
add_action( 'admin_init', 'uwf_add_editor_perms' );

endif;  // EndIf is_admin()
