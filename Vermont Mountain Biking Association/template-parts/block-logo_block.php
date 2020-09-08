<?php
	/**
	 * Template part for displaying a Logo block.
	 */


	$style         = get_sub_field( 'style' );
	$heading       = get_sub_field( 'heading' );
	$heading_color = get_sub_field( 'heading_color' );
	$copy          = get_sub_field( 'copy' );
	$limit         = get_sub_field( 'row_limit' );

	$topo              = get_sub_field( 'topo' );
?>
<section
        class="block logo_block
        style-<?php echo $style; ?>
        topo-<?php echo $topo; ?>
">
    <div class="outer-block-wrapper"> <!-- extend with needed container -->
        <div class="inner-block-wrapper"> <!-- probably extend with row or -->
            <!-- Stuff goes here -->
            <div class="logo_block--content">
                <!--follow this pattern for fields, that way their space is not allocated if the field is empty and we do not have weird empty markup everywhere-->

				<?php if ( $heading ): ?>
                    <h3 class="heading
       heading-style-<?php echo $heading_color; ?>"> <?php echo $heading ?></h3>
				<?php endif; ?>
				<?php if ( $copy ): ?>
                    <div class="copy"> <?php echo $copy ?></div>
				<?php endif; ?>

				<?php if ( have_rows( 'logos' ) ) : ?>
                    <div class="logos-wrapper limit-<?php echo $limit; ?>">
						<?php while ( have_rows( 'logos' ) ) : the_row();
							$link = get_sub_field( 'link' );
							$logo = get_sub_field( 'logo' );
							?>


                            <a class="logo " <?php if ( $link ) { ?>
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

				<?php if ( have_rows( 'buttons' ) ) : ?>
                    <div class="buttons">
						<?php while ( have_rows( 'buttons' ) ) : the_row(); ?>
							<?php $button = get_sub_field( 'button' ); ?>
							<?php $button_style = get_sub_field( 'button_style' ); ?>
							<?php if ( $button ) { ?>

                                <a class='<?php if ( $button_style ) {
									echo $button_style;
								}
								else {echo'btn-default';}?>' href="<?php echo $button['url']; ?>"
                                   target="<?php echo $button['target']; ?>"><?php echo $button['title']; ?></a>
							<?php } ?>
						<?php endwhile; ?>
                    </div>
				<?php endif; ?>

            </div>
        </div>
    </div>
</section>