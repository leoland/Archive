<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package ch2
 */

get_header(); ?>



			<section class="error-404 not-found">
				<div class="outer-wrapper">
					<div class="inner-wrapper">
						<div class="content-wrapper">
							<header class="page-header">
								<h1 class="page-title"><?php esc_html_e( 'Sorry! That page can&rsquo;t be found.', 'ch2_sandbox' ); ?></h1>
							</header><!-- .page-header -->
			
							<div class="page-content">
								<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'ch2_sandbox' ); ?></p>
			
								<?php
								//	get_search_form();
			
								//	the_widget( 'WP_Widget_Recent_Posts' );
			
									// Only show the widget if site has multiple categories.
			
									/* translators: %1$s: smiley */
			
								?>
			
							</div><!-- .page-content -->
						</div>
					</div>
				</div>
			</section><!-- .error-404 -->


<?php
get_footer();
