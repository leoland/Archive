<?php
	/**
	 * Template part for displaying a Two columns.
	 */


	wp_enqueue_script( 'match-height', get_template_directory_uri() . '/assets/js/jquery.matchHeight-min.js', array( jquery ), '', true );

	$style   = get_sub_field( 'background' );
	$heading = get_sub_field( 'block_heading' );
	if ( have_rows( 'columns' ) ) :
	$combo = '';
	while ( have_rows( 'columns' ) ) : the_row();
		if ( $combo == '' ) {
			$combo = get_sub_field( 'column_style' );
		} else {
			$combo .= '-' . get_sub_field( 'column_style' );
		}
	endwhile;

?>
<section
        class="block two_columns style-<?php echo $style; ?> <?php echo $combo; ?>">
    <div class="outer-block-wrapper"> <!-- extend with needed container -->
        <div class="inner-block-wrapper"> <!-- extended with .row -->
            <!-- Stuff goes here -->

            <!--follow this pattern for fields, that way their space is not allocated if the field is empty and we do not have weird empty markup everywhere-->

			<?php if ( $heading ): ?>
                <h2 class="heading"><?php echo $heading ?></h2>
			<?php endif; ?>


            <div class="two_columns--content <?php echo $combo; ?>">
				<?php while ( have_rows( 'columns' ) ) : the_row();
					$col_heading = get_sub_field( 'column_heading_optional' );
					$copy        = get_sub_field( 'copy' );
					$image       = get_sub_field( 'image' );
					$style       = get_sub_field( 'column_style' );
					?>
                    <div class="col col-sm-6 <?php echo $style ?>">
						<?php if ( 'boxed' === $style ) : ?>
                        <div class="box-wrapper">
							<?php endif; ?>



							<?php if ( ( ( 'general' ) === $style ) || ( ( 'boxed' ) === $style ) ) : ?>
								<?php if ( $col_heading ): ?>
                                    <h3 class="col-heading"><?php echo $col_heading; ?></h3>
								<?php endif; ?>
							<?php endif; ?>

							<?php if ( ( ( 'general' ) === $style ) || ( ( 'boxed' ) === $style ) ) : ?>
								<?php if ( $copy ) : ?>
                                    <div class="copy">
										<?php echo $copy; ?>
                                    </div>
								<?php endif; ?>
							<?php endif; ?>


							<?php if ( ( $image ) && ( 'image' == $style ) ): ?>
                                <div class="image-container"
                                     style="background-image: url(<?php echo $image['url']; ?>)">
                                </div>
							<?php endif; ?>


							<?php if ( have_rows( 'logos' ) ) : ?>
                                <div class="logos-wrapper ">
									<?php while ( have_rows( 'logos' ) ) : the_row();
										$link = get_sub_field( 'link' );
										$logo = get_sub_field( 'logo' );
										?>


                                        <a class="logo limit-<?php echo $limit; ?>" <?php if ( $link ) { ?>
                                            href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"
										<?php } ?>
                                        >
											<?php if ( $logo ) { ?>
                                                <div class="image-wrapper" style="
                                                        background-image: url(<?php echo $logo['url']; ?>);
                                                        ">
                                                    <!-- <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>"/>-->
                                                </div>
											<?php } ?>
                                        </a>
									<?php endwhile; ?>
                                </div>
							<?php endif; ?>

							<?php if ( 'image' != $style ): ?>
								<?php if ( have_rows( 'buttons' ) ) : ?>
                                    <div class="buttons">
										<?php while ( have_rows( 'buttons' ) ) : the_row(); ?>
											<?php $button = get_sub_field( 'button' ); ?>
											<?php $button_style = get_sub_field( 'button_style' ); ?>
											<?php if ( $button ) { ?>

                                                <a class='<?php if ( $button_style ) {
													echo $button_style;
												} else {
													echo 'btn-default';
												} ?>' href="<?php echo $button['url']; ?>"
                                                   target="<?php echo $button['target']; ?>"><?php echo $button['title']; ?></a>
											<?php } ?>
										<?php endwhile; ?>
                                    </div>
								<?php endif; ?>
							<?php endif; ?>

							<?php if ( 'boxed' === $style ) : ?>
                        </div>
					<?php endif; ?>

                    </div>
				<?php endwhile; ?>
				<?php endif; ?>
            </div>
        </div>

        <script>
            jQuery(function () {
                jQuery('.col').matchHeight(
                    {
                        byRow: true,
                        property: 'height',
                    });
                jQuery('.copy').matchHeight(
                    {
                        byRow: true,
                        property: 'height',
                    });
                jQuery('.col-heading').matchHeight(
                    {
                        byRow: true,
                        property: 'height',
                    });
            });

        </script>
</section>



