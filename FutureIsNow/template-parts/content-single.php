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
	<div class="page-header">
		<div class="blog__categories"><?php $args=array('show_count'=> 0,
'orderby'=> 'name',
'exclude'=> '1',
'show_option_all'=> __('None'),
'style'=> 'list',
'hierarchical'=> 1,
'title_li'=> null,
'taxonomy'=> 'category',
'walker'=> null);

?><input type="checkbox" id="checkbox_toggle"><label class="categories__label" for="checkbox_toggle"><span><?php if (is_category()) {
    single_cat_title();
}

else {
    echo "Select Category";
}

?></span></label>
			<ul><?php wp_list_categories($args);
?></ul>
		</div>
	</div>
	<div class="outer-post-wrapper">
		<div class="post-thumbnail"><?php the_post_thumbnail();
?><div class="logo-icon"></div>
		</div><a class='tit' href="<?php the_permalink(); ?>">
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

					<?php the_post_navigation();
?>
				</div>
			</div>
		</div>
	</div>
	</div>
</article>