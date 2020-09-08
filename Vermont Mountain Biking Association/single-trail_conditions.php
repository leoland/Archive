<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ch2
 */

get_header(); ?>



		<?php
		while ( have_posts() ) : the_post();

			?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php $background = get_the_post_thumbnail_url( get_the_ID(), 'full' );
					$conditions_background = get_field( 'conditions_background', 'option' );
					$background =  $conditions_background['url'];?>
                <header class="entry-header block hero height-<?php the_field( 'height' ); ?>"
                        style="background-color: lightgray; background: linear-gradient(to right, rgba(2, 48, 62, .9), rgba(2, 48, 62, .9)),  url('<?php echo $background; ?>');
                                ">
                    <div class="filter"></div>
                    <div class="outer-block-wrapper"> <!-- extend with needed container -->
                        <div class="inner-block-wrapper"> <!-- probably extend with row or -->
                            <div class="hero--content">
								<?php
									$logo = get_field( 'logo' ); ?>
								<?php if ( $logo ) { ?>
                                    <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>"/>
								<?php } else {
									the_title( '<h1 class="hero--title entry-title">', '</h1>' );
								};

								?>


                            </div>
                        </div>
                    </div>
                </header><!-- .entry-header -->
<?php

	get_template_part( 'template-parts/layout', 'blocks' );


         ?>


            </article><!-- #post-## -->

		<?php
		endwhile; // End of the loop.
		?>



<?php
get_footer();
