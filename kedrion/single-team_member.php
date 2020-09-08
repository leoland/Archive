<?php
	/**
	 * The template for displaying all single posts
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
	 *
	 * @package ch2
	 */

	get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php  get_template_part( 'template-parts/block', 'hero' ); ?>
        <?php
				while ( have_posts() ) : the_post();
 $member_photo = get_field( 'member_photo' ); ?>

        <div class="block entry-content">
            <div class="outer-block-wrapper">
                <!-- extend with needed container -->
                <div class="inner-block-wrapper">
                    <!-- probably extend with row or -->


                    <div class="main">

                        <?php if ( $member_photo ) { ?>
                        <div class="member-photo">
                            <img src="<?php echo $member_photo['url']; ?>" alt="<?php echo $member_photo['alt']; ?>" />
                        </div>
                        <?php } ?>
                        <?php the_field( 'Main' ); ?>
                    </div>


                </div>
            </div>



            <div class="member-quote">
                <div class="outer-block-wrapper">
                    <!-- extend with needed container -->
                    <div class="inner-block-wrapper">
                        <h2 class="quote-heading">
                            <?php the_field( 'quote_heading' ); ?>
                        </h2>
                        <div class="quote-body">
                            <?php the_field( 'quote_body' ); ?>
                        </div>

                        <div class="quote-source">
                            <?php the_field( 'quote_source' ); ?>
                        </div>
                        <a href="/about-us/" class="back-link">Back to Team</a>
                    </div>
                </div>


            </div>




            <?php
				endwhile; // End of the loop.
			?>


    </main><!-- #main -->
</div><!-- #primary -->

</div>

<?php
	get_footer();