<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ch2
 */

get_header(); ?>

<div id="primary" class="content-area ">
	<main id="main" class="site-main" role="main">

		<article id="post-<?php the_ID();?>" <?php post_class();?>>

			<?php get_template_part('template-parts/block', 'hero');?>


			<section class="block general_copy login-block">
				<div class="outer-block-wrapper">
					<!-- extend with needed container -->
					<div class="inner-block-wrapper">
						<!-- probably extend with row or -->

						<div class="content">

							<?php

echo do_shortcode( '[frm-login label_username="Username" label_password="Password" class="frm_style_formidable-style"]' );



if ( !is_user_logged_in() ) { ?>
							<a href="/create-an-account/" class="create">Create an Account</a>
							<?php
}
?>
						</div>

					</div>
				</div>
			</section>



		</article><!-- #post-## -->
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();