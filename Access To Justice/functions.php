<?php
/**
 * Functions
 *
 * @package      EAStarter
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

/*
BEFORE MODIFYING THIS THEME:
Please read the instructions here (private repo): https://github.com/billerickson/EA-Starter/wiki
Devs, contact me if you need access
*/

define( 'EA_STARTER_VERSION', filemtime( get_template_directory() . '/assets/css/main.css' ) );

// General cleanup
include_once( get_template_directory() . '/inc/wordpress-cleanup.php' );

// Theme
include_once( get_template_directory() . '/inc/tha-theme-hooks.php' );
include_once( get_template_directory() . '/inc/layouts.php' );
include_once( get_template_directory() . '/inc/helper-functions.php' );
include_once( get_template_directory() . '/inc/navigation.php' );
include_once( get_template_directory() . '/inc/loop.php' );
include_once( get_template_directory() . '/inc/template-tags.php' );
include_once( get_template_directory() . '/inc/site-footer.php' );

// Editor
include_once( get_template_directory() . '/inc/disable-editor.php' );
include_once( get_template_directory() . '/inc/tinymce.php' );

// Functionality
include_once( get_template_directory() . '/inc/login-logo.php' );
include_once( get_template_directory() . '/inc/block-area.php' );
include_once( get_template_directory() . '/inc/social-links.php' );

// Plugin Support
include_once( get_template_directory() . '/inc/acf.php' );
include_once( get_template_directory() . '/inc/amp.php' );
include_once( get_template_directory() . '/inc/shared-counts.php' );
include_once( get_template_directory() . '/inc/wpforms.php' );

/**
 * Enqueue scripts and styles.
 */
function ea_scripts() {

	if( ! ea_is_amp() ) {
		wp_enqueue_script( 'ea-global', get_template_directory_uri() . '/assets/js/global-min.js', array( 'jquery' ), filemtime( get_template_directory() . '/assets/js/global-min.js' ), true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Move jQuery to footer
		if( ! is_admin() ) {
			wp_deregister_script( 'jquery' );
			wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, NULL, true );
			wp_enqueue_script( 'jquery' );
		}

	}

	wp_register_style( 'ea-fonts', ea_theme_fonts_url() );
	wp_register_style( 'ea-fonts', ea_theme_fonts_url() );
	wp_register_style( 'ea-critical', get_template_directory_uri() . '/assets/css/critical.css', array(), filemtime( get_template_directory() . '/assets/css/critical.css' ) );
	wp_register_style( 'ea-style', get_template_directory_uri() . '/assets/css/main.css', array(), filemtime( get_template_directory() . '/assets/css/main.css' ) );

	if( $using_critical_css = true ) {
		wp_enqueue_style( 'ea-critical' );
		wp_dequeue_style( 'wp-block-library' );
		add_action( 'wp_footer', 'ea_enqueue_noncritical_css', 1 );
	} else {
		ea_enqueue_noncritical_css();
	}

}
add_action( 'wp_enqueue_scripts', 'ea_scripts' );

/**
 * Enqueue Non-Critical CSS
 *
 */
function ea_enqueue_noncritical_css() {
	wp_enqueue_style( 'wp-block-library' );
	wp_enqueue_style( 'ea-critical' );
	wp_enqueue_style( 'ea-style' );
	wp_enqueue_style( 'ea-fonts' );
}

/**
 * Gutenberg scripts and styles
 *
 */
function ea_gutenberg_scripts() {
	wp_enqueue_style( 'ea-fonts', ea_theme_fonts_url() );
	wp_enqueue_script( 'ea-editor', get_template_directory_uri() . '/assets/js/editor.js', array( 'wp-blocks', 'wp-dom' ), filemtime( get_template_directory() . '/assets/js/editor.js' ), true );
}
add_action( 'enqueue_block_editor_assets', 'ea_gutenberg_scripts' );

/**
 * Theme Fonts URL
 *
 */
function ea_theme_fonts_url() {
	return false;
}

if ( ! function_exists( 'ea_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ea_setup() {
	/*
	 * Make theme available for translation.
	 */
	load_theme_textdomain( 'ea-starter', get_template_directory() . '/languages' );

	// Editor Styles
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor-style.css' );

	// Admin Bar Styling
	add_theme_support( 'admin-bar', array( 'callback' => '__return_false' ) );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Body open hook
	add_theme_support( 'body-open' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 */
	 $GLOBALS['content_width'] = apply_filters( 'ea_content_width', 768 );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Navigation Menu', 'ea-starter' ),
		'secondary' => esc_html__( 'Secondary Navigation Menu', 'ea-starter' ),
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

	// Gutenberg

	// -- Responsive embeds
	add_theme_support( 'responsive-embeds' );

	// -- Wide Images
	add_theme_support( 'align-wide' );

	// -- Disable custom font sizes
	add_theme_support( 'disable-custom-font-sizes' );

	// -- Editor Font Styles
	add_theme_support( 'editor-font-sizes', array(
		array(
			'name'      => __( 'Small', 'ea-starter' ),
			'shortName' => __( 'S', 'ea-starter' ),
			'size'      => 14,
			'slug'      => 'small'
		),
		array(
			'name'      => __( 'Normal', 'ea-starter' ),
			'shortName' => __( 'M', 'ea-starter' ),
			'size'      => 20,
			'slug'      => 'normal'
		),
		array(
			'name'      => __( 'Large', 'ea-starter' ),
			'shortName' => __( 'L', 'ea-starter' ),
			'size'      => 24,
			'slug'      => 'large'
		),
	) );

	// -- Disable Custom Colors
	add_theme_support( 'disable-custom-colors' );

	// -- Editor Color Palette
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => __( 'Black', 'ea_starter' ),
			'slug'  => 'black',
			'color' => '#212121',
		),
		array(
			'name'  => __( 'Grey', 'ea_starter' ),
			'slug'  => 'grey',
			'color' => '#f2f2f2',
		),
		array(
			'name'  => __( 'White', 'ea_starter' ),
			'slug'  => 'white',
			'color' => '#fff',
		),
		array(
			'name'  => __( 'Blue', 'ea_starter' ),
			'slug'  => 'blue',
			'color' => '#39c0e0',
		),
		array(
			'name'  => __( 'Red', 'ea_starter' ),
			'slug'  => 'red',
			'color' => '#c20f2f',
		),
	) );

}
endif;
add_action( 'after_setup_theme', 'ea_setup' );

/**
 * Template Hierarchy
 *
 */
function ea_template_hierarchy( $template ) {

	if( is_home() || is_search() )
		$template = get_query_template( 'archive' );
	return $template;
}
add_filter( 'template_include', 'ea_template_hierarchy' );



//set up dev time 
function devTime()
{
    $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	if (preg_match("/(.test|.local|localhost')/", $actual_link)):
		
		return true;
		
   // elseif (current_user_can('administrator')):
     //   return true;

    else:
        return false;
    endif;
}


//Checks if this is the first instance of a hero

function leo_first_hero($this_block_name , $this_block_id) {

	global $post;
	$blocks = parse_blocks( $post->post_content );

	$first = leo_first_hero_checker($blocks, $this_block_name, $this_block_id);

	if ($first){
		return true;
	}
	else {
		return false;
	}
	
}
function leo_first_hero_checker( $blocks = array(), $this_block_name, $this_block_id ) {
	
	foreach ( $blocks as $block ) {
		 
		if( ! isset( $block['blockName'] ) )
			continue;
			
		// Custom header block
		if( $this_block_name === $block['blockName'] ) {
			if($this_block_id === $block['attrs']['id']){
				return true;
			}
			else {
				return false;
			}
			
		}
		elseif( isset( $block['innerBlocks'] ) && !empty( $block['innerBlocks'] ) ) {
				leo_first_hero_checker($block['innerBlocks'], $this_block_name, $this_block_id);
		}

	}

	return false;
}



//register helio block category
function helio_block_category( $categories, $post ) {
	return array_merge(
		
		array(
			array(
				'slug' => 'helio-blocks',
				'title' => __( 'Helio Blocks', 'helio-blocks' ),
			),
		),
		$categories
	);
}
add_filter( 'block_categories', 'helio_block_category', 10, 2);

//Hero

add_action( 'acf/init', 'register_hero_block' );
function register_hero_block() {

	if ( function_exists( 'acf_register_block_type' ) ) {

		// Register Hero block
		acf_register_block_type( array(
			'name' 					=> 'hero',
			'title' 				=> __( 'Hero' ),
			'description' 			=> __( 'A custom Hero block.' ),
			'category' 				=> 'helio-blocks',
			'icon'					=> 'format-image',
			'keywords'				=> array( 'hero' ),
			'post_types'			=> array( 'post', 'page' ),
			'mode'					=> 'auto',
			'align'				 	=> 'full',
			'render_template'		=> 'template-parts/blocks/hero/hero.php',
			// 'render_callback'	=> 'hero_block_render_callback',
			 // 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/hero/hero.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/hero/hero.js',
			// 'enqueue_assets' 	=> 'hero_block_enqueue_assets',
			//'supports' 				=> array( 'align' => array( 'full', 'wide' ),),
			
		));

	}

}

//Action Cards

add_action( 'acf/init', 'register_action_cards_block' );
function register_action_cards_block() {

	if ( function_exists( 'acf_register_block_type' ) ) {

		// Register Action Cards block
		acf_register_block_type( array(
			'name' 					=> 'action-cards',
			'title' 				=> __( 'Action Cards' ),
			'description' 			=> __( 'A custom Action Cards block.' ),
			'category' 				=> 'helio-blocks',
			'icon'					=> 'images-alt2',
			'keywords'				=> array( 'action', 'cards' ),
			'post_types'			=> array( 'post', 'page' ),
			'mode'					=> 'auto',
			// 'align'				=> 'wide',
			'render_template'		=> 'template-parts/blocks/action-cards/action-cards.php',
			// 'render_callback'	=> 'action_cards_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/action-cards/action-cards.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/action-cards/action-cards.js',
			// 'enqueue_assets' 	=> 'action_cards_block_enqueue_assets',
		));

	}

}


// Call to Action

add_action( 'acf/init', 'register_call_to_action_block' );
function register_call_to_action_block() {

	if ( function_exists( 'acf_register_block_type' ) ) {

		// Register Call to Action block
		acf_register_block_type( array(
			'name' 					=> 'call-to-action',
			'title' 				=> __( 'Call to Action' ),
			'description' 			=> __( 'A custom Call to Action block.' ),
			'category' 				=> 'helio-blocks',
			'icon'					=> 'admin-links',
			'keywords'				=> array( 'call', 'to', 'action' ),
			'post_types'			=> array( 'post', 'page' ),
			'mode'					=> 'auto',
			// 'align'				=> 'wide',
			'render_template'		=> 'template-parts/blocks/call-to-action/call-to-action.php',
			// 'render_callback'	=> 'call_to_action_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/call-to-action/call-to-action.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/call-to-action/call-to-action.js',
			// 'enqueue_assets' 	=> 'call_to_action_block_enqueue_assets',
		));

	}

}

//Filter Blocks

add_action( 'acf/init', 'register_link_blocks_block' );
function register_link_blocks_block() {

	if ( function_exists( 'acf_register_block_type' ) ) {

		// Register link blocks block
		acf_register_block_type( array(
			'name' 					=> 'link-blocks',
			'title' 				=> __( 'Link blocks' ),
			'description' 			=> __( 'A custom link blocks block.' ),
			'category' 				=> 'helio-blocks',
			'icon'					=> 'grid-view',
			'keywords'				=> array( 'link', 'blocks' ),
			'post_types'			=> array( 'post', 'page' ),
			'mode'					=> 'auto',
			// 'align'				=> 'wide',
			'render_template'		=> 'template-parts/blocks/link-blocks/link-blocks.php',
			// 'render_callback'	=> 'filter_blocks_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/filter-blocks/filter-blocks.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/filter-blocks/filter-blocks.js',
			// 'enqueue_assets' 	=> 'filter_blocks_block_enqueue_assets',
		));

	}

}


add_action( 'acf/init', 'register_events_block' );
function register_events_block() {

	if ( function_exists( 'acf_register_block_type' ) ) {

		// Register Events block
		acf_register_block_type( array(
			'name' 					=> 'events',
			'title' 				=> __( 'Events' ),
			'description' 			=> __( 'A custom Events block.' ),
			'category' 				=> 'helio-blocks',
			'icon'					=> 'calendar-alt',
			'keywords'				=> array( 'events' ),
			'post_types'			=> array( 'post', 'page' ),
			'mode'					=> 'auto',
			// 'align'				=> 'wide',
			'render_template'		=> 'template-parts/blocks/events/events.php',
			// 'render_callback'	=> 'events_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/events/events.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/events/events.js',
			// 'enqueue_assets' 	=> 'events_block_enqueue_assets',
		));

	}

}

add_action( 'acf/init', 'register_featured_posts_block' );
function register_featured_posts_block() {

	if ( function_exists( 'acf_register_block_type' ) ) {

		// Register Featured Posts block
		acf_register_block_type( array(
			'name' 					=> 'featured-posts',
			'title' 				=> __( 'Featured Posts' ),
			'description' 			=> __( 'A custom Featured Posts block.' ),
			'category' 				=> 'helio-blocks',
			'icon'					=> 'format-aside',
			'keywords'				=> array( 'featured', 'posts' ),
			'post_types'			=> array( 'post', 'page' ),
			'mode'					=> 'auto',
			// 'align'				=> 'wide',
			'render_template'		=> 'template-parts/blocks/featured-posts/featured-posts.php',
			// 'render_callback'	=> 'featured_posts_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/featured-posts/featured-posts.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/featured-posts/featured-posts.js',
			// 'enqueue_assets' 	=> 'featured_posts_block_enqueue_assets',
		));

	}

}



add_action( 'acf/init', 'register_team_block' );
function register_team_block() {

	if ( function_exists( 'acf_register_block_type' ) ) {

		// Register Team block
		acf_register_block_type( array(
			'name' 					=> 'team',
			'title' 				=> __( 'Team' ),
			'description' 			=> __( 'A custom Team block.' ),
			'category' 				=> 'helio-blocks',
			'icon'					=> 'groups',
			'keywords'				=> array( 'team' ),
			'post_types'			=> array( 'post', 'page' ),
			'mode'					=> 'auto',
			// 'align'				=> 'wide',
			'render_template'		=> 'template-parts/blocks/team/team.php',
			// 'render_callback'	=> 'team_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/team/team.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/team/team.js',
			// 'enqueue_assets' 	=> 'team_block_enqueue_assets',
		));

	}

}


add_action( 'acf/init', 'register_stats_block' );
function register_stats_block() {

	if ( function_exists( 'acf_register_block_type' ) ) {

		// Register Stats block
		acf_register_block_type( array(
			'name' 					=> 'stats',
			'title' 				=> __( 'Stats' ),
			'description' 			=> __( 'A custom Stats block.' ),
			'category' 				=> 'helio-blocks',
			'icon'					=> 'chart-pie',
			'keywords'				=> array( 'stats' ),
			'post_types'			=> array( 'post', 'page' ),
			'mode'					=> 'auto',
			// 'align'				=> 'wide',
			'render_template'		=> 'template-parts/blocks/stats/stats.php',
			// 'render_callback'	=> 'stats_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/stats/stats.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/stats/stats.js',
			// 'enqueue_assets' 	=> 'stats_block_enqueue_assets',
		));

	}

}

add_action( 'acf/init', 'register_flow_columns_block' );
function register_flow_columns_block() {

	if ( function_exists( 'acf_register_block_type' ) ) {

		// Register Flow Columns block
		acf_register_block_type( array(
			'name' 					=> 'flow-columns',
			'title' 				=> __( 'Flow Columns' ),
			'description' 			=> __( 'A custom Flow Columns block.' ),
			'category' 				=> 'helio-blocks',
			'icon'					=> 'editor-table',
			'keywords'				=> array( 'flow', 'columns' ),
			'post_types'			=> array( 'post', 'page' ),
			'mode'					=> 'auto',
			// 'align'				=> 'wide',
			'render_template'		=> 'template-parts/blocks/flow-columns/flow-columns.php',
			// 'render_callback'	=> 'flow_columns_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/flow-columns/flow-columns.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/flow-columns/flow-columns.js',
			// 'enqueue_assets' 	=> 'flow_columns_block_enqueue_assets',
		));

	}

}

//two col block
add_action( 'acf/init', 'register_two_column_block' );
function register_two_column_block() {

	if ( function_exists( 'acf_register_block_type' ) ) {

		// Register Two Column block
		acf_register_block_type( array(
			'name' 					=> 'two-column',
			'title' 				=> __( 'Two Column' ),
			'description' 			=> __( 'A custom Two Column block.' ),
			'category' 				=> 'helio-blocks',
			'icon'					=> 'layout',
			'keywords'				=> array( 'two', 'column' ),
			'post_types'			=> array( 'post', 'page' ),
			'mode'					=> 'auto',
			 'align'				=> 'wide',
			'render_template'		=> 'template-parts/blocks/two-column.php',
			// 'render_callback'	=> 'two_column_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/two-column/two-column.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/two-column/two-column.js',
			// 'enqueue_assets' 	=> 'two_column_block_enqueue_assets',
			'supports' 				=> array( 'align' => array( 'full', 'wide' ),),
		));

	}

}


//gen copy
add_action( 'acf/init', 'register_general_copy_block' );
function register_general_copy_block() {

	if ( function_exists( 'acf_register_block_type' ) ) {

		// Register General Copy block
		acf_register_block_type( array(
			'name' 					=> 'general-copy',
			'title' 				=> __( 'General Copy' ),
			'description' 			=> __( 'A custom General Copy block.' ),
			'category' 				=> 'helio-blocks',
			'icon'					=> 'layout',
			'keywords'				=> array( 'general', 'copy' ),
			'post_types'			=> array( 'post', 'page' ),
			'mode'					=> 'auto',
			// 'align'				=> 'wide',
			'render_template'		=> 'template-parts/blocks/general-copy.php',
			// 'render_callback'	=> 'general_copy_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/general-copy/general-copy.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/general-copy/general-copy.js',
			// 'enqueue_assets' 	=> 'general_copy_block_enqueue_assets',
		));

	}

}

add_action( 'acf/init', 'register_tabbed_content_block' );
function register_tabbed_content_block() {

	if ( function_exists( 'acf_register_block_type' ) ) {

		// Register Tabbed Content block
		acf_register_block_type( array(
			'name' 					=> 'tabbed-content',
			'title' 				=> __( 'Tabbed Content' ),
			'description' 			=> __( 'A custom Tabbed Content block.' ),
			'category' 				=> 'helio-blocks',
			'icon'					=> 'layout',
			'keywords'				=> array( 'tabbed', 'content' ),
			'post_types'			=> array( 'post', 'page' ),
			'mode'					=> 'auto',
			// 'align'				=> 'wide',
			'render_template'		=> 'template-parts/blocks/tabbed-content.php',
			// 'render_callback'	=> 'tabbed_content_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/tabbed-content/tabbed-content.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/tabbed-content/tabbed-content.js',
			// 'enqueue_assets' 	=> 'tabbed_content_block_enqueue_assets',
		));

	}

}


add_action( 'acf/init', 'register_contact_block' );
function register_contact_block() {

	if ( function_exists( 'acf_register_block_type' ) ) {

		// Register Contact block
		acf_register_block_type( array(
			'name' 					=> 'contact',
			'title' 				=> __( 'Contact' ),
			'description' 			=> __( 'A custom Contact block.' ),
			'category' 				=>  'helio-blocks',
			'icon'					=> 'layout',
			'keywords'				=> array( 'contact' ),
			'post_types'			=> array( 'post', 'page' ),
			'mode'					=> 'auto',
			// 'align'				=> 'wide',
			'render_template'		=> 'template-parts/blocks/contact.php',
			// 'render_callback'	=> 'contact_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/contact/contact.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/contact/contact.js',
			// 'enqueue_assets' 	=> 'contact_block_enqueue_assets',
		));

	}

}

// Fill in your custom taxonomy here
$yourTaxonomy = 'topic';
// SHOW YOAST PRIMARY CATEGORY, OR FIRST CATEGORY
$category = get_the_terms( $postId, $yourTaxonomy );
$useCatLink = true;
// If post has a category assigned.
if ($category){
    $category_display = '';
    $category_link = '';
    if ( class_exists('WPSEO_Primary_Term') )
    {
        // Show the post's 'Primary' category, if this Yoast feature is available, & one is set
        $wpseo_primary_term = new WPSEO_Primary_Term( 'event_cat', get_the_id() );
        $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
        $term = get_term( $wpseo_primary_term );
        if (is_wp_error($term)) {
            // Default to first category (not Yoast) if an error is returned
            $category_display = $category[0]->name;
            $category_link = get_bloginfo('url') . '/' . 'topics/' . $term->slug;
        } else {
            // Yoast Primary category
            $category_display = $term->name;
            $category_link = get_term_link( $term->term_id );
        }
    }
    else {
        // Default, display the first category in WP's list of assigned categories
        $category_display = $category[0]->name;
        $category_link = get_term_link( $category[0]->term_id );
    }
    // Display category
    if ( !empty($category_display) ){
        if ( $useCatLink == true && !empty($category_link) ){
        echo '<span class="post-topic">';
        echo '<a href="'.$category_link.'">'.$category_display.'</a>';
        echo '</span>';
        } else {
        echo '<span class="post-topic">'.$category_display.'</span>';
        }
    }

}




//google fonts added to header 

function helio_add_fonts()
{ ?>
<link href="https://fonts.googleapis.com/css?family=Cabin:wght@400;700|Roboto|Roboto+Condensed:300,400,700&display=swap"
	rel="stylesheet">
<?php
}
add_action('tha_head_bottom', 'helio_add_fonts');







/*

//hardcoding some fields
if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_5e554a82872a5',
		'title' => 'Block - Action Cards',
		'fields' => array(
			array(
				'key' => 'field_5e5fb2f3789f9',
				'label' => 'Block Background Color',
				'name' => 'bbgc',
				'type' => 'button_group',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'white' => 'white',
					'transparent' => 'transparent',
				),
				'allow_null' => 0,
				'default_value' => '',
				'layout' => 'horizontal',
				'return_format' => 'value',
			),
			array(
				'key' => 'field_5e554a8f70138',
				'label' => 'Headline',
				'name' => 'headline',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5e554a9970139',
				'label' => 'Copy',
				'name' => 'copy',
				'type' => 'textarea',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'new_lines' => 'wpautop',
			),
			array(
				'key' => 'field_5e554a9f7013a',
				'label' => 'Cards',
				'name' => 'cards',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => 'field_5e9084fff35c1',
				'min' => 0,
				'max' => 0,
				'layout' => 'block',
				'button_label' => 'Add Card',
				'sub_fields' => array(
					array(
						'key' => 'field_5e9084e4f35bf',
						'label' => 'target',
						'name' => 'target',
						'type' => 'link',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'array',
					),
					array(
						'key' => 'field_5e9084f6f35c0',
						'label' => 'Icon',
						'name' => 'icon',
						'type' => 'image',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'array',
						'preview_size' => 'medium',
						'library' => 'all',
						'min_width' => '',
						'min_height' => '',
						'min_size' => '',
						'max_width' => '',
						'max_height' => '',
						'max_size' => '',
						'mime_types' => '',
					),
					array(
						'key' => 'field_5e9084fff35c1',
						'label' => 'Label',
						'name' => 'label',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5e90850ff35c2',
						'label' => 'Copy',
						'name' => 'copy',
						'type' => 'textarea',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => '',
						'new_lines' => '',
					),
				),
			),
			array(
				'key' => 'field_5e5faf99be004',
				'label' => 'Closing Card',
				'name' => 'closing_card',
				'type' => 'group',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layout' => 'block',
				'sub_fields' => array(
					array(
						'key' => 'field_5e909dac9466c',
						'label' => 'Headline',
						'name' => 'headline',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5e909de49466d',
						'label' => 'Target',
						'name' => 'target',
						'type' => 'link',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'array',
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'block',
					'operator' => '==',
					'value' => 'acf/action-cards',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));
	
	acf_add_local_field_group(array(
		'key' => 'group_5e5fb493162be',
		'title' => 'Block - Link blocks',
		'fields' => array(
			array(
				'key' => 'field_5e5fb4f3855b9',
				'label' => 'Block Background Color',
				'name' => 'bbgc',
				'type' => 'button_group',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'white' => 'white',
					'transparent' => 'transparent',
				),
				'allow_null' => 0,
				'default_value' => '',
				'layout' => 'horizontal',
				'return_format' => 'value',
			),
			array(
				'key' => 'field_5e5fb62309a33',
				'label' => 'Headline',
				'name' => 'headline',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5e5fb64f1253e',
				'label' => 'Copy',
				'name' => 'copy',
				'type' => 'textarea',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'new_lines' => 'wpautop',
			),
			array(
				'key' => 'field_5e5fb4a6855b7',
				'label' => 'Block Targets',
				'name' => 'links',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => 'field_5e5fb4dd855b8',
				'min' => 0,
				'max' => 0,
				'layout' => 'block',
				'button_label' => 'Add Link block',
				'sub_fields' => array(
					array(
						'key' => 'field_5e90a28bfffee',
						'label' => 'Target',
						'name' => 'target',
						'type' => 'link',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'array',
					),
				),
			),
			array(
				'key' => 'field_5e5fb64109a34',
				'label' => 'Closing Link Button',
				'name' => 'closing_link',
				'type' => 'link',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'block',
					'operator' => '==',
					'value' => 'acf/link-blocks',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));
	
	endif;

	*/












	



		function resource_term_link_filter( $url, $term, $taxonomy) {
$stakeholder_taxonomies = array('stakeholder_types', 'stakeholder_topics');

$resource_taxonomies =  array('visiting_reason', 'case_status','translated_content', 'misc', 'type_of_court_user');

$news = array('category');

if (in_array($taxonomy, $stakeholder_taxonomies)) { 
	$url = home_url() . '/stakeholders/?fwp_' . $taxonomy . '=' . $term->slug;
			return $url;

}

if (in_array($taxonomy, $resource_taxonomies)) { 
	$url = home_url() . '/resources/?fwp_' . $taxonomy . '=' . $term->slug;
			return $url;

}

if (in_array($taxonomy, $news)) { 
	$url = home_url() . '/news/?fwp_' . $taxonomy . '=' . $term->slug;
			return $url;

}
return $url;
		}
	
		add_filter( 'term_link', 'resource_term_link_filter', 10, 3 );

		








		//renaming default taxonomy labels
		function leo_change_cat_label() {
			global $submenu;
			$submenu['edit.php'][15][0] = 'Topics'; // Rename categories to Topics
		}
		add_action( 'admin_menu', 'leo_change_cat_label' );

		function leo_change_cat_object() {
			global $wp_taxonomies;
			$labels = &$wp_taxonomies['category']->labels;
			$labels->name = 'Topics';
			$labels->singular_name = 'Topic';
			$labels->add_new = 'Add Topic';
			$labels->add_new_item = 'Add Topic';
			$labels->edit_item = 'Edit Topic';
			$labels->new_item = 'Topic';
			$labels->view_item = 'View Topic';
			$labels->search_items = 'Search Topics';
			$labels->not_found = 'No Topics found';
			$labels->not_found_in_trash = 'No Topics found in Trash';
			$labels->all_items = 'All Topics';
			$labels->menu_name = 'Topic';
			$labels->name_admin_bar = 'Topic';
		}
		add_action( 'init', 'leo_change_cat_object' );