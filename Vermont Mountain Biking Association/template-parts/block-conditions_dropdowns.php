<?php
	/**
	 * Template part for displaying a Conditions dropdowns.
	 */

	$pre_heading = get_sub_field( 'pre_heading' );
	$background  = get_sub_field( 'background' );

	$background_url    = $background['url'];
	$background_credit = get_post_meta( $background['ID'], 'ch2_the_photo_credit', true );
	$heading           = get_sub_field( 'heading' );
	$copy              = get_sub_field( 'copy' );


?>


<section class="block conditions_dropdowns"
         style=" background: linear-gradient(to right, rgba(2, 48, 62, .81), rgba(2, 48, 62, .81)), url('<?php echo $background_url; ?>'); ">
    <div class="outer-block-wrapper"> <!-- extend with needed container -->
        <div class="inner-block-wrapper"> <!-- probably extend with row or -->
            <!-- Stuff goes here -->

            <div class="info">
                <h3 class="pre-heading"><?php echo $pre_heading ?></h3>
                <h2 class="heading"><?php echo $heading; ?></h2>
                <div class="copy">
					<?php echo $copy; ?>
                </div>


            </div>

            <div class="dropdowns">
				<?php
					// WP_Query arguments
					$args = array(
						'post_type'      => array( 'trail_conditions' ),
						'posts_per_page' => '-1',
						'order'          => 'ASC',
						'orderby'        => 'title',
						'meta_query'     => array(
							array(
								'key'     => 'region',
								'value'   => 'north',
								'compare' => 'LIKE'
							),
						)
					);

					// The Query
					$query = new WP_Query( $args );

					// The Loop
					if ( $query->have_posts() ) :?>


                        <div class="trail-select-wrapper">

                            <input type="checkbox" id="north_toggle">
                            <label class="region" for="north_toggle">
                                Northern VT
                            </label>

                            <ul class="trail-select">
								<?php
									while ( $query->have_posts() ) : $query->the_post();
										?>
                                        <li>
                                        <a class="trail-condition" href="<?php the_permalink(); ?>">
											<?php the_title(); ?>
                                        </a>
                                        </li><?php
									endwhile;
								?>
                            </ul>
                        </div>
					<?php
					endif;

					// Restore original Post Data
					wp_reset_postdata();


				?>



				<?php
					// WP_Query arguments
					$args = array(
						'post_type'      => array( 'trail_conditions' ),
						'posts_per_page' => '-1',
						'order'          => 'ASC',
						'orderby'        => 'title',
						'meta_query'     => array(
							array(
								'key'     => 'region',
								'value'   => 'central',
								'compare' => 'LIKE'
							),
						)
					);

					// The Query
					$query = new WP_Query( $args );

					// The Loop
					if ( $query->have_posts() ) :?>
                        <div class="trail-select-wrapper">

                            <input type="checkbox" id="central_toggle">
                            <label class="region" for="central_toggle">
                                Central VT
                            </label>

                            <ul class="trail-select">
								<?php
									while ( $query->have_posts() ) : $query->the_post();
										?>
                                        <li>
                                        <a class="trail-condition" href="<?php the_permalink(); ?>">
											<?php the_title(); ?>
                                        </a>
                                        </li><?php
									endwhile;
								?>
                            </ul>
                        </div>
					<?php
					endif;

					// Restore original Post Data
					wp_reset_postdata();
				?>

				<?php
					// WP_Query arguments
					$args = array(
						'post_type'      => array( 'trail_conditions' ),
						'posts_per_page' => '-1',
						'order'          => 'ASC',
						'orderby'        => 'title',
						'meta_query'     => array(
							array(
								'key'     => 'region',
								'value'   => 'south', // this should work...
								'compare' => 'LIKE'
							),
						)
					);

					// The Query
					$query = new WP_Query( $args );

					// The Loop
					if ( $query->have_posts() ) :?>
                        <div class="trail-select-wrapper">

                            <input type="checkbox" id="south_toggle">
                            <label class="region" for="south_toggle">
                                Southern VT
                            </label>

                            <ul class="trail-select">
								<?php
									while ( $query->have_posts() ) : $query->the_post();
										?>
                                        <li>
                                        <a class="trail-condition" href="<?php the_permalink(); ?>">
											<?php the_title(); ?>
                                        </a>
                                        </li><?php
									endwhile;
								?>
                            </ul>
                        </div>
					<?php
					endif;

					// Restore original Post Data
					wp_reset_postdata();


				?>

            </div>
			<?php if ( $background_credit ): ?>
                <span class="photo-credit">
            <?php echo $background_credit; ?>
        </span>
			<?php endif; ?>
        </div>
    </div>
</section>