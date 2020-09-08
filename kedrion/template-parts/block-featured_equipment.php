
		<?php
        /**
        * Template part for displaying a Featured equipment.
        */
        ?>
<section class="block featured_equipment background-<?php the_sub_field( 'block_background_color' ); ?>">
    <div class="outer-block-wrapper"> <!-- extend with needed container -->
        <div class="inner-block-wrapper">
            <?php $heading = get_sub_field( 'heading' );
	        if($heading){?>
            <h1 class="block-title"><?php echo $heading;?></h1>
            <?php }
          $equipment = get_sub_field( 'equipment' ); ?>
	        <?php if ( $equipment ): ?>
            <div class="posts">
		        <?php foreach ( $equipment as $post ):  ?>
			        <?php setup_postdata ( $post ); ?>
                <div class=" featured-post">
                    <a class="thumbnail" href="<?php the_permalink(); ?>"
                       style="background-image: url('<?php the_post_thumbnail_url( 'medium' ); ?>')">
		                <?php
			                $terms = get_the_terms( get_the_ID(), 'condition' );
			                if ( $terms && ! is_wp_error( $terms ) ) :
				                foreach ( $terms as $term ) {
					                $term_id          = $term->term_id;
					                $term_id_prefixed = 'condition_' . $term_id;
					                $color            = get_field( 'label_color', $term_id_prefixed );
					                ?>
                                    <div class="label <?php echo $term->slug; ?>"
                                         style="background-color: <?php echo $color; ?>;"><?php echo $term->name; ?></div>
				                <?php } ?>


			                <?php endif; ?>
                    </a>
                    <div class="item">Item# <?php the_field( 'item' ); ?></div>
                    <a href="<?php the_permalink(); ?>"><h2
                                class="equipment-title"><?php the_title(); ?></h2></a>



                </div>
		        <?php endforeach; ?>
		        <?php wp_reset_postdata(); ?>
            </div>
	        <?php endif; ?>
<div class="buttons">
	<?php $link = get_sub_field( 'button_link' ); ?>
	<?php if ( $link ) { ?>
        <a class="btn-default"
           href="<?php echo $link['url']; ?>"
           target="<?php echo $link['target']; ?>"><?php echo $link['title']; ?></a>
	<?php } ?>
</div>




            <!--End Related Posts-->
        </div>
    </div>
</section>