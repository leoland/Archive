<?php
	/**
	 * Template part for displaying a Contact.
	 */
?>
<section class="block contact">
    <div class="outer-block-wrapper"> <!-- extend with needed container -->
        <div class="inner-block-wrapper"> <!-- probably extend with row or -->
            <div class="boxed-section">
				<?php if ( have_rows( 'boxed_section' ) ) : ?>
					<?php while ( have_rows( 'boxed_section' ) ) : the_row(); ?>
                        <div class="address-line">

							<?php the_sub_field( 'address' ); ?>
                        </div>
                        <div class="address-line">
							<?php the_sub_field( 'address_2' ); ?>
                        </div>

						<?php if ( have_rows( 'departments' ) ) : ?>
							<?php while ( have_rows( 'departments' ) ) : the_row(); ?>
                                <div class="department">
                                    <h2 class="heading">
										<?php the_sub_field( 'heading' ); ?>
                                    </h2>
									<?php if ( have_rows( 'numbers' ) ) : ?>
                                        <ul>
											<?php while ( have_rows( 'numbers' ) ) : the_row(); ?>
                                                <li class="<?php the_sub_field( 'type' ); ?>">
													<?php the_sub_field( 'number' ); ?>
                                                </li>
											<?php endwhile; ?>
                                        </ul>
									<?php endif; ?>

                                </div>

							<?php endwhile; ?>
						<?php endif; ?>
					<?php endwhile; ?>
				<?php endif; ?>
            </div>
            <div class="form--content">
				<?php $form_object = get_sub_field( 'contact_form' );

					if ( $form_object):
						gravity_form_enqueue_scripts( $form_object, true );
						gravity_form( $form_object, false, false, false, '', true, 1 );
						?>
					<?php endif; ?>
            </div>
        </div>
    </div>
</section>