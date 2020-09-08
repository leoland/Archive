<?php
/**
 * Template part for displaying a Featured posts.
 */
?>
<section class="block featured_posts">
    <div class="outer-block-wrapper">
        <!-- extend with needed container -->
        <div class="inner-block-wrapper">
            <!-- probably extend with row or -->

            <?php $heading = get_sub_field('header');
if ($heading) {
    echo '<h2>' . $heading . '</h2>';
}?>
            <?php $post_objects = get_sub_field('featured_posts');?>
            <?php if ($post_objects): ?>
            <div class="post-thumbnails">
                <?php foreach ($post_objects as $post): ?>
                <?php setup_postdata($post);

?>
                <div class="outer-post-wrapper">


                    <!--
                    <div class="post-thumbnail"
                        style="background-color: gray; background-image: url('<?php echo $hero_image['url']; ?>');">

                        <ul class="cat-list">
                            <?php
$post = get_post();
$categories = get_the_category($post->ID);
foreach ($categories as $category) {
    // Define term ID
    // Replace NULL with ID of term to be queried eg '123'
    $term_id = $category->term_id;
    $category = $category->category_nicename;

    // Define taxonomy prefix
    // Replace NULL with the name of the taxonomy eg 'category'
    $taxonomy_prefix = 'category';

    // Define prefixed term ID
    $term_id_prefixed = $taxonomy_prefix . '_' . $term_id;

    if ('uncategorized' != $category) {?>
                            <li style="background-color:<?php the_field('color', $term_id_prefixed);?>">
                                <?
        echo $category; ?>
                            </li>
                            <?php
}
}
?>
                        </ul>


                </div>
	-->

                    <a class='title' href="<?php the_permalink();?>"><?php the_title();?></a>
                    <span class="author">By:
                        <?php the_author();?>
                    </span>
                    <!--<span class="date">
                        <?php echo get_the_date('M d, Y'); ?>
                    </span> -->
					<br>
                    <a class='read-more' href="<?php the_permalink();?>">Read More</a>



                </div>
                <?php endforeach;?>
                <?php wp_reset_postdata();?>
            </div>

            <?php endif;?>
            <a href="<?php echo home_url() ?>" class="btn-solid">View All Articles</a>
        </div>
    </div>
</section>