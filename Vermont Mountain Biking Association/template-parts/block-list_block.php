<?php
	/**
	 * Template part for displaying a List block.
	 */


	$pre_heading = get_sub_field( 'pre_heading' );
	$heading     = get_sub_field( 'heading' );
	$style     = get_sub_field( 'style' );

?>
<?php if ( have_rows( 'items' ) ) : ?>


    <section class="block list_block
    style-<?php echo $style;?>
">
        <div class="outer-block-wrapper"> <!-- extend with needed container -->
            <div class="inner-block-wrapper"> <!-- probably extend with row or -->

				<?php if ( $pre_heading ): ?>
                    <h5 class=" pre-heading"> <?php echo $pre_heading ?></h5>
				<?php endif; ?>
				<?php if ( $heading ): ?>
                    <h2 class="heading"> <?php echo $heading ?></h2>
				<?php endif; ?>
                <!-- Stuff goes here -->
                <ul class="list-items">
				<?php while ( have_rows( 'items' ) ) : the_row(); ?>
                <li class="list-item"><?php the_sub_field( 'item_content' ); ?></li>

				<?php endwhile; ?>
                </ul>
            </div>
        </div>
    </section>


<?php endif; ?>