<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ch2
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">



			<?php  get_template_part( 'template-parts/block', 'hero' ); ?>
		<?php
		if ( have_posts() ) :

 ?>

            <section class="block featured_posts   posts-archive">
                <div class="outer-block-wrapper"> <!-- extend with needed container -->
                    <div class="inner-block-wrapper"> <!-- probably extend with row or -->
                        <div class="post-thumbnails">
                        <?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'archive' );

			endwhile;
			?>


                       <?php  the_posts_navigation();


	?>
                    </div>
                    </div>
                    </div>
			</section>

			<?php




		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
