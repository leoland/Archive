<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ch2
 */

get_header();

wp_enqueue_script('match-height', get_template_directory_uri() . '/assets/js/jquery.matchHeight.js', 'jquery', '', false);

?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">


        <?php

$post_types = array('case_study', 'team_member');

if ((!is_post_type_archive($post_types))) {?>

        <header class="page-header">
            <div class="outer-block-wrapper">
                <div class="inner-block-wrapper"><?php if (is_home()) {
    ?>
                    <h1 class="blog--title"><?php echo get_the_title(get_option('page_for_posts', true)); ?>
                    </h1><?php
} else {
    the_archive_title('<h1 class="archive--title">', '</h1>');
}

    ?>
                    <div class="page-description content">
                        <?php //todo taxonomy conditional
    $description = term_description();

    if ($description) {
        echo $description;
    } elseif (is_author()) {
        echo get_the_author_description();

    } else {
        the_field('intro_text', 'option');

    }

    ?>
                    </div>
                    <?php if (is_author()) {?>
                    <p class='back-link'> <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>">Return
                            to
                            all Posts</a> </p>
                    <?php
} else {
        ?>

                    <div class="blog__categories"><?php $args = array('show_count' => 0,
            'orderby' => 'name',
            'exclude' => '1',
            'show_option_all' => __('None'),
            'style' => 'list',
            'hierarchical' => 1,
            'title_li' => null,
            'taxonomy' => 'category',
            'walker' => null);?><input type="checkbox" id="checkbox_toggle"><label class="categories__label"
                            for="checkbox_toggle"><span><?php if (is_category()) {
            single_cat_title();
        } else {
            echo "Select Category";
        }?></span></label>
                        <ul><?php wp_list_categories($args);?>
                        </ul>
                    </div>

                    <?php
}?>
                </div>
            </div>
        </header>

        <?php }
?>



        <?php if (is_post_type_archive('case_study')): ?>




        <?php $hero_image = get_field('hero_image', 'cpt_case_study');?>




        <section class="block hero case-studies simple-hero <?php echo $post_type; ?>">
            <div class="hero__main" style="
<?php if ($hero_image) {?>
	background: url(<?php echo $hero_image['url']; ?>) ;
<?php }?>">
                <div class="outer-block-wrapper">
                    <div class="inner-block-wrapper">

                        <h1 class="hero--title">Case Studies</h1>

                    </div>
                </div>
            </div>



        </section>



        <div class="outer-block-wrapper">
            <div class="inner-block-wrapper">

                <section class="case-studies-intro">
                    <?php the_field('intro_text', 'cpt_case_study');?>

                </section>


            </div>
        </div>







        <?php endif;?>

        <div class="block posts-container">
            <div class="outer-block-wrapper">
                <div class="inner-block-wrapper">

                    <?php if (have_posts()):

    while (have_posts()): the_post();

        get_template_part('template-parts/content', 'archive');

    endwhile;
    ?>
                </div>
            </div>
        </div>


        <?php the_posts_pagination(array(
        'mid_size' => 2,
        'prev_text' => __('Prev Page'),
        'next_text' => __('Next Page'),
    ));

else:get_template_part('template-parts/content', 'none');

endif;
?>
    </main>

    <script>
    jQuery(function() {
        jQuery('.title-area-content').matchHeight({
            property: 'height',
            byRow: false,
        });
    });
    </script>

</div><?php get_footer();