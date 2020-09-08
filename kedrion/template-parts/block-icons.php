<?php
/**
 * Template part for displaying a Icons.
 */
wp_enqueue_script('match-height', get_template_directory_uri() . '/assets/js/jquery.matchHeight.js', 'jquery', '', false);

$block_heading = get_sub_field('block_heading');
$block_copy = get_sub_field('block_copy');?>


<section class="block icons <?php the_sub_field('block_background_color');?>">
    <div class="outer-block-wrapper">
        <!-- extend with needed container -->
        <div class="inner-block-wrapper">
            <!-- probably extend with row or -->
            <!-- Stuff goes here -->
            <?php if ($block_heading) {?>
            <h1 class="icons__heading"><?php echo $block_heading; ?></h1>
            <?php }?>
            <?php if ($block_copy) {?>
            <div class="icons__copy block__copy"><?php echo $block_copy; ?></div>
            <?php }?>

            <?php if (have_rows('icons')): ?>
            <div class="icons-wrapper">
                <?php while (have_rows('icons')): the_row();?>
                <?php $link = get_sub_field('link');?>

                <div class="icon-single">
                    <div class="icon-inner">
                        <?php if ($link) {?>
                        <a class="" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">
                            <?php }?>
                            <?php $icon = get_sub_field('icon');?>
                            <?php if ($icon) {?>
                            <div class="icon-image">
                                <img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>" />
                            </div>
                            <?php }?>
                            <h3><?php the_sub_field('heading');?></h3>
                            <div class="icon icon__text">


                                <?php the_sub_field('text');?>
                            </div>
                            <?php if ($link) {?>



                            <button class="btn"><?php echo $link['title']; ?>
                            </button>
                        </a>

                        <?php }?>

                    </div>
                </div>


                <?php
endwhile;?>
            </div>
            <?php endif;?>

        </div>
    </div>
    <script>
    jQuery(function() {
        jQuery('.icon-inner').matchHeight({
            property: 'height',
            byRow: false,
        });
    });
    </script>
</section>