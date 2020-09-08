<?php
	/**
	 * Template part for displaying a Gallery.
	 */
?>
<section class="block gallery">
    <script>
        /*
        jQuery(document).ready(function(){
            jQuery(document).on('facetwp-refresh', function() {
                jQuery('.facetwp-template').animate({ opacity: 0 }, 0);
            });
            jQuery(document).on('facetwp-loaded', function() {
                jQuery('.facetwp-template').animate({ opacity: 1 }, 1000);
            });
        });
        */
    </script>
    <div class="outer-block-wrapper"> <!-- extend with needed container -->
        <div class="inner-block-wrapper"> <!-- probably extend with row or -->
            <!-- Stuff goes here -->
            <div class="facetwp-points_of_interest facetwp">
                <div class='facetwp-sidebar sidebar'>

					<?php
/*
						$post_type = 'image_gallery';

						// Get all the taxonomies for this post type
						$taxonomies = get_object_taxonomies( (object) array( 'post_type' => $post_type ) );

						foreach ( $taxonomies as $taxonomy ) :

							// Gets every "category" (term) in this taxonomy to get the respective posts
						echo $taxonomy;

						echo '<br>';



						endforeach;

*/
					?>
                    <div class="tax-filter">
                        <span class="label">Colors</span>
						<?php echo facetwp_display( 'facet', 'colors' ); ?>
                    </div>

                    <div class="tax-filter">
                        <span class="label">Windows</span>
						<?php echo facetwp_display( 'facet', 'windows' ); ?>
                    </div>

                    <div class="tax-filter">
                        <span class="label">Doors</span>
						<?php echo facetwp_display( 'facet', 'doors' ); ?>
                    </div>

                    <div class="tax-filter">
                        <span class="label">Exteriors</span>
						<?php echo facetwp_display( 'facet', 'exteriors' ); ?>
                    </div>
                    <div class="tax-filter">
                        <span class="label">Interiors</span>
						<?php echo facetwp_display( 'facet', 'interiors' ); ?>
                    </div>

                    <div class="tax-filter">
                        <span class="label">Grilles</span>
						<?php echo facetwp_display( 'facet', 'grilles' ); ?>
                    </div>

                    <div class="tax-filter">
                        <span class="label">Transoms</span>
						<?php echo facetwp_display( 'facet', 'transoms' ); ?>

                    </div> <div class="tax-filter">
                        <span class="label">Custom Options</span>
						<?php echo facetwp_display( 'facet', 'custom_options' ); ?>
                    </div>


                </div>
                <div class="content">
                    <div class="list">
						<?php

							echo facetwp_display( 'template', 'image_gallery' );

						?>
                    </div>
                </div>

            </div>
        </div>
    </div>

</section>