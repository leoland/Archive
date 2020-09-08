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
			<div class="intro-copy">
				<?php the_sub_field( 'intro_copy' ); ?>
			</div>
			<?php $post_objects = get_sub_field('featured_posts');?>
			<?php if ($post_objects): ?>
			<div class="post-thumbnails">
				<?php foreach ($post_objects as $post): ?>
				<?php setup_postdata($post);

?>
				<div class="outer-post-wrapper">



					<div class="post-thumbnail"
						style="background-color: gray; background-image: url('<?php echo get_the_post_thumbnail_url( ); ?>');">
					</div>

					<?php
//$post = get_post();
?>
					<div class="post-content">
						<a class='title' href="<?php the_field( 'original_post_url' ); ?>"><?php the_title();?></a>
						<div class="excerpt">
							<?php the_excerpt(  ); ?>
						</div>


						<a class='read-more' href="<?php  the_field( 'original_post_url' ); ?>">Read More</a>




					</div>

				</div>
				<?php endforeach;?>
				<?php wp_reset_postdata();?>
			</div>

			<?php endif;?>
		</div>
	</div>
</section>