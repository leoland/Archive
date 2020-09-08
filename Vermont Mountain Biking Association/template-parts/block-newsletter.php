
		<?php
        /**
        * Template part for displaying a Newsletter.
        */

        $form             = get_sub_field( 'form' );

        ?>
<section class="block newsletter">
    <div class="outer-block-wrapper"> <!-- extend with needed container -->
        <div class="inner-block-wrapper"> <!-- probably extend with row or -->
            <h3><?php the_sub_field( 'heading' ); ?></h3>
            <div class="form">
		        <?php gravity_form( $form['id'], false, false, false, '', true, 0 ); ?>
            </div>
        </div>
    </div>
</section>