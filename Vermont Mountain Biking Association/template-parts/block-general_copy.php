<?php
/**
 * Template part for displaying a General copy.
 */

$style = get_sub_field('style');
?>
<section class="block general_copy style-<?php echo $style;?>">
    <div class="outer-block-wrapper"> <!-- extend with needed container -->
        <div class="inner-block-wrapper"> <!-- probably extend with row or -->
            <!-- Stuff goes here -->
            <div class="content">
				<?php the_sub_field( 'general_copy' ); ?>
            </div>
        </div>
    </div>
</section>