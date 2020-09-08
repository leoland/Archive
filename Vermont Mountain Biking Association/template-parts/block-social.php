
		<?php
        /**
        * Template part for displaying a Social.
        */
        $heading = get_sub_field( 'heading' ); ?>
<section class="block social">
    <div class="outer-block-wrapper"> <!-- extend with needed container -->
        <div class="inner-block-wrapper"> <!-- probably extend with row or -->
        <?php if ($heading){?>
            <h2 class="heading">
                <?php echo $heading; ?>
            </h2>
            <?php }?>
            <div class="social-links">
		        <?php while ( have_rows( 'social_links' ) ) : the_row(); ?>
                    <a href="<?php the_sub_field( 'link'); ?>"
                       target="_blank"><?php the_sub_field( 'icon' ); ?></a>
		        <?php endwhile; ?>
            </div>
        </div>
    </div>
</section>