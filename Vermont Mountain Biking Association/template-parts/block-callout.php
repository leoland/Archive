<?php
	/**
	 * Template part for displaying a callout.
	 */


	/*
	* Helper classes
	*/
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
							<?php $button_style= get_sub_field( 'button_style' ); ?>
							<?php if ( $button ) { ?>
                                <a class='
                                <?php if ($button_style){
	                                echo $button_style;
                                }
                                else {
                                    echo 'btn';

                                }?>' href="<?php echo $button['url']; ?>"
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