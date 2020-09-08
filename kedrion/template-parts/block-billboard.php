<?php
/**
 * Template part for displaying a Billboard.
 */
?>
<section class="block billboard">
    <?php $billboard_image = get_sub_field('billboard_image');?>
    <?php if ($billboard_image) {?>
    <img src="<?php echo $billboard_image['url']; ?>" alt="<?php echo $billboard_image['alt']; ?>" />
    <?php }?>
</section>