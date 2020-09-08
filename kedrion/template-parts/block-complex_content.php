<?php
	/**
	 * Template part for displaying a Complex content.
	 */
?>
<section class="block complex_content">
    <div class="outer-block-wrapper"> <!-- extend with needed container -->
        <div class="inner-block-wrapper"> <!-- probably extend with row or -->
            <!-- Stuff goes here -->


			<?php if ( have_rows( 'geometric_box' ) ) : ?>

				<?php while ( have_rows( 'geometric_box' ) ) : the_row(); ?>
                    <div class="geometric-box  <?php the_sub_field( 'accent_color' ); ?>">
						<?php $optional_logo = get_sub_field( 'optional_logo' ); ?>
						<?php if ( $optional_logo ) { ?>
                            <div class="logo-area">
                                <img src="<?php echo $optional_logo['url']; ?>"
                                     alt="<?php echo $optional_logo['alt']; ?>"/>
                            </div>
						<?php }

							$geo_heading = get_sub_field( 'heading' );
							$geo_copy    = get_sub_field( 'copy' );
							if ( $geo_heading ) { ?>
                                <h2 class="geo__heading">
									<?php echo $geo_heading; ?>
                                </h2>
							<?php }

							if ( $geo_copy ) { ?>
                                <div class="geo__copy">
									<?php echo $geo_copy; ?>
                                </div>
							<?php } ?>


                    </div>
				<?php endwhile; ?>

			<?php endif; ?>

			<?php if ( have_rows( 'factoids' ) ) : ?>
                <div class="factoids">
					<?php while ( have_rows( 'factoids' ) ) : the_row(); ?>
                        <div class="factoids__factoid">
							<?php $icon           = get_sub_field( 'icon' );
								$factoid__heading = get_sub_field( 'factoid_heading' );
								$factoid__copy    = get_sub_field( 'text' );
								if ( $icon ) { ?>
                                    <div class="factoid__image">
                                        <img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>"/>
                                    </div>
								<?php } ?>
                            <div class="factoid__content">


								<?php if ( $factoid__heading ) { ?>
                                    <h3><?php echo $factoid__heading ?></h3>
								<?php } ?>
								<?php if ( $factoid__copy ) { ?>
                                    <div class="factoid__copy"><?php echo $factoid__copy ?></div>
								<?php } ?>


                            </div>


                        </div>
					<?php endwhile; ?>
                </div>
			<?php endif; ?>

			<?php $main_copy = get_sub_field( 'main_copy' ); ?>
			<?php if ( $main_copy ): ?>
                <div class="main-copy">
					<?php echo $main_copy; ?>
                </div>
			<?php endif; ?>







			<?php $featured_content = get_sub_field( 'featured_content' ); ?>
			<?php $featured_content_heading = get_sub_field( 'featured_content_heading' ); ?>
			<?php if ( $featured_content ): ?>
                <div class="featured-content">
					<?php if ( $featured_content_heading ) { ?>
                        <h3><?php echo $featured_content_heading; ?></h3>
					<?php } ?>

					<?php foreach ( $featured_content as $post ): ?>
						<?php setup_postdata( $post ); ?>
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					<?php endforeach; ?>
					<?php wp_reset_postdata(); ?>
                </div>
			<?php endif; ?>


        </div>
    </div>
</section>