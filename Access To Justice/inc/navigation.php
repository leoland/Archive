<?php
/**
 * Navigation
 *
 * @package      EAStarter
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

/**
 * Mobile Menu
 *
 */
function ea_site_header() {
	echo ea_mobile_menu_toggle();
	echo ea_search_toggle();

	echo '<nav' . ea_amp_class( 'nav-menu', 'active', 'menuActive' ) . ' role="navigation">';
	if( has_nav_menu( 'primary' ) ) {
		wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'container_class' => 'nav-primary', 'walker' => new leo_Menu_Walker() ));
	}
	if( has_nav_menu( 'secondary' ) ) {
		wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu', 'container_class' => 'nav-secondary' ) );
	}
	echo '</nav>';

	echo '<div' . ea_amp_class( 'header-search', 'active', 'searchActive' ) . '>' . get_search_form( array( 'echo' => false ) ) . '</div>';
}
add_action( 'tha_header_bottom', 'ea_site_header', 11 );

/**
 * Nav Extras
 *
 */
function ea_nav_extras( $menu, $args ) {

	if( 'primary' === $args->theme_location ) {
	//	$menu .= '<li class="menu-item search">' . ea_search_toggle() . '</li>';
	}

	if( 'secondary' === $args->theme_location ) {
		//$menu .= '<li class="menu-item search">' . get_search_form( false ) . '</li>';
		//$menu .= '<li class="menu-item search">' . ea_search_toggle() . '</li>';
	}

	return $menu;
}
add_filter( 'wp_nav_menu_items', 'ea_nav_extras', 10, 2 );

/**
 * Search toggle
 *
 */
function ea_search_toggle() {
	$output = '<button' . ea_amp_class( 'search-toggle', 'active', 'searchActive' ) . ea_amp_toggle( 'searchActive', array( 'menuActive', 'mobileFollow' ) ) . '>';
		$output .= ea_icon( array( 'icon' => 'search', 'size' => 24, 'class' => 'open' ) );
		$output .= ea_icon( array( 'icon' => 'close', 'size' => 24, 'class' => 'close' ) );
		$output .= '<span class="screen-reader-text">Search</span>';
	$output .= '</button>';
	return $output;
}

/**
 * Mobile menu toggle
 *
 */
function ea_mobile_menu_toggle() {
	$output = '<button' . ea_amp_class( 'menu-toggle', 'active', 'menuActive' ) . ea_amp_toggle( 'menuActive', array( 'searchActive', 'mobileFollow' ) ) . '>';
		$output .= ea_icon( array( 'icon' => 'menu', 'size' => 24, 'class' => 'open' ) );
		$output .= ea_icon( array( 'icon' => 'close', 'size' => 24, 'class' => 'close' ) );
		$output .= '<span class="screen-reader-text">Menu</span>';
	$output .= '</button>';
	return $output;
}

/**
 * Add a dropdown icon to top-level menu items.
 *
 * @param string $output Nav menu item start element.
 * @param object $item   Nav menu item.
 * @param int    $depth  Depth.
 * @param object $args   Nav menu args.
 * @return string Nav menu item start element.
 * Add a dropdown icon to top-level menu items
 */
function ea_nav_add_dropdown_icons( $output, $item, $depth, $args ) {

	if ( ! isset( $args->theme_location ) || 'primary' !== $args->theme_location ) {
		return $output;
	}

	if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {

		// Add SVG icon to parent items.
		$icon = ea_icon( array( 'icon' => 'navigate-down', 'size' => 8, 'title' => 'Submenu Dropdown' ) );

		$output .= sprintf(
			'<button' . ea_amp_nav_dropdown( $args->theme_location, $depth ) . ' tabindex="-1">%s</button>',
			$icon
		);
	}

	return $output;
}
add_filter( 'walker_nav_menu_start_el', 'ea_nav_add_dropdown_icons', 10, 4 );

/**
 * Previous/Next Archive Navigation (disabled)
 *
 */
function ea_archive_navigation() {
	if( ! is_singular() )
		the_posts_navigation();
}
//add_action( 'tha_content_while_after', 'ea_archive_navigation' );

/**
 * Archive Paginated Navigation
 *
 */
function ea_archive_paginated_navigation() {

	if ( is_singular() ) {
		return;
	}

	global $wp_query;

	// Stop execution if there's only one page.
	if ( $wp_query->max_num_pages <= 1 ) {
		return;
	}

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = (int) $wp_query->max_num_pages;

	// Add current page to the array.
	if ( $paged >= 1 ) {
		$links[] = $paged;
	}

	// Add the pages around the current page to the array.
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<nav class="archive-pagination pagination">';

	$before_number = '<span class="screen-reader-text">' . __( 'Go to page', 'ea-starter' ) . '</span>';

	printf( '<ul role="navigation" aria-label="%s">', esc_attr__( 'Pagination', 'ea-starter' ) );

	// Previous Post Link.
	if ( get_previous_posts_link() ) {
		$label		= __( '<span class="screen-reader-text">Go to</span> Previous Page', 'ea-starter' );
		$link       = get_previous_posts_link( apply_filters( 'genesis_prev_link_text', '&#x000AB; ' . $label ) );
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Value is hardcoded and safe, not set via input.
		printf( '<li class="pagination-previous">%s</li>' . "\n", $link );
	}

	// Link to first page, plus ellipses if necessary.
	if ( ! in_array( 1, $links, true ) ) {
		$class = 1 === $paged ? ' class="active"' : '';

		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Value is known to be safe, not set via input.
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, get_pagenum_link( 1 ), trim( $before_number . ' 1' ) );

		if ( ! in_array( 2, $links, true ) ) {
			$label	= sprintf( '<span class="screen-reader-text">%s</span> &#x02026;', __( 'Interim pages omitted', 'ea-starter' ) );
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Value is known to be safe, not set via input.
			printf( '<li class="pagination-omission">%s</li> ' . "\n", $label );
		}
	}

	// Link to current page, plus 2 pages in either direction if necessary.
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = '';
		$aria  = '';
		if ( $paged === $link ) {
			$class = ' class="active" ';
			$aria  = ' aria-label="' . esc_attr__( 'Current page', 'ea-starter' ) . '" aria-current="page"';
		}

		printf(
			'<li%s><a href="%s"%s>%s</a></li>' . "\n",
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Value is safe, not set via input.
			$class,
			esc_url( get_pagenum_link( $link ) ),
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Value is safe, not set via input.
			$aria,
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Value is safe, not set via input.
			trim( $before_number . ' ' . $link )
		);
	}

	// Link to last page, plus ellipses if necessary.
	if ( ! in_array( $max, $links, true ) ) {

		if ( ! in_array( $max - 1, $links, true ) ) {
			$label = sprintf( '<span class="screen-reader-text">%s</span> &#x02026;', __( 'Interim pages omitted', 'ea-starter' ) );
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Value is known to be safe, not set via input.
			printf( '<li class="pagination-omission">%s</li> ' . "\n", $label );
		}

		$class = $paged === $max ? ' class="active"' : '';
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Value is safe, not set via input.
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, get_pagenum_link( $max ), trim( $before_number . ' ' . $max ) );

	}

	// Next Post Link.
	if ( get_next_posts_link() ) {
		$label = __( '<span class="screen-reader-text">Go to</span> Next Page', 'ea-starter' );
		$link       = get_next_posts_link( apply_filters( 'genesis_next_link_text', $label . ' &#x000BB;' ) );
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Value is hardcoded and safe, not set via input.
		printf( '<li class="pagination-next">%s</li>' . "\n", $link );
	}

	echo '</ul>';
	echo '</nav>';
}
add_action( 'tha_content_while_after', 'ea_archive_paginated_navigation' );


/**
 * Adds the Callout Image & Link if used as well as the class on the item itself
 */
 
function my_wp_nav_menu_objects( $items, $args ) {
	
	// loop
	foreach( $items as $item ) {
		
		// vars
		$large = get_field( 'large_dropdown', $item);
		
		if( $large ) {
			$item->classes[] = 'large_dropdown';
			//$dad_id = $item->object_id;
		}
	
	
		
	}
	
	// return
	return $items;
	
}
add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);











				
		//walker


		
		class leo_Menu_Walker extends Walker_Nav_Menu {
static $count = 0;
			public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
				global $wp_query;
			
				if ($depth==0) self::$count=0;  // reset var when we are in first level


				if ($depth==1 && self::$count==1) { 
					$callout_link = get_field( 'callout_link', $item->menu_item_parent ); 
					if ($callout_link) {
						$callout_image = get_field( 'callout_image' , $item->menu_item_parent ); 
						$callout_image_url = $callout_image['url'];
						$callout_text = get_field( 'callout_text', $item->menu_item_parent );
						$the_callout = '<li class="callout"><a href="'. $callout_link . '">' . '<img src="'. $callout_image_url.' " alt="" />' . '<div class="callout-text">'.$callout_text .'</div></a></li>';
						$output .= $the_callout;
					} 
					}

		
				




				if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
					$t = '';
					$n = '';
				} else {
					$t = "\t";
					$n = "\n";
				}
				$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';
			 
				$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
				$classes[] = 'menu-item-' . $item->ID;
			 
				/**
				 * Filters the arguments for a single nav menu item.
				 *
				 * @since 4.4.0
				 *
				 * @param stdClass $args  An object of wp_nav_menu() arguments.
				 * @param WP_Post  $item  Menu item data object.
				 * @param int      $depth Depth of menu item. Used for padding.
				 */
				$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );
			 
				/**
				 * Filters the CSS classes applied to a menu item's list item element.
				 *
				 * @since 3.0.0
				 * @since 4.1.0 The `$depth` parameter was added.
				 *
				 * @param string[] $classes Array of the CSS classes that are applied to the menu item's `<li>` element.
				 * @param WP_Post  $item    The current menu item.
				 * @param stdClass $args    An object of wp_nav_menu() arguments.
				 * @param int      $depth   Depth of menu item. Used for padding.
				 */
				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
				$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
			 
				/**
				 * Filters the ID applied to a menu item's list item element.
				 *
				 * @since 3.0.1
				 * @since 4.1.0 The `$depth` parameter was added.
				 *
				 * @param string   $menu_id The ID that is applied to the menu item's `<li>` element.
				 * @param WP_Post  $item    The current menu item.
				 * @param stdClass $args    An object of wp_nav_menu() arguments.
				 * @param int      $depth   Depth of menu item. Used for padding.
				 */
				$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
				$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
			 
				$output .= $indent . '<li' . $id . $class_names . '>';
			 
				$atts           = array();
				$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
				$atts['target'] = ! empty( $item->target ) ? $item->target : '';
				if ( '_blank' === $item->target && empty( $item->xfn ) ) {
					$atts['rel'] = 'noopener noreferrer';
				} else {
					$atts['rel'] = $item->xfn;
				}
				$atts['href']         = ! empty( $item->url ) ? $item->url : '';
				$atts['aria-current'] = $item->current ? 'page' : '';
			 
				/**
				 * Filters the HTML attributes applied to a menu item's anchor element.
				 *
				 * @since 3.6.0
				 * @since 4.1.0 The `$depth` parameter was added.
				 *
				 * @param array $atts {
				 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
				 *
				 *     @type string $title        Title attribute.
				 *     @type string $target       Target attribute.
				 *     @type string $rel          The rel attribute.
				 *     @type string $href         The href attribute.
				 *     @type string $aria_current The aria-current attribute.
				 * }
				 * @param WP_Post  $item  The current menu item.
				 * @param stdClass $args  An object of wp_nav_menu() arguments.
				 * @param int      $depth Depth of menu item. Used for padding.
				 */
				$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
			 
				$attributes = '';
				foreach ( $atts as $attr => $value ) {
					if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
						$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
						$attributes .= ' ' . $attr . '="' . $value . '"';
					}
				}
			 
				/** This filter is documented in wp-includes/post-template.php */
				$title = apply_filters( 'the_title', $item->title, $item->ID );
			 
				/**
				 * Filters a menu item's title.
				 *
				 * @since 4.4.0
				 *
				 * @param string   $title The menu item's title.
				 * @param WP_Post  $item  The current menu item.
				 * @param stdClass $args  An object of wp_nav_menu() arguments.
				 * @param int      $depth Depth of menu item. Used for padding.
				 */
				$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );
			 
				$item_output  = $args->before;
				$item_output .= '<a' . $attributes . '>';
				$item_output .= $args->link_before . $title . $args->link_after;
				$item_output .= '</a>';
				$item_output .= $args->after;
			 
				/**
				 * Filters a menu item's starting output.
				 *
				 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
				 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
				 * no filter for modifying the opening and closing `<li>` for a menu item.
				 *
				 * @since 3.0.0
				 *
				 * @param string   $item_output The menu item's starting HTML output.
				 * @param WP_Post  $item        Menu item data object.
				 * @param int      $depth       Depth of menu item. Used for padding.
				 * @param stdClass $args        An object of wp_nav_menu() arguments
				 */

				//$callout_link = get_field( 'callout_link', $item); 
				if ($callout_link) {
					//$item_output .= '<div class="cta-container">'.$callout_link.'</div>';
			}

		



				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

			
				self::$count++;  // increase counter
			}

			 // add classes to ul sub-menus
			 function start_lvl( &$output, $depth = 0, $args = array() ) {
				// depth dependent classes
				$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
				$display_depth = ( $depth + 1); // because it counts the first submenu as 0
				$classes = array(
					'sub-menu',
					'menu-depth-' . $display_depth
				);
				$class_names = implode( ' ', $classes );
		
				// build html
				if ($display_depth == 1) {
					$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
				} else {
					$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
				}
			}
		
		}