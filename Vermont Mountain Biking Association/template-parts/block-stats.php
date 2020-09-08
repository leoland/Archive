<?php
	/**
	 * Template part for displaying a Stats.
	 */


	wp_enqueue_script( 'waypoint', get_template_directory_uri() . '/assets/js/waypoints.min.js', '', '1', true );
	wp_enqueue_script( 'counter-up', get_template_directory_uri() . '/assets/js/jquery.counterup-min.js', array( jquery ), '1', false );
	wp_enqueue_script( 'match-height', get_template_directory_uri() . '/assets/js/jquery.matchHeight-min.js', array( jquery ), '', false );


	$heading = get_sub_field( 'header' );
	$style   = get_sub_field( 'style' );
	$copy    = get_sub_field( 'copy' ); ?>

<section class="block stats style-<?php echo $style;?>">
    <div class="outer-block-wrapper"> <!-- extend with needed container -->
        <div class="inner-block-wrapper"> <!-- probably extend with row or -->
            <h2 class="heading"><?php echo $heading; ?></h2>
            <div class="copy"><?php echo $copy; ?></div>

			<?php if ( have_rows( 'stats' ) ) : ?>
                <div class="counters">
					<?php while ( have_rows( 'stats' ) ) : the_row();

                        $prefix = get_sub_field( 'prefix' );
                        $suffix = get_sub_field( 'suffix' );
                        $counter = get_sub_field( 'stat' );
                        $label = get_sub_field( 'label' );
                        ?>
                        <div class="single-counter">
                            <div class="the-counter">
                                <?php if ($prefix){?>
                                <div class="prefix">
									<?php echo $prefix; ?>
                                </div>
                            <?php }?>

                                <?php if ($counter){?>
                                <div class="counter-wrapper">
	                                <?php echo $counter; ?>
                                <div class="counter">
									<?php echo $counter; ?>
                                </div>
                                </div>
                            <?php }?>

	                            <?php if ($suffix){?>
                                    <div class="suffix">
			                            <?php echo $suffix; ?>
                                    </div>
	                            <?php }?>
                            </div>
	                        <?php if ($label){?>
                                <div class="label">
			                        <?php echo $label; ?>
                                </div>
	                        <?php }?>
                        </div>
					<?php endwhile; ?>
                </div>
			<?php endif; ?>
        </div>
    </div>
    <script>


        jQuery(function () {
            jQuery('.counter').counterUp({
                delay: 10,
                time: 3000
            });
console.log('hai?');
            jQuery('.the-counter').matchHeight(
                {
                    byRow: true,
                    property: 'height',
                });
        });
    </script>
</section>