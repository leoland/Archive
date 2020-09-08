<?php
/**
 * Helio Blueprint functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ch2
 */

if (!function_exists('ch2_setup')):
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function ch2_sandbox_setup()
{
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Helio Blueprint, use a find and replace
         * to change 'ch2' to the name of your theme in all the template files.
         */
        load_theme_textdomain('ch2', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * add custom largest image size to prevent giant images form being used in their original 'full' size in template parts
         */
        add_action('init', function () {
            remove_post_type_support('image', 'editor');
            remove_post_type_support('page', 'editor');
        }, 99);

        add_theme_support('post-thumbnails');

        add_action('after_setup_theme', 'helio_custom_add_image_sizes');
        function helio_custom_add_image_sizes()
    {
            add_image_size('largest', 1600, 9999);
            add_image_size('large', 1100, 9999);
            add_image_size('medium', 700, 9999);

        }

        add_filter('image_size_names_choose', 'aw_custom_add_image_size_names');
        function aw_custom_add_image_size_names($sizes)
    {
            return array_merge($sizes, array(
                'small' => __('Small'),
                'medium-small' => __('Medium Small'),
                'xl' => __('Extra Large'),
                'xxl' => __('2x Extra Large'),
            ));
        }

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */

        // Register nav menus
        register_nav_menus(array(
            'menu-1' => esc_html__('Main menu', 'ch2'),
        ));
        register_nav_menus(array(
            'menu-2' => esc_html__('Top Menu', 'ch2'),
        ));


        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');
    }
endif;
add_action('after_setup_theme', 'ch2_sandbox_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Important as it determines width of oembeds and responsiveness of images.
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ch2_content_width()
{
    $GLOBALS['content_width'] = apply_filters('ch2_content_width', 1000);
}

add_action('after_setup_theme', 'ch2_content_width', 0);

/**
 * Register widget area..
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ch2_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'ch2'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'ch2'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

function devTime()
{
    $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if (preg_match("/(.test|.local|localhost')/", $actual_link)):
        return true;
    elseif (current_user_can('administrator')):
        return true;

    else:
        return false;
    endif;
}

add_action('widgets_init', 'ch2_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function ch2_scripts()
{

    wp_enqueue_style('ch2-style', get_stylesheet_uri());

    $cache_bust = filemtime(get_stylesheet_directory() . '/assets/sass/style.css');
    if (devTime()):
        $cache_bust = filemtime(get_stylesheet_directory() . '/assets/sass/style.css');
        wp_enqueue_style('ch2-theme-style', get_template_directory_uri() . '/assets/sass/style.css', array(), $cache_bust);

    else:
        wp_enqueue_style('ch2-theme-style', get_template_directory_uri() . '/assets/sass/style.css', array(), '20190916.001');
        //    wp_enqueue_style( 'ch2-theme-style', get_template_directory_uri() . '/assets/sass/style.css', array(), $cache_bust );
    endif;



    //wp_enqueue_style( 'featherlight-css', get_template_directory_uri() . '/assets/css/featherlight.css' );

    //wp_enqueue_style( 'featherlight-gallery-css', get_template_directory_uri() . '/assets/css/featherlight.gallery.css' );

    //wp_enqueue_script( 'ch2-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20170303', true );

    //wp_enqueue_script( 'ch2-fancy', get_template_directory_uri() . '/assets/js/min/ch2-fancy.min.js', array( 'jquery' ), '1', false );

    //wp_enqueue_script( 'ch2-fancy', get_template_directory_uri() . '/assets/js/min/ch2-fancy.min.js', array( 'jquery' ), '1', false );

    //wp_enqueue_script( 'ch2-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20170303', true );

    wp_enqueue_script('footer-scripts', get_template_directory_uri() . '/assets/js/footer-min.js', array('jquery'), $cache_bust, true);

    //wp_enqueue_script( 'ch2-addthis', '//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5a6509ecf9b20d4d', array(), '20170303', true );

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    if (devTime()):
        wp_enqueue_script('debug-grid', get_template_directory_uri() . '/assets/js/ch2-debug.js', array('jquery'), '', true);

        //wp_enqueue_script( 'debug-grid', get_template_directory_uri() . '/assets/js/ch2-debug-min.js', array( '' ), '',true );

    endif;
}

add_action('wp_enqueue_scripts', 'ch2_scripts');

//add_filter( 'script_loader_tag', 'add_defer_attribute', 10, 2 );

/**
 * Filter the HTML script tag of `font-awesome` script to add `defer` attribute.
 *
 * @param string $tag The <script> tag for the enqueued script.
 * @param string $handle The script's registered handle.
 *
 * @return   Filtered HTML script tag.
 */
function add_defer_attribute($tag, $handle)
{
    if ('font-awesome' === $handle) {
        $tag = str_replace(' src', ' defer src', $tag);
    }

    return $tag;

}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
//require get_template_directory() . '/inc/customizer.php';

// Move Yoast to bottom of post/page editor
//need to test if this requires a conditional (though we always use yoast safety is nice to have)
function yoasttobottom()
{
    return 'low';
}

add_filter('wpseo_metabox_prio', 'yoasttobottom');

//adds an options page to house header and footer options.
if (function_exists('acf_add_options_page')) {

    acf_add_options_page('Global Options');
}

/**
 * Body Class stuff
 */

function add_slug_body_class($classes)
{
    global $post;
    if (isset($post)) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    }

    return $classes;
}

add_filter('body_class', 'add_slug_body_class');

//adds a contents of the bodyclass field to the list of body classes

function acf_body_class($classes)
{

    if ($bodyclass = get_field('body_class', get_queried_object_id())) {

        $bodyclass = esc_attr(trim($bodyclass));

        $classes[] = $bodyclass;
    }

    return $classes;
}

/**
 * Add an options page to each Custom Post type. This page appears within the custom post type menu in the admin allowing the user to  find it more naturally
 *
 * taken from Tusko Trush's plugin to perform the same function see https://github.com/Tusko/ACF-CPT-Options-Pages#usage for usage.
 *
 *
 * The default functions of ACF plugin (get_field, the_field, etc.) can be used to load values from a CPT Options Pages, but second parameter is required to target the CPT options.
 *
 * This is similar to passing through a $post_id parameter to target a specific post object.
 *
 * The $post_id parameter needed is a string containing the cpt_ and CPT name in the following format: "cpt_{CPT_NAME}"
 */

function ctpacf_admin_error_notice()
{
    echo '<div class="update-nag"><p>' . __('Please make sure ACF is installed and activated', 'cpt-acf') . '</p></div>';
}

function ctpacf_options_pages()
{
    if (function_exists('acf_add_options_page')) { //Check if installed acf
        $ctpacf_post_types = get_post_types(array(
            '_builtin' => false,
            'has_archive' => true,
        )); //get post types
        foreach ($ctpacf_post_types as $cpt) {
            if (post_type_exists($cpt)) {
                $cptname = get_post_type_object($cpt)->labels->name;
                $cpt_post_id = 'cpt_' . $cpt;
                if (defined('ICL_LANGUAGE_CODE')) {
                    $cpt_post_id = $cpt_post_id . '_' . ICL_LANGUAGE_CODE;
                }
                $cpt_acf_page = array(
                    'page_title' => sprintf(__('%s Page', 'cpt-acf'), ucfirst($cptname)),
                    'menu_title' => sprintf(__('%s Page', 'cpt-acf'), ucfirst($cptname)),
                    'parent_slug' => 'edit.php?post_type=' . $cpt,
                    'menu_slug' => $cpt . '-Page',
                    'capability' => 'edit_posts',
                    'post_id' => $cpt_post_id,
                    'position' => false,
                    'icon_url' => false,
                    'redirect' => false,
                );
                acf_add_options_page($cpt_acf_page);
            } // end if
        }
    } else { //activation warning
        add_action('admin_notices', 'ctpacf_admin_error_notice');
    }
}

add_action('init', 'ctpacf_options_pages', 99);
/*
Hide The gallery short code from the editor, they are ugly and we probably want a better solution anyway.

uncomment the add action to use
 */

// add_action( 'admin_head_media_upload_gallery_form', 'ch2_remove_gallery_setting_div' );
if (!function_exists('ch2_remove_gallery_setting_div')) {
    function ch2_remove_gallery_setting_div()
    {
        print '
 <style type="text/css">
 #gallery-settings *{
 display:none;
 }
 </style>';
    }
}

/*
Remove adminbar links

 */

add_action('wp_before_admin_bar_render', 'ch2_remove_admin_bar_links');
function ch2_remove_admin_bar_links()
{
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('w3tc-faq');
    $wp_admin_bar->remove_menu('w3tc-support');
}

/**
 * NOTE:  Hide WordPress News
 *
 */

add_action('admin_init', 'ch2_disable_dashboard_widgets');
function ch2_disable_dashboard_widgets()
{
    remove_meta_box('dashboard_primary', 'dashboard', 'normal');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'normal');
}

/*
Disable file editor in the editor online
 */

if (!defined('DISALLOW_FILE_EDIT')) {
    define('DISALLOW_FILE_EDIT', true);
}

/*
Get a custom menu order going, reorganize closer to live and uncomment the  proper appropiate lines
 */

function custom_menu_order($menu_ord)
{
    if (!$menu_ord) {
        return true;
    }

    return array(
        //come back to this near end to get all menus in order

        'wpengine-common', // WPENGINE
        'index.php', // Dashboard
        'edit.php?post_type=page', // Pages
        'edit.php', // Posts
        'edit.php?post_type=tribe_events', // Events
        'edit.php?post_type=team_member', // Team

        'separator1', // First separator
        'gf_edit_forms', // Gravity Forms
        'wpengine-common', // WPENGINE
        'acf-options-global-options', // Global Options
        //    'admin.php?page=specific page',

        'upload.php', // Media

        'separator2', // First separator
        'separator3', // First separator
        'plugins.php', // Plugins
        'users.php', // Users
        'tools.php', // Tools
        'options-general.php', // Settings
    );
}

//add_filter('custom_menu_order', 'custom_menu_order'); // Activate custom_menu_order
//add_filter('menu_order', 'custom_menu_order');

function ch2_remove_posts_menu_item()
{

    /* remove the sub menu item */
    /* this removes blog stuff */
    remove_menu_page(
        'edit.php' // parent slug
    );
}

//add_action( 'admin_menu', 'ch2_remove_posts_menu_item' );

/*
 * Disable all comment functionality
 */

// Disable support for comments and trackbacks in post types
function df_disable_comments_post_types_support()
{
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}

// Close comments on the front-end
function df_disable_comments_status()
{
    return false;
}

// Hide existing comments
function df_disable_comments_hide_existing_comments($comments)
{
    $comments = array();

    return $comments;
}

// Remove comments page in menu
function df_disable_comments_admin_menu()
{
    remove_menu_page('edit-comments.php');
}

// Redirect any user trying to access comments page
function df_disable_comments_admin_menu_redirect()
{
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url());
        exit;
    }
}

// Remove comments metabox from dashboard
function df_disable_comments_dashboard()
{
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}

// Remove comments links from admin bar
function df_disable_comments_admin_bar()
{
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
}

/* All these guys turn post coments on and off (globally and HARD)
 */

add_action('init', 'df_disable_comments_admin_bar');
add_action('admin_menu', 'df_disable_comments_admin_menu');
add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);
add_action('admin_init', 'df_disable_comments_post_types_support');
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);
add_action('admin_init', 'df_disable_comments_admin_menu_redirect');
add_action('admin_init', 'df_disable_comments_dashboard');

//login logo to use client logo instead of Wordpress. Looks for logo.png in assets folder.
function ch2_custom_login_logo()
{
    $site_logo = get_field('site_logo', 'option');
    if ($site_logo) {

        echo '<style type="text/css">
                .login.login h1 a {background-size: contain;
                    width: 200px; height: 150px ; background-position: center center; background-image:url(' . $site_logo["url"] . '</style>';
    }
}

add_action('login_head', 'ch2_custom_login_logo');

//said logo no longer sends to wordpress.com
function ch2_login_logo_url()
{
    return get_bloginfo('url');
}

add_filter('login_headerurl', 'ch2_login_logo_url');

function ch2_login_logo_url_title()
{
    return get_bloginfo('name');
}

add_filter('login_headertitle', 'ch2_login_logo_url_title');

/**
 * Registers an editor stylesheet for the theme.
 */
function ch_add_editor_styles()
{
    add_editor_style('assets/sass/admin-style.css');
}
add_action('admin_init', 'ch_add_editor_styles');

//add a bit of css to the actual admin
add_action('admin_head', 'leo_custom_admin_style');

function leo_custom_admin_style()
{
    echo '<style>
  .mce-toolbar .mce-btn.mce-orange-hr .mce-ico {
	color: orange;
  }
  </style>';
}

/*
 * attempt to fix the events calendar ACF conflict
 * */

if (function_exists('acf_get_dir')) {

    function wpdocs_dequeue_script()
    {
        wp_dequeue_script('tribe-select2');
        wp_deregister_script('tribe-select2');
    }
    //add_action( 'wp_print_scripts', 'wpdocs_dequeue_script', 99999999 );

}

/*
 * Fixes tab index issues with multiple gforms ina  single page.
 *
 */

add_filter('gform_tabindex', '__return_false');

/**
 * Disable Emoji Support
 */
function disable_emojis_tinymce($plugins)
{
    if (is_array($plugins)) {
        return array_diff($plugins, array('wpemoji'));
    } else {
        return array();
    }
}

function disable_emojis()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
}

add_action('init', 'disable_emojis');

// Callback function to insert 'styleselect' into the $buttons array
function ch2_mce_buttons_2($buttons)
{
    array_unshift($buttons, 'styleselect');

    return $buttons;
}

// Register our callback to the appropriate filter
add_filter('mce_buttons_2', 'ch2_mce_buttons_2');

// Callback function to filter the MCE settings
function ch2_mce_before_init_insert_formats($init_array)
{
    // Define the style_formats array
    $style_formats = array(
        // Each array child is a format with it's own settings
        array(
            'title' => 'Primary Button',
            'selector' => 'a',
            'classes' => 'btn-primary',
            'wrapper' => false,
        ),
        array(
            'title' => 'Alternative Button',
            'selector' => 'a',
            'classes' => 'btn-alt',
            'wrapper' => false,
        ),
        array(
            'title' => 'Tertiary Button',
            'selector' => 'a',
            'classes' => 'btn-tert',
            'wrapper' => false,
        ),

		array(
            'title' => 'Purple Copy',
            'selector' => 'span, p, h1, h2, h3, h4, h5, strong, span, em',
            'classes' => 'purple',
            'wrapper' => false,
		),
		array(
            'title' => 'teal Copy',
            'selector' => 'span, p, h1, h2, h3, h4, h5, strong, span, em',
            'classes' => 'teal',
            'wrapper' => false,
		),
		array(
            'title' => 'Teal Underlined Heading',
            'selector' => 'h1, h2, h3, h4, h5',
            'classes' => 'teal-ul',
            'wrapper' => false,
		),


    );
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode($style_formats);

    return $init_array;
}

// Attach callback to 'tiny_mce_before_init'
add_filter('tiny_mce_before_init', 'ch2_mce_before_init_insert_formats');

// Customize excerpts
function ch2_excerpt_more($more)
{
	if ('speaker' == get_post_type()  ) {
    global $post;

	return '<p><a class="moretag" href="' . get_permalink($post->ID) . '">read more</a></p>';
	}
}

add_filter('excerpt_more', 'ch2_excerpt_more');

if (!devTime()) {
    add_filter('acf/settings/show_admin', '__return_false');
}

//add labels to blocks

function my_acf_flexible_content_layout_title($title, $field, $layout, $i)
{

    // load text sub field
    if (($text = get_sub_field('block_label')) || ($text = get_sub_field('heading'))) {

        $title .= " - " . "<strong>" . $text . "</strong>";

    }

    // return
    return stripslashes($title);
}

// name
//    add_filter( 'acf/fields/flexible_content/layout_title', 'my_acf_flexible_content_layout_title', 10, 4 );

//get yoast primary

function get_primary_category($post = 0)
{
    if (!$post) {
        $post = get_the_ID();
    }
    // SHOW YOAST PRIMARY CATEGORY, OR FIRST CATEGORY
    $category = get_the_category($post);
    $primary_category = array();
    // If post has a category assigned.
    if ($category) {
        $category_display = '';
        $category_slug = '';
        $category_link = '';
        $category_id = '';

        if (class_exists('WPSEO_Primary_Term')) {
            // Show the post's 'Primary' category, if this Yoast feature is available, & one is set
            $wpseo_primary_term = new WPSEO_Primary_Term('category', get_the_id($post));
            $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
            $term = get_term($wpseo_primary_term);
            if (is_wp_error($term)) {
                // Default to first category (not Yoast) if an error is returned
                $category_display = $category[0]->name;
                $category_slug = $category[0]->slug;
                $category_link = get_category_link($category[0]->term_id);
                $category_id = $category[0]->term_id;

            } else {
                // Yoast Primary category
                $category_display = $term->name;
                $category_slug = $term->slug;
                $category_link = get_category_link($term->term_id);
                $category_id = $term->term_id;
            }
        } else {
            // Default, display the first category in WP's list of assigned categories
            $category_display = $category[0]->name;
            $category_slug = $category[0]->slug;
            $category_link = get_category_link($category[0]->term_id);
            $category_id = $term->term_id;
        }
        $primary_category['url'] = $category_link;
        $primary_category['slug'] = $category_slug;
        $primary_category['title'] = $category_display;
        $primary_category['id'] = $category_id;

    }
    return $primary_category;
}

//fancy menu stuffs

add_action('admin_head', 'admin_css');

function admin_css()
{
    echo '<style>
   .menu-item:not(.menu-item-depth-0)  [data-name="menu_image"]{
        display:none!important;
	}
   .menu-item:not(.menu-item-depth-0)  [data-name="fat_menu"]{
        display:none!important;
	}

.menu-item:not(.menu-item-depth-1)  [data-name="icon"]{
        display:none!important;
	}
.acf-menu-item-fields {
		width: 100%;
	}
  </style>';
}
/*
add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

function my_wp_nav_menu_objects($items, $args)
{

// loop
foreach ($items as $item) {

// vars

$preview = get_field('menu_image', $item);
if ($preview) {
$preview_image = get_field('preview_image', $item);
$link = get_field('link', $item);
$subtitle = get_field('subtitle', $item);

}

$icon = get_field('icon', $item);
// append icon
if ($icon) {

$item->title .= ' <i style="background-image: url(' . $icon["url"] . ')" class="menu-item-icon"></i>';
$item->classes[] = ' has-icon';
}

}

// return
return $items;

}
 */

class CC_menu_walker extends Walker_Nav_Menu
{

    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        global $wp_query;
        $class_names = $value = '';
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $preview = get_field('menu_image', $item);
        $fat_menu = get_field('fat_menu', $item);

        if ($preview) {
            $preview_image = get_field('preview_image', $item);
            $link = get_field('link', $item);
            $subtitle = get_field('subtitle', $item);
            $preview_class = " has-preview";

        }
        if ($fat_menu) {

            $fat_class = " fat-menu";

        }

        $icon = get_field('icon', $item);
        if ($icon) {
            $icon_class = ' has-icon';
        }

        $class_names = ' class="' . esc_attr($class_names) . $preview_class . $icon_class . $fat_class . '"';

        $output .= '<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        $description = !empty($item->description) ? '<span>' . esc_attr($item->description) . '</span>' : '';
        $item_output = $args->before;

        if ($icon) {
            $icon_code = '<i style="background-image: url(' . $icon["url"] . ')" class="menu-item-icon"></i>';
        }

        $item_output .= '<a' . $attributes . '>' . $icon_code . '<span class="menu_item_title ' . $link_color . '">';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID);

        $item_output .= $description . $args->link_after;

        $link_description = get_field('link_description', $item);
        if ($link_description) {
            $item_output .= ' <div class="link-description">' . $link_description . '</div>';
        }

        $item_output .= '</span></a>';

        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        if ($preview) {

            // $output .= "\n$indent<div class='sub-menu-wrap'>\n";
            //  $item_output .= "\n$indent<div class='sub-menu-wrap'>\n";

            $url = $preview_image['url'];
            $link_url = $link['url'];
            $link_target = $link['target'];
            $link_title = $link['title'];
            $link_subtitle = get_field('subtitle', $item);

            $the_mm_preview = '<div class="mm-preview"><a href="' . $link_url . '" target="' . $link_target . '"><img src="' . $url . '">
            <p class="link-title"> ' . $link_title . '
            </p>
            <p class="link-subtitle">' . $link_subtitle . '
            </p>
            </a>
            </div>';

            $output .= "\n$indent$the_mm_preview\n";

        }

    }

    public function start_lvl(&$output, $depth = 0, $arg = array())
    {
        $indent = str_repeat("\t", $depth);
        $level = $depth + 1;

        $output .= "\n$indent\n" . '<ul class="sub-menu level-' . $level . ' ">';
        if ($level == 2) {
            $output .= '<li class="back-link menu-item menu-item-type-custom menu-item-object-custom"><a><span class="menu_item_title ">Back</span></a></li>';
        }

    }
    public function end_lvl(&$output, $depth = 0, $arg = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent\n" . '</ul>'
        ;
    }

}

/*
 * Internal Redirects
 */

function carecontent_custom_urls($url, $post)
{
    // Create an array of post types to skip.
    $skip_post_types = array(
        'attachment',
    );

    // page_link gives the ID rather than the $post object.
    if ('integer' === gettype($post)) {
        $post_id = $post;
    } else {
        $post_id = $post->ID;
    }

    // Check if the current post type should be skipped.
    if (in_array(get_post_type($post_id), $skip_post_types, true)) {
        return $url;
    }

    // Get the custom_link if one exists.
    $custom_url = get_field('custom_url', $post_id);

    if ($custom_url) {
        //$url = $custom_url['url'];
        $url = $custom_url;
    }

    return $url;
}

/**
 * Add filters for post_link, page_link, and post_type_link to update Custom Link
 */
foreach (['post', 'page', 'post_type'] as $post_type) {
    add_filter($post_type . '_link', 'carecontent_custom_urls', 10, 2);
}


/**
 * Gravity Wiz // Gravity Forms // Set Number of List Field Rows by Field Value
 *
 * Add/remove list field rows automatically based on the value entered in the specified field. Removes the add/remove
 * that normally buttons next to List field rows.
 *
 * @version	  1.0
 * @author    David Smith <david@gravitywiz.com>
 * @license   GPL-2.0+
 * @link      http://gravitywiz.com/2012/06/03/set-number-of-list-field-rows-by-field-value/
 */

 /*
class GWAutoListFieldRows {
	private static $_is_script_output;
	function __construct( $args ) {
		$this->_args = wp_parse_args( $args, array(
			'form_id'       => false,
			'input_html_id' => false,
			'list_field_id' => false
		) );
		extract( $this->_args ); // gives us $form_id, $input_html_id, and $list_field_id
		if( ! $form_id || ! $input_html_id || ! $list_field_id )
			return;
		add_filter( 'gform_pre_render_' . $form_id, array( $this, 'pre_render' ) );
	}
	function pre_render( $form ) {
		?>
<style type="text/css">
#field_<?php echo $form['id'];
?>_<?php echo $this->_args['list_field_id'] . " ";

?>.gfield_list_icons {
	display: none;
}
</style>
<?php
		add_filter( 'gform_register_init_scripts', array( $this, 'register_init_script' ) );
		if( ! self::$_is_script_output )
			$this->output_script();
		return $form;
	}
	function register_init_script( $form ) {
		// remove this function from the filter otherwise it will be called for every other form on the page
		remove_filter( 'gform_register_init_scripts', array( $this, 'register_init_script' ) );
		$args = array(
			'formId'      => $this->_args['form_id'],
			'listFieldId' => $this->_args['list_field_id'],
			'inputHtmlId' => $this->_args['input_html_id']
		);
		$script = "new gwalfr(" . json_encode( $args ) . ");";
		$key = implode( '_', $args );
		GFFormDisplay::add_init_script( $form['id'], 'gwalfr_' . $key , GFFormDisplay::ON_PAGE_RENDER, $script );
	}
	function output_script() {
		?>
<script type="text/javascript">
window.gwalfr;
(function($) {
	gwalfr = function(args) {
		this.formId = args.formId,
			this.listFieldId = args.listFieldId,
			this.inputHtmlId = args.inputHtmlId;
		this.init = function() {
			var gwalfr = this,
				triggerInput = $(this.inputHtmlId);
			// update rows on page load
			this.updateListItems(triggerInput, this.listFieldId, this.formId);
			// update rows when field value changes
			triggerInput.change(function() {
				gwalfr.updateListItems($(this), gwalfr.listFieldId, gwalfr.formId);
			});
		}
		this.updateListItems = function(elem, listFieldId, formId) {
			var listField = $('#field_' + formId + '_' + listFieldId),
				count = parseInt(elem.val());
			rowCount = listField.find('table.gfield_list tbody tr').length,
				diff = count - rowCount;
			if (diff > 0) {
				for (var i = 0; i < diff; i++) {
					listField.find('.add_list_item:last').click();
				}
			} else {
				// make sure we never delete all rows
				if (rowCount + diff == 0)
					diff++;
				for (var i = diff; i < 0; i++) {
					listField.find('.delete_list_item:last').click();
				}
			}
		}
		this.init();
	}
})(jQuery);
</script>
<?php
	}
}
new GWAutoListFieldRows( array(
	'form_id' => 6,
	'list_field_id' => 15,
	'input_html_id' => '#input_6_17'
) );

*/








remove_filter( 'single_template', 'wpcs_set_single_session_template' );

function test_session_filter($string) {

   return $string;
}
add_filter( 'wpcs_session_content_footer','test_session_filter', 10, 3 );


/**
*
* stuff related to the archive pages for each event year
*
*/

/**
 * Hide the term description in the post_tag edit form
 */
function remove_description_form() {
    echo "<style> .term-description-wrap { display:none; } </style>";
}

add_action( "event_edit_form", 'remove_description_form');
add_action( "event_add_form", 'remove_description_form');

/**
 * Remove the 'description' column from the table in 'edit-tags.php'
 * but only for the 'post_tag' taxonomy
 */
add_filter('manage_edit-event_columns', function ( $columns )
{
    if( isset( $columns['description'] ) )
        unset( $columns['description'] );

    return $columns;
} );


///modify   the order of the speakers

add_filter( 'pre_get_posts', 'custom_get_posts' );

function custom_get_posts( $query ) {


if( ($query->is_main_query()) && (is_tax('event'))  ) {

	$meta_query = array(
		'relation' => 'AND',
		'featured' => array(
			'key' => 'featured',
						'compare' => 'EXISTS',
		),
		'last_name' => array(
			'key' => 'last_name',
			'compare' => 'EXISTS',
		),

	);
	$order_by =  array(
		'featured' => 'DESC',
		'last_name' => 'ASC',

	);
	$query->set( 'meta_query', $meta_query );
	$query->set( 'orderby', $order_by );
	$query->set( 'posts_per_page', '-1' );

/*
$query->query_vars['orderby'] = 'ID';
$query->query_vars['order'] = 'ASC';
*/
}

return $query;
}


