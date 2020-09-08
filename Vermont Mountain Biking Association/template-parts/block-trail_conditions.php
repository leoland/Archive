
		<?php
        /**
        * Template part for displaying a Tral conditions.
        */
        ?>
<section class="block tral_conditions">
    <div class="outer-block-wrapper"> <!-- extend with needed container -->
        <div class="inner-block-wrapper"> <!-- probably extend with row or -->
            <!-- Stuff goes here -->
	        <?php if ( have_rows( 'Sources' ) ) : ?>
                <div class="sources">
		        <?php while ( have_rows( 'Sources' ) ) : the_row(); ?>
                    <div class="source">
                    <iframe allowfullscreen="" width='100%' frameborder="0" src="  <?php the_sub_field( 'source_url' ); ?>"></iframe>
                    </div>
		        <?php endwhile; ?>
                </div>
	        <?php endif; ?>
        </div>
    </div>
</section>