<?php
/**
	 * Template part for displaying posts
	 *
	 * @link https://codex.wordpress.org/Template_Hierarchy
	 *
	 * @package ch2
	 */

?><article id="post-<?php the_ID(); ?>" <?php post_class();
?>>




        </div><a class='' href="<?php the_permalink(); ?>">
            <h1 class='content title'><?php the_title();
?></h1>
        </a>
        <div class="post-meta"><span class=" author
">
                <?php the_author();
?></span><?php $prime_cat=get_primary_category();
?><span class="category"><?php echo $prime_cat['title'];
?></span></span><span class="date"><?php echo get_the_date('M d, Y');
?></span></div>

        <div class="outer-block-wrapper">
            <div class="inner-block-wrapper">
                <div class="post-content content"><?php the_content();

?></div>
            </div>
        </div>
        <div class="outer-block-wrapper">
            <div class="inner-block-wrapper">
                <div class='post-footer content'>
                    <div class="tags"><?php if(get_the_tag_list()) {
    echo get_the_tag_list('<ul><li>', '</li><li>', '</li></ul>');
}

?></div>
                    <div class="author-box">
                        <div class="author-thumbnail"><?php echo get_avatar(get_the_author_meta('ID'), 175);
?></div>
                        <div class="author-info">
                            <p class="author-name">
                                <?php
the_author_firstname(  );
                                ?>
                            </p>
                            <div class="author-bio">
                                <?php the_author_description(  get_the_author_ID(  )); ?>
                            </div>


                            <div class="author-archive">
                                <a
                                    href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">View
                                    All Posts By <?php the_author(); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                  <?php the_post_navigation();
?>
                </div>
            </div>
        </div>
    </div>
    </div>
</article>