<?php
	/**
	 * Template part for displaying a Testimonials.
	 */
?>


<section class="block testimonials ">
    <div class="outer-block-wrapper"> <!-- extend with needed container -->
        <div class="inner-block-wrapper"> <!-- probably extend with row or -->


			<?php if ( get_sub_field( 'use_global_testimonial_block' ) == 1 ) :

				?>
                <h1 class="title"><?php the_field( 'heading', 'option' ); ?></h1>

				<?php if ( have_rows( 'quotes', 'option' ) ) : ?>

                <div class="testimonials-slider">
					<?php while ( have_rows( 'quotes', 'option' ) ) : the_row(); ?>
                        <div class="testimonial">

                            <div class="copy">                        <?php the_sub_field( 'copy' ); ?>
                            </div>

                            <h2 class="source">
								<?php the_sub_field( 'source' ); ?>
                            </h2>
                            <p class="source-detail">
								<?php the_sub_field( 'source_detail' ); ?></p>

                        </div>
					<?php endwhile; ?>
                </div>

			<?php endif;
			else:

				?>


                <h1 class="title"><?php the_sub_field( 'heading' ); ?></h1>
				<?php if ( have_rows( 'quotes' ) ) : ?>

                <div class="testimonials-slider">
					<?php while ( have_rows( 'quotes' ) ) : the_row(); ?>
                        <div class="testimonial">

                            <div class="copy">                        <?php the_sub_field( 'copy' ); ?>
                            </div>

                            <h2 class="source">
								<?php the_sub_field( 'source' ); ?>
                            </h2>
                            <p class="source-detail">
								<?php the_sub_field( 'source_detail' ); ?></p>

                        </div>
					<?php endwhile; ?>
                </div>

			<?php endif;
			endif; ?>


        </div>
    </div>
</section>


