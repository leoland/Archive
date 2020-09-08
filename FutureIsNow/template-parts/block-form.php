<?php
/**
 * Template part for displaying a Form.
 */
?>
<section
    class="block form background-<?php the_sub_field('block_background_color');?> <?php the_sub_field('form_type');?>">
    <div class="outer-block-wrapper">
        <!-- extend with needed container -->
        <div class="inner-block-wrapper">
            <!-- probably extend with row or -->
            <!-- Stuff goes here -->
            <div class="form--content">
                <!--follow this pattern for fields, that way their space is not allocated if the field is empty and we do not have weird empty markup everywhere-->
                <?php if (get_sub_field('select_form')): ?>
                <?php
$form_object = get_sub_field('select_form');
gravity_form_enqueue_scripts($form_object['id'], true);
gravity_form($form_object['id'], false, true, false, '', true);
?>
                <?php endif;?>
            </div>

        </div>
    </div>
</section>