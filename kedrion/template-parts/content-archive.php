<?php
/**
 * Template part for displaying posts (individual posts)
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ch2
 */

?>
<div class="outer-post-wrapper content">
    <div class="post-thumbnail"><?php the_post_thumbnail();
?>
    </div><a class='title' href="<?php the_permalink();?>">
        <h1><?php the_title();
?></h1>
    </a>
    <div class="post-meta"><span class=" author
">
            <?php the_author();
?></span><?php $prime_cat = get_primary_category();
?><span class="category"><?php echo $prime_cat['title'];
?></span></span><span class="date"><?php echo get_the_date('M d, Y');
?></span></div>
    <div class="post-summary">
        <?php the_excerpt();?>
    </div>
    <?php
?>
</div>

