<?php
/**
* Template part for displaying a Two columns.
*/
?>
<section class="block featured_posts">
    <div class="outer-block-wrapper"> <!-- extend with needed container -->
        <div class="inner-block-wrapper"> <!-- probably extend with row or -->
            
			<div class="col-md-12">
				
				<?php if ( get_sub_field( 'heading' ) ) { ?>
				<h4><?php the_sub_field( 'heading' ); ?></h4>
				<?php } ?>
				
				<?php if ( have_rows( 'featured_posts' ) ) : ?>
					<div class="posts-container">
	                <?php while ( have_rows( 'featured_posts' ) ) : the_row(); ?>
	                    <?php $post_object = get_sub_field( 'featured_post' ); ?>
						<?php if ( $post_object ): ?>
							<?php $post = $post_object; ?>
							<?php setup_postdata( $post ); ?> 
							<?php get_template_part( 'template-parts/content', 'archive' ); ?>

						<?php endif; ?>
		                <?php wp_reset_postdata(); ?>
					<?php endwhile; ?>
					</div>
				<?php endif; ?>
                
			</div>

        </div>
    </div>
</section>