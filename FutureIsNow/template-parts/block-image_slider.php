<?php
	/**
	 * Template part for displaying a Image slider.
	 */

?>

<section
        class="block image_slider default background-<?php the_sub_field( 'block_background_color' ); ?>">
    <div class="outer-block-wrapper"> <!-- extend with needed container -->
        <div class="inner-block-wrapper"> <!-- probably extend with row or -->
            <div class="images-wrapper">
                <div class="image-slider">
					<?php
						if ( have_rows( 'images' ) ) :
							while ( have_rows( 'images' ) ) : the_row();
								$slider_image = get_sub_field( 'image' );
								if ( $slider_image ) { ?>
                                    <div class="slide-wrapper">
                                        <div class="slide-image"
                                             style="background-image: url('<?php echo wp_get_attachment_image_url( $slider_image['ID'], 'slider' ); ?>')">

                                        </div>
                                    </div>
									<?php
								}
							endwhile;
						endif; ?>

                </div>
				<?php if ( have_rows( 'images' ) ) : ?>
                    <div class="image-thumbs">
                        <?php

							while ( have_rows( 'images' ) ) : the_row();
								$slider_image = get_sub_field( 'image' );

								if ( $slider_image ) {
									echo wp_get_attachment_image( $slider_image['ID'], 'thumbnail' );
								}
							endwhile;
						?>
                    </div>

				<?php endif; ?>
            </div>
        </div>
    </div>
</section>



