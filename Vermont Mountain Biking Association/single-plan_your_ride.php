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
			<?php
				$logo = get_field( 'logo' ); ?>
			<?php if ( $logo ) { ?>
                <header class="poi-header">
                    <div class="filter"></div>
                    <div class="outer-block-wrapper"> <!-- extend with needed container -->
                        <div class="inner-block-wrapper"> <!-- probably extend with row or -->
                            <div class="poi-logo">


                                <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>"/>

                            </div>
                        </div>
                    </div>
                </header><!-- .entry-header -->
			<?php }
			?>
            <!-- <div class="favorites">
			 </div>-->
            <div class="outer-block-wrapper"> <!-- extend with needed container -->
                <div class="inner-block-wrapper"> <!-- probably extend with row or -->
                    <div class="content">
                        <div class="side-info">
							<?php $vmba_location = get_field( 'vmba_location' ); ?>
							<?php if ( $vmba_location ) {
								$map_link = 'https://www.google.com/maps/place/' . urlencode( str_replace( ' ', '+', $vmba_location['address'] ) );
								?>
                                <a class="pin" target='_blank'
                                   href="<?php echo $map_link; ?>"> <?php echo $vmba_location['address']; ?></a>
							<?php } ?>

							<?php if ( have_rows( 'email' ) ) : ?>
								<?php while ( have_rows( 'email' ) ) : the_row(); ?>
									<?php if ( get_sub_field( 'address' ) ): ?>

										<?php $label = get_sub_field( 'label' ); ?>
                                        <a class="email"
                                           href="mailto:<?php the_sub_field( 'address' ); ?>"><?php if ( $label ) {
												echo $label;
											} else {
												echo 'Contact';
											}; ?></a>
									<?php endif; ?>
								<?php endwhile; ?>
							<?php endif; ?>

							<?php if ( have_rows( 'phone' ) ) : ?>

								<?php while ( have_rows( 'phone' ) ) : the_row();
									$phone = get_sub_field( 'number' );
									if ( $phone ):
										$raw = preg_replace( "/[^0-9,.]/", "", $phone );
										?>
                                        <a class="phone" href="tel:<?php echo $raw; ?>">
											<?php $data = $phone;
												echo '(' . substr( $data, 0, 3 ) . ') ' . substr( $data, 3, 3 ) . '-' . substr( $data, 6 ); ?>
                                        </a>
									<?php endif; ?>
								<?php endwhile; ?>
							<?php endif; ?>
							<?php if ( get_field( 'website' ) ): ?>
                                <a class="web" target="_blank" href="<?php the_field( 'website' ); ?>">
                                    Learn More</a>

							<?php endif; ?>
                        </div>
                        <div class="main-info">
                            <div class="poi-meta">
                                <div class="types">
									<?php
										$terms = get_the_terms( get_the_ID(), 'poi_type' );

										if ( $terms && ! is_wp_error( $terms ) ) :


											foreach (
												$terms

												as $term
											) {
												?><span class="type"> <?php echo $term->name; ?></span><?php
											}

										endif; ?>
                                </div>
                                <div class="poi-regions">
									<?php
										$terms = get_the_terms( get_the_ID(), 'region' );

										if ( $terms && ! is_wp_error( $terms ) ) :


										foreach ( $terms

										as $term ) {
									?><span class="poi-region"> <?php echo $term->name; ?><span><?php
												}

												endif; ?>
                                </div>

                            </div>
                            <h1 class="poi-title"><?php the_title() ?></h1>
                            <!--<h4 class="poi-description">Description</h4>-->
                            <div class="poi-content"><?php the_content(); ?></div>


							<?php $post_objects = get_field( 'nearby_trails' );
								if ( $post_objects ): ?>
                                    <div class="nearby">
                                        <h3>Trailheads within a 45 minute drive</h3>
                                        <ul>
											<?php foreach ( $post_objects as $post ): // variable must be called $post (IMPORTANT) ?>
												<?php setup_postdata( $post ); ?>
                                                <li>
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

													<?php

														$terms = get_the_terms( get_the_ID(), 'poi_type' );

														if ( $terms && ! is_wp_error( $terms ) ) :

															?>

                                                            <div class="difficulties">
																<?php
																	foreach ( $terms as $term ) {
																		if ( $term->parent == 4 ) {
																			$difficulty = $term->name;
																			?>
                                                                            <div class="difficulty"><?php
																			echo $difficulty[0]; ?></div><?php
																		}
																	}
																?></div> <?php
														endif; ?>


                                                </li>
											<?php endforeach; ?>
                                        </ul>
										<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                                    </div>
								<?php endif; ?>


                        </div>
                    </div>
                </div>
            </div>


			<?php if ( have_rows( 'points_of_interest_callout', 'option' ) ) : ?>
				<?php while ( have_rows( 'points_of_interest_callout', 'option' ) ) : the_row();


					$style             = get_sub_field( 'style' );
					$topo              = get_sub_field( 'topo' );
					$background_image  = get_sub_field( 'background_image' );
					$background_url    = $background_image['url'];
					$background_credit = get_post_meta( $background_image['ID'], 'ch2_the_photo_credit', true );
					$align             = get_sub_field( 'content_placement' );

					/*
					* Content
					*/

					$pre_heading = get_sub_field( 'pre-heading' );
					$heading     = get_sub_field( 'heading' );
					$copy        = get_sub_field( 'copy' );


					?>


                    <section
                            class="block callout
        style-<?php echo $style; ?>
        topo-<?php echo $topo; ?>
        align-<?php echo $align; ?>
"
                            style=" background: linear-gradient(to right, rgba(40, 70, 52,.1), rgba(40, 70, 52,.1)), url('<?php echo $background_url; ?>'); "

                    >
                        <div class="outer-block-wrapper"> <!-- extend with needed container -->
                            <div class="inner-block-wrapper"> <!-- probably extend with row or -->
                                <!-- Stuff goes here -->
                                <div class="callout--content">
                                    <!--follow this pattern for fields, that way their space is not allocated if the field is empty and we do not have weird empty markup everywhere-->

									<?php if ( $pre_heading ): ?>
                                        <h5 class="callout--pre-heading pre-heading"> <?php echo $pre_heading ?></h5>
									<?php endif; ?>
									<?php if ( $heading ): ?>
                                        <h2 class="callout--title heading"> <?php echo $heading ?></h2>
									<?php endif; ?>

									<?php if ( $copy ): ?>
                                        <div class="copy"> <?php echo $copy; ?></div>
									<?php endif;


									?>




									<?php if ( have_rows( 'buttons' ) ) : ?>
                                        <div class="buttons">
											<?php while ( have_rows( 'buttons' ) ) : the_row(); ?>
												<?php $button = get_sub_field( 'button' ); ?>
												<?php if ( $button ) { ?>
                                                    <a class='btn' href="<?php echo $button['url']; ?>"
                                                       target="<?php echo $button['target']; ?>"><?php echo $button['title']; ?></a>
												<?php } ?>
											<?php endwhile; ?>
                                        </div>
									<?php endif; ?>
                                </div>

								<?php if ( $background_credit ): ?>
                                    <span class="photo-credit">
            <?php echo $background_credit; ?>
        </span>
								<?php endif; ?>
                            </div>

                        </div>
                    </section>
				<?php endwhile; ?>
			<?php endif; ?>
        </article><!-- #post-## -->

	<?php
	endwhile; // End of the loop.
?>


<?php
	get_footer();
