<?php
	/**
	 * Template part for displaying a Contact block.
	 */

	$style            = get_sub_field( 'style' );
	$type             = get_sub_field( 'content_type' );
	$order            = get_sub_field( 'order' );
	$heading          = get_sub_field( 'heading' );
	$copy             = get_sub_field( 'text' );
	$form             = get_sub_field( 'form' );
	$background_image = get_sub_field( 'background_image' );


?>
<section class="block contact_block style-<?php echo $style; ?> type-<?php echo $type; ?> order-<?php echo $order; ?> "
	<?php if ( ( $background_image ) && ( '3' == $style ) ) { ?>
        style="background: linear-gradient(to right, rgba(0, 48, 62, .9), rgba(0, 48, 62, .9)),   url(<?php echo $background_image['url']; ?>); background-position: center center;
                background-size: cover;
                background-repeat: no-repeat;"
	<?php } ?>>

    <div class="outer-block-wrapper"> <!-- extend with needed container -->
        <div class="inner-block-wrapper"> <!-- probably extend with row or -->
			<?php if ( 'general' == $type ): ?>
                <div class="general">
                    <h2 class="heading"><?php echo $heading; ?> </h2>
                    <div class="copy">
						<?php echo $copy; ?>
                    </div>
                </div>
			<?php endif; ?>
			<?php if ( 'form' == $type ): ?>
                <div class="form">
					<?php gravity_form( $form['id'], false, false, false, '', true, 0 ); ?>
                </div>
			<?php endif; ?>
			<?php if ( have_rows( 'icon_list' ) ) : ?>
                <div class="icons">
					<?php while ( have_rows( 'icon_list' ) ) : the_row(); ?>
                        <div class="contact-icon">

							<?php $icon = get_sub_field( 'icon' ); ?>
							<?php if ( $icon ) { ?>
                                <div class="icon-image">
                                    <img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>"/>
                                </div>
							<?php } ?>
                            <div class="icon-copy">
								<?php the_sub_field( 'copy' ); ?>
                            </div>
                        </div>
					<?php endwhile; ?>
                </div>
			<?php endif; ?>


            <!-- Stuff goes here -->
        </div>
    </div>
</section>