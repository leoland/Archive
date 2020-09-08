<?php while ( have_posts() ): the_post(); ?>
	<?php if ( has_term( 'trails', 'poi_type' ) ) : ?>
        <a class='single-poi single-plan_your_ride trails' href="<?php the_permalink(); ?>">
            <div class="thumbnail"
				<?php
					if ( has_post_thumbnail() ) { ?>
                        style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');"
					<?php } else { ?>
                        style="background-image: url('<?php echo get_the_post_thumbnail_url( '117' ); ?>');"
					<?php } ?>
            >
                <div class="poi-icons">
					<?php
						$terms = get_the_terms( get_the_ID(), 'poi_type' );

						if ( $terms && ! is_wp_error( $terms ) ) :


							foreach (
								$terms

								as $term
							) {
								?><span class="poi-icon"> <?php
								// image id is stored as term meta
								$image_id = get_term_meta( $term->term_id, 'image', true );

								// image data stored in array, second argument is which image size to retrieve
								$image_data = wp_get_attachment_image_src( $image_id, 'full' );

								// image url is the first item in the array (aka 0)
								$image = $image_data[0];

								if ( ! empty( $image ) ) {
									echo '<img src="' . esc_url( $image ) . '" />';
								}
								?></span><?php
							}

						endif; ?>
                </div>
            </div>

            <div class="poi-meta">
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
            <h3><?php the_title(); ?></h3>

        </a>
	<?php endif; ?>
<?php endwhile; ?>
<?php while ( have_posts() ): the_post(); ?>
	<?php if ( ! ( has_term( 'trails', 'poi_type' ) ) ) : ?>
        <a class='single-plan_your_ride single-poi no-trails' href="<?php the_permalink(); ?>">
            <div class="thumbnail"
				<?php
					if ( has_post_thumbnail() ) { ?>
                        style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');"
					<?php } else { ?>
                        style="background-image: url('<?php echo get_the_post_thumbnail_url( '117' ); ?>');"
					<?php } ?>
            >
                <div class="poi-icons">
					<?php
						$terms = get_the_terms( get_the_ID(), 'poi_type' );

						if ( $terms && ! is_wp_error( $terms ) ) :


							foreach (
								$terms

								as $term
							) {
								?><span class="poi-icon"> <?php
								// image id is stored as term meta
								$image_id = get_term_meta( $term->term_id, 'image', true );

								// image data stored in array, second argument is which image size to retrieve
								$image_data = wp_get_attachment_image_src( $image_id, 'full' );

								// image url is the first item in the array (aka 0)
								$image = $image_data[0];

								if ( ! empty( $image ) ) {
									echo '<img src="' . esc_url( $image ) . '" />';
								}
								?></span><?php
							}

						endif; ?>
                </div>
            </div>

            <div class="poi-meta">
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
            <h3><?php the_title(); ?></h3>

        </a>
	<?php endif; ?>
<?php endwhile; ?>