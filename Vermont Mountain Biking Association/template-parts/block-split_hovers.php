<?php
	/**
	 * Template part for displaying a Split hovers.
	 */
?>

<?php if ( have_rows( 'sections' ) ) :
    wp_enqueue_script( 'match-height', get_template_directory_uri() . '/assets/js/jquery.matchHeight-min.js', array( jquery ), '', false );
	?>
    <section class="block split_hovers">
        <div class="outer-block-wrapper">
            <div class="inner-block-wrapper">
				<?php while ( have_rows( 'sections' ) ) : the_row();
					$background        = get_sub_field( 'background' );
					$background_url    = $background['url'];
					$background_credit = get_post_meta( $background['ID'], 'ch2_the_photo_credit', true );
					$heading           = get_sub_field( 'heading' );
					$copy              = get_sub_field( 'copy' );
					$button            = get_sub_field( 'button' ); ?>

                    <div class="hover-section">
						<?php if ( $heading ) { ?>
                            <h2 class="heading"><?php echo $heading; ?></h2>
                        <?php } ?>
                        <?php if ( $heading ) { ?>
                            <h2 class="big-heading"><?php echo $heading; ?></h2>
                        <?php } ?>


                        <?php if ( $copy ) { ?>
                            <div class="copy">
	                            <?php echo $copy; ?>
                            </div>
                        <?php } ?>

						<?php if ( $button ) { ?>
                            <a class='button btn-alt-o' href="<?php echo $button['url']; ?>"
                               target="<?php echo $button['target']; ?>"><?php echo $button['title']; ?></a>
						<?php } ?>
						<?php if ( $background_credit ): ?>
                            <span class="photo-credit">
            <?php echo $background_credit; ?>
        </span>
						<?php endif; ?>
                    </div>
					<?php if ( $background ) { ?>
                        <div class="hover-background" style="
                                background: url(<?php echo $background['url']; ?>);
                                background-size: cover;
                                backgorund-position: center center;
                                background-repeat: no-repeat; ">
                        </div>
					<?php } ?>

				<?php endwhile; ?>
            </div>
        </div>
        <script>
            jQuery(function () {
                jQuery('.hover-section').matchHeight(
                    {
                        byRow: false,
                        property: 'height',
                    });
            });
        </script>
    </section>


<?php else : ?>
	<?php echo '¯\_(ツ)_/¯'; ?>
<?php endif; ?>
