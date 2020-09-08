<?php
	/**
	 * Template part for displaying a Split callout.
	 */
?>
<section class="block split_callout">
    <div class="outer-block-wrapper"> <!-- extend with needed container -->
        <div class="inner-block-wrapper"> <!-- probably extend with row or -->


			<?php
				if ( have_rows( 'sections' ) ) :
					while ( have_rows( 'sections' ) ) : the_row();
						$background_image = get_sub_field( 'background_image' );
						$background_url   = $background_image['url'];
						$heading          = get_sub_field( 'heading' );
						$copy             = get_sub_field( 'copy' );
						?>
                        <div class="hover-section">
                            <span class="big-heading"><?php echo $heading; ?></span>
                            <div class="hover-contents">
								<?php if ( $heading ) { ?>
                                    <h2 class="heading"><?php echo $heading; ?></h2>

								<?php } ?>


								<?php if ( $copy ) { ?>
                                    <div class="copy">
										<?php echo $copy; ?>
                                    </div>
								<?php } ?>

								<?php
									if ( have_rows( 'buttons' ) ) : ?>
                                        <div class="buttons">
											<?php while ( have_rows( 'buttons' ) ) : the_row(); ?>
												<?php $link_text = get_sub_field( 'link_&text' ); ?>
												<?php if ( $link_text ) { ?>
                                                    <a class="btn-<?php the_sub_field( 'button_style' ); ?>"
                                                       href="<?php echo $link_text['url']; ?>"
                                                       target="<?php echo $link_text['target']; ?>"><?php echo $link_text['title']; ?></a>
												<?php } ?>

											<?php endwhile; ?>

                                        </div>
									<?php endif; ?>
                            </div>
							<?php if ( $background_url ) { ?>
                                <div class="hover-background" style="
                                        background: url(<?php echo $background_url; ?>);
                                        background-size: cover;
                                        background-position: center center;
                                        background-repeat: no-repeat; ">
                                </div>
							<?php } ?>

                        </div>
					<?php endwhile; ?>

				<?php endif; ?>
        </div>
    </div>
</section>