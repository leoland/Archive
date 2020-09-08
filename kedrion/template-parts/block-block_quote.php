<?php
/**
 * Template part for displaying a Block quote.
 */
?>
<section class="block block_quote">
    <div class="outer-block-wrapper">
        <div class="inner-block-wrapper">
            <?php $image = get_sub_field('image');?>
            <?php if ($image) {
    $class = ' has-image';?>

            <?php }?>
            <div class="quote-wrapper <?php echo $class; ?> ">
                <?php if ($image) {?>
                <div class="quote-image">
                    <img src="<?php echo $image['url']; ?>" alt="">
                </div> <?php }?>
                <div class="inner-wrapper">
   <div class="block_quote__copy">
                    <?php the_sub_field('quote_copy');?>
                </div>
                <div class="block_quote__source">
                    <?php the_sub_field('source');?>
                </div>
                </div>

            </div>
        </div>
    </div>



</section>