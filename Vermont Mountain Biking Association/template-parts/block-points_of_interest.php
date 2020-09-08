<?php
	/**
	 * Template part for displaying a Points of interest.
	 */

	wp_enqueue_script( 'sticky-kit', get_template_directory_uri() . '/assets/js/jquery.sticky-kit.min.js', array( jquery ), '1', false );

?>
<section class="block points_of_interest">
    <div class="outer-block-wrapper"> <!-- extend with needed container -->
        <div class="inner-block-wrapper"> <!-- probably extend with row or -->
            <div class="facetwp-points_of_interest facetwp">
                <div class="facetwp-sidebar sidebar">
					<?php

						echo facetwp_display( 'facet', 'search' );
					?>
                    <span class="label">Region</span>
					<?php
						echo facetwp_display( 'facet', 'region' );
					?>
                    <br>
                    <span class="label">Show Me</span>
					<?php
						echo facetwp_display( 'facet', 'type' );


					?>
                </div>
                <div class="content">
                    <div class="list">
						<?php

							echo facetwp_display( 'template', 'points_of_interest' );
						?>
                    </div>

                    <div class="map">
						<?php

							echo facetwp_display( 'facet', 'poi_map' );
						?>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <script>

        jQuery(document).ready(function () {
            var loads = 0;
            jQuery(document).on('scroll', function () {
                var window_width = jQuery(window).width();

                if (window_width < 768) {
                    jQuery(".facetwp-sidebar").trigger("sticky_kit:detach");
                } else {
                    make_sticky();
                }

                jQuery(window).resize(function () {

                    window_width = jQuery(window).width();

                    if (window_width < 768) {
                        jQuery(".facetwp-sidebar").trigger("sticky_kit:detach");
                    } else {
                        make_sticky();
                    }

                });

                function make_sticky() {
                    jQuery(".facetwp-sidebar").stick_in_parent({
                        offset_top: 120,
                    });
                }

            });


            (function ($) {
                $(document).on('facetwp-loaded', function () {



                    // Scroll to the top of the page after the page is refreshed

                    if (loads > 0) {
                        $('html, body').animate({
                            scrollTop: $(".facetwp-points_of_interest ").offset().top - 150
                        }, 0);
                    }
                    loads++;
                    console.log(loads);
                });

            })(jQuery);
        });
    </script>
</section>