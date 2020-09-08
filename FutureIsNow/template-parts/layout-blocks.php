<?php
/**
 * Template part for displaying blocks
 */
if (have_rows('blocks')):
    $in_accordion = 0;
    while (have_rows('blocks')): the_row();
        if (get_sub_field('collapsible') == 1) {
            if ($in_accordion == 0) {
                wp_enqueue_script('a11yaccordion', get_template_directory_uri() . '/assets/js/aria.accordion.min.js', array(), '20170303', true);
                echo '<div class="accordion-wrapper" data-aria-accordion>';
                $in_accordion = 1;
            }?>

		<h2 class="accordion__header" data-aria-accordion-heading> <?php the_sub_field('label');?></h2>
		<div class="accordion__panel" data-aria-accordion-panel>
			<?php
        } else {
            if ($in_accordion == 1) {
                echo '</div>'; //close current accordion;
            }
        }
        $layout = get_row_layout();
        get_template_part('template-parts/block', $layout);
        if (get_sub_field('collapsible') == 1) {?>
		</div> <!-- aacordion panel close-->
		<?php }
    endwhile;
endif;