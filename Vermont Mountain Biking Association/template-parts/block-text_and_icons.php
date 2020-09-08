<?php
	/**
	 * Template part for displaying a Text and icons.
	 */


	wp_enqueue_script( 'match-height', get_template_directory_uri() . '/assets/js/jquery.matchHeight-min.js', array( jquery ), '', false );
	$style       = get_sub_field( 'style' );
	$topo        = get_sub_field( 'topo' );
	$pre_heading = get_sub_field( 'pre_heading' );
	$heading     = get_sub_field( 'heading' );


?>
<section
        class="block text_and_icons  style-<?php echo $style; ?>
        topo-<?php echo $topo; ?>">
    <div class="outer-block-wrapper"> <!-- extend with needed container -->
        <div class="inner-block-wrapper"> <!-- probably extend with row or -->
            <!-- Stuff goes here -->
            <div class="text_and_icons--content">
                <!--follow this pattern for fields, that way their space is not allocated if the field is empty and we do not have weird empty markup everywhere-->

				<?php if ( $pre_heading ): ?>
                    <h5 class="callout--pre-heading pre-heading"> <?php echo $pre_heading ?></h5>
				<?php endif; ?>
				<?php if ( $heading ): ?>
                    <h2 class="callout--title heading"> <?php echo $heading ?></h2>
				<?php endif; ?>


				<?php if ( have_rows( 'icons' ) ) : ?>
                    <?php
					$hey = get_field('icons');
					$hay = get_sub_field('icons');
					echo $hey;
					echo $hay;
                    ?>
                    <div class="icons-wrapper">
						<?php while ( have_rows( 'icons' ) ) : the_row(); ?>
							<?php $image = get_sub_field( 'image' );
							$label       = get_sub_field( 'icon_label' );
							$copy        = get_sub_field( 'icon_copy' );
							$link        = get_sub_field( 'link' ); ?>
                            <div class="icon-outer-wrapper
<?php if ( $link ): ?>
                                    has-link
                    <?php endif; ?>
">
								<?php if ( $link ): ?>
                                    <a
                                    href="<?php echo $link['url']; ?>"
                                    target="<?php echo $link['target']; ?>"
                                    title="<?php echo $link['title']; ?>"
                                    >
								<?php endif; ?>
								<?php if ( $image ) { ?>
                                    <div class="icon-img-wrapper">
                                        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
                                    </div>
								<?php }
									if ( $label ): ?>
                                        <h3 class="icon-label"><?php echo $label; ?></h3>
									<?php endif;
									if ( $copy ): ?>
                                        <div class="icon-copy"><?php echo $copy; ?></div>
									<?php endif; ?>
	                                    <?php if ( $link ): ?>
                                        </a>
		                                    <?php endif; ?>

                            </div>
						<?php endwhile; ?>
                    </div>
				<?php else : ?>
					<?php // no rows found ?>
				<?php endif; ?>

            </div>
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
    </div>
    <script>
        jQuery(function () {
            jQuery('.icon-img-wrapper').matchHeight(
                {
                    property: 'height',
                });
        });
    </script>
</section>