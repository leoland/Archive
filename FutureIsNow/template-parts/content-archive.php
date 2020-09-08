<?php
/**
 * Template part for displaying posts (individual posts)
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ch2
 */

?>



<?php if (is_post_type_archive('case_study')): ?>


<?php $thumbnail_image = get_field('thumbnail_image');?>
<article class="outer-post-wrapper">


	<a class="title-area-wrapper" href="<?php the_permalink();?>" style=" background-image:
        url(<?php echo $thumbnail_image['url']; ?> )">





		<div class="title-area-content">

			<h3><?php the_title();
?></h3>


			<?php
$args = array('orderby' => 'name', 'order' => 'asc', 'fields' => 'all');

// $terms = get_the_terms(get_the_ID(), 'cs_categories');
$terms = wp_get_post_terms(get_the_ID(), 'cs_categories', $args);

?>
			<ul class='term-list'>

				<?php
foreach ($terms as $term) {?>
				<li>
					<?php echo $term->name; ?>
				</li>
				<?php

}

?>



			</ul>


		</div>



	</a>
	<div class="post-summary">
		<?php the_excerpt();?>
	</div>


	<a class='title' href="<?php the_permalink();?>">
		View <?php the_field('short_title');?> Case Study >
	</a>
</article>


<?php else: ?>

<div class="outer-post-wrapper content">
	<div class="post-thumbnail"><?php the_post_thumbnail();
?><div class="logo-icon"></div>
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

</div>


<?php endif;?>