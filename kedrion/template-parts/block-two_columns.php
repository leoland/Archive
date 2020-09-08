<?php
	/**
	 * Template part for displaying a Two columns.
	 */
?>
<section
    class="block two_columns order-<?php the_sub_field( 'order' ); ?> <?php the_sub_field( 'block_style' ); ?> <?php the_sub_field( 'block_background_color' ); ?> <?php the_sub_field( 'image_placement' ); ?>">
    <div class=" outer-block-wrapper">
        <!-- extend with needed container -->
        <div class="inner-block-wrapper">
            <!-- extended with .row -->
            <?php
				$block_title    = get_sub_field( 'block_heading' );
				$block_subtitle = get_sub_field( 'block_subheading' );

				if ( $block_subtitle ){ ?>
            <h4 class="two_columns--subtitle"><?php echo $block_subtitle; ?></h4>
            <?php }

				if ( $block_title) { ?>
            <h2 class="two_columns--title"><?php echo $block_title; ?></h2>
            <?php } ?>


            <div class="columns-wrapper">
                <!-- extended with .row -->
                <?php if ( 'image-text' == get_sub_field( 'block_style' ) ): ?>
                <?php if ( have_rows( 'image_text' ) ) : ?>
                <?php while ( have_rows( 'image_text' ) ) : the_row(); ?>
                <?php $image_id = get_sub_field( 'background_image' ); ?>
                <div class="col col-image">
                    <img src="<?php echo wp_get_attachment_url( $image_id, 'large' ); ?>)" alt="">
                </div>
                <div class="col col-text">
                    <div class="inner">
                        <div class="copy">
                            <?php the_sub_field( 'column_copy' ); ?>
                        </div>


                    </div>
                </div>

                <?php endwhile; ?>
                <?php endif; ?>


                <?php elseif ( 'text-text' == get_sub_field( 'block_style' ) ): ?>

                <?php if ( have_rows( 'text_&_text' ) ) : ?>

                <?php while ( have_rows( 'text_&_text' ) ) : the_row(); ?>
                <div class="col col-text">
                    <div class="inner">

                        <div class="copy"><?php the_sub_field( 'column_copy' ); ?></div>
                        <?php if ( have_rows( 'buttons' ) ) : ?>

                        <?php endif; ?>
                    </div>
                </div>
                <div class="col col-text">
                    <div class="inner">

                        <div class="copy"> <?php the_sub_field( 'column_copy_2' ); ?></div>
                        <?php if ( have_rows( 'buttons_2' ) ) : ?>

                        <?php endif; ?>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php endif; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>