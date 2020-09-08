<?php while ( have_posts() ): the_post();
	if ( has_post_thumbnail() ):?>
        <a data-featherlight-gallery class='single-gallery-image' href="<?php echo get_the_post_thumbnail_url('', 'xxl'); ?>">
            <div class="thumbnail" style="background-image: url('<?php echo get_the_post_thumbnail_url('', 'large'); ?>');">
            </div>
        </a>
	<?php endif;

endwhile; ?>
<script>
    jQuery(document).ready(function(){
        jQuery('.single-gallery-image').featherlightGallery();
        console.log ('fire gallery');
    });

</script>
